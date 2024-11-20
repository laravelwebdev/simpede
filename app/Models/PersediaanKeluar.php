<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PersediaanKeluar extends Model
{
    protected $casts = [
        'tanggal_dokumen' => 'date',
        'tanggal_buku' => 'date',
    ];

    public function daftarBarangPersediaans(): MorphMany
    {
        return $this->morphMany(BarangPersediaan::class, 'barang_persediaanable');
    }

    public function naskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class);
    }

    protected static function booted(): void
    {
        static::saving(function (PersediaanKeluar $persediaan) {
            if ($persediaan->isDirty('tanggal_buku')) {
                BarangPersediaan::where('barang_persediaanable_id', $persediaan->id)
                    ->where('barang_persediaanable_type', 'App\Models\PersediaanKeluar')
                    ->update(['tanggal_transaksi' => $persediaan->tanggal_buku]);
            }
        });
        static::deleting(function (PersediaanKeluar $persediaan) {
            $persediaan->daftarBarangPersediaans->each->delete();
        });
    }
}
