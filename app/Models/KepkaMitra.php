<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class KepkaMitra extends Model
{
    use HasFactory, LaraCache;
    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return KepkaMitra::all();
                }),
        ];
    }
    public function mitra(): HasMany
    {
        return $this->hasMany(Mitra::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (KepkaMitra $kepkaMitra) {
            $mitraIds = Mitra::where('kepka_mitra_id', $kepkaMitra->id)->pluck('id');
            Mitra::cache()->disable();
            Mitra::destroy($mitraIds);
            Mitra::cache()->enable();
            Mitra::cache()->update('all');
        });
        static::creating(function (KepkaMitra $kepkaMitra) {
            $kepkaMitra->tahun = session('year');
        });
    }
}
