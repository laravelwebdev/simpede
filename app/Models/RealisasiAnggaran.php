<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealisasiAnggaran extends Model
{
    protected $casts = [
        'tanggal_sp2d' => 'date',
    ];
    protected $fillable = ['dipa_id', 'mata_anggaran_id' ,'nomor_sp2d'];

}
