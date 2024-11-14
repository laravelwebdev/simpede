<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class RealisasiAnggaran extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\RealisasiAnggaran::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nomor_sp2d';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nomor_sp2d', 'uraian'
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
            ID::make()->sortable(),

            Date::make('Tanggal SP2D', 'tanggal_sp2d')
                ->sortable()
                ->rules('required', 'date'),

            Text::make('Nomor SPP', 'nomor_spp')
                ->sortable()
                ->rules('required', 'max:10'),

            Text::make('Nomor SP2D', 'nomor_sp2d')
                ->sortable()
                ->rules('required', 'max:20'),

            Text::make('Uraian', 'uraian')
                ->sortable()
                ->rules('required', 'max:255'),

            Number::make('COA ID', 'coa_id')
                ->sortable()
                ->rules('required', 'integer'),

            Number::make('Nilai', 'nilai')
                ->sortable()
                ->rules('required', 'integer'),


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
        return [
            new \App\Nova\Lenses\SerapanAnggaranLens,
        ];
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