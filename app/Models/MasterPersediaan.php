<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class MasterPersediaan extends Model
{
    use LaraCache;

    protected $fillable = ['kode'];

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return MasterPersediaan::all();
                }),
        ];
    }
}
