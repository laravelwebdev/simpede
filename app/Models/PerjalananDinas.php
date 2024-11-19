<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerjalananDinas extends Model
{
    protected $table = 'perjalanan_dinas';

    protected $casts = [
        'tanggal_spd' => 'date',
        'tanggal_st' => 'date',
        'tanggal_berangkat' => 'date',
        'tanggal_kembali' => 'date',
    ];

    public function spdNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'spd_naskah_keluar_id');
    }

    public function stNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'st_naskah_keluar_id');
    }

    public function anggaranKerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(AnggaranKerangkaAcuan::class);
    }

    public function kerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(KerangkaAcuan::class);
    }

    public function daftarPesertaPerjalanan(): HasMany
    {
        return $this->hasMany(DaftarPesertaPerjalanan::class, 'perjalanan_dinas_id');
    }

    protected static function booted(): void
    {
        //TODO: belum selesai, perlu jenis arsip, isdirty tanggal dan jenis arsip
        static::updating(function (PerjalananDinas $perjalanan) {
            if ($perjalanan->naskah_keluar_id === null) {
                $default_naskah = NaskahDefault::cache()->get('all')
                    ->where('jenis', 'bon')
                    ->first();
                $naskahkeluar = new NaskahKeluar;
                $naskahkeluar->tanggal = $perjalanan->tanggal_perjalanan;
                $naskahkeluar->jenis_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'jenis_naskah_id');
                $naskahkeluar->kode_arsip_id = Helper::getPropertyFromCollection($default_naskah, 'kode_arsip_id')[0];
                $naskahkeluar->derajat_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'derajat_naskah_id');
                $naskahkeluar->tujuan = 'Pengelola Barang Persediaan';
                $naskahkeluar->perihal = 'Bon Permintaan Persediaan '.$perjalanan->rincian;
                $naskahkeluar->generate = 'A';
                $naskahkeluar->save();
                $perjalanan->naskah_keluar_id = $naskahkeluar->id;
            } else {
                if ($perjalanan->isDirty(['tanggal_perjalanan'])) {
                    $naskahkeluar = NaskahKeluar::where('id', $perjalanan->naskah_keluar_id)->first();
                    $naskahkeluar->tanggal = $perjalanan->tanggal_perjalanan;
                    $naskahkeluar->save();
                }
            }
        });

        static::deleting(function (PerjalananDinas $perjalanan) {
            $perjalanan->daftarPesertaPerjalanan->each->delete();
            NaskahKeluar::destroy([$perjalanan->st_naskah_keluar_id, $perjalanan->spd_naskah_keluar_id]);
        });
    }
}
