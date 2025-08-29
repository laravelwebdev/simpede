<?php

namespace App\Nova;

use Laravel\Nova\Http\Requests\NovaRequest;

class UangPersediaan extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\UangPersediaan>
     */
    public static $model = \App\Models\UangPersediaan::class;

    public static function label()
    {
        return 'Uang Persediaan';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return Helper::JENIS_UANG_PERSEDIAAN[$this->jenis] ?? '';
    }

    public function subtitle(){
        return $this->limit ? 'Nilai GUP: '.Helper::formatUang($this->limit) : null;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'jenis',
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
            Date::make('Tanggal', 'tanggal')
                ->sortable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('required'),
            Select::make('Jenis', 'jenis')
                ->options(Helper::JENIS_UANG_PERSEDIAAN)
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),
            Numeric::make('Nilai GUP', 'limit')
                ->sortable()
                ->rules('required', 'integer', 'gte:1'),

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
        return [];
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
        return [];
    }
}
