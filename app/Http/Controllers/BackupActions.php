<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class BackupActions extends Controller
{
    public function downloadBackup(string $filename)
    {
        $backupPath = config('backup.backup.name')."/{$filename}";

        $readStream = Gdrive::readStream($backupPath);

        return response()->stream(function () use ($readStream) {
            fpassthru($readStream->file);
        }, 200, [
            'Content-Type' => $readStream->ext,
            'Content-disposition' => 'attachment; filename="'.$filename.'"', // force download?
        ]);
    }

    public function cleanBackup()
    {
        Artisan::call('backup:clean');
        Storage::disk('google')->getAdapter()->emptyTrash([]);

        return redirect()->back()->with('status', 'Backup cleaned successfully.');
    }

    public function createBackup()
    {
        Artisan::call('simpede:backup');

        return redirect()->back()->with('status', 'Backup created successfully.');
    }
}
