<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Symfony\Component\Process\Process;

class Api
{
    protected static $process;

    public static function getSentryUnreolvedIssues()
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

    public static function getComposerOutdatedPackages($flag = '--no-dev')
    {
        $composer = config('app.composer');
        $home = config('app.composer_home');
        self::$process = new Process([], base_path(), ['COMPOSER_HOME' => $home]);

        try {
            self::$process->setCommandLine($composer.' outdated {flag} -f json');
            self::$process->run();
            $value = self::$process->getOutput();
            $data = json_decode($value, true);

            self::$process->setCommandLine($composer.' clear-cache');
            self::$process->run();

            return $data['installed'] ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }
}
