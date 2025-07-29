<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class Mitra extends Model
{
    use LaraCache;

    protected $fillable = ['email', 'kepka_mitra_id', 'nik', 'updated_at'];

    public function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return Mitra::all();
                }),
        ];
    }

    public function daftarHonorMitra(): HasMany
    {
        return $this->hasMany(DaftarHonorMitra::class);
    }

    public function DaftarPulsaMitra(): HasMany
    {
        return $this->hasMany(DaftarPulsaMitra::class);
    }
}
