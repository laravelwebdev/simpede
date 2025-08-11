<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DaftarPulsaMitra;
use App\Models\Mitra;
use App\Models\PulsaKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SweetAlert2\Laravel\Swal;

class PulsaController extends Controller
{
    public function index()
    {
        $judul = PulsaKegiatan::getJudulByToken(request()->route('token'));
        $token = request()->route('token');
        $version = Helper::version();
        $satker = 'BPS '.config('satker.kabupaten');

        return view('index-pulsa', compact('judul', 'token', 'version', 'satker'));
    }

    public function verifikasi(Request $request)
    {
        $request->validate([
            'nik' => 'required|numeric|digits:16',
        ]);

        $token = $request->route('token');
        $nik = $request->input('nik');
        $mitraId = Helper::getMitraIdByNIK($nik);

        $pulsaKegiatanId = PulsaKegiatan::getIdByToken($token);

        if (DaftarPulsaMitra::where('pulsa_kegiatan_id', $pulsaKegiatanId)
            ->where('mitra_id', $mitraId)
            ->exists()) {
            session([
                'mitraId' => $mitraId,
                'pulsaKegiatanId' => $pulsaKegiatanId,
            ]);

            return redirect()->route('pulsa-actions', ['token' => $token]);
        } else {
            return redirect()->back()->withErrors(['NIK tidak terdaftar.']);
        }
    }

    public function actionsChoice(Request $request)
    {
        $mitra = Helper::getMitraById(session('mitraId'));
        $matchKegiatan = PulsaKegiatan::where('id', session('pulsaKegiatanId'))
            ->where('token', request()->route('token'))
            ->exists();
        $matchMitra = DaftarPulsaMitra::where('mitra_id', session('mitraId'))
            ->where('pulsa_kegiatan_id', session('pulsaKegiatanId'))
            ->exists();
        if (! $mitra || ! $matchKegiatan || ! $matchMitra) {
            abort(404);
        }
        $judul = PulsaKegiatan::getJudulByToken(request()->route('token'));
        $token = request()->route('token');
        $nik = $mitra->nik;
        $nama = $mitra->nama;
        $version = Helper::version();
        $satker = 'BPS '.config('satker.kabupaten');

        return view('actions-choice-pulsa', compact('judul', 'token', 'nik', 'nama', 'version', 'satker'));
    }

    public function choice(Request $request)
    {
        $mitra = Helper::getMitraById(session('mitraId'));
        $matchKegiatan = PulsaKegiatan::where('id', session('pulsaKegiatanId'))
            ->where('token', request()->route('token'))
            ->exists();
        $matchMitra = DaftarPulsaMitra::where('mitra_id', session('mitraId'))
            ->where('pulsa_kegiatan_id', session('pulsaKegiatanId'))
            ->exists();
        if (! $mitra || ! $matchKegiatan || ! $matchMitra) {
            abort(404);
        }
        $token = request()->route('token');
        if ($request->input('action-type') === 'konfirmasi') {
            return redirect()->route('pulsa-confirm', ['token' => $token]);
        }
        if ($request->input('action-type') === 'upload') {
            return redirect()->route('pulsa-upload', ['token' => $token]);
        }
    }

    public function confirm(Request $request)
    {
        $mitra = Helper::getMitraById(session('mitraId'));
        $matchKegiatan = PulsaKegiatan::where('id', session('pulsaKegiatanId'))
            ->where('token', request()->route('token'))
            ->exists();
        $daftarMitra = DaftarPulsaMitra::where('mitra_id', session('mitraId'))
            ->where('pulsa_kegiatan_id', session('pulsaKegiatanId'))
            ->first();
        $matchMitra = ! is_null($daftarMitra);
        if (! $mitra || ! $matchKegiatan || ! $matchMitra) {
            abort(404);
        }
        $judul = PulsaKegiatan::getJudulByToken(request()->route('token'));
        $token = request()->route('token');
        $nik = $mitra->nik;
        $nama = $mitra->nama;
        $handphone = $mitra->no_pulsa;
        $version = Helper::version();
        $satker = 'BPS '.config('satker.kabupaten');
        $confirmed = optional($daftarMitra)->confirmed;
        $no_confirmed = optional($daftarMitra)->handphone;
        $edit = $request->input('edit');

        return view('konfirmasi-pulsa', compact('judul', 'token', 'nik', 'nama', 'handphone', 'version', 'satker', 'confirmed', 'no_confirmed', 'edit'));
    }

