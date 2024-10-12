<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BastMitra extends Model
{
    use HasFactory;

    protected $casts = [
        'tanggal_bast' => 'date',
    ];

    public function kontrakMitra(): BelongsTo
    {
        return $this->belongsTo(KontrakMitra::class);
    }

    protected static function booted(): void
    {
        static::creating(function (BastMitra $bast) {
            $bast->status = 'dibuat';
        });
    }
}
