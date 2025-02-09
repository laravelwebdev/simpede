<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DaftarSp2d extends Model
{
    protected function casts(): array
    {
        return [
            'tanggal_sp2d' => 'date',
        ];
    }

    protected $fillable = ['dipa_id', 'nomor_sp2d'];

    public function kerangkaAcuan(): BelongsToMany
    {
        return $this->belongsToMany(KerangkaAcuan::class, 'kak_sp2d')
            ->using(KakSp2d::class);
    }

    public function realisasiAnggaran(): HasMany
    {
        return $this->hasMany(RealisasiAnggaran::class);
    }
}
