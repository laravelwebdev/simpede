<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use App\Models\DaftarKegiatan;
use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;

class Deadline extends Table
{
    public $name = 'Deadline Bulan Ini';

    /**
     * Calculate the value of the metric.
     *
     * @return array<int, \Laravel\Nova\Metrics\MetricTableRow>
     */
    public function calculate(NovaRequest $request): array
    {
        $rows = [];
        $deadlines = DaftarKegiatan::where('jenis', 'deadline')
            ->whereYear('awal', now()->year)
            ->whereMonth('awal', now()->month)
            ->orderBy('awal', 'desc')
            ->get();
        foreach ($deadlines as $deadline) {
            $rows[] = MetricTableRow::make()
                ->icon('calendar')
                ->iconClass($deadline->awal->toDateString() >= now()->toDateString() ? 'text-red-500' : 'text-green-500')
                ->subtitle($deadline->kegiatan)
                ->title(Helper::terbilangTanggal($deadline->awal));
        }

        return $rows;
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     */
    public function cacheFor(): ?DateTimeInterface
    {
        // return now()->addMinutes(5);

        return null;
    }
}
