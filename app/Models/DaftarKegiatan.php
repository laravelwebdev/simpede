<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarKegiatan extends Model
{
    protected $fillable = [
        'rapat_internal_id',
        'jenis',
        'awal',
    ];

    protected $casts = [
        'awal' => 'datetime',
        'akhir' => 'datetime',
    ];
}
