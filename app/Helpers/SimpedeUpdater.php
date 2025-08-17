<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class SimpedeUpdater
{
    public static function run($option = null): array
    {
        $error = false;
        try {
            $output = [];

            // Start maintenance mode
            Artisan::call('maintenance', ['action' => 'start']);
            $output['maintenance_start_output'] = Artisan::output();

            // Git pull
            $process = new Process(['git', 'pull', 'origin', 'main']);
            $process->run();
            $output['git_pull'] = $process->getOutput();
            if (! $process->isSuccessful()) {
                $error = true;
            }

            // Composer update
            $composer = config('app.composer');
            $home = config('app.composer_home');
            $devFlag = $option ? '' : '--no-dev';
            $process = Process::fromShellCommandline("$composer update $devFlag", base_path(), ['COMPOSER_HOME' => $home]);
            $process->run();
            $output['composer_update'] = $process->getErrorOutput();
            if (! $process->isSuccessful()) {
                $error = true;
            }

            // Composer clear-cache
            $process = Process::fromShellCommandline("$composer clear-cache", base_path(), ['COMPOSER_HOME' => $home]);
            $process->run();
            $output['composer_clear_cache'] = $process->getErrorOutput();
            if (! $process->isSuccessful()) {
                $error = true;
            }
        } finally {
            // Stop maintenance mode
            Artisan::call('maintenance', ['action' => 'stop']);
            $output['maintenance_stop_output'] = Artisan::output();

            // Optimize clear
            Artisan::call('optimize:clear');
            $output['optimize_clear_output'] = Artisan::output();

            // Optimize
            Artisan::call('optimize');
            $output['optimize_output'] = Artisan::output();

            // Simpede cache
            Artisan::call('simpede:cache');
            $output['simpede_cache_output'] = Artisan::output();

            // Storage link
    
            Artisan::call('storage:link');
            $output['storage_link_output'] = Artisan::output();
 
            $output['success'] = ! $error;
        }

        // You can log or return $output as needed

        return $output;
    }

    public static function update($option = null): bool
    {
        return self::run($option)['success'];
    }

    public static function getOutput($option = null): array
    {
        return self::run($option);
    }
}
