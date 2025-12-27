<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ArsipKeuangan extends Model
{
    public function daftarBerkas(): HasOne
    {
        return $this->hasOne(KakSp2d::class);
    }

    public function arsipDokumens(): HasManyThrough
    {
        return $this->hasManyThrough(
            ArsipDokumen::class,
            KakSp2d::class,
            'arsip_keuangan_id', // FK di KAKSp2d
            'kak_sp2d_id',       // FK di ArsipDokumen
            'id',                // PK di ArsipKeuangan
            'id'                 // PK di KAKSp2d
        );
    }

    protected static function booted(): void
    {
        static::creating(function (ArsipKeuangan $arsipKeuangan) {
            $arsipKeuangan->kurun_awal = session('year');
            $arsipKeuangan->kurun_akhir = '';
            DB::transaction(function () use ($arsipKeuangan) {
                $maxNomor = self::where('kurun_awal', session('year'))
                    ->lockForUpdate()
                    ->max('nomor');
                $arsipKeuangan->nomor = ($maxNomor ?? 0) + 1;
            });
        });
    }
}
