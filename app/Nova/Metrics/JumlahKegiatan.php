<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class JumlahKegiatan extends Value
{
    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name()
    {
        return 'Jumlah Kegiatan';
    }

    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $filtered_jenis = Helper::parseFilterFromUrl(request()->headers->get('referer'), 'mitras_filter', 'Select:jenis_kontrak_id');
        $filtered_bulan = Helper::parseFilterFromUrl(request()->headers->get('referer'), 'mitras_filter', 'App\\Nova\\Filters\\BulanFilter', date('m'));
        $bulan_ini = DB::table('daftar_honor_mitras')
            ->select('honor_kegiatans.id')
            ->join('honor_kegiatans', 'honor_kegiatans.id', '=', 'daftar_honor_mitras.honor_kegiatan_id')
            ->where('jenis_honor', 'Kontrak Mitra Bulanan')
            ->where('tahun', session('year'))
            ->when(! empty($filtered_bulan), function ($query) use ($filtered_bulan) {
                return $query->where('bulan', $filtered_bulan);
            })
            ->when(! empty($filtered_jenis), function ($query) use ($filtered_jenis) {
                return $query->where('jenis_kontrak_id', $filtered_jenis);
            })
            ->distinct('honor_kegiatans.id')
            ->count();
        $bulan_lalu = DB::table('daftar_honor_mitras')
            ->select('honor_kegiatans.id')
            ->join('honor_kegiatans', 'honor_kegiatans.id', '=', 'daftar_honor_mitras.honor_kegiatan_id')
            ->where('jenis_honor', 'Kontrak Mitra Bulanan')
            ->where('tahun', session('year'))
            ->when(! empty($filtered_bulan), function ($query) use ($filtered_bulan) {
                return $query->where('bulan', $filtered_bulan - 1);
            })
            ->when(! empty($filtered_jenis), function ($query) use ($filtered_jenis) {
                return $query->where('jenis_kontrak_id', $filtered_jenis);
            })
            ->distinct('honor_kegiatans.id')
            ->count();

        return $this->result($bulan_ini)
            ->previous($bulan_lalu)
            ->suffix('Kegiatan')
            ->withoutSuffixInflection();
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
}
