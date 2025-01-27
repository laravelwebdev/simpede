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

    public static function formatTelepon($telepon)
    {
        $wa = str_replace('+62 08', '628', $telepon);
        $wa = str_replace('+62 ', '62', $wa);
        $wa = str_replace('-', '', $wa);

        return "https://wa.me/{$wa}";
    }

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

    public static function getTriwulanBerjalan($month)
    {
        return (int) ceil($month / 3);
    }

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

    public static function cekStokPersediaan($id, $tanggal = null)
    {
        $stok = DB::table('barang_persediaans')
            ->selectRaw(
                'SUM(CASE WHEN tanggal_transaksi IS NOT NULL AND (barang_persediaanable_type = "App\\\Models\\\PembelianPersediaan" OR  barang_persediaanable_type = "App\\\Models\\\PersediaanMasuk") THEN volume ELSE 0 END) -  SUM(CASE WHEN barang_persediaanable_type = "App\\\Models\\\PermintaanPersediaan" OR  barang_persediaanable_type = "App\\\Models\\\PersediaanKeluar"THEN volume ELSE 0 END) as stok'
            )
            ->where('master_persediaan_id', $id)
            ->when($tanggal, function ($query, $tanggal) {
                return $query->where('tanggal_transaksi', '<=', $tanggal);
            })
            ->groupBy('master_persediaan_id')
            ->first();

        return $stok ? $stok->stok : 0;
    }

    /**
     * Upper case nama tanpa gelar.
     *
     * @param  string  $nama
     * @return string
     */
    public static function upperNamaTanpaGelar($nama)
    {
        return strtoupper(self::namaTanpaGelar($nama));
    }

    /**
     * Nama tanpa gelar.
     *
     * @param  string  $nama
     * @return string
     */
    public static function namaTanpaGelar($nama)
    {
        return explode(',', $nama)[0];
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

    public static function asterikNik($nik)
    {
        return substr($nik, 0, 4).str_repeat('*', 10).substr($nik, 14);
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
        return self::jangkaWaktu($awal, $akhir).' Kalender';
    }

    public static function jangkaWaktu($awal, $akhir)
    {
        $selisih = $awal->diff($akhir)->format('%a') + 1;

        return $selisih.' ( '.self::terbilang($selisih).') Hari';
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

        return Number::spell($x, 'id');
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

    public static function getMonthFromDate($tanggal)
    {
        return $tanggal->format('m');
    }

    public static function formatJam($jam)
    {
        return date('H:i', strtotime($jam));
    }

    public static function formatDaftarNama($nama)
    {
        $daftar = [];
        $index = 1;

        for ($i = 0; $i < count($nama); $i += 2) {
            $nama1 = Helper::getPegawaiByUserId($nama[$i]['peserta_user_id'])->name;
            $unit_kerja1 = 'BPS '.config('satker.kabupaten');
            $nama2 = isset($nama[$i + 1]) ? Helper::getPegawaiByUserId($nama[$i + 1]['peserta_user_id'])->name : '';
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

        return Carbon::createFromFormat('Y-m-d', $tanggal)->endOfDay();
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
        $bulan = self::getMonthFromDate($tanggal);
        $replaces['<tahun>'] = $tahun;
        $replaces['<bulan>'] = $bulan;

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
        $format = self::getPropertyFromCollection($kode_naskah, 'format');
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

    public static function setDefaultPengelola($role, $tanggal)
    {
        $pengelola = self::getUsersByPengelola($role, $tanggal);

        return $pengelola->count() == 1 ? $pengelola->first()->id : null;
    }

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

    public static function getKodeBankById($id)
    {
        return KodeBank::cache()->get('all')->where('id', $id)->first();
    }

    /**
     * Mengambil data MasterPersediaan berdasarkan ID.
     *
     * @param  int  $id  ID dari MasterPersediaan yang ingin diambil.
     * @return mixed Data MasterPersediaan yang sesuai dengan ID yang diberikan, atau null jika tidak ditemukan.
     */
    public static function getMasterPersediaanById($id)
    {
        return MasterPersediaan::cache()->get('all')->where('id', $id)->first();
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

    public static function getMataAnggaranById($id)
    {
        return MataAnggaran::cache()->get('all')->where('id', $id)->first();
    }

    public static function getMasterWilayahById($id)
    {
        return MasterWilayah::cache()->get('all')->where('id', $id)->first();
    }

    public static function getMasterWilayahByKode($kode)
    {
        return MasterWilayah::cache()->get('all')->where('kode', $kode)->first();
    }

    /**
     * Memeriksa apakah anggaran memuat akun honor output kegiatan.
     *
     * @param  json anggaran $spek
     * @return int
     */
    public static function isAkunHonor($mata_anggaran_id): bool
    {
        $mak = MataAnggaran::cache()->get('all')->where('id', $mata_anggaran_id)->first()->mak;

        return $mak == in_array(substr($mak, -6), self::$akun_honor);
    }

    /**
     * Memeriksa apakah akun honor berubah dari $mak_old menjadi $mak_new.
     *
     * @param  string  $mak_old  akun sebelumnya
     * @param  string  $mak_new  akun setelahnya
     * @return bool
     */
    public static function isAkunHonorChanged($mak_old, $mak_new)
    {
        return (self::isAkunHonor($mak_old) && ! self::isAkunHonor($mak_new)) || (self::isAkunHonor($mak_old) && self::isAkunHonor($mak_new) && $mak_old != $mak_new);
    }

    /**
     * Memeriksa apakah kode akun merupakan akun persediaan.
     *
     * @param  string  $mak  Kode akun yang akan diperiksa.
     * @return bool Mengembalikan true jika kode akun merupakan akun persediaan, sebaliknya false.
     */
    public static function isAkunPersediaan(string $mata_anggaran_id): bool
    {
        $mak = MataAnggaran::cache()->get('all')->where('id', $mata_anggaran_id)->first()->mak;

        return $mak == in_array(substr($mak, -6), self::$akun_persediaan);
    }

    public static function isAkunPemeliharaan(string $mata_anggaran_id): bool
    {
        $mak = MataAnggaran::cache()->get('all')->where('id', $mata_anggaran_id)->first()->mak;

        return $mak == in_array(substr($mak, -6), self::$akun_pemeliharaan);
    }

    /**
     * Memeriksa apakah akun persediaan telah berubah.
     *
     * Fungsi ini membandingkan dua nilai akun persediaan dan menentukan apakah
     * ada perubahan antara nilai lama dan nilai baru.
     *
     * @param  string  $mak_old  Nilai akun persediaan lama.
     * @param  string  $mak_new  Nilai akun persediaan baru.
     * @return bool Mengembalikan true jika akun persediaan berubah, sebaliknya false.
     */
    public static function isAkunPersediaanChanged($mak_old, $mak_new)
    {
        return (self::isAkunPersediaan($mak_old) && ! self::isAkunPersediaan($mak_new)) || (self::isAkunPersediaan($mak_old) && self::isAkunPersediaan($mak_new) && $mak_old != $mak_new);
    }

    public static function isAkunPemeliharaanChanged($mak_old, $mak_new)
    {
        return (self::isAkunPemeliharaan($mak_old) && ! self::isAkunPemeliharaan($mak_new)) || (self::isAkunPemeliharaan($mak_old) && self::isAkunPemeliharaan($mak_new) && $mak_old != $mak_new);
    }

    /**
     * Mengambil detail akun sesuai level yang diinginkan.
     *
     * @param  string  $mak
     * @param  string  $level  default 'akun', pilihan: program, kegiatan, kro, ro, komponen, sub, akun
     * @param  bool  $kode_prefix  default true, jika true maka detail akan diawali dengan kode level yang diinginkan
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
     * Format tampilan spesifikasi.
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
     * Menghitung jumlah nilai spesifikasi.
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
     * Format tampilan anggaran.
     *
     * @param  array  $anggaran
     * @return array
     */
    public static function formatAnggaran($anggaran)
    {
        $spek = collect($anggaran);
        $spek->transform(function ($item, $index) {
            $item['mak'] = self::getPropertyFromCollection(self::getMataAnggaranById($item['mata_anggaran_id']), 'mak')."\r\n".self::getPropertyFromCollection(self::getMataAnggaranById($item['mata_anggaran_id']), 'uraian');
            $item['anggaran_no'] = $index + 1;
            $item['perkiraan'] = self::formatRupiah($item['perkiraan']);

            return $item;
        });

        return $spek->toArray();
    }

    public static function formatBarangPersediaan($bastp)
    {
        $spek = collect($bastp);
        $spek->transform(function ($item, $index) {
            $item['no'] = $index + 1;
            $item['harga_satuan'] = self::formatRupiah($item['harga_satuan']);
            $item['total_harga'] = self::formatRupiah($item['total_harga']);
            $item['kode'] = self::getPropertyFromCollection(self::getMasterPersediaanById($item['master_persediaan_id']), 'kode');

            return $item;
        });

        return $spek->toArray();
    }

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

    public static function formatDaftarPersediaan($id, $spek)
    {
        $stok = self::cekStokPersediaan($id, (session('year') - 1).'-12-31');
        $spek->transform(function ($item, $index) use (&$stok) {
            // Menambahkan nomor urut
            $item['no'] = $index + 1;

            // Mengubah tanggal transaksi menjadi tanggal buku
            $item['tanggal_buku'] = self::terbilangTanggal(
                $item['tanggal_transaksi']
            );

            // Mengambil nomor dokumen berdasarkan tipe barang persediaan
            $item['nomor_dokumen'] = match (get_class($item->barangPersediaanable)) {
                "App\Models\PembelianPersediaan" => $item->barangPersediaanable
                    ->bastNaskahKeluar->nomor,
                "App\Models\PermintaanPersediaan" => $item->barangPersediaanable
                    ->naskahKeluar->nomor,
                "App\Models\PersediaanMasuk" => $item->barangPersediaanable
                    ->naskahMasuk->nomor,
                "App\Models\PersediaanKeluar" => $item->barangPersediaanable
                    ->naskahKeluar->nomor,
            };

            // Mengambil uraian berdasarkan tipe barang persediaan
            $item['uraian'] = match (get_class($item->barangPersediaanable)) {
                "App\Models\PembelianPersediaan" => $item->barangPersediaanable
                    ->rincian,
                "App\Models\PermintaanPersediaan" => 'Permintaan Persediaan oleh '.
                  $item->barangPersediaanable->user->name.
                  ' untuk '.
                  $item->barangPersediaanable->kegiatan,
                "App\Models\PersediaanMasuk" => $item->barangPersediaanable->rincian,
                "App\Models\PersediaanKeluar" => $item->barangPersediaanable->rincian
            };

            // Menghitung volume masuk dan keluar
            $item['masuk'] = match (get_class($item->barangPersediaanable)) {
                "App\Models\PembelianPersediaan" => $item->volume,
                "App\Models\PersediaanMasuk" => $item->volume,
                default => '-'
            };

            $item['keluar'] = match (get_class($item->barangPersediaanable)) {
                "App\Models\PermintaanPersediaan" => $item->volume,
                "App\Models\PersediaanKeluar" => $item->volume,
                default => '-'
            };

            // Menghitung sisa stok
            $item['sisa'] = match (get_class($item->barangPersediaanable)) {
                "App\Models\PembelianPersediaan", "App\Models\PersediaanMasuk" => $stok +
                  $item['volume'],
                "App\Models\PermintaanPersediaan",
                "App\Models\PersediaanKeluar" => $stok - $item['volume']
            };

            // Memperbarui stok
            $stok = $item['sisa'];
            unset($item->barangPersediaanable);

            return $item;
        });

        $arrayspek = $spek->toArray();

        return empty($arrayspek) ? [['no' => 1, 'nomor_dokumen' => '-', 'tanggal_buku' => '-', 'uraian' => '-', 'masuk' => '-', 'keluar' => '-', 'sisa' => '-']] : $arrayspek;
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
            $mitra = self::getMitraById($item['mitra_id']);
            $item['nip'] = '-';
            $item['nama'] = self::getPropertyFromCollection($mitra, 'nama');
            $item['nip_lama'] = self::getPropertyFromCollection($mitra, 'nik');
            $item['rekening'] = self::getPropertyFromCollection($mitra, 'rekening');
            $item['kode_bank_id'] = self::getPropertyFromCollection($mitra, 'kode_bank_id');
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
     * Format tampilan pegawai.
     *
     * @param  \Illuminate\Support\Collection  $pegawai
     * @param  string  $tanggal_spj
     * @return \Illuminate\Support\Collection
     */
    public static function formatPegawai($pegawai, $tanggal_spj)
    {
        $pegawai->transform(function ($item, $index) use ($tanggal_spj) {
            $pegawai = self::getPegawaiByUserId($item['user_id']);
            $item['nama'] = self::getPropertyFromCollection($pegawai, 'name');
            $item['nip'] = self::getPropertyFromCollection($pegawai, 'nip');
            $item['nip_lama'] = self::getPropertyFromCollection($pegawai, 'nip_lama');
            $item['jabatan'] = self::getPropertyFromCollection(self::getDataPegawaiByUserId($item['user_id'], $tanggal_spj), 'jabatan');
            $item['rekening'] = self::getPropertyFromCollection($pegawai, 'rekening');
            $item['kode_bank_id'] = self::getPropertyFromCollection($pegawai, 'kode_bank_id');
            $item['golongan'] = self::getPropertyFromCollection(self::getDataPegawaiByUserId($item['user_id'], $tanggal_spj), 'golongan');
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

    public static function makeBaseListMitra($honor_kegiatan_id)
    {
        $mitra = DaftarHonorMitra::where('honor_kegiatan_id', $honor_kegiatan_id)->get();
        $formattedMitra = self::formatMitra($mitra);

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
                $item['rekening'] = self::getPropertyFromCollection(self::getKodeBankById($item['kode_bank_id']), 'nama_bank').' '.$item['rekening'];
                $item['netto'] = self::formatUang($item['netto']);
                $item['harga_satuan'] = self::formatUang($item['harga_satuan']);

                return $item;
            })
            ->toArray();
    }

    public static function checkEmptyRekeningOnSpjMitraAndPegawai($honor_kegiatan_id, $tanggal): bool
    {
        $list = collect(self::makeSpjMitraAndPegawai($honor_kegiatan_id, $tanggal));

        return $list->contains(fn ($value) => $value['rekening'] == ' ');
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
                $item['Benef Bank'] = Helper::getPropertyFromCollection(Helper::getKodeBankById($item['kode_bank_id']), 'kode');
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

    public static function makeKontrakMitra($kontrak_mitra_id)
    {
        return DaftarHonorMitra::where('daftar_kontrak_mitra_id', $kontrak_mitra_id)->get()
            ->transform(function ($item, $index) {
                $honor_kegiatan = HonorKegiatan::find($item['honor_kegiatan_id']);
                $mata_anggaran = self::getMataAnggaranById($honor_kegiatan->mata_anggaran_id);
                $item['spek_no'] = $index + 1;
                $item['spek_kegiatan'] = self::getPropertyFromCollection($honor_kegiatan, 'kegiatan');
                $item['spek_mak'] = self::getPropertyFromCollection($mata_anggaran, 'mak');
                $item['spek_vol'] = $item['volume_target'];
                $item['spek_vol_target'] = $item['volume_target'];
                $item['spek_vol_realisasi'] = $item['volume_realisasi'];
                $item['spek_selesai'] = $item['status_realisasi'];
                $item['spek_satuan'] = self::getPropertyFromCollection($honor_kegiatan, 'satuan');
                $item['spek_akhir'] = self::terbilangTanggal(self::getPropertyFromCollection($honor_kegiatan, 'akhir'));
                $item['spek_total'] = self::formatUang($item['volume_target'] * $item['harga_satuan']);

                return $item;
            })
            ->toArray();
    }

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
     * Get property from collection.
     *
     * @param  mixed  $collection  Eloquent collection or null
     * @param  string  $property  Property name
     * @return mixed
     */
    public static function getPropertyFromCollection($collection, $property)
    {
        return optional($collection)->$property;
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
        return self::getPropertyFromCollection(self::getLatestHargaSatuan($tanggal), 'id');
    }

    /**
     * Mengambil harga satuan terbaru berdasarkan tanggal yang diberikan.
     *
     * @param  string  $tanggal  Tanggal untuk memfilter data harga satuan.
     * @return HargaSatuan|null Objek HargaSatuan terbaru atau null jika tidak ditemukan.
     */
    public static function getLatestHargaSatuan($tanggal)
    {
        return HargaSatuan::cache()->get('all')->where('tanggal', '<=', $tanggal)->sortByDesc('tanggal')->first();
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

    public static function setOptionsKodeBank()
    {
        return self::setOptions(KodeBank::cache()->get('all'), 'id', 'nama_bank');
    }

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

    public static function hasAkun($kak_id, array $akun): bool
    {
        return KerangkaAcuan::find($kak_id)->anggaranKerangkaAcuan->contains(function ($anggaran) use ($akun) {
            return in_array(substr($anggaran->mataAnggaran->mak, 29, 6), $akun);
        });
    }

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

    public static function setDefaultTemplate($jenis)
    {
        $template = Template::cache()->get('all')->where('jenis', $jenis);

        return $template->count() == 1 ? $template->first()->id : null;
    }

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

    public static function setOptionBarangPersediaan()
    {
        return self::setOptions(MasterPersediaan::cache()->get('all'), 'id', 'barang', 'satuan');
    }

    public static function sendReminder($reminder, $method = 'auto')
    {
        $kegiatan = $reminder->daftarKegiatan;
        $hari = $kegiatan->awal->diffInDays($method === 'auto' ? $reminder->tanggal : now());
        $pesan = strtr($kegiatan->pesan, [
            '{judul}' => $hari > 0 ? '[Reminder Deadline (H-'.$hari.')]' : '[Reminder Deadline]',
            '{tanggal}' => Helper::terbilangTanggal($kegiatan->awal),
            '{kegiatan}' => $kegiatan->kegiatan,
            '{pj}' => $kegiatan->daftar_kegiatanable_type == 'App\Models\UnitKerja' ? UnitKerja::find($kegiatan->daftar_kegiatanable_id)->unit : User::find($kegiatan->daftar_kegiatanable_id)->name,
        ]);
        $response = Fonnte::make()->sendWhatsAppMessage($kegiatan->wa_group_id, $pesan);
        $reminder->status = $response['data']['process'] ?? 'Gagal';
        $reminder->message_id = $response['data']['id'][0];
        $reminder->save();
    }

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
}
