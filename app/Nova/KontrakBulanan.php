<?php

namespace App\Nova;

use App\Helpers\Helper;
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class KontrakBulanan extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\KontrakMitra>
     */
    public static $model = \App\Models\KontrakBulanan::class;

    public static function label()
    {
        return 'Kontrak Bulanan';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nama_kontrak';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nama_kontrak', 'bulan', 'jenis',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Bulan Kontrak', 'bulan')
                ->rules('required')
                ->options(Helper::$bulan)
                ->filterable()
                ->displayUsingLabels(),
            Select::make('Jenis Kontrak', 'jenis_kontrak')
                ->rules('required')
                ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(JenisKontrak::cache()->get('all')->where('id', $kode)->first(), 'jenis'))
                ->dependsOn('bulan', function (Select $field, NovaRequest $request, FormData $form) {
                    $field->options(Helper::setOptionJenisKontrak(Carbon::createFromDate(session('year'), $form->bulan)->startOfMonth()));
                }),
            Date::make('Tanggal SPK', 'tanggal_spk')
                ->rules('required')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Date::make('Tanggal Mulai Pelaksanaan Kontrak', 'awal_kontrak')
                ->rules('required', 'after_or_equal:tanggal_spk')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Date::make('Tanggal Selesai Kontrak', 'akhir_kontrak')
                ->rules('required', 'after_or_equal:awal')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
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