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
        $process = new Process(['git', 'pull', 'origin', 'main']);
        $process->run();

        $this->info($process->getOutput());

        $composer = config('app.composer');
        $devFlag = $this->option('dev') ? '' : '--no-dev';
        $process = new Process(['composer2 update']);
        $process->run();

        $this->info($process->getOutput());
    }
}
