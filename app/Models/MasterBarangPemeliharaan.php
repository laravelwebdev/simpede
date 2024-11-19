<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class MasterBarangPemeliharaan extends Model
{
    use LaraCache;

    protected $fillable = ['kode_barang', 'nup'];

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return MasterBarangPemeliharaan::all();
                }),
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function daftarPemeliharaan():HasMany
    {
        return $this->hasMany(DaftarPemeliharaan::class);
    }


    protected static function booted(): void
    {
        static::deleting(function (MasterBarangPemeliharaan $barang) {
                $barang->daftarPemeliharaan->each->delete();
        });
    }
}
