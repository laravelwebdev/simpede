<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class ArsipKeuangan extends Model
{
    public function daftarBerkas(): HasMany
    {
        return $this->hasMany(KakSp2d::class);
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
