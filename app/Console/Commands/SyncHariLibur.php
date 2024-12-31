<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use Illuminate\Console\Command;

class SyncHariLibur extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holidays:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CSync Indonesian Holidays to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Helper::syncHariLibur(date('Y'));
        $this->info('Holidays synced successfully.');
    }
}
