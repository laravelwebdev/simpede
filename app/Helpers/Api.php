<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class Api
{
    /**
     * Get unresolved issues from Sentry.
     *
     * @return array
     */
    public static function getSentryUnresolvedIssues()
    {
        $organization = config('app.sentry_organization');
        $project = config('app.sentry_project');
        $token = config('app.sentry_token');

        $client = new Client;
        try {
            $response = $client->request('GET', 'https://sentry.io/api/0/projects/'.$organization.'/'.$project.'/issues/', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                ],
                'query' => [
                    'query' => 'is:unresolved',
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            return [];
        }
    }

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
