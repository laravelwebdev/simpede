<?php

namespace App\Nova\Lenses;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;

class PemeliharaanBarang extends Lens
{
    public function name()
    {
        return 'Pemeliharaan BMN';
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
     * Get the query builder / paginator for the lens.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->orderBy('kode_barang', 'asc')
                ->orderBy('nup', 'asc')

        ));
    }

    /**
     * Get the fields available to the lens.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Kode Barang')

                ->readonly(),
            Number::make('NUP')

                ->step(1)
                ->readonly(),
            Text::make('Nama Barang')

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

                ->filterable()
                ->readonly(),
            Text::make('Lokasi')

                ->readonly(),
            BelongsTo::make('Pemegang', 'user', 'App\Nova\User')

                ->searchable()
                ->withSubtitles(),
        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the lens.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available on the lens.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'pemeliharaan-barang';
    }
}
