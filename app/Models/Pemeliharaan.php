<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\Nova;
use Laravel\Nova\URL;

class Pemeliharaan extends Model
{
    protected $fillable = ['status'];

    public function kerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(KerangkaAcuan::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Pemeliharaan $pemeliharaan) {
            $pemeliharaan->status = 'dibuat';
            User::find(Auth::user()->id)->notify(
                NovaNotification::make()
                    ->message('Anda mengajukan anggaran pemeliharaan. Mohon lengkapi detail pemeliharaan yang dilakukan!')
                    ->action('Lihat', URL::remote(Nova::path().'/resources/'.\App\Nova\Pemeliharaan::uriKey().'/'.$pemeliharaan->id))
                    ->icon('exclamation')
                    ->type('error')
            );
        });
        static::deleting(function (Pemeliharaan $pemeliharaan) {
            //TODO: Hapus barang pemeliharaan
            // $pemeliharaan->daftarBarangPersediaans->each->delete();
        });
    }
}
