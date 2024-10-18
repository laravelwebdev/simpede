<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarKontrakMitra extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::creating(function (DaftarKontrakMitra $daftar) {
            $daftar->status = 'dibuat';
        });
        // BUG: masih sementara
        static::creating(function (DaftarKontrakMitra $daftar) {
            $kontrak = KontrakMitra::find($daftar->kontrak_mitra_id);
                $kode_naskah = KodeNaskah::cache()
                    ->get('all')
                    ->where('kategori', 'Surat Dinas')
                    ->where('tata_naskah_id', Helper::getLatestTataNaskahId($kontrak->tanggal_spk))
                    ->first();
                $jenis_naskah = JenisNaskah::cache()
                    ->get('all')
                    ->where('jenis', 'Surat Perjanjian')
                    ->where('kode_naskah_id', Helper::getPropertyFromCollection($kode_naskah, 'id'))
                    ->first();
                $kode_arsip_id = $kontrak->kode_arsip_id;
                $naskahkeluar = new NaskahKeluar;
                $naskahkeluar->tanggal = $kontrak->tanggal_spk;
                $naskahkeluar->jenis_naskah_id = Helper::getPropertyFromCollection($jenis_naskah, 'id');
                $naskahkeluar->kode_arsip_id = $kode_arsip_id;
                $naskahkeluar->kode_naskah_id = Helper::getPropertyFromCollection($jenis_naskah, 'kode_naskah_id');
                $naskahkeluar->derajat = 'B';
                $naskahkeluar->tujuan = $daftar->objek_sk;
                $naskahkeluar->perihal = 'Kontrak '.$daftar->objek_sk;
                $naskahkeluar->generate = 'A';
                $naskahkeluar->save();
                $daftar->kontrak_naskah_keluar_id = $naskahkeluar->id;            
        });
    }
}
