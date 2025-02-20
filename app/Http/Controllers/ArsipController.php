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
    /**
     * Display the list of Mata Anggaran (COA) for a given token.
     *
     * @param string $token The access token.
     * @return \Illuminate\View\View The view displaying the list of Mata Anggaran.
     */
    public function perDetail($token)
    {
        $tahun = ShareLink::getTahunByToken($token);
        $dipa = Dipa::getByTahun($tahun);
        $search = request()->get('search');
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

    /**
     * Display the list of Kerangka Acuan (KAK) for a given COA and token.
     *
     * @param string $token The access token.
     * @param string $coa The COA identifier.
     * @return \Illuminate\View\View The view displaying the list of Kerangka Acuan.
     */
    public function perKak($token, $coa)
    {
        $tahun = ShareLink::getTahunByToken($token);
        $search = request()->get('search');
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

    /**
     * Display the list of files for a given KAK and token.
     *
     * @param string $token The access token.
     * @param string $kak The KAK identifier.
     * @return \Illuminate\View\View The view displaying the list of files.
     */
    public function daftarFile($token, $kak)
    {
        $tahun = ShareLink::getTahunByToken($token);
        $path = $tahun.'/'.'arsip-dokumens'.'/'.$kak;
        $files = Storage::disk('arsip')->files($path);
        $perPage = 15;
        $page = request()->get('page', 1);
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

    /**
     * Download the contents of a folder as a ZIP file.
     *
     * @param string $token The access token.
     * @param string $kak The KAK identifier.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\RedirectResponse The response to download the ZIP file or redirect back with an error message.
     */
    public function downloadFolder($token, $kak)
    {
        $tahun = ShareLink::getTahunByToken($token);
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
