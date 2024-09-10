<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class Dipa extends Model
{
    use HasFactory, LaraCache;

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the daftar mata anggaran.
     */
    public function mataAnggaran(): HasMany
    {
        return $this->hasMany(MataAnggaran::class);
    }

    /**
     * Get the daftar kamus anggaran.
     */
    public function kamusAnggaran(): HasMany
    {
        return $this->hasMany(KamusAnggaran::class);
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return Dipa::all();
                }),
        ];
    }
}
