<?php

namespace App\Nova;

use App\Nova\Actions\ImportAlokasi;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SusenasAlokasi extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\SusenasAlokasi>
     */
    public static $model = \App\Models\SusenasAlokasi::class;

    public static $globallySearchable = false;

    public static function singularLabel()
    {
        return 'Alokasi Petugas';
    }

    public static function label()
    {
        return 'Alokasi Petugas';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nks';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nks', 'kode_pcl', 'pcl, kode_pml', 'pml',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Prov', 'prov')
                ->rules('required', 'max:2', 'min:2')
                ->sortable(),
            Text::make('Kab', 'kab')
                ->rules('required', 'max:2', 'min:2')
                ->sortable(),
            Text::make('NKS', 'nks')
                ->rules('required')
                ->sortable(),
            Text::make('Kode PCL', 'kode_pcl')
                ->rules('required', 'max:40')
                ->sortable(),
            Text::make('PCL', 'pcl')
                ->rules('required', 'max:40')
                ->sortable(),
            Text::make('Kode PML', 'kode_pml')
                ->rules('required', 'max:40')
                ->sortable(),
            Text::make('PML', 'pml')
                ->rules('required', 'max:40')
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
            ImportAlokasi::make()
            ->confirmText('Yakin untuk mengimpor Alokasi Petugas? Semua data Progress Pencacahan dan Rekap yang tersimpan akan DIHAPUS')
            ->standalone(),
        ];
    }
}
