<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class TataNaskah extends Model
{
    use LaraCache;

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the daftar mata anggaran.
     */
    public function kodeArsip(): HasMany
    {
        return $this->hasMany(KodeArsip::class);
    }

    public function kodeNaskah(): HasMany
    {
        return $this->hasMany(KodeNaskah::class);
    }

    public function derajatNaskah(): HasMany
    {
        return $this->hasMany(DerajatNaskah::class);
    }

    public function naskahDefault(): HasMany
    {
        return $this->hasMany(NaskahDefault::class);
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return TataNaskah::all();
                }),
        ];
    }

    protected static function booted(): void
    {
        static::deleting(function (TataNaskah $tata_naskah) {
            $kodeArsipIds = KodeArsip::where('tata_naskah_id', $tata_naskah->id)->pluck('id');
            KodeArsip::cache()->disable();
            KodeArsip::destroy($kodeArsipIds);
            KodeArsip::cache()->enable();
            KodeArsip::cache()->update('all');
            $derajatnaskahIds = DerajatNaskah::where('tata_naskah_id', $tata_naskah->id)->pluck('id');
            DerajatNaskah::cache()->disable();
            DerajatNaskah::destroy($derajatnaskahIds);
            DerajatNaskah::cache()->enable();
            DerajatNaskah::cache()->update('all');
            $kodenaskahIds = KodeNaskah::where('tata_naskah_id', $tata_naskah->id)->pluck('id');
            KodeNaskah::cache()->disable();
            KodeNaskah::destroy($kodenaskahIds);
            KodeNaskah::cache()->enable();
            KodeNaskah::cache()->update('all');
            $naskahDefaultIds = NaskahDefault::where('tata_naskah_id', $tata_naskah->id)->pluck('id');
            NaskahDefault::cache()->disable();
            NaskahDefault::destroy($naskahDefaultIds);
            NaskahDefault::cache()->enable();
            NaskahDefault::cache()->update('all');
        });
    }
}
