<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class TataNaskah extends Model
{
    use HasFactory, LaraCache;

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the daftar mata anggaran.
     */
    public function kodeArsip(): HasMany
    {
        return $this->hasMany(KodeArsip::class);
    }

    public function kodeNaskah(): HasMany
    {
        return $this->hasMany(KodeNaskah::class);
    }

    public function template(): HasMany
    {
        return $this->hasMany(Template::class);
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return TataNaskah::all();
                }),
        ];
    }
}
