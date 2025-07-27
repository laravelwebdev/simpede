<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class LimitPulsa extends Model
{
    use LaraCache;

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return LimitPulsa::all();
                }),
        ];
    }

    public function jenisPulsa(): HasMany
    {
        return $this->hasMany(JenisPulsa::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (PulsaKegiatan $pulsa) {
            $jenisPulsaIds = JenisPulsa::where('limit_pulsa_id', $pulsa->id)->pluck('id');
            JenisPulsa::cache()->disable();
            JenisPulsa::destroy($jenisPulsaIds);
            JenisPulsa::cache()->enable();
            JenisPulsa::cache()->updateAll();
        });
    }
}
