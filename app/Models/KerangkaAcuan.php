<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class KerangkaAcuan extends Model
{
    use HasFactory;

    protected $casts = [
        'tanggal' => 'date',
        'awal' => 'date',
        'akhir' => 'date',
        'spesifikasi' => 'array',
        'anggaran' => 'array',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (KerangkaAcuan $kak) {
            $jenis_naskah = JenisNaskah::cache()->get('all')->where('jenis', 'Form Permintaan')->first();
            $unit_kerja = UnitKerja::cache()->get('all')->where('unit', 'BPS Kabupaten')->first();
            $kode_arsip = KodeArsip::cache()->get('all')->where('kode', 'KU.320')->first();
            $nomor = (new Helper)::nomor($kak->tanggal, session('year'), $jenis_naskah->kode_naskah_id, $unit_kerja->id, $kode_arsip->id, 'B');
            $kak->nomor = $nomor['nomor'];
            $kak->nama = Auth::user()->nama;
            $kak->nip = Auth::user()->nip;
            $kak->jabatan = Auth::user()->jabatan;
            $kak->unit_kerja_id = Auth::user()->unit_kerja_id;
            $kak->ppk = Helper::getPengelola('ppk')->nama;
            $kak->nipppk = Helper::getPengelola('ppk')->nip;
            $kak->tahun = session('year');
            $naskahkeluar = new NaskahKeluar;
            $naskahkeluar->tanggal = $kak->tanggal;
            $naskahkeluar->jenis_naskah_id = $jenis_naskah->id;
            $naskahkeluar->kode_arsip_id = $kode_arsip->id;
            $naskahkeluar->unit_kerja_id = $unit_kerja->id;
            $naskahkeluar->kode_naskah_id = $jenis_naskah->kode_naskah_id;
            $naskahkeluar->derajat = 'B';
            $naskahkeluar->tujuan = 'Pejabat Pembuat Komitmen';
            $naskahkeluar->perihal = 'Form Permintaan '.$kak->rincian;
            $naskahkeluar->save();
        });
        static::deleted(function (KerangkaAcuan $kak) {
            NaskahKeluar::where('nomor', $kak->nomor)->delete();
        });
        static::saving(function (KerangkaAcuan $kak) {
            if ($kak->jenis !== 'Penyedia') {
                $kak->metode = null;
                $kak->tkdn = null;
            }
            $kak->spesifikasi = Helper::addTotalToSpek($kak->spesifikasi);
        });
        static::updating(function (KerangkaAcuan $kak) {
            $naskahkeluar = NaskahKeluar::where('nomor', $kak->nomor)->first();
            $naskahkeluar->perihal = 'Form Permintaan '.$kak->rincian;
            $naskahkeluar->save();
        });
    }
}
