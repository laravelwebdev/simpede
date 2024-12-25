<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnggaranKerangkaAcuan extends Model
{
    public function mataAnggaran(): BelongsTo
    {
        return $this->belongsTo(MataAnggaran::class);
    }

    protected static function booted(): void
    {
        static::saved(function (AnggaranKerangkaAcuan $anggaranKak) {
            if ($anggaranKak->isDirty() && Helper::isAkunHonor($anggaranKak->mata_anggaran_id)) {
                if ($honor = HonorKegiatan::where('anggaran_kerangka_acuan_id', $anggaranKak->id)->first()) {
                    $honor->mata_anggaran_id = $anggaranKak->mata_anggaran_id;
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
                    $honor->mata_anggaran_id = $anggaranKak->mata_anggaran_id;
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
            if ($anggaranKak->isDirty() && Helper::isAkunPersediaan($anggaranKak->mata_anggaran_id)) {
                if ($pembelian = PembelianPersediaan::where('anggaran_kerangka_acuan_id', $anggaranKak->id)->first()) {
                    $pembelian->status = 'outdated';
                    $pembelian->save();
                } else {
                    $kak = KerangkaAcuan::find($anggaranKak->kerangka_acuan_id);
                    $pembelian = new PembelianPersediaan;
                    $pembelian->kerangka_acuan_id = $kak->id;
                    $pembelian->tanggal_kak = $kak->tanggal;
                    $pembelian->anggaran_kerangka_acuan_id = $anggaranKak->id;
                    $pembelian->rincian = $kak->rincian;
                    $pembelian->status = 'outdated';
                    $pembelian->save();
                }
            }

            if ($anggaranKak->isDirty() && Helper::isAkunPemeliharaan($anggaranKak->mata_anggaran_id)) {
                $kak = KerangkaAcuan::find($anggaranKak->kerangka_acuan_id);
                if ($pemeliharaan = Pemeliharaan::where('anggaran_kerangka_acuan_id', $anggaranKak->id)->first()) {
                    $pemeliharaan->rincian = $kak->rincian;
                    $pemeliharaan->save();
                } else {
                    $pemeliharaan = new Pemeliharaan;
                    $pemeliharaan->kerangka_acuan_id = $kak->id;
                    $pemeliharaan->tanggal_kak = $kak->tanggal;
                    $pemeliharaan->anggaran_kerangka_acuan_id = $anggaranKak->id;
                    $pemeliharaan->rincian = $kak->rincian;
                    $pemeliharaan->save();
                }
            }
        });
        static::deleting(function (AnggaranKerangkaAcuan $anggaranKak) {
            $ids = HonorKegiatan::where('anggaran_kerangka_acuan_id', $anggaranKak->id)->pluck('id');
            HonorKegiatan::destroy($ids);
            $ids = PembelianPersediaan::where('anggaran_kerangka_acuan_id', $anggaranKak->id)->pluck('id');
            PembelianPersediaan::destroy($ids);
            $ids = Pemeliharaan::where('anggaran_kerangka_acuan_id', $anggaranKak->id)->pluck('id');
            Pemeliharaan::destroy($ids);
            KerangkaAcuan::where('id', $anggaranKak->kerangka_acuan_id)->update(['status' => 'outdated']);
        });
        static::saving(function (AnggaranKerangkaAcuan $anggaranKak) {
            if ($anggaranKak->isDirty()) {
                KerangkaAcuan::where('id', $anggaranKak->kerangka_acuan_id)->update(['status' => 'outdated']);
            }
        });
        static::updated(function (AnggaranKerangkaAcuan $anggaranKak) {
            if (Helper::isAkunHonorChanged($anggaranKak->getOriginal('mata_anggaran_id'), $anggaranKak->mata_anggaran_id)) {
                $id = HonorKegiatan::where('anggaran_kerangka_acuan_id', $anggaranKak->id)->pluck('id');
                HonorKegiatan::destroy($id);
            }
            if (Helper::isAkunPersediaanChanged($anggaranKak->getOriginal('mata_anggaran_id'), $anggaranKak->mata_anggaran_id)) {
                $id = PembelianPersediaan::where('anggaran_kerangka_acuan_id', $anggaranKak->id)->pluck('id');
                PembelianPersediaan::destroy($id);
            }

            if (Helper::isAkunPemeliharaanChanged($anggaranKak->getOriginal('mata_anggaran_id'), $anggaranKak->mata_anggaran_id)) {
                $id = Pemeliharaan::where('anggaran_kerangka_acuan_id', $anggaranKak->id)->pluck('id');
                Pemeliharaan::destroy($id);
            }
        });
    }
}
