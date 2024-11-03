<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PembelianPersediaan extends Model
{
    use HasFactory;
    protected $fillable = ['status'];

    protected $casts = [
        'tanggal_bast' => 'date',
        'tanggal_buku' => 'date',
        'tanggal_kak' => 'date',
    ];

    public function kakNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'kak_naskah_keluar_id');
    }

    public function bastNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'bast_naskah_keluar_id');
    }

}
