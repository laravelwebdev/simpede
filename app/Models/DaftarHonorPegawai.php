<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarHonorPegawai extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::saving(function (DaftarHonorPegawai $honor) {
            if ($honor->isDirty()) {
                $honorKegiatan = HonorKegiatan::find($honor->honor_kegiatan_id);
                $honorKegiatan->status = 'outdated';
                $honorKegiatan->save();
            }
            if (! $honor->volume) {
                $honor->harga_satuan = null;
                $honor->persen_pajak = null;
            }
        });
        static::deleting(function (DaftarHonorPegawai $honor) {
            $honorKegiatan = HonorKegiatan::find($honor->honor_kegiatan_id);
            $honorKegiatan->status = 'outdated';
            $honorKegiatan->save();
        });
    }
}
