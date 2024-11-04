<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanPersediaan extends Model
{
    protected $casts = [
        'tanggal_permintaan' => 'date',
        'tanggal_persetujuan' => 'date',
    ];
}
