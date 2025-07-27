<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\AddHasManyModel;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class JenisPulsa extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\JenisPulsa>
     */
    public static $model = \App\Models\JenisPulsa::class;

    public static function label()
    {
        return 'Jenis Pulsa';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'jenis';

    public function subtitle()
    {
        return 'Batas maksimal: '.Helper::formatRupiah($this->sbml);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'jenis', 'sbml',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Jenis Kegiatan', 'jenis')
                ->rules('required', 'max:80'),
            Text::make('Satuan')
                ->rules('required'),
            Numeric::make('Batas maksimal per Satuan', 'sbml')
                ->rules('required', 'gte:1'),
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
        $actions = [];
        if (Policy::make()->allowedFor('admin,ppk')->get() && $request->viaResource === 'limit-pulsas') {
            $actions[] =
            AddHasManyModel::make('JenisPulsa', 'LimitPulsa', $request->viaResourceId)
                ->confirmButtonText('Tambah')
                // ->size('7xl')
                ->standalone()
                ->onlyOnIndex()
                ->addFields($this->fields($request));
        }

        return $actions;
    }
}
