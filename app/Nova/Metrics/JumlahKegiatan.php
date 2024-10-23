<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\LensMetricRequest;
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
        $filtered_bulan = date('m');
        $queries = [];
        parse_str(
            parse_url(
                request()->headers->get('referer'), PHP_URL_QUERY),
            $queries
        );

        if (isset($queries['daftar-honor-mitras_filter'])) {
            $filtered_bulan = collect(
                json_decode(base64_decode($queries['daftar-honor-mitras_filter'], true))
            )->pluck('App\\Nova\\Filters\\BulanKontrak')[1];
            $filtered_jenis = collect(
                json_decode(base64_decode($queries['daftar-honor-mitras_filter'], true))
            )->pluck('App\\Nova\\Filters\\JenisKontrak')[1];
        }
        $bulan_ini = DB::table('daftar_honor_mitras')
            ->select('honor_kegiatans.id')
            ->join('honor_kegiatans', 'honor_kegiatans.id', '=', 'daftar_honor_mitras.honor_kegiatan_id')
            ->where('jenis_honor', 'Kontrak Mitra Bulanan')
            ->where('tahun', session('year'))
            ->where('bulan', $filtered_bulan)
            ->when(isset($filtered_jenis), function ($query) use ($filtered_jenis) {
                return $query->where('jenis_kontrak_id', $filtered_jenis);
            })
            ->distinct('honor_kegiatans.id')
            ->count();
        $bulan_lalu = DB::table('daftar_honor_mitras')
            ->select('honor_kegiatans.id')
            ->join('honor_kegiatans', 'honor_kegiatans.id', '=', 'daftar_honor_mitras.honor_kegiatan_id')
            ->where('jenis_honor', 'Kontrak Mitra Bulanan')
            ->where('tahun', session('year'))
            ->where('bulan', $filtered_bulan - 1)
            ->when(isset($filtered_jenis), function ($query) use ($filtered_jenis) {
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
