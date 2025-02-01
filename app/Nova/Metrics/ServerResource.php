<?php

namespace App\Nova\Metrics;

use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;
use Symfony\Component\Process\Process;

class ServerResource extends Partition
{
    private $type;

    public function __construct($type = 'space')
    {
        $this->type = $type;
    }

    public function name()
    {
        return $this->type === 'space' ? 'Disk Space (GB)' : 'Inode Usage';
    }

    /**
     * Calculate the value of the metric.
     */
    public function calculate(NovaRequest $request): PartitionResult
    {
        $process = new Process($this->type === 'space' ? ['du', '-s'] : ['du', '--inodes', '-s']);
        $process->run();
        $used = (int) $process->getOutput();
        $value = $this->type === 'space' ? round($used / 1024, 2) : $used;
        $total = $this->type === 'space' ? round((int) config('app.disk_space_limit') / 1024 / 1024 / 1024, 2) : (int) config('app.disk_inode_limit');

        return $this->result([
            'Used' => $value,
            'Free' => $total - $value,
        ])
            ->colors([
                'Used' => 'rgb(213, 86, 54)',
                'Free' => 'rgb(12, 197, 83)',
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

    /**
     * Get the URI key for the metric.
     */
    public function uriKey(): string
    {
        return 'disk-space_'.$this->type;
    }
}
