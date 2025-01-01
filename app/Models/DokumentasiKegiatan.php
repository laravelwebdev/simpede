<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DokumentasiKegiatan extends Model
{
    protected $casts = [
        'tanggal' => 'date',
        'file' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::creating(function (DokumentasiKegiatan $dokumentasi) {
            $dokumentasi->user_id = Auth::user()->id;
        });
        static::saving(function (DokumentasiKegiatan $dokumentasi) {
            if ($dokumentasi->isDirty('file') && ! empty($dokumentasi->file) && $dokumentasi->compress) {
                $files = array_diff($dokumentasi->file, $dokumentasi->getOriginal('file') ?? []);
                foreach ($files as $file) {
                    $image = Image::make(Storage::disk('dokumentasi')->path($file))
                        ->encode('webp', 20);
                    Storage::disk('dokumentasi')->put($file, (string) $image);
                }                
            }
            unset($dokumentasi->compress);
        });
    }
}
