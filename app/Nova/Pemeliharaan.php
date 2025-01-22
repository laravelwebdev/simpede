<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\Pemeliharaan as ModelsPemeliharaan;
use App\Nova\Filters\StatusFilter;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Pemeliharaan extends Resource
{
    public static $with = ['kerangkaAcuan', 'kerangkaAcuan.naskahKeluar', 'daftarPemeliharaan'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Pemeliharaan>
     */
    public static $model = \App\Models\Pemeliharaan::class;

    public static function label()
    {
        return 'Pemeliharaan BMN';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'rincian';

    public function subtitle()
    {
        return 'Status: '.$this->status;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'rincian', 'status',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Stack::make('Kerangka Acuan/Tanggal', 'tanggal_kak', [
                BelongsTo::make('Kerangka Acuan')
                    ->readonly(),
                Date::make('Tanggal KAK', 'tanggal_kak')
                    ->readonly()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Text::make('Rincian')
                ->rules('required'),
            Status::make('Status', 'status')
                ->loadingWhen(['dibuat'])
                ->failedWhen(['outdated'])
                ->sortable(),
            HasMany::make('Barang Pemeliharaan', 'daftarPemeliharaan', 'App\Nova\DaftarPemeliharaan'),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $model = ModelsPemeliharaan::whereYear('tanggal_kak', session('year'));

        return [
            MetricValue::make($model, 'total-pemeliharaan')
                ->width('1/2')
                ->refreshWhenActionsRun(),
            MetricPartition::make($model, 'status', 'status-pemeliharaan')
                ->refreshWhenActionsRun()
                ->width('1/2')
                ->failedWhen(['outdated'])
                ->successWhen(['selesai']),
        ];
    }
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            StatusFilter::make('pemeliharaans'),
        ];
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereYear('tanggal_kak', session('year'));
    }
}
