<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SK extends Model
{
    use HasFactory, SoftDeletes;
    protected $casts = [
        'tanggal' => 'date',
    ];

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = $value;
        $this->attributes['s1'] = (new Helper)->nomor($value, 's_k_s', '', '', 'sk')->segmen;
        $this->attributes['nomor'] = (new Helper)->nomor($value, 's_k_s', '', '', 'sk')->nomor;
    }
}
