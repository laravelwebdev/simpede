<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class NaskahDefault extends Model
{
    use HasFactory, LaraCache;

    protected $casts = [
        'kode_arsip_id' => 'array',
    ];

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
