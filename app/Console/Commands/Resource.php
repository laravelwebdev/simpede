<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Resource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resource {modelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Model, Migration, Policy and Nova Resource';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelNama = $this->argument('modelName');

        $this->call('make:model', ['name' => $modelNama, '-m' => true]);
        $this->call('make:policy', ['name' => $modelNama.'Policy']);
        $this->call('nova:resource', ['name' => $modelNama]);
    }
}
