<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\SusenasSetting;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function home()
    {
        return view('welcome', [
            'version' => Helper::version(),
            'satker' => 'BPS '.config('satker.kabupaten'),
        ]);
    }

    public function isusenas()
    {
        $apk_file = optional(SusenasSetting::first())->apk_file;

        return view('isusenas', [
            'version' => Helper::version(),
            'satker' => 'BPS '.config('satker.kabupaten'),
            'apkUrl' => Storage::disk('susenas')->url($apk_file),
        ]);
    }
}
