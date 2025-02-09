<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class DokumentasiKegiatan extends Model
{
    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'file' => 'array',
        ];
    }

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
            if ($dokumentasi->isDirty('file') && ! empty($dokumentasi->file) && ! $dokumentasi->uncompress) {
                $files = array_diff($dokumentasi->file, $dokumentasi->getOriginal('file') ?? []);
                foreach ($files as $file) {
                    $image = Image::read(Storage::disk('dokumentasi')->path($file))
                        ->toWebp(50);
                    Storage::disk('dokumentasi')->put($file, (string) $image);
                }
            }
            unset($dokumentasi->uncompress);
        });
    }
}
