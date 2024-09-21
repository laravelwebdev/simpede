<?php

namespace App\Helpers;

use App\Models\DataPegawai;
use App\Models\DerajatNaskah;
use App\Models\Dipa;
use App\Models\JenisKontrak;
use App\Models\JenisNaskah;
use App\Models\KamusAnggaran;
use App\Models\KodeArsip;
use App\Models\KodeNaskah;
use App\Models\MataAnggaran;
use App\Models\NaskahKeluar;
use App\Models\Pengelola;
use App\Models\TataNaskah;
use App\Models\Template;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helper
{
    /**
     * @var array
     *
     * This static property holds an array of account inventory data.
     */
    public static $akun_persediaan = [
        '521811',
        '521813',
        '523112',
        '523123',
        '523125',
        '521832',
        '521831',
    ];

    public static $template = [
        'kontrak' => 'Kontrak',
        'import'   => 'Import',
        'kak'      => 'Kerangka Acuan',
        'spj'      => 'SPJ',
        'sk'       => 'Surat Keputusan',
        'st'       => 'Surat Tugas',
    ];


    /**
     * @var array An array containing account information for travel.
     */
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
        '13' => 'AdHoc',
    ];

    public static $role = [
        'kepala' => 'Kepala',
        'ppk' => 'Pejabat Pembuat Komitmen',
        'bendahara' => 'Bendahara',
        'ppspm' => 'Pejabat PSPM',
        'pbj' => 'Pejabat PBJ',
        'bmn' => 'Pengelola BMN',
        'admin' => 'Administrator',
        'kpa' => 'Kuasa Pengguna Anggaran',
        'koordinator' => 'Ketua Tim',
        'anggota' => 'Pegawai',
        'kasubbag' => 'Kasubbag Umum',
        'arsiparis' => 'Arsiparis',
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
     * Mengubah tanggal ke nama hari.
     *
     * @param  Date  $tanggal
     * @return string
     */
    public static function terbilangHari($tanggal)
    {
        $tanggal = $tanggal->format('Y-m-d');
        $hari = ['Senin',	'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $num = date('N', strtotime($tanggal));

        return $hari[$num - 1];
    }

    /**
     * Mengubah bulan ke nama bulan.
     *
     * @param  int  $bulan
     * @return string
     */
    public static function terbilangBulan($bulan)
    {
        return self::$bulan[$bulan];
    }

    /**
     * Mengubah angka ke rupiah.
     *
     * @param  int|float  $angka
     * @return string
     */
    public static function formatRupiah($angka)
    {
        $hasil = 'Rp.'.self::formatUang($angka);

        return $hasil;
    }

    /**
     * Upper case nama tanpa gelar.
     *
     * @param  string  $nama
     * @return string
     */
    public static function upperNamaTanpaGelar($nama)
    {
        $hasil = explode(',', $nama)[0];

        return strtoupper($hasil);
    }

    /**
     * Mengubah angka ke format uang.
     *
     * @param  int|float  $angka
     * @return string
     */
    public static function formatUang($angka)
    {
        $hasil = number_format($angka, 0, ',', '.');

        return $hasil;
    }

    /**
     * Generate jangka waktu.
     *
     * @param  DateTime  $awal
     * @param  DateTime  $akhir
     * @return string
     */
    public static function jangkaWaktuHariKalender($awal, $akhir)
    {
        $selisih = $awal->diff($akhir)->format('%a') + 1;

        return $selisih.' ( '.self::terbilang($selisih).') Hari Kalender';
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
     * Menghapus titik di akhir kalimat.
     *
     * @param  string  $kalimat
     * @return string
     */
    public static function hapusTitikAkhirKalimat($kalimat)
    {
        return rtrim($kalimat, '.');
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

    public static function getYearFromDate($tanggal)
    {
        return  Carbon::createFromFormat('Y-m-d', $tanggal->format('Y-m-d'))->year;
    }

    public static function getYearFromDateString($tanggal)
    {
        return  Carbon::createFromFormat('Y-m-d', $tanggal)->year;
    }

    public static function createDateFromString($tanggal)
    {
        if ($tanggal == null) {
            return null;
        }

        return Carbon::createFromFormat('Y-m-d', $tanggal)->endOfDay()->format('Y-m-d H:i:s');
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
    public static function nomor($tanggal, $jenis_naskah_id, $unit_kerja_id = null, $kode_arsip_id = null, $derajat = null)
    {
        $replaces = [];
        $tahun = self::getYearFromDate($tanggal);
        $replaces['<tahun>'] = $tahun;
        $jenis_naskah = JenisNaskah::cache()->get('all')->where('id', $jenis_naskah_id)->first();
        $kode_naskah = KodeNaskah::cache()->get('all')->where('id', $jenis_naskah->kode_naskah_id)->first();
        if ($unit_kerja_id !== null) {
            $unit_kerja = UnitKerja::cache()->get('all')->where('id', $unit_kerja_id)->first();
            $replaces['<kode_unit_kerja>'] = $unit_kerja->kode;
        }
        if ($kode_arsip_id !== null) {
            $kode_arsip = KodeArsip::cache()->get('all')->where('id', $kode_arsip_id)->first();
            $replaces['<kode_arsip>'] = $kode_arsip->kode;
        }
        if ($derajat !== null) {
            $replaces['<derajat>'] = $derajat;
        }

        $naskah = NaskahKeluar::whereYear('tanggal', $tahun)->where('kode_naskah_id', $kode_naskah->id);
        $max_no_urut = $naskah->max('no_urut');
        $max_tanggal = $naskah->max('tanggal') ?? '1970-01-01';
        if ($tanggal >= $max_tanggal) {
            $no_urut = ($max_no_urut ?? 0) + 1;
            $segmen = 0;
            $replaces['<no_urut>'] = $no_urut;
        } else {
            $no_urut = $naskah->where('tanggal', '<=', $tanggal)->max('no_urut') ?? 1;
            $segmen = NaskahKeluar::whereYear('tanggal', $tahun)->where('kode_naskah_id', $kode_naskah->id)->where('no_urut', $no_urut)->max('segmen') + 1;
            $replaces['<no_urut>'] = $no_urut.'.'.$segmen;
        }
        $format = $jenis_naskah->format ?? $kode_naskah->format;
        $nomor = strtr($format, $replaces);

        return [
            'nomor' => $nomor,
            'no_urut' => $no_urut,
            'segmen' => $segmen,
            'kode_naskah_id' => $kode_naskah->id,
        ];
    }

    /**
     * Generate Keterangan Pengelola.
     *
     * @param  string  $role  Role
     * @return User $user
     */
    public static function getUsersByPengelola($role, $tanggal)
    {
        $usersIdByPengelola = Pengelola::cache()
            ->get('all')
            ->where('role', $role)
            ->where('active', '<=', $tanggal)
            ->where(function ($query) use ($tanggal) {
                return $query->where('inactive', '>', $tanggal)
                    ->orWhere('inactive', '=', null);
            })
            ->pluck('user_id')
            ->toArray();
        $usersId = $usersIdByPengelola;
        if ($role == 'koordinator') {
            $usersIdByUnitKerja = DataPegawai::cache()
                ->get('all')
                ->where('unit_kerja_id', Helper::getDataPegawaiByUserId(Auth::user()->id, $tanggal) ? Helper::getDataPegawaiByUserId(Auth::user()->id, $tanggal)->unit_kerja_id : null)
                ->where('tanggal', '<=', $tanggal)
                ->pluck('user_id')
                ->toArray();
            $koordinatorsId = array_intersect($usersIdByPengelola, $usersIdByUnitKerja);
            if (count($koordinatorsId) > 0) {
                $usersId = $koordinatorsId;
            }
        }

        return User::cache()->get('all')->whereIn('id', $usersId);
    }

    /**
     * Retrieve the most recent DataPegawai record for a given user ID up to a specified date.
     *
     * This method fetches all cached DataPegawai records, filters them by the provided user ID
     * and date, sorts them in descending order by date, and returns the first record.
     *
     * @param  int  $user_id  The ID of the user whose DataPegawai record is to be retrieved.
     * @param  string  $tanggal  The date up to which the DataPegawai records should be considered.
     * @return DataPegawai|null The most recent DataPegawai record for the given user ID up to the specified date, or null if no record is found.
     */
    public static function getDataPegawaiByUserId($user_id, $tanggal)
    {
        return DataPegawai::cache()->get('all')->where('user_id', $user_id)->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first();
    }

    public static function getPegawaiByUserId($user_id)
    {
        return User::cache()->get('all')->where('id', $user_id)->first();
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

    // /**
    //  * Mengecek mak memuat akun tertentu.
    //  *
    //  * @param  json anggaran $spek
    //  * @param  array  $akun
    //  * @return int
    //  */
    // public static function sumJenisAkun($spek, $akun)
    // {
    //     // $spek = collect($spek);

    //     return $spek->transform(function ($item, $key) {
    //         return ['mak' => substr($item['mak'], -6)];
    //     })->whereIn('mak', $akun)->count();
    // }

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

    // /**
    //  * Memeriksa apakah anggaran memuat akun perjalanan dinas.
    //  *
    //  * @param  json anggaran $spek
    //  * @return int
    //  */
    // public static function sumJenisAkunPerjalanan($spek)
    // {
    //     return self::sumJenisAkun($spek, self::$akun_perjalanan);
    // }

    // /**
    //  * Memeriksa apakah anggaran memuat akun belanja persediaan.
    //  *
    //  * @param  json anggaran $spek
    //  * @return int
    //  */
    // public static function sumJenisAkunPersediaan($spek)
    // {
    //     return self::sumJenisAkun($spek, self::$akun_persediaan);
    // }

    /**
     * Memeriksa apakah anggaran memuat akun honor output kegiatan.
     *
     * @param  json anggaran $spek
     * @return int
     */
    public static function isAkunHonor(string $mak): bool
    {
        return in_array(substr($mak, -6), self::$akun_honor);
    }

    /**
     * //  * Memeriksa apakah terjadi perubahan dari anggaran honor menjadi tidak ada.
     * //  *
     * //  * @param  json anggaran $spek_old
     * //  * @param  json anggaran $spek_new
     * //  * @return bool
     * //  */
    // public static function isAkunHonorChanged($spek_old, $spek_new)
    // {
    //     return self::sumJenisAkunHonor($spek_old) - self::sumJenisAkunHonor($spek_new) == 1;
    // }

    // /**
    //  * Memeriksa apakah terjadi perubahan dari anggaran perjalanan menjadi tidak ada.
    //  *
    //  * @param  json anggaran $spek_old
    //  * @param  json anggaran $spek_new
    //  * @return bool
    //  */
    // public static function isAkunPerjalananChanged($spek_old, $spek_new)
    // {
    //     return self::sumJenisAkunPerjalanan($spek_old) - self::sumJenisAkunPerjalanan($spek_new) == 1;
    // }

    // /**
    //  * Memeriksa apakah terjadi perubahan dari anggaran persediaan menjadi tidak ada.
    //  *
    //  * @param  json anggaran $spek_old
    //  * @param  json anggaran $spek_new
    //  * @return bool
    //  */
    // public static function isAkunPersediaanChanged($spek_old, $spek_new)
    // {
    //     return self::sumJenisAkunPersediaan($spek_old) - self::sumJenisAkunPersediaan($spek_new) == 1;
    // }

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
        // $spek = collect($spek);

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
        })->first()->detail ?? '';

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

        return JenisKontrak::cache()->get('all')->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first()->jenis ?? '';
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

    /**
     * Format tampilan spesifikasi.
     *
     * @param  array  $spesifikasi
     * @return array
     */
    public static function formatSpek($spesifikasi)
    {
        // $speks= json_decode($spesifikasi,true);
        $spek = collect($spesifikasi);
        $spek->transform(function ($item, $index) {
            $item['spek_no'] = $index + 1;
            $item['spek_nilai'] = (float) $item['spek_volume'] * (float) $item['spek_harga'];
            if (isset($item['spek_harga'])) {
                $item['spek_harga'] = self::formatRupiah($item['spek_harga']);
            }
            if (isset($item['spek_nilai'])) {
                $item['spek_nilai'] = self::formatRupiah($item['spek_nilai']);
            }

            return $item;
        })->toArray();

        return $spek;
    }

    /**
     * Format tampilan anggaran.
     *
     * @param  array  $spesifikasi
     * @return array
     */
    public static function formatAnggaran($anggaran)
    {
        // $speks= json_decode($spesifikasi,true);
        $spek = collect($anggaran);
        $spek->transform(function ($item, $index) {
            $item['no'] = $index + 1;
            if (isset($item['perkiraan'])) {
                $item['perkiraan'] = self::formatRupiah($item['perkiraan']);
            }

            return $item;
        })->toArray();

        return $spek;
    }

    /**
     * Format tampilan spj.
     *
     * @param  string  $spesifikasi
     * @return array
     */
    public static function formatSpj($spesifikasi)
    {
        $spek = json_decode($spesifikasi, true);
        $speks = collect($spek);
        $speks->transform(function ($item, $index) {
            $item['spj_no'] = $index + 1;
            if (isset($item['spj_satuan'])) {
                $item['spj_satuan'] = self::formatUang($item['spj_satuan']);
            }
            if (isset($item['spj_bruto'])) {
                $item['spj_bruto'] = self::formatUang($item['spj_bruto']);
            }
            if (isset($item['spj_pajak'])) {
                $item['spj_pajak'] = self::formatUang($item['spj_pajak']);
            }
            if (isset($item['spj_netto'])) {
                $item['spj_netto'] = self::formatUang($item['spj_netto']);
            }

            return $item;
        })->toArray();

        return $speks;
    }

    /**
     * Mengambil Path Template.
     *
     * @param  string  $jenis
     * @return string
     */
    public static function getTemplatePath($column, $value)
    {
        $file = Template::cache()->get('all')->where($column,'=', $value)->first()->file ?? '';

        return [
            'filename' => $file,
            'path' => Storage::disk('templates')->path($file),
        ];
    }

    public static function getTemplatePathByName($name)
    {
        return self::getTemplatePath('nama', $name);
    }

    public static function getTemplatePathById($id)
    {
       return self::getTemplatePath('id', $id);
    }

    /**
     * Mengambil Keterangan DIPA.
     *
     * @param  string  $id
     * @return collection
     */
    public static function getDipa($id)
    {
        return Dipa::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Mengambil ID Tata Naskah Terbaru.
     *
     * @param  string  $tanggal
     * @return string
     */
    public static function getLatestTataNaskahId($tanggal)
    {
        return TataNaskah::cache()->get('all')->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first()->id;
    }

    /**
     * Sets options for Derajat Naskah based on the given date.
     *
     * This method retrieves all Derajat Naskah records from the cache, filters them
     * by the 'tata_naskah_id' corresponding to the provided date, and then sets the
     * options using the 'kode' and 'derajat' fields.
     *
     * @param  string  $tanggal  The date used to determine the 'tata_naskah_id'.
     * @return mixed The result of setting the options.
     */
    public static function setOptionsDerajatNaskah($tanggal)
    {
        return self::setOptions(DerajatNaskah::cache()->get('all')->where('tata_naskah_id', self::getLatestTataNaskahId($tanggal)), 'kode', 'derajat');
    }

    /**
     * Sets options for Jenis Naskah based on the provided date.
     *
     * This method retrieves the `kode_naskah_id` by filtering the cached KodeNaskah
     * records using the `tata_naskah_id` obtained from the provided date. It then
     * sets the options for Jenis Naskah by filtering the cached JenisNaskah records
     * using the retrieved `kode_naskah_id`.
     *
     * @param  string  $tanggal  The date used to determine the `tata_naskah_id`.
     * @return array The options for Jenis Naskah with keys as 'id' and values as 'jenis'.
     */
    public static function setOptionsJenisNaskah($tanggal)
    {
        $kode_naskah_id = KodeNaskah::cache()->get('all')->where('tata_naskah_id', self::getLatestTataNaskahId($tanggal))->pluck('id');

        return self::setOptions(JenisNaskah::cache()->get('all')->whereIn('kode_naskah_id', $kode_naskah_id), 'id', 'jenis');
    }

    /**
     * Sets options for Kode Arsip based on the provided date.
     *
     * This method retrieves all cached Kode Arsip records and filters them
     * by the 'tata_naskah_id' that corresponds to the given date. It then
     * sets options using the filtered records.
     *
     * @param  string  $tanggal  The date used to determine the 'tata_naskah_id'.
     * @return mixed The result of the setOptions method.
     */
    public static function setOptionsKodeArsip($tanggal)
    {
        return self::setOptions(KodeArsip::cache()->get('all')->where('tata_naskah_id', self::getLatestTataNaskahId($tanggal)), 'id', 'detail', 'group');
    }

    /**
     * Sets options for Mata Anggaran based on the given year.
     *
     * This method retrieves the DIPA ID for the specified year and uses it to filter
     * the Mata Anggaran options. It then sets these options using the 'mak' field.
     *
     * @param  int  $tahun  The year for which to set the Mata Anggaran options.
     * @return array The filtered and set options for Mata Anggaran.
     */
    public static function setOptionsMataAnggaran($dipa_id)
    {
        return self::setOptions(MataAnggaran::cache()->get('all')->where('dipa_id', $dipa_id), 'mak', 'mak');
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

    // /**
    //  * Pilihan Tahun.
    //  *
    //  * @return array $tahun
    //  */
    // public static function setOptionTahun()
    // {
    //     return array_combine(range(date('Y'), 2024), range(date('Y'), 2024));
    // }

    public static function setOptionTahunDipa()
    {
        return [
            session('year') => session('year'),
            session('year') + 1 => session('year') + 1,
        ];
    }

    public static function setOptionPengelola($role, $tanggal, $unitKerjaId = null)
    {
        return self::setOptions(self::getUsersByPengelola($role, $tanggal, $unitKerjaId), 'id', 'name');
    }

    public static function setOptionDipa()
    {
        return self::setOptions(Dipa::cache()->get('all')->whereBetween('tahun', [session('year'), session('year') + 1]), 'id', 'tahun');
    }
}
