<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class RateTranslok extends Model
{
    use LaraCache;
    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return RateTranslok::all();
                }),
        ];
    }
    protected $fillable = [
        'type',
        'sk_translok_id',
        'asal_master_wilayah_id',
        'tujuan_master_wilayah_id',

    ];
    public function getTitleAttribute()
    {
        return "{$this->asalMasterWilayah->wilayah} - {$this->tujuanMasterWilayah->wilayah} ({$this->skTranslok->tahun})";
    }

    public function skTranslok(): BelongsTo
    {
        return $this->belongsTo(SkTranslok::class);
    }

    public function asalMasterWilayah(): BelongsTo
    {
        return $this->belongsTo(MasterWilayah::class, 'asal_master_wilayah_id');
    }

    public function tujuanMasterWilayah(): BelongsTo
    {
        return $this->belongsTo(MasterWilayah::class, 'tujuan_master_wilayah_id');
    }


    
}
