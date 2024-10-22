<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Nova;

class JumlahKegiatan extends Value
{
    /**
     * Get the displayable name of the metric
     *
     * @return string
     */
    public function name()
    {
        return 'Jumlah Kegiatan Bulan '.Helper::$bulan[date('m')];
    }
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $bulan_ini = DB::table('daftar_honor_mitras')
            ->select('honor_kegiatans.id')
            ->join('honor_kegiatans', 'honor_kegiatans.id', '=', 'daftar_honor_mitras.honor_kegiatan_id')
            ->where('jenis_honor', 'Kontrak Mitra Bulanan')
            ->where('tahun', session('year'))
            ->where('bulan', date('m'))
            ->distinct('honor_kegiatans.id')
            ->count();
        $bulan_lalu = DB::table('daftar_honor_mitras')
            ->select('honor_kegiatans.id')
            ->join('honor_kegiatans', 'honor_kegiatans.id', '=', 'daftar_honor_mitras.honor_kegiatan_id')
            ->where('jenis_honor', 'Kontrak Mitra Bulanan')
            ->where('tahun', session('year'))
            ->where('bulan', date('m')-1)
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
