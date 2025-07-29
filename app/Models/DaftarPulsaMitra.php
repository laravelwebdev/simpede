<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarPulsaMitra extends Model
{
    protected $fillable = ['mitra_id', 'pulsa_kegiatan_id'];

    public function pulsaKegiatan(): BelongsTo
    {
        return $this->belongsTo(PulsaKegiatan::class, 'pulsa_kegiatan_id');
    }

    public function mitra(): BelongsTo
    {
        return $this->belongsTo(Mitra::class);
    }

    protected static function booted(): void
    {
        static::creating(function (DaftarPulsaMitra $pulsa) {
            $pulsa->confirmed = false;
        });
    }

    public static function getNominalByMitraIdAndKegiatanId(int $mitraId, int $kegiatanId): ?int
    {
        return self::where('mitra_id', $mitraId)
            ->where('pulsa_kegiatan_id', $kegiatanId)
            ->value('nominal');
    }
}
