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
            if ($naskah->isDirty(['kode_naskah_id', 'tanggal'])) {
                $nomor = Helper::nomor($naskah->tanggal, session('year'), $naskah->kode_naskah_id, ($naskah->jenis_naskah_id == 23) ? 7 : Auth::user()->unit_kerja_id, $naskah->kode_arsip_id, $naskah->derajat);
                $naskah->nomor = $nomor['nomor'];
                $naskah->no_urut = $nomor['no_urut'];
                $naskah->segmen = $nomor['segmen'];
            }
        });
        static::creating(function (NaskahKeluar $naskah) {
            $naskah->tahun = session('year');
            $naskah->unit_kerja_id = ($naskah->jenis_naskah_id == 23) ? 7 : Auth::user()->unit_kerja_id;
        });
    }
}
