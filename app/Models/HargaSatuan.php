<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class HargaSatuan extends Model
{
    use LaraCache;

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    /**
     * Get the daftar mata anggaran.
     */
    public function jenisKontrak(): HasMany
    {
        return $this->hasMany(JenisKontrak::class);
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return HargaSatuan::all();
                }),
        ];
    }

    protected static function booted(): void
    {
        static::deleting(function (HargaSatuan $harga_satuan) {
            $jenisKontrakIds = JenisKontrak::where('harga_satuan_id', $harga_satuan->id)->pluck('id');
            JenisKontrak::cache()->disable();
            JenisKontrak::destroy($jenisKontrakIds);
            JenisKontrak::cache()->enable();
            JenisKontrak::cache()->updateAll();
        });
    }
}
