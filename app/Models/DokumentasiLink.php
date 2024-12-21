<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DokumentasiLink extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::creating(function (DokumentasiLink $link) {
            $link->user_id = Auth::user()->id;
        });

    }
}
