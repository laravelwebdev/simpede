<?php

namespace App\Nova;

use App\Helpers\Policy;
use App\Nova\Actions\ImportMitra;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class KepkaMitra extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\KepkaMitra>
     */
    public static $model = \App\Models\KepkaMitra::class;

    public static function label()
    {
        return 'Kepka Mitra';
    }

    public static $with = ['mitra'];

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nomor';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nomor',
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
            Text::make('Nomor', 'nomor')
                ->sortable()
                ->rules('required'),
            HasMany::make('Mitra'),
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
        $actions = [];
        if (Policy::make()->allowedFor('admin')->get()) {
            $actions [] =
                ImportMitra::make()
                    ->showInline()
                    ->showOnDetail()
                    ->exceptOnIndex();
        }

        return $actions;
    }
}
