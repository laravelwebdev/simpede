<?php

namespace App\Http\Controllers;

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
}
