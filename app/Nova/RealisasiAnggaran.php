<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Nova\Lenses\RealisasiAnggaran as LensesRealisasiAnggaran;
use App\Nova\Lenses\RencanaPenarikanDana;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Query\Search\SearchableText;

class RealisasiAnggaran extends Resource
{
    public static $displayInNavigation = false;

    public static $with = ['daftarSp2d', 'mataAnggaran'];

    public static function label()
    {
        return 'Realisasi Anggaran';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\RealisasiAnggaran::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'daftarSp2d.nomor_spp';

    public static $subtitle = 'daftarSp2d.uraian';

    public static $search = [
        'daftarSp2d.nomor_spp',
        'daftarSp2d.uraian',
        'daftarSp2d.nomor_sp2d',
        'daftarSp2d.tanggal_sp2d',
        'nilai'
    ];
    
    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
       return   $this->defaultFields();
    }

    private function fieldsForDaftarSp2d()
    {
        return [
            Stack::make('RO/Komponen', [
                Line::make('RO', 'mataAnggaran.mak')
                    ->displayUsing(fn ($value) => Helper::getDetailAnggaran($value, 'ro'))->asSubTitle(),
                Line::make('Komponen', 'mataAnggaran.mak')
                    ->displayUsing(fn ($value) => Helper::getDetailAnggaran($value, 'komponen'))->asSmall(),
            ]),
            Stack::make('Akun/Detil', [
                Line::make('Akun', 'mataAnggaran.mak')
                    ->displayUsing(fn ($value) => Helper::getDetailAnggaran($value))->asSubTitle(),
                Line::make('Item', 'mataAnggaran.item')->asSmall(),
            ]),
        ];
    }

    private function defaultFields()
    {
        return [
            Hidden::make('Mata Anggaran', 'mata_anggaran_id')->filterable(),
            Date::make('Tanggal SP2D', 'daftarSp2d.tanggal_sp2d')
                ->sortable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),

            BelongsTo::make('Nomor SPP', 'daftarSp2d', 'App\Nova\DaftarSp2d')
                            ->sortable(),

            Text::make('Nomor SP2D', 'daftarSp2d.nomor_sp2d')
                ->sortable(),

            Text::make('Uraian', 'daftarSp2d.uraian')
                ->sortable(),

            Currency::make('Nilai', 'nilai')
                ->sortable()
                ->rules('required', 'integer'),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [
            LensesRealisasiAnggaran::make(),
            RencanaPenarikanDana::make(),
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
}
