<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class IzinKeluar extends Model
{
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the post that owns the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (IzinKeluar $izin) {
            $izin->user_id = Auth::user()->id;
        });
        static::saving(function (IzinKeluar $izin) {
            if ($izin->isDirty('bukti')) {
                Image::make(Storage::disk('izin_keluar')
                    ->path($izin->bukti))
                    ->encode(quality: 60);
            }
        });
    }
}
