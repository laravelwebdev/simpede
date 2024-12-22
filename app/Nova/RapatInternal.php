<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Query\Search\SearchableText;

class RapatInternal extends Resource
{
    public static $with = ['kasubbag', 'pimpinan', 'kepala', 'notulis', 'naskahKeluar'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\RapatInternal>
     */
    public static $model = \App\Models\RapatInternal::class;

    public static function label()
    {
        return 'Rapat Internal';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return Helper::terbilangTanggal($this->tanggal_rapat);
    }

    public function subtitle()
    {
        return $this->tema;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static function searchableColumns()
    {
        return ['naskahKeluar.nomor', 'tanggal', 'tema',  new SearchableText('agenda')];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [

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
        return [];
    }
}
