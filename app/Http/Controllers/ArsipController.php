<?php

namespace App\Http\Controllers;

use App\Models\Dipa;
use App\Models\ShareLink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ArsipController extends Controller
{
    public function perKro($token)
    {
        $tahun = ShareLink::where('token', $token)->first()->tahun;
        $dipa = Dipa::where('tahun', $tahun)->first();
        $search = request()->get('search');

        $subquery = DB::table('mata_anggarans')
            ->selectRaw('MID(mak,11,8) as KRO')
            ->when($search, function ($query, $search) {
                return $query->whereRaw('MID(mak,11,8) like ?', ['%'.$search.'%']);
            })
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
        $search = request()->get('search');
        $data = DB::table('mata_anggarans')
            ->select(['mak', 'id', 'uraian'])
            ->where('dipa_id', ! empty($dipa) ? $dipa->id : null)
            ->whereLike('mak', '%'.$kro.'%')
            ->when($search, function ($query, $search) {
                return $query->where('mak', 'like', '%'.$search.'%');
            })
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
        $search = request()->get('search');
        $kakIds = DB::table('anggaran_kerangka_acuans')
            ->select('kerangka_acuan_id')
            ->where('mata_anggaran_id', $coa)
            ->pluck('kerangka_acuan_id')
            ->toArray();
        $data = DB::table('kerangka_acuans')
            ->select(['id', 'rincian'])
            ->when($search, function ($query, $search) {
                return $query->where('rincian', 'like', '%'.$search.'%');
            })
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

    public function downloadFolder($token, $kak)
    {
        $tahun = ShareLink::where('token', $token)->first()->tahun;
        $path = $tahun.'/'.'arsip-dokumens'.'/'.$kak;
        $folderPath = Storage::disk('arsip')->path($path);
        $files = Storage::disk('arsip')->files($path);
        $zipFileName = uniqid().'.zip';
        $zipFilePath = Storage::disk('temp')->path($zipFileName);

        if (! empty($files)) {
            $zip = new ZipArchive;
            if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
                $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($folderPath), \RecursiveIteratorIterator::LEAVES_ONLY);
                foreach ($files as $file) {
                    if (! $file->isDir()) {
                        $relativePath = substr($file->getRealPath(), strlen($folderPath) + 1);
                        $zip->addFile($file->getRealPath(), $relativePath);
                    }
                }

                $zip->close();
            }

            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return redirect()->back()->with([
                'message' => 'Folder kosong, tidak ada file untuk diunduh.',
                'type' => 'danger',
            ]);
        }
    }
}
