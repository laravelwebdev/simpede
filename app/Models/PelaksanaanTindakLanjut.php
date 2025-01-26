<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PelaksanaanTindakLanjut extends Model
{
    public function tindakLanjut(): BelongsTo
    {
        return $this->belongsTo(TindakLanjut::class);
    }

    protected $casts = [
        'bukti_dukung' => 'array',
    ];
}
