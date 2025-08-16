<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\BackupsTable;
use App\Nova\Metrics\IssuesTable;
use App\Nova\Metrics\OutdatedTable;
use App\Nova\Metrics\ServerResource;
use Laravel\Nova\Dashboard;
use Laravelwebdev\SystemInfo\SystemInfo;

class SystemHealth extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(): array
    {
        return [
            ServerResource::make()->refreshIntervalSeconds(60),
            ServerResource::make('inode')->refreshIntervalSeconds(60),
            ServerResource::make('backup')->help('')->refreshIntervalSeconds(60),
            SystemInfo::make()->versions()->width('1/2')->refreshIntervalSeconds(60),
            BackupsTable::make()->width('1/2')
                ->emptyText('No backups found.'),
            OutdatedTable::make()->width('1/2')
                ->emptyText('All packages are already up to date.'),
            IssuesTable::make()->width('1/2')
                ->refreshIntervalSeconds(60)
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
