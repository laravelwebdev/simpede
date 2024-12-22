<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RapatInternal extends Model
{
    protected $casts = [
        'tanggal' => 'date',
        'tanggal_rapat' => 'date',
        'peserta' => 'array',
    ];

    public function kasubbag(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kasubbag_user_id');
    }

    public function pimpinan(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pimpinan_user_id');
    }

    public function kepala(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kepala_user_id');
    }

    public function notulis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'notulis_user_id');
    }

    public function naskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class);
    }
}
