<?php

namespace App\Helpers;

use App\Models\DaftarHonorMitra;
use App\Models\DaftarHonorPegawai;
use App\Models\DaftarKegiatan;
use App\Models\DataPegawai;
use App\Models\DerajatNaskah;
use App\Models\Dipa;
use App\Models\HargaSatuan;
use App\Models\HonorKegiatan;
use App\Models\JenisKontrak;
use App\Models\JenisNaskah;
use App\Models\KamusAnggaran;
use App\Models\KepkaMitra;
use App\Models\KerangkaAcuan;
use App\Models\KodeArsip;
use App\Models\KodeBank;
use App\Models\KodeNaskah;
use App\Models\MasterPersediaan;
use App\Models\MasterWilayah;
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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use OpenSpout\Reader\XLSX\Reader;

use function Illuminate\Filesystem\join_paths;

class Helper
{
    public static $jenis_belanja = [
        '51' => 'Belanja Pegawai (51)',
        '52' => 'Belanja Barang dan Jasa (52)',
        '53' => 'Belanja Modal (53)',
        '54' => 'Belanja Bunga Utang (54)',
        '55' => 'Belanja Subsidi (55)',
        '56' => 'Belanja Hibah (56)',
        '57' => 'Belanja Bantuan Sosial (57)',
        '58' => 'Belanja Lainnya (58)',
    ];

    public static $jenis_angkutan = [
        'Angkutan Umum' => 'Angkutan Umum',
        'Kendaraan Dinas' => 'Kendaraan Dinas',
        'Lainnya' => 'Lainnya',
    ];

    public static $akun_perjalanan = [
        '524111',
        '524113',
        '524114',
        '524119'];

    public static $jenis_kegiatan = [
        'Libur' => 'Libur',
        'Deadline' => 'Deadline',
        'Kegiatan' => 'Kegiatan',
    ];

    public static $waktu_reminder = [
        'HK' => 'Hari Kerja Sebelum Deadline',
        'H' => 'Hari Kalender Sebelum Deadline',
    ];

    public static $translok_type = [
        '1' => 'Kabupaten - Kecamatan',
        '2' => 'Kabupaten - Desa',
        '3' => 'Kecamatan - Desa',
    ];

    public static $jam = [
        '08:00:00' => '08:00',
        '09:00:00' => '09:00',
        '10:00:00' => '10:00',
        '11:00:00' => '11:00',
        '12:00:00' => '12:00',
        '13:00:00' => '13:00',
        '14:00:00' => '14:00',
        '15:00:00' => '15:00',
        '16:00:00' => '16:00',
        '17:00:00' => '17:00',
        '18:00:00' => '18:00',
        '19:00:00' => '19:00',
        '20:00:00' => '20:00',
        '21:00:00' => '21:00',
        '22:00:00' => '22:00',
        '23:00:00' => '23:00',
        '00:00:00' => '00:00',
        '01:00:00' => '01:00',
        '02:00:00' => '02:00',
        '03:00:00' => '03:00',
        '04:00:00' => '04:00',
        '05:00:00' => '05:00',
        '06:00:00' => '06:00',
        '07:00:00' => '07:00',
    ];

    public static $jenis_perjalanan = [
        '1' => 'Perjalanan Dinas Biasa',
        '2' => 'Translok Pendataan',
        '3' => 'Translok Role Playing',
        '4' => 'Translok Pelatihan',
        '5' => 'Paket Meeting Halfday',
        '6' => 'Paket Meeting Fullday',
        '7' => 'Paket Meeting Fullboard Dalam Kota',
        '8' => 'Paket Meeting Fullboard Luar Kota',
    ];

    public static $akun_persediaan = [
        '521811',
        '521813',
        '523112',
        '523123',
        '523125',
        '521832',
        '521831',
    ];

    public static $akun_pemeliharaan = [
        '523111',
        '523121',
    ];

    public static $template = [
        'bastp' => 'Pernyataan Penerimaan Persediaan',
        'bon' => 'Bon Persediaan',
        'bast' => 'BAST Mitra',
        'kontrak' => 'Kontrak Mitra',
        'import' => 'Import',
        'kak' => 'Kerangka Acuan',
        'spj' => 'SPJ Honor Mitra',
        'sk' => 'Surat Keputusan Petugas',
        'st' => 'Surat Tugas',
        'karken_persediaan' => 'Kartu Kendali Persediaan',
        'karken_pemeliharaan' => 'Kartu Kendali Pemeliharaan',
        'kuitansi' => 'Kuitansi Perjalanan Dinas',
        'pernyataan_kendaraan' => 'Pernyataan Tidak Menggunakan Kendaraan Dinas',
        'kertas_kerja_reward' => 'Kertas Kerja Employee Of The Month',
        'sertifikat_reward' => 'Sertifikat Employee Of The Month',
        'sk_reward' => 'Surat Keputusan Employee Of The Month',
        'sppd' => 'Surat Tugas dan SPPD',
        'undangan' => 'Undangan',
        'daftar_hadir' => 'Daftar Hadir',
        'notula' => 'Notula',
    ];

