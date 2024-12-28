<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarReminder extends Model
{
    protected $fillable = [
        'tanggal',
        'daftar_kegiatan_id',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function daftarKegiatan(): BelongsTo
    {
        return $this->belongsTo(DaftarKegiatan::class);
    }

    protected static function booted(): void
    {
        static::creating(function (DaftarReminder $daftar) {
            $daftar->status = 'in progress';
        });
    }
}
