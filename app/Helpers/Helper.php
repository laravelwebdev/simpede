<?php

namespace App\Helpers;

use App\Models\Pengelola;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Helper
{
    /**
     * Role admin|kpa|kepala|ppk|bendahara|ppspm|koordinator|anggota|pbj|bmn.
     *
     * @var array
     */
    public static $role = [
        'kepala'=>'kepala',
        'koordinator'=>'koordinator',
        'anggota'=>'anggota',       
    ];

    /**
     * Golongan PNS.
     *
     * @var array
     */
    public static $golongan = [
        'I/a' => ['label' => 'I/a', 'group' => 'GOLONGAN I (Juru)'],
        'I/b' => ['label' => 'I/b', 'group' => 'GOLONGAN I (Juru)'],
        'I/c' => ['label' => 'I/c', 'group' => 'GOLONGAN I (Juru)'],
        'I/d' => ['label' => 'I/d', 'group' => 'GOLONGAN I (Juru)'],
        'II/a' => ['label' => 'II/a', 'group' => 'GOLONGAN II (Pengatur)'],
        'II/b' => ['label' => 'II/b', 'group' => 'GOLONGAN II (Pengatur)'],
        'II/c' => ['label' => 'II/c', 'group' => 'GOLONGAN II (Pengatur)'],
        'II/d' => ['label' => 'II/d', 'group' => 'GOLONGAN II (Pengatur)'],
        'III/a' => ['label' => 'III/a', 'group' => 'GOLONGAN III (Penata)'],
        'III/b' => ['label' => 'III/b', 'group' => 'GOLONGAN III (Penata)'],
        'III/c' => ['label' => 'III/c', 'group' => 'GOLONGAN III (Penata)'],
        'III/d' => ['label' => 'III/d', 'group' => 'GOLONGAN III (Penata)'],
        'IV/a' => ['label' => 'IV/a', 'group' => 'GOLONGAN IV (Pembina)'],
        'IV/b' => ['label' => 'IV/b', 'group' => 'GOLONGAN IV (Pembina)'],
        'IV/c' => ['label' => 'IV/c', 'group' => 'GOLONGAN IV (Pembina)'],
        'IV/d' => ['label' => 'IV/d', 'group' => 'GOLONGAN IV (Pembina)'],
        'IV/e' => ['label' => 'IV/e', 'group' => 'GOLONGAN IV (Pembina)'],
    ];

    /**
     * Array Pangkat dan Golongan.
     *
     * @var array
     */
    public static $pangkat = [
        "I/a" => "Juru Muda",
        "I/b" => "Juru Muda Tingkat 1",
        "I/c" => "Juru",
        "I/d" => "Juru Tingkat 1",
        "II/a" => "Pengatur Muda",
        "II/b" => "Pengatur Muda Tingkat 1",
        "II/c" => "Pengatur",
        "II/d" => "Pengatur Tingkat 1",
        "III/a" => "Penata Muda",
        "III/b" => "Penata Muda Tingkat 1",
        "III/c" => "Penata",
        "III/d" => "Penata Tingkat 1",
        "IV/a" => "Pembina",
        "IV/b" => "Pembina Tingkat 1",
        "IV/c" => "Pembina Utama Muda",
        "IV/d" => "Pembina Utama Madya",
        "IV/e" => "Pembina Utama",
    ];


    /**
     * Membuat Nomor Surat.
     *
     * @param  int  $user_id
     * @return string
     */
    public function rolePengelola($user_id)
    {
        $pengelola = Pengelola::cache()->get('all');
    }

}
