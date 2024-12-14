<?php

namespace App\Http\Controllers;

use App\Models\Dipa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function perKro($tahun = null)
    {
        $tahun = (int) $tahun;
        $tahun = $tahun == 0 ? date('Y') : $tahun;
        $dipa = Dipa::where('tahun', $tahun)->first();

        $data = DB::table('mata_anggarans')
            ->selectRaw('MID(mak,11,8) as KRO')
            ->where('dipa_id', ! empty($dipa) ? $dipa->id : null)
            ->distinct()
            ->paginate();

        return view('arsip-per-kro', [
            'level' => 'KRO',
            'tahun' => $tahun,
            'data' => $data,
        ]);
    }

    public function perDetail($tahun, $kro)
    {
        $tahun = (int) $tahun;
        $tahun = $tahun == 0 ? date('Y') : $tahun;
        $dipa = Dipa::where('tahun', $tahun)->first();

        $data = ! empty($dipa) ? DB::table('mata_anggarans')
            ->select(['mak', 'id', 'uraian'])
            ->where('dipa_id', $dipa->id)
            ->whereLike('mak', '%'.$kro.'%')
            ->orderBy('ordered')->get() : [];

        return view('arsip-per-detail', [
            'tahun' => $tahun,
            'data' => $data,
        ]);
    }

    public function perKak($tahun, $coa)
    {
        $tahun = (int) $tahun;
        $tahun = $tahun == 0 ? date('Y') : $tahun;
        $kakIds = DB::table('anggaran_kerangka_acuans')
            ->select('kerangka_acuan_id')
            ->where('mata_anggaran_id', $coa)
            ->pluck('kerangka_acuan_id')
            ->toArray();
        $data = ! empty($kakIds) ? DB::table('kerangka_acuans')
            ->select(['id', 'rincian'])
            ->whereIn('id', $kakIds)->get() : [];

        return view('arsip-per-kak', [
            'tahun' => $tahun,
            'data' => $data,
        ]);
    }


    public function daftarFile($tahun, $kak)
    {
        $tahun = (int) $tahun;
        $tahun = $tahun == 0 ? date('Y') : $tahun;
        $path = $tahun.'/'.'arsip-dokumens'.'/'.$kak;
        $data = Storage::disk('arsip')->files($path);

        return view('daftar-file', [
            'tahun' => $tahun,
            'data' => $data,
        ]);
    }
}
