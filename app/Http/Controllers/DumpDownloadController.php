<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DumpDownloadController extends Controller
{
    public function show( $filename, Request $request )
    {
        $path = Storage::path('public/'.$filename);
        return response()->download( $path, $filename )->deleteFileAfterSend(true);
    }
}
