<?php

namespace App\Models;

use App\Models\JenisPulsa;
use Mostafaznv\LaraCache\CacheEntity;
use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\Traits\LaraCache;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
