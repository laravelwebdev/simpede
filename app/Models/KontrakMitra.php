<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakMitra extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'tahun', 'bulan', 'jenis_kontrak' ,'jenis_honor', 'honor_kegiatan_id'];

    protected $casts = [
        'awal_kontrak' => 'date',
        'akhir_kontrak' => 'date',
        'tanggal_spk' => 'date',
    ];

    protected static function booted(): void
    {
        static::created(function (KontrakMitra $kontrak) {
           $bast = new BastMitra();
           $bast->kontrak_mitra_id = $kontrak->id;
           $bast->save();
        });
        static::deleting(function (KontrakMitra $kontrak) {
            $bastId = Helper::getPropertyFromCollection(BastMitra::where('kontrak_mitra_id', $kontrak->id)->first(), 'id');
            BastMitra::destroy($bastId);
         });
    }

}
