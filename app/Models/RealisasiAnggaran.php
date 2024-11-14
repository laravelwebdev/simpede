<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealisasiAnggaran extends Model
{
    protected $casts = [
        'tanggal_sp2d' => 'date',
    ];
    protected $fillable = ['coa_id', 'dipa_id' ,'nomor_sp2d'];
}
