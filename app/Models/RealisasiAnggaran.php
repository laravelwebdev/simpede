<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RealisasiAnggaran extends Model
{
    protected $fillable = ['dipa_id', 'mata_anggaran_id', 'daftar_sp2d_id'];

    public function daftarSp2d(): BelongsTo
    {
        return $this->belongsTo(DaftarSp2d::class);
    }

    public function mataAnggaran(): BelongsTo
    {
        return $this->belongsTo(MataAnggaran::class);
    }
}
