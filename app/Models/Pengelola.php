<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class Pengelola extends Model
{
    use LaraCache;

    protected $casts = [
        'active' => 'date',
        'inactive' => 'date',
    ];

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
