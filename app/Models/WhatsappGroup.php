<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class WhatsappGroup extends Model
{
    use LaraCache;

    protected $fillable = [
        'group_id',
    ];

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return WhatsappGroup::all();
                }),
        ];
    }
}
