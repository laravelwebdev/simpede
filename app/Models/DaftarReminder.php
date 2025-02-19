<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarReminder extends Model
{
    protected $fillable = [
        'tanggal',
        'daftar_kegiatan_id',
        'waktu_kirim',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'datetime',
        ];
    }

    public function daftarKegiatan(): BelongsTo
    {
        return $this->belongsTo(DaftarKegiatan::class);
    }

    protected static function booted(): void
    {
        static::creating(function (DaftarReminder $daftar) {
            $daftar->status = 'on progress';
        });
        static::deleting(function (DaftarReminder $daftar) {
            $daftar->daftarKegiatan->whereDoesntHave('daftarReminder', function ($query) use ($daftar) {
                $query->where('status', '!=', 'sent')->where('id', '!=', $daftar->id);
            })->update(['status' => 'sent']);
        });
    }

    public static function getRemindersForToday()
    {
        $tanggal = date('Y-m-d');

        return self::with('daftarKegiatan')
            ->whereDate('tanggal', $tanggal)
            ->whereTime('waktu_kirim', '<=', date('H:i:s'))
            ->where('status', '!=', 'sent')
            ->get();
    }
}
