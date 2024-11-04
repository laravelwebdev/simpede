<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class DataPegawai extends Model
{
    use LaraCache;

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the unit kerja that owns the user.
     */
    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function setGolonganAttribute($value)
    {
        $this->attributes['golongan'] = $value;
        $this->attributes['pangkat'] = Helper::$pangkat[$value];
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return DataPegawai::all();
                }),
        ];
    }
}
