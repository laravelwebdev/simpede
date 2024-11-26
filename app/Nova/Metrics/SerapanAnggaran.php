<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use App\Models\Dipa;
use App\Models\MataAnggaran;
use App\Models\RealisasiAnggaran;
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
        return $this->program ? 'Serapan Anggaran '.self::$kamusProgram[$this->program] : 'Serapan Anggaran Total';
    }

    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $dipa_id = null;
        $$dipa_id = Helper::getPropertyFromCollection(Dipa::cache()->get('all')->where('tahun', session('year'))->first(), 'id');
        $filtered_ro = Helper::parseFilterFromUrl(request()->headers->get('referer'), 'realisasi-anggarans_filter', 'App\\Nova\\Filters\\RoFilter');
        $filtered_bulan = Helper::parseFilterFromUrl(request()->headers->get('referer'), 'realisasi-anggarans_filter', 'App\\Nova\\Filters\\BulanFilter');

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
                    );
            }, column: 'nilai', target: MataAnggaran::whereRaw("SUBSTRING(mak,8,2) = '".$this->program."'")->where('dipa_id', $dipa_id)->sum('total'))
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
                    );
            }, column: 'nilai', target: ! empty($filtered_ro) ? MataAnggaran::whereRaw("SUBSTRING(mak,11,12) ='".$filtered_ro."'")->where('dipa_id', $dipa_id)->sum('total') : MataAnggaran::where('dipa_id', $dipa_id)->sum('total'));
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
