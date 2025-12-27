<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KakSp2d extends Pivot
{
    protected $table = 'kak_sp2d';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['arsip_keuangan_id', 'catatan', 'rekap_bos', 'rekap_sirup'];

    public function kerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(KerangkaAcuan::class);
    }

    public function daftarSp2d(): BelongsTo
    {
        return $this->belongsTo(DaftarSp2d::class);
    }

    public function arsipKeuangan(): BelongsTo
    {
        return $this->belongsTo(ArsipKeuangan::class);
    }

    public function arsipDokumens(): HasMany
    {
        return $this->hasMany(ArsipDokumen::class, 'kak_sp2d_id');
    }

    protected static function booted(): void
    {
        static::saved(function (KakSp2d $kakSp2d) {
            $daftarSp2d = DaftarSp2d::find($kakSp2d->daftar_sp2d_id);
            $year = session('year');
            $basePath = $year.'/arsip-dokumens/'.$kakSp2d->kerangka_acuan_id.'/';
            $nomorSpp = $daftarSp2d->nomor_spp;
            $nomorSp2d = $daftarSp2d->nomor_sp2d;
            
            // Copy SP2D
            $sp2dPath = $basePath.'SP2D_'.$nomorSp2d.'.pdf';
            Storage::disk('arsip')->copy($daftarSp2d->arsip_sp2d, $sp2dPath);
            ArsipDokumen::updateOrCreate(
                [
                    'kak_sp2d_id' => $kakSp2d->id,
                    'slug' => 'SP2D '.$nomorSp2d,
                ],
                [
                    'jumlah_halaman' => 1,
                    'tanggal_dokumen' => $daftarSp2d->tanggal_sp2d,
                    'file' => $sp2dPath,
                ]
            );

            // Copy SPM
            $spmPath = $basePath.'SPM_'.$nomorSpp.'.pdf';

            Storage::disk('arsip')->copy($daftarSp2d->arsip_spm, $spmPath);

            ArsipDokumen::updateOrCreate(
                [
                    'kak_sp2d_id' => $kakSp2d->id,
                    'slug' => 'Surat Perintah Membayar '.$nomorSpp,
                ],
                [
                    'tanggal_dokumen' => $daftarSp2d->tanggal_spm,
                    'file' => $spmPath,
                ]
            );

            // Copy Lampiran SPM
            $lampiranSpmPath = $basePath.'Lampiran_SPM_'.$nomorSpp.'.pdf';
            Storage::disk('arsip')->copy($daftarSp2d->arsip_lampiran, $lampiranSpmPath);
            ArsipDokumen::updateOrCreate(
                [
                    'kak_sp2d_id' => $kakSp2d->id,
                    'slug' => 'Lampiran SPM '.$nomorSpp,
                ],
                [
                    'tanggal_dokumen' => $daftarSp2d->tanggal_spm,
                    'file' => $lampiranSpmPath,
                ]
            );

            // Copy SPP
            $sppPath = $basePath.'SPP_'.$nomorSpp.'.pdf';
            Storage::disk('arsip')->copy($daftarSp2d->arsip_spp, $sppPath);
            ArsipDokumen::updateOrCreate(
                [
                    'kak_sp2d_id' => $kakSp2d->id,
                    'slug' => 'Surat Permintaan Pembayaran '.$nomorSpp,
                ],
                [
                    'file' => $sppPath,
                ]
            );

            // Copy Lampiran SPP
            $lampiranSppPath = $basePath.'Lampiran_SPP_'.$nomorSpp.'.pdf';
            Storage::disk('arsip')->copy($daftarSp2d->arsip_lampiran_spp, $lampiranSppPath);
            ArsipDokumen::updateOrCreate(
                [
                    'kak_sp2d_id' => $kakSp2d->id,
                    'slug' => 'Lampiran SPP '.$nomorSpp,
                ],
                [
                    'file' => $lampiranSppPath,
                ]
            );
            
            // Copy SSP
            $arsipSsp = $daftarSp2d->arsip_ssp;
            if ($arsipSsp) {
                $sspPath = $basePath.'SSP_'.$nomorSpp.'.pdf';
                Storage::disk('arsip')->copy($arsipSsp, $sspPath);
                ArsipDokumen::updateOrCreate(
                    [
                        'kak_sp2d_id' => $kakSp2d->id,
                        'slug' => 'Surat Setoran Pajak '.$nomorSpp,
                    ],
                    [
                        'file' => $sspPath,
                    ]
                );
            }

            // Copy DPT
            $arsipDpt = $daftarSp2d->arsip_dpt;
            if ($arsipDpt) {
                $dptPath = $basePath.'DPT_'.$nomorSpp.'.pdf';
                Storage::disk('arsip')->copy($arsipDpt, $dptPath);
                ArsipDokumen::updateOrCreate(
                    [
                        'kak_sp2d_id' => $kakSp2d->id,
                        'slug' => 'Daftar Pembayaran Tagihan '.$nomorSpp,
                    ],
                    [
                        'file' => $dptPath,
                    ]
                );
            }
        });

        static::deleting(function (KakSp2d $kakSp2d) {
            $daftarSp2d = DaftarSp2d::find($kakSp2d->daftar_sp2d_id);
            $year = session('year');
            $basePath = $year.'/arsip-dokumens/'.$kakSp2d->kerangka_acuan_id.'/';
            $nomorSpp = $daftarSp2d->nomor_spp;
            $nomorSp2d = $daftarSp2d->nomor_sp2d;

            $filesAndSlugs = [
                ['SPM_'.$nomorSpp.'.pdf', 'Surat Perintah Membayar '.$nomorSpp],
                ['SP2D_'.$nomorSp2d.'.pdf', 'SP2D '.$nomorSp2d],
                ['Lampiran_SPM_'.$nomorSpp.'.pdf', 'Lampiran SPM '.$nomorSpp],
                ['SPP_'.$nomorSpp.'.pdf', 'Surat Permintaan Pembayaran '.$nomorSpp],
                ['Lampiran_SPP_'.$nomorSpp.'.pdf', 'Lampiran SPP '.$nomorSpp],
                ['SSP_'.$nomorSpp.'.pdf', 'Surat Setoran Pajak '.$nomorSpp],
                ['DPT_'.$nomorSpp.'.pdf', 'Daftar Pembayaran Tagihan '.$nomorSpp],
            ];

            foreach ($filesAndSlugs as [$file, $slug]) {
                Storage::disk('arsip')->delete($basePath.$file);
                ArsipDokumen::where('kak_sp2d_id', $kakSp2d->id)
                    ->where('slug', $slug)
                    ->delete();
            }
        });
    }
}