    public function submitConfirm(Request $request)
    {
        $mitra = Helper::getMitraById(session('mitraId'));
        $matchKegiatan = PulsaKegiatan::where('id', session('pulsaKegiatanId'))
            ->where('token', request()->route('token'))
            ->exists();
        $matchMitra = DaftarPulsaMitra::where('mitra_id', session('mitraId'))
            ->where('pulsa_kegiatan_id', session('pulsaKegiatanId'))
            ->exists();
        if (! $mitra || ! $matchKegiatan || ! $matchMitra) {
            abort(404);
        }

        if ($request->input('edit') === 'edit') {
            return redirect()->route('pulsa-confirm', [
                'token' => request()->route('token'),
                'edit' => $request->input('edit'),
            ]);
        }
        $request->validate([
            'handphone' => 'required|regex:/^\+?[0-9]{10,15}$/',
            'confirm' => 'required|same:handphone',
        ]);
        $token = request()->route('token');
        $handphone = $request->input('handphone');
        $mitraModel = Mitra::find(session('mitraId'));
        $mitraModel->no_pulsa = $handphone;
        $updateMitra = $mitraModel->save();
        $updateDaftar = DaftarPulsaMitra::where('pulsa_kegiatan_id', session('pulsaKegiatanId'))
            ->where('mitra_id', session('mitraId'))
            ->update(['confirmed' => true, 'handphone' => $handphone]);
        if ($updateMitra > 0 && $updateDaftar > 0) {
            Swal::success([
                'title' => 'Berhasil',
                'text' => 'Nomor handphone telah berhasil dikonfirmasi.',
            ]);
        } else {
            Swal::error([
                'title' => 'Gagal',
                'text' => 'Gagal mengupdate nomor handphone.',
            ]);
        }

        return redirect()->route('pulsa-confirm', ['token' => $token]);
    }

    public function upload(Request $request)
    {
        $mitra = Helper::getMitraById(session('mitraId'));
        $matchKegiatan = PulsaKegiatan::where('id', session('pulsaKegiatanId'))
            ->where('token', request()->route('token'))
            ->exists();
        $matchMitra = DaftarPulsaMitra::where('mitra_id', session('mitraId'))
            ->where('pulsa_kegiatan_id', session('pulsaKegiatanId'))
            ->exists();
        if (! $mitra || ! $matchKegiatan || ! $matchMitra) {
            abort(404);
        }
        $judul = PulsaKegiatan::getJudulByToken(request()->route('token'));
        $token = request()->route('token');
        $nik = $mitra->nik;
        $nama = $mitra->nama;
        $handphone = $mitra->no_pulsa;
        $nominal = DaftarPulsaMitra::getNominalByMitraIdAndKegiatanId(session('mitraId'), session('pulsaKegiatanId'));
        $daftar = DaftarPulsaMitra::where('pulsa_kegiatan_id', session('pulsaKegiatanId'))
            ->where('mitra_id', session('mitraId'))
            ->whereNotNull('file')
            ->first();
        $uploaded = ! is_null($daftar);
        $path = $uploaded ? $daftar->file : null;
        $version = Helper::version();
        $satker = 'BPS '.config('satker.kabupaten');
        $edit = $request->input('edit');

        return view('upload-pulsa', compact('judul', 'token', 'nik', 'nama', 'handphone', 'nominal', 'uploaded', 'version', 'satker', 'edit', 'path'));
    }

    public function submitUpload(Request $request)
    {
        $mitra = Helper::getMitraById(session('mitraId'));
        $matchKegiatan = PulsaKegiatan::where('id', session('pulsaKegiatanId'))
            ->where('token', request()->route('token'))
            ->exists();
        $matchMitra = DaftarPulsaMitra::where('mitra_id', session('mitraId'))
            ->where('pulsa_kegiatan_id', session('pulsaKegiatanId'))
            ->exists();
        if (! $mitra || ! $matchKegiatan || ! $matchMitra) {
            abort(404);
        }
        if ($request->input('edit') === 'edit') {
            return redirect()->route('pulsa-upload', [
                'token' => request()->route('token'),
                'edit' => $request->input('edit'),
            ]);
        }

        $request->validate([
            'attachment' => [
                'required',
                'image',
                'max:10240',
                function ($attribute, $value, $fail) use ($request) {
                    $image = $request->file('attachment');
                    if ($image) {
                        [$width, $height] = getimagesize($image->getPathname());
                        $ratio = $height / $width;
                        if ($ratio >= 1.7) {
                            $fail('Sepertinya Anda mengirim full screenshot layar. Silakan crop dulu sesuai petunjuk di bawah ini');
                        }
                    }
                },
            ],
        ]);
        // Remove previous file if exists
        $existing = DaftarPulsaMitra::where('pulsa_kegiatan_id', session('pulsaKegiatanId'))
            ->where('mitra_id', session('mitraId'))
            ->value('file');
        if ($existing) {
            Storage::disk('pulsa')->delete($existing);
        }
        // Store new file with new extension
        $attachment = $request->file('attachment')->storeAs(
            date('Y').'/'.session('pulsaKegiatanId'),
            session('pulsaKegiatanId').'-'.session('mitraId').'.'.$request->file('attachment')->getClientOriginalExtension(),
            'pulsa'
        );

        $updateDaftar = DaftarPulsaMitra::where('pulsa_kegiatan_id', session('pulsaKegiatanId'))
            ->where('mitra_id', session('mitraId'))
            ->update(['file' => $attachment]);

        if ($attachment && $updateDaftar > 0) {
            Swal::success([
                'title' => 'Berhasil',
                'text' => 'Lampiran berhasil diunggah.',
            ]);
        } else {
            Swal::error([
                'title' => 'Gagal',
                'text' => 'Gagal mengunggah lampiran.',
            ]);
        }

        return redirect()->route('pulsa-upload', ['token' => request()->route('token')]);
    }
}
