<?php

namespace App\Nova;

use App\Nova\Actions\ImportRentangHarga;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class SusenasHarga extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\SusenasHarga>
     */
    public static $model = \App\Models\SusenasHarga::class;

    public static function label()
    {
        return 'Rentang Harga';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nama';

    public static $globallySearchable = false;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nama',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Number::make('No Urut', 'no_urut')
                ->rules('required', 'integer', 'min:1')
                ->step(1)
                ->min(1)
                ->hideFromIndex()
                ->creationRules('unique:rentang_harga,no_urut')
                ->updateRules('unique:rentang_harga,no_urut,{{resourceId}}')
                ->sortable(),
            Text::make('Nama', 'nama')
                ->rules('required', 'string', 'max:255')
                ->sortable(),
            Text::make('Satuan', 'satuan')
                ->rules('nullable', 'string', 'max:100')
                ->sortable(),
            Numeric::make('Harga Minimum', 'harga1')
                ->rules('required', 'numeric', 'min:0')
                ->sortable(),
            Numeric::make('Harga Maksimum', 'harga2')
                ->rules('required', 'numeric', 'min:0', 'gte:harga1')
                ->sortable(),
            Number::make('Fixed', 'fixed')
                ->rules('required', 'integer', 'min:0', 'max:2')
                ->step(1)
                ->min(0)
                ->max(2)
                ->hideFromIndex()
                ->sortable(),
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
        return [
            ImportRentangHarga::make()->standalone()
                ->confirmText('Mengimport rentang harga baru akan menghapus semua data rentang harga yang ada. Apakah Anda yakin ingin melanjutkan?'),
        ];
    }
}
