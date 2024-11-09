<?php

namespace App\Nova\Metrics;

use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class PembukuanBarangPersediaan extends Partition
{
    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name()
    {
        return 'Pembukuan Persediaan';
    }

    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $arr = DB::table('barang_persediaans')
            ->selectRaw(
                'SUM(CASE WHEN tanggal_transaksi IS NULL THEN 1 ELSE 0 END) as belum'
            )
            ->selectRaw(
                'SUM(CASE WHEN tanggal_transaksi IS NOT NULL THEN 1 ELSE 0 END) as sudah'
            )
            ->selectRaw('COUNT(id) as total')
            ->get();

        $arr->transform(function ($item, $index) {
            if ($item->total > 0) {
                return [
                    'Sudah' => $item->sudah,
                    'Belum' => $item->belum,
                ];
            }

            return ['Tidak Ada Data' => 0];
        });

        return $this
            ->result($arr->first())
            ->colors([
                'Sudah' => '#38C172',
                'Belum' => '#E3342F',
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
        return 'proporsi-barang-per-tanggal-transaksi';
    }
}
