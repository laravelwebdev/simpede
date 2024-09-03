<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
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
                $nomor = Helper::nomor($naskah->tanggal, $naskah->jenis_naskah_id, Auth::user()->unit_kerja_id, $naskah->kode_arsip_id, $naskah->derajat);
                $naskah->nomor = $nomor['nomor'];
                $naskah->no_urut = $nomor['no_urut'];
                $naskah->segmen = $nomor['segmen'];
                $naskah->tahun = Carbon::createFromFormat('Y-m-d', $naskah->tanggal->format('Y-m-d'))->year;
            }
        });
        static::creating(function (NaskahKeluar $naskah) {           
            $naskah->unit_kerja_id = Auth::user()->unit_kerja_id;
        });
    }
}
