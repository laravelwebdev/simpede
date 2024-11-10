<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;

class HelperImportAnggaran extends Table
{
    public function name()
    {
        return 'Tata Cara Import Anggaran';
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
                ->title('1.Import POK SATU DJA')
                ->subtitle('Import File Excel revisi terakhir  dari Satu DJA (Download DIPA pilih POK), save as dengan extensi .xlsx'),
            //TODO: belum selesai   
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('2.Import Mata Anggaran Monsakti')
                ->subtitle('Unduh Template Excel melalui menu Import Peserta -> Download Template. Beri Cek pada pilihan Sertakan Master Sobat BPS lalu pilih kegiatan dan klik tombol Download Excel.'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('3.Import Realisasi SP2D')
                ->subtitle('Import dengan memilih menu Tampilan. Pada Tab Daftar Honor Mitra pilih Aksi Import Dari BOS. Import file Excel pada langkah 2 tanpa perlu diisi terlebih dahulu.'),
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
