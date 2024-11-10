<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarHonorPegawai extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::saving(function (DaftarHonorPegawai $honor) {
            if ($honor->isDirty()) {
                HonorKegiatan::where('id', $honor->honor_kegiatan_id)
                    ->update(['status' => 'outdated']);
            }
            if (! $honor->volume) {
                $honor->harga_satuan = null;
                $honor->persen_pajak = null;
            }
        });
        static::deleting(function (DaftarHonorPegawai $honor) {
            HonorKegiatan::where('id', $honor->honor_kegiatan_id)
                ->update(['status' => 'outdated']);
        });
    }
}
