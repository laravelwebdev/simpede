<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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

    public function daftarKegiatanable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function booted(): void
    {
        static::saving(function (DaftarKegiatan $daftar) {
            if (empty($daftar->akhir)) {
                $daftar->akhir = $daftar->awal;
            }
        });
    }
}
