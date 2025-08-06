<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DigitalPayment extends Model
{
    protected function casts(): array
    {
        return [
            'tanggal_transaksi' => 'date',
            'tanggal_pembayaran' => 'date',
        ];
    }

    public function kerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(KerangkaAcuan::class);
    }
}
