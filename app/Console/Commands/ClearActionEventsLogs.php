<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearActionEventsLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'action-events:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Finished Action Events Logs form database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('action_events')
            ->where('status', 'finished')
            ->delete();
    }
}
