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
            if ($anggaranKak->isDirty() && Helper::isAkunHonor($anggaranKak->mak)) {
                if ($honor = HonorKegiatan::where('anggaran_kerangka_acuan_id', $anggaranKak->id)->first()) {
                    $honor->mak = $anggaranKak->mak;
                    $honor->perkiraan_anggaran = $anggaranKak->perkiraan;
                    $honor->status = 'outdated';
                    $honor->save();
                } else {
                    $kak = KerangkaAcuan::find($anggaranKak->kerangka_acuan_id);
                    $dipa = Dipa::cache()->get('all')->where('id', $kak->dipa_id)->first();
                    $honor = new HonorKegiatan;
                    $honor->kerangka_acuan_id = $kak->id;
                    $honor->judul_spj = 'Daftar Honor Petugas '.strtr($kak->kegiatan, ['Pemeriksaan' => 'Pemeriksa', 'Pencacahan' => 'Pencacah', 'Pengawasan' => 'Pengawas']);
                    $honor->awal = $kak->awal;
                    $honor->akhir = $kak->akhir;
                    $honor->mak = $anggaranKak->mak;
                    $honor->anggaran_kerangka_acuan_id = $anggaranKak->id;
                    $honor->perkiraan_anggaran = $anggaranKak->perkiraan;
                    $honor->kegiatan = $kak->kegiatan;
                    $honor->uraian_tugas = 'Melakukan '.$kak->kegiatan;
                    $honor->objek_sk = 'Petugas '.strtr($kak->kegiatan, ['Pemeriksaan' => 'Pemeriksa', 'Pencacahan' => 'Pencacah', 'Pengawasan' => 'Pengawas']);
                    $honor->generate_sk = true;
                    $honor->generate_st = true;
                    $honor->tanggal_kak = $kak->tanggal;
                    $honor->tanggal_spj = $kak->akhir;
                    $honor->tanggal_st = $kak->tanggal;
                    $honor->tanggal_sk = $kak->tanggal;
                    $honor->tahun = Helper::getPropertyFromCollection($dipa, 'tahun');
                    $honor->unit_kerja_id = $kak->unit_kerja_id;
                    $honor->save();
                }
            }
            if ($anggaranKak->isDirty() && Helper::isAkunPersediaan($anggaranKak->mak)) {

            }
                
        });
        static::deleting(function (AnggaranKerangkaAcuan $anggaranKak) {
            $ids = HonorKegiatan::where('anggaran_kerangka_acuan_id', $anggaranKak->id)->pluck('id')->toArray();
            HonorKegiatan::destroy($ids);
            KerangkaAcuan::where('id', $anggaranKak->kerangka_acuan_id)->update(['status' => 'outdated']);
        });
        static::saving(function (AnggaranKerangkaAcuan $anggaranKak) {
            if ($anggaranKak->isDirty()) {
                KerangkaAcuan::where('id', $anggaranKak->kerangka_acuan_id)->update(['status' => 'outdated']);
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
