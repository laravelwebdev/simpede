<?php

namespace App\Nova\Dashboards;

use App\Helpers\Api;
use App\Nova\Metrics\ServerResource;
use Illuminate\Support\Facades\Cache;
use Laravel\Nova\Dashboard;
use Laravelwebdev\ListCard\ListCard;
use Laravelwebdev\SystemInfo\SystemInfo;
use Spatie\Backup\BackupDestination\Backup;
use Spatie\Backup\BackupDestination\BackupDestination;
use Spatie\Backup\Helpers\Format;

class SystemHealth extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(): array
    {
        $outdated = array_map(fn ($package) => [
            'title' => $package['name'],
            'description' => 'Installed: '.$package['version'].' | Latest: '.$package['latest'],
        ], Api::getComposerOutdatedPackages());

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

        $backuplist = array_map(function ($backup) {
            return [
                'title' => $backup['path'],
                'description' => 'Created: '.$backup['date'].', Size: '.$backup['size'],
                'icon' => 'arrow-down',
                'url' => config('app.url').config('nova.path').'/backup/download/'.basename($backup['path']),
            ];
        }, $backups);

        $issues = array_map(function ($issue) {
            return [
                'title' => ucwords($issue['type']).' ('.$issue['count'].')',
                'description' => $issue['title'],
            ];
        }, Api::getSentryUnresolvedIssues());

        return [
            ServerResource::make()->refreshIntervalSeconds(60),
            ServerResource::make('inode')->refreshIntervalSeconds(60),
            ServerResource::make('backup')->help('')->refreshIntervalSeconds(60),
            SystemInfo::make()->versions()->width('1/2'),
            ListCard::make()
                ->width('1/2')
                ->title('Backups')
                ->items($backuplist)
                ->emptyText('No Backup Found'),
            ListCard::make()
                ->width('1/2')
                ->title('Outdated Packages')
                ->items($outdated)
                ->emptyText('All packages are already up to date.'),
            ListCard::make()
                ->width('1/2')
                ->title('Unresolved Issues')
                ->items($issues)
                ->emptyText('No issues found.'),
        ];
    }

    /**
     * Get the URI key for the dashboard.
     */
    public function uriKey(): string
    {
        return 'system-health';
    }
}
