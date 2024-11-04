<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class KodeNaskah extends Model
{
    use LaraCache;

    public function jenisNaskah(): HasMany
    {
        return $this->hasMany(JenisNaskah::class);
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return KodeNaskah::all();
                }),
        ];
    }

    protected static function booted(): void
    {
        static::deleting(function (KodeNaskah $kode_naskah) {
            $jenisNaskahIds = JenisNaskah::where('kode_naskah_id', $kode_naskah->id)->pluck('id');
            JenisNaskah::cache()->disable();
            JenisNaskah::destroy($jenisNaskahIds);
            JenisNaskah::cache()->enable();
            JenisNaskah::cache()->update('all');
        });
    }
}
