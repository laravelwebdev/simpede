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
                $dipa = Dipa::cache()->get('all')->where('id', $kak->dipa_id)->first();
                if ($honor = HonorKegiatan::where('anggaran_kerangka_acuan_id', $anggaranKak->id)->first()) {
                    $honor->judul_spj = 'Daftar Honor Petugas '.strtr($kak->kegiatan, ['Pemeriksaan' => 'Pemeriksa', 'Pencacahan' => 'Pencacah', 'Pengawasan' => 'Pengawas']);
                    $honor->tanggal_spj = $kak->akhir;
                    $honor->tahun = Helper::getPropertyFromCollection($dipa, 'tahun');
                    if ($kak->wasChanged('tanggal')) {
                        $honor->generate_sk ? $honor->tanggal_sk = $kak->tanggal : null;
                        $honor->generate_st ? $honor->tanggal_st = $kak->tanggal : null;
                    }
                    $honor->save();
                } else {
                    $honor = new HonorKegiatan;
                    $honor->anggaran_kerangka_acuan_id = $anggaranKak->id;
                    $honor->judul_spj = 'Daftar Honor Petugas '.strtr($kak->kegiatan, ['Pemeriksaan' => 'Pemeriksa', 'Pencacahan' => 'Pencacah', 'Pengawasan' => 'Pengawas']);
                    $honor->uraian_tugas = 'Melakukan '.$kak->kegiatan;
                    $honor->objek_sk = 'Petugas '.strtr($kak->kegiatan, ['Pemeriksaan' => 'Pemeriksa', 'Pencacahan' => 'Pencacah', 'Pengawasan' => 'Pengawas']);
                    $honor->generate_sk = true;
                    $honor->generate_st = true;
                    $honor->tanggal_spj = $kak->akhir;
                    $honor->tanggal_st = $kak->tanggal;
                    $honor->tanggal_sk = $kak->tanggal;
                    $honor->tahun = Helper::getPropertyFromCollection($dipa, 'tahun');
                    $honor->unit_kerja_id = $kak->unit_kerja_id;
                    $honor->save();
                }
            }
        });
        //BUG: jangan pakai mak harusnya pakai anggaran_kak _id
        static::deleting(function (AnggaranKerangkaAcuan $anggaranKak) {
            $id = HonorKegiatan::where('anggaran_kerangka_acuan_id', $anggaranKak->id)->pluck('id');
            HonorKegiatan::destroy($id);
            KerangkaAcuan::find($anggaranKak->kerangka_acuan_id)->update(['status' => 'dibuat']);
        });
        static::saving(function (AnggaranKerangkaAcuan $anggaranKak) {
            if ($anggaranKak->isDirty()) {
                KerangkaAcuan::find($anggaranKak->kerangka_acuan_id)->update(['status' => 'dibuat']);
            }
        });
        static::updated(function (AnggaranKerangkaAcuan $anggaranKak) {
            if (Helper::isAkunHonorChanged($anggaranKak->getOriginal('mak'), $anggaranKak->mak)) {
                $id = HonorKegiatan::where('anggaran_kerangka_acuan_id', $anggaranKak->id)->pluck('id');
                HonorKegiatan::destroy($id);
            }
        });
    }
}
