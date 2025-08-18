<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\BackupsTable;
use App\Nova\Metrics\IssuesTable;
use App\Nova\Metrics\OutdatedTable;
use App\Nova\Metrics\ServerResource;
use App\Nova\Metrics\SystemInfo;
use Laravel\Nova\Dashboard;

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
            SystemInfo::make()->width('1/2')->refreshIntervalSeconds(60)->scrollable(),
            BackupsTable::make()->width('1/2')
                ->emptyText('No backups found.')
                ->scrollable()
                ->refreshIntervalSeconds(60),
            OutdatedTable::make()->width('1/2')
                ->scrollable()
                ->emptyText('All packages are already up to date.'),
            IssuesTable::make()->width('1/2')
                ->refreshIntervalSeconds(60)
                ->scrollable()
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
