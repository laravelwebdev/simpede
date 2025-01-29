<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

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
        $process = Process::exec("top -bn1 | grep -E '^(%Cpu|CPU)' | awk '{ print $2 + $4 }'");
        $process->run();
        if (! $process->isSuccessful()) {
            $this->error($process->getErrorOutput());

            return 1; // Return non-zero exit code to indicate failure
        }
        

    }
}
