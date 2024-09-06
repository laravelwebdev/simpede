<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HonorSurvei extends Model
{
    use HasFactory;
    protected $casts = [
        'tanggal_spj' => 'date',
        'tanggal_sk' => 'date',
        'tanggal_st' => 'date',
        'tanggal_kak' => 'date',
        'awal' => 'date',
        'akhir' => 'date',
        'pegawai' => 'array',
    ];

    /**
     * Get the kerangka acuan that owns the honor survei.
     */
    public function kerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(KerangkaAcuan::class);
    }

    /**
     * Get the keluars for user.
     */
    public function daftarHonor(): HasMany
    {
        return $this->hasMany(DaftarHonor::class)->orderBy('nama', 'asc');
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (HonorSurvei $honor) {
            $honor->tahun = session('year');
            $honor->ppk = Helper::getPengelola('ppk')->nama;
            $honor->nipppk = Helper::getPengelola('ppk')->nip;
            $honor->bendahara = Helper::getPengelola('bendahara')->nama;
            $honor->nipbendahara = Helper::getPengelola('bendahara')->nip;
        });
        static::saving(function (HonorSurvei $honor) {
            if ($honor->generate_sk === 'Tidak') {
                $honor->tanggal_sk = null;
                $honor->objek_sk = null;
            }
            if ($honor->generate_st === 'Tidak') {
                $honor->tanggal_st = null;
                $honor->uraian_tugas = null;
                $honor->kode_arsip_id = null;
            }
        });
    //     static::deleting(function(Survei $survei) {
    //         $survei->spjs()->delete();
    //        File::delete(Storage::path('public/spj/SPJ'.explode('/', $survei->no_permintaan)[0].'.docx'));
    //        DownloadLink::where('file_path', '=', 'spj/SPJ'.explode('/', $survei->no_permintaan)[0].'.docx')->delete();
    //    });
    }
}
