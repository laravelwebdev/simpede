<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class Dipa extends Model
{
    use LaraCache;

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'tanggal_revisi' => 'date',
            'tanggal_realisasi' => 'date',
        ];
    }

    /**
     * Get the daftar mata anggaran.
     */
    public function mataAnggaran(): HasMany
    {
        return $this->hasMany(MataAnggaran::class);
    }

    public function jenisBelanja(): HasMany
    {
        return $this->hasMany(JenisBelanja::class);
    }

    /**
     * Get the daftar kamus anggaran.
     */
    public function kamusAnggaran(): HasMany
    {
        return $this->hasMany(KamusAnggaran::class);
    }

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return Dipa::all();
                }),
        ];
    }

    protected static function booted(): void
    {
        static::deleting(function (Dipa $dipa) {
            $kamusAnggaranIds = KamusAnggaran::where('dipa_id', $dipa->id)->pluck('id');
            KamusAnggaran::cache()->disable();
            KamusAnggaran::destroy($kamusAnggaranIds);
            KamusAnggaran::cache()->enable();
            KamusAnggaran::cache()->updateAll();
            $mataAnggaranIds = MataAnggaran::where('dipa_id', $dipa->id)->pluck('id');
            MataAnggaran::cache()->disable();
            MataAnggaran::destroy($mataAnggaranIds);
            MataAnggaran::cache()->enable();
            MataAnggaran::cache()->updateAll();
            $jenisIds = JenisBelanja::where('dipa_id', $dipa->id)->pluck('id');
            JenisBelanja::cache()->disable();
            JenisBelanja::destroy($jenisIds);
            JenisBelanja::cache()->enable();
            JenisBelanja::cache()->updateAll();
            $realisasiIds = RealisasiAnggaran::where('dipa_id', $dipa->id)->pluck('id');
            RealisasiAnggaran::destroy($realisasiIds);
        });
    }

    public static function getByTahun($tahun)
    {
        return self::where('tahun', $tahun)->first();
    }

    public static function getMataAnggarans($dipaId, $search)
    {
        return DB::table('mata_anggarans')
            ->select(['mak', 'id', 'uraian'])
            ->where('dipa_id', $dipaId)
            ->when($search, function ($query, $search) {
                $keywords = explode('.', $search);
                foreach ($keywords as $keyword) {
                    $query->where('mak', 'like', '%'.$keyword.'%');
                }

                return $query;
            })
            ->orderBy('mak')
            ->orderBy('ordered');
    }
}
