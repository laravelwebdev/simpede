<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class Fonnte
{
    protected $account_token;

    // Konstanta endpoint API Fonnte
    const ENDPOINTS = [
        'send_message' => 'https://api.fonnte.com/send',
        'update_group' => 'https://api.fonnte.com/fetch-group',
        'list_group' => 'https://api.fonnte.com/get-whatsapp-group',

    ];

    public static function make()
    {
        return new static;
    }

    public function __construct()
    {
        $this->account_token = config('fonnte.token');
    }

    /**
     * Make a request to the Fonnte API.
     *
     * @param  string  $endpoint  The API endpoint to call.
     * @param  array  $params  The parameters to send with the request.
     * @return array The response from the API.
     */
    protected function makeRequest($endpoint, $params = [])
    {
        $token = $this->account_token;

        if (! $token) {
            return ['status' => false, 'error' => 'API token or device token is required.'];
        }

        // Gunakan JSON format dan pastikan Content-Type header benar
        $response = Http::withHeaders([
            'Authorization' => $token,
            'Content-Type' => 'application/json', // Tambahkan header
        ])->post($endpoint, $params);

        if ($response->failed()) {
            return [
                'status' => false,
                'error' => $response->json()['reason'] ?? 'Unknown error occurred',
            ];
        }

        return [
            'status' => true,
            'data' => $response->json(),
        ];
    }

    /**
     * Send a WhatsApp message using the Fonnte API.
     *
     * @param  string  $phoneNumber  The phone number to send the message to.
     * @param  string  $message  The message to send.
     * @return array The response from the API.
     */
    public function sendWhatsAppMessage($phoneNumber, $message)
    {
        return $this->makeRequest(self::ENDPOINTS['send_message'], [
            'target' => $phoneNumber,
            'message' => $message,
        ]);
    }

    /**
     * Update the WhatsApp group list using the Fonnte API.
     *
     * @return array The response from the API.
     */
    public function updateWhatsappGroupList()
    {
        return $this->makeRequest(self::ENDPOINTS['update_group']);
    }

    /**
     * Get the WhatsApp group list using the Fonnte API.
     *
     * @return array The response from the API.
     */
    public function getWhatsappGroupList()
    {
        return $this->makeRequest(self::ENDPOINTS['list_group']);
    }
}
