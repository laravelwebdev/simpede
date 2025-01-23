<?php

namespace App\Nova\Metrics;

use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;

class MetricPartition extends Partition
{
    private $model;

    private $column;

    private $key;

    private $failed;

    private $title;

    private $success;

    private $labels = [];

    public function __construct($model, $column, $key, $title = 'Status')
    {
        $this->model = $model;
        $this->column = $column;
        $this->key = $key;
        $this->title = $title;
    }

    /**
     * Calculate the value of the metric.
     */
    public function calculate(NovaRequest $request): PartitionResult
    {
        $result =  ($this->failed || $this->success)
        ? $this->count(
            $request, $this->model, $this->column, 'id'
        )
            ->colors(array_merge(
                array_fill_keys($this->failed, 'rgb(213, 86, 54)'),
                array_fill_keys($this->success, 'rgb(12, 197, 83)')
            ))
            : $this->count(
                $request, $this->model, $this->column, 'id'
            );
        return $result->label(fn ($value) => $this->labels[$value] ?? $value);
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     */
    public function cacheFor(): ?DateTimeInterface
    {
        // return now()->addMinutes(5);

        return null;
    }

    public function failedWhen(array $failed)
    {
        $this->failed = $failed;

        return $this;
    }

    public function successWhen(array $success)
    {
        $this->success = $success;

        return $this;
    }

    public function name()
    {
        return $this->title;
    }

    public function setLabel(array $labels)
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * Get the URI key for the metric.
     */
    public function uriKey(): string
    {
        return 'status-'.$this->key;
    }
}
