<?php

namespace App\Http\Controllers;

use App\Helpers\Helper; // Ensure this class exists and is correctly imported

class HomeController extends Controller
{
    public function show()
    {
        return view('welcome', [
            'version' => Helper::version(),
            'satker' => 'BPS '.config('satker.kabupaten'),
        ]);
    }
}
