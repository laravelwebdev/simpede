<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponRate extends Model
{
    protected static function booted(): void
    {
        static::creating(function (ResponRate $responRate) {
            $responRate->tahun = session('year');
        });
    }
}
