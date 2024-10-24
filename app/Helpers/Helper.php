<?php

namespace App\Helpers;

use App\Models\DaftarHonorMitra;
use App\Models\DaftarHonorPegawai;
use App\Models\DataPegawai;
use App\Models\DerajatNaskah;
use App\Models\Dipa;
use App\Models\HargaSatuan;
use App\Models\HonorKegiatan;
use App\Models\JenisKontrak;
use App\Models\JenisNaskah;
use App\Models\KamusAnggaran;
use App\Models\KepkaMitra;
use App\Models\KodeArsip;
use App\Models\KodeNaskah;
use App\Models\MataAnggaran;
use App\Models\Mitra;
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
        'bast' => 'BAST',
        'kontrak' => 'Kontrak',
        'import' => 'Import',
        'kak' => 'Kerangka Acuan',
        'spj' => 'SPJ',
        'sk' => 'Surat Keputusan',
        'st' => 'Surat Tugas',
    ];

    public static $jenis_honor = [
        'Kontrak Mitra Bulanan' => 'Kontrak Mitra Bulanan',
        'Kontrak Mitra AdHoc' => 'Kontrak Mitra AdHoc',
        'Honor Pegawai' => 'Honor Pegawai',
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

    public static $pajakgolongan = [
        'I/a' => 0,
        'I/b' => 0,
        'I/c' => 0,
        'I/d' => 0,
        'II/a' => 0,
        'II/b' => 0,
        'II/c' => 0,
        'II/d' => 0,
        'III/a' => 5,
        'III/b' => 5,
        'III/c' => 5,
        'III/d' => 5,
        'IV/a' => 15,
        'IV/b' => 15,
        'IV/c' => 15,
        'IV/d' => 15,
        'IV/e' => 15,
    ];

    /**
     * Mengubah tanggal ke nama hari.
     *
     * @param  Date  $tanggal
     * @return string
     */
    public static function terbilangHari($tanggal)
    {
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $num = (int) $tanggal->format('N');

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
     * Mengubah angka ke format rupiah.
     *
     * @param  int|float  $angka
     * @return string
     */
    public static function formatRupiah($angka)
    {
        return 'Rp.'.self::formatUang($angka);
    }

    /**
     * Upper case nama tanpa gelar.
     *
     * @param  string  $nama
     * @return string
     */
    public static function upperNamaTanpaGelar($nama)
    {
        return strtoupper(explode(',', $nama)[0]);
    }

    /**
     * Mengubah angka ke format uang.
     *
     * @param  int|float  $angka
     * @return string
     */
    public static function formatUang($angka)
    {
        return number_format($angka, 0, ',', '.');
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
                $hasil = strtoupper($hasil.' '.$suffix);
                break;
            case 'uw':
                $hasil = ucwords($hasil.' '.$suffix);
                break;
            case 'uf':
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
            return $format == 's'
                ? $tanggal->day.' '.self::terbilangBulan($tanggal->month).' '.$tanggal->format('Y')
                : self::terbilang($tanggal->day).'bulan '.self::terbilangBulan($tanggal->month).' tahun '.self::terbilang($tanggal->year);
        }
    }

    /**
     * Mengembalikan tahun dari tanggal yang diberikan.
     *
     * @param  \Illuminate\Support\Carbon  $tanggal  Tanggal
     * @return int Tahun
     */
    public static function getYearFromDate($tanggal)
    {
        return $tanggal->format('Y');
    }

    /**
     * Mengembalikan tahun dari tanggal yang diberikan dalam format 'Y-m-d'.
     *
     * @param  string  $tanggal  Tanggal dalam format 'Y-m-d'
     * @return int Tahun
     */
    public static function getYearFromDateString($tanggal)
    {
        return Carbon::createFromFormat('Y-m-d', $tanggal)->year;
    }

    /**
     * Create a date from a given string.
     *
     * @param  string  $tanggal  Tanggal dalam format 'Y-m-d'
     * @return string|null Tanggal dalam format 'Y-m-d H:i:s' atau null jika tanggal kosong
     */
    public static function createDateFromString($tanggal)
    {
        if (empty($tanggal)) {
            return null;
        }

        return Carbon::createFromFormat('Y-m-d', $tanggal)->endOfDay()->format('Y-m-d H:i:s');
    }

    /**
     * Mem-parsing filter dari URL yang diberikan.
     *
     * @param  string  $url  URL yang akan di-parsing.
     * @param  string  $filterUri  URI filter yang akan dicari dalam query URL.
     * @param  string  $filterKey  Kunci filter yang akan diambil nilainya.
     * @return string Nilai filter yang ditemukan berdasarkan kunci filter yang diberikan.
     */
    public static function parseFilterFromUrl($url, $filterUri, $filterKey, $defaultValue = null)
    {
        $filterValue = $defaultValue ?? '';
        $queries = [];
        if ($url) {
            $parsed_url = parse_url($url, PHP_URL_QUERY);
        }

        if ($parsed_url) {
            parse_str($parsed_url, $queries);
        }

        if (isset($queries[$filterUri])) {
            $filters = array_merge(
                ...json_decode(
                    base64_decode($queries[$filterUri], true),
                    true
                )
            );

            $filterValue = $filters[$filterKey];
        }

        return $filterValue;
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
    public static function nomor($tanggal, $jenis_naskah_id, $unit_kerja_id = null, $kode_arsip_id = null, $derajat_naskah_id = null)
    {
        $replaces = [];
        $tahun = self::getYearFromDate($tanggal);
        $replaces['<tahun>'] = $tahun;

        $jenis_naskah = JenisNaskah::cache()->get('all')->where('id', $jenis_naskah_id)->first();
        $kode_naskah_id = self::getPropertyFromCollection($jenis_naskah, 'kode_naskah_id');
        $kode_naskah = KodeNaskah::cache()->get('all')->where('id', $kode_naskah_id)->first();

        if ($unit_kerja_id !== null) {
            $unit_kerja = UnitKerja::cache()->get('all')->where('id', $unit_kerja_id)->first();
            $replaces['<kode_unit_kerja>'] = self::getPropertyFromCollection($unit_kerja, 'kode');
        }

        if ($kode_arsip_id !== null) {
            $kode_arsip = KodeArsip::cache()->get('all')->where('id', $kode_arsip_id)->first();
            $replaces['<kode_arsip>'] = self::getPropertyFromCollection($kode_arsip, 'kode');
        }

        if ($derajat_naskah_id !== null) {
            $derajat_naskah = DerajatNaskah::cache()->get('all')->where('id', $derajat_naskah_id)->first();
            $replaces['<derajat>'] = self::getPropertyFromCollection($derajat_naskah, 'kode');
        }

        $naskah = NaskahKeluar::whereYear('tanggal', $tahun)->where('kode_naskah_id', self::getPropertyFromCollection($kode_naskah, 'id'));
        $max_no_urut = $naskah->max('no_urut') ?? 0;
        $max_tanggal = $naskah->max('tanggal') ?? '1970-01-01';

        if ($tanggal >= $max_tanggal) {
            $no_urut = $max_no_urut + 1;
            $segmen = 0;
        } else {
            $no_urut = $naskah->where('tanggal', '<=', $tanggal)->max('no_urut') ?? 1;
            $segmen = NaskahKeluar::whereYear('tanggal', $tahun)
                ->where('kode_naskah_id', self::getPropertyFromCollection($kode_naskah, 'id'))
                ->where('no_urut', $no_urut)
                ->max('segmen') + 1;
        }

        $replaces['<no_urut>'] = ($segmen > 0) ? "{$no_urut}.{$segmen}" : $no_urut;
        $format = self::getPropertyFromCollection($jenis_naskah, 'format') ?? self::getPropertyFromCollection($kode_naskah, 'format');
        $nomor = strtr($format, $replaces);

        return [
            'nomor' => $nomor,
            'no_urut' => $no_urut,
            'segmen' => $segmen,
            'kode_naskah_id' => self::getPropertyFromCollection($kode_naskah, 'id'),
        ];
    }

    /**
     * Mendapatkan user yang memiliki peran pengelola berdasarkan tanggal aktif/inaktif.
     *
     * @param  string  $role  Peran pengelola (admin/koordinator)
     * @param  date  $tanggal  Tanggal
     * @return Collection Kumpulan user
     */
    public static function getUsersByPengelola($role, $tanggal)
    {
        $usersIdByPengelola = Pengelola::cache()
            ->get('all')
            ->where('role', $role)
            ->where('active', '<=', $tanggal)
            ->where(function ($query) use ($tanggal) {
                return $query->where('inactive', '>', $tanggal)
                    ->orWhereNull('inactive');
            })
            ->pluck('user_id')
            ->toArray();
        $usersId = $usersIdByPengelola;
        if ($role === 'koordinator') {
            $usersIdByUnitKerja = DataPegawai::cache()
                ->get('all')
                ->where('unit_kerja_id', self::getPropertyFromCollection(self::getDataPegawaiByUserId(Auth::user()->id, $tanggal), 'unit_kerja_id'))
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
     * Mendapatkan data Pegawai berdasarkan ID User dan tanggal.
     *
     * @param  int  $user_id  ID User
     * @param  \Illuminate\Support\Carbon  $tanggal  Tanggal
     * @return \App\Models\DataPegawai|null
     */
    public static function getDataPegawaiByUserId($user_id, $tanggal)
    {
        return DataPegawai::cache()->get('all')->where('user_id', $user_id)->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first();
    }

    /**
     * Mendapatkan data Pegawai berdasarkan ID User.
     *
     * @param  int  $user_id  ID User
     * @return \App\Models\User|null
     */
    public static function getPegawaiByUserId($user_id)
    {
        return User::cache()->get('all')->where('id', $user_id)->first();
    }

    /**
     * Mendapatkan data Mitra berdasarkan ID.
     *
     * @param  int  $id  ID Mitra
     * @return \App\Models\Mitra|null
     */
    public static function getMitraById($id)
    {
        return Mitra::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Mengambil jenis kontrak berdasarkan ID.
     *
     * Metode ini mengambil semua catatan dari cache Mitra dan memfilter
     * untuk menemukan catatan pertama yang cocok dengan ID yang diberikan.
     *
     * @param  int  $id  ID jenis kontrak yang akan diambil.
     * @return mixed Catatan pertama yang cocok dengan ID yang diberikan, atau null jika tidak ada yang cocok.
     */
    public static function getJenisKontrakById($id)
    {
        return JenisKontrak::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Memeriksa apakah anggaran memuat akun honor output kegiatan.
     *
     * @param  json anggaran $spek
     * @return int
     */
    public static function isAkunHonor(string $mak): bool
    {
        return $mak == in_array(substr($mak, -6), self::$akun_honor);
    }

    /**
     * Memeriksa apakah akun honor berubah dari $mak_old menjadi $mak_new.
     *
     * @param  string  $mak_old  Maksimal akun sebelumnya
     * @param  string  $mak_new  Maksimal akun setelahnya
     * @return bool
     */
    public static function isAkunHonorChanged($mak_old, $mak_new)
    {
        return (self::isAkunHonor($mak_old) && ! self::isAkunHonor($mak_new)) || (self::isAkunHonor($mak_old) && self::isAkunHonor($mak_new) && $mak_old != $mak_new);
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
     * Mengambil detail akun sesuai level yang diinginkan.
     *
     * @param  string  $mak
     * @param  string  $level  default 'akun', pilihan: program, kegiatan, kro, ro, komponen, sub, akun
     * @param  bool  $kode_prefix  default true, jika true maka detail akan diawali dengan kode level yang diinginkan
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
        $kamus = KamusAnggaran::cache()->get('all')->filter(function ($item, $key) use ($mak, $length, $level) {
            return Str::of($item->mak)->startsWith(Str::substr($mak, 0, $length[$level])) && Str::of($item->mak)->length == $length[$level];
        })->first();
        $detail = $kamus == null ? 'edit manual karena belum ada di POK' : $kamus->detail;

        return $kode_prefix ? $kode[$level].$detail : $detail;
    }

    /**
     * Format tampilan spesifikasi.
     *
     * @param  array  $spesifikasi
     * @return array
     */
    public static function formatSpek($spesifikasi)
    {
        $spek = collect($spesifikasi);
        $spek->transform(function ($item, $index) {
            $item['spek_no'] = $index + 1;
            $item['harga_satuan'] = self::formatRupiah($item['harga_satuan']);
            $item['total_harga'] = self::formatRupiah($item['total_harga']);

            return $item;
        });

        return $spek->toArray();
    }

    /**
     * Format tampilan anggaran.
     *
     * @param  array  $anggaran
     * @return array
     */
    public static function formatAnggaran($anggaran)
    {
        $spek = collect($anggaran);
        $spek->transform(function ($item, $index) {
            $item['anggaran_no'] = $index + 1;
            $item['perkiraan'] = self::formatRupiah($item['perkiraan']);

            return $item;
        });

        return $spek->toArray();
    }

    /**
     * Format tampilan data Mitra untuk keperluan cetak SPJ.
     *
     * @param  collection  $mitra
     * @return collection
     */
    public static function formatMitra($mitra)
    {
        $mitra->transform(function ($item, $index) {
            $mitra = Helper::getMitraById($item['mitra_id']);
            $item['nama'] = Helper::getPropertyFromCollection($mitra, 'nama');
            $item['rekening'] = Helper::getPropertyFromCollection($mitra, 'rekening');
            $item['golongan'] = '-';
            $item['nip'] = '-';
            $item['jabatan'] = 'Mitra Statistik';
            $item['bruto'] = $item['volume'] * $item['harga_satuan'];
            $item['pajak'] = round($item['volume'] * $item['harga_satuan'] * $item['persen_pajak'] / 100, 0, PHP_ROUND_HALF_UP);
            $item['netto'] = $item['bruto'] - $item['pajak'];
            unset($item['mitra_id']);
            unset($item['id']);
            unset($item['created_at']);
            unset($item['updated_at']);
            unset($item['persen_pajak']);
            unset($item['honor_kegiatan_id']);

            return $item;
        });

        return $mitra;
    }

    /**
     * Format tampilan pegawai.
     *
     * @param  \Illuminate\Support\Collection  $pegawai
     * @param  string  $tanggal_spj
     * @return \Illuminate\Support\Collection
     */
    public static function formatPegawai($pegawai, $tanggal_spj)
    {
        $pegawai->transform(function ($item, $index) use ($tanggal_spj) {
            $pegawai = Helper::getPegawaiByUserId($item['user_id']);
            $item['nama'] = Helper::getPropertyFromCollection($pegawai, 'name');
            $item['nip'] = Helper::getPropertyFromCollection($pegawai, 'nip');
            $item['jabatan'] = Helper::getPropertyFromCollection(Helper::getDataPegawaiByUserId($item['user_id'], $tanggal_spj), 'jabatan');
            $item['rekening'] = Helper::getPropertyFromCollection($pegawai, 'rekening');
            $item['golongan'] = Helper::getPropertyFromCollection(Helper::getDataPegawaiByUserId($item['user_id'], $tanggal_spj), 'golongan');
            $item['bruto'] = $item['volume'] * $item['harga_satuan'];
            $item['pajak'] = round($item['volume'] * $item['harga_satuan'] * $item['persen_pajak'] / 100, 0, PHP_ROUND_HALF_UP);
            $item['netto'] = $item['bruto'] - $item['pajak'];
            unset($item['user_id']);
            unset($item['id']);
            unset($item['created_at']);
            unset($item['updated_at']);
            unset($item['persen_pajak']);
            unset($item['honor_kegiatan_id']);

            return $item;
        });

        return $pegawai;
    }

    /**
     * Format the mitra and pegawai from the database into a unified list with the required fields.
     *
     * @param  int  $honor_kegiatan_id  The ID of the honor kegiatan
     * @param  string  $tanggal  The date of the SPJ
     * @return Collection A collection of the unified list
     */
    public static function makeBaseListMitraAndPegawai($honor_kegiatan_id, $tanggal)
    {
        $mitra = DaftarHonorMitra::where('honor_kegiatan_id', $honor_kegiatan_id)->get();
        $pegawai = DaftarHonorPegawai::where('honor_kegiatan_id', $honor_kegiatan_id)->get();
        $formattedMitra = self::formatMitra($mitra);
        $formattedPegawai = self::formatPegawai($pegawai, $tanggal);
        $formattedMitra->push(...$formattedPegawai);

        return $formattedMitra;
    }

    /**
     * Buat array untuk keperluan SPJ berdasar id honor kegiatan dan tanggal.
     *
     * @param  int  $honor_kegiatan_id
     * @param  string  $tanggal
     * @return array
     */
    public static function makeSpjMitraAndPegawai($honor_kegiatan_id, $tanggal)
    {
        return self::makeBaseListMitraAndPegawai($honor_kegiatan_id, $tanggal)
            ->reject(function ($item) {
                return $item['netto'] == 0;
            })
            ->flatten()
            ->transform(function ($item, $index) {
                $item['spj_no'] = $index + 1;
                $item['bruto'] = self::formatUang($item['bruto']);
                $item['pajak'] = self::formatUang($item['pajak']);
                $item['netto'] = self::formatUang($item['netto']);
                $item['harga_satuan'] = self::formatUang($item['harga_satuan']);

                return $item;
            })
            ->toArray();
    }

    /**
     * Membuat format data untuk Surat Tugas (ST) ke mitra dan pegawai.
     *
     * @param  int  $honor_kegiatan_id
     * @param  \Illuminate\Support\Carbon  $tanggal
     * @return array
     */
    public static function makeStMitraAndPegawai($honor_kegiatan_id, $tanggal)
    {
        return self::makeBaseListMitraAndPegawai($honor_kegiatan_id, $tanggal)
            ->transform(function ($item, $index) {
                $item['kepada'] = $index == 0 ? 'Kepada: ' : '';
                $item['st_no'] = $index + 1;

                return $item;
            })
            ->toArray();
    }

    /**
     * Make Surat Keterangan (SK) for both Mitra and Pegawai.
     *
     * @param  int  $honor_kegiatan_id  ID of HonorKegiatan
     * @param  string  $tanggal  Date in 'Y-m-d' format
     * @return array
     */
    public static function makeSkMitraAndPegawai($honor_kegiatan_id, $tanggal)
    {
        return self::makeBaseListMitraAndPegawai($honor_kegiatan_id, $tanggal)
            ->transform(function ($item, $index) use ($honor_kegiatan_id) {
                $item['sk_no'] = $index + 1;
                $item['honor'] = $item['harga_satuan'] > 0 ? self::formatUang($item['harga_satuan']).'/'.HonorKegiatan::find($honor_kegiatan_id)->satuan : '-';

                return $item;
            })
            ->toArray();
    }

    /**
     * Get property from collection.
     *
     * @param  mixed  $collection  Eloquent collection or null
     * @param  string  $property  Property name
     * @return mixed
     */
    public static function getPropertyFromCollection($collection, $property)
    {
        return $collection == null ? null : $collection->$property;
    }

    /**
     * Mendapatkan path template berdasarkan kolom dan value.
     *
     * @param  string  $column  Nama kolom template
     * @param  string  $value  Nilai kolom template
     * @return array Berisi filename dan path template
     */
    public static function getTemplatePath($column, $value)
    {
        $file = self::getPropertyFromCollection(Template::cache()->get('all')->where($column, '=', $value)->first(), 'file');

        return [
            'filename' => $file,
            'path' => Storage::disk('templates')->path($file),
        ];
    }

    /**
     * Mengambil Path Template berdasarkan nama Template.
     *
     * @param  string  $name  Nama Template
     * @return array
     */
    public static function getTemplatePathByName($name)
    {
        return self::getTemplatePath('nama', $name);
    }

    /**
     * Mengambil Path Template berdasarkan ID Template.
     *
     * @param  int  $id
     * @return array
     */
    public static function getTemplatePathById($id)
    {
        return self::getTemplatePath('id', $id);
    }

    /**
     * Mengambil ID Tata Naskah terbaru berdasarkan tanggal yang diberikan.
     *
     * @param  string  $tanggal
     * @return string
     */
    public static function getLatestTataNaskahId($tanggal)
    {
        return self::getPropertyFromCollection(TataNaskah::cache()->get('all')->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first(), 'id');
    }

    /**
     * Mengambil ID Harga Satuan Terbaru berdasarkan tanggal yang diberikan.
     *
     * @param  string  $tanggal
     * @return string
     */
    public static function getLatestHargaSatuanId($tanggal)
    {
        return self::getPropertyFromCollection(HargaSatuan::cache()->get('all')->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first(), 'id');
    }

    /**
     * Membuat option value select field Derajat Naskah berdasarkan tanggal yang diberikan.
     *
     * @param  string  $tanggal
     * @return array
     */
    public static function setOptionsDerajatNaskah($tanggal)
    {
        return self::setOptions(DerajatNaskah::cache()->get('all')->where('tata_naskah_id', self::getLatestTataNaskahId($tanggal)), 'id', 'derajat');
    }

    /**
     * Membuat option value select field Jenis Naskah berdasarkan tanggal yang diberikan.
     *
     * @param  string  $tanggal
     * @return array
     */
    public static function setOptionsJenisNaskah($tanggal)
    {
        $kode_naskah_id = KodeNaskah::cache()->get('all')->where('tata_naskah_id', self::getLatestTataNaskahId($tanggal))->pluck('id');

        return self::setOptions(JenisNaskah::cache()->get('all')->whereIn('kode_naskah_id', $kode_naskah_id), 'id', 'jenis');
    }

    /**
     * Membuat option value select field Kode Arsip berdasarkan tanggal yang diberikan.
     *
     * @param  string  $tanggal
     * @return array
     */
    public static function setOptionsKodeArsip($tanggal, array $filterId = [])
    {
        $kodeArsip = KodeArsip::cache()->get('all')->where('tata_naskah_id', self::getLatestTataNaskahId($tanggal));

        if (! empty($filterId)) {
            $kodeArsip = $kodeArsip->whereIn('id', $filterId);
        }

        return self::setOptions($kodeArsip, 'id', 'detail', 'group', '', 'kode');
    }

    /**
     * Membuat option value select field Mata Anggaran berdasarkan dipa_id yang diberikan.
     *
     * @param  int  $dipa_id
     * @return array
     */
    public static function setOptionsMataAnggaran($dipa_id)
    {
        return self::setOptions(MataAnggaran::cache()->get('all')->where('dipa_id', $dipa_id), 'mak', 'mak');
    }

    /**
     * Membuat option value select field.
     *
     * @param  \Illuminate\Support\Collection  $collection
     * @param  string  $value
     * @param  string  $label
     * @param  string  $group
     * @param  string  $labelPrefix
     * @param  string  $groupPrefix
     * @return array
     */
    public static function setOptions($collection, $value, $label, $group = '', $labelPrefix = '', $groupPrefix = '')
    {
        return $collection->mapWithKeys(function ($option) use ($value, $label, $group, $labelPrefix, $groupPrefix) {
            $labelValue = $labelPrefix ? $option->$labelPrefix.' '.$option->$label : $option->$label;
            $groupValue = $groupPrefix ? $option->$groupPrefix.' '.$option->$group : $option->$group;

            return [$option->$value => $group ? ['label' => $labelValue, 'group' => $groupValue] : $labelValue];
        })->toArray();
    }

    /**
     * Mengembalikan opsi jenis kontrak berdasarkan tanggal yang diberikan.
     *
     * @param  string  $tanggal
     * @return array
     */
    public static function setOptionJenisKontrak($tanggal)
    {
        return self::setOptions(JenisKontrak::cache()->get('all')->where('harga_satuan_id', self::getLatestHargaSatuanId($tanggal)), 'id', 'jenis');
    }

    /**
     * Opsi tahun DIPA.
     *
     * @return array
     */
    public static function setOptionTahunDipa()
    {
        $year = session('year');

        return [
            $year => $year,
            $year + 1 => $year + 1,
        ];
    }

    /**
     * Pilihan template berdasarkan jenis.
     *
     * @param  string  $jenis
     * @return array
     */
    public static function setOptionTemplate($jenis)
    {
        return self::setOptions(Template::cache()->get('all')->where('jenis', $jenis), 'id', 'nama');
    }

    /**
     * Mengambil opsi pengelola berdasarkan role dan tanggal.
     *
     * @param  string  $role
     * @param  string  $tanggal
     * @return array
     */
    public static function setOptionPengelola($role, $tanggal)
    {
        return self::setOptions(self::getUsersByPengelola($role, $tanggal), 'id', 'name');
    }

    /**
     * Opsi DIPA.
     *
     * @return array
     */
    public static function setOptionDipa()
    {
        return self::setOptions(Dipa::cache()->get('all')->whereBetween('tahun', [session('year'), session('year') + 1]), 'id', 'tahun');
    }

    /**
     * Opsi Kepka Mitra berdasarkan tahun.
     *
     * @param  int  $tahun
     * @return array
     */
    public static function setOptionKepkaMitra($tahun)
    {
        return self::setOptions(KepkaMitra::cache()->get('all')->where('tahun', $tahun), 'id', 'nomor');
    }
}
