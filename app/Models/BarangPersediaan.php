<?php

namespace App\Models;

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
            if (!empty($persediaan->masterPersediaan)) {
                $persediaan->barang = $persediaan->masterPersediaan->barang;
                $persediaan->satuan = $persediaan->masterPersediaan->satuan;

            }
            if ($persediaan->barang_persediaanable_type == 'App\Models\PembelianPersediaan' && $persediaan->isDirty()) {
                PembelianPersediaan::where('id' , $persediaan->barang_persediaanable_id)
                ->where('status', '!=' , 'dibuat')
                ->update(['status' => 'outdated']);
            }
        });

        static::deleting(function (BarangPersediaan $persediaan) {
            if ($persediaan->barang_persediaanable_type == 'App\Models\PembelianPersediaan') {
                PembelianPersediaan::where('id' , $persediaan->barang_persediaanable_id)
                ->update(['status' => 'outdated']);
            }
        });
    }
}
