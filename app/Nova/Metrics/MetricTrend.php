<?php

namespace App\Nova\Metrics;

use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Metrics\TrendResult;

class MetricTrend extends Trend
{
    private $model;

    private $key;

    private $column;

    public function __construct($model, $column, $key)
    {
        $this->model = $model;
        $this->column = $column;
        $this->key = $key;
    }

    /**
     * Calculate the value of the metric.
     */
    public function calculate(NovaRequest $request): TrendResult
    {
        return $this->countByMonths($request, $this->model, $this->column);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array<int, string>
     */
    public function ranges(): array
    {
        return [
            1 => 'Bulan ini',
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

    public function name()
    {
        return 'Trend';
    }

    /**
     * Get the URI key for the metric.
     */
    public function uriKey(): string
    {
        return 'trend-'.$this->key;
    }
}
