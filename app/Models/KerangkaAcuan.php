<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class KerangkaAcuan extends Model
{
    use HasFactory;

    protected $casts = [
        'tanggal' => 'date',
        'awal' => 'date',
        'akhir' => 'date',
        'spesifikasi' => 'array',
        'anggaran' => 'array',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (KerangkaAcuan $kak) {
                $nomor = (new Helper)::nomor(session('year'), 3 , 7, 118, 'B');
                $kak->nomor = $nomor['nomor'];
                $kak->no_urut = $nomor['no_urut'];
                $kak->nama = Auth::user()->nama;
                $kak->nip = Auth::user()->nip;
                $kak->jabatan = Auth::user()->jabatan;
                $kak->unit_kerja_id = Auth::user()->unit_kerja_id;
                $kak->ppk = (new Helper)->getPengelola('ppk')->nama;
                $kak->nipppk = (new Helper)->getPengelola('ppk')->nip;
                $kak->tahun = session('year');
                NaskahKeluar::create([
                    'tanggal' => $kak->tanggal,
                    'jenis_naskah_id' => 23,
                    'kode_arsip_id' => 118,
                    'unit_kerja_id' => 7,
                    'kode_naskah_id' => 3,
                    'derajat' => 'B',
                    'tujuan' => 'Pejabat Pembuat Komitmen',
                    'perihal' => 'Form Permintaan '. $kak->rincian,
                ]);
        });
        static::deleted(function (KerangkaAcuan $kak) {
            NaskahKeluar::where('nomor',$kak->nomor)->delete();
    });
    static::saving(function (KerangkaAcuan $kak) {
        if ($kak->jenis !== 'Penyedia') $kak->metode = null;
});
    }
}