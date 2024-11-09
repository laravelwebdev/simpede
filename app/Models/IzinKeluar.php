<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\Nova;
use Laravel\Nova\URL;

class IzinKeluar extends Model
{
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the post that owns the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (IzinKeluar $izin) {
            $izin->user_id = Auth::user()->id;
        });
        // static::created(function (IzinKeluar $izin) {
        //     if (in_array(Auth::user()->id, Helper::getUsersByPengelola('kepala', $izin->tanggal)->pluck('id')->toArray())) {
        //         $users = Helper::getUsersByPengelola('koordinator', $izin->tanggal);
        //         foreach ($users as $user) {
        //             $user->notify(
        //                 NovaNotification::make()
        //                     ->message('Izin Keluar Baru: '.Auth::user()->name.' Mengajukan Izin Keluar untuk '.$izin->kegiatan)
        //                     ->action('Lihat', URL::remote(Nova::path().'/resources/'.\App\Nova\IzinKeluar::uriKey().'/'.$izin->id))
        //                     ->icon('information-circle')
        //                     ->type('info')
        //             );
        //         }
        //     } else
        //     if (in_array(Auth::user()->id, Helper::getUsersByPengelola('koordinator', $izin->tanggal)->pluck('id')->toArray())) {
        //         $users = Helper::getUsersByPengelola('kepala', $izin->tanggal);
        //         foreach ($users as $user) {
        //             $user->notify(
        //                 NovaNotification::make()
        //                     ->message('Izin Keluar Baru: '.Auth::user()->name.' Mengajukan Izin Keluar untuk '.$izin->kegiatan)
        //                     ->action('Lihat', URL::remote(Nova::path().'/resources/'.\App\Nova\IzinKeluar::uriKey().'/'.$izin->id))
        //                     ->icon('information-circle')
        //                     ->type('info')
        //             );
        //         }
        //     }
        //     else
        //     if (in_array(Auth::user()->id, Helper::getUsersByPengelola('anggota', $izin->tanggal)->pluck('id')->toArray())) {
        //         $users = Helper::getUsersByPengelola('koordinator', $izin->tanggal);
        //         foreach ($users as $user) {
        //             $user->notify(
        //                 NovaNotification::make()
        //                     ->message('Izin Keluar Baru: '.Auth::user()->name.' Mengajukan Izin Keluar untuk '.$izin->kegiatan)
        //                     ->action('Lihat', URL::remote(Nova::path().'/resources/'.\App\Nova\IzinKeluar::uriKey().'/'.$izin->id))
        //                     ->icon('information-circle')
        //                     ->type('info')
        //             );
        //         }
        //     }
        // });
    }
}
