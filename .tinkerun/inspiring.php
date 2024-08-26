<?php

use App\Helpers\Helper;
use App\Models\KamusAnggaran;


$kamus = KamusAnggaran::cache()->get('all')->filter(function ($item, $key){
    return Str::of($item->mak)->startsWith('054.01.GG.2898.BMA.007.005.A.521213') && Str::of($item->mak)->length > 37;
});
$kamus->get()












