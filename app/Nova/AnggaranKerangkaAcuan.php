<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\KerangkaAcuan;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class AnggaranKerangkaAcuan extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\AnggaranKerangkaAcuan>
     */
    public static $model = \App\Models\AnggaranKerangkaAcuan::class;
    public static $with = ['kerangkaAcuan'];
    public static $displayInNavigation = false;

    public static function label()
    {
        return 'Anggaran';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'mak';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'mak',
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
            Select::make('MAK', 'mak')
                ->rules('required')
                ->searchable()
                ->filterable()
                ->dependsOn('tanggal', function (Select $field, NovaRequest $request, FormData $formData) {
                    $field->options(Helper::setOptionsMataAnggaran(Helper::getYearFromDate(KerangkaAcuan::find($formData->kerangkaAcuan)->tanggal)));
                }),

            Currency::make('Perkiraan Digunakan ', 'perkiraan')
                ->rules('required')
                ->step(1)
                ->default(0),

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
