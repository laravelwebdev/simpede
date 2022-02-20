<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        $prefix = '';
        if ($this->jenis == 'Surat Biasa') {
            $prefix = 'B-';
        }
        $kode = Helper::kodeSurat($this->k4, Auth::user()->unit);
        $this->attributes['s1'] = (new Helper)->nomor($value, 'surats', $kode, $prefix)->segmen;
        $this->attributes['nomor'] = (new Helper)->nomor($value, 'surats', $kode, $prefix)->nomor;
    }
}
