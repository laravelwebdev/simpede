<?php

namespace App\Http\Controllers;

use App\Models\DaftarReminder;
use Illuminate\Support\Facades\Storage;

class WebhookController extends Controller
{

    public function handle()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $id = $data['id'];
        $status = $data['status'];    
    
        if (isset($id)) {
            DaftarReminder::where('message_id', $id)->update(['status' => $status]);
        }
    }
}
