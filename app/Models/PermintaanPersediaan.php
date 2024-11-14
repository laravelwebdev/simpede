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
    protected $casts = [
        'tanggal_permintaan' => 'date',
        'tanggal_persetujuan' => 'date',
    ];

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

        static::deleting(function (PermintaanPersediaan $permintaan) {
            $permintaan->daftarBarangPersediaans->each->delete();
        });
    }
}
