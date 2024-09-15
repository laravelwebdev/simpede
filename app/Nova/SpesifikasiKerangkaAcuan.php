<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class SpesifikasiKerangkaAcuan extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\SpesifikasiKerangkaAcuan>
     */
    public static $model = \App\Models\SpesifikasiKerangkaAcuan::class;
    public static $with = ['kerangkaAcuan'];
    public static $displayInNavigation = false;

    public static function label()
    {
        return 'Spesifikasi';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'rincian',
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
            Text::make('Rincian')
                ->rules('required'),
            Number::make('Volume')
                ->rules('required')
                ->default(0),
            Text::make('Satuan')
                ->rules('required'),
            Currency::make('Harga Satuan')
                ->rules('required')
                ->step(1)
                ->default(0),
            Textarea::make('Spesifikasi')
                ->rows(2)
                ->rules('required')
                ->placeholder('Mohon diisi secara detail dan spesifik')
                ->alwaysShow(),
            BelongsTo::make('Kerangka Acuan Kerja', 'kerangkaAcuan', KerangkaAcuan::class)
                ->rules('required')
                ->searchable()
                ->onlyOnForms(),
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
