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
            $kode_arsip = KodeArsip::cache()->get('all')->where('kode', 'KU.320')->first();
            $naskahkeluar = new NaskahKeluar;
            $naskahkeluar->tanggal = $kak->tanggal;
            $naskahkeluar->jenis_naskah_id = $jenis_naskah->id;
            $naskahkeluar->kode_arsip_id = $kode_arsip->id;
            $naskahkeluar->kode_naskah_id = $jenis_naskah->kode_naskah_id;
            $naskahkeluar->derajat = 'B';
            $naskahkeluar->tujuan = 'Pejabat Pembuat Komitmen';
            $naskahkeluar->perihal = 'Form Permintaan '.$kak->rincian;
            $naskahkeluar->save();
            $kak->naskah_keluar_id = $naskahkeluar->id;

            $user = User::cache()->get('all')->where('role', 'koordinator')->where('unit_kerja_id', Auth::user()->unit_kerja_id)->first();
            $kak->nama = $user->nama;
            $kak->nip = $user->nip;
            $kak->jabatan = $user->jabatan == 'Kepala Subbagian Umum' ? 'Kepala Subbagian Umum' : 'Penanggung Jawab Kegiatan';
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
        static::deleting(function (KerangkaAcuan $kak) {
            NaskahKeluar::destroy($kak->naskah_keluar_id);
            HonorSurvei::destroy($kak->id);
        });
        static::saving(function (KerangkaAcuan $kak) {
            if ($kak->jenis !== 'Penyedia') {
                $kak->metode = '-';
                $kak->tkdn = '-';
            }
        });
        static::saved(function (KerangkaAcuan $kak) {
            if (Helper::sumJenisAkunHonor($kak->anggaran) == 1) {
                if ($honor = HonorSurvei::where('kerangka_acuan_id', $kak->id)->first()) {
                    $honor->judul_spj = str_ireplace('Pembayaran Biaya', '', $kak->rincian);
                    $honor->awal = $kak->awal;
                    $honor->akhir = $kak->akhir;
                    $honor->tanggal_kak = $kak->tanggal;
                    $honor->tanggal_spj = $kak->akhir;
                    $honor->mak = Helper::getSingleAkunHonor($kak->anggaran);
                    $honor->kegiatan = $kak->kegiatan;
                    if ($kak->wasChanged('tanggal')){
                        $honor->generate_sk =='Ya' ? $honor->tanggal_sk = $kak->tanggal: null;
                        $honor->generate_st == 'Ya' ? $honor->tanggal_st = $kak->tanggal: null;
                    }
                    $honor->save();
                } else {
                    $honor = new HonorSurvei;
                    $honor->kerangka_acuan_id = $kak->id;
                    $honor->judul_spj = str_ireplace('Pembayaran Biaya', '', $kak->rincian);
                    $honor->awal = $kak->awal;
                    $honor->akhir = $kak->akhir;
                    $honor->mak = Helper::getSingleAkunHonor($kak->anggaran);
                    $honor->kegiatan = $kak->kegiatan;
                    $honor->uraian_tugas = 'Melakukan '.$kak->kegiatan;
                    $honor->objek_sk = 'Petugas '.strtr($kak->kegiatan, ['Pemeriksaan' => 'Pemeriksa', 'Pencacahan' => 'Pencacah', 'Pengawasan' => 'Pengawas']);
                    $honor->generate_sk = 'Ya';
                    $honor->generate_st = 'Ya';
                    $honor->tanggal_kak = $kak->tanggal;
                    $honor->tanggal_spj = $kak->akhir;
                    $honor->tanggal_st = $kak->tanggal;
                    $honor->tanggal_sk = $kak->tanggal;
                    $honor->unit_kerja_id = $kak->unit_kerja_id;
                    $honor->ketua = $kak->nama;
                    $honor->nipketua = $kak->nip;
                    $honor->save();
                }
            }
            if (Helper::isAkunHonorChanged($kak->getOriginal('anggaran'), $kak->anggaran)) {
                HonorSurvei::destroy($kak->id);
            }
        });
    }
}
