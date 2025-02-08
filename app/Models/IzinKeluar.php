<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class IzinKeluar extends Model
{
    protected $casts = [
        'tanggal' => 'date',
        'bukti' => 'array',
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
            if ($izin->isDirty('bukti') && $izin->bukti) {
                $files = array_diff($izin->bukti, $izin->getOriginal('bukti') ?? []);
                foreach ($files as $file) {
                    $image = Image::read(Storage::disk('izin_keluar')->path($file))
                        ->toWebp(50);
                    Storage::disk('izin_keluar')->put($file, (string) $image);
                }
            }
        });
    }
}
