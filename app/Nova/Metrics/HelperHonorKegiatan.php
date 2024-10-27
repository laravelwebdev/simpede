<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;

class HelperHonorKegiatan extends Table
{
    public function name()
    {
        return 'Tata Cara Penggunaan Import dan Upload Menggunakan FIle BOS';
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return [
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('1.Lengkapi Semua Keterangan Honor Kegiatan')
                ->subtitle('Lengkapi terlebih dahulu keterangan tentang honor kegiatan melalui menu Sunting.'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('2.Unduh Template dari Aplikasi BOS')
                ->subtitle('Unduh Template Excel melalui menu Import Peserta -> Download Template. Beri Cek pada pilihan Sertakan Master Sobat BPS lalu pilih kegiatan dan klik tombol Download Excel.'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('3.Import Template Excel')
                ->subtitle('Import dengan memilih menu Tampilan. Pada Tab Daftar Honor Mitra pilih Aksi Import Dari BOS. Import file Excel pada langkah 2 tanpa perlu diisi terlebih dahulu.'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('4.Lengkapi Isian')
                ->subtitle('Lengkapi Keterangan volume, harga satuan, persentase pajak tiap mitra yang termuat. Pastikan Rekening sudah terisi. Jika masih kosong, lengkapi melalui aksi Edit Rekening.'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('5.Upload Excel ke Aplikasi BOS')
                ->subtitle('Setelah terisi lengkap, pilih aksi Export Template BOOS dan gunakan file excel tersebut untuk digunakan sebagai file import peserta pada aplikasi BOS.'),
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
