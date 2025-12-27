<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipDokumen extends Model
{
    protected $fillable = ['slug', 'file', 'kak_sp2d_id', 'tanggal_dokumen', 'jumlah_halaman'];

    public function kakSp2d()
    {
        return $this->belongsTo(KakSp2d::class);
    }

    protected function casts(): array
    {
        return [
            'tanggal_dokumen' => 'date',
        ];
    }
}
