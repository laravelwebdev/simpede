<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DaftarPulsaMitra;
use App\Models\Mitra;
use App\Models\PulsaKegiatan;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class PulsaController extends Controller
{
    public function index()
    {
        $judul = PulsaKegiatan::getJudulByToken(request()->route('token'));
        $token = request()->route('token');

        return view('index-pulsa', compact('judul', 'token'));
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
            return redirect()->back()->withErrors(['NIK tidak terdaftar atau sudah diverifikasi.']);
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

        return view('actions-choice-pulsa', compact('judul', 'token', 'nik', 'nama'));
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

        return view('konfirmasi-pulsa', compact('judul', 'token', 'nik', 'nama', 'handphone'));

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
            ->update(['confirmed' => true]);
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

        return redirect()->route('pulsa-actions', ['token' => $token]);
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
        $uploaded = DaftarPulsaMitra::where('pulsa_kegiatan_id', session('pulsaKegiatanId'))
            ->where('mitra_id', session('mitraId'))
            ->whereNotNull('file')
            ->exists();

        return view('upload-pulsa', compact('judul', 'token', 'nik', 'nama', 'handphone', 'nominal', 'uploaded'));

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
        $request->validate([
            'attachment' => 'required|image|max:10240',
        ]);
        $attachment = $request->file('attachment')->storeAs(
            date('Y'),
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

        return redirect()->route('pulsa-actions', ['token' => request()->route('token')]);
    }
}
