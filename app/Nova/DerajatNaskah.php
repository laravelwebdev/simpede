<?php

namespace App\Nova;

use App\Nova\Actions\AddDerajatNaskah;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DerajatNaskah extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DerajatNaskah>
     */
    public static $model = \App\Models\DerajatNaskah::class;

    public static function label()
    {
        return 'Derajat Naskah';
    }

    public static $displayInNavigation = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'derajat';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'derajat',
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
            Text::make('Kode')
                ->rules('required'),
            Text::make('Derajat Naskah', 'derajat')
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
        return [
            AddDerajatNaskah::make($request->viaResourceId)
                ->confirmButtonText('Tambah')
                // ->size('7xl')
                ->standalone(),
        ];
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/resources/tata-naskahs/'.$request->viaResourceId.'#Detail%20Naskah=derajat-naskah';
    }
}
