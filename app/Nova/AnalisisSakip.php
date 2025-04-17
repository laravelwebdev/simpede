<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\AnalisisSakip as ModelsAnalisisSakip;
use App\Nova\Metrics\MetricKeberadaan;
use App\Nova\Metrics\MetricPartition;
use App\Nova\Metrics\MetricValue;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Filepond\Filepond;

class AnalisisSakip extends Resource
{
    public static $with = ['unitKerja', 'perjanjianKinerja'];

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
        return $this->kegiatan;
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
    public static function searchableColumns()
    {
        return ['kegiatan', 'kendala', 'solusi'];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            BelongsTo::make('Unit Kerja')
                ->sortable()
                ->exceptOnForms(),
            Select::make('Bulan Pelaksanaan', 'bulan')
                ->options(array_slice(Helper::BULAN, 0, now()->month, true))
                ->displayUsingLabels()
                ->sortable()
                ->filterable()
                ->rules('required'),
            Text::make('Kegiatan')
                ->sortable()
                ->help('Misal: Survei Sosial Ekonomi Nasional Maret, Pengisian Metadata Statistik')
                ->rules('required', 'max:255'),
            Textarea::make('Kendala')
                ->alwaysShow()
                ->rules('required'),
            Textarea::make('Solusi')
                ->alwaysShow()
                ->rules('required'),
            Select::make('Indikator Terdampak', 'perjanjian_kinerja_count')
                ->options([
                    0 => 'Belum Ada',
                ])
                ->filterable(function ($request, $query, $value, $attribute) {
                    $query->has('perjanjianKinerja', '<=', $value);
                })
                ->exceptOnForms(),
            Filepond::make('Bukti Dukung Pelaksanaan Solusi', 'bukti_solusi')
                ->disk('sakip')
                ->disableCredits()
                ->rules('required')
                ->columns(3)
                ->multiple()
                ->limit(10)
                ->path(session('year').'/'.static::uriKey())
                ->prunable(),
            Text::make('Bukti Dukung', 'bukti_solusi')
                ->displayUsing(fn ($value) => empty($value) ? null : count($value).' File')
                ->onlyOnIndex(),
            BelongsToMany::make('Indikator Kinerja Terdampak', 'perjanjianKinerja', PerjanjianKinerja::class)
                ->rules('required'),
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
            MetricPartition::make($model, 'unit_kerja_id', 'unit-kerja-analisis', 'Unit Kerja')
                ->setLabel(Helper::setOptionUnitKerja())
                ->refreshWhenActionsRun(),
            MetricKeberadaan::make('Indikator', $model->withcount('perjanjianKinerja'), 'perjanjian_kinerja_count', 'indikator-terdampak-analisis')
                ->nullStrict(false)
                ->refreshWhenActionsRun(),
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
        return $query->where('tahun', session('year'))->withCount('perjanjianKinerja');
    }
}
