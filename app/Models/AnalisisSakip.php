<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalisisSakip extends Model
{
    protected $casts = [
        'penanggung_jawab' => 'array',
        'bukti_tl' => 'array',
        'bukti_solusi' => 'array',
    ];

}
