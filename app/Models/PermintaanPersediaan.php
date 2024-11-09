<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

class PermintaanPersediaan extends Model
{
    protected $fillable = ['status'];
    protected $casts = [
        'tanggal_permintaan' => 'date',
        'tanggal_persetujuan' => 'date',
    ];

    public function daftarBarangPersediaans(): MorphMany
    {
        return $this->morphMany(BarangPersediaan::class, 'barang_persediaanable');
    }

    protected static function booted(): void
    {
        static::creating(function (PermintaanPersediaan $permintaan) {
            $permintaan->status = 'dibuat';
            $permintaan->user_id = Auth::user()->id;
        });
        static::deleting(function (PermintaanPersediaan $permintaan) {
            $permintaan->daftarBarangPersediaans->each->delete();
        });
    }
}
