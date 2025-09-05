<?php

namespace App\Helpers;

use App\Models\DaftarHonorMitra;
use App\Models\DaftarHonorPegawai;
use App\Models\DaftarKegiatan;
use App\Models\DaftarPulsaMitra;
use App\Models\DataPegawai;
use App\Models\DerajatNaskah;
use App\Models\Dipa;
use App\Models\HargaSatuan;
use App\Models\HonorKegiatan;
use App\Models\JenisKontrak;
use App\Models\JenisNaskah;
use App\Models\JenisPulsa;
use App\Models\KamusAnggaran;
use App\Models\KepkaMitra;
use App\Models\KerangkaAcuan;
use App\Models\KodeArsip;
use App\Models\KodeBank;
use App\Models\KodeNaskah;
use App\Models\LimitPulsa;
use App\Models\MasterPersediaan;
use App\Models\MasterWilayah;
use App\Models\MataAnggaran;
use App\Models\Mitra;
use App\Models\NaskahKeluar;
use App\Models\Pengelola;
use App\Models\TataNaskah;
use App\Models\Template;
use App\Models\UangPersediaan;
use App\Models\UnitKerja;
use App\Models\User;
use App\Models\WhatsappGroup;
use DateTime;
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
    const JENIS_BELANJA = [
        '51' => 'Belanja Pegawai (51)',
        '52' => 'Belanja Barang dan Jasa (52)',
        '53' => 'Belanja Modal (53)',
        '54' => 'Belanja Bunga Utang (54)',
        '55' => 'Belanja Subsidi (55)',
        '56' => 'Belanja Hibah (56)',
        '57' => 'Belanja Bantuan Sosial (57)',
        '58' => 'Belanja Lainnya (58)',
    ];

    const JENIS_ANGKUTAN = [
        'Angkutan Umum' => 'Angkutan Umum',
        'Kendaraan Dinas' => 'Kendaraan Dinas',
        'Lainnya' => 'Lainnya',
    ];

    const JENIS_UP = [
        'GTUP NIHIL',
        'GUP NIHIL',
        'GUP KKP',
        'TUP',
        'GUP',
        'UP',
    ];

    const AKUN_PERJALANAN = [
        '524111',
        '524113',
        '524114',
        '524119',
    ];

    const JENIS_DIGITAL_PAYMENT = [
        'atm' => 'ATM',
        'kkp' => 'KKP',
    ];

    const JENIS_KEGIATAN = [
        'Libur' => 'Libur',
        'Deadline' => 'Deadline',
        'Kegiatan' => 'Kegiatan',
    ];

    const WAKTU_REMINDER = [
        'HK' => 'Hari Kerja Sebelum Deadline',
        'H' => 'Hari Kalender Sebelum Deadline',
    ];

    const TRANSLOK_TYPE = [
        '1' => 'Kabupaten - Kecamatan',
        '2' => 'Kabupaten - Desa',
        '3' => 'Kecamatan - Desa',
    ];

    const JAM = [
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

    const JENIS_PERJALANAN = [
        '1' => 'Perjalanan Dinas Biasa',
        '2' => 'Translok Pendataan',
        '3' => 'Translok Role Playing',
        '4' => 'Translok Pelatihan',
        '5' => 'Paket Meeting Halfday',
        '6' => 'Paket Meeting Fullday',
        '7' => 'Paket Meeting Fullboard Dalam Kota',
        '8' => 'Paket Meeting Fullboard Luar Kota',
    ];

    const AKUN_PERSEDIAAN = [
        '521811',
        '521813',
        '523112',
        '523123',
        '523125',
        '521832',
        '521831',
    ];

    const AKUN_PEMELIHARAAN = [
        '523111',
        '523121',
    ];

    const TEMPLATE = [
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
        'pulsa' => 'Tanda Terima Pulsa',
    ];

    const JENIS_HONOR = [
        'Kontrak Mitra Bulanan' => 'Kontrak Mitra Bulanan',
        'Kontrak Mitra AdHoc' => 'Kontrak Mitra AdHoc',
        'Honor Pegawai' => 'Honor Pegawai',
    ];

    const AKUN_HONOR = [
        '521213',
    ];

    const BULAN = [
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

    const ROLE = [
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

    const GOLONGAN = [
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

    const PANGKAT = [
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

    const PAJAK_GOLONGAN = [
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
     * Get the name of the last sheet in an Excel file.
     *
     * @param  string  $file  The path to the Excel file.
     * @return string The name of the last sheet.
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
     * Format a phone number to a WhatsApp URL.
     *
     * @param  string  $telepon  The phone number to format.
     * @return string The formatted WhatsApp URL.
     */
    public static function formatTelepon($telepon)
    {
        $wa = str_replace('+62 08', '628', $telepon);
        $wa = str_replace('+62 ', '62', $wa);
        $wa = str_replace('-', '', $wa);

        return "https://wa.me/{$wa}";
    }

    /**
     * Check if the current date is within a specific quarter.
     *
     * @param  int  $tw  The quarter to check (1, 2, 3, or 4).
     * @return bool True if the current date is within the specified quarter, false otherwise.
     */
    public static function is_triwulan($tw)
    {
        $now = Carbon::now();
        switch ($tw) {
            case 1:
                return $now->between(Carbon::create($now->year, 3, 1), Carbon::create($now->year, 4, 20));
            case 2:
                return $now->between(Carbon::create($now->year, 6, 1), Carbon::create($now->year, 7, 20));
            case 3:
                return $now->between(Carbon::create($now->year, 9, 1), Carbon::create($now->year, 10, 20));
            case 4:
                return $now->between(Carbon::create($now->year, 12, 1), Carbon::create($now->year, 1, 20)->addYear());
            default:
                return false;
        }
    }

    /**
     * Check if the current date is within a specific cumulative quarter.
     *
     * @param  int  $tw  The cumulative quarter to check (1, 2, 3, or 4).
     * @return bool True if the current date is within the specified cumulative quarter, false otherwise.
     */
    public static function is_triwulan_kumulatif($tw)
    {
        $now = Carbon::now();
        switch ($tw) {
            case 1:
                return $now->between(Carbon::create($now->year, 3, 1), Carbon::create($now->year, 4, 20));
            case 2:
                return $now->between(Carbon::create($now->year, 3, 1), Carbon::create($now->year, 7, 20));
            case 3:
                return $now->between(Carbon::create($now->year, 3, 1), Carbon::create($now->year, 10, 20));
            case 4:
                return $now->between(Carbon::create($now->year, 3, 1), Carbon::create($now->year, 1, 20)->addYear());
            default:
                return false;
        }
    }

    /**
     * Get the current quarter based on the given month.
     *
     * @param  int  $month  The month to determine the quarter.
     * @return int The current quarter (1, 2, 3, or 4).
     */
    public static function getTriwulanBerjalan($month)
    {
        return (int) ceil($month / 3);
    }

    /**
     * Convert a date to the name of the day.
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
     * Convert a month to the name of the month.
     *
     * @param  int  $bulan
     * @return string
     */
    public static function terbilangBulan($bulan)
    {
        return self::BULAN[$bulan];
    }

    /**
     * Convert a number to Rupiah format.
     *
     * @param  int|float  $angka
     * @return string
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
     * @return int The stock of the item.
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
     * @param  string  $nama
     * @return string
     */
    public static function upperNamaTanpaGelar($nama)
    {
        return strtoupper(self::namaTanpaGelar($nama));
    }

    /**
     * Get a name without titles.
     *
     * @param  string  $nama
     * @return string
     */
    public static function namaTanpaGelar($nama)
    {
        return explode(',', $nama)[0];
    }

    /**
     * Convert a number to currency format.
     *
     * @param  int|float  $angka
     * @return string
     */
    public static function formatUang($angka)
    {
        return number_format($angka ?? 0, 0, ',', '.');
    }

    /**
     * Mask a NIK (National Identification Number) with asterisks.
     *
     * @param  string  $nik
     * @return string
     */
    public static function asterikNik($nik)
    {
        return substr($nik, 0, 4).str_repeat('*', 10).substr($nik, 14);
    }

    /**
     * Generate a time span in calendar days.
     *
     * @param  DateTime  $awal
     * @param  DateTime  $akhir
     * @return string
     */
    public static function jangkaWaktuHariKalender($awal, $akhir)
    {
        return self::jangkaWaktu($awal, $akhir).' Kalender';
    }

    /**
     * Generate a time span.
     *
     * @param  DateTime  $awal
     * @param  DateTime  $akhir
     * @return string
     */
    public static function jangkaWaktu($awal, $akhir)
    {
        $selisih = $awal->diff($akhir)->format('%a') + 1;

        return $selisih.' ( '.self::terbilang($selisih).') Hari';
    }

    /**
     * Convert a number to words.
     *
     * @param  int|float  $x
     * @return string
     */
    private static function kata($x)
    {
        $x = abs($x);

        return Number::spell($x, 'id');
    }

    /**
     * Remove the period at the end of a sentence.
     *
     * @param  string  $kalimat
     * @return string
     */
    public static function hapusTitikAkhirKalimat($kalimat)
    {
        return rtrim($kalimat, '.');
    }

    /**
     * Convert a number to words.
     *
     * @param  int|float  $x  The number
     * @param  string  $style  up=Upper|uw=ucwords|uf=ucfirst
     * @param  string  $suffix  Additional text at the end
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
     * Get the date before a specific deadline.
     *
     * @param  string  $tanggal_deadline  The deadline date
     * @param  int  $jumlah_hari  The number of days before the deadline
     * @param  string  $ref  The reference type (h=calendar days, HK=working days)
     * @return string The date before the deadline
     */
    public static function getTanggalSebelum($tanggal_deadline, $jumlah_hari, $ref = 'h')
    {
        $tanggal_deadline = Carbon::parse($tanggal_deadline);

        if ($ref === 'HK') {
            $hariLibur = DaftarKegiatan::where('jenis', 'Libur')->pluck('awal')->toArray();
            $hariLibur = array_map(fn ($date) => Carbon::parse($date)->format('Y-m-d'), $hariLibur);

            while ($tanggal_deadline->isWeekend() || in_array($tanggal_deadline->format('Y-m-d'), $hariLibur)) {
                $tanggal_deadline->subDay();
            }

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
     * Get the year from a given date.
     *
     * @param  \Illuminate\Support\Carbon  $tanggal  The date
     * @return int The year
     */
    public static function getYearFromDate($tanggal)
    {
        return $tanggal->format('Y');
    }

    /**
     * Get the month from a given date.
     *
     * @param  \Illuminate\Support\Carbon  $tanggal  The date
     * @return int The month
     */
    public static function getMonthFromDate($tanggal)
    {
        return $tanggal->format('m');
    }

    /**
     * Format a time.
     *
     * @param  string  $jam
     * @return string
     */
    public static function formatJam($jam, $suffix = 'WITA')
    {
        return date('H:i', strtotime($jam)).' '.$suffix;
    }

    /**
     * Format a list of names.
     *
     * @param  array  $nama
     * @return array
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
     * Convert an index to an alphabet.
     *
     * @param  int  $index
     * @return string
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
     * Get the year from a date string in 'Y-m-d' format.
     *
     * @param  string  $tanggal  The date in 'Y-m-d' format
     * @return int The year
     */
    public static function getYearFromDateString($tanggal)
    {
        return Carbon::createFromFormat('Y-m-d', $tanggal)->year;
    }

    /**
     * Create a date from a given string.
     *
     * @param  string  $tanggal  The date in 'Y-m-d' format
     * @return string|null The date in 'Y-m-d H:i:s' format or null if the date is empty
     */
    public static function createDateFromString($tanggal)
    {
        if (empty($tanggal)) {
            return null;
        }

        return Carbon::createFromFormat('Y-m-d', $tanggal)->endOfDay();
    }

    /**
     * Parse a filter from a URL.
     *
     * @param  string  $url  The URL to parse.
     * @param  string  $filterUri  The filter URI to look for in the query.
     * @param  string  $filterKey  The filter key to retrieve the value for.
     * @return string The filter value found based on the given filter key.
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
     * Parse a filter from a base64 encoded string.
     *
     * @param  string  $filter  The base64 encoded filter string.
     * @param  string  $filterKey  The filter key to retrieve the value for.
     * @param  string|null  $defaultValue  The default value if the filter key is not found.
     * @return string The filter value found based on the given filter key.
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
     * Check for duplicates in a JSON array.
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
     * Retrieves the pulsa limit (sbml) for a specific kegiatan based on the given jenis_pulsa_id.
     *
     * This method fetches the JenisPulsa record from cache, finds the entry with the specified ID,
     * and returns its 'sbml' value. If no matching record is found, it returns 0.
     *
     * @param  int  $jenis_pulsa_id  The ID of the JenisPulsa to retrieve the limit for.
     * @return int The pulsa limit (sbml) for the specified kegiatan, or 0 if not found.
     */
    public static function getLimitPulsaPerKegiatan($jenis_pulsa_id)
    {
        $limit = JenisPulsa::cache()
            ->get('all')
            ->where('id', $jenis_pulsa_id)
            ->first();

        return $limit ? $limit->sbml : 0;
    }

    /**
     * Generate a document number.
     *
     * @param  date  $tanggal  The date
     * @param  string  $tahun  The year
     * @param  string  $jenis_naskah_id  The document type ID
     * @param  string  $unit_kerja_id  The unit ID
     * @param  string  $kode_arsip_id  The archive code ID
     * @param  string  $derajat  The degree
     * @return array nomor, nomor_urut, segmen
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
     * @param  string  $role  The role (admin/koordinator)
     * @param  date  $tanggal  The date
     * @return Collection A collection of users
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
     * Set the default manager based on role and date.
     *
     * @param  string  $role  The role
     * @param  date  $tanggal  The date
     * @return int|null The user ID of the default manager or null if not found
     */
    public static function setDefaultPengelola($role, $tanggal)
    {
        $pengelola = self::getUsersByPengelola($role, $tanggal);

        return $pengelola->count() == 1 ? $pengelola->first()->id : null;
    }

    /**
     * Set the default meeting participants based on the purpose and date.
     *
     * @param  string  $tujuan  The purpose
     * @param  date  $tanggal  The date
     * @return array The list of participants
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
     * @param  int  $user_id  The user ID
     * @param  \Illuminate\Support\Carbon  $tanggal  The date
     * @return \App\Models\DataPegawai|null
     */
    public static function getDataPegawaiByUserId($user_id, $tanggal)
    {
        return DataPegawai::cache()->get('all')->where('user_id', $user_id)->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first();
    }

    /**
     * Get employee data based on user ID.
     *
     * @param  int  $user_id  The user ID
     * @return \App\Models\User|null
     */
    public static function getPegawaiByUserId($user_id)
    {
        return User::cache()->get('all')->where('id', $user_id)->first();
    }

    /**
     * Get partner data based on ID.
     *
     * @param  int  $id  The partner ID
     * @return \App\Models\Mitra|null
     */
    public static function getMitraById($id)
    {
        return Mitra::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Retrieve the ID of a Mitra by their NIK (Nomor Induk Kependudukan).
     *
     * This method fetches all Mitra records from the cache, filters them by the provided NIK,
     * and returns the ID of the first matching Mitra.
     *
     * @param  string  $nik  The NIK of the Mitra to search for.
     * @return int|null The ID of the matching Mitra, or null if not found.
     */
    public static function getMitraIdByNik($nik)
    {
        return optional(Mitra::cache()->get('all')->where('nik', $nik)->first())->id;
    }

    /**
     * Get jenis pulsa based on ID.
     *
     * @param  int  $id  The jenis pulsa ID
     * @return \App\Models\JenisPulsa|null
     */
    public static function getJenisPulsaById($id)
    {
        return JenisPulsa::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Get bank code data based on ID.
     *
     * @param  int  $id  The bank code ID
     * @return \App\Models\KodeBank|null
     */
    public static function getKodeBankById($id)
    {
        return KodeBank::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Get master inventory data based on ID.
     *
     * @param  int  $id  The master inventory ID
     * @return \App\Models\MasterPersediaan|null
     */
    public static function getMasterPersediaanById($id)
    {
        return MasterPersediaan::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Get contract type data based on ID.
     *
     * @param  int  $id  The contract type ID
     * @return \App\Models\JenisKontrak|null
     */
    public static function getJenisKontrakById($id)
    {
        return JenisKontrak::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Get budget data based on ID.
     *
     * @param  int  $id  The budget ID
     * @return \App\Models\MataAnggaran|null
     */
    public static function getMataAnggaranById($id)
    {
        return MataAnggaran::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Get region data based on ID.
     *
     * @param  int  $id  The region ID
     * @return \App\Models\MasterWilayah|null
     */
    public static function getMasterWilayahById($id)
    {
        return MasterWilayah::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Get region data based on code.
     *
     * @param  string  $kode  The region code
     * @return \App\Models\MasterWilayah|null
     */
    public static function getMasterWilayahByKode($kode)
    {
        return MasterWilayah::cache()->get('all')->where('kode', $kode)->first();
    }

    /**
     * Check if the budget contains an honor account for activity output.
     *
     * @param  json anggaran $spek
     * @return int
     */
    public static function isAkunHonor($mata_anggaran_id): bool
    {
        $mak = MataAnggaran::cache()->get('all')->where('id', $mata_anggaran_id)->first()->mak;

        return $mak == in_array(substr($mak, -6), self::AKUN_HONOR);
    }

    /**
     * Check if the honor account has changed from $mak_old to $mak_new.
     *
     * @param  string  $mak_old  The previous account
     * @param  string  $mak_new  The new account
     * @return bool
     */
    public static function isAkunHonorChanged($mak_old, $mak_new)
    {
        return (self::isAkunHonor($mak_old) && ! self::isAkunHonor($mak_new)) || (self::isAkunHonor($mak_old) && self::isAkunHonor($mak_new) && $mak_old != $mak_new);
    }

    /**
     * Check if the account code is an inventory account.
     *
     * @param  string  $mak  The account code to check.
     * @return bool True if the account code is an inventory account, false otherwise.
     */
    public static function isAkunPersediaan(string $mata_anggaran_id): bool
    {
        $mak = MataAnggaran::cache()->get('all')->where('id', $mata_anggaran_id)->first()->mak;

        return $mak == in_array(substr($mak, -6), self::AKUN_PERSEDIAAN);
    }

    /**
     * Check if the account code is a maintenance account.
     *
     * @param  string  $mata_anggaran_id  The account code to check.
     * @return bool True if the account code is a maintenance account, false otherwise.
     */
    public static function isAkunPemeliharaan(string $mata_anggaran_id): bool
    {
        $mak = MataAnggaran::cache()->get('all')->where('id', $mata_anggaran_id)->first()->mak;

        return $mak == in_array(substr($mak, -6), self::AKUN_PEMELIHARAAN);
    }

    /**
     * Check if the inventory account has changed.
     *
     * This function compares two inventory account values and determines if
     * there is a change between the old value and the new value.
     *
     * @param  string  $mak_old  The old inventory account value.
     * @param  string  $mak_new  The new inventory account value.
     * @return bool True if the inventory account has changed, false otherwise.
     */
    public static function isAkunPersediaanChanged($mak_old, $mak_new)
    {
        return (self::isAkunPersediaan($mak_old) && ! self::isAkunPersediaan($mak_new)) || (self::isAkunPersediaan($mak_old) && self::isAkunPersediaan($mak_new) && $mak_old != $mak_new);
    }

    /**
     * Check if the maintenance account has changed.
     *
     * This function compares two maintenance account values and determines if
     * there is a change between the old value and the new value.
     *
     * @param  string  $mak_old  The old maintenance account value.
     * @param  string  $mak_new  The new maintenance account value.
     * @return bool True if the maintenance account has changed, false otherwise.
     */
    public static function isAkunPemeliharaanChanged($mak_old, $mak_new)
    {
        return (self::isAkunPemeliharaan($mak_old) && ! self::isAkunPemeliharaan($mak_new)) || (self::isAkunPemeliharaan($mak_old) && self::isAkunPemeliharaan($mak_new) && $mak_old != $mak_new);
    }

    /**
     * Get the account details based on the desired level.
     *
     * @param  string  $mak  The account code
     * @param  string  $level  The level (default 'akun', options: program, kegiatan, kro, ro, komponen, sub, akun)
     * @param  bool  $kode_prefix  Whether to include the code prefix (default true)
     * @return string
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
     * Format the specifications for display.
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
     * Format the travel expenses for display.
     *
     * @param  array  $spesifikasi
     * @return array
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
     * @param  array  $item
     * @return array
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
     * Calculate the total value of the specifications.
     *
     * @param  array  $spesifikasi
     * @return float
     */
    public static function sumSpek($spesifikasi, $column)
    {
        // $speks= json_decode($spesifikasi,true);
        $spek = collect($spesifikasi);

        return $spek->sum($column);
    }

    /**
     * Format the budget for display.
     *
     * @param  array  $anggaran
     * @return array
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
     * @param  array  $bastp
     * @return array
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
     * Format the maintenance list for display.
     *
     * @param  array  $spek
     * @return array
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
     * Format the assessment list for display.
     *
     * @param  array  $spek
     * @return array
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
     * Format the inventory list for display.
     *
     * @param  int  $id
     * @param  array  $spek
     * @return array
     */
    // --- Fungsi lengkap bebas N+1, alur & hasil sama ---
    public static function formatDaftarPersediaan($id, $spek)
    {
        $stok = self::cekStokPersediaan($id, (session('year') - 1).'-12-31');

        $spek->transform(function ($item, $index) use (&$stok) {
            // Add serial number
            $item['no'] = $index + 1;

            // Convert transaction date to book date
            $item['tanggal_buku'] = self::terbilangTanggal(
                $item['tanggal_transaksi']
            );

            // Get document number based on inventory item type
            $cls = get_class($item->barangPersediaanable);
            $item['nomor_dokumen'] = match ($cls) {
                \App\Models\PembelianPersediaan::class => $item->barangPersediaanable->bastNaskahKeluar->nomor,
                \App\Models\PermintaanPersediaan::class => $item->barangPersediaanable->naskahKeluar->nomor,
                \App\Models\PersediaanMasuk::class => $item->barangPersediaanable->naskahMasuk->nomor,
                \App\Models\PersediaanKeluar::class => $item->barangPersediaanable->naskahKeluar->nomor,
            };

            // Get description based on inventory item type
            $item['uraian'] = match ($cls) {
                \App\Models\PembelianPersediaan::class => $item->barangPersediaanable->rincian,
                \App\Models\PermintaanPersediaan::class => 'Permintaan Persediaan oleh '.
                    $item->barangPersediaanable->user->name.
                    ' untuk '.
                    $item->barangPersediaanable->kegiatan,
                \App\Models\PersediaanMasuk::class => $item->barangPersediaanable->rincian,
                \App\Models\PersediaanKeluar::class => $item->barangPersediaanable->rincian
            };

            // Calculate incoming and outgoing volume
            $item['masuk'] = match ($cls) {
                \App\Models\PembelianPersediaan::class,
                \App\Models\PersediaanMasuk::class => $item->volume,
                default => '-'
            };

            $item['keluar'] = match ($cls) {
                \App\Models\PermintaanPersediaan::class,
                \App\Models\PersediaanKeluar::class => $item->volume,
                default => '-'
            };

            // Calculate remaining stock
            $item['sisa'] = match ($cls) {
                \App\Models\PembelianPersediaan::class,
                \App\Models\PersediaanMasuk::class => $stok + $item['volume'],
                \App\Models\PermintaanPersediaan::class,
                \App\Models\PersediaanKeluar::class => $stok - $item['volume']
            };

            // Update stock
            $stok = $item['sisa'];

            // Bersihkan relasi dari output
            unset($item->barangPersediaanable);

            return $item;
        });

        $arrayspek = $spek->toArray();

        return empty($arrayspek)
            ? [[
                'no' => 1,
                'nomor_dokumen' => '-',
                'tanggal_buku' => '-',
                'uraian' => '-',
                'masuk' => '-',
                'keluar' => '-',
                'sisa' => $stok,
            ]]
            : $arrayspek;
    }

    /**
     * Format partner data for SPJ purposes.
     *
     * @param  collection  $mitra
     * @return collection
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

    public static function formatPulsaMitra($mitra)
    {
        $mitra->transform(function ($item, $index) {
            $mitra = self::getMitraById($item['mitra_id']);
            $item['nama'] = optional($mitra)->nama;
            $item['nik'] = optional($mitra)->nik;
            $item['nik_tag'] = '${'.optional($mitra)->nik.'}';
            $item['bukti'] = $item['file'];
            unset($item['mitra_id']);
            unset($item['id']);
            unset($item['created_at']);
            unset($item['updated_at']);
            unset($item['pulsa_kegiatan_id']);
            unset($item['volume']);
            unset($item['file']);
            unset($item['confirmed']);

            return $item;
        });

        return $mitra;
    }

    /**
     * Create a query for the model based on the quarter.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  int  $triwulan  The quarter (1, 2, 3, or 4)
     * @return \Illuminate\Database\Eloquent\Builder
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
            ->leftJoin('perjanjian_kinerja_tindak_lanjut', 'perjanjian_kinerjas.id', '=', 'perjanjian_kinerja_tindak_lanjut.perjanjian_kinerja_id')
            ->leftJoin('tindak_lanjuts', function ($join) use ($triwulan) {
                $join->on('perjanjian_kinerja_tindak_lanjut.tindak_lanjut_id', '=', 'tindak_lanjuts.id')
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
     * Format employee data for display.
     *
     * @param  \Illuminate\Support\Collection  $pegawai
     * @param  string  $tanggal_spj
     * @return \Illuminate\Support\Collection
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
     * Format the mitra from the database into a unified list with the required fields.
     *
     * @param  int  $honor_kegiatan_id  The ID of the honor kegiatan
     * @return Collection A collection of the unified list
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
                $item['rekening'] = optional(self::getKodeBankById($item['kode_bank_id']))->nama_bank.' '.$item['rekening'];
                $item['netto'] = self::formatUang($item['netto']);
                $item['harga_satuan'] = self::formatUang($item['harga_satuan']);

                return $item;
            })
            ->toArray();
    }

    public static function makeSpjPulsaMitra($pulsa_kegiatan_id)
    {
        $mitra = DaftarPulsaMitra::where('pulsa_kegiatan_id', $pulsa_kegiatan_id)->get();
        $formattedMitra = self::formatPulsaMitra($mitra);

        return $formattedMitra
            ->transform(function ($item, $index) {
                $item['spj_no'] = $index + 1;
                $item['nominal'] = self::formatUang($item['nominal']);
                $item['harga'] = self::formatUang($item['harga']);

                return $item;
            })
            ->toArray();
    }

    /**
     * Check for empty bank account numbers in the SPJ list.
     *
     * @param  int  $honor_kegiatan_id
     * @param  string  $tanggal
     */
    public static function checkEmptyRekeningOnSpjMitraAndPegawai($honor_kegiatan_id, $tanggal): bool
    {
        $list = collect(self::makeSpjMitraAndPegawai($honor_kegiatan_id, $tanggal));

        return $list->contains(fn ($value) => $value['rekening'] == ' ');
    }

    /**
     * Create a format for Surat Tugas (ST) for both mitra and pegawai.
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
     * Create a collection for export on a specific sheet.
     *
     * @param  int  $honor_kegiatan_id
     * @param  string  $tanggal
     * @param  int  $sheet_no
     * @param  string  $awal
     * @param  string  $akhir
     * @return \Illuminate\Support\Collection
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
     * Create a collection for mass fund transfer.
     *
     * @param  int  $honor_kegiatan_id
     * @param  string  $tanggal
     * @param  string  $satker_rekening
     * @param  string  $remark
     * @return \Illuminate\Support\Collection
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
     * Create a collection for mass credit note.
     *
     * @param  int  $honor_kegiatan_id
     * @param  string  $tanggal
     * @param  string  $satker_rekening
     * @param  string  $remark
     * @return \Illuminate\Support\Collection
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
     * Create Surat Keterangan (SK) for both Mitra and Pegawai.
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
     * Create a contract for Mitra.
     *
     * @param  int  $kontrak_mitra_id
     * @return array
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
     * Get public holidays for a specific year.
     *
     * @param  int  $tahun
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
     * Sync public holidays for a specific year.
     *
     * @param  int  $tahun
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
     * Get the template path based on a column and value.
     *
     * @param  string  $column  The template column name
     * @param  string  $value  The template column value
     * @return array The template filename and path
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
     * @param  string  $name  The template name
     * @return array
     */
    public static function getTemplatePathByName($name)
    {
        return self::getTemplatePath('nama', $name);
    }

    /**
     * Get the template path based on the template ID.
     *
     * @param  int  $id
     * @return array
     */
    public static function getTemplatePathById($id)
    {
        return self::getTemplatePath('id', $id);
    }

    /**
     * Get the latest Tata Naskah ID based on the given date.
     *
     * @param  string  $tanggal
     * @return string
     */
    public static function getLatestTataNaskahId($tanggal)
    {
        return optional(TataNaskah::cache()->get('all')->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first())->id;
    }

    public static function getLatestUangPersediaan($tahun, array $jenis)
    {
        $dipa = Dipa::cache()
            ->get('all')
            ->where('tahun', $tahun)
            ->first();
        $dipaId = optional($dipa)->id;

        $latestUp = UangPersediaan::where('dipa_id', $dipaId)
            ->whereIn('jenis', $jenis)
            ->whereNowOrPast('tanggal')
            ->latest('tanggal')
            ->first();

        return $latestUp;
    }

    public static function getLatestUp($tahun)
    {
        return self::getLatestUangPersediaan($tahun, ['UP']);
    }

    public static function getLatestGup($tahun)
    {
        $gup = self::getLatestUangPersediaan($tahun, ['GUP']);

        return $gup ?? self::getLatestUp($tahun);
    }

    public static function getLatestTup($tahun)
    {
        $tup = self::getLatestUangPersediaan($tahun, ['TUP', 'GTUP NIHIL']);

        return $tup === 'GTUP NIHIL' ? null : $tup;
    }

    /**
     * Get the latest Harga Satuan ID based on the given date.
     *
     * @param  string  $tanggal
     * @return string
     */
    public static function getLatestHargaSatuanId($tanggal)
    {
        return optional(self::getLatestHargaSatuan($tanggal))->id;
    }

    /**
     * Get the latest Limit Pulsa ID based on the given date.
     *
     * @param  string  $tanggal
     * @return string|null The latest Limit Pulsa ID or null if not found.
     */
    public static function getLatestLimitPulsaId($tanggal)
    {
        return optional(self::getLatestLimitPulsa($tanggal))->id;
    }

    /**
     * Get the latest Harga Satuan based on the given date.
     *
     * @param  string  $tanggal  The date to filter the Harga Satuan data.
     * @return HargaSatuan|null The latest Harga Satuan object or null if not found.
     */
    public static function getLatestHargaSatuan($tanggal)
    {
        return HargaSatuan::cache()->get('all')->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first();
    }

    /**
     * Retrieves the latest LimitPulsa record with a 'tanggal' less than or equal to the specified date.
     *
     * This method fetches all LimitPulsa records from cache, filters them by the given date,
     * sorts them in descending order by 'tanggal', and returns the first (latest) record.
     *
     * @param  string|\DateTime  $tanggal  The date to filter records by (inclusive).
     * @return LimitPulsa|null The latest LimitPulsa record matching the criteria, or null if none found.
     */
    public static function getLatestLimitPulsa($tanggal)
    {
        return LimitPulsa::cache()->get('all')->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first();
    }

    /**
     * Create option values for the Derajat Naskah select field based on the given date.
     *
     * @param  string  $tanggal
     * @return array
     */
    public static function setOptionsDerajatNaskah($tanggal)
    {
        return self::setOptions(DerajatNaskah::cache()->get('all')->where('tata_naskah_id', self::getLatestTataNaskahId($tanggal)), 'id', 'derajat');
    }

    /**
     * Create option values for the Kode Bank select field.
     *
     * @return array
     */
    public static function setOptionsKodeBank()
    {
        return self::setOptions(KodeBank::cache()->get('all'), 'id', 'nama_bank');
    }

    /**
     * Create option values for the WhatsApp group select field.
     *
     * @return array
     */
    public static function setOptionsWaGroup()
    {
        return self::setOptions(WhatsappGroup::cache()->get('all'), 'group_id', 'group_name');
    }

    /**
     * Create option values for the Jenis Naskah select field based on the given date.
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
     * Create option values for the Kode Arsip select field based on the given date.
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
     * Check if the KAK contains the specified accounts.
     *
     * @param  int  $kak_id
     */
    public static function hasAkun($kak_id, array $akun): bool
    {
        return KerangkaAcuan::find($kak_id)->anggaranKerangkaAcuan->contains(function ($anggaran) use ($akun) {
            return in_array(substr($anggaran->mataAnggaran->mak, 29, 6), $akun);
        });
    }

    /**
     * Create option values for the Pemenang select field based on the reward_pegawai_id.
     *
     * @param  int  $reward_pegawai_id
     * @return array
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
     * Create option values for a select field.
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
     * Create option values for the contract type select field based on the given date.
     *
     * @param  string  $tanggal
     * @return array
     */
    public static function setOptionJenisKontrak($tanggal)
    {
        return self::setOptions(JenisKontrak::cache()->get('all')->where('harga_satuan_id', self::getLatestHargaSatuanId($tanggal)), 'id', 'jenis');
    }

    public static function setOptionJenisPulsa($tanggal)
    {
        return self::setOptions(JenisPulsa::cache()->get('all')->where('limit_pulsa_id', self::getLatestLimitPulsaId($tanggal)), 'id', 'jenis');
    }

    /**
     * Create option values for the DIPA year select field.
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
     * Create option values for the template select field based on the type.
     *
     * @param  string  $jenis
     * @return array
     */
    public static function setOptionTemplate($jenis)
    {
        return self::setOptions(Template::cache()->get('all')->where('jenis', $jenis), 'id', 'nama');
    }

    /**
     * Set the default template based on the type.
     *
     * @param  string  $jenis
     * @return int|null
     */
    public static function setDefaultTemplate($jenis)
    {
        $template = Template::cache()->get('all')->where('jenis', $jenis);

        return $template->count() == 1 ? $template->first()->id : null;
    }

    /**
     * Create option values for the RO select field based on the DIPA ID.
     *
     * @param  int  $dipa_id
     * @return array
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
     * Create option values for the manager select field based on the role and date.
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
     * Create option values for the DIPA select field.
     *
     * @return array
     */
    public static function setOptionDipa()
    {
        return self::setOptions(Dipa::cache()->get('all')->whereBetween('tahun', [session('year'), session('year') + 1]), 'id', 'tahun');
    }

    /**
     * Create option values for the Kepka Mitra select field based on the year.
     *
     * @param  int  $tahun
     * @return array
     */
    public static function setOptionKepkaMitra($tahun)
    {
        return self::setOptions(KepkaMitra::cache()->get('all')->where('tahun', $tahun), 'id', 'nomor');
    }

    /**
     * Generates options for Mitra based on the specified year.
     *
     * Retrieves the KepkaMitra ID for the given year, then fetches all Mitra records
     * associated with that KepkaMitra ID. Returns the options array using the Mitra's
     * 'id' as the key and 'nama' as the value.
     *
     * @param  int|string  $tahun  The year to filter KepkaMitra records.
     * @return array Options array with Mitra IDs as keys and names as values.
     */
    public static function setOptionsMitra($tahun)
    {
        $kepkaMitraId = optional(KepkaMitra::cache()->get('all')->where('tahun', $tahun)->first())->id;

        return self::setOptions(Mitra::cache()->get('all')->where('kepka_mitra_id', $kepkaMitraId), 'id', 'nama', '', 'nik');
    }

    /**
     * Set options for Mata Anggaran based on the given DIPA ID and MAK.
     *
     * This method filters the Mata Anggaran records from the cache based on the provided
     * DIPA ID and MAK, excluding those marked as manual, and then sets the options.
     *
     * @param  int  $dipa_id  The ID of the DIPA.
     * @param  string  $mak  The MAK (Mata Anggaran Kode).
     * @return array The options set for Mata Anggaran.
     */
    public static function setOptionMataAnggaran($dipa_id, $mak)
    {
        return self::setOptions(MataAnggaran::cache()->get('all')
            ->where('dipa_id', $dipa_id)
            ->where('mak', $mak)
            ->where('is_manual', '!=', true), 'id', 'uraian', 'mak');
    }

    /**
     * Create option values for the inventory item select field.
     *
     * @return array
     */
    public static function setOptionBarangPersediaan()
    {
        return self::setOptions(MasterPersediaan::cache()->get('all'), 'id', 'barang', 'satuan');
    }

    /**
     * Send a reminder message.
     *
     * @param  \App\Models\DaftarReminder  $reminder
     * @param  string  $method
     * @return void
     */
    public static function sendReminder($reminder, $method = 'auto')
    {
        $kegiatan = $reminder->daftarKegiatan;
        $hari = floor(($method === 'auto' ? $reminder->tanggal : now())->diffInDays($kegiatan->awal, true));
        $pesan = strtr($kegiatan->pesan, [
            '{judul}' => $hari > 0 ? '[Reminder Deadline (H-'.$hari.')]' : '[Reminder Deadline]',
            '{tanggal}' => self::terbilangTanggal($kegiatan->awal),
            '{kegiatan}' => $kegiatan->kegiatan,
            '{pj}' => $kegiatan->daftar_kegiatanable_type == \App\Models\UnitKerja::class ? UnitKerja::find($kegiatan->daftar_kegiatanable_id)->unit : User::find($kegiatan->daftar_kegiatanable_id)->name,
        ]);
        $recipients = implode(',', collect($kegiatan->wa_group_id)->pluck('id')->toArray());
        $response = Fonnte::make()->sendWhatsAppMessage($recipients, $pesan);
        if ($response['status']) {
            $reminder->status = $response['data']['process'] ?? 'Gagal';
            $reminder->message_id = $response['data']['id'][0];
            $reminder->save();

            return true;
        } else {
            return $response['error'] ?? 'Gagal Mengirim Reminder';
        }
    }

    /**
     * Create option values for the unit select field.
     *
     * @return array
     */
    public static function setOptionUnitKerja()
    {
        return self::setOptions(UnitKerja::cache()->get('all'), 'id', 'unit');
    }

    /**
     * Get the current Simpede version.
     */
    public static function version(): string
    {
        return once(function () {
            $manifest = File::json((string) realpath(join_paths(__DIR__, '../..', 'composer.json')));

            $version = $manifest['version'] ?? '2.x';

            return $version;
        });
    }

    public static function hitungPeriodeGup($tanggalGup): array
    {
        if (isset($tanggalGup)) {
            $date = $tanggalGup;

            $bulan = (int) $date->format('m');
            $tahun = (int) $date->format('Y');
            $hari = (int) $date->format('d');

            $daysInCurrentMonth = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

            // Cari bulan berikutnya
            $nextMonth = $bulan + 1;
            $nextYear = $tahun;
            if ($nextMonth > 12) {
                $nextMonth = 1;
                $nextYear++;
            }
            $daysInNextMonth = cal_days_in_month(CAL_GREGORIAN, $nextMonth, $nextYear);

            if ($hari == $daysInCurrentMonth) {
                // Jika tanggal terakhir bulan → pakai tanggal terakhir bulan berikutnya
                $endDate = new DateTime("$nextYear-$nextMonth-$daysInNextMonth");
                $days = $daysInNextMonth;
            } else {
                // Jika bukan tanggal terakhir → pakai tanggal sama di bulan berikutnya
                // Hati-hati jika bulan berikutnya tidak punya tanggal tsb (misalnya 30 Feb)
                $endDay = min($hari, $daysInNextMonth);
                $endDate = new DateTime("$nextYear-$nextMonth-$endDay");
                $days = $daysInCurrentMonth;
            }

            return [
                'awal' => Carbon::instance($date),
                'akhir' => Carbon::instance($endDate),
                'hari' => $days,
            ];
        }

        return [
            'awal' => '-',
            'akhir' => '-',
            'hari' => 0,
        ];
    }

    public static function setReminderForUangPersediaan($jenis, $tanggal)
    {
        $kegiatan = new DaftarKegiatan;
        $kegiatan->jenis = 'Deadline';
        $kegiatan->kegiatan = $jenis === 'gup' ? 'SPM Penggantian UP (GUP)' : 'SPM Pertanggungjawaban TUP (GTUP)';
        $kegiatan->awal = $tanggal;
        $kegiatan->akhir = $tanggal;
        $kegiatan->wa_group_id = [['id' => '6287814885714-1605499798@g.us']];
        $kegiatan->pesan = "*{judul}*\n\nDeadline : {tanggal}\nPerihal : {kegiatan}\nPenanggung jawab: *{pj}*\n\nMohon untuk segera membuat ".($jenis === 'gup' ? 'SPM Penggantian UP (GUP)' : 'SPM Pertanggungjawaban TUP (GTUP)')." sebelum tanggal ({tanggal}). Harap tetap memperhatikan jumlah minimum yang telah ditentukan.\n\nTerimakasih ✨✨";
        $kegiatan->waktu_reminder = [
            ['hari' => 3, 'referensi_waktu' => 'HK', 'waktu_kirim' => '08:00:00'],
            ['hari' => 1, 'referensi_waktu' => 'HK', 'waktu_kirim' => '08:00:00'],
        ];
        $kegiatan->daftar_kegiatanable_id = 1;
        $kegiatan->daftar_kegiatanable_type = 'App\\Models\\UnitKerja';
        $kegiatan->save();
    }
}
