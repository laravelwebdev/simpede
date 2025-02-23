<?php

namespace App\Helpers;

class Constant
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

}
