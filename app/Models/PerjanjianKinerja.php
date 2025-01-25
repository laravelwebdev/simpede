<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerjanjianKinerja extends Model
{
    public function realisasiKinerja(): HasMany
    {
        return $this->hasMany(RealisasiKinerja::class);
    }

    public function tindakLanjut(): BelongsToMany
    {
        return $this->belongsToMany(TindakLanjut::class);
    }

    public function analisisSakip(): BelongsToMany
    {
        return $this->belongsToMany(AnalisisSakip::class);
    }

    protected static function booted(): void
    {
        static::creating(function (PerjanjianKinerja $perjanjian) {
            $perjanjian->tahun = session('year');
        });
    }
}
