<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KakSp2d extends Model
{
    protected $fillable = [
        'kerangka_acuan_id',
        'daftar_sp2d_id',
    ];
    protected $table = 'kak_sp2d';
}
