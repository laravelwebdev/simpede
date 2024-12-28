<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RapatInternal extends Model
{
    protected $casts = [
        'tanggal' => 'date',
        'tanggal_rapat' => 'date',
        'peserta' => 'array',
    ];

    public function kasubbag(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kasubbag_user_id');
    }

    public function pimpinan(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pimpinan_user_id');
    }

    public function kepala(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kepala_user_id');
    }

    public function notulis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'notulis_user_id');
    }

    public function naskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class);
    }

    protected static function booted(): void
    {
        static::creating(function (RapatInternal $rapat) {
            $default_naskah = NaskahDefault::cache()->get('all')
                ->where('jenis', 'undangan')
                ->first();
            $naskahkeluar = new NaskahKeluar;
            $naskahkeluar->tanggal = $rapat->tanggal;
            $naskahkeluar->jenis_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'jenis_naskah_id');
            $naskahkeluar->kode_arsip_id = Helper::getPropertyFromCollection($default_naskah, 'kode_arsip_id')[0];
            $naskahkeluar->derajat_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'derajat_naskah_id');
            $naskahkeluar->tujuan = $rapat->tujuan;
            $naskahkeluar->perihal = 'Undangan '.$rapat->tema;
            $naskahkeluar->generate = 'A';
            $naskahkeluar->save();
            $rapat->naskah_keluar_id = $naskahkeluar->id;
        });
        static::updating(function (RapatInternal $rapat) {
            if ($rapat->isDirty('tanggal_rapat')) {
                $naskahkeluar = NaskahKeluar::where('id', $rapat->naskah_keluar_id)->first();
                $naskahkeluar->tanggal = $rapat->tanggal;
                $naskahkeluar->save();
            }
        });

        static::deleting(function (RapatInternal $rapat) {
            NaskahKeluar::destroy($rapat->naskah_keluar_id);
            $kegiatanIds = DaftarKegiatan::where('rapat_internal_id', $rapat->id)->pluck('id');
            DaftarKegiatan::destroy($kegiatanIds);
        });

        static::saved(function (RapatInternal $rapat) {
            $kegiatan = DaftarKegiatan::firstOrNew(
                [
                    'rapat_internal_id' => $rapat->id,
                ]
            );
            $kegiatan->jenis = 'Rapat';
            $kegiatan->kegiatan = $rapat->tema;
            $kegiatan->awal = $rapat->tanggal_rapat;
            $kegiatan->save();
        });
    }
}
