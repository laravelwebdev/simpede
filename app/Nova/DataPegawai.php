<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\UnitKerja;
use App\Nova\Actions\AddHasManyModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DataPegawai extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DataPegawai>
     */
    public static $model = \App\Models\DataPegawai::class;

    public static function label()
    {
        return 'Data Pegawai';
    }

    public static $with = ['unitKerja'];
    public static $displayInNavigation = false;
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'user_id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'user_id',
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
            Date::make('Tanggal Perubahan', 'tanggal')
                ->rules('required')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            Select::make('Golongan')
                ->options(Helper::$golongan)
                ->rules('required')
                ->searchable(),
            Text::make('Jabatan')
                ->rules('required'),
            Select::make('Unit Kerja', 'unit_kerja_id')
                ->options(Helper::setOptions(UnitKerja::cache()->get('all'), 'id', 'unit'))
                ->rules('required'),
        ];
    }

    public function fieldsForIndex(NovaRequest $request)
    {
        return [
            Date::make('Tanggal Perubahan', 'tanggal')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            Select::make('Golongan')
                ->options(Helper::$golongan),
            Text::make('Pangkat'),
            Text::make('Jabatan'),
            BelongsTo::make('Unit Kerja')
                ->filterable(),
        ];
    }

    public function fieldsForDetail(NovaRequest $request)
    {
        return [
            Date::make('Tanggal Perubahan', 'tanggal')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            Select::make('Golongan')
                ->options(Helper::$golongan),
            Text::make('Pangkat'),
            Text::make('Jabatan'),
            BelongsTo::make('Unit Kerja'),
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
        return [
            AddHasManyModel::make('DataPegawai','User', $request->viaResourceId)
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
        return '/resources/users/'.$request->viaResourceId.'#Detail=data-pegawai';
    }
}
