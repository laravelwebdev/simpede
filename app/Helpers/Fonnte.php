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
        if (! $this->account_token) {
            return ['status' => false, 'error' => 'API token is required.'];
        }

        $response = Http::withHeaders([
            'Authorization' => $this->account_token,
            'Content-Type' => 'application/json',
        ])->post($endpoint, $params);

        $body = $response->json();

        if (! ($body['status'] ?? false)) {
            return [
                'status' => false,
                'error' => $body['reason'] ?? 'Unknown error',
                'data' => $body,
            ];
        }

        return [
            'status' => true,
            'data' => $body,
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
