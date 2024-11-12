<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\AddHasManyModel;
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
    public static $title = 'user.name';

    public function subtitle()
    {
        return 'Golongan: '.$this->golongan.', Jabatan: '.$this->jabatan.', Unit Kerja: '.$this->unitKerja->unit.'(Sejak: '.Helper::terbilangTanggal($this->tanggal).')';
    }

    public static $search = [
        'golongan',
        'jabatan',
        'unitKerja.unit',
        'user.name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
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
            BelongsTo::make('Unit Kerja')
                ->rules('required')
                ->filterable(),
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
        $actions = [];
        if (Policy::make()->allowedFor('admin')->get() && $request->viaResource === 'users') {
            $actions[] =
            AddHasManyModel::make('DataPegawai', 'User', $request->viaResourceId)
                ->confirmButtonText('Tambah')
                // ->size('7xl')
                ->standalone()
                ->onlyOnIndex()
                ->addFields($this->fields($request));
        }

        return $actions;
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId.'#Detail=data-pegawai';
    }
}
