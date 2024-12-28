<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class DaftarKegiatan extends Model
{
    protected $fillable = [
        'rapat_internal_id',
        'jenis',
        'awal',
    ];

    protected $casts = [
        'awal' => 'datetime',
        'akhir' => 'datetime',
        'waktu_reminder' => 'array',
    ];

    public function daftarKegiatanable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function booted(): void
    {
        static::saving(function (DaftarKegiatan $daftar) {
            if (empty($daftar->akhir)) {
                $daftar->akhir = $daftar->awal;
            }
            if ($daftar->jenis == 'Libur') {
                $daftar->daftar_kegiatanable_id = null;
                $daftar->daftar_kegiatanable_type = null;
            }
            if ($daftar->jenis != 'Deadline') {
                $daftar->wa_group_id = null;
                $daftar->pesan = null;
                $daftar->waktu_reminder = null;
            }
        });
        static::deleting(function (DaftarKegiatan $daftar) {
            $ids = DaftarReminder::where('daftar_kegiatan_id', $daftar->id)->get()->pluck('id');
            DaftarReminder::destroy($ids);
        });

        static::creating(function (DaftarKegiatan $daftar) {
            if ($daftar->jenis === 'Deadline') {
                $daftar->status = 'in progress';
            }

        });

        static::saved(function (DaftarKegiatan $daftar) {
            if (($daftar->isDirty('waktu_reminder') || $daftar->isDirty('awal')) && $daftar->jenis == 'Deadline') {
                foreach ($daftar->waktu_reminder as $item) {
                    $tanggal = Helper::getTanggalSebelum($daftar->awal, $item['hari'], $item['referensi_waktu']);
                    $reminder = DaftarReminder::firstOrNew([
                        'tanggal' => $tanggal,
                        'daftar_kegiatan_id' => $daftar->id,
                    ]);
                    $reminder->status = 'dibuat';
                    $reminder->save();
                }
            }
        });
    }
}
