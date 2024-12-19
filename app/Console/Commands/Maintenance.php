<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Maintenance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintenance {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage the application maintenance mode';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');

        if ($action === 'start') {
            $this->call('down', [
                '--render' => 'maintenance',
            ]);
            $this->info('Application is now in maintenance mode.');
        } elseif ($action === 'stop') {
            $this->call('up');
            $this->info('Application is now live.');
        } else {
            $this->error('Invalid action. Use "start" or "stop".');
        }
    }
}
