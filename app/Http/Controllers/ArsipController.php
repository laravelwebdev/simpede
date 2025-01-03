<?php

namespace App\Http\Controllers;

use App\Models\Dipa;
use App\Models\ShareLink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function perKro($token)
    {
        $tahun = ShareLink::where('token', $token)->first()->tahun;
        $dipa = Dipa::where('tahun', $tahun)->first();

        $subquery = DB::table('mata_anggarans')
            ->selectRaw('MID(mak,11,8) as KRO')
            ->where('dipa_id', ! empty($dipa) ? $dipa->id : null)
            ->distinct();

        $data = DB::table(DB::raw("({$subquery->toSql()}) as sub"))
            ->mergeBindings($subquery)
            ->paginate();

        return view('arsip-per-kro', [
            'level' => 'KRO',
            'token' => $token,
            'tahun' => $tahun,
            'data' => $data,
        ]);
    }

    public function perDetail($token, $kro)
    {
        $tahun = ShareLink::where('token', $token)->first()->tahun;
        $dipa = Dipa::where('tahun', $tahun)->first();

        $data = DB::table('mata_anggarans')
            ->select(['mak', 'id', 'uraian'])
            ->where('dipa_id', ! empty($dipa) ? $dipa->id : null)
            ->whereLike('mak', '%'.$kro.'%')
            ->orderBy('ordered')->paginate();

        return view('arsip-per-detail', [
            'tahun' => $tahun,
            'token' => $token,
            'level' => 'COA',
            'data' => $data,
        ]);
    }

    public function perKak($token, $coa)
    {
        $tahun = ShareLink::where('token', $token)->first()->tahun;
        $kakIds = DB::table('anggaran_kerangka_acuans')
            ->select('kerangka_acuan_id')
            ->where('mata_anggaran_id', $coa)
            ->pluck('kerangka_acuan_id')
            ->toArray();
        $data = DB::table('kerangka_acuans')
            ->select(['id', 'rincian'])
            ->whereIn('id', $kakIds)->paginate();

        return view('arsip-per-kak', [
            'level' => 'KAK',
            'token' => $token,
            'tahun' => $tahun,
            'data' => $data,
        ]);
    }

    public function daftarFile($token, $kak)
    {
        $tahun = ShareLink::where('token', $token)->first()->tahun;
        $path = $tahun.'/'.'arsip-dokumens'.'/'.$kak;
        $files = Storage::disk('arsip')->files($path);
        $perPage = 15;
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;
        $data = array_slice($files, $offset, $perPage);
        $data = new \Illuminate\Pagination\LengthAwarePaginator($data, count($files), $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);

        return view('daftar-file', [
            'tahun' => $tahun,
            'level' => 'FILE',
            'data' => $data,
        ]);
    }
}
