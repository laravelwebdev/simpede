<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RapatInternal extends Model
{
    protected $casts = [
        'tanggal' => 'date',
        'tanggal_rapat' => 'date',
        'peserta' => 'array',
    ];

    public function kasubbag()
    {
        return $this->belongsTo(User::class, 'kasubbag_user_id');
    }

    public function pimpinan()
    {
        return $this->belongsTo(User::class, 'pimpinan_user_id');
    }

    public function kepala()
    {
        return $this->belongsTo(User::class, 'kepala_user_id');
    }

    public function notulis()
    {
        return $this->belongsTo(User::class, 'notulis_user_id');
    }

    public function naskahKeluar()
    {
        return $this->belongsTo(NaskahKeluar::class);
    }

    
}
