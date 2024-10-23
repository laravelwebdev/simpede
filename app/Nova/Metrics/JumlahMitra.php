<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Metrics\TrendResult;

class JumlahMitra extends Trend
{
    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name()
    {
        return 'Jumlah Mitra Per Bulan '.session('year');
    }

    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $filtered_bulan = date('m');
        $filtered_jenis = null;
        $queries = [];

        parse_str(parse_url(request()->headers->get('referer'), PHP_URL_QUERY), $queries);

        if (isset($queries['daftar-honor-mitras_filter'])) {
            $filters = json_decode(base64_decode($queries['daftar-honor-mitras_filter'], true), true);
            $filtered_bulan = $filters['App\\Nova\\Filters\\BulanKontrak'][1] ?? $filtered_bulan;
            $filtered_jenis = $filters['App\\Nova\\Filters\\JenisKontrak'][1] ?? null;
        }
        $arr = [];
        foreach (Helper::$bulan as $key => $value) {
            $arr[$value] = DB::table('daftar_honor_mitras')
                ->select('mitra_id')
                ->join(
                    'honor_kegiatans',
                    'honor_kegiatans.id',
                    '=',
                    'daftar_honor_mitras.honor_kegiatan_id'
                )
                ->where('jenis_honor', 'Kontrak Mitra Bulanan')
                ->where('tahun', session('year'))
                ->where('bulan', $key)
                ->when(isset($filtered_jenis), function ($query) use ($filtered_jenis) {
                    return $query->where('jenis_kontrak_id', $filtered_jenis);
                })
                ->distinct('mitra_id')
                ->count();
        }

        return (new TrendResult)->trend($arr)
            ->result($arr[Helper::$bulan[$filtered_bulan]])
            ->suffix('Mitra')
            ->withoutSuffixInflection();
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
        ];
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
        return 'jumlah-mitra';
    }
}
