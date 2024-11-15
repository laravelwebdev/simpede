<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class KamusAnggaran extends Model
{
    use LaraCache;

    protected $fillable = ['mak', 'dipa_id'];

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return KamusAnggaran::all();
                }),
            CacheEntity::make('program')
                ->cache(function () {
                    return KamusAnggaran::whereRaw('LENGTH(mak) = 9')->get();
                }),
            CacheEntity::make('kegiatan')
                ->cache(function () {
                    return KamusAnggaran::whereRaw('LENGTH(mak) = 14')->get();
                }),
            CacheEntity::make('kro')
                ->cache(function () {
                    return KamusAnggaran::whereRaw('LENGTH(mak) = 18')->get();
                }),
            CacheEntity::make('ro')
                ->cache(function () {
                    return KamusAnggaran::whereRaw('LENGTH(mak) = 22')->get();
                }),
            CacheEntity::make('komponen')
                ->cache(function () {
                    return KamusAnggaran::whereRaw('LENGTH(mak) = 26')->get();
                }),
            CacheEntity::make('sub')
                ->cache(function () {
                    return KamusAnggaran::whereRaw('LENGTH(mak) = 28')->get();
                }),
            CacheEntity::make('akun')
                ->cache(function () {
                    return KamusAnggaran::whereRaw('LENGTH(mak) = 37')->get();
                }),
        ];
    }
}
