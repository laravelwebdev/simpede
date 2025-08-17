<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
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
        dispatch(function () {
            Artisan::call('simpede:backup clean');
        })->name('Clean Backup');

        return redirect()->back()->with('status', 'Backup cleaning processed in background.');
    }

    public function createBackup()
    {
        dispatch(function () {
            Artisan::call('simpede:backup create');
        })->name('Create Backup');

        return redirect()->back()->with('status', 'Backup creation processed in background.');
    }
}
