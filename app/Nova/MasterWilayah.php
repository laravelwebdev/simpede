<?php

namespace App\Nova;

use App\Helpers\Policy;
use App\Nova\Actions\ImportMasterwilayah;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MasterWilayah extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\MasterWilayah>
     */
    public static $model = \App\Models\MasterWilayah::class;

    public static function label()
    {
        return 'Master Wilayah';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'wilayah';

    public function subtitle()
    {
        return $this->kode;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kode', 'wilayah',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            Text::make('Kode', 'kode')
                ->sortable()
                ->updateRules('required', 'min:7', 'max:11', 'unique:master_wilayahs:kode')
                ->creationRules('required', 'min:7', 'max:11', 'unique:master_wilayahs:kode,{{resourceId}}'),
            Text::make('Nama Wilayah', 'wilayah')
                ->sortable()
                ->rules('required'),
        ];
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
        if (Policy::make()->allowedFor('admin')->get()) {
            $actions[] =
                ImportMasterwilayah::make()
                    ->showInline()
                    ->showOnDetail()
                    ->exceptOnIndex();
        }

        return $actions;
    }
}
