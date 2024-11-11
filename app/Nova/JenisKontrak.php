<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Nova\Actions\AddHasManyModel;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class JenisKontrak extends Resource
{
    public static function label()
    {
        return 'Jenis Kontrak';
    }

    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\JenisKontrak>
     */
    public static $model = \App\Models\JenisKontrak::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'jenis';

    public function subtitle()
    {
        return 'Batas maksimal: ' . Helper::formatRupiah($this->sbml);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'jenis', 'sbml',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Jenis Kontrak', 'jenis')
                ->rules('required'),
            Currency::make('Batas maksimal (SBML)', 'sbml')
                ->rules('required', 'gt:1')
                ->step(1)
                ->min(1),
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
        return [
            AddHasManyModel::make('JenisKontrak', 'HargaSatuan', $request->viaResourceId)
                ->confirmButtonText('Tambah')
                // ->size('7xl')
                ->standalone()
                ->onlyOnIndex()
                ->addFields($this->fields($request)),
        ];
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId;
    }
}
