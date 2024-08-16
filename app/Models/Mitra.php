<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class Mitra extends Model
{
    use HasFactory, LaraCache;
    protected $fillable =['nik','nama','alamat','rekening','tahun'];
    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return Mitra::all();
                }),
        ];
    }
    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Mitra $mitra) {
            if (session('role') === 'koordinator') 
                $mitra->tahun = session('year');
        });
    }
}
