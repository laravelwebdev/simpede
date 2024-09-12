<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Pengelola extends Resource
{
    /**
     * Get the label for the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Pengelola';
    }

    public static $with = ['user'];
    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Pengelola>
     */
    public static $model = \App\Models\Pengelola::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'role';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'role',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('role')
                ->options(Helper::$role)
                ->displayUsingLabels()
                ->rules('required'),
            Date::make('Tanggal Aktivasi', 'active')
                ->rules('required')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            Date::make('Tanggal Deaktivasi', 'inactive')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            BelongsTo::make('User')
                ->rules('required')
                ->onlyOnForms(),
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
