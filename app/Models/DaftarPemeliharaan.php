<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarPemeliharaan extends Model
{
    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function masterBarangPemeliharaan(): BelongsTo
    {
        return $this->belongsTo(MasterBarangPemeliharaan::class);
    }

    public function pemeliharaan(): BelongsTo
    {
        return $this->belongsTo(Pemeliharaan::class);
    }

    protected static function booted(): void
    {
        static::created(function (DaftarPemeliharaan $daftar) {
            $daftar->pemeliharaan->update([
                'status' => 'selesai',
            ]);
        });
        static::deleted(function (DaftarPemeliharaan $daftar) {
            if ($daftar->count() === 0) {
                $daftar->pemeliharaan->update([
                    'status' => 'outdated',
                ]);
            }
        });
    }
}
