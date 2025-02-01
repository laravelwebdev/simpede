<?php

namespace App\Nova\Metrics;

use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;

class DiskSpace extends Partition
{
    public function name()
    {
        return 'Disk Space (GB)';
    }

    /**
     * Calculate the value of the metric.
     */
    public function calculate(NovaRequest $request): PartitionResult
    {
        return $this->result([
            'Free' => round(disk_free_space('/') / 1024 / 1024 / 1024, 2),
            'Used' => round(disk_total_space('/') / 1024 / 1024 / 1024, 2),
        ])
            ->colors([
                'Used' => 'rgb(213, 86, 54)',
                'Free' => 'rgb(12, 197, 83)',
            ]);
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     */
    public function cacheFor(): ?DateTimeInterface
    {
        // return now()->addMinutes(5);

        return null;
    }

    /**
     * Get the URI key for the metric.
     */
    public function uriKey(): string
    {
        return 'disk-space';
    }
}
