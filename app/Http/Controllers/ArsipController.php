<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Dipa;
use App\Models\KerangkaAcuan;
use App\Models\ShareLink;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ArsipController extends Controller
{
    public function perDetail($token)
    {
        $tahun = ShareLink::getTahunByToken($token);
        $dipa = Dipa::getByTahun($tahun);
        $search = request()->query('search');
        $data = Dipa::getMataAnggarans(! empty($dipa) ? $dipa->id : null, $search)
            ->paginate()
            ->withQueryString();

        return view('arsip-per-detail', [
            'tahun' => $tahun,
            'token' => $token,
            'level' => 'COA',
            'data' => $data,
            'version' => Helper::version(),
            'satker' => 'BPS '.config('satker.kabupaten'),
        ]);
    }

    public function perKak($token, $coa)
    {
        $tahun = ShareLink::getTahunByToken($token);
        $search = request()->query('search');
        $data = KerangkaAcuan::getKerangkaAcuans($coa, $search)
            ->paginate()
            ->withQueryString();

        return view('arsip-per-kak', [
            'level' => 'KAK',
            'token' => $token,
            'tahun' => $tahun,
            'data' => $data,
            'version' => Helper::version(),
            'satker' => 'BPS '.config('satker.kabupaten'),
        ]);
    }

    public function daftarFile($token, $kak)
    {
        $tahun = ShareLink::getTahunByToken($token);
        $kakId = optional(KerangkaAcuan::where('id_link', $kak)->get()->first())->id;
        $path = $tahun.'/'.'arsip-dokumens'.'/'.$kakId;
        $files = Storage::disk('arsip')->files($path);
        $perPage = 15;
        $page = request()->query('page', 1);
        $offset = ($page - 1) * $perPage;
        $data = array_slice($files, $offset, $perPage);
        $data = (new \Illuminate\Pagination\LengthAwarePaginator($data, count($files), $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]));

        return view('daftar-file', [
            'tahun' => $tahun,
            'level' => 'FILE',
            'data' => $data,
            'version' => Helper::version(),
            'satker' => 'BPS '.config('satker.kabupaten'),
        ]);
    }

    public function downloadFolder($token, $kak)
    {
        $tahun = ShareLink::getTahunByToken($token);
        $kakId = optional(KerangkaAcuan::where('id_link', $kak)->get()->first())->id;
        $path = $tahun.'/'.'arsip-dokumens'.'/'.$kakId;
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
