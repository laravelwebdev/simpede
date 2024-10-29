<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DaftarKontrakMitra extends Model
{
    use HasFactory;

    protected $fillable = [
        'kontrak_mitra_id',
        'mitra_id',

    ];

    public function kontrakNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'kontrak_naskah_keluar_id');
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
            $daftar->status = 'dibuat';
            $kontrak = KontrakMitra::find($daftar->kontrak_mitra_id);
            $jenis_kontrak = Helper::getPropertyFromCollection(JenisKontrak::cache()->get('all')->where('id', $kontrak->jenis_kontrak_id)->first(), 'jenis');
            $bulan_kontrak = Helper::$bulan[$kontrak->bulan];
            $default_naskah = NaskahDefault::cache()->get('all')
                ->where('jenis', 'kontrak')
                ->first();
            $naskahkeluar = new NaskahKeluar;
            $naskahkeluar->tanggal = $kontrak->tanggal_spk;
            $naskahkeluar->jenis_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'jenis_naskah_id');
            $naskahkeluar->kode_arsip_id = $kontrak->kode_arsip_id;
            $naskahkeluar->derajat_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'derajat_naskah_id');
            $naskahkeluar->tujuan = Helper::getPropertyFromCollection(Helper::getMitraById($daftar->mitra_id), 'nama');
            $naskahkeluar->perihal = 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS '.strtoupper($jenis_kontrak).' BULAN '.strtoupper($bulan_kontrak).' TAHUN '.$kontrak->tahun;
            $naskahkeluar->generate = 'A';
            $naskahkeluar->save();
            $daftar->kontrak_naskah_keluar_id = $naskahkeluar->id;
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

        static::updating(function (DaftarKontrakMitra $daftar) {
            if (!(count($daftar->getDirty()) === 1 && $daftar->isDirty('status'))) {
                $daftar->status = $daftar->status === 'dibuat' ? 'diubah' : 'outdated';
            }
        });
    }
}
