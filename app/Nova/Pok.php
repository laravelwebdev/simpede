<?php

namespace App\Nova;

use App\Models\Permintaan;
use App\Nova\Actions\CreatePermintaan;
use App\Nova\Actions\ImportPoks;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Http\Requests\NovaRequest;

class Pok extends Resource
{
    use Breadcrumbs;
    public static $group = 'Perekaman';

    public static function label()
    {
        if (Auth::user()->role != 'koordinator') {
            self::$group = 'Referensi';

            return 'POK';
        } else {
            return 'Buat Permintaan';
        }
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Pok::class;

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
        'mak', 'ro', 'detail',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $blmbayar = Permintaan::where('detail', $this->id)->where('jumlah_bayar', null)->sum('perkiraan');

        return [
            Stack::make('Details', [
                Line::make('Mak')->asSubTitle(),
                Line::make('Ro')->extraClasses('font-bold text-90'),
                Line::make('Komponen')->asHeading(),
                Line::make('Sub'),
                Line::make('Akun')->extraClasses('font-semibold text-80'),
                Line::make('Detail')->extraClasses('italic font-medium text-80'),
            ]),
            Currency::make('Pagu', 'jumlah')
                ->currency('IDR')
                ->locale('id'),
            Currency::make('Realisasi', 'realisasi')
                ->currency('IDR')
                ->locale('id'),
            Currency::make('Belum dibayar', function () use ($blmbayar) {
                return $blmbayar;
            })
                ->currency('IDR')
                ->locale('id'),
            Currency::make('Sisa', function () use ($blmbayar) {
                return $this->jumlah - $this->realisasi - $blmbayar;
            })
                    ->currency('IDR')
                    ->locale('id'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            return [
                ImportPoks::make()->standalone(),
            ];
        } else {
            return [
                (new CreatePermintaan)->canRun(function () {
                    return Auth::user()->role == 'koordinator';
                })->canSee(function () {
                    return Auth::user()->role == 'koordinator';
                })->onlyOnTableRow(),
            ];
        }
    }
}
