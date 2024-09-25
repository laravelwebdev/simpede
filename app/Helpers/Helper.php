<?php

namespace App\Helpers;

use App\Models\DataPegawai;
use App\Models\DerajatNaskah;
use App\Models\Dipa;
use App\Models\HargaSatuan;
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
        'import' => 'Import',
        'kak' => 'Kerangka Acuan',
        'spj' => 'SPJ',
        'sk' => 'Surat Keputusan',
        'st' => 'Surat Tugas',
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

        $tanggal =  Carbon::createFromFormat('Y-m-d', $tanggal)->endOfDay()->format('Y-m-d H:i:s');
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
        $kode_naskah = KodeNaskah::cache()->get('all')->where('id', self::getPropertyFromCollection($jenis_naskah, 'kode_naskah_id'))->first();
        if ($unit_kerja_id !== null) {
            $unit_kerja = UnitKerja::cache()->get('all')->where('id', $unit_kerja_id)->first();
            $replaces['<kode_unit_kerja>'] = self::getPropertyFromCollection($unit_kerja, 'kode');
        }
        if ($kode_arsip_id !== null) {
            $kode_arsip = KodeArsip::cache()->get('all')->where('id', $kode_arsip_id)->first();
            $replaces['<kode_arsip>'] = self::getPropertyFromCollection($kode_arsip, 'kode');
        }
        if ($derajat !== null) {
            $replaces['<derajat>'] = $derajat;
        }

        $naskah = NaskahKeluar::whereYear('tanggal', $tahun)->where('kode_naskah_id', self::getPropertyFromCollection($kode_naskah, 'id'));
        $max_no_urut = $naskah->max('no_urut');
        $max_tanggal = $naskah->max('tanggal') ?? '1970-01-01';
        if ($tanggal >= $max_tanggal) {
            $no_urut = ($max_no_urut ?? 0) + 1;
            $segmen = 0;
            $replaces['<no_urut>'] = $no_urut;
        } else {
            $no_urut = $naskah->where('tanggal', '<=', $tanggal)->max('no_urut') ?? 1;
            $segmen = NaskahKeluar::whereYear('tanggal', $tahun)->where('kode_naskah_id', self::getPropertyFromCollection($kode_naskah, 'id'))->where('no_urut', $no_urut)->max('segmen') + 1;
            $replaces['<no_urut>'] = $no_urut.'.'.$segmen;
        }
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
                ->where('unit_kerja_id',self::getPropertyFromCollection(self::getDataPegawaiByUserId(Auth::user()->id, $tanggal),'unit_kerja_id'))
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

    public static function getDataPegawaiByUserId($user_id, $tanggal)
    {
        return DataPegawai::cache()->get('all')->where('user_id', $user_id)->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first();
    }

    public static function getPegawaiByUserId($user_id)
    {
        return User::cache()->get('all')->where('id', $user_id)->first();
    }

    public static function getMitraById($id)
    {
        return Mitra::cache()->get('all')->where('id', $id)->first();
    }


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
     * Memeriksa apakah anggaran memuat akun honor output kegiatan.
     *
     * @param  json anggaran $spek
     * @return int
     */
    public static function isAkunHonor(string $mak): bool
    {
        return $mak == in_array(substr($mak, -6), self::$akun_honor);
    }

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
        // $speks= json_decode($spesifikasi,true);
        $spek = collect($spesifikasi);
        $spek->transform(function ($item, $index) {
            $item['spek_no'] = $index + 1;
            if (isset($item['harga_satuan'])) {
                $item['harga_satuan'] = self::formatRupiah($item['harga_satuan']);
            }
            if (isset($item['total_harga'])) {
                $item['total_harga'] = self::formatRupiah($item['total_harga']);
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
            $item['anggaran_no'] = $index + 1;
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
    public static function formatMitra($mitra)
    {
        $mitra->transform(function ($item, $index) {
            $mitra = Helper::getMitraById($item['mitra_id']);
            $item['nama']   = Helper::getPropertyFromCollection($mitra, 'nama');
            $item['rekening']   = Helper::getPropertyFromCollection($mitra, 'rekening');
            $item['golongan'] = '-';
            $item['bruto'] = $item['volume']*$item['harga_satuan'];
            $item['pajak'] = round($item['volume']*$item['harga_satuan']*$item['persen_pajak']/100,0,PHP_ROUND_HALF_UP);
            $item['netto'] = $item['bruto'] - $item['pajak'];
            $item['harga_satuan'] = self::formatUang($item['harga_satuan']);
            $item['bruto'] = self::formatUang($item['bruto']);
            $item['pajak'] = self::formatUang($item['pajak']);
            $item['netto'] = self::formatUang($item['netto']);
            return $item;
        });

        return $mitra;
    }

    public static function formatPegawai($pegawai, $tanggal_spj)
    {
        $pegawai->transform(function ($item, $index) use ($tanggal_spj) {
            $pegawai = Helper::getPegawaiByUserId($item['user_id']);
            $item['nama']   = Helper::getPropertyFromCollection($pegawai, 'name');
            $item['rekening'] = Helper::getPropertyFromCollection($pegawai, 'rekening');
            $item['golongan'] = Helper::getPropertyFromCollection(Helper::getDataPegawaiByUserId($item['user_id'], $tanggal_spj), 'golongan');
            $item['bruto'] = $item['volume']*$item['harga_satuan'];
            $item['pajak'] = round($item['volume']*$item['harga_satuan']*$item['persen_pajak']/100,0,PHP_ROUND_HALF_UP);
            $item['netto'] = $item['bruto'] - $item['pajak'];
            $item['harga_satuan'] = self::formatUang($item['harga_satuan']);
            $item['bruto'] = self::formatUang($item['bruto']);
            $item['pajak'] = self::formatUang($item['pajak']);
            $item['netto'] = self::formatUang($item['netto']);
            return $item;
        });

        return $pegawai;
    }

    public static function getPropertyFromCollection($collection, $property)
    {
        return $collection == null ? null : $collection->$property;
    }

    /**
     * Mengambil Path Template.
     *
     * @param  string  $jenis
     * @return string
     */
    public static function getTemplatePath($column, $value)
    {
        $file = self::getPropertyFromCollection(Template::cache()->get('all')->where($column, '=', $value)->first(),'file');

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
     * Mengambil ID Tata Naskah Terbaru.
     *
     * @param  string  $tanggal
     * @return string
     */
    public static function getLatestTataNaskahId($tanggal)
    {
        return self::getPropertyFromCollection(TataNaskah::cache()->get('all')->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first(), 'id');
    }

    public static function getLatestHargaSatuanId($tanggal)
    {
        return self::getPropertyFromCollection(HargaSatuan::cache()->get('all')->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first(), 'id');
    }

    public static function setOptionsDerajatNaskah($tanggal)
    {
        return self::setOptions(DerajatNaskah::cache()->get('all')->where('tata_naskah_id', self::getLatestTataNaskahId($tanggal)), 'kode', 'derajat');
    }

    public static function setOptionsJenisNaskah($tanggal)
    {
        $kode_naskah_id = KodeNaskah::cache()->get('all')->where('tata_naskah_id', self::getLatestTataNaskahId($tanggal))->pluck('id');

        return self::setOptions(JenisNaskah::cache()->get('all')->whereIn('kode_naskah_id', $kode_naskah_id), 'id', 'jenis');
    }

    public static function setOptionsKodeArsip($tanggal)
    {
        return self::setOptions(KodeArsip::cache()->get('all')->where('tata_naskah_id', self::getLatestTataNaskahId($tanggal)), 'id', 'detail', 'group');
    }

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
    public static function setOptionJenisKontrak($tanggal)
    {
        return self::setOptions(JenisKontrak::cache()->get('all')->where('harga_satuan_id', self::getLatestHargaSatuanId($tanggal)), 'id', 'jenis');
    }


    public static function setOptionTahunDipa()
    {
        return [
            session('year') => session('year'),
            session('year') + 1 => session('year') + 1,
        ];
    }

    public static function setOptionTemplate($jenis)
    {
        return self::setOptions(Template::cache()->get('all')->where('jenis', $jenis), 'id', 'nama');
    }

    public static function setOptionPengelola($role, $tanggal)
    {
        return self::setOptions(self::getUsersByPengelola($role, $tanggal), 'id', 'name');
    }

    public static function setOptionDipa()
    {
        return self::setOptions(Dipa::cache()->get('all')->whereBetween('tahun', [session('year'), session('year') + 1]), 'id', 'tahun');
    }

    public static function setOptionKepkaMitra($tahun)
    {
        return self::setOptions(KepkaMitra::cache()->get('all')->where('tahun', $tahun), 'id', 'nomor');
    }
}
