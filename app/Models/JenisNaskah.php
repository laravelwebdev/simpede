<?php

namespace App\Models;

use App\Models\KodeNaskah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JenisNaskah extends Model
{
    use HasFactory;
    
    /**
     * Get the user that owns the pengelola.
     */
    public function kodeNaskah(): BelongsTo
    {
        return $this->belongsTo(KodeNaskah::class);
    }
}
