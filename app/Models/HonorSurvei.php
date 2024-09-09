<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HonorSurvei extends Model
{
    use HasFactory;
    protected $casts = [
        'tanggal_spj' => 'date',
        'tanggal_sk' => 'date',
        'tanggal_st' => 'date',
        'tanggal_kak' => 'date',
        'awal' => 'date',
        'akhir' => 'date',
        'pegawai' => 'array',
    ];

    /**
     * Get the kerangka acuan that owns the honor survei.
     */
    public function kerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(KerangkaAcuan::class);
    }

    public function skNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'sk_naskah_keluar_id');
    }

    public function stNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'st_naskah_keluar_id');
    }

    /**
     * Get the daftar honor.
     */
    public function daftarHonor(): HasMany
    {
        return $this->hasMany(DaftarHonor::class)->orderBy('nama', 'asc');
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (HonorSurvei $honor) {
            $honor->tahun = session('year');
            $honor->ppk = Helper::getPengelola('ppk')->nama;
            $honor->nipppk = Helper::getPengelola('ppk')->nip;
            $honor->bendahara = Helper::getPengelola('bendahara')->nama;
            $honor->nipbendahara = Helper::getPengelola('bendahara')->nip;
        });
        static::saving(function (HonorSurvei $honor) {
            if ($honor->generate_sk === 'Tidak') {
                $honor->tanggal_sk = null;
                NaskahKeluar::destroy($honor->sk_naskah_keluar_id);
                $honor->sk_naskah_keluar_id = null;
            }
            if ($honor->generate_st === 'Tidak') {
                $honor->tanggal_st = null;
                $honor->uraian_tugas = null;
                $honor->kode_arsip_id = null;
                NaskahKeluar::destroy($honor->st_naskah_keluar_id);
                $honor->st_naskah_keluar_id = null;
            }
            if ($honor->bulan != null) {
                if ($honor->generate_sk == 'Ya') {
                    if ($honor->sk_naskah_keluar_id === null) {
                        $jenis_naskah = JenisNaskah::cache()->get('all')->where('jenis', 'Keputusan')->first();
                        $kode_arsip = KodeArsip::cache()->get('all')->where('kode', 'VS.220')->first();
                        $naskahkeluar = new NaskahKeluar;
                        $naskahkeluar->tanggal = $honor->tanggal_sk;
                        $naskahkeluar->jenis_naskah_id = $jenis_naskah->id;
                        $naskahkeluar->kode_arsip_id = $kode_arsip->id;
                        $naskahkeluar->kode_naskah_id = $jenis_naskah->kode_naskah_id;
                        $naskahkeluar->derajat = 'B';
                        $naskahkeluar->tujuan = $honor->objek_sk;
                        $naskahkeluar->perihal = 'SK '.$honor->objek_sk;
                        $naskahkeluar->generate = 'A';
                        $naskahkeluar->save();
                        $honor->sk_naskah_keluar_id = $naskahkeluar->id;
                    } else {
                        if ($honor->isDirty('tanggal_sk')) {
                            $naskahkeluar = NaskahKeluar::where('id', $honor->sk_naskah_keluar_id)->first();
                            $naskahkeluar->tanggal = $honor->tanggal_sk;
                            $naskahkeluar->save();
                        }
                    }
                }

                if ($honor->generate_st == 'Ya') {
                    if ($honor->st_naskah_keluar_id === null) {
                        $jenis_naskah = JenisNaskah::cache()->get('all')->where('jenis', 'Surat Tugas')->first();
                        $naskahkeluar = new NaskahKeluar;
                        $naskahkeluar->tanggal = $honor->tanggal_st;
                        $naskahkeluar->jenis_naskah_id = $jenis_naskah->id;
                        $naskahkeluar->kode_arsip_id = $honor->kode_arsip_id;
                        $naskahkeluar->kode_naskah_id = $jenis_naskah->kode_naskah_id;
                        $naskahkeluar->derajat = 'B';
                        $naskahkeluar->tujuan = $honor->objek_sk;
                        $naskahkeluar->perihal = 'Surat Tugas '.$honor->objek_sk;
                        $naskahkeluar->generate = 'A';
                        $naskahkeluar->save();
                        $honor->st_naskah_keluar_id = $naskahkeluar->id;
                    } else {
                        if ($honor->isDirty('tanggal_st')) {
                            $naskahkeluar = NaskahKeluar::where('id', $honor->st_naskah_keluar_id)->first();
                            $naskahkeluar->tanggal = $honor->tanggal_st;
                            $naskahkeluar->save();
                        }
                    }
                }
            }
        });
        static::deleting(function (HonorSurvei $honor) {
            NaskahKeluar::destroy([$honor->sk_naskah_keluar_id, $honor->st_naskah_keluar_id]);
        });
    }
}
