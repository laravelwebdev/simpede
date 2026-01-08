<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class SusenasFitur extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\SusenasFitur>
     */
    public static $model = \App\Models\SusenasFitur::class;

    public static function label()
    {
        return 'Fitur';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nama_fitur';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nama_fitur',
    ];

    public static $globallySearchable = false;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Nama Fitur', 'nama_fitur')
                ->rules('required', 'string', 'max:30')
                ->sortable(),
            Text::make('Path', 'path')
                ->rules('required', 'string', 'max:255')
                ->hideFromIndex()
                ->sortable(),
            Textarea::make('Image', 'image')
                ->rules('required', 'string')
                ->onlyOnForms()
                ->help('base64 image string'),
            Boolean::make('Active', 'is_active')
                ->rules('required', 'boolean')
                ->filterable()
                ->default(true)
                ->sortable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
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
