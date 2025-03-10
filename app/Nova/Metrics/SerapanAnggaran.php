<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use App\Models\Dipa;
use App\Models\MataAnggaran;
use App\Models\RealisasiAnggaran;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Progress;

class SerapanAnggaran extends Progress
{
    protected $program;

    protected static $kamusProgram = [
        'WA' => 'DUKMAN',
        'GG' => 'PPIS',
    ];

    public function __construct($program = null)
    {
        $this->program = $program;
    }

    public function name()
    {
        return $this->program ? 'Serapan Anggaran '.self::$kamusProgram[$this->program] : 'Serapan Anggaran';
    }

    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $dipa_id = optional(Dipa::cache()->get('all')->where('tahun', session('year'))->first())->id;
        $filtered_ro = Helper::parseFilter($request->query->get('filter'), \App\Nova\Filters\RoFilter::class);
        $filtered_bulan = Helper::parseFilter($request->query->get('filter'), \App\Nova\Filters\BulanFilter::class);

        return $this->program
            ? $this->sum($request, RealisasiAnggaran::class, function ($query) use ($dipa_id, $filtered_bulan) {
                return $query->whereRaw("SUBSTRING(mak,8,2) = '".$this->program."'")
                    ->where('realisasi_anggarans.dipa_id', $dipa_id)
                    ->when(! empty($filtered_bulan), function ($query) use ($filtered_bulan) {
                        return $query->whereMonth('tanggal_sp2d', '<=', $filtered_bulan);
                    })
                    ->join(
                        'mata_anggarans',
                        'realisasi_anggarans.mata_anggaran_id',
                        '=',
                        'mata_anggarans.id'
                    )->join(
                        'daftar_sp2ds',
                        'realisasi_anggarans.daftar_sp2d_id',
                        '=',
                        'daftar_sp2ds.id'
                    );
            }, column: 'nilai', target: MataAnggaran::whereRaw("SUBSTRING(mak,8,2) = '".$this->program."'")->where('dipa_id', $dipa_id)->sum(DB::raw('total - blokir')))
            : $this->sum($request, RealisasiAnggaran::class, function ($query) use ($filtered_ro, $filtered_bulan, $dipa_id) {
                return $query->when(! empty($filtered_ro), function ($query) use ($filtered_ro) {
                    return $query->whereRaw("SUBSTRING(mak,11,12) ='".$filtered_ro."'");
                })->where('realisasi_anggarans.dipa_id', $dipa_id)
                    ->when(! empty($filtered_bulan), function ($query) use ($filtered_bulan) {
                        return $query->whereMonth('tanggal_sp2d', '<=', $filtered_bulan);
                    })
                    ->join(
                        'mata_anggarans',
                        'realisasi_anggarans.mata_anggaran_id',
                        '=',
                        'mata_anggarans.id'
                    )->join(
                        'daftar_sp2ds',
                        'realisasi_anggarans.daftar_sp2d_id',
                        '=',
                        'daftar_sp2ds.id'
                    );
            }, column: 'nilai', target: ! empty($filtered_ro) ? MataAnggaran::whereRaw("SUBSTRING(mak,11,12) ='".$filtered_ro."'")->where('dipa_id', $dipa_id)->sum(DB::raw('total - blokir')) : MataAnggaran::where('dipa_id', $dipa_id)->sum(DB::raw('total - blokir')));
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int
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
        return 'serapan-anggaran-'.$this->program;
    }
}
