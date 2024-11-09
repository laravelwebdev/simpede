<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PersediaanMasuk extends Model
{
    protected $casts = [
        'tanggal_dokumen' => 'date',
        'tanggal_buku' => 'date',
    ];

    public function daftarBarangPersediaans(): MorphMany
    {
        return $this->morphMany(BarangPersediaan::class, 'barang_persediaanable');
    }

    protected static function booted(): void
    {
        static::saving(function (PersediaanMasuk $persediaan) {
            if ($persediaan->isDirty('tanggal_buku')) {
                BarangPersediaan::where('barang_persediaanable_id', $persediaan->id)
                    ->where('barang_persediaanable_type', 'App\Models\PersediaanMasuk')
                    ->update(['tanggal_transaksi' => $persediaan->tanggal_buku]);
            }
        });
        static::deleting(function (PersediaanMasuk $persediaan) {
            $persediaan->daftarBarangPersediaans->each->delete();
        });
    }
}
