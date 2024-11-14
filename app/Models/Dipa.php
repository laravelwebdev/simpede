<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class Dipa extends Model
{
    use LaraCache;

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the daftar mata anggaran.
     */
    public function mataAnggaran(): HasMany
    {
        return $this->hasMany(MataAnggaran::class);
    }

    public function targetSerapanAnggaran(): HasMany
    {
        return $this->hasMany(TargetSerapanAnggaran::class);
    }

    /**
     * Get the daftar kamus anggaran.
     */
    public function kamusAnggaran(): HasMany
    {
        return $this->hasMany(KamusAnggaran::class);
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return Dipa::all();
                }),
        ];
    }

    protected static function booted(): void
    {
        static::deleting(function (Dipa $dipa) {
            $kamusAnggaranIds = KamusAnggaran::where('dipa_id', $dipa->id)->pluck('id');
            KamusAnggaran::cache()->disable();
            KamusAnggaran::destroy($kamusAnggaranIds);
            KamusAnggaran::cache()->enable();
            KamusAnggaran::cache()->update('all');
            $mataAnggaranIds = MataAnggaran::where('dipa_id', $dipa->id)->pluck('id');
            MataAnggaran::cache()->disable();
            MataAnggaran::destroy($mataAnggaranIds);
            MataAnggaran::cache()->enable();
            MataAnggaran::cache()->update('all');
            $targetIds = TargetSerapanAnggaran::where('dipa_id', $dipa->id)->pluck('id');
            TargetSerapanAnggaran::cache()->disable();
            TargetSerapanAnggaran::destroy($targetIds);
            TargetSerapanAnggaran::cache()->enable();
            TargetSerapanAnggaran::cache()->update('all');
        });
    }
}
