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
        $triwulan = Helper::getTriwulanBerjalan(now()->month);

        return $this->{'realisasi_tw'.$triwulan};
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
                ->rules('required', 'numeric', 'gte:0'),
            Number::make('Target Triwulan II', 'target_tw2')
                ->step(0.01)
                ->help('Target kumulatif sampai dengan triwulan II')
                ->rules('required', 'numeric', 'gte:target_tw1'),
            Number::make('Target Triwulan III', 'target_tw3')
                ->step(0.01)
                ->help('Target kumulatif sampai dengan triwulan III')
                ->rules('required', 'numeric', 'gte:target_tw2'),
            Number::make('Target Triwulan IV', 'target_tw4')
                ->step(0.01)
                ->help('Target kumulatif sampai dengan triwulan IV')
                ->rules('required', 'numeric', 'gte:target_tw3'),
            Textarea::make('Penjelasan Target', 'keterangan_target')
                ->alwaysShow()
                ->help('Misalnya rincian target secara detail, misal 4 dinas apa saja yang menjadi target dll')
                ->rules('required'),
            Panel::make('Realisasi Triwulan 1', [
                Number::make('Realisasi TW 1', 'realisasi_tw1')
                    ->rules('nullable', 'numeric', 'gte:0')
                    ->step(0.01)
                    ->hideWhenCreating()
                    ->immutable(! Helper::is_triwulan(1))
                    ->hide(fn () => Helper::is_triwulan_kumulatif(1))
                    ->help('Realisasi secara kumulatif sampai dengan Triwulan I'),
                Textarea::make('Penjelasan Realisasi', 'keterangan_realisasi_tw1')
                    ->hideWhenCreating()
                    ->alwaysShow()
                    ->help('Misalnya penjelasan penyebab non respon, rincian capaian, dan lain-lain')
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
            Panel::make('Realisasi Triwulan 2', [
                Number::make('Realisasi TW 2', 'realisasi_tw2')
                    ->rules('nullable', 'numeric', 'gte:0')
                    ->step(0.01)
                    ->hideWhenCreating()
                    ->immutable(! Helper::is_triwulan(2))
                    ->hide(fn () => Helper::is_triwulan_kumulatif(2))
                    ->help('Realisasi secara kumulatif sampai dengan Triwulan II'),
                Textarea::make('Penjelasan Realisasi', 'keterangan_realisasi_tw2')
                    ->hideWhenCreating()
                    ->alwaysShow()
                    ->help('Misalnya penjelasan penyebab non respon, rincian capaian, dan lain-lain')
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
            Panel::make('Realisasi Triwulan 3', [
                Number::make('Realisasi TW 3', 'realisasi_tw3')
                    ->rules('nullable', 'numeric', 'gte:0')
                    ->step(0.01)
                    ->hideWhenCreating()
                    ->immutable(! Helper::is_triwulan(3))
                    ->hide(fn () => Helper::is_triwulan_kumulatif(3))
                    ->help('Realisasi secara kumulatif sampai dengan Triwulan III'),
                Textarea::make('Penjelasan Realisasi', 'keterangan_realisasi_tw3')
                    ->hideWhenCreating()
                    ->alwaysShow()
                    ->help('Misalnya penjelasan penyebab non respon, rincian capaian, dan lain-lain')
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
            Panel::make('Realisasi Triwulan 4', [
                Number::make('Realisasi TW 4', 'realisasi_tw4')
                    ->rules('nullable', 'numeric', 'gte:0')
                    ->step(0.01)
                    ->hideWhenCreating()
                    ->immutable(! Helper::is_triwulan(4))
                    ->hide(fn () => Helper::is_triwulan_kumulatif(4))
                    ->help('Realisasi secara kumulatif sampai dengan Triwulan IV'),
                Textarea::make('Penjelasan Realisasi', 'keterangan_realisasi_tw4')
                    ->hideWhenCreating()
                    ->alwaysShow()
                    ->help('Misalnya penjelasan penyebab non respon, rincian capaian, dan lain-lain')
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
        $model = ModelsRealisasiKinerja::where('perjanjian_kinerja_id', optional(PerjanjianKinerja::where('tahun', session('year'))->first())->id);
        $triwulan = Helper::getTriwulanBerjalan(now()->month);
        $title = 'Triwulan '.strtoupper($triwulan);

        return [
            MetricValue::make($model, 'total-realisasi-kinerja')
                ->width('1/2')
                ->refreshWhenActionsRun(),
            MetricKeberadaan::make('Kelengkapan Isian '.$title, $model, 'realisasi_tw'.$triwulan, 'keberadaan-realisasi-kinerja-tw'.$triwulan)
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
