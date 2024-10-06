<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'tahun', 'bulan', 'jenis_kontrak' ,'jenis_honor', 'honor_kegiatan_id'];

    protected $casts = [
        'tanggal' => 'date',
        'awal_kontrak' => 'date',
        'akhir_kontrak' => 'date',
        'tanggal_bast' => 'date',
        'tanggal_spk' => 'date',
    ];

}
