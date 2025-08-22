<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanTemp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simpede:clean-temp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean temporary files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folderPath = storage_path('app/filepond/temp');

        // Hapus semua isi folder (file dan subfolder)
        File::deleteDirectory($folderPath);

        $this->info("Temporary files in '{$folderPath}' cleaned successfully.");
    }
}
