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
    public $name = 'Deadline Mendatang';

    /**
     * Calculate the value of the metric.
     *
     * @return array<int, \Laravel\Nova\Metrics\MetricTableRow>
     */
    public function calculate(NovaRequest $request): array
    {
        $rows = [];
        $deadlines = DaftarKegiatan::where('jenis', 'deadline')
            ->whereDate('awal', '>=', now()->toDateString())
            ->orderBy('awal', 'asc')
            ->get();
        foreach ($deadlines as $deadline) {
            $rows[] = MetricTableRow::make()
                ->icon('calendar')
                ->iconClass('text-red-500')
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
