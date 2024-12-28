<?php

namespace App\Http\Controllers;

use App\Models\DaftarReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function index(Request $request)
    {
        
        {
            // Log the incoming request for debugging purposes
            Log::info('Webhook received', [
                'method' => $request->method(),
                'data' => $request->all()
            ]);
    
            // Validate the incoming request
            $validatedData = $request->validate([
                'id' => 'required|string',
                'status' => 'required|string',
            ]);
    
            // Retrieve the validated input data
            $id = $validatedData['id'];
            $status = $validatedData['status'];
    
            // Update the status in the database
            $updated = DB::table('daftar_reminders')
                ->where('message_id', $id)
                ->update(['status' => $status]);
    
            if ($updated) {
                return response()->json(['success' => true, 'message' => 'Status updated successfully'], 200, ['Content-Type' => 'application/json; charset=utf-8']);
            } else {
                return response()->json(['error' => 'Failed to update status'], 500, ['Content-Type' => 'application/json; charset=utf-8']);
            }
        }

    }
}
