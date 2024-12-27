<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Wdelfuego\Nova\DateTime\Fields\DateTime;

class DaftarKegiatan extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarKegiatan>
     */
    public static $model = \App\Models\DaftarKegiatan::class;

    public static function label()
    {
        return 'Daftar Kegiatan';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'kegiatan';

    public function subtitle(){
        return Helper::terbilangTanggal($this->awal) . ' - ' . Helper::terbilangTanggal($this->akhir);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'jenis', 'kegiatan', 'awal', 'akhir',
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
            Select::make('Jenis')
                ->options(Helper::$jenis_kegiatan)
                ->sortable()
                ->filterable()
                ->rules('required'),
            Text::make('Kegiatan')
                ->sortable()
                ->rules('required'),
            DateTime::make('Awal')
                ->sortable()
                ->rules('required'),
            DateTime::make('Akhir')
                ->sortable()
                ->rules('nullable', 'bail', 'after_or_equal:awal'),
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
