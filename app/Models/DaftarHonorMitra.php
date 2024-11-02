<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarHonorMitra extends Model
{
    use HasFactory;

    protected $fillable = ['mitra_id', 'honor_kegiatan_id', 'daftar_kontrak_mitra_id'];

    public function honorKegiatan()
    {
        return $this->belongsTo(HonorKegiatan::class, 'honor_kegiatan_id');
    }

    protected static function booted(): void
    {
        static::saving(function (DaftarHonorMitra $honor) {
            if ($honor->isDirty()) {
                HonorKegiatan::where('id', $honor->honor_kegiatan_id)
                    ->update(['status' => 'outdated']);
                $daftarKontrak = DaftarKontrakMitra::find($honor->daftar_kontrak_mitra_id);
                if ($daftarKontrak) {
                    $daftarKontrak->update([
                        'status_kontrak' => 'outdated',
                        'status_bast' => 'outdated'
                    ]);
                }
            }
            if ($honor->volume_realisasi != $honor->volume_target) {
                $honor->status_realisasi = $honor->volume_realisasi < $honor->volume_target
                ? 'Selesai Tidak Sesuai Target'
                : 'Selesai Melebihi Target';
            } else {
                $honor->status_realisasi = 'Selesai Sesuai Target';
            }
        });
        static::deleting(function (DaftarHonorMitra $honor) {
            HonorKegiatan::where('id', $honor->honor_kegiatan_id)
            ->update(['status' => 'outdated']);
        });
    }
}
