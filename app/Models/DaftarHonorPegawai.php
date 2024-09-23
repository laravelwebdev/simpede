<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\HonorKegiatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarHonorPegawai extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::saving(function (DaftarHonorPegawai $honor) {
            $honor->nama = Helper::getPropertyFromCollection(Helper::getPegawaiByNip($honor->nik),'name');
            $honor->golongan = Helper::getPropertyFromCollection(Helper::getDataPegawaiByNip($honor->nik, HonorKegiatan::where('id',$honor->honor_kegiatan_id )->first()->tanggal_spj),'golongan');
            $honor->bruto = $honor->volume * $honor->harga_satuan;
            $honor->pajak = round($honor->pajak * $honor->bruto /100,0, PHP_ROUND_HALF_UP);
            $honor->netto = $honor->bruto - $honor->pajak;
        });
    }
}
