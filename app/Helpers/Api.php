<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class Api
{
    /**
     * Get outdated packages from Composer.
     *
     * @param  string  $flag
     * @return array
     */
    public static function getComposerOutdatedPackages($flag = '--no-dev')
    {
        $composer = config('app.composer');
        $home = config('app.composer_home');
        $process = Process::fromShellCommandline($composer.' outdated '.$flag.' -f json', base_path(), ['COMPOSER_HOME' => $home]);
        $process->run();
        $value = $process->getOutput();
        $data = json_decode($value, true);
        $process = Process::fromShellCommandline($composer.' clear-cache', base_path(), ['COMPOSER_HOME' => $home]);
        $process->run();

        return $data['installed'] ?? [];
    }

    public static function getGoogleDriveDownloadLink($path)
    {
        $backupPath = config('backup.backup.name')."/{$path}";
        $fileId = self::getFileIdFromPath($backupPath);

        return "https://drive.google.com/uc?export=download&id={$fileId}";
    }

    private static function getFileIdFromPath(string $path): ?string
    {
        $adapter = Storage::disk('google')->getAdapter();
        $service = $adapter->getService();

        $filename = basename($path);

        $results = $service->files->listFiles([
            'q' => "name = '{$filename}' and trashed = false",
            'fields' => 'files(id, name)',
        ]);

        foreach ($results->getFiles() as $file) {
            return $file->id;
        }

        return null;
    }
}
