<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\PerjanjianKinerja;
use App\Models\RealisasiKinerja as ModelsRealisasiKinerja;
use App\Nova\Metrics\MetricKeberadaan;
use App\Nova\Metrics\MetricValue;
use App\Nova\PerjanjianKinerja as ResourcePerjanjianKinerja;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravelwebdev\Filepond\Filepond;

class RealisasiKinerja extends Resource
{
    public static $with = ['perjanjianKinerja', 'unitKerja'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\RealisasiKinerja>
     */
    public static $model = \App\Models\RealisasiKinerja::class;

    public static function label()
    {
        return 'Realisasi Kinerja';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'komponen';

    public function subtitle()
    {
        $currentMonth = now()->month;
        if ($currentMonth) {
            return $this->realisasi_tw1;
        }

        if ($currentMonth <= 6) {
            return $this->realisasi_tw2;
        }

        if ($currentMonth <= 9) {
            return $this->realisasi_tw3;
        }

        return $this->realisasi_tw4;

    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'komponen',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            BelongsTo::make('Indikator Realisasi Kinerja', 'perjanjianKinerja', ResourcePerjanjianKinerja::class)
                ->sortable()
                ->withSubtitles()
                ->immutable(! Policy::make()->allowedFor('kasubbag')->get())
                ->hideFromIndex()
                ->rules('required'),
            Text::make('Komponen')
                ->sortable()
                ->immutable(! Policy::make()->allowedFor('kasubbag')->get())
                ->rules('required'),
            BelongsTo::make('Penanggung Jawab', 'unitKerja', UnitKerja::class)
                ->sortable()
                ->withSubtitles()
                ->immutable(! Policy::make()->allowedFor('kasubbag')->get())
                ->rules('required'),
            Boolean::make('Indikator Perhitungan Kinerja', 'is_indikator')
                ->immutable(! Policy::make()->allowedFor('kasubbag')->get())
                ->hideFromIndex()
                ->rules('required'),
            Number::make('Target Triwulan I', 'target_tw1')
                ->step(0.01)
                ->help('Target total selama triwulan I')
                ->rules('required', 'integer', 'gte:0'),
            Number::make('Target Triwulan II', 'target_tw2')            
                ->step(0.01)
                ->help('Target kumulatif sampai dengan triwulan II')
                ->rules('required', 'integer', 'gte:target_tw1'),
            Number::make('Target Triwulan III', 'target_tw3')
                ->step(0.01)
                ->help('Target kumulatif sampai dengan triwulan III')
                ->rules('required', 'integer', 'gte:target_tw2'),
            Number::make('Target Triwulan IV', 'target_tw4')
                ->step(0.01)
                ->help('Target kumulatif sampai dengan triwulan IV')
                ->rules('required', 'integer', 'gte:target_tw3'),                
            Textarea::make('Penjelasan Target Target', 'keterangan_target')
                ->alwaysShow()
                ->rules('required'),
            Panel::make('Realisasi Triwulan I', [
                Number::make('Realisasi TW I', 'realisasi_tw1')
                    ->rules('nullable', 'integer', 'gte:0')
                    ->step(0.01)
                    ->hideWhenCreating()
                    ->immutable(! Helper::is_triwulan(1))
                    ->hide(fn () => Helper::is_triwulan_kumulatif(1))
                    ->help('Realisasi secara kumulatif sampai dengan Triwulan I'),
                Textarea::make('Penjelasan Realisasi', 'keterangan_realisasi_tw1')
                    ->hideWhenCreating()
                    ->alwaysShow()
                    ->immutable(! Helper::is_triwulan(1))
                    ->hide(fn () => Helper::is_triwulan_kumulatif(1)),
                Filepond::make('Bukti Dukung Realisasi', 'bukti_realisasi_tw1')
                    ->disk('sakip')
                    ->disableCredits()
                    ->prunable()
                    ->hide(! Helper::is_triwulan(1))
                    ->columns(3)
                    ->multiple()
                    ->limit(10)
                    ->path(session('year').'/'.static::uriKey())
                    ->hideWhenCreating(),
            ]),
            Panel::make('Realisasi Triwulan II', [
                Number::make('Realisasi TW II', 'realisasi_tw2')
                    ->rules('nullable', 'integer', 'gte:0')
                    ->step(0.01)
                    ->hideWhenCreating()
                    ->immutable(! Helper::is_triwulan(2))
                    ->hide(fn () => Helper::is_triwulan_kumulatif(2))
                    ->help('Realisasi secara kumulatif sampai dengan Triwulan II'),
                Textarea::make('Penjelasan Realisasi', 'keterangan_realisasi_tw2')
                    ->hideWhenCreating()
                    ->alwaysShow()
                    ->immutable(! Helper::is_triwulan(2))
                    ->hide(fn () => Helper::is_triwulan_kumulatif(2)),
                Filepond::make('Bukti Dukung Realisasi', 'bukti_realisasi_tw2')
                    ->disk('sakip')
                    ->disableCredits()
                    ->prunable()
                    ->hide(! Helper::is_triwulan(2))
                    ->columns(3)
                    ->multiple()
                    ->limit(10)
                    ->path(session('year').'/'.static::uriKey())
                    ->hideWhenCreating(),
            ]),
            Panel::make('Realisasi Triwulan III', [
                Number::make('Realisasi TW III', 'realisasi_tw3')
                    ->rules('nullable', 'integer', 'gte:0')
                    ->step(0.01)
                    ->hideWhenCreating()
                    ->immutable(! Helper::is_triwulan(3))
                    ->hide(fn () => Helper::is_triwulan_kumulatif(3))
                    ->help('Realisasi secara kumulatif sampai dengan Triwulan III'),
                Textarea::make('Penjelasan Realisasi', 'keterangan_realisasi_tw3')
                    ->hideWhenCreating()
                    ->alwaysShow()
                    ->immutable(! Helper::is_triwulan(3))
                    ->hide(fn () => Helper::is_triwulan_kumulatif(3)),
                Filepond::make('Bukti Dukung Realisasi', 'bukti_realisasi_tw3')
                    ->disk('sakip')
                    ->disableCredits()
                    ->prunable()
                    ->hide(! Helper::is_triwulan(3))
                    ->columns(3)
                    ->multiple()
                    ->limit(10)
                    ->path(session('year').'/'.static::uriKey())
                    ->hideWhenCreating(),
            ]),
            Panel::make('Realisasi Triwulan IV', [
                Number::make('Realisasi TW IV', 'realisasi_tw4')
                    ->rules('nullable', 'integer', 'gte:0')
                    ->step(0.01)
                    ->hideWhenCreating()
                    ->immutable(! Helper::is_triwulan(4))
                    ->hide(fn () => Helper::is_triwulan_kumulatif(4))
                    ->help('Realisasi secara kumulatif sampai dengan Triwulan IV'),
                Textarea::make('Penjelasan Realisasi', 'keterangan_realisasi_tw4')
                    ->hideWhenCreating()
                    ->alwaysShow()
                    ->immutable(! Helper::is_triwulan(4))
                    ->hide(fn () => Helper::is_triwulan_kumulatif(4)),
                Filepond::make('Bukti Dukung Realisasi', 'bukti_realisasi_tw4')
                    ->disk('sakip')
                    ->disableCredits()
                    ->prunable()
                    ->hide(! Helper::is_triwulan(4))
                    ->columns(3)
                    ->multiple()
                    ->limit(10)
                    ->path(session('year').'/'.static::uriKey())
                    ->hideWhenCreating(),
            ]),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $model = ModelsRealisasiKinerja::where('perjanjian_kinerja_id', PerjanjianKinerja::where('tahun', session('year'))->first()->id);

        $currentMonth = now()->month;
        if ($currentMonth <= 3) {
            $triwulan = 'tw1';
            $title = 'Triwulan I';
        } elseif ($currentMonth <= 6) {
            $triwulan = 'tw2';
            $title = 'Triwulan II';
        } elseif ($currentMonth <= 9) {
            $triwulan = 'tw3';
            $title = 'Triwulan III';
        } else {
            $triwulan = 'tw4';
            $title = 'Triwulan IV';
        }

        return [
            MetricValue::make($model, 'total-realisasi-kinerja')
                ->width('1/2')
                ->refreshWhenActionsRun(),
            MetricKeberadaan::make('Kelengkapan Isian '.$title, $model, 'realisasi_'.$triwulan, 'keberadaan-realisasi-kinerja-'.$triwulan)
                ->refreshWhenActionsRun()
                ->setAdaLabel('Terisi')
                ->setTidakAdaLabel('Kosong')
                ->width('1/2'),
        ];
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
