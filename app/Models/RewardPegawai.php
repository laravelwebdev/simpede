<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RewardPegawai extends Model
{
    protected $casts = [
        'tanggal_penilaian' => 'date',
        'tanggal_penetapan' => 'date',
    ];
    protected $fillable = ['status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'sk_naskah_keluar_id');
    }

    public function daftarPenilaianReward(): HasMany
    {
        return $this->hasMany(DaftarPenilaianReward::class);
    }

    public function sertifikatNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'sertifikat_naskah_keluar_id');
    }

    protected static function booted(): void
    {
        static::creating(function (RewardPegawai $reward) {
            $reward->status = 'dibuat';
        });   
        static::saving(function (RewardPegawai $reward) {
            $reward->tahun = session('year');
        });        
        static::deleting(function (RewardPegawai $reward) {
            $reward->daftarPenilaianReward->each->delete();
            NaskahKeluar::destroy([$reward->sk_naskah_keluar_id, $reward->sertifikat_naskah_keluar_id]);
        });
    }

}
