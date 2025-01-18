<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Nova\Actions\AddHasManyModel;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class SpesifikasiKerangkaAcuan extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\SpesifikasiKerangkaAcuan>
     */
    public static $model = \App\Models\SpesifikasiKerangkaAcuan::class;

    public static $displayInNavigation = false;

    public static function label()
    {
        return 'Spesifikasi KAK';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'rincian';

    public function subtitle()
    {
        return 'Volume: '.$this->volume.' '.$this->satuan.' | Harga Satuan: '.Helper::formatRupiah($this->harga_satuan);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'rincian',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Hidden::make('ID KAK', 'kerangka_acuan_id')->default($request->viaResourceId),
            Text::make('Rincian')
                ->rules('required'),
            Number::make('Volume')
                ->step(0.01)
                ->rules('required', 'gt:0')->min(0),
            Text::make('Satuan')
                ->rules('required'),
            Numeric::make('Harga Satuan')
                ->rules('required', 'gt:0'),
            Textarea::make('Spesifikasi')
                ->rules('required')
                ->alwaysShow()
                ->placeholder('Mohon diisi secara detail dan spesifik'),
        ];
    }

    public function fieldsforIndex(NovaRequest $request)
    {
        return [
            Text::make('Rincian'),
            Number::make('Volume'),
            Text::make('Satuan'),
            Numeric::make('Harga Satuan'),
            Numeric::make('Total', 'total_harga'),
            Textarea::make('Spesifikasi'),
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
            AddHasManyModel::make('SpesifikasiKerangkaAcuan', 'KerangkaAcuan', $request->viaResourceId)
                ->confirmButtonText('Tambah')
                // ->size('7xl')
                ->standalone()
                ->onlyOnIndex()
                ->addFields($this->fields($request)),
        ];
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId : '/'.'resources'.'/'.'kerangka-acuans'.'/';
    }
}
