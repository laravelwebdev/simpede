<?php

namespace App\Nova;

use App\Helpers\Policy;
use App\Nova\Actions\ImportMasterBarangPemeliharaan;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MasterBarangPemeliharaan extends Resource
{
    public static $with = ['user'];
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\MasterBarangPemeliharaan>
     */
    public static $model = \App\Models\MasterBarangPemeliharaan::class;

    public static function label()
    {
        return 'Master Barang';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return $this->nama_barang. ' Pemegang: '.$this->user->name;
    }

    public function subtitle()
    {
        return 'Kode: '.$this->kode_barang. ' NUP: '.$this->nup.' Merk:'.$this->merk.' Nopol:'.$this->nopol.' Kondisi:'.$this->kondisi.' Lokasi:'.$this->lokasi;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kode_barang', 'nup', 'nama_barang', 'merk', 'nopol', 'kondisi', 'lokasi'
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
            Text::make('Kode Barang')
                ->sortable()
                ->readonly(),
            Number::make('NUP')
                ->sortable()
                ->step(1)
                ->readonly(),
            Text::make('Nama Barang')
                ->sortable()
                ->readonly(),
            Text::make('Merk')
                ->readonly(),
            Text::make('Nopol')
                ->readonly(),
            Select::make('Kondisi')
                ->options([
                    'Baik' => 'Baik',
                    'Rusak Ringan' => 'Rusak Ringan',
                ])
                ->displayUsingLabels()
                ->sortable()
                ->filterable()
                ->readonly(),
            Text::make('Lokasi')
                ->sortable()
                ->readonly(),
            BelongsTo::make('Pemegang', 'user', 'App\Nova\User')
                ->sortable()
                ->searchable()
                ->withSubtitles(),
            
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
        $actions = [];
        if (Policy::make()->allowedFor('admin,kasubbag,bmn')){
            $actions [] = ImportMasterBarangPemeliharaan::make()->standalone();
        }

        return $actions;
    }
}
