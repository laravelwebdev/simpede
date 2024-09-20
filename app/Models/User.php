<?php

namespace App\Models;

use App\Models\DataPegawai;
use App\Models\Pengelola;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mostafaznv\LaraCache\CacheEntity;
use Mostafaznv\LaraCache\Traits\LaraCache;

class User extends Authenticatable
{
    use HasFactory, LaraCache, Notifiable;

    public static function cacheEntities(): array
    {
        return [
            CacheEntity::make('all')
                ->cache(function () {
                    return User::all();
                }),
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the unit kerja that owns the user.
     */
    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class);
    }

    /**
     * Get the unit kerja that owns the user.
     */
    public function pengelola(): HasMany
    {
        return $this->hasMany(Pengelola::class);
    }

    /**
     * Get the unit kerja that owns the user.
     */
    public function dataPegawai(): HasMany
    {
        return $this->hasMany(DataPegawai::class);
    }

    protected static function booted(): void
    {
        static::creating(function (User $user) {
            $user->avatar = $user->avatar ?? 'G99ElrTEgEDRG4blE3m1xxMmFcfB0VVeLio0L3H6.jpg';
        });
        static::deleting(function (User $user) {
            $pengelolaIds = Pengelola::where('user_id', $user->id)->pluck('id');
            Pengelola::cache()->disable();
            Pengelola::destroy($pengelolaIds);
            Pengelola::cache()->enable();
            Pengelola::cache()->update('all');
            $dataPegawaiIds = DataPegawai::where('user_id', $user->id)->pluck('id');
            DataPegawai::cache()->disable();
            DataPegawai::destroy($dataPegawaiIds);
            DataPegawai::cache()->enable();
            DataPegawai::cache()->update('all');
        });
    }
}
