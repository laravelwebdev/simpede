<?php

namespace App\Nova;

use App\Nova\Lenses\FormRencanaAksi;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Tabs\Tab;

class PerjanjianKinerja extends Resource
{
    public static $with = ['realisasiKinerja', 'analisisSakip', 'tindakLanjut'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PerjanjianKinerja>
     */
    public static $model = \App\Models\PerjanjianKinerja::class;

    public static function label()
    {
        return 'Perjanjian Kinerja';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'indikator';

    public function subtitle()
    {
        return $this->tahun;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'tujuan', 'indikator', 'sasaran',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Tujuan')
                ->rules('required')
                ->hideFromIndex(),
            Text::make('Sasaran')
                ->rules('required')
                ->hideFromIndex(),
            Text::make('Indikator')
                ->rules('required'),
            Number::make('Target Triwulan I', 'target_tw1')
                ->step(0.01)
                ->help('Target total selama triwulan I')
                ->rules('required', 'integer', 'gte:0'),
            Number::make('Target Triwulan II', 'target_tw2')
                ->step(0.01)
                ->help('Target kumulatif sampai dengan triwulan II')
                ->rules('required', 'integer', 'gte:target_tw1'),
            Number::make('Target Triwulan III', 'target_tw3')
                ->step(0.01)
                ->help('Target kumulatif sampai dengan triwulan III')
                ->rules('required', 'integer', 'gte:target_tw2'),
            Number::make('Target Triwulan IV', 'target_tw4')
                ->step(0.01)
                ->help('Target kumulatif sampai dengan triwulan IV')
                ->rules('required', 'integer', 'gte:target_tw3'),
            Tab::group(fields: [
                HasMany::make('Realisasi Kinerja', 'realisasiKinerja', RealisasiKinerja::class),
                BelongsToMany::make('Analisis Sakip', 'analisisSakip', AnalisisSakip::class),
                BelongsToMany::make('Tindak Lanjut', 'tindakLanjut', TindakLanjut::class),
            ]),

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
            FormRencanaAksi::make('Form Rencana Aksi'),
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('tahun', session('year'));
    }
}
