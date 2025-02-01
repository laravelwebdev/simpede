<?php

namespace App\Nova\Dashboards;

use App\Helpers\Api;
use App\Nova\Metrics\Issues;
use App\Nova\Metrics\IssuesTable;
use App\Nova\Metrics\OutdatedTable;
use App\Nova\Metrics\ServerResource;
use Laravel\Nova\Dashboard;
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
        $sentryIssues = Api::getSentryUnreolvedIssues();
        $outdatedPackages = Api::getComposerOutdatedPackages();

        return [
            ServerResource::make(),
            ServerResource::make('inode'),
            Issues::make(count($sentryIssues)),
            Welcome::make()
                ->title('Packages and Issues'),
            OutdatedTable::make($outdatedPackages)->width('1/2')
                ->emptyText('All packages is up to date.'),
            IssuesTable::make($sentryIssues)->width('1/2')
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
