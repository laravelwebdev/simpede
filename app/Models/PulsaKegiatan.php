<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class PulsaKegiatan extends Model
{
    protected $fillable = ['status'];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function mataAnggaran(): BelongsTo
    {
        return $this->belongsTo(MataAnggaran::class);
    }

    public function jenisPulsa(): BelongsTo
    {
        return $this->belongsTo(JenisPulsa::class);
    }

    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function kerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(KerangkaAcuan::class);
    }

    /**
     * Get the daftar pulsa mitra.
     */
    public function daftarPulsaMitra(): HasMany
    {
        return $this->hasMany(DaftarPulsaMitra::class);
    }

    protected static function booted(): void
    {
        static::creating(function (PulsaKegiatan $pulsa) {
            $pulsa->tahun = session('year');
            $token = uniqid(Str::random(19));
            $pulsa->token = $token;
            $pulsa->status = 'open';
            $pulsa->link = url(config('nova.path')).'/pulsa/'.$token;
        });
        static::updating(function (PulsaKegiatan $pulsa) {
            $dataKetua = Helper::getDataPegawaiByUserId($pulsa->koordinator_user_id, $pulsa->tanggal);
            $pulsa->unit_kerja_id = optional($dataKetua)->unit_kerja_id;
        });
        static::deleting(function (PulsaKegiatan $pulsa) {
            $DaftarPulsaMitraIds = DaftarPulsaMitra::where('pulsa_kegiatan_id', $pulsa->id)->pluck('id');
            DaftarPulsaMitra::destroy($DaftarPulsaMitraIds);
        });
    }

    public static function getJudulByToken($token)
    {
        return optional(self::where('token', $token)->first())->kegiatan;
    }

    public static function getIdByToken($token)
    {
        return optional(self::where('token', $token)->first())->id;
    }
}
