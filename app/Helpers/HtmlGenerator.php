<?php

namespace App\Helpers;

use App\Models\DaftarHonorMitra;
use App\Models\DaftarPulsaMitra;

class HtmlGenerator
{
    public static function detailHonorMitra($model)
    {
        $html = '<div class="p-2">
    <!-- Header -->
    <div class="flex justify-between mb-6">
      <div>
        <h2 class="text-xl font-bold">'.$model->nama.'</h2>
        <p class="text-gray-500 dark:text-gray-400">Bulan: '.Helper::terbilangBulan($model->bulan).'</p>
      </div>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-gray-100 dark:bg-gray-700">
            <th class="border p-2 text-left">No</th>
            <th class="border p-2 text-left">Kegiatan</th>
            <th class="border p-2 text-right">Jumlah Honor</th>
          </tr>
        </thead>
        <tbody>';
        $honors = DaftarHonorMitra::with('honorKegiatan')
            ->where('mitra_id', $model->mitra_id)
            ->whereHas('honorKegiatan', function ($query) use ($model) {
                $query->where('bulan', $model->bulan)
                    ->where('tahun', session('year'))
                    ->where('jenis_honor', 'Kontrak Mitra Bulanan');
            })
            ->get();
        $total = 0;
        $kegiatans = [];
        foreach ($honors as $i => $honor) {
            $jumlah = $honor->volume_realisasi * $honor->harga_satuan;
            $total += $jumlah;
            $kegiatans[] = [
                'no' => $i + 1,
                'kegiatan' => $honor->honorKegiatan->kegiatan ?? '',
                'jumlah' => $jumlah,
            ];
        }

        foreach ($kegiatans as $kegiatan) {
            $html .= '<tr>
            <td class="border p-2">'.$kegiatan['no'].'</td>
            <td class="border p-2">'.$kegiatan['kegiatan'].'</td>
            <td class="border p-2 text-right">'.Helper::formatUang($kegiatan['jumlah']).'</td>
          </tr>';
        }
        $html .= '</tbody>
      </table>
    </div>

    <!-- Footer Total -->
    <div class="mt-4 text-right font-bold text-lg">
      Total: '.Helper::formatUang($total).'
    </div>
  </div>';

        return $html;
    }

    public static function detailPulsaMitra($model)
    {
        $html = '<div class="p-2">
    <!-- Header -->
    <div class="flex justify-between mb-6">
      <div>
        <h2 class="text-xl font-bold">'.$model->nama.'</h2>
        <p class="text-gray-500 dark:text-gray-400">Bulan: '.Helper::terbilangBulan($model->bulan).'</p>
      </div>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-gray-100 dark:bg-gray-700">
            <th class="border p-2 text-left">No</th>
            <th class="border p-2 text-left">Kegiatan</th>
            <th class="border p-2 text-right">Jumlah Pulsa</th>
          </tr>
        </thead>
        <tbody>';
        $pulsas = DaftarPulsaMitra::with('pulsaKegiatan')
            ->where('mitra_id', $model->mitra_id)
            ->whereHas('pulsaKegiatan', function ($query) use ($model) {
                $query->where('bulan', $model->bulan)
                    ->where('tahun', session('year'));
            })
            ->get();
        $total = 0;
        $kegiatans = [];
        foreach ($pulsas as $i => $pulsa) {
            $jumlah = $pulsa->harga;
            $total += $jumlah;
            $kegiatans[] = [
                'no' => $i + 1,
                'kegiatan' => $pulsa->pulsaKegiatan->kegiatan ?? '',
                'jumlah' => $jumlah,
            ];
        }

        foreach ($kegiatans as $kegiatan) {
            $html .= '<tr>
            <td class="border p-2">'.$kegiatan['no'].'</td>
            <td class="border p-2">'.$kegiatan['kegiatan'].'</td>
            <td class="border p-2 text-right">'.Helper::formatUang($kegiatan['jumlah']).'</td>
          </tr>';
        }
        $html .= '</tbody>
      </table>
    </div>

    <!-- Footer Total -->
    <div class="mt-4 text-right font-bold text-lg">
      Total: '.Helper::formatUang($total).'
    </div>
  </div>';

        return $html;
    }
}
