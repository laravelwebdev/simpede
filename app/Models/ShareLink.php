<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShareLink extends Model
{
    protected static function booted(): void
    {
        static::saving(function (ShareLink $shareLink) {
            $token = uniqid(Str::random(19));
            $shareLink->token = $token;
            $shareLink->link = url(config('nova.path')).'/arsip-dokumen/'.$token;
        });
    }

    public function getShareLinkPerDetail($token)
    {
        $tahun = $this->where('token', $token)->first()->tahun;
        $dipa = Dipa::where('tahun', $tahun)->first();
        $search = request()->get('search');
        $data = DB::table('mata_anggarans')
            ->select(['mak', 'id', 'uraian'])
            ->where('dipa_id', ! empty($dipa) ? $dipa->id : null)
            ->when($search, function ($query, $search) {
                $keywords = explode('.', $search);
                foreach ($keywords as $keyword) {
                    $query->where('mak', 'like', '%'.$keyword.'%');
                }

                return $query;
            })
            ->orderBy('mak')
            ->orderBy('ordered');

        return $data;
    }

    public static function getTahunByToken($token)
    {
        return self::where('token', $token)->first()->tahun;
    }
}
