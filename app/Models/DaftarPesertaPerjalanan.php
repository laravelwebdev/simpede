<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPesertaPerjalanan extends Model
{
    protected $casts = [
        'tanggal_berangkat' => 'date',
        'tanggal_kembali' => 'date',
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

    protected static function booted(): void
    {
        static::creating(function (DaftarPesertaPerjalanan $daftar) {
            $perjalanan = PerjalananDinas::find($daftar->perjalanan_dinas_id);
            $daftar->tanggal_berangkat = $perjalanan->tanggal_berangkat;
            $daftar->tanggal_kembali = $perjalanan->tanggal_kembali;
        });
    }
}
