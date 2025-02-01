<?php

namespace App\Nova\Metrics;

use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;

class IssuesTable extends Table
{
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function name(): string
    {
        return 'Issues' . ' (' . count($this->data) . ')';
    }
    /**
     * Calculate the value of the metric.
     *
     * @return array<int, \Laravel\Nova\Metrics\MetricTableRow>
     */
    public function calculate(NovaRequest $request): array
    {
        $rows = [];
        foreach ($this->data as $issue) {
            $rows[] = MetricTableRow::make()
            ->icon($issue['level'] === 'error' ? 'x-circle' : 'exclamation-circle')
            ->iconClass($issue['level'] === 'error' ? 'text-red-500' : 'text-yellow-500')
            ->title(ucwords($issue['type']) . ' (' . $issue['count'] . ')')
            ->subtitle($issue['title']);
        }
        return $rows;
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     */
    public function cacheFor(): DateTimeInterface|null
    {
        // return now()->addMinutes(5);

        return null;
    }
}
