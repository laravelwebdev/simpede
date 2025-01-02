<?php

namespace App\Nova;

use App\Helpers\Policy;
use App\Nova\Actions\AddHasManyModel;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DerajatNaskah extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DerajatNaskah>
     */
    public static $model = \App\Models\DerajatNaskah::class;

    public static function label()
    {
        return 'Derajat Naskah';
    }

    public static $displayInNavigation = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'derajat';

    public function subtitle()
    {
        return 'Kode: '.$this->kode;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'derajat',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Kode')
                ->rules('required'),
            Text::make('Derajat Naskah', 'derajat')
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
        $actions = [];
        if (Policy::make()->allowedFor('admin')->get() && $request->viaResource === 'tata-naskahs') {
            $actions[] =
            AddHasManyModel::make('DerajatNaskah', 'TataNaskah', $request->viaResourceId)
                ->confirmButtonText('Tambah')
            // ->size('7xl')
                ->standalone()
                ->onlyOnIndex()
                ->addFields($this->fields($request));
        }

        return $actions;
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId.'#Detail%20Naskah=derajat-naskah' : '/'.'resources'.'/'.'tata-naskahs'.'/';
    }
}
