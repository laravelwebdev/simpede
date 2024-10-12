<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DaftarKontrakMitra extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarKontrakMitra>
     */
    public static $model = \App\Models\DaftarKontrakMitra::class;

    public static function label()
    {
        return 'Daftar Kontrak Mitra';
    }

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
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $mitra = Helper::getMitraById($this->mitra_id);
        return [
            Text::make('NIK', fn () => Helper::getPropertyFromCollection($mitra, 'nik'))
                ->readOnly(),
            Text::make('Nama', fn () => Helper::getPropertyFromCollection($mitra, 'nama'))
                ->readOnly(),
            Text::make('Nomor Kontrak', 'nomor_kontrak')
                ->readOnly(),
            Text::make('Nomor BAST', 'nomor_bast')
                ->readOnly(),
            Number::make('Jumlah Kegiatan','jumlah_kegiatan')
                ->readOnly(),
            Currency::make('Honor', 'honor')
                ->currency('IDR')
                ->locale('id')
                ->readOnly(),
            Status::make('Status', 'status')
                ->loadingWhen(['dibuat'])
                ->failedWhen(['outdated'])
                ->onlyOnIndex(),
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
