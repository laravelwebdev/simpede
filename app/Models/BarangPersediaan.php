<?php

namespace App\Models;

use App\Models\PermintaanPersediaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangPersediaan extends Model
{
    public function masterPersediaan(): BelongsTo
    {
        return $this->belongsTo(MasterPersediaan::class);
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
                if ($persediaan->isClean('master_persediaan_id')) 
                PembelianPersediaan::where('id', $persediaan->barang_persediaanable_id)
                    ->where('status', 'diterima')
                    ->update(['status' => 'outdated']);
                PembelianPersediaan::where('id', $persediaan->barang_persediaanable_id)
                    ->where('status', 'berkode')
                    ->update(['status' => 'diterima']);
            }

            if ($persediaan->barang_persediaanable_type == 'App\Models\PermintaanPersediaan' && $persediaan->isDirty()) {
                PermintaanPersediaan::where('id', $persediaan->barang_persediaanable_id)
                    ->where('status', 'dicetak')
                    ->update(['status' => 'outdated']);
            }
        });

        static::deleting(function (BarangPersediaan $persediaan) {
            if ($persediaan->barang_persediaanable_type == 'App\Models\PembelianPersediaan') {
                PembelianPersediaan::where('id', $persediaan->barang_persediaanable_id)
                    ->update(['status' => 'outdated']);
            }
        });
    }
}
