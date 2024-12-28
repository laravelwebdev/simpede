<?php

namespace App\Http\Controllers;

use App\Models\DaftarReminder;

class WebhookController extends Controller
{
    public function handle()
    {
        header('Content-Type: application/json; charset=utf-8');
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (isset($data)) {
            $id = $data['id'];
            $status = $data['status'];

            if (isset($id)) {
                DaftarReminder::where('message_id', $id)->update(['status' => $status]);
            }
        }

    }
}
