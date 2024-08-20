<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HonorSurvei extends Model
{
    use HasFactory;
    protected $casts = [
        'tanggal_spj' => 'date',
        'akhir' => 'date',      
    ];
    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (HonorSurvei $honor) {
            $honor->tahun = session('year');
            $honor->ppk = Helper::getPengelola('ppk')->nama;
            $honor->nipppk = Helper::getPengelola('ppk')->nip;
            $honor->bendahara = Helper::getPengelola('bendahara')->nama;
            $honor->nipbendahara = Helper::getPengelola('bendahara')->nip;
        });
    }
}
