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

    private $title;

    private $adaLabel = 'Ada';

    private $tidakAdaLabel = 'Tidak';

    public function __construct($title, $model, $column, $key)
    {
        $this->title = $title;
        $this->model = $model;
        $this->column = $column;
        $this->key = $key;
    }

    public function setAdaLabel($label)
    {
        $this->adaLabel = $label;

        return $this;
    }

    public function setTidakAdaLabel($label)
    {
        $this->tidakAdaLabel = $label;

        return $this;
    }

    /**
     * Calculate the value of the metric.
     */
    public function calculate(NovaRequest $request): PartitionResult
    {
        $results = $this->model->newQuery()
            ->selectRaw("SUM(CASE WHEN {$this->column} IS NOT NULL THEN 1 ELSE 0 END) as {$this->adaLabel}, SUM(CASE WHEN {$this->column} IS NULL THEN 1 ELSE 0 END) as {$this->tidakAdaLabel}")
            ->get()
            ->toArray();

        return $this->result($results[0])
            ->colors([
                'Tidak' => 'rgb(213, 86, 54)',
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
        return $this->title;
    }

    /**
     * Get the URI key for the metric.
     */
    public function uriKey(): string
    {
        return 'status-'.$this->key;
    }
}
