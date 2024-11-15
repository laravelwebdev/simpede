<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use App\Models\Dipa;
use App\Nova\Filters\RoFilter;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;

class RealisasiAnggaran extends Lens
{
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [];

    public function name()
    {
        return 'Realisasi SP2D per '.Helper::terbilangTanggal(Dipa::cache()->get('all')->where('tahun', session('year'))->first()->tanggal_realisasi);
    }

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        $dipa_id = Dipa::cache()->get('all')->where('tahun', session('year'))->first()->id;

        return $request->withOrdering($request->withFilters(
            $query->fromSub(fn ($query) => $query->from('realisasi_anggarans')->selectRaw(
                'mak, 
                mata_anggarans.uraian as item, 
                total, 
                CASE WHEN SUM(nilai) IS NULL THEN 0 ELSE SUM(nilai) END as realisasi, 
                CASE WHEN SUM(nilai) IS NULL THEN 0 ELSE round(100*sum(nilai)/total,2) END as persen, 
                CASE WHEN SUM(nilai) IS NULL THEN total ELSE  total- SUM(nilai) END as sisa'
            )
                ->rightJoin(
                    'mata_anggarans',
                    'realisasi_anggarans.mata_anggaran_id',
                    '=',
                    'mata_anggarans.id'
                )
                ->where('mata_anggarans.dipa_id', $dipa_id)
                ->groupBy('mak')
                ->groupBy('mata_anggaran_id')
                ->groupBy('mata_anggarans.uraian')
                ->groupBy('total')
                ->orderBy('mata_anggarans.mak')
                ->orderBy('mata_anggaran_id'), 'realisasi_anggarans')));
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
            Number::make('Total', 'total')
                ->displayUsing(fn ($value) => Helper::formatUang($value)),
            Number::make('Realisasi', 'realisasi')
                ->displayUsing(fn ($value) => Helper::formatUang($value)),
            Number::make('% Realisasi', 'persen')->filterable(),
            Number::make('Sisa', 'sisa')
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
        return [];
    }

    /**
     * Get the filters available for the lens.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
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
        return parent::actions($request);
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'realisasi-anggaran';
    }
}
