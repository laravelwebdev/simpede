<?php

namespace App\Nova\Metrics;

use App\Helpers\Api;
use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;

class OutdatedTable extends Table
{
    /**
     * Calculate the value of the metric.
     *
     * @return array<int, \Laravel\Nova\Metrics\MetricTableRow>
     */
    public function calculate(NovaRequest $request): array
    {
        $rows = [];
        foreach (Api::getComposerOutdatedPackages() as $package) {
            $rows[] = MetricTableRow::make()
                ->icon('exclamation-circle')
                ->iconClass('text-yellow-500')
                ->title($package['name'])
                ->subtitle('Installed: '.$package['version'].' | Latest: '.$package['latest']);
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
