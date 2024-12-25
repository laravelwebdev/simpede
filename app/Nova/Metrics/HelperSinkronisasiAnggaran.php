<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;

class HelperSinkronisasiAnggaran extends Table
{
    public function name()
    {
        return 'Tata Cara Sinkronisasi Data Anggaran';
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
                ->title('1.Unduh Data POK SATU DJA')
                ->subtitle('Unduh File Excel revisi terakhir  dari Satu DJA (Download DIPA - POK), save as dengan extensi .xlsx'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('2.Unduh Data Mata Anggaran Monsakti')
                ->subtitle('Unduh File CSV dari Monsakti (Anggaran - Download Data Mentah Penganggaran)'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('3.Sinkronisasi Data Anggaran')
                ->subtitle('Sinkronisasi dapat dilakukan melalui Tombol Aksi -> Sinkronisasi Data Anggaran dan pilih kedua file yang telah diunduh'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('4.Import Realisasi SP2D')
                ->subtitle('Import file Excel dari mon sakti (Pembayaran - Monitoring Detail Transaksi FA 16 Segmen Versi SP2D - Kosongkan Tanggal) melalui Tombol Aksi -> Import Realisasi Anggaran Monsakti'),
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