    public static $jenis_honor = [
        'Kontrak Mitra Bulanan' => 'Kontrak Mitra Bulanan',
        'Kontrak Mitra AdHoc' => 'Kontrak Mitra AdHoc',
        'Honor Pegawai' => 'Honor Pegawai',
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
        'admin' => 'Administrator',
        'kepala' => 'Kepala',
        'kpa' => 'Kuasa Pengguna Anggaran',
        'kasubbag' => 'Kasubbag Umum',
        'koordinator' => 'Ketua Tim',
        'ppspm' => 'Pejabat PSPM',
        'ppk' => 'Pejabat Pembuat Komitmen',
        'bendahara' => 'Bendahara',
        'pbj' => 'Pejabat PBJ',
        'bmn' => 'Pengelola BMN dan Persediaan',
        'arsiparis' => 'Arsiparis',
        'anggota' => 'Pegawai',
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
     * Get the last sheet name from an Excel file.
     *
     * @param  string  $file  The path to the Excel file.
     * @return string  The name of the last sheet.
     */
    public static function getLastSheetName($file)
    {
        $reader = new Reader;
        $reader->open($file);
        foreach ($reader->getSheetIterator() as $sheet) {
            $name = $sheet->getName();
        }
        $reader->close();

        return $name;
    }

    /**
     * Format a phone number for WhatsApp.
     *
     * @param  string  $telepon  The phone number to format.
     * @return string  The formatted phone number.
     */
    public static function formatTelepon($telepon)
    {
        $wa = str_replace('+62 08', '628', $telepon);
        $wa = str_replace('+62 ', '62', $wa);
        $wa = str_replace('-', '', $wa);

        return "https://wa.me/{$wa}";
    }

    /**
     * Check if the current date is within a specific triwulan (quarter).
     *
     * @param  int  $tw  The triwulan number (1-4).
     * @return bool  True if the current date is within the specified triwulan, false otherwise.
     */
    public static function is_triwulan($tw)
    {
        $now = Carbon::now();
        switch ($tw) {
            case 1:
                return $now->between(Carbon::create($now->year, 3, 1), Carbon::create($now->year, 4, 10));
            case 2:
                return $now->between(Carbon::create($now->year, 6, 1), Carbon::create($now->year, 7, 10));
            case 3:
                return $now->between(Carbon::create($now->year, 9, 1), Carbon::create($now->year, 10, 10));
            case 4:
                return $now->between(Carbon::create($now->year, 12, 1), Carbon::create($now->year, 1, 10)->addYear());
            default:
                return false;
        }
    }

    /**
     * Check if the current date is within a specific cumulative triwulan (quarter).
     *
     * @param  int  $tw  The cumulative triwulan number (1-4).
     * @return bool  True if the current date is within the specified cumulative triwulan, false otherwise.
     */
    public static function is_triwulan_kumulatif($tw)
    {
        $now = Carbon::now();
        switch ($tw) {
            case 1:
                return $now->between(Carbon::create($now->year, 3, 1), Carbon::create($now->year, 4, 10));
            case 2:
                return $now->between(Carbon::create($now->year, 3, 1), Carbon::create($now->year, 7, 10));
            case 3:
                return $now->between(Carbon::create($now->year, 3, 1), Carbon::create($now->year, 10, 10));
            case 4:
                return $now->between(Carbon::create($now->year, 3, 1), Carbon::create($now->year, 1, 10)->addYear());
            default:
                return false;
        }
    }

    /**
     * Get the current triwulan (quarter) based on the given month.
     *
     * @param  int  $month  The month number (1-12).
     * @return int  The triwulan number (1-4).
     */
    public static function getTriwulanBerjalan($month)
    {
        return (int) ceil($month / 3);
    }

    /**
     * Convert a date to the name of the day.
     *
     * @param  Date  $tanggal  The date to convert.
     * @return string  The name of the day.
     */
    public static function terbilangHari($tanggal)
    {
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $num = (int) $tanggal->format('N');

        return $hari[$num - 1];
    }

    /**
     * Convert a month number to the name of the month.
     *
     * @param  int  $bulan  The month number (1-12).
     * @return string  The name of the month.
     */
    public static function terbilangBulan($bulan)
    {
        return self::$bulan[$bulan];
    }

    /**
     * Format a number as Indonesian Rupiah.
     *
     * @param  int|float  $angka  The number to format.
     * @return string  The formatted Rupiah value.
     */
    public static function formatRupiah($angka)
    {
        return 'Rp.'.self::formatUang($angka);
    }

    /**
     * Check the stock of a specific item in the inventory.
     *
     * @param  int  $id  The ID of the item.
     * @param  string|null  $tanggal  The date to check the stock (optional).
     * @return int  The stock quantity.
     */
    public static function cekStokPersediaan($id, $tanggal = null)
    {
        $stok = DB::table('barang_persediaans')
            ->selectRaw(
                'SUM(CASE WHEN tanggal_transaksi IS NOT NULL AND (barang_persediaanable_type = "App\\\Models\\\PembelianPersediaan" OR  barang_persediaanable_type = "App\\\Models\\\PersediaanMasuk") THEN volume ELSE 0 END) -  SUM(CASE WHEN barang_persediaanable_type = "App\\\Models\\\PermintaanPersediaan" OR  barang_persediaanable_type = "App\\\Models\\\PersediaanKeluar"THEN volume ELSE 0 END) as stok'
            )
            ->where('master_persediaan_id', $id)
            ->when($tanggal, function ($query, $tanggal) {
                return $query->whereDate('tanggal_transaksi', '<=', $tanggal);
            })
            ->groupBy('master_persediaan_id')
            ->first();

        return $stok ? $stok->stok : 0;
    }

    /**
     * Convert a name to uppercase without titles.
     *
     * @param  string  $nama  The name to convert.
     * @return string  The name in uppercase without titles.
     */
    public static function upperNamaTanpaGelar($nama)
    {
        return strtoupper(self::namaTanpaGelar($nama));
    }

    /**
     * Remove titles from a name.
     *
     * @param  string  $nama  The name to process.
     * @return string  The name without titles.
     */
    public static function namaTanpaGelar($nama)
    {
        return explode(',', $nama)[0];
    }

    /**
     * Format a number as currency.
     *
     * @param  int|float  $angka  The number to format.
     * @return string  The formatted currency value.
     */
    public static function formatUang($angka)
    {
        return number_format($angka, 0, ',', '.');
    }

    /**
     * Mask a NIK (National Identification Number) with asterisks.
     *
     * @param  string  $nik  The NIK to mask.
     * @return string  The masked NIK.
     */
    public static function asterikNik($nik)
    {
        return substr($nik, 0, 4).str_repeat('*', 10).substr($nik, 14);
    }

    /**
     * Generate a time period in calendar days.
     *
     * @param  DateTime  $awal  The start date.
     * @param  DateTime  $akhir  The end date.
     * @return string  The time period in calendar days.
     */
    public static function jangkaWaktuHariKalender($awal, $akhir)
    {
        return self::jangkaWaktu($awal, $akhir).' Kalender';
    }

    /**
     * Generate a time period in days.
     *
     * @param  DateTime  $awal  The start date.
     * @param  DateTime  $akhir  The end date.
     * @return string  The time period in days.
     */
    public static function jangkaWaktu($awal, $akhir)
    {
        $selisih = $awal->diff($akhir)->format('%a') + 1;

        return $selisih.' ( '.self::terbilang($selisih).') Hari';
    }

    /**
     * Convert a number to words.
     *
     * @param  int|float  $x  The number to convert.
     * @return string  The number in words.
     */
    private static function kata($x)
    {
        $x = abs($x);

        return Number::spell($x, 'id');
    }

    /**
     * Remove the period at the end of a sentence.
     *
     * @param  string  $kalimat  The sentence to process.
     * @return string  The sentence without the period at the end.
     */
    public static function hapusTitikAkhirKalimat($kalimat)
    {
        return rtrim($kalimat, '.');
    }

    /**
     * Convert a number to words with optional style and suffix.
     *
     * @param  int|float  $x  The number to convert.
     * @param  string  $style  The style of the words (up=Upper, uw=ucwords, uf=ucfirst).
     * @param  string  $suffix  The suffix to add to the words.
     * @return string  The number in words with the specified style and suffix.
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
     * Get the date before a specific deadline.
     *
     * @param  string  $tanggal_deadline  The deadline date.
     * @param  int  $jumlah_hari  The number of days before the deadline.
     * @param  string  $ref  The reference type (HK=Hari Kerja, H=Hari Kalender).
     * @return string  The date before the deadline.
     */
    public static function getTanggalSebelum($tanggal_deadline, $jumlah_hari, $ref = 'h')
    {
        $tanggal_deadline = Carbon::parse($tanggal_deadline);
        if ($ref === 'HK') {
            $hariLibur = DaftarKegiatan::where('jenis', 'Libur')->pluck('awal')->toArray();
            $hariLibur = array_map(function ($date) {
                return Carbon::parse($date)->format('Y-m-d');
            }, $hariLibur);

            $count = 0;
            while ($count < $jumlah_hari) {
                $tanggal_deadline->subDay();
                if ($tanggal_deadline->isWeekend() || in_array($tanggal_deadline->format('Y-m-d'), $hariLibur)) {
                    continue;
                }
                $count++;
            }
        } else {
            $tanggal_deadline->subDay($jumlah_hari);
        }

        return $tanggal_deadline->format('Y-m-d');
    }

    /**
     * Convert a date to words.
     *
     * @param  Date  $tanggal  The date to convert.
     * @param  string  $format  The format of the words (s=short, l=long).
     * @return string  The date in words.
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
     * Get the year from a date.
     *
     * @param  \Illuminate\Support\Carbon  $tanggal  The date to process.
     * @return int  The year.
     */
    public static function getYearFromDate($tanggal)
    {
        return $tanggal->format('Y');
    }

    /**
     * Get the month from a date.
     *
     * @param  \Illuminate\Support\Carbon  $tanggal  The date to process.
     * @return int  The month.
     */
    public static function getMonthFromDate($tanggal)
    {
        return $tanggal->format('m');
    }

    /**
     * Format a time value.
     *
     * @param  string  $jam  The time value to format.
     * @return string  The formatted time value.
     */
    public static function formatJam($jam)
    {
        return date('H:i', strtotime($jam));
    }

    /**
     * Format a list of names.
     *
     * @param  array  $nama  The list of names to format.
     * @return array  The formatted list of names.
     */
    public static function formatDaftarNama($nama)
    {
        $daftar = [];
        $index = 1;

        for ($i = 0; $i < count($nama); $i += 2) {
            $nama1 = self::getPegawaiByUserId($nama[$i]['peserta_user_id'])->name;
            $unit_kerja1 = 'BPS '.config('satker.kabupaten');
            $nama2 = isset($nama[$i + 1]) ? self::getPegawaiByUserId($nama[$i + 1]['peserta_user_id'])->name : '';
            $unit_kerja2 = isset($nama[$i + 1]) ? 'BPS '.config('satker.kabupaten') : '';

            $daftar[] = [
                'no' => $index,
                'nama1' => $nama1,
                'unit_kerja1' => $unit_kerja1,
                'nama2' => $nama2,
                'unit_kerja2' => $unit_kerja2,
            ];

            $index++;
        }

        return $daftar;
    }

    /**
     * Convert an index to an alphabetic representation.
     *
     * @param  int  $index  The index to convert.
     * @return string  The alphabetic representation of the index.
     */
    public static function convertIndexToAlphabet($index)
    {
        $alphabet = '';
        while ($index > 0) {
            $index--; // Adjust index to be 0-based
            $alphabet = chr(65 + ($index % 26)).$alphabet;
            $index = intval($index / 26);
        }

        return $alphabet;
    }

    /**
     * Get the year from a date string.
     *
     * @param  string  $tanggal  The date string in 'Y-m-d' format.
     * @return int  The year.
     */
    public static function getYearFromDateString($tanggal)
    {
        return Carbon::createFromFormat('Y-m-d', $tanggal)->year;
    }

    /**
     * Create a date from a given string.
     *
     * @param  string  $tanggal  The date string in 'Y-m-d' format.
     * @return string|null  The date in 'Y-m-d H:i:s' format or null if the date is empty.
     */
    public static function createDateFromString($tanggal)
    {
        if (empty($tanggal)) {
            return null;
        }

        return Carbon::createFromFormat('Y-m-d', $tanggal)->endOfDay();
    }

    /**
     * Parse a filter value from a URL.
     *
     * @param  string  $url  The URL to parse.
     * @param  string  $filterUri  The filter URI to search for in the query.
     * @param  string  $filterKey  The filter key to retrieve the value for.
     * @param  string|null  $defaultValue  The default value to return if the filter is not found.
     * @return string  The filter value.
     */
    public static function parseFilterFromUrl($url, $filterUri, $filterKey, $defaultValue = null)
    {
        $filterValue = $defaultValue ?? '';
        $parsed_url = null;
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
     * Parse a filter value from a base64-encoded filter string.
     *
     * @param  string  $filter  The base64-encoded filter string.
     * @param  string  $filterKey  The filter key to retrieve the value for.
     * @param  string|null  $defaultValue  The default value to return if the filter is not found.
     * @return string  The filter value.
     */
    public static function parseFilter($filter, $filterKey, $defaultValue = null)
    {
        $filterValue = $defaultValue ?? '';
        $filters = array_merge(
            ...json_decode(
                base64_decode($filter, true),
                true
            ));

        $filterValue = $filters[$filterKey];

        return $filterValue;
    }

    /**
     * Check for duplicate values in a JSON array.
     *
     * @param  json  $json  The JSON array to check.
     * @param  string  $key  The key to check for duplicates.
     * @return bool  True if duplicates are found, false otherwise.
     */
    public static function cekGanda($json, $key)
    {
        $spek = collect($json);
        $cek = $spek->duplicates($key);

        return $cek->isNotEmpty();
    }

    /**
     * Generate a document number.
     *
     * @param  date  $tanggal  The date of the document.
     * @param  string  $jenis_naskah_id  The ID of the document type.
     * @param  string|null  $unit_kerja_id  The ID of the work unit (optional).
     * @param  string|null  $kode_arsip_id  The ID of the archive code (optional).
     * @param  string|null  $derajat_naskah_id  The ID of the document degree (optional).
     * @return array  The generated document number, order number, segment, and archive code ID.
     */
    public static function nomor($tanggal, $jenis_naskah_id, $unit_kerja_id = null, $kode_arsip_id = null, $derajat_naskah_id = null)
    {
        $replaces = [];
        $tahun = self::getYearFromDate($tanggal);
        $bulan = self::getMonthFromDate($tanggal);
        $replaces['<tahun>'] = $tahun;
        $replaces['<bulan>'] = $bulan;

        $jenis_naskah = JenisNaskah::cache()->get('all')->where('id', $jenis_naskah_id)->first();
        $kode_naskah_id = optional($jenis_naskah)->kode_naskah_id;
        $kode_naskah = KodeNaskah::cache()->get('all')->where('id', $kode_naskah_id)->first();

        if ($unit_kerja_id !== null) {
            $unit_kerja = UnitKerja::cache()->get('all')->where('id', $unit_kerja_id)->first();
            $replaces['<kode_unit_kerja>'] = optional($unit_kerja)->kode;
        }

        if ($kode_arsip_id !== null) {
            $kode_arsip = KodeArsip::cache()->get('all')->where('id', $kode_arsip_id)->first();
            $replaces['<kode_arsip>'] = optional($kode_arsip)->kode;
        }

        if ($derajat_naskah_id !== null) {
            $derajat_naskah = DerajatNaskah::cache()->get('all')->where('id', $derajat_naskah_id)->first();
            $replaces['<derajat>'] = optional($derajat_naskah)->kode;
        }

        $naskah = NaskahKeluar::whereYear('tanggal', $tahun)->where('kode_naskah_id', optional($kode_naskah)->id);
        $max_no_urut = $naskah->max('no_urut') ?? 0;
        $max_tanggal = $naskah->max('tanggal') ?? '1970-01-01';

        if ($tanggal >= $max_tanggal) {
            $no_urut = $max_no_urut + 1;
            $segmen = 0;
        } else {
            $no_urut = $naskah->whereDate('tanggal', '<=', $tanggal)->max('no_urut') ?? 1;
            $segmen = NaskahKeluar::whereYear('tanggal', $tahun)
                ->where('kode_naskah_id', optional($kode_naskah)->id)
                ->where('no_urut', $no_urut)
                ->max('segmen') + 1;
        }

        $replaces['<no_urut>'] = ($segmen > 0) ? "{$no_urut}.{$segmen}" : $no_urut;
        $format = optional($kode_naskah)->format;
        $nomor = strtr($format, $replaces);

        return [
            'nomor' => $nomor,
            'no_urut' => $no_urut,
            'segmen' => $segmen,
            'kode_naskah_id' => optional($kode_naskah)->id,
        ];
    }

    /**
     * Get users with a specific role based on active/inactive dates.
     *
     * @param  string  $role  The role of the users (admin/koordinator).
     * @param  date  $tanggal  The date to check for active/inactive status.
     * @return Collection  The collection of users.
     */
    public static function getUsersByPengelola($role, $tanggal)
    {
        $usersIdByPengelola = Pengelola::cache()
            ->get('all')
            ->where('role', $role)
            ->where('active', '<', $tanggal)
            ->reject(function ($item) use ($tanggal) {
                return $item['inactive'] && $item['inactive'] < $tanggal;
            })
            ->pluck('user_id')
            ->toArray();
        $usersId = $usersIdByPengelola;
        if ($role === 'koordinator') {
            $usersIdByUnitKerja = DataPegawai::cache()
                ->get('all')
                ->where('unit_kerja_id', optional(self::getDataPegawaiByUserId(Auth::user()->id, $tanggal))->unit_kerja_id)
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
     * Set the default manager for a specific role based on the date.
     *
     * @param  string  $role  The role of the manager.
     * @param  date  $tanggal  The date to check for active/inactive status.
     * @return int|null  The ID of the default manager or null if not found.
     */
    public static function setDefaultPengelola($role, $tanggal)
    {
        $pengelola = self::getUsersByPengelola($role, $tanggal);

        return $pengelola->count() == 1 ? $pengelola->first()->id : null;
    }

    /**
     * Set the default participants for a meeting based on the purpose and date.
     *
     * @param  string  $tujuan  The purpose of the meeting.
     * @param  date  $tanggal  The date of the meeting.
     * @return array  The list of default participants.
     */
    public static function setDefaultPesertaRapat($tujuan, $tanggal)
    {
        Str::contains(Str::lower($tujuan), ['ketua', 'penanggung', 'penanggungjawab']) ? $role = 'koordinator' : $role = 'anggota';
        $usersId = Pengelola::cache()
            ->get('all')
            ->where('role', $role)
            ->where('active', '<', $tanggal)
            ->reject(function ($item) use ($tanggal) {
                return $item['inactive'] && $item['inactive'] < $tanggal;
            })
            ->pluck('user_id')
            ->toArray();
        $user = User::cache()->get('all')->whereIn('id', $usersId)->pluck('id')->map(function ($id) {
            return [
                'peserta_user_id' => $id,
            ];
        });

        return $user;
    }

    /**
     * Get employee data based on user ID and date.
     *
     * @param  int  $user_id  The user ID.
     * @param  \Illuminate\Support\Carbon  $tanggal  The date to check for active/inactive status.
     * @return \App\Models\DataPegawai|null  The employee data or null if not found.
     */
    public static function getDataPegawaiByUserId($user_id, $tanggal)
    {
        return DataPegawai::cache()->get('all')->where('user_id', $user_id)->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first();
    }

    /**
     * Get employee data based on user ID.
     *
     * @param  int  $user_id  The user ID.
     * @return \App\Models\User|null  The employee data or null if not found.
     */
    public static function getPegawaiByUserId($user_id)
    {
        return User::cache()->get('all')->where('id', $user_id)->first();
    }

    /**
     * Get mitra data based on ID.
     *
     * @param  int  $id  The mitra ID.
     * @return \App\Models\Mitra|null  The mitra data or null if not found.
     */
    public static function getMitraById($id)
    {
        return Mitra::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Get bank code data based on ID.
     *
     * @param  int  $id  The bank code ID.
     * @return \App\Models\KodeBank|null  The bank code data or null if not found.
     */
    public static function getKodeBankById($id)
    {
        return KodeBank::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Get master inventory data based on ID.
     *
     * @param  int  $id  The master inventory ID.
     * @return \App\Models\MasterPersediaan|null  The master inventory data or null if not found.
     */
    public static function getMasterPersediaanById($id)
    {
        return MasterPersediaan::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Get contract type data based on ID.
     *
     * @param  int  $id  The contract type ID.
     * @return \App\Models\JenisKontrak|null  The contract type data or null if not found.
     */
    public static function getJenisKontrakById($id)
    {
        return JenisKontrak::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Get budget data based on ID.
     *
     * @param  int  $id  The budget ID.
     * @return \App\Models\MataAnggaran|null  The budget data or null if not found.
     */
    public static function getMataAnggaranById($id)
    {
        return MataAnggaran::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Get master region data based on ID.
     *
     * @param  int  $id  The master region ID.
     * @return \App\Models\MasterWilayah|null  The master region data or null if not found.
     */
    public static function getMasterWilayahById($id)
    {
        return MasterWilayah::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Get master region data based on code.
     *
     * @param  string  $kode  The master region code.
     * @return \App\Models\MasterWilayah|null  The master region data or null if not found.
     */
    public static function getMasterWilayahByKode($kode)
    {
        return MasterWilayah::cache()->get('all')->where('kode', $kode)->first();
    }

    /**
     * Check if the budget contains honor account output activities.
     *
     * @param  json  $spek  The budget specification.
     * @return bool  True if the budget contains honor account output activities, false otherwise.
     */
    public static function isAkunHonor($mata_anggaran_id): bool
    {
        $mak = MataAnggaran::cache()->get('all')->where('id', $mata_anggaran_id)->first()->mak;

        return $mak == in_array(substr($mak, -6), self::$akun_honor);
    }

    /**
     * Check if the honor account has changed from $mak_old to $mak_new.
     *
     * @param  string  $mak_old  The old honor account.
     * @param  string  $mak_new  The new honor account.
     * @return bool  True if the honor account has changed, false otherwise.
     */
    public static function isAkunHonorChanged($mak_old, $mak_new)
    {
        return (self::isAkunHonor($mak_old) && ! self::isAkunHonor($mak_new)) || (self::isAkunHonor($mak_old) && self::isAkunHonor($mak_new) && $mak_old != $mak_new);
    }

    /**
     * Check if the account code is an inventory account.
     *
     * @param  string  $mata_anggaran_id  The budget ID.
     * @return bool  True if the account code is an inventory account, false otherwise.
     */
    public static function isAkunPersediaan(string $mata_anggaran_id): bool
    {
        $mak = MataAnggaran::cache()->get('all')->where('id', $mata_anggaran_id)->first()->mak;

        return $mak == in_array(substr($mak, -6), self::$akun_persediaan);
    }

    /**
     * Check if the account code is a maintenance account.
     *
     * @param  string  $mata_anggaran_id  The budget ID.
     * @return bool  True if the account code is a maintenance account, false otherwise.
     */
    public static function isAkunPemeliharaan(string $mata_anggaran_id): bool
    {
        $mak = MataAnggaran::cache()->get('all')->where('id', $mata_anggaran_id)->first()->mak;

        return $mak == in_array(substr($mak, -6), self::$akun_pemeliharaan);
    }

    /**
     * Check if the inventory account has changed.
     *
     * @param  string  $mak_old  The old inventory account.
     * @param  string  $mak_new  The new inventory account.
     * @return bool  True if the inventory account has changed, false otherwise.
     */
    public static function isAkunPersediaanChanged($mak_old, $mak_new)
    {
        return (self::isAkunPersediaan($mak_old) && ! self::isAkunPersediaan($mak_new)) || (self::isAkunPersediaan($mak_old) && self::isAkunPersediaan($mak_new) && $mak_old != $mak_new);
    }

    /**
     * Check if the maintenance account has changed.
     *
     * @param  string  $mak_old  The old maintenance account.
     * @param  string  $mak_new  The new maintenance account.
     * @return bool  True if the maintenance account has changed, false otherwise.
     */
    public static function isAkunPemeliharaanChanged($mak_old, $mak_new)
    {
        return (self::isAkunPemeliharaan($mak_old) && ! self::isAkunPemeliharaan($mak_new)) || (self::isAkunPemeliharaan($mak_old) && self::isAkunPemeliharaan($mak_new) && $mak_old != $mak_new);
    }

    /**
     * Get the account details based on the desired level.
     *
     * @param  string  $mak  The account code.
     * @param  string  $level  The desired level (default: 'akun', options: program, kegiatan, kro, ro, komponen, sub, akun).
     * @param  bool  $kode_prefix  Whether to include the code prefix (default: true).
     * @return string  The account details.
     */
    public static function getDetailAnggaran($mak, $level = 'akun', $tahun = null, bool $kode_prefix = true)
    {
        $tahun = $tahun ?? session('year') ?? date('Y');
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
        $kamus = KamusAnggaran::cache()->get($level)
            ->where('dipa_id', Dipa::cache()->get('all')->where('tahun', $tahun)->first()->id)
            ->where('mak', substr($mak, 0, $length[$level]))
            ->first();
        $detail = $kamus == null ? 'edit manual karena belum ada di POK' : $kamus->detail;

        return $kode_prefix ? $kode[$level].$detail : $detail;
    }

    /**
     * Format the specification for display.
     *
     * @param  array  $spesifikasi  The specification to format.
     * @return array  The formatted specification.
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
     * Format the travel expenses for display.
     *
     * @param  array  $item  The travel expenses to format.
     * @return array  The formatted travel expenses.
     */
    public static function formatBiayaSpd($item)
    {
        $speks = collect($item)
            ->transform(function ($item) {
                $item['nilai'] = self::formatRupiah($item['jumlah'] * $item['harga_satuan']);
                $item['harga_satuan'] = self::formatRupiah($item['harga_satuan']);

                return $item;
            });

        return $speks->toArray();
    }

    /**
     * Add the total travel expenses.
     *
     * @param  array  $item  The travel expenses to add.
     * @return \Illuminate\Support\Collection  The travel expenses with the total added.
     */
    public static function addTotalBiayaSpd($item)
    {
        $speks = collect($item)
            ->transform(function ($item) {
                $item['nilai'] = $item['jumlah'] * $item['harga_satuan'];

                return $item;
            });

        return $speks;
    }

    /**
     * Sum the values of a specific column in the specification.
     *
     * @param  array  $spesifikasi  The specification to sum.
     * @param  string  $column  The column to sum.
     * @return float  The sum of the values in the column.
     */
    public static function sumSpek($spesifikasi, $column)
    {
        $spek = collect($spesifikasi);

        return $spek->sum($column);
    }

    /**
     * Format the budget for display.
     *
     * @param  array  $anggaran  The budget to format.
     * @return array  The formatted budget.
     */
    public static function formatAnggaran($anggaran)
    {
        $spek = collect($anggaran);
        $spek->transform(function ($item, $index) {
            $item['mak'] = optional(self::getMataAnggaranById($item['mata_anggaran_id']))->mak."\r\n".optional(self::getMataAnggaranById($item['mata_anggaran_id']))->uraian;
            $item['anggaran_no'] = $index + 1;
            $item['perkiraan'] = self::formatRupiah($item['perkiraan']);

            return $item;
        });

        return $spek->toArray();
    }

    /**
     * Format the inventory items for display.
     *
     * @param  array  $bastp  The inventory items to format.
     * @return array  The formatted inventory items.
     */
    public static function formatBarangPersediaan($bastp)
    {
        $spek = collect($bastp);
        $spek->transform(function ($item, $index) {
            $item['no'] = $index + 1;
            $item['harga_satuan'] = self::formatRupiah($item['harga_satuan']);
            $item['total_harga'] = self::formatRupiah($item['total_harga']);
            $item['kode'] = optional(self::getMasterPersediaanById($item['master_persediaan_id']))->kode;

            return $item;
        });

        return $spek->toArray();
    }

    /**
     * Format the maintenance items for display.
     *
     * @param  \Illuminate\Support\Collection  $spek  The maintenance items to format.
     * @return array  The formatted maintenance items.
     */
    public static function formatDaftarPemeliharaan($spek)
    {
        $spek->transform(function ($item, $index) {
            $item['no'] = $index + 1;
            $item['biaya'] = self::formatRupiah($item['biaya']);
            $item['tanggal_pemeliharaan'] = self::terbilangTanggal($item['tanggal']);

            return $item;
        });

        $arrayspek = $spek->toArray();

        return empty($arrayspek) ? [['no' => 1, 'tanggal_pemeliharaan' => '-', 'uraian' => '-', 'penyedia' => '-', 'biaya' => '-']] : $arrayspek;
    }

    /**
     * Format the assessment items for display.
     *
     * @param  \Illuminate\Support\Collection  $spek  The assessment items to format.
     * @return array  The formatted assessment items.
     */
    public static function formatDaftarPenilaian($spek)
    {
        $spek->transform(function ($item, $index) {
            $pegawai = self::getPegawaiByUserId($item['user_id']);
            $item['no'] = $index + 1;
            $item['nama'] = $pegawai->name;
            $item['nip'] = $pegawai->nip;

            return $item;
        });

        return $spek->toArray();
    }

    /**
     * Format the inventory items for display.
     *
     * @param  int  $id  The ID of the inventory item.
     * @param  \Illuminate\Support\Collection  $spek  The inventory items to format.
     * @return array  The formatted inventory items.
     */
    public static function formatDaftarPersediaan($id, $spek)
    {
        $stok = self::cekStokPersediaan($id, (session('year') - 1).'-12-31');
        $spek->transform(function ($item, $index) use (&$stok) {
            $item['no'] = $index + 1;
            $item['tanggal_buku'] = self::terbilangTanggal($item['tanggal_transaksi']);
            $item['nomor_dokumen'] = match (get_class($item->barangPersediaanable)) {
                \App\Models\PembelianPersediaan::class => $item->barangPersediaanable->bastNaskahKeluar->nomor,
                \App\Models\PermintaanPersediaan::class => $item->barangPersediaanable->naskahKeluar->nomor,
                \App\Models\PersediaanMasuk::class => $item->barangPersediaanable->naskahMasuk->nomor,
                \App\Models\PersediaanKeluar::class => $item->barangPersediaanable->naskahKeluar->nomor,
            };
            $item['uraian'] = match (get_class($item->barangPersediaanable)) {
                \App\Models\PembelianPersediaan::class => $item->barangPersediaanable->rincian,
                \App\Models\PermintaanPersediaan::class => 'Permintaan Persediaan oleh '.$item->barangPersediaanable->user->name.' untuk '.$item->barangPersediaanable->kegiatan,
                \App\Models\PersediaanMasuk::class => $item->barangPersediaanable->rincian,
                \App\Models\PersediaanKeluar::class => $item->barangPersediaanable->rincian,
            };
            $item['masuk'] = match (get_class($item->barangPersediaanable)) {
                \App\Models\PembelianPersediaan::class, \App\Models\PersediaanMasuk::class => $item->volume,
                default => '-',
            };
            $item['keluar'] = match (get_class($item->barangPersediaanable)) {
                \App\Models\PermintaanPersediaan::class, \App\Models\PersediaanKeluar::class => $item->volume,
                default => '-',
            };
            $item['sisa'] = match (get_class($item->barangPersediaanable)) {
                \App\Models\PembelianPersediaan::class, \App\Models\PersediaanMasuk::class => $stok + $item['volume'],
                \App\Models\PermintaanPersediaan::class, \App\Models\PersediaanKeluar::class => $stok - $item['volume'],
            };
            $stok = $item['sisa'];
            unset($item->barangPersediaanable);

            return $item;
        });

        $arrayspek = $spek->toArray();

        return empty($arrayspek) ? [['no' => 1, 'nomor_dokumen' => '-', 'tanggal_buku' => '-', 'uraian' => '-', 'masuk' => '-', 'keluar' => '-', 'sisa' => $stok]] : $arrayspek;
    }

    /**
     * Format the mitra data for SPJ purposes.
     *
     * @param  \Illuminate\Support\Collection  $mitra  The mitra data to format.
     * @return \Illuminate\Support\Collection  The formatted mitra data.
     */
    public static function formatMitra($mitra)
    {
        $mitra->transform(function ($item, $index) {
            $mitra = self::getMitraById($item['mitra_id']);
            $item['nip'] = '-';
            $item['nama'] = optional($mitra)->nama;
            $item['nip_lama'] = optional($mitra)->nik;
            $item['rekening'] = optional($mitra)->rekening;
            $item['kode_bank_id'] = optional($mitra)->kode_bank_id;
            $item['golongan'] = '-';
            $item['jabatan'] = 'Mitra Statistik';
            $item['volume'] = $item['volume_realisasi'];
            $item['bruto'] = $item['volume_realisasi'] * $item['harga_satuan'];
            $item['pajak'] = round($item['volume_realisasi'] * $item['harga_satuan'] * $item['persen_pajak'] / 100, 0, PHP_ROUND_HALF_UP);
            $item['netto'] = $item['bruto'] - $item['pajak'];
            unset($item['mitra_id']);
            unset($item['id']);
            unset($item['created_at']);
            unset($item['updated_at']);
            unset($item['honor_kegiatan_id']);
            unset($item['volume_target']);
            unset($item['volume_realisasi']);
            unset($item['status_realisasi']);
            unset($item['daftar_kontrak_mitra_id']);

            return $item;
        });

        return $mitra;
    }

    /**
     * Create a query for the model based on the triwulan (quarter).
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model  The model to query.
     * @param  int  $triwulan  The triwulan number (1-4).
     * @return \Illuminate\Database\Eloquent\Builder  The query builder.
     */
    public static function modelQuery($model, $triwulan)
    {
        $bulan = match ($triwulan) {
            '1' => [1, 2, 3],
            '2' => [4, 5, 6],
            '3' => [7, 8, 9],
            '4' => [10, 11, 12],
        };

        return $model->select(
            'perjanjian_kinerjas.id',
            'perjanjian_kinerjas.indikator',
            DB::raw('ROUND(AVG(CASE WHEN realisasi_kinerjas.realisasi_tw'.$triwulan.' / realisasi_kinerjas.target_tw'.$triwulan.' * 100 > 120 THEN 120 ELSE realisasi_kinerjas.realisasi_tw'.$triwulan.' / realisasi_kinerjas.target_tw'.$triwulan.' * 100 END), 2) AS realisasi_triwulan'),
            DB::raw('ROUND(AVG(CASE WHEN realisasi_kinerjas.realisasi_tw'.$triwulan.' / realisasi_kinerjas.target_tw4 * 100 > 120 THEN 120 ELSE realisasi_kinerjas.realisasi_tw'.$triwulan.' / realisasi_kinerjas.target_tw4 * 100 END), 2) AS realisasi_tahun'),
            DB::raw('IF(COUNT(CASE WHEN realisasi_kinerjas.realisasi_tw'.$triwulan.' IS NULL THEN 1 END) > 0, 0, 1) AS jumlah_realisasi_tw'),
            DB::raw('COUNT(DISTINCT tindak_lanjuts.id) AS jumlah_tindak_lanjut'),
            DB::raw('COUNT(DISTINCT analisis_sakips.id) AS jumlah_analisis')
        )
            ->leftJoin('realisasi_kinerjas', function ($join) {
                $join->on('perjanjian_kinerjas.id', '=', 'realisasi_kinerjas.perjanjian_kinerja_id')
                    ->where('realisasi_kinerjas.is_indikator', true);
            })
            ->leftJoin('tindak_lanjuts', function ($join) use ($triwulan) {
                $join->on('realisasi_kinerjas.unit_kerja_id', '=', 'tindak_lanjuts.unit_kerja_id')
                    ->where('tindak_lanjuts.triwulan', $triwulan);
            })
            ->leftJoin('analisis_sakip_perjanjian_kinerja', 'perjanjian_kinerjas.id', '=', 'analisis_sakip_perjanjian_kinerja.perjanjian_kinerja_id')
            ->leftJoin('analisis_sakips', function ($join) use ($bulan) {
                $join->on('analisis_sakip_perjanjian_kinerja.analisis_sakip_id', '=', 'analisis_sakips.id')
                    ->whereIn('bulan', $bulan);
            })
            ->where('perjanjian_kinerjas.tahun', session('year'))
            ->groupBy('perjanjian_kinerjas.id', 'perjanjian_kinerjas.indikator');
    }

    /**
     * Format the employee data for display.
     *
     * @param  \Illuminate\Support\Collection  $pegawai  The employee data to format.
     * @param  string  $tanggal_spj  The date of the SPJ.
     * @return \Illuminate\Support\Collection  The formatted employee data.
     */
    public static function formatPegawai($pegawai, $tanggal_spj)
    {
        $pegawai->transform(function ($item, $index) use ($tanggal_spj) {
            $pegawai = self::getPegawaiByUserId($item['user_id']);
            $item['nama'] = optional($pegawai)->name;
            $item['nip'] = optional($pegawai)->nip;
            $item['nip_lama'] = optional($pegawai)->nip_lama;
            $item['jabatan'] = optional(self::getDataPegawaiByUserId($item['user_id'], $tanggal_spj))->jabatan;
            $item['rekening'] = optional($pegawai)->rekening;
            $item['kode_bank_id'] = optional($pegawai)->kode_bank_id;
            $item['golongan'] = optional(self::getDataPegawaiByUserId($item['user_id'], $tanggal_spj))->golongan;
            $item['bruto'] = $item['volume'] * $item['harga_satuan'];
            $item['pajak'] = round($item['volume'] * $item['harga_satuan'] * $item['persen_pajak'] / 100, 0, PHP_ROUND_HALF_UP);
            $item['netto'] = $item['bruto'] - $item['pajak'];
            unset($item['user_id']);
            unset($item['id']);
            unset($item['created_at']);
            unset($item['updated_at']);
            unset($item['honor_kegiatan_id']);

            return $item;
        });

        return $pegawai;
    }

    /**
     * Create a unified list of mitra and employee data for SPJ purposes.
     *
     * @param  int  $honor_kegiatan_id  The ID of the honor kegiatan.
     * @param  string  $tanggal  The date of the SPJ.
     * @return \Illuminate\Support\Collection  The unified list of mitra and employee data.
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
     * Create a list of mitra data for SPJ purposes.
     *
     * @param  int  $honor_kegiatan_id  The ID of the honor kegiatan.
     * @return \Illuminate\Support\Collection  The list of mitra data.
     */
    public static function makeBaseListMitra($honor_kegiatan_id)
    {
        $mitra = DaftarHonorMitra::where('honor_kegiatan_id', $honor_kegiatan_id)->get();
        $formattedMitra = self::formatMitra($mitra);

        return $formattedMitra;
    }

    /**
     * Create an array for SPJ purposes based on honor kegiatan ID and date.
     *
     * @param  int  $honor_kegiatan_id  The ID of the honor kegiatan.
     * @param  string  $tanggal  The date of the SPJ.
     * @return array  The array for SPJ purposes.
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
                $item['rekening'] = optional(self::getKodeBankById($item['kode_bank_id']))->nama_bank.' '.$item['rekening'];
                $item['netto'] = self::formatUang($item['netto']);
                $item['harga_satuan'] = self::formatUang($item['harga_satuan']);

                return $item;
            })
            ->toArray();
    }

    /**
     * Check for empty bank account numbers in the SPJ list.
     *
     * @param  int  $honor_kegiatan_id  The ID of the honor kegiatan.
     * @param  string  $tanggal  The date of the SPJ.
     * @return bool  True if there are empty bank account numbers, false otherwise.
     */
    public static function checkEmptyRekeningOnSpjMitraAndPegawai($honor_kegiatan_id, $tanggal): bool
    {
        $list = collect(self::makeSpjMitraAndPegawai($honor_kegiatan_id, $tanggal));

        return $list->contains(fn ($value) => $value['rekening'] == ' ');
    }

    /**
     * Create a list of mitra and employee data for Surat Tugas (ST) purposes.
     *
     * @param  int  $honor_kegiatan_id  The ID of the honor kegiatan.
     * @param  \Illuminate\Support\Carbon  $tanggal  The date of the ST.
     * @return array  The list of mitra and employee data for ST purposes.
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
     * Create a collection for export on a specific sheet.
     *
     * @param  int  $honor_kegiatan_id  The ID of the honor kegiatan.
     * @param  string  $tanggal  The date of the SPJ.
     * @param  int  $sheet_no  The sheet number (default: 1).
     * @param  string  $awal  The start date (optional).
     * @param  string  $akhir  The end date (optional).
     * @return \Illuminate\Support\Collection  The collection for export.
     */
    public static function makeCollectionForExportOnSheet($honor_kegiatan_id, $tanggal, $sheet_no = 1, $awal = '', $akhir = '')
    {
        if ($sheet_no === 1) {
            return self::makeBaseListMitraAndPegawai($honor_kegiatan_id, $tanggal)
                ->reject(function ($item) {
                    return $item['netto'] == 0;
                })
                ->flatten()
                ->transform(function ($item, $index) use ($awal, $akhir) {
                    $item['NIP Lama'] = $item['nip_lama'];
                    $item['TanggalAwal'] = '';
                    $item['TanggalAkhir'] = '';
                    $item['BulanMulai'] = $awal;
                    $item['BulanSelesai'] = $akhir;
                    $item['Volume'] = $item['volume'];
                    $item['HargaSatuan'] = $item['harga_satuan'];
                    $item['PersentasePajak'] = $item['persen_pajak'];
                    $item['Pajak'] = '';
                    unset($item['nip_lama']);
                    unset($item['volume']);
                    unset($item['harga_satuan']);
                    unset($item['persen_pajak']);
                    unset($item['bruto']);
                    unset($item['nama']);
                    unset($item['nip']);
                    unset($item['jabatan']);
                    unset($item['kode_bank_id']);
                    unset($item['rekening']);
                    unset($item['golongan']);
                    unset($item['bruto']);
                    unset($item['pajak']);
                    unset($item['netto']);

                    return $item;
                });
        } else {
            return self::makeBaseListMitra($honor_kegiatan_id)
                ->reject(function ($item) {
                    return $item['netto'] == 0;
                })
                ->flatten()
                ->transform(function ($item, $index) {
                    $item['nip'] = $item['nip_lama'];
                    $item['nama'] = $item['nama'];
                    unset($item['nip_lama']);
                    unset($item['volume']);
                    unset($item['harga_satuan']);
                    unset($item['persen_pajak']);
                    unset($item['bruto']);
                    unset($item['jabatan']);
                    unset($item['rekening']);
                    unset($item['kode_bank_id']);
                    unset($item['golongan']);
                    unset($item['bruto']);
                    unset($item['pajak']);
                    unset($item['netto']);

                    return $item;
                });
        }
    }

    /**
     * Create a collection for mass fund transfer (FT) purposes.
     *
     * @param  int  $honor_kegiatan_id  The ID of the honor kegiatan.
     * @param  string  $tanggal  The date of the SPJ.
     * @param  string  $satker_rekening  The sender account number.
     * @param  string  $remark  The remark for the transfer.
     * @return \Illuminate\Support\Collection  The collection for mass FT purposes.
     */
    public static function makeCollectionForMassFt($honor_kegiatan_id, $tanggal, $satker_rekening, $remark)
    {
        return self::makeBaseListMitraAndPegawai($honor_kegiatan_id, $tanggal)
            ->reject(function ($item) {
                return $item['netto'] == 0 || $item['kode_bank_id'] != 11;
            })
            ->flatten()
            ->transform(function ($item, $index) use ($satker_rekening, $remark) {
                $item['No'] = $index + 1;
                $item['Sender Account'] = $satker_rekening;
                $item['Benef Account'] = $item['rekening'];
                $item['Benef Name'] = $item['nama'];
                $item['eMail'] = '';
                $item['Amount'] = $item['netto'];
                $item['Currency'] = 'IDR';
                $item['Charge Type'] = 'BEN';
                $item['Voucher Code'] = '';
                $item['BI Trx Code'] = '';
                $item['Remark'] = $remark;
                $item['Reference Number'] = uniqid();
                unset($item['nip_lama']);
                unset($item['volume']);
                unset($item['harga_satuan']);
                unset($item['persen_pajak']);
                unset($item['bruto']);
                unset($item['nama']);
                unset($item['nip']);
                unset($item['jabatan']);
                unset($item['kode_bank_id']);
                unset($item['rekening']);
                unset($item['golongan']);
                unset($item['bruto']);
                unset($item['pajak']);
                unset($item['netto']);

                return $item;
            });
    }

    /**
     * Create a collection for mass credit note (CN) purposes.
     *
     * @param  int  $honor_kegiatan_id  The ID of the honor kegiatan.
     * @param  string  $tanggal  The date of the SPJ.
     * @param  string  $satker_rekening  The sender account number.
     * @param  string  $remark  The remark for the transfer.
     * @return \Illuminate\Support\Collection  The collection for mass CN purposes.
     */
    public static function makeCollectionForMassCn($honor_kegiatan_id, $tanggal, $satker_rekening, $remark)
    {
        return self::makeBaseListMitraAndPegawai($honor_kegiatan_id, $tanggal)
            ->reject(function ($item) {
                return $item['netto'] == 0 || $item['kode_bank_id'] == 11;
            })
            ->flatten()
            ->transform(function ($item, $index) use ($satker_rekening, $remark) {
                $item['No'] = $index + 1;
                $item['Sender Account'] = $satker_rekening;
                $item['Benef Account'] = $item['rekening'];
                $item['Benef Name'] = $item['nama'];
                $item['Benef Address'] = strtoupper(str_replace('Kabupaten ', '', config('satker.kabupaten')));
                $item['Benef Bank'] = optional(self::getKodeBankById($item['kode_bank_id']))->kode;
                $item['Benef eMail'] = '';
                $item['Amount'] = $item['netto'];
                $item['Charge Type'] = 'BEN';
                $item['Remark'] = $remark;
                $item['Reference Number'] = uniqid();
                unset($item['nip_lama']);
                unset($item['volume']);
                unset($item['harga_satuan']);
                unset($item['persen_pajak']);
                unset($item['bruto']);
                unset($item['nama']);
                unset($item['nip']);
                unset($item['jabatan']);
                unset($item['kode_bank_id']);
                unset($item['rekening']);
                unset($item['golongan']);
                unset($item['bruto']);
                unset($item['pajak']);
                unset($item['netto']);

                return $item;
            });
    }

    /**
     * Create a list of mitra and employee data for Surat Keputusan (SK) purposes.
     *
     * @param  int  $honor_kegiatan_id  The ID of the honor kegiatan.
     * @param  string  $tanggal  The date of the SK.
     * @return array  The list of mitra and employee data for SK purposes.
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
     * Create a list of contract data for mitra.
     *
     * @param  int  $kontrak_mitra_id  The ID of the contract.
     * @return array  The list of contract data for mitra.
     */
    public static function makeKontrakMitra($kontrak_mitra_id)
    {
        return DaftarHonorMitra::where('daftar_kontrak_mitra_id', $kontrak_mitra_id)->get()
            ->transform(function ($item, $index) {
                $honor_kegiatan = HonorKegiatan::find($item['honor_kegiatan_id']);
                $mata_anggaran = self::getMataAnggaranById($honor_kegiatan->mata_anggaran_id);
                $item['spek_no'] = $index + 1;
                $item['spek_kegiatan'] = optional($honor_kegiatan)->kegiatan;
                $item['spek_mak'] = optional($mata_anggaran)->mak;
                $item['spek_vol'] = $item['volume_target'];
                $item['spek_vol_target'] = $item['volume_target'];
                $item['spek_vol_realisasi'] = $item['volume_realisasi'];
                $item['spek_selesai'] = $item['status_realisasi'];
                $item['spek_satuan'] = optional($honor_kegiatan)->satuan;
                $item['spek_akhir'] = self::terbilangTanggal(optional($honor_kegiatan)->akhir);
                $item['spek_total'] = self::formatUang($item['volume_target'] * $item['harga_satuan']);

                return $item;
            })
            ->toArray();
    }

    /**
     * Get the list of holidays for a specific year.
     *
     * @param  int  $tahun  The year to get the holidays for.
     * @return array  The list of holidays.
     */
    public static function getHariLibur($tahun): array
    {
        $response = Http::get('https://dayoffapi.vercel.app/api?year='.$tahun);
        $data1 = $response->json();
        $response = Http::get('https://api-harilibur.vercel.app/api?year='.$tahun);
        $data2 = $response->json();
        $libur = [];
        foreach ($data2 as $data) {
            if ($data['is_national_holiday']) {
                $libur[] = [
                    'tanggal' => $data['holiday_date'],
                    'keterangan' => $data['holiday_name'],
                ];
            }
        }
        foreach ($data1 as $item) {
            if (isset($item['tanggal']) && isset($item['keterangan'])) {
                $libur[] = [
                    'tanggal' => $item['tanggal'],
                    'keterangan' => $item['keterangan'],
                ];
            }
        }

        return $libur;
    }

    /**
     * Synchronize holidays for a specific year.
     *
     * @param  int  $tahun  The year to synchronize holidays for.
     * @return void
     */
    public static function syncHariLibur($tahun)
    {
        $data = self::getHariLibur($tahun);
        foreach ($data as $item) {
            $kegiatan = DaftarKegiatan::firstOrNew([
                'jenis' => 'Libur',
                'awal' => $item['tanggal'],
            ]);
            $kegiatan->kegiatan = $item['keterangan'];
            $kegiatan->akhir = $item['tanggal'];
            $kegiatan->save();
        }
    }

    /**
     * Get the template path based on a specific column and value.
     *
     * @param  string  $column  The column name.
     * @param  string  $value  The column value.
     * @return array  The template filename and path.
     */
    public static function getTemplatePath($column, $value)
    {
        $file = optional(Template::cache()->get('all')->where($column, '=', $value)->first())->file;

        return [
            'filename' => $file,
            'path' => Storage::disk('templates')->path($file),
        ];
    }

    /**
     * Get the template path based on the template name.
     *
     * @param  string  $name  The template name.
     * @return array  The template filename and path.
     */
    public static function getTemplatePathByName($name)
    {
        return self::getTemplatePath('nama', $name);
    }

    /**
     * Get the template path based on the template ID.
     *
     * @param  int  $id  The template ID.
     * @return array  The template filename and path.
     */
    public static function getTemplatePathById($id)
    {
        return self::getTemplatePath('id', $id);
    }

    /**
     * Get the latest Tata Naskah ID based on the given date.
     *
     * @param  string  $tanggal  The date to check for the latest Tata Naskah.
     * @return string  The latest Tata Naskah ID.
     */
    public static function getLatestTataNaskahId($tanggal)
    {
        return optional(TataNaskah::cache()->get('all')->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first())->id;
    }

    /**
     * Get the latest Harga Satuan ID based on the given date.
     *
     * @param  string  $tanggal  The date to check for the latest Harga Satuan.
     * @return string  The latest Harga Satuan ID.
     */
    public static function getLatestHargaSatuanId($tanggal)
    {
        return optional(self::getLatestHargaSatuan($tanggal))->id;
    }

    /**
     * Get the latest Harga Satuan based on the given date.
     *
     * @param  string  $tanggal  The date to check for the latest Harga Satuan.
     * @return \App\Models\HargaSatuan|null  The latest Harga Satuan or null if not found.
     */
    public static function getLatestHargaSatuan($tanggal)
    {
        return HargaSatuan::cache()->get('all')->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first();
    }

    /**
     * Create options for the Derajat Naskah select field based on the given date.
     *
     * @param  string  $tanggal  The date to check for the latest Tata Naskah.
     * @return array  The options for the Derajat Naskah select field.
     */
    public static function setOptionsDerajatNaskah($tanggal)
    {
        return self::setOptions(DerajatNaskah::cache()->get('all')->where('tata_naskah_id', self::getLatestTataNaskahId($tanggal)), 'id', 'derajat');
    }

    /**
     * Create options for the Kode Bank select field.
     *
     * @return array  The options for the Kode Bank select field.
     */
    public static function setOptionsKodeBank()
    {
        return self::setOptions(KodeBank::cache()->get('all'), 'id', 'nama_bank');
    }

    /**
     * Create options for the WhatsApp group select field.
     *
     * @return array  The options for the WhatsApp group select field.
     */
    public static function setOptionsWaGroup()
    {
        $datas = Cache::get('wa_group');
        $result = [];
        if (! empty($datas)) {
            foreach ($datas as $group) {
                $result[$group['id']] = $group['name'];
            }
        }

        return $result;
    }

    /**
     * Create options for the Jenis Naskah select field based on the given date.
     *
     * @param  string  $tanggal  The date to check for the latest Tata Naskah.
     * @return array  The options for the Jenis Naskah select field.
     */
    public static function setOptionsJenisNaskah($tanggal)
    {
        $kode_naskah_id = KodeNaskah::cache()->get('all')->where('tata_naskah_id', self::getLatestTataNaskahId($tanggal))->pluck('id');

        return self::setOptions(JenisNaskah::cache()->get('all')->whereIn('kode_naskah_id', $kode_naskah_id), 'id', 'jenis');
    }

    /**
     * Create options for the Kode Arsip select field based on the given date.
     *
     * @param  string  $tanggal  The date to check for the latest Tata Naskah.
     * @param  array  $filterId  The filter IDs to include (optional).
     * @return array  The options for the Kode Arsip select field.
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
     * Check if the budget contains specific accounts.
     *
     * @param  int  $kak_id  The ID of the budget.
     * @param  array  $akun  The list of accounts to check.
     * @return bool  True if the budget contains the specified accounts, false otherwise.
     */
    public static function hasAkun($kak_id, array $akun): bool
    {
        return KerangkaAcuan::find($kak_id)->anggaranKerangkaAcuan->contains(function ($anggaran) use ($akun) {
            return in_array(substr($anggaran->mataAnggaran->mak, 29, 6), $akun);
        });
    }

    /**
     * Create options for the Pemenang select field based on the reward ID.
     *
     * @param  int  $reward_pegawai_id  The ID of the reward.
     * @return array  The options for the Pemenang select field.
     */
    public static function setOptionsPemenang($reward_pegawai_id)
    {
        return User::whereIn('id', function ($query) use ($reward_pegawai_id) {
            $query
                ->select('user_id')
                ->from('daftar_penilaian_rewards')
                ->where('reward_pegawai_id', $reward_pegawai_id)
                ->where('nilai_total', '>=', function ($subQuery) use ($reward_pegawai_id) {
                    $subQuery
                        ->select(DB::raw('MAX(nilai_total)'))
                        ->from('daftar_penilaian_rewards')
                        ->where('reward_pegawai_id', $reward_pegawai_id);
                });
        })
            ->pluck('name', 'id')
            ->toArray();
    }

    /**
     * Create options for a select field.
     *
     * @param  \Illuminate\Support\Collection  $collection  The collection of options.
     * @param  string  $value  The value field.
     * @param  string  $label  The label field.
     * @param  string  $group  The group field (optional).
     * @param  string  $labelPrefix  The label prefix (optional).
     * @param  string  $groupPrefix  The group prefix (optional).
     * @return array  The options for the select field.
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
     * Create options for the Jenis Kontrak select field based on the given date.
     *
     * @param  string  $tanggal  The date to check for the latest Harga Satuan.
     * @return array  The options for the Jenis Kontrak select field.
     */
    public static function setOptionJenisKontrak($tanggal)
    {
        return self::setOptions(JenisKontrak::cache()->get('all')->where('harga_satuan_id', self::getLatestHargaSatuanId($tanggal)), 'id', 'jenis');
    }

    /**
     * Create options for the DIPA year select field.
     *
     * @return array  The options for the DIPA year select field.
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
     * Create options for the template select field based on the template type.
     *
     * @param  string  $jenis  The template type.
     * @return array  The options for the template select field.
     */
    public static function setOptionTemplate($jenis)
    {
        return self::setOptions(Template::cache()->get('all')->where('jenis', $jenis), 'id', 'nama');
    }

    /**
     * Set the default template based on the template type.
     *
     * @param  string  $jenis  The template type.
     * @return int|null  The ID of the default template or null if not found.
     */
    public static function setDefaultTemplate($jenis)
    {
        $template = Template::cache()->get('all')->where('jenis', $jenis);

        return $template->count() == 1 ? $template->first()->id : null;
    }

    /**
     * Create options for the RO select field based on the DIPA ID.
     *
     * @param  int  $dipa_id  The ID of the DIPA.
     * @return array  The options for the RO select field.
     */
    public static function setOptionsRo($dipa_id)
    {
        return KamusAnggaran::cache()
            ->get('ro')
            ->where('dipa_id', $dipa_id)
            ->pluck('detail', 'mak')
            ->mapWithKeys(function ($item, $key) {
                return [
                    substr($key, 10, 12) => $item,
                ];
            })
            ->toArray();
    }

    /**
     * Create options for the manager select field based on the role and date.
     *
     * @param  string  $role  The role of the manager.
     * @param  string  $tanggal  The date to check for active/inactive status.
     * @return array  The options for the manager select field.
     */
    public static function setOptionPengelola($role, $tanggal)
    {
        return self::setOptions(self::getUsersByPengelola($role, $tanggal), 'id', 'name');
    }

    /**
     * Create options for the DIPA select field.
     *
     * @return array  The options for the DIPA select field.
     */
    public static function setOptionDipa()
    {
        return self::setOptions(Dipa::cache()->get('all')->whereBetween('tahun', [session('year'), session('year') + 1]), 'id', 'tahun');
    }

    /**
     * Create options for the Kepka Mitra select field based on the year.
     *
     * @param  int  $tahun  The year to check for Kepka Mitra.
     * @return array  The options for the Kepka Mitra select field.
     */
    public static function setOptionKepkaMitra($tahun)
    {
        return self::setOptions(KepkaMitra::cache()->get('all')->where('tahun', $tahun), 'id', 'nomor');
    }

    /**
     * Create options for the inventory item select field.
     *
     * @return array  The options for the inventory item select field.
     */
    public static function setOptionBarangPersediaan()
    {
        return self::setOptions(MasterPersediaan::cache()->get('all'), 'id', 'barang', 'satuan');
    }

    /**
     * Send a reminder message.
     *
     * @param  \App\Models\DaftarReminder  $reminder  The reminder to send.
     * @param  string  $method  The method of sending the reminder (default: 'auto').
     * @return void
     */
    public static function sendReminder($reminder, $method = 'auto')
    {
        $kegiatan = $reminder->daftarKegiatan;
        $hari = $kegiatan->awal->diffInDays($method === 'auto' ? $reminder->tanggal : now());
        $pesan = strtr($kegiatan->pesan, [
            '{judul}' => $hari > 0 ? '[Reminder Deadline (H-'.$hari.')]' : '[Reminder Deadline]',
            '{tanggal}' => self::terbilangTanggal($kegiatan->awal),
            '{kegiatan}' => $kegiatan->kegiatan,
            '{pj}' => $kegiatan->daftar_kegiatanable_type == \App\Models\UnitKerja::class ? UnitKerja::find($kegiatan->daftar_kegiatanable_id)->unit : User::find($kegiatan->daftar_kegiatanable_id)->name,
        ]);
        $response = Fonnte::make()->sendWhatsAppMessage($kegiatan->wa_group_id, $pesan);
        $reminder->status = $response['data']['process'] ?? 'Gagal';
        $reminder->message_id = $response['data']['id'][0];
        $reminder->save();
    }

    /**
     * Create options for the work unit select field.
     *
     * @return array  The options for the work unit select field.
     */
    public static function setOptionUnitKerja()
    {
        return self::setOptions(UnitKerja::cache()->get('all'), 'id', 'unit');
    }

    /**
     * Get the current Simpede version.
     *
     * @return string  The current Simpede version.
     */
    public static function version(): string
    {
        return once(function () {
            $manifest = File::json((string) realpath(join_paths(__DIR__, '../..', 'composer.json')));

            $version = $manifest['version'] ?? '2.x';

            return $version;
        });
    }
}
