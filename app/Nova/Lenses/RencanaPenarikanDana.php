<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use App\Models\Dipa;
use App\Nova\Filters\BulanFilter;
use App\Nova\Filters\RoFilter;
use App\Nova\Metrics\RencanaPenarikanPerJenisBelanja;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;

class RencanaPenarikanDana extends Lens
{
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'mak',
    ];

    public function name()
    {
        return 'Monitoring RPD';
    }

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        $dipa_id = Helper::getPropertyFromCollection(Dipa::cache()->get('all')->where('tahun', session('year'))->first(), 'id');
        $filtered_bulan = Helper::parseFilter($request->query->get('filters'), 'App\\Nova\\Filters\\BulanFilter', (int) date('m'));

        return $request->withOrdering($request->withFilters(
            $query->fromSub(fn ($query) => $query->from('realisasi_anggarans')->selectRaw(
                'mak, 
                ordered,
                mata_anggarans.uraian as item, 
                rpd_'.$filtered_bulan.' as target, 
                CASE WHEN SUM(nilai) IS NULL THEN 0 ELSE SUM(nilai) END as realisasi, 
                CASE WHEN SUM(nilai) IS NULL THEN  rpd_'.$filtered_bulan.' ELSE   rpd_'.$filtered_bulan.' - SUM(nilai) END as deviasi'
            )
                ->join('daftar_sp2ds', 'realisasi_anggarans.daftar_sp2d_id', '=', 'daftar_sp2ds.id')
                ->rightJoin('mata_anggarans', function ($join) use ($filtered_bulan) {
                    $join->on('realisasi_anggarans.mata_anggaran_id',
                        '=',
                        'mata_anggarans.id')

                        ->whereMonth('tanggal_sp2d', $filtered_bulan);
                })
                ->where('mata_anggarans.dipa_id', $dipa_id)

                ->groupBy('mak')
                ->groupBy('ordered')
                ->groupBy('item')
                ->groupBy('target')
                ->orderBy('mak')
                ->orderBy('ordered'), 'realisasi_anggarans')
        ));
    }

    /**
     * Get the fields available to the lens.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Stack::make('RO/Komponen', [
                Line::make('RO', 'mak')
                    ->displayUsing(fn ($value) => Helper::getDetailAnggaran($value, 'ro'))->asSubTitle(),
                Line::make('Komponen', 'mak')
                    ->displayUsing(fn ($value) => Helper::getDetailAnggaran($value, 'komponen'))->asSmall(),
            ]),
            Stack::make('Akun/Detil', [
                Line::make('Akun', 'mak')
                    ->displayUsing(fn ($value) => Helper::getDetailAnggaran($value))->asSubTitle(),
                Line::make('Item', 'item')->asSmall(),
            ]),
            Number::make('Target', 'target')
                ->displayUsing(fn ($value) => Helper::formatUang($value)),
            Number::make('Realisasi', 'realisasi')
                ->displayUsing(fn ($value) => Helper::formatUang($value)),
            Number::make('Deviasi', 'deviasi')
                ->sortable()
                ->displayUsing(fn ($value) => Helper::formatUang($value)),
        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            RencanaPenarikanPerJenisBelanja::make(),
        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            BulanFilter::make(),
            RoFilter::make(),
        ];
    }

    /**
     * Get the actions available on the lens.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [

        ];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'rencana-penarikan-dana';
    }
}
