<?php

namespace App\Nova;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Dipa extends Resource
{
    public static function label()
    {
        return 'DIPA';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Dipa>
     */
    public static $model = \App\Models\Dipa::class;

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
        'nomor', 'tahun',
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
            Select::make('Tahun', 'tahun')
                ->sortable()
                ->rules('required')
                ->options(Helper::setOptionTahun())
                ->creationRules('unique:dipas,tahun')
                ->updateRules('unique:dipas,tahun,{{resourceId}}'),
            Text::make('Nomor', 'nomor')
                ->sortable()
                ->rules('required'),
            Date::make('Tanggal', 'tanggal')
                ->sortable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
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