<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RewardPegawai extends Model
{
    protected function casts(): array
    {
        return [
            'tanggal_penetapan' => 'date',
        ];
    }

    protected $fillable = ['status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'sk_naskah_keluar_id');
    }

    public function daftarPenilaianReward(): HasMany
    {
        return $this->hasMany(DaftarPenilaianReward::class);
    }

    public function sertifikatNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'sertifikat_naskah_keluar_id');
    }

    protected static function booted(): void
    {
        static::creating(function (RewardPegawai $reward) {
            $reward->status = 'dibuat';
        });

        static::deleting(function (RewardPegawai $reward) {
            $reward->daftarPenilaianReward->each->delete();
            NaskahKeluar::destroy([$reward->sk_naskah_keluar_id, $reward->sertifikat_naskah_keluar_id]);
        });
        static::saving(function (RewardPegawai $reward) {
            $reward->tahun = session('year');
            if ($reward->status === 'ditetapkan') {
                if ($reward->sk_naskah_keluar_id === null) {
                    $default_naskah = NaskahDefault::cache()->get('all')
                        ->where('jenis', 'sk_reward')
                        ->first();
                    $naskahkeluar = new NaskahKeluar;
                    $naskahkeluar->tanggal = $reward->tanggal_penetapan;
                    $naskahkeluar->jenis_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'jenis_naskah_id');
                    $naskahkeluar->kode_arsip_id = Helper::getPropertyFromCollection($default_naskah, 'kode_arsip_id')[0];
                    $naskahkeluar->derajat_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'derajat_naskah_id');
                    $naskahkeluar->tujuan = 'Employee of the month';
                    $naskahkeluar->perihal = 'SK Employee of The Month Bulan '.Helper::$bulan[$reward->bulan];
                    $naskahkeluar->generate = 'A';
                    $naskahkeluar->save();
                    $reward->sk_naskah_keluar_id = $naskahkeluar->id;
                } else {
                    if ($reward->isDirty(['tanggal_penetapan'])) {
                        $naskahkeluar = NaskahKeluar::where('id', $reward->sk_naskah_keluar_id)->first();
                        $naskahkeluar->tanggal = $reward->tanggal_penetapan;
                        $naskahkeluar->save();
                    }
                }
                if ($reward->sertifikat_naskah_keluar_id === null) {
                    $default_naskah = NaskahDefault::cache()->get('all')
                        ->where('jenis', 'sertifikat_reward')
                        ->first();
                    $naskahkeluar = new NaskahKeluar;
                    $naskahkeluar->tanggal = $reward->tanggal_penetapan;
                    $naskahkeluar->jenis_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'jenis_naskah_id');
                    $naskahkeluar->kode_arsip_id = Helper::getPropertyFromCollection($default_naskah, 'kode_arsip_id')[0];
                    $naskahkeluar->derajat_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'derajat_naskah_id');
                    $naskahkeluar->tujuan = 'Employee of the month';
                    $naskahkeluar->perihal = 'Sertifikat Employee of The Month Bulan '.Helper::$bulan[$reward->bulan];
                    $naskahkeluar->generate = 'A';
                    $naskahkeluar->save();
                    $reward->sertifikat_naskah_keluar_id = $naskahkeluar->id;
                } else {
                    if ($reward->isDirty(['tanggal_penetapan'])) {
                        $naskahkeluar = NaskahKeluar::where('id', $reward->sertifikat_naskah_keluar_id)->first();
                        $naskahkeluar->tanggal = $reward->tanggal_penetapan;
                        $naskahkeluar->save();
                    }
                }
            }
        });
    }
}
