<?php

namespace App\Nova;

use App\Helpers\Policy;
use App\Nova\Actions\EditRekening;
use App\Nova\Actions\ImportDaftarHonorMitra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;

class DaftarHonorMitra extends Resource
{
    public static $perPageViaRelationship = 10;
    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarHonorMitra>
     */
    public static $model = \App\Models\DaftarHonorMitra::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nik', 'nama',
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
            Text::make('NIK')
                ->readOnly(),
            Text::make('Nama')
                ->readOnly(),
            Text::make('Golongan')
                ->readOnly(),
            Number::make('Jumlah', 'volume')->readOnly(),
            Currency::make('Harga Satuan', 'harga_satuan')
                ->currency('IDR')
                ->locale('id')
                ->readOnly(),
            Currency::make('Bruto', 'bruto')
                ->currency('IDR')
                ->locale('id')
                ->readOnly(),
            Currency::make('Pajak', 'pajak')
                ->currency('IDR')
                ->locale('id')
                ->readOnly(),
            Currency::make('Netto', 'netto')
                ->currency('IDR')
                ->locale('id')
                ->readOnly(),
            Text::make('Rekening', 'rekening')
                ->rules('required')->readOnly(),
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
        if (Policy::make()->allowedFor('koordinator,anggota')->get()) {
            $actions [] =
                EditRekening::make('mitra')->onlyInline();
        }
        if (Policy::make()->allowedFor('koordinator,anggota')->get()) {
            $actions[] =
                ImportDaftarHonorMitra::make($request->viaResourceId)
                ->standalone()
                ->confirmButtonText('Unduh');
        }

        return $actions;
    }

}
