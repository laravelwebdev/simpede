<?php

namespace App\Http\Controllers;

use Yaza\LaravelGoogleDriveStorage\Gdrive;

class BackupActions extends Controller
{
    public function downloadBackup(string $filename)
    {
        $backupPath = config('backup.backup.name')."/{$filename}";
        if (! Gdrive::exists($backupPath)) {
            abort(404, 'Backup file not found.');
        }
        $data = Gdrive::get($backupPath);

        return response($data->file, 200)
            ->header('Content-Type', $data->ext)
            ->header('Content-disposition', 'attachment; filename="'.$data->filename.'"');
    }
}
