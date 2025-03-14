<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class Template extends Model
{
    use LaraCache;

    protected $fillable = [
        'nama',
        'jenis',
        'file',
    ];

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return Template::all();
                }),
        ];
    }
}
