<?php

namespace App\Nova\Metrics;

use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;

class MetricKeberadaan extends Partition
{
    private $model;

    private $column;

    private $key;

    public function __construct($model, $column, $key)
    {
        $this->model = $model;
        $this->column = $column;
        $this->key = $key;
    }

    /**
     * Calculate the value of the metric.
     */
    public function calculate(NovaRequest $request): PartitionResult
    {
        $results = $this->model->newQuery()
            ->selectRaw("{$this->column}, COUNT(id) as count")
            ->groupBy($this->column)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->{$this->column} > 0 ? 'Ada' : 'Tidak Ada' => $item->count];
            })->toArray();

        return $this->result($results)
            ->colors([
                'Tidak Ada' => 'rgb(213, 86, 54)',
                'Ada' => 'rgb(12, 197, 83)',
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

    public function name()
    {
        return 'Status';
    }

    /**
     * Get the URI key for the metric.
     */
    public function uriKey(): string
    {
        return 'status-'.$this->key;
    }
}
