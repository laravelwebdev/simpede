<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BastMitra extends Model
{
    protected $fillable = ['kontrak_mitra_id', 'status'];

    public function kontrakMitra(): BelongsTo
    {
        return $this->belongsTo(KontrakMitra::class);
    }

    public function ppk(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ppk_user_id');
    }

    public function daftarKontrakMitra(): HasMany
    {
        return $this->hasMany(DaftarKontrakMitra::class);
    }

    protected static function booted(): void
    {
        static::creating(function (BastMitra $bast) {
            $bast->status = 'dibuat';
        });
        static::deleting(function (BastMitra $bast) {
            $daftarKontrakMitras = DaftarKontrakMitra::where('bast_mitra_id', $bast->id)->get();
            foreach ($daftarKontrakMitras as $daftarKontrakMitra) {
                $daftarKontrakMitra->bast_naskah_keluar_id = null;
                $daftarKontrakMitra->save();
            }
        });
    }
}
