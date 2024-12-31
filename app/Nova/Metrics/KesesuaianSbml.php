<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class KesesuaianSbml extends Partition
{
    public function name()
    {
        return 'Kesesuaian dengan SBML';
    }

    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $filtered_jenis = Helper::parseFilter($request->query->get('filter'), 'Select:jenis_kontrak_id');
        $filtered_bulan = Helper::parseFilter($request->query->get('filter'), 'App\\Nova\\Filters\\BulanFilter', (int) date('m'));
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
                            ->where('tahun', 2024)
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
