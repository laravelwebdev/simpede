<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DigitalPayment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DigitalPayment>
     */
    public static $model = \App\Models\DigitalPayment::class;

    public static $with = ['kerangkaAcuan'];

    public static function label()
    {
        return 'Penggunaan CMS dan KKP';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'kerangkaAcuan.naskahKeluar.nomor';

    public function subtitle()
    {
        return 'kerangkaAcuan.rincian';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kerangkaAcuan.rincian',
        'tanggal_transaksi',
        'tanggal_pembayaran',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Uraian', 'kerangkaAcuan.rincian')
                ->sortable(),
            Select::make('Jenis', 'jenis')
                ->options(Helper::JENIS_DIGITAL_PAYMENT)
                ->displayUsingLabels()
                ->rules('required')
                ->filterable()
                ->sortable(),
            Date::make('Tanggal Transaksi', 'tanggal_transaksi')
                ->rules('required')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->filterable()
                ->sortable(),
            Text::make('Nomor SP2D/SPBy', 'nomor')
                ->rules('nullable', 'bail', 'max:50')
                ->sortable()
                ->readonly(! Policy::make()->allowedFor('ppk')->get())
                ->help('Masukkan nomor SP2D untuk pembayaran KKP atau Nomor SPBY untuk CMS'),
            Date::make('Tanggal Pembayaran', 'tanggal_pembayaran')
                ->rules('nullable', 'bail', 'after_or_equal:tanggal_transaksi')
                ->sortable()
                ->readonly(! Policy::make()->allowedFor('ppk')->get())
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->filterable()
                ->help('Masukkan tanggal SP2D untuk pembayaran KKP atau tanggal Persetujuan SPBy oleh PPK untuk CMS'),
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
        return [
            new Lenses\MonitoringDigitalPayment,
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
