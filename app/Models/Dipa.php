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
            'tanggal_nihil' => 'date',
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

    public function targetKkp(): HasMany
    {
        return $this->hasMany(TargetKkp::class);
    }

    public function uangPersediaan(): HasMany
    {
        return $this->hasMany(UangPersediaan::class);
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
            $kkpIds = TargetKkp::where('dipa_id', $dipa->id)->pluck('id');
            TargetKkp::cache()->disable();
            TargetKkp::destroy($kkpIds);
            TargetKkp::cache()->enable();
            TargetKkp::cache()->updateAll();
            $uangPersediaan = UangPersediaan::where('dipa_id', $dipa->id)->pluck('id');
            UangPersediaan::destroy($uangPersediaan);
            $realisasiIds = RealisasiAnggaran::where('dipa_id', $dipa->id)->pluck('id');
            RealisasiAnggaran::destroy($realisasiIds);
        });
        static::created(function (Dipa $dipa) {
            foreach (range(1, 12) as $bulan) {
                $targetKkp = new TargetKkp;
                $targetKkp->dipa_id = $dipa->id;
                $targetKkp->bulan = $bulan;
                $targetKkp->nilai = 0;
                $targetKkp->save();
            }
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
                    $query->where('mak', 'like', '%'.$keyword.'%')
                        ->orWhere('uraian', 'like', '%'.$keyword.'%');
                }

                return $query;
            })
            ->orderBy('mak')
            ->orderBy('ordered');
    }
}
