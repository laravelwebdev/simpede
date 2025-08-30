<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class TargetKkp extends Model
{
    use LaraCache;

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return TargetKkp::all();
                }),
        ];
    }

    public function dipa(): BelongsTo
    {
        return $this->belongsTo(Dipa::class);
    }
}
