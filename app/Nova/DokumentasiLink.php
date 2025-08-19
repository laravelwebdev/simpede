<?php

namespace App\Nova;

use App\Models\DokumentasiLink as ModelsDokumentasiLink;
use App\Nova\Metrics\MetricTrend;
use App\Nova\Metrics\MetricValue;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;

class DokumentasiLink extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DokumentasiLink>
     */
    public static $model = \App\Models\DokumentasiLink::class;

    public static function label()
    {
        return 'Link';
    }

    public static $with = ['user'];

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'link';

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
        'uraian', 'link',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Uraian')
                ->rules('required', 'max:255')
                ->sortable(),
            Text::make('Link')
                ->rules('required', 'max:255')
                ->sortable()
                ->onlyOnForms()
                ->creationRules('unique:dokumentasi_links,link')
                ->updateRules('unique:dokumentasi_links,link,{{resourceId}}'),
            URL::make('Lihat', fn () => $this->link),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $model = ModelsDokumentasiLink::whereYear('created_at', session('year'));

        return [
            MetricValue::make($model, 'total-link')
                ->width('1/2')
                ->refreshWhenActionsRun(),
            MetricTrend::make($model, 'created_at', 'trend-link')
                ->refreshWhenActionsRun()
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
