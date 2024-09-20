<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggaranKerangkaAcuan extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::saved(function (AnggaranKerangkaAcuan $anggaranKak) {
            if (Helper::isAkunHonor($anggaranKak->mak)) {
                $kak = KerangkaAcuan::find($anggaranKak->kerangka_acuan_id);
                if ($honor = HonorSurvei::where('kerangka_acuan_id', $kak->id)->first()) {
                    $honor->judul_spj = 'Daftar Honor Petugas '.strtr($kak->kegiatan, ['Pemeriksaan' => 'Pemeriksa', 'Pencacahan' => 'Pencacah', 'Pengawasan' => 'Pengawas']);
                    $honor->awal = $kak->awal;
                    $honor->akhir = $kak->akhir;
                    $honor->tanggal_kak = $kak->tanggal;
                    $honor->tanggal_spj = $kak->akhir;
                    $honor->mak = $anggaranKak->mak;
                    $honor->kegiatan = $kak->kegiatan;
                    if ($kak->wasChanged('tanggal')) {
                        $honor->generate_sk == 'Ya' ? $honor->tanggal_sk = $kak->tanggal : null;
                        $honor->generate_st == 'Ya' ? $honor->tanggal_st = $kak->tanggal : null;
                    }
                    $honor->save();
                } else {
                    $honor = new HonorSurvei;
                    $honor->kerangka_acuan_id = $kak->id;
                    $honor->judul_spj = 'Daftar Honor Petugas '.strtr($kak->kegiatan, ['Pemeriksaan' => 'Pemeriksa', 'Pencacahan' => 'Pencacah', 'Pengawasan' => 'Pengawas']);
                    $honor->awal = $kak->awal;
                    $honor->akhir = $kak->akhir;
                    $honor->mak = $anggaranKak->mak;
                    $honor->kegiatan = $kak->kegiatan;
                    $honor->uraian_tugas = 'Melakukan '.$kak->kegiatan;
                    $honor->objek_sk = 'Petugas '.strtr($kak->kegiatan, ['Pemeriksaan' => 'Pemeriksa', 'Pencacahan' => 'Pencacah', 'Pengawasan' => 'Pengawas']);
                    $honor->generate_sk = 'Ya';
                    $honor->generate_st = 'Ya';
                    $honor->tanggal_kak = $kak->tanggal;
                    $honor->tanggal_spj = $kak->akhir;
                    $honor->tanggal_st = $kak->tanggal;
                    $honor->tanggal_sk = $kak->tanggal;
                    $honor->unit_kerja_id = $kak->unit_kerja_id;
                    $honor->save();
                }
            }
            // if (Helper::isAkunHonorChanged($kak->getOriginal('anggaran'), $kak->anggaran)) {
            //     HonorSurvei::destroy($kak->id);
            // }
        });
    }
}
