<?php

namespace App\Nova;

use App\Helpers\Policy;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class ResponRate extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ResponRate>
     */
    public static $model = \App\Models\ResponRate::class;

    public static function label()
    {
        return 'Respon Rate';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'survei';

    public function subtitle()
    {
        return $this->jenis;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'survei', 'jenis',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Nama Survei', 'survei')
                ->rules('required')
                ->readonly(! Policy::make()->allowedFor('admin')->get()),
            Text::make('Jenis Sampel', 'jenis')
                ->rules('required')
                ->readonly(! Policy::make()->allowedFor('admin')->get()),
            Numeric::make('Target Sampel Setahun', 'target')
                ->rules('required', 'integer', 'gte:0'),
            Numeric::make('Realisasi Triwulan I (Kumulatif)', 'realisasi_tw1')
                ->rules('nullable', 'integer', 'gte:0', 'lte:target')
                ->help('Jumlah Kumulatif sampel yang berhasil dicacah sampai dengan Triwulan I'),
            Numeric::make('Realisasi Triwulan II (Kumulatif)', 'realisasi_tw2')
                ->rules('nullable', 'integer', 'gte:realisasi_tw1', 'lte:target')
                ->help('Jumlah Kumulatif sampel yang berhasil dicacah sampai dengan Triwulan II'),
            Numeric::make('Realisasi Triwulan III (Kumulatif)', 'realisasi_tw3')
                ->rules('nullable', 'integer', 'gte:realisasi_tw2', 'lte:target')
                ->help('Jumlah Kumulatif sampel yang berhasil dicacah sampai dengan Triwulan III'),
            Numeric::make('Realisasi Triwulan IV (Kumulatif)', 'realisasi_tw4')
                ->rules('nullable', 'integer', 'gte:realisasi_tw3', 'lte:target')
                ->help('Jumlah Kumulatif sampel yang berhasil dicacah sampai dengan Triwulan IV'),

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
        return [];
    }
}