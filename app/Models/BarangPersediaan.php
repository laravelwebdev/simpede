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
        });
    }
}
