<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NaskahKeluar extends Model
{
    public function casts(): array
    {
        return [
            'tanggal' => 'date',
            'tanggal_kirim' => 'date',
        ];
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saving(function (NaskahKeluar $naskah) {
            if ($naskah->isDirty(['jenis_naskah_id', 'tanggal', 'kode_arsip_id', 'derajat_naskah_id', 'unit_kerja_id'])) {
                $pegawai = Helper::getDataPegawaiByUserId(Auth::user()->id, $naskah->tanggal);
                if (is_null($pegawai)) {
                    $pegawai = Helper::getDataPegawaiByUserId(Auth::user()->id, now());
                }
                $unit_kerja_id = $naskah->unit_kerja_id ?? optional($pegawai)->unit_kerja_id;
                $nomor = Helper::nomor($naskah->tanggal, $naskah->jenis_naskah_id, $unit_kerja_id, $naskah->kode_arsip_id, $naskah->derajat_naskah_id);
                $naskah->nomor = $nomor['nomor'];
                $naskah->no_urut = $nomor['no_urut'];
                $naskah->segmen = $nomor['segmen'];
                $naskah->kode_naskah_id = $nomor['kode_naskah_id'];
                $naskah->unit_kerja_id = $unit_kerja_id;
            }
        });
    }
}
