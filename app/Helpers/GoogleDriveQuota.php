<?php

namespace App\Helpers;

use Google\Client;
use Google\Service\Drive;

class GoogleDriveQuota
{
    public static function getQuota(): array
    {
        $client = new Client();
        $client->setClientId(config('app.google.client_id'));
        $client->setClientSecret(config('app.google.client_secret'));
        $client->setRedirectUri(env('APP_URL') . '/google/oauth/callback');
        $client->setAccessType('offline');
        $client->setScopes(['https://www.googleapis.com/auth/drive.metadata.readonly']);

        // refresh token -> access token
        $refreshToken = config('app.google.refresh_token');
        $accessToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
        $client->setAccessToken($accessToken);

        $service = new Drive($client);
        $about = $service->about->get(['fields' => 'storageQuota']);
        $q = $about->getStorageQuota();

        $limit = $q->getLimit();   // total bytes
        $usage = $q->getUsage();   // used bytes

        return [
            'used'  => self::toGB($usage),
            'total' => self::toGB($limit),
        ];
    }

    private static function toGB($bytes): ?float
    {
        if ($bytes === null) return null;
        return round($bytes / (1024 ** 3), 2); // convert to GB (2 decimal)
    }
}
