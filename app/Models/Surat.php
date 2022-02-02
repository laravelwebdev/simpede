<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $casts = [
        'tanggal' => 'date',
        'kirim' => 'date',
    ];

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = $value;
        $this->attributes['s1'] = (new Helper)->nomor($value, 'surats', 'BPS')->segmen;
        $this->attributes['nomor'] = (new Helper)->nomor($value, 'surats', 'BPS')->nomor;
    }
}
