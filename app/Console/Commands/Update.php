<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update {--composer=composer}';

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
        exec('git pull origin main', $output, $return_var);        
        $composer = $this->option('composer');
        exec("$composer update --no-dev", $output, $return_var);        
    }
}
