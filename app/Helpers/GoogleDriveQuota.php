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

        // Step 1: Refresh token -> Access token
        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'refresh_token' => $refreshToken,
            'grant_type' => 'refresh_token',
        ]);

        if ($response->failed()) {
            return [
                'used_gb' => null,
                'total_gb' => null,
                'error' => $response->json(),
            ];
        }

        $accessToken = $response->json()['access_token'];

        // Step 2: Get storage info
        $about = Http::withToken($accessToken)
            ->get('https://www.googleapis.com/drive/v3/about?fields=storageQuota')
            ->json();

        $limit = $about['storageQuota']['limit'] ?? 0;
        $usage = $about['storageQuota']['usage'] ?? 0;

        // Convert bytes to GB
        $limitGb = $limit ? round($limit / (1024 ** 3), 2) : 0;
        $usageGb = $usage ? round($usage / (1024 ** 3), 2) : 0;

        return [
            'used' => $usageGb,
            'total' => $limitGb,
        ];
    }
}
