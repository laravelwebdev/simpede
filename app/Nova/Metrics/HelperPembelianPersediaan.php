<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;

class HelperPembelianPersediaan extends Table
{
    public function name()
    {
        return 'Tata Cara Perekaman Pembelian Barang Persediaan';
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
                ->title('1.Penerimaan oleh Pejabat Pengadaan')
                ->subtitle('Pejabat Pengadaan melengkapi daftar barang sesuai dengan jumlah, jenis, dan harganya. Jika sudah sesuai pilih aksi terima barang.'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('2.Penentuan tanggal BAST dan Tanggal Buku oleh Pengelola BMN')
                ->subtitle('Pengelola BMN menentukan tanggal BAST dan tanggal pembukuan barang melalui menu Sunting.'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('3.Pemberian Kode Barang oleh Pengelola BMN')
                ->subtitle('Pengelola BMN memberikan kode barang yang sesuai untuk semua barang persediaan yang telah dibeli. Jika semua sudah diberi kode, pilih aksi Tandai Telah Diberi Kode'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('4.PPK melakukan perekaman di SAKTI')
                ->subtitle('Pejabat Pembuat Komitmen melakukan perekaman BAST di SAKTI sesuai tanggal BAST, tanggal buku dan kode barang yang telah diisikan ooleh Pengelola BMN.'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('5.Pencetakan BAST oleh Pengelola BMN')
                ->subtitle('Pengelola BMN melakukan pencetakan BAST melalui aksi Cetak BAST Persediaan.'),
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
