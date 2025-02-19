<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KontrakMitra extends Model
{
    protected $fillable = ['status', 'tahun', 'bulan', 'jenis_kontrak_id', 'jenis_honor', 'honor_kegiatan_id'];

    public function casts(): array
    {
        return [
            'awal_kontrak' => 'date',
            'akhir_kontrak' => 'date',
            'tanggal_spk' => 'date',
        ];
    }

    public function daftarKontrakMitra(): HasMany
    {
        return $this->hasMany(DaftarKontrakMitra::class);
    }

    public function jenisKontrak(): BelongsTo
    {
        return $this->belongsTo(JenisKontrak::class);
    }

    public function ppk(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ppk_user_id');
    }

    protected static function booted(): void
    {
        static::creating(function (KontrakMitra $kontrak) {
            $kontrak->status = 'dibuat';
        });
        static::saved(function (KontrakMitra $kontrak) {
            $bast = BastMitra::firstOrNew(['kontrak_mitra_id' => $kontrak->id]);
            $bast->save();
        });
        static::deleting(function (KontrakMitra $kontrak) {
            $bastId = optional(BastMitra::where('kontrak_mitra_id', $kontrak->id)->first())->id;
            BastMitra::destroy($bastId);
            $daftarKontrakMitraIds = DaftarKontrakMitra::where('kontrak_mitra_id', $kontrak->id)->pluck('id');
            DaftarKontrakMitra::destroy($daftarKontrakMitraIds);
        });

        static::updating(function (KontrakMitra $kontrak) {
            DaftarKontrakMitra::where('kontrak_mitra_id', $kontrak->id)->update(['status_kontrak' => 'outdated']);
            if ($kontrak->isDirty('tanggal_spk')) {
                $daftar_kontraks = DaftarKontrakMitra::where('kontrak_mitra_id', $kontrak->id)->get();
                foreach ($daftar_kontraks as $daftar_kontrak) {
                    $naskah_keluar = NaskahKeluar::find($daftar_kontrak->kontrak_naskah_keluar_id);
                    $naskah_keluar->tanggal = $kontrak->tanggal_spk;
                    $naskah_keluar->save();
                }
            }
            if ($kontrak->isDirty()) {
                $kontrak->status = $kontrak->status === 'dibuat' ? 'diubah' : 'outdated';
            }
        });
    }
}
