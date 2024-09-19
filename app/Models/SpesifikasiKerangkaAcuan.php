<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesifikasiKerangkaAcuan extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::saving(function (SpesifikasiKerangkaAcuan $spesifikasi) {
            $spesifikasi->total_harga = $spesifikasi->volume * $spesifikasi->harga_satuan;
        });
    }
}
