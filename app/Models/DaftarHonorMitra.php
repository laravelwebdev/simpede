<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarHonorMitra extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::saving(function (DaftarHonorMitra $honor) {
            if ($honor->isDirty()) {
                HonorKegiatan::find($honor->honor_kegiatan_id)->update(['status' => 'dibuat']);
            }
        });
        static::deleting(function (DaftarHonorMitra $honor) {
            HonorKegiatan::find($honor->honor_kegiatan_id)->update(['status' => 'dibuat']);
        });
    }
}
