<?php

use App\Helpers\Cetak;
use App\Helpers\Inspiring;
use App\Models\JenisKontrak;
use App\Models\KerangkaAcuan;
use Illuminate\Support\Carbon;


$format_nomor =':derajat-:no_urut/:kode_unit_kerja/:kode_arsip/:tahun';
$replaces=[];
preg_match_all("/:[a-zA-Z0-9_]+/", $format_nomor, $hasil);
foreach ($hasil[0] as $key)
if (($key != ':tahun') && ($key != ':no_urut')) $replaces[$key] = $key;

$format_nomor;

Carbon::createFromFormat('Y-m-d', '2024-01-01')->year;







