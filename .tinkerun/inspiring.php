<?php

namespace App\Http\Controllers;

use App\Models\KodeArsip;
use App\Models\KodeNaskah;
use App\Models\NaskahKeluar;
use App\Models\Pengelola;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Laravel\Nova\Nova;



// $kodes = KodeArsip::cache()->get('all')->all();

// function setOptions($collection, $value, $label, $group='')
// {
//     $options=[];
//     if ($group!=='') {
//         foreach ($collection as $option) {
//             $options[$option->$value]= ['label' => $option->$label,'group'=> $option->$group];
//         }
//     } else {
//         foreach ($collection as $option) {
//             $options[$option->$value] = $option->$label;
//         }
//     }
            
//     return  $options;
// }

// setOptions($kodes,'id','detail');

// $kodes = KodeArsip::cache()->get('all')->where('id',2)->first()->kode;
// Schema::getColumnListing('naskah_keluars');

// function nomor($tahun, $kode_naskah_id, $unit_kerja_id, $kode_arsip_id, $derajat) 
// {
//     $kode_naskah = KodeNaskah::cache()->get('all')->where('id',$kode_naskah_id)->first();
//     $unit_kerja= UnitKerja::cache()->get('all')->where('id',$unit_kerja_id)->first();
//     $kode_arsip= KodeArsip::cache()->get('all')->where('id',$kode_arsip_id)->first();
//     $max = NaskahKeluar::where('tahun',$tahun)->where('kode_naskah_id',$kode_naskah_id)->max('no_urut');
//     $format = $kode_naskah->format;
//     ($max>0) ? $no_urut = $max +1 : $no_urut = 1;
//     $replaces ['<tahun>'] = $tahun;
//     $replaces['<no_urut>'] = $no_urut;
//     $replaces['<unit_kerja_id>'] = $unit_kerja->kode;
//     $replaces['<kode_arsip_id>'] = $kode_arsip->kode;
//     $replaces['<derajat>'] = $derajat;
//     $nomor = strtr($format,$replaces);
//     return $nomor;


// }
// $b = nomor('2024','6',1,1,'B');






