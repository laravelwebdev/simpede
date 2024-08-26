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
        static::updating(function (KerangkaAcuan $kak) {
            $naskahkeluar = NaskahKeluar::where('nomor', $kak->getOriginal('nomor'))->first();
            $naskah_id = $naskahkeluar->id;
            $naskahkeluar->tanggal = $kak->tanggal;
            $naskahkeluar->perihal = 'Form Permintaan '.$kak->rincian;
            $naskahkeluar->save();
            $kak->nomor = NaskahKeluar::find($naskah_id)->nomor;
        });
        static::deleted(function (KerangkaAcuan $kak) {
            NaskahKeluar::where('nomor', $kak->nomor)->delete();
            HonorSurvei::where('nomor_kak', $kak->nomor)->delete();
        });
        static::saved(function (KerangkaAcuan $kak) {
            if ($kak->jenis !== 'Penyedia') {
                $kak->metode = null;
                $kak->tkdn = null;
            }
            $kak->spesifikasi = Helper::addTotalToSpek($kak->spesifikasi);
            if (Helper::sumJenisAkunHonor($kak->anggaran)==1) {
                if ($honor = HonorSurvei::where('nomor_kak', $kak->isDirty('nomor')?$kak->getOriginal('nomor'):$kak->nomor)->first()) {
                    $honor->nomor_kak = $kak->nomor;
                    $honor->judul_spj = str_ireplace('Pembayaran Biaya', '', $kak->rincian);
                    $honor->akhir = $kak->akhir;
                    $honor->mak = Helper::getSingleAkunHonor($kak->anggaran);
                    $honor->kegiatan = $kak->kegiatan;
                    $honor->save();
                } else {
                    $honor = new HonorSurvei;
                    $honor->nomor_kak = $kak->nomor;
                    $honor->judul_spj = str_ireplace('Pembayaran Biaya', '', $kak->rincian);
                    $honor->akhir = $kak->akhir;
                    $honor->mak = Helper::getSingleAkunHonor($kak->anggaran);
                    $honor->kegiatan = $kak->kegiatan;
                    $honor->unit_kerja_id = $kak->unit_kerja_id;
                    $honor->ketua = $kak->nama;
                    $honor->nipketua = $kak->nip;
                    $honor->save();
                }
            }
            if (Helper::isAkunHonorChanged($kak->getOriginal('anggaran'), $kak->anggaran))
            HonorSurvei::where('nomor_kak', $kak->getOriginal('nomor'))->delete();
        });

    }
}
