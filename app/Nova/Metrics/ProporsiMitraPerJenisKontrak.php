<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class ProporsiMitraPerJenisKontrak extends Partition
{
    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name()
    {
        return 'Proporsi Jumlah Mitra';
    }

    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $filtered_bulan = Helper::parseFilter($request->query->get('filter'), 'App\Nova\Filters\BulanKontrak', (int) date('m'));
        $arr = DB::table('daftar_honor_mitras')
            ->selectRaw('jenis, count(distinct(mitra_id)) as jumlah_mitra')
            ->join(
                'honor_kegiatans',
                'honor_kegiatans.id',
                '=',
                'daftar_honor_mitras.honor_kegiatan_id'
            )
            ->join(
                'jenis_kontraks',
                'jenis_kontraks.id',
                '=',
                'honor_kegiatans.jenis_kontrak_id'
            )
            ->join('mitras', 'mitras.id', '=', 'daftar_honor_mitras.mitra_id')
            ->where('jenis_honor', 'Kontrak Mitra Bulanan')
            ->where('tahun', session('year'))
            ->when(! empty($filtered_bulan), function ($query) use ($filtered_bulan) {
                return $query->where('bulan', $filtered_bulan);
            })
            ->groupBy('jenis_kontrak_id')
            ->pluck('jumlah_mitra', 'jenis')
            ->toArray();
        if (empty($arr)) {
            $arr = ['Tidak Ada Data' => 0];
        }

        return $this
            ->result($arr);
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'jumlah-mitra-per-jenis-kontrak';
    }
}
