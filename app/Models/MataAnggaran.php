<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class MataAnggaran extends Model
{
    use LaraCache;

    protected $fillable = ['coa_id', 'dipa_id'];

    protected function casts(): array
    {
        return [
            'is_manual' => 'boolean',
            'is_pok' => 'boolean',
        ];
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return MataAnggaran::all();
                }),
        ];
    }

    /**
     * Get the daftar kamus anggaran.
     */
    public function realisasiAnggaran(): HasMany
    {
        return $this->hasMany(RealisasiAnggaran::class);
    }

    public function dipa(): BelongsTo
    {
        return $this->belongsTo(Dipa::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (MataAnggaran $mataAnggaran) {
            $Ids = RealisasiAnggaran::where('mata_anggaran_id', $mataAnggaran->id)->pluck('id');
            RealisasiAnggaran::destroy($Ids);
        });
        static::saving(function (MataAnggaran $mataAnggaran) {
            $mataAnggaran->jenis_belanja = substr($mataAnggaran->mak ?? '', 29, 2);
        });
    }
}
