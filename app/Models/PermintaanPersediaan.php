<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\Nova;
use Laravel\Nova\URL;

class PermintaanPersediaan extends Model
{
    protected $fillable = ['status'];

    protected function casts(): array
    {
        return [
            'tanggal_permintaan' => 'date',
            'tanggal_persetujuan' => 'date',
        ];
    }

    public function daftarBarangPersediaans(): MorphMany
    {
        return $this->morphMany(BarangPersediaan::class, 'barang_persediaanable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pbmn(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pbmn_user_id');
    }

    public function naskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class);
    }

    protected static function booted(): void
    {
        static::creating(function (PermintaanPersediaan $permintaan) {
            $permintaan->status = 'dibuat';
            $permintaan->user_id = Auth::user()->id;
        });

        static::created(function (PermintaanPersediaan $permintaan) {
            $users = Helper::getUsersByPengelola('bmn', $permintaan->tanggal_permintaan);
            foreach ($users as $user) {
                $user->notify(
                    NovaNotification::make()
                        ->message(Auth::user()->name.' Mengajukan Permintaan Persediaan')
                        ->action('Lihat', URL::remote(Nova::path().'/resources/'.\App\Nova\PermintaanPersediaan::uriKey().'/'.$permintaan->id))
                        ->icon('information-circle')
                        ->type('info')
                );
            }
        });

        static::saving(function (PermintaanPersediaan $permintaan) {
            if ($permintaan->naskah_keluar_id === null) {
                $default_naskah = NaskahDefault::cache()->get('all')
                    ->where('jenis', 'bon')
                    ->first();
                $naskahkeluar = new NaskahKeluar;
                $naskahkeluar->tanggal = $permintaan->tanggal_permintaan;
                $naskahkeluar->jenis_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'jenis_naskah_id');
                $naskahkeluar->kode_arsip_id = Helper::getPropertyFromCollection($default_naskah, 'kode_arsip_id')[0];
                $naskahkeluar->derajat_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'derajat_naskah_id');
                $naskahkeluar->tujuan = 'Pengelola Barang Persediaan';
                $naskahkeluar->perihal = 'Bon Permintaan Persediaan '.$permintaan->rincian;
                $naskahkeluar->generate = 'A';
                $naskahkeluar->save();
                $permintaan->naskah_keluar_id = $naskahkeluar->id;
            } else {
                if ($permintaan->isDirty(['tanggal_permintaan'])) {
                    $naskahkeluar = NaskahKeluar::where('id', $permintaan->naskah_keluar_id)->first();
                    $naskahkeluar->tanggal = $permintaan->tanggal_permintaan;
                    $naskahkeluar->save();
                }
            }
        });

        static::deleting(function (PermintaanPersediaan $permintaan) {
            $permintaan->daftarBarangPersediaans->each->delete();
            NaskahKeluar::destroy($permintaan->naskah_keluar_id);
        });
    }
}
