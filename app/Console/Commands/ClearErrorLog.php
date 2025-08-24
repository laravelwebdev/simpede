<?php

namespace App\Console\Commands;

use App\Models\ErrorLog;
use Illuminate\Console\Command;

class ClearErrorLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simpede:clear-error-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the error log';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ErrorLog::where('resolved', true)->delete();
        $this->info('Error log cleared successfully.');
    }
}
