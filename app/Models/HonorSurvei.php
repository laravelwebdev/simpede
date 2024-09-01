<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class HonorSurvei extends Model
{
    use HasFactory;
    protected $casts = [
        'tanggal_spj' => 'date',
        'akhir' => 'date',
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
    //     static::deleting(function(Survei $survei) {
    //         $survei->spjs()->delete();
    //        File::delete(Storage::path('public/spj/SPJ'.explode('/', $survei->no_permintaan)[0].'.docx'));
    //        DownloadLink::where('file_path', '=', 'spj/SPJ'.explode('/', $survei->no_permintaan)[0].'.docx')->delete();
    //    });
    }
}
