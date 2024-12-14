<?php

namespace App\Http\Controllers;

use App\Models\Dipa;
use Illuminate\Support\Facades\DB;

class ArsipController extends Controller
{
    public function perKro($tahun = null)
    {
        $tahun = (int) $tahun;
        $tahun = $tahun == 0 ? date('Y') : $tahun;
        $dipa = Dipa::where('tahun', $tahun)->first();
        
        $data = !empty($dipa) ? DB::table('mata_anggarans')
            ->selectRaw('DISTINCT MID(mak,11,8) as KRO')
            ->where('dipa_id', $dipa->id)->get() : [];

        return view('arsip-per-kro', [
            'tahun' => $tahun,
            'data' => $data,
        ]);
    }
}
