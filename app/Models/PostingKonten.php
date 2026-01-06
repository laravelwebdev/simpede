<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostingKonten extends Model
{
    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::creating(function (PostingKonten $postingKonten) {
            $postingKonten->status = 'Belum Mulai';
        });
        static::deleting(function (PostingKonten $postingKonten) {
            $kegiatanIds = DaftarKegiatan::where('posting_konten_id', $postingKonten->id)->pluck('id');
            DaftarKegiatan::destroy($kegiatanIds);
        });
        static::saved(function (PostingKonten $postingKonten) {
            $kegiatan = DaftarKegiatan::firstOrNew(
                [
                    'posting_konten_id' => $postingKonten->id,
                ]
            );
            $kegiatan->jenis = 'Deadline';
            $kegiatan->kegiatan = 'Posting '.$postingKonten->kegiatan;
            $kegiatan->awal = $postingKonten->tanggal;
            $kegiatan->pesan = $postingKonten->reminder;
            $kegiatan->wa_group_id = [['id' => '120363202688889376@g.us']];
            $kegiatan->daftar_kegiatanable_id = $postingKonten->user_id;
            $kegiatan->daftar_kegiatanable_type = User::class;
            $kegiatan->waktu_reminder = [
                ['hari' => 3, 'referensi_waktu' => 'H', 'waktu_kirim' => '09:00:00'],
                ['hari' => 0, 'referensi_waktu' => 'H', 'waktu_kirim' => '14:00:00'],
            ];
            $kegiatan->save();
        });
    }
}
