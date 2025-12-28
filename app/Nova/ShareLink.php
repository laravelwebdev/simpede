<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Nova\Filters\FilterTahunDipa;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;

class ShareLink extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ShareLink>
     */
    public static $model = \App\Models\ShareLink::class;

    public static function label()
    {
        return 'Share Link SPJ';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'tahun';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'tahun',
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
            Select::make('Tahun')
                ->sortable()
                ->searchable()
                ->rules('required')
                ->creationRules('unique:share_links,tahun')
                ->updateRules('unique:share_links,tahun,{{resourceId}}')
                ->options(Helper::setOptionTahunDipa()),
            Text::make('Link')
                ->exceptOnForms()
                ->displayUsing(fn () => 'Salin')
                ->copyable(),
            URL::make('Lihat', fn () => $this->link),
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
        return [
            FilterTahunDipa::make('tahun'),
        ];
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
