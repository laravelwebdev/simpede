<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KontrakMitra extends Model
{
    protected $fillable = ['status', 'tahun', 'bulan', 'jenis_kontrak_id', 'jenis_honor', 'honor_kegiatan_id'];

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

    }
}
