<?php

namespace App\Http\Controllers;

use App\Models\DaftarReminder;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (isset($data)) {
            $id = $data['id'];
            $status = $data['status'];

            if (isset($id)) {
                DaftarReminder::where('message_id', $id)->update(['status' => $status]);
            }
        }
        return $request->header('Content-Type: application/json; charset=utf-8');

    }
}
