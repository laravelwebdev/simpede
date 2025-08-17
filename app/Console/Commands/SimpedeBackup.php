<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SimpedeBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simpede:backup {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup Application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');

        if ($action === 'create') {
            $this->call('action-events:clear');
            $this->call('backup:run');
            $this->call('backup:clean');
            Storage::disk('google')->getAdapter()->emptyTrash([]);
        } elseif ($action === 'clean') {
            $this->call('backup:clean');
            Storage::disk('google')->getAdapter()->emptyTrash([]);
        } else {
            $this->error('Invalid action. Use "create" or "clean".');
        }
    }
}
