<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class TargetSerapanAnggaran extends Resource
{
    public static $with = ['jenisBelanja'];

    public static $globalSearchResults = 12;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\TargetSerapanAnggaran>
     */
    public static $model = \App\Models\TargetSerapanAnggaran::class;

    public static function label()
    {
        return 'Target Serapan Anggaran';
    }

    public function title()
    {
        return Helper::BULAN[$this->bulan];
    }

    public function subtitle()
    {
        return 'Target: '.Helper::formatUang($this->nilai);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'jenisBelanja.kode',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Bulan', 'bulan')
                ->readonly()
                ->searchable()
                ->filterable()
                ->options(Helper::BULAN)
                ->displayUsingLabels(),
            Numeric::make('Target', 'nilai')
                ->rules('gte:0', 'required'),

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

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId : '/'.'resources'.'/'.'dipas'.'/';
    }

    public static $indexDefaultOrder = [
        'bulan' => 'asc',
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
