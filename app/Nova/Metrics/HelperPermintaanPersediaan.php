<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;

class HelperPermintaanPersediaan extends Table
{
    public function name()
    {
        return 'Tata Cara Perekaman Permintaan Barang Persediaan';
    }

    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return [
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('1.Pengajuan Permintaan Oleh Pegawai')
                ->subtitle('Pegawai mengajukan permintaan dengan membuat permintaan persediaan dan mengisi jenis dan jumlah barang yang diminta.'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('2.Pencetakan Dokumen Permintaan Persediaan oleh Pengelola BMN')
                ->subtitle('Pengelola BMN melakukan pencetakan  melalui aksi Unduh Permintaan Persediaan. Barang Pesediaan hanya akan tercatat dalam saldo keluar apabila Daftar Permintaan telah dicetak.'),
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
}
