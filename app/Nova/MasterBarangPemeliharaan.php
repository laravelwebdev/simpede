<?php

namespace App\Nova;

use App\Helpers\Policy;
use App\Nova\Actions\ImportMasterBarangPemeliharaan;
use App\Nova\Lenses\PemeliharaanBarang;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MasterBarangPemeliharaan extends Resource
{
    public static $with = ['user', 'daftarPemeliharaan'];
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
        return $this->nama_barang;
    }

    public function subtitle()
    {
        return 'Kode: '.$this->kode_barang.' NUP: '.$this->nup.' Merk:'.$this->merk.' Nopol:'.$this->nopol.' Kondisi:'.$this->kondisi.' Lokasi:'.$this->lokasi;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kode_barang', 'nup', 'nama_barang', 'merk', 'nopol', 'kondisi', 'lokasi', 'user.name',
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
                ->showWhenPeeking()
                ->readonly(),
            Number::make('NUP')
                ->sortable()
                ->showWhenPeeking()
                ->step(1)
                ->readonly(),
            Text::make('Nama Barang')
                ->sortable()
                ->showWhenPeeking()
                ->readonly(),
            Text::make('Merk')
                ->showWhenPeeking()
                ->readonly(),
            Text::make('Nopol')
                ->showWhenPeeking()
                ->readonly(),
            Select::make('Kondisi')
                ->options([
                    'Baik' => 'Baik',
                    'Rusak Ringan' => 'Rusak Ringan',
                ])
                ->displayUsingLabels()
                ->sortable()
                ->showWhenPeeking()
                ->searchable()
                ->filterable()
                ->readonly(),
            Text::make('Lokasi')
                ->sortable()
                ->showWhenPeeking()
                ->readonly(),
            BelongsTo::make('Pemegang', 'user', 'App\Nova\User')
                ->sortable()
                ->showWhenPeeking()
                ->searchable()
                ->withSubtitles(),
            HasMany::make('Daftar Pemeliharaan', 'daftarPemeliharaan', 'App\Nova\DaftarPemeliharaan'),

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
        return [
            PemeliharaanBarang::make(),
        ];
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
        if (Policy::make()->allowedFor('admin,kasubbag,bmn')->get()) {
            $actions [] = ImportMasterBarangPemeliharaan::make()
                ->standalone()
                ->onlyOnIndex();
        }

        return $actions;
    }
}
