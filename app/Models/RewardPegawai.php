<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RewardPegawai extends Model
{
    protected $fillable = ['status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::creating(function (RewardPegawai $reward) {
            $reward->status = 'dibuat';
        });   
        static::saving(function (RewardPegawai $reward) {
            $reward->tahun = session('year');
        });        
    }

}
