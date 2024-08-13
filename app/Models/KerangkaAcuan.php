<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
