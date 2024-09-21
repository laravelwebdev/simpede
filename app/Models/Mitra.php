<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class Mitra extends Model
{
    use HasFactory, LaraCache;
    protected $guarded = [];
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return Mitra::all();
                }),
        ];
    }
}
