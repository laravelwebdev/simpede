<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class TargetSerapanAnggaran extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\TargetSerapanAnggaran>
     */
    public static $model = \App\Models\TargetSerapanAnggaran::class;

    public static function label()
    {
        return 'Target Serapan Anggaran';
    }

    public function title()
    {
        return Helper::$bulan[$this->bulan];
    }

    public function subtitle()
    {
        return '51 :'.Helper::formatUang($this->belanja51).' | 52 :'.Helper::formatUang($this->belanja52).' | 53 :'.Helper::formatUang($this->belanja53).' | 57 :'.Helper::formatUang($this->belanja57);
    }

    public static $displayInNavigation = false;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'bulan',
    ];

    //TODO: 1. auto buat saat dipa created, auto delete saat dipa didelete, hanya bisa diedit admin
    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Bulan', 'bulan')
                ->sortable()
                ->readonly()
                ->options(Helper::$bulan)
                ->displayUsingLabels(),
            Number::make('Belanja Pegawai (51)', 'belanja51')
                ->rules('gte:0', 'lte:100')
                ->step(0.01)
                ->min(0)
                ->max(100)
                ->displayUsing(fn ($value) => $value.'%')
                ->help('Persentase (%) dari total belanja pegawai'),
            Number::make('Belanja Barang dan Jasa (52)', 'belanja52')
                ->rules('gte:0', 'lte:100')
                ->step(0.01)
                ->min(0)
                ->max(100)
                ->displayUsing(fn ($value) => $value.'%')
                ->help('Persentase (%) dari total belanja barang dan jasa'),
            Number::make('Belanja Modal (53)', 'belanja53')
                ->rules('gte:0', 'lte:100')
                ->step(0.01)
                ->min(0)
                ->max(100)
                ->displayUsing(fn ($value) => $value.'%')
                ->help('Persentase (%) dari total belanja modal'),
            Number::make('Belanja Bunga Utang (54)', 'belanja54')
                ->rules('gte:0', 'lte:100')
                ->step(0.01)
                ->min(0)
                ->max(100)
                ->displayUsing(fn ($value) => $value.'%')
                ->help('Persentase (%) dari total belanja bunga utang'),
            Number::make('Belanja Subsidi (55)', 'belanja55')
                ->rules('gte:0', 'lte:100')
                ->step(0.01)
                ->min(0)
                ->max(100)
                ->displayUsing(fn ($value) => $value.'%')
                ->help('Persentase (%) dari total belanja subsidi'),
            Number::make('Belanja Hibah (56)', 'belanja56')
                ->rules('gte:0', 'lte:100')
                ->step(0.01)
                ->min(0)
                ->max(100)
                ->displayUsing(fn ($value) => $value.'%')
                ->help('Persentase (%) dari total belanja hibah'),
            Number::make('Belanja Bantuan Sosial (57)', 'belanja57')
                ->rules('gte:0', 'lte:100')
                ->step(0.01)
                ->min(0)
                ->max(100)
                ->displayUsing(fn ($value) => $value.'%')
                ->help('Persentase (%) dari total belanja bantuan sosial'),
            Number::make('Belanja Lainnya (58)', 'belanja58')
                ->rules('gte:0', 'lte:100')
                ->step(0.01)
                ->min(0)
                ->max(100)
                ->displayUsing(fn ($value) => $value.'%')
                ->help('Persentase (%) dari total belanja lainnya'),
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

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId.'#Anggaran%20dan%20Target%20Serapan=target-serapan-anggaran';
    }
}
