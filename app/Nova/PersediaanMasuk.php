<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class PersediaanMasuk extends Resource
{
    public static $with = ['daftarBarangPersediaans'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PersediaanMasuk>
     */
    public static $model = \App\Models\PersediaanMasuk::class;

    public static function label()
    {
        return 'Persediaan Masuk';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nomor_dokumen';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nomor_dokumen',
        'rincian',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Nomor Dokumen', 'nomor_dokumen')
                ->rules('required', 'max:40'),
            Date::make('Tanggal Dokumen', 'tanggal_dokumen')
                ->sortable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('required'),
            Text::make('Rincian', 'rincian')
                ->rules('required'),
            Date::make('Tanggal Buku', 'tanggal_buku')
                ->sortable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('required', 'after_or_equal:tanggal_dokumen'),

            MorphMany::make('Daftar Barang Persediaan', 'daftarBarangPersediaans', 'App\Nova\BarangPersediaan'),
        ];
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
}