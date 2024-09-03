<?php

namespace App\Nova;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\NovaSimpleRepeatable\SimpleRepeatable;

class JenisKontrak extends Resource
{
    public static function label()
    {
        return 'Jenis Kontrak';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\JenisKontrak>
     */
    public static $model = \App\Models\JenisKontrak::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'tanggal',
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
            Text::make('Nomor Perka SHKS', 'nomor')
                ->rules('required'),
            Date::make('Tanggal Berlaku SHKS', 'tanggal')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('required'),
            SimpleRepeatable::make('Jenis Kontrak dan SBML', 'jenis', [
                Text::make('Jenis Kontrak', 'jenis')
                        ->rules('required'),
                Currency::make('Batas maksimal (SBML)', 'sbml')
                        ->rules('required')
                        ->step(1)
                        ->default(0),
                ])->rules('required',
                    function ($attribute, $value, $fail) {
                        if (Helper::cekGanda(json_decode($value), 'jenis')) {
                            return $fail('validation.unique')->translate();
                        }
                    }, function ($attribute, $value, $fail) {
                        if ($value == '[]') {
                            return $fail('validation.required')->translate();
                        }
                    }),

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
        return [];
    }
}
