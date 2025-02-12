<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class JenisBelanja extends Resource
{
    public static $displayInNavigation = false;

    public static $with = ['dipa', 'targetSerapanAnggaran'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\JenisBelanja>
     */
    public static $model = \App\Models\JenisBelanja::class;

    public static function label()
    {
        return 'Jenis Belanja';
    }

    public function title()
    {
        return Helper::$jenis_belanja[$this->kode];
    }

    public function subtitle()
    {
        return 'Kode Belanja: '.$this->kode;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kode',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Kode Jenis Belanja', 'kode')
                ->readonly(),
            Text::make('Jenis Belanja', fn ($value) => Helper::$jenis_belanja[$value->kode]),
            HasMany::make('Target Serapan Anggaran'),
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

    public static $indexDefaultOrder = [
        'kode' => 'asc',
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];

            return $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        }

        return $query;
    }
}
