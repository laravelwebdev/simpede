<?php

namespace App\Nova;

use App\Nova\Actions\ImportKodeArsip;
use App\Nova\Filters\Kode1Arsip;
use Illuminate\Support\Facades\Auth;
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
    public static $title = 'kode';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kode','k1','k2', 'k3','k4',
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
            Text::make('Kode Surat', 'kode')->sortable()->rules('required'),
            Text::make('Klasifikasi 1', 'k1')->sortable()->rules('required'),
            Text::make('Klasifikasi 2', 'k2')->sortable()->rules('required'),
            Text::make('Klasifikasi 3', 'k3')->sortable()->rules('required'),
            Text::make('Klasifikasi 4', 'k4')->sortable()->rules('required'),
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
        return [
            Kode1Arsip::make(),            
        ];
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
        if (Auth::user()->role == 'admin') {
            return [
                ImportKodeArsip::make()->standalone(),
            ];
        } else {
            return [];
        }
    }
}
