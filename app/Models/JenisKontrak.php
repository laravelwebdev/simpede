<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class JenisKontrak extends Model
{
    use HasFactory, LaraCache;

    public function hargaSatuan(): BelongsTo
    {
        return $this->belongsTo(HargaSatuan::class);
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return JenisKontrak::all();
                }),
        ];
    }
}
