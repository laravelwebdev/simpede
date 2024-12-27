<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarKegiatan extends Model
{
    protected $fillable = [
        'rapat_internal_id',
        'jenis',
        'awal',
    ];

    protected $casts = [
        'awal' => 'datetime',
        'akhir' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (DaftarKegiatan $daftar) {
            if (empty($daftar->akhir)) {
                $daftar->akhir = $daftar->awal;
            }
        });
    }
}
