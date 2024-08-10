<?php

namespace App\Nova;

use Illuminate\Support\Facades\Schema;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class KodeNaskah extends Resource
{
    /**
     * Get the label for the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Format Penomoran Naskah';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\KodeNaskah>
     */
    public static $model = \App\Models\KodeNaskah::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'kategori';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kategori',
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
        Text::make('Kategori')
            ->creationRules('unique:kode_naskahs,kategori')
            ->updateRules('unique:kode_naskahs,kategori,{{resourceId}}')
            ->rules('required'),
        Text::make('Format Penomoran','format')
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
