<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DaftarSp2d extends Model
{
    protected function casts(): array
    {
        return [
            'tanggal_sp2d' => 'date',
            'tanggal_spm' => 'date',
        ];
    }

    public function dipa(): BelongsTo
    {
        return $this->belongsTo(Dipa::class);
    }

    public function arsipKeuangans()
    {
        return $this->hasManyThrough(
            ArsipKeuangan::class,
            KakSp2d::class,
            'daftar_sp2d_id',   // FK di kak_sp2d
            'id',               // PK di arsip_keuangans
            'id',               // PK di daftar_sp2d
            'arsip_keuangan_id' // FK di kak_sp2d
        );
    }

    protected $fillable = ['dipa_id', 'nomor_sp2d', 'tanggal_spm'];

    public function kerangkaAcuan(): BelongsToMany
    {
        return $this->belongsToMany(KerangkaAcuan::class, 'kak_sp2d')
            ->using(KakSp2d::class);
    }

    public function realisasiAnggaran(): HasMany
    {
        return $this->hasMany(RealisasiAnggaran::class);
    }
}
