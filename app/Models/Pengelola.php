<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class Pengelola extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    use LaraCache;

    public function casts(): array
    {
        return [
            'active' => 'date',
            'inactive' => 'date',
        ];
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
