<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class PerjalananDinas extends Resource
{
    public static $with = ['spdNaskahKeluar', 'stNaskahKeluar', 'anggaranKerangkaAcuan', 'kerangkaAcuan', 'daftarPesertaPerjalanan'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PerjalananDinas>
     */
    public static $model = \App\Models\PerjalananDinas::class;

    public static function label()
    {
        return 'Perjalanan Dinas';
    }

    public static function singularLabel()
    {
        return 'Perjalanan Dinas';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'spdNaskahKeluar.nomor';

    public function subtitle()
    {
        return $this->uraian;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'uraian',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Stack::make('Nomor/Tanggal KAK', [
                BelongsTo::make('Nomor:', 'kerangkaAcuan', 'App\Nova\KerangkaAcuan'),
                Date::make('Tanggal:', 'kerangkaAcuan.tanggal')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ]),
            Stack::make('Nomor/Tanggal SPPD', 'tanggal_spd', [
                BelongsTo::make('Nomor:', 'spdNaskahKeluar', 'App\Nova\NaskahKeluar'),
                Date::make('Tanggal:', 'spd.naskahKeluar.tangggal')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Stack::make('Nomor/Tanggal Surat Tugas', 'tanggal_st', [
                BelongsTo::make('Nomor:', 'stNaskahKeluar', 'App\Nova\NaskahKeluar'),
                Date::make('Tanggal:', 'st.naskahKeluar.tangggal')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Text::make('Uraian', 'uraian')
                ->rules('required'),
            Panel::make('Surat Perjalanan Dinas', [
                Date::make('Tanggal SPD', 'tanggal_spd')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                    ->rules('required', 'before_or_equal:tanggal_berangkat', 'after_or_equal:tanggal_st', 'before_or_equal:today')
                    ->onlyOnForms(),
                Select::make('Klasifikasi Arsip SPD', 'spd_kode_arsip_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(KodeArsip::cache()->get('all')->where('id', $kode)->first(), 'kode'))
                    ->rules('required')
                    ->dependsOn(['tanggal_spd'], function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionsKodeArsip($formData->tanggal_spd));
                    }),
            ]),
            Panel::make('Surat Tugas', [
                Date::make('Tanggal Surat Tugas', 'tanggal_st')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                    ->rules('required', 'before_or_equal:tanggal_berangkat', 'before_or_equal:today')
                    ->onlyOnForms(),
                Select::make('Klasifikasi Arsip ST', 'st_kode_arsip_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(KodeArsip::cache()->get('all')->where('id', $kode)->first(), 'kode'))
                    ->rules('required')
                    ->dependsOn(['tanggal_st'], function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionsKodeArsip($formData->tanggal_st));
                    }),
            ]),
            Date::make('Tanggal Berangkat', 'tanggal_berangkat')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
               ,
            Date::make('Tanggal Kembali', 'tanggal_kembali')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
               ,

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
