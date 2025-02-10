<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class DumpDownloadController extends Controller
{
    private const STORAGE_PATH = 'public/.temp/';

    public function __invoke(string $filename)
    {
        $path = Storage::path(self::STORAGE_PATH.$filename);

        if (! Storage::exists(self::STORAGE_PATH.$filename)) {
            abort(404, 'File not found.');
        }

        return response()->download($path, $filename)->deleteFileAfterSend(true);
    }
}
