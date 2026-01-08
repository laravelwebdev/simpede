<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class Announcement extends Model
{
    use LaraCache;

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('latest')
                ->cache(function () {
                    return Announcement::where('jenis', 'pengumuman')->latest()->take(3)->get();
                }),
            CacheEntity::make('aplikasi')
                ->cache(function () {
                    return Announcement::where('jenis', 'aplikasi')->get();
                }),
        ];
    }
}
