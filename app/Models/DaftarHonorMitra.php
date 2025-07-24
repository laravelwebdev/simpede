<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\Nova;
use Laravel\Nova\URL;

class DaftarHonorMitra extends Model
{
    protected $fillable = ['mitra_id', 'honor_kegiatan_id', 'daftar_kontrak_mitra_id'];

    public function honorKegiatan(): BelongsTo
    {
        return $this->belongsTo(HonorKegiatan::class, 'honor_kegiatan_id');
    }

    public function mitra(): BelongsTo
    {
        return $this->belongsTo(Mitra::class);
    }

    protected static function booted(): void
    {
        static::saving(function (DaftarHonorMitra $honor) {
            if ($honor->isDirty()) {
                HonorKegiatan::where('id', $honor->honor_kegiatan_id)
                    ->update(['status' => 'outdated']);
                $daftarKontrak = DaftarKontrakMitra::find($honor->daftar_kontrak_mitra_id);
                if ($daftarKontrak) {
                    $daftarKontrak->update([
                        'status_kontrak' => 'outdated',
                        'status_bast' => 'outdated',
                    ]);
                    KontrakMitra::where('id', $daftarKontrak->kontrak_mitra_id)
                        ->where('status', 'digenerate')
                        ->update(['status' => 'outdated']);
                    BastMitra::where('kontrak_mitra_id', $daftarKontrak->kontrak_mitra_id)
                        ->where('status', 'digenerate')
                        ->update(['status' => 'outdated']);
                    $ppk = Helper::getPegawaiByUserId($daftarKontrak->spk_ppk_user_id);
                    $ppk->notify(
                        NovaNotification::make()
                            ->message('Terdapat perubahan pada kontrak mitra!')
                            ->action('Lihat', URL::remote(Nova::path().'/resources/'.\App\Nova\KontrakMitra::uriKey()))
                            ->icon('exclamation')
                            ->type('error')
                    );
                }
            }
            if ($honor->volume_realisasi != $honor->volume_target) {
                $honor->status_realisasi = $honor->volume_realisasi < $honor->volume_target
                ? 'Selesai Tidak Sesuai Target'
                : 'Selesai Melebihi Target';
            } else {
                $honor->status_realisasi = 'Selesai Sesuai Target';
            }
        });
        static::deleting(function (DaftarHonorMitra $honor) {
            HonorKegiatan::where('id', $honor->honor_kegiatan_id)
                ->update(['status' => 'outdated']);
        });
    }
}
