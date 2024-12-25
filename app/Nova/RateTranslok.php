<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class RateTranslok extends Resource
{
    public static $with = ['asalMasterWilayah', 'tujuanMasterWilayah', 'skTranslok'];
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\RateTranslok>
     */
    public static $model = \App\Models\RateTranslok::class;

    public static function label()
    {
        return 'Rate Translok';
    }

    public static $displayInNavigation = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public function subtitle(){
        return $this->rate;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'asalMasterWilayah.wilayah', 'tujuanMasterWilayah.wilayah'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Tipe', 'type')
                ->sortable()
                ->rules('required')
                ->displayUsingLabels()
                ->filterable()
                ->hideFromIndex()
                ->options(Helper::$translok_type),
            Text::make('Asal', 'asalMasterWilayah.wilayah')
                ->sortable()
                ->rules('required'),
            Text::make('Tujuan', 'tujuanMasterWilayah.wilayah')
                ->sortable()
                ->rules('required'),
            Currency::make('Rate', 'rate')
                ->rules('required'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
