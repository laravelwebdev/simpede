<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BastMitra extends Model
{
    use HasFactory;

    protected $casts = [
        'tanggal_bast' => 'date',
    ];

    protected $fillable = ['kontrak_mitra_id'];

    public function kontrakMitra(): BelongsTo
    {
        return $this->belongsTo(KontrakMitra::class);
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
            static::updating(function (BastMitra $bast) {
                if ($bast->isDirty('tanggal_bast')) {
                    $daftar_basts = DaftarKontrakMitra::where('bast_mitra_id', $bast->id)->get();
                    foreach ($daftar_basts as $daftar_bast) {
                        $naskah_keluar = NaskahKeluar::find($daftar_bast->bast_naskah_keluar_id);
                        $naskah_keluar->tanggal = $bast->tanggal_bast;
                        $naskah_keluar->save();
                    }
                }
                if ($bast->isDirty()) {
                    $bast->status = $bast->status === 'dibuat' ? 'diubah' : 'outdated';
                }
            });
        });
    }
}
