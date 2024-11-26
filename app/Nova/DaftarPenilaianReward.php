<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class DaftarPenilaianReward extends Resource
{
    public static $with = ['user'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarPenilaianReward>
     */
    public static $model = \App\Models\DaftarPenilaianReward::class;

    public static function label()
    {
        return 'Daftar Penilaian';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'user.nama';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'user.nama',
    ];

    public static $globallySearchable = false;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            BelongsTo::make('Pegawai', 'user', 'App\Nova\User')
                ->readOnly(),
            Number::make('Nilai SKP')
                ->step(1)
                ->rules('required', 'integer', 'gte:0', 'lte:120')
                ->hideFromIndex(),
            Number::make('Jumlah TK', 'tk')
                ->onlyOnDetail(),
            Number::make('Jumlah TL1', 'tl1')
                ->onlyOnDetail(),
            Number::make('Jumlah TL2', 'tl2')
                ->onlyOnDetail(),
            Number::make('Jumlah TL3', 'tl3')
                ->onlyOnDetail(),
            Number::make('Jumlah PSW1', 'psw1')
                ->onlyOnDetail(),
            Number::make('Jumlah PSW2', 'psw2')
                ->onlyOnDetail(),
            Number::make('Jumlah PSW3', 'psw3')
                ->onlyOnDetail(),
            Number::make('Jumlah PSW4', 'psw4')
                ->onlyOnDetail(),
            Number::make('Jumlah Butir Pekerjaan', 'jumlah_butir')
                ->step(1)
                ->rules('required', 'integer', 'gt:0')
                ->hideFromIndex(),
            Number::make('Kinerja', 'nilai_kinerja')
                ->exceptOnForms(),
            Number::make('Disiplin', 'nilai_disiplin')
                ->exceptOnForms(),
            Number::make('Beban Kerja', 'nilai_beban')
                ->exceptOnForms(),
            Number::make('Total Nilai', 'nilai_total')
                ->exceptOnForms(),

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

    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId.'#Detail=arsip-dokumen'  : '/'.'resources'.'/'.'reward-pegawais'.'/';

    }

    public static $indexDefaultOrder = [
        'nilai_total' => 'desc',
        'nilai_kinerja' => 'desc',
        'nilai_disiplin' => 'desc',
        'nilai_beban' => 'desc',
        'jumlah_butir' => 'desc',
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];

            return $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        }

        return $query;
    }
}
