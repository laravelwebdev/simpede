<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Nova\Lenses\RealisasiAnggaran as LensesRealisasiAnggaran;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Query\Search\SearchableText;

class RealisasiAnggaran extends Resource
{
    public static $displayInNavigation = false;

    public static function label()
    {
        return 'Realisasi Anggaran';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\RealisasiAnggaran::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return 'SPM Nomor: '.$this->nomor_spp;
    }

    public function subtitle()
    {
        return $this->uraian;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static function searchableColumns()
    {
        return ['tanggal_sp2d', 'nomor_sp2d', 'nomor_spp', new SearchableText('uraian')];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Hidden::make('Mata Anggaran', 'mata_anggaran_id')->filterable(),
            Date::make('Tanggal SP2D', 'tanggal_sp2d')
                ->sortable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),

            Text::make('Nomor SPM', 'nomor_spp')
                ->sortable()
                ->rules('required', 'max:10'),

            Text::make('Nomor SP2D', 'nomor_sp2d')
                ->sortable()
                ->rules('required', 'max:20'),

            Text::make('Uraian', 'uraian')
                ->sortable()
                ->rules('required', 'max:255'),

            Currency::make('Nilai', 'nilai')
                ->sortable()
                ->rules('required', 'integer'),

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
            new LensesRealisasiAnggaran,
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
