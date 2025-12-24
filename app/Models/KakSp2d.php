<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Storage;

class KakSp2d extends Pivot
{
    protected $table = 'kak_sp2d';

    protected $fillable = ['arsip_keuangan_id'];

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

    protected static function booted(): void
    {
        static::saving(function (KakSp2d $kakSp2d) {
            Storage::disk('arsip')
                ->copy(DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->arsip_spm,
                    session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SPM_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            ArsipDokumen::updateOrCreate(
                [
                    'kerangka_acuan_id' => $kakSp2d->kerangka_acuan_id,
                    'slug' => 'Surat Perintah Membayar',
                ],
                [
                    'file' => session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SPM_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf',
                ]
            );
            Storage::disk('arsip')
                ->copy(DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->arsip_sp2d,
                    session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SP2D_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            ArsipDokumen::updateOrCreate(
                [
                    'kerangka_acuan_id' => $kakSp2d->kerangka_acuan_id,
                    'slug' => 'SP2D',
                ],
                [
                    'file' => session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SP2D_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf',
                ]
            );
            Storage::disk('arsip')
                ->copy(DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->arsip_lampiran,
                    session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/Lampiran_SPM_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            ArsipDokumen::updateOrCreate(
                [
                    'kerangka_acuan_id' => $kakSp2d->kerangka_acuan_id,
                    'slug' => 'Lampiran SPM',
                ],
                [
                    'file' => session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/Lampiran_SPM_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf',
                ]
            );
            Storage::disk('arsip')
                ->copy(DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->arsip_spp,
                    session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SPP_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            ArsipDokumen::updateOrCreate(
                [
                    'kerangka_acuan_id' => $kakSp2d->kerangka_acuan_id,
                    'slug' => 'Surat Permintaan Pembayaran',
                ],
                [
                    'file' => session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SPP_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf',
                ]
            );
            Storage::disk('arsip')
                ->copy(DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->arsip_lampiran_spp,
                    session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/Lampiran_SPP_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            ArsipDokumen::updateOrCreate(
                [
                    'kerangka_acuan_id' => $kakSp2d->kerangka_acuan_id,
                    'slug' => 'Lampiran SPP',
                ],
                [
                    'file' => session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/Lampiran_SPP_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf',
                ]
            );
            $arsipSsp = DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->arsip_ssp;
            if ($arsipSsp) {
                Storage::disk('arsip')
                    ->copy($arsipSsp,
                        session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SSP_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
                ArsipDokumen::updateOrCreate(
                    [
                        'kerangka_acuan_id' => $kakSp2d->kerangka_acuan_id,
                        'slug' => 'Surat Setoran Pajak',
                    ],
                    [
                        'file' => session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SSP_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf',
                    ]
                );
            }
            $arsipDpt = DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->arsip_dpt;
            if ($arsipDpt) {
                Storage::disk('arsip')
                    ->copy($arsipDpt,
                        session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/DPT_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
                ArsipDokumen::updateOrCreate(
                    [
                        'kerangka_acuan_id' => $kakSp2d->kerangka_acuan_id,
                        'slug' => 'Daftar Pembayaran Tagihan',
                    ],
                    [
                        'file' => session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/DPT_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf',
                    ]
                );
            }
        });
        static::deleting(function (KakSp2d $kakSp2d) {
            Storage::disk('arsip')
                ->delete(session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SPM_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            ArsipDokumen::where('kerangka_acuan_id', $kakSp2d->kerangka_acuan_id)
                ->where('slug', 'Surat Perintah Membayar')
                ->delete();
            Storage::disk('arsip')
                ->delete(session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SP2D_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            ArsipDokumen::where('kerangka_acuan_id', $kakSp2d->kerangka_acuan_id)
                ->where('slug', 'SP2D')
                ->delete();
            Storage::disk('arsip')
                ->delete(session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/Lampiran_SPM_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            ArsipDokumen::where('kerangka_acuan_id', $kakSp2d->kerangka_acuan_id)
                ->where('slug', 'Lampiran SPM')
                ->delete();
            Storage::disk('arsip')
                ->delete(session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SPP_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            ArsipDokumen::where('kerangka_acuan_id', $kakSp2d->kerangka_acuan_id)
                ->where('slug', 'Surat Permintaan Pembayaran')
                ->delete();
            Storage::disk('arsip')
                ->delete(session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SSP_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            ArsipDokumen::where('kerangka_acuan_id', $kakSp2d->kerangka_acuan_id)
                ->where('slug', 'Surat Setoran Pajak')
                ->delete();
            Storage::disk('arsip')
                ->delete(session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/Lampiran_SPP_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            ArsipDokumen::where('kerangka_acuan_id', $kakSp2d->kerangka_acuan_id)
                ->where('slug', 'Lampiran SPP')
                ->delete();
            Storage::disk('arsip')
                ->delete(session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/DPT_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            ArsipDokumen::where('kerangka_acuan_id', $kakSp2d->kerangka_acuan_id)
                ->where('slug', 'Daftar Pembayaran Tagihan')
                ->delete();
        });
    }
}
