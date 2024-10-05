<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakBulanan extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'tahun', 'bulan','jenis_kontrak'];

    protected $casts = [
        'tanggal' => 'date',
        'awal_kontrak' => 'date',
        'akhir_kontrak' => 'date',
        'tanggal_bast' => 'date',
        'tanggal_spk' => 'date',
    ];

}
