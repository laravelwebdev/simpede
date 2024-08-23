<?php

use App\Models\NaskahKeluar;

$naskah = NaskahKeluar::where('tahun', 2024)->where('kode_naskah_id', 3);
$max_no_urut = $naskah->max('no_urut');
$max_tanggal = $naskah->max('tanggal')?? '1970-01-01';
$no_urut = ($max_no_urut?? 0) + 1;
$no_urut = $naskah->where('tanggal', '<=', '2024-01-08')->max('no_urut')?? 1;
$naskah->get();
JenisNaskah::cache()->get('all')->reject(function ($value) {
    return $value->jenis == 'Form Permintaan';
})











