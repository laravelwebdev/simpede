<?php

namespace App\Console\Commands;

use App\Helpers\Composer;
use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
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

        // Update composer dependencies
        // $composer = config('app.composer');
        // $devFlag = $this->option('dev') ? '' : '--no-dev';
        // shell_exec('composer2 update');
        $process = Process::fromShellCommandline("composer2 update --no-dev", base_path(), env : ['COMPOSER_HOME' => '$HOME/.cache/composer']);
        $process->run();
        if (!$process->isSuccessful()) {
            $this->error($process->getErrorOutput());
            return 1; // Return non-zero exit code to indicate failure
        }
        $this->info($process->getOutput());
    }
}
