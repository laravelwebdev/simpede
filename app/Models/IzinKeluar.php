<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\Nova;
use Laravel\Nova\URL;

class IzinKeluar extends Model
{
    use HasFactory;

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
            $izin->tahun = session('year');
        });
        static::created(function (IzinKeluar $izin) {
            $usercache = User::cache()->get('all');
            if (Auth::user()->role === 'kepala') {
                $users = $usercache->where('role', 'koordinator');
                foreach ($users as $user) {
                    $user->notify(
                        NovaNotification::make()
                            ->message('Izin Keluar Baru: '.Auth::user()->nama.' Mengajukan Izin Keluar untuk '.$izin->kegiatan)
                            ->action('Lihat', URL::remote(Nova::path().'/resources/'.\App\Nova\IzinKeluar::uriKey().'/'.$izin->id))
                            ->icon('information-circle')
                            ->type('info')
                    );
                }
            }
            if (Auth::user()->role === 'koordinator') {
                $users = $usercache->where('role', 'kepala');
                foreach ($users as $user) {
                    $user->notify(
                        NovaNotification::make()
                            ->message('Izin Keluar Baru: '.Auth::user()->nama.' Mengajukan Izin Keluar untuk '.$izin->kegiatan)
                            ->action('Lihat', URL::remote(Nova::path().'/resources/'.\App\Nova\IzinKeluar::uriKey().'/'.$izin->id))
                            ->icon('information-circle')
                            ->type('info')
                    );
                }
            }
            if (Auth::user()->role === 'anggota') {
                $users = $usercache->where('role', 'koordinator')
                    ->where('unit_kerja_id', Auth::user()->unit_kerja_id);
                foreach ($users as $user) {
                    $user->notify(
                        NovaNotification::make()
                            ->message('Izin Keluar Baru: '.Auth::user()->nama.' Mengajukan Izin Keluar untuk '.$izin->kegiatan)
                            ->action('Lihat', URL::remote(Nova::path().'/resources/'.\App\Nova\IzinKeluar::uriKey().'/'.$izin->id))
                            ->icon('information-circle')
                            ->type('info')
                    );
                }
            }
        });
    }
}
