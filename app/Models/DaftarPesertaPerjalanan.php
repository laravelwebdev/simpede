<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPesertaPerjalanan extends Model
{
    protected $casts = [
        'spesifikasi' => 'array',
        'tanggal_kuitansi' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function perjalananDinas()
    {
        return $this->belongsTo(PerjalananDinas::class);
    }

}
