<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelaksanaanTindakLanjut extends Model
{
    protected $casts = [
        'bukti_dukung' => 'array',
    ];
}
