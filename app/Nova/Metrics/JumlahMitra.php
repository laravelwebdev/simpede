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
                ->distinct('mitra_id')
                ->count();
        }

        return (new TrendResult)->trend($arr)
            ->result($arr[Helper::$bulan[date('m')]])
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
