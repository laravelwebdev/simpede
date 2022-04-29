<?php

namespace App\Models;

use App\Helpers\CetakHelper;
use App\Helpers\Helper;
use Armancodes\DownloadLink\Models\DownloadLink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perjalanan extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        'tanggal' => 'date',
        'tgl_permintaan' => 'date',
        'berangkat' => 'date',
        'kembali' => 'date',
        'biaya' => 'array',
    ];

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = $value;
        $this->attributes['s1'] = (new Helper)->nomor($value, 'perjalanans', 'SPPD/6307')->segmen;
        $this->attributes['nomor'] = (new Helper)->nomor($value, 'perjalanans', 'SPPD/6307')->nomor;

        $this->attributes['ppk'] = (new Helper)->getPejabat('ppk', 'nama');
        $this->attributes['nipppk'] = (new Helper)->getPejabat('ppk', 'nip');
        $this->attributes['kepala'] = (new Helper)->getPejabat('kepala', 'nama');
        $this->attributes['nipkepala'] = (new Helper)->getPejabat('kepala', 'nip');
        $this->attributes['bendahara'] = (new Helper)->getPejabat('bendahara', 'nama');
        $this->attributes['nipbendahara'] = (new Helper)->getPejabat('bendahara', 'nip');
    }

    protected static function booted()
    {
        static::deleting(function ($perjalanan) {
            File::delete(Storage::path('public/perjalanan/SPD'.explode('/', $perjalanan->nomor)[0].'.docx'));
            DownloadLink::where('file_path', '=', 'perjalanan/SPD'.explode('/', $perjalanan->nomor)[0].'.docx')->delete();
            File::delete(Storage::path('public/perjalanan/DPR'.explode('/', $perjalanan->nomor)[0].'.docx'));
            DownloadLink::where('file_path', '=', 'perjalanan/DPR'.explode('/', $perjalanan->nomor)[0].'.docx')->delete();
        });

        static::updating(function ($perjalanan) {
            $perjalanan->biaya = Helper::simpanSpek($perjalanan->biaya);
        });

        static::updated(function ($perjalanan) {
            CetakHelper::cetakSpd($perjalanan->nomor);
            CetakHelper::cetakDpr($perjalanan->nomor);
        });
    }
}
