<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanPersediaan extends Model
{
    use HasFactory;
    protected $casts = [
        'tanggal_permintaan' => 'date',
        'tanggal_persetujuan' => 'date',
    ];
}
