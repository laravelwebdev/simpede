<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumentasiKegiatan extends Model
{
    protected $casts = [
        'tanggal' => 'date',
        'file' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
