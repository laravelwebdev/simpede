<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\PembelianPersediaan;
use App\Models\PermintaanPersediaan;
use App\Models\PersediaanKeluar;
use App\Models\PersediaanMasuk;
use App\Nova\PembelianPersediaan as NovaPembelianPersediaan;
use App\Nova\PermintaanPersediaan as NovaPermintaanPersediaan;
use App\Nova\PersediaanKeluar as NovaPersediaanKeluar;
use App\Nova\PersediaanMasuk as NovaPersediaanMasuk;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Query\Search\SearchableMorphToRelation;
use Laravelwebdev\Numeric\Numeric;

class BarangPersediaan extends Resource
{
    public static $displayInNavigation = false;

    public static $with = ['masterPersediaan', 'barangPersediaanable'];

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
    public function title()
    {
        return $this->relationLoaded('masterPersediaan')
            ? $this->masterPersediaan->barang
            : $this->masterPersediaan()->value('barang');
    }

    public function subtitle()
    {
        $item = $this->relationLoaded('barangPersediaanable')
            ? $this->barangPersediaanable
            : $this->barangPersediaanable()->first(); // ambil record tanpa lazy load

        return match ($item::class) {
            PembelianPersediaan::class => $item->rincian,
            PersediaanMasuk::class => $item->rincian,
            PersediaanKeluar::class => $item->rincian,
            PermintaanPersediaan::class => $item->kegiatan,
        };
    }

    public static function searchableColumns()
    {
        return ['masterPersediaan.kode', 'masterPersediaan.barang',
            new SearchableMorphToRelation('barangPersediaanable', 'rincian', [NovaPembelianPersediaan::class]),
            new SearchableMorphToRelation('barangPersediaanable', 'rincian', [NovaPersediaanMasuk::class]),
            new SearchableMorphToRelation('barangPersediaanable', 'rincian', [NovaPersediaanKeluar::class]),
            new SearchableMorphToRelation('barangPersediaanable', 'kegiatan', [NovaPermintaanPersediaan::class]),
        ];
    }

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
                ->hideFromIndex(! Policy::make()
                    ->allowedFor('bmn')
                    ->get())
                ->copyable(),
            Text::make('Kode Barang Sakti', 'masterPersediaan.kode')
                ->displayUsing(fn ($value) => substr($value, 0, 10))
                ->hideFromIndex(! Policy::make()
                    ->allowedFor('ppk,bmn,arsiparis')
                    ->get()),
            Text::make('Volume')
                ->displayUsing(fn ($value) => $value.' '.$this->satuan),
            Numeric::make('Harga Satuan')->hideFromIndex($request->viaResource == 'permintaan-persediaans' || $request->viaResource == 'persediaan-keluars'),
            Numeric::make('Total Harga')->hideFromIndex($request->viaResource == 'permintaan-persediaans' || $request->viaResource == 'persediaan-keluars'),

        ];
    }

    public function fields(NovaRequest $request)
    {
        $fields = [];
        if ($request->viaResource == 'pembelian-persediaans') {
            if (Policy::make()
                ->allowedFor('bmn')
                ->get()) {
                $fields[] =
                    BelongsTo::make('Barang', 'masterPersediaan', MasterPersediaan::class)
                        ->withSubtitles()
                        ->searchable()
                        ->showCreateRelationButton()
                        ->rules('required');
            }
            if (Policy::make()
                ->allowedFor('pbj,bmn')
                ->get()) {
                $fields[] =
                    Text::make('Nama Barang', 'barang')
                        ->readonly(fn () => Policy::make()
                            ->allowedFor('bmn')
                            ->get())
                        ->rules('required', 'max:80');
                $fields[] =
                    Text::make('Satuan', 'satuan')
                        ->readonly(fn () => Policy::make()
                            ->allowedFor('bmn')
                            ->get())
                        ->rules('required', 'max:20');
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
                ->dependsOn(['master_persediaan_id'], function (Number $field, NovaRequest $request, FormData $form) {
                    $stok = Helper::cekStokPersediaan($form->master_persediaan_id);
                    $field
                        ->help('Stok tersedia '.$stok)
                        ->rules('required', 'gt:0', 'lte:'.$stok);
                });
        }

        if ($request->viaResource == 'persediaan-masuks') {
            $fields[] =
            BelongsTo::make('Barang', 'masterPersediaan', MasterPersediaan::class)
                ->withSubtitles()
                ->searchable()
                ->showCreateRelationButton()
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
                ->dependsOn(['master_persediaan_id'], function (Number $field, NovaRequest $request, FormData $form) {
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
        return [
        ];
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
