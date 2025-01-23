<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\AnalisisSakip as ModelsAnalisisSakip;
use App\Nova\Metrics\MetricPartition;
use App\Nova\Metrics\MetricValue;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Filepond\Filepond;

class AnalisisSakip extends Resource
{
    public static $with = ['unitKerja'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\AnalisisSakip>
     */
    public static $model = \App\Models\AnalisisSakip::class;

    public static function label()
    {
        return 'Kendala - Solusi';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return 'Analisis SAKIP Bulan '.Helper::$bulan[$this->bulan];
    }

    public function subtitle()
    {
        return $this->tahun;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kegiatan', 'kendala', 'solusi', 'tindak_lanjut',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Bulan', 'bulan')
                ->options(Helper::$bulan)
                ->displayUsingLabels()
                ->sortable()
                ->filterable()
                ->rules('required'),
            Select::make('Kategori')
                ->options(Helper::$kategori_sakip)
                ->displayUsingLabels()
                ->sortable()
                ->filterable()
                ->rules('required'),
            BelongsTo::make('Unit Kerja')
                ->rules('required')
                ->filterable(),
            Text::make('Kegiatan')
                ->sortable()
                ->help('Misal: Survei Sosial Ekonomi Nasional Maret, Pengisian Metadata Statistik')
                ->rules('required'),
            Textarea::make('Kendala')
                ->rules('required'),
            Textarea::make('Solusi')
                ->rules('required'),
            Filepond::make('Bukti Dukung Pelaksanaan Solusi', 'bukti_solusi')
                ->disk('arsip')
                ->disableCredits()
                ->rules('required')
                ->columns(3)
                ->multiple()
                ->path(session('year').'/'.static::uriKey())
                ->prunable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $model = ModelsAnalisisSakip::where('tahun', session('year'))->where('bulan', now()->month);

        return [
            MetricValue::make($model, 'total-analisis')
                ->refreshWhenActionsRun(),
            MetricPartition::make($model, 'kategori', 'kategori-analisis', 'Kategori')
                ->refreshWhenActionsRun()
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('tahun', session('year'))->where('bulan', now()->month);
    }

}
