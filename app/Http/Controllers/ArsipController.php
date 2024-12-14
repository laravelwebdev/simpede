<?php

namespace App\Http\Controllers;

use App\Models\Dipa;
use App\Models\MataAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArsipController extends Controller
{
    public function show($tahun = null)
    {
        $tahun = (int) $tahun;
        $tahun = $tahun == 0 ? date('Y') : $tahun;
        $dipa = Dipa::where('tahun', $tahun)->first();
        
        if (!$dipa) {
            return redirect()->back()->with('error', 'Data DIPA tidak ditemukan untuk tahun tersebut.');
        }

        $data = DB::table('mata_anggarans')
            ->selectRaw('DISTINCT MID(mak,11,8) as KRO')    
            ->where('dipa_id', $dipa->id)->get();

        return view('arsip-dokumen', [
            'tahun' => $tahun,
            'data' => $data,
        ]);
    }
}
