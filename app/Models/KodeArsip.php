<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class KodeArsip extends Model
{
    use HasFactory, LaraCache;

    protected $guarded = [];

    public function tataNaskah(): BelongsTo
    {
        return $this->belongsTo(TataNaskah::class);
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return KodeArsip::all();
                }),
        ];
    }
}
