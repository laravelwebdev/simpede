<?php

namespace App\Helpers;

use App\Models\KodeArsip;
use App\Models\KodeNaskah;
use App\Models\NaskahKeluar;
use App\Models\Pengelola;
use App\Models\UnitKerja;
use App\Models\User;

class Helper
{
    /**
     * Role admin|kpa|kepala|ppk|bendahara|ppspm|koordinator|anggota|pbj|bmn.
     *
     * @var array
     */
    public static $role = [
        'kepala' => 'kepala',
        'koordinator' => 'koordinator',
        'anggota' => 'anggota',
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
        'I/a' => 'Juru Muda',
        'I/b' => 'Juru Muda Tingkat 1',
        'I/c' => 'Juru',
        'I/d' => 'Juru Tingkat 1',
        'II/a' => 'Pengatur Muda',
        'II/b' => 'Pengatur Muda Tingkat 1',
        'II/c' => 'Pengatur',
        'II/d' => 'Pengatur Tingkat 1',
        'III/a' => 'Penata Muda',
        'III/b' => 'Penata Muda Tingkat 1',
        'III/c' => 'Penata',
        'III/d' => 'Penata Tingkat 1',
        'IV/a' => 'Pembina',
        'IV/b' => 'Pembina Tingkat 1',
        'IV/c' => 'Pembina Utama Muda',
        'IV/d' => 'Pembina Utama Madya',
        'IV/e' => 'Pembina Utama',
    ];

    /**
     * Mengubah Angka ke Suku Kata.
     *
     * @param  int|float  $x
     * @return string
     */
    private static function kata($x)
    {
        $x = abs($x);
        $angka = ['', 'satu', 'dua', 'tiga', 'empat', 'lima',
            'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas', ];
        $temp = '';
        if ($x < 12) {
            $temp = ' '.$angka[$x];
        } elseif ($x < 20) {
            $temp = self::kata($x - 10).' belas';
        } elseif ($x < 100) {
            $temp = self::kata($x / 10).' puluh'.self::kata($x % 10);
        } elseif ($x < 200) {
            $temp = ' seratus'.self::kata($x - 100);
        } elseif ($x < 1000) {
            $temp = self::kata($x / 100).' ratus'.self::kata($x % 100);
        } elseif ($x < 2000) {
            $temp = ' seribu'.self::kata($x - 1000);
        } elseif ($x < 1000000) {
            $temp = self::kata($x / 1000).' ribu'.self::kata($x % 1000);
        } elseif ($x < 1000000000) {
            $temp = self::kata($x / 1000000).' juta'.self::kata($x % 1000000);
        } elseif ($x < 1000000000000) {
            $temp = self::kata($x / 1000000000).' milyar'.self::kata(fmod($x, 1000000000));
        } elseif ($x < 1000000000000000) {
            $temp = self::kata($x / 1000000000000).' trilyun'.self::kata(fmod($x, 1000000000000));
        }

        return $temp;
    }

    /**
     * Mengubah Angka ke  Kata.
     *
     * @param  int|float  $x  Angka
     * @param  string  $style  up=Upper|uw=ucwordss|uf=ucfirst
     * @param  string  $suffix  tambahan di akhir
     * @return string
     */
    public static function terbilang($x, $style = 'uw', $suffix = '')
    {
        if ($x < 0) {
            $hasil = 'minus '.trim(self::kata($x));
        } else {
            $hasil = trim(self::kata($x));
        }
        switch ($style) {
            case 'up':
                // mengubah semua karakter menjadi huruf besar
                $hasil = strtoupper($hasil.' '.$suffix);
                break;
            case 'uw':
                // mengubah karakter pertama dari setiap kata menjadi huruf besar
                $hasil = ucwords($hasil.' '.$suffix);
                break;
            case 'uf':
                // mengubah karakter pertama menjadi huruf besar
                $hasil = ucfirst($hasil.' '.$suffix);
                break;
        }

        return $hasil;
    }

    /**
     * Mengubah Tanggal ke Kata.
     *
     * @param  Date  $tanggal
     * @param  string  $format  s=short|l=long
     * @return string
     */
    public static function terbilangTanggal($tanggal, $format = 's')
    {
        if ($tanggal) {
            $bulan = ['Januari',	'Februari',	'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $tanggal = $tanggal->format('Y-m-d');
            $split = explode('-', $tanggal);
            if ($format == 's') {
                $hasil = $split[2].' '.$bulan[(int) $split[1] - 1].' '.$split[0];
            } else {
                $hasil = self::terbilang((int) $split[2]).' bulan '.$bulan[(int) $split[1] - 1].' tahun '.self::terbilang((int) $split[0]);
            }

            return $hasil;
        }
    }

    /**
     * Membuat option value select filed.
     *
     * @param  Collection  $collection
     * @param  string  $value
     * @param  string  $tanggal
     * @param  string  $group
     * @return array
     */
    public static function setOptions($collection, $value, $label, $group = '')
    {
        $collection = $collection->all();
        $options = [];
        if ($group !== '') {
            foreach ($collection as $option) {
                $options[$option->$value] = ['label' => $option->$label, 'group' => $option->$group];
            }
        } else {
            foreach ($collection as $option) {
                $options[$option->$value] = $option->$label;
            }
        }

        return $options;
    }

    /**
     * Membuat Nomor.
     *
     * @param  string  $tahun
     * @param  string  $kode_naskah_id
     * @param  string  $unit_kerja_id
     * @param  string  $kode_arsip_id
     * @param  string  $derajat
     * @return array nomor, nomor_urut
     */
    public static function nomor($tahun, $kode_naskah_id, $unit_kerja_id, $kode_arsip_id, $derajat)
    {
        $kode_naskah = KodeNaskah::cache()->get('all')->where('id', $kode_naskah_id)->first();
        $unit_kerja = UnitKerja::cache()->get('all')->where('id', $unit_kerja_id)->first();
        $kode_arsip = KodeArsip::cache()->get('all')->where('id', $kode_arsip_id)->first();
        $max = NaskahKeluar::where('tahun', $tahun)->where('kode_naskah_id', $kode_naskah->id)->max('no_urut');
        $format = $kode_naskah->format;
        ($max > 0) ? $no_urut = $max + 1 : $no_urut = 1;
        $replaces['<tahun>'] = $tahun;
        $replaces['<no_urut>'] = $no_urut;
        $replaces['<unit_kerja_id>'] = $unit_kerja->kode;
        $replaces['<kode_arsip_id>'] = $kode_arsip->kode;
        $replaces['<derajat>'] = $derajat;
        $nomor = strtr($format, $replaces);

        return [
            'nomor' => $nomor,
            'no_urut' => $no_urut,
        ];
    }

    /**
     * Generate Keterangan Pengelola.
     *
     * @param  string  $role  Role
     * @return User $user
     */
    public function getPengelola($role)
    {
        $pengelola_id = Pengelola::cache()->get('all')->where('role', $role)->first()->user_id;
        return User::cache()->get('all')->where('id', $pengelola_id)->first();
    }
}
