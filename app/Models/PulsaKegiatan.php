<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PulsaKegiatan extends Model
{
    public function kerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(KerangkaAcuan::class);
    }

    protected static function booted(): void
    {
        static::creating(function (PulsaKegiatan $pulsa) {
            $pulsa->tahun = session('year');
        });
    }
}
