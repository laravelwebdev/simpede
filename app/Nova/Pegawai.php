<?php

namespace App\Nova;

use App\Helpers\Helper;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Pegawai extends Resource
{
    use Breadcrumbs;
    public static $group = 'Referensi';

    public static function label()
    {
        return 'Pegawai';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Pegawai::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nama';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nip', 'nama', 'jabatan',
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
            Text::make('NIP', 'nip')
                ->rules('required')->sortable()
                ->placeholder('xxxxxxxx xxxxxx x xxxx')
                ->creationRules('unique:pegawais,nip')
                ->updateRules('unique:pegawais,nip,{{resourceId}}'),
            Text::make('Nama', 'nama')
                ->rules('required')->sortable(),
            Select::make('Golongan', 'golongan')
                ->options(Helper::$golongan)
                ->rules('required'),
            Text::make('Pangkat', 'pangkat')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            Text::make('Jabatan', 'jabatan')
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
