<?php

namespace App\Nova;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;

class SkKpa extends Resource
{
    use Breadcrumbs;
    public static $group = 'Referensi';

    public static function label()
    {
        return 'SK KPA';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SkKpa::class;

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
        'nomor', 'tanggal', 'perihal',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make('Nomor', 'nomor')
                ->hideWhenCreating()
                ->readonly(function ($request) {
                    return $request->isUpdateOrUpdateAttachedRequest();
                })->sortable()
                ->rules('required'),
            Date::make('Tanggal SK', 'tanggal')
                ->readonly(function ($request) {
                    return $request->isUpdateOrUpdateAttachedRequest();
                })->sortable()
                ->rules('required')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Textarea::make('Perihal', 'perihal')
                ->placeholder('Perihal surat')
                ->rules('required')->alwaysShow(),
        ];
    }


    /**
     * Get the fields displayed by the resource on index page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fieldsForIndex(Request $request)
    {
        return [
            // ID::make(__('ID'), 'id')->sortable(),
            Stack::make('Nomor/Tanggal', [
                Line::make('Nomor', 'nomor')->asHeading(),
                Date::make('Tanggal ', 'tanggal')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            ]),
            Textarea::make('Perihal')
                ->showOnIndex()
                ->readMore(['max' => 255, 'mask' => '(...)']),
        ];
    }

    /**
     * Return the location to redirect the user after creation.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Nova\Resource  $resource
     * @return string
     */
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/resources/'.static::uriKey();
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Nova\Resource  $resource
     * @return string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/resources/'.static::uriKey();
    }


    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
