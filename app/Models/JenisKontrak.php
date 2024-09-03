<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class JenisKontrak extends Model
{
    use HasFactory, LaraCache;
    protected $casts = [
        'tanggal' => 'date',
        'jenis' => 'array',
    ];

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return JenisKontrak::all();
                }),
        ];
    }

}
