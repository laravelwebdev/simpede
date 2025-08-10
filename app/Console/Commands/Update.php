<?php

namespace App\Console\Commands;

use App\Helpers\SimpedeUpdater;
use Illuminate\Console\Command;

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
        $success = SimpedeUpdater::update($this->option('dev'));
        $success ? $this->info('Update Sukses') : $this->error('Update Gagal');

    }
}
