<?php

namespace App\Nova;

use App\Nova\Actions\AddKodeArsip;
use App\Nova\Filters\GroupArsip;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class KodeArsip extends Resource
{

    /**
     * Get the label for the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Kode Arsip Naskah';
    }

    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\KodeArsip>
     */
    public static $model = \App\Models\KodeArsip::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'detail';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kode', 'group', 'detail',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Kode Arsip', 'kode')
                ->sortable()
                ->rules('required'),
            Text::make('Klasifikasi', 'group')
                ->sortable()
                ->rules('required'),
            Text::make('Detail', 'detail')
                ->sortable()
                ->rules('required'),
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
            GroupArsip::make(),
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
        return [
            AddKodeArsip::make($request->viaResourceId)
                ->confirmButtonText('Tambah')
                // ->size('7xl')
                ->standalone(),
        ];
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/resources/tata-naskahs/'.$request->viaResourceId.'#Detail%20Naskah=kode-arsip';
    }
}
