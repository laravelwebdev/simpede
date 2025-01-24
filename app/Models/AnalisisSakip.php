<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnalisisSakip extends Model
{
    protected $casts = [
        'bukti_solusi' => 'array',
        'indikator' => 'array',
    ];

    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class);
    }

    protected static function booted(): void
    {
        static::creating(function (AnalisisSakip $analisis) {
            $analisis->tahun = session('year');
        });
    }
}
