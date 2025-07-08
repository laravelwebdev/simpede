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
            $nilai_kinerja = 0.45 * $penilaian->nilai_skp;
            $nilai_kehadiran = (100 / $penilaian->hk) * ($penilaian->hd + 0.5 * $penilaian->cst + 0.5 * $penilaian->tb);
            $nilai_disiplin = 0.1 * ($nilai_kehadiran - (100 * $penilaian->tk + 10 * ($penilaian->tl4 + $penilaian->psw4) + 7.5 * ($penilaian->tl3 + $penilaian->psw3) + 5 * ($penilaian->tl2 + $penilaian->psw2) + 2.5 * ($penilaian->tl1 + $penilaian->psw1)));
            $nilai_perilaku = 0.45 * $penilaian->nilai_perilaku;
            $penilaian->nilai_kinerja = $nilai_kinerja;
            $penilaian->nilai_disiplin = $nilai_disiplin;
            $penilaian->nilai_perilaku = $nilai_perilaku;
            $penilaian->nilai_total = $nilai_kinerja + $nilai_disiplin + $nilai_perilaku;
        });
    }
}
