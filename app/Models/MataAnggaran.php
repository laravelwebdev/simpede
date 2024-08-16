<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class MataAnggaran extends Model
{
    use HasFactory, LaraCache;
    protected $fillable =['mak','tahun'];

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return MataAnggaran::all();
                }),
        ];
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (MataAnggaran $mak) {
            if (session('role') === 'koordinator') 
                $mak->tahun = session('year');
        });
    }
}
