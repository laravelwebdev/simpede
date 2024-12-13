<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class KakSp2d extends Pivot
{
    protected $table = 'kak_sp2d';
    
    protected static function booted(): void
    {
        static::saving(function (KakSp2d $kakSp2d) {
            $kakSp2d->status = 'dibuat';
        });
        static::deleting(function (KakSp2d $kakSp2d) {
            $kakSp2d->status = 'dihapus';
        });
    }
}
