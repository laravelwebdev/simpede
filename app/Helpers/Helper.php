<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Helper
{
    /**
     * Nomnor Surat.
     *
     * @var string
     */
    public $nomor = '';

    /**
     * Penanda Nomor Surat.
     *
     * @var string
     */
    public $segmen = 0;

    /**
     * Membuat Nomor Surat.
     *
     * @param  mixed[]  $tanggal  tanggal surat
     * @param  string  $table  tabel surat
     * @param  string  $kode  kode surat
     * @param  string  $prefix  kawalan nomor
     * @return object Nomor
     */
    public function nomor($tanggal, $table, $kode, $prefix = '')
    {
        $abjad = range('A', 'Z');
        $check1 = DB::table($table)->orderBy('tanggal', 'desc')->first();
        $check2 = DB::table($table)->orderBy('s1', 'desc')->first();
        $maxdate = (! is_null($check1)) ? $check1->tanggal : '1970-01-01';
        $bulan = Str::of(Carbon::createFromFormat('Y-m-d', $tanggal)->month)->padLeft(2, '0');
        $tahun = Carbon::createFromFormat('Y-m-d', $tanggal)->year;
        if ($tanggal >= $maxdate) {
            $maxs1 = (! is_null($check2)) ? $check2->s1 : 0;
            $this->segmen = 1 + $maxs1;
            $this->nomor = $prefix.Str::of(1 + $maxs1)->padLeft(3, '0')->append('/')->append($kode)->append('/6307/')->append($bulan)->append('/')->append($tahun);
        } else {
            $maxs1 = DB::table($table)->where('tanggal', '<=', $tanggal)->orderBy('s1', 'desc')->first()->s1;
            $index = DB::table($table)->where('s1', '=', $maxs1)->count('id');
            $this->segmen = $maxs1;
            $this->nomor = $prefix.Str::of($maxs1)->padLeft(3, '0')->append($abjad[$index - 1])->append('/')->append($kode)->append('/6307/')->append($bulan)->append('/')->append($tahun);
        }

        return $this;
    }

    /**
     * Generate Keterangan Pejabat.
     *
     * @param  string  $role  Role
     * @param  string  $ambil  nama|nip|jabatan|unit
     * @return string
     */
    public function getPejabat($role, $ambil = 'nama')
    {
        $pegawai = DB::table('users')->where('role', '=', $role)->first();
        switch ($ambil) {
            case 'unit':
                return $pegawai->unit;
                break;
            case 'nip':
                return $pegawai->nip;
                break;
            case 'jabatan':
                return $pegawai->jabatan;
                break;
            default:
                return $pegawai->name;
            }
    }

    /**
     * Unit Kerja.
     *
     * @var array
     */
    public static $unit_kerja = [
        'Sub Bagian Umum'=>'Sub Bagian Umum',
        'Fungsi Statistik Sosial'=>'Fungsi Statistik Sosial',
        'Fungsi Statistik Produksi'=>'Fungsi Statistik Produksi',
        'Fungsi Statistik Ditribusi'=>'Fungsi Statistik Ditribusi',
        'Fungsi Nerwilis'=>'Fungsi Nerwilis',
        'Fungsi IPDS'=>'Fungsi IPDS',
    ];

    /**
     * Metode Pengadaan.
     *
     * @var array
     */
    public static $metode = [
        'E Purchasing' => 'E Purchasing',
        'Pengadaan Langsung' => 'Pengadaan Langsung',
        'Penunjukan Langsung' => 'Penunjukan Langsung',
        'Tender' => 'Tender',
        'Tender Cepat' => 'Tender Cepat',
    ];

    /**
     * Role admin|kpa|kepala|ppk|bendahara|ppspm|koordinator.
     *
     * @var array
     */
    public static $role = [
        'admin'=>'admin',
        'kpa'=>'kpa',
        'kepala'=>'kepala',
        'ppk'=>'ppk',
        'bendahara'=>'bendahara',
        'ppspm'=>'ppspm',
        'koordinator'=>'koordinator',
        'pbj'=>'pbj',
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
     * Jenis Pengadaan swakelola|penyedia.
     *
     * @var array
     */
    public static $pengelolaan = [
        'swakelola' => 'Swakelola (Honor, Transport, Perjalanan Dinas)',
        'penyedia' => 'Penyedia (Barang/Jasa)',
    ];

    /**
     * Kelengkapan SPJ Lengkap|Belum Lengkap|Tidak Ada|Tidak Diperlukan.
     *
     * @var array
     */
    public static $kelengkapan = [
        'Lengkap' => 'Lengkap',
        'Belum Lengkap' => 'Belum Lengkap',
        'Tidak Ada' => 'Tidak Ada',
        'Tidak Diperlukan' => 'Tidak Diperlukan',
    ];

    /**
     * Cara Pembayaran LS|UP.
     *
     * @var array
     */
    public static $carabayar = [
        'LS' => 'LS',
        'UP' => 'UP',
    ];

    /**
     * Scan SPJ Sudah|Belum.
     *
     * @var array
     */
    public static $scan = [
        'Sudah' => 'Sudah',
        'Belum' => 'Belum',
    ];

    /**
     * Jenis Pemeliharaan Kendaraan BBM|Servis|STNK.
     *
     * @var array
     */
    public static $jenis_pemeliharaan = [
        'BBM' => 'BBM',
        'Servis' => 'Servis',
        'STNK' => 'STNK',
    ];

    /**
     * Jenis Pemeliharaan Kendaraan BBM|Servis|STNK.
     *
     * @var array
     */
    public static $jenis_surat = [
        'Surat Biasa' => 'Surat Biasa',
        'Surat Tugas' => 'Surat Tugas',
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
     * Mengubah angka ke rupiah.
     *
     * @param  int|float  $angka
     * @return string
     */
    public static function formatRupiah($angka)
    {
        $hasil = 'Rp.'.number_format($angka, 0, ',', '.');

        return $hasil;
    }

    /**
     * Membuat Nomor Dokumen Pengadaan.
     *
     * @param  Date  $tanggal
     * @param  string  $kode  Kode Pengadaan
     * @param  string  $surat  pbj|sp|bast
     * @return string
     */
    public static function nomorPengadaan($tanggal, $kode, $surat = 'pbj')
    {
        $tanggal = $tanggal->format('Y-m-d');
        $split = explode('-', $tanggal);
        switch ($surat) {
            case 'sp':
                return '001/PBJ/'.$kode.'/'.$split[1].'/'.$split[0];
                break;
            case 'bast':
                    return '002/PPK/'.$kode.'/'.$split[1].'/'.$split[0];
                    break;
            default:
                return '001/PPK/'.$kode.'/'.$split[1].'/'.$split[0];
                break;
        }
    }

    /**
     * Menghitung jumlah nilai spesifikasi.
     *
     * @param  array  $spesifikasi
     * @return float
     */
    public static function sumSpek($spesifikasi)
    {
        // $speks= json_decode($spesifikasi,true);
        $spek = collect($spesifikasi);

        return $spek->sum('spek_nilai');
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
            $item['spek_satuan'] = self::formatRupiah($item['spek_satuan']);
            $item['spek_nilai'] = self::formatRupiah($item['spek_nilai']);

            return $item;
        })->toArray();

        return $spek;
    }

    /**
     * Generate biaya SPPD.
     *
     * @param  array  $spesifikasi
     * @param  string  total | jlh_dpr | dpr |real
     * @return mixed
     */
    public static function biayaSpd($spesifikasi, $jenis = 'total')
    {
        // $speks= json_decode($spesifikasi,true);
        $coll = collect($spesifikasi);
        $biaya_total = $coll->sum('spek_nilai');
        $real = $coll->filter(function ($value) {
            if ($value['spek_spek'] == 'Tidak') {
                return true;
            }
        })->values();
        $dpr = $coll->filter(function ($value) {
            if ($value['spek_spek'] == 'Ya') {
                return true;
            }
        })->values();
        $jlh_dpr = $dpr->sum('spek_nilai');
        $real->push(['spek_rincian' =>'Pengeluaran Riil', 'spek_nilai'=>$jlh_dpr, 'spek_satuan'=>' ', 'spek_vol'=>'1', 'spek_sat'=>'']);
        $real = $real->transform(function ($item, $index) {
            $item['spek_no'] = $index + 1;
            $item['spek_satuan'] = ($item['spek_satuan'] === ' ') ? ' ' : Helper::formatRupiah($item['spek_satuan']);
            $item['spek_nilai'] = Helper::formatRupiah($item['spek_nilai']);

            return $item;
        })->toArray();
        $dpr = $dpr->transform(function ($item, $index) {
            $item['spek_no'] = $index + 1;
            $item['spek_satuan'] = Helper::formatRupiah($item['spek_satuan']);
            $item['spek_nilai'] = Helper::formatRupiah($item['spek_nilai']);

            return $item;
        })->toArray();

        switch ($jenis) {
            case 'jlh_dpr':
                return $jlh_dpr;
                break;
            case 'dpr':
                return $dpr;
                break;
            case 'real':
                return $real;
                break;
            default:
                return $biaya_total;
                break;
        }
    }

    /**
     * Generate jangka waktu.
     *
     * @param  DateTime  $awal
     * @param  DateTime  $akhir
     * @return string
     */
    public static function jangkaWaktu($awal, $akhir)
    {
        $selisih = ($awal->diff($akhir))->format('%a') + 1;

        return $selisih.' ( '.Helper::terbilang($selisih).') Hari';
    }

    /**
     * Simpan spesifikasi.
     *
     * @param  array  $spesifikasi
     * @return array
     */
    public static function simpanSpek($spesifikasi)
    {
        // $speks= json_decode($spesifikasi,true);
        $spek = collect($spesifikasi);
        $spek->transform(function ($item, $index) {
            $item['spek_nilai'] = $item['spek_vol'] * $item['spek_satuan'];

            return $item;
        })->toArray();

        return $spek;
    }
}
