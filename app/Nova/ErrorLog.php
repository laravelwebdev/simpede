<?php

namespace App\Nova;

use App\Nova\Lenses\SystemReport;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class ErrorLog extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ErrorLog>
     */
    public static $model = \App\Models\ErrorLog::class;

    public static function label()
    {
        return 'Error Log';
    }

    public static $displayInNavigation = false;

    public static $globallySearchable = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'level';

    public function subtitle()
    {
        return $this->file;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'message', 'context', 'file',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [

            Badge::make('Level')
                ->map([
                    'EMERGENCY' => 'danger',
                    'ALERT' => 'danger',
                    'CRITICAL' => 'danger',
                    'ERROR' => 'danger',
                    'WARNING' => 'warning',
                    'NOTICE' => 'info',
                    'INFO' => 'info',
                    'DEBUG' => 'info',
                ])
                ->withIcons()
                ->filterable(),
            Text::make('File', function ($model) {
                if (is_null($model->file)) {
                    return null;
                }

                return $model->file.' on Line :'.$model->line;
            })->onlyOnDetail(),
            Stack::make('Details', [
                Text::make('Context'),
                Line::make('File', function ($model) {
                    if (is_null($model->file)) {
                        return null;
                    }

                    return $model->file.' on Line :'.$model->line;
                })->asBase(),
                Line::make('Message', function ($model) {
                    return strlen($model->message) > 175
                        ? substr($model->message, 0, 175).'...'
                        : $model->message;
                })->asSmall(),
            ])->onlyOnIndex(),
            Textarea::make('Message')->alwaysShow()->onlyOnDetail(),
            Numeric::make('Count')->sortable(),
            Boolean::make('Resolved')->filterable(),

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
        return [
            SystemReport::make(),
        ];
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
