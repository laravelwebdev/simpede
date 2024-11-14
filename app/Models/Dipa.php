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
        static::created(function (Dipa $dipa) {
            for ($bulan = 1; $bulan <= 12; $bulan++) {
            $target = new TargetSerapanAnggaran();
            $target->dipa_id = $dipa->id;
            $target->bulan = $bulan;
            $target->belanja51 = 0;
            $target->belanja52 = 0;
            $target->belanja53 = 0;
            $target->belanja54 = 0;
            $target->belanja55 = 0;
            $target->belanja56 = 0;
            $target->belanja57 = 0;
            $target->belanja58 = 0;            
            $target->save();
            }
        });
    }
}
