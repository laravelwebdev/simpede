<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('welcome', [
            'version' => Helper::version(),
            'satker' => 'BPS '.config('satker.kabupaten'),
        ]);
    }
}
