<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\Issues;
use App\Nova\Metrics\IssuesTable;
use App\Nova\Metrics\OutdatedTable;
use App\Nova\Metrics\ServerResource;
use Laravel\Nova\Dashboard;
use Laravelwebdev\SystemInfo\SystemInfo;
use Laravelwebdev\Welcome\Welcome;

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
            ServerResource::make(),
            ServerResource::make('inode'),
            Issues::make(),
            SystemInfo::make()->versions(),
            OutdatedTable::make()->width('1/2')
                ->emptyText('All packages are already up to date.'),
            IssuesTable::make()->width('1/2')
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
