<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class TargetKkp extends Resource
{
    public static $with = ['dipa'];

    public static $globalSearchResults = 12;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\TargetKkp>
     */
    public static $model = \App\Models\TargetKkp::class;

    public static function label()
    {
        return 'Target Penggunaan KKP';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
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
        'bulan',
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

    public static $indexDefaultOrder = [
        'bulan' => 'asc',
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (empty($request->query('orderBy'))) {
            $query->getQuery()->orders = [];

            return $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        }

        return $query;
    }
}
