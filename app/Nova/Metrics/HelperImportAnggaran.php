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
                ->subtitle('Import File Excel revisi terakhir  dari Satu DJA (Download DIPA - POK), save as dengan extensi .xlsx'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('2.Import Mata Anggaran Monsakti')
                ->subtitle('Import File CSV dari Monsakti (Anggaran - Download Data Mentah Penganggaran)'),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('3.Import Realisasi SP2D')
                ->subtitle('Import file Excel dari mon sakti (Pembayaran - Monitoring Detail Transaksi FA 16 Segmen Versi SP2D - Pilih Tanggal dari 1 Januari - 31 Desember)'),
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
