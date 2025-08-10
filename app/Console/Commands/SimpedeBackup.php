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
    protected $signature = 'simpede:backup';

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
        $this->call('action-events:clear');
        $this->call('queue:clear');
        $this->call('backup:run');
        $this->call('backup:clean');
        Storage::disk('google')->getAdapter()->emptyTrash([]);
    }
}
