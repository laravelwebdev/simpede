<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarPemeliharaan extends Model
{
    protected $casts = [
        'tanggal' => 'date',
    ];
    public function masterBarangPemeliharaan(): BelongsTo
    {
        return $this->belongsTo(MasterBarangPemeliharaan::class);
    }

    public function pemeliharaan(): BelongsTo
    {
        return $this->belongsTo(Pemeliharaan::class);
    }
}
