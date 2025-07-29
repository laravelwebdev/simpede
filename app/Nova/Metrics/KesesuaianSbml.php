<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class KesesuaianSbml extends Partition
{
    private $model;

    public function __construct($model = 'honor')
    {
        $this->model = $model;
    }

    public function name()
    {
        if ($this->model === 'honor') {
            return 'Kesesuaian dengan SBML';
        }
        if ($this->model === 'pulsa') {
            return 'Kesesuaian dengan Batas Limit Bulanan';
        }
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
            $arr = DB::query()
                ->selectRaw(
                    'sum(if(valid_sbml=1,1,0)) as sesuai, sum(if(valid_sbml=0,1,0)) as tidak, count(valid_sbml) as total'
                )
                ->from(
                    DB::table('daftar_honor_mitras')
                        ->selectRaw(
                            'bulan,jenis_kontrak_id, nama,  mitra_id, count(DISTINCT honor_kegiatan_id) as jumlah_kegiatan, sum(volume_realisasi * harga_satuan) as nilai_kontrak, sum(volume_realisasi * harga_satuan) < sbml as valid_sbml '
                        )
                        ->whereIn('honor_kegiatan_id', function ($query) use ($filtered_bulan, $filtered_jenis) {
                            $query
                                ->select('id')
                                ->from('honor_kegiatans')
                                ->where('tahun', session('year'))
                                ->when(! empty($filtered_bulan), function ($query) use ($filtered_bulan) {
                                    return $query->where('bulan', $filtered_bulan);
                                })
                                ->when(! empty($filtered_jenis), function ($query) use ($filtered_jenis) {
                                    return $query->where('jenis_kontrak_id', $filtered_jenis);
                                })
                                ->where('jenis_honor', 'Kontrak Mitra Bulanan');
                        })
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
                        ->groupBy([
                            'bulan',
                            'mitra_id',
                            'nama',
                            'nik',
                            'sbml',
                            'jenis_kontrak_id',
                        ])
                )
                ->get();
        }
        if ($this->model == 'pulsa') {
            $arr = DB::query()
                ->selectRaw(
                    'sum(if(valid_sbml=1,1,0)) as sesuai, sum(if(valid_sbml=0,1,0)) as tidak, count(valid_sbml) as total'
                )
                ->from(
                    DB::table('daftar_pulsa_mitras')
                        ->selectRaw(
                            'bulan, nama,  mitra_id, count(DISTINCT pulsa_kegiatan_id) as jumlah_kegiatan,  sum(harga) < `limit` as valid_sbml '
                        )
                        ->whereIn('pulsa_kegiatan_id', function ($query) use ($filtered_bulan) {
                            $query
                                ->select('id')
                                ->from('pulsa_kegiatans')
                                ->where('tahun', session('year'))
                                ->when(! empty($filtered_bulan), function ($query) use ($filtered_bulan) {
                                    return $query->where('bulan', $filtered_bulan);
                                });
                        })
                        ->join(
                            'pulsa_kegiatans',
                            'pulsa_kegiatans.id',
                            '=',
                            'daftar_pulsa_mitras.pulsa_kegiatan_id'
                        )
                        ->join('jenis_pulsas', 'jenis_pulsas.id', '=', 'pulsa_kegiatans.jenis_pulsa_id')
                        ->join('limit_pulsas', 'limit_pulsas.id', '=', 'jenis_pulsas.limit_pulsa_id')
                        ->join('mitras', 'mitras.id', '=', 'daftar_pulsa_mitras.mitra_id')
                        ->groupBy([
                            'bulan',
                            'mitra_id',
                            'nama',
                            'nik',
                            'limit',
                        ])
                )
                ->get();
        }
        $arr->transform(function ($item, $index) {
            if ($item->total > 0) {
                return [
                    'Sesuai' => $item->sesuai,
                    'Tidak Sesuai' => $item->tidak,
                ];
            }

            return ['Tidak Ada Data' => 0];
        });

        return $this
            ->result($arr->first())
            ->colors([
                'Sesuai' => '#38C172',
                'Tidak Sesuai' => '#E3342F',
            ]);
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
        return 'kesesuaian-sbml';
    }
}
