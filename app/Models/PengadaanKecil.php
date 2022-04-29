<?php

namespace App\Models;

use App\Helpers\CetakHelper;
use App\Helpers\Helper;
use App\Models\Permintaan;
use Armancodes\DownloadLink\Models\DownloadLink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PengadaanKecil extends Model
{
    use HasFactory;
    protected $casts = [
        'tanggal' => 'date',
        'tgl_sp' => 'date',
        'awal' => 'date',
        'akhir' => 'date',
        'tgl_proses' => 'date',
        'spesifikasi' => 'array',
    ];

    protected $guarded = [];

    public function setKodeAttribute($value)
    {
        $this->attributes['kode'] = $value;
        $this->attributes['ppk'] = (new Helper)->getPejabat('ppk', 'nama');
        $this->attributes['nipppk'] = (new Helper)->getPejabat('ppk', 'nip');
        $this->attributes['pbj'] = (new Helper)->getPejabat('pbj', 'nama');
        $this->attributes['nippbj'] = (new Helper)->getPejabat('pbj', 'nip');
        $this->attributes['bendahara'] = (new Helper)->getPejabat('bendahara', 'nama');
        $this->attributes['nipbendahara'] = (new Helper)->getPejabat('bendahara', 'nip');
    }

    protected static function booted()
    {
        static::updating(function ($pengadaan_kecil) {
            $pengadaan_kecil->spesifikasi = Helper::simpanSpek($pengadaan_kecil->spesifikasi);
            if ($pengadaan_kecil->jumlah_bayar != Helper::sumSpek($pengadaan_kecil->spesifikasi)) {
                throw_if(
                    true,
                    'Nilai Pembayaran tidak sama dengan total nilai barang'
                );
            }
        });
        static::deleting(function ($pengadaan_kecil) {
            File::delete(Storage::path('public/pengadaan_kecil/PK'.explode('/', $pengadaan_kecil->nomor)[0].'.docx'));
            DownloadLink::where('file_path', '=', 'pengadaan_kecil/PK'.explode('/', $pengadaan_kecil->nomor)[0].'.docx')->delete();
        });

        static::updated(function ($pengadaan_kecil) {
            CetakHelper::cetakPengadaan($pengadaan_kecil->nomor);
            Permintaan::where('nomor', '=', $pengadaan_kecil->nomor)->update([
                'no_spk' => Helper::nomorPengadaan($pengadaan_kecil->tgl_sp, $pengadaan_kecil->kode, 'sp'),
                'no_bast' => Helper::nomorPengadaan($pengadaan_kecil->akhir, $pengadaan_kecil->kode, 'bast'),
                'tgl_spk' => $pengadaan_kecil->tgl_sp,
                'tgl_bast' => $pengadaan_kecil->akhir,
            ]);
        });
    }
}
