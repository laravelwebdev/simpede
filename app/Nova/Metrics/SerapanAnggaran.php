<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use App\Models\MataAnggaran;
use App\Models\RealisasiAnggaran;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Progress;

class SerapanAnggaran extends Progress
{
    protected $program;

    protected static $kamusProgram =[
        "WA" => 'DUKMAN',
        "GG" => "PPIS",
    ];

    public function __construct($program = null)
    {
        $this->program = $program;
    }

    public function name()
    {
        return $this->program ? 'Serapan Anggaran ' . self::$kamusProgram[$this->program] : 'Serapan Anggaran Total';
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $filtered_ro = Helper::parseFilterFromUrl(request()->headers->get('referer'), 'realisasi-anggarans_filter', 'App\\Nova\\Filters\\RoFilter');
        return is_null($this->program ) ? $this->sum($request, RealisasiAnggaran::class, function ($query) use ($filtered_ro) {
            return !empty($filtered_ro) ? $query->whereRaw("SUBSTRING(mak,11,12) ='".$filtered_ro."'")
            ->join(
                "mata_anggarans",
                "realisasi_anggarans.mata_anggaran_id",
                "=",
                "mata_anggarans.id"
              )
            :$query;
        }, column: 'nilai', target: !empty($filtered_ro) ? MataAnggaran::whereRaw("SUBSTRING(mak,11,12) ='".$filtered_ro."'")->sum('total') :MataAnggaran::sum('total'))
        : $this->sum($request, RealisasiAnggaran::class, function ($query) {
            return $query->whereRaw("SUBSTRING(mak,8,2) = '".$this->program."'")
            ->join(
              "mata_anggarans",
              "realisasi_anggarans.mata_anggaran_id",
              "=",
              "mata_anggarans.id"
            );
        }, column: 'nilai', target: MataAnggaran::whereRaw("SUBSTRING(mak,8,2) = '".$this->program."'")->sum('total'));
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
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
        return 'serapan-anggaran-' . $this->program;
    }
}
