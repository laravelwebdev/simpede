<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use App\Models\PerjanjianKinerja;
use DateTimeInterface;
use Illuminate\Support\Facades\DB;
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

    private $null_strict = true;

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

    public function nullStrict(bool $value)
    {
        $this->null_strict = $value;

        return $this;
    }

    /**
     * Calculate the value of the metric.
     */
    public function calculate(NovaRequest $request): PartitionResult
    {
        if (is_null($this->model)) {
            $triwulan = Helper::parseFilter($request->query->get('filter'), \App\Nova\Filters\TriwulanFilter::class, '1') ?: (string) now()->quarter;
            $this->model = Helper::modelQuery(PerjanjianKinerja::query(), $triwulan);
        }
        $table = $this->model->newQuery();
        $results = DB::query()
            ->selectRaw(
                $this->null_strict ?
                "SUM(CASE WHEN {$this->column} IS NOT NULL AND {$this->column} != '[]' THEN 1 ELSE 0 END) as ada, SUM(CASE WHEN {$this->column} IS NULL OR {$this->column} = '[]' THEN 1 ELSE 0 END) as tidak" :
                "SUM(CASE WHEN {$this->column} > 0 THEN 1 ELSE 0 END) as ada, SUM(CASE WHEN {$this->column} <= 0 THEN 1 ELSE 0 END) as tidak"
            )
            ->fromSub($table, 'sub')
            ->get()
            ->toArray();

        return $this->result((array) $results[0])
            ->label(fn ($value) => match ($value) {
                'ada' => $this->adaLabel,
                'tidak' => $this->tidakAdaLabel
            })
            ->colors([
                'tidak' => 'rgb(213, 86, 54)',
                'ada' => 'rgb(12, 197, 83)',
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
