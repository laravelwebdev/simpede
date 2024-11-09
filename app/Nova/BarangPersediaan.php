<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class BarangPersediaan extends Resource
{
    public static $displayInNavigation = false;

    public static $with = ['masterPersediaan'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BarangPersediaan>
     */
    public static $model = \App\Models\BarangPersediaan::class;

    public static function label()
    {
        return 'Barang Persediaan';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fieldsforIndex(NovaRequest $request)
    {
        return [
            Text::make('Nama Barang', 'barang'),
            Text::make('Kode Barang Detail', 'masterPersediaan.kode')
                ->hideFromIndex(Policy::make()
                    ->notAllowedFor('bmn')
                    ->get())
                ->copyable(),
            Text::make('Kode Barang Sakti', 'masterPersediaan.kode')
                ->displayUsing(fn ($value) => substr($value, 0, 10))
                ->hideFromIndex(Policy::make()
                    ->notAllowedFor('ppk,bmn')
                    ->get())
                ->copyable(),
            Text::make('Volume')
                ->displayUsing(fn ($value) => $value.' '.$this->satuan),
            Currency::make('Harga Satuan')->hideFromIndex($request->viaResource == 'permintaan-persediaans' || $request->viaResource == 'persediaan-keluars'),
            Currency::make('Total Harga')->hideFromIndex($request->viaResource == 'permintaan-persediaans' || $request->viaResource == 'persediaan-keluars'),

        ];
    }

    public function fields(NovaRequest $request)
    {
        $fields = [];
        if ($request->viaResource == 'pembelian-persediaans') {
            if (Policy::make()
                ->notAllowedFor('pbj')
                ->get()) {
                $fields[] =
                    BelongsTo::make('Kode Barang', 'masterPersediaan', 'App\Nova\MasterPersediaan')
                        ->withSubtitles()
                        ->searchable()
                        ->rules('required');
            }
            if (Policy::make()
                ->allowedFor('pbj,bmn')
                ->get()) {
                $fields[] =
                    Text::make('Nama Barang', 'barang')
                        ->rules('required')
                        ->readonly(Policy::make()
                            ->allowedFor('bmn')
                            ->get());
                $fields[] =
                    Text::make('Satuan', 'satuan')
                        ->rules('required')
                        ->readonly(Policy::make()
                            ->allowedFor('bmn')
                            ->get());
            }
            if (Policy::make()
                ->allowedFor('pbj')
                ->get()) {
                $fields[] =
                    Number::make('Volume')
                        ->step(1)
                        ->rules('required', 'gt:0')->min(0);
                $fields[] =
                    Number::make('Harga Satuan')
                        ->step(1)
                        ->rules('required', 'gt:0')->min(0);
            }

        }

        if ($request->viaResource == 'permintaan-persediaans') {
            $fields[] =
            Select::make('Satuan - Barang', 'master_persediaan_id')
                ->options(Helper::setOptionBarangPersediaan())
                ->searchable()
                ->displayUsingLabels()
                ->rules('required');
            $fields[] =
            Number::make('Jumlah', 'volume')
                ->step(1)
                ->dependsOn(['master_persediaan_id'], function (Field $field, NovaRequest $request, FormData $form) {
                    $stok = Helper::cekStokPersediaan($form->master_persediaan_id);
                    $field
                        ->help('Stok tersedia '.$stok)
                        ->rules('required', 'gt:0', 'lte:'.$stok);
                });
        }

        if ($request->viaResource == 'persediaan-masuks') {
            $fields[] =
            Select::make('Barang', 'master_persediaan_id')
                ->options(Helper::setOptionBarangPersediaan())
                ->searchable()
                ->displayUsingLabels()
                ->rules('required');
            $fields[] =
            Number::make('Jumlah', 'volume')
                ->step(1)
                ->rules('required', 'gt:0');
                $fields[] =
            Number::make('Harga Satuan')
                    ->step(1)
                    ->rules('required', 'gt:0')->min(0);
        }

        if ($request->viaResource == 'persediaan-keluars') {
            $fields[] =
            Select::make('Satuan - Barang', 'master_persediaan_id')
                ->options(Helper::setOptionBarangPersediaan())
                ->searchable()
                ->displayUsingLabels()
                ->rules('required');
            $fields[] =
            Number::make('Jumlah', 'volume')
                ->step(1)
                ->dependsOn(['master_persediaan_id'], function (Field $field, NovaRequest $request, FormData $form) {
                    $stok = Helper::cekStokPersediaan($form->master_persediaan_id);
                    $field
                        ->help('Stok tersedia '.$stok)
                        ->rules('required', 'gt:0', 'lte:'.$stok);
                });
        }

        return $fields;
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId;
    }

    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId;
    }

    /**
     * Handle any post-validation processing.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    protected static function afterValidation(NovaRequest $request, $validator)
    {
        if (($request->viaResource == 'persediaan-keluars' || $request->viaResource == 'permintaan-persediaans') && $request->volume > Helper::cekStokPersediaan($request->master_persediaan_id)) {
            $validator->errors()->add('volume', 'Jumlah melebihi stok yang tersedia');
        }
    }
}
