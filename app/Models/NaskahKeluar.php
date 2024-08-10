<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NaskahKeluar extends Model
{
    use HasFactory;
    protected $casts = [
        'tanggal' => 'date',
        'tanggal_kirim' => 'date',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saving(function (NaskahKeluar $naskah) {
            if ($naskah->isDirty('kode_naskah_id')) {
            $nomor = (new Helper)::nomor(session('year'), $naskah->kode_naskah_id, Auth::user()->unit_kerja_id, $naskah->kode_arsip_id, $naskah->derajat);
            $naskah->nomor = $nomor['nomor'];
            $naskah->no_urut = $nomor['no_urut'];
            $naskah->tahun = session('year');
        }
        });
    }


}
