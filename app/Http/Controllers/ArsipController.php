<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function show(string $tahun = Date('Y'))
    {
        $tahun = (int) $tahun;
        $tahun = $tahun < 2000 ? Date('Y') : $tahun;

        return view('arsip-dokumen', [
            'tahun' => $tahun,
            'files' => $this->getFiles($tahun),
        ]);
    }
}
