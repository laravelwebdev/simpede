<?php

namespace App\Nova;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class UnitKerja extends Resource
{
    /**
     * Get the label for the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Unit Kerja';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\UnitKerja>
     */
    public static $model = \App\Models\UnitKerja::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'unit';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'unit', 'kode',
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
                ->help('Kode Unit Kerja untuk ditampilkan di nomor surat')
                ->rules('required'),
            Text::make('Unit')
                ->help('Nama Unit Kerja')
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
