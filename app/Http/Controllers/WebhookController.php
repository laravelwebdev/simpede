<?php

namespace App\Http\Controllers;

use App\Models\DaftarReminder;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        
        $data = $request->all();
        if (isset($data)) {
            $id = $data['id'];
            $status = $data['status'];

            if (isset($id)) {
                DaftarReminder::where('message_id', $id)->update(['status' => $status]);
            }
        }

    }
}
