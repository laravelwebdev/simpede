<?php

namespace App\Helpers;

use App\Models\JenisKontrak;
use App\Models\JenisNaskah;
use App\Models\KamusAnggaran;
use App\Models\KodeArsip;
use App\Models\KodeNaskah;
use App\Models\NaskahKeluar;
use App\Models\Pengelola;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Helper
{
    public static $akun_persediaan = [
        '521811',
        '521813',
        '523112',
        '523123',
        '523125',
        '521832',
        '521831',
    ];

    public static $akun_perjalanan = [
        '524111',
        '524112',
        '524113',
        '524114',
        '524119',
        '524211',
        '524212',
        '524219',
    ];
    public static $akun_honor = [
        '521213',
    ];

    public static $bulan = [
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];

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
     * Pilihan Tahun.
     *
     * @return array $tahun
     */
    public static function setOptionTahun()
    {
        return array_combine(range(date('Y'), 2024), range(date('Y'), 2024));
    }

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
     * @param  date  $tanggal  Tanggal
     * @param  string  $tahun
     * @param  string  $jenis_naskah_id
     * @param  string  $unit_kerja_id
     * @param  string  $kode_arsip_id
     * @param  string  $derajat
     * @return array nomor, nomor_urut, segmen
     */
    public static function nomor($tanggal, $tahun, $jenis_naskah_id, $unit_kerja_id, $kode_arsip_id, $derajat)
    {
        $jenis_naskah = JenisNaskah::cache()->get('all')->where('id', $jenis_naskah_id)->first();
        $kode_naskah = KodeNaskah::cache()->get('all')->where('id', $jenis_naskah->kode_naskah_id)->first();
        $unit_kerja = UnitKerja::cache()->get('all')->where('id', $unit_kerja_id)->first();
        $kode_arsip = KodeArsip::cache()->get('all')->where('id', $kode_arsip_id)->first();
        $naskah = NaskahKeluar::where('tahun', $tahun)->where('kode_naskah_id', $kode_naskah->id);
        $max_no_urut = $naskah->max('no_urut');
        $max_tanggal = $naskah->max('tanggal') ?? '1970-01-01';
        if ($tanggal >= $max_tanggal) {
            $no_urut = ($max_no_urut ?? 0) + 1;
            $segmen = 0;
            $replaces['<no_urut>'] = $no_urut;
        } else {
            $no_urut = $naskah->where('tanggal', '<=', $tanggal)->max('no_urut') ?? 1;
            $segmen = NaskahKeluar::where('tahun', $tahun)->where('kode_naskah_id', $kode_naskah->id)->where('no_urut', $no_urut)->max('segmen') + 1;
            $replaces['<no_urut>'] = $no_urut.'.'.$segmen;
        }
        $format = $jenis_naskah->format ?? $kode_naskah->format;
        $replaces['<tahun>'] = $tahun;
        $replaces['<unit_kerja_id>'] = $unit_kerja->kode;
        $replaces['<kode_arsip_id>'] = $kode_arsip->kode;
        $replaces['<derajat>'] = $derajat;
        $nomor = strtr($format, $replaces);

        return [
            'nomor' => $nomor,
            'no_urut' => $no_urut,
            'segmen' => $segmen,
        ];
    }

    /**
     * Generate Keterangan Pengelola.
     *
     * @param  string  $role  Role
     * @return User $user
     */
    public static function getPengelola($role)
    {
        $pengelola_id = Pengelola::cache()->get('all')->where('role', $role)->first()->user_id;

        return User::cache()->get('all')->where('id', $pengelola_id)->first();
    }

    /**
     * Cek Duplicate from json.
     *
     * @param  json  $json
     * @param  string  $key
     * @return bool
     */
    public static function cekGanda($json, $key)
    {
        $spek = collect($json);
        $cek = $spek->duplicates($key);

        return $cek->isNotEmpty();
    }

    /**
     * Menghitung jumlah nilai spesifikasi.
     *
     * @param  json  $json
     * @param  string  $key
     * @return float
     */
    public static function sumJson($json, $key)
    {
        $spek = collect($json);

        return $spek->sum($key);
    }

    /**
     * Menambahkan rincian total pada spesifikasi.
     *
     * @param  json  $spek
     * @return json
     */
    public static function addTotalToSpek($spek)
    {
        $spek = collect($spek);
        $spek->transform(function ($item, $index) {
            $item['spek_nilai'] = (float) $item['spek_volume'] * (float) $item['spek_harga'];

            return $item;
        })->toArray();

        return $spek;
    }

    /**
     * Mengecek mak memuat akun tertentu.
     *
     * @param  json anggaran $spek
     * @param  array  $akun
     * @return int
     */
    public static function sumJenisAkun($spek, $akun)
    {
        $spek = collect($spek);

        return $spek->transform(function ($item, $key) {
            return ['mak' => substr($item['mak'], -6)];
        })->whereIn('mak', $akun)->count();
    }

    /**
     * Menambahkan tambahan segmen nomor naskah.
     *
     * @param  int  $num
     * @return string
     */
    public static function setSegmen($num): string
    {
        $b26 = '';
        if ($num > 0) {
            do {
                $val = ($num % 26) ?: 26;
                $num = ($num - $val) / 26;
                $b26 = chr($val + 64).($b26 ?: '');
            } while (0 < $num);
        }

        return  $b26;
    }

    /**
     * Memeriksa apakah anggaran memuat akun perjalanan dinas.
     *
     * @param  json anggaran $spek
     * @return int
     */
    public static function sumJenisAkunPerjalanan($spek)
    {
        return self::sumJenisAkun($spek, self::$akun_perjalanan);
    }

    /**
     * Memeriksa apakah anggaran memuat akun belanja persediaan.
     *
     * @param  json anggaran $spek
     * @return int
     */
    public static function sumJenisAkunPersediaan($spek)
    {
        return self::sumJenisAkun($spek, self::$akun_persediaan);
    }

    /**
     * Memeriksa apakah anggaran memuat akun honor output kegiatan.
     *
     * @param  json anggaran $spek
     * @return int
     */
    public static function sumJenisAkunHonor($spek)
    {
        return self::sumJenisAkun($spek, self::$akun_honor);
    }

    /**
     * Memeriksa apakah terjadi perubahan dari anggaran honor menjadi tidak ada.
     *
     * @param  json anggaran $spek_old
     * @param  json anggaran $spek_new
     * @return bool
     */
    public static function isAkunHonorChanged($spek_old, $spek_new)
    {
        return self::sumJenisAkunHonor($spek_old) - self::sumJenisAkunHonor($spek_new) == 1;
    }

    /**
     * Memeriksa apakah terjadi perubahan dari anggaran perjalanan menjadi tidak ada.
     *
     * @param  json anggaran $spek_old
     * @param  json anggaran $spek_new
     * @return bool
     */
    public static function isAkunPerjalananChanged($spek_old, $spek_new)
    {
        return self::sumJenisAkunPerjalanan($spek_old) - self::sumJenisAkunPerjalanan($spek_new) == 1;
    }

    /**
     * Memeriksa apakah terjadi perubahan dari anggaran persediaan menjadi tidak ada.
     *
     * @param  json anggaran $spek_old
     * @param  json anggaran $spek_new
     * @return bool
     */
    public static function isAkunPersediaanChanged($spek_old, $spek_new)
    {
        return self::sumJenisAkunPersediaan($spek_old) - self::sumJenisAkunPersediaan($spek_new) == 1;
    }

    /**
     * Mengambil satu akun mak dari kumpulan akun.
     *
     * @param  json anggaran $spek
     * @param  array  $akun
     * @return string
     */
    public static function getSingleAkun($spek, $akun)
    {
        $spek = collect($spek);

        return $spek->filter(function ($item, $key) use ($akun) {
            return in_array(substr($item['mak'], -6), $akun);
        });
    }

    /**
     * Mengambil satu akun honor dari kumpulan akun.
     *
     * @param  json anggaran $spek
     * @return string
     */
    public static function getSingleAkunHonor($spek)
    {
        $spek = collect($spek);

        return $spek->filter(function ($item, $key) {
            return in_array(substr($item['mak'], -6), self::$akun_honor);
        })->first()['mak'];
    }

    /**
     * Mengambil satu akun perjalanan dari kumpulan akun.
     *
     * @param  json anggaran $spek
     * @return string
     */
    public static function getSingleAkunPerjalanan($spek)
    {
        $spek = collect($spek);

        return $spek->filter(function ($item, $key) {
            return in_array(substr($item['mak'], -6), self::$akun_perjalanan);
        })->first()['mak'];
    }

    /**
     * Mengambil satu akun persediaan dari kumpulan akun.
     *
     * @param  json anggaran $spek
     * @return string
     */
    public static function getSingleAkunPersediaan($spek)
    {
        $spek = collect($spek);

        return $spek->filter(function ($item, $key) {
            return in_array(substr($item['mak'], -6), self::$akun_persediaan);
        })->first()['mak'];
    }

    /**
     * Mengambil detail akun.
     *
     * @param  string  $mak
     * @return collection
     */
    public static function getCollectionDetailAkun($mak)
    {
        return KamusAnggaran::cache()->get('all')->filter(function ($item, $key) use ($mak) {
            return Str::of($item->mak)->startsWith($mak) && Str::of($item->mak)->length > 37;
        });
    }

    /**
     * Mengambil detail Anggaran.
     *
     * @param  string  $mak
     * @param  string  $level
     * @return string
     */
    public static function getDetailAnggaran($mak, $level = 'akun', bool $kode_prefix = true)
    {
        $length = [
            'program' => 9,
            'kegiatan' => 14,
            'kro' => 18,
            'ro' => 22,
            'komponen' => 26,
            'sub' => 28,
            'akun' => 37,

        ];
        $kode = [
            'program' => '('.Str::substr($mak, 0, 9).') ',
            'kegiatan' => '('.Str::substr($mak, 10, 4).') ',
            'kro' => '('.Str::substr($mak, 10, 8).') ',
            'ro' => '('.Str::substr($mak, 10, 12).') ',
            'komponen' => '('.Str::substr($mak, 23, 3).') ',
            'sub' => '('.Str::substr($mak, 27, 1).') ',
            'akun' => '('.Str::substr($mak, 29, 6).') ',

        ];
        $detail = KamusAnggaran::cache()->get('all')->filter(function ($item, $key) use ($mak, $length, $level) {
            return Str::of($item->mak)->startsWith(Str::substr($mak, 0, $length[$level])) && Str::of($item->mak)->length == $length[$level];
        })->first()->detail;

        return $kode_prefix ? $kode[$level].$detail : $detail;
    }

    /**
     * Mengambil array Jenis Kontrak.
     *
     * @param  string  $tahun
     * @param  string  $bulan
     * @return array
     */
    public static function getJenisKontrak($tahun, $bulan): array
    {
        $tanggal = Carbon::createFromDate($tahun, $bulan)->startOfMonth();

        return JenisKontrak::cache()->get('all')->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first()->jenis;
    }

    /**
     * Pilihan Jenis kontrak.
     *
     * @param  string  $tahun
     * @param  string  $bulan
     * @return array
     */
    public static function setOptionJenisKontrak($tahun, $bulan)
    {
        $options = [];
        $jeniskontrak = self::getJenisKontrak($tahun, $bulan);
        foreach ($jeniskontrak as $option) {
            $options[$option['jenis']] = $option['jenis'];
        }

        return $options;
    }

    /**
     * Mengambil batas SBML.
     *
     * @param  string  $tahun
     * @param  string  $bulan
     * @param  string  $jenis
     * @return array
     */
    public static function getSbml($tahun, $bulan, $jenis)
    {
        $nilai = 0;
        $jeniskontrak = self::getJenisKontrak($tahun, $bulan);
        foreach ($jeniskontrak as $option) {
            $nilai = $option['jenis'] === $jenis ? $option['sbml'] : 0;
        }

        return $nilai;
    }
}
