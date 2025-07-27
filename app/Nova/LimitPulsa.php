<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class LimitPulsa extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\LimitPulsa>
     */
    public static $model = \App\Models\LimitPulsa::class;

    public static function label()
    {
        return 'Limit Pulsa';
    }

    public static $with = ['jenisPulsa'];

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nomor';

    public function subtitle()
    {
        return 'Tanggal: '.Helper::terbilangTanggal($this->tanggal);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nomor',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Nomor', 'nomor')
                ->sortable()
                ->rules('required', 'max:40'),
            Date::make('Tanggal', 'tanggal')
                ->sortable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('required'),
            Numeric::make('Limit per bulan', 'limit')
                ->sortable()
                ->rules('required', 'integer', 'gte:1'),
            HasMany::make('Jenis Pulsa'),
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
