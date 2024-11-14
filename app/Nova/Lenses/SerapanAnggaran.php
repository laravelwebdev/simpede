<?php

namespace App\Nova\Lenses;

use Laravel\Nova\Lenses\Lens;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use App\Nova\Filters\BulanFilter;

class SerapanAnggaranLens extends Lens
{
    /**
     * Get the fields displayed by the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Jenis Belanja', 'jenis_belanja'),

            Number::make('Target Realisasi', 'target_realisasi')
                ->displayUsing(function ($value) {
                    return number_format($value, 2);
                }),

            Number::make('Realisasi Kumulatif', 'realisasi_kumulatif')
                ->displayUsing(function ($value) {
                    return number_format($value, 2);
                }),

            Number::make('Realisasi Bulan Ini', 'realisasi_bulan_ini')
                ->displayUsing(function ($value) {
                    return number_format($value, 2);
                }),

            Number::make('Selisih Realisasi', 'selisih_realisasi')
                ->displayUsing(function ($value) {
                    return number_format($value, 2);
                }),

            Number::make('Persen Realisasi', 'persen_realisasi')
                ->displayUsing(function ($value) {
                    return number_format($value, 2) . ' %';
                }),
        ];
    }

    /**
     * Get the query for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest    $request
     * @param  \Illuminate\Database\Eloquent\Builder      $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function query(NovaRequest $request, $query)
    {
        // Ambil filter bulan
        $filterBulan = '10';
        $filterTahun = date('Y'); // Sesuaikan tahun jika diperlukan

        // Subquery untuk realisasi bulan ini
        $realisasiBulanIniSubquery = DB::table('realisasi_anggarans')
            ->select([
                DB::raw("SUBSTRING(mata_anggarans.mak, 30, 2) as jenis_belanja"),
                DB::raw("SUM(realisasi_anggarans.nilai) as realisasi_bulan_ini")
            ])
            ->join('mata_anggarans', 'realisasi_anggarans.coa_id', '=', 'mata_anggarans.coa_id')
            ->whereYear('realisasi_anggarans.tanggal_sp2d', '=', $filterTahun)
            ->whereMonth('realisasi_anggarans.tanggal_sp2d', '=', $filterBulan)
            ->groupBy('jenis_belanja');

        // Subquery untuk total berdasarkan jenis belanja
        $totalSubquery = DB::table('mata_anggarans')
            ->select([
                DB::raw("SUBSTRING(mak, 30, 2) as jenis_belanja"),
            DB::raw("SUM(CASE WHEN SUBSTRING(mak, 30, 2) = '51' THEN total ELSE 0 END) as total51"),
            DB::raw("SUM(CASE WHEN SUBSTRING(mak, 30, 2) = '52' THEN total ELSE 0 END) as total52"),
            DB::raw("SUM(CASE WHEN SUBSTRING(mak, 30, 2) = '53' THEN total ELSE 0 END) as total53"),
            DB::raw("SUM(CASE WHEN SUBSTRING(mak, 30, 2) = '54' THEN total ELSE 0 END) as total54"),
            DB::raw("SUM(CASE WHEN SUBSTRING(mak, 30, 2) = '55' THEN total ELSE 0 END) as total55"),
            DB::raw("SUM(CASE WHEN SUBSTRING(mak, 30, 2) = '56' THEN total ELSE 0 END) as total56"),
            DB::raw("SUM(CASE WHEN SUBSTRING(mak, 30, 2) = '57' THEN total ELSE 0 END) as total57"),
            DB::raw("SUM(CASE WHEN SUBSTRING(mak, 30, 2) = '58' THEN total ELSE 0 END) as total58")
            ])
            ->groupBy("jenis_belanja");

        // Query utama
        return $request->withOrdering($request->withFilters(
            $query->from('realisasi_anggarans')
                ->select([
                    DB::raw("SUBSTRING(mata_anggarans.mak, 30, 2) as jenis_belanja"),
                    DB::raw("
                        SUM(DISTINCT
                            CASE 
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '51' THEN (target_serapan_anggarans.belanja51 / 100) * total_subquery.total51
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '52' THEN (target_serapan_anggarans.belanja52 / 100) * total_subquery.total52
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '53' THEN (target_serapan_anggarans.belanja53 / 100) * total_subquery.total53
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '54' THEN (target_serapan_anggarans.belanja54 / 100) * total_subquery.total54
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '55' THEN (target_serapan_anggarans.belanja55 / 100) * total_subquery.total55
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '56' THEN (target_serapan_anggarans.belanja56 / 100) * total_subquery.total56
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '57' THEN (target_serapan_anggarans.belanja57 / 100) * total_subquery.total57
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '58' THEN (target_serapan_anggarans.belanja58 / 100) * total_subquery.total58
                                ELSE 0
                            END
                        ) as target_realisasi
                    "),
                    DB::raw("SUM(DISTINCT realisasi_anggarans.nilai) as realisasi_kumulatif"),
                    DB::raw("
                        SUM(DISTINCT
                            CASE 
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '51' THEN (target_serapan_anggarans.belanja51 / 100) * total_subquery.total51
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '52' THEN (target_serapan_anggarans.belanja52 / 100) * total_subquery.total52
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '53' THEN (target_serapan_anggarans.belanja53 / 100) * total_subquery.total53
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '54' THEN (target_serapan_anggarans.belanja54 / 100) * total_subquery.total54
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '55' THEN (target_serapan_anggarans.belanja55 / 100) * total_subquery.total55
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '56' THEN (target_serapan_anggarans.belanja56 / 100) * total_subquery.total56
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '57' THEN (target_serapan_anggarans.belanja57 / 100) * total_subquery.total57
                                WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '58' THEN (target_serapan_anggarans.belanja58 / 100) * total_subquery.total58
                                ELSE 0
                            END
                        ) - SUM(DISTINCT realisasi_anggarans.nilai) as selisih_realisasi
                    "),
                    DB::raw("
                        ROUND(
                            SUM(DISTINCT realisasi_anggarans.nilai) / NULLIF(
                                SUM(DISTINCT
                                    CASE 
                                        WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '51' THEN (target_serapan_anggarans.belanja51 / 100) * total_subquery.total51
                                        WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '52' THEN (target_serapan_anggarans.belanja52 / 100) * total_subquery.total52
                                        WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '53' THEN (target_serapan_anggarans.belanja53 / 100) * total_subquery.total53
                                        WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '54' THEN (target_serapan_anggarans.belanja54 / 100) * total_subquery.total54
                                        WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '55' THEN (target_serapan_anggarans.belanja55 / 100) * total_subquery.total55
                                        WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '56' THEN (target_serapan_anggarans.belanja56 / 100) * total_subquery.total56
                                        WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '57' THEN (target_serapan_anggarans.belanja57 / 100) * total_subquery.total57
                                        WHEN SUBSTRING(mata_anggarans.mak, 30, 2) = '58' THEN (target_serapan_anggarans.belanja58 / 100) * total_subquery.total58
                                        ELSE 0
                                    END
                                ), 0
                            ) * 100, 2
                        ) as persen_realisasi
                    "),
                    DB::raw("COALESCE(realisasi_bulan_ini.realisasi_bulan_ini, 0) as realisasi_bulan_ini"),
                ])
                ->join('mata_anggarans', 'realisasi_anggarans.coa_id', '=', 'mata_anggarans.coa_id')
                ->join('target_serapan_anggarans', function ($join) use ($filterBulan) {
                    $join->on('target_serapan_anggarans.bulan', '<=', DB::raw("'$filterBulan'"));
                })
                ->leftJoinSub($realisasiBulanIniSubquery, 'realisasi_bulan_ini', function ($join) {
                    $join->on(DB::raw("SUBSTRING(mata_anggarans.mak, 30, 2)"), '=', 'realisasi_bulan_ini.jenis_belanja');
                })
                ->leftJoinSub($totalSubquery, 'total_subquery', function ($join) {
                    $join->on(DB::raw("SUBSTRING(mata_anggarans.mak, 30, 2)"), '=', 'total_subquery.jenis_belanja');
                })
                ->whereYear('realisasi_anggarans.tanggal_sp2d', '=', $filterTahun)
                ->whereMonth('realisasi_anggarans.tanggal_sp2d', '<=', $filterBulan)
                ->groupBy([
                    DB::raw("SUBSTRING(mata_anggarans.mak, 30, 2)"),
                    'jenis_belanja',
                ])
                ->groupByRaw('COALESCE(realisasi_bulan_ini.realisasi_bulan_ini, 0)')
        ));
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new BulanFilter,
        ];
    }

    /**
     * Get the actions available for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}