<?php

namespace App\Nova\Metrics;

use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Metrics\ValueResult;
use Laravel\Nova\Nova;
use Symfony\Component\Process\Process;

class Issues extends Value
{
    private $type;

    public function __construct($type = 'issues')
    {
        $this->type = $type;
    }

    public function name()
    {
        return $this->type === 'issues' ? 'Issues' : 'Outdated Packages';
    }
    /**
     * Calculate the value of the metric.
     */
    public function calculate(NovaRequest $request): ValueResult
    {
        $composer = config('app.composer');
        $home = config('app.composer_home');
        $devFlag = '--no-dev';
        $process = Process::fromShellCommandline("$composer outdated $devFlag -f json", base_path(), ['COMPOSER_HOME' => $home]);
        $process->run();
        $value = $process->getOutput();
        return $this->result($value);


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
    public function cacheFor(): DateTimeInterface|null
    {
        // return now()->addMinutes(5);

        return null;
    }
}
