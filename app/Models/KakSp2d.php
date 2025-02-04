<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Storage;

class KakSp2d extends Pivot
{
    protected $table = 'kak_sp2d';

    protected static function booted(): void
    {
        static::saving(function (KakSp2d $kakSp2d) {
            Storage::disk('arsip')
                ->copy(DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->arsip_spm,
                    session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SPM_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            Storage::disk('arsip')
                ->copy(DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->arsip_sp2d,
                    session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SP2D_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            Storage::disk('arsip')
                ->copy(DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->arsip_lampiran,
                    session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/Lampiran_SPM_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            Storage::disk('arsip')
                ->copy(DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->arsip_spp,
                    session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SPP_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            $arsipSsp = DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->arsip_ssp;
            if ($arsipSsp) {
                Storage::disk('arsip')
                    ->copy($arsipSsp,
                        session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SSP_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            }
        });
        static::deleting(function (KakSp2d $kakSp2d) {
            Storage::disk('arsip')
                ->delete(session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SPM_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            Storage::disk('arsip')
                ->delete(session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SP2D_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            Storage::disk('arsip')
                ->delete(session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/Lampiran_SPM_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            Storage::disk('arsip')
                ->delete(session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SPP_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
            Storage::disk('arsip')
                ->delete(session('year').'/'.'arsip-dokumens'.'/'.$kakSp2d->kerangka_acuan_id.'/SSP_'.DaftarSp2d::find($kakSp2d->daftar_sp2d_id)->nomor_spp.'.pdf');
        });
    }
}
