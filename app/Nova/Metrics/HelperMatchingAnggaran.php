<?php

namespace App\Nova\Metrics;

use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;

class HelperMatchingAnggaran extends Table
{
    public function name()
    {
        return 'Petunjuk Matching Anggaran';
    }

    /**
     * Calculate the value of the metric.
     *
     * @return array<int, \Laravel\Nova\Metrics\MetricTableRow>
     */
    public function calculate(NovaRequest $request): array
    {
        return [
            MetricTableRow::make()
                ->icon('information-circle')
                ->iconClass('text-green-500')
                ->title('Tujuan')
                ->subtitle('Tujuan melakukan matching anggaran adalah untuk mengganti anggaran yang belum ada di POK yang telah ditambahkan sebelumnya dengan anggaran yang ada di POK hasil revisi.'),
            MetricTableRow::make()
                ->icon('x-circle')
                ->iconClass('text-red-700')
                ->title('Warning')
                ->subtitle('Matching anggaran hanya dapat dilakukan sekali dalam satu akun dan tidak dapat dimatching ulang jika terjadi kesalahan. Pastikan untuk memilih anggaran yang benar-benar sesuai.'),
        ];
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
