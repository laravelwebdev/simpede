<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KontrakMitra extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'tahun', 'bulan', 'jenis_kontrak', 'jenis_honor', 'honor_kegiatan_id'];

    protected $casts = [
        'awal_kontrak' => 'date',
        'akhir_kontrak' => 'date',
        'tanggal_spk' => 'date',
    ];

    public function daftarKontrakMitra(): HasMany
    {
        return $this->hasMany(DaftarKontrakMitra::class);
    }

    protected static function booted(): void
    {
        static::creating(function (KontrakMitra $kontrak) {
            $kontrak->status = 'dibuat';
        });
        static::created(function (KontrakMitra $kontrak) {
            $bast = new BastMitra;
            $bast->kontrak_mitra_id = $kontrak->id;
            $bast->save();
        });
        static::deleting(function (KontrakMitra $kontrak) {
            $bastId = Helper::getPropertyFromCollection(BastMitra::where('kontrak_mitra_id', $kontrak->id)->first(), 'id');
            BastMitra::destroy($bastId);
        });
    }
}
