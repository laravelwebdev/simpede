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
        $this->info('Melakukan Pembaharuan Alikasi... Silakan Tunggu');
        $messages = SimpedeUpdater::getOutput($this->option('dev'));
        $status = null;
        foreach ($messages as $key => $message) {
            if ($key === 'success') {
                $status = $message;

                continue;
            }
            if ($message !== null && $message !== '' && $key !== 'success') {
                $this->line($message);
            }
        }
        $status ? $this->info('UPDATE SUKSES.') :
                  $this->error('UPDATE GAGAL.');
    }
}
