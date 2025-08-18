<?php

namespace App\Nova\Metrics;

use DateTimeInterface;
use Fidum\LaravelNovaMetricsPolling\Concerns\SupportsPolling;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;
use Laravel\Nova\Nova;

use function Illuminate\Filesystem\join_paths;

class SystemInfo extends Table
{
    use SupportsPolling;

    /**
     * Calculate the value of the metric.
     *
     * @return array<int, \Laravel\Nova\Metrics\MetricTableRow>
     */
    public function calculate(NovaRequest $request): array
    {
        return [
            MetricTableRow::make()
                ->icon('computer-desktop')
                ->iconClass('text-green-500')
                ->title('Operating System')
                ->subtitle(php_uname('s').' ('.php_uname('r').' - '.php_uname('v').')'),
            MetricTableRow::make()
                ->icon('cpu-chip')
                ->iconClass('text-green-500')
                ->title('PHP Version')
                ->subtitle(phpversion()),
            MetricTableRow::make()
                ->icon('circle-stack')
                ->iconClass('text-green-500')
                ->title('Database')
                ->subtitle($this->getDatabase()),
            MetricTableRow::make()
                ->icon('command-line')
                ->iconClass('text-green-500')
                ->title('Laravel Version')
                ->subtitle(app()->version()),
            MetricTableRow::make()
                ->icon('command-line')
                ->iconClass('text-green-500')
                ->title('Nova Version')
                ->subtitle(Nova::version()),
            MetricTableRow::make()
                ->icon('command-line')
                ->iconClass('text-green-500')
                ->title('Application Version')
                ->subtitle($this->version()),
        ];
    }

    private function getDatabase()
    {
        $knownDatabases = [
            'sqlite',
            'mysql',
            'mariadb',
            'pgsql',
            'sqlsrv',
        ];

        if (! in_array(config('database.default'), $knownDatabases)) {
            return 'Unkown';
        }

        $results = DB::select('select version() as version');

        return $results[0]->version;
    }

    private function version(): string
    {
        return once(function () {
            $manifest = File::json((string) realpath(join_paths(__DIR__, '../../..', 'composer.json')));

            $version = $manifest['version'] ?? 'Unkown';

            return $version;
        });
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
