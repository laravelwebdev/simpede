<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemeliharaan extends Model
{
    protected $fillable = ['status'];

    public function kerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(KerangkaAcuan::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Pemeliharaan $pemeliharaan) {
            $pemeliharaan->status = 'dibuat';
        });
        static::deleting(function (Pemeliharaan $pemeliharaan) {
            //TODO: Hapus barang pemeliharaan
            // $pemeliharaan->daftarBarangPersediaans->each->delete();
        });
    }
}
