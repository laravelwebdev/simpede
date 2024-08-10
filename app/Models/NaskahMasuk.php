<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaskahMasuk extends Model
{
    use HasFactory;
    protected $casts = [
        'tanggal' => 'date',
    ];
}
