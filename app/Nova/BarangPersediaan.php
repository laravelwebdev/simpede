<?php

namespace App\Nova;

use App\Helpers\Policy;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
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
            Currency::make('Harga Satuan'),
            Currency::make('Total Harga'),

        ];
    }

    // public function fields(NovaRequest $request)
    // {
    //     return [
    //         Text::make('Nama Barang', 'barang')
    //             ->readonly(),
    //         Text::make('Satuan', 'satuan')
    //             ->readonly(),
    //         BelongsTo::make('Kode Barang', 'masterPersediaan', 'App\Nova\MasterPersediaan')
    //             ->withSubtitles()
    //             ->searchable()
    //             ->onlyOnForms()
    //             ->rules('required'),
    //         Text::make('Kode Barang Detail', 'masterPersediaan.kode')
    //             ->onlyOnIndex()
    //             ->copyable(),
    //         Text::make('Kode Barang Sakti', 'masterPersediaan.kode')
    //             ->displayUsing(fn ($value) => substr($value, 0, 10))
    //             ->onlyOnIndex()
    //             ->copyable(),
    //         Number::make('Volume')
    //             ->step(0.01)
    //             ->rules('required', 'gt:0')->min(0),
    //         Currency::make('Harga Satuan')

    //             ->step(1)
    //             ->rules('required', 'gt:0'),

    //     ];
    // }

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
                        ->step(0.01)
                        ->rules('required', 'gt:0')->min(0);
                $fields[] =
                    Number::make('Harga Satuan')
                        ->step(1)
                        ->rules('required', 'gt:0')->min(0);
            }

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
}
