<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NaskahMasuk extends Model
{
    public function jenisNaskah(): BelongsTo
    {
        return $this->belongsTo(JenisNaskah::class);
    }

    public function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }
}
