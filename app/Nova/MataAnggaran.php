<?php

namespace App\Nova;

use App\Nova\Actions\ImportMataAnggaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MataAnggaran extends Resource
{
    public static function label()
    {
        return 'Mata Anggaran Kegiatan';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\MataAnggaran>
     */
    public static $model = \App\Models\MataAnggaran::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'mak';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'mak',
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
            Text::make('MAK', 'mak')
                ->updateRules('required', 'min:35', 'max:35', Rule::unique('mata_anggarans', 'mak')->where('tahun', session('year'))->ignore($this->id))
                ->sortable()
                ->creationRules('required', 'min:35', 'max:35', Rule::unique('mata_anggarans', 'mak')->where('tahun', session('year')))
                ->placeholder('XXX.XX.XX.XXXX.XXX.XXX.XXX.X.XXXXXX'),

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
        if (session('role') === 'admin') {
            return [
                ImportMataAnggaran::make()->standalone(),
            ];
        } else {
            return [];
        }
    }
}
