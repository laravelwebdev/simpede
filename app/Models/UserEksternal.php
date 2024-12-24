<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class UserEksternal extends Model
{
    use LaraCache;

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
                    return UserEksternal::all();
                }),
        ];
    }
}
