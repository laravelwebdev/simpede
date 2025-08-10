<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class SimpedeUpdater
{
    public static function update($option = null): bool
    {
        $error = false;
        try {
            Artisan::call('maintenance', ['action' => 'start']);
            $process = new Process(['git', 'pull', 'origin', 'main']);
            $process->run();
            if (! $process->isSuccessful()) {
                $error = true;
            }

            $composer = config('app.composer');
            $home = config('app.composer_home');
            $devFlag = $option ? '' : '--no-dev';
            $process = Process::fromShellCommandline("$composer update $devFlag", base_path(), ['COMPOSER_HOME' => $home]);
            $process->run();
            if (! $process->isSuccessful()) {
                $error = true;
            }

            $process = Process::fromShellCommandline("$composer clear-cache", base_path(), ['COMPOSER_HOME' => $home]);
            $process->run();
            if (! $process->isSuccessful()) {
                $error = true;
            }
        } finally {
            Artisan::call('maintenance', ['action' => 'stop']);
            Artisan::call('optimize:clear');
            Artisan::call('optimize');
            Artisan::call('simpede:cache');
            if (! is_link(public_path('storage'))) {
                Artisan::call('storage:link');
            }

        }

        return ! $error;
    }
}
