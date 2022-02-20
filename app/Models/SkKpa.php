<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SkKpa extends Model
{
    use HasFactory;
    protected $casts = [
        'tanggal' => 'date',
    ];

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = $value;
        $this->attributes['s1'] = (new Helper)->nomor($value, 'sk_kpas', '/KPA', '', 'sk')->segmen;
        $this->attributes['nomor'] = (new Helper)->nomor($value, 'sk_kpas', '/KPA', '', 'sk')->nomor;
    }
}
