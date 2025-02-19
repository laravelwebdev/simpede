<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class DaftarKegiatan extends Model
{
    protected $fillable = [
        'rapat_internal_id',
        'jenis',
        'awal',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'awal' => 'datetime',
            'akhir' => 'datetime',
            'waktu_reminder' => 'array',
        ];
    }

    public function daftarKegiatanable(): MorphTo
    {
        return $this->morphTo();
    }

    public function daftarReminder(): HasMany
    {
        return $this->hasMany(DaftarReminder::class);
    }

    protected static function booted(): void
    {
        static::saving(function (DaftarKegiatan $daftar) {
            if ($daftar->jenis != 'Kegiatan') {
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
            DaftarReminder::where('daftar_kegiatan_id', $daftar->id)->delete();
        });

        static::creating(function (DaftarKegiatan $daftar) {
            if ($daftar->jenis === 'Deadline') {
                $daftar->status = empty($daftar->waktu_reminder) ? 'sent' : 'on progress';
            }
        });

        static::saved(function (DaftarKegiatan $daftar) {
            if ($daftar->jenis == 'Deadline') {
                foreach ($daftar->waktu_reminder as $item) {
                    $tanggal = Helper::getTanggalSebelum($daftar->awal, $item['hari'], $item['referensi_waktu']);
                    $reminder = DaftarReminder::firstOrNew([
                        'tanggal' => $tanggal,
                        'waktu_kirim' => $item['waktu_kirim'],
                        'daftar_kegiatan_id' => $daftar->id,
                    ]);
                    $reminder->save();
                }
                $daftar
                    ->whereHas('daftarReminder', function ($query) {
                        $query->where('status', '!=', 'sent');
                    })
                    ->update(['status' => 'on progress']);
            }
        });
    }
}
