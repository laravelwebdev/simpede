<?php

namespace App\Nova\Metrics;

use DateTimeInterface;
use Fidum\LaravelNovaMetricsPolling\Concerns\SupportsPolling;
use Illuminate\Support\Facades\Cache;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;
use Spatie\Backup\BackupDestination\Backup;
use Spatie\Backup\BackupDestination\BackupDestination;
use Spatie\Backup\Helpers\Format;

class BackupsTable extends Table
{
    use SupportsPolling;

    public function name(): string
    {
        return 'Latest 3 Backups';
    }

    /**
     * Calculate the value of the metric.
     *
     * @return array<int, \Laravel\Nova\Metrics\MetricTableRow>
     */
    public function calculate(NovaRequest $request): array
    {
        $disk = config('backup.backup.destination.disks')[0] ?? 'local';
        $backupDestination = BackupDestination::create($disk, config('backup.backup.name'));
        $backups = Cache::remember("backups-{$disk}", now()->addSeconds(4), function () use ($backupDestination) {
            return $backupDestination
                ->backups()
                ->map(function (Backup $backup) {
                    $size = method_exists($backup, 'sizeInBytes') ? $backup->sizeInBytes() : $backup->size();

                    return [
                        'path' => $backup->path(),
                        'date' => $backup->date()->format('j F Y H:i:s'),
                        'size' => Format::humanReadableSize($size),
                    ];
                })
                ->toArray();
        });

        $rows = [];
        // Ambil 4 backup terbaru saja
        $latestBackups = array_slice($backups, 0, 3);
        foreach ($latestBackups as $backup) {
            $rows[] = MetricTableRow::make()
                ->icon('inbox')
                ->iconClass('text-green-500')
                ->title($backup['path'])
                ->subtitle('Created: '.$backup['date'].', Size: '.$backup['size'])
                ->actions(fn () => [
                    MenuItem::externalLink('Download', config('app.url').config('nova.path').'/backup/download'.basename($backup['path'])),
                    // MenuItem::externalLink('Create Backup', config('app.url').config('nova.path').'/backup/create'),
                    MenuItem::externalLink('Clean Backup', config('app.url').config('nova.path').'/backup/clean'),
                ]);
        }

        return $rows;
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     */
    public function cacheFor(): ?DateTimeInterface
    {
        // return now()->addMinutes(5);

        return null;
    }
}
