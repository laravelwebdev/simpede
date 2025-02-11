<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class DumpDownloadController extends Controller
{
    public function __invoke(string $filename)
    {
        $path = Storage::disk('public')->path(config('app.download_temp').'/'.$filename);

        if (! Storage::disk('public')->path(config('app.download_temp').'/'.$filename)) {
            abort(404, 'File not found.');
        }

        return response()->download($path, $filename)->deleteFileAfterSend(true);
    }
}
