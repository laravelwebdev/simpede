<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarKegiatan extends Model
{
    protected $casts = [
        'awal' => 'datetime',
        'akhir' => 'datetime',
    ];
}
