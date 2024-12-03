<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class BarangPersediaan extends Model
{
    protected $fillable = [
        'tanggal_transaksi',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
    ];

    public function masterPersediaan(): BelongsTo
    {
        return $this->belongsTo(MasterPersediaan::class);
    }

    public function barangPersediaanable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function booted(): void
    {
        static::saving(function (BarangPersediaan $persediaan) {
            $persediaan->total_harga = $persediaan->volume * $persediaan->harga_satuan;
            if (! empty($persediaan->masterPersediaan)) {
                $persediaan->barang = $persediaan->masterPersediaan->barang;
                $persediaan->satuan = $persediaan->masterPersediaan->satuan;
            }
            if ($persediaan->barang_persediaanable_type == 'App\Models\PembelianPersediaan' && $persediaan->isDirty()) {
                if ($persediaan->isClean('master_persediaan_id')) {
                    PembelianPersediaan::where('id', $persediaan->barang_persediaanable_id)
                        ->where('status', 'diterima')
                        ->update(['status' => 'outdated']);
                }
                PembelianPersediaan::where('id', $persediaan->barang_persediaanable_id)
                    ->where('status', 'berkode')
                    ->update(['status' => 'diterima']);
            }

            if ($persediaan->barang_persediaanable_type == 'App\Models\PermintaanPersediaan' && $persediaan->isDirty()) {
                PermintaanPersediaan::where('id', $persediaan->barang_persediaanable_id)
                    ->where('status', 'dicetak')
                    ->update(['status' => 'outdated']);
            }
            if ($persediaan->barang_persediaanable_type == 'App\Models\PersediaanKeluar' && $persediaan->isDirty()) {
                $persediaan->tanggal_transaksi = PersediaanKeluar::find($persediaan->barang_persediaanable_id)->tanggal_buku;
            }

            if ($persediaan->barang_persediaanable_type == 'App\Models\PersediaanMasuk' && $persediaan->isDirty()) {
                $persediaan->tanggal_transaksi = PersediaanMasuk::find($persediaan->barang_persediaanable_id)->tanggal_buku;
            }

            if ($persediaan->barang_persediaanable_type == 'App\Models\PembelianPersediaan' && $persediaan->isDirty()) {
                $persediaan->tanggal_transaksi = PembelianPersediaan::find($persediaan->barang_persediaanable_id)->tanggal_buku;
            }
        });

        static::deleting(function (BarangPersediaan $persediaan) {
            if ($persediaan->barang_persediaanable_type == 'App\Models\PembelianPersediaan' || $persediaan->barang_persediaanable_type == 'App\Models\PermintaanPersediaan') {
                PembelianPersediaan::where('id', $persediaan->barang_persediaanable_id)
                    ->update(['status' => 'outdated']);
            }
        });
    }
}
