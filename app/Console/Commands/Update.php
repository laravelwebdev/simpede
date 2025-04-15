<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simpede:update {--dev : Include dev dependencies}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $error = false;
        try {
            $this->call('maintenance', ['start']);
            $process = new Process(['git', 'pull', 'origin', 'main']);
            $process->run();
            if (! $process->isSuccessful()) {
                $error = true;
            }

            $composer = config('app.composer');
            $home = config('app.composer_home');
            $devFlag = $this->option('dev') ? '' : '--no-dev';
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
            $error ? $this->error('Update Gagal!') : $this->info('Update Sukses! ');
            $this->call('maintenance', ['stop']);
        }
    }
}
