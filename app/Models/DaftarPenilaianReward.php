<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarPenilaianReward extends Model
{
    protected $fillable = [
        'reward_pegawai_id',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rewardPegawai(): BelongsTo
    {
        return $this->belongsTo(RewardPegawai::class);
    }

    protected static function booted(): void
    {
        static::saving(function (DaftarPenilaianReward $penilaian) {
            $nilai_kinerja = 0.6 * $penilaian->nilai_skp;
            $nilai_disiplin = 0.2 * (100 - (100 * $penilaian->tk + 50 * ($penilaian->tl4 + $penilaian->psw4) + 30 * ($penilaian->tl3 + $penilaian->psw3) + 20 * ($penilaian->tl2 + $penilaian->psw2) + 10 * ($penilaian->tl1 + $penilaian->psw1)));
            $nilai_disiplin_abs = $nilai_disiplin > 0 ? $nilai_disiplin : 0;
            $nilai_beban = 0.2 * 4 * $penilaian->jumlah_butir;
            $nilai_beban_abs = $nilai_beban <= 100 ? $nilai_beban : 100;
            $penilaian->nilai_kinerja = $nilai_kinerja;
            $penilaian->nilai_disiplin = $nilai_disiplin_abs;
            $penilaian->nilai_beban = $nilai_beban_abs;
            $penilaian->nilai_total = $nilai_kinerja + $nilai_disiplin_abs + $nilai_beban_abs;
        });
    }
}
