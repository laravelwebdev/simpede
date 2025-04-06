<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DaftarKontrakMitra extends Model
{
    // protected $fillable = [
    //     'kontrak_mitra_id',
    //     'mitra_id',
    //     'status_kontrak',
    //     'status_bast',

    // ];

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'valid_sbml' => 'boolean',
            'valid_jumlah_kontrak' => 'boolean',
            'tanggal_spk' => 'date',
            'tanggal_bast' => 'date',
            'awal_kontrak' => 'date',
            'akhir_kontrak' => 'date',

        ];
    }

    public function kontrakNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'kontrak_naskah_keluar_id');
    }

    public function kontrakMitra(): BelongsTo
    {
        return $this->belongsTo(KontrakMitra::class);
    }

    public function bastMitra(): BelongsTo
    {
        return $this->belongsTo(BastMitra::class);
    }

    public function mitra(): BelongsTo
    {
        return $this->belongsTo(Mitra::class);
    }

    public function daftarHonorMitra(): HasMany
    {
        return $this->hasMany(DaftarHonorMitra::class);
    }

    public function bastNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'bast_naskah_keluar_id');
    }

    protected static function booted(): void
    {
        static::creating(function (DaftarKontrakMitra $daftar) {
            $daftar->status_kontrak = 'dibuat';
            $daftar->status_bast = 'dibuat';
        });

        static::updating(function (DaftarKontrakMitra $daftar) {
            if ($daftar->isDirty(['tanggal_spk', 'spk_kode_arsip_id'])) {
                if ($daftar->kontrak_naskah_keluar_id === null) {
                    $kontrak = KontrakMitra::find($daftar->kontrak_mitra_id);
                    $jenis_kontrak = optional(JenisKontrak::cache()->get('all')->where('id', $kontrak->jenis_kontrak_id)->first())->jenis;
                    $bulan_kontrak = Helper::BULAN[$kontrak->bulan];
                    $default_naskah = NaskahDefault::cache()->get('all')
                        ->where('jenis', 'kontrak')
                        ->first();

                    $naskahkeluar = new NaskahKeluar;
                    $naskahkeluar->tanggal = $daftar->tanggal_spk;
                    $naskahkeluar->jenis_naskah_id = optional($default_naskah)->jenis_naskah_id;
                    $naskahkeluar->kode_arsip_id = $daftar->spk_kode_arsip_id;
                    $naskahkeluar->derajat_naskah_id = optional($default_naskah)->derajat_naskah_id;
                    $naskahkeluar->tujuan = optional(Helper::getMitraById($daftar->mitra_id))->nama;
                    $naskahkeluar->perihal = 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS '.strtoupper($jenis_kontrak).' BULAN '.strtoupper($bulan_kontrak).' TAHUN '.$kontrak->tahun;
                    $naskahkeluar->generate = 'A';
                    $naskahkeluar->save();
                    $daftar->kontrak_naskah_keluar_id = $naskahkeluar->id;
                } else {
                    $naskahkeluar = NaskahKeluar::where('id', $daftar->kontrak_naskah_keluar_id)->first();
                    $naskahkeluar->kode_arsip_id = $daftar->spk_kode_arsip_id;
                    $naskahkeluar->tanggal = $daftar->tanggal_spk;
                    $naskahkeluar->save();
                }
            }
            if ($daftar->isDirty(['tanggal_bast', 'bast_kode_arsip_id'])) {
                if ($daftar->bast_naskah_keluar_id === null) {
                    $kontrak = KontrakMitra::find($daftar->kontrak_mitra_id);
                    $jenis_kontrak = optional(JenisKontrak::cache()->get('all')->where('id', $kontrak->jenis_kontrak_id)->first())->jenis;
                    $bulan_kontrak = Helper::BULAN[$kontrak->bulan];
                    $default_naskah = NaskahDefault::cache()->get('all')
                        ->where('jenis', 'bast')
                        ->first();

                    $naskahkeluar = new NaskahKeluar;
                    $naskahkeluar->tanggal = $daftar->tanggal_bast;
                    $naskahkeluar->jenis_naskah_id = optional($default_naskah)->jenis_naskah_id;
                    $naskahkeluar->kode_arsip_id = $daftar->bast_kode_arsip_id;
                    $naskahkeluar->derajat_naskah_id = optional($default_naskah)->derajat_naskah_id;
                    $naskahkeluar->tujuan = optional(Helper::getMitraById($daftar->mitra_id))->nama;
                    $naskahkeluar->perihal = 'BERITA ACARA SERAH TERIMA PEKERJAAN MITRA STATISTIK PETUGAS '.strtoupper($jenis_kontrak).' BULAN '.strtoupper($bulan_kontrak).' TAHUN '.$kontrak->tahun;
                    $naskahkeluar->generate = 'A';
                    $naskahkeluar->save();
                    $daftar->bast_naskah_keluar_id = $naskahkeluar->id;
                } else {
                    $naskahkeluar = NaskahKeluar::where('id', $daftar->bast_naskah_keluar_id)->first();
                    $naskahkeluar->kode_arsip_id = $daftar->bast_kode_arsip_id;
                    $naskahkeluar->tanggal = $daftar->tanggal_bast;
                    $naskahkeluar->save();
                }
            }
        });

        static::deleting(function (DaftarKontrakMitra $daftar) {
            NaskahKeluar::destroy([$daftar->kontrak_naskah_keluar_id, $daftar->bast_naskah_keluar_id]);
        });

        static::saving(function (DaftarKontrakMitra $daftar) {
            if ($daftar->isDirty('bast_naskah_keluar_id')) {
                if (is_null($daftar->bast_naskah_keluar_id)) {
                    NaskahKeluar::destroy($daftar->getOriginal('bast_naskah_keluar_id'));
                }
            }
        });
    }
}
