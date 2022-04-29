<?php

namespace App\Models;

use App\Helpers\CetakHelper;
use App\Helpers\Helper;
use App\Models\PengadaanKecil;
use App\Models\Perjalanan;
use App\Models\Pok;
use Armancodes\DownloadLink\Models\DownloadLink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permintaan extends Model
{
    use HasFactory, SoftDeletes;
    protected $casts = [
        'tanggal' => 'date',
        'awal' => 'date',
        'akhir' => 'date',
        'terimappk' => 'date',
        'terimappspm' => 'date',
        'bayar' => 'date',
        'tgl_spk' => 'date',
        'tgl_bast' => 'date',
        'spesifikasi' => 'array',
    ];

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = $value;
        $this->attributes['s1'] = (new Helper)->nomor($value, 'permintaans', 'PMT/6307')->segmen;
        $this->attributes['nomor'] = (new Helper)->nomor($value, 'permintaans', 'PMT/6307')->nomor;

        //pejabat
        $this->attributes['nama'] = Auth::user()->name;
        $this->attributes['nip'] = Auth::user()->nip;
        $this->attributes['jabatan'] = Auth::user()->jabatan;
        $this->attributes['unit'] = Auth::user()->unit;
        $this->attributes['ppk'] = (new Helper)->getPejabat('ppk', 'nama');
        $this->attributes['nipppk'] = (new Helper)->getPejabat('ppk', 'nip');
        $this->attributes['kepala'] = (new Helper)->getPejabat('kepala', 'nama');
        $this->attributes['nipkepala'] = (new Helper)->getPejabat('kepala', 'nip');
    }

    protected static function booted()
    {
        static::updating(function ($permintaan) {
            //validasi
            $permintaan->spesifikasi = Helper::simpanSpek($permintaan->spesifikasi);
            if ($permintaan->jumlah_bayar > $permintaan->perkiraan) {
                throw_if(
                    true,
                    'Nilai Pembayaran lebih besar dari permintaan'
                );
            }
            if (($permintaan->perkiraan + Permintaan::where('detail', $permintaan->detail)->where('jumlah_bayar', null)->sum('perkiraan')) > $permintaan->sisa && $permintaan->isDirty('detail')) {
                throw_if(
                    true,
                    'Perkiraan penggunaan lebih besar dari sisa pagu tersedia'
                );
            }

            if ($permintaan->perkiraan != Helper::sumSpek($permintaan->spesifikasi)) {
                throw_if(
                    true,
                    'Perkiraan jumlah penggunaan tidak sama dengan  total nilai barang/jasa'
                );
            }
            if (DB::table('perjalanans')->where('no_permintaan', '=', $permintaan->nomor)->first() &&
            ($permintaan->jumlah_bayar > 0 && $permintaan->jumlah_bayar != Helper::biayaSpd(Perjalanan::where('no_permintaan', '=', $permintaan->nomor)->first()->biaya))) {
                throw_if(
                    true,
                    'Nilai Pembayaran SPPD tidak sama dengan bayar PPK'
                );
            }
            //set sisa
            $permintaan->sisanett = $permintaan->sisa - $permintaan->perkiraan;
            // set jangka waktu
            $permintaan->waktu = Helper::jangkaWaktu($permintaan->awal, $permintaan->akhir);
            if (! $permintaan->isDirty('detail')) {
                $permintaan->sisa = $permintaan->getOriginal('sisa');
                $permintaan->realisasi = $permintaan->getOriginal('realisasi');
            }
            $permintaan->sisanett = $permintaan->sisa - $permintaan->perkiraan;

            if ($permintaan->isDirty('detail') && $permintaan->getOriginal('detail')) {
                $pok = Pok::find($permintaan->getOriginal('detail'));
                $realisasi2 = $pok->realisasi;
                $pok->realisasi = $realisasi2 - $permintaan->getOriginal('jumlah_bayar');
                $pok->save();
                $pok = Pok::find($permintaan->detail);
                $realisasi = $pok->realisasi;
                $pok->realisasi = $realisasi + $permintaan->jumlah_bayar;
                $pok->save();
            } elseif ($permintaan->isDirty('jumlah_bayar')) {
                $pok = Pok::find($permintaan->detail);
                $realisasi = $pok->realisasi;
                $pok->realisasi = $realisasi - $permintaan->getOriginal('jumlah_bayar') + $permintaan->jumlah_bayar;
                $pok->save();
            }

            if ($permintaan->isDirty('mak')) {
                Perjalanan::where('no_permintaan', $permintaan->nomor)->delete();
            }

            if (substr($permintaan->mak, -6, 3) == '524') {
                if (Perjalanan::where('no_permintaan', $permintaan->nomor)->first('no_permintaan')) {
                    Perjalanan::where('no_permintaan', $permintaan->nomor)->update(
                            [
                                'tujuan_spd' => str_ireplace('Pembayaran Biaya', '', $permintaan->rincian),
                                'waktu' => $permintaan->waktu,
                                'berangkat' => $permintaan->awal->format('Y-m-d'),
                                'kembali' => $permintaan->akhir->format('Y-m-d'),
                                'mak' => $permintaan->mak,
                            ],
                        );
                } else {
                    Perjalanan::create(
                            [
                                'tanggal' => $permintaan->tanggal->format('Y-m-d'),
                                'tgl_permintaan' => $permintaan->tanggal->format('Y-m-d'),
                                'tujuan_spd' => $permintaan->rincian,
                                'waktu' => $permintaan->waktu,
                                'tujuan_spd' => str_ireplace('Pembayaran Biaya', '', $permintaan->rincian),
                                'berangkat' => $permintaan->awal->format('Y-m-d'),
                                'kembali' => $permintaan->akhir->format('Y-m-d'),
                                'mak' => $permintaan->mak,
                                'biaya' => $permintaan->spesifikasi,
                                'no_permintaan' => $permintaan->nomor,
                            ],
                        );
                }
            }
            if (
                ($permintaan->isDirty('penyedia') || $permintaan->isDirty('jumlah_bayar')) &&
                ($permintaan->jenis != 'penyedia' || $permintaan->jumlah_bayar > 10000000)
            ) {
                PengadaanKecil::where('nomor', $permintaan->nomor)->delete();
            }
            if ($permintaan->jenis == 'penyedia' && $permintaan->jumlah_bayar > 0 && $permintaan->jumlah_bayar <= 10000000) {
                if (PengadaanKecil::where('nomor', $permintaan->nomor)->first('nomor')) {
                    PengadaanKecil::where('nomor', $permintaan->nomor)->update(
                            [
                                'spesifikasi' => $permintaan->spesifikasi,
                                'penyedia' => $permintaan->penyedia,
                                'jumlah_bayar' => $permintaan->jumlah_bayar,
                                'mak' => $permintaan->mak,
                                'detail' => $permintaan->detail,
                                'alamat' => Penyedia::where('id', $permintaan->penyedia)->first('alamat')->alamat,
                                'penandatangan' => Penyedia::where('id', $permintaan->penyedia)->first('penandatangan')->penandatangan,
                                'program' => $permintaan->program,
                                'kegiatan' => $permintaan->kegiatan,
                                'kro' => $permintaan->kro,
                                'ro' => $permintaan->ro,
                                'komponen' => $permintaan->komponen,
                                'sub' => $permintaan->sub,
                                'akun' => $permintaan->akun,
                                'waktu' => $permintaan->waktu,
                                'awal' => $permintaan->awal->format('Y-m-d'),
                                'akhir' => $permintaan->akhir->format('Y-m-d'),
                            ],
                        );
                } else {
                    PengadaanKecil::create(
                            [
                                'tanggal' => $permintaan->tanggal->format('Y-m-d'),
                                'nomor' => $permintaan->nomor,
                                'rincian' => $permintaan->rincian,
                                'perkiraan' => $permintaan->perkiraan,
                                'spesifikasi' => $permintaan->spesifikasi,
                                'penyedia' => $permintaan->penyedia,
                                'alamat' => Penyedia::where('id', $permintaan->penyedia)->first('alamat')->alamat,
                                'penandatangan' => Penyedia::where('id', $permintaan->penyedia)->first('penandatangan')->penandatangan,
                                'jumlah_bayar' => $permintaan->jumlah_bayar,
                                'mak' => $permintaan->mak,
                                'detail' => $permintaan->detail,
                                'program' => $permintaan->program,
                                'kegiatan' => $permintaan->kegiatan,
                                'kro' => $permintaan->kro,
                                'ro' => $permintaan->ro,
                                'komponen' => $permintaan->komponen,
                                'sub' => $permintaan->sub,
                                'akun' => $permintaan->akun,
                                'waktu' => $permintaan->waktu,
                                'awal' => $permintaan->awal->format('Y-m-d'),
                                'akhir' => $permintaan->akhir->format('Y-m-d'),
                            ],
                        );
                }
            }
        });
        static::deleting(function ($permintaan) {
            if ($permintaan->jumlah_bayar > 0) {
                throw_if(
                    true,
                    'Permintaan ini sudah disetujui bayar oleh PPK'
                );
            } else {
                PengadaanKecil::where('nomor', $permintaan->nomor)->delete();
                Perjalanan::where('no_permintaan', $permintaan->nomor)->delete();
                File::delete(Storage::path('public/permintaan/PMT'.explode('/', $permintaan->nomor)[0].'.docx'));
                DownloadLink::where('file_path', '=', 'permintaan/PMT'.explode('/', $permintaan->nomor)[0].'.docx')->delete();
            }
        });
        static::updated(function ($permintaan) {
            CetakHelper::cetakPermintaan($permintaan->nomor);
        });
    }
}
