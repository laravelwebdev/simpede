<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
     * Get the naskah_keluar that owns thekerangka acuan.
     */
    public function naskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (KerangkaAcuan $kak) {
            $jenis_naskah = JenisNaskah::cache()->get('all')->where('jenis', 'Form Permintaan')->first();
            $unit_kerja = UnitKerja::cache()->get('all')->where('unit', 'BPS Kabupaten')->first();
            $kode_arsip = KodeArsip::cache()->get('all')->where('kode', 'KU.320')->first();
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
            $kak->naskah_keluar_id = $naskahkeluar->id;
            $kak->nama = Auth::user()->nama;
            $kak->nip = Auth::user()->nip;
            $kak->jabatan = Auth::user()->jabatan;
            $kak->unit_kerja_id = Auth::user()->unit_kerja_id;
            $kak->ppk = Helper::getPengelola('ppk')->nama;
            $kak->nipppk = Helper::getPengelola('ppk')->nip;
            $kak->tahun = session('year');

        });
        static::updating(function (KerangkaAcuan $kak) {
            $naskahkeluar = NaskahKeluar::where('id', $kak->naskah_keluar_id)->first();
            $naskahkeluar->tanggal = $kak->tanggal;
            $naskahkeluar->perihal = 'Form Permintaan '.$kak->rincian;
            $naskahkeluar->save();
        });
        static::deleted(function (KerangkaAcuan $kak) {
            NaskahKeluar::where('id', $kak->naskah_keluar_id)->delete();
            HonorSurvei::where('kerangka_acuan_id', $kak->id)->delete();
        });
        static::saved(function (KerangkaAcuan $kak) {
            if ($kak->jenis !== 'Penyedia') {
                $kak->metode = null;
                $kak->tkdn = null;
            }
            $kak->spesifikasi = Helper::addTotalToSpek($kak->spesifikasi);
            if (Helper::sumJenisAkunHonor($kak->anggaran) == 1) {
                if ($honor = HonorSurvei::where('kerangka_acuan_id',$kak->id)->first()) {
                    $honor->judul_spj = str_ireplace('Pembayaran Biaya', '', $kak->rincian);
                    $honor->akhir = $kak->akhir;
                    $honor->mak = Helper::getSingleAkunHonor($kak->anggaran);
                    $honor->kegiatan = $kak->kegiatan;
                    $honor->save();
                } else {
                    $honor = new HonorSurvei;
                    $honor->kerangka_acuan_id = $kak->id;
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
            if (Helper::isAkunHonorChanged($kak->getOriginal('anggaran'), $kak->anggaran)) {
                HonorSurvei::where('kerangka_acuan_id', $kak->id)->delete();
            }
        });
    }
}
