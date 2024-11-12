<?php

namespace App\Nova;

use App\Helpers\Policy;
use App\Nova\Actions\ImportMasterPersediaan;
use App\Nova\Lenses\RekapBarangPersediaan;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MasterPersediaan extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\MasterPersediaan>
     */
    public static $model = \App\Models\MasterPersediaan::class;

    public static function label()
    {
        return 'Master Persediaan';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return $this->barang;
    }

    public function subtitle()
    {
        return $this->kode.' ('.$this->satuan.')';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kode', 'barang', 'satuan',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Kode')
                ->sortable()
                ->rules('required', 'size:16')
                ->creationRules('unique:master_persediaans,kode')
                ->updateRules('unique:master_persediaans,kode,{{resourceId}}'),
            Text::make('Nama Barang', 'barang')
                ->sortable()
                ->rules('required', 'max:255'),
            Text::make('Satuan')
                ->rules('required', 'max:20'),
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
        return [
            RekapBarangPersediaan::make(),
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        $actions = [];
        if (Policy::make()->allowedFor('bmn')->get()) {
            $actions[] =
            ImportMasterPersediaan::make()
                ->standalone()
                ->confirmButtonText('Import');
        }

        return $actions;
    }
}
