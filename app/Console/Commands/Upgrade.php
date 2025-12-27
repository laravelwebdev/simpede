<?php

namespace App\Console\Commands;

use App\Models\KerangkaAcuan;
use Illuminate\Console\Command;

class Upgrade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simpede:upgrade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upgrade the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (KerangkaAcuan::whereNull('id_link')->pluck('id') as $id) {
            KerangkaAcuan::where('id', $id)->update(['id_link' => md5(uniqid())]);
        }
        $this->info('Upgrade completed successfully.');
    }
}
