<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerjalananDinas extends Model
{
    protected $table = 'perjalanan_dinas';

    public function casts(): array
    {
        return [
            'tanggal_spd' => 'date',
            'tanggal_st' => 'date',
            'tanggal_berangkat' => 'date',
            'tanggal_kembali' => 'date',
        ];
    }

    public function spdNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'spd_naskah_keluar_id');
    }

    public function mataAnggaran(): BelongsTo
    {
        return $this->belongsTo(MataAnggaran::class);
    }

    public function stNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'st_naskah_keluar_id');
    }

    public function kerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(KerangkaAcuan::class);
    }

    public function ppk(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ppk_user_id');
    }

    public function tujuanMasterWilayah(): BelongsTo
    {
        return $this->belongsTo(MasterWilayah::class, 'tujuan_master_wilayah_id');
    }

    public function kepala(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kepala_user_id');
    }

    public function daftarPesertaPerjalanan(): HasMany
    {
        return $this->hasMany(DaftarPesertaPerjalanan::class, 'perjalanan_dinas_id');
    }

    protected static function booted(): void
    {
        static::updating(function (PerjalananDinas $perjalanan) {
            if ($perjalanan->st_naskah_keluar_id === null) {
                $default_naskah = NaskahDefault::cache()->get('all')
                    ->where('jenis', 'st')
                    ->first();
                $naskahkeluar = new NaskahKeluar;
                $naskahkeluar->tanggal = $perjalanan->tanggal_st;
                $naskahkeluar->jenis_naskah_id = optional($default_naskah)->jenis_naskah_id;
                $naskahkeluar->kode_arsip_id = $perjalanan->st_kode_arsip_id;
                $naskahkeluar->derajat_naskah_id = optional($default_naskah)->derajat_naskah_id;
                $naskahkeluar->tujuan = 'Pelaksana Perjalanan Dinas';
                $naskahkeluar->perihal = 'Surat Tugas '.$perjalanan->uraian;
                $naskahkeluar->generate = 'M';
                $naskahkeluar->save();
                $perjalanan->st_naskah_keluar_id = $naskahkeluar->id;
            } else {
                if ($perjalanan->isDirty(['tanggal_st', 'st_kode_arsip_id'])) {
                    $naskahkeluar = NaskahKeluar::where('id', $perjalanan->st_naskah_keluar_id)->first();
                    $naskahkeluar->tanggal = $perjalanan->tanggal_st;
                    $naskahkeluar->kode_arsip_id = $perjalanan->st_kode_arsip_id;
                    $naskahkeluar->save();
                }
            }

            if ($perjalanan->spd_naskah_keluar_id === null) {
                $default_naskah = NaskahDefault::cache()->get('all')
                    ->where('jenis', 'st')
                    ->first();
                $naskahkeluar = new NaskahKeluar;
                $naskahkeluar->tanggal = $perjalanan->tanggal_spd;
                $naskahkeluar->jenis_naskah_id = optional($default_naskah)->jenis_naskah_id;
                $naskahkeluar->kode_arsip_id = $perjalanan->spd_kode_arsip_id;
                $naskahkeluar->derajat_naskah_id = optional($default_naskah)->derajat_naskah_id;
                $naskahkeluar->tujuan = 'Pelaksana Perjalanan Dinas';
                $naskahkeluar->perihal = 'SPPD '.$perjalanan->uraian;
                $naskahkeluar->generate = 'A';
                $naskahkeluar->save();
                $perjalanan->spd_naskah_keluar_id = $naskahkeluar->id;
            } else {
                if ($perjalanan->isDirty(['tanggal_spd', 'spd_kode_arsip_id'])) {
                    $naskahkeluar = NaskahKeluar::where('id', $perjalanan->spd_naskah_keluar_id)->first();
                    $naskahkeluar->tanggal = $perjalanan->tanggal_spd;
                    $naskahkeluar->kode_arsip_id = $perjalanan->spd_kode_arsip_id;
                    $naskahkeluar->save();
                }
            }
        });

        static::deleting(function (PerjalananDinas $perjalanan) {
            $perjalanan->daftarPesertaPerjalanan->each->delete();
            NaskahKeluar::destroy($perjalanan->spd_naskah_keluar_id);
        });
    }
}
