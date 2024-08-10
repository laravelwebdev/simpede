<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class Pengelola extends Model
{
    use HasFactory, LaraCache;

    /**
     * Get the user that owns the pengelola.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return Pengelola::all();
                }),
        ];
    }
}
