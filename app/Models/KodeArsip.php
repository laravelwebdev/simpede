<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class KodeArsip extends Model
{
    use LaraCache;

    protected $fillable = ['detail', 'tata_naskah_id', 'kode'];

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return KodeArsip::all();
                }),
        ];
    }
}
