<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Storage;

class KakSp2d extends Pivot
{
    protected $table = 'kak_sp2d';
    
    protected static function booted(): void
    {
        static::saving(function (KakSp2d $kakSp2d) {
           Storage::disk('arsip')
           ->copy(DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->arsip_spm, 
           DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
        });
        static::deleting(function (KakSp2d $kakSp2d) {
            $kakSp2d->status = 'dihapus';
        });
    }
}
