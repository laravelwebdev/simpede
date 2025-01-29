<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $process = Process::fromShellCommandline("php artisan pulse:check");
        $process->run();
        if (! $process->isSuccessful()) {
            $this->error($process->getErrorOutput());

            return 1; // Return non-zero exit code to indicate failure
        }
        $this->info($process->getOutput());

    }
}
