<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class TindakLanjut extends Model
{
    protected $casts = [
        'penanggung_jawab' => 'array',
        'deadline' => 'date',
    ];

    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function perjanjianKinerja(): BelongsToMany
    {
        return $this->belongsToMany(PerjanjianKinerja::class);
    }

    public function pelaksanaanTindakLanjut(): HasMany
    {
        return $this->hasMany(PelaksanaanTindakLanjut::class);
    }

    protected static function booted(): void
    {
        static::creating(function (TindakLanjut $tindak_lanjut) {
            $tindak_lanjut->triwulan = 1;
            $deadlines = [
                1 => now()->setDate(now()->year, 6, 30),
                2 => now()->setDate(now()->year, 9, 30),
                3 => now()->setDate(now()->year, 12, 31),
                4 => now()->setDate(now()->year + 1, 3, 31),
            ];
            $tindak_lanjut->deadline = $deadlines[$tindak_lanjut->triwulan] ?? null;
            $tindak_lanjut->tahun = session('year');
            $tindak_lanjut->unit_kerja_id = Helper::getDataPegawaiByUserId(Auth::user()->id, now())->unit_kerja_id;
        });
    }
}