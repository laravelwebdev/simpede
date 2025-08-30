<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UangPersediaan extends Model
{
    protected $fillable = [
        'dipa_id', 'nomor_sp2d',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function dipa(): BelongsTo
    {
        return $this->belongsTo(Dipa::class);
    }
}
