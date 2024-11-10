<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class NaskahDefault extends Model
{
    use LaraCache;

    protected $casts = [
        'kode_arsip_id' => 'array',
    ];

    public function jenisNaskah(): BelongsTo
    {
        return $this->belongsTo(JenisNaskah::class);
    }

    public function derajatNaskah(): BelongsTo
    {
        return $this->belongsTo(DerajatNaskah::class);
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return NaskahDefault::all();
                }),
        ];
    }
}
