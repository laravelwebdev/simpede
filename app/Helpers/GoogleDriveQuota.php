<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class GoogleDriveQuota
{
    public static function getQuota(): array
    {
        $clientId = config('app.google.client_id');
        $clientSecret = config('app.google.client_secret');
        $refreshToken = config('app.google.refresh_token');

        $used = 0;
        $total = 0;

        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'refresh_token' => $refreshToken,
            'grant_type' => 'refresh_token',
        ]);

        if ($response->ok()) {
            $accessToken = $response->json()['access_token'] ?? null;
            if ($accessToken) {
                $about = Http::withToken($accessToken)
                    ->get('https://www.googleapis.com/drive/v3/about?fields=storageQuota')
                    ->json();

                $limit = $about['storageQuota']['limit'] ?? 0;
                $usage = $about['storageQuota']['usage'] ?? 0;

                $total = $limit ? round($limit / (1024 ** 3), 2) : 0;
                $used = $usage ? round($usage / (1024 ** 3), 2) : 0;
            }
        }

        return [
            'used' => $used,
            'total' => $total,
        ];
    }
}
