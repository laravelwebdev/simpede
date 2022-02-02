<?php

namespace App\Nova;

use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Kendaraan extends Resource
{
    use Breadcrumbs;
    public static $group = 'Referensi';

    public static function label()
    {
        return 'Kendaraan';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Kendaraan::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nopol';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nopol', 'nama',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            // ID::make(__('ID'), 'id')
            //     ->sortable(),
            Text::make('Nomor Polisi', 'nopol')
                ->rules('required')
                ->creationRules('unique:kendaraans,nopol')
                ->updateRules('unique:kendaraans,nopol,{{resourceId}}')
                ->placeholder('DA xxxx XX')->sortable(),
            Select::make('Pemegang Kendaraan', 'nama')
                ->options(
                    DB::table('pegawais')->select(['nama'])
                    ->pluck('nama', 'nama')
                )
                ->rules('required')->sortable(),
            Select::make('Jenis Kendaraan', 'jenis')
                ->options([
                    'Roda Dua' => 'Roda Dua',
                    'Roda Empat' => 'Roda Empat',
                ])
                ->rules('required'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
