<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarReminder extends Model
{
    protected $fillable = [
        'tanggal',
        'daftar_kegiatan_id',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function daftarKegiatan(): BelongsTo
    {
        return $this->belongsTo(DaftarKegiatan::class);
    }
}