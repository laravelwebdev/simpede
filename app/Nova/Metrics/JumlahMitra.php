<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Metrics\TrendResult;

class JumlahMitra extends Trend
{
    private $model;

    public function __construct($model = 'honor')
    {
        $this->model = $model;
    }

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
        $filtered_bulan = Helper::parseFilter($request->query->get('filter'), \App\Nova\Filters\BulanFilter::class, (int) date('m'));
        if ($this->model == 'honor') {
            $filtered_jenis = Helper::parseFilter($request->query->get('filter'), 'Select:jenis_kontrak_id');
            $arr = [];
            $query = DB::table('daftar_honor_mitras')
                ->select(DB::raw('bulan, COUNT(DISTINCT mitra_id) as mitra_count'))
                ->join(
                    'honor_kegiatans',
                    'honor_kegiatans.id',
                    '=',
                    'daftar_honor_mitras.honor_kegiatan_id'
                )
                ->where('jenis_honor', 'Kontrak Mitra Bulanan')
                ->where('tahun', session('year'))
                ->when(! empty($filtered_jenis), function ($query) use ($filtered_jenis) {
                    return $query->where('jenis_kontrak_id', $filtered_jenis);
                })
                ->groupBy('bulan')
                ->get();
        }
        if ($this->model == 'pulsa') {
            $arr = [];
            $query = DB::table('daftar_pulsa_mitras')
                ->select(DB::raw('bulan, COUNT(DISTINCT mitra_id) as mitra_count'))
                ->join(
                    'pulsa_kegiatans',
                    'pulsa_kegiatans.id',
                    '=',
                    'daftar_pulsa_mitras.pulsa_kegiatan_id'
                )
                ->where('tahun', session('year'))
                ->groupBy('bulan')
                ->get();
        }

        foreach (Helper::BULAN as $key => $value) {
            $arr[$value] = $query->firstWhere('bulan', $key)->mitra_count ?? 0;
        }
        if ($filtered_bulan == '') {
            return (new TrendResult)->trend($arr);
        } else {
            return (new TrendResult)->trend($arr)
                ->result($arr[Helper::BULAN[$filtered_bulan]])
                ->suffix('Mitra')
                ->format([
                    'average' => false,
                ])
                ->withoutSuffixInflection();
        }
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
