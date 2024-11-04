<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class UnitKerja extends Model
{
    use LaraCache;

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return UnitKerja::all();
                }),
        ];
    }
}
