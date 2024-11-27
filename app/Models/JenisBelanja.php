<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class JenisBelanja extends Model
{
    use LaraCache;

    protected $fillable = ['kode', 'dipa_id'];

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return JenisBelanja::all();
                }),
        ];
    }

    public function dipa(): BelongsTo
    {
        return $this->belongsTo(Dipa::class);
    }

    public function targetSerapanAnggaran(): HasMany
    {
        return $this->hasMany(TargetSerapanAnggaran::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (JenisBelanja $jenis) {
            $targetIds = TargetSerapanAnggaran::where('jenis_belanja_id', $jenis->id)->pluck('id');
            TargetSerapanAnggaran::cache()->disable();
            TargetSerapanAnggaran::destroy($targetIds);
            TargetSerapanAnggaran::cache()->enable();
            TargetSerapanAnggaran::cache()->updateAll();
        });
        static::created(function (JenisBelanja $jenis) {
            foreach (range(1, 12) as $bulan) {
                $targetSerapan = new TargetSerapanAnggaran;
                $targetSerapan->jenis_belanja_id = $jenis->id;
                $targetSerapan->bulan = $bulan;
                $targetSerapan->nilai = 100;
                $targetSerapan->save();
            }
        });
    }
}
