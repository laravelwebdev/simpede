<?php

namespace App\Nova\Metrics;

use App\Helpers\GoogleDriveQuota;
use DateTimeInterface;
use Fidum\LaravelNovaMetricsPolling\Concerns\SupportsPolling;
use Illuminate\Support\Facades\Cache;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatus;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;
use Symfony\Component\Process\Process;

class ServerResource extends Partition
{
    use SupportsPolling;

    private $type;

    public function __construct($type = 'space')
    {
        $this->type = $type;
    }

    public function name()
    {
        if ($this->type === 'backup') {
            return 'Backup Disk (GB)';
        } elseif ($this->type === 'inode') {
            return 'Inode Usage';
        } else {
            return 'Disk Space (MB)';
        }
    }

    /**
     * Calculate the value of the metric.
     */
    public function calculate(NovaRequest $request): PartitionResult
    {
        $command = [];
        if ($this->type === 'backup') {
            // Get used storage from backup info
            $quota = GoogleDriveQuota::getQuota();

            $value = $quota['used'];   // dalam GB
            $total = $quota['total']; // dalam GB
        } else {
            $command = $this->type === 'inode'
            ? ['du', '--inodes', '-s']
            : ['du', '-s'];
        }
        if (! empty($command)) {
            $process = new Process($command, '/home');
            $process->run();
            $used = (int) $process->getOutput();
            $value = $this->type === 'space' ? round($used / 1024, 2) : $used;
            $total = $this->type === 'space' ? round((int) config('app.disk_space_limit') / 1024 / 1024, 2) : (int) config('app.disk_inode_limit');
        }

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

    protected function getMonitorConfig()
    {
        $reflection = new \ReflectionMethod(BackupDestinationStatusFactory::class, 'createForMonitorConfig');
        $monitorBackupsType = $reflection->getParameters()[0]->getType()->getName();

        return $monitorBackupsType === 'Spatie\Backup\Config\MonitoredBackupsConfig'
            ? \Spatie\Backup\Config\MonitoredBackupsConfig::fromArray(config('backup.monitor_backups'))
            : config('backup.monitor_backups');
    }

    protected function getBackupInfo()
    {
        return Cache::remember('backup-statuses', now()->addSeconds(4), function () {
            return BackupDestinationStatusFactory::createForMonitorConfig($this->getMonitorConfig())
                ->map(function (BackupDestinationStatus $backupDestinationStatus) {
                    return [
                        'name' => $backupDestinationStatus->backupDestination()->backupName(),
                        'disk' => $backupDestinationStatus->backupDestination()->diskName(),
                        'reachable' => $backupDestinationStatus->backupDestination()->isReachable(),
                        'healthy' => $backupDestinationStatus->isHealthy(),
                        'amount' => $backupDestinationStatus->backupDestination()->backups()->count(),
                        'newest' => $backupDestinationStatus->backupDestination()->newestBackup()
                            ? $backupDestinationStatus->backupDestination()->newestBackup()->date()->diffForHumans()
                            : __('No backups present'),
                        'usedStorage' => $backupDestinationStatus->backupDestination()->usedStorage(),
                    ];
                })
                ->values()
                ->toArray();
        });
    }

    public function help($text)
    {
        $backupInfo = $this->getBackupInfo();
        $this->helpText = $this->type === 'backup'
        ?
        'Disk: '.($backupInfo[0]['disk'] ?? 'Unknown').'<br>'
        .'Used Storage: '.(isset($backupInfo[0]['usedStorage']) ? round($backupInfo[0]['usedStorage'] / 1024 / 1024 / 1024, 2) : 0).' GB<br>'
        .'Newest Backup: '.($backupInfo[0]['newest'] ?? 'N/A').'<br>'
        : $text;

        return $this;
    }
}
