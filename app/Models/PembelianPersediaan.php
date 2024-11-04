<?php

namespace App\Models;

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
        return $this->morphMany(BarangPersediaan::class, 'barang_persediaanable')->chaperone();
    }

    protected static function booted(): void
    {
        static::creating(function (PembelianPersediaan $pembelian) {
            $pembelian->status = 'dibuat';
        });
    }
}
