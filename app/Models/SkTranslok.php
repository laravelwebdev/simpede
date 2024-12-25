<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class SkTranslok extends Model
{
    use LaraCache;

    protected $casts = [
        'tanggal' => 'date',
    ];

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return SkTranslok::all();
                }),
        ];
    }

}
