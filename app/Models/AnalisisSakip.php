<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

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

    public function perjanjianKinerja(): BelongsToMany
    {
        return $this->belongsToMany(PerjanjianKinerja::class);
    }

    protected static function booted(): void
    {
        static::creating(function (AnalisisSakip $analisis) {
            $analisis->tahun = session('year');
            $analisis->unit_kerja_id = Helper::getDataPegawaiByUserId(Auth::user()->id, now())->unit_kerja_id;
        });
    }
}
