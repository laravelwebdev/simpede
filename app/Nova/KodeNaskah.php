<?php

namespace App\Nova;

use App\Nova\Actions\AddHasManyModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class KodeNaskah extends Resource
{
    public static $with = ['jenisNaskah'];

    /**
     * Get the label for the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Format Penomoran Naskah';
    }

    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\KodeNaskah>
     */
    public static $model = \App\Models\KodeNaskah::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'kategori';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kategori',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Kategori')
                ->creationRules('unique:kode_naskahs,kategori')
                ->updateRules('unique:kode_naskahs,kategori,{{resourceId}}')
                ->rules('required'),
            Text::make('Format Penomoran', 'format')
                ->rules('required'),
            HasMany::make('Jenis Naskah'),
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
            AddHasManyModel::make('KodeNaskah','TataNaskah', $request->viaResourceId)
                ->confirmButtonText('Tambah')
                // ->size('7xl')
                ->standalone()
                ->addFields($this->fields($request)),
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
        return '/resources/tata-naskahs/'.$request->viaResourceId.'#Detail%20Naskah=kode-naskah';
    }
}
