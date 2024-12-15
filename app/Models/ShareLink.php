<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class ShareLink extends Model
{
    protected static function booted(): void
    {
        static::saving(function (ShareLink $shareLink) {
            $token = Str::random(32);
            $shareLink->token = $token;
            $shareLink->link = url(Config::get('nova.path')).'/arsip-dokumen?token='.$token;
        });
    }
}
