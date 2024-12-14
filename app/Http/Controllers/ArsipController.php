<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function show($tahun = null)
    {
        $tahun = (int) $tahun;
        $tahun = $tahun ?? Date('Y') ;

        return view('arsip-dokumen', [
            'tahun' => $tahun,
        ]);
    }
}
