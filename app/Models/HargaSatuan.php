<?php

namespace App\Models;

use App\Models\JenisKontrak;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class HargaSatuan extends Model
{
    use HasFactory, LaraCache;

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the daftar mata anggaran.
     */
    public function jenisKontrak(): HasMany
    {
        return $this->hasMany(JenisKontrak::class);
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return HargaSatuan::all();
                }),
        ];
    }
}
