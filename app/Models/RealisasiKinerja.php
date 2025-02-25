<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RealisasiKinerja extends Model
{
    protected function casts(): array
    {
        return [
            'is_indikator' => 'boolean',
        ];
    }

    public function perjanjianKinerja(): BelongsTo
    {
        return $this->belongsTo(PerjanjianKinerja::class);
    }

    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class);
    }
}
