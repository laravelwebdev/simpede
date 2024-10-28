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
            if ($spesifikasi->isDirty()) {
                $kerangkaAcuan = KerangkaAcuan::find($spesifikasi->kerangka_acuan_id);
                $kerangkaAcuan->status = 'outdated';
                $kerangkaAcuan->save();
            }
        });
        static::deleting(function (SpesifikasiKerangkaAcuan $spesifikasi) {
            $kerangkaAcuan = KerangkaAcuan::find($spesifikasi->kerangka_acuan_id);
            $kerangkaAcuan->status = 'outdated';
            $kerangkaAcuan->save();
        });
    }
}
