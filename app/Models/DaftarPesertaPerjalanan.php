<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarPesertaPerjalanan extends Model
{
    protected $casts = [
        'spesifikasi' => 'array',
        'tanggal_kuitansi' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function asalMasterWilayah(): BelongsTo
    {
        return $this->belongsTo(MasterWilayah::class, 'asal_master_wilayah_id');
    }

    public function perjalananDinas(): BelongsTo
    {
        return $this->belongsTo(PerjalananDinas::class);
    }
}
