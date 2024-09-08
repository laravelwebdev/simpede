<?php

namespace App\Nova;

use App\Helpers\Policy;
use App\Nova\Actions\ImportMitra;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Mitra extends Resource
{
    public static function label()
    {
        return 'Mitra';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Mitra>
     */
    public static $model = \App\Models\Mitra::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nik';

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
            Text::make('NIK', 'nik')
                ->updateRules('required', 'min:16', 'max:16', Rule::unique('mitras', 'nik')->where('tahun', session('year'))->ignore($this->id))
                ->sortable()
                ->creationRules('required', 'min:16', 'max:16', Rule::unique('mitras', 'nik')->where('tahun', session('year'))),
            Text::make('Nama', 'nama')
                ->sortable()
                ->rules('required'),
            Text::make('Alamat', 'alamat')
                ->sortable()
                ->rules('required'),
            Text::make('Rekening', 'rekening')
                ->sortable()
                ->rules('required')->help('Contoh Penulisan Rekening: BRI 123456788089'),
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
        if (Policy::make()->allowedFor('admin')->get()) {
            $actions []=
                ImportMitra::make()->standalone();
        }
        return $actions;
    }
}
