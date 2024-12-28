<?php

namespace App\Http\Controllers;

use App\Models\DaftarReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        
        $id = $request->input('id');
        $status = $request->input('status');

        // Update the status in the database
        $updated = DB::table('daftar_reminders')
            ->where('message_id', $id)
            ->update(['status' => $status]);

    }
}
