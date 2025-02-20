<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
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
        $dummyWaGroup = Cache::get('wa_group');

        try {
            $commands = [
                ['git', 'pull', 'origin', 'main'],
                [config('app.composer'), 'update', $this->option('dev') ? '' : '--no-dev'],
                [config('app.composer'), 'clear-cache']
            ];

            foreach ($commands as $command) {
                $process = new Process($command, base_path(), ['COMPOSER_HOME' => config('app.composer_home')]);
                $process->run();

                if (! $process->isSuccessful()) {
                    $error = true;
                    $this->error($process->getErrorOutput());
                    break;
                }
            }
        } finally {
            Cache::rememberForever('wa_group', fn () => $dummyWaGroup);
            $error ? $this->error('Update Gagal!') : $this->info('Update Sukses! ');
        }
    }
}
