<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PembelianPersediaan extends Model
{
    protected $fillable = ['status'];

    protected $casts = [
        'tanggal_bast' => 'date',
        'tanggal_buku' => 'date',
        'tanggal_kak' => 'date',
        'tanggal_nota' => 'date',
    ];

    public function kerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(KerangkaAcuan::class, 'kerangka_acuan_id');
    }

    public function bastNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'bast_naskah_keluar_id');
    }

    public function daftarBarangPersediaans(): MorphMany
    {
        return $this->morphMany(BarangPersediaan::class, 'barang_persediaanable');
    }

    protected static function booted(): void
    {
        static::creating(function (PembelianPersediaan $pembelian) {
            $pembelian->status = 'dibuat';
        });
        static::deleting(function (PembelianPersediaan $pembelian) {
            $pembelian->daftarBarangPersediaans->each->delete();
            NaskahKeluar::destroy($pembelian->bast_naskah_keluar_id);
        });
        static::updating(function (PembelianPersediaan $pembelian) {
            if ($pembelian->bast_naskah_keluar_id === null && $pembelian->isDirty(['tanggal_bast'])) {
                $default_naskah = NaskahDefault::cache()->get('all')
                    ->where('jenis', 'bastp')
                    ->first();
                $naskahkeluar = new NaskahKeluar;
                $naskahkeluar->tanggal = $pembelian->tanggal_bast;
                $naskahkeluar->jenis_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'jenis_naskah_id');
                $naskahkeluar->kode_arsip_id = Helper::getPropertyFromCollection($default_naskah, 'kode_arsip_id')[0];
                $naskahkeluar->derajat_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'derajat_naskah_id');
                $naskahkeluar->tujuan = 'Pengelola Barang Persediaan';
                $naskahkeluar->perihal = 'BAST '.$pembelian->rincian;
                $naskahkeluar->generate = 'A';
                $naskahkeluar->save();
                $pembelian->bast_naskah_keluar_id = $naskahkeluar->id;
            } else {
                if ($pembelian->isDirty(['tanggal_bast'])) {
                    $naskahkeluar = NaskahKeluar::where('id', $pembelian->bast_naskah_keluar_id)->first();
                    $naskahkeluar->tanggal = $pembelian->tanggal_bast;
                    $naskahkeluar->save();
                }
            }
            //BUG: update saat cetak saja
            if ($pembelian->isDirty('tanggal_buku')) {
                BarangPersediaan::where('barang_persediaanable_id', $pembelian->id)
                    ->where('barang_persediaanable_type', 'App\Models\PembelianPersediaan')
                    ->update(['tanggal_transaksi' => $pembelian->tanggal_buku]);
            }
        });
    }
}
