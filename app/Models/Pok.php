<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pok extends Model
{
    use HasFactory;
    protected $casts = [
        'revisi' => 'date',
    ];

    protected $guarded = [];

    protected static function booted()
    {
        static::updating(function ($pok) {
            //set sisa
            $pok->sisa = $pok->jumlah - $pok->realisasi;
        });
    }
}
