<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use App\Models\DaftarKegiatan;
use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;

class Kegiatan extends Table
{
    protected $jenis = 'Rapat';

    public function __construct($jenis)
    {
        $this->jenis = $jenis;
    }

    public function name()
    {
        switch ($this->jenis) {
            case 'Rapat':
            return 'Rapat Mendatang';
            case 'Deadline':
            return 'Deadline Mendatang';
            case 'Libur':
            return 'Hari Libur Nasional';
            default:
            return 'Kegiatan ' . ucfirst($this->jenis);
        }
    }

    /**
     * Calculate the value of the metric.
     *
     * @return array<int, \Laravel\Nova\Metrics\MetricTableRow>
     */
    public function calculate(NovaRequest $request): array
    {
        $rows = [];
        $deadlines = DaftarKegiatan::where('jenis', $this->jenis)
            ->when($this->jenis !== 'Libur', function ($query) {
                $query->whereDate('awal', '>=', now()->toDateString());
            })
            ->orderBy('awal', 'asc')
            ->get();
        foreach ($deadlines as $deadline) {
            $rows[] = MetricTableRow::make()
                ->icon(
                    $this->jenis === 'Libur' ? 'calendar' :
                    ($this->jenis === 'Deadline' ? 'exclamation-triangle' : 'user-group')
                )
                ->iconClass(
                    $this->jenis === 'Rapat' ? 'text-green-500' :
                    ($this->jenis === 'Deadline' ? 'text-red-500' : 'text-blue-500')
                )
                ->subtitle($deadline->kegiatan)
                ->title(Helper::terbilangHari($deadline->awal).', '.Helper::terbilangTanggal($deadline->awal));
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
