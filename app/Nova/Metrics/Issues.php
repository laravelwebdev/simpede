<?php

namespace App\Nova\Metrics;

use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Metrics\ValueResult;
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
        if ($this->type === 'outdated') {
            $composer = config('app.composer');
            $home = config('app.composer_home');
            $devFlag = '--no-dev';
            $process = Process::fromShellCommandline("$composer outdated $devFlag -f json", base_path(), ['COMPOSER_HOME' => $home]);
            $process->run();
            $value = $process->getOutput();
            $data = json_decode($value, true);
            $count = count($data['installed'] ?? []);
            $process = Process::fromShellCommandline("$composer clear-cache", base_path(), ['COMPOSER_HOME' => $home]);
            $process->run();
        } else {
            //
            $organization = config('app.sentry_organization');
            $project = config('app.sentry_project');
            $token = config('app.sentry_token');

            $client = new \GuzzleHttp\Client;
            $response = $client->request('GET', "https://sentry.io/api/0/projects/$organization/$project/issues/", [
                'headers' => [
                    'Authorization' => "Bearer $token",
                ],
                'query' => [
                    'query' => 'is:unresolved',
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            $count = count($data);
        }

        return $this->result($count);
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
        return 'issues_'.$this->type;
    }
}
