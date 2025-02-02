<?php

namespace App\Nova\Metrics;

use App\Helpers\Api;
use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Metrics\ValueResult;

class Issues extends Value
{
    /**
     * Calculate the value of the metric.
     */
    public function calculate(NovaRequest $request): ValueResult
    {
        $sentryIssues = Api::getSentryUnreolvedIssues(adsasds);

        return $this->result(count($sentryIssues));
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array<int|string, string>
     */
    public function ranges(): array
    {
        return [];
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
        return 'issues';
    }
}
