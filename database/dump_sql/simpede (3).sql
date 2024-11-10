-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Nov 10, 2024 at 11:11 PM
-- Server version: 8.0.32
-- PHP Version: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpede`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_events`
--

CREATE TABLE `action_events` (
  `id` bigint UNSIGNED NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_id` bigint UNSIGNED NOT NULL,
  `target_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED DEFAULT NULL,
  `fields` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'running',
  `exception` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `original` mediumtext COLLATE utf8mb4_unicode_ci,
  `changes` mediumtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `action_events`
--

INSERT INTO `action_events` (`id`, `batch_id`, `user_id`, `name`, `actionable_type`, `actionable_id`, `target_type`, `target_id`, `model_type`, `model_id`, `fields`, `status`, `exception`, `created_at`, `updated_at`, `original`, `changes`) VALUES
(1, '9d554bfb-fe1f-43f9-a8ce-3b878e50735d', 1, 'Create', 'App\\Models\\KerangkaAcuan', 1, 'App\\Models\\KerangkaAcuan', 1, 'App\\Models\\KerangkaAcuan', 1, '', 'finished', '', '2024-10-26 06:52:05', '2024-10-26 06:52:05', NULL, '{\"tanggal\":\"2024-10-25T16:00:00.000000Z\",\"rincian\":\"embayaran Biaya Perjalanan Dinas dalam rangka... Pengadaan Perlengkapan....\",\"latar\":\"Kegiatan PLKUMKM merupakan salah satu kegiatan yang dilakukan oleh Badan Pusat Statistik dalam rangka mendukung penyediaan Data Statistik sesuai amanat Undang-Undang no 16 Tahun 1997. Agar kegiatan tersebut dapat berjalan dengan lancar dan tepat waktu diperlukan adanya penyediaan ATK Pelatihan Petugas PLKUMKM sebagai sarana penunjang kegiatan yang dilaksanakan.\",\"maksud\":\"Maksud dari pelaksanaan kegiatan ini adalah untuk\",\"tujuan\":\"Tujuan dari pelaksanaan kegiatan ini adalah\",\"sasaran\":\"Target\\/sasaran yang ingin dicapai terkait dengan pelaksanaan kegiatan ini adalah\",\"kegiatan\":\"Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024\",\"awal\":\"2024-10-25T16:00:00.000000Z\",\"akhir\":\"2024-10-25T16:00:00.000000Z\",\"jenis\":\"Swakelola\",\"koordinator_user_id\":\"1\",\"ppk_user_id\":\"13\",\"dipa_id\":\"1\",\"metode\":\"-\",\"tkdn\":\"-\",\"unit_kerja_id\":1,\"status\":\"dibuat\",\"naskah_keluar_id\":1,\"updated_at\":\"2024-10-25T22:52:05.000000Z\",\"created_at\":\"2024-10-25T22:52:05.000000Z\",\"id\":1}'),
(2, '9d554c0f-2087-4b69-86a7-7a60619aa741', 1, 'Update', 'App\\Models\\KerangkaAcuan', 1, 'App\\Models\\KerangkaAcuan', 1, 'App\\Models\\KerangkaAcuan', 1, '', 'finished', '', '2024-10-26 06:52:18', '2024-10-26 06:52:18', '{\"rincian\":\"embayaran Biaya Perjalanan Dinas dalam rangka... Pengadaan Perlengkapan....\"}', '{\"rincian\":\"Pembayaran Biaya Perjalanan Dinas dalam rangka... Pengadaan Perlengkapan....\"}'),
(3, '9d554c5d-2429-4a70-b6db-e5f5f2f38acd', 1, 'Unduh KAK', 'App\\Models\\KerangkaAcuan', 1, 'App\\Models\\KerangkaAcuan', 1, 'App\\Models\\KerangkaAcuan', 1, 'a:2:{s:8:\"filename\";s:13:\"671c212379bf4\";s:8:\"template\";s:1:\"3\";}', 'finished', '', '2024-10-26 06:53:09', '2024-10-26 06:53:09', NULL, NULL),
(5, '9d554cb5-6223-42eb-8074-73ddef80c0e7', 1, 'Update', 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, '', 'finished', '', '2024-10-26 06:54:07', '2024-10-26 06:54:07', '{\"tanggal_kak\":\"2024-10-25T16:00:00.000000Z\",\"satuan\":null,\"generate_sk\":1,\"generate_st\":1,\"jenis_honor\":null,\"bulan\":null,\"jenis_kontrak_id\":null,\"kamus_anggaran_id\":null,\"koordinator_user_id\":null,\"ppk_user_id\":null,\"kepala_user_id\":null,\"kpa_user_id\":null,\"bendahara_user_id\":null,\"sk_kode_arsip_id\":null,\"st_kode_arsip_id\":null}', '{\"tanggal_kak\":\"2024-10-25 16:00:00\",\"satuan\":\"DOK\",\"generate_sk\":true,\"generate_st\":true,\"jenis_honor\":\"Kontrak Mitra Bulanan\",\"bulan\":\"11\",\"jenis_kontrak_id\":\"1\",\"kamus_anggaran_id\":\"49\",\"koordinator_user_id\":\"1\",\"ppk_user_id\":\"13\",\"kepala_user_id\":\"22\",\"kpa_user_id\":\"22\",\"bendahara_user_id\":\"16\",\"sk_kode_arsip_id\":\"28\",\"st_kode_arsip_id\":\"28\"}'),
(6, '9d554cc3-a210-4479-877b-268f663a7e1f', 1, 'Unduh Surat Tugas', 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'a:2:{s:8:\"filename\";s:13:\"671c2190bb23c\";s:8:\"template\";s:1:\"7\";}', 'finished', '', '2024-10-26 06:54:16', '2024-10-26 06:54:16', NULL, NULL),
(7, '9d554d81-d803-45f0-a751-020c8393ae0d', 1, 'Create', 'App\\Models\\DaftarHonorPegawai', 1, 'App\\Models\\DaftarHonorPegawai', 1, 'App\\Models\\DaftarHonorPegawai', 1, '', 'finished', '', '2024-10-26 06:56:21', '2024-10-26 06:56:21', NULL, '{\"user_id\":\"1\",\"volume\":null,\"harga_satuan\":null,\"persen_pajak\":\"5\",\"honor_kegiatan_id\":1,\"updated_at\":\"2024-10-25T22:56:21.000000Z\",\"created_at\":\"2024-10-25T22:56:21.000000Z\",\"id\":1}'),
(8, '9d554d8a-89df-457c-87a7-2f72058cb04c', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'a:2:{s:8:\"filename\";s:13:\"671c22167e6d5\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-10-26 06:56:27', '2024-10-26 06:56:28', NULL, NULL),
(9, '9d554db0-15dd-4976-ac30-8fcc3ea23dd0', 1, 'Unduh Surat Tugas', 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'a:2:{s:8:\"filename\";s:13:\"671c221ca8760\";s:8:\"template\";s:1:\"7\";}', 'finished', '', '2024-10-26 06:56:51', '2024-10-26 06:56:51', NULL, NULL),
(10, '9d554dd1-a88a-4d77-95e2-0505cc0830cb', 1, 'Unduh SK', 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'a:2:{s:8:\"filename\";s:13:\"671c22346be31\";s:8:\"template\";s:1:\"5\";}', 'finished', '', '2024-10-26 06:57:13', '2024-10-26 06:57:13', NULL, NULL),
(11, '9d55569f-71aa-40d8-b658-41ec11e27a28', 1, 'Create', 'App\\Models\\KerangkaAcuan', 2, 'App\\Models\\KerangkaAcuan', 2, 'App\\Models\\KerangkaAcuan', 2, '', 'finished', '', '2024-10-26 07:21:50', '2024-10-26 07:21:50', NULL, '{\"tanggal\":\"2024-10-25T16:00:00.000000Z\",\"rincian\":\"Pembayaran Biaya Perjalanan Dinas dalam rangka... Pengadaan Perlengkapan....\",\"latar\":\"Kegiatan PLKUMKM merupakan salah satu kegiatan yang dilakukan oleh Badan Pusat Statistik dalam rangka mendukung penyediaan Data Statistik sesuai amanat Undang-Undang no 16 Tahun 1997. Agar kegiatan tersebut dapat berjalan dengan lancar dan tepat waktu diperlukan adanya penyediaan ATK Pelatihan Petugas PLKUMKM sebagai sarana penunjang kegiatan yang dilaksanakan.\",\"maksud\":\"Maksud dari pelaksanaan kegiatan ini adalah untuk\",\"tujuan\":\"Tujuan dari pelaksanaan kegiatan ini adalah\",\"sasaran\":\"Target\\/sasaran yang ingin dicapai terkait dengan pelaksanaan kegiatan ini adalah\",\"kegiatan\":\"Pengolahan Lapangan Survei Sosial Ekonomi Nasional Maret 2024\",\"awal\":\"2024-10-25T16:00:00.000000Z\",\"akhir\":\"2024-10-25T16:00:00.000000Z\",\"jenis\":\"Swakelola\",\"koordinator_user_id\":\"1\",\"ppk_user_id\":\"13\",\"dipa_id\":\"1\",\"metode\":\"-\",\"tkdn\":\"-\",\"unit_kerja_id\":1,\"status\":\"dibuat\",\"naskah_keluar_id\":4,\"updated_at\":\"2024-10-25T23:21:50.000000Z\",\"created_at\":\"2024-10-25T23:21:50.000000Z\",\"id\":2}'),
(12, '9d555762-7573-41cb-ab0e-8b98b8da1261', 1, 'Update', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, '', 'finished', '', '2024-10-26 07:23:58', '2024-10-26 07:23:58', '{\"tanggal_kak\":\"2024-10-25T16:00:00.000000Z\",\"satuan\":null,\"generate_sk\":1,\"generate_st\":1,\"jenis_honor\":null,\"bulan\":null,\"jenis_kontrak_id\":null,\"kamus_anggaran_id\":null,\"koordinator_user_id\":null,\"ppk_user_id\":null,\"kepala_user_id\":null,\"kpa_user_id\":null,\"bendahara_user_id\":null,\"sk_kode_arsip_id\":null,\"st_kode_arsip_id\":null}', '{\"tanggal_kak\":\"2024-10-25 16:00:00\",\"satuan\":\"DOK\",\"generate_sk\":true,\"generate_st\":true,\"jenis_honor\":\"Kontrak Mitra Bulanan\",\"bulan\":\"12\",\"jenis_kontrak_id\":\"2\",\"kamus_anggaran_id\":\"50\",\"koordinator_user_id\":\"1\",\"ppk_user_id\":\"13\",\"kepala_user_id\":\"22\",\"kpa_user_id\":\"22\",\"bendahara_user_id\":\"16\",\"sk_kode_arsip_id\":\"34\",\"st_kode_arsip_id\":\"34\"}'),
(13, '9d555d16-09b3-43fd-95aa-8036a301d9be', 1, 'Create', 'App\\Models\\DaftarHonorPegawai', 2, 'App\\Models\\DaftarHonorPegawai', 2, 'App\\Models\\DaftarHonorPegawai', 2, '', 'finished', '', '2024-10-26 07:39:55', '2024-10-26 07:39:55', NULL, '{\"user_id\":\"15\",\"volume\":null,\"harga_satuan\":null,\"honor_kegiatan_id\":2,\"updated_at\":\"2024-10-25T23:39:55.000000Z\",\"created_at\":\"2024-10-25T23:39:55.000000Z\",\"id\":2}'),
(14, '9d555d93-0909-477e-ac79-ab640ebceaa5', 1, 'Create', 'App\\Models\\DaftarHonorPegawai', 3, 'App\\Models\\DaftarHonorPegawai', 3, 'App\\Models\\DaftarHonorPegawai', 3, '', 'finished', '', '2024-10-26 07:41:16', '2024-10-26 07:41:16', NULL, '{\"user_id\":\"4\",\"volume\":null,\"harga_satuan\":null,\"honor_kegiatan_id\":2,\"updated_at\":\"2024-10-25T23:41:16.000000Z\",\"created_at\":\"2024-10-25T23:41:16.000000Z\",\"id\":3}'),
(15, '9d555e54-d4fc-4afd-8576-9ee903e91e73', 1, 'Create', 'App\\Models\\DaftarHonorPegawai', 4, 'App\\Models\\DaftarHonorPegawai', 4, 'App\\Models\\DaftarHonorPegawai', 4, '', 'finished', '', '2024-10-26 07:43:23', '2024-10-26 07:43:23', NULL, '{\"user_id\":\"6\",\"volume\":\"1\",\"harga_satuan\":\"20000\",\"persen_pajak\":\"5\",\"honor_kegiatan_id\":2,\"updated_at\":\"2024-10-25T23:43:23.000000Z\",\"created_at\":\"2024-10-25T23:43:23.000000Z\",\"id\":4}'),
(16, '9d555e62-0a16-4141-bf8a-5d809faaba8c', 1, 'Update', 'App\\Models\\DaftarHonorPegawai', 4, 'App\\Models\\DaftarHonorPegawai', 4, 'App\\Models\\DaftarHonorPegawai', 4, '', 'finished', '', '2024-10-26 07:43:32', '2024-10-26 07:43:32', '{\"volume\":1,\"harga_satuan\":20000}', '{\"volume\":null,\"harga_satuan\":null}'),
(17, '9d556133-903e-4d88-b891-311afb88725c', 1, 'Update', 'App\\Models\\DaftarHonorPegawai', 3, 'App\\Models\\DaftarHonorPegawai', 3, 'App\\Models\\DaftarHonorPegawai', 3, '', 'finished', '', '2024-10-26 07:51:25', '2024-10-26 07:51:25', '[]', '[]'),
(18, '9d556156-4749-44b5-b327-0a178e185f52', 1, 'Update', 'App\\Models\\DaftarHonorPegawai', 3, 'App\\Models\\DaftarHonorPegawai', 3, 'App\\Models\\DaftarHonorPegawai', 3, '', 'finished', '', '2024-10-26 07:51:48', '2024-10-26 07:51:48', '[]', '[]'),
(19, '9d5561b2-7177-4dc5-959b-01c8421dbcf2', 1, 'Update', 'App\\Models\\DaftarHonorPegawai', 4, 'App\\Models\\DaftarHonorPegawai', 4, 'App\\Models\\DaftarHonorPegawai', 4, '', 'finished', '', '2024-10-26 07:52:48', '2024-10-26 07:52:48', '[]', '[]'),
(20, '9d562da7-cdb4-4984-a033-606558ef5811', 1, 'Update', 'App\\Models\\KontrakMitra', 2, 'App\\Models\\KontrakMitra', 2, 'App\\Models\\KontrakMitra', 2, '', 'finished', '', '2024-10-26 17:23:07', '2024-10-26 17:23:07', '{\"tanggal_spk\":null,\"ppk_user_id\":null,\"kode_arsip_id\":null}', '{\"tanggal_spk\":\"2024-10-26 00:00:00\",\"ppk_user_id\":\"13\",\"kode_arsip_id\":\"28\"}'),
(21, '9d562db0-a3dd-4e17-b211-0e7e035ff802', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 2, 'App\\Models\\KontrakMitra', 2, 'App\\Models\\KontrakMitra', 2, 'a:0:{}', 'finished', '', '2024-10-26 17:23:12', '2024-10-26 17:23:13', NULL, NULL),
(22, '9d563564-1c38-4066-95eb-8ae6984db625', 1, 'Create', 'App\\Models\\KerangkaAcuan', 3, 'App\\Models\\KerangkaAcuan', 3, 'App\\Models\\KerangkaAcuan', 3, '', 'finished', '', '2024-10-26 17:44:45', '2024-10-26 17:44:45', NULL, '{\"tanggal\":\"2024-10-25T16:00:00.000000Z\",\"rincian\":\"Pembayaran Biaya Perjalanan Dinas dalam rangka... Pengadaan Perlengkapan....\",\"latar\":\"Kegiatan PLKUMKM merupakan salah satu kegiatan yang dilakukan oleh Badan Pusat Statistik dalam rangka mendukung penyediaan Data Statistik sesuai amanat Undang-Undang no 16 Tahun 1997. Agar kegiatan tersebut dapat berjalan dengan lancar dan tepat waktu diperlukan adanya penyediaan ATK Pelatihan Petugas PLKUMKM sebagai sarana penunjang kegiatan yang dilaksanakan.\",\"maksud\":\"Maksud dari pelaksanaan kegiatan ini adalah untuk\",\"tujuan\":\"Tujuan dari pelaksanaan kegiatan ini adalah\",\"sasaran\":\"Target\\/sasaran yang ingin dicapai terkait dengan pelaksanaan kegiatan ini adalah\",\"kegiatan\":\"Pengolahan Lapangan Survei Sosial Ekonomi Nasional Maret 2024\",\"awal\":\"2024-10-31T16:00:00.000000Z\",\"akhir\":\"2024-11-29T16:00:00.000000Z\",\"jenis\":\"Swakelola\",\"koordinator_user_id\":\"1\",\"ppk_user_id\":\"13\",\"dipa_id\":\"1\",\"metode\":\"-\",\"tkdn\":\"-\",\"unit_kerja_id\":1,\"status\":\"dibuat\",\"naskah_keluar_id\":9,\"updated_at\":\"2024-10-26T09:44:44.000000Z\",\"created_at\":\"2024-10-26T09:44:44.000000Z\",\"id\":3}'),
(23, '9d563aff-5e68-464f-94c7-ce20a2ff12d7', 1, 'Edit Target', 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'a:1:{s:6:\"target\";s:1:\"1\";}', 'finished', '', '2024-10-26 18:00:25', '2024-10-26 18:00:25', NULL, NULL),
(24, '9d563ba8-4716-4fe0-966a-7d35f419d1e9', 1, 'Edit Target', 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'a:1:{s:6:\"target\";s:1:\"2\";}', 'finished', '', '2024-10-26 18:02:16', '2024-10-26 18:02:16', NULL, NULL),
(25, '9d563bb2-ccfa-4c1e-8c02-637821999aef', 1, 'Edit Target', 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'a:1:{s:6:\"target\";s:1:\"1\";}', 'finished', '', '2024-10-26 18:02:23', '2024-10-26 18:02:23', NULL, NULL),
(26, '9d563beb-56fa-49ab-9631-89818937d713', 1, 'Edit Target', 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'a:1:{s:6:\"target\";s:1:\"1\";}', 'finished', '', '2024-10-26 18:03:00', '2024-10-26 18:03:00', NULL, NULL),
(27, '9d563c91-34b2-4103-bc85-68e99bafd75d', 1, 'Edit Target', 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'a:1:{s:6:\"target\";s:1:\"1\";}', 'finished', '', '2024-10-26 18:04:48', '2024-10-26 18:04:49', NULL, NULL),
(28, '9d563c99-e593-4778-a2e8-d9d5648a003f', 1, 'Edit Target', 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'a:1:{s:6:\"target\";s:1:\"2\";}', 'finished', '', '2024-10-26 18:04:54', '2024-10-26 18:04:54', NULL, NULL),
(29, '9d563ca8-d101-4c6b-854c-4ec628a6a14b', 1, 'Edit Target', 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'a:1:{s:6:\"target\";s:1:\"0\";}', 'finished', '', '2024-10-26 18:05:04', '2024-10-26 18:05:04', NULL, NULL),
(30, '9d563cbf-11b2-47e1-aff7-b870b027b5a4', 1, 'Edit Target', 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'App\\Models\\DaftarHonorMitra', 4, 'a:1:{s:6:\"target\";s:1:\"1\";}', 'finished', '', '2024-10-26 18:05:19', '2024-10-26 18:05:19', NULL, NULL),
(31, '9d5648d3-863d-4070-9d92-955fea0ec9b4', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'a:2:{s:8:\"filename\";s:13:\"671cc68b52b78\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-10-26 18:39:05', '2024-10-26 18:39:06', NULL, NULL),
(32, '9d564ab2-47c3-40ac-a7f6-abd38da322d6', 1, 'Unduh SK', 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'a:2:{s:8:\"filename\";s:13:\"671cc6cb540da\";s:8:\"template\";s:1:\"5\";}', 'finished', '', '2024-10-26 18:44:19', '2024-10-26 18:44:19', NULL, NULL),
(33, '9d564aca-15bd-4129-8a10-47bc6c6b2239', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'a:2:{s:8:\"filename\";s:13:\"671cc8045a7fc\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-10-26 18:44:35', '2024-10-26 18:44:36', NULL, NULL),
(34, '9d564b38-cd6d-4cef-92eb-7b1ff9685242', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'App\\Models\\HonorKegiatan', 1, 'a:2:{s:8:\"filename\";s:13:\"671cc814aafe1\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-10-26 18:45:47', '2024-10-26 18:45:48', NULL, NULL),
(35, '9d568efc-ff08-4664-b523-f707dd639707', 1, 'Update', 'App\\Models\\DaftarHonorMitra', 36, 'App\\Models\\DaftarHonorMitra', 36, 'App\\Models\\DaftarHonorMitra', 36, '', 'finished', '', '2024-10-26 21:55:16', '2024-10-26 21:55:16', '{\"volume_target\":10,\"volume_realisasi\":10}', '{\"volume_target\":\"5\",\"volume_realisasi\":\"5\"}'),
(36, '9d568f54-8370-4ca2-9073-3ddd4497c453', 1, 'Update', 'App\\Models\\DaftarHonorMitra', 36, 'App\\Models\\DaftarHonorMitra', 36, 'App\\Models\\DaftarHonorMitra', 36, '', 'finished', '', '2024-10-26 21:56:14', '2024-10-26 21:56:14', '{\"volume_target\":5,\"volume_realisasi\":5}', '{\"volume_target\":\"8\",\"volume_realisasi\":\"8\"}'),
(37, '9d5690c6-daa6-4b8c-b920-93a06b301184', 1, 'Update', 'App\\Models\\DaftarHonorMitra', 36, 'App\\Models\\DaftarHonorMitra', 36, 'App\\Models\\DaftarHonorMitra', 36, '', 'finished', '', '2024-10-26 22:00:17', '2024-10-26 22:00:17', '{\"volume_realisasi\":3}', '{\"volume_realisasi\":\"2\"}'),
(38, '9d56919e-89d7-4849-a449-03d3ac70bd36', 1, 'Create', 'App\\Models\\DaftarHonorPegawai', 5, 'App\\Models\\DaftarHonorPegawai', 5, 'App\\Models\\DaftarHonorPegawai', 5, '', 'finished', '', '2024-10-26 22:02:38', '2024-10-26 22:02:38', NULL, '{\"user_id\":\"3\",\"volume\":\"1\",\"harga_satuan\":\"100000\",\"persen_pajak\":\"5\",\"honor_kegiatan_id\":3,\"updated_at\":\"2024-10-26T14:02:38.000000Z\",\"created_at\":\"2024-10-26T14:02:38.000000Z\",\"id\":5}'),
(39, '9d5691fa-8565-471c-9b98-5a139a454ac3', 1, 'Create', 'App\\Models\\DaftarHonorPegawai', 6, 'App\\Models\\DaftarHonorPegawai', 6, 'App\\Models\\DaftarHonorPegawai', 6, '', 'finished', '', '2024-10-26 22:03:38', '2024-10-26 22:03:38', NULL, '{\"user_id\":\"5\",\"volume\":null,\"harga_satuan\":null,\"honor_kegiatan_id\":3,\"persen_pajak\":null,\"updated_at\":\"2024-10-26T14:03:38.000000Z\",\"created_at\":\"2024-10-26T14:03:38.000000Z\",\"id\":6}'),
(40, '9d569403-bf62-4b11-b2a8-e86eeb696108', 1, 'Create', 'App\\Models\\DaftarHonorPegawai', 7, 'App\\Models\\DaftarHonorPegawai', 7, 'App\\Models\\DaftarHonorPegawai', 7, '', 'finished', '', '2024-10-26 22:09:20', '2024-10-26 22:09:20', NULL, '{\"user_id\":\"1\",\"volume\":null,\"harga_satuan\":null,\"honor_kegiatan_id\":3,\"persen_pajak\":null,\"updated_at\":\"2024-10-26T14:09:20.000000Z\",\"created_at\":\"2024-10-26T14:09:20.000000Z\",\"id\":7}'),
(42, '9d56aaa5-9651-4afc-a1cf-2e071e3db535', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 3, 'App\\Models\\HonorKegiatan', 3, 'App\\Models\\HonorKegiatan', 3, 'a:1:{s:8:\"filename\";s:13:\"671d06ddd9679\";}', 'finished', '', '2024-10-26 23:12:37', '2024-10-26 23:12:38', NULL, NULL),
(43, '9d56aae8-1013-4785-bc6e-fb630ee64736', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 3, 'App\\Models\\HonorKegiatan', 3, 'App\\Models\\HonorKegiatan', 3, 'a:1:{s:8:\"filename\";s:13:\"671d06ddd9679\";}', 'finished', '', '2024-10-26 23:13:20', '2024-10-26 23:13:22', NULL, NULL),
(44, '9d56ad17-f69d-4436-9852-77dbcf13f3e9', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 3, 'App\\Models\\HonorKegiatan', 3, 'App\\Models\\HonorKegiatan', 3, 'a:1:{s:8:\"filename\";s:13:\"671d087b7629a\";}', 'finished', '', '2024-10-26 23:19:27', '2024-10-26 23:19:29', NULL, NULL),
(45, '9d56ad99-f724-4de2-a025-36b36185a7b8', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 3, 'App\\Models\\HonorKegiatan', 3, 'App\\Models\\HonorKegiatan', 3, 'a:1:{s:8:\"filename\";s:13:\"671d08d16c0af\";}', 'finished', '', '2024-10-26 23:20:52', '2024-10-26 23:20:54', NULL, NULL),
(46, '9d56adc5-ae7c-491c-8ea3-6b5ab51383b7', 1, 'Update', 'App\\Models\\DaftarHonorPegawai', 5, 'App\\Models\\DaftarHonorPegawai', 5, 'App\\Models\\DaftarHonorPegawai', 5, '', 'finished', '', '2024-10-26 23:21:21', '2024-10-26 23:21:21', '{\"volume\":1,\"harga_satuan\":100000}', '{\"volume\":null,\"harga_satuan\":null}'),
(47, '9d56add8-efaf-4ec3-a1b7-a71a695cfe30', 1, 'Update', 'App\\Models\\DaftarHonorPegawai', 7, 'App\\Models\\DaftarHonorPegawai', 7, 'App\\Models\\DaftarHonorPegawai', 7, '', 'finished', '', '2024-10-26 23:21:34', '2024-10-26 23:21:34', '{\"volume\":null,\"harga_satuan\":null,\"persen_pajak\":null}', '{\"volume\":\"1\",\"harga_satuan\":\"100000\",\"persen_pajak\":\"5\"}'),
(48, '9d56ade0-1262-4481-97a4-55eef259b3d1', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 3, 'App\\Models\\HonorKegiatan', 3, 'App\\Models\\HonorKegiatan', 3, 'a:1:{s:8:\"filename\";s:13:\"671d08ff5232c\";}', 'finished', '', '2024-10-26 23:21:38', '2024-10-26 23:21:40', NULL, NULL),
(49, '9d56ae9a-e9d7-4a90-85fd-115b76969fa1', 1, 'Update', 'App\\Models\\User', 1, 'App\\Models\\User', 1, 'App\\Models\\User', 1, '', 'finished', '', '2024-10-26 23:23:41', '2024-10-26 23:23:41', '{\"nip_lama\":null}', '{\"nip_lama\":\"340053819\"}'),
(50, '9d56aeb5-a1c8-4ff6-894a-070d6e0d553d', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 3, 'App\\Models\\HonorKegiatan', 3, 'App\\Models\\HonorKegiatan', 3, 'a:1:{s:8:\"filename\";s:13:\"671d0988d7297\";}', 'finished', '', '2024-10-26 23:23:58', '2024-10-26 23:24:00', NULL, NULL),
(52, '9d572fd3-a1bb-41e4-b856-1cd8ab792bb3', 1, 'Create', 'App\\Models\\KerangkaAcuan', 4, 'App\\Models\\KerangkaAcuan', 4, 'App\\Models\\KerangkaAcuan', 4, '', 'finished', '', '2024-10-27 05:25:01', '2024-10-27 05:25:01', NULL, '{\"tanggal\":\"2024-10-26T16:00:00.000000Z\",\"rincian\":\"Pembayaran Biaya Perjalanan Dinas dalam rangka... Pengadaan Perlengkapan....\",\"latar\":\"Kegiatan PLKUMKM merupakan salah satu kegiatan yang dilakukan oleh Badan Pusat Statistik dalam rangka mendukung penyediaan Data Statistik sesuai amanat Undang-Undang no 16 Tahun 1997. Agar kegiatan tersebut dapat berjalan dengan lancar dan tepat waktu diperlukan adanya penyediaan ATK Pelatihan Petugas PLKUMKM sebagai sarana penunjang kegiatan yang dilaksanakan.\",\"maksud\":\"Maksud dari pelaksanaan kegiatan ini adalah untuk\",\"tujuan\":\"Tujuan dari pelaksanaan kegiatan ini adalah\",\"sasaran\":\"Target\\/sasaran yang ingin dicapai terkait dengan pelaksanaan kegiatan ini adalah\",\"kegiatan\":\"Pengolahan Lapangan Survei Sosial Ekonomi Nasional Maret 2024\",\"awal\":\"2024-10-26T16:00:00.000000Z\",\"akhir\":\"2024-10-26T16:00:00.000000Z\",\"jenis\":\"Swakelola\",\"koordinator_user_id\":\"1\",\"ppk_user_id\":\"13\",\"dipa_id\":\"1\",\"metode\":\"-\",\"tkdn\":\"-\",\"unit_kerja_id\":1,\"status\":\"dibuat\",\"naskah_keluar_id\":10,\"updated_at\":\"2024-10-26T21:25:01.000000Z\",\"created_at\":\"2024-10-26T21:25:01.000000Z\",\"id\":4}'),
(57, '9d5730e1-5194-4569-86c3-7f91410bb033', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 4, 'App\\Models\\HonorKegiatan', 4, 'App\\Models\\HonorKegiatan', 4, 'a:1:{s:8:\"filename\";s:13:\"671d5e3dbcac1\";}', 'finished', '', '2024-10-27 05:27:57', '2024-10-27 05:27:57', NULL, NULL),
(61, '9d573ac7-516a-446b-864e-0b2fc047de55', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 3, 'App\\Models\\HonorKegiatan', 3, 'App\\Models\\HonorKegiatan', 3, 'a:1:{s:8:\"filename\";s:13:\"671d654bc8fe7\";}', 'finished', '', '2024-10-27 05:55:38', '2024-10-27 05:55:40', NULL, NULL),
(62, '9d573d1a-edfd-43df-b8a6-f0d967b35977', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:1:{s:8:\"filename\";s:13:\"671d66db11333\";}', 'finished', '', '2024-10-27 06:02:08', '2024-10-27 06:02:10', NULL, NULL),
(63, '9d573d9d-3ef0-450b-a702-cc54843aa59f', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:1:{s:8:\"filename\";s:13:\"671d66e310432\";}', 'finished', '', '2024-10-27 06:03:34', '2024-10-27 06:03:35', NULL, NULL),
(64, '9d573e33-14ec-473a-956b-4a5f7bdfb295', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:1:{s:8:\"filename\";s:13:\"671d6794cef25\";}', 'finished', '', '2024-10-27 06:05:12', '2024-10-27 06:05:14', NULL, NULL),
(65, '9d57410a-bacd-4b70-bd24-958c2d2273a2', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:1:{s:8:\"filename\";s:13:\"671d68c3679f5\";}', 'finished', '', '2024-10-27 06:13:09', '2024-10-27 06:13:10', NULL, NULL),
(66, '9d57413c-064f-45a4-b8ac-9818df337581', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:1:{s:8:\"filename\";s:13:\"671d698ed1306\";}', 'finished', '', '2024-10-27 06:13:41', '2024-10-27 06:13:43', NULL, NULL),
(67, '9d5741dd-b76f-4c4b-a8d9-25ae71676da9', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:1:{s:8:\"filename\";s:13:\"671d69fa3c8a3\";}', 'finished', '', '2024-10-27 06:15:27', '2024-10-27 06:15:29', NULL, NULL),
(68, '9d574267-2a44-4cf8-a88e-50ceeed87ce5', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:1:{s:8:\"filename\";s:13:\"671d6a50d403b\";}', 'finished', '', '2024-10-27 06:16:57', '2024-10-27 06:16:59', NULL, NULL),
(69, '9d574366-8f72-4cd8-9f4a-ce2241e2dff0', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:1:{s:8:\"filename\";s:13:\"671d6a5c2b405\";}', 'finished', '', '2024-10-27 06:19:45', '2024-10-27 06:19:46', NULL, NULL),
(70, '9d5743ae-b0d4-40be-b4df-86820e5a6ce5', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:1:{s:8:\"filename\";s:13:\"671d6b037ceb8\";}', 'finished', '', '2024-10-27 06:20:32', '2024-10-27 06:20:34', NULL, NULL),
(71, '9d574409-af63-4aaa-b8de-7fb212a00a77', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:0:{}', 'finished', '', '2024-10-27 06:21:32', '2024-10-27 06:21:33', NULL, NULL),
(72, '9d574450-41b0-40b1-821b-b5a166e019a7', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:0:{}', 'finished', '', '2024-10-27 06:22:18', '2024-10-27 06:22:19', NULL, NULL),
(73, '9d57452a-ac5f-401a-a0a4-05d82cb0c8aa', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:0:{}', 'finished', '', '2024-10-27 06:24:41', '2024-10-27 06:24:42', NULL, NULL),
(74, '9d57471d-4f48-4524-ad65-b7ec5cd82337', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:1:{s:8:\"filename\";s:13:\"671d6d6c8d172\";}', 'finished', '', '2024-10-27 06:30:08', '2024-10-27 06:30:09', NULL, NULL),
(75, '9d574876-64e7-4d99-aeec-176da97e1544', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:1:{s:8:\"filename\";s:13:\"671d6e4ecf0ce\";}', 'finished', '', '2024-10-27 06:33:54', '2024-10-27 06:33:55', NULL, NULL),
(76, '9d574afb-8ffd-4e14-92fc-d6c1e8b6ac6e', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:3:{s:4:\"awal\";s:1:\"2\";s:5:\"akhir\";s:1:\"4\";s:8:\"filename\";s:13:\"671d6fe921cba\";}', 'finished', '', '2024-10-27 06:40:57', '2024-10-27 06:40:58', NULL, NULL),
(77, '9d574cef-bbec-4705-b31e-6d49b30922cc', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:1:{s:8:\"filename\";s:13:\"671d713dad250\";}', 'finished', '', '2024-10-27 06:46:24', '2024-10-27 06:46:26', NULL, NULL),
(78, '9d574d1b-3161-468f-9a6c-c6d5af83a632', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:1:{s:8:\"filename\";s:13:\"671d715a10cbe\";}', 'finished', '', '2024-10-27 06:46:53', '2024-10-27 06:46:55', NULL, NULL),
(79, '9d574dbd-0bd4-4e7d-a445-85d05efd4dfa', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:1:{s:8:\"filename\";s:13:\"671d71c46e10d\";}', 'finished', '', '2024-10-27 06:48:39', '2024-10-27 06:48:41', NULL, NULL),
(80, '9d574ec8-a3dc-453f-b26b-b5a3764a63e7', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:3:{s:4:\"awal\";N;s:5:\"akhir\";N;s:8:\"filename\";s:13:\"671d7271e3112\";}', 'finished', '', '2024-10-27 06:51:34', '2024-10-27 06:51:36', NULL, NULL),
(81, '9d574eee-2a37-4ce6-bf50-7d8578b76206', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:3:{s:4:\"awal\";s:1:\"3\";s:5:\"akhir\";s:1:\"4\";s:8:\"filename\";s:13:\"671d7279649a1\";}', 'finished', '', '2024-10-27 06:51:59', '2024-10-27 06:52:01', NULL, NULL),
(82, '9d5753a2-50cd-444b-a45a-aa449b59b05b', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:0:{}', 'finished', '', '2024-10-27 07:05:08', '2024-10-27 07:05:10', NULL, NULL),
(83, '9d5756c1-34da-4254-87eb-30fa79084f17', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:3:{s:4:\"awal\";s:1:\"2\";s:5:\"akhir\";s:1:\"2\";s:8:\"filename\";s:13:\"671d77a93493e\";}', 'finished', '', '2024-10-27 07:13:52', '2024-10-27 07:13:53', NULL, NULL),
(84, '9d5756ea-e5cf-40b1-8e60-85ddc926a76b', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:3:{s:4:\"awal\";s:1:\"2\";s:5:\"akhir\";s:1:\"3\";s:8:\"filename\";s:13:\"671d77c52b323\";}', 'finished', '', '2024-10-27 07:14:19', '2024-10-27 07:14:22', NULL, NULL),
(85, '9d57582c-8ed1-42b8-9f05-875ff68e76a4', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'App\\Models\\HonorKegiatan', 2, 'a:3:{s:4:\"awal\";s:1:\"2\";s:5:\"akhir\";s:1:\"2\";s:8:\"filename\";s:13:\"671d77cf1fa6d\";}', 'finished', '', '2024-10-27 07:17:50', '2024-10-27 07:17:52', NULL, NULL),
(86, '9d5a6c93-7c33-4a67-98cd-68eb68aef421', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 2, 'App\\Models\\KontrakMitra', 2, 'App\\Models\\KontrakMitra', 2, 'a:0:{}', 'finished', '', '2024-10-28 20:02:22', '2024-10-28 20:02:24', NULL, NULL),
(87, '9d5a749a-a848-4f19-9b0b-a21805306b59', 1, 'Create', 'App\\Models\\Template', 8, 'App\\Models\\Template', 8, 'App\\Models\\Template', 8, '', 'finished', '', '2024-10-28 20:24:49', '2024-10-28 20:24:49', NULL, '{\"nama\":\"Kontrak Bulanan Mitra\",\"jenis\":\"kontrak\",\"file\":\"NMkRjA9CIjEGH6Otv1VdnDL1dt2tQFY4dXm0W8Sg.docx\",\"updated_at\":\"2024-10-28T12:24:49.000000Z\",\"created_at\":\"2024-10-28T12:24:49.000000Z\",\"id\":8}'),
(94, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(95, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(96, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(97, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(98, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(99, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(100, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(101, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(102, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(103, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(104, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(105, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(106, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(107, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(108, '9d5a7b1e-0cbd-438b-b272-d073692b93a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f86d15c8ad\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:43:01', '2024-10-28 20:43:03', NULL, NULL),
(110, '9d5a7c37-d2f0-4fb1-8cd6-40cf7848d386', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f8789bc9ec\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:46:06', '2024-10-28 20:46:06', NULL, NULL),
(112, '9d5a7ef3-bbd0-4735-8a83-7907eef07693', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f895504727\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:53:45', '2024-10-28 20:53:45', NULL, NULL),
(114, '9d5a810c-ae4b-436f-ae0a-23f62a39efb7', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f8ab3ca3d6\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 20:59:37', '2024-10-28 20:59:37', NULL, NULL),
(116, '9d5a818b-a427-4162-acdf-eee2b9c7c3a6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f8b0773e15\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:01:00', '2024-10-28 21:01:00', NULL, NULL),
(117, '9d5a8318-f194-48f6-a229-8dc11b05c337', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f8c0ca4471\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:05:20', '2024-10-28 21:05:20', NULL, NULL),
(118, '9d5a8318-f194-48f6-a229-8dc11b05c337', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f8c0ca4471\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:05:20', '2024-10-28 21:05:20', NULL, NULL),
(119, '9d5a83a6-2707-46e6-a03a-0ef68c31c9ab', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f8c68751be\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:06:53', '2024-10-28 21:06:53', NULL, NULL),
(120, '9d5a83c5-e7b4-4992-bc4b-8a7677d575a7', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f8c7aedb10\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:07:14', '2024-10-28 21:07:14', NULL, NULL),
(121, '9d5a83c5-e7b4-4992-bc4b-8a7677d575a7', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f8c7aedb10\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:07:14', '2024-10-28 21:07:14', NULL, NULL),
(122, '9d5a8404-ed77-44f0-bcdc-ae2f505d634d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f8ca6c4f0f\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:07:55', '2024-10-28 21:07:55', NULL, NULL),
(123, '9d5a8404-ed77-44f0-bcdc-ae2f505d634d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f8ca6c4f0f\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:07:55', '2024-10-28 21:07:55', NULL, NULL),
(124, '9d5a842a-9fcc-4b70-a88a-df749590a5f6', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f8cc01a44d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:20', '2024-10-28 21:08:20', NULL, NULL),
(125, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(126, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(127, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(128, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(129, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(130, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(131, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(132, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(133, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(134, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(135, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(136, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(137, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(138, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(139, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(140, '9d5a8454-458c-44d4-850e-5d0c3958e4d5', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f8cdabc810\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:08:47', '2024-10-28 21:08:48', NULL, NULL),
(141, '9d5a84f9-16ca-4225-b747-667d37e0136c', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f8d4771f8f\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:10:35', '2024-10-28 21:10:35', NULL, NULL),
(142, '9d5a84f9-16ca-4225-b747-667d37e0136c', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f8d4771f8f\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:10:35', '2024-10-28 21:10:35', NULL, NULL),
(147, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(148, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(149, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(150, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(151, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(152, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(153, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(154, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(155, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(156, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(157, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(158, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(159, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(160, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL);
INSERT INTO `action_events` (`id`, `batch_id`, `user_id`, `name`, `actionable_type`, `actionable_id`, `target_type`, `target_id`, `model_type`, `model_id`, `fields`, `status`, `exception`, `created_at`, `updated_at`, `original`, `changes`) VALUES
(161, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(162, '9d5a874d-d312-4177-b1e2-31f8a7c54b83', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f8ecec21f0\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:06', '2024-10-28 21:17:07', NULL, NULL),
(163, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(164, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(165, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(166, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(167, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(168, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(169, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(170, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(171, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(172, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(173, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(174, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(175, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(176, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(177, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(178, '9d5a8792-7f92-42a8-909a-37ca7a0d1b1e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f8efb43d55\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:17:51', '2024-10-28 21:17:53', NULL, NULL),
(179, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(180, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(181, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(182, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(183, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(184, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(185, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(186, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(187, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(188, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(189, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(190, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(191, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(192, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(193, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(194, '9d5a8866-4156-4514-883b-595010c4ad27', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f8f8445ec1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:20:10', '2024-10-28 21:20:11', NULL, NULL),
(195, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(196, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(197, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(198, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(199, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(200, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(201, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(202, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(203, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(204, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(205, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(206, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(207, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(208, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(209, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(210, '9d5a88b9-afd2-4626-9fca-f999afbbd3bc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f8fbd025b4\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:21:04', '2024-10-28 21:21:06', NULL, NULL),
(211, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(212, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(213, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(214, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(215, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(216, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(217, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(218, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(219, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(220, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(221, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(222, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(223, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(224, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(225, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(226, '9d5a891f-e23d-4695-b9ab-ea03bc025812', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f8ffd32f66\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:11', '2024-10-28 21:22:13', NULL, NULL),
(227, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(228, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(229, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(230, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(231, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(232, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(233, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(234, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(235, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(236, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(237, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(238, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(239, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(240, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(241, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(242, '9d5a894f-5857-4afa-aa01-11f8d30698c9', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f901eb2cf7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:22:42', '2024-10-28 21:22:44', NULL, NULL),
(243, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(244, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(245, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(246, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(247, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(248, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(249, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(250, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(251, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(252, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(253, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(254, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(255, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(256, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(257, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(258, '9d5a8bbe-34d3-4549-97b6-42578b1ebf2b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f91b696dc1\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:31', '2024-10-28 21:29:32', NULL, NULL),
(259, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(260, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(261, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(262, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(263, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(264, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(265, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(266, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(267, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(268, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(269, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(270, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(271, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(272, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(273, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(274, '9d5a8bdf-842f-41b0-9174-6c87904584f2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f91ccdbd26\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 21:29:52', '2024-10-28 21:29:54', NULL, NULL),
(275, '9d5a8c9f-684e-41fb-a656-9dc770b44547', 1, 'Create', 'App\\Models\\Template', 9, 'App\\Models\\Template', 9, 'App\\Models\\Template', 9, '', 'finished', '', '2024-10-28 21:31:58', '2024-10-28 21:31:58', NULL, '{\"nama\":\"BAST Kontrak Bulanan Mitra\",\"jenis\":\"bast\",\"file\":\"m3yoHzM7gYlvy2F6KDKSlFtyeYNe36eqKLh8FoYU.docx\",\"updated_at\":\"2024-10-28T13:31:58.000000Z\",\"created_at\":\"2024-10-28T13:31:58.000000Z\",\"id\":9}'),
(276, '9d5a932a-d67d-42fc-968d-d9791f97fb9f', 1, 'Generate BAST Mitra', 'App\\Models\\BastMitra', 2, 'App\\Models\\BastMitra', 2, 'App\\Models\\BastMitra', 2, 'a:0:{}', 'finished', '', '2024-10-28 21:50:16', '2024-10-28 21:50:16', NULL, NULL),
(277, '9d5a953c-0d2e-4f98-901c-8508f037d803', 1, 'Update', 'App\\Models\\BastMitra', 2, 'App\\Models\\BastMitra', 2, 'App\\Models\\BastMitra', 2, '', 'finished', '', '2024-10-28 21:56:03', '2024-10-28 21:56:03', '{\"tanggal_bast\":null,\"kode_arsip_id\":null,\"ppk_user_id\":null}', '{\"tanggal_bast\":\"2024-12-31 00:00:00\",\"kode_arsip_id\":\"29\",\"ppk_user_id\":\"1\"}'),
(278, '9d5a954d-ba53-4baf-92e9-d86241929e1d', 1, 'Generate BAST Mitra', 'App\\Models\\BastMitra', 2, 'App\\Models\\BastMitra', 2, 'App\\Models\\BastMitra', 2, 'a:0:{}', 'finished', '', '2024-10-28 21:56:15', '2024-10-28 21:56:17', NULL, NULL),
(311, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(312, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(313, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(314, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(315, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(316, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(317, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(318, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(319, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(320, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(321, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(322, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(323, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(324, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(325, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(326, '9d5a9665-e593-4dec-b8c2-1dcfb89a2e73', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f982321900\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 21:59:18', '2024-10-28 21:59:20', NULL, NULL),
(327, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(328, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(329, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(330, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(331, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(332, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(333, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(334, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(335, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(336, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(337, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(338, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(339, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(340, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(341, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL),
(342, '9d5a989f-1055-4929-9540-8470f75d6bf1', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f9a27d57ad\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:05:31', '2024-10-28 22:05:33', NULL, NULL);
INSERT INTO `action_events` (`id`, `batch_id`, `user_id`, `name`, `actionable_type`, `actionable_id`, `target_type`, `target_id`, `model_type`, `model_id`, `fields`, `status`, `exception`, `created_at`, `updated_at`, `original`, `changes`) VALUES
(343, '9d5a997c-ca15-446e-b573-a1319173f4f0', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f9a2f91e58\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:07:57', '2024-10-28 22:07:57', NULL, NULL),
(344, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(345, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(346, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(347, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(348, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(349, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(350, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(351, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(352, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(353, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(354, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(355, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(356, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(357, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(358, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(359, '9d5a99a1-4a3b-4bb6-82a5-9dd0a9c0ab4d', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f9ad0c608b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:08:21', '2024-10-28 22:08:22', NULL, NULL),
(360, '9d5a99bc-6711-4b5e-b6f7-8fc00a3b3014', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f9ad8b556c\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:38', '2024-10-28 22:08:38', NULL, NULL),
(361, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(362, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(363, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(364, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(365, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(366, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(367, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(368, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(369, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(370, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(371, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(372, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(373, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(374, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(375, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(376, '9d5a99d3-bb4a-4630-94c2-7072db9fc70e', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f9af1cfffa\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:08:54', '2024-10-28 22:08:55', NULL, NULL),
(377, '9d5a9aa7-e71d-4b68-af57-9e9d221af58e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f9b7d49919\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:11:13', '2024-10-28 22:11:13', NULL, NULL),
(378, '9d5a9aa7-e71d-4b68-af57-9e9d221af58e', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f9b7d49919\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:11:13', '2024-10-28 22:11:13', NULL, NULL),
(379, '9d5a9ae6-c727-49c0-8ed8-51a97488273b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f9ba60ea12\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:11:54', '2024-10-28 22:11:54', NULL, NULL),
(380, '9d5a9ae6-c727-49c0-8ed8-51a97488273b', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f9ba60ea12\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-10-28 22:11:54', '2024-10-28 22:11:54', NULL, NULL),
(381, '9d5a9b11-eb4a-4b53-b30d-fb1f555e7b0d', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f9bacb5fce\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:22', '2024-10-28 22:12:22', NULL, NULL),
(382, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'App\\Models\\DaftarKontrakMitra', 18, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(383, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'App\\Models\\DaftarKontrakMitra', 17, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(384, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(385, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(386, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(387, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(388, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(389, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(390, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(391, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(392, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(393, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(394, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(395, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(396, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(397, '9d5a9b28-0677-471c-9739-b5fefaa7208a', 1, 'Unduh BAST', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"671f9bd120f42\";s:8:\"template\";s:1:\"9\";}', 'finished', '', '2024-10-28 22:12:37', '2024-10-28 22:12:38', NULL, NULL),
(398, '9d5b3bcb-8246-4169-a1b9-431dfad3f015', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 2, 'App\\Models\\KontrakMitra', 2, 'App\\Models\\KontrakMitra', 2, 'a:0:{}', 'finished', '', '2024-10-29 05:41:47', '2024-10-29 05:41:48', NULL, NULL),
(399, '9d5b3f8b-653c-456b-904f-7bc4e2d9829e', 1, 'Unduh KAK', 'App\\Models\\KerangkaAcuan', 1, 'App\\Models\\KerangkaAcuan', 1, 'App\\Models\\KerangkaAcuan', 1, 'a:2:{s:8:\"filename\";s:13:\"6720078d5b0a5\";s:8:\"template\";s:1:\"3\";}', 'finished', '', '2024-10-29 05:52:16', '2024-10-29 05:52:16', NULL, NULL),
(400, '9d5b4f35-b121-4f54-a604-5bf9d95183fe', 1, 'Create', 'App\\Models\\KerangkaAcuan', 5, 'App\\Models\\KerangkaAcuan', 5, 'App\\Models\\KerangkaAcuan', 5, '', 'finished', '', '2024-10-29 06:36:05', '2024-10-29 06:36:05', NULL, '{\"tanggal\":\"2024-10-28T16:00:00.000000Z\",\"rincian\":\"Pembayaran Biaya Perjalanan Dinas dalam rangka... Pengadaan Perlengkapan....\",\"latar\":\"Kegiatan PLKUMKM merupakan salah satu kegiatan yang dilakukan oleh Badan Pusat Statistik dalam rangka mendukung penyediaan Data Statistik sesuai amanat Undang-Undang no 16 Tahun 1997. Agar kegiatan tersebut dapat berjalan dengan lancar dan tepat waktu diperlukan adanya penyediaan ATK Pelatihan Petugas PLKUMKM sebagai sarana penunjang kegiatan yang dilaksanakan.\",\"maksud\":\"Maksud dari pelaksanaan kegiatan ini adalah untuk\",\"tujuan\":\"Tujuan dari pelaksanaan kegiatan ini adalah\",\"sasaran\":\"Target\\/sasaran yang ingin dicapai terkait dengan pelaksanaan kegiatan ini adalah\",\"kegiatan\":\"Pengolahan Lapangan Survei Sosial Ekonomi Nasional Maret 2024\",\"awal\":\"2024-10-28T16:00:00.000000Z\",\"akhir\":\"2024-10-30T16:00:00.000000Z\",\"jenis\":\"Swakelola\",\"koordinator_user_id\":\"1\",\"ppk_user_id\":\"13\",\"dipa_id\":\"1\",\"metode\":\"-\",\"tkdn\":\"-\",\"unit_kerja_id\":1,\"status\":\"dibuat\",\"naskah_keluar_id\":43,\"updated_at\":\"2024-10-28T22:36:04.000000Z\",\"created_at\":\"2024-10-28T22:36:04.000000Z\",\"id\":5}'),
(402, '9d5b4f8f-289f-4140-bdd7-505921e1ddb0', 1, 'Create', 'App\\Models\\KerangkaAcuan', 6, 'App\\Models\\KerangkaAcuan', 6, 'App\\Models\\KerangkaAcuan', 6, '', 'finished', '', '2024-10-29 06:37:03', '2024-10-29 06:37:03', NULL, '{\"tanggal\":\"2024-10-28T16:00:00.000000Z\",\"rincian\":\"Pembayaran Biaya Perjalanan Dinas dalam rangka... Pengadaan Perlengkapan....\",\"latar\":\"Kegiatan PLKUMKM merupakan salah satu kegiatan yang dilakukan oleh Badan Pusat Statistik dalam rangka mendukung penyediaan Data Statistik sesuai amanat Undang-Undang no 16 Tahun 1997. Agar kegiatan tersebut dapat berjalan dengan lancar dan tepat waktu diperlukan adanya penyediaan ATK Pelatihan Petugas PLKUMKM sebagai sarana penunjang kegiatan yang dilaksanakan.\",\"maksud\":\"Maksud dari pelaksanaan kegiatan ini adalah untuk\",\"tujuan\":\"Tujuan dari pelaksanaan kegiatan ini adalah\",\"sasaran\":\"Target\\/sasaran yang ingin dicapai terkait dengan pelaksanaan kegiatan ini adalah\",\"kegiatan\":\"czzczx\",\"awal\":\"2024-10-28T16:00:00.000000Z\",\"akhir\":\"2024-10-28T16:00:00.000000Z\",\"jenis\":\"Penyedia\",\"metode\":\"Penunjukan Langsung\",\"tkdn\":\"Ya\",\"koordinator_user_id\":\"1\",\"ppk_user_id\":\"13\",\"dipa_id\":\"1\",\"unit_kerja_id\":1,\"status\":\"dibuat\",\"naskah_keluar_id\":44,\"updated_at\":\"2024-10-28T22:37:03.000000Z\",\"created_at\":\"2024-10-28T22:37:03.000000Z\",\"id\":6}'),
(403, '9d643a74-b781-4161-8bb4-836b272305aa', 1, 'Delete', 'App\\Models\\KerangkaAcuan', 1, 'App\\Models\\KerangkaAcuan', 1, 'App\\Models\\KerangkaAcuan', 1, '', 'finished', '', '2024-11-02 17:00:30', '2024-11-02 17:00:30', NULL, NULL),
(404, '9d643a75-6468-46a3-adf9-9b03f03b428d', 1, 'Delete', 'App\\Models\\KerangkaAcuan', 2, 'App\\Models\\KerangkaAcuan', 2, 'App\\Models\\KerangkaAcuan', 2, '', 'finished', '', '2024-11-02 17:00:30', '2024-11-02 17:00:30', NULL, NULL),
(405, '9d643a75-b950-483b-8f6d-42d984b3f7e0', 1, 'Delete', 'App\\Models\\KerangkaAcuan', 3, 'App\\Models\\KerangkaAcuan', 3, 'App\\Models\\KerangkaAcuan', 3, '', 'finished', '', '2024-11-02 17:00:30', '2024-11-02 17:00:30', NULL, NULL),
(406, '9d643a75-e446-4621-a5ed-52b1423b8653', 1, 'Delete', 'App\\Models\\KerangkaAcuan', 4, 'App\\Models\\KerangkaAcuan', 4, 'App\\Models\\KerangkaAcuan', 4, '', 'finished', '', '2024-11-02 17:00:30', '2024-11-02 17:00:30', NULL, NULL),
(407, '9d643a76-1320-47ea-9560-2cd2d4445979', 1, 'Delete', 'App\\Models\\KerangkaAcuan', 5, 'App\\Models\\KerangkaAcuan', 5, 'App\\Models\\KerangkaAcuan', 5, '', 'finished', '', '2024-11-02 17:00:31', '2024-11-02 17:00:31', NULL, NULL),
(408, '9d643a76-2c4f-499a-9611-4adb6028b49b', 1, 'Delete', 'App\\Models\\KerangkaAcuan', 6, 'App\\Models\\KerangkaAcuan', 6, 'App\\Models\\KerangkaAcuan', 6, '', 'finished', '', '2024-11-02 17:00:31', '2024-11-02 17:00:31', NULL, NULL),
(409, '9d643b00-b748-4432-b548-edcd66eb44ec', 1, 'Delete', 'App\\Models\\KontrakMitra', 1, 'App\\Models\\KontrakMitra', 1, 'App\\Models\\KontrakMitra', 1, '', 'finished', '', '2024-11-02 17:02:01', '2024-11-02 17:02:01', NULL, NULL),
(410, '9d643b01-4d55-4789-8348-3e10593cda60', 1, 'Delete', 'App\\Models\\KontrakMitra', 2, 'App\\Models\\KontrakMitra', 2, 'App\\Models\\KontrakMitra', 2, '', 'finished', '', '2024-11-02 17:02:02', '2024-11-02 17:02:02', NULL, NULL),
(411, '9d643bbc-baf1-4bef-8b82-ae5695acc9bd', 1, 'Create', 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, '', 'finished', '', '2024-11-02 17:04:05', '2024-11-02 17:04:05', NULL, '{\"tanggal\":\"2024-11-01T16:00:00.000000Z\",\"rincian\":\"Pembayaran Biaya Perjalanan Dinas dalam rangka... Pengadaan Perlengkapan....\",\"latar\":\"Kegiatan PLKUMKM merupakan salah satu kegiatan yang dilakukan oleh Badan Pusat Statistik dalam rangka mendukung penyediaan Data Statistik sesuai amanat Undang-Undang no 16 Tahun 1997. Agar kegiatan tersebut dapat berjalan dengan lancar dan tepat waktu diperlukan adanya penyediaan ATK Pelatihan Petugas PLKUMKM sebagai sarana penunjang kegiatan yang dilaksanakan.\",\"maksud\":\"Maksud dari pelaksanaan kegiatan ini adalah untuk\",\"tujuan\":\"Tujuan dari pelaksanaan kegiatan ini adalah\",\"sasaran\":\"Target\\/sasaran yang ingin dicapai terkait dengan pelaksanaan kegiatan ini adalah\",\"kegiatan\":\"Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024\",\"awal\":\"2024-11-01T16:00:00.000000Z\",\"akhir\":\"2024-11-01T16:00:00.000000Z\",\"jenis\":\"Swakelola\",\"koordinator_user_id\":\"1\",\"ppk_user_id\":\"13\",\"dipa_id\":\"1\",\"metode\":\"-\",\"tkdn\":\"-\",\"unit_kerja_id\":1,\"status\":\"dibuat\",\"naskah_keluar_id\":45,\"updated_at\":\"2024-11-02T09:04:05.000000Z\",\"created_at\":\"2024-11-02T09:04:05.000000Z\",\"id\":7}'),
(412, '9d643c19-52e4-4197-9249-e00648596a8b', 1, 'Unduh KAK', 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'a:2:{s:8:\"filename\";s:13:\"6725eb3da781a\";s:8:\"template\";s:1:\"3\";}', 'finished', '', '2024-11-02 17:05:05', '2024-11-02 17:05:05', NULL, NULL),
(413, '9d643c3e-1627-4f51-9148-e9876401b0df', 1, 'Update', 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, '', 'finished', '', '2024-11-02 17:05:29', '2024-11-02 17:05:29', '{\"maksud\":\"Maksud dari pelaksanaan kegiatan ini adalah untuk\"}', '{\"maksud\":\"Maksud dari pelaksanaan kegiatan ini adalah untuk aa\"}'),
(418, '9d643d90-9311-4191-9154-25ad2d6cf679', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"6725ec33afff8\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-11-02 17:09:11', '2024-11-02 17:09:18', NULL, NULL),
(419, '9d643dc0-16d8-490f-be6a-7cad5d66553b', 1, 'Unduh Surat Tugas', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"6725ec3e65e7c\";s:8:\"template\";s:1:\"7\";}', 'finished', '', '2024-11-02 17:09:42', '2024-11-02 17:09:44', NULL, NULL),
(420, '9d643dfc-baf9-485c-a904-946f1c020d16', 1, 'Unduh SK', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"6725ec58b2cd8\";s:8:\"template\";s:1:\"5\";}', 'finished', '', '2024-11-02 17:10:22', '2024-11-02 17:10:24', NULL, NULL),
(421, '9d643ef1-2fa0-4566-b830-3a012cd2b4cd', 1, 'Unduh Surat Tugas', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"6725ec807778c\";s:8:\"template\";s:1:\"7\";}', 'finished', '', '2024-11-02 17:13:02', '2024-11-02 17:13:04', NULL, NULL),
(422, '9d643f4e-f042-47d6-a9ce-3f3d67655a0c', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, 'a:0:{}', 'finished', '', '2024-11-02 17:14:04', '2024-11-02 17:14:04', NULL, NULL),
(423, '9d643f6e-d0c2-4e8e-b327-6d090504a68f', 1, 'Update', 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, '', 'finished', '', '2024-11-02 17:14:25', '2024-11-02 17:14:25', '{\"tanggal_spk\":null,\"ppk_user_id\":null,\"kode_arsip_id\":null}', '{\"tanggal_spk\":\"2024-11-02 00:00:00\",\"ppk_user_id\":\"13\",\"kode_arsip_id\":\"29\"}'),
(424, '9d643f82-75e0-4553-807f-be731d57840e', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, 'a:0:{}', 'finished', '', '2024-11-02 17:14:38', '2024-11-02 17:14:40', NULL, NULL),
(441, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 34, 'App\\Models\\DaftarKontrakMitra', 34, 'App\\Models\\DaftarKontrakMitra', 34, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(442, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 33, 'App\\Models\\DaftarKontrakMitra', 33, 'App\\Models\\DaftarKontrakMitra', 33, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(443, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 32, 'App\\Models\\DaftarKontrakMitra', 32, 'App\\Models\\DaftarKontrakMitra', 32, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(444, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 31, 'App\\Models\\DaftarKontrakMitra', 31, 'App\\Models\\DaftarKontrakMitra', 31, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(445, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 30, 'App\\Models\\DaftarKontrakMitra', 30, 'App\\Models\\DaftarKontrakMitra', 30, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(446, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 29, 'App\\Models\\DaftarKontrakMitra', 29, 'App\\Models\\DaftarKontrakMitra', 29, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(447, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 28, 'App\\Models\\DaftarKontrakMitra', 28, 'App\\Models\\DaftarKontrakMitra', 28, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(448, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 27, 'App\\Models\\DaftarKontrakMitra', 27, 'App\\Models\\DaftarKontrakMitra', 27, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(449, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 26, 'App\\Models\\DaftarKontrakMitra', 26, 'App\\Models\\DaftarKontrakMitra', 26, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(450, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 25, 'App\\Models\\DaftarKontrakMitra', 25, 'App\\Models\\DaftarKontrakMitra', 25, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(451, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 24, 'App\\Models\\DaftarKontrakMitra', 24, 'App\\Models\\DaftarKontrakMitra', 24, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(452, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 23, 'App\\Models\\DaftarKontrakMitra', 23, 'App\\Models\\DaftarKontrakMitra', 23, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(453, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 22, 'App\\Models\\DaftarKontrakMitra', 22, 'App\\Models\\DaftarKontrakMitra', 22, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(454, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 21, 'App\\Models\\DaftarKontrakMitra', 21, 'App\\Models\\DaftarKontrakMitra', 21, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(455, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 20, 'App\\Models\\DaftarKontrakMitra', 20, 'App\\Models\\DaftarKontrakMitra', 20, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(456, '9d643fc1-d58f-4543-b540-57a101a99198', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 19, 'App\\Models\\DaftarKontrakMitra', 19, 'App\\Models\\DaftarKontrakMitra', 19, 'a:2:{s:8:\"filename\";s:13:\"6725ed99dfe04\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:15:19', '2024-11-02 17:15:21', NULL, NULL),
(457, '9d644057-2a88-4f36-9fea-5798346473da', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"6725ee0534935\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-11-02 17:16:57', '2024-11-02 17:17:03', NULL, NULL),
(458, '9d6440ae-bbd8-4eef-a286-00c73f33192f', 1, 'Update', 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, '', 'finished', '', '2024-11-02 17:17:54', '2024-11-02 17:17:54', '{\"volume_realisasi\":3}', '{\"volume_realisasi\":\"2\"}'),
(459, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 34, 'App\\Models\\DaftarKontrakMitra', 34, 'App\\Models\\DaftarKontrakMitra', 34, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(460, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 33, 'App\\Models\\DaftarKontrakMitra', 33, 'App\\Models\\DaftarKontrakMitra', 33, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(461, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 32, 'App\\Models\\DaftarKontrakMitra', 32, 'App\\Models\\DaftarKontrakMitra', 32, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(462, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 31, 'App\\Models\\DaftarKontrakMitra', 31, 'App\\Models\\DaftarKontrakMitra', 31, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(463, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 30, 'App\\Models\\DaftarKontrakMitra', 30, 'App\\Models\\DaftarKontrakMitra', 30, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(464, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 29, 'App\\Models\\DaftarKontrakMitra', 29, 'App\\Models\\DaftarKontrakMitra', 29, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(465, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 28, 'App\\Models\\DaftarKontrakMitra', 28, 'App\\Models\\DaftarKontrakMitra', 28, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(466, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 27, 'App\\Models\\DaftarKontrakMitra', 27, 'App\\Models\\DaftarKontrakMitra', 27, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(467, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 26, 'App\\Models\\DaftarKontrakMitra', 26, 'App\\Models\\DaftarKontrakMitra', 26, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(468, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 25, 'App\\Models\\DaftarKontrakMitra', 25, 'App\\Models\\DaftarKontrakMitra', 25, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(469, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 24, 'App\\Models\\DaftarKontrakMitra', 24, 'App\\Models\\DaftarKontrakMitra', 24, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(470, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 23, 'App\\Models\\DaftarKontrakMitra', 23, 'App\\Models\\DaftarKontrakMitra', 23, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(471, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 22, 'App\\Models\\DaftarKontrakMitra', 22, 'App\\Models\\DaftarKontrakMitra', 22, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(472, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 21, 'App\\Models\\DaftarKontrakMitra', 21, 'App\\Models\\DaftarKontrakMitra', 21, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(473, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 20, 'App\\Models\\DaftarKontrakMitra', 20, 'App\\Models\\DaftarKontrakMitra', 20, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(474, '9d644119-174e-4a4a-9554-51bb82231341', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 19, 'App\\Models\\DaftarKontrakMitra', 19, 'App\\Models\\DaftarKontrakMitra', 19, 'a:2:{s:8:\"filename\";s:13:\"6725ee8487719\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:19:04', '2024-11-02 17:19:05', NULL, NULL),
(475, '9d6442ef-4d4e-4a2c-bb84-befa1385cce7', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, 'a:0:{}', 'finished', '', '2024-11-02 17:24:12', '2024-11-02 17:24:12', NULL, NULL),
(476, '9d644362-933c-4ad8-9717-2482ebf68784', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 34, 'App\\Models\\DaftarKontrakMitra', 34, 'App\\Models\\DaftarKontrakMitra', 34, 'a:2:{s:8:\"filename\";s:13:\"6725efc1592d5\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:25:28', '2024-11-02 17:25:28', NULL, NULL),
(477, '9d64436a-df7a-41cd-a5c1-8e630b41de06', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, 'a:0:{}', 'finished', '', '2024-11-02 17:25:33', '2024-11-02 17:25:33', NULL, NULL),
(478, '9d6445bf-da0b-42fb-ba3d-2d9faa034444', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, 'a:0:{}', 'finished', '', '2024-11-02 17:32:04', '2024-11-02 17:32:05', NULL, NULL),
(479, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 34, 'App\\Models\\DaftarKontrakMitra', 34, 'App\\Models\\DaftarKontrakMitra', 34, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(480, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 33, 'App\\Models\\DaftarKontrakMitra', 33, 'App\\Models\\DaftarKontrakMitra', 33, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(481, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 32, 'App\\Models\\DaftarKontrakMitra', 32, 'App\\Models\\DaftarKontrakMitra', 32, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(482, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 31, 'App\\Models\\DaftarKontrakMitra', 31, 'App\\Models\\DaftarKontrakMitra', 31, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(483, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 30, 'App\\Models\\DaftarKontrakMitra', 30, 'App\\Models\\DaftarKontrakMitra', 30, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(484, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 29, 'App\\Models\\DaftarKontrakMitra', 29, 'App\\Models\\DaftarKontrakMitra', 29, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(485, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 28, 'App\\Models\\DaftarKontrakMitra', 28, 'App\\Models\\DaftarKontrakMitra', 28, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(486, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 27, 'App\\Models\\DaftarKontrakMitra', 27, 'App\\Models\\DaftarKontrakMitra', 27, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(487, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 26, 'App\\Models\\DaftarKontrakMitra', 26, 'App\\Models\\DaftarKontrakMitra', 26, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(488, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 25, 'App\\Models\\DaftarKontrakMitra', 25, 'App\\Models\\DaftarKontrakMitra', 25, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(489, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 24, 'App\\Models\\DaftarKontrakMitra', 24, 'App\\Models\\DaftarKontrakMitra', 24, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(490, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 23, 'App\\Models\\DaftarKontrakMitra', 23, 'App\\Models\\DaftarKontrakMitra', 23, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(491, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 22, 'App\\Models\\DaftarKontrakMitra', 22, 'App\\Models\\DaftarKontrakMitra', 22, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(492, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 21, 'App\\Models\\DaftarKontrakMitra', 21, 'App\\Models\\DaftarKontrakMitra', 21, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(493, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 20, 'App\\Models\\DaftarKontrakMitra', 20, 'App\\Models\\DaftarKontrakMitra', 20, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(494, '9d64462b-b1a7-48de-a7ef-8be8bd05abde', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 19, 'App\\Models\\DaftarKontrakMitra', 19, 'App\\Models\\DaftarKontrakMitra', 19, 'a:2:{s:8:\"filename\";s:13:\"6725f1d6aa536\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-02 17:33:15', '2024-11-02 17:33:17', NULL, NULL),
(495, '9d64466c-2233-44fb-85ff-f906beb498f7', 1, 'Update', 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, '', 'finished', '', '2024-11-02 17:33:57', '2024-11-02 17:33:57', '{\"volume_realisasi\":2}', '{\"volume_realisasi\":\"3\"}'),
(496, '9d6446a2-f3ce-4b30-89ea-dfaee43dce67', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, 'a:0:{}', 'finished', '', '2024-11-02 17:34:33', '2024-11-02 17:34:34', NULL, NULL),
(497, '9d64471b-d96c-4c47-9562-dad13e9b3351', 1, 'Update', 'App\\Models\\BastMitra', 3, 'App\\Models\\BastMitra', 3, 'App\\Models\\BastMitra', 3, '', 'finished', '', '2024-11-02 17:35:52', '2024-11-02 17:35:52', '{\"tanggal_bast\":null,\"kode_arsip_id\":null,\"ppk_user_id\":null}', '{\"tanggal_bast\":\"2024-12-31 00:00:00\",\"kode_arsip_id\":\"29\",\"ppk_user_id\":\"13\"}'),
(498, '9d64472a-cbcc-43f4-9518-7716c79cdf19', 1, 'Generate BAST Mitra', 'App\\Models\\BastMitra', 3, 'App\\Models\\BastMitra', 3, 'App\\Models\\BastMitra', 3, 'a:0:{}', 'finished', '', '2024-11-02 17:36:02', '2024-11-02 17:36:04', NULL, NULL),
(499, '9d644ab4-57d2-4711-8894-6917db87e730', 1, 'Delete', 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, 'App\\Models\\KontrakMitra', 3, '', 'finished', '', '2024-11-02 17:45:56', '2024-11-02 17:45:56', NULL, NULL),
(500, '9d644aec-fccb-4e62-bda6-fd1fa40506b4', 1, 'Update', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, '', 'finished', '', '2024-11-02 17:46:33', '2024-11-02 17:46:33', '{\"tanggal_kak\":\"2024-10-31T16:00:00.000000Z\",\"generate_sk\":1,\"generate_st\":1}', '{\"tanggal_kak\":\"2024-10-31 16:00:00\",\"generate_sk\":true,\"generate_st\":true}'),
(501, '9d644b10-1f51-4211-801d-14da54a373cb', 1, 'Update', 'App\\Models\\KontrakMitra', 4, 'App\\Models\\KontrakMitra', 4, 'App\\Models\\KontrakMitra', 4, '', 'finished', '', '2024-11-02 17:46:56', '2024-11-02 17:46:56', '{\"tanggal_spk\":null,\"ppk_user_id\":null,\"kode_arsip_id\":null}', '{\"tanggal_spk\":\"2024-11-02 00:00:00\",\"ppk_user_id\":\"13\",\"kode_arsip_id\":\"29\"}'),
(506, '9d644be7-cbc3-435c-ae91-82034698b242', 1, 'Delete', 'App\\Models\\KontrakMitra', 4, 'App\\Models\\KontrakMitra', 4, 'App\\Models\\KontrakMitra', 4, '', 'finished', '', '2024-11-02 17:49:17', '2024-11-02 17:49:17', NULL, NULL),
(507, '9d644c0d-d391-4204-82a4-1baf33e0eb38', 1, 'Update', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, '', 'finished', '', '2024-11-02 17:49:42', '2024-11-02 17:49:42', '{\"tanggal_kak\":\"2024-10-30T16:00:00.000000Z\",\"generate_sk\":1,\"generate_st\":1}', '{\"tanggal_kak\":\"2024-10-30 16:00:00\",\"generate_sk\":true,\"generate_st\":true}'),
(508, '9d644c27-94b4-4346-8b75-a5333c3c0909', 1, 'Update', 'App\\Models\\KontrakMitra', 5, 'App\\Models\\KontrakMitra', 5, 'App\\Models\\KontrakMitra', 5, '', 'finished', '', '2024-11-02 17:49:59', '2024-11-02 17:49:59', '{\"tanggal_spk\":null,\"ppk_user_id\":null,\"kode_arsip_id\":null}', '{\"tanggal_spk\":\"2024-11-02 00:00:00\",\"ppk_user_id\":\"13\",\"kode_arsip_id\":\"29\"}'),
(533, '9d64507f-0b80-4e67-a161-7d049e68c744', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 5, 'App\\Models\\KontrakMitra', 5, 'App\\Models\\KontrakMitra', 5, 'a:0:{}', 'finished', '', '2024-11-02 18:02:07', '2024-11-02 18:02:07', NULL, NULL),
(538, '9d64522c-d177-4938-b2d5-6613a854d880', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 5, 'App\\Models\\KontrakMitra', 5, 'App\\Models\\KontrakMitra', 5, 'a:0:{}', 'finished', '', '2024-11-02 18:06:49', '2024-11-02 18:06:51', NULL, NULL),
(539, '9d64602b-9e30-486e-8ee9-2523bd73f543', 1, 'Delete', 'App\\Models\\KontrakMitra', 5, 'App\\Models\\KontrakMitra', 5, 'App\\Models\\KontrakMitra', 5, '', 'finished', '', '2024-11-02 18:45:57', '2024-11-02 18:45:57', NULL, NULL),
(540, '9d646041-4e16-47ab-82f1-49d06f65a08d', 1, 'Update', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, '', 'finished', '', '2024-11-02 18:46:11', '2024-11-02 18:46:11', '{\"tanggal_kak\":\"2024-10-29T16:00:00.000000Z\",\"generate_sk\":1,\"generate_st\":1}', '{\"tanggal_kak\":\"2024-10-29 16:00:00\",\"generate_sk\":true,\"generate_st\":true}');
INSERT INTO `action_events` (`id`, `batch_id`, `user_id`, `name`, `actionable_type`, `actionable_id`, `target_type`, `target_id`, `model_type`, `model_id`, `fields`, `status`, `exception`, `created_at`, `updated_at`, `original`, `changes`) VALUES
(541, '9d6481d0-3358-4853-81a5-b18644355b4b', 1, 'Delete', 'App\\Models\\KontrakMitra', 6, 'App\\Models\\KontrakMitra', 6, 'App\\Models\\KontrakMitra', 6, '', 'finished', '', '2024-11-02 20:20:01', '2024-11-02 20:20:01', NULL, NULL),
(542, '9d6481e6-ca74-4706-b994-9e50c9bd845c', 1, 'Update', 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, '', 'finished', '', '2024-11-02 20:20:16', '2024-11-02 20:20:16', '[]', '[]'),
(543, '9d648207-6732-4570-83b0-5c09be7d79f1', 1, 'Update', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, '', 'finished', '', '2024-11-02 20:20:38', '2024-11-02 20:20:38', '{\"tanggal_kak\":\"2024-10-28T16:00:00.000000Z\",\"generate_sk\":1,\"generate_st\":1}', '{\"tanggal_kak\":\"2024-10-28 16:00:00\",\"generate_sk\":true,\"generate_st\":true}'),
(562, '9d648708-9033-4752-8d33-3050a7c2c983', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"6726193f501ff\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-11-02 20:34:37', '2024-11-02 20:34:44', NULL, NULL),
(563, '9d648731-3f4f-4cb5-8e23-aa763ce551ba', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"67261c7355fb6\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-11-02 20:35:04', '2024-11-02 20:35:10', NULL, NULL),
(564, '9d64875a-6751-4b8c-a95b-17d460a781ea', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"67261c7ef1298\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-11-02 20:35:31', '2024-11-02 20:35:37', NULL, NULL),
(565, '9d64880e-9f15-4fbb-b5e4-f15b49fd25d8', 1, 'Update', 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, '', 'finished', '', '2024-11-02 20:37:29', '2024-11-02 20:37:29', '{\"tanggal_spk\":null,\"ppk_user_id\":null,\"kode_arsip_id\":null}', '{\"tanggal_spk\":\"2024-11-02 00:00:00\",\"ppk_user_id\":\"13\",\"kode_arsip_id\":\"29\"}'),
(566, '9d648815-96ae-4c5c-9417-bea40c15f13f', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'a:0:{}', 'finished', '', '2024-11-02 20:37:34', '2024-11-02 20:37:35', NULL, NULL),
(567, '9d648bbc-7c47-4605-9534-28ba9be3245d', 1, 'Generate BAST Mitra', 'App\\Models\\BastMitra', 7, 'App\\Models\\BastMitra', 7, 'App\\Models\\BastMitra', 7, 'a:0:{}', 'finished', '', '2024-11-02 20:47:46', '2024-11-02 20:47:46', NULL, NULL),
(568, '9d654844-daa8-4cdf-aa49-1a3f33763560', 1, 'Unduh KAK', 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'a:2:{s:8:\"filename\";s:13:\"67269afd35412\";s:8:\"template\";s:1:\"3\";}', 'finished', '', '2024-11-03 05:34:57', '2024-11-03 05:34:57', NULL, NULL),
(569, '9d654bf3-4405-4043-8223-c05082b6c636', 1, 'Update', 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, '', 'finished', '', '2024-11-03 05:45:14', '2024-11-03 05:45:14', '{\"kegiatan\":\"Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024\"}', '{\"kegiatan\":\"Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024 a\"}'),
(570, '9d654c01-1510-4a48-b6cf-608e9915b122', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"67269d6dbbc88\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-11-03 05:45:23', '2024-11-03 05:45:30', NULL, NULL),
(571, '9d654c26-a0cc-4d0f-82a2-35cfc791ebbf', 1, 'Update', 'App\\Models\\AnggaranKerangkaAcuan', 9, 'App\\Models\\AnggaranKerangkaAcuan', 9, 'App\\Models\\AnggaranKerangkaAcuan', 9, '', 'finished', '', '2024-11-03 05:45:48', '2024-11-03 05:45:48', '[]', '[]'),
(572, '9d654c5d-44a4-4c42-8e75-6a920b576403', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"67269d8fa8159\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-11-03 05:46:24', '2024-11-03 05:46:30', NULL, NULL),
(573, '9d654cbe-c774-4514-8349-2c17f6bc8d32', 1, 'Unduh KAK', 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'a:2:{s:8:\"filename\";s:13:\"67269de91928c\";s:8:\"template\";s:1:\"3\";}', 'finished', '', '2024-11-03 05:47:28', '2024-11-03 05:47:28', NULL, NULL),
(574, '9d654cc9-9028-4c44-b161-dfe2df4f563f', 1, 'Update', 'App\\Models\\AnggaranKerangkaAcuan', 9, 'App\\Models\\AnggaranKerangkaAcuan', 9, 'App\\Models\\AnggaranKerangkaAcuan', 9, '', 'finished', '', '2024-11-03 05:47:35', '2024-11-03 05:47:35', '[]', '[]'),
(575, '9d654d0a-a01e-465d-be90-828c9455b203', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"67269e1d621da\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-11-03 05:48:17', '2024-11-03 05:48:24', NULL, NULL),
(576, '9d654dac-e051-442a-9adb-ba583acc0190', 1, 'Update', 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, '', 'finished', '', '2024-11-03 05:50:04', '2024-11-03 05:50:04', '{\"volume_realisasi\":3}', '{\"volume_realisasi\":\"2\"}'),
(577, '9d654f1f-a4c4-4e2c-9d55-978549a4dc16', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'a:0:{}', 'finished', '', '2024-11-03 05:54:07', '2024-11-03 05:54:07', NULL, NULL),
(578, '9d654f2e-cf43-426a-b33a-ab1e1ccb5829', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'a:0:{}', 'finished', '', '2024-11-03 05:54:17', '2024-11-03 05:54:17', NULL, NULL),
(579, '9d654fc5-f59e-4e6f-b1e8-908bad62a4be', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'a:0:{}', 'finished', '', '2024-11-03 05:55:56', '2024-11-03 05:55:56', NULL, NULL),
(580, '9d65502d-ab89-45e8-b284-1515bc76b3a5', 1, 'Update', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, '', 'finished', '', '2024-11-03 05:57:04', '2024-11-03 05:57:04', '{\"tanggal_kak\":\"2024-11-01T16:00:00.000000Z\",\"generate_sk\":1,\"generate_st\":1}', '{\"tanggal_kak\":\"2024-11-01 16:00:00\",\"generate_sk\":true,\"generate_st\":true}'),
(581, '9d65504a-e0b8-425d-b001-a60cfc506182', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"6726a03c0ae9c\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-11-03 05:57:23', '2024-11-03 05:57:29', NULL, NULL),
(582, '9d65505e-0ed8-414a-a926-df8bf3b34a67', 1, 'Update', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, '', 'finished', '', '2024-11-03 05:57:35', '2024-11-03 05:57:35', '{\"tanggal_kak\":\"2024-10-31T16:00:00.000000Z\",\"generate_sk\":1,\"generate_st\":1}', '{\"tanggal_kak\":\"2024-10-31 16:00:00\",\"generate_sk\":true,\"generate_st\":true}'),
(583, '9d655088-cbc5-4df1-83bf-ae3346925965', 1, 'Update', 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, '', 'finished', '', '2024-11-03 05:58:04', '2024-11-03 05:58:04', '[]', '[]'),
(584, '9d65512b-6c73-4449-9e30-8883a2154e37', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"6726a0d22cb95\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-11-03 05:59:50', '2024-11-03 05:59:56', NULL, NULL),
(585, '9d655144-c9dd-4140-ad2b-8f6d1a654966', 1, 'Update', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, '', 'finished', '', '2024-11-03 06:00:07', '2024-11-03 06:00:07', '{\"tanggal_kak\":\"2024-10-30T16:00:00.000000Z\",\"generate_sk\":1,\"generate_st\":1}', '{\"tanggal_kak\":\"2024-10-30 16:00:00\",\"generate_sk\":true,\"generate_st\":true}'),
(586, '9d6551d1-073e-4c78-998d-4a7d2bc4763c', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'a:0:{}', 'finished', '', '2024-11-03 06:01:39', '2024-11-03 06:01:39', NULL, NULL),
(587, '9d65527d-2cf9-4864-be7c-a43172490865', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"6726a1af95856\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-11-03 06:03:31', '2024-11-03 06:03:38', NULL, NULL),
(588, '9d6552f7-7162-4efc-8afe-150d3057e1a9', 1, 'Update', 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, '', 'finished', '', '2024-11-03 06:04:52', '2024-11-03 06:04:52', '{\"volume_realisasi\":2}', '{\"volume_realisasi\":\"3\"}'),
(589, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 97, 'App\\Models\\DaftarKontrakMitra', 97, 'App\\Models\\DaftarKontrakMitra', 97, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(590, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 96, 'App\\Models\\DaftarKontrakMitra', 96, 'App\\Models\\DaftarKontrakMitra', 96, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(591, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 95, 'App\\Models\\DaftarKontrakMitra', 95, 'App\\Models\\DaftarKontrakMitra', 95, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(592, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 94, 'App\\Models\\DaftarKontrakMitra', 94, 'App\\Models\\DaftarKontrakMitra', 94, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(593, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 93, 'App\\Models\\DaftarKontrakMitra', 93, 'App\\Models\\DaftarKontrakMitra', 93, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(594, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 92, 'App\\Models\\DaftarKontrakMitra', 92, 'App\\Models\\DaftarKontrakMitra', 92, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(595, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 91, 'App\\Models\\DaftarKontrakMitra', 91, 'App\\Models\\DaftarKontrakMitra', 91, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(596, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 90, 'App\\Models\\DaftarKontrakMitra', 90, 'App\\Models\\DaftarKontrakMitra', 90, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(597, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 89, 'App\\Models\\DaftarKontrakMitra', 89, 'App\\Models\\DaftarKontrakMitra', 89, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(598, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 88, 'App\\Models\\DaftarKontrakMitra', 88, 'App\\Models\\DaftarKontrakMitra', 88, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(599, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 87, 'App\\Models\\DaftarKontrakMitra', 87, 'App\\Models\\DaftarKontrakMitra', 87, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(600, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 86, 'App\\Models\\DaftarKontrakMitra', 86, 'App\\Models\\DaftarKontrakMitra', 86, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(601, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 85, 'App\\Models\\DaftarKontrakMitra', 85, 'App\\Models\\DaftarKontrakMitra', 85, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(602, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 84, 'App\\Models\\DaftarKontrakMitra', 84, 'App\\Models\\DaftarKontrakMitra', 84, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(603, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 83, 'App\\Models\\DaftarKontrakMitra', 83, 'App\\Models\\DaftarKontrakMitra', 83, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(604, '9d6553b2-8e6e-44b8-b32f-6a53c4b9e9d2', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 82, 'App\\Models\\DaftarKontrakMitra', 82, 'App\\Models\\DaftarKontrakMitra', 82, 'a:2:{s:8:\"filename\";s:13:\"6726a27a1a05d\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:06:54', '2024-11-03 06:06:56', NULL, NULL),
(621, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 97, 'App\\Models\\DaftarKontrakMitra', 97, 'App\\Models\\DaftarKontrakMitra', 97, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(622, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 96, 'App\\Models\\DaftarKontrakMitra', 96, 'App\\Models\\DaftarKontrakMitra', 96, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(623, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 95, 'App\\Models\\DaftarKontrakMitra', 95, 'App\\Models\\DaftarKontrakMitra', 95, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(624, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 94, 'App\\Models\\DaftarKontrakMitra', 94, 'App\\Models\\DaftarKontrakMitra', 94, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(625, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 93, 'App\\Models\\DaftarKontrakMitra', 93, 'App\\Models\\DaftarKontrakMitra', 93, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(626, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 92, 'App\\Models\\DaftarKontrakMitra', 92, 'App\\Models\\DaftarKontrakMitra', 92, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(627, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 91, 'App\\Models\\DaftarKontrakMitra', 91, 'App\\Models\\DaftarKontrakMitra', 91, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(628, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 90, 'App\\Models\\DaftarKontrakMitra', 90, 'App\\Models\\DaftarKontrakMitra', 90, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(629, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 89, 'App\\Models\\DaftarKontrakMitra', 89, 'App\\Models\\DaftarKontrakMitra', 89, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(630, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 88, 'App\\Models\\DaftarKontrakMitra', 88, 'App\\Models\\DaftarKontrakMitra', 88, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(631, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 87, 'App\\Models\\DaftarKontrakMitra', 87, 'App\\Models\\DaftarKontrakMitra', 87, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(632, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 86, 'App\\Models\\DaftarKontrakMitra', 86, 'App\\Models\\DaftarKontrakMitra', 86, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(633, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 85, 'App\\Models\\DaftarKontrakMitra', 85, 'App\\Models\\DaftarKontrakMitra', 85, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(634, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 84, 'App\\Models\\DaftarKontrakMitra', 84, 'App\\Models\\DaftarKontrakMitra', 84, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(635, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 83, 'App\\Models\\DaftarKontrakMitra', 83, 'App\\Models\\DaftarKontrakMitra', 83, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(636, '9d655604-71c9-4276-b60c-cdfb152d4e98', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 82, 'App\\Models\\DaftarKontrakMitra', 82, 'App\\Models\\DaftarKontrakMitra', 82, 'a:2:{s:8:\"filename\";s:13:\"6726a3f0214ab\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:13:23', '2024-11-03 06:13:25', NULL, NULL),
(637, '9d65571e-97d2-4d43-914d-7f01c81e5b7f', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'a:0:{}', 'finished', '', '2024-11-03 06:16:28', '2024-11-03 06:16:30', NULL, NULL),
(638, '9d655745-f843-4213-b01f-56b7661f27bf', 1, 'Unduh SPJ', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:2:{s:8:\"filename\";s:13:\"6726a4c957549\";s:8:\"template\";s:1:\"4\";}', 'finished', '', '2024-11-03 06:16:54', '2024-11-03 06:17:00', NULL, NULL),
(639, '9d65576e-bf65-4ff8-99c1-6794dd15053c', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'a:0:{}', 'finished', '', '2024-11-03 06:17:21', '2024-11-03 06:17:23', NULL, NULL),
(640, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(641, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(642, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(643, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(644, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(645, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(646, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(647, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(648, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(649, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(650, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(651, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(652, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(653, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(654, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 2, 'App\\Models\\DaftarKontrakMitra', 2, 'App\\Models\\DaftarKontrakMitra', 2, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(655, '9d65578f-20d2-42f8-a564-7aa809f05491', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 1, 'App\\Models\\DaftarKontrakMitra', 1, 'App\\Models\\DaftarKontrakMitra', 1, 'a:2:{s:8:\"filename\";s:13:\"6726a50286f4b\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:17:42', '2024-11-03 06:17:43', NULL, NULL),
(656, '9d6557bd-de4c-472b-bc9c-a269fc869872', 1, 'Update', 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, '', 'finished', '', '2024-11-03 06:18:13', '2024-11-03 06:18:13', '{\"volume_realisasi\":3}', '{\"volume_realisasi\":\"2\"}'),
(657, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(658, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(659, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(660, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(661, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(662, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(663, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(664, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(665, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(666, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(667, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(668, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(669, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(670, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(671, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 2, 'App\\Models\\DaftarKontrakMitra', 2, 'App\\Models\\DaftarKontrakMitra', 2, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(672, '9d6557ef-e0ea-476c-b076-47e06142b176', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 1, 'App\\Models\\DaftarKontrakMitra', 1, 'App\\Models\\DaftarKontrakMitra', 1, 'a:2:{s:8:\"filename\";s:13:\"6726a541a0746\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:18:45', '2024-11-03 06:18:47', NULL, NULL),
(673, '9d655800-0574-41e0-91de-85f265d00270', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'a:0:{}', 'finished', '', '2024-11-03 06:18:56', '2024-11-03 06:18:56', NULL, NULL),
(674, '9d65581c-fd36-4a01-ba10-9236d3698ab1', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"6726a5530ccd3\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 06:19:15', '2024-11-03 06:19:15', NULL, NULL),
(675, '9d655b49-67f7-41c2-a9c1-75d98d93b3ad', 1, 'Update', 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, '', 'finished', '', '2024-11-03 06:28:07', '2024-11-03 06:28:07', '{\"volume_realisasi\":2}', '{\"volume_realisasi\":\"3\"}'),
(676, '9d655f55-59f0-467a-8831-b5c6c4133df5', 1, 'Update', 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, '', 'finished', '', '2024-11-03 06:39:26', '2024-11-03 06:39:26', '{\"volume_realisasi\":3}', '{\"volume_realisasi\":\"2\"}'),
(677, '9d656175-e00f-4770-b181-55f395b00c2a', 13, 'Update', 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, '', 'finished', '', '2024-11-03 06:45:23', '2024-11-03 06:45:23', '{\"volume_realisasi\":2}', '{\"volume_realisasi\":\"3\"}'),
(678, '9d6562e6-1ba6-438a-8312-b41763384416', 13, 'Update', 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, '', 'finished', '', '2024-11-03 06:49:25', '2024-11-03 06:49:25', '{\"volume_realisasi\":3}', '{\"volume_realisasi\":\"2\"}'),
(679, '9d6563e5-397c-4a58-aef3-350df454475c', 13, 'Update', 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, '', 'finished', '', '2024-11-03 06:52:12', '2024-11-03 06:52:12', '[]', '[]'),
(680, '9d6563fa-71f8-4d0c-afb9-de3181bdac03', 13, 'Update', 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, '', 'finished', '', '2024-11-03 06:52:26', '2024-11-03 06:52:26', '{\"kode_arsip_id\":29}', '{\"kode_arsip_id\":\"30\"}'),
(681, '9d6566c6-8bbd-4bfd-a48d-3500a7345645', 1, 'Update', 'App\\Models\\BastMitra', 7, 'App\\Models\\BastMitra', 7, 'App\\Models\\BastMitra', 7, '', 'finished', '', '2024-11-03 07:00:15', '2024-11-03 07:00:15', '{\"tanggal_bast\":null,\"kode_arsip_id\":null,\"ppk_user_id\":null}', '{\"tanggal_bast\":\"2024-12-31 00:00:00\",\"kode_arsip_id\":\"29\",\"ppk_user_id\":\"13\"}'),
(682, '9d6566cc-9f65-4f3e-b74a-03b4e8f63349', 1, 'Generate BAST Mitra', 'App\\Models\\BastMitra', 7, 'App\\Models\\BastMitra', 7, 'App\\Models\\BastMitra', 7, 'a:0:{}', 'finished', '', '2024-11-03 07:00:19', '2024-11-03 07:00:21', NULL, NULL),
(683, '9d65676c-c2e0-4a55-8496-6d5fb575caf7', 1, 'Delete', 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, 'App\\Models\\KontrakMitra', 7, '', 'finished', '', '2024-11-03 07:02:04', '2024-11-03 07:02:04', NULL, NULL),
(684, '9d65677d-9d48-45c9-a528-30ff2a289597', 1, 'Update', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, '', 'finished', '', '2024-11-03 07:02:15', '2024-11-03 07:02:15', '{\"tanggal_kak\":\"2024-10-29T16:00:00.000000Z\",\"generate_sk\":1,\"generate_st\":1}', '{\"tanggal_kak\":\"2024-10-29 16:00:00\",\"generate_sk\":true,\"generate_st\":true}'),
(685, '9d6567a6-4d1a-4772-82d2-9af2130b2ffe', 1, 'Update', 'App\\Models\\KontrakMitra', 8, 'App\\Models\\KontrakMitra', 8, 'App\\Models\\KontrakMitra', 8, '', 'finished', '', '2024-11-03 07:02:42', '2024-11-03 07:02:42', '{\"tanggal_spk\":null,\"ppk_user_id\":null,\"kode_arsip_id\":null}', '{\"tanggal_spk\":\"2024-11-03 00:00:00\",\"ppk_user_id\":\"13\",\"kode_arsip_id\":\"29\"}'),
(686, '9d6567bf-82ca-4f19-b3cd-fb47d574a80e', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 8, 'App\\Models\\KontrakMitra', 8, 'App\\Models\\KontrakMitra', 8, 'a:0:{}', 'finished', '', '2024-11-03 07:02:58', '2024-11-03 07:03:00', NULL, NULL),
(687, '9d6574de-8caf-47bd-b7e3-de51b873b67d', 1, 'Update', 'App\\Models\\BastMitra', 8, 'App\\Models\\BastMitra', 8, 'App\\Models\\BastMitra', 8, '', 'finished', '', '2024-11-03 07:39:40', '2024-11-03 07:39:40', '{\"tanggal_bast\":null,\"kode_arsip_id\":null,\"ppk_user_id\":null}', '{\"tanggal_bast\":\"2024-12-31 00:00:00\",\"kode_arsip_id\":\"29\",\"ppk_user_id\":\"13\"}'),
(688, '9d6574e9-abbd-454d-99cb-2878f0d31cc9', 1, 'Generate BAST Mitra', 'App\\Models\\BastMitra', 8, 'App\\Models\\BastMitra', 8, 'App\\Models\\BastMitra', 8, 'a:0:{}', 'finished', '', '2024-11-03 07:39:47', '2024-11-03 07:39:49', NULL, NULL),
(689, '9d657570-0b39-4707-bd6f-6c0fb70b1923', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 8, 'App\\Models\\KontrakMitra', 8, 'App\\Models\\KontrakMitra', 8, 'a:0:{}', 'finished', '', '2024-11-03 07:41:15', '2024-11-03 07:41:17', NULL, NULL),
(690, '9d65757b-7d3b-4958-b56a-a1e1538b0974', 1, 'Generate BAST Mitra', 'App\\Models\\BastMitra', 8, 'App\\Models\\BastMitra', 8, 'App\\Models\\BastMitra', 8, 'a:0:{}', 'finished', '', '2024-11-03 07:41:22', '2024-11-03 07:41:24', NULL, NULL),
(691, '9d6575b2-9a1c-4549-b3c3-e06b40e81b5c', 1, 'Update', 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, '', 'finished', '', '2024-11-03 07:41:58', '2024-11-03 07:41:58', '{\"volume_realisasi\":2}', '{\"volume_realisasi\":\"3\"}'),
(692, '9d6575f1-870f-4327-9be6-58bd3d93523b', 1, 'Generate Kontrak Mitra', 'App\\Models\\KontrakMitra', 8, 'App\\Models\\KontrakMitra', 8, 'App\\Models\\KontrakMitra', 8, 'a:0:{}', 'finished', '', '2024-11-03 07:42:40', '2024-11-03 07:42:40', NULL, NULL),
(693, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'App\\Models\\DaftarKontrakMitra', 16, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(694, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'App\\Models\\DaftarKontrakMitra', 15, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(695, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'App\\Models\\DaftarKontrakMitra', 14, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(696, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'App\\Models\\DaftarKontrakMitra', 13, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(697, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'App\\Models\\DaftarKontrakMitra', 12, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(698, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'App\\Models\\DaftarKontrakMitra', 11, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(699, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'App\\Models\\DaftarKontrakMitra', 10, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(700, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'App\\Models\\DaftarKontrakMitra', 9, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(701, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'App\\Models\\DaftarKontrakMitra', 8, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(702, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'App\\Models\\DaftarKontrakMitra', 7, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(703, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'App\\Models\\DaftarKontrakMitra', 6, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(704, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'App\\Models\\DaftarKontrakMitra', 5, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(705, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'App\\Models\\DaftarKontrakMitra', 4, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(706, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'App\\Models\\DaftarKontrakMitra', 3, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(707, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 2, 'App\\Models\\DaftarKontrakMitra', 2, 'App\\Models\\DaftarKontrakMitra', 2, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(708, '9d65760d-f918-402e-99a2-e3b4b782d8cc', 1, 'Unduh Kontrak', 'App\\Models\\DaftarKontrakMitra', 1, 'App\\Models\\DaftarKontrakMitra', 1, 'App\\Models\\DaftarKontrakMitra', 1, 'a:2:{s:8:\"filename\";s:13:\"6726b8fd119d7\";s:8:\"template\";s:1:\"8\";}', 'finished', '', '2024-11-03 07:42:58', '2024-11-03 07:43:00', NULL, NULL),
(709, '9d658bc1-6e54-404a-a3f2-633956b97081', 1, 'Create', 'App\\Models\\MasterPersediaan', 1, 'App\\Models\\MasterPersediaan', 1, 'App\\Models\\MasterPersediaan', 1, '', 'finished', '', '2024-11-03 08:43:39', '2024-11-03 08:43:39', NULL, '{\"kode\":\"1010301001000005\",\"barang\":\"Trigonal Clips Besar\",\"satuan\":\"Kotak\",\"updated_at\":\"2024-11-03T00:43:39.000000Z\",\"created_at\":\"2024-11-03T00:43:39.000000Z\",\"id\":1}'),
(710, '9d65bae6-dc4c-4cea-ab52-930bc2cce27d', 1, 'Create', 'App\\Models\\Template', 10, 'App\\Models\\Template', 10, 'App\\Models\\Template', 10, '', 'finished', '', '2024-11-03 10:55:29', '2024-11-03 10:55:29', NULL, '{\"nama\":\"Template Import Master Persediaan\",\"jenis\":\"import\",\"file\":\"zUCmuLwHj8P0d50lunRAYlQGESuUTwaECHs7hvEx.xlsx\",\"updated_at\":\"2024-11-03T02:55:29.000000Z\",\"created_at\":\"2024-11-03T02:55:29.000000Z\",\"id\":10}'),
(711, '9d6631b6-3ada-4117-8eef-c097ba61e517', 1, 'Create', 'App\\Models\\Template', 11, 'App\\Models\\Template', 11, 'App\\Models\\Template', 11, '', 'finished', '', '2024-11-03 16:27:42', '2024-11-03 16:27:42', NULL, '{\"nama\":\"Template BAST Barang Persediaan\",\"jenis\":\"bastp\",\"file\":\"8XlIOq9mjiZWYRhQE22KUkPKRDLzZDOdqtjoJiyy.docx\",\"updated_at\":\"2024-11-03T08:27:42.000000Z\",\"created_at\":\"2024-11-03T08:27:42.000000Z\",\"id\":11}'),
(712, '9d6631dc-7b52-4717-a225-a1fe91681b99', 1, 'Create', 'App\\Models\\Template', 12, 'App\\Models\\Template', 12, 'App\\Models\\Template', 12, '', 'finished', '', '2024-11-03 16:28:07', '2024-11-03 16:28:07', NULL, '{\"nama\":\"Template Bon Persediaan\",\"jenis\":\"bon\",\"file\":\"kA4gjL7ih9kVU5CNpew9noR35RJpPuPq8rgPvZ3B.docx\",\"updated_at\":\"2024-11-03T08:28:07.000000Z\",\"created_at\":\"2024-11-03T08:28:07.000000Z\",\"id\":12}'),
(713, '9d6651b2-1e05-4e4d-9025-0a1721ada31c', 1, 'Create', 'App\\Models\\KerangkaAcuan', 8, 'App\\Models\\KerangkaAcuan', 8, 'App\\Models\\KerangkaAcuan', 8, '', 'finished', '', '2024-11-03 17:57:08', '2024-11-03 17:57:08', NULL, '{\"tanggal\":\"2024-11-02T16:00:00.000000Z\",\"rincian\":\"Pembelian Kertas F4\",\"latar\":\"Kegiatan PLKUMKM merupakan salah satu kegiatan yang dilakukan oleh Badan Pusat Statistik dalam rangka mendukung penyediaan Data Statistik sesuai amanat Undang-Undang no 16 Tahun 1997. Agar kegiatan tersebut dapat berjalan dengan lancar dan tepat waktu diperlukan adanya penyediaan ATK Pelatihan Petugas PLKUMKM sebagai sarana penunjang kegiatan yang dilaksanakan.\",\"maksud\":\"Maksud dari pelaksanaan kegiatan ini adalah untuk\",\"tujuan\":\"Tujuan dari pelaksanaan kegiatan ini adalah\",\"sasaran\":\"Target\\/sasaran yang ingin dicapai terkait dengan pelaksanaan kegiatan ini adalah\",\"kegiatan\":\"Administrasi\",\"awal\":\"2024-11-02T16:00:00.000000Z\",\"akhir\":\"2024-11-04T16:00:00.000000Z\",\"jenis\":\"Penyedia\",\"metode\":\"Pengadaan Langsung\",\"tkdn\":\"Ya\",\"koordinator_user_id\":\"1\",\"ppk_user_id\":\"13\",\"dipa_id\":\"1\",\"unit_kerja_id\":1,\"status\":\"dibuat\",\"naskah_keluar_id\":256,\"updated_at\":\"2024-11-03T09:57:08.000000Z\",\"created_at\":\"2024-11-03T09:57:08.000000Z\",\"id\":8}'),
(714, '9d66520d-bb87-47a2-9c2e-7d6a47fb5a95', 1, 'Unduh KAK', 'App\\Models\\KerangkaAcuan', 8, 'App\\Models\\KerangkaAcuan', 8, 'App\\Models\\KerangkaAcuan', 8, 'a:2:{s:8:\"filename\";s:13:\"672749274c4f9\";s:8:\"template\";s:1:\"3\";}', 'finished', '', '2024-11-03 17:58:08', '2024-11-03 17:58:08', NULL, NULL),
(715, '9d6652f0-aab6-4f5c-90fd-8b5e8b29ef58', 1, 'Update', 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, '', 'finished', '', '2024-11-03 18:00:37', '2024-11-03 18:00:37', '[]', '[]'),
(716, '9d665395-7e8f-4b9b-a073-aead84cd71c2', 1, 'Update', 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, '', 'finished', '', '2024-11-03 18:02:25', '2024-11-03 18:02:25', '{\"perkiraan\":100000}', '{\"perkiraan\":\"75000\"}'),
(717, '9d6653a7-573b-4bcb-add2-b4270c364789', 1, 'Update', 'App\\Models\\SpesifikasiKerangkaAcuan', 9, 'App\\Models\\SpesifikasiKerangkaAcuan', 9, 'App\\Models\\SpesifikasiKerangkaAcuan', 9, '', 'finished', '', '2024-11-03 18:02:37', '2024-11-03 18:02:37', '{\"harga_satuan\":100000}', '{\"harga_satuan\":\"75000\"}'),
(718, '9d665619-f4da-4bdf-b32e-835675536766', 1, 'Update', 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, '', 'finished', '', '2024-11-03 18:09:27', '2024-11-03 18:09:27', '{\"perkiraan\":75000}', '{\"perkiraan\":\"100000\"}'),
(719, '9d685049-c2fa-4e95-a912-bc79bf7bc024', 1, 'Create', 'App\\Models\\BarangPersediaan', 1, 'App\\Models\\BarangPersediaan', 1, 'App\\Models\\BarangPersediaan', 1, '', 'finished', '', '2024-11-04 17:44:51', '2024-11-04 17:44:51', NULL, '{\"barang_persediaanable_id\":2,\"barang_persediaanable_type\":\"App\\\\Models\\\\PembelianPersediaan\",\"updated_at\":\"2024-11-04T09:44:51.000000Z\",\"created_at\":\"2024-11-04T09:44:51.000000Z\",\"id\":1}'),
(720, '9d685060-6d02-4c39-abf5-24394d7eba98', 1, 'Delete', 'App\\Models\\BarangPersediaan', 1, 'App\\Models\\BarangPersediaan', 1, 'App\\Models\\BarangPersediaan', 1, '', 'finished', '', '2024-11-04 17:45:06', '2024-11-04 17:45:06', NULL, NULL),
(721, '9d68544a-63a3-448c-913e-61b8029014f6', 1, 'Create', 'App\\Models\\BarangPersediaan', 2, 'App\\Models\\BarangPersediaan', 2, 'App\\Models\\BarangPersediaan', 2, '', 'finished', '', '2024-11-04 17:56:03', '2024-11-04 17:56:03', NULL, '{\"barang\":\"Sass\",\"volume\":\"2\",\"satuan\":\"Dus\",\"barang_persediaanable_id\":2,\"barang_persediaanable_type\":\"App\\\\Models\\\\PembelianPersediaan\",\"updated_at\":\"2024-11-04T09:56:03.000000Z\",\"created_at\":\"2024-11-04T09:56:03.000000Z\",\"id\":2}'),
(722, '9d6854f8-b5c3-4f6d-b849-39a3c6cf4bdf', 1, 'Update', 'App\\Models\\BarangPersediaan', 2, 'App\\Models\\BarangPersediaan', 2, 'App\\Models\\BarangPersediaan', 2, '', 'finished', '', '2024-11-04 17:57:57', '2024-11-04 17:57:57', '[]', '[]'),
(725, '9d69600b-1a18-4be1-b5ee-e955ef9626f2', 1, 'Create', 'App\\Models\\BarangPersediaan', 5, 'App\\Models\\BarangPersediaan', 5, 'App\\Models\\BarangPersediaan', 5, '', 'finished', '', '2024-11-05 06:24:44', '2024-11-05 06:24:44', NULL, '{\"barang\":\"aa\",\"volume\":\"1\",\"satuan\":\"s\",\"barang_persediaanable_id\":2,\"barang_persediaanable_type\":\"App\\\\Models\\\\PembelianPersediaan\",\"updated_at\":\"2024-11-04T22:24:44.000000Z\",\"created_at\":\"2024-11-04T22:24:44.000000Z\",\"id\":5}'),
(726, '9d696010-dd07-448d-8ac1-ba3c8c26a8fa', 1, 'Delete', 'App\\Models\\BarangPersediaan', 5, 'App\\Models\\BarangPersediaan', 5, 'App\\Models\\BarangPersediaan', 5, '', 'finished', '', '2024-11-05 06:24:48', '2024-11-05 06:24:48', NULL, NULL),
(728, '9d696617-6208-4533-ab9c-aad75baeb5b0', 1, 'Update', 'App\\Models\\BarangPersediaan', 6, 'App\\Models\\BarangPersediaan', 6, 'App\\Models\\BarangPersediaan', 6, '', 'finished', '', '2024-11-05 06:41:39', '2024-11-05 06:41:39', '{\"master_persediaan_id\":null}', '{\"master_persediaan_id\":1}');
INSERT INTO `action_events` (`id`, `batch_id`, `user_id`, `name`, `actionable_type`, `actionable_id`, `target_type`, `target_id`, `model_type`, `model_id`, `fields`, `status`, `exception`, `created_at`, `updated_at`, `original`, `changes`) VALUES
(730, '9d696904-8e07-4666-a55d-1c70afe3babc', 1, 'Update', 'App\\Models\\BarangPersediaan', 7, 'App\\Models\\BarangPersediaan', 7, 'App\\Models\\BarangPersediaan', 7, '', 'finished', '', '2024-11-05 06:49:50', '2024-11-05 06:49:50', '{\"master_persediaan_id\":null}', '{\"master_persediaan_id\":3}'),
(731, '9d696933-8134-401d-b3fa-f597b4b79eca', 1, 'Update', 'App\\Models\\BarangPersediaan', 7, 'App\\Models\\BarangPersediaan', 7, 'App\\Models\\BarangPersediaan', 7, '', 'finished', '', '2024-11-05 06:50:21', '2024-11-05 06:50:21', '{\"master_persediaan_id\":3}', '{\"master_persediaan_id\":46}'),
(732, '9d696c18-7aa4-4da9-9c71-d9148417caf1', 1, 'Update', 'App\\Models\\BarangPersediaan', 7, 'App\\Models\\BarangPersediaan', 7, 'App\\Models\\BarangPersediaan', 7, '', 'finished', '', '2024-11-05 06:58:26', '2024-11-05 06:58:26', '{\"master_persediaan_id\":46}', '{\"master_persediaan_id\":220}'),
(733, '9d696d64-8734-41bf-ae93-3010c23185f9', 1, 'Create', 'App\\Models\\BarangPersediaan', 8, 'App\\Models\\BarangPersediaan', 8, 'App\\Models\\BarangPersediaan', 8, '', 'finished', '', '2024-11-05 07:02:04', '2024-11-05 07:02:04', NULL, '{\"master_persediaan_id\":4,\"volume\":\"1\",\"harga_satuan\":\"10000\",\"barang_persediaanable_id\":2,\"barang_persediaanable_type\":\"App\\\\Models\\\\PembelianPersediaan\",\"total_harga\":10000,\"barang\":\"Binder Clips 155\",\"satuan\":\"Dozz\",\"updated_at\":\"2024-11-04T23:02:04.000000Z\",\"created_at\":\"2024-11-04T23:02:04.000000Z\",\"id\":8}'),
(734, '9d696ed3-0dc3-4bc6-9e5e-55d3b3b87da7', 1, 'Update', 'App\\Models\\BarangPersediaan', 8, 'App\\Models\\BarangPersediaan', 8, 'App\\Models\\BarangPersediaan', 8, '', 'finished', '', '2024-11-05 07:06:04', '2024-11-05 07:06:04', '{\"master_persediaan_id\":4}', '{\"master_persediaan_id\":41}'),
(737, '9d6a4a1d-8eb4-4959-9cb2-8598a67a79b2', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-05 17:19:15', '2024-11-05 17:19:15', NULL, NULL),
(738, '9d6a4cb4-c790-41a2-a39a-afc9ee664127', 1, 'Tandai Telah Diberi Kode', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-05 17:26:30', '2024-11-05 17:26:30', NULL, NULL),
(739, '9d6a51a0-a63f-4284-8085-9c68ad872df5', 1, 'Delete', 'App\\Models\\BarangPersediaan', 7, 'App\\Models\\BarangPersediaan', 7, 'App\\Models\\BarangPersediaan', 7, '', 'finished', '', '2024-11-05 17:40:15', '2024-11-05 17:40:15', NULL, NULL),
(740, '9d6a5266-ba09-435c-8658-c75ce1965fe4', 1, 'Impor dari KAK', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-05 17:42:25', '2024-11-05 17:42:25', NULL, NULL),
(741, '9d6a527d-2f33-4dd1-acf3-d820fb251373', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-05 17:42:40', '2024-11-05 17:42:40', NULL, NULL),
(742, '9d6a5287-9e83-44cc-801b-46f0c3ef5ce2', 1, 'Delete', 'App\\Models\\BarangPersediaan', 9, 'App\\Models\\BarangPersediaan', 9, 'App\\Models\\BarangPersediaan', 9, '', 'finished', '', '2024-11-05 17:42:47', '2024-11-05 17:42:47', NULL, NULL),
(743, '9d6a551d-6f43-4d57-92b6-f1006a275bf6', 1, 'Impor dari KAK', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-05 17:50:00', '2024-11-05 17:50:00', NULL, NULL),
(744, '9d6a552e-1383-4ae7-9eba-5fbd7e9c177b', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-05 17:50:11', '2024-11-05 17:50:11', NULL, NULL),
(745, '9d6a5539-9adb-49d2-9225-cb1368b91c8e', 1, 'Delete', 'App\\Models\\BarangPersediaan', 10, 'App\\Models\\BarangPersediaan', 10, 'App\\Models\\BarangPersediaan', 10, '', 'finished', '', '2024-11-05 17:50:19', '2024-11-05 17:50:19', NULL, NULL),
(746, '9d6a5547-13be-4f6c-ac71-542a83414b71', 1, 'Impor dari KAK', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-05 17:50:28', '2024-11-05 17:50:28', NULL, NULL),
(747, '9d6a554b-2a4a-4e34-b65d-3e151c2301e1', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-05 17:50:30', '2024-11-05 17:50:30', NULL, NULL),
(748, '9d6a6db1-3f4c-4387-bcc5-439423951a46', 1, 'Create', 'App\\Models\\BarangPersediaan', 12, 'App\\Models\\BarangPersediaan', 12, 'App\\Models\\BarangPersediaan', 12, '', 'finished', '', '2024-11-05 18:58:44', '2024-11-05 18:58:44', NULL, '{\"master_persediaan_id\":510,\"volume\":\"1\",\"barang_persediaanable_id\":2,\"barang_persediaanable_type\":\"App\\\\Models\\\\PembelianPersediaan\",\"total_harga\":0,\"barang\":\"Baterai Alkalin AA\",\"satuan\":\"Set\",\"updated_at\":\"2024-11-05T10:58:44.000000Z\",\"created_at\":\"2024-11-05T10:58:44.000000Z\",\"id\":12}'),
(749, '9d6a6dbf-b160-4b27-a21c-9ff69cabb0fa', 1, 'Delete', 'App\\Models\\BarangPersediaan', 12, 'App\\Models\\BarangPersediaan', 12, 'App\\Models\\BarangPersediaan', 12, '', 'finished', '', '2024-11-05 18:58:53', '2024-11-05 18:58:53', NULL, NULL),
(750, '9d6a6dec-4e11-45a1-b435-df24337503ec', 1, 'Create', 'App\\Models\\BarangPersediaan', 13, 'App\\Models\\BarangPersediaan', 13, 'App\\Models\\BarangPersediaan', 13, '', 'finished', '', '2024-11-05 18:59:22', '2024-11-05 18:59:22', NULL, '{\"master_persediaan_id\":2,\"volume\":\"2\",\"barang_persediaanable_id\":2,\"barang_persediaanable_type\":\"App\\\\Models\\\\PembelianPersediaan\",\"total_harga\":0,\"barang\":\"Binder Clips 107\",\"satuan\":\"Dozz\",\"updated_at\":\"2024-11-05T10:59:22.000000Z\",\"created_at\":\"2024-11-05T10:59:22.000000Z\",\"id\":13}'),
(751, '9d6b5b8f-bb9b-4680-a25c-5fd87e633e6c', 1, 'Create', 'App\\Models\\BarangPersediaan', 14, 'App\\Models\\BarangPersediaan', 14, 'App\\Models\\BarangPersediaan', 14, '', 'finished', '', '2024-11-06 06:03:52', '2024-11-06 06:03:52', NULL, '{\"barang\":\"Kertas A4\",\"volume\":\"2\",\"satuan\":\"Rim\",\"harga_satuan\":\"10000\",\"barang_persediaanable_id\":2,\"barang_persediaanable_type\":\"App\\\\Models\\\\PembelianPersediaan\",\"total_harga\":20000,\"updated_at\":\"2024-11-05T22:03:52.000000Z\",\"created_at\":\"2024-11-05T22:03:52.000000Z\",\"id\":14}'),
(752, '9d6b6356-059d-474c-a7c3-620e9cb2fb03', 1, 'Impor dari KAK', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-06 06:25:36', '2024-11-06 06:25:36', NULL, NULL),
(753, '9d6b69bb-931b-4f18-ac34-dfdb04eba951', 1, 'Create', 'App\\Models\\BarangPersediaan', 17, 'App\\Models\\BarangPersediaan', 17, 'App\\Models\\BarangPersediaan', 17, '', 'finished', '', '2024-11-06 06:43:29', '2024-11-06 06:43:29', NULL, '{\"barang\":\"aaa\",\"satuan\":\"buah\",\"volume\":\"2\",\"harga_satuan\":\"10000\",\"barang_persediaanable_id\":2,\"barang_persediaanable_type\":\"App\\\\Models\\\\PembelianPersediaan\",\"total_harga\":20000,\"updated_at\":\"2024-11-05T22:43:29.000000Z\",\"created_at\":\"2024-11-05T22:43:29.000000Z\",\"id\":17}'),
(754, '9d6b69c3-01c4-42c2-a741-ab02999db31c', 1, 'Delete', 'App\\Models\\BarangPersediaan', 17, 'App\\Models\\BarangPersediaan', 17, 'App\\Models\\BarangPersediaan', 17, '', 'finished', '', '2024-11-06 06:43:34', '2024-11-06 06:43:34', NULL, NULL),
(755, '9d6b71b0-3279-45c5-8670-8cc9a4f617a0', 1, 'Create', 'App\\Models\\BarangPersediaan', 18, 'App\\Models\\BarangPersediaan', 18, 'App\\Models\\BarangPersediaan', 18, '', 'finished', '', '2024-11-06 07:05:44', '2024-11-06 07:05:44', NULL, '{\"barang\":\"Zz\",\"satuan\":\"22\",\"volume\":\"22\",\"harga_satuan\":\"10000\",\"barang_persediaanable_id\":2,\"barang_persediaanable_type\":\"App\\\\Models\\\\PembelianPersediaan\",\"total_harga\":220000,\"updated_at\":\"2024-11-05T23:05:44.000000Z\",\"created_at\":\"2024-11-05T23:05:44.000000Z\",\"id\":18}'),
(756, '9d6b71b8-8ebd-4367-84d9-b2492af240a1', 1, 'Delete', 'App\\Models\\BarangPersediaan', 18, 'App\\Models\\BarangPersediaan', 18, 'App\\Models\\BarangPersediaan', 18, '', 'finished', '', '2024-11-06 07:05:49', '2024-11-06 07:05:49', NULL, NULL),
(757, '9d6b74aa-a37b-4ae8-8f0b-e687630c28d4', 1, 'Create', 'App\\Models\\BarangPersediaan', 19, 'App\\Models\\BarangPersediaan', 19, 'App\\Models\\BarangPersediaan', 19, '', 'finished', '', '2024-11-06 07:14:04', '2024-11-06 07:14:04', NULL, '{\"total_harga\":0,\"updated_at\":\"2024-11-05T23:14:03.000000Z\",\"created_at\":\"2024-11-05T23:14:03.000000Z\",\"id\":19}'),
(758, '9d6b74ae-4252-45a9-9e33-3a56483b0adb', 1, 'Create', 'App\\Models\\BarangPersediaan', 20, 'App\\Models\\BarangPersediaan', 20, 'App\\Models\\BarangPersediaan', 20, '', 'finished', '', '2024-11-06 07:14:06', '2024-11-06 07:14:06', NULL, '{\"total_harga\":0,\"updated_at\":\"2024-11-05T23:14:06.000000Z\",\"created_at\":\"2024-11-05T23:14:06.000000Z\",\"id\":20}'),
(759, '9d6b74af-f47a-4fdc-9da6-2ea4a1a74bf3', 1, 'Create', 'App\\Models\\BarangPersediaan', 21, 'App\\Models\\BarangPersediaan', 21, 'App\\Models\\BarangPersediaan', 21, '', 'finished', '', '2024-11-06 07:14:07', '2024-11-06 07:14:07', NULL, '{\"total_harga\":0,\"updated_at\":\"2024-11-05T23:14:07.000000Z\",\"created_at\":\"2024-11-05T23:14:07.000000Z\",\"id\":21}'),
(760, '9d6b7f61-dca7-430b-915e-15067c69ae5f', 1, 'Impor dari KAK', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-06 07:44:01', '2024-11-06 07:44:01', NULL, NULL),
(761, '9d6b7f67-f2e7-413a-ad42-6e85c23522ed', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-06 07:44:05', '2024-11-06 07:44:05', NULL, NULL),
(762, '9d6b7f6e-b2b1-40fb-8bf6-2b92a1380a2c', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-06 07:44:10', '2024-11-06 07:44:10', NULL, NULL),
(763, '9d7173ae-6ad3-4afe-871b-316ba9e01020', 1, 'Impor dari KAK', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-09 06:46:16', '2024-11-09 06:46:16', NULL, NULL),
(764, '9d7173c2-8029-4130-b5fa-f3972dd96e45', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-09 06:46:29', '2024-11-09 06:46:29', NULL, NULL),
(765, '9d7173ce-4792-4ebb-bd8c-f23b28551d67', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-09 06:46:37', '2024-11-09 06:46:37', NULL, NULL),
(766, '9d717773-da67-42df-bc4d-71354cc1b762', 1, 'Impor dari KAK', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-09 06:56:49', '2024-11-09 06:56:49', NULL, NULL),
(767, '9d71777b-bb32-4ec2-b978-6d8c27b559f8', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-09 06:56:54', '2024-11-09 06:56:54', NULL, NULL),
(768, '9d7178b7-6742-4231-aa62-f883ba008ab2', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-09 07:00:21', '2024-11-09 07:00:21', NULL, NULL),
(769, '9d7179b8-416a-4c77-8a46-9297d4a04be3', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-09 07:03:09', '2024-11-09 07:03:09', NULL, NULL),
(770, '9d7179c4-b68e-4a4e-86d5-75e5b26f39be', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-09 07:03:18', '2024-11-09 07:03:18', NULL, NULL),
(771, '9d717a17-ef3d-47a7-8f7a-f3953e0b7f33', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-09 07:04:12', '2024-11-09 07:04:12', NULL, NULL),
(772, '9d717a85-b077-4aa2-bb69-5197325674ce', 1, 'Update', 'App\\Models\\BarangPersediaan', 27, 'App\\Models\\BarangPersediaan', 27, 'App\\Models\\BarangPersediaan', 27, '', 'finished', '', '2024-11-09 07:05:24', '2024-11-09 07:05:24', '{\"master_persediaan_id\":null}', '{\"master_persediaan_id\":32}'),
(773, '9d717a9c-6c35-4e11-ad13-7320092dbfed', 1, 'Update', 'App\\Models\\BarangPersediaan', 26, 'App\\Models\\BarangPersediaan', 26, 'App\\Models\\BarangPersediaan', 26, '', 'finished', '', '2024-11-09 07:05:39', '2024-11-09 07:05:39', '{\"master_persediaan_id\":null}', '{\"master_persediaan_id\":220}'),
(774, '9d717aeb-fa2b-4df4-aac1-a6b521e98712', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-09 07:06:31', '2024-11-09 07:06:31', NULL, NULL),
(775, '9d717b04-f769-45e2-a11a-c741f5949d51', 1, 'Update', 'App\\Models\\BarangPersediaan', 27, 'App\\Models\\BarangPersediaan', 27, 'App\\Models\\BarangPersediaan', 27, '', 'finished', '', '2024-11-09 07:06:47', '2024-11-09 07:06:47', '[]', '[]'),
(776, '9d717b2b-b833-412a-9d2d-672a407cacb5', 1, 'Update', 'App\\Models\\BarangPersediaan', 27, 'App\\Models\\BarangPersediaan', 27, 'App\\Models\\BarangPersediaan', 27, '', 'finished', '', '2024-11-09 07:07:13', '2024-11-09 07:07:13', '{\"master_persediaan_id\":32}', '{\"master_persediaan_id\":41}'),
(777, '9d717c5d-3121-4450-aa01-23e0a3c18eb0', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-09 07:10:33', '2024-11-09 07:10:33', NULL, NULL),
(778, '9d717f5e-82c2-4f0f-80ed-0b4d46ddfd15', 1, 'Tandai Telah Diberi Kode', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-09 07:18:57', '2024-11-09 07:18:57', NULL, NULL),
(779, '9d717f72-5b46-4bdb-88af-adad8759efed', 1, 'Update', 'App\\Models\\BarangPersediaan', 27, 'App\\Models\\BarangPersediaan', 27, 'App\\Models\\BarangPersediaan', 27, '', 'finished', '', '2024-11-09 07:19:10', '2024-11-09 07:19:10', '[]', '[]'),
(780, '9d717f99-9e1c-43ae-b1ab-a0a94850dbd3', 1, 'Update', 'App\\Models\\BarangPersediaan', 27, 'App\\Models\\BarangPersediaan', 27, 'App\\Models\\BarangPersediaan', 27, '', 'finished', '', '2024-11-09 07:19:36', '2024-11-09 07:19:36', '{\"master_persediaan_id\":41}', '{\"master_persediaan_id\":1}'),
(781, '9d71803a-4470-40a5-b4fa-778113f0cd79', 1, 'Update', 'App\\Models\\BarangPersediaan', 27, 'App\\Models\\BarangPersediaan', 27, 'App\\Models\\BarangPersediaan', 27, '', 'finished', '', '2024-11-09 07:21:21', '2024-11-09 07:21:21', '{\"master_persediaan_id\":1}', '{\"master_persediaan_id\":35}'),
(782, '9d71815f-bc0b-4c2a-9ce4-02e988259ff2', 1, 'Impor dari KAK', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'a:0:{}', 'finished', '', '2024-11-09 07:24:34', '2024-11-09 07:24:34', NULL, NULL),
(783, '9d71818a-8c37-4e3b-9223-4a78d71fcdd8', 1, 'Delete', 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, 'App\\Models\\PembelianPersediaan', 2, '', 'finished', '', '2024-11-09 07:25:02', '2024-11-09 07:25:02', NULL, NULL),
(784, '9d71826f-6151-4ed3-a0e0-1432dd05c5c9', 1, 'Update', 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, '', 'finished', '', '2024-11-09 07:27:32', '2024-11-09 07:27:32', '[]', '[]'),
(785, '9d7182af-6511-4c9e-afc8-7a0d10db455c', 1, 'Update', 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, '', 'finished', '', '2024-11-09 07:28:13', '2024-11-09 07:28:13', '{\"perkiraan\":100000}', '{\"perkiraan\":\"150000\"}'),
(786, '9d7182c5-60c7-407a-b325-75741178e574', 1, 'Impor dari KAK', 'App\\Models\\PembelianPersediaan', 3, 'App\\Models\\PembelianPersediaan', 3, 'App\\Models\\PembelianPersediaan', 3, 'a:0:{}', 'finished', '', '2024-11-09 07:28:28', '2024-11-09 07:28:28', NULL, NULL),
(787, '9d7182da-b97c-47d3-a032-631ed50f976e', 1, 'Update', 'App\\Models\\BarangPersediaan', 31, 'App\\Models\\BarangPersediaan', 31, 'App\\Models\\BarangPersediaan', 31, '', 'finished', '', '2024-11-09 07:28:42', '2024-11-09 07:28:42', '[]', '[]'),
(788, '9d71830b-4bb5-442d-9b82-f50adceb8f1e', 1, 'Impor dari KAK', 'App\\Models\\PembelianPersediaan', 3, 'App\\Models\\PembelianPersediaan', 3, 'App\\Models\\PembelianPersediaan', 3, 'a:0:{}', 'finished', '', '2024-11-09 07:29:14', '2024-11-09 07:29:14', NULL, NULL),
(789, '9d71833f-2cf5-4139-a2bc-6a3a292ccc19', 1, 'Update', 'App\\Models\\PembelianPersediaan', 3, 'App\\Models\\PembelianPersediaan', 3, 'App\\Models\\PembelianPersediaan', 3, '', 'finished', '', '2024-11-09 07:29:48', '2024-11-09 07:29:48', '{\"tanggal_kak\":\"2024-11-02T16:00:00.000000Z\",\"tanggal_bast\":null,\"tanggal_buku\":null,\"ppk_user_id\":null,\"pbmn_user_id\":null}', '{\"tanggal_kak\":\"2024-11-02 16:00:00\",\"tanggal_bast\":\"2024-11-09 00:00:00\",\"tanggal_buku\":\"2024-11-09 00:00:00\",\"ppk_user_id\":\"13\",\"pbmn_user_id\":\"25\"}'),
(790, '9d71835f-f98a-40a7-8bed-34edae720c90', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 3, 'App\\Models\\PembelianPersediaan', 3, 'App\\Models\\PembelianPersediaan', 3, 'a:0:{}', 'finished', '', '2024-11-09 07:30:09', '2024-11-09 07:30:09', NULL, NULL),
(791, '9d71837d-c466-49f0-b46d-2627d62a47d7', 1, 'Delete', 'App\\Models\\PembelianPersediaan', 3, 'App\\Models\\PembelianPersediaan', 3, 'App\\Models\\PembelianPersediaan', 3, '', 'finished', '', '2024-11-09 07:30:29', '2024-11-09 07:30:29', NULL, NULL),
(792, '9d719773-bee3-4296-8ad1-efefb9fd6bdc', 1, 'Update', 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, '', 'finished', '', '2024-11-09 08:26:18', '2024-11-09 08:26:18', '{\"perkiraan\":150000}', '{\"perkiraan\":\"100000\"}'),
(793, '9d71978a-989c-4345-82b3-5eda79ef0b65', 1, 'Impor dari KAK', 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'a:0:{}', 'finished', '', '2024-11-09 08:26:33', '2024-11-09 08:26:33', NULL, NULL),
(794, '9d71979e-17ee-4b47-b7d2-0ba6c0253d04', 1, 'Update', 'App\\Models\\BarangPersediaan', 35, 'App\\Models\\BarangPersediaan', 35, 'App\\Models\\BarangPersediaan', 35, '', 'finished', '', '2024-11-09 08:26:45', '2024-11-09 08:26:45', '{\"barang\":\"AAA\"}', '{\"barang\":\"Baaa\"}'),
(795, '9d7197b3-afe6-40a6-a8bd-35e9859379ee', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'a:0:{}', 'finished', '', '2024-11-09 08:27:00', '2024-11-09 08:27:00', NULL, NULL),
(796, '9d7197d7-0fe9-43b6-974c-fdb3f81270f5', 1, 'Update', 'App\\Models\\BarangPersediaan', 35, 'App\\Models\\BarangPersediaan', 35, 'App\\Models\\BarangPersediaan', 35, '', 'finished', '', '2024-11-09 08:27:23', '2024-11-09 08:27:23', '{\"barang\":\"Baaa\"}', '{\"barang\":\"Bauu\"}'),
(797, '9d7197e3-1214-4122-bfd2-64440a19a695', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'a:0:{}', 'finished', '', '2024-11-09 08:27:31', '2024-11-09 08:27:31', NULL, NULL),
(798, '9d719a26-77ba-4777-bcb2-e63e57166058', 1, 'Update', 'App\\Models\\BarangPersediaan', 35, 'App\\Models\\BarangPersediaan', 35, 'App\\Models\\BarangPersediaan', 35, '', 'finished', '', '2024-11-09 08:33:50', '2024-11-09 08:33:50', '[]', '[]'),
(799, '9d719a3a-6eae-4841-a641-402b51f7b431', 1, 'Update', 'App\\Models\\BarangPersediaan', 35, 'App\\Models\\BarangPersediaan', 35, 'App\\Models\\BarangPersediaan', 35, '', 'finished', '', '2024-11-09 08:34:03', '2024-11-09 08:34:03', '{\"barang\":\"Bauu\"}', '{\"barang\":\"Bauus\"}'),
(800, '9d719a48-07d2-42db-8749-7931e16b36d4', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'a:0:{}', 'finished', '', '2024-11-09 08:34:12', '2024-11-09 08:34:12', NULL, NULL),
(801, '9d719a87-0e01-4bbc-b65e-796a1b70cb3b', 1, 'Update', 'App\\Models\\BarangPersediaan', 35, 'App\\Models\\BarangPersediaan', 35, 'App\\Models\\BarangPersediaan', 35, '', 'finished', '', '2024-11-09 08:34:54', '2024-11-09 08:34:54', '{\"master_persediaan_id\":null}', '{\"master_persediaan_id\":32}'),
(802, '9d719abc-9368-4f15-9fd7-ca3f6751828c', 1, 'Update', 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, '', 'finished', '', '2024-11-09 08:35:29', '2024-11-09 08:35:29', '{\"tanggal_kak\":\"2024-11-02T16:00:00.000000Z\",\"tanggal_bast\":null,\"tanggal_buku\":null,\"ppk_user_id\":null,\"pbmn_user_id\":null}', '{\"tanggal_kak\":\"2024-11-02 16:00:00\",\"tanggal_bast\":\"2024-11-09 00:00:00\",\"tanggal_buku\":\"2024-11-09 00:00:00\",\"ppk_user_id\":\"13\",\"pbmn_user_id\":\"25\"}'),
(803, '9d719ae7-1aec-4547-8e0b-feda8171d55a', 1, 'Update', 'App\\Models\\BarangPersediaan', 34, 'App\\Models\\BarangPersediaan', 34, 'App\\Models\\BarangPersediaan', 34, '', 'finished', '', '2024-11-09 08:35:57', '2024-11-09 08:35:57', '{\"master_persediaan_id\":null}', '{\"master_persediaan_id\":220}'),
(804, '9d719af5-7b95-48bf-b040-db152e4ff932', 1, 'Tandai Telah Diberi Kode', 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'a:0:{}', 'finished', '', '2024-11-09 08:36:06', '2024-11-09 08:36:06', NULL, NULL),
(805, '9d719b1a-4ebe-4a51-b86c-0210a627a38d', 1, 'Update', 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, '', 'finished', '', '2024-11-09 08:36:30', '2024-11-09 08:36:30', '{\"tanggal_kak\":\"2024-11-01T16:00:00.000000Z\",\"tanggal_buku\":\"2024-11-08T16:00:00.000000Z\"}', '{\"tanggal_kak\":\"2024-11-01 16:00:00\",\"tanggal_buku\":\"2024-11-10 00:00:00\"}'),
(806, '9d719b4a-6ee5-4aba-b9c5-f031efc87686', 1, 'Update', 'App\\Models\\BarangPersediaan', 35, 'App\\Models\\BarangPersediaan', 35, 'App\\Models\\BarangPersediaan', 35, '', 'finished', '', '2024-11-09 08:37:02', '2024-11-09 08:37:02', '{\"master_persediaan_id\":32}', '{\"master_persediaan_id\":35}'),
(807, '9d71a8af-7216-4930-ba1e-632aead21005', 1, 'Update', 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, '', 'finished', '', '2024-11-09 09:14:29', '2024-11-09 09:14:29', '{\"tanggal_kak\":\"2024-10-31T16:00:00.000000Z\",\"tanggal_bast\":\"2024-11-08T16:00:00.000000Z\"}', '{\"tanggal_kak\":\"2024-10-31 16:00:00\",\"tanggal_bast\":\"2024-11-10 00:00:00\"}'),
(808, '9d71a8e3-2529-4a70-a7da-d32c61b62d02', 1, 'Update', 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, '', 'finished', '', '2024-11-09 09:15:03', '2024-11-09 09:15:03', '{\"tanggal_kak\":\"2024-10-30T16:00:00.000000Z\",\"tanggal_bast\":\"2024-11-09T16:00:00.000000Z\"}', '{\"tanggal_kak\":\"2024-10-30 16:00:00\",\"tanggal_bast\":\"2024-11-09 00:00:00\"}'),
(809, '9d71a983-1976-4f1a-8cbd-fd045f4db4e8', 1, 'Tandai Telah Diberi Kode', 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'a:0:{}', 'finished', '', '2024-11-09 09:16:48', '2024-11-09 09:16:48', NULL, NULL),
(810, '9d71aaa8-56e3-4731-a01b-67e03494b8f9', 1, 'Delete', 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, 'App\\Models\\PembelianPersediaan', 4, '', 'finished', '', '2024-11-09 09:20:00', '2024-11-09 09:20:00', NULL, NULL),
(814, '9d71addd-1862-4111-afc3-d233361d0f31', 1, 'Update', 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, '', 'finished', '', '2024-11-09 09:28:58', '2024-11-09 09:28:58', '[]', '[]'),
(816, '9d71aec5-d568-450d-9ac4-a9aca0992e97', 1, 'Update', 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, 'App\\Models\\AnggaranKerangkaAcuan', 10, '', 'finished', '', '2024-11-09 09:31:30', '2024-11-09 09:31:30', '{\"perkiraan\":100000}', '{\"perkiraan\":\"120000\"}'),
(817, '9d71aedf-03a7-45ef-b64a-827692a5344c', 1, 'Impor dari KAK', 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'a:0:{}', 'finished', '', '2024-11-09 09:31:47', '2024-11-09 09:31:47', NULL, NULL),
(818, '9d71aef1-e2d9-4a0f-8820-d61cd979a470', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'a:0:{}', 'finished', '', '2024-11-09 09:31:59', '2024-11-09 09:31:59', NULL, NULL),
(819, '9d71af11-4c75-4a24-a70c-b844fccea65c', 1, 'Update', 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, '', 'finished', '', '2024-11-09 09:32:20', '2024-11-09 09:32:20', '{\"tanggal_kak\":\"2024-11-02T16:00:00.000000Z\",\"tanggal_bast\":null,\"tanggal_buku\":null,\"ppk_user_id\":null,\"pbmn_user_id\":null}', '{\"tanggal_kak\":\"2024-11-02 16:00:00\",\"tanggal_bast\":\"2024-11-09 00:00:00\",\"tanggal_buku\":\"2024-11-09 00:00:00\",\"ppk_user_id\":\"13\",\"pbmn_user_id\":\"25\"}'),
(820, '9d71af27-cf05-431c-a95f-64f01d169a92', 1, 'Tandai Telah Diberi Kode', 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'a:0:{}', 'finished', '', '2024-11-09 09:32:34', '2024-11-09 09:32:34', NULL, NULL),
(821, '9d71bb8d-bd72-41ae-8e97-1e4215e7edc6', 1, 'Update', 'App\\Models\\BarangPersediaan', 37, 'App\\Models\\BarangPersediaan', 37, 'App\\Models\\BarangPersediaan', 37, '', 'finished', '', '2024-11-09 10:07:14', '2024-11-09 10:07:14', '{\"master_persediaan_id\":null}', '{\"master_persediaan_id\":32}'),
(822, '9d71bb9b-bb0a-4127-9ae3-90e4f24975c7', 1, 'Update', 'App\\Models\\BarangPersediaan', 36, 'App\\Models\\BarangPersediaan', 36, 'App\\Models\\BarangPersediaan', 36, '', 'finished', '', '2024-11-09 10:07:24', '2024-11-09 10:07:24', '{\"master_persediaan_id\":null}', '{\"master_persediaan_id\":220}'),
(823, '9d71bbab-da64-4107-8d51-99ccc8211d74', 1, 'Unduh BAST', 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'a:2:{s:8:\"filename\";s:13:\"672ec3e207e7b\";s:8:\"template\";s:2:\"11\";}', 'finished', '', '2024-11-09 10:07:34', '2024-11-09 10:07:34', NULL, NULL),
(825, '9d71bc5e-951e-4610-a3c5-c2c7dc69063f', 1, 'Tandai Telah Diberi Kode', 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'a:0:{}', 'finished', '', '2024-11-09 10:09:31', '2024-11-09 10:09:31', NULL, NULL),
(826, '9d71bc65-14f7-4fc2-afc8-5f5b07e4e45d', 1, 'Unduh BAST', 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'a:2:{s:8:\"filename\";s:13:\"672ec45c2cd42\";s:8:\"template\";s:2:\"11\";}', 'finished', '', '2024-11-09 10:09:36', '2024-11-09 10:09:36', NULL, NULL),
(827, '9d71bcde-ed28-4390-9890-069330a2352d', 1, 'Unduh BAST', 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'a:2:{s:8:\"filename\";s:13:\"672ec4609dc0c\";s:8:\"template\";s:2:\"11\";}', 'finished', '', '2024-11-09 10:10:55', '2024-11-09 10:10:56', NULL, NULL),
(828, '9d71bd85-95fa-424f-bbc8-258ffa6c7427', 1, 'Unduh BAST', 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'a:2:{s:8:\"filename\";s:13:\"672ec518bf569\";s:8:\"template\";s:2:\"11\";}', 'finished', '', '2024-11-09 10:12:45', '2024-11-09 10:12:45', NULL, NULL),
(829, '9d71c118-4dd1-4d39-aaa7-5cd7707486dd', 1, 'Unduh BAST', 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'a:2:{s:8:\"filename\";s:13:\"672ec6bc4c392\";s:8:\"template\";s:2:\"11\";}', 'finished', '', '2024-11-09 10:22:44', '2024-11-09 10:22:44', NULL, NULL),
(830, '9d71e9e6-25c6-4021-be90-5822b35839d2', 1, 'Create', 'App\\Models\\PermintaanPersediaan', 1, 'App\\Models\\PermintaanPersediaan', 1, 'App\\Models\\PermintaanPersediaan', 1, '', 'finished', '', '2024-11-09 12:16:50', '2024-11-09 12:16:50', NULL, '{\"tanggal_permintaan\":\"2024-11-08T16:00:00.000000Z\",\"kegiatan\":\"Susneas\",\"keterangan\":\"Yeeee\",\"updated_at\":\"2024-11-09T04:16:50.000000Z\",\"created_at\":\"2024-11-09T04:16:50.000000Z\",\"id\":1}'),
(831, '9d7205d4-7985-4f9e-a1ed-9f848d76447a', 1, 'Create', 'App\\Models\\BarangPersediaan', 38, 'App\\Models\\BarangPersediaan', 38, 'App\\Models\\BarangPersediaan', 38, '', 'finished', '', '2024-11-09 13:34:56', '2024-11-09 13:34:56', NULL, '{\"master_persediaan_id\":\"2\",\"volume\":\"1\",\"barang_persediaanable_id\":1,\"barang_persediaanable_type\":\"App\\\\Models\\\\PermintaanPersediaan\",\"total_harga\":0,\"barang\":\"Binder Clips 107\",\"satuan\":\"Dozz\",\"updated_at\":\"2024-11-09T05:34:56.000000Z\",\"created_at\":\"2024-11-09T05:34:56.000000Z\",\"id\":38}'),
(832, '9d721a07-49c2-4b4c-a461-b298fbd55df7', 1, 'Update', 'App\\Models\\BarangPersediaan', 38, 'App\\Models\\BarangPersediaan', 38, 'App\\Models\\BarangPersediaan', 38, '', 'finished', '', '2024-11-09 14:31:25', '2024-11-09 14:31:25', '{\"master_persediaan_id\":2}', '{\"master_persediaan_id\":\"220\"}'),
(833, '9d721a24-34c9-41b4-8a23-0951ee27e691', 1, 'Delete', 'App\\Models\\BarangPersediaan', 38, 'App\\Models\\BarangPersediaan', 38, 'App\\Models\\BarangPersediaan', 38, '', 'finished', '', '2024-11-09 14:31:44', '2024-11-09 14:31:44', NULL, NULL),
(834, '9d721b1d-4c51-4011-a6ae-7589b6d019af', 1, 'Create', 'App\\Models\\BarangPersediaan', 39, 'App\\Models\\BarangPersediaan', 39, 'App\\Models\\BarangPersediaan', 39, '', 'finished', '', '2024-11-09 14:34:27', '2024-11-09 14:34:27', NULL, '{\"master_persediaan_id\":\"220\",\"volume\":\"1\",\"barang_persediaanable_id\":1,\"barang_persediaanable_type\":\"App\\\\Models\\\\PermintaanPersediaan\",\"total_harga\":0,\"barang\":\"KERTAS HVS A4S\",\"satuan\":\"Rim\",\"updated_at\":\"2024-11-09T06:34:27.000000Z\",\"created_at\":\"2024-11-09T06:34:27.000000Z\",\"id\":39}'),
(835, '9d721d8e-0015-4fc2-9491-7dfe9b3e96f8', 1, 'Delete', 'App\\Models\\BarangPersediaan', 39, 'App\\Models\\BarangPersediaan', 39, 'App\\Models\\BarangPersediaan', 39, '', 'finished', '', '2024-11-09 14:41:16', '2024-11-09 14:41:16', NULL, NULL),
(836, '9d721dc6-1240-4c88-901a-0d76e728de0a', 1, 'Create', 'App\\Models\\BarangPersediaan', 40, 'App\\Models\\BarangPersediaan', 40, 'App\\Models\\BarangPersediaan', 40, '', 'finished', '', '2024-11-09 14:41:53', '2024-11-09 14:41:53', NULL, '{\"master_persediaan_id\":\"220\",\"volume\":\"1\",\"barang_persediaanable_id\":1,\"barang_persediaanable_type\":\"App\\\\Models\\\\PermintaanPersediaan\",\"total_harga\":0,\"barang\":\"KERTAS HVS A4S\",\"satuan\":\"Rim\",\"updated_at\":\"2024-11-09T06:41:53.000000Z\",\"created_at\":\"2024-11-09T06:41:53.000000Z\",\"id\":40}'),
(837, '9d721ed7-57b3-4bcf-8b77-91cba1c38be8', 1, 'Update', 'App\\Models\\BarangPersediaan', 40, 'App\\Models\\BarangPersediaan', 40, 'App\\Models\\BarangPersediaan', 40, '', 'finished', '', '2024-11-09 14:44:52', '2024-11-09 14:44:52', '{\"master_persediaan_id\":220}', '{\"master_persediaan_id\":\"32\"}'),
(838, '9d722395-e0fd-4a98-9ece-32a816acc75c', 1, 'Delete', 'App\\Models\\PermintaanPersediaan', 1, 'App\\Models\\PermintaanPersediaan', 1, 'App\\Models\\PermintaanPersediaan', 1, '', 'finished', '', '2024-11-09 14:58:08', '2024-11-09 14:58:08', NULL, NULL),
(839, '9d7223b3-ee8b-43de-a6ab-658786c943a8', 1, 'Create', 'App\\Models\\PermintaanPersediaan', 2, 'App\\Models\\PermintaanPersediaan', 2, 'App\\Models\\PermintaanPersediaan', 2, '', 'finished', '', '2024-11-09 14:58:28', '2024-11-09 14:58:28', NULL, '{\"tanggal_permintaan\":\"2024-11-08T16:00:00.000000Z\",\"kegiatan\":\"Susenas\",\"keterangan\":\"halo\",\"status\":\"dibuat\",\"updated_at\":\"2024-11-09T06:58:28.000000Z\",\"created_at\":\"2024-11-09T06:58:28.000000Z\",\"id\":2}'),
(840, '9d7223c7-0ae8-414f-a73d-675977b249ec', 1, 'Create', 'App\\Models\\BarangPersediaan', 41, 'App\\Models\\BarangPersediaan', 41, 'App\\Models\\BarangPersediaan', 41, '', 'finished', '', '2024-11-09 14:58:40', '2024-11-09 14:58:40', NULL, '{\"master_persediaan_id\":\"220\",\"volume\":\"1\",\"barang_persediaanable_id\":2,\"barang_persediaanable_type\":\"App\\\\Models\\\\PermintaanPersediaan\",\"total_harga\":0,\"barang\":\"KERTAS HVS A4S\",\"satuan\":\"Rim\",\"updated_at\":\"2024-11-09T06:58:40.000000Z\",\"created_at\":\"2024-11-09T06:58:40.000000Z\",\"id\":41}'),
(841, '9d722c63-3955-408f-b2cf-bfe63668dcdd', 1, 'Create', 'App\\Models\\BarangPersediaan', 42, 'App\\Models\\BarangPersediaan', 42, 'App\\Models\\BarangPersediaan', 42, '', 'finished', '', '2024-11-09 15:22:45', '2024-11-09 15:22:45', NULL, '{\"barang\":\"azz\",\"satuan\":\"1dsd\",\"volume\":\"1\",\"harga_satuan\":\"33\",\"barang_persediaanable_id\":5,\"barang_persediaanable_type\":\"App\\\\Models\\\\PembelianPersediaan\",\"total_harga\":33,\"updated_at\":\"2024-11-09T07:22:45.000000Z\",\"created_at\":\"2024-11-09T07:22:45.000000Z\",\"id\":42}'),
(842, '9d722c85-6e95-49b6-89ee-601ea9e8f3c7', 1, 'Delete', 'App\\Models\\BarangPersediaan', 42, 'App\\Models\\BarangPersediaan', 42, 'App\\Models\\BarangPersediaan', 42, '', 'finished', '', '2024-11-09 15:23:07', '2024-11-09 15:23:07', NULL, NULL),
(843, '9d722c93-3932-45cc-8cb5-117b8556abbc', 1, 'Create', 'App\\Models\\BarangPersediaan', 43, 'App\\Models\\BarangPersediaan', 43, 'App\\Models\\BarangPersediaan', 43, '', 'finished', '', '2024-11-09 15:23:16', '2024-11-09 15:23:16', NULL, '{\"barang\":\"bb\",\"satuan\":\"vv\",\"volume\":\"1\",\"harga_satuan\":\"23\",\"barang_persediaanable_id\":5,\"barang_persediaanable_type\":\"App\\\\Models\\\\PembelianPersediaan\",\"total_harga\":23,\"updated_at\":\"2024-11-09T07:23:16.000000Z\",\"created_at\":\"2024-11-09T07:23:16.000000Z\",\"id\":43}'),
(844, '9d722c99-b045-48b6-a675-9c899aa6bdaa', 1, 'Delete', 'App\\Models\\BarangPersediaan', 43, 'App\\Models\\BarangPersediaan', 43, 'App\\Models\\BarangPersediaan', 43, '', 'finished', '', '2024-11-09 15:23:21', '2024-11-09 15:23:21', NULL, NULL),
(845, '9d723a75-3aa7-452b-8ba2-87fb74668bf8', 1, 'Update', 'App\\Models\\PermintaanPersediaan', 2, 'App\\Models\\PermintaanPersediaan', 2, 'App\\Models\\PermintaanPersediaan', 2, '', 'finished', '', '2024-11-09 16:02:05', '2024-11-09 16:02:05', '[]', '[]'),
(846, '9d724218-5cf1-4baf-9881-24ee21f5399c', 1, 'Update', 'App\\Models\\PermintaanPersediaan', 2, 'App\\Models\\PermintaanPersediaan', 2, 'App\\Models\\PermintaanPersediaan', 2, '', 'finished', '', '2024-11-09 16:23:27', '2024-11-09 16:23:27', '[]', '[]'),
(847, '9d724267-df5d-434e-b874-3cb45407549e', 1, 'Update', 'App\\Models\\PermintaanPersediaan', 2, 'App\\Models\\PermintaanPersediaan', 2, 'App\\Models\\PermintaanPersediaan', 2, '', 'finished', '', '2024-11-09 16:24:19', '2024-11-09 16:24:19', '[]', '[]'),
(848, '9d72429f-21a0-4fd1-be39-6db738cfecc1', 1, 'Delete', 'App\\Models\\PermintaanPersediaan', 2, 'App\\Models\\PermintaanPersediaan', 2, 'App\\Models\\PermintaanPersediaan', 2, '', 'finished', '', '2024-11-09 16:24:55', '2024-11-09 16:24:55', NULL, NULL),
(849, '9d7242ae-5325-4e9a-a005-fbadd2b20986', 1, 'Create', 'App\\Models\\PermintaanPersediaan', 3, 'App\\Models\\PermintaanPersediaan', 3, 'App\\Models\\PermintaanPersediaan', 3, '', 'finished', '', '2024-11-09 16:25:05', '2024-11-09 16:25:05', NULL, '{\"tanggal_permintaan\":\"2024-11-08T16:00:00.000000Z\",\"kegiatan\":\"Susenas\",\"keterangan\":\"sdsdd\",\"status\":\"dibuat\",\"updated_at\":\"2024-11-09T08:25:05.000000Z\",\"created_at\":\"2024-11-09T08:25:05.000000Z\",\"id\":3}'),
(850, '9d724354-b0e8-421f-82fd-cbfc410b4c17', 1, 'Delete', 'App\\Models\\PermintaanPersediaan', 3, 'App\\Models\\PermintaanPersediaan', 3, 'App\\Models\\PermintaanPersediaan', 3, '', 'finished', '', '2024-11-09 16:26:54', '2024-11-09 16:26:54', NULL, NULL),
(851, '9d7243af-8d4d-4556-8fb2-e4be145ffb97', 1, 'Create', 'App\\Models\\PermintaanPersediaan', 4, 'App\\Models\\PermintaanPersediaan', 4, 'App\\Models\\PermintaanPersediaan', 4, '', 'finished', '', '2024-11-09 16:27:54', '2024-11-09 16:27:54', NULL, '{\"tanggal_permintaan\":\"2024-11-08T16:00:00.000000Z\",\"kegiatan\":\"Apa\",\"keterangan\":\"aA\",\"status\":\"dibuat\",\"user_id\":1,\"updated_at\":\"2024-11-09T08:27:54.000000Z\",\"created_at\":\"2024-11-09T08:27:54.000000Z\",\"id\":4}'),
(852, '9d7243c9-9a10-4283-89d3-ab6223dd696b', 1, 'Create', 'App\\Models\\BarangPersediaan', 44, 'App\\Models\\BarangPersediaan', 44, 'App\\Models\\BarangPersediaan', 44, '', 'finished', '', '2024-11-09 16:28:11', '2024-11-09 16:28:11', NULL, '{\"master_persediaan_id\":\"220\",\"volume\":\"1\",\"barang_persediaanable_id\":4,\"barang_persediaanable_type\":\"App\\\\Models\\\\PermintaanPersediaan\",\"total_harga\":0,\"barang\":\"KERTAS HVS A4S\",\"satuan\":\"Rim\",\"updated_at\":\"2024-11-09T08:28:11.000000Z\",\"created_at\":\"2024-11-09T08:28:11.000000Z\",\"id\":44}'),
(855, '9d7248b1-bac2-4af4-863d-9cc807a5f1fd', 1, 'Update', 'App\\Models\\PermintaanPersediaan', 4, 'App\\Models\\PermintaanPersediaan', 4, 'App\\Models\\PermintaanPersediaan', 4, '', 'finished', '', '2024-11-09 16:41:54', '2024-11-09 16:41:54', '{\"tanggal_persetujuan\":null,\"pbmn_user_id\":null}', '{\"tanggal_persetujuan\":\"2024-11-09 00:00:00\",\"pbmn_user_id\":\"25\"}'),
(856, '9d7248ba-a1db-4205-925a-66ae84dd06aa', 1, 'Unduh Permintaan Persediaan', 'App\\Models\\PermintaanPersediaan', 4, 'App\\Models\\PermintaanPersediaan', 4, 'App\\Models\\PermintaanPersediaan', 4, 'a:2:{s:8:\"filename\";s:13:\"672f205357845\";s:8:\"template\";s:2:\"12\";}', 'finished', '', '2024-11-09 16:42:00', '2024-11-09 16:42:00', NULL, NULL),
(857, '9d72491b-fed0-49c4-bc9d-2b63ff49430d', 1, 'Unduh Permintaan Persediaan', 'App\\Models\\PermintaanPersediaan', 4, 'App\\Models\\PermintaanPersediaan', 4, 'App\\Models\\PermintaanPersediaan', 4, 'a:2:{s:8:\"filename\";s:13:\"672f2093c7cc5\";s:8:\"template\";s:2:\"12\";}', 'finished', '', '2024-11-09 16:43:04', '2024-11-09 16:43:04', NULL, NULL),
(858, '9d7249c6-64a9-46a3-9e7d-293a60e9f837', 1, 'Create', 'App\\Models\\BarangPersediaan', 45, 'App\\Models\\BarangPersediaan', 45, 'App\\Models\\BarangPersediaan', 45, '', 'finished', '', '2024-11-09 16:44:55', '2024-11-09 16:44:55', NULL, '{\"master_persediaan_id\":\"32\",\"volume\":\"1\",\"barang_persediaanable_id\":4,\"barang_persediaanable_type\":\"App\\\\Models\\\\PermintaanPersediaan\",\"total_harga\":0,\"barang\":\"Kertas Karbon\",\"satuan\":\"kotak\",\"updated_at\":\"2024-11-09T08:44:55.000000Z\",\"created_at\":\"2024-11-09T08:44:55.000000Z\",\"id\":45}'),
(859, '9d724a57-f0ef-40a8-b108-7a8d00dca165', 1, 'Unduh Permintaan Persediaan', 'App\\Models\\PermintaanPersediaan', 4, 'App\\Models\\PermintaanPersediaan', 4, 'App\\Models\\PermintaanPersediaan', 4, 'a:2:{s:8:\"filename\";s:13:\"672f216112acd\";s:8:\"template\";s:2:\"12\";}', 'finished', '', '2024-11-09 16:46:31', '2024-11-09 16:46:31', NULL, NULL),
(860, '9d72516b-a434-4d31-9d1e-be4c6096b561', 1, 'Create', 'App\\Models\\PermintaanPersediaan', 5, 'App\\Models\\PermintaanPersediaan', 5, 'App\\Models\\PermintaanPersediaan', 5, '', 'finished', '', '2024-11-09 17:06:18', '2024-11-09 17:06:18', NULL, '{\"tanggal_permintaan\":\"2024-11-08T16:00:00.000000Z\",\"kegiatan\":\"Aa\",\"keterangan\":\"aa\",\"status\":\"dibuat\",\"user_id\":1,\"updated_at\":\"2024-11-09T09:06:18.000000Z\",\"created_at\":\"2024-11-09T09:06:18.000000Z\",\"id\":5}'),
(861, '9d72522c-0f9c-47f2-afeb-a82080424941', 1, 'Delete', 'App\\Models\\PermintaanPersediaan', 5, 'App\\Models\\PermintaanPersediaan', 5, 'App\\Models\\PermintaanPersediaan', 5, '', 'finished', '', '2024-11-09 17:08:24', '2024-11-09 17:08:24', NULL, NULL),
(862, '9d725237-484c-4813-86b3-8e11e502045c', 1, 'Create', 'App\\Models\\PermintaanPersediaan', 6, 'App\\Models\\PermintaanPersediaan', 6, 'App\\Models\\PermintaanPersediaan', 6, '', 'finished', '', '2024-11-09 17:08:31', '2024-11-09 17:08:31', NULL, '{\"tanggal_permintaan\":\"2024-11-08T16:00:00.000000Z\",\"kegiatan\":\"sdsd\",\"keterangan\":\"dfdf\",\"status\":\"dibuat\",\"user_id\":1,\"updated_at\":\"2024-11-09T09:08:31.000000Z\",\"created_at\":\"2024-11-09T09:08:31.000000Z\",\"id\":6}'),
(863, '9d72589d-f909-4fab-80b5-65ae1d209f7c', 1, 'Create', 'App\\Models\\IzinKeluar', 1, 'App\\Models\\IzinKeluar', 1, 'App\\Models\\IzinKeluar', 1, '', 'finished', '', '2024-11-09 17:26:25', '2024-11-09 17:26:25', NULL, '{\"tanggal\":\"2024-11-08T16:00:00.000000Z\",\"keluar\":\"17:26\",\"kegiatan\":\"sdsdsd\",\"kembali\":null,\"user_id\":1,\"updated_at\":\"2024-11-09T09:26:25.000000Z\",\"created_at\":\"2024-11-09T09:26:25.000000Z\",\"id\":1}'),
(864, '9d7262c2-9ce1-4acd-bb4a-846dcf2ccea2', 1, 'Create', 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, '', 'finished', '', '2024-11-09 17:54:47', '2024-11-09 17:54:47', NULL, '{\"nomor_dokumen\":\"123\",\"tanggal_dokumen\":\"2024-11-08T16:00:00.000000Z\",\"rincian\":\"Pemberian ke\",\"tanggal_buku\":\"2024-11-08T16:00:00.000000Z\",\"updated_at\":\"2024-11-09T09:54:47.000000Z\",\"created_at\":\"2024-11-09T09:54:47.000000Z\",\"id\":1}'),
(865, '9d726829-6d16-4f9a-a8ad-de44524eabb2', 1, 'Create', 'App\\Models\\BarangPersediaan', 46, 'App\\Models\\BarangPersediaan', 46, 'App\\Models\\BarangPersediaan', 46, '', 'finished', '', '2024-11-09 18:09:53', '2024-11-09 18:09:53', NULL, '{\"master_persediaan_id\":\"32\",\"volume\":\"1\",\"barang_persediaanable_id\":1,\"barang_persediaanable_type\":\"App\\\\Models\\\\PersediaanKeluar\",\"total_harga\":0,\"barang\":\"Kertas Karbon\",\"satuan\":\"kotak\",\"tanggal_transaksi\":\"2024-11-08T16:00:00.000000Z\",\"updated_at\":\"2024-11-09T10:09:53.000000Z\",\"created_at\":\"2024-11-09T10:09:53.000000Z\",\"id\":46}'),
(867, '9d7269b1-4308-4bd4-9e16-97741ff1d821', 1, 'Update', 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, '', 'finished', '', '2024-11-09 18:14:10', '2024-11-09 18:14:10', '{\"tanggal_buku\":\"2024-11-08T16:00:00.000000Z\"}', '{\"tanggal_buku\":\"2024-11-16 00:00:00\"}'),
(868, '9d7269f6-462b-4c95-a80d-d86f8a9fe047', 1, 'Update', 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, '', 'finished', '', '2024-11-09 18:14:55', '2024-11-09 18:14:55', '{\"tanggal_buku\":\"2024-11-15T16:00:00.000000Z\"}', '{\"tanggal_buku\":\"2024-11-15 00:00:00\"}'),
(869, '9d726a18-7381-4bba-9590-c5d8ebeb8785', 1, 'Update', 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, '', 'finished', '', '2024-11-09 18:15:18', '2024-11-09 18:15:18', '{\"tanggal_buku\":\"2024-11-14T16:00:00.000000Z\"}', '{\"tanggal_buku\":\"2024-11-10 00:00:00\"}'),
(870, '9d726ac5-d34e-4551-9c0a-7444ed620108', 1, 'Update', 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, '', 'finished', '', '2024-11-09 18:17:11', '2024-11-09 18:17:11', '{\"tanggal_buku\":\"2024-11-09T16:00:00.000000Z\"}', '{\"tanggal_buku\":\"2024-11-11 00:00:00\"}'),
(871, '9d726b0a-d770-4542-b0d2-77e8d8d4c26d', 1, 'Update', 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, '', 'finished', '', '2024-11-09 18:17:57', '2024-11-09 18:17:57', '{\"tanggal_buku\":\"2024-11-10T16:00:00.000000Z\"}', '{\"tanggal_buku\":\"2024-11-10 00:00:00\"}'),
(872, '9d726b1f-829f-4575-bbd6-89c2c4d5a16b', 1, 'Update', 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, '', 'finished', '', '2024-11-09 18:18:10', '2024-11-09 18:18:10', '{\"tanggal_buku\":\"2024-11-09T16:00:00.000000Z\"}', '{\"tanggal_buku\":\"2024-11-13 00:00:00\"}'),
(873, '9d726bad-3d8b-470f-a062-d497ad3a4ddd', 1, 'Delete', 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, 'App\\Models\\PersediaanKeluar', 1, '', 'finished', '', '2024-11-09 18:19:43', '2024-11-09 18:19:43', NULL, NULL),
(874, '9d726bca-1a9e-4263-96db-bbb2ffba623e', 1, 'Create', 'App\\Models\\PersediaanKeluar', 2, 'App\\Models\\PersediaanKeluar', 2, 'App\\Models\\PersediaanKeluar', 2, '', 'finished', '', '2024-11-09 18:20:02', '2024-11-09 18:20:02', NULL, '{\"nomor_dokumen\":\"sdsfdsw\",\"tanggal_dokumen\":\"2024-11-08T16:00:00.000000Z\",\"rincian\":\"dsfdsfd\",\"tanggal_buku\":\"2024-11-09T16:00:00.000000Z\",\"updated_at\":\"2024-11-09T10:20:02.000000Z\",\"created_at\":\"2024-11-09T10:20:02.000000Z\",\"id\":2}'),
(875, '9d726be9-731a-4995-b16b-3261df94d091', 1, 'Create', 'App\\Models\\BarangPersediaan', 47, 'App\\Models\\BarangPersediaan', 47, 'App\\Models\\BarangPersediaan', 47, '', 'finished', '', '2024-11-09 18:20:22', '2024-11-09 18:20:22', NULL, '{\"master_persediaan_id\":\"32\",\"volume\":\"1\",\"barang_persediaanable_id\":2,\"barang_persediaanable_type\":\"App\\\\Models\\\\PersediaanKeluar\",\"total_harga\":0,\"barang\":\"Kertas Karbon\",\"satuan\":\"kotak\",\"tanggal_transaksi\":\"2024-11-09T16:00:00.000000Z\",\"updated_at\":\"2024-11-09T10:20:22.000000Z\",\"created_at\":\"2024-11-09T10:20:22.000000Z\",\"id\":47}'),
(876, '9d726bfa-d3e5-454d-9079-37d760c37af5', 1, 'Update', 'App\\Models\\PersediaanKeluar', 2, 'App\\Models\\PersediaanKeluar', 2, 'App\\Models\\PersediaanKeluar', 2, '', 'finished', '', '2024-11-09 18:20:34', '2024-11-09 18:20:34', '{\"tanggal_buku\":\"2024-11-09T16:00:00.000000Z\"}', '{\"tanggal_buku\":\"2024-11-11 00:00:00\"}'),
(878, '9d7272f1-4aeb-4575-b20b-e07af1c73c99', 1, 'Update', 'App\\Models\\PersediaanKeluar', 2, 'App\\Models\\PersediaanKeluar', 2, 'App\\Models\\PersediaanKeluar', 2, '', 'finished', '', '2024-11-09 18:40:02', '2024-11-09 18:40:02', '[]', '[]'),
(879, '9d7273ae-b4c9-49f1-8080-6876b907f41d', 1, 'Update', 'App\\Models\\PersediaanKeluar', 2, 'App\\Models\\PersediaanKeluar', 2, 'App\\Models\\PersediaanKeluar', 2, '', 'finished', '', '2024-11-09 18:42:06', '2024-11-09 18:42:06', '{\"tanggal_buku\":\"2024-11-10T16:00:00.000000Z\"}', '{\"tanggal_buku\":\"2024-11-09 00:00:00\"}'),
(880, '9d7273c0-16df-4bad-b0b4-829fb9ab3104', 1, 'Update', 'App\\Models\\PersediaanKeluar', 2, 'App\\Models\\PersediaanKeluar', 2, 'App\\Models\\PersediaanKeluar', 2, '', 'finished', '', '2024-11-09 18:42:18', '2024-11-09 18:42:18', '{\"tanggal_buku\":\"2024-11-08T16:00:00.000000Z\"}', '{\"tanggal_buku\":\"2024-11-11 00:00:00\"}'),
(881, '9d72756a-557f-46a5-9aed-a38fff0d34d3', 1, 'Delete', 'App\\Models\\BarangPersediaan', 47, 'App\\Models\\BarangPersediaan', 47, 'App\\Models\\BarangPersediaan', 47, '', 'finished', '', '2024-11-09 18:46:57', '2024-11-09 18:46:57', NULL, NULL),
(882, '9d72789b-f1fe-4a7c-a3a4-9cd14bafce4e', 1, 'Create', 'App\\Models\\BarangPersediaan', 48, 'App\\Models\\BarangPersediaan', 48, 'App\\Models\\BarangPersediaan', 48, '', 'finished', '', '2024-11-09 18:55:53', '2024-11-09 18:55:53', NULL, '{\"master_persediaan_id\":\"32\",\"volume\":\"1\",\"barang_persediaanable_id\":2,\"barang_persediaanable_type\":\"App\\\\Models\\\\PersediaanKeluar\",\"total_harga\":0,\"barang\":\"Kertas Karbon\",\"satuan\":\"kotak\",\"tanggal_transaksi\":\"2024-11-10T16:00:00.000000Z\",\"updated_at\":\"2024-11-09T10:55:53.000000Z\",\"created_at\":\"2024-11-09T10:55:53.000000Z\",\"id\":48}'),
(883, '9d7278a5-c784-48d8-b477-26027818b944', 1, 'Delete', 'App\\Models\\BarangPersediaan', 48, 'App\\Models\\BarangPersediaan', 48, 'App\\Models\\BarangPersediaan', 48, '', 'finished', '', '2024-11-09 18:55:59', '2024-11-09 18:55:59', NULL, NULL),
(884, '9d727f50-ed69-45f3-aa86-b5b65dc2574a', 1, 'Create', 'App\\Models\\PersediaanMasuk', 1, 'App\\Models\\PersediaanMasuk', 1, 'App\\Models\\PersediaanMasuk', 1, '', 'finished', '', '2024-11-09 19:14:38', '2024-11-09 19:14:38', NULL, '{\"nomor_dokumen\":\"222\",\"tanggal_dokumen\":\"2024-11-08T16:00:00.000000Z\",\"rincian\":\"dgdfg\",\"tanggal_buku\":\"2024-11-08T16:00:00.000000Z\",\"updated_at\":\"2024-11-09T11:14:38.000000Z\",\"created_at\":\"2024-11-09T11:14:38.000000Z\",\"id\":1}'),
(885, '9d727fb4-10c3-4432-9087-32de54dc543f', 1, 'Create', 'App\\Models\\BarangPersediaan', 49, 'App\\Models\\BarangPersediaan', 49, 'App\\Models\\BarangPersediaan', 49, '', 'finished', '', '2024-11-09 19:15:43', '2024-11-09 19:15:43', NULL, '{\"master_persediaan_id\":\"1\",\"volume\":\"2\",\"barang_persediaanable_id\":1,\"barang_persediaanable_type\":\"App\\\\Models\\\\PersediaanMasuk\",\"total_harga\":0,\"barang\":\"Trigonal Clips Besar\",\"satuan\":\"Kotak\",\"tanggal_transaksi\":\"2024-11-08T16:00:00.000000Z\",\"updated_at\":\"2024-11-09T11:15:43.000000Z\",\"created_at\":\"2024-11-09T11:15:43.000000Z\",\"id\":49}');
INSERT INTO `action_events` (`id`, `batch_id`, `user_id`, `name`, `actionable_type`, `actionable_id`, `target_type`, `target_id`, `model_type`, `model_id`, `fields`, `status`, `exception`, `created_at`, `updated_at`, `original`, `changes`) VALUES
(886, '9d728012-36cb-4a24-adf5-3864c4a9de69', 1, 'Update', 'App\\Models\\BarangPersediaan', 49, 'App\\Models\\BarangPersediaan', 49, 'App\\Models\\BarangPersediaan', 49, '', 'finished', '', '2024-11-09 19:16:45', '2024-11-09 19:16:45', '{\"harga_satuan\":null}', '{\"harga_satuan\":\"20000\"}'),
(887, '9d72804a-40f3-4e11-8d67-b387f97fb720', 1, 'Create', 'App\\Models\\BarangPersediaan', 50, 'App\\Models\\BarangPersediaan', 50, 'App\\Models\\BarangPersediaan', 50, '', 'finished', '', '2024-11-09 19:17:21', '2024-11-09 19:17:21', NULL, '{\"master_persediaan_id\":\"220\",\"volume\":\"5\",\"harga_satuan\":\"50000\",\"barang_persediaanable_id\":1,\"barang_persediaanable_type\":\"App\\\\Models\\\\PersediaanMasuk\",\"total_harga\":250000,\"barang\":\"KERTAS HVS A4S\",\"satuan\":\"Rim\",\"tanggal_transaksi\":\"2024-11-08T16:00:00.000000Z\",\"updated_at\":\"2024-11-09T11:17:21.000000Z\",\"created_at\":\"2024-11-09T11:17:21.000000Z\",\"id\":50}'),
(888, '9d728174-6e02-4f80-a6d3-2aadedc59dae', 1, 'Create', 'App\\Models\\BarangPersediaan', 51, 'App\\Models\\BarangPersediaan', 51, 'App\\Models\\BarangPersediaan', 51, '', 'finished', '', '2024-11-09 19:20:37', '2024-11-09 19:20:37', NULL, '{\"master_persediaan_id\":\"220\",\"volume\":\"4\",\"barang_persediaanable_id\":2,\"barang_persediaanable_type\":\"App\\\\Models\\\\PersediaanKeluar\",\"total_harga\":0,\"barang\":\"KERTAS HVS A4S\",\"satuan\":\"Rim\",\"tanggal_transaksi\":\"2024-11-10T16:00:00.000000Z\",\"updated_at\":\"2024-11-09T11:20:37.000000Z\",\"created_at\":\"2024-11-09T11:20:37.000000Z\",\"id\":51}'),
(889, '9d7281ae-7456-4826-a7e0-7bba85b0967d', 1, 'Update', 'App\\Models\\PersediaanMasuk', 1, 'App\\Models\\PersediaanMasuk', 1, 'App\\Models\\PersediaanMasuk', 1, '', 'finished', '', '2024-11-09 19:21:15', '2024-11-09 19:21:15', '{\"tanggal_buku\":\"2024-11-08T16:00:00.000000Z\"}', '{\"tanggal_buku\":\"2024-11-10 00:00:00\"}'),
(890, '9d72980e-10be-48e4-9c31-b8c18e26dfa7', 1, 'Create', 'App\\Models\\MasterPersediaan', 653, 'App\\Models\\MasterPersediaan', 653, 'App\\Models\\MasterPersediaan', 653, '', 'finished', '', '2024-11-09 20:23:48', '2024-11-09 20:23:48', NULL, '{\"kode\":\"1234567890123456\",\"barang\":\"233\",\"satuan\":\"ee\",\"updated_at\":\"2024-11-09T12:23:48.000000Z\",\"created_at\":\"2024-11-09T12:23:48.000000Z\",\"id\":653}'),
(891, '9d72bb7e-9413-4fa8-a775-8fd7789791b3', 1, 'Create', 'App\\Models\\BarangPersediaan', 52, 'App\\Models\\BarangPersediaan', 52, 'App\\Models\\BarangPersediaan', 52, '', 'finished', '', '2024-11-09 22:02:54', '2024-11-09 22:02:54', NULL, '{\"master_persediaan_id\":\"220\",\"volume\":\"1\",\"barang_persediaanable_id\":6,\"barang_persediaanable_type\":\"App\\\\Models\\\\PermintaanPersediaan\",\"total_harga\":0,\"barang\":\"KERTAS HVS A4S\",\"satuan\":\"Rim\",\"updated_at\":\"2024-11-09T14:02:54.000000Z\",\"created_at\":\"2024-11-09T14:02:54.000000Z\",\"id\":52}'),
(892, '9d72c0dd-a823-4bd2-8502-8280f4affda0', 1, 'Terima Barang', 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'App\\Models\\PembelianPersediaan', 5, 'a:0:{}', 'finished', '', '2024-11-09 22:17:55', '2024-11-09 22:17:55', NULL, NULL),
(893, '9d72c27f-6e69-4102-8bbe-e92f6cb25ee5', 1, 'Delete', 'App\\Models\\BarangPersediaan', 45, 'App\\Models\\BarangPersediaan', 45, 'App\\Models\\BarangPersediaan', 45, '', 'finished', '', '2024-11-09 22:22:29', '2024-11-09 22:22:29', NULL, NULL),
(894, '9d72c2f5-9f55-4740-8bde-98b4ad1cb63b', 1, 'Create', 'App\\Models\\BarangPersediaan', 53, 'App\\Models\\BarangPersediaan', 53, 'App\\Models\\BarangPersediaan', 53, '', 'finished', '', '2024-11-09 22:23:47', '2024-11-09 22:23:47', NULL, '{\"master_persediaan_id\":\"1\",\"volume\":\"1\",\"barang_persediaanable_id\":4,\"barang_persediaanable_type\":\"App\\\\Models\\\\PermintaanPersediaan\",\"total_harga\":0,\"barang\":\"Trigonal Clips Besar\",\"satuan\":\"Kotak\",\"updated_at\":\"2024-11-09T14:23:47.000000Z\",\"created_at\":\"2024-11-09T14:23:47.000000Z\",\"id\":53}'),
(895, '9d72c4bd-1b04-4a91-b080-7d8dc148579b', 1, 'Create', 'App\\Models\\PermintaanPersediaan', 7, 'App\\Models\\PermintaanPersediaan', 7, 'App\\Models\\PermintaanPersediaan', 7, '', 'finished', '', '2024-11-09 22:28:45', '2024-11-09 22:28:45', NULL, '{\"tanggal_permintaan\":\"2024-11-08T16:00:00.000000Z\",\"kegiatan\":\"dsfsd\",\"keterangan\":\"ffddf\",\"status\":\"dibuat\",\"user_id\":1,\"updated_at\":\"2024-11-09T14:28:45.000000Z\",\"created_at\":\"2024-11-09T14:28:45.000000Z\",\"id\":7}'),
(896, '9d737b34-bdfe-4ec9-be82-92e7d35b726a', 1, 'Edit Rekening', 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, 'App\\Models\\DaftarHonorMitra', 52, 'a:1:{s:8:\"rekening\";s:16:\"BRI 123456788089\";}', 'finished', '', '2024-11-10 06:58:58', '2024-11-10 06:58:58', NULL, NULL),
(897, '9d7382df-2f18-44ab-94f2-3cdd5223267f', 1, 'Update', 'App\\Models\\Pengelola', 10, 'App\\Models\\Pengelola', 10, 'App\\Models\\Pengelola', 10, '', 'finished', '', '2024-11-10 07:20:24', '2024-11-10 07:20:24', '{\"inactive\":null}', '{\"inactive\":\"2024-06-06 00:00:00\"}'),
(898, '9d73ab21-419d-4a4b-a8c2-caf2b4f63319', 1, 'Create', 'App\\Models\\DaftarHonorPegawai', 8, 'App\\Models\\DaftarHonorPegawai', 8, 'App\\Models\\DaftarHonorPegawai', 8, '', 'finished', '', '2024-11-10 09:12:58', '2024-11-10 09:12:58', NULL, '{\"user_id\":\"4\",\"volume\":null,\"harga_satuan\":null,\"honor_kegiatan_id\":6,\"persen_pajak\":null,\"updated_at\":\"2024-11-10T01:12:58.000000Z\",\"created_at\":\"2024-11-10T01:12:58.000000Z\",\"id\":8}'),
(899, '9d73b1d8-b503-4035-b88d-1943f4fdd157', 1, 'Update', 'App\\Models\\DaftarHonorPegawai', 8, 'App\\Models\\DaftarHonorPegawai', 8, 'App\\Models\\DaftarHonorPegawai', 8, '', 'finished', '', '2024-11-10 09:31:45', '2024-11-10 09:31:45', '{\"volume\":null,\"harga_satuan\":null,\"persen_pajak\":null,\"user_id\":4}', '{\"volume\":\"2\",\"harga_satuan\":\"10000\",\"persen_pajak\":\"5\",\"user_id\":\"5\"}'),
(900, '9d73b2b5-5ecd-4db4-9620-abdfa15a8c70', 1, 'Edit Rekening', 'App\\Models\\DaftarHonorPegawai', 8, 'App\\Models\\DaftarHonorPegawai', 8, 'App\\Models\\DaftarHonorPegawai', 8, 'a:1:{s:8:\"rekening\";s:3:\"dsd\";}', 'finished', '', '2024-11-10 09:34:10', '2024-11-10 09:34:10', NULL, NULL),
(901, '9d73db2b-d77c-49f9-a755-f1087f97d14b', 1, 'Update', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, '', 'finished', '', '2024-11-10 11:27:18', '2024-11-10 11:27:18', '{\"tanggal_kak\":\"2024-10-28T16:00:00.000000Z\",\"generate_sk\":1,\"generate_st\":1,\"jenis_kontrak_id\":1}', '{\"tanggal_kak\":\"2024-10-28 16:00:00\",\"generate_sk\":true,\"generate_st\":true,\"jenis_kontrak_id\":\"2\"}'),
(902, '9d73db51-739c-4b8b-9f16-bf4d299dc729', 1, 'Export Template BOS', 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'App\\Models\\HonorKegiatan', 6, 'a:3:{s:4:\"awal\";s:1:\"2\";s:5:\"akhir\";s:2:\"10\";s:8:\"filename\";s:13:\"6730281cc4800\";}', 'finished', '', '2024-11-10 11:27:43', '2024-11-10 11:27:45', NULL, NULL),
(903, '9d73e684-916d-4094-b21e-6664c5068e32', 1, 'Create', 'App\\Models\\NaskahMasuk', 1, 'App\\Models\\NaskahMasuk', 1, 'App\\Models\\NaskahMasuk', 1, '', 'finished', '', '2024-11-10 11:59:02', '2024-11-10 11:59:02', NULL, '{\"tanggal\":\"2024-11-09T16:00:00.000000Z\",\"nomor\":\"efrsdfdf\",\"pengirim\":\"esdefd\",\"perihal\":\"dfdsf\",\"jenis_naskah_id\":\"2\",\"arsip\":\"ZdmqPHqgl0CRIhbtUmECV741vl9PHUyC7sEcCnZu.pdf\",\"updated_at\":\"2024-11-10T03:59:02.000000Z\",\"created_at\":\"2024-11-10T03:59:02.000000Z\",\"id\":1}'),
(904, '9d73e6a3-9b00-43d7-b779-133a37aee5fa', 1, 'Delete', 'App\\Models\\NaskahMasuk', 1, 'App\\Models\\NaskahMasuk', 1, 'App\\Models\\NaskahMasuk', 1, '', 'finished', '', '2024-11-10 11:59:22', '2024-11-10 11:59:22', NULL, NULL),
(905, '9d748200-a067-4979-86ed-20ac4472d635', 1, 'Import POK SATU DJA', 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'a:3:{s:4:\"file\";s:45:\"qkqyjHul0JGY000IS9TBiqNyrjeLhCk81FiGK8a2.xlsx\";s:6:\"satker\";s:6:\"428578\";s:7:\"wilayah\";s:5:\"15.00\";}', 'finished', '', '2024-11-10 19:13:48', '2024-11-10 19:13:52', NULL, NULL),
(906, '9d74825f-cf1b-4318-8993-e5a0c2abba10', 1, 'Import POK SATU DJA', 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'a:3:{s:4:\"file\";s:45:\"UgFTDYJn16b9B35gpklkxpiadBJGxucgGIUUFY2u.xlsx\";s:6:\"satker\";s:6:\"428578\";s:7:\"wilayah\";s:5:\"15.00\";}', 'finished', '', '2024-11-10 19:14:50', '2024-11-10 19:14:53', NULL, NULL),
(907, '9d748292-4f6b-41e0-9262-c3acee142127', 1, 'Import POK SATU DJA', 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'a:3:{s:4:\"file\";s:45:\"fS0vTchoJgffoNGEWMBmjNyTYxFJHdubEFxA3I37.xlsx\";s:6:\"satker\";s:6:\"428578\";s:7:\"wilayah\";s:5:\"15.00\";}', 'finished', '', '2024-11-10 19:15:23', '2024-11-10 19:15:27', NULL, NULL),
(908, '9d748371-78fa-465d-b8ba-a43a1b873011', 1, 'Import POK SATU DJA', 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'a:3:{s:4:\"file\";s:45:\"ukWcenvrv16jmEPldj3LlG16tlLYTsFONIaqw4vc.xlsx\";s:6:\"satker\";s:6:\"428578\";s:7:\"wilayah\";s:5:\"15.00\";}', 'finished', '', '2024-11-10 19:17:50', '2024-11-10 19:17:53', NULL, NULL),
(913, '9d748515-faba-4daf-a7b6-58d152dde99a', 1, 'Import Mata Anggaran Monsakti', 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'a:1:{s:4:\"file\";s:45:\"KyoGoj4Rg0XCbFDQm1PLvAQbjkAYv3hEvOgs1nx7.xlsx\";}', 'finished', '', '2024-11-10 19:22:25', '2024-11-10 19:22:28', NULL, NULL),
(919, '9d749973-6b74-41a0-9d50-dae7ba6923a3', 1, 'Import Mata Anggaran Monsakti', 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'a:2:{s:4:\"file\";s:44:\"1yZFlCDaZNcLM2DV1jtlnk0R875XqpdLEpFpmjeR.csv\";s:10:\"update_rpd\";b:0;}', 'finished', '', '2024-11-10 20:19:22', '2024-11-10 20:19:23', NULL, NULL),
(920, '9d749e6b-9c42-48d1-a967-bf16fcc81eba', 1, 'Import Mata Anggaran Monsakti', 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'a:3:{s:4:\"file\";s:44:\"EhRRyL8qa48DS2wCiifD18Ap74j6j9oCmmUYpuAO.csv\";s:4:\"kode\";s:6:\"054.01\";s:10:\"update_rpd\";b:1;}', 'finished', '', '2024-11-10 20:33:16', '2024-11-10 20:33:19', NULL, NULL),
(921, '9d749f0a-667d-4a42-826e-e7a537466759', 1, 'Import Mata Anggaran Monsakti', 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'a:3:{s:4:\"file\";s:44:\"lmbAzXSuS9jgtoYJpbtNDYXURjX4kPLly2DE5XvF.csv\";s:4:\"kode\";s:6:\"054.01\";s:10:\"update_rpd\";b:0;}', 'finished', '', '2024-11-10 20:35:00', '2024-11-10 20:35:01', NULL, NULL),
(922, '9d749f35-168e-4e69-be4a-2fb6d7a7dc9f', 1, 'Import Mata Anggaran Monsakti', 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'a:3:{s:4:\"file\";s:44:\"WkfGImYsRpRzooD2wcMZZgbVHY8XCufYW9ggnYdt.csv\";s:4:\"kode\";s:6:\"054.01\";s:10:\"update_rpd\";b:1;}', 'finished', '', '2024-11-10 20:35:28', '2024-11-10 20:35:31', NULL, NULL),
(923, '9d749f52-57ec-4e24-84aa-9f1a76352bba', 1, 'Update', 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, '', 'finished', '', '2024-11-10 20:35:47', '2024-11-10 20:35:47', '{\"nomor\":\"SP DIPA No 428578\\/2-24\"}', '{\"nomor\":\"SP DIPA No 428578\\/2024\"}'),
(924, '9d749f98-96ef-4892-8f47-f174608f5dbf', 1, 'Update', 'App\\Models\\MataAnggaran', 326, 'App\\Models\\MataAnggaran', 326, 'App\\Models\\MataAnggaran', 326, '', 'finished', '', '2024-11-10 20:36:33', '2024-11-10 20:36:33', '[]', '[]'),
(927, '9d74ae25-1e01-4442-90ff-9404d0913009', 1, 'Import Realisasi Anggaran Monsakti', 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'a:1:{s:4:\"file\";s:45:\"O2OsyijKNwp1X1ylTA33rbF5n19CoRb5ueWsadbK.xlsx\";}', 'finished', '', '2024-11-10 21:17:14', '2024-11-10 21:17:19', NULL, NULL),
(928, '9d74af89-5224-45d0-991a-32c4d62e7de7', 1, 'Import Realisasi Anggaran Monsakti', 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'a:1:{s:4:\"file\";s:45:\"c6zlkBwXZBtF3G9ULe2Pir3n2M0BofBVFxo1hFka.xlsx\";}', 'finished', '', '2024-11-10 21:21:07', '2024-11-10 21:21:13', NULL, NULL),
(929, '9d74afe6-60ca-4061-bf6f-f3e637955869', 1, 'Import Realisasi Anggaran Monsakti', 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'App\\Models\\Dipa', 1, 'a:1:{s:4:\"file\";s:45:\"pXdhEJfcUnvpaDcc8r5Qf7C7ZnkHXZHNJiANVW9q.xlsx\";}', 'finished', '', '2024-11-10 21:22:08', '2024-11-10 21:22:14', NULL, NULL),
(933, '9d75689e-300e-4ac1-aa65-60a86ea67517', 1, 'Unduh KAK', 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'a:2:{s:8:\"filename\";s:13:\"67312c8b2396a\";s:8:\"template\";s:1:\"3\";}', 'waiting', '', '2024-11-11 05:58:39', '2024-11-11 05:58:39', NULL, NULL),
(934, '9d7568d9-0ef8-45e1-bf16-02979c135b96', 1, 'Unduh KAK', 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'a:2:{s:8:\"filename\";s:13:\"67312c8f903d7\";s:8:\"template\";s:1:\"3\";}', 'finished', '', '2024-11-11 05:59:17', '2024-11-11 05:59:17', NULL, NULL),
(936, '9d757a35-5b64-402c-b332-f81153e5aec4', 1, 'Update', 'App\\Models\\SpesifikasiKerangkaAcuan', 8, 'App\\Models\\SpesifikasiKerangkaAcuan', 8, 'App\\Models\\SpesifikasiKerangkaAcuan', 8, '', 'finished', '', '2024-11-11 06:47:50', '2024-11-11 06:47:50', '{\"volume\":20}', '{\"volume\":\"2\"}'),
(938, '9d757a59-a357-431c-af44-063a7de6fa07', 1, 'Unduh KAK', 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'a:2:{s:8:\"filename\";s:13:\"673138178fc6c\";s:8:\"template\";s:1:\"3\";}', 'finished', '', '2024-11-11 06:48:14', '2024-11-11 06:48:14', NULL, NULL),
(939, '9d757ae0-ed27-4b11-a980-90fca7483937', 1, 'Unduh KAK', 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'a:2:{s:8:\"filename\";s:13:\"6731382f044a3\";s:8:\"template\";s:1:\"3\";}', 'finished', '', '2024-11-11 06:49:42', '2024-11-11 06:49:43', NULL, NULL),
(940, '9d757b5c-24d3-40ee-bdc6-d5567b777d56', 1, 'Unduh KAK', 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'App\\Models\\KerangkaAcuan', 7, 'a:2:{s:8:\"filename\";s:13:\"6731388788cd7\";s:8:\"template\";s:1:\"3\";}', 'finished', '', '2024-11-11 06:51:03', '2024-11-11 06:51:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `anggaran_kerangka_acuans`
--

CREATE TABLE `anggaran_kerangka_acuans` (
  `id` bigint UNSIGNED NOT NULL,
  `mata_anggaran_id` mediumint UNSIGNED DEFAULT NULL,
  `perkiraan` int UNSIGNED DEFAULT NULL,
  `kerangka_acuan_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggaran_kerangka_acuans`
--

INSERT INTO `anggaran_kerangka_acuans` (`id`, `mata_anggaran_id`, `perkiraan`, `kerangka_acuan_id`, `created_at`, `updated_at`) VALUES
(13, 169, 100000, 7, '2024-11-11 06:42:06', '2024-11-11 06:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `arsip_dokumens`
--

CREATE TABLE `arsip_dokumens` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kerangka_acuan_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `arsip_dokumens`
--

INSERT INTO `arsip_dokumens` (`id`, `slug`, `file`, `kerangka_acuan_id`, `created_at`, `updated_at`) VALUES
(43, 'Kerangka Acuan Kerja', NULL, 7, '2024-11-02 17:04:05', '2024-11-02 17:04:05'),
(44, 'Form Permintaan', NULL, 7, '2024-11-02 17:04:05', '2024-11-02 17:04:05'),
(45, 'SPM', NULL, 7, '2024-11-02 17:04:05', '2024-11-02 17:04:05'),
(46, 'SP2D', NULL, 7, '2024-11-02 17:04:05', '2024-11-02 17:04:05'),
(47, 'Surat Setoran Pajak', NULL, 7, '2024-11-02 17:04:05', '2024-11-02 17:04:05'),
(48, 'SPJ', NULL, 7, '2024-11-02 17:04:05', '2024-11-02 17:04:05'),
(49, 'Mutasi Rekening', NULL, 7, '2024-11-02 17:04:05', '2024-11-02 17:04:05'),
(50, 'Kerangka Acuan Kerja', NULL, 8, '2024-11-03 17:57:08', '2024-11-03 17:57:08'),
(51, 'Form Permintaan', NULL, 8, '2024-11-03 17:57:08', '2024-11-03 17:57:08'),
(52, 'SPM', NULL, 8, '2024-11-03 17:57:08', '2024-11-03 17:57:08'),
(53, 'SP2D', NULL, 8, '2024-11-03 17:57:08', '2024-11-03 17:57:08'),
(54, 'Surat Setoran Pajak', NULL, 8, '2024-11-03 17:57:08', '2024-11-03 17:57:08'),
(55, 'SPJ', NULL, 8, '2024-11-03 17:57:08', '2024-11-03 17:57:08'),
(56, 'Mutasi Rekening', NULL, 8, '2024-11-03 17:57:08', '2024-11-03 17:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `barang_persediaans`
--

CREATE TABLE `barang_persediaans` (
  `id` bigint UNSIGNED NOT NULL,
  `barang` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume` mediumint DEFAULT NULL,
  `harga_satuan` mediumint UNSIGNED DEFAULT NULL,
  `total_harga` mediumint UNSIGNED DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `master_persediaan_id` mediumint DEFAULT NULL,
  `barang_persediaanable_id` int DEFAULT NULL,
  `barang_persediaanable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_persediaans`
--

INSERT INTO `barang_persediaans` (`id`, `barang`, `satuan`, `volume`, `harga_satuan`, `total_harga`, `tanggal_transaksi`, `master_persediaan_id`, `barang_persediaanable_id`, `barang_persediaanable_type`, `created_at`, `updated_at`) VALUES
(36, 'KERTAS HVS A4S', 'Rim', 1, 75000, 75000, '2024-11-09', 220, 5, 'App\\Models\\PembelianPersediaan', '2024-11-09 09:31:47', '2024-11-09 10:22:44'),
(37, 'Kertas Karbon', 'kotak', 2, 100000, 200000, '2024-11-09', 32, 5, 'App\\Models\\PembelianPersediaan', '2024-11-09 09:31:47', '2024-11-09 10:22:44'),
(44, 'KERTAS HVS A4S', 'Rim', 1, NULL, 0, '2024-11-09', 220, 4, 'App\\Models\\PermintaanPersediaan', '2024-11-09 16:28:11', '2024-11-09 16:46:31'),
(49, 'Trigonal Clips Besar', 'Kotak', 2, 20000, 40000, '2024-11-10', 1, 1, 'App\\Models\\PersediaanMasuk', '2024-11-09 19:15:43', '2024-11-09 19:21:15'),
(50, 'KERTAS HVS A4S', 'Rim', 5, 50000, 250000, '2024-11-10', 220, 1, 'App\\Models\\PersediaanMasuk', '2024-11-09 19:17:21', '2024-11-09 19:21:15'),
(51, 'KERTAS HVS A4S', 'Rim', 4, NULL, 0, '2024-11-11', 220, 2, 'App\\Models\\PersediaanKeluar', '2024-11-09 19:20:37', '2024-11-09 19:20:37'),
(52, 'KERTAS HVS A4S', 'Rim', 1, NULL, 0, NULL, 220, 6, 'App\\Models\\PermintaanPersediaan', '2024-11-09 22:02:54', '2024-11-09 22:02:54'),
(53, 'Trigonal Clips Besar', 'Kotak', 1, NULL, 0, NULL, 1, 4, 'App\\Models\\PermintaanPersediaan', '2024-11-09 22:23:47', '2024-11-09 22:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `bast_mitras`
--

CREATE TABLE `bast_mitras` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal_bast` date DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_arsip_id` mediumint UNSIGNED DEFAULT NULL,
  `ppk_user_id` mediumint UNSIGNED DEFAULT NULL,
  `kontrak_mitra_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bast_mitras`
--

INSERT INTO `bast_mitras` (`id`, `tanggal_bast`, `status`, `kode_arsip_id`, `ppk_user_id`, `kontrak_mitra_id`, `created_at`, `updated_at`) VALUES
(8, '2024-12-31', 'outdated', 29, 13, 8, '2024-11-03 07:02:15', '2024-11-03 07:41:58'),
(9, NULL, 'dibuat', NULL, NULL, 9, '2024-11-10 11:27:18', '2024-11-10 11:27:18');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_honor_mitras`
--

CREATE TABLE `daftar_honor_mitras` (
  `id` bigint UNSIGNED NOT NULL,
  `volume_target` smallint UNSIGNED DEFAULT NULL,
  `volume_realisasi` mediumint UNSIGNED DEFAULT NULL,
  `status_realisasi` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_satuan` mediumint UNSIGNED DEFAULT NULL,
  `persen_pajak` decimal(5,2) UNSIGNED DEFAULT NULL,
  `mitra_id` mediumint UNSIGNED DEFAULT NULL,
  `honor_kegiatan_id` mediumint UNSIGNED DEFAULT NULL,
  `daftar_kontrak_mitra_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_honor_mitras`
--

INSERT INTO `daftar_honor_mitras` (`id`, `volume_target`, `volume_realisasi`, `status_realisasi`, `harga_satuan`, `persen_pajak`, `mitra_id`, `honor_kegiatan_id`, `daftar_kontrak_mitra_id`, `created_at`, `updated_at`) VALUES
(37, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 77, 6, 6, '2024-11-02 17:08:56', '2024-11-03 07:42:40'),
(38, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 78, 6, 7, '2024-11-02 17:08:56', '2024-11-03 07:42:40'),
(39, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 68, 6, 5, '2024-11-02 17:08:56', '2024-11-03 07:42:40'),
(40, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 473, 6, 16, '2024-11-02 17:08:56', '2024-11-03 07:42:40'),
(41, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 46, 6, 3, '2024-11-02 17:08:56', '2024-11-03 07:42:40'),
(42, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 53, 6, 4, '2024-11-02 17:08:56', '2024-11-03 07:42:40'),
(43, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 2, 6, 1, '2024-11-02 17:08:56', '2024-11-03 07:42:40'),
(44, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 14, 6, 2, '2024-11-02 17:08:57', '2024-11-03 07:42:40'),
(45, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 279, 6, 11, '2024-11-02 17:08:57', '2024-11-03 07:42:40'),
(46, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 294, 6, 14, '2024-11-02 17:08:57', '2024-11-03 07:42:40'),
(47, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 293, 6, 13, '2024-11-02 17:08:57', '2024-11-03 07:42:40'),
(48, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 282, 6, 12, '2024-11-02 17:08:57', '2024-11-03 07:42:40'),
(49, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 242, 6, 8, '2024-11-02 17:08:57', '2024-11-03 07:42:40'),
(50, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 256, 6, 9, '2024-11-02 17:08:57', '2024-11-03 07:42:40'),
(51, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 259, 6, 10, '2024-11-02 17:08:57', '2024-11-03 07:42:40'),
(52, 3, 3, 'Selesai Sesuai Target', 10000, NULL, 329, 6, 15, '2024-11-02 17:08:57', '2024-11-03 07:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_honor_pegawais`
--

CREATE TABLE `daftar_honor_pegawais` (
  `id` bigint UNSIGNED NOT NULL,
  `volume` smallint UNSIGNED DEFAULT NULL,
  `harga_satuan` mediumint UNSIGNED DEFAULT NULL,
  `persen_pajak` decimal(5,2) UNSIGNED DEFAULT NULL,
  `user_id` mediumint UNSIGNED DEFAULT NULL,
  `honor_kegiatan_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_honor_pegawais`
--

INSERT INTO `daftar_honor_pegawais` (`id`, `volume`, `harga_satuan`, `persen_pajak`, `user_id`, `honor_kegiatan_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 5.00, 1, 1, '2024-10-26 06:56:21', '2024-10-26 06:56:21'),
(2, NULL, NULL, NULL, 15, 2, '2024-10-26 07:39:55', '2024-10-26 07:39:55'),
(3, NULL, NULL, NULL, 4, 2, '2024-10-26 07:41:16', '2024-10-26 07:41:16'),
(4, NULL, NULL, NULL, 6, 2, '2024-10-26 07:43:23', '2024-10-26 07:52:48'),
(5, NULL, NULL, NULL, 3, 3, '2024-10-26 22:02:38', '2024-10-26 23:21:21'),
(6, NULL, NULL, NULL, 5, 3, '2024-10-26 22:03:38', '2024-10-26 22:03:38'),
(7, 1, 100000, 5.00, 1, 3, '2024-10-26 22:09:20', '2024-10-26 23:21:34'),
(8, 2, 10000, 5.00, 5, 6, '2024-11-10 09:12:58', '2024-11-10 09:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_kontrak_mitras`
--

CREATE TABLE `daftar_kontrak_mitras` (
  `id` bigint UNSIGNED NOT NULL,
  `kontrak_naskah_keluar_id` mediumint UNSIGNED DEFAULT NULL,
  `bast_naskah_keluar_id` mediumint UNSIGNED DEFAULT NULL,
  `jumlah_kegiatan` smallint UNSIGNED DEFAULT NULL,
  `nilai_kontrak` mediumint UNSIGNED DEFAULT NULL,
  `valid_sbml` tinyint(1) DEFAULT NULL,
  `valid_jumlah_kontrak` tinyint(1) DEFAULT NULL,
  `mitra_id` mediumint UNSIGNED DEFAULT NULL,
  `kontrak_mitra_id` mediumint UNSIGNED DEFAULT NULL,
  `bast_mitra_id` mediumint UNSIGNED DEFAULT NULL,
  `status_kontrak` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_bast` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_kontrak_mitras`
--

INSERT INTO `daftar_kontrak_mitras` (`id`, `kontrak_naskah_keluar_id`, `bast_naskah_keluar_id`, `jumlah_kegiatan`, `nilai_kontrak`, `valid_sbml`, `valid_jumlah_kontrak`, `mitra_id`, `kontrak_mitra_id`, `bast_mitra_id`, `status_kontrak`, `status_bast`, `created_at`, `updated_at`) VALUES
(1, 224, 240, 1, 30000, 1, 1, 2, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:15', '2024-11-03 07:43:00'),
(2, 225, 241, 1, 30000, 1, 1, 14, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:15', '2024-11-03 07:43:00'),
(3, 226, 242, 1, 30000, 1, 1, 46, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:15', '2024-11-03 07:43:00'),
(4, 227, 243, 1, 30000, 1, 1, 53, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:15', '2024-11-03 07:42:59'),
(5, 228, 244, 1, 30000, 1, 1, 68, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:15', '2024-11-03 07:42:59'),
(6, 229, 245, 1, 30000, 1, 1, 77, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:16', '2024-11-03 07:42:59'),
(7, 230, 246, 1, 30000, 1, 1, 78, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:16', '2024-11-03 07:42:59'),
(8, 231, 247, 1, 30000, 1, 1, 242, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:16', '2024-11-03 07:42:59'),
(9, 232, 248, 1, 30000, 1, 1, 256, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:16', '2024-11-03 07:42:59'),
(10, 233, 249, 1, 30000, 1, 1, 259, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:16', '2024-11-03 07:42:59'),
(11, 234, 250, 1, 30000, 1, 1, 279, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:16', '2024-11-03 07:42:59'),
(12, 235, 251, 1, 30000, 1, 1, 282, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:16', '2024-11-03 07:42:59'),
(13, 236, 252, 1, 30000, 1, 1, 293, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:16', '2024-11-03 07:42:59'),
(14, 237, 253, 1, 30000, 1, 1, 294, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:17', '2024-11-03 07:42:59'),
(15, 238, 254, 1, 30000, 1, 1, 329, 8, 8, 'dicetak', 'outdated', '2024-11-03 07:41:17', '2024-11-03 07:42:59'),
(16, 239, 255, 1, 30000, 1, 1, 473, 8, 8, 'dicetak', 'dibuat', '2024-11-03 07:41:17', '2024-11-03 07:42:58');

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawais`
--

CREATE TABLE `data_pegawais` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `pangkat` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_kerja_id` mediumint UNSIGNED DEFAULT NULL,
  `user_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_pegawais`
--

INSERT INTO `data_pegawais` (`id`, `tanggal`, `pangkat`, `golongan`, `jabatan`, `unit_kerja_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2024-01-01', 'Penata Tingkat 1', 'III/d', 'Kepala Subbagian Umum', 1, 1, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(2, '2024-01-01', 'Penata Muda Tingkat 1', 'III/b', 'Statistisi Ahli Pertama', 3, 2, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(3, '2024-01-01', 'Penata Muda Tingkat 1', 'III/b', 'Statistisi Mahir', 1, 3, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(4, '2024-01-01', 'Penata', 'III/c', 'Statistisi Ahli Muda', 4, 4, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(5, '2024-01-01', 'Penata Muda Tingkat 1', 'III/b', 'Statistisi Ahli Pertama', 4, 5, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(6, '2024-01-01', 'Penata Muda Tingkat 1', 'III/b', 'Pelaksana', 3, 6, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(7, '2024-01-01', 'Penata Muda', 'III/a', 'Statistisi Mahir', 2, 7, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(8, '2024-01-01', 'Penata Muda Tingkat 1', 'III/b', 'Statistisi Ahli Pertama', 2, 8, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(9, '2024-01-01', 'Penata Muda Tingkat 1', 'III/b', 'Statistisi Ahli Muda', 2, 9, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(10, '2024-01-01', 'Penata Muda Tingkat 1', 'III/b', 'Statistisi Ahli Pertama', 6, 10, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(11, '2024-01-01', 'Penata', 'III/c', 'Pranata Komputer Ahli Muda', 5, 11, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(12, '2024-01-01', 'Penata Muda Tingkat 1', 'III/b', 'Pelaksana', 5, 12, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(13, '2024-01-01', 'Penata Muda', 'III/a', 'Statistisi Ahli Pertama', 5, 13, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(14, '2024-01-01', 'Penata Muda Tingkat 1', 'III/b', 'Statistisi Ahli Pertama', 6, 14, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(15, '2024-01-01', 'Pengatur Muda Tingkat 1', 'II/b', 'Fungsional Umum', 1, 15, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(16, '2024-01-01', 'Pengatur', 'II/c', 'Fungsional Umum', 1, 16, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(17, '2024-01-01', 'Pengatur', 'II/c', 'Fungsional Umum', 3, 17, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(18, '2024-01-01', 'Penata Muda', 'III/a', 'Fungsional Umum', 3, 18, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(19, '2024-01-01', 'Penata Muda', 'III/a', 'Statistisi Mahir', 6, 19, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(20, '2024-01-01', 'Penata Muda Tingkat 1', 'III/b', 'Statistisi Mahir', 4, 20, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(21, '2024-01-01', 'Penata', 'III/c', 'Statistisi Ahli Muda', 3, 21, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(22, '2024-01-01', 'Pembina Tingkat 1', 'IV/b', 'Kepala', 7, 22, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(23, '2024-01-01', 'Penata', 'III/c', 'Statistisi Penyelia', 2, 23, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(24, '2024-01-01', 'Penata Muda', 'III/a', 'Statistisi Ahli Pertama', 4, 24, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(25, '2024-01-01', 'Penata Muda', 'III/a', 'Pelaksana', 3, 25, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(26, '2024-01-01', 'Penata Muda', 'III/a', 'Pelaksana', 2, 26, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(27, '2024-01-01', 'Penata Muda', 'III/a', 'Fungsional Umum', 5, 27, '2024-01-01 00:00:00', '2024-09-11 21:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `derajat_naskahs`
--

CREATE TABLE `derajat_naskahs` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `derajat` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tata_naskah_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `derajat_naskahs`
--

INSERT INTO `derajat_naskahs` (`id`, `kode`, `derajat`, `tata_naskah_id`, `created_at`, `updated_at`) VALUES
(1, 'B', 'Biasa', 1, '2024-08-06 07:10:57', '2024-08-08 02:08:17'),
(2, 'T', 'Terbatas', 1, '2024-08-06 07:10:57', '2024-08-08 02:08:17'),
(3, 'R', 'Rahasia', 1, '2024-08-06 07:10:57', '2024-08-08 02:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `dipas`
--

CREATE TABLE `dipas` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dipas`
--

INSERT INTO `dipas` (`id`, `nomor`, `tanggal`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 'SP DIPA No 428578/2024', '2023-11-23', '2024', '2024-10-25 16:27:42', '2024-11-10 20:35:47');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `harga_satuans`
--

CREATE TABLE `harga_satuans` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `harga_satuans`
--

INSERT INTO `harga_satuans` (`id`, `nomor`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'SBML No 1 Tahun 2024', '0023-12-23', '2024-10-25 16:28:54', '2024-10-25 16:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `honor_kegiatans`
--

CREATE TABLE `honor_kegiatans` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal_kak` date DEFAULT NULL,
  `judul_spj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mata_anggaran_id` mediumint UNSIGNED DEFAULT NULL,
  `perkiraan_anggaran` int UNSIGNED DEFAULT NULL,
  `awal` date DEFAULT NULL,
  `akhir` date DEFAULT NULL,
  `satuan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_spj` date DEFAULT NULL,
  `generate_sk` tinyint(1) DEFAULT NULL,
  `generate_st` tinyint(1) DEFAULT NULL,
  `tanggal_sk` date DEFAULT NULL,
  `tanggal_st` date DEFAULT NULL,
  `objek_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uraian_tugas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_honor` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bulan` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sheet_name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kontrak_id` mediumint UNSIGNED DEFAULT NULL,
  `kerangka_acuan_id` mediumint UNSIGNED DEFAULT NULL,
  `anggaran_kerangka_acuan_id` mediumint UNSIGNED DEFAULT NULL,
  `koordinator_user_id` mediumint UNSIGNED DEFAULT NULL,
  `ppk_user_id` mediumint UNSIGNED DEFAULT NULL,
  `kepala_user_id` mediumint UNSIGNED DEFAULT NULL,
  `kpa_user_id` mediumint UNSIGNED DEFAULT NULL,
  `bendahara_user_id` mediumint UNSIGNED DEFAULT NULL,
  `unit_kerja_id` mediumint UNSIGNED DEFAULT NULL,
  `sk_kode_arsip_id` mediumint UNSIGNED DEFAULT NULL,
  `st_kode_arsip_id` mediumint UNSIGNED DEFAULT NULL,
  `sk_naskah_keluar_id` mediumint UNSIGNED DEFAULT NULL,
  `st_naskah_keluar_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `honor_kegiatans`
--

INSERT INTO `honor_kegiatans` (`id`, `tanggal_kak`, `judul_spj`, `mata_anggaran_id`, `perkiraan_anggaran`, `awal`, `akhir`, `satuan`, `tanggal_spj`, `generate_sk`, `generate_st`, `tanggal_sk`, `tanggal_st`, `objek_sk`, `uraian_tugas`, `jenis_honor`, `bulan`, `tahun`, `kegiatan`, `status`, `sheet_name`, `jenis_kontrak_id`, `kerangka_acuan_id`, `anggaran_kerangka_acuan_id`, `koordinator_user_id`, `ppk_user_id`, `kepala_user_id`, `kpa_user_id`, `bendahara_user_id`, `unit_kerja_id`, `sk_kode_arsip_id`, `st_kode_arsip_id`, `sk_naskah_keluar_id`, `st_naskah_keluar_id`, `created_at`, `updated_at`) VALUES
(6, '2024-10-28', 'Daftar Honor Petugas Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024 a', NULL, 1000000, '2024-11-02', '2024-11-02', 'OJP', '2024-11-02', 1, 1, '2024-11-02', '2024-11-02', 'Petugas Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024 a', 'Melakukan Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024 a', 'Kontrak Mitra Bulanan', '12', '2024', 'Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024 a', 'outdated', 'Master 63 07 KSA24 45', 2, 7, 9, 1, 13, 22, 22, 16, 1, 29, 29, 46, 47, '2024-11-02 17:04:22', '2024-11-10 11:27:18'),
(7, '2024-11-02', 'Daftar Honor Petugas Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024 a', 169, 100000, '2024-11-02', '2024-11-02', NULL, '2024-11-02', 1, 1, '2024-11-02', '2024-11-02', 'Petugas Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024 a', 'Melakukan Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024 a', NULL, NULL, '2024', 'Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024 a', 'dibuat', NULL, NULL, 7, 13, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2024-11-11 06:42:06', '2024-11-11 06:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `izin_keluars`
--

CREATE TABLE `izin_keluars` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `keluar` time DEFAULT NULL,
  `kembali` time DEFAULT NULL,
  `kegiatan` text COLLATE utf8mb4_unicode_ci,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` mediumint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `izin_keluars`
--

INSERT INTO `izin_keluars` (`id`, `tanggal`, `keluar`, `kembali`, `kegiatan`, `bukti`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2024-11-09', '17:26:00', NULL, 'sdsdsd', NULL, 1, '2024-11-09 17:26:25', '2024-11-09 17:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kontraks`
--

CREATE TABLE `jenis_kontraks` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sbml` int UNSIGNED DEFAULT NULL,
  `harga_satuan_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_kontraks`
--

INSERT INTO `jenis_kontraks` (`id`, `jenis`, `sbml`, `harga_satuan_id`, `created_at`, `updated_at`) VALUES
(1, 'Pendataan', 100000, 1, '2024-10-25 16:29:09', '2024-10-25 16:29:09'),
(2, 'Pengo;ahan', 50000, 1, '2024-10-25 16:29:18', '2024-10-25 16:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_naskahs`
--

CREATE TABLE `jenis_naskahs` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_naskah_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_naskahs`
--

INSERT INTO `jenis_naskahs` (`id`, `jenis`, `format`, `template`, `kode_naskah_id`, `created_at`, `updated_at`) VALUES
(1, 'Peraturan Perundang-undangan', NULL, NULL, 1, '2024-08-06 07:10:57', '2024-08-08 02:08:17'),
(2, 'Instruksi', NULL, NULL, 1, '2024-08-08 02:07:14', '2024-08-08 02:07:14'),
(3, 'Surat Edaran', NULL, NULL, 1, '2024-08-08 02:07:34', '2024-08-08 02:07:34'),
(4, 'SOP Administrasi Pemerintahan', NULL, NULL, 1, '2024-08-08 02:08:00', '2024-08-08 02:08:00'),
(5, 'Keputusan', NULL, NULL, 2, '2024-08-08 02:11:01', '2024-08-08 02:11:01'),
(6, 'Surat Tugas', NULL, NULL, 3, '2024-08-08 02:13:13', '2024-08-08 02:13:13'),
(7, 'Surat Perintah', NULL, NULL, 3, '2024-08-08 02:13:28', '2024-08-08 02:13:28'),
(8, 'Nota Dinas', NULL, NULL, 4, '2024-08-08 02:13:57', '2024-08-08 02:13:57'),
(9, 'Memorandum', NULL, NULL, 4, '2024-08-08 02:14:25', '2024-08-08 02:14:25'),
(10, 'Disposisi', NULL, NULL, 4, '2024-08-08 02:15:38', '2024-08-08 02:15:38'),
(11, 'Undangan Internal', NULL, NULL, 4, '2024-08-08 02:16:00', '2024-08-08 02:16:00'),
(12, 'Surat Dinas Eksternal', NULL, NULL, 3, '2024-08-08 02:17:14', '2024-08-08 02:17:14'),
(13, 'Surat Perjanjian', NULL, NULL, 5, '2024-08-08 02:28:20', '2024-08-08 02:28:20'),
(14, 'Surat Kuasa', NULL, NULL, 5, '2024-08-08 02:28:39', '2024-08-08 02:28:39'),
(15, 'Berita Acara', NULL, NULL, 5, '2024-08-08 02:28:57', '2024-08-08 02:28:57'),
(16, 'Surat Keterangan', NULL, NULL, 5, '2024-08-08 02:29:16', '2024-08-08 02:29:16'),
(17, 'Surat Pengantar', NULL, NULL, 5, '2024-08-08 02:29:32', '2024-08-08 02:29:32'),
(18, 'Pengumuman', NULL, NULL, 5, '2024-08-08 02:29:45', '2024-08-08 02:29:45'),
(19, 'Laporan', NULL, NULL, 5, '2024-08-08 02:29:58', '2024-08-08 02:29:58'),
(20, 'Telaahan Staf', NULL, NULL, 5, '2024-08-08 02:30:16', '2024-08-08 02:30:16'),
(21, 'Notula', NULL, NULL, 5, '2024-08-08 02:30:29', '2024-08-08 02:30:29'),
(22, 'Sertifikat', NULL, NULL, 5, '2024-08-08 02:30:36', '2024-08-16 11:16:24'),
(23, 'Form Permintaan', 'B-<no_urut>/63070/KU.320/<tahun>', NULL, 3, '2024-08-10 18:08:56', '2024-09-03 21:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"a17ca8f2-1c70-420b-ad62-0ad0dc4239a8\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:22:\\\"App\\\\Models\\\\DataPegawai\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(2, 'default', '{\"uuid\":\"62ee78a6-df84-467e-99c7-4cccdef133eb\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:24:\\\"App\\\\Models\\\\DerajatNaskah\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(3, 'default', '{\"uuid\":\"8ef5f026-7635-450c-af0d-64b087dffcda\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:15:\\\"App\\\\Models\\\\Dipa\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(4, 'default', '{\"uuid\":\"f57e26b4-59cf-4ec9-9284-6659271d34a6\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:22:\\\"App\\\\Models\\\\HargaSatuan\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(5, 'default', '{\"uuid\":\"de150294-344e-469d-af11-c4c34b43eea8\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:23:\\\"App\\\\Models\\\\JenisKontrak\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(6, 'default', '{\"uuid\":\"874ab3e4-cf27-4272-a22b-b4f7a4b66da7\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:22:\\\"App\\\\Models\\\\JenisNaskah\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(7, 'default', '{\"uuid\":\"0e366c29-5cbe-4b59-9dba-405c876e9f93\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:24:\\\"App\\\\Models\\\\KamusAnggaran\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(8, 'default', '{\"uuid\":\"041034ab-f42d-4603-befa-a363cc0b2b39\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:20:\\\"App\\\\Models\\\\KodeArsip\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(9, 'default', '{\"uuid\":\"468f069c-1fbd-4b38-9704-04af92e4ead1\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:21:\\\"App\\\\Models\\\\KodeNaskah\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(10, 'default', '{\"uuid\":\"123d228c-74ed-40ad-b683-e969a8da47b2\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:23:\\\"App\\\\Models\\\\MataAnggaran\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(11, 'default', '{\"uuid\":\"b879252f-2453-42e2-bb6c-36f91d72e5ca\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:16:\\\"App\\\\Models\\\\Mitra\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(12, 'default', '{\"uuid\":\"6ac860ea-25ea-4dc8-90d8-7044fa968129\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:20:\\\"App\\\\Models\\\\Pengelola\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(13, 'default', '{\"uuid\":\"02667215-a863-4df0-b30c-8d0507a00e9b\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:21:\\\"App\\\\Models\\\\TataNaskah\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(14, 'default', '{\"uuid\":\"b6ea6cfd-0254-4899-8c07-3153a1badfbf\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:19:\\\"App\\\\Models\\\\Template\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(15, 'default', '{\"uuid\":\"e3d03f00-91c4-4d57-80e5-0376f29f728d\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:20:\\\"App\\\\Models\\\\UnitKerja\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(16, 'default', '{\"uuid\":\"181895d3-51ba-442d-9074-4ecfc92d4d78\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(17, 'default', '{\"uuid\":\"dbca4fb8-1e98-41ea-9cbd-4826a24a9a79\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:24:\\\"App\\\\Models\\\\NaskahDefault\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896622, 1729896622),
(18, 'default', '{\"uuid\":\"862d7836-737b-4e0d-9c54-d48ea74a18f9\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729896646, 1729896646),
(19, 'default', '{\"uuid\":\"12c8b0cd-d334-4fdf-be0b-b246ae69d4e1\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:20:\\\"App\\\\Models\\\\Pengelola\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729931890, 1729931890),
(20, 'default', '{\"uuid\":\"abda5d08-ab79-4297-bef5-e1d9bcaeb784\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1729956221, 1729956221),
(21, 'default', '{\"uuid\":\"ea69e92d-80e5-4f1c-8b8b-06b136c61c02\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:19:\\\"App\\\\Models\\\\Template\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1730118289, 1730118289),
(22, 'default', '{\"uuid\":\"38c00af3-45f5-4040-9cba-fac0ad792281\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:19:\\\"App\\\\Models\\\\Template\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1730122318, 1730122318),
(23, 'default', '{\"uuid\":\"5720e628-890e-49f3-bfd5-e73d74376c62\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:19:\\\"App\\\\Models\\\\Template\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1730602529, 1730602529),
(24, 'default', '{\"uuid\":\"a4afda7a-3f3e-4fab-891b-e62cd439992f\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:27:\\\"App\\\\Models\\\\MasterPersediaan\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1730603651, 1730603651),
(25, 'default', '{\"uuid\":\"be5b83c5-8adb-488c-9702-7b2de29329e3\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:19:\\\"App\\\\Models\\\\Template\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1730622462, 1730622462),
(26, 'default', '{\"uuid\":\"007accb9-20fc-411c-b22e-6e8cfeb582f7\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:19:\\\"App\\\\Models\\\\Template\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1730622487, 1730622487),
(27, 'default', '{\"uuid\":\"e57d95f3-3438-4360-b62d-2ed3e460d064\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:20:\\\"App\\\\Models\\\\Pengelola\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1730757040, 1730757040),
(28, 'default', '{\"uuid\":\"6e5cc2ec-df29-4ec7-a5fe-35bcfd5a1986\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:20:\\\"App\\\\Models\\\\Pengelola\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1730796888, 1730796888),
(29, 'default', '{\"uuid\":\"f3d08243-f335-4f01-8bd9-653bf629493e\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:24:\\\"App\\\\Models\\\\NaskahDefault\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731114479, 1731114479),
(30, 'default', '{\"uuid\":\"98c4381d-e9cb-4c7f-b902-03f909282d2a\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:27:\\\"App\\\\Models\\\\MasterPersediaan\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731155028, 1731155028),
(31, 'default', '{\"uuid\":\"026e6fcb-6822-4d47-8a83-47c563df5a28\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:16:\\\"App\\\\Models\\\\Mitra\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731193138, 1731193138),
(32, 'default', '{\"uuid\":\"15c9c971-d6bf-480a-8638-3ac4ed0db3e4\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:20:\\\"App\\\\Models\\\\Pengelola\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731194424, 1731194424),
(33, 'default', '{\"uuid\":\"5eb4a2db-90aa-4191-9c92-be675723c36d\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731202450, 1731202450),
(34, 'default', '{\"uuid\":\"f8819351-4be6-4531-8a02-32de863c2e55\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:24:\\\"App\\\\Models\\\\KamusAnggaran\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731237231, 1731237231),
(35, 'default', '{\"uuid\":\"20c1e9e5-4134-457f-8695-381694735ca5\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:24:\\\"App\\\\Models\\\\KamusAnggaran\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731237293, 1731237293),
(36, 'default', '{\"uuid\":\"81deff01-e2f5-4e76-99bb-c634bd296936\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:24:\\\"App\\\\Models\\\\KamusAnggaran\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731237327, 1731237327),
(37, 'default', '{\"uuid\":\"80f78d9c-755f-4482-bae5-c52c2025e31d\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:24:\\\"App\\\\Models\\\\KamusAnggaran\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731237473, 1731237473),
(38, 'default', '{\"uuid\":\"3974a8a8-0254-4df8-af94-cbfec1ae72e7\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:23:\\\"App\\\\Models\\\\MataAnggaran\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731237748, 1731237748),
(39, 'default', '{\"uuid\":\"ac882c13-b691-483e-b976-ca1ae7a56d1d\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:23:\\\"App\\\\Models\\\\MataAnggaran\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731241163, 1731241163),
(40, 'default', '{\"uuid\":\"5ba9264a-8659-430a-81ab-1cab8e6425d4\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:23:\\\"App\\\\Models\\\\MataAnggaran\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731241999, 1731241999),
(41, 'default', '{\"uuid\":\"63985859-18a5-4e25-bd0a-805f09fe150d\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:23:\\\"App\\\\Models\\\\MataAnggaran\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731242101, 1731242101),
(42, 'default', '{\"uuid\":\"54aca908-ab84-4ca3-aa2c-2f488fd195c6\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:23:\\\"App\\\\Models\\\\MataAnggaran\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731242131, 1731242131),
(43, 'default', '{\"uuid\":\"2ffb8245-9b2b-4ada-8952-5217c60acd5c\",\"displayName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\",\"command\":\"O:51:\\\"Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\\":4:{s:59:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000driver\\\";s:4:\\\"file\\\";s:56:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000key\\\";s:16:\\\"laracache.models\\\";s:58:\\\"\\u0000Mostafaznv\\\\LaraCache\\\\Jobs\\\\UpdateLaraCacheModelsList\\u0000model\\\";s:15:\\\"App\\\\Models\\\\Dipa\\\";s:5:\\\"queue\\\";s:7:\\\"default\\\";}\"}}', 0, NULL, 1731242147, 1731242147),
(44, 'default', '{\"uuid\":\"ffce4b30-878f-4479-86f2-a6b0b5ed9834\",\"displayName\":\"App\\\\Nova\\\\Actions\\\\Download\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Nova\\\\Actions\\\\CallQueuedAction\",\"command\":\"O:37:\\\"Laravel\\\\Nova\\\\Actions\\\\CallQueuedAction\\\":5:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:24:\\\"App\\\\Models\\\\KerangkaAcuan\\\";s:2:\\\"id\\\";a:1:{i:0;i:7;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";s:42:\\\"Laravel\\\\Nova\\\\Actions\\\\ActionModelCollection\\\";}s:6:\\\"action\\\";O:25:\\\"App\\\\Nova\\\\Actions\\\\Download\\\":34:{s:8:\\\"\\u0000*\\u0000jenis\\\";s:3:\\\"kak\\\";s:8:\\\"\\u0000*\\u0000title\\\";s:9:\\\"Unduh KAK\\\";s:4:\\\"name\\\";N;s:6:\\\"uriKey\\\";N;s:9:\\\"component\\\";s:20:\\\"confirm-action-modal\\\";s:19:\\\"withoutActionEvents\\\";b:0;s:19:\\\"withoutConfirmation\\\";b:0;s:11:\\\"onlyOnIndex\\\";b:0;s:12:\\\"onlyOnDetail\\\";b:0;s:11:\\\"showOnIndex\\\";b:0;s:12:\\\"showOnDetail\\\";b:1;s:10:\\\"showInline\\\";b:1;s:13:\\\"actionBatchId\\\";N;s:17:\\\"confirmButtonText\\\";s:5:\\\"Unduh\\\";s:16:\\\"cancelButtonText\\\";s:6:\\\"Cancel\\\";s:11:\\\"confirmText\\\";s:41:\\\"Are you sure you want to run this action?\\\";s:10:\\\"standalone\\\";b:0;s:4:\\\"sole\\\";b:0;s:12:\\\"responseType\\\";s:4:\\\"json\\\";s:9:\\\"modalSize\\\";s:3:\\\"2xl\\\";s:10:\\\"modalStyle\\\";s:6:\\\"window\\\";s:21:\\\"authorizedToRunAction\\\";b:1;s:14:\\\"handleCallback\\\";N;s:4:\\\"meta\\\";a:0:{}s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}s:6:\\\"method\\\";s:6:\\\"handle\\\";s:6:\\\"fields\\\";O:32:\\\"Laravel\\\\Nova\\\\Fields\\\\ActionFields\\\":2:{s:13:\\\"\\u0000*\\u0000attributes\\\";a:2:{s:8:\\\"filename\\\";s:13:\\\"67312c8b2396a\\\";s:8:\\\"template\\\";s:1:\\\"3\\\";}s:9:\\\"callbacks\\\";O:35:\\\"Laravel\\\\Nova\\\\Fields\\\\FieldCollection\\\":2:{s:8:\\\"\\u0000*\\u0000items\\\";a:0:{}s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;}}s:13:\\\"actionBatchId\\\";s:36:\\\"9d75689e-300e-4ac1-aa65-60a86ea67517\\\";}\"}}', 0, NULL, 1731275919, 1731275919);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kamus_anggarans`
--

CREATE TABLE `kamus_anggarans` (
  `id` bigint UNSIGNED NOT NULL,
  `mak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dipa_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamus_anggarans`
--

INSERT INTO `kamus_anggarans` (`id`, `mak`, `detail`, `dipa_id`, `created_at`, `updated_at`) VALUES
(1, '428578', 'BADAN PUSAT STATISTIK KAB. HULU SUNGAI TENGAH', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(2, '054.01.GG', 'Program Penyediaan dan Pelayanan Informasi Statistik', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(3, '054.01.GG.2896', 'Pengembangan dan Analisis Statistik', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(4, '054.01.GG.2896.BMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(5, '054.01.GG.2896.BMA.004', 'PUBLIKASI/LAPORAN ANALISIS DAN PENGEMBANGAN STATISTIK', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(6, '054.01.GG.2896.BMA.004.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(7, '054.01.GG.2896.BMA.004.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(8, '054.01.GG.2896.BMA.004.005.A.521811.A', 'Belanja Barang Persediaan Barang Konsumsi', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(9, '054.01.GG.2896.BMA.004.005.A.521811.A.00001', '- Alat Tulis Kantor (ATK)', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(10, '054.01.GG.2897', 'Pelayanan dan Pengembangan Diseminasi Informasi Statistik', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(11, '054.01.GG.2897.BDB', 'Fasilitasi dan Pembinaan Lembaga', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(12, '054.01.GG.2897.BDB.003', 'LAPORAN PENYELENGGARAAN SISTEM STATISTIK NASIONAL (SSN)', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(13, '054.01.GG.2897.BDB.003.052', 'PENGUMPULAN DATA', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(14, '054.01.GG.2897.BDB.003.052.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(15, '054.01.GG.2897.BDB.003.052.A.522151.A', 'Belanja Jasa Profesi', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(16, '054.01.GG.2897.BDB.003.052.A.522151.A.00001', '- honor narasumber eselon ii/ ke bawah', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(17, '054.01.GG.2897.BDB.003.054', 'DISEMINASI DAN EVALUASI', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(18, '054.01.GG.2897.BDB.003.054.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(19, '054.01.GG.2897.BDB.003.054.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(20, '054.01.GG.2897.BDB.003.054.A.521211.A.00001', '- Konsumsi Pembinaan Statistik Sektoral', 1, '2024-11-10 19:14:50', '2024-11-10 19:17:50'),
(21, '054.01.GG.2897.BDB.003.054.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(22, '054.01.GG.2897.BDB.003.054.A.524111.A.00001', '- Perjalanan dinas ke BPS Provinsi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(23, '054.01.GG.2897.BDB.003.054.A.524119.A', 'Belanja Perjalanan Dinas Paket Meeting Luar Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(24, '054.01.GG.2897.BDB.003.054.A.524119.A.00001', '- Perjalanan rapat pleno provinsi epss', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(25, '054.01.GG.2897.BMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(26, '054.01.GG.2897.BMA.004', 'LAPORAN DISEMINASI DAN METADATA STATISTIK', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(27, '054.01.GG.2897.BMA.004.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(28, '054.01.GG.2897.BMA.004.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(29, '054.01.GG.2897.BMA.004.005.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(30, '054.01.GG.2897.BMA.004.005.A.521211.A.00001', '- ATK dan Computer Supplies', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(31, '054.01.GG.2897.BMA.004.052', 'PENGUMPULAN DATA', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(32, '054.01.GG.2897.BMA.004.052.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(33, '054.01.GG.2897.BMA.004.052.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(34, '054.01.GG.2897.BMA.004.052.A.521211.A.00001', '- Konsumsi FGD KDA 2024', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(35, '054.01.GG.2897.BMA.004.053', 'PENGOLAHAN DAN ANALISIS', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(36, '054.01.GG.2897.BMA.004.053.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(37, '054.01.GG.2897.BMA.004.053.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(38, '054.01.GG.2897.BMA.004.053.A.524111.A.00001', '- Perjalanan Dinas ke BPS Provinsi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(39, '054.01.GG.2898', 'Penyediaan dan Pengembangan Statistik Neraca Pengeluaran', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(40, '054.01.GG.2898.BMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(41, '054.01.GG.2898.BMA.007', 'PUBLIKASI/LAPORAN STATISTIK NERACA PENGELUARAN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(42, '054.01.GG.2898.BMA.007.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(43, '054.01.GG.2898.BMA.007.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(44, '054.01.GG.2898.BMA.007.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(45, '054.01.GG.2898.BMA.007.005.A.521213.A.00001', '- honor petugas pendataan lapangan sklnpt', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(46, '054.01.GG.2898.BMA.007.005.A.521213.A.00002', '- honor petugas pendataan lapangan skps', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(47, '054.01.GG.2898.BMA.007.005.A.521213.A.00003', '- honor petugas pendataan lapangan sksppi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(48, '054.01.GG.2898.BMA.007.005.A.521213.A.00004', '- honor petugas pendataan lapangan updating direktori lnprt', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(49, '054.01.GG.2898.BMA.007.005.A.521213.A.00005', '- honor petugas pendataan lapangan sklnp', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(50, '054.01.GG.2898.BMA.007.005.A.521213.A.00006', '- honor petugas pendataan lapangan sksip', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(51, '054.01.GG.2898.BMA.007.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(52, '054.01.GG.2898.BMA.007.005.A.524113.A.00001', '- transport lokal', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(53, '054.01.GG.2898.BMA.007.051', 'PERSIAPAN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(54, '054.01.GG.2898.BMA.007.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(55, '054.01.GG.2898.BMA.007.051.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(56, '054.01.GG.2898.BMA.007.051.A.521211.A.00001', '- perlengkapan pelatihan SKTDNPENG', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(57, '054.01.GG.2898.BMA.007.051.A.521211.A.00002', '- konsumsi pelatihan SKTDNPENG', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(58, '054.01.GG.2898.BMA.007.051.A.521211.A.00003', '- paket data pelatihan SKTDNPENG', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(59, '054.01.GG.2898.BMA.007.051.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(60, '054.01.GG.2898.BMA.007.051.A.521213.A.00001', '- honor pengajar petugas pendataan SKTDNPENG', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(61, '054.01.GG.2898.BMA.007.051.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(62, '054.01.GG.2898.BMA.007.051.A.524113.A.00001', '- transport lokal pelatihan SKTDNPENG', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(63, '054.01.GG.2898.BMA.007.053', 'PENGOLAHAN DAN ANALISIS', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(64, '054.01.GG.2898.BMA.007.053.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(65, '054.01.GG.2898.BMA.007.053.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(66, '054.01.GG.2898.BMA.007.053.A.524111.A.00001', '- Konsultasi kab/kot ke provinsi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(67, '054.01.GG.2898.QMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(68, '054.01.GG.2898.QMA.008', 'PUBLIKASI/LAPORAN PENYUSUNAN DISAGREGASI PMTB', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(69, '054.01.GG.2898.QMA.008.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(70, '054.01.GG.2898.QMA.008.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(71, '054.01.GG.2898.QMA.008.005.A.521811.A', 'Belanja Barang Persediaan Barang Konsumsi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(72, '054.01.GG.2898.QMA.008.005.A.521811.A.00001', '- Alat Tulis Kantor (ATK)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(73, '054.01.GG.2898.QMA.008.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(74, '054.01.GG.2898.QMA.008.005.A.524113.A.00001', '- transport lokal', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(75, '054.01.GG.2899', 'Penyediaan dan Pengembangan Statistik Neraca Produksi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(76, '054.01.GG.2899.BMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(77, '054.01.GG.2899.BMA.006', 'PUBLIKASI/LAPORAN NERACA PRODUKSI', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(78, '054.01.GG.2899.BMA.006.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(79, '054.01.GG.2899.BMA.006.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(80, '054.01.GG.2899.BMA.006.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(81, '054.01.GG.2899.BMA.006.005.A.521213.A.00001', '- honor petugas pendataan lapangan sksj 2024', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(82, '054.01.GG.2899.BMA.006.005.A.521213.A.00002', '- honor petugas pendataan lapangan sktnp jasa 2024', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(83, '054.01.GG.2899.BMA.006.005.A.521213.A.00003', '- honor petugas pendataan lapangan survei khusus neraca produksi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(84, '054.01.GG.2899.BMA.006.005.A.521213.A.00004', '- honor petugas pendataan lapangan in-depth study seea', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(85, '054.01.GG.2899.BMA.006.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(86, '054.01.GG.2899.BMA.006.005.A.524113.A.00001', '- transport lokal', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(87, '054.01.GG.2899.BMA.006.051', 'PERSIAPAN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(88, '054.01.GG.2899.BMA.006.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(89, '054.01.GG.2899.BMA.006.051.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(90, '054.01.GG.2899.BMA.006.051.A.524111.A.00001', '- Konsultasi kab/kot ke provinsi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(91, '054.01.GG.2900', 'Pengembangan Metodologi Sensus dan Survei', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(92, '054.01.GG.2900.BMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(93, '054.01.GG.2900.BMA.005', 'DOKUMEN, LAPORAN, DAN PUBLIKASI PENGEMBANGAN METODOLOGI SENSUS DAN SURVEI', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(94, '054.01.GG.2900.BMA.005.052', 'PENGUMPULAN DATA', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(95, '054.01.GG.2900.BMA.005.052.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(96, '054.01.GG.2900.BMA.005.052.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(97, '054.01.GG.2900.BMA.005.052.A.521211.A.00001', '- Konsumsi Rapat', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(98, '054.01.GG.2900.BMA.005.052.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(99, '054.01.GG.2900.BMA.005.052.A.524111.A.00001', '- Perjalanan dinas ke BPS Provinsi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(100, '054.01.GG.2900.BMA.005.052.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(101, '054.01.GG.2900.BMA.005.052.A.524113.A.00001', '- Perjalanan dinas dalam rangka Pengembangan Mixed Method BPS Kabupaten/Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(102, '054.01.GG.2900.BMA.005.052.A.524113.A.00002', '- Perjalanan penunjuk jalan kegiatan Pengembangan Mixed Method', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(103, '054.01.GG.2902', 'Penyediaan dan Pengembangan Statistik Distribusi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(104, '054.01.GG.2902.BMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(105, '054.01.GG.2902.BMA.004', 'PUBLIKASI/LAPORAN STATISTIK DISTRIBUSI', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(106, '054.01.GG.2902.BMA.004.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(107, '054.01.GG.2902.BMA.004.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(108, '054.01.GG.2902.BMA.004.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(109, '054.01.GG.2902.BMA.004.005.A.521213.A.00001', '- Honor petugas pendataan lapangan updating profil pasar 2024', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(110, '054.01.GG.2902.BMA.004.005.A.521213.A.00002', '- Honor petugas pendataan lapangan survei perdagangan antar wilayah', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(111, '054.01.GG.2902.BMA.004.005.A.521213.A.00003', '- Honor petugas pendataan lapangan survei pergudangan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(112, '054.01.GG.2902.BMA.004.005.A.521811.A', 'Belanja Barang Persediaan Barang Konsumsi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(113, '054.01.GG.2902.BMA.004.005.A.521811.A.00001', '- ATK dan Computer Supplies', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(114, '054.01.GG.2902.BMA.004.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(115, '054.01.GG.2902.BMA.004.005.A.524113.A.00001', '- Transport lokal petugas pemeriksaan lapangan survei perdagangan antar wilayah', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(116, '054.01.GG.2902.BMA.004.051', 'PERSIAPAN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(117, '054.01.GG.2902.BMA.004.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(118, '054.01.GG.2902.BMA.004.051.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(119, '054.01.GG.2902.BMA.004.051.A.521211.A.00001', '- paket data/biaya komunikasi pelatihan petugas survei rutin distribusi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(120, '054.01.GG.2902.BMA.004.051.A.521211.A.00002', '- konsumsi pelatihan petugas survei rutin distribusi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(121, '054.01.GG.2902.BMA.004.051.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(122, '054.01.GG.2902.BMA.004.051.A.521213.A.00001', '- honor pengajar pelatihan petugas survei rutin distribusi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(123, '054.01.GG.2902.BMA.004.051.A.521213.A.00002', '- Honor pengajar pelatihan petugas updating profil pasar', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(124, '054.01.GG.2902.BMA.004.051.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(125, '054.01.GG.2902.BMA.004.051.A.524113.A.00001', '- Transport pelatihan petugas survei rutin distribusi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(126, '054.01.GG.2902.QMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(127, '054.01.GG.2902.QMA.006', 'PUBLIKASI/LAPORAN SENSUS EKONOMI 2026', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(128, '054.01.GG.2902.QMA.006.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(129, '054.01.GG.2902.QMA.006.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(130, '054.01.GG.2902.QMA.006.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(131, '054.01.GG.2902.QMA.006.005.A.521213.A.00001', '- Honor petugas pendataan lapangan updating direktori usaha perusahaan ekonomi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(132, '054.01.GG.2902.QMA.006.005.A.521811.A', 'Belanja Barang Persediaan Barang Konsumsi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(133, '054.01.GG.2902.QMA.006.005.A.521811.A.00001', '- ATK dan Computer Supplies', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(134, '054.01.GG.2902.QMA.006.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(135, '054.01.GG.2902.QMA.006.005.A.524113.A.00001', '- transport lokal petugas pencaahan lapangan Updating Direktori Usaha/Perusahaan Ekonomi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(136, '054.01.GG.2902.QMA.006.503', 'Updating Direktori Usaha/Perusahaan Ekonomi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(137, '054.01.GG.2902.QMA.006.503.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(138, '054.01.GG.2902.QMA.006.503.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(139, '054.01.GG.2902.QMA.006.503.A.521211.A.00001', '- Biaya konsumsi pelatihan petugas lapangan updating direktori usaha/perusahaan ekonomi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(140, '054.01.GG.2902.QMA.006.503.A.521211.A.00002', '- Biaya pulsa pelatihan petugas lapangan updating direktori usaha/perusahaan ekonomi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(141, '054.01.GG.2902.QMA.006.503.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(142, '054.01.GG.2902.QMA.006.503.A.521213.A.00001', '- Honor inda pelatihan updating direktori usaha/perusahaan ekonomi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(143, '054.01.GG.2902.QMA.006.503.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(144, '054.01.GG.2902.QMA.006.503.A.524113.A.00001', '- Transport pelatihan petugas lapangan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:50'),
(145, '054.01.GG.2903', 'Penyediaan dan Pengembangan Statistik Harga', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(146, '054.01.GG.2903.BMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(147, '054.01.GG.2903.BMA.009', 'PUBLIKASI/LAPORAN STATISTIK HARGA', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(148, '054.01.GG.2903.BMA.009.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(149, '054.01.GG.2903.BMA.009.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(150, '054.01.GG.2903.BMA.009.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(151, '054.01.GG.2903.BMA.009.005.A.521213.A.00001', '- honor petugas pendataan lapangan ikp 2024', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(152, '054.01.GG.2903.BMA.009.005.A.521213.A.00002', '- honor petugas pengolahan data hasil ikp(non PNS)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(153, '054.01.GG.2903.BMA.009.005.A.521213.A.00003', '- honor petugas pendataan lapangan hpg', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(154, '054.01.GG.2903.BMA.009.005.A.521213.A.00004', '- honor petugas pendataan lapangan paket komoditas shkk (non pns)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(155, '054.01.GG.2903.BMA.009.005.A.521213.A.00005', '- honor petugas listing svpeb', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(156, '054.01.GG.2903.BMA.009.005.A.521213.A.00006', '- honor petugas pendataan lapangan hk 1.1, 1.2, 4, 5 dan 6 (non pns)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(157, '054.01.GG.2903.BMA.009.005.A.521213.A.00007', '- honor petugas pendataan lapangan hk 2.1, 2.2, dan 3 (non pns)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(158, '054.01.GG.2903.BMA.009.005.A.521213.A.00008', '- honor petugas pendataan lapangan svk (non pns)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(159, '054.01.GG.2903.BMA.009.005.A.521213.A.00009', '- honor petugas pendataan lapangan svpeb (non pns)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(160, '054.01.GG.2903.BMA.009.005.A.521213.A.00010', '- honor petugas pendataan lapangan survei harga perdagangan besar (non pns)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(161, '054.01.GG.2903.BMA.009.005.A.521213.A.00011', '- honor petugas pendataan lapangan survei harga konsumen perdesaan (hkd) non pns', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(162, '054.01.GG.2903.BMA.009.005.A.521213.A.00012', '- honor petugas pendataan lapangan survei harga produsen perdesaan (hd) non pns', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(163, '054.01.GG.2903.BMA.009.005.A.521213.A.00013', '- honor petugas pendataan lapangan hpbg', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(164, '054.01.GG.2903.BMA.009.005.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(165, '054.01.GG.2903.BMA.009.005.A.524111.A.00001', '- Perjalanan dinas ke BPS Provinsi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(166, '054.01.GG.2903.BMA.009.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(167, '054.01.GG.2903.BMA.009.005.A.524113.A.00001', '- transport lokal petugas pemeriksaan lapangan hpbg', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(168, '054.01.GG.2903.BMA.009.005.A.524113.A.00002', '- transport lokal petugas pemeriksaan lapangan dokumen hasil survei harga perdagangan besar (pns)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(169, '054.01.GG.2903.BMA.009.005.A.524113.A.00003', '- transport lokal petugas pemeriksaan lapangan hp (kabkot)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(170, '054.01.GG.2903.BMA.009.005.A.524113.A.00004', '- transport lokal petugas pemeriksaan lapangan hk 1.1, 1.2, 4, 5 dan 6', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(171, '054.01.GG.2903.BMA.009.005.A.524113.A.00005', '- transport lokal petugas pemeriksaan lapangan ikp 2024 (kabkot)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(172, '054.01.GG.2903.BMA.009.005.A.524113.A.00006', '- translok petugas pengolahan data hasil ikp (PNS) (kabkot)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(173, '054.01.GG.2903.BMA.009.005.A.524113.A.00007', '- transport lokal petugas pemeriksaan lapangan data hasil pencacahan shkk (kabkot)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(174, '054.01.GG.2903.BMA.009.005.A.524113.A.00008', '- transport lokal petugas pemeriksaan lapangan svk', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(175, '054.01.GG.2903.BMA.009.005.A.524113.A.00009', '- transport lokal petugas pemeriksaan lapangan survei harga produsen perdesaan (hd)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(176, '054.01.GG.2903.BMA.009.051', 'PERSIAPAN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(177, '054.01.GG.2903.BMA.009.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(178, '054.01.GG.2903.BMA.009.051.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(179, '054.01.GG.2903.BMA.009.051.A.521211.A.00001', '- Konsumsi pelatihan petugas SHPBG', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(180, '054.01.GG.2903.BMA.009.051.A.521211.A.00002', '- perlengkapan fullboard pelatihan petugas penyusunan ikp', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(181, '054.01.GG.2903.BMA.009.051.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(182, '054.01.GG.2903.BMA.009.051.A.521213.A.00001', '- honor innas pelatihan petugas SHPBG', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(183, '054.01.GG.2903.BMA.009.051.A.521213.A.00002', '- honor innas pelatihan petugas penyusunan ikp', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(184, '054.01.GG.2903.BMA.009.051.A.521219.A', 'Belanja Barang Non Operasional Lainnya', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(185, '054.01.GG.2903.BMA.009.051.A.521219.A.00001', '- penggantian contoh gabah untuk survei hpg', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(186, '054.01.GG.2903.BMA.009.051.A.521219.A.00002', '- penggantian contoh beras untuk survei hpbg shp', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(187, '054.01.GG.2903.BMA.009.051.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(188, '054.01.GG.2903.BMA.009.051.A.524113.A.00001', '- Transport peserta pelatihan petugas SHPBG', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(189, '054.01.GG.2903.BMA.009.051.A.524114.A', 'Belanja Perjalanan Dinas Paket Meeting Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(190, '054.01.GG.2903.BMA.009.051.A.524114.A.00001', '- paket meeting pelatihan petugas lapangan ikp (kabkot)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(191, '054.01.GG.2903.BMA.009.051.A.524114.A.00002', '- transpot dan uang harian paket meeting pelatihan petugas lapangan ikp (kabkot)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(192, '054.01.GG.2904', 'Penyediaan dan Pengembangan Statistik Industri, Pertambangan dan Penggalian, Energi, dan Konstruksi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(193, '054.01.GG.2904.BMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(194, '054.01.GG.2904.BMA.006', 'PUBLIKASI/LAPORAN STATISTIK INDUSTRI, PERTAMBANGAN DAN PENGGALIAN, ENERGI, DAN KONSTRUKSI', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(195, '054.01.GG.2904.BMA.006.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(196, '054.01.GG.2904.BMA.006.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(197, '054.01.GG.2904.BMA.006.005.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(198, '054.01.GG.2904.BMA.006.005.A.521211.A.00001', '- biaya pulsa/paket data pelatihan petugas stpim', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(199, '054.01.GG.2904.BMA.006.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(200, '054.01.GG.2904.BMA.006.005.A.521213.A.00001', '- honor petugas pendataan lapangan pemutakhiran dpa 2024', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(201, '054.01.GG.2904.BMA.006.005.A.521213.A.00002', '- honor petugas pendataan lapangan survei ibs tahunan (stpim) 2024', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(202, '054.01.GG.2904.BMA.006.005.A.521213.A.00003', '- honor petugas pendataan lapangan listing vimk24 tahunan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(203, '054.01.GG.2904.BMA.006.005.A.521213.A.00004', '- honor petugas pendataan lapangan vimk24 tahunan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(204, '054.01.GG.2904.BMA.006.005.A.521213.A.00005', '- honor petugas pendataan lapangan listing vimk 2024 triwulanan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(205, '054.01.GG.2904.BMA.006.005.A.521213.A.00006', '- honor petugas pendataan lapangan vimk23 triwulanan triwulan 4', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(206, '054.01.GG.2904.BMA.006.005.A.521213.A.00007', '- honor petugas pendataan lapangan vimk24 triwulanan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(207, '054.01.GG.2904.BMA.006.005.A.521213.A.00008', '- honor petugas pendataan lapangan updating direktori perusahaan konstruksi (udp)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(208, '054.01.GG.2904.BMA.006.005.A.521213.A.00009', '- honor petugas pendataan lapangan survei konstruksi tahunan (skth)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(209, '054.01.GG.2904.BMA.006.005.A.521213.A.00010', '- honor petugas pendataan lapangan survei konstruksi triwulanan (sktr)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(210, '054.01.GG.2904.BMA.006.005.A.521213.A.00011', '- honor petugas pendataan lapangan survei captive power', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(211, '054.01.GG.2904.BMA.006.005.A.521213.A.00012', '- honor petugas pendataan lapangan survei usaha penggalian', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(212, '054.01.GG.2904.BMA.006.005.A.521213.A.00013', '- honor petugas pendataan lapangan survei triwulanan air bersih', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(213, '054.01.GG.2904.BMA.006.005.A.521213.A.00014', '- honor petugas pendataan lapangan survei air bersih', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(214, '054.01.GG.2904.BMA.006.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(215, '054.01.GG.2904.BMA.006.005.A.524113.A.00001', '- transport lokal petugas pemeriksaan listing vimk24 triwulanan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(216, '054.01.GG.2904.BMA.006.005.A.524113.A.00002', '- transport lokal petugas pemeriksaan vimk24 triwulanan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(217, '054.01.GG.2904.BMA.006.051', 'PERSIAPAN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(218, '054.01.GG.2904.BMA.006.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(219, '054.01.GG.2904.BMA.006.051.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(220, '054.01.GG.2904.BMA.006.051.A.521211.A.00001', '- Konsumsi Pelatihan Petugas', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(221, '054.01.GG.2904.BMA.006.051.A.521211.A.00002', '- Perlengkapan Peserta Pelatihan Petugas', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(222, '054.01.GG.2904.BMA.006.051.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(223, '054.01.GG.2904.BMA.006.051.A.521213.A.00001', '- Honor Mengajar Petugas', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(224, '054.01.GG.2904.BMA.006.051.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(225, '054.01.GG.2904.BMA.006.051.A.524113.A.00001', '- Transport Peserta Pelatihan Petugas', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(226, '054.01.GG.2904.BMA.006.052', 'PENGUMPULAN DATA', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(227, '054.01.GG.2904.BMA.006.052.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(228, '054.01.GG.2904.BMA.006.052.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(229, '054.01.GG.2904.BMA.006.052.A.521213.A.00001', '- Honor Petugas Pendataan vimk24 triwulanan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(230, '054.01.GG.2904.BMA.006.053', 'PENGOLAHAN DAN ANALISIS', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(231, '054.01.GG.2904.BMA.006.053.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(232, '054.01.GG.2904.BMA.006.053.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(233, '054.01.GG.2904.BMA.006.053.A.521213.A.00001', '- Honor Petugas Entri VIMK Tahunan 2024', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(234, '054.01.GG.2904.BMA.006.053.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(235, '054.01.GG.2904.BMA.006.053.A.524111.A.00001', '- Konsultasi Ke BPS Provinsi', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(236, '054.01.GG.2904.BMA.006.053.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(237, '054.01.GG.2904.BMA.006.053.A.524113.A.00001', '- pengawasan pengolahan dan analisis imk tahunan dari kabupaten ke kecamatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(238, '054.01.GG.2905', 'Penyediaan dan Pengembangan Statistik Kependudukan dan Ketenagakerjaan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(239, '054.01.GG.2905.BMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(240, '054.01.GG.2905.BMA.004', 'PUBLIKASI/LAPORAN SAKERNAS', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(241, '054.01.GG.2905.BMA.004.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(242, '054.01.GG.2905.BMA.004.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(243, '054.01.GG.2905.BMA.004.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(244, '054.01.GG.2905.BMA.004.005.A.521213.A.00001', '- Honor Pemeriksaan Pemutakhiran Sakernas Agustus', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(245, '054.01.GG.2905.BMA.004.005.A.521213.A.00002', '- Honor Pemeriksaan Pendataan Sakernas Agustus', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(246, '054.01.GG.2905.BMA.004.005.A.521213.A.00003', '- honor petugas pendataan lapangan updating/listing BS (sakernas februari)', 1, '2024-11-10 19:14:51', '2024-11-10 19:17:51'),
(247, '054.01.GG.2905.BMA.004.005.A.521213.A.00004', '- honor petugas pendataan lapangan (sakernas februari)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(248, '054.01.GG.2905.BMA.004.005.A.521213.A.00005', '- honor petugas pendataan lapangan updating listing BS (sakernas agustus)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(249, '054.01.GG.2905.BMA.004.005.A.521213.A.00006', '- honor petugas pendataan lapangan (sakernas agustus)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(250, '054.01.GG.2905.BMA.004.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(251, '054.01.GG.2905.BMA.004.005.A.524113.A.00001', '- transport lokal petugas pemeriksaan lapangan (sakernas agustus)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(252, '054.01.GG.2905.BMA.004.051', 'PERSIAPAN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(253, '054.01.GG.2905.BMA.004.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(254, '054.01.GG.2905.BMA.004.051.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(255, '054.01.GG.2905.BMA.004.051.A.521211.A.00001', '- perlengkapan petugas pelatihan sakernas februari', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(256, '054.01.GG.2905.BMA.004.051.A.521211.A.00002', '- perlengkapan petugas pelatihan sakernas agustus', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(257, '054.01.GG.2905.BMA.004.051.A.521211.A.00003', '- Biaya pulsa pelatihan sakernas februari', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(258, '054.01.GG.2905.BMA.004.051.A.521211.A.00004', '- Spanduk Pelatihan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(259, '054.01.GG.2905.BMA.004.051.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(260, '054.01.GG.2905.BMA.004.051.A.521213.A.00001', '- honor pengajar pelatihan petugas sakernas februari', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(261, '054.01.GG.2905.BMA.004.051.A.521213.A.00002', '- honor pengajar pelatihan petugas sakernas agustus', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(262, '054.01.GG.2905.BMA.004.051.A.524114.A', 'Belanja Perjalanan Dinas Paket Meeting Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(263, '054.01.GG.2905.BMA.004.051.A.524114.A.00001', '- pelatihan petugas sakernas februari', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(264, '054.01.GG.2905.BMA.004.051.A.524114.A.00002', '- perjalanan pelatihan petugas sakernas februari', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(265, '054.01.GG.2905.BMA.004.051.A.524114.A.00003', '- pelatihan petugas sakernas agustus', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(266, '054.01.GG.2905.BMA.004.051.A.524114.A.00004', '- perjalanan pelatihan petugas sakernas agustus', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(267, '054.01.GG.2905.BMA.004.054', 'DISEMINASI DAN EVALUASI', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(268, '054.01.GG.2905.BMA.004.054.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(269, '054.01.GG.2905.BMA.004.054.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(270, '054.01.GG.2905.BMA.004.054.A.524111.A.00001', '- Konsultasi kab/kot ke provinsi', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(271, '054.01.GG.2906', 'Penyediaan dan Pengembangan Statistik Kesejahteraan Rakyat', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(272, '054.01.GG.2906.BMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(273, '054.01.GG.2906.BMA.006', 'PUBLIKASI/LAPORAN SUSENAS', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(274, '054.01.GG.2906.BMA.006.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(275, '054.01.GG.2906.BMA.006.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(276, '054.01.GG.2906.BMA.006.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(277, '054.01.GG.2906.BMA.006.005.A.521213.A.00001', '- honor petugas pendataan lapangan updating listing (susenas msbp 2024)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(278, '054.01.GG.2906.BMA.006.005.A.521213.A.00002', '- honor petugas pengolahan updating listing (susenas msbp 2024)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(279, '054.01.GG.2906.BMA.006.005.A.521213.A.00003', '- honor petugas pendataan lapangan (susenas msbp 2024)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(280, '054.01.GG.2906.BMA.006.005.A.521213.A.00004', '- honor petugas pengolahan (susenas msbp 2024)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(281, '054.01.GG.2906.BMA.006.005.A.521213.A.00005', '- honor petugas pendataan lapangan updating listing (susenas maret 2024)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(282, '054.01.GG.2906.BMA.006.005.A.521213.A.00006', '- honor petugas pengolahan updating listing (susenas maret 2024)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(283, '054.01.GG.2906.BMA.006.005.A.521213.A.00007', '- honor petugas pendataan lapangan (susenas maret 2024)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(284, '054.01.GG.2906.BMA.006.005.A.521213.A.00008', '- honor petugas pengolahan (susenas maret 2024)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(285, '054.01.GG.2906.BMA.006.005.A.521213.A.00009', '- honor petugas pendataan lapangan (seruti triwulan 1 dan 3)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(286, '054.01.GG.2906.BMA.006.005.A.521213.A.00010', '- honor petugas pendataan lapangan (seruti triwulan 2 dan 4)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(287, '054.01.GG.2906.BMA.006.005.A.521213.A.00011', '- honor petugas pengolahan (seruti triwulan 1 dan 3)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(288, '054.01.GG.2906.BMA.006.005.A.521213.A.00012', '- honor petugas pengolahan (seruti triwulan 2 dan 4)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(289, '054.01.GG.2906.BMA.006.005.A.521213.A.00013', '- honor petugas pendataan lapangan (seruti triwulan 2)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(290, '054.01.GG.2906.BMA.006.005.A.521213.A.00014', '- honor petugas pengolahan (seruti triwulan 2)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(291, '054.01.GG.2906.BMA.006.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(292, '054.01.GG.2906.BMA.006.005.A.524113.A.00001', '- transport lokal petugas pemeriksaan lapangan updating listing (susenas msbp 2024 organik)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(293, '054.01.GG.2906.BMA.006.005.A.524113.A.00002', '- transport lokal petugas pemeriksaan lapangan (susenas msbp 2024 organik)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(294, '054.01.GG.2906.BMA.006.005.A.524113.A.00003', '- transport lokal petugas pengolahan (susenas msbp 2024 organik)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(295, '054.01.GG.2906.BMA.006.005.A.524113.A.00004', '- transport lokal petugas pendataan susenas msbp 2024', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(296, '054.01.GG.2906.BMA.006.005.A.524113.A.00005', '- transport lokal pencacahan rentang harga', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(297, '054.01.GG.2906.BMA.006.005.A.524113.A.00006', '- transport lokal petugas pemeriksaan lapangan (susenas maret 2024 organik)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(298, '054.01.GG.2906.BMA.006.005.A.524113.A.00007', '- transport lokal petugas pemeriksaan lapangan (seruti triwulan 1 dan 3)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(299, '054.01.GG.2906.BMA.006.005.A.524113.A.00008', '- transport lokal petugas pemeriksaan lapangan (seruti triwulan 2 dan 4)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(300, '054.01.GG.2906.BMA.006.005.A.524113.A.00009', '- transport lokal petugas pengolahan (seruti triwulan 1 dan 3)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(301, '054.01.GG.2906.BMA.006.005.A.524113.A.00010', '- transport lokal petugas pengolahan (seruti triwulan 2 dan 4)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(302, '054.01.GG.2906.BMA.006.051', 'PERSIAPAN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(303, '054.01.GG.2906.BMA.006.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(304, '054.01.GG.2906.BMA.006.051.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(305, '054.01.GG.2906.BMA.006.051.A.521211.A.00001', '- perlengkapan pelatihan petugas susenas msbp 2024 di kabupaten/kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(306, '054.01.GG.2906.BMA.006.051.A.521211.A.00002', '- perlengkapan petugas pelatihan petugas susenas maret 2024', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(307, '054.01.GG.2906.BMA.006.051.A.521211.A.00003', '- biaya pulsa pelatihan petugas susenas maret 2024', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(308, '054.01.GG.2906.BMA.006.051.A.521211.A.00004', '- konsumsi rapat persiapan seruti triwulan II', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(309, '054.01.GG.2906.BMA.006.051.A.521211.A.00005', '- Spanduk Pelatihan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(310, '054.01.GG.2906.BMA.006.051.A.521211.A.00006', '- konsumsi rapat persiapan seruti triwulan 4', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(311, '054.01.GG.2906.BMA.006.051.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(312, '054.01.GG.2906.BMA.006.051.A.521213.A.00001', '- honor pengajar pelatihan petugas susenas msbp 2024 di kabupaten/kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(313, '054.01.GG.2906.BMA.006.051.A.521213.A.00002', '- honor pengajar pelatihan petugas susenas maret 2024 honor pengajar petugas', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(314, '054.01.GG.2906.BMA.006.051.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(315, '054.01.GG.2906.BMA.006.051.A.524113.A.00001', '- transport lokal responden role playing pelatihan petugas susenas msbp 2024 di kabupaten/kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(316, '054.01.GG.2906.BMA.006.051.A.524113.A.00002', '- transport lokal rapat persiapan seruti triwulan II', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(317, '054.01.GG.2906.BMA.006.051.A.524113.A.00003', '- Transport lokal rapat persiapan seruti triwulan 4', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(318, '054.01.GG.2906.BMA.006.051.A.524114.A', 'Belanja Perjalanan Dinas Paket Meeting Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(319, '054.01.GG.2906.BMA.006.051.A.524114.A.00001', '- pelatihan petugas susenas msbp 2024 di kabupaten/kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(320, '054.01.GG.2906.BMA.006.051.A.524114.A.00002', '- perjalanan petugas susenas msbp 2024 di kabupaten/kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(321, '054.01.GG.2906.BMA.006.051.A.524114.A.00003', '- pelatihan petugas susenas maret 2024', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(322, '054.01.GG.2906.BMA.006.051.A.524114.A.00004', '- perjalanan petugas susenas maret 2024', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(323, '054.01.GG.2906.BMA.006.052', 'PENGUMPULAN DATA', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(324, '054.01.GG.2906.BMA.006.052.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(325, '054.01.GG.2906.BMA.006.052.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(326, '054.01.GG.2906.BMA.006.052.A.524113.A.00001', '- pengawasan lapangan dari bps kabupaten/kota ke kecamatan susenas msbp 2024', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(327, '054.01.GG.2906.BMA.006.052.A.524113.A.00002', '- pengawasan kab/kota ke kecamatan dalam rangka seruti', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(328, '054.01.GG.2906.BMA.006.054', 'DISEMINASI DAN EVALUASI', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(329, '054.01.GG.2906.BMA.006.054.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(330, '054.01.GG.2906.BMA.006.054.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(331, '054.01.GG.2906.BMA.006.054.A.524111.A.00001', '- Perjalanan Dinas ke BPS Provinsi', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(332, '054.01.GG.2907', 'Penyediaan dan Pengembangan Statistik Ketahanan Sosial', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(333, '054.01.GG.2907.BMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(334, '054.01.GG.2907.BMA.006', 'PUBLIKASI/LAPORAN STATISTIK KETAHANAN SOSIAL', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(335, '054.01.GG.2907.BMA.006.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(336, '054.01.GG.2907.BMA.006.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(337, '054.01.GG.2907.BMA.006.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(338, '054.01.GG.2907.BMA.006.005.A.524113.A.00001', '- transport lokal petugas pendataan lapangan bps kabupaten/kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(339, '054.01.GG.2907.BMA.006.005.A.524113.A.00002', '- transport lokal petugas pemeriksaan lapangan (SPAK)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(340, '054.01.GG.2907.BMA.006.054', 'DISEMINASI DAN EVALUASI', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(341, '054.01.GG.2907.BMA.006.054.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(342, '054.01.GG.2907.BMA.006.054.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(343, '054.01.GG.2907.BMA.006.054.A.524111.A.00001', '- Perjalanan Dinas ke BPS Provinsi', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(344, '054.01.GG.2907.BMA.008', 'PUBLIKASI/LAPORAN PENDATAAN PODES', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(345, '054.01.GG.2907.BMA.008.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(346, '054.01.GG.2907.BMA.008.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(347, '054.01.GG.2907.BMA.008.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(348, '054.01.GG.2907.BMA.008.005.A.521213.A.00001', '- honor petugas pendataan lapangan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(349, '054.01.GG.2907.BMA.008.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(350, '054.01.GG.2907.BMA.008.005.A.524113.A.00001', '- transport lokal petugas pendataan lapangan desa', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(351, '054.01.GG.2907.BMA.008.005.A.524113.A.00002', '- transport lokal pengawasan podes desa/kelurahan/pendataan lapangan podes kecamatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(352, '054.01.GG.2907.BMA.008.005.A.524113.A.00003', '- transport lokal daerah sulit pendataan podes desa/kelurahan/kecamatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(353, '054.01.GG.2907.BMA.008.005.A.524113.A.00004', '- Translok Pembinaan Desa Cantik', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(354, '054.01.GG.2907.BMA.008.005.A.524113.A.00005', '- Translok Pengawasan Desa Cantik', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:51'),
(355, '054.01.GG.2907.BMA.008.051', 'PERSIAPAN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(356, '054.01.GG.2907.BMA.008.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(357, '054.01.GG.2907.BMA.008.051.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(358, '054.01.GG.2907.BMA.008.051.A.521211.A.00001', '- perlengkapan fullboard pelatihan petugas', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(359, '054.01.GG.2907.BMA.008.051.A.521211.A.00002', '- biaya pulsa pelatihan petugas', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(360, '054.01.GG.2907.BMA.008.051.A.521211.A.00003', '- Konsumsi Pertemuan Desa Cantik', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52');
INSERT INTO `kamus_anggarans` (`id`, `mak`, `detail`, `dipa_id`, `created_at`, `updated_at`) VALUES
(361, '054.01.GG.2907.BMA.008.051.A.521211.A.00004', '- Spanduk Pelatihan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(362, '054.01.GG.2907.BMA.008.051.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(363, '054.01.GG.2907.BMA.008.051.A.521213.A.00001', '- honor pengajar pelatihan petugas', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(364, '054.01.GG.2907.BMA.008.051.A.524114.A', 'Belanja Perjalanan Dinas Paket Meeting Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(365, '054.01.GG.2907.BMA.008.051.A.524114.A.00001', '- fullday pelatihan petugas', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(366, '054.01.GG.2907.BMA.008.051.A.524114.A.00002', '- perjalanan fullday pelatihan petugas', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(367, '054.01.GG.2907.BMA.008.054', 'DISEMINASI DAN EVALUASI', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(368, '054.01.GG.2907.BMA.008.054.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(369, '054.01.GG.2907.BMA.008.054.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(370, '054.01.GG.2907.BMA.008.054.A.524111.A.00001', '- Perjalanan Dalam Rangka Statistik Sosial', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(371, '054.01.GG.2908', 'Penyediaan dan Pengembangan Statistik Keuangan, Teknologi Informasi, dan Pariwisata', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(372, '054.01.GG.2908.BMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(373, '054.01.GG.2908.BMA.004', 'PUBLIKASI/LAPORAN STATISTIK KEUANGAN, TEKNOLOGI INFORMASI, DAN PARIWISATA', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(374, '054.01.GG.2908.BMA.004.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(375, '054.01.GG.2908.BMA.004.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(376, '054.01.GG.2908.BMA.004.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(377, '054.01.GG.2908.BMA.004.005.A.521213.A.00001', '- honor petugas pendataan lapangan survei karakteristik usaha', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(378, '054.01.GG.2908.BMA.004.005.A.521213.A.00002', '- honor petugas pendataan lapangan slk koperasi simpan pinjam', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(379, '054.01.GG.2908.BMA.004.005.A.521213.A.00003', '- honor petugas pendataan lapangan vdtw', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(380, '054.01.GG.2908.BMA.004.005.A.521213.A.00004', '- honor petugas pendataan lapangan vhts', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(381, '054.01.GG.2908.BMA.004.005.A.521213.A.00005', '- honor petugas pendataan lapangan vhtl', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(382, '054.01.GG.2908.BMA.004.005.A.521213.A.00006', '- honor petugas pendataan lapangan keuangan desa', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(383, '054.01.GG.2908.BMA.004.005.A.521213.A.00007', '- honor petugas pendataan lapangan vrest umk', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(384, '054.01.GG.2908.BMA.004.005.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(385, '054.01.GG.2908.BMA.004.005.A.524111.A.00001', '- Perjalanan DInas ke BPS Provinsi', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(386, '054.01.GG.2908.BMA.004.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(387, '054.01.GG.2908.BMA.004.005.A.524113.A.00001', '- transport lokal petugas pemeriksaan lapangan vhts', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(388, '054.01.GG.2908.BMA.004.005.A.524113.A.00002', '- transport lokal petugas pendataan vhtl', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(389, '054.01.GG.2908.BMA.004.005.A.524113.A.00003', '- transport lokal petugas pendataan slk koperasi simpan pinjam', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(390, '054.01.GG.2908.BMA.004.051', 'PERSIAPAN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(391, '054.01.GG.2908.BMA.004.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(392, '054.01.GG.2908.BMA.004.051.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(393, '054.01.GG.2908.BMA.004.051.A.521211.A.00001', '- Paket data/pulsa pelatihan petugas survei karakteristik usaha', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(394, '054.01.GG.2908.BMA.004.051.A.521211.A.00002', '- Biaya Pulsa/paket data pelatihan petugas survei bidang jasa pariwisata', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(395, '054.01.GG.2908.QMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(396, '054.01.GG.2908.QMA.009', 'PUBLIKASI/ LAPORAN STATISTIK E-COMMERCE', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(397, '054.01.GG.2908.QMA.009.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(398, '054.01.GG.2908.QMA.009.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(399, '054.01.GG.2908.QMA.009.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(400, '054.01.GG.2908.QMA.009.005.A.521213.A.00001', '- honor petugas listing survei e-commerce', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(401, '054.01.GG.2908.QMA.009.005.A.521213.A.00002', '- honor petugas pendataan survei e-commerce', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(402, '054.01.GG.2908.QMA.009.005.A.521811.A', 'Belanja Barang Persediaan Barang Konsumsi', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(403, '054.01.GG.2908.QMA.009.005.A.521811.A.00001', '- ATK dan Computer Supplies', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(404, '054.01.GG.2908.QMA.009.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(405, '054.01.GG.2908.QMA.009.005.A.524113.A.00001', '- transport lokal pemeriksaan hasil listing survei e-commerce', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(406, '054.01.GG.2908.QMA.009.005.A.524113.A.00002', '- transport lokal pemeriksaan hasil survei e-commerce', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(407, '054.01.GG.2909', 'Penyediaan dan Pengembangan Statistik Peternakan, Perikanan, dan Kehutanan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(408, '054.01.GG.2909.BMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(409, '054.01.GG.2909.BMA.005', 'PUBLIKASI/LAPORAN STATISTIK PETERNAKAN, PERIKANAN, DAN KEHUTANAN YANG TERBIT TEPAT WAKTU', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(410, '054.01.GG.2909.BMA.005.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(411, '054.01.GG.2909.BMA.005.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(412, '054.01.GG.2909.BMA.005.005.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(413, '054.01.GG.2909.BMA.005.005.A.521211.A.00001', '- Pembelian ATK', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(414, '054.01.GG.2910', 'Penyediaan dan Pengembangan Statistik Tanaman Pangan, Hortikultura, dan Perkebunan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(415, '054.01.GG.2910.BMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(416, '054.01.GG.2910.BMA.008', 'PUBLIKASI/LAPORAN STATISTIK HORTIKULTURA DAN PERKEBUNAN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(417, '054.01.GG.2910.BMA.008.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(418, '054.01.GG.2910.BMA.008.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(419, '054.01.GG.2910.BMA.008.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(420, '054.01.GG.2910.BMA.008.005.A.521213.A.00001', '- honor petugas pendataan lapangan listing komstrat karet', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(421, '054.01.GG.2910.BMA.008.005.A.521213.A.00002', '- honor petugas pendataan lapangan komstrat karet', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(422, '054.01.GG.2910.BMA.008.005.A.521213.A.00003', '- honor petugas pendataan lapangan updating dpp dutl', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(423, '054.01.GG.2910.BMA.008.005.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(424, '054.01.GG.2910.BMA.008.005.A.524111.A.00001', '- Konsultasi Ke BPS Provinsi', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(425, '054.01.GG.2910.BMA.008.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(426, '054.01.GG.2910.BMA.008.005.A.524113.A.00001', '- transport lokal petugas pemeriksaan lapangan listing komstrat karet', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(427, '054.01.GG.2910.BMA.008.005.A.524113.A.00002', '- transport lokal petugas pemeriksaan lapangan komstrat karet', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(428, '054.01.GG.2910.BMA.008.051', 'PERSIAPAN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(429, '054.01.GG.2910.BMA.008.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(430, '054.01.GG.2910.BMA.008.051.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(431, '054.01.GG.2910.BMA.008.051.A.521211.A.00001', '- perlengkapan fullboard pelatihan petugas komstrat di kab kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(432, '054.01.GG.2910.BMA.008.051.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(433, '054.01.GG.2910.BMA.008.051.A.521213.A.00001', '- honor pengajar pelatihan petugas komstrat di kab kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(434, '054.01.GG.2910.BMA.008.051.A.524114.A', 'Belanja Perjalanan Dinas Paket Meeting Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(435, '054.01.GG.2910.BMA.008.051.A.524114.A.00001', '- fullboard pelatihan petugas komstrat di kab kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(436, '054.01.GG.2910.BMA.008.051.A.524114.A.00002', '- perjalanan fullboard pelatihan petugas komstrat di kab kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(437, '054.01.GG.2910.BMA.008.052', 'PENGUMPULAN DATA', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(438, '054.01.GG.2910.BMA.008.052.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(439, '054.01.GG.2910.BMA.008.052.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(440, '054.01.GG.2910.BMA.008.052.A.524113.A.00001', '- pengawasan statistik hortikultura dan perkebunan dari kabupaten ke kecamatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(441, '054.01.GG.2910.QMA', 'Data dan Informasi Publik', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(442, '054.01.GG.2910.QMA.006', 'PUBLIKASI/LAPORAN SENSUS PERTANIAN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(443, '054.01.GG.2910.QMA.006.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(444, '054.01.GG.2910.QMA.006.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(445, '054.01.GG.2910.QMA.006.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(446, '054.01.GG.2910.QMA.006.005.A.521213.A.00001', '- honor petugas pendataan lapangan updating listing (survei proling)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(447, '054.01.GG.2910.QMA.006.005.A.521213.A.00002', '- honor petugas pengolahan updating (survei proling)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(448, '054.01.GG.2910.QMA.006.005.A.521213.A.00003', '- honor petugas lapangan sensus papi (survei proling)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(449, '054.01.GG.2910.QMA.006.005.A.521213.A.00004', '- honor pemeriksa lapangan sensus papi (survei survei proling)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(450, '054.01.GG.2910.QMA.006.005.A.521213.A.00005', '- honor petugas pengolahan sensus (survei survei proling)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(451, '054.01.GG.2910.QMA.006.005.A.521213.A.00006', '- honor Petugas Lapangan Sensus PAPI (survei ekonomi pertanian)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(452, '054.01.GG.2910.QMA.006.005.A.521213.A.00007', '- honor Pemeriksaan Lapangan Sensus PAPI (survei ekonomi pertanian)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(453, '054.01.GG.2910.QMA.006.005.A.521213.A.00008', '- honor pengolahan lapangan sensus (survei ekonomi pertanian)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(454, '054.01.GG.2910.QMA.006.005.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(455, '054.01.GG.2910.QMA.006.005.A.524111.A.00001', '- Konsultasi Kab/kota ke Prov', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(456, '054.01.GG.2910.QMA.006.005.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(457, '054.01.GG.2910.QMA.006.005.A.524113.A.00001', '- transport lokal honor pemeriksaan daftar listing/pemutahiran sls (survei proling)', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(458, '054.01.GG.2910.QMA.006.005.A.524113.A.00002', '- Transport lokal pencacahan UTL dan perusahaan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(459, '054.01.GG.2910.QMA.006.005.A.524113.A.00003', '- Transport lokal pencacahan UTL dan perusahaan SEP', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(460, '054.01.GG.2910.QMA.006.716', 'SURVEI EKONOMI PERTANIAN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(461, '054.01.GG.2910.QMA.006.716.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(462, '054.01.GG.2910.QMA.006.716.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(463, '054.01.GG.2910.QMA.006.716.A.521213.A.00001', '- honor pengajar petugas papi survei ekonomi pertanian', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(464, '054.01.GG.2910.QMA.006.716.A.521219.A', 'Belanja Barang Non Operasional Lainnya', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(465, '054.01.GG.2910.QMA.006.716.A.521219.A.00001', '- Asuransi Petugas', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(466, '054.01.GG.2910.QMA.006.716.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(467, '054.01.GG.2910.QMA.006.716.A.524113.A.00001', '- transport lokal responden role playing pelatihan petugas', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(468, '054.01.GG.2910.QMA.006.716.A.524114.A', 'Belanja Perjalanan Dinas Paket Meeting Dalam Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(469, '054.01.GG.2910.QMA.006.716.A.524114.A.00001', '- fullboard pelatihan petugas papi kab kota survei ekonomi pertanian', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(470, '054.01.GG.2910.QMA.006.716.A.524114.A.00002', '- Perjalanan pelatihan petugas papi kab kota survei ekonomi pertanian', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(471, '054.01.GG.2910.QMA.006.716.A.524119.A', 'Belanja Perjalanan Dinas Paket Meeting Luar Kota', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(472, '054.01.GG.2910.QMA.006.716.A.524119.A.00001', '- Perjalanan Peserta Rapat Koordinasi SEP 2024', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(473, '054.01.GG.2910.QMA.006.717', 'PENGOLAHAN SURVEI EKONOMI PERTANIAN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(474, '054.01.GG.2910.QMA.006.717.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(475, '054.01.GG.2910.QMA.006.717.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(476, '054.01.GG.2910.QMA.006.717.A.521211.A.00001', '- Konsumsi rapat dalam rangka pelatihan pengolahan Survei Ekonomi Pertanian', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(477, '054.01.GG.2910.QMA.006.717.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:52', '2024-11-10 19:17:52'),
(478, '054.01.GG.2910.QMA.006.717.A.521213.A.00001', '- Honor pengajar pelatihan petugas pengolahan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(479, '054.01.GG.2910.QMA.006.717.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(480, '054.01.GG.2910.QMA.006.717.A.524113.A.00001', '- Transport petugas dalam rangka pelatihan pengolahan Survei Ekonomi Pertanian', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(481, '054.01.GG.2910.QMA.006.724', 'SURVEI PRODUKSI DAN LINGKUNGAN PERTANIAN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(482, '054.01.GG.2910.QMA.006.724.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(483, '054.01.GG.2910.QMA.006.724.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(484, '054.01.GG.2910.QMA.006.724.A.521213.A.00001', '- honor pengajar petugas papi survei produksi dan lingkungan pertanian', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(485, '054.01.GG.2910.QMA.006.724.A.521219.A', 'Belanja Barang Non Operasional Lainnya', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(486, '054.01.GG.2910.QMA.006.724.A.521219.A.00001', '- Asuransi Petugas', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(487, '054.01.GG.2910.QMA.006.724.A.521811.A', 'Belanja Barang Persediaan Barang Konsumsi', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(488, '054.01.GG.2910.QMA.006.724.A.521811.A.00001', '- penggandaan laporan kab kota hasil survei produksi dan lingkungan pertanian', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(489, '054.01.GG.2910.QMA.006.724.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(490, '054.01.GG.2910.QMA.006.724.A.524113.A.00001', '- pengawasan kab/kota ke kecamatan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(491, '054.01.GG.2910.QMA.006.724.A.524113.A.00002', '- transport daerah sulit', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(492, '054.01.GG.2910.QMA.006.724.A.524113.A.00003', '- transport lokal responden role playing pelatihan petugas', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(493, '054.01.GG.2910.QMA.006.724.A.524114.A', 'Belanja Perjalanan Dinas Paket Meeting Dalam Kota', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(494, '054.01.GG.2910.QMA.006.724.A.524114.A.00001', '- fullboard pelatihan petugas papi di kab/kota survei proling', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(495, '054.01.GG.2910.QMA.006.724.A.524114.A.00002', '- perjalanan fullboard pelatihan petugas papi di kab/kota survei proling', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(496, '054.01.GG.2910.QMA.006.725', 'PENGOLAHAN SURVEI PRODUKSI DAN LINGKUNGAN PERTANIAN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(497, '054.01.GG.2910.QMA.006.725.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(498, '054.01.GG.2910.QMA.006.725.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(499, '054.01.GG.2910.QMA.006.725.A.521211.A.00001', '- konsumsi rapat dalam rangka pelatihan pengolahan survei proling', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(500, '054.01.GG.2910.QMA.006.725.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(501, '054.01.GG.2910.QMA.006.725.A.521213.A.00001', '- honor pengajar petugas pengolahan survei proling', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(502, '054.01.GG.2910.QMA.006.725.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(503, '054.01.GG.2910.QMA.006.725.A.524113.A.00001', '- transport lokal pelatihan petugas pengolahan survei proling', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(504, '054.01.GG.2910.QMA.007', 'PUBLIKASI/ LAPORAN STATISTIK TANAMAN PANGAN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(505, '054.01.GG.2910.QMA.007.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(506, '054.01.GG.2910.QMA.007.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(507, '054.01.GG.2910.QMA.007.005.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(508, '054.01.GG.2910.QMA.007.005.A.521211.A.00001', '- perlengkapan petugas ubinan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(509, '054.01.GG.2910.QMA.007.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(510, '054.01.GG.2910.QMA.007.005.A.521213.A.00001', '- honor petugas pendataan lapangan updating ubinan palawija', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(511, '054.01.GG.2910.QMA.007.005.A.521213.A.00002', '- honor petugas pendataan lapangan ubinan padi dan ubinan palawija', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(512, '054.01.GG.2910.QMA.007.005.A.521219.A', 'Belanja Barang Non Operasional Lainnya', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(513, '054.01.GG.2910.QMA.007.005.A.521219.A.00001', '- penggantian biaya responden', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(514, '054.01.GG.2910.QMA.007.052', 'PENGUMPULAN DATA', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(515, '054.01.GG.2910.QMA.007.052.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(516, '054.01.GG.2910.QMA.007.052.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(517, '054.01.GG.2910.QMA.007.052.A.524111.A.00001', '- Konsultasi Kab/kota ke Prov', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(518, '054.01.GG.2910.QMA.010', 'PUBLIKASI/ LAPORAN STATISTIK TANAMAN PANGAN TERINTEGRASI DENGAN KERANGKA SAMPEL AREA', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(519, '054.01.GG.2910.QMA.010.005', 'Dukungan Penyelenggaraan Tugas dan Fungsi Unit', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(520, '054.01.GG.2910.QMA.010.005.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(521, '054.01.GG.2910.QMA.010.005.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(522, '054.01.GG.2910.QMA.010.005.A.521213.A.00001', '- honor petugas pendataan lapangan updating ksa jagung', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(523, '054.01.GG.2910.QMA.010.005.A.521213.A.00002', '- honor petugas pendataan lapangan updating ksa padi', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(524, '054.01.GG.2910.QMA.010.005.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(525, '054.01.GG.2910.QMA.010.005.A.524111.A.00001', '- Konsultasi ke BPS Prov', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(526, '054.01.GG.2910.QMA.010.051', 'PERSIAPAN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(527, '054.01.GG.2910.QMA.010.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(528, '054.01.GG.2910.QMA.010.051.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(529, '054.01.GG.2910.QMA.010.051.A.521211.A.00001', '- perlengkapan pelatihan petugas ksa padi dan jagung', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(530, '054.01.GG.2910.QMA.010.051.A.521213.A', 'Belanja Honor Output Kegiatan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(531, '054.01.GG.2910.QMA.010.051.A.521213.A.00001', '- honor pengajar petugas pelatihan ksa padi dan jagung', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(532, '054.01.GG.2910.QMA.010.051.A.524113.A', 'Belanja Perjalanan Dinas Dalam Kota', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(533, '054.01.GG.2910.QMA.010.051.A.524113.A.00001', '- Transport pelatihan petugas ksa padi dan jagung', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(534, '054.01.WA', 'Program Dukungan Manajemen', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(535, '054.01.WA.2886', 'Dukungan Manajemen dan Pelaksanaan Tugas Teknis Lainnya BPS Provinsi', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(536, '054.01.WA.2886.EBA', 'Layanan Dukungan Manajemen Internal', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(537, '054.01.WA.2886.EBA.956', 'Layanan BMN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(538, '054.01.WA.2886.EBA.956.051', 'Tanpa Komponen', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(539, '054.01.WA.2886.EBA.956.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(540, '054.01.WA.2886.EBA.956.051.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(541, '054.01.WA.2886.EBA.956.051.A.524111.A.00001', '- Perjalanan dalam rangka administrasi BMN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(542, '054.01.WA.2886.EBA.962', 'Layanan Umum', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(543, '054.01.WA.2886.EBA.962.051', 'Tanpa Komponen', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(544, '054.01.WA.2886.EBA.962.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(545, '054.01.WA.2886.EBA.962.051.A.521211.A', 'Belanja Bahan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(546, '054.01.WA.2886.EBA.962.051.A.521211.A.00001', '- Konsumsi Rapat', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(547, '054.01.WA.2886.EBA.994', 'Layanan Perkantoran', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(548, '054.01.WA.2886.EBA.994.001', 'Gaji dan Tunjangan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(549, '054.01.WA.2886.EBA.994.001.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(550, '054.01.WA.2886.EBA.994.001.A.511111.A', 'Belanja Gaji Pokok PNS', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(551, '054.01.WA.2886.EBA.994.001.A.511111.A.00001', '- belanja gaji pokok pns', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(552, '054.01.WA.2886.EBA.994.001.A.511111.A.00002', '- belanja gaji pokok pns (gaji ke 13)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(553, '054.01.WA.2886.EBA.994.001.A.511111.A.00003', '- belanja gaji pokok pns (gaji ke 14)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:52'),
(554, '054.01.WA.2886.EBA.994.001.A.511119.A', 'Belanja Pembulatan Gaji PNS', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(555, '054.01.WA.2886.EBA.994.001.A.511119.A.00001', '- belanja pembulatan gaji pns', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(556, '054.01.WA.2886.EBA.994.001.A.511119.A.00002', '- belanja pembulatan gaji pns (gaji ke 13)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(557, '054.01.WA.2886.EBA.994.001.A.511119.A.00003', '- belanja pembulatan gaji pns (gaji ke 14)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(558, '054.01.WA.2886.EBA.994.001.A.511121.A', 'Belanja Tunj. Suami/Istri PNS', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(559, '054.01.WA.2886.EBA.994.001.A.511121.A.00001', '- tunj.suami/istri pns', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(560, '054.01.WA.2886.EBA.994.001.A.511121.A.00002', '- tunj.suami/istri pns (gaji ke 13)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(561, '054.01.WA.2886.EBA.994.001.A.511121.A.00003', '- tunj.suami/istri pns (gaji ke 14)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(562, '054.01.WA.2886.EBA.994.001.A.511122.A', 'Belanja Tunj. Anak PNS', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(563, '054.01.WA.2886.EBA.994.001.A.511122.A.00001', '- tunj. anak pns', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(564, '054.01.WA.2886.EBA.994.001.A.511122.A.00002', '- tunj. anak pns (gaji ke 13)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(565, '054.01.WA.2886.EBA.994.001.A.511122.A.00003', '- tunj. anak pns (gaji ke 14)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(566, '054.01.WA.2886.EBA.994.001.A.511123.A', 'Belanja Tunj. Struktural PNS', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(567, '054.01.WA.2886.EBA.994.001.A.511123.A.00001', '- tunj. struktural pns', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(568, '054.01.WA.2886.EBA.994.001.A.511123.A.00002', '- tunj. struktural pns (gaji ke 13)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(569, '054.01.WA.2886.EBA.994.001.A.511123.A.00003', '- tunj. struktural pns (gaji ke 14)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(570, '054.01.WA.2886.EBA.994.001.A.511124.A', 'Belanja Tunj. Fungsional PNS', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(571, '054.01.WA.2886.EBA.994.001.A.511124.A.00001', '- tunj. fungsional pns', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(572, '054.01.WA.2886.EBA.994.001.A.511124.A.00002', '- tunj. fungsional pns (gaji ke 13)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(573, '054.01.WA.2886.EBA.994.001.A.511124.A.00003', '- tunj. fungsional pns (gaji ke 14)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(574, '054.01.WA.2886.EBA.994.001.A.511125.A', 'Belanja Tunj. PPh PNS', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(575, '054.01.WA.2886.EBA.994.001.A.511125.A.00001', '- tunj. pph pns', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(576, '054.01.WA.2886.EBA.994.001.A.511125.A.00002', '- tunj. pph pns (gaji ke 13)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(577, '054.01.WA.2886.EBA.994.001.A.511125.A.00003', '- tunj. pph pns (gaji ke 14)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(578, '054.01.WA.2886.EBA.994.001.A.511126.A', 'Belanja Tunj. Beras PNS', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(579, '054.01.WA.2886.EBA.994.001.A.511126.A.00001', '- tunj. beras pns', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(580, '054.01.WA.2886.EBA.994.001.A.511129.A', 'Belanja Uang Makan PNS', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(581, '054.01.WA.2886.EBA.994.001.A.511129.A.00001', '- uang makan pns', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(582, '054.01.WA.2886.EBA.994.001.A.511151.A', 'Belanja Tunjangan Umum PNS', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(583, '054.01.WA.2886.EBA.994.001.A.511151.A.00001', '- tunj. umum pns', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(584, '054.01.WA.2886.EBA.994.001.A.511151.A.00002', '- tunj. umum pns (gaji ke 13)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(585, '054.01.WA.2886.EBA.994.001.A.511151.A.00003', '- tunj. umum pns (gaji ke 14)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(586, '054.01.WA.2886.EBA.994.001.A.512211.A', 'Belanja Uang Lembur', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(587, '054.01.WA.2886.EBA.994.001.A.512211.A.00001', '- belanja uang lembur', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(588, '054.01.WA.2886.EBA.994.001.A.512411.A', 'Belanja Pegawai (Tunjangan Khusus/Kegiatan/Kinerja)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(589, '054.01.WA.2886.EBA.994.001.A.512411.A.00001', '- belanja pegawai (tunjangan khusus/kegiatan/kinerja)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(590, '054.01.WA.2886.EBA.994.002', 'Operasional dan Pemeliharaan Kantor', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(591, '054.01.WA.2886.EBA.994.002.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(592, '054.01.WA.2886.EBA.994.002.A.521111.A', 'Belanja Keperluan Perkantoran', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(593, '054.01.WA.2886.EBA.994.002.A.521111.A.00001', '- biaya pengurusan surat kendaraaan eselon iii', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(594, '054.01.WA.2886.EBA.994.002.A.521111.A.00002', '- biaya pengurusan surat kendaraan roda 2', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(595, '054.01.WA.2886.EBA.994.002.A.521111.A.00003', '- keperluan sehari-hari perkantoran', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(596, '054.01.WA.2886.EBA.994.002.A.521111.A.00004', '- pengiriman dokumen', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(597, '054.01.WA.2886.EBA.994.002.A.521115.A', 'Belanja Honor Operasional Satuan Kerja', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(598, '054.01.WA.2886.EBA.994.002.A.521115.A.00001', '- bendahara', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(599, '054.01.WA.2886.EBA.994.002.A.521115.A.00002', '- Kuasa Pengguna Anggaran', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(600, '054.01.WA.2886.EBA.994.002.A.521115.A.00003', '- Pejabat Pembuat Komitmen', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(601, '054.01.WA.2886.EBA.994.002.A.521115.A.00004', '- Pejabat Penandatanganan SPM', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(602, '054.01.WA.2886.EBA.994.002.A.521115.A.00005', '- Pejabat Pengadaan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(603, '054.01.WA.2886.EBA.994.002.A.521115.A.00006', '- Staf Pengelola Keuangan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(604, '054.01.WA.2886.EBA.994.002.A.521115.A.00007', '- pengurus/penyimpan bmn', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(605, '054.01.WA.2886.EBA.994.002.A.521119.A', 'Belanja Barang Operasional Lainnya', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(606, '054.01.WA.2886.EBA.994.002.A.521119.A.00001', '- Pakaian Seragam Pegawai', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(607, '054.01.WA.2886.EBA.994.002.A.521119.A.00002', '- Pengadaan Tanda pengenal (Badge) Pegawai', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(608, '054.01.WA.2886.EBA.994.002.A.521252.A', 'Belanja Peralatan dan Mesin - Ekstrakomptabel', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(609, '054.01.WA.2886.EBA.994.002.A.521252.A.00001', '- Belanja Pembelian Peralatan Kantor', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(610, '054.01.WA.2886.EBA.994.002.A.521811.A', 'Belanja Barang Persediaan Barang Konsumsi', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(611, '054.01.WA.2886.EBA.994.002.A.521811.A.00001', '- Alat Tulis Kantor (ATK)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(612, '054.01.WA.2886.EBA.994.002.A.521811.A.00002', '- Computer Supplies', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(613, '054.01.WA.2886.EBA.994.002.A.522111.A', 'Belanja Langganan Listrik', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(614, '054.01.WA.2886.EBA.994.002.A.522111.A.00001', '- biaya langganan listrik', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(615, '054.01.WA.2886.EBA.994.002.A.522112.A', 'Belanja Langganan Telepon', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(616, '054.01.WA.2886.EBA.994.002.A.522112.A.00001', '- biaya langganan telepon', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(617, '054.01.WA.2886.EBA.994.002.A.522113.A', 'Belanja Langganan Air', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(618, '054.01.WA.2886.EBA.994.002.A.522113.A.00001', '- Biaya langganan air', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(619, '054.01.WA.2886.EBA.994.002.A.522119.A', 'Belanja Langganan Daya dan Jasa Lainnya', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(620, '054.01.WA.2886.EBA.994.002.A.522119.A.00001', '- Koneksi Internet', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(621, '054.01.WA.2886.EBA.994.002.A.522191.A', 'Belanja Jasa Lainnya', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(622, '054.01.WA.2886.EBA.994.002.A.522191.A.00001', '- biaya jasa manajemen building', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(623, '054.01.WA.2886.EBA.994.002.A.523111.A', 'Belanja Pemeliharaan Gedung dan Bangunan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(624, '054.01.WA.2886.EBA.994.002.A.523111.A.00001', '- pemeliharaan halaman kantor', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(625, '054.01.WA.2886.EBA.994.002.A.523111.A.00002', '- pemeliharaan gedung kantor', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(626, '054.01.WA.2886.EBA.994.002.A.523112.A', 'Belanja Barang Persediaan Pemeliharaan Gedung dan Bangunan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(627, '054.01.WA.2886.EBA.994.002.A.523112.A.00001', '- Persediaan Pemeliharaan Gedung Kantor', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(628, '054.01.WA.2886.EBA.994.002.A.523121.A', 'Belanja Pemeliharaan Peralatan dan Mesin', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(629, '054.01.WA.2886.EBA.994.002.A.523121.A.00001', '- inventaris kantor', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(630, '054.01.WA.2886.EBA.994.002.A.523121.A.00002', '- pemeliharaan air conditioner/AC', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(631, '054.01.WA.2886.EBA.994.002.A.523121.A.00003', '- Pemeliharaan genset', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(632, '054.01.WA.2886.EBA.994.002.A.523121.A.00004', '- pemeliharaan kendaraan operasional eselon iii', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(633, '054.01.WA.2886.EBA.994.002.A.523121.A.00005', '- pemeliharaan kendaraan operasional roda 2', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(634, '054.01.WA.2886.EBA.994.002.A.523121.A.00006', '- pemeliharaan pc/laptop/notebook', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(635, '054.01.WA.2886.EBA.994.002.A.523121.A.00007', '- pemeliharaan printer', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(636, '054.01.WA.2886.EBA.994.002.A.523121.A.00008', '- pemeliharaan jaringan listrik, telepon dan komputer', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(637, '054.01.WA.2886.EBA.994.002.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(638, '054.01.WA.2886.EBA.994.002.A.524111.A.00001', '- Konsultasi kab/kota ke propinsi (Transport Perjalanan)', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(639, '054.01.WA.2886.EBB', 'Layanan Sarana dan Prasarana Internal', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(640, '054.01.WA.2886.EBB.951', 'Layanan Sarana Internal', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(641, '054.01.WA.2886.EBB.951.053', 'Pengadaan peralatan fasilitas perkantoran', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(642, '054.01.WA.2886.EBB.951.053.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(643, '054.01.WA.2886.EBB.951.053.A.532111.A', 'Belanja Modal Peralatan dan Mesin', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(644, '054.01.WA.2886.EBB.951.053.A.532111.A.00001', '- Pengadaan Laptop', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(645, '054.01.WA.2886.EBD', 'Layanan Manajemen Kinerja Internal', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(646, '054.01.WA.2886.EBD.952', 'Layanan Perencanaan dan Penganggaran', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(647, '054.01.WA.2886.EBD.952.051', 'Tanpa Komponen', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(648, '054.01.WA.2886.EBD.952.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(649, '054.01.WA.2886.EBD.952.051.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(650, '054.01.WA.2886.EBD.952.051.A.524111.A.00001', '- Perjalanan ke DJPB', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(651, '054.01.WA.2886.EBD.955', 'Layanan Manajemen Keuangan', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(652, '054.01.WA.2886.EBD.955.051', 'Tanpa Komponen', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(653, '054.01.WA.2886.EBD.955.051.A', 'TANPA SUB KOMPONEN', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(654, '054.01.WA.2886.EBD.955.051.A.521115.A', 'Belanja Honor Operasional Satuan Kerja', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(655, '054.01.WA.2886.EBD.955.051.A.521115.A.00001', '- Pengelola SAI tingkat satuan: koordinator', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(656, '054.01.WA.2886.EBD.955.051.A.521115.A.00002', '- Pengelola SAI tingkat satuan kerja: ketua', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(657, '054.01.WA.2886.EBD.955.051.A.521115.A.00003', '- Pengelola SAI tingkat satuan kerja: anggota', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(658, '054.01.WA.2886.EBD.955.051.A.524111.A', 'Belanja Perjalanan Dinas Biasa', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53'),
(659, '054.01.WA.2886.EBD.955.051.A.524111.A.00001', '- Konsultasi Administrasi', 1, '2024-11-10 19:14:53', '2024-11-10 19:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `kepka_mitras`
--

CREATE TABLE `kepka_mitras` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kepka_mitras`
--

INSERT INTO `kepka_mitras` (`id`, `nomor`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 'Kepka Mitra Tahuin 2024', '2024', '2024-10-25 16:28:11', '2024-10-25 16:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `kerangka_acuans`
--

CREATE TABLE `kerangka_acuans` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `rincian` text COLLATE utf8mb4_unicode_ci,
  `latar` text COLLATE utf8mb4_unicode_ci,
  `maksud` text COLLATE utf8mb4_unicode_ci,
  `tujuan` text COLLATE utf8mb4_unicode_ci,
  `sasaran` text COLLATE utf8mb4_unicode_ci,
  `tkdn` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metode` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kegiatan` text COLLATE utf8mb4_unicode_ci,
  `awal` date DEFAULT NULL,
  `akhir` date DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `naskah_keluar_id` mediumint UNSIGNED DEFAULT NULL,
  `dipa_id` mediumint UNSIGNED DEFAULT NULL,
  `unit_kerja_id` mediumint UNSIGNED DEFAULT NULL,
  `ppk_user_id` mediumint UNSIGNED DEFAULT NULL,
  `koordinator_user_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kerangka_acuans`
--

INSERT INTO `kerangka_acuans` (`id`, `tanggal`, `rincian`, `latar`, `maksud`, `tujuan`, `sasaran`, `tkdn`, `jenis`, `metode`, `kegiatan`, `awal`, `akhir`, `status`, `naskah_keluar_id`, `dipa_id`, `unit_kerja_id`, `ppk_user_id`, `koordinator_user_id`, `created_at`, `updated_at`) VALUES
(7, '2024-11-02', 'Pembayaran Biaya Perjalanan Dinas dalam rangka... Pengadaan Perlengkapan....', 'Kegiatan PLKUMKM merupakan salah satu kegiatan yang dilakukan oleh Badan Pusat Statistik dalam rangka mendukung penyediaan Data Statistik sesuai amanat Undang-Undang no 16 Tahun 1997. Agar kegiatan tersebut dapat berjalan dengan lancar dan tepat waktu diperlukan adanya penyediaan ATK Pelatihan Petugas PLKUMKM sebagai sarana penunjang kegiatan yang dilaksanakan.', 'Maksud dari pelaksanaan kegiatan ini adalah untuk aa', 'Tujuan dari pelaksanaan kegiatan ini adalah', 'Target/sasaran yang ingin dicapai terkait dengan pelaksanaan kegiatan ini adalah', '-', 'Swakelola', '-', 'Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024 a', '2024-11-02', '2024-11-02', 'dicetak', 45, 1, 1, 13, 1, '2024-11-02 17:04:05', '2024-11-11 06:51:03'),
(8, '2024-11-03', 'Pembelian Kertas F4', 'Kegiatan PLKUMKM merupakan salah satu kegiatan yang dilakukan oleh Badan Pusat Statistik dalam rangka mendukung penyediaan Data Statistik sesuai amanat Undang-Undang no 16 Tahun 1997. Agar kegiatan tersebut dapat berjalan dengan lancar dan tepat waktu diperlukan adanya penyediaan ATK Pelatihan Petugas PLKUMKM sebagai sarana penunjang kegiatan yang dilaksanakan.', 'Maksud dari pelaksanaan kegiatan ini adalah untuk', 'Tujuan dari pelaksanaan kegiatan ini adalah', 'Target/sasaran yang ingin dicapai terkait dengan pelaksanaan kegiatan ini adalah', 'Ya', 'Penyedia', 'Pengadaan Langsung', 'Administrasi', '2024-11-03', '2024-11-05', 'outdated', 256, 1, 1, 13, 1, '2024-11-03 17:57:08', '2024-11-09 09:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `kode_arsips`
--

CREATE TABLE `kode_arsips` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tata_naskah_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kode_arsips`
--

INSERT INTO `kode_arsips` (`id`, `kode`, `group`, `detail`, `tata_naskah_id`, `created_at`, `updated_at`) VALUES
(1, 'PS.000', 'PERUMUSAN KEBIJAKAN DI BIDANG STATISTIK', 'Pengkajian Dan Pengusulan Kebijakan', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(2, 'PS.100', 'PERUMUSAN KEBIJAKAN DI BIDANG STATISTIK', 'Penyiapan Kebijakan', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(3, 'PS.200', 'PERUMUSAN KEBIJAKAN DI BIDANG STATISTIK', 'Masukan Dan Dukungan Dalam Penyusunan Kebijakan', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(4, 'PS.300', 'PERUMUSAN KEBIJAKAN DI BIDANG STATISTIK', 'Pengembangan Desain Dan Standardisasi', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(5, 'PS.400', 'PERUMUSAN KEBIJAKAN DI BIDANG STATISTIK', 'Penetapan Nspk', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(6, 'SS.010', 'SENSUS', 'Perencanaan:Master Plan dan Network Planing', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(7, 'SS.021', 'SENSUS', 'Perencanaan:Penyiapan bahan penyusunan rancangan sensus', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(8, 'SS.022', 'SENSUS', 'Perencanaan:Penyusunan metode pencacahan sensus', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(9, 'SS.023', 'SENSUS', 'Perencanaan:Penentuan volume sensus', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(10, 'SS.024', 'SENSUS', 'Perencanaan:Penyusunan desain penarikan sampel', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(11, 'SS.025', 'SENSUS', 'Perencanaan:Penyusunan kerangka sampel', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(12, 'SS.030', 'SENSUS', 'Perencanaan:Studi Pendahuluan', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(13, 'SS.110', 'SENSUS', 'Persiapan Sensus:Rancangan Organisasi', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(14, 'SS.120', 'SENSUS', 'Persiapan Sensus:Penyusunan Kuesioner', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(15, 'SS.130', 'SENSUS', 'Persiapan Sensus:Penyusunan Konsep dan Definisi', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(16, 'SS.140', 'SENSUS', 'Persiapan Sensus:Penyusunan Metodologi (organisasi, lapangan, ukuran statistik)', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(17, 'SS.150', 'SENSUS', 'Persiapan Sensus:Penyusunan Buku Pedoman (pencacahan, pengawasan, pengolahan)', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(18, 'SS.160', 'SENSUS', 'Persiapan Sensus:Penyusunan Peta Wilayah Kerja dan Muatan Peta Wilayah', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(19, 'SS.170', 'SENSUS', 'Persiapan Sensus:Penyusunan Pedoman Sosialisasi', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(20, 'SS.180', 'SENSUS', 'Persiapan Sensus:Penyusunan Program Pengolahan (rule validasi pemeriksaan entri tabulasi)', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(21, 'SS.190', 'SENSUS', 'Persiapan Sensus:Koordinasi Intern/Ekstrn', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(22, 'SS.210', 'SENSUS', 'Pelatihan Instruktur', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(23, 'SS.220', 'SENSUS', 'Pelatihan Petugas', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(24, 'SS.230', 'SENSUS', 'Pelatihan Petugas Pengolahan', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(25, 'SS.240', 'SENSUS', 'Perancangan Tabel', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(26, 'SS.250', 'SENSUS', 'Ujicoba Kuesioner Sensus', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(27, 'SS.260', 'SENSUS', 'Ujicoba Kuesioner Metodologi Sensus', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(28, 'SS.310', 'SENSUS', 'Pelaksanaan Lapangan:Listing', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(29, 'SS.320', 'SENSUS', 'Pelaksanaan Lapangan:Pemilihan Sampel', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(30, 'SS.330', 'SENSUS', 'Pelaksanaan Lapangan:Pengumpulan Data', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(31, 'SS.340', 'SENSUS', 'Pelaksanaan Lapangan:Pemeriksaan Data', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(32, 'SS.350', 'SENSUS', 'Pelaksanaan Lapangan:Pengawasan Lapangan', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(33, 'SS.360', 'SENSUS', 'Pelaksanaan Lapangan:Monitoring Kualitas', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(34, 'SS.410', 'SENSUS', 'Pengolahan:Receiving Batching', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(35, 'SS.420', 'SENSUS', 'Pengolahan:Editing Coding', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(36, 'SS.430', 'SENSUS', 'Pengolahan:Entri/Scan', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(37, 'SS.440', 'SENSUS', 'Pengolahan:Tabulasi Data', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(38, 'SS.450', 'SENSUS', 'Pengolahan:Pemeriksaan Tabulasi', 1, '2024-10-12 17:47:01', '2024-10-12 17:47:01'),
(39, 'SS.460', 'SENSUS', 'Pengolahan:Laporan Konsistensi Tabulasi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(40, 'SS.510', 'SENSUS', 'Analisis Dan Penyajian:Pembahasan Angka Hasil Pengolahan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(41, 'SS.520', 'SENSUS', 'Analisis Dan Penyajian:Penyusunan Angka Sementara', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(42, 'SS.530', 'SENSUS', 'Analisis Dan Penyajian:Penyusunan Angka Tetap', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(43, 'SS.540', 'SENSUS', 'Analisis Dan Penyajian:Penyusunan/Pembahasan Draft Publikasi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(44, 'SS.550', 'SENSUS', 'Analisis Dan Penyajian:Analisis Data Sensus', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(45, 'SS.560', 'SENSUS', 'Analisis Dan Penyajian:Penyusunan Diseminasi Hasil Sensus', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(46, 'SS.610', 'SENSUS', 'Diseminasi Hasil Sensus:Penyusunan Bahan Diseminasi:leaflet, booklet, website dll', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(47, 'SS.620', 'SENSUS', 'Diseminasi Hasil Sensus:Sosialisasi hasil Sensus melalui berbagai media', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(48, 'SS.630', 'SENSUS', 'Diseminasi Hasil Sensus:Layanan Promosi Statistik', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(49, 'VS.010', 'SURVEI', 'Perencanaan Survei:Master Plan dan Network Planing SURVEI', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(50, 'VS.021', 'SURVEI', 'Perencanaan Survei:Penyiapan bahan penyusunan rancangan survei', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(51, 'VS.022', 'SURVEI', 'Perencanaan Survei:Penyusunan metode pencacahan survei', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(52, 'VS.023', 'SURVEI', 'Perencanaan Survei:Penentuan volume survei', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(53, 'VS.024', 'SURVEI', 'Perencanaan Survei:Penyusunan desain penarikan sampel', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(54, 'VS.025', 'SURVEI', 'Perencanaan Survei:Penyusunan kerangka sampel', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(55, 'VS.030', 'SURVEI', 'Perencanaan Survei:Studi Pendahuluan (desk study)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(56, 'VS.110', 'SURVEI', 'Persiapan Survei:Rancangan Organisasi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(57, 'VS.120', 'SURVEI', 'Persiapan Survei:Penyusunan Kuesioner', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(58, 'VS.130', 'SURVEI', 'Persiapan Survei:Penyusunan Konsep dan Definisi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(59, 'VS.140', 'SURVEI', 'Persiapan Survei:Penyusunan Metodologi (organisasi, lapangan, ukuran statistik)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(60, 'VS.150', 'SURVEI', 'Persiapan Survei:Penyusunan Buku Pedoman (pencacahan, pengawasan, pengolahan)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(61, 'VS.160', 'SURVEI', 'Persiapan Survei:Penyusunan Peta Wilayah Kerja dan Muatan Peta Wilayah', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(62, 'VS.170', 'SURVEI', 'Persiapan Survei:Penyusunan Pedoman Sosialisasi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(63, 'VS.180', 'SURVEI', 'Persiapan Survei:Penyusunan Program Pengolahan (rule validasi pemeriksaan entri tabulasi)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(64, 'VS.190', 'SURVEI', 'Persiapan Survei:Koordinasi Intern/Ekstrn', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(65, 'VS.210', 'SURVEI', 'Pelatihan/Ujicoba:Pelatihan Instruktur', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(66, 'VS.220', 'SURVEI', 'Pelatihan/Ujicoba:Pelatihan Petugas', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(67, 'VS.230', 'SURVEI', 'Pelatihan/Ujicoba:Pelatihan Petugas Pengolahan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(68, 'VS.240', 'SURVEI', 'Pelatihan/Ujicoba:Perancangan Tabel', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(69, 'VS.250', 'SURVEI', 'Pelatihan/Ujicoba:Pelaksanaan Ujicoba Kuesioner Survei', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(70, 'VS.260', 'SURVEI', 'Pelatihan/Ujicoba:Pelaksanaan Ujicoba Kuesioner Metodologi Survei', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(71, 'VS.310', 'SURVEI', 'Pelaksanaan Lapangan:Listing', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(72, 'VS.320', 'SURVEI', 'Pelaksanaan Lapangan:Pemilihan Sampel', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(73, 'VS.330', 'SURVEI', 'Pelaksanaan Lapangan:Pengumpulan Data', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(74, 'VS.340', 'SURVEI', 'Pelaksanaan Lapangan:Pemeriksaan Data', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(75, 'VS.350', 'SURVEI', 'Pelaksanaan Lapangan:Pengawasan Lapangan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(76, 'VS.360', 'SURVEI', 'Pelaksanaan Lapangan:Monitoring Kualitas', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(77, 'VS.410', 'SURVEI', 'Pengolahan:Pengelolaan Dokumen (penerimaan/pengiriman, pengelompokan/batching)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(78, 'VS.420', 'SURVEI', 'Pengolahan:Pemeriksaan Dokumen dan Pengkodean(editing/coding)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(79, 'VS.430', 'SURVEI', 'Pengolahan:Perekam Data (entri/scanner)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(80, 'VS.440', 'SURVEI', 'Pengolahan:Tabulasi Data', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(81, 'VS.450', 'SURVEI', 'Pengolahan:Pemeriksaan Tabulasi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(82, 'VS.460', 'SURVEI', 'Pengolahan:Laporan Konsistensi Tabulasi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(83, 'VS.510', 'SURVEI', 'Analisis Dan Penyajian Hasil Survei:Pembahasan Angka Hasil Pengolahan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(84, 'VS.520', 'SURVEI', 'Analisis Dan Penyajian Hasil Survei:Penyusunan Angka Sementara', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(85, 'VS.530', 'SURVEI', 'Analisis Dan Penyajian Hasil Survei:Penyusunan Angka Proyeksi/Ramalan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(86, 'VS.540', 'SURVEI', 'Analisis Dan Penyajian Hasil Survei:Penyusunan Angka Tetap', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(87, 'VS.550', 'SURVEI', 'Analisis Dan Penyajian Hasil Survei:Penyusunan/ Pembahasan Draft Publikasi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(88, 'VS.560', 'SURVEI', 'Analisis Dan Penyajian Hasil Survei:Analisis Data Survei', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(89, 'VS.570', 'SURVEI', 'Analisis Dan Penyajian Hasil Survei:Penyusunan Diseminasi Hasil Survei', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(90, 'VS.610', 'SURVEI', 'Diseminasi Hasil Survei:Penyusunan Bahan Diseminasi: leaflet, booklet, website dll', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(91, 'VS.620', 'SURVEI', 'Diseminasi Hasil Survei:Sosialisasi Hasil Survei melalui berbagai Media', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(92, 'VS.630', 'SURVEI', 'Diseminasi Hasil Survei:Layanan Promosi Statistik', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(93, 'KS.000', 'KONSOLIDASI DATA STATISTIK', 'Kompilasi Data', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(94, 'KS.100', 'KONSOLIDASI DATA STATISTIK', 'Analisi Data', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(95, 'KS.200', 'KONSOLIDASI DATA STATISTIK', 'Penyusunan Publikasi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(96, 'KU.010', 'PELAKSANAAN ANGGARAN', 'Ketentuan/Peraturan Menteri Keuangan Menyangkut Pelaksanaan dan Penatausahaan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(97, 'KU.110', 'PELAKSANAAN ANGGARAN', 'Realisasi Pendapatan/Penerimaan Negara:Surat Setoran Pajak (SSP)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(98, 'KU.120', 'PELAKSANAAN ANGGARAN', 'Realisasi Pendapatan/Penerimaan Negara:Surat Setoran Bukan Pajak (SSBP)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(99, 'KU.130', 'PELAKSANAAN ANGGARAN', 'Realisasi Pendapatan/Penerimaan Negara:Bukti Penerimaan Bukan Pajak (PNBP)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(100, 'KU.141', 'PELAKSANAAN ANGGARAN', 'Pendapatan/Penerimaan dari :Pajak Bumi Bangunan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(101, 'KU.142', 'PELAKSANAAN ANGGARAN', 'Pendapatan/Penerimaan dari :Bea Perolehan Hak Atas Tanah dan Bangunan (BPHTB)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(102, 'KU.143', 'PELAKSANAAN ANGGARAN', 'Pendapatan/Penerimaan dari :Pajak Penghasilan (Pph)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(103, 'KU.150', 'PELAKSANAAN ANGGARAN', 'Realisasi Pendapatan/Penerimaan Negara:Bukti Setor Sisa Anggaran Lebih atau Bukti Setor Pengembalian Belanja (SSPB)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(104, 'KU.160', 'PELAKSANAAN ANGGARAN', 'Realisasi Pendapatan/Penerimaan Negara:Bunga dan atau Jasa Giro pada Bank', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(105, 'KU.170', 'PELAKSANAAN ANGGARAN', 'Realisasi Pendapatan/Penerimaan Negara:Piutang Negara', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(106, 'KU.180', 'PELAKSANAAN ANGGARAN', 'Realisasi Pendapatan/Penerimaan Negara:Pengelolaan Investasi dan Penyertaan Modal', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(107, 'KU.210', 'PELAKSANAAN ANGGARAN', 'Pengelolaan Perbendaharaan:Pejabat Penguji dan Penandatanganan SPM', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(108, 'KU.220', 'PELAKSANAAN ANGGARAN', 'Pengelolaan Perbendaharaan:Bendahara Penerimaan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(109, 'KU.230', 'PELAKSANAAN ANGGARAN', 'Pengelolaan Perbendaharaan:Bendahara Pengeluaran', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(110, 'KU.240', 'PELAKSANAAN ANGGARAN', 'Pengelolaan Perbendaharaan:Kartu Pengawasan Pembayaran Penghasilan Pegawai (PK4)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(111, 'KU.250', 'PELAKSANAAN ANGGARAN', 'Pengelolaan Perbendaharaan:Pengembalian Belanja', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(112, 'KU.261', 'PELAKSANAAN ANGGARAN', 'Pengelolaan Perbendaharaan:Pembukuan :Buku Kas Umum (BKU)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(113, 'KU.262', 'PELAKSANAAN ANGGARAN', 'Pengelolaan Perbendaharaan:Pembukuan :Buku Kas Pembantu', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(114, 'KU.263', 'PELAKSANAAN ANGGARAN', 'Pengelolaan Perbendaharaan:Pembukuan :Kartu Realisasi Anggaran dan Pengawasan Realisasi Anggaran', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(115, 'KU.270', 'PELAKSANAAN ANGGARAN', 'Pengelolaan Perbendaharaan:Berita Acara Pemeriksaan Kas', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(116, 'KU.280', 'PELAKSANAAN ANGGARAN', 'Pengelolaan Perbendaharaan:Datar Gaji/Kartu Gaji', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(117, 'KU.310', 'PELAKSANAAN ANGGARAN', 'Naskah  Pengeluaran Anggaran:Naskah SPP,  SPM, SP2D, Nota Keuangan :Belanja Bahan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(118, 'KU.320', 'PELAKSANAAN ANGGARAN', 'Naskah  Pengeluaran Anggaran:Naskah SPP,  SPM, SP2D, Nota Keuangan :Belanja Barang', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(119, 'KU.330', 'PELAKSANAAN ANGGARAN', 'Naskah  Pengeluaran Anggaran:Naskah SPP,  SPM, SP2D, Nota Keuangan :Belanja Jasa (Konsultasi, Profesi)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(120, 'KU.340', 'PELAKSANAAN ANGGARAN', 'Naskah  Pengeluaran Anggaran:Naskah SPP,  SPM, SP2D, Nota Keuangan :Belanja Perjalanan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(121, 'KU.350', 'PELAKSANAAN ANGGARAN', 'Naskah  Pengeluaran Anggaran:Naskah SPP,  SPM, SP2D, Nota Keuangan :Belanja Pegawai', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(122, 'KU.360', 'PELAKSANAAN ANGGARAN', 'Naskah  Pengeluaran Anggaran:Naskah SPP,  SPM, SP2D, Nota Keuangan :Belanja Paket Meeting Dalam Kota', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(123, 'KU.370', 'PELAKSANAAN ANGGARAN', 'Naskah  Pengeluaran Anggaran:Naskah SPP,  SPM, SP2D, Nota Keuangan :Belanja Paket Meeting Luar Kota', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(124, 'KU.380', 'PELAKSANAAN ANGGARAN', 'Naskah  Pengeluaran Anggaran:Naskah SPP,  SPM, SP2D, Nota Keuangan :Belanja Akun Kombinasi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(125, 'KU.410', 'PELAKSANAAN ANGGARAN', 'Verifikasi Anggaran:Surat Permintaan Pembayaran (SPP) beserta lampirannya', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(126, 'KU.420', 'PELAKSANAAN ANGGARAN', 'Verifikasi Anggaran:Surat Perintah Membayar (SPM), Surat perintah Pencairan dana (SP2D)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(127, 'KU.511', 'PELAKSANAAN ANGGARAN', 'Pelaporan:Berita Acara Pemeriksaan Kas', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(128, 'KU.512', 'PELAKSANAAN ANGGARAN', 'Pelaporan:Kas/Registrasi Penutupan Kas', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(129, 'KU.513', 'PELAKSANAAN ANGGARAN', 'Pelaporan:Laporan Pendapatan Negara', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(130, 'KU.514', 'PELAKSANAAN ANGGARAN', 'Pelaporan:Arsip Data Komputer (ADK)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(131, 'KU.521', 'PELAKSANAAN ANGGARAN', 'Pelaporan:Keadaan Kredit Anggaran (LKKA) Bulanan/ Triwulan/Semesteran ', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(132, 'KU.521', 'PELAKSANAAN ANGGARAN', 'Pelaporan:Laporan Realisasi Anggaran (RKA)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(133, 'KU.521', 'PELAKSANAAN ANGGARAN', 'Pelaporan:Neraca', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(134, 'KU.521', 'PELAKSANAAN ANGGARAN', 'Pelaporan:Laporan Arus Kas', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(135, 'KU.521', 'PELAKSANAAN ANGGARAN', 'Pelaporan:Catatan Atas Laporan Keuangan (CALK)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(136, 'KU.530', 'PELAKSANAAN ANGGARAN', 'Pelaporan:Rekonsiliasi Data Laporan Keuangan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(137, 'KU.610', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Permohonan Pinjaman Luar Negeri (Blue Book)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(138, 'KU.620', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Dokumen Kesanggupan negara donor (Gray Book)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(139, 'KU.630', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Memorandum of Understand (MOU) dan dokumen sejenisnya', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(140, 'KU.640', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Loan Agreement  Pinjaman/Hibah Luar Negeri (PHLN), legal opinion', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(141, 'KU.650', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Alokasi dan Relokasi Penggunaan Dana Pinjaman/Hibah Luar Negeri', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(142, 'KU.661', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Aplikasi Penarikan Dana Bantuan Luar Negeri (BLN)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(143, 'KU.661', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Penarikan Dana Bantuan Luar Negeri:Reimbursment', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(144, 'KU.661', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Penarikan Dana Bantuan Luar Negeri:Direct [payment/ Transfer Procedure', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(145, 'KU.661', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Penarikan Dana Bantuan Luar Negeri:Special Comitment/ L/C Opening', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(146, 'KU.661', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Penarikan Dana Bantuan Luar Negeri:Special Account/Imprest Fund', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(147, 'KU.662', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Penarikan Dana Bantuan Luar Negeri:Otorisasi Penarikan Dana (Payment Advice)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(148, 'KU.663', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Penarikan Dana Bantuan Luar Negeri:Replenisment (permintaan penarikan dana dari negara donor)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(149, 'KU.663', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Penarikan Dana Bantuan Luar Negeri:No Objection Letter (NOL)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(150, 'KU.663', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Penarikan Dana Bantuan Luar Negeri:Notification of Contract', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(151, 'KU.663', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Penarikan Dana Bantuan Luar Negeri:Withdrawal Authorization (WA)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(152, 'KU.663', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Penarikan Dana Bantuan Luar Negeri:Statement of Expenditur (SE)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(153, 'KU.670', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Realisasi Pencairan Dana Bantuan Luar Negeri', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(154, 'KU.670', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:a Surat Perintah Pencairan Dana (SP2D)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(155, 'KU.670', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:SPM , SPP, Kontrak, BA dan data pendukung lainnya', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(156, 'KU.680', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Ketentuan/Peraturan yang Menyangkut Bantuan/Pinjaman Luar Negeri', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(157, 'KU.691', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Laporan Pelaksanaan Bantuan/Pinjaman Luar Negeri:Staff Appraisal Report', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(158, 'KU.692', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Laporan Pelaksanaan Bantuan/Pinjaman Luar Negeri:Report/Laporan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(159, 'KU.692', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Laporan Pelaksanaan Bantuan/Pinjaman Luar Negeri:Progress Report', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(160, 'KU.692', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Laporan Pelaksanaan Bantuan/Pinjaman Luar Negeri:Monthly Report', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(161, 'KU.692', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Laporan Pelaksanaan Bantuan/Pinjaman Luar Negeri:Quartely Report', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(162, 'KU.693', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Laporan Pelaksanaan Bantuan/Pinjaman Luar Negeri:Laporan Hutang Negara', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(163, 'KU.693', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Laporan Pelaksanaan Bantuan/Pinjaman Luar Negeri:Laporan Pembayaran Hutang Negara', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(164, 'KU.693', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Laporan Pelaksanaan Bantuan/Pinjaman Luar Negeri:Laporan Posisi Hutang Negara', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(165, 'KU.694', 'PELAKSANAAN ANGGARAN', 'Bantuan Pinjaman Luar Negeri:Laporan Pelaksanaan Bantuan/Pinjaman Luar Negeri:Completion Report/Annual Report', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(166, 'KU.711', 'PELAKSANAAN ANGGARAN', 'Pengelola Anggaran:SK Penetapan :Kuasa Pengguna Anggaran (KPA), Pejabat Pembuat Komitmen (PKK)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(167, 'KU.712', 'PELAKSANAAN ANGGARAN', 'Pengelola Anggaran:SK Penetapan :Pejabat Pembuatan Daftar Gaji', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(168, 'KU.713', 'PELAKSANAAN ANGGARAN', 'Pengelola Anggaran:SK Penetapan :Penandatangan SPM', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(169, 'KU.714', 'PELAKSANAAN ANGGARAN', 'Pengelola Anggaran:SK Penetapan :Bendahara Penerimaan/Pengeluaran, Pengelola Barang', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(170, 'KU.810', 'PELAKSANAAN ANGGARAN', 'Sistem Akuntansi Instansi (Sai):Manual Implementasi Sistem Akuntansi Instansi (SAI)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(171, 'KU.820', 'PELAKSANAAN ANGGARAN', 'Sistem Akuntansi Instansi (Sai):Arsip Data Komputer dan Berita Acara Rekonsiliasi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(172, 'KU.830', 'PELAKSANAAN ANGGARAN', 'Sistem Akuntansi Instansi (Sai):Daftar Transaksi (DT), Pengeluaran (PK), Penerimaan (PN)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(173, 'KU.830', 'PELAKSANAAN ANGGARAN', 'Sistem Akuntansi Instansi (Sai):Dokumen Sumber (DS), Bukti Jurnal (BJ) surat Tanda Setor (STS)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(174, 'KU.830', 'PELAKSANAAN ANGGARAN', 'Sistem Akuntansi Instansi (Sai):Surat Setor Bukan Pajak (SSBP), Surat Perintah Pencairan Dana (SP2D)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(175, 'KU.830', 'PELAKSANAAN ANGGARAN', 'Sistem Akuntansi Instansi (Sai):SPM dalam Daftar Ringkasan Pengembalian dan Potongan dari Pengeluaran (SPRD)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(176, 'KU.840', 'PELAKSANAAN ANGGARAN', 'Sistem Akuntansi Instansi (Sai):Listing (Daftar Rekaman Penerimaan) Buku Temuan dan Tindakan Lain (SAI)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(177, 'KU.850', 'PELAKSANAAN ANGGARAN', 'Sistem Akuntansi Instansi (Sai):Laporan Realisasi Bulanan SAI', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(178, 'KU.860', 'PELAKSANAAN ANGGARAN', 'Sistem Akuntansi Instansi (Sai):Laporan Realisasi Triwulanan SAI dari Unit Akuntansi Wilayah (UAW) /UAKPI', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(179, 'KU.910', 'PELAKSANAAN ANGGARAN', 'Pertanggungjawaban Keuangan Negara:Laporan Hasil Pemeriksaan atas Laporan Keuangan oleh BPK RI', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(180, 'KU.920', 'PELAKSANAAN ANGGARAN', 'Pertanggungjawaban Keuangan Negara:Hasil Pengawasan dan Pemeriksaan Internal', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(181, 'KU.931', 'PELAKSANAAN ANGGARAN', 'Pertanggungjawaban Keuangan Negara:Laporan Aparat Pemeriksa Fungsional:Laporan Hasil Pemeriksaan  (LHP) ', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(182, 'KU.932', 'PELAKSANAAN ANGGARAN', 'Pertanggungjawaban Keuangan Negara:Laporan Aparat Pemeriksa Fungsional:Memorandum Hasil Pemeriksaan (MHP)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(183, 'KU.933', 'PELAKSANAAN ANGGARAN', 'Pertanggungjawaban Keuangan Negara:Laporan Aparat Pemeriksa Fungsional:Tindak Lanjut/Tanggapan LHP', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(184, 'KU.941', 'PELAKSANAAN ANGGARAN', 'Pertanggungjawaban Keuangan Negara:Dokumentasi Penyelesaian Keuangan Negara:Tuntutan Perbendaharaan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(185, 'KU.942', 'PELAKSANAAN ANGGARAN', 'Pertanggungjawaban Keuangan Negara:Dokumentasi Penyelesaian Keuangan Negara:Tuntutan Ganti Rugi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(186, 'KP.010', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Usulan dari Unit Kerja', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(187, 'KP.020', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Usulan Permintaan Formasi kepada Menpan dan Kepala BKN', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(188, 'KP.030', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Persetujuan Menpan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(189, 'KP.040', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Penetapan Formasi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(190, 'KP.050', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Penetapan Formasi Khusus', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(191, 'KP.111', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Perimaan Pegawai:Pengumuman', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(192, 'KP.112', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Perimaan Pegawai:Seleksi Administrasi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(193, 'KP.113', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Perimaan Pegawai:Pemanggilan Peserta Tes', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(194, 'KP.114', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Perimaan Pegawai:Pelaksanaa Ujian (tertulis, psikotes, wawancara)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(195, 'KP.115', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Perimaan Pegawai:Keputusan Hasil Ujian', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(196, 'KP.120', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Penetapan Pengumuman Kelulusan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(197, 'KP.130', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Berkas Lamaran yang Tidak Diterima', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(198, 'KP.140', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Nota Usul dan Kelengkapan Penetapan NIP', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(199, 'KP.150', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Nota Usul Pengangkatan CPNS menjadi PNS', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(200, 'KP.160', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:Nota Usul Pengangkatan CPNS menjadi PNS lebih 2 Tahun', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(201, 'KP.170', 'KEPEGAWAIAN', 'Pengadaan Dan Pengangkatan Pegawai:SK CPNS/PNS Kolektif', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(202, 'KP.200', 'KEPEGAWAIAN', 'Berkas Pegawai Tidak Tetap/Mitra Statistik', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(203, 'KP.311', 'KEPEGAWAIAN', 'Pembinaan Karir:Diklat Kursus/ Tugas Belajar/ Ujian Dinas/ Izin Belajar Pegawai:Surat Perintah/ Surat Tugas/ SK/ Surat Izin', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(204, 'KP.312', 'KEPEGAWAIAN', 'Pembinaan Karir Pegawai:Diklat Kursus/ Tugas Belajar/ Ujian Dinas/ Izin Belajar Pegawai:Laporan Kegiatan Pengembangan Diri', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(205, 'KP.313', 'KEPEGAWAIAN', 'Pembinaan Karir:Diklat Kursus/ Tugas Belajar/ Ujian Dinas/ Izin Belajar Pegawai:Surat Tanda Tamat Pendidikan dan Pelatihan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(206, 'KP.321', 'KEPEGAWAIAN', 'Pembinaan Karir Pegawai:Ujian Kompetensi:Assesment Tes Pegawai', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(207, 'KP.322', 'KEPEGAWAIAN', 'Pembinaan Karir Pegawai:Ujian Kompetensi:Pemetaan/Mapping Talent Pegawai', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(208, 'KP.330', 'KEPEGAWAIAN', 'Pembinaan Karir Pegawai:Daftar Penilaian Pelaksanaan Pekerjaan (DP3) dan Sasaran Kinerja Pegawai (SKP)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(209, 'KP.340', 'KEPEGAWAIAN', 'Pembinaan Karir Pegawai:Pakta Integritas Pegawai', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(210, 'KP.350', 'KEPEGAWAIAN', 'Pembinaan Karir Pegawai:Laporan Hasil Kekayaan Penyelenggara Negara (LHKPN)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(211, 'KP.360', 'KEPEGAWAIAN', 'Pembinaan Karir Pegawai:Daftar Usul Penetapan Angka Kredit Fungsional', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(212, 'KP.371', 'KEPEGAWAIAN', 'Pembinaan Karir Pegawai:Disiplin Pegawai:Daftar Hadir', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(213, 'KP.371', 'KEPEGAWAIAN', 'Pembinaan Karir Pegawai:Disiplin Pegawai:Rekapitulasi Daftar Hadir', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(214, 'KP.380', 'KEPEGAWAIAN', 'Pembinaan Karir Pegawai:Berkas Hukum Disiplin', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(215, 'KP.390', 'KEPEGAWAIAN', 'Pembinaan Karir Pegawai:Penghargaan dan Tanda Jasa (Satya Lencana/Bintang Jasa)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(216, 'KP.400', 'KEPEGAWAIAN', 'Penyelesaian Pengelolaan Keberatan Pegawai', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(217, 'KP.510', 'KEPEGAWAIAN', 'Mutasi Pegawai:Alih Status, Pindah, Diperbantukan, Dipekerjakan, Penugasan Sementara', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(218, 'KP.520', 'KEPEGAWAIAN', 'Mutasi Pegawai:Nota Persetujuan/Pertimbangan Kepala BKN', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(219, 'KP.531', 'KEPEGAWAIAN', 'Mutasi Pegawai:Mutasi Keluarga:Surat Izin Pernikahan/Perceraian', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(220, 'KP.532', 'KEPEGAWAIAN', 'Mutasi Pegawai:Mutasi Keluarga:Surat Penolakan Izin Pernikahan/perceraian', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(221, 'KP.533', 'KEPEGAWAIAN', 'Mutasi Pegawai:Mutasi Keluarga:Akte Nikah/Cerai', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(222, 'KP.534', 'KEPEGAWAIAN', 'Mutasi Pegawai:Mutasi Keluarga:Surat Keterangan Meninggal Dunia', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(223, 'KP.540', 'KEPEGAWAIAN', 'Mutasi Pegawai:Usul Kenaikan Pangkat/Golongan/Jabatan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(224, 'KP.550', 'KEPEGAWAIAN', 'Mutasi Pegawai:Usul Pengangkatan dan Pemberhentian dalam Jabatan Struktural/Fungsional', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(225, 'KP.560', 'KEPEGAWAIAN', 'Mutasi Pegawai:Usul Penetapan Perubahan Data Dasar/Status/kedudukan Hukum pegawai', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(226, 'KP.570', 'KEPEGAWAIAN', 'Mutasi Pegawai:Peninjauan Masa Kerja', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(227, 'KP.580', 'KEPEGAWAIAN', 'Mutasi Pegawai:Berkas Baperjakat', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(228, 'KP.611', 'KEPEGAWAIAN', 'Administrasi Pegawai:Identitas Pegawai:Usul Penetapan Karpeg/KPE/Karis/Karsu', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(229, 'KP.612', 'KEPEGAWAIAN', 'Administrasi Pegawai:Identitas Pegawai:Keanggotaan Organisasi Profesi/Kedinasan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(230, 'KP.613', 'KEPEGAWAIAN', 'Administrasi Pegawai:Identitas Pegawai:Laporan Pajak Penghasilan Pribadi (LP2P)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(231, 'KP.614', 'KEPEGAWAIAN', 'Administrasi Pegawai:Identitas Pegawai:Keterangan Penerimaan Penghasilan Pegawai (KP4)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(232, 'KP.620', 'KEPEGAWAIAN', 'Administrasi Pegawai:Berkas Kepegawaian dan Daftar Urut Kepangkatan (DUK)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(233, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Berkas Perorangan Pegawai Negeri Sipil', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(234, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Nota Penetapan NIP dan kelengkapannya', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(235, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Nota Persetujuan/Pertimbangan Kepala BKN', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(236, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Pengangkatan CPNS', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(237, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Hasil Pengujian Kesehatan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(238, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Pengangkatan PNS', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(239, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Peninjauan Masa Kerja', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(240, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Kenaikan Pangkat', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(241, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Pernyataan Melaksanakan Tugas/Menduduki Jabatan/Surat Pernyataan Pelantikan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(242, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Pengangkatan Dalam atau Pemberhentian Dari Jabatan Struktural/Fungsional', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(243, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Perpindahan Wilayah Kerja', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(244, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Perpindahan Antar Instansi', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(245, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Cuti di Luar Tanggungan Negara (CLTN)', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(246, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Berita Acara Pemeriksaan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(247, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Hukuman Jabatan/ Hukum Disiplin PNS', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(248, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Perbantuan/Dipekerjakan Diluar Instansi Induk', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(249, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Penarikan Kembali dan Perbantuan/Dipekerjakan', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(250, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Pemberian Uang Tunggu', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(251, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Pembebasan Dari Jabatan Organik Karena Diangkat Sebagai Pejabat Negara', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(252, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Pengalihan PNS', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(253, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Pemberhentian Sebagai PNS', 1, '2024-10-12 17:47:02', '2024-10-12 17:47:02'),
(254, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Pemberhentian Sementara', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(255, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Ketarangan Pernyataan Hilang', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(256, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Keterangan Kembalinya PNS Yang Dinyatakan Hilang', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(257, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Penggantian Nama', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(258, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Perbaikan Tanggal Tahun Kelahiran', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(259, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Akta Nikah/Cerai', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(260, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Akta Kelahiran', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(261, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Isian Formulir PUPNS', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(262, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Berita Acara Pengambilan Sumpah/Janji PNS dari Jabatan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(263, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Permohonan Menjadi Anggota Parpol', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(264, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Keterangan Mutasi Keluarga', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(265, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Keterangan Meninggal Dunia', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(266, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Keterangan Peningkatan Pendidikan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(267, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Penetapan Angka Kredit Jabatan Fungsional', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(268, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Keterangan Hasil Penelitian Khusus', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(269, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Penelitian Kenaikan Gaji Berkala', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(270, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Tugas/Izin Belajar Dalam/Luar Negeri', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(271, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Izin Bepergian Ke Luar Negeri', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(272, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Kartu Pendaftaran Ulang (Kardaf) PNS', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(273, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Ijazah/Sertifikat', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(274, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Penempatan/Penarikan Pegawai', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(275, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Pengangkatan Pada Jabatan Diluar Instansi Induk', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(276, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Pertimbangan Status TNI', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(277, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:SK Pengaktifan Kembali Sebagai PNS', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(278, 'KP.630', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Pernyataan Pengunduran Diri Dari Jabatan Organik Karena Dicalonkan Sebagai Kepala/Wakil Kepala Daerah', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(279, 'KP.641', 'KEPEGAWAIAN', 'Administrasi Pegawai:Berkas Perseorangan Pejabat Negara:Kepala BPS', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(280, 'KP.642', 'KEPEGAWAIAN', 'Administrasi Pegawai:Berkas Perseorangan Pejabat Negara:Pejabat Negara Lain', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(281, 'KP.650', 'KEPEGAWAIAN', 'Administrasi Pegawai:Surat Perintah Dinas/Surat Tugas', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(282, 'KP.661', 'KEPEGAWAIAN', 'Administrasi Pegawai:Berkas :Cuti Sakit', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(283, 'KP.662', 'KEPEGAWAIAN', 'Administrasi Pegawai:Berkas :Cuti Bersalin', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(284, 'KP.663', 'KEPEGAWAIAN', 'Administrasi Pegawai:Berkas :Cuti Tahunan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(285, 'KP.664', 'KEPEGAWAIAN', 'Administrasi Pegawai:Berkas :Cuti Alasan Penting', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(286, 'KP.665', 'KEPEGAWAIAN', 'Administrasi Pegawai:Berkas :Cuti Luar Tanggungan Negara (CLTN)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(287, 'KP.710', 'KEPEGAWAIAN', 'Kesejahteraan Pegawai:Berkas Tentang Layanan Tunjangan/Gaji', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(288, 'KP.720', 'KEPEGAWAIAN', 'Kesejahteraan Pegawai:Berkas Tentang Pemeliharaan Kesehatan Pegawai', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(289, 'KP.730', 'KEPEGAWAIAN', 'Kesejahteraan Pegawai:Berkas Tentang Layanan Asuransi Pegawai', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(290, 'KP.740', 'KEPEGAWAIAN', 'Kesejahteraan Pegawai:Berkas Tentang Bantuan Sosial', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(291, 'KP.750', 'KEPEGAWAIAN', 'Kesejahteraan Pegawai:Berkas Tentang Layanan Olahraga Dan Rekreasi', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(292, 'KP.760', 'KEPEGAWAIAN', 'Kesejahteraan Pegawai:Berkas Tentang Layanan Pengurusan Jenazah', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(293, 'KP.770', 'KEPEGAWAIAN', 'Kesejahteraan Pegawai:Berkas Tentang Layanan Organisasi Non Kedinasan (Korpri, Dharma Wanita, Koperasi)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(294, 'KP.800', 'KEPEGAWAIAN', 'Pemberhentian Pegawai Tanpa Hak Pensiun', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(295, 'KP.900', 'KEPEGAWAIAN', 'Usul Pemberhentian Dan Penetapan Pensiun:Usul Pemberhentian Dan Penetapan Pensiun Pegawai/Janda/Duda & Pns Yang Tewas', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(296, 'PR.010', 'PERENCANAAN', 'Pokok-Pokok Kebijakan Dan Strategi Pembangunan:Pengumpulan Data', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(297, 'PR.020', 'PERENCANAAN', 'Pokok-Pokok Kebijakan Dan Strategi Pembangunan:Rencana Pembangunan Jangka Panjang (RPJP)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(298, 'PR.030', 'PERENCANAAN', 'Pokok-Pokok Kebijakan Dan Strategi Pembangunan:Rencana Pembangunan Jangka Panjang (RPJP)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(299, 'PR.040', 'PERENCANAAN', 'Pokok-Pokok Kebijakan Dan Strategi Pembangunan:Rencana Kerja Pemerintah(RKP)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(300, 'PR.050', 'PERENCANAAN', 'Pokok-Pokok Kebijakan Dan Strategi Pembangunan:Penyelenggaraan Musyawarah Perencanaan Pembangunan(Musrenbang)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(301, 'PR.110', 'PERENCANAAN', 'Penyusunan Rencana:Rencana Kegiatan Teknis', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(302, 'PR.120', 'PERENCANAAN', 'Penyusunan Rencana:Rencana Kegiatan Non-Teknis', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(303, 'PR.130', 'PERENCANAAN', 'Penyusunan Rencana:Keterpaduan Rencana Teknis dan Non Teknis', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(304, 'PR.210', 'PERENCANAAN', 'Program Kerja Tahunan:Usulan Unit Kerja beserta data penduduknya', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(305, 'PR.220', 'PERENCANAAN', 'Program Kerja Tahunan:Program Kerja Thunan Unit Kerja', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(306, 'PR.230', 'PERENCANAAN', 'Program Kerja Tahunan:Program Kerja Tahunan Instansi/Lembaga', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(307, 'PR.311', 'PERENCANAAN', 'Rapbn:Penyusunan:Arah kebijakan umum, strategi, prioritas, dan renstra', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(308, 'PR.311', 'PERENCANAAN', 'Rapbn:Penyusunan RAPBN:Rencana kerja', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(309, 'PR.311', 'PERENCANAAN', 'Rapbn:Penyusunan RAPBN:Rencana kerja pemerintah', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(310, 'PR.312', 'PERENCANAAN', 'Rapbn:Penyusunan:Rencana kerja dan anggaran kementrian lembaga (RKAKL)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(311, 'PR.313', 'PERENCANAAN', 'Rapbn:Penyusunan:Lembaga satuan anggaran per satuan kerja (SAPSKI), satuan rincian alokasi anggaran', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(312, 'PR.321', 'PERENCANAAN', 'Rapbn:Penyampaian APBN kepada DPR RI:Nota keuangan pemerintah dan rancangan Undang-Undang RAPBN', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(313, 'PR.321', 'PERENCANAAN', 'Rapbn:Penyampaian APBN kepada DPR RI:Nota keuangan pemerintah', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(314, 'PR.321', 'PERENCANAAN', 'Rapbn:Penyampaian APBN kepada DPR RI:Materi RAPBN dari lembaga negara dan badan pemerintah (RASKIP)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(315, 'PR.322', 'PERENCANAAN', 'Rapbn:Penyampaian APBN kepada DPR RI:Pembahasan RAPBN oleh komisi DPR RI', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(316, 'PR.323', 'PERENCANAAN', 'Rapbn:Penyampaian APBN kepada DPR RI:Risalah rapat dengar pendapat dengan DPR RI', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(317, 'PR.324', 'PERENCANAAN', 'Rapbn:Penyampaian APBN kepada DPR RI:Nota jawaban DPR RI', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(318, 'PR.330', 'PERENCANAAN', 'Rapbn:Undang-Undang anggaranpendapatan dan belanja negara (APBN) dan rencana pembangunan tahunan (REPETA)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(319, 'PR.410', 'PERENCANAAN', 'Penyusunan Apbn:Ketetapan pagu indikatif/pagu sementara', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(320, 'PR.420', 'PERENCANAAN', 'Penyusunan Apbn:ketetapan pagu definitif', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(321, 'PR.430', 'PERENCANAAN', 'Penyusunan Apbn:Rencana kerja anggaran (RKA) lembaga negara dan badan pemerintah (LNBP)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(322, 'PR.440', 'PERENCANAAN', 'Penyusunan Apbn:Daftar isian pelaksanaan anggaran (DIPA) dan revisinya', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(323, 'PR.450', 'PERENCANAAN', 'Penyusunan Apbn:Petunjuk operasional kegiatan (POK) dan revisinya', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(324, 'PR.460', 'PERENCANAAN', 'Penyusunan Apbn:Petunjuk teknis tata laksana keterpaduan kegiatan dan pengelolaan anggaran', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(325, 'PR.470', 'PERENCANAAN', 'Penyusunan Apbn:Target penerimaan negara bukan pajak', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(326, 'PR.510', 'PERENCANAAN', 'Penyusunan Standar Harga Monitoring Program:Pedoman pengumpulan dan pengolahan data standar harga', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(327, 'PR.520', 'PERENCANAAN', 'Penyusunan Standar Harga Monitoring Program:Pedoman teknis monitoring program dan kegiatan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(328, 'PR.530', 'PERENCANAAN', 'Penyusunan Standar Harga Monitoring Program:Pedoman teknis evaluasi dan pelaporan program', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(329, 'PR.611', 'PERENCANAAN', 'Laporan:Laporan khusus:Pemantau prioritas', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(330, 'PR.612', 'PERENCANAAN', 'Laporan:Laporan khusus:Laporan pelaksanaan kegiatan atas permintaan eksternal', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(331, 'PR.613', 'PERENCANAAN', 'Laporan:Laporan khusus:Laporan atas pelaksanaan kegiatan/program tertentu', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(332, 'PR.614', 'PERENCANAAN', 'Laporan:Laporan khusus:Rapat dengar pendapat dengan DPR RI', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(333, 'PR.620', 'PERENCANAAN', 'Laporan:Laporan progress report', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(334, 'PR.630', 'PERENCANAAN', 'Laporan:Laporan akuntabilitas kinerja instansi pemerintah (LAKIP)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(335, 'PR.640', 'PERENCANAAN', 'Laporan:Laporan berkala (harian,mingguan,triwulanan,semesteran,tahunan)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(336, 'PR.710', 'PERENCANAAN', 'Evaluasi Program:Evaluasi program unit kerja', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(337, 'PR.720', 'PERENCANAAN', 'Evaluasi Program:Evaluasi program lembaga/instansi', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03');
INSERT INTO `kode_arsips` (`id`, `kode`, `group`, `detail`, `tata_naskah_id`, `created_at`, `updated_at`) VALUES
(338, 'HK.010', 'HUKUM', 'Program Legilasi:Bahan/materi program legilasi nasional dan instansi', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(339, 'HK.020', 'HUKUM', 'Program Legilasi:Program legilasi lembaga/instansi', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(340, 'HK.100', 'HUKUM', 'Program Legilasi:PERATURAN PIMPINAN LEMBAGA/INSTANSI', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(341, 'HK.110', 'HUKUM', 'Peraturan Pimpinan Lembaga/Instansi:Peraturan kepala BPS', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(342, 'HK.200', 'HUKUM', 'Keputusan/Ketetapan Pimpinan Lembaga/Instansi:Keputusan/Ketetapan Pimpinan Lembaga/Instansi Termasuk  Telaah Hukum', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(343, 'HK.310', 'HUKUM', 'Instruksi Surat Edaran:Istruksi/surat edaran kepala BPS', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(344, 'HK.320', 'HUKUM', 'Instruksi Surat Edaran:Instruksi/Surat edaran pejabat tinggi madya dan pejabat tinggi pratama', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(345, 'HK.410', 'HUKUM', 'Surat Perintah:Surat perintah kepala BPS', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(346, 'HK.420', 'HUKUM', 'Surat Perintah:Surat perintah pejabat madya', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(347, 'HK.430', 'HUKUM', 'Surat Perintah:Surat perintah pejabat pratama', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(348, 'HK.500', 'HUKUM', 'Pedoman', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(349, 'HK.610', 'HUKUM', 'Nota Kesepahaman:Dalam negeri', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(350, 'HK.620', 'HUKUM', 'Nota Kesepahaman:Luar negeri', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(351, 'HK.700', 'HUKUM', 'Dokumentasi Hukum', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(352, 'HK.810', 'HUKUM', 'Sosialisasi/Penyuluhan/Pembinaan Hukum:Berkas yang berhubungan dengan kegiatan sosialisasi atau penyuluhan hukum', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(353, 'HK.820', 'HUKUM', 'Sosialisasi/Penyuluhan/Pembinaan Hukum:Laporan hasil pelaksanaan sosialisasi penyukuhan hukum', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(354, 'HK.900', 'HUKUM', 'Bantuan Konsultasi Hukum/Advokasi', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(355, 'HK.1011', 'HUKUM', 'Kasus/Sengketa Hukum:Pidana:Proses verbal mulai dari penyelidikan, penyidikan sampai dengan vonis', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(356, 'HK.1012', 'HUKUM', 'Kasus/Sengketa Hukum:Pidana:Berkas pembelaan dan bantuan hukum', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(357, 'HK.1013', 'HUKUM', 'Kasus/Sengketa Hukum:Pidana:Telaah hukum dan opini terbuka', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(358, 'HK.1021', 'HUKUM', 'Kasus/Sengketa Hukum:Perdata:Proses gugatan sampai dengan putusan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(359, 'HK.1022', 'HUKUM', 'Kasus/Sengketa Hukum:Perdata:Berkas pembelaan dan bantuan hukum', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(360, 'HK.1023', 'HUKUM', 'Kasus/Sengketa Hukum:Perdata:Telaah hukum dan opini hukum', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(361, 'HK.1031', 'HUKUM', 'Kasus/Sengketa Hukum:Tata Usaha Negara:Proses gugatan sampai dengan putusan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(362, 'HK.1032', 'HUKUM', 'Kasus/Sengketa Hukum:Tata Usaha Negara:Berkas pembelaan dan bantuan hukum', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(363, 'HK.1033', 'HUKUM', 'Kasus/Sengketa Hukum:Tata Usaha Negara:Telaah hukum dan opini hukum', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(364, 'HK.1041', 'HUKUM', 'Kasus/Sengketa Hukum:Arbitrase:Proses gugatan sampai dengan putusan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(365, 'HK.1042', 'HUKUM', 'Kasus/Sengketa Hukum:Arbitrase:Berkas pembelaan dan bantuan hukum', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(366, 'HK.1043', 'HUKUM', 'Kasus/Sengketa Hukum:Arbitrase:Telaah hukum dan opini hukum', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(367, 'OT .010', 'ORGANISASI DAN TATA LAKSANA', 'Kasus/Sengketa Hukum:Pembentukan organisasi', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(368, 'OT .020', 'ORGANISASI DAN TATA LAKSANA', 'Kasus/Sengketa Hukum:Pengubahan organisasi', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(369, 'OT .030', 'ORGANISASI DAN TATA LAKSANA', 'Kasus/Sengketa Hukum:Pembubaran organisasi', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(370, 'OT .040', 'ORGANISASI DAN TATA LAKSANA', 'Kasus/Sengketa Hukum:Evaluasi kelembagaan:Naskah yang berkaitan dengan penilaian dan penyempurnaan organisasi', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(371, 'OT .050', 'ORGANISASI DAN TATA LAKSANA', 'Kasus/Sengketa Hukum:Uraian Jabatan  klasifikasi kepegawaian/pekerjaan,penelitian,jabatan dan analisa jabatan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(372, 'OT .110', 'ORGANISASI DAN TATA LAKSANA', 'Tata Laksana:Standar kompetensi Jabatan Struktual dan fungsional', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(373, 'OT .120', 'ORGANISASI DAN TATA LAKSANA', 'Penyusunan tata hubungan kerja baik intern maupun ekstern BPS', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(374, 'OT .130', 'ORGANISASI DAN TATA LAKSANA', 'Sistem dan Prosedur berkenaan dengan masalah penelahan tata cara dan metode kegiatan dibidang perstatistikan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(375, 'HM.010', 'HUBUNGAN MASYARAKAT', 'Keprotokolan:Penyelenggarakan acara kedinasan (Upacara,pelantikan,peresmian dan jamuan, peringatan hari-hari besar)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(376, 'HM.020', 'HUBUNGAN MASYARAKAT', 'Keprotokolan:Agenda kegiatan pimpinan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(377, 'HM.031', 'HUBUNGAN MASYARAKAT', 'Keprotokolan:Kunjungan dinas dalam dan luar negeri', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(378, 'HM.032', 'HUBUNGAN MASYARAKAT', 'Keprotokolan:Kunjungan dinas pimpinan lembaga/instansi', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(379, 'HM.033', 'HUBUNGAN MASYARAKAT', 'Keprotokolan:Kunjungan dinas pejabat lembaga/instansi', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(380, 'HM.040', 'HUBUNGAN MASYARAKAT', 'Keprotokolan:Kunjungan Dinas:Buku tamu', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(381, 'HM.050', 'HUBUNGAN MASYARAKAT', 'Keprotokolan:Kunjungan Dinas:daftar nama/alamat kantor/pejabat', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(382, 'HM.100', 'HUBUNGAN MASYARAKAT', 'Liputan Media Massa', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(383, 'HM.210', 'HUBUNGAN MASYARAKAT', 'Penyajian Informasi Kelembagaan :Kliping koran', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(384, 'HM.220', 'HUBUNGAN MASYARAKAT', 'Penyajian Informasi Kelembagaan :Penerbitan majalah,buletin,koran dan jurnal', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(385, 'HM.230', 'HUBUNGAN MASYARAKAT', 'Penyajian Informasi Kelembagaan :Brosur/leaflet/poster/plakat', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(386, 'HM.240', 'HUBUNGAN MASYARAKAT', 'Penyajian Informasi Kelembagaan :Pengumuman/pemberitaan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(387, 'HM.310', 'HUBUNGAN MASYARAKAT', 'Hubungan Antar Lembaga:Hubungan antar lembaga pemerintah', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(388, 'HM.320', 'HUBUNGAN MASYARAKAT', 'Hubungan Antar Lembaga:Hubungan dengan organisasi sosial/LSM', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(389, 'HM.330', 'HUBUNGAN MASYARAKAT', 'Hubungan Antar Lembaga:Hubungan dengan perusahaan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(390, 'HM.340', 'HUBUNGAN MASYARAKAT', 'Hubungan Antar Lembaga:Hubungan dengan peguruan tinggi/sekolah magang,pendidikan sistem ganga, praktek kerja lapangan (PKL)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(391, 'HM.350', 'HUBUNGAN MASYARAKAT', 'Hubungan Antar Lembaga:Forum Kehumasan (Bakohumas/Perhumas)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(392, 'HM.360', 'HUBUNGAN MASYARAKAT', 'Hubungan Antar Lembaga:Hubungan dengan media massa', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(393, 'HM.360', 'HUBUNGAN MASYARAKAT', 'Hubungan Antar Lembaga:Siaran pers/konferensi pers/pers realease', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(394, 'HM.360', 'HUBUNGAN MASYARAKAT', 'Hubungan Antar Lembaga:Kunjungan wartawan/peliputan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(395, 'HM.360', 'HUBUNGAN MASYARAKAT', 'Hubungan Antar Lembaga:Wawanacara', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(396, 'HM.400', 'HUBUNGAN MASYARAKAT', 'Dengar Pendapat/Hearing Dpr', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(397, 'HM.500', 'HUBUNGAN MASYARAKAT', 'Penyiapan Bahan Materi Pimpinan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(398, 'HM.600', 'HUBUNGAN MASYARAKAT', 'Publikasi Melalui Media Cetak Maupun Elektronik', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(399, 'HM.700', 'HUBUNGAN MASYARAKAT', 'Pameran/Sayembara/Lomba/Festival,Pembuatan Spanduk Dan Iklan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(400, 'HM.800', 'HUBUNGAN MASYARAKAT', 'Penghargaan/Kenang-Kenagan/Cindera Mata', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(401, 'HM.900', 'HUBUNGAN MASYARAKAT', 'Ucapan Terima Kasih,Ucapan Selamat,Bela Sungkawa,Permohonan Maaf', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(402, 'KA.010', 'KEARSIPAN', 'Pencetakan:Penyiapan pembuatan buku kerja dan kalender BPS,', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(403, 'KA.020', 'KEARSIPAN', 'Pencetakan:Penerimaan permintaan mencetak dan naskah yang akan dicetak', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(404, 'KA.030', 'KEARSIPAN', 'Pencetakan:Menyusunan perencanaaan cetak', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(405, 'KA.040', 'KEARSIPAN', 'Pencetakan:Pencetakan naskah,surat,dokumen secara digital dan risograph', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(406, 'KA.110', 'KEARSIPAN', 'Pengurusan Surat:Surat masuk/surat keluar', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(407, 'KA.120', 'KEARSIPAN', 'Pengurusan Surat:Penggunaan aplikasi surat menyurat', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(408, 'KA.210', 'KEARSIPAN', 'Pengelolaan Arsip Dinamis:Penyusunan sisitem arsip', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(409, 'KA.220', 'KEARSIPAN', 'Pengelolaan Arsip Dinamis:Penciptaan dan pemberkasan arsip', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(410, 'KA.230', 'KEARSIPAN', 'Pengelolaan Arsip Dinamis:Pengelolahan data base menjadi informasi', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(411, 'KA.240', 'KEARSIPAN', 'Pengelolaan Arsip Dinamis:Alih media', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(412, 'KA.310', 'KEARSIPAN', 'Penyimpangan Dan Pemeliharaan Arsip:Daftar arsip', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(413, 'KA.320', 'KEARSIPAN', 'Penyimpangan Dan Pemeliharaan Arsip:Pemeliharan arsip dan ruang penyimpanan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(414, 'KA.330', 'KEARSIPAN', 'Penyimpangan Dan Pemeliharaan Arsip:daftar pencarian arsip', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(415, 'KA.340', 'KEARSIPAN', 'Penyimpangan Dan Pemeliharaan Arsip:daftar arsip informasi publik', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(416, 'KA.350', 'KEARSIPAN', 'Penyimpangan Dan Pemeliharaan Arsip:Daftar arsip vital/aset', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(417, 'KA.360', 'KEARSIPAN', 'Penyimpangan Dan Pemeliharaan Arsip:Layanan arsip (pemindahan,pengguna arsip)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(418, 'KA.370', 'KEARSIPAN', 'Penyimpangan Dan Pemeliharaan Arsip:Persetujuan jadwal retensi arsip', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(419, 'KA.410', 'KEARSIPAN', 'Pemindahan Arsip:Pemindahan Arsip Inaktif', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(420, 'KA.420', 'KEARSIPAN', 'Pemindahan Arsip:Daftar Arsip yang Dimusnahkan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(421, 'KA.510', 'KEARSIPAN', 'Pemusnahan Arsip Yang Tidak Bernilai Guna:Berita Acara Pemusnahan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(422, 'KA.520', 'KEARSIPAN', 'Pemusnahan Arsip Yang Tidak Bernilai Guna:Daftar Arsip yang Dimusnahkan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(423, 'KA.530', 'KEARSIPAN', 'Pemusnahan Arsip Yang Tidak Bernilai Guna:Rekomendasi/Pertimbangan/Permusnahan Arsip dari ANRI', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(424, 'KA.540', 'KEARSIPAN', 'Pemusnahan Arsip Yang Tidak Bernilai Guna:Surat Keputusan Pemusnahan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(425, 'KA.610', 'KEARSIPAN', 'Penyerahan Arsip Statis:Berita Acara Serah Terima Arsip', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(426, 'KA.620', 'KEARSIPAN', 'Penyerahan Arsip Statis:Daftar Arsip yang Diserahkan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(427, 'KA.710', 'KEARSIPAN', 'Pembinaan Kearsipan:Pembinaan Arsiparis', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(428, 'KA.720', 'KEARSIPAN', 'Pembinaan Kearsipan:Aresiasi/Sosialisasi/Penyeluruhan Kearsipan,Diklat Profesi', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(429, 'KA.730', 'KEARSIPAN', 'Pembinaan Kearsipan:Bimbingan Teknis', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(430, 'KA.740', 'KEARSIPAN', 'Pembinaan Kearsipan:Penilaian dan sertifikasi SDM kearsipan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(431, 'KA.750', 'KEARSIPAN', 'Pembinaan Kearsipan:Supervisi dan Monitoring', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(432, 'KA.760', 'KEARSIPAN', 'Pembinaan Kearsipan:penilaian Akreditasi Unit Kerja Kearsipan ', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(433, 'KA.770', 'KEARSIPAN', 'Pembinaan Kearsipan:Implementasi Pengelolaan Arsip Elektronik', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(434, 'KA.780', 'KEARSIPAN', 'Pembinaan Kearsipan:Penghargaan Kearsipan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(435, 'KA.790', 'KEARSIPAN', 'Pembinaan Kearsipan:Pengawasan Kearsipan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(436, 'RT.000', 'KERUMAHTANGGAAN', 'Administrasi Langganan: Telekomunikasitelepon,radio, TV kabel dan internet', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(437, 'RT.100', 'KERUMAHTANGGAAN', 'Administrasi Penggunaan Fasilitas Kantor', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(438, 'RT.210', 'KERUMAHTANGGAAN', 'Pengurusan Kendaraan Dinas:Pengurusan Surat kendaraan Dinas', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(439, 'RT.220', 'KERUMAHTANGGAAN', 'Pengurusan Kendaraan Dinas:Pemeliharaan dan Perbaikan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(440, 'RT.230', 'KERUMAHTANGGAAN', 'Pengurusan Kendaraan Dinas:Pengurusan Kehilangan dan Masalah Kendaraan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(441, 'RT.310', 'KERUMAHTANGGAAN', 'Pemeliharaan Gedung Dan Taman:Pertamanan/Lanscaping', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(442, 'RT.320', 'KERUMAHTANGGAAN', 'Pemeliharaan Gedung Dan Taman:Penghijauan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(443, 'RT.330', 'KERUMAHTANGGAAN', 'Pemeliharaan Gedung Dan Taman:Perbaiki Gedung', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(444, 'RT.340', 'KERUMAHTANGGAAN', 'Pemeliharaan Gedung Dan Taman:Perbaiki Rumah Dinas/Wisma', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(445, 'RT.350', 'KERUMAHTANGGAAN', 'Pemeliharaan Gedung Dan Taman:Kebersihan Gedung dan Taman', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(446, 'RT.410', 'KERUMAHTANGGAAN', 'Pengelolaan Jaringan Listrik,Air,Telepon,Dan Komputer:Perbaikan/Pemeliharaan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(447, 'RT.420', 'KERUMAHTANGGAAN', 'Pengelolaan Jaringan Listrik,Air,Telepon,Dan Komputer:Pemasangan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(448, 'RT.511', 'KERUMAHTANGGAAN', 'Ketertiban Dan Keamanan:Pengamanan:Daftar Nama Satuan Pengamanan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(449, 'RT.512', 'KERUMAHTANGGAAN', 'Ketertiban Dan Keamanan:Pengamanan:Daftar Jaga/Daftar Piket', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(450, 'RT.513', 'KERUMAHTANGGAAN', 'Ketertiban Dan Keamanan:Pengamanan:Surat Ijin Keluar Masuk Orang atau Barang', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(451, 'RT.521', 'KERUMAHTANGGAAN', 'Laporan Ketertiban Dan Keamanan:Kehilangan,kerusakan,kecelakaan,gangguan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(452, 'RT.600', 'KERUMAHTANGGAAN', 'Administrasi Pengelolaan Parkir', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(453, 'PL.010', 'PERLENGKAPAN', 'Rencana Kebutuhan Barang Dan Jasa:Usulan Unit Kerja', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(454, 'PL.020', 'PERLENGKAPAN', 'Rencana Kebutuhan Barang Dan Jasa:Rencana Kebutuhan Lembaga Pusat/Daerah', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(455, 'PL.100', 'PERLENGKAPAN', 'Berkas Perkenalan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(456, 'PL.210', 'PERLENGKAPAN', 'Pengadaan Barang:Pengadaan/pembelian barang tidak melalui lelang(pengadaan langsung) ', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(457, 'PL.220', 'PERLENGKAPAN', 'Pengadaan Barang:Pengadaan/pembelian barang melalui lelang', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(458, 'PL.230', 'PERLENGKAPAN', 'Pengadaan Barang:Perolehan barang melalui bantuan/hibah', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(459, 'PL.240', 'PERLENGKAPAN', 'Pengadaan Barang:Pengadaan barang melalui tukar menukar', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(460, 'PL.250', 'PERLENGKAPAN', 'Pengadaan Barang:Pemanfaatan barang melalui pinjam pakai', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(461, 'PL.260', 'PERLENGKAPAN', 'Pengadaan Barang:Pemanfaatan barang melalui sewa', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(462, 'PL.270', 'PERLENGKAPAN', 'Pengadaan Barang:Pemanfaatan barang melalui kerjasama pemanfaatan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(463, 'PL.280', 'PERLENGKAPAN', 'Pengadaan Barang:Pemanfaatan barang melalui bangun serah guna/bangun serah guna', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(464, 'PL.300', 'PERLENGKAPAN', 'Berkas Pengadaan Jasa Oleh Pihak Ketiga Terdiri Dari Berkas Penawaran Sampai Dengan Kontrak', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(465, 'PL.400', 'PERLENGKAPAN', 'Laporan Kemajuan Pelaksanaan Belanja Modal', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(466, 'PL.021', 'PERLENGKAPAN', 'Inventarisasi:Inventarisasi Ruangan/Gedung/Bangunan:Daftar Opname Fisik Barang Inventaris(DOFBI)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(467, 'PL.022', 'PERLENGKAPAN', 'Inventarisasi:Inventarisasi Ruangan/Gedung/Bangunan:Daftar Inventaris Barang(DIB)', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(468, 'PL.023', 'PERLENGKAPAN', 'Inventarisasi:Inventarisasi Ruangan/Gedung/Bangunan:Daftar Kartu Inventaris Barang', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(469, 'PL.024', 'PERLENGKAPAN', 'Inventarisasi:Inventarisasi Ruangan/Gedung/Bangunan:Buku Inventaris/pembantu Inventaris Barang', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(470, 'PL.530', 'PERLENGKAPAN', 'Inventarisasi:Penyusunan Laporan Tahunan Inventaris BMN', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(471, 'PL.540', 'PERLENGKAPAN', 'Inventarisasi:Sensus BMN', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(472, 'PL.611', 'PERLENGKAPAN', 'Penyimpanan:Penatausahaan Penyimpanan Barang/Publikasi :Tanda terima/surat pengantar/surat pengiriman barang', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(473, 'PL.612', 'PERLENGKAPAN', 'Penyimpanan:Penatausahaan Penyimpanan Barang/Publikasi :Surat pernyataan harga  dan mutu barang', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(474, 'PL.613', 'PERLENGKAPAN', 'Penyimpanan:Penatausahaan Penyimpanan Barang/Publikasi :Berita acara serah terima barang hasil pengadaan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(475, 'PL.614', 'PERLENGKAPAN', 'Penyimpanan:Penatausahaan Penyimpanan Barang/Publikasi :Buku penerimaan', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(476, 'PL.615', 'PERLENGKAPAN', 'Penyimpanan:Penatausahaan Penyimpanan Barang/Publikasi :Buku persediaan barang/kartu stock barang', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(477, 'PL.616', 'PERLENGKAPAN', 'Penyimpanan:Penatausahaan Penyimpanan Barang/Publikasi :Kartu barang/kartu gudang', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(478, 'PL.620', 'PERLENGKAPAN', 'Penyimpanan:Penyusunan laporan persediaan barang', 1, '2024-10-12 17:47:03', '2024-10-12 17:47:03'),
(479, 'PL.711', 'PERLENGKAPAN', 'Penyaluran:Penatausahaan penyaluran barang/publikasi:Surat permintaan dari unit kerja/formulir permintaan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(480, 'PL.712', 'PERLENGKAPAN', 'Penyaluran:Penatausahaan penyaluran barang/publikasi:Surat perintah mengeluarkan barang (SPMB)', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(481, 'PL.713', 'PERLENGKAPAN', 'Penyaluran:Penatausahaan penyaluran barang/publikasi:Surat perintah mengeluarkan barang inventaris', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(482, 'PL.714', 'PERLENGKAPAN', 'Penyaluran:Penatausahaan penyaluran barang/publikasi:Berita acara serah terima distribusi barang', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(483, 'PL.810', 'PERLENGKAPAN', 'Penghapusan Bmn:Penghapusan barang bergerak/barang inventaris kantor', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(484, 'PL.900', 'PERLENGKAPAN', 'Bukti-Bukti Kepemilikan Dan Kelengkapan Bmn', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(485, 'DL.010', 'PENDIDIKAN DAN LATIHAN', 'Perencanaan Diklat:Analisa kebutuhan penyelenggaraan diklat', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(486, 'DL.020', 'PENDIDIKAN DAN LATIHAN', 'Perencanaan Diklat:Sistem dan metode', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(487, 'DL.030', 'PENDIDIKAN DAN LATIHAN', 'Perencanaan Diklat:kurikulim', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(488, 'DL.040', 'PENDIDIKAN DAN LATIHAN', 'Perencanaan Diklat:Bahan ajar/modul', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(489, 'DL.050', 'PENDIDIKAN DAN LATIHAN', 'Perencanaan Diklat:Konsultasi penyelenggaraan diklat', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(490, 'DL.110', 'PENDIDIKAN DAN LATIHAN', 'Akreditasi Lembaga Diklat:Surat permohonan akreditasi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(491, 'DL.120', 'PENDIDIKAN DAN LATIHAN', 'Akreditasi Lembaga Diklat:laporan hasil verifikasi lapangan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(492, 'DL.130', 'PENDIDIKAN DAN LATIHAN', 'Akreditasi Lembaga Diklat:Berita acara rapat verifikasi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(493, 'DL.140', 'PENDIDIKAN DAN LATIHAN', 'Akreditasi Lembaga Diklat:Berita acara raoat tim penilai', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(494, 'DL.150', 'PENDIDIKAN DAN LATIHAN', 'Akreditasi Lembaga Diklat:Surat keputusan penetapan akreditasi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(495, 'DL.160', 'PENDIDIKAN DAN LATIHAN', 'Akreditasi Lembaga Diklat:Surat akreditasi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(496, 'DL.170', 'PENDIDIKAN DAN LATIHAN', 'Akreditasi Lembaga Diklat:Laporan akreditasi lembaga diklat', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(497, 'DL.210', 'PENDIDIKAN DAN LATIHAN', 'Penyelenggarakan Diklat:Prajabatan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(498, 'DL.220', 'PENDIDIKAN DAN LATIHAN', 'Penyelenggarakan Diklat:Kepemimpinan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(499, 'DL.230', 'PENDIDIKAN DAN LATIHAN', 'Penyelenggarakan Diklat:Teknis', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(500, 'DL.240', 'PENDIDIKAN DAN LATIHAN', 'Penyelenggarakan Diklat:Fungsional', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(501, 'DL.250', 'PENDIDIKAN DAN LATIHAN', 'Penyelenggarakan Diklat:Evaluasi pasca diklat', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(502, 'DL.300', 'PENDIDIKAN DAN LATIHAN', 'Sertifikat Sumberdaya Manusia Kediklatan:Naskah-naskah yang berkaitan dengan kegiatan sertifikat sumberdaya kediklatan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(503, 'DL.410', 'PENDIDIKAN DAN LATIHAN', 'Sistem Informasi Diklat:Data lembaga diklat', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(504, 'DL.420', 'PENDIDIKAN DAN LATIHAN', 'Sistem Informasi Diklat:Data prasarana diklat', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(505, 'DL.430', 'PENDIDIKAN DAN LATIHAN', 'Sistem Informasi Diklat:Data sarana diklat', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(506, 'DL.440', 'PENDIDIKAN DAN LATIHAN', 'Sistem Informasi Diklat:Data pengelola diklat', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(507, 'DL.450', 'PENDIDIKAN DAN LATIHAN', 'Sistem Informasi Diklat:Data penyelenggara diklat', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(508, 'DL.460', 'PENDIDIKAN DAN LATIHAN', 'Sistem Informasi Diklat:Data widyaiswara', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(509, 'DL.470', 'PENDIDIKAN DAN LATIHAN', 'Sistem Informasi Diklat:Data program diklat', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(510, 'DL.510', 'PENDIDIKAN DAN LATIHAN', 'Registrasi Sertifikat/Sttpl Peserta Diklat:Surat permohonan kode registrasi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(511, 'DL.520', 'PENDIDIKAN DAN LATIHAN', 'Registrasi Sertifikat/Sttpl Peserta Diklat:Buku Registrasi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(512, 'DL.530', 'PENDIDIKAN DAN LATIHAN', 'Registrasi Sertifikat/Sttpl Peserta Diklat:Surat penyampaian kode registrasi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(513, 'DL.610', 'PENDIDIKAN DAN LATIHAN', 'Evaluasi Penyelenggaraan Diklat:Evaluasi materi penyenggaraan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(514, 'DL.620', 'PENDIDIKAN DAN LATIHAN', 'Evaluasi Penyelenggaraan Diklat:Evaluasi pengajar/instruktur/fasilitator', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(515, 'DL.630', 'PENDIDIKAN DAN LATIHAN', 'Evaluasi Penyelenggaraan Diklat:Evaluasi peserta', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(516, 'DL.640', 'PENDIDIKAN DAN LATIHAN', 'Evaluasi Penyelenggaraan Diklat:Evaluasi sarana dan prasarana', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(517, 'DL.650', 'PENDIDIKAN DAN LATIHAN', 'Evaluasi Penyelenggaraan Diklat:Evaluasi alumni peserta', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(518, 'DL.660', 'PENDIDIKAN DAN LATIHAN', 'Evaluasi Penyelenggaraan Diklat:Laporan penyelenggaran', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(519, 'DL.670', 'PENDIDIKAN DAN LATIHAN', 'Evaluasi Penyelenggaraan Diklat:Evaluasi alumni diklat', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(520, 'PK.010', 'KEPUTUSAN', 'Penyimpanan Deposit Bahan Pustaka:Bukti penerimaan koleksi bahan pustaka deposit', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(521, 'PK.020', 'KEPUTUSAN', 'Penyimpanan Deposit Bahan Pustaka:Administrasi pengelohan deposit bahan pustaka', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(522, 'PK.110', 'KEPUTUSAN', 'Pengadaan Bahan Pustaka:Buku induk koleksi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(523, 'PK.120', 'KEPUTUSAN', 'Pengadaan Bahan Pustaka:daftar buku terseleksi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(524, 'PK.130', 'KEPUTUSAN', 'Pengadaan Bahan Pustaka:daftar buku dalam pemesanan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(525, 'PK.140', 'KEPUTUSAN', 'Pengadaan Bahan Pustaka:Daftar buku dalam permintaan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(526, 'PK.210', 'KEPUTUSAN', 'Pengolahan Bahan Pustaka:Lembar kerja pengelohan bahan pustaka (buram pengkatalogan)', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(527, 'PK.220', 'KEPUTUSAN', 'Pengolahan Bahan Pustaka:Shell list/jajaran kartu utama (master list)', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(528, 'PK.230', 'KEPUTUSAN', 'Pengolahan Bahan Pustaka:Daftar tambahan buku (assesion list)', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(529, 'PK.240', 'KEPUTUSAN', 'Pengolahan Bahan Pustaka:Daftar/jajaran kemdali (subjek dan pengarang)', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(530, 'PK.310', 'KEPUTUSAN', 'Layanan Jasa Perpustakaan Dan Informasi:Data dan statistik anggota, pengunjung dan peminjaman bahan pustaka', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(531, 'PK.320', 'KEPUTUSAN', 'Layanan Jasa Perpustakaan Dan Informasi:Pertanyaan,rujukan dan jawaban', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(532, 'PK.410', 'KEPUTUSAN', 'Preservasi Bahan Pustaka:Survei kondisi bahan pustaka', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(533, 'PK.420', 'KEPUTUSAN', 'Preservasi Bahan Pustaka:Reprografi bahan pustaka', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(534, 'PK.510', 'KEPUTUSAN', 'Pembinaan Perpustakaan:Bimbingan teknis', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(535, 'PK.520', 'KEPUTUSAN', 'Pembinaan Perpustakaan:Penyuluhan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(536, 'PK.530', 'KEPUTUSAN', 'Pembinaan Perpustakaan:Sosialisasi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(537, 'IF.000', 'INFORMATIKA', 'Rencana Strategis Masterplan Pembangunan Sistem Informasi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(538, 'IF.110', 'INFORMATIKA', 'Dokumentasi Arsitektur:Sistem informasi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(539, 'IF.120', 'INFORMATIKA', 'Dokumentasi Arsitektur:Sistem apliaksi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(540, 'IF.130', 'INFORMATIKA', 'Dokumentasi Arsitektur:Infrastruktur', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(541, 'IF.210', 'INFORMATIKA', 'Perekaman Dan Pemutakhiran Data:Formulir isian', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(542, 'IF.220', 'INFORMATIKA', 'Perekaman Dan Pemutakhiran Data:Daftar petugas perekaman', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(543, 'IF.230', 'INFORMATIKA', 'Perekaman Dan Pemutakhiran Data:Jadwal pelaksanaan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(544, 'IF.240', 'INFORMATIKA', 'Perekaman Dan Pemutakhiran Data:Laporan hasil perekaman dan pemutakhiran data', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(545, 'IF.300', 'INFORMATIKA', 'Migrasi Sistem Apliaksi Data', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(546, 'IF.410', 'INFORMATIKA', 'Dokumen Hosting:Formulir permintaan hosting', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(547, 'IF.420', 'INFORMATIKA', 'Dokumen Hosting:Layanan hasil uji kelayakan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(548, 'IF.430', 'INFORMATIKA', 'Dokumen Hosting:Laporan pelaksanaan hosting', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(549, 'IF.500', 'INFORMATIKA', 'Layanan Back-Up Data Digital', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(550, 'PW.010', 'PENGAWASAN', 'Rencana Pengawasan:Rencana strategis pengawasan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(551, 'PW.020', 'PENGAWASAN', 'Rencana Pengawasan:Rencana kerja tahunan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(552, 'PW.030', 'PENGAWASAN', 'Rencana Pengawasan:Rencana kinerja tahunan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(553, 'PW.040', 'PENGAWASAN', 'Rencana Pengawasan:Penetepan kinerja tahunan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(554, 'PW.050', 'PENGAWASAN', 'Rencana Pengawasan:Rakor pengawasan tingkat nasional', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(555, 'PW.110', 'PENGAWASAN', 'Pelaksanaan Pengawasan:Naskah-naskah yang berkaitan dengan audit mulai dari surat penugasan sampai dengan surat menyurat', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(556, 'PW.120', 'PENGAWASAN', 'Laporan hasil audit (LHA), hasil pemeriksaan operasional(LHPO),Hasil evaluasi(LHE),Akuntan (LA), Auditor indendent (LAI) ', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(557, 'PW.130', 'PENGAWASAN', 'Laporan hasil audit investigasi (LHAI), Hasil pemeriksaan operasional(LHPO), Hasil evaluasi (LHE), Aakuntan (LA),Auditor independent (LAI)', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(558, 'PW.140', 'PENGAWASAN', 'Pelaksanaan Pengawasan:Laporan perkembangan penanganan surat pengaduan masyarakat', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(559, 'PW.150', 'PENGAWASAN', 'Pelaksanaan Pengawasan:Laporan pemutakhiran data', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(560, 'PW.160', 'PENGAWASAN', 'Pelaksanaan Pengawasan:Laporan perkembangan BMN', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(561, 'PW.170', 'PENGAWASAN', 'Pelaksanaan Pengawasan:Laporan kegiatan pendampingan penyusunan laporan keuangan dan reviu departmen/LPND', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(562, 'PW.180', 'PENGAWASAN', 'Pelaksanaan Pengawasan:Good corporate governance (GCG)', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(563, 'TS.010', 'TRANSFORMASI STATISTIK', 'Penyusunan Rencana Kegiatan:Transformasi proses bisnis statistik', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(564, 'TS.020', 'TRANSFORMASI STATISTIK', 'Penyusunan Rencana Kegiatan Bidang Transformasi Statistik (Tor):Transformasi TIK dan Komunikasi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(565, 'TS.030', 'TRANSFORMASI STATISTIK', 'Penyusunan Rencana Kegiatan:Transformasi manajemen sumberdaya manusia dan kelembagaan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(566, 'TS.110', 'TRANSFORMASI STATISTIK', 'Penyusunan Bahan:Rencana Sarana dan Prasarana Transformasi Statistik', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(567, 'TS.120', 'TRANSFORMASI STATISTIK', 'Penyusunan Bahan:Statistical Business Frame Work and Architecture (SBFA)', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(568, 'TS.130', 'TRANSFORMASI STATISTIK', 'Penyusunan Bahan Terkait Transformasi Statistik:Analysis Document', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(569, 'TS.140', 'TRANSFORMASI STATISTIK', 'Penyusunan Bahan Terkait Transformasi Statistik:CSI', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(570, 'TS.150', 'TRANSFORMASI STATISTIK', 'Penyusunan Bahan Terkait Transformasi Statistik:BPR', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(571, 'TS.160', 'TRANSFORMASI STATISTIK', 'Penyusunan Bahan:Sosialisasi, internalisasi, workshop terkait kegiatan transformasi', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(572, 'TS.170', 'TRANSFORMASI STATISTIK', 'Penyusunan Bahan Terkait Transformasi Statistik:Deliverables', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(573, 'TS.210', 'TRANSFORMASI STATISTIK', 'Manajemen Perubahan:Steering Committee (Dewan Pengarah)', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(574, 'TS.220', 'TRANSFORMASI STATISTIK', 'Manajemen Perubahan:Change Agent', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(575, 'TS.230', 'TRANSFORMASI STATISTIK', 'Manajemen Perubahan:Change Leader', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(576, 'TS.240', 'TRANSFORMASI STATISTIK', 'Manajemen Perubahan:Change Champion', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(577, 'TS.250', 'TRANSFORMASI STATISTIK', 'Manajemen Perubahan:Working Group', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(578, 'TS.260', 'TRANSFORMASI STATISTIK', 'Manajemen Perubahan:Evaluasi dan Monitoring Perkembangan Program STATCAP CERDAS', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(579, 'TS.270', 'TRANSFORMASI STATISTIK', 'Manajemen Perubahan:Sosialisasi, Internalisasi, Workshop, Kick of Meeting', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(580, 'TS.310', 'TRANSFORMASI STATISTIK', 'Keterpaduan Transformasi:Mendukung Implementasi TransformasiCAPI SAKERNAS, Continous Survey', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(581, 'TS.410', 'TRANSFORMASI STATISTIK', 'Laporan Transformasi Statistik:Laporan Kemajuan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(582, 'TS.420', 'TRANSFORMASI STATISTIK', 'Laporan Transformasi Statistik:Laporan Bulanan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(583, 'TS.430', 'TRANSFORMASI STATISTIK', 'Laporan Transformasi Statistik:Laporan Triwulan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04'),
(584, 'TS.440', 'TRANSFORMASI STATISTIK', 'Laporan Transformasi Statistik:Laporan Tahunan', 1, '2024-10-12 17:47:04', '2024-10-12 17:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `kode_naskahs`
--

CREATE TABLE `kode_naskahs` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tata_naskah_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kode_naskahs`
--

INSERT INTO `kode_naskahs` (`id`, `kategori`, `format`, `tata_naskah_id`, `created_at`, `updated_at`) VALUES
(1, 'Naskah Dinas Pengaturan', '<no_urut> TAHUN <tahun>', 1, '2024-08-06 07:10:43', '2024-09-03 21:06:52'),
(2, 'Naskah Dinas Penetapan', '<no_urut> TAHUN <tahun>', 1, '2024-08-08 01:58:06', '2024-09-03 21:05:05'),
(3, 'Surat Dinas', '<derajat>-<no_urut>/<kode_unit_kerja>/<kode_arsip>/<tahun>', 1, '2024-08-08 02:03:05', '2024-09-03 21:08:00'),
(4, 'Memo dan Nota Dinas', '<no_urut>/<kode_unit_kerja>/<kode_arsip>/<tahun>', 1, '2024-08-08 02:04:08', '2024-09-03 21:08:36'),
(5, 'Naskah Dinas Khusus', '<no_urut>/<tahun>', 1, '2024-08-08 02:25:52', '2024-09-03 21:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `kontrak_mitras`
--

CREATE TABLE `kontrak_mitras` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis_honor` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kontrak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `awal_kontrak` date DEFAULT NULL,
  `akhir_kontrak` date DEFAULT NULL,
  `tanggal_spk` date DEFAULT NULL,
  `bulan` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kontrak_id` mediumint UNSIGNED DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ppk_user_id` mediumint UNSIGNED DEFAULT NULL,
  `kode_arsip_id` mediumint UNSIGNED DEFAULT NULL,
  `honor_kegiatan_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kontrak_mitras`
--

INSERT INTO `kontrak_mitras` (`id`, `jenis_honor`, `nama_kontrak`, `awal_kontrak`, `akhir_kontrak`, `tanggal_spk`, `bulan`, `tahun`, `jenis_kontrak_id`, `status`, `ppk_user_id`, `kode_arsip_id`, `honor_kegiatan_id`, `created_at`, `updated_at`) VALUES
(8, 'Kontrak Mitra Bulanan', 'Kontrak Pendataan Bulan Desember', '2024-12-01', '2024-12-31', '2024-11-03', '12', '2024', 1, 'digenerate', 13, 29, NULL, '2024-11-03 07:02:15', '2024-11-03 07:42:40'),
(9, 'Kontrak Mitra Bulanan', 'Kontrak Pengo;ahan Bulan Desember', '2024-12-01', '2024-12-31', NULL, '12', '2024', 2, 'dibuat', NULL, NULL, NULL, '2024-11-10 11:27:18', '2024-11-10 11:27:18');

-- --------------------------------------------------------

--
-- Table structure for table `master_persediaans`
--

CREATE TABLE `master_persediaans` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_persediaans`
--

INSERT INTO `master_persediaans` (`id`, `kode`, `barang`, `satuan`, `created_at`, `updated_at`) VALUES
(1, '1010301001000005', 'Trigonal Clips Besar', 'Kotak', '2024-11-03 08:43:39', '2024-11-03 11:14:08'),
(2, '1010301001000006', 'Binder Clips 107', 'Dozz', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(3, '1010301001000007', 'Binder Clips 111', 'Dozz', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(4, '1010301001000008', 'Binder Clips 155', 'Dozz', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(5, '1010301001000009', 'Binder Clips 200', 'Dozz', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(6, '1010301001000010', 'Amplop Putih Plester', 'Kotak', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(7, '1010301001000011', 'Amplop Putih Kecil', 'Kotak', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(8, '1010301001000012', 'Amplop Cokelat Kabinet', 'Kotak', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(9, '1010301001000014', 'Amplop Cokelat Folio', 'Kotak', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(10, '1010301001000015', 'Amplop Cokelat Ekstra Folio', 'Kotak', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(11, '1010301001000016', 'Amplop Logo BPS', 'Kotak', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(12, '1010301001000017', 'Spidol Whiteboard', 'Buah', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(13, '1010301001000018', 'Stabillo Boss', 'buah', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(14, '1010301001000019', 'Correct Pen (TipEx)', 'buah', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(15, '1010301001000020', 'Stapless Besar', 'buah', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(16, '1010301001000021', 'Stapless Kecil', 'buah', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(17, '1010301001000022', 'Isi Staples Besar', 'kotak', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(18, '1010301001000023', 'Isi Staples Kecil', 'kotak', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(19, '1010301001000024', 'Cutter Besar', 'buah', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(20, '1010301001000025', 'Snelhecter Plastik', 'buah', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(21, '1010301001000026', 'Snelhecter Folio', 'buah', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(22, '1010301001000027', 'Stopmap Folio', 'buah', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(23, '1010301001000029', 'Pembuka Staples', 'buah', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(24, '1010301001000030', 'Buku Tulis', 'buah', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(25, '1010301001000031', 'Lakban Cokelat', 'buah', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(26, '1010301001000032', 'Lakban Hitam Besar', 'buah', '2024-11-03 11:14:08', '2024-11-03 11:14:08'),
(27, '1010301001000033', 'Lakban Hitam Tanggung', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(28, '1010301001000034', 'Lakban Transparan', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(29, '1010301001000035', 'Ballpoint', 'lusin', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(30, '1010301001000036', 'Papper Punch Besar', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(31, '1010301001000037', 'Papper Punch Kecil', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(32, '1010301001000039', 'Kertas Karbon', 'kotak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(33, '1010301001000040', 'Buku Ekspedisi', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(34, '1010301001000042', 'Isolasi Tranparan', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(35, '1010301001000043', 'Lem Glue Stick', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(36, '1010301001000044', 'Pensil 2B', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(37, '1010301001000045', 'Penggaris Besi', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(38, '1010301001000047', 'Map Plastik Jepit', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(39, '1010301001000048', 'Buku Agenda', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(40, '1010301001000049', 'Buku Kwitansi', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(41, '1010301001000050', 'Lem Kertas', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(42, '1010301001000053', 'Isi Pensil Mekanik', 'kotak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(43, '1010301001000054', 'Bak Stempel', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(44, '1010301001000055', 'Tinta Stempel', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(45, '1010301001000056', 'Spidol Marker', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(46, '1010301001000057', 'Kertas Warna Cover', 'lembar', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(47, '1010301001000060', 'Tempat Isolasi', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(48, '1010301001000061', 'Penggaris Plastik', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(49, '1010301001000062', 'Penghapus WhiteBoard', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(50, '1010301001000063', 'Gunting', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(51, '1010301001000064', 'Tali Rapia 1 Kg', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(52, '1010301001000065', 'Plastik Transparan Mika', 'lembar', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(53, '1010301001000066', 'Buku Folio Bergaris', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(54, '1010301001000067', 'Buku Tabilaris 12 kolom', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(55, '1010301001000068', 'Buku Tabilaris 18 Kolom', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(56, '1010301001000069', 'Lem Kertas Besar', 'Botol', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(57, '1010301001000104', 'Map Batik bertali', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(58, '1010301001000105', 'Binder Clips 105', 'Kotak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(59, '1010301001000106', 'Binder Clips 260', 'Kotak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(60, '1010301001000107', 'Buku Tabilaris 10 Kolom', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(61, '1010301001000108', 'Penghapus Pensil', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(62, '1010301001000109', 'Cutter Kecil', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(63, '1010301001000111', 'Paper Clip', 'Kotak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(64, '1010301001000168', 'Box File', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(65, '1010301001000172', 'Block Note', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(66, '1010301001000173', 'Name Tag', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(67, '1010301001000175', 'Spidol Boardmarker', 'Lusin', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(68, '1010301001000176', 'Buku Kas', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(69, '1010301001000177', 'Tempat Pen', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(70, '1010301001000184', 'PENSIL 2B', 'LUSIN', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(71, '1010301001000185', 'PENSIL ISI ULANG', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(72, '1010301001000186', 'ISI ULANG PENSIL', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(73, '1010301001000187', 'SPIDOL', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(74, '1010301001000189', 'PENSIL', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(75, '1010301001000190', 'Ballpoint', 'lusin', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(76, '1010301001000191', 'Pensil Graebel', 'Kotak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(77, '1010301001000192', 'Stabilo', 'Lusin', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(78, '1010301001000193', 'PEN V.5', 'Lusin', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(79, '1010301001000194', 'SPIDOL WHITE BOARD MARKER', 'LUSIN', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(80, '1010301001000195', 'SPIDOL SNOWMAN MARKER', 'LUSIN', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(81, '1010301001000196', 'PEN', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(82, '1010301001000197', 'Pensil Faber Castell', 'LS', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(83, '1010301001000199', 'PEN B Gel F2', 'Ls', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(84, '1010301001000200', 'Penghapus Faber Castell', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(85, '1010301001000201', 'Rautan Putar', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(86, '1010301001000202', 'Stabillo', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(87, '1010301001000203', 'PENSIL FC', 'Lusin', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(88, '1010301001000205', 'Pensil (IMK)', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(89, '1010301001000206', 'Ballpoint (IMK)', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(90, '1010301001000207', 'Spidol Marker (IMK)', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(91, '1010301001000208', 'Pensil (SPTK)', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(92, '1010301001000209', 'Ballpoint (SPTK)', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(93, '1010301001000211', 'Ballpoint (IMK Kab. HST)', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(94, '1010301001000212', 'KERTAS A4S', 'Box', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(95, '1010301001000214', 'Pen Mini Gel', 'Lusin', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(96, '1010301001000215', 'Staples Kenko HD - 10', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(97, '1010301001000216', 'Staples Joyko HD - 50', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(98, '1010301001000217', 'Isi Staples Etono No. 10', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(99, '1010301001000218', 'Isi Staples Etono No. 3', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(100, '1010301001000219', 'Map Busness File', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(101, '1010301001000220', 'Pensil Graebel 2B', 'Lusin', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(102, '1010301001000221', 'Bak Stempel Joyko', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(103, '1010301001000222', 'Stip Stadlear Hitam', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(104, '1010301001000223', 'Cap Stempel Kantor', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(105, '1010301001000231', 'PEN TIZO', 'LUSIN', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(106, '1010301001000232', 'Penghapus Karet SP2020', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(107, '1010301001000233', 'Pisau Peruncing SP2020', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(108, '1010301001000234', 'Pensil 2B SP2020', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(109, '1010301001000235', 'Ballpoint SP2020', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(110, '1010301001000236', 'PENSIL MEKANIK', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(111, '1010301001000239', 'PEN SNOWMAN V2', 'LUSIN', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(112, '1010301001000241', 'PULPEN SNOWMAN V5', 'LUSIN', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(113, '1010301001000242', 'PULPEN SNOWMAN V7', 'LUSIN', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(114, '1010301001000244', 'PEN TIZO GEL LINER', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(115, '1010301001000245', 'PEN MITSUBISHI BOXY 001P', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(116, '1010301001000246', 'Lem', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(117, '1010301001000247', 'Glue Stick', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(118, '1010301001000248', 'PENSIL 2B', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(119, '1010301001000251', 'PULPEN', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(120, '1010301002000001', 'Stamp Ink Color', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(121, '1010301002000002', 'Tinta Stempel', 'Botol', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(122, '1010301003000001', 'BINDER CLIPS 105', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(123, '1010301003000002', 'BINDER CLIPS 107', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(124, '1010301003000003', 'PAPER CLIPS', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(125, '1010301003000004', 'BINDER CLIPS 155', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(126, '1010301003000005', 'BINDER CLIPS 111', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(127, '1010301003000006', 'BINDER CLIPS 200', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(128, '1010301003000007', 'bINDER CLIP 300', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(129, '1010301003000008', 'Binder Clips 105 Joyko', 'Gross', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(130, '1010301003000009', 'Trigonal Warna', 'Pack', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(131, '1010301003000010', 'Paper Clip (SPTK)', 'Kotak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(132, '1010301003000011', 'Binder Clip 260 (IMK Kab.HST)', 'Kotak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(133, '1010301003000012', 'Binder Clip 155 (IMK Kab. HST)', 'Kotak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(134, '1010301003000013', 'PAPER CLIPS DAITO No. 3', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(135, '1010301003000014', 'BINDER CLIPS Joyko No. 105', 'Gros', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(136, '1010301003000015', 'BINDER CLIPS 107', 'GROSS', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(137, '1010301003000016', 'Binder Clips 260', 'Lusin', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(138, '1010301003000017', 'BINDER CLIPS 260', 'GROSS', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(139, '1010301003000018', 'BINDER CLIPS 260', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(140, '1010301004000001', 'PENGHAPUS PENSIL', 'KOTAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(141, '1010301004000002', 'TIPE-X', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(142, '1010301004000003', 'Tipe-x-Kertas', 'Btl', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(143, '1010301004000004', 'Eraser', 'Ktk', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(144, '1010301004000005', 'Tipex Kertas (IMK Kab. HST)', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(145, '1010301004000006', 'PENGHAPUS PENSIL', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(146, '1010301005000001', 'BUKU EKSPEDISI', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(147, '1010301005000002', 'BUKU AGENDA SURAT', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(148, '1010301005000003', 'BUKU FOLIO BERGARIS', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(149, '1010301006000001', 'STOPMAP FOLIO', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(150, '1010301006000005', 'Map Batik', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(151, '1010301006000006', 'MAP', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(152, '1010301006000007', 'BUSNESS FILE', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(153, '1010301006000009', 'Map Plastik Transparan', 'Lusin', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(154, '1010301006000014', 'Tas jala kancing', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(155, '1010301006000018', 'ORDNER BANTEX', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(156, '1010301006000019', 'MAP BATIK', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(157, '1010301006000020', 'TAS JALA KANCING', 'LUSIN', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(158, '1010301006000021', 'TAS KANCING JENIA', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(159, '1010301006000022', 'TAS KANCING JENIA', 'LUSIN', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(160, '1010301006000023', 'ORDNER BANTEX HITAM', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(161, '1010301006000024', 'MAP BISNIS', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(162, '1010301006000025', 'MAP PLASTIK KANCING', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(163, '1010301006000026', 'Map Arsip', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(164, '1010301006000027', 'Box Arsip', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(165, '1010301006000028', 'MAP BPS HST', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(166, '1010301006000030', 'File Folder FAVO', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(167, '1010301006000032', 'File Rack', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(168, '1010301008000001', 'CUTTER KNIFE', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(169, '1010301008000002', 'Cutter Kenko', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(170, '1010301008000003', 'Cutter Kenko L - 500', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(171, '1010301008000004', 'Isi Cutter Kenko L - 500', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(172, '1010301010000001', 'ISOLASI SEDANG', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(173, '1010301010000002', 'ISOLASI KECIL', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(174, '1010301010000003', 'LEM KERTAS', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(175, '1010301010000004', 'LAKBAN', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(176, '1010301010000005', 'Isolasi Bening Besar', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(177, '1010301010000006', 'Isolasi Bening Sedang', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(178, '1010301010000007', 'Isolasi Bening Kecil', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(179, '1010301010000008', 'Isolasi Besar Coklat', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(180, '1010301010000009', 'Isolasi Bening Sedang (IMK)', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(181, '1010301010000010', 'Isolasi Kecil', 'Rol', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(182, '1010301010000011', 'LAKBAN', 'Rol', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(183, '1010301010000012', 'AMOS WHITE GLUE', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(184, '1010301010000013', 'ISOLASI NADU 12 MM', 'ROLL', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(185, '1010301010000014', 'ISOLASI NADU 24 MM', 'ROLL', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(186, '1010301010000015', 'DOHTE TAPE 1 INCHI', 'LUSIN', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(187, '1010301010000016', 'DOUBLE SIDE TAPE 24 MM NACHI', 'ROLL', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(188, '1010301012000001', 'STAPLES KECIL', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(189, '1010301012000002', 'Stapler Kenko HD-10', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(190, '1010301012000003', 'Stapler HD kecil', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(191, '1010301012000004', 'Stapler Tembak', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(192, '1010301012000005', 'Isi Stapler Tembak', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(193, '1010301012000006', 'STAPLES MEDIUM', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(194, '1010301013000004', 'ISI STAPLES GW NO. 10', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(195, '1010301013000005', 'ISI STAPLES GW NO. 369', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(196, '1010301999000001', 'TEMPAT PEN MEJA', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(197, '1010301999000002', 'SANDARAN BUKU', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(198, '1010301999000004', 'PEMOTONG LAKBAN', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(199, '1010301999000005', 'PEMOTONG ISOLASI', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(200, '1010301999000006', 'KOTAK CD', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(201, '1010301999000007', 'ACRYLIC BANTEX', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(202, '1010301999000008', 'GUNTING', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(203, '1010301999000009', 'CD', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(204, '1010301999000010', 'Calkulator', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(205, '1010301999000011', 'Pelubang Kertas', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(206, '1010301999000012', 'STICK ON', 'SET', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(207, '1010301999000013', 'GUNTING GUNINDO OMM', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(208, '1010301999000014', 'GUNTING GUNINDO OLL', 'BUAH', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(209, '1010301999000015', 'STICKY NOTE', 'SET', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(210, '1010301999000016', 'STICKY NOTE T&J', 'Set', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(211, '1010301999000017', 'JOYKO IM-35', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(212, '1010301999000018', 'K-Eight LGC 025', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(213, '1010301999000019', 'K-Eight LGA 007', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(214, '1010301999000020', 'Desk Organizer', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(215, '1010301999000021', 'Pencil Holder', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(216, '1010301999000022', 'Pen Holder', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(217, '1010301999000023', 'Cable Clips', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(218, '1010302001000006', 'FOTOCOPY', 'Lembar', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(219, '1010302001000007', 'KERTAS CLR', 'Lembar', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(220, '1010302001000009', 'KERTAS HVS A4S', 'Rim', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(221, '1010302001000011', 'Kertas Folio Bergaris', 'Rim', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(222, '1010302001000014', 'Kertas A4S', 'Box', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(223, '1010302001000016', 'Kertas A4', 'RIM', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(224, '1010302001000017', 'KERTAS A3', 'RIM', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(225, '1010302001000029', 'KERTAS F4', 'RIM', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(226, '1010302001000031', 'KERTAS A4', 'BOX', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(227, '1010302001000032', 'Kertas Sertifikat', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(228, '1010302004000001', 'AMPLOP CASING B', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(229, '1010302004000002', 'AMPLOP CASING C', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(230, '1010302004000003', 'AMPLOP CASING D', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(231, '1010302004000004', 'AMPLOP LEM', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(232, '1010302004000005', 'AMPLOP SAMSON E', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(233, '1010302004000006', 'AMPLOP SAMSON D', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(234, '1010302004000007', 'AMPLOP SAMSON A', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(235, '1010302004000009', 'AMPLOP SAMSON B', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(236, '1010302004000010', 'AMPLOP SAMSON JAYA', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(237, '1010302004000011', 'Amplop Coklat F4 Lem', 'Pack', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(238, '1010302004000012', 'Amplop Coklat F4 Non Lem', 'Pack', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(239, '1010302004000013', 'Amplop Putih 105 Pps', 'Pack', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(240, '1010302004000014', 'Amplop Putih polos 104 Pps', 'Pack', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(241, '1010302004000015', 'Amplop Putih Polos 90 Pps', 'Pack', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(242, '1010302004000017', 'Amplop PPL 90', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(243, '1010302004000018', 'Amplop 110', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(244, '1010302004000019', 'Amplop PPL 104', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(245, '1010302004000022', 'Amplop Samson Jaya E', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(246, '1010302004000023', 'Amplop Samson Jaya B', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(247, '1010302004000024', 'Amplop Samson Jaya C', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(248, '1010302004000025', 'Amplop Plastik Bima', 'Lusin', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(249, '1010302004000028', 'Amplop Exicutive B', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(250, '1010302004000029', 'Amplop Exicutive b', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(251, '1010302004000030', 'AMPLOP PPL 110', 'KOTAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(252, '1010302004000031', 'AMPLOP J PLUS D', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(253, '1010302004000032', 'AMPLOP PPL 104', 'KOTAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(254, '1010302004000033', 'AMPLOP PPL 90', 'KOTAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(255, '1010302004000034', 'AMPLOP A3', 'PAK', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(256, '1010302004000035', 'Amplop Executive Folio', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(257, '1010302999000002', 'Kertas Linen', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(258, '1010303999000001', 'Kertas Photo', 'Pak', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(259, '1010303999000002', 'Poster ST2013', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(260, '1010304001000001', 'Computer 2 Ply 14 7 8 x 11', 'box', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(261, '1010304001000002', 'Computer 2 Ply 9,5 x 11', 'box', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(262, '1010304002000001', 'Plastik CD', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(263, '1010304002000002', 'Kotak CD', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(264, '1010304003000001', 'Cartridge Canon MP510 Hitam', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(265, '1010304003000002', 'Cartridge Canon MP510 Warna', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(266, '1010304003000003', 'Cartridge Canon MP145 Hitam', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(267, '1010304003000004', 'Cartridge Canon MP145 Warna', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(268, '1010304003000005', 'Cartridge HP PSC 1410 Hitam', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(269, '1010304003000006', 'Cartridge HP PSC 1410 Warna', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(270, '1010304003000007', 'Cartridge HP Deskjet Hitam 3920', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(271, '1010304003000008', 'Cartridge HP Deskjet Warna 3920', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(272, '1010304003000009', 'Cartridge HP PSC 1210 HJitam', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(273, '1010304003000010', 'Pita Epson', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(274, '1010304003000011', 'Catridge HP Laserjet 1420', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(275, '1010304003000012', 'Catridge Canon 1700', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(276, '1010304003000013', 'Catridge Canon 1480', 'Buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(277, '1010304004000001', 'Toner HP Laserjet 1320', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(278, '1010304004000002', 'Toner HP Laserjet 1826', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(279, '1010304004000003', 'Tinta Botol Hitam Kecil', 'botol', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(280, '1010304004000004', 'Tinta Botol Warna Kecil', 'botol', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(281, '1010304004000005', 'DataPrint Hitam', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(282, '1010304004000006', 'Dataprint Warna', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(283, '1010304004000007', 'Tinta Hitam 1 Liter', 'botol', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(284, '1010304004000008', 'Tinta Botol 1 Liter Warna', 'botol', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(285, '1010304004000009', 'Toner Xerox Phaser 3428', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(286, '1010304004000010', 'Toner Xerox Docuprint C3055 Black', 'buah', '2024-11-03 11:14:09', '2024-11-03 11:14:09'),
(287, '1010304004000011', 'Toner Xerox Cyan', 'unit', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(288, '1010304004000012', 'Toner Fuji Xerox Magenta', 'Unit', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(289, '1010304004000013', 'Toner Fuji Xerox Yellow', 'Unit', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(290, '1010304004000014', 'TINTA E-PRINT', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(291, '1010304004000015', 'Toner Printer HP 1102', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(292, '1010304004000016', 'Toner Printer HP P2055D', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(293, '1010304004000017', 'Tinta Epson', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(294, '1010304004000018', 'Refiil Toner', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(295, '1010304004000019', 'Tinta Epson 664 Original Hitam', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(296, '1010304004000020', 'Cartridge Toner HP 85A', 'Pcs', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(297, '1010304004000021', 'Tinta Toner Laser jet (IMK  Kab. HST)', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(298, '1010304004000022', 'Toner Laser jet (IMK Kab. HST)', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(299, '1010304004000023', 'Catridge Toner 285A', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(300, '1010304004000024', 'Tinta Epson Black 774', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(301, '1010304004000025', 'Tinta Epson Cyan 664', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(302, '1010304004000026', 'Tinta Epson Magenta 664', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(303, '1010304004000027', 'Tinta Epson Yellow 664', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(304, '1010304004000028', 'Toner HP 89A', 'Unit', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(305, '1010304004000029', 'BLUEPRINT Toner Cartridge HP Laserjet BP-HP85A Black', 'Unit', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(306, '1010304004000030', 'Toner Cartridge HP Laserjet HP 89A Black', 'Unit', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(307, '1010304004000031', 'MX-INK T6641', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(308, '1010304004000032', 'Tinta Pixma Magenta', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(309, '1010304004000033', 'Tinta Pixma Yellow', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(310, '1010304004000034', 'Tinta Pixma Cyan', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(311, '1010304004000035', 'Tinta Pixma Black', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(312, '1010304004000036', 'Toner HP LaserJet MX-CE285A', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(313, '1010304004000037', 'Toner HP LJ Enterprise MX-CF289A-NC', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(314, '1010304004000038', 'MX INK T664 Black', 'BOTOL', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(315, '1010304004000039', 'MX INK T664 Yellow', 'BOTOL', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(316, '1010304004000040', 'MX INK T664 Cyan', 'BOTOL', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(317, '1010304004000041', 'MX INK T664 Magenta', 'BOTOL', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(318, '1010304004000042', 'HP LaserJet Enterprise CF289A', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(319, '1010304004000048', 'MX INK AP008 Black', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(320, '1010304004000049', 'MX INK AP008 Cyan', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(321, '1010304004000050', 'MX INK AP008 Magenta', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(322, '1010304004000051', 'MX INK AP008 Yellow', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(323, '1010304006000001', 'Flashdisk 4 GB', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(324, '1010304006000002', 'Flashdisk 8 GB', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(325, '1010304006000003', 'HDD 320 GB', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(326, '1010304006000004', 'FD 4 GB', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(327, '1010304006000005', 'FD 8 GB', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(328, '1010304006000006', 'FD 16GB', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(329, '1010304006000007', 'Modem WIFI', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(330, '1010304006000008', 'Flashdisk', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(331, '1010304006000009', 'FLASH DISK OTG 64 GB', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(332, '1010304006000010', 'FLASHDISK SANDISK OTG 32 GB', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(333, '1010304006000011', 'FLASHDISK SANDISK OTG 32 GB TYPE C', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(334, '1010304006000012', 'SANDISK OTG 16GB TYPE C', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(335, '1010304006000013', 'SANDISK FLASH DRIVE 16GB', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(336, '1010304006000014', 'FLASHDISK OTG V-GEN 16GB', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(337, '1010304007000001', 'SD Card', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(338, '1010304010000001', 'MOUSE', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(339, '1010304999000001', 'CD-RW', 'keping', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(340, '1010304999000002', 'Disket', 'kotak', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(341, '1010304999000003', 'DVD-R', 'keping', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(342, '1010304999000005', 'Baterai UPS', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(343, '1010304999000006', 'Flashdisk', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(344, '1010304999000007', 'CD-R', 'keping', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(345, '1010304999000008', 'Computer Cleaning set', 'set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(346, '1010304999000009', 'USB Hub', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(347, '1010304999000010', 'Switch Hub 8 Port', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(348, '1010304999000011', 'Keyboard', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(349, '1010304999000012', 'DVD-RW', 'Keping', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(350, '1010304999000014', 'Key Numeric', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(351, '1010304999000015', 'Key Flexsibel', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(352, '1010304999000016', 'DVD', 'Keping', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(353, '1010304999000017', 'Mouse Pad', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(354, '1010304999000018', 'KEYBOARD MOUSE WIRELESS', 'SET', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(355, '1010304999000019', 'Logitech MK 220', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(356, '1010304999000020', 'Logitech M221 Silent Charcoal', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(357, '1010304999000021', 'Logitech M221 Silent Rose', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(358, '1010304999000022', 'Maintenance Box Printer', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(359, '1010304999000023', 'RJ-45', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(360, '1010304999000024', 'USB to LAN', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(361, '1010304999000025', 'Laptop Holder', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(362, '1010304999000026', 'Vertion Display Port', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(363, '1010304999000027', 'USB to USB', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(364, '1010305001000001', 'Kapstok Belakang Pintu', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(365, '1010305001000002', 'Tempat Kapur Barus', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(366, '1010305001000003', 'Gayung Mandi', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(367, '1010305001000004', 'Sikat Lantai', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(368, '1010305001000005', 'Sikat WC', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(369, '1010305001000006', 'SAPU LANTAI', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(370, '1010305001000007', 'SIKAT LANTAI', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(371, '1010305001000008', 'SAPU LIDI', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(372, '1010305001000009', 'Serok', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(373, '1010305001000010', 'Sikat WC Bulat', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(374, '1010305001000011', 'Sikat WC', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(375, '1010305001000012', 'SIKAT BESI', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(376, '1010305002000001', 'Bulu Ayam Kemoceng', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(377, '1010305002000002', 'Sapu Lantai', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(378, '1010305002000003', 'Pel Tangkai Busa', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(379, '1010305002000004', 'Lawai', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(380, '1010305002000005', 'tangkai Pel', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(381, '1010305002000006', 'Kain Pel', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(382, '1010305002000007', 'SERBET', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(383, '1010305002000008', 'Sapu Pel', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(384, '1010305002000009', 'Lap Tangan Gantung', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(385, '1010305002000010', 'PEL', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(386, '1010305002000011', 'KESET', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(387, '1010305002000012', 'BUSA PEL', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(388, '1010305002000013', 'LAP TANGAN GANTUNG', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(389, '1010305002000014', 'Pel Destek', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(390, '1010305002000015', 'Sapu Tangan Serbit', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(391, '1010305002000016', 'SPRAY MOP', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(392, '1010305003000001', 'Ember Plastik', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(393, '1010305004000001', 'Keset Kaki', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(394, '1010305004000002', 'Keranjang Sampah', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(395, '1010305004000003', 'Serok Sampah', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(396, '1010305004000004', 'Keranjang Sampah Injak', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(397, '1010305004000005', 'SEROK SAMPAH', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(398, '1010305004000006', 'TONG SAMPAH', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(399, '1010305005000001', 'KRAN', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(400, '1010305006000001', 'Lem Kuning', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(401, '1010305006000002', 'Lem Besi', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(402, '1010305006000003', 'TALI BENDERA', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(403, '1010305006000004', 'ISOLASI KRAN', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(404, '1010305007000001', 'Radar', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(405, '1010305008000001', 'Pembersih Porselen', 'botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(406, '1010305008000002', 'Kapur Barus', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(407, '1010305008000003', 'Karbol', 'botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(408, '1010305008000004', 'Pembersih Kaca', 'botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(409, '1010305008000005', 'Refill Pembersih Kaca', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(410, '1010305008000006', 'Kapur Barus Kecil Kamper', 'bungkus', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(411, '1010305008000007', 'Kapur Barus Gantung (Ball)', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(412, '1010305008000009', 'Cairan pembersih Tangan', 'botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(413, '1010305008000010', 'Pembersih Lantai', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(414, '1010305008000011', 'Sabun Cream', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(415, '1010305008000012', 'Pembersih Dasboard', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(416, '1010305008000013', 'refiil Pembersih Dashboard', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(417, '1010305008000014', 'Pengharum Mobil', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(418, '1010305008000015', 'Refill Pengharum Mobil', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(419, '1010305008000017', 'Pembersih Ban Mobil', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(420, '1010305008000018', 'Refill Pembersih ban Mobil', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(421, '1010305008000019', 'Pembersih Mobil', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(422, '1010305008000020', 'Pengharum Elektrik Mobil', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(423, '1010305008000021', 'Refill Pengharum Elektrik', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(424, '1010305008000022', 'Refill Shampo Mobil', 'bungkus', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(425, '1010305008000031', 'Refill Pencuci Tangan', 'bungkus', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(426, '1010305008000042', 'Cairan Pembersih Alat Makan', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(427, '1010305008000043', 'Cairan Pembersih  WC (Wipot)', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(428, '1010305008000044', 'HANDWASH BOTOL', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(429, '1010305008000045', 'HANDWASH ISI ULANG', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(430, '1010305008000046', 'OBAT SEMPROT NYAMUK', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(431, '1010305008000047', 'SABUN LANTAI', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(432, '1010305008000048', 'KARBOL', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(433, '1010305008000049', 'SABUN CUCI', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(434, '1010305008000050', 'ISI ULANG KARBOL', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(435, '1010305008000051', 'SABUN CUCI CREAM', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(436, '1010305008000052', 'VIXAL B', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(437, '1010305008000053', 'S.O.S  Refiil', 'Bks', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(438, '1010305008000054', 'Sleek Hand Wash', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(439, '1010305008000055', 'VIXAL', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(440, '1010305008000056', 'Wifol', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(441, '1010305008000057', 'S.O.S', 'Btl', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(442, '1010305008000058', 'Sunlight 400', 'Bks', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(443, '1010305008000059', 'Sleek Hand Wash isi Ulang', 'Bks', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(444, '1010305008000061', 'Sunlight 800', 'Bungkus', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(445, '1010305008000062', 'Soklin', 'Bks', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(446, '1010305008000063', 'SUN LIGHT EXTRA', 'Bungkus', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(447, '1010305008000064', 'cling', 'bungkus', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(448, '1010305008000065', 'Hand Carex', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(449, '1010305008000066', 'REFILL SUNLIGHT', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(450, '1010305008000067', 'BAYCLIN', 'LITER', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(451, '1010305008000068', 'SOS SUPERPEL', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(452, '1010305008000069', 'SOS HANDWASH', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(453, '1010305008000070', 'REFILL WIPOL', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(454, '1010305008000071', 'REFILL SUPERPEL', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(455, '1010305008000072', 'SUPER PELL', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(456, '1010305008000073', 'BLUE CLEAN', 'PAK', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(457, '1010305009000001', 'Gelas Minum', 'Lusin', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(458, '1010305009000002', 'Piring Makan', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(459, '1010305009000003', 'Piring Kecil', '1/2 Lusin', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(460, '1010305012000001', 'Pengharum Ruangan Elektrik', 'kaleng', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(461, '1010305012000002', 'Pembasmi Serangga', 'kaleng', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(462, '1010305012000003', 'Pengharum Ruangan Gantung', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(463, '1010305012000004', 'Pengharum Telepon', 'kaleng', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(464, '1010305012000005', 'Pengharum Ruangan semprot', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(465, '1010305012000006', 'PENGHARUM MATIC', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(466, '1010305012000007', 'PENGHARUM GANTUNG', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(467, '1010305012000008', 'PENGHARUM KAMAR MANDI', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(468, '1010305012000009', 'ISI ULANG PENGHARUM', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(469, '1010305012000010', 'Stella Botol', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(470, '1010305012000012', 'Stella', 'Klg', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(471, '1010305012000013', 'DAHLIA MATIC DISPENSE', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(472, '1010305012000014', 'STELLA MATIC', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(473, '1010305012000016', 'PENGHARUM MATIC DISPENSE', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(474, '1010305012000017', 'DAHLIA MATIC', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(475, '1010305012000018', 'PENGHARUM AIO', 'PAK', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(476, '1010305014000001', 'Tape Dispenser Kenko', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(477, '1010305014000002', 'Tape Dispenser Kenjoy', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(478, '1010305999000001', 'bendera (umbul-umbul)', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(479, '1010305999000006', 'Tissue kotak', 'Kotak', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(480, '1010305999000007', 'Vas Bunga', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(481, '1010305999000008', 'Cermin Besar', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(482, '1010305999000009', 'Cermin Kecil', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(483, '1010305999000010', 'Figura Foto', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(484, '1010305999000011', 'Figura Peta', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(485, '1010305999000012', 'Jam Dinding', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(486, '1010305999000013', 'Pigura', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(487, '1010305999000016', 'BATERAI', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(488, '1010305999000017', 'BINGKAI PIBER', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(489, '1010305999000019', 'TISSUE F', 'BKS', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(490, '1010305999000022', 'SEROK SAMPAH', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(491, '1010305999000023', 'SPONS', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(492, '1010305999000024', 'TISSUE ROLL', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(493, '1010305999000025', 'Tissue Roll', 'Pak', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(494, '1010306001000001', 'Kabel Listrik', 'Meter', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(495, '1010306001000002', 'KABEL LISTRIK', 'Roll', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(496, '1010306002000001', 'Lampu Pijar', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(497, '1010306002000002', 'Lampu Neon 10 Watts', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(498, '1010306002000003', 'Lampu Neon 20 Watts', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(499, '1010306002000004', 'Lampu', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(500, '1010306002000005', 'Bola Lampu', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(501, '1010306002000006', 'Lampu 22 W', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(502, '1010306002000007', 'Lampu 12 W', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(503, '1010306002000008', 'Lampu 10 W', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(504, '1010306003000001', 'Stop Kontak T', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(505, '1010306004000001', 'Saklar', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(506, '1010306010000001', 'Baterai Kecil', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(507, '1010306010000002', 'Baterai Besar', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10');
INSERT INTO `master_persediaans` (`id`, `kode`, `barang`, `satuan`, `created_at`, `updated_at`) VALUES
(508, '1010306010000003', 'Baterai Remote', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(509, '1010306010000004', 'Baterai Wireless', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(510, '1010306010000005', 'Baterai Alkalin AA', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(511, '1010306010000006', 'BATERAI ABC AA', 'BUAH', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(512, '1010306010000007', 'BATERAI ALKALIN AAA', 'SET', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(513, '1010306010000008', 'BATERAI ABC AAA', 'SET', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(514, '1010306999000001', 'Microfon', 'buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(515, '1010306999000002', 'Clen Aston', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(516, '1010306999000003', 'Jasa Perbaikan Listrik', 'Paket', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(517, '1010306999000004', 'NEB', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(518, '1010309003000001', 'Stempel', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(519, '1010399999000210', 'LEM BANTEX', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(520, '1010399999000220', 'BOX FILE BANTEX', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(521, '1010399999000250', 'Handsanitizer 250 ml', 'Botol', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(522, '1010399999000338', 'Topi ST2023', 'Pcs', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(523, '1010399999000339', 'Payung ST2023', 'Pcs', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(524, '1010399999000340', 'Kaos ST2023 Allsize Panjang', 'Pcs', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(525, '1010399999000341', 'Kaos ST2023 Allsize Pendek', 'Pcs', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(526, '1010399999000342', 'Kaos ST2023 XXL Panjang', 'Pcs', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(527, '1010399999000343', 'Kaos ST2023 XXL Pendek', 'Pcs', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(528, '1010399999000344', 'Kaos ST2023 XXXL Panjang', 'Pcs', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(529, '1010399999000345', 'Goodie Bag ST2023', 'Pcs', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(530, '1010399999000346', 'ATK Petugas ST2023-PAPI', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(531, '1010399999000347', 'Buku 2A.2 Pedoman Lapangan ST2023-UTP (Papi)', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(532, '1010399999000348', 'Buku 2C. Pedoman Petugas Lapangan ST2023-UTL', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(533, '1010399999000349', 'Buku 3A.2 Pedoman Pemeriksa Lapangan ST2023-UTP (PAPI)', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(534, '1010399999000350', 'ST2023-L2.UTP', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(535, '1010399999000351', 'ST2023-L2.UTL', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(536, '1010399999000352', 'Box File', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(537, '1010399999000353', 'Topi Petugas ST2023', 'Pcs', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(538, '1010399999000354', 'Rautan Elektronik', 'Buah', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(539, '1010399999000355', 'Kuesioner REGSOSEK22-K', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(540, '1010399999000356', 'VBH22-BL', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(541, '1010399999000357', 'VBH22-BLp', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(542, '1010399999000358', 'VBH22-HR', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(543, '1010399999000359', 'VBH22-HRp', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(544, '1010399999000360', 'VBH22-LK', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(545, '1010399999000361', 'VBH22-KK', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(546, '1010399999000362', 'VBH22-S', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(547, '1010399999000363', 'Pedoman Produksi', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(548, '1010399999000364', 'Pedoman Konsumsi', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(549, '1010399999000365', 'Pedoman Pengolahan', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(550, '1010399999000366', 'Kuesioner HKD-1', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(551, '1010399999000367', 'Kuesioner HKD-2.1', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(552, '1010399999000368', 'Kuesioner HKD-2.2', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(553, '1010399999000369', 'Kuesioner HD-1', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(554, '1010399999000370', 'Kuesioner HD-2', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(555, '1010399999000371', 'Kuesioner HD-3', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(556, '1010399999000372', 'Kuesioner HD-4', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(557, '1010399999000373', 'Kuesioner HD-5.1', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(558, '1010399999000374', 'Kuesioner HD-5.2', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(559, '1010399999000375', 'Pedoman Pencacahan Survei HPBG 2023', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(560, '1010399999000376', 'Pedoman Pemeriksaan Survei HPBG 2023', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(561, '1010399999000377', 'Pedoman Pencacahan Survei HPG 2023', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(562, '1010399999000378', 'Pedoman Pemeriksaan Survei HPG 2023', 'Eksemplar', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(563, '1010399999000379', 'Kuesioner Susenas VSEN23.K', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(564, '1010399999000380', 'Kuesioner Susenas VSEN23.KP', 'Set', '2024-11-03 11:14:10', '2024-11-03 11:14:10'),
(565, '1010399999000381', 'Kuesioner Susenas VSEN23.P', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(566, '1010399999000382', 'Kuesioner Susenas VSEN23.DSRT', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(567, '1010399999000383', 'Kuesioner Susenas VSEN23.MHP', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(568, '1010399999000384', 'Pedoman Kepala BPS Provinsi dan Kepala BPS Kabupaten/Kota Susenas Maret 2023', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(569, '1010399999000385', 'Pedoman Pencacahan Susenas Maret 2023', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(570, '1010399999000386', 'Pedoman Pengawas Susenas Maret 2023', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(571, '1010399999000387', 'Konsep dan Definisi Susenas Maret 2023', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(572, '1010399999000388', 'Pemanfaatan Data Susenas Kor dan KP Susenas Maret 2023', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(573, '1010399999000389', 'Poster ST2023', 'Lembar', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(574, '1010399999000390', 'Leaflet ST2023', 'Lembar', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(575, '1010399999000391', 'Standing Banner ST2023', 'Buah', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(576, '1010399999000392', 'Spanduk ST2023', 'Buah', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(577, '1010399999000393', 'Baliho ST2023', 'Buah', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(578, '1010399999000394', 'Kuesioner SAK.23', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(579, '1010399999000395', 'Pedoman Pencacahan SAK.23', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(580, '1010399999000396', 'Pedoman Pemeriksaan SAK.23', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(581, '1010399999000397', 'Buku Kode SAK.23', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(582, '1010399999000398', 'Kuesioner PMTB23-PERKEBUNAN', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(583, '1010399999000399', 'Kuesioner PMTB23-HORTIKULTURA', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(584, '1010399999000400', 'Kuesioner PMTB23-HEWAN', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(585, '1010399999000401', 'Kuesioner PMTB23-KENDARAAN (SAMSAT)', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(586, '1010399999000402', 'Kuesioner PMTB23-IMB/PBG', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(587, '1010399999000403', 'Kuesioner PMTB23-PBB', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(588, '1010399999000404', 'Kuesioner PMTB23-LKPM', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(589, '1010399999000405', 'Kuesioner PMTB23-APBDESA', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(590, '1010399999000406', 'Kuesioner PMTB23-FINANSIAL', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(591, '1010399999000407', 'Kuesioner PMTB23-RT', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(592, '1010399999000408', 'Kuesioner PMTB23-NONFINANSIAL', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(593, '1010399999000409', 'Kuesioner PMTB23-LNPRT', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(594, '1010399999000410', 'Buku Pedoman Pencacahan PMTB', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(595, '1010399999000411', 'VSERUTI23.INTI', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(596, '1010399999000412', 'CLIP BOARD', 'BUAH', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(597, '1010399999000413', 'Kuesioner Survei Perdagangan Antar Wilayah 2023 (PAW)', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(598, '1010399999000414', 'Buku Pedoman Survei Perdagangan Antar Wilayah 2023 (PAW)', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(599, '1010399999000415', 'Kuesioner Survei Pola Distribusi Barang 2023', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(600, '1010399999000416', 'Buku Pedoman Survei Pola Distribusi Barang 2023', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(601, '1010399999000417', 'Kuesioner Survei Tahunan Perusahaan Pertambangan Non Migas', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(602, '1010399999000418', 'Kuesioner Survei Tahunan Usaha Penggalian Bahan Industri dan Konstruksi URT', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(603, '1010399999000419', 'Kuesioner Survei Captive Power', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(604, '1010399999000420', 'Kuesioner Updating Perusahaan Pertambangan dan Energi', 'Lembar', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(605, '1010399999000421', 'Kuesioner Updating Master Frame Desa Lokasi Usaha Penggalian', 'Lembar', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(606, '1010399999000422', 'Kuesioner Survei Triwulanan Perusahaan Air Bersih', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(607, '1010399999000423', 'Pedoman Pencacahan Survei Pertambangan dan Energi 2023', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(608, '1010399999000424', 'Kuesioner Survei Industri Mikro dan Kecil 2023', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(609, '1010399999000425', 'Lembar Klasifikasi dan Kasus Batas IMK', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(610, '1010399999000426', 'Kuesioner STPIM-IIA', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(611, '1010399999000427', 'Kartu Kendali Survei IBS', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(612, '1010399999000429', 'Kuesioner SKLNPT', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(613, '1010399999000430', 'Kuesioner Survei Perusahaan Konstruksi Tahunan (SKTH 2022)', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(614, '1010399999000431', 'Kuesioner Survei Perusahaan Konstruksi Triwulanan (SKTR 2023)', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(615, '1010399999000432', 'Sampel Usaha Konstruksi Perorangan 2023 (SKP23-S)', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(616, '1010399999000433', 'Surat Pengantar BPS', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(617, '1010399999000434', 'Kuesioner Lembaga Keuangan Koperasi Simpan Pinjam 2023', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(618, '1010399999000435', 'Surat Permohonan Data Survei Lembaga Keuangan 2023', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(619, '1010399999000436', 'Storage Box', 'Buah', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(620, '1010399999000437', 'TAS', 'Buah', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(621, '1010399999000438', 'Blocknote Paperline', 'Buah', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(622, '1010399999000439', 'Buku Pedoman Pencacahan SPDT IHPB 2023', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(623, '1010399999000440', 'Buku Pedoman Pemeriksaan SPDT IHPB 2023', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(624, '1010399999000441', 'Buku Pedoman SKTNP Barang', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(625, '1010399999000442', 'Buku Pedoman SKTNP Jasa', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(626, '1010399999000443', 'Buku Pedoman SINASI', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(627, '1010399999000444', 'Kuesioner SKTNP Barang Tahap 3', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(628, '1010399999000445', 'Kuesioner SKTNP Barang Tahap 4', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(629, '1010399999000446', 'Kuesioner SKTNP Jasa Tahap 3', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(630, '1010399999000447', 'Kuesioner SKTNP Jasa Tahap 4', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(631, '1010399999000448', 'Kuesioner SINASI', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(632, '1010399999000449', 'Pedoman VHTS', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(633, '1010399999000450', 'Pedoman VHTL', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(634, '1010399999000451', 'Pedoman VREST UMB', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(635, '1010399999000452', 'Pedoman VDTW', 'Buku', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(636, '1010399999000453', 'Kuesioner VHTL', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(637, '1010399999000454', 'Kuesioner VREST UMB', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(638, '1010399999000455', 'Kuesioner VDTW', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(639, '1010399999000457', 'Alat Peraga', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(640, '1010399999000458', 'Buku Pedoman Forum Konsultasi Publik (FKP)', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(641, '1010399999000459', 'Suplemen Pedoman Forum Konsultasi Publik', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(642, '1010399999000460', 'Cue Card Fasilitator', 'Set', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(643, '1010399999000461', 'Bolpoin Peserta FKP', 'Buah', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(644, '1010399999000712', 'Booklet Indikator Strategis Kabupaten Hulu Sungai Tengah 2023', 'Buah', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(645, '1010399999000713', 'Kabupaten Hulu Sungai Tengah Dalam Angka 2023', 'Eksemplar', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(646, '1010399999000714', 'Kecamatan Dalam Angka Kab. Hulu Sungai Tengah 2023', 'Eksemplar', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(647, '1010399999000715', 'PDRB Kab. Hulu Sungai Tengah Menurut Lapangan Usaha 2018 - 2022', 'Eksemplar', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(648, '1010399999000716', 'PDRB Kab. Hulu Sungai Tengah Menurut Pengeluaran 2018 - 2022', 'Eksemplar', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(649, '1010399999000717', 'Statistik Daerah Kab. Hulu Sungai Tengah 2023', 'Eksemplar', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(650, '1010399999000718', 'Indikator Kesejahteraan Rakyat Kab. Hulu Sungai†Tengah†2023', 'Eksemplar', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(651, '1010399999000721', 'Jam LED', 'buah', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(652, '1010399999000722', 'Penghancur Kertas', 'buah', '2024-11-03 11:14:11', '2024-11-03 11:14:11'),
(653, '1234567890123456', '233', 'ee', '2024-11-09 20:23:48', '2024-11-09 20:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `mata_anggarans`
--

CREATE TABLE `mata_anggarans` (
  `id` bigint UNSIGNED NOT NULL,
  `mak` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coa_id` smallint UNSIGNED DEFAULT NULL,
  `uraian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume` mediumint UNSIGNED DEFAULT NULL,
  `satuan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_satuan` int UNSIGNED DEFAULT NULL,
  `total` int UNSIGNED DEFAULT NULL,
  `blokir` int UNSIGNED DEFAULT NULL,
  `rpd_januari` int UNSIGNED DEFAULT NULL,
  `rpd_februari` int UNSIGNED DEFAULT NULL,
  `rpd_maret` int UNSIGNED DEFAULT NULL,
  `rpd_april` int UNSIGNED DEFAULT NULL,
  `rpd_mei` int UNSIGNED DEFAULT NULL,
  `rpd_juni` int UNSIGNED DEFAULT NULL,
  `rpd_juli` int UNSIGNED DEFAULT NULL,
  `rpd_agustus` int UNSIGNED DEFAULT NULL,
  `rpd_september` int UNSIGNED DEFAULT NULL,
  `rpd_oktober` int UNSIGNED DEFAULT NULL,
  `rpd_november` int UNSIGNED DEFAULT NULL,
  `rpd_desember` int UNSIGNED DEFAULT NULL,
  `dipa_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_anggarans`
--

INSERT INTO `mata_anggarans` (`id`, `mak`, `coa_id`, `uraian`, `volume`, `satuan`, `harga_satuan`, `total`, `blokir`, `rpd_januari`, `rpd_februari`, `rpd_maret`, `rpd_april`, `rpd_mei`, `rpd_juni`, `rpd_juli`, `rpd_agustus`, `rpd_september`, `rpd_oktober`, `rpd_november`, `rpd_desember`, `dipa_id`, `created_at`, `updated_at`) VALUES
(1, '054.01.WA.2886.EBA.956.051.A.524111', 323, 'Perjalanan  dalam rangka administrasi BMN', 2, 'OP', 2914500, 5829000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2854000, 2975000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(2, '054.01.WA.2886.EBA.962.051.A.521211', 381, 'Konsumsi Rapat', 38, 'O-K', 85000, 3230000, 0, 0, 1587000, 680000, 0, 0, 0, 0, 0, 0, 0, 0, 963000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(3, '054.01.WA.2886.EBA.994.001.A.511111', 324, 'belanja gaji pokok pns', 1, 'THN', 1145565000, 1145565000, 0, 86915580, 103457700, 96531800, 95534720, 95534720, 95934920, 95909620, 91821420, 92359620, 90575300, 97261300, 103728300, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(4, '054.01.WA.2886.EBA.994.001.A.511111', 325, 'belanja gaji pokok pns (gaji ke 13)', 1, 'BLN', 95669000, 95669000, 0, 0, 0, 0, 0, 0, 95668120, 0, 0, 0, 0, 0, 880, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(5, '054.01.WA.2886.EBA.994.001.A.511111', 326, 'belanja gaji pokok pns (gaji ke 14)', 1, 'BLN', 95418000, 95418000, 0, 0, 0, 94303240, 0, 1114280, 0, 0, 0, 0, 0, 0, 480, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(6, '054.01.WA.2886.EBA.994.001.A.511119', 327, 'belanja pembulatan gaji pns', 1, 'THN', 26000, 26000, 0, 1567, 3359, 1748, 1790, 1690, 1820, 1643, 1611, 1536, 0, 500, 8736, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(7, '054.01.WA.2886.EBA.994.001.A.511119', 328, 'belanja pembulatan gaji pns (gaji ke 13)', 1, 'BLN', 2000, 2000, 0, 0, 0, 0, 0, 0, 1590, 0, 0, 0, 0, 0, 410, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(8, '054.01.WA.2886.EBA.994.001.A.511119', 329, 'belanja pembulatan gaji pns (gaji ke 14)', 1, 'BLN', 2000, 2000, 0, 0, 0, 1446, 0, 120, 0, 0, 0, 0, 0, 0, 434, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(9, '054.01.WA.2886.EBA.994.001.A.511121', 330, 'tunj.suami/istri pns', 1, 'THN', 69944000, 69944000, 0, 5294290, 6141150, 5717720, 5717720, 5717720, 5757740, 5755210, 5624960, 6041930, 5741280, 5741280, 6693000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(10, '054.01.WA.2886.EBA.994.001.A.511121', 331, 'tunj.suami/istri pns (gaji ke 13)', 1, 'BLN', 5732000, 5732000, 0, 0, 0, 0, 0, 0, 5731060, 0, 0, 0, 0, 0, 940, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(11, '054.01.WA.2886.EBA.994.001.A.511121', 332, 'tunj.suami/istri pns (gaji ke 14)', 1, 'BLN', 5718000, 5718000, 0, 0, 0, 5717720, 0, 0, 0, 0, 0, 0, 0, 0, 280, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(12, '054.01.WA.2886.EBA.994.001.A.511122', 333, 'tunj. anak pns', 1, 'THN', 19057000, 19057000, 0, 1490560, 1728988, 1609774, 1609774, 1609774, 1625782, 1624770, 1543006, 1548018, 1490306, 1490306, 1685942, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(13, '054.01.WA.2886.EBA.994.001.A.511122', 334, 'tunj. anak pns (gaji ke 13)', 1, 'BLN', 1616000, 1616000, 0, 0, 0, 0, 0, 0, 1615110, 0, 0, 0, 0, 0, 890, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(14, '054.01.WA.2886.EBA.994.001.A.511122', 335, 'tunj. anak pns (gaji ke 14)', 1, 'BLN', 1610000, 1610000, 0, 0, 0, 1609774, 0, 0, 0, 0, 0, 0, 0, 0, 226, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(15, '054.01.WA.2886.EBA.994.001.A.511123', 336, 'tunj. struktural pns', 1, 'THN', 21600000, 21600000, 0, 1800000, 1800000, 1800000, 1800000, 1800000, 1800000, 1800000, 1800000, 1800000, 1800000, 1800000, 1800000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(16, '054.01.WA.2886.EBA.994.001.A.511123', 337, 'tunj. struktural pns (gaji ke 13)', 1, 'BLN', 1800000, 1800000, 0, 0, 0, 0, 0, 0, 1800000, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(17, '054.01.WA.2886.EBA.994.001.A.511123', 338, 'tunj. struktural pns (gaji ke 14)', 1, 'BLN', 1800000, 1800000, 0, 0, 0, 1800000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(18, '054.01.WA.2886.EBA.994.001.A.511124', 339, 'tunj. fungsional pns', 1, 'THN', 130920000, 130920000, 0, 9840000, 9840000, 10440000, 10140000, 13400000, 11360000, 11360000, 10260000, 10260000, 9720000, 9720000, 14580000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(19, '054.01.WA.2886.EBA.994.001.A.511124', 340, 'tunj. fungsional pns (gaji ke 13)', 1, 'BLN', 12320000, 12320000, 0, 0, 0, 0, 0, 0, 12320000, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(20, '054.01.WA.2886.EBA.994.001.A.511124', 341, 'tunj. fungsional pns (gaji ke 14)', 1, 'BLN', 10920000, 10920000, 0, 0, 0, 9840000, 0, 1080000, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(21, '054.01.WA.2886.EBA.994.001.A.511125', 342, 'tunj. pph pns', 1, 'THN', 1358000, 1358000, 0, 14937, 101646, 51575, 51575, 120339, 51575, 51575, 51575, 51575, 51575, 378075, 381978, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(22, '054.01.WA.2886.EBA.994.001.A.511125', 343, 'tunj. pph pns (gaji ke 13)', 1, 'BLN', 4111000, 4111000, 0, 0, 0, 0, 0, 0, 3970625, 0, 0, 0, 0, 0, 140375, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(23, '054.01.WA.2886.EBA.994.001.A.511125', 344, 'tunj. pph pns (gaji ke 14)', 1, 'BLN', 3855000, 3855000, 0, 0, 0, 3854927, 0, 0, 0, 0, 0, 0, 0, 0, 73, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(24, '054.01.WA.2886.EBA.994.001.A.511126', 345, 'tunj. beras pns', 1, 'THN', 66917000, 66917000, 0, 4779720, 4779720, 9559440, 4779720, 4779720, 9559440, 4779720, 4634880, 4707300, 4490040, 4707540, 5359760, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(25, '054.01.WA.2886.EBA.994.001.A.511129', 346, 'uang makan pns', 1, 'THN', 178258000, 178258000, 0, 0, 19054000, 16236000, 16372000, 11910000, 13829000, 14066000, 17860000, 16723000, 15000000, 17205000, 20003000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(26, '054.01.WA.2886.EBA.994.001.A.511151', 347, 'tunj. umum pns', 1, 'THN', 17920000, 17920000, 0, 1650000, 1650000, 1650000, 1650000, 1280000, 1280000, 1280000, 1280000, 1280000, 1280000, 1820000, 1820000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(27, '054.01.WA.2886.EBA.994.001.A.511151', 348, 'tunj. umum pns (gaji ke 13)', 1, 'BLN', 1433000, 1433000, 0, 0, 0, 0, 0, 0, 1280000, 0, 0, 0, 0, 0, 153000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(28, '054.01.WA.2886.EBA.994.001.A.511151', 349, 'tunj. umum pns (gaji ke 14)', 1, 'BLN', 1650000, 1650000, 0, 0, 0, 1650000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(29, '054.01.WA.2886.EBA.994.001.A.512211', 350, 'belanja uang lembur', 1, 'THN', 30708000, 30708000, 0, 0, 545000, 0, 0, 0, 0, 0, 1228000, 4593000, 0, 0, 24342000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(30, '054.01.WA.2886.EBA.994.001.A.512411', 351, 'belanja pegawai (tunjangan khusus/kegiatan/kinerja)', 1, 'THN', 1807396000, 1807396000, 0, 134823338, 129852296, 129961095, 263430277, 132748261, 261792936, 127413775, 123755375, 123446025, 119421239, 127514500, 133236883, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(31, '054.01.WA.2886.EBA.994.002.A.521111', 352, 'biaya pengurusan surat kendaraaan eselon iii', 2, 'U/THN', 950000, 1900000, 0, 0, 0, 0, 0, 0, 0, 0, 505300, 0, 0, 1394700, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(32, '054.01.WA.2886.EBA.994.002.A.521111', 353, 'biaya pengurusan surat kendaraan roda 2', 4, 'U/THN', 114000, 456000, 0, 0, 0, 436000, 0, 0, 0, 0, 0, 0, 0, 0, 20000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(33, '054.01.WA.2886.EBA.994.002.A.521111', 354, 'keperluan sehari-hari perkantoran', 1, 'TAHUN', 15620000, 15620000, 0, 0, 1280416, 2271000, 270000, 530411, 1058000, 1311576, 3587500, 0, 1500000, 3500000, 311097, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(34, '054.01.WA.2886.EBA.994.002.A.521111', 356, 'pengiriman dokumen', 1, 'Paket', 300000, 300000, 0, 0, 0, 21000, 0, 0, 0, 0, 22400, 0, 11200, 11200, 234200, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(35, '054.01.WA.2886.EBA.994.002.A.521115', 357, 'bendahara', 12, 'O-B', 430000, 5160000, 0, 0, 516000, 516000, 0, 1032000, 516000, 516000, 344000, 0, 688000, 344000, 688000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(36, '054.01.WA.2886.EBA.994.002.A.521115', 358, 'Kuasa Pengguna Anggaran', 12, 'O-B', 1036000, 12432000, 0, 0, 1036000, 1036000, 0, 2072000, 1036000, 1036000, 1036000, 0, 2072000, 1036000, 2072000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(37, '054.01.WA.2886.EBA.994.002.A.521115', 359, 'Pejabat Pembuat Komitmen', 12, 'O-B', 1512000, 18144000, 0, 0, 1512000, 1512000, 0, 3024000, 1512000, 1512000, 1512000, 0, 3024000, 1512000, 3024000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(38, '054.01.WA.2886.EBA.994.002.A.521115', 360, 'Pejabat Penandatanganan SPM', 12, 'O-B', 396000, 4752000, 0, 0, 396000, 396000, 0, 792000, 396000, 396000, 396000, 0, 792000, 396000, 792000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(39, '054.01.WA.2886.EBA.994.002.A.521115', 361, 'Pejabat Pengadaan', 12, 'O-B', 408000, 4896000, 0, 0, 0, 816000, 0, 816000, 408000, 408000, 408000, 0, 816000, 408000, 816000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(40, '054.01.WA.2886.EBA.994.002.A.521115', 392, ' Staf Pengelola Keuangan', 12, 'O-B', 256000, 3072000, 0, 0, 0, 512000, 0, 512000, 256000, 256000, 256000, 0, 512000, 256000, 512000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(41, '054.01.WA.2886.EBA.994.002.A.521115', 362, 'pengurus/penyimpan bmn', 12, 'O-B', 180000, 2160000, 0, 0, 180000, 180000, 0, 360000, 180000, 180000, 180000, 0, 360000, 180000, 360000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(42, '054.01.WA.2886.EBA.994.002.A.521119', 363, 'Pakaian Seragam Pegawai', 56, 'STEL', 457250, 25606000, 0, 0, 0, 25606000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(43, '054.01.WA.2886.EBA.994.002.A.521119', 393, 'Pengadaan Tanda pengenal (Badge) Pegawai', 28, 'SET', 150000, 4200000, 0, 0, 0, 0, 0, 0, 0, 0, 2600000, 0, 0, 400000, 1200000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(44, '054.01.WA.2886.EBA.994.002.A.521252', 396, 'Belanja Pembelian Peralatan Kantor', 1, 'THN', 17880000, 17880000, 0, 0, 0, 1550000, 0, 0, 0, 0, 0, 0, 0, 16330000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(45, '054.01.WA.2886.EBA.994.002.A.521811', 364, 'Alat Tulis Kantor (ATK)', 1, 'PAKET', 15017000, 15017000, 0, 0, 6017000, 0, 0, 0, 0, 0, 580000, 0, 2800000, 2800000, 2820000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(46, '054.01.WA.2886.EBA.994.002.A.521811', 365, 'Computer Supplies', 1, 'PAKET', 16355000, 16355000, 0, 0, 0, 1795000, 0, 0, 450000, 0, 3152000, 0, 3000000, 3000000, 4958000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(47, '054.01.WA.2886.EBA.994.002.A.522111', 366, 'biaya langganan listrik', 1, 'THN', 45072000, 45072000, 0, 0, 3159027, 3687581, 3293290, 3968003, 6007041, 0, 7795345, 0, 7594651, 3800000, 5767062, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(48, '054.01.WA.2886.EBA.994.002.A.522112', 367, 'biaya langganan telepon', 1, 'THN', 840000, 840000, 0, 0, 77425, 69100, 69100, 69100, 138200, 0, 138200, 0, 138200, 69100, 71575, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(49, '054.01.WA.2886.EBA.994.002.A.522113', 368, 'Biaya langganan air', 1, 'THN', 4896000, 4896000, 0, 0, 138200, 120400, 173800, 103000, 206000, 0, 536000, 0, 1986000, 800000, 832600, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(50, '054.01.WA.2886.EBA.994.002.A.522119', 467, ' Koneksi Internet', 12, 'BLN', 1000000, 12000000, 0, 0, 984850, 984850, 984850, 984850, 1969700, 0, 1969700, 0, 1969700, 984850, 1166650, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(51, '054.01.WA.2886.EBA.994.002.A.522191', 369, 'biaya jasa manajemen building', 1, 'Paket', 297377000, 297377000, 0, 0, 0, 0, 36561971, 0, 94749219, 0, 0, 62453305, 0, 0, 103612505, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(52, '054.01.WA.2886.EBA.994.002.A.523111', 370, 'pemeliharaan halaman kantor', 342, 'M2/TH', 11000, 3762000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3762000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(53, '054.01.WA.2886.EBA.994.002.A.523111', 371, 'pemeliharaan gedung kantor', 240, 'M2/TH', 148000, 35520000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 35520000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(54, '054.01.WA.2886.EBA.994.002.A.523112', 394, 'Persediaan Pemeliharaan Gedung Kantor', 1, 'THN', 1000000, 1000000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1000000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(55, '054.01.WA.2886.EBA.994.002.A.523121', 372, 'inventaris kantor', 27, 'O-TH', 60000, 1620000, 0, 0, 0, 0, 0, 850000, 0, 0, 0, 0, 0, 0, 770000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(56, '054.01.WA.2886.EBA.994.002.A.523121', 373, 'pemeliharaan air conditioner/AC', 8, 'U/THN', 383000, 3064000, 0, 0, 300000, 0, 0, 250000, 0, 650000, 0, 0, 600000, 600000, 664000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(57, '054.01.WA.2886.EBA.994.002.A.523121', 374, 'Pemeliharaan genset', 1, 'U/THN', 618000, 618000, 0, 0, 0, 0, 0, 120000, 0, 0, 0, 0, 0, 0, 498000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(58, '054.01.WA.2886.EBA.994.002.A.523121', 375, 'pemeliharaan kendaraan operasional eselon iii', 2, 'U/THN', 20099000, 40198000, 0, 0, 4890185, 2300040, 0, 2899895, 0, 3745000, 2720000, 0, 6000000, 14642880, 3000000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(59, '054.01.WA.2886.EBA.994.002.A.523121', 376, 'pemeliharaan kendaraan operasional roda 2', 2, 'U/THN', 1751000, 3502000, 0, 0, 0, 951000, 98000, 452000, 0, 0, 444085, 0, 500000, 500000, 556915, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(60, '054.01.WA.2886.EBA.994.002.A.523121', 377, 'pemeliharaan pc/laptop/notebook', 10, 'U/THN', 100000, 1000000, 0, 0, 0, 50000, 0, 0, 0, 0, 0, 0, 0, 950000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(61, '054.01.WA.2886.EBA.994.002.A.523121', 378, 'pemeliharaan printer', 14, 'U/THN', 101000, 1414000, 0, 0, 275000, 0, 0, 0, 0, 0, 270000, 0, 0, 869000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(62, '054.01.WA.2886.EBA.994.002.A.523121', 379, 'pemeliharaan jaringan listrik, telepon dan komputer', 1, 'THN', 1284000, 1284000, 0, 0, 0, 0, 0, 0, 0, 200000, 0, 0, 0, 1084000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(63, '054.01.WA.2886.EBA.994.002.A.524111', 380, 'Konsultasi kab/kota ke propinsi (Transport Perjalanan)', 22, 'O-P', 3040000, 66880000, 0, 0, 2540000, 3394000, 1680000, 3116395, 1440000, 20144000, 16052900, 0, 9662705, 6000000, 2850000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(64, '054.01.WA.2886.EBB.951.053.A.532111', 583, 'Pengadaan Laptop', 3, 'UNIT', 23779000, 71337000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 71337000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(65, '054.01.WA.2886.EBD.952.051.A.524111', 387, 'Perjalanan ke DJPB', 2, 'OP', 3126500, 6253000, 0, 0, 0, 0, 0, 2713000, 0, 0, 0, 0, 0, 3540000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(66, '054.01.WA.2886.EBD.955.051.A.521115', 382, 'Pengelola SAI tingkat satuan: koordinator', 12, 'O-B', 100000, 1200000, 0, 0, 100000, 100000, 0, 200000, 100000, 100000, 100000, 0, 200000, 100000, 200000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(67, '054.01.WA.2886.EBD.955.051.A.521115', 383, 'Pengelola SAI tingkat satuan kerja: ketua', 12, 'O-B', 80000, 960000, 0, 0, 80000, 80000, 0, 160000, 80000, 80000, 80000, 0, 160000, 80000, 160000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(68, '054.01.WA.2886.EBD.955.051.A.521115', 384, 'Pengelola SAI tingkat satuan kerja: anggota', 24, 'O-B', 82500, 1980000, 0, 0, 180000, 180000, 0, 360000, 180000, 180000, 150000, 0, 300000, 150000, 300000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(69, '054.01.WA.2886.EBD.955.051.A.524111', 397, 'Konsultasi Administrasi', 2, 'O-P', 3690000, 7380000, 0, 0, 0, 0, 0, 0, 0, 2091000, 1820000, 0, 0, 0, 3469000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(70, '054.01.GG.2896.BMA.004.005.A.521811', 558, 'Alat Tulis Kantor (ATK)', 1, 'PAKET', 600000, 600000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 600000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(71, '054.01.GG.2897.BDB.003.054.A.521211', 482, 'Konsumsi Pembinaan Statistik Sektoral', 65, 'PAKET', 68000, 4420000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1904000, 2516000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(72, '054.01.GG.2897.BDB.003.052.A.522151', 4, 'honor narasumber eselon ii/ ke bawah', 1, 'O-J', 1000000, 1000000, 0, 0, 0, 0, 0, 1000000, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(73, '054.01.GG.2897.BDB.003.054.A.524111', 481, 'Perjalanan dinas ke BPS Provinsi', 1, 'PAKET', 7560000, 7560000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7560000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(74, '054.01.GG.2897.BDB.003.054.A.524119', 490, 'Perjalanan rapat pleno provinsi epss', 1, 'PAKET', 7150000, 7150000, 0, 0, 0, 0, 0, 0, 0, 0, 7150000, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(75, '054.01.GG.2897.BMA.004.005.A.521211', 479, 'ATK dan Computer Supplies', 1, 'PAKET', 1000000, 1000000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1000000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(76, '054.01.GG.2897.BMA.004.052.A.521211', 388, 'Konsumsi FGD KDA 2024', 35, 'PAKET', 68000, 2380000, 0, 0, 0, 2380000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:28'),
(77, '054.01.GG.2897.BMA.004.053.A.524111', 480, 'Perjalanan Dinas ke BPS Provinsi', 1, 'PAKET', 16424000, 16424000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 15644000, 780000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(78, '054.01.GG.2898.BMA.007.051.A.521211', 25, 'perlengkapan pelatihan SKTDNPENG', 8, 'PAKET', 50000, 400000, 0, 0, 0, 0, 0, 0, 0, 400000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(79, '054.01.GG.2898.BMA.007.051.A.521211', 26, 'konsumsi pelatihan SKTDNPENG', 9, 'PAKET', 55000, 495000, 0, 0, 0, 0, 0, 0, 0, 495000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(80, '054.01.GG.2898.BMA.007.051.A.521211', 419, 'paket data pelatihan SKTDNPENG', 5, 'PAKET', 115000, 575000, 0, 0, 0, 0, 0, 0, 0, 575000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(81, '054.01.GG.2898.BMA.007.005.A.521213', 14, 'honor petugas pendataan lapangan sklnpt', 40, 'DOK', 65000, 2600000, 0, 0, 0, 0, 0, 650000, 0, 650000, 0, 0, 650000, 0, 650000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(82, '054.01.GG.2898.BMA.007.005.A.521213', 15, 'honor petugas pendataan lapangan skps', 7, 'DOK', 68000, 476000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 476000, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(83, '054.01.GG.2898.BMA.007.005.A.521213', 16, 'honor petugas pendataan lapangan sksppi', 15, 'DOK', 75000, 1125000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1125000, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(84, '054.01.GG.2898.BMA.007.005.A.521213', 17, 'honor petugas pendataan lapangan updating direktori lnprt', 10, 'DOK', 50000, 500000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 500000, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(85, '054.01.GG.2898.BMA.007.005.A.521213', 415, 'honor petugas pendataan lapangan sklnp', 7, 'DOK', 73000, 511000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 511000, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(86, '054.01.GG.2898.BMA.007.005.A.521213', 416, 'honor petugas pendataan lapangan sksip', 2, 'DOK', 55000, 110000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 110000, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(87, '054.01.GG.2898.BMA.007.051.A.521213', 27, 'honor pengajar petugas pendataan SKTDNPENG', 20, 'OJP', 111000, 2220000, 0, 0, 0, 0, 0, 0, 2220000, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(88, '054.01.GG.2898.BMA.007.053.A.524111', 466, 'Konsultasi kab/kot ke provinsi', 5, 'O-P', 4708600, 23543000, 0, 0, 0, 0, 0, 0, 0, 0, 7320000, 0, 230000, 7822000, 8171000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(89, '054.01.GG.2898.BMA.007.005.A.524113', 18, 'transport lokal', 2, 'O-K', 110000, 220000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 220000, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(90, '054.01.GG.2898.BMA.007.051.A.524113', 465, 'transport lokal pelatihan SKTDNPENG', 5, 'O-K', 110000, 550000, 0, 0, 0, 0, 0, 0, 0, 550000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(91, '054.01.GG.2898.QMA.008.005.A.521811', 582, 'Alat Tulis Kantor (ATK)', 1, 'PAKET', 1130000, 1130000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1130000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(92, '054.01.GG.2898.QMA.008.005.A.524113', 35, 'transport lokal', 2, 'O-K', 110000, 220000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 220000, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(93, '054.01.GG.2899.BMA.006.005.A.521213', 37, 'honor petugas pendataan lapangan sksj 2024', 8, 'DOK', 60000, 480000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 480000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(94, '054.01.GG.2899.BMA.006.005.A.521213', 38, 'honor petugas pendataan lapangan sktnp jasa 2024', 8, 'DOK', 55000, 440000, 0, 0, 0, 0, 0, 220000, 0, 110000, 0, 0, 110000, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(95, '054.01.GG.2899.BMA.006.005.A.521213', 420, 'honor petugas pendataan lapangan survei khusus neraca produksi', 46, 'DOK', 60000, 2760000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2760000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(96, '054.01.GG.2899.BMA.006.005.A.521213', 421, 'honor petugas pendataan lapangan in-depth study seea', 4, 'DOK', 75000, 300000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300000, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(97, '054.01.GG.2899.BMA.006.051.A.524111', 483, 'Konsultasi kab/kot ke provinsi', 2, 'O-P', 3847000, 7694000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3531000, 4163000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(98, '054.01.GG.2899.BMA.006.005.A.524113', 39, 'transport lokal', 10, 'O-K', 128000, 1280000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1280000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(99, '054.01.GG.2900.BMA.005.052.A.521211', 536, 'Konsumsi Rapat', 11, 'OK', 17000, 187000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 187000, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(100, '054.01.GG.2900.BMA.005.052.A.524111', 557, 'Perjalanan dinas ke BPS Provinsi', 1, 'PAKET', 3248000, 3248000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3248000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(101, '054.01.GG.2900.BMA.005.052.A.524113', 537, 'Perjalanan dinas dalam rangka Pengembangan Mixed Method BPS Kabupaten/Kota', 2, 'OP', 150000, 300000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300000, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(102, '054.01.GG.2900.BMA.005.052.A.524113', 556, 'Perjalanan penunjuk jalan kegiatan Pengembangan Mixed Method', 3, 'OP', 135000, 405000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 405000, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(103, '054.01.GG.2902.BMA.004.051.A.521211', 56, 'paket data/biaya komunikasi pelatihan petugas survei rutin distribusi', 1, 'PAKET', 150000, 150000, 0, 0, 0, 0, 0, 0, 0, 50000, 100000, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(104, '054.01.GG.2902.BMA.004.051.A.521211', 57, 'konsumsi pelatihan petugas survei rutin distribusi', 8, 'O-K', 170000, 1360000, 1360000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1360000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(105, '054.01.GG.2902.BMA.004.005.A.521213', 48, 'Honor petugas pendataan lapangan updating profil pasar 2024', 21, 'Dok', 50000, 1050000, 0, 0, 0, 0, 0, 0, 0, 1050000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(106, '054.01.GG.2902.BMA.004.005.A.521213', 49, 'Honor petugas pendataan lapangan survei perdagangan antar wilayah', 28, 'Resp', 60000, 1680000, 1680000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1680000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(107, '054.01.GG.2902.BMA.004.005.A.521213', 402, 'Honor petugas pendataan lapangan survei pergudangan', 8, 'Dok', 73000, 584000, 0, 0, 0, 0, 0, 0, 0, 0, 584000, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(108, '054.01.GG.2902.BMA.004.051.A.521213', 58, 'honor pengajar pelatihan petugas survei rutin distribusi', 18, 'OJP', 123000, 2214000, 2214000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2214000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(109, '054.01.GG.2902.BMA.004.051.A.521213', 450, 'Honor pengajar pelatihan petugas updating profil pasar', 5, 'OJP', 111000, 555000, 0, 0, 0, 0, 0, 0, 0, 555000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(110, '054.01.GG.2902.BMA.004.005.A.521811', 578, 'ATK dan Computer Supplies', 1, 'PAKET', 1695000, 1695000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1695000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(111, '054.01.GG.2902.BMA.004.005.A.524113', 54, 'Transport lokal petugas pemeriksaan lapangan survei perdagangan antar wilayah', 2, 'O-K', 150000, 300000, 300000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(112, '054.01.GG.2902.BMA.004.051.A.524113', 59, 'Transport pelatihan petugas survei rutin distribusi', 8, 'O-K', 700000, 5600000, 5600000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5600000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(113, '054.01.GG.2902.QMA.006.503.A.521211', 468, ' Biaya konsumsi pelatihan petugas lapangan updating direktori usaha/perusahaan ekonomi', 7, 'PAKET', 17000, 119000, 0, 0, 0, 0, 0, 0, 0, 0, 119000, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(114, '054.01.GG.2902.QMA.006.503.A.521211', 469, 'Biaya pulsa pelatihan petugas lapangan updating direktori usaha/perusahaan ekonomi', 4, 'PAKET', 60000, 240000, 0, 0, 0, 0, 0, 0, 0, 240000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(115, '054.01.GG.2902.QMA.006.005.A.521213', 60, 'Honor petugas pendataan lapangan updating direktori usaha perusahaan ekonomi', 76, 'Dok', 50000, 3800000, 0, 0, 0, 0, 0, 0, 0, 0, 3800000, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(116, '054.01.GG.2902.QMA.006.503.A.521213', 63, 'Honor inda pelatihan updating direktori usaha/perusahaan ekonomi', 11, 'OJP', 111000, 1221000, 0, 0, 0, 0, 0, 0, 1221000, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(117, '054.01.GG.2902.QMA.006.005.A.521811', 560, 'ATK dan Computer Supplies', 1, 'PAKET', 1860000, 1860000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1860000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(118, '054.01.GG.2902.QMA.006.005.A.524113', 405, 'transport lokal petugas pencaahan lapangan Updating Direktori Usaha/Perusahaan Ekonomi', 16, 'O-K', 113125, 1810000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1810000, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(119, '054.01.GG.2902.QMA.006.503.A.524113', 65, 'Transport pelatihan petugas lapangan', 4, 'O-K', 116250, 465000, 0, 0, 0, 0, 0, 0, 0, 465000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(120, '054.01.GG.2903.BMA.009.051.A.521211', 389, 'Konsumsi pelatihan petugas SHPBG', 5, 'PAKET', 55000, 275000, 0, 0, 0, 275000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(121, '054.01.GG.2903.BMA.009.051.A.521211', 101, 'perlengkapan fullboard pelatihan petugas penyusunan ikp', 25, 'SET', 150000, 3750000, 3750000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3750000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(122, '054.01.GG.2903.BMA.009.005.A.521213', 66, 'honor petugas pendataan lapangan ikp 2024', 385, 'DOK', 62000, 23870000, 23870000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 23870000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(123, '054.01.GG.2903.BMA.009.005.A.521213', 71, 'honor petugas pendataan lapangan survei harga perdagangan besar (non pns)', 180, 'DOK', 50000, 9000000, 0, 0, 750000, 750000, 750000, 1500000, 0, 750000, 750000, 750000, 750000, 750000, 1500000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(124, '054.01.GG.2903.BMA.009.005.A.521213', 72, 'honor petugas pendataan lapangan survei harga konsumen perdesaan (hkd) non pns', 108, 'DOK', 65000, 7020000, 0, 0, 585000, 585000, 585000, 585000, 585000, 585000, 585000, 585000, 585000, 585000, 1170000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(125, '054.01.GG.2903.BMA.009.005.A.521213', 73, 'honor petugas pendataan lapangan survei harga produsen perdesaan (hd) non pns', 192, 'DOK', 55000, 10560000, 0, 0, 880000, 880000, 880000, 880000, 880000, 880000, 880000, 880000, 880000, 880000, 1760000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(126, '054.01.GG.2903.BMA.009.005.A.521213', 74, 'honor petugas pendataan lapangan hpbg', 48, 'DOK', 55000, 2640000, 0, 0, 220000, 220000, 220000, 220000, 220000, 220000, 220000, 220000, 220000, 220000, 440000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(127, '054.01.GG.2903.BMA.009.005.A.521213', 75, 'honor petugas pengolahan data hasil ikp(non PNS)', 282, 'DOK', 14000, 3948000, 3948000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3948000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(128, '054.01.GG.2903.BMA.009.005.A.521213', 76, 'honor petugas pendataan lapangan hpg', 180, 'DOK', 50000, 9000000, 0, 0, 750000, 750000, 750000, 0, 1500000, 750000, 750000, 750000, 750000, 750000, 1500000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(129, '054.01.GG.2903.BMA.009.005.A.521213', 77, 'honor petugas pendataan lapangan paket komoditas shkk (non pns)', 108, 'DOK', 60000, 6480000, 0, 0, 1200000, 0, 0, 1200000, 0, 0, 1080000, 0, 0, 3000000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(130, '054.01.GG.2903.BMA.009.005.A.521213', 78, 'honor petugas listing svpeb', 1, 'PASAR', 228000, 228000, 0, 0, 0, 0, 0, 0, 228000, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(131, '054.01.GG.2903.BMA.009.005.A.521213', 81, 'honor petugas pendataan lapangan hk 1.1, 1.2, 4, 5 dan 6 (non pns)', 1128, 'DOK', 50000, 56400000, 0, 0, 4700000, 4700000, 4700000, 4700000, 4700000, 4700000, 4700000, 4700000, 4700000, 4700000, 9400000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(132, '054.01.GG.2903.BMA.009.005.A.521213', 82, 'honor petugas pendataan lapangan hk 2.1, 2.2, dan 3 (non pns)', 348, 'DOK', 65000, 22620000, 0, 0, 1885000, 1885000, 1885000, 1885000, 1885000, 1885000, 1885000, 1885000, 1885000, 1885000, 3770000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(133, '054.01.GG.2903.BMA.009.005.A.521213', 67, 'honor petugas pendataan lapangan svk (non pns)', 40, 'DOK', 65000, 2600000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2600000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(134, '054.01.GG.2903.BMA.009.005.A.521213', 68, 'honor petugas pendataan lapangan svpeb (non pns)', 60, 'DOK', 50000, 3000000, 0, 0, 0, 0, 0, 0, 1500000, 0, 0, 0, 0, 1500000, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(135, '054.01.GG.2903.BMA.009.051.A.521213', 390, 'honor innas pelatihan petugas SHPBG', 7, 'OJP', 111000, 777000, 0, 0, 0, 777000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(136, '054.01.GG.2903.BMA.009.051.A.521213', 103, 'honor innas pelatihan petugas penyusunan ikp', 18, 'OJP', 123000, 2214000, 2214000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2214000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(137, '054.01.GG.2903.BMA.009.051.A.521219', 104, 'penggantian contoh gabah untuk survei hpg', 75, 'PAKET', 10000, 750000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 600000, 150000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(138, '054.01.GG.2903.BMA.009.051.A.521219', 443, 'penggantian contoh beras untuk survei hpbg shp', 48, 'PAKET', 12000, 576000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 528000, 48000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(139, '054.01.GG.2903.BMA.009.005.A.524111', 451, 'Perjalanan dinas ke BPS Provinsi', 10, 'O-P', 3126800, 31268000, 0, 0, 0, 0, 0, 0, 0, 7712000, 0, 0, 5410000, 0, 18146000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(140, '054.01.GG.2903.BMA.009.005.A.524113', 579, 'transport lokal petugas pemeriksaan lapangan hpbg', 4, 'O-K', 135000, 540000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 540000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(141, '054.01.GG.2903.BMA.009.005.A.524113', 580, 'transport lokal petugas pemeriksaan lapangan dokumen hasil survei harga perdagangan besar (pns)', 2, 'O-K', 150000, 300000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(142, '054.01.GG.2903.BMA.009.005.A.524113', 581, 'transport lokal petugas pemeriksaan lapangan hp (kabkot)', 2, 'O-K', 150000, 300000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300000, 1, '2024-11-10 20:35:00', '2024-11-10 20:35:29'),
(143, '054.01.GG.2903.BMA.009.005.A.524113', 561, 'transport lokal petugas pemeriksaan lapangan hk 1.1, 1.2, 4, 5 dan 6', 4, 'O-K', 110000, 440000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 330000, 110000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(144, '054.01.GG.2903.BMA.009.005.A.524113', 83, 'transport lokal petugas pemeriksaan lapangan ikp 2024 (kabkot)', 44, 'O-K', 150000, 6600000, 6600000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6600000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(145, '054.01.GG.2903.BMA.009.005.A.524113', 92, 'translok petugas pengolahan data hasil ikp (PNS) (kabkot)', 10, 'O-K', 150000, 1500000, 1500000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1500000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(146, '054.01.GG.2903.BMA.009.005.A.524113', 505, 'transport lokal petugas pemeriksaan lapangan data hasil pencacahan shkk (kabkot)', 2, 'O-K', 122500, 245000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 245000, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(147, '054.01.GG.2903.BMA.009.005.A.524113', 511, 'transport lokal petugas pemeriksaan lapangan svk', 2, 'O-K', 150000, 300000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(148, '054.01.GG.2903.BMA.009.005.A.524113', 516, 'transport lokal petugas pemeriksaan lapangan survei harga produsen perdesaan (hd)', 12, 'O-K', 141250, 1695000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 600000, 1095000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(149, '054.01.GG.2903.BMA.009.051.A.524113', 391, 'Transport peserta pelatihan petugas SHPBG', 2, 'O-K', 135000, 270000, 0, 0, 0, 270000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(150, '054.01.GG.2903.BMA.009.051.A.524114', 105, 'paket meeting pelatihan petugas lapangan ikp (kabkot)', 25, 'O-P', 1300000, 32500000, 32500000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 32500000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(151, '054.01.GG.2903.BMA.009.051.A.524114', 106, 'transpot dan uang harian paket meeting pelatihan petugas lapangan ikp (kabkot)', 25, 'O-P', 472000, 11800000, 11800000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 11800000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(152, '054.01.GG.2904.BMA.006.005.A.521211', 444, 'biaya pulsa/paket data pelatihan petugas stpim', 1, 'PAKET', 100000, 100000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(153, '054.01.GG.2904.BMA.006.051.A.521211', 545, 'Konsumsi Pelatihan Petugas', 8, 'O-K', 85000, 680000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 680000, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(154, '054.01.GG.2904.BMA.006.051.A.521211', 546, 'Perlengkapan Peserta Pelatihan Petugas', 8, 'SET', 50000, 400000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300000, 0, 100000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(155, '054.01.GG.2904.BMA.006.005.A.521213', 116, 'honor petugas pendataan lapangan pemutakhiran dpa 2024', 3, 'DOK', 30000, 90000, 0, 0, 0, 0, 0, 0, 90000, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(156, '054.01.GG.2904.BMA.006.005.A.521213', 117, 'honor petugas pendataan lapangan survei konstruksi triwulanan (sktr)', 16, 'DOK', 60000, 960000, 0, 240000, 0, 0, 0, 240000, 0, 0, 240000, 0, 240000, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(157, '054.01.GG.2904.BMA.006.005.A.521213', 119, 'honor petugas pendataan lapangan survei captive power', 6, 'DOK', 55000, 330000, 0, 0, 0, 0, 0, 0, 0, 0, 330000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(158, '054.01.GG.2904.BMA.006.005.A.521213', 120, 'honor petugas pendataan lapangan survei usaha penggalian', 30, 'DOK', 55000, 1650000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1650000, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(159, '054.01.GG.2904.BMA.006.005.A.521213', 121, 'honor petugas pendataan lapangan survei triwulanan air bersih', 4, 'DOK', 44000, 176000, 0, 0, 0, 0, 0, 44000, 0, 0, 44000, 0, 44000, 0, 44000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(160, '054.01.GG.2904.BMA.006.005.A.521213', 122, 'honor petugas pendataan lapangan survei air bersih', 1, 'DOK', 55000, 55000, 0, 0, 0, 0, 0, 0, 0, 0, 55000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(161, '054.01.GG.2904.BMA.006.005.A.521213', 123, 'honor petugas pendataan lapangan survei ibs tahunan (stpim) 2024', 1, 'DOK', 78000, 78000, 0, 0, 0, 0, 0, 0, 78000, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(162, '054.01.GG.2904.BMA.006.005.A.521213', 124, 'honor petugas pendataan lapangan listing vimk24 tahunan', 28, 'BS', 228000, 6384000, 0, 0, 0, 0, 0, 0, 0, 0, 6384000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(163, '054.01.GG.2904.BMA.006.005.A.521213', 125, 'honor petugas pendataan lapangan vimk24 tahunan', 145, 'DOK', 55000, 7975000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7975000, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(164, '054.01.GG.2904.BMA.006.005.A.521213', 126, 'honor petugas pendataan lapangan listing vimk 2024 triwulanan', 13, 'BS', 228000, 2964000, 2964000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2964000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(165, '054.01.GG.2904.BMA.006.005.A.521213', 127, 'honor petugas pendataan lapangan vimk23 triwulanan triwulan 4', 33, 'DOK', 55000, 1815000, 0, 1815000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(166, '054.01.GG.2904.BMA.006.005.A.521213', 128, 'honor petugas pendataan lapangan vimk24 triwulanan', 198, 'DOK', 55000, 10890000, 10890000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10890000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(167, '054.01.GG.2904.BMA.006.005.A.521213', 129, 'honor petugas pendataan lapangan updating direktori perusahaan konstruksi (udp)', 50, 'DOK', 50000, 2500000, 0, 0, 0, 0, 2500000, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(168, '054.01.GG.2904.BMA.006.005.A.521213', 130, 'honor petugas pendataan lapangan survei konstruksi tahunan (skth)', 16, 'DOK', 73000, 1168000, 0, 0, 0, 0, 0, 0, 0, 1168000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(169, '054.01.GG.2904.BMA.006.051.A.521213', 547, 'Honor Mengajar Petugas', 9, 'OJP', 111000, 999000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 999000, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(170, '054.01.GG.2904.BMA.006.052.A.521213', 564, 'Honor Petugas Pendataan vimk24 triwulanan', 33, 'DOK', 55000, 1815000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1815000, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(171, '054.01.GG.2904.BMA.006.053.A.521213', 493, 'Honor Petugas Entri VIMK Tahunan 2024', 145, 'DOK', 11000, 1595000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1595000, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(172, '054.01.GG.2904.BMA.006.053.A.524111', 494, 'Konsultasi Ke BPS Provinsi', 2, 'O-P', 2440500, 4881000, 0, 0, 0, 0, 0, 0, 0, 0, 4880000, 0, 0, 0, 1000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(173, '054.01.GG.2904.BMA.006.005.A.524113', 141, 'transport lokal petugas pemeriksaan listing vimk24 triwulanan', 4, 'O-K', 150000, 600000, 600000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 600000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(174, '054.01.GG.2904.BMA.006.005.A.524113', 143, 'transport lokal petugas pemeriksaan vimk24 triwulanan', 24, 'O-K', 150000, 3600000, 1800000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1800000, 0, 1800000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(175, '054.01.GG.2904.BMA.006.051.A.524113', 548, 'Transport Peserta Pelatihan Petugas', 6, 'O-P', 212000, 1272000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 570000, 0, 702000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(176, '054.01.GG.2904.BMA.006.053.A.524113', 149, 'pengawasan pengolahan dan analisis imk tahunan dari kabupaten ke kecamatan', 1, 'O-P', 362000, 362000, 362000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 362000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(177, '054.01.GG.2905.BMA.004.051.A.521211', 163, 'perlengkapan petugas pelatihan sakernas februari', 12, 'SET', 48000, 576000, 0, 0, 576000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(178, '054.01.GG.2905.BMA.004.051.A.521211', 164, 'perlengkapan petugas pelatihan sakernas agustus', 45, 'SET', 50000, 2250000, 0, 0, 0, 0, 0, 0, 0, 0, 2250000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(179, '054.01.GG.2905.BMA.004.051.A.521211', 431, 'Biaya pulsa pelatihan sakernas februari', 8, 'PAKET', 78750, 630000, 0, 0, 0, 0, 0, 0, 0, 630000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(180, '054.01.GG.2905.BMA.004.051.A.521211', 565, 'Spanduk Pelatihan', 12, 'M2', 25000, 300000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300000, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(181, '054.01.GG.2905.BMA.004.005.A.521213', 491, 'Honor Pemeriksaan Pemutakhiran Sakernas Agustus', 4, 'DOK', 53000, 212000, 0, 0, 0, 0, 0, 0, 0, 0, 212000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(182, '054.01.GG.2905.BMA.004.005.A.521213', 492, 'Honor Pemeriksaan Pendataan Sakernas Agustus', 40, 'DOK', 23000, 920000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 920000, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(183, '054.01.GG.2905.BMA.004.005.A.521213', 150, 'honor petugas pendataan lapangan updating/listing BS (sakernas februari)', 14, 'Dok', 166000, 2324000, 0, 0, 2324000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(184, '054.01.GG.2905.BMA.004.005.A.521213', 151, 'honor petugas pendataan lapangan (sakernas februari)', 140, 'DOK', 67000, 9380000, 0, 0, 0, 9380000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(185, '054.01.GG.2905.BMA.004.005.A.521213', 152, 'honor petugas pendataan lapangan updating listing BS (sakernas agustus)', 56, 'DOK', 166000, 9296000, 0, 0, 0, 0, 0, 0, 0, 0, 9296000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(186, '054.01.GG.2905.BMA.004.005.A.521213', 154, 'honor petugas pendataan lapangan (sakernas agustus)', 560, 'DOK', 67000, 37520000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 37453000, 0, 0, 67000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(187, '054.01.GG.2905.BMA.004.051.A.521213', 167, 'honor pengajar pelatihan petugas sakernas februari', 25, 'OJP', 111000, 2775000, 0, 0, 0, 0, 0, 2775000, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(188, '054.01.GG.2905.BMA.004.051.A.521213', 168, 'honor pengajar pelatihan petugas sakernas agustus', 23, 'OJP', 111000, 2553000, 0, 0, 0, 0, 0, 0, 0, 0, 2553000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:29'),
(189, '054.01.GG.2905.BMA.004.054.A.524111', 489, 'Konsultasi kab/kot ke provinsi', 20, 'O-P', 2480500, 49610000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 49610000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(190, '054.01.GG.2905.BMA.004.005.A.524113', 160, 'transport lokal petugas pemeriksaan lapangan (sakernas agustus)', 15, 'O-K', 107000, 1605000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1605000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(191, '054.01.GG.2905.BMA.004.051.A.524114', 171, 'pelatihan petugas sakernas februari', 12, 'O-P', 240000, 2880000, 0, 0, 0, 0, 2880000, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(192, '054.01.GG.2905.BMA.004.051.A.524114', 172, 'perjalanan pelatihan petugas sakernas februari', 10, 'O-P', 230100, 2301000, 0, 0, 2300000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(193, '054.01.GG.2905.BMA.004.051.A.524114', 173, 'pelatihan petugas sakernas agustus', 45, 'O-P', 450000, 20250000, 0, 0, 0, 0, 0, 0, 0, 0, 20250000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(194, '054.01.GG.2905.BMA.004.051.A.524114', 174, 'perjalanan pelatihan petugas sakernas agustus', 45, 'O-P', 660000, 29700000, 0, 0, 0, 0, 0, 0, 0, 29070000, 0, 0, 0, 0, 630000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(195, '054.01.GG.2906.BMA.006.051.A.521211', 531, 'perlengkapan pelatihan petugas susenas msbp 2024 di kabupaten/kota', 26, 'SET', 50000, 1300000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1250000, 0, 50000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(196, '054.01.GG.2906.BMA.006.051.A.521211', 204, 'perlengkapan petugas pelatihan petugas susenas maret 2024', 65, 'SET', 48000, 3120000, 0, 0, 3120000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(197, '054.01.GG.2906.BMA.006.051.A.521211', 429, 'biaya pulsa pelatihan petugas susenas maret 2024', 123, 'PAKET', 30000, 3690000, 0, 0, 0, 0, 0, 0, 0, 3690000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(198, '054.01.GG.2906.BMA.006.051.A.521211', 473, 'konsumsi rapat persiapan seruti triwulan II', 3, 'O-K', 75000, 225000, 0, 0, 0, 0, 0, 0, 0, 0, 225000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(199, '054.01.GG.2906.BMA.006.051.A.521211', 566, 'Spanduk Pelatihan', 15, 'M2', 25000, 375000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 250000, 125000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(200, '054.01.GG.2906.BMA.006.051.A.521211', 567, 'konsumsi rapat persiapan seruti triwulan 4', 25, 'O-P', 85000, 2125000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2125000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(201, '054.01.GG.2906.BMA.006.005.A.521213', 178, 'honor petugas pendataan lapangan updating listing (susenas msbp 2024)', 15, 'BS', 166000, 2490000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2490000, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(202, '054.01.GG.2906.BMA.006.005.A.521213', 179, 'honor petugas pendataan lapangan (seruti triwulan 2 dan 4)', 300, 'DOK', 91000, 27300000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 27300000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(203, '054.01.GG.2906.BMA.006.005.A.521213', 180, 'honor petugas pengolahan (seruti triwulan 1 dan 3)', 450, 'DOK', 12000, 5400000, 0, 0, 0, 0, 0, 1800000, 0, 0, 0, 0, 1800000, 0, 1800000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(204, '054.01.GG.2906.BMA.006.005.A.521213', 181, 'honor petugas pengolahan (seruti triwulan 2 dan 4)', 262, 'DOK', 17000, 4454000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4454000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(205, '054.01.GG.2906.BMA.006.005.A.521213', 470, 'honor petugas pendataan lapangan (seruti triwulan 2)', 20, 'RUTA', 91000, 1820000, 0, 0, 0, 0, 0, 0, 0, 1820000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(206, '054.01.GG.2906.BMA.006.005.A.521213', 471, 'honor petugas pengolahan (seruti triwulan 2)', 20, 'RUTA', 17000, 340000, 0, 0, 0, 0, 0, 0, 0, 340000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(207, '054.01.GG.2906.BMA.006.005.A.521213', 182, 'honor petugas pengolahan updating listing (susenas msbp 2024)', 15, 'DOK', 33000, 495000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 495000, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(208, '054.01.GG.2906.BMA.006.005.A.521213', 183, 'honor petugas pendataan lapangan (susenas msbp 2024)', 150, 'DOK', 120000, 18000000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18000000, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(209, '054.01.GG.2906.BMA.006.005.A.521213', 184, 'honor petugas pengolahan (susenas msbp 2024)', 150, 'DOK', 27500, 4125000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4125000, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(210, '054.01.GG.2906.BMA.006.005.A.521213', 185, 'honor petugas pendataan lapangan updating listing (susenas maret 2024)', 66, 'BS', 166000, 10956000, 0, 0, 10956000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(211, '054.01.GG.2906.BMA.006.005.A.521213', 186, 'honor petugas pengolahan updating listing (susenas maret 2024)', 66, 'DOK', 33000, 2178000, 0, 0, 0, 0, 0, 2178000, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(212, '054.01.GG.2906.BMA.006.005.A.521213', 187, 'honor petugas pendataan lapangan (susenas maret 2024)', 660, 'DOK', 120000, 79200000, 0, 0, 0, 79200000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(213, '054.01.GG.2906.BMA.006.005.A.521213', 188, 'honor petugas pengolahan (susenas maret 2024)', 660, 'DOK', 27500, 18150000, 0, 0, 0, 0, 0, 18150000, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(214, '054.01.GG.2906.BMA.006.005.A.521213', 189, 'honor petugas pendataan lapangan (seruti triwulan 1 dan 3)', 300, 'DOK', 60000, 18000000, 0, 0, 0, 9000000, 0, 0, 0, 0, 0, 0, 9000000, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(215, '054.01.GG.2906.BMA.006.051.A.521213', 532, 'honor pengajar pelatihan petugas susenas msbp 2024 di kabupaten/kota', 27, 'OJP', 123000, 3321000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2997000, 0, 0, 324000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(216, '054.01.GG.2906.BMA.006.051.A.521213', 205, 'honor pengajar pelatihan petugas susenas maret 2024 honor pengajar petugas', 77, 'OJP', 111000, 8547000, 0, 0, 0, 0, 0, 8547000, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(217, '054.01.GG.2906.BMA.006.054.A.524111', 569, 'Perjalanan Dinas ke BPS Provinsi', 20, 'O-P', 2909050, 58181000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 58181000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(218, '054.01.GG.2906.BMA.006.005.A.524113', 190, 'transport lokal petugas pemeriksaan lapangan updating listing (susenas msbp 2024 organik)', 3, 'O-K', 150000, 450000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 450000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30');
INSERT INTO `mata_anggarans` (`id`, `mak`, `coa_id`, `uraian`, `volume`, `satuan`, `harga_satuan`, `total`, `blokir`, `rpd_januari`, `rpd_februari`, `rpd_maret`, `rpd_april`, `rpd_mei`, `rpd_juni`, `rpd_juli`, `rpd_agustus`, `rpd_september`, `rpd_oktober`, `rpd_november`, `rpd_desember`, `dipa_id`, `created_at`, `updated_at`) VALUES
(219, '054.01.GG.2906.BMA.006.005.A.524113', 195, 'transport lokal petugas pengolahan (seruti triwulan 2 dan 4)', 4, 'O-K', 150000, 600000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 600000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(220, '054.01.GG.2906.BMA.006.005.A.524113', 196, 'transport lokal petugas pemeriksaan lapangan (susenas msbp 2024 organik)', 29, 'O-K', 150000, 4350000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2250000, 2100000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(221, '054.01.GG.2906.BMA.006.005.A.524113', 197, 'transport lokal petugas pengolahan (susenas msbp 2024 organik)', 3, 'O-K', 150000, 450000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 450000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(222, '054.01.GG.2906.BMA.006.005.A.524113', 198, 'transport lokal petugas pendataan susenas msbp 2024', 15, 'O-K', 150000, 2250000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2250000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(223, '054.01.GG.2906.BMA.006.005.A.524113', 199, 'transport lokal pencacahan rentang harga', 15, 'O-K', 150000, 2250000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2250000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(224, '054.01.GG.2906.BMA.006.005.A.524113', 201, 'transport lokal petugas pemeriksaan lapangan (susenas maret 2024 organik)', 20, 'O-K', 188250, 3765000, 0, 0, 0, 0, 0, 0, 3765000, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(225, '054.01.GG.2906.BMA.006.005.A.524113', 192, 'transport lokal petugas pemeriksaan lapangan (seruti triwulan 1 dan 3)', 12, 'O-K', 150000, 1800000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1800000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(226, '054.01.GG.2906.BMA.006.005.A.524113', 193, 'transport lokal petugas pemeriksaan lapangan (seruti triwulan 2 dan 4)', 26, 'O-K', 150000, 3900000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3900000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(227, '054.01.GG.2906.BMA.006.005.A.524113', 194, 'transport lokal petugas pengolahan (seruti triwulan 1 dan 3)', 2, 'O-K', 150000, 300000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(228, '054.01.GG.2906.BMA.006.051.A.524113', 533, 'transport lokal responden role playing pelatihan petugas susenas msbp 2024 di kabupaten/kota', 3, 'O-K', 150000, 450000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 400000, 0, 50000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(229, '054.01.GG.2906.BMA.006.051.A.524113', 476, 'transport lokal rapat persiapan seruti triwulan II', 2, 'O-K', 122500, 245000, 0, 0, 0, 0, 0, 0, 0, 0, 245000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(230, '054.01.GG.2906.BMA.006.051.A.524113', 568, 'Transport lokal rapat persiapan seruti triwulan 4', 15, 'O-P', 150000, 2250000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2250000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(231, '054.01.GG.2906.BMA.006.052.A.524113', 210, 'pengawasan lapangan dari bps kabupaten/kota ke kecamatan susenas msbp 2024', 2, 'O-P', 362000, 724000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 724000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(232, '054.01.GG.2906.BMA.006.052.A.524113', 212, 'pengawasan kab/kota ke kecamatan dalam rangka seruti', 2, 'O-P', 362000, 724000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 724000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(233, '054.01.GG.2906.BMA.006.051.A.524114', 534, 'pelatihan petugas susenas msbp 2024 di kabupaten/kota', 75, 'O-P', 510000, 38250000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 37875000, 0, 0, 375000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(234, '054.01.GG.2906.BMA.006.051.A.524114', 535, 'perjalanan petugas susenas msbp 2024 di kabupaten/kota', 25, 'O-P', 500500, 12512000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 12510000, 0, 0, 2000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(235, '054.01.GG.2906.BMA.006.051.A.524114', 207, 'pelatihan petugas susenas maret 2024', 63, 'O-P', 500000, 31500000, 0, 0, 0, 0, 31500000, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(236, '054.01.GG.2906.BMA.006.051.A.524114', 208, 'perjalanan petugas susenas maret 2024', 100, 'O-P', 174100, 17410000, 0, 0, 17410000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(237, '054.01.GG.2907.BMA.006.054.A.524111', 570, 'Perjalanan Dinas ke BPS Provinsi', 1, 'O-P', 4150000, 4150000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4150000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(238, '054.01.GG.2907.BMA.006.005.A.524113', 226, 'transport lokal petugas pendataan lapangan bps kabupaten/kota', 5, 'O-K', 163000, 815000, 0, 0, 0, 0, 0, 0, 0, 0, 815000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(239, '054.01.GG.2907.BMA.006.005.A.524113', 227, 'transport lokal petugas pemeriksaan lapangan (SPAK)', 2, 'O-K', 142500, 285000, 0, 0, 0, 0, 0, 0, 0, 0, 285000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(240, '054.01.GG.2907.BMA.008.051.A.521211', 220, 'perlengkapan fullboard pelatihan petugas', 30, 'SET', 50000, 1500000, 0, 0, 0, 0, 0, 0, 0, 1500000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(241, '054.01.GG.2907.BMA.008.051.A.521211', 436, 'biaya pulsa pelatihan petugas', 53, 'O-B', 25000, 1325000, 0, 0, 0, 0, 0, 0, 0, 1325000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(242, '054.01.GG.2907.BMA.008.051.A.521211', 544, 'Konsumsi Pertemuan Desa Cantik', 70, 'O-P', 60000, 4200000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4200000, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(243, '054.01.GG.2907.BMA.008.051.A.521211', 571, 'Spanduk Pelatihan', 10, 'M2', 25000, 250000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 250000, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(244, '054.01.GG.2907.BMA.008.005.A.521213', 214, 'honor petugas pendataan lapangan', 169, 'DOK', 102000, 17238000, 0, 0, 0, 0, 0, 0, 17238000, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(245, '054.01.GG.2907.BMA.008.051.A.521213', 221, 'honor pengajar pelatihan petugas', 32, 'OJP', 111000, 3552000, 0, 0, 0, 0, 0, 3552000, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(246, '054.01.GG.2907.BMA.008.054.A.524111', 452, 'Perjalanan Dalam Rangka Statistik Sosial', 10, 'O-P', 3527400, 35274000, 0, 0, 0, 0, 0, 0, 3490000, 4182000, 0, 0, 25000000, 0, 2602000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(247, '054.01.GG.2907.BMA.008.005.A.524113', 218, 'transport lokal petugas pendataan lapangan desa', 400, 'O-K', 60575, 24230000, 0, 0, 0, 0, 0, 0, 0, 0, 24230000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(248, '054.01.GG.2907.BMA.008.005.A.524113', 445, 'transport lokal pengawasan podes desa/kelurahan/pendataan lapangan podes kecamatan', 10, 'O-P', 331000, 3310000, 0, 0, 0, 0, 0, 0, 0, 3310000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(249, '054.01.GG.2907.BMA.008.005.A.524113', 446, 'transport lokal daerah sulit pendataan podes desa/kelurahan/kecamatan', 100, 'O-P', 99700, 9970000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 9970000, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(250, '054.01.GG.2907.BMA.008.005.A.524113', 542, 'Translok Pembinaan Desa Cantik', 50, 'O-P', 141400, 7070000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1350000, 5720000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(251, '054.01.GG.2907.BMA.008.005.A.524113', 543, 'Translok Pengawasan Desa Cantik', 20, 'O-P', 135000, 2700000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2700000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(252, '054.01.GG.2907.BMA.008.051.A.524114', 222, 'fullday pelatihan petugas', 40, 'O-P', 240000, 9600000, 0, 0, 0, 0, 0, 9600000, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(253, '054.01.GG.2907.BMA.008.051.A.524114', 223, 'perjalanan fullday pelatihan petugas', 40, 'O-P', 216625, 8665000, 0, 0, 0, 0, 0, 8665000, 0, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(254, '054.01.GG.2908.BMA.004.051.A.521211', 441, 'Paket data/pulsa pelatihan petugas survei karakteristik usaha', 1, 'PAKET', 35000, 35000, 0, 0, 0, 0, 0, 0, 0, 0, 35000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(255, '054.01.GG.2908.BMA.004.051.A.521211', 442, 'Biaya Pulsa/paket data pelatihan petugas survei bidang jasa pariwisata', 4, 'PAKET', 45000, 180000, 0, 0, 0, 0, 0, 0, 0, 0, 180000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(256, '054.01.GG.2908.BMA.004.005.A.521213', 519, 'honor petugas pendataan lapangan survei karakteristik usaha', 10, 'DOK', 55000, 550000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 550000, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(257, '054.01.GG.2908.BMA.004.005.A.521213', 230, 'honor petugas pendataan lapangan slk koperasi simpan pinjam', 18, 'DOK', 60000, 1080000, 0, 0, 0, 0, 0, 0, 0, 0, 1080000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(258, '054.01.GG.2908.BMA.004.005.A.521213', 231, 'honor petugas pendataan lapangan vdtw', 4, 'DOK', 60000, 240000, 0, 0, 0, 0, 0, 0, 0, 0, 240000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(259, '054.01.GG.2908.BMA.004.005.A.521213', 232, 'honor petugas pendataan lapangan vhts', 190, 'DOK', 55000, 10450000, 0, 0, 770000, 880000, 880000, 880000, 880000, 880000, 880000, 880000, 880000, 880000, 1760000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(260, '054.01.GG.2908.BMA.004.005.A.521213', 234, 'honor petugas pendataan lapangan vhtl', 16, 'DOK', 55000, 880000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 880000, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(261, '054.01.GG.2908.BMA.004.005.A.521213', 236, 'honor petugas pendataan lapangan keuangan desa', 29, 'DOK', 55000, 1595000, 0, 0, 0, 0, 0, 0, 0, 0, 1595000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(262, '054.01.GG.2908.BMA.004.005.A.521213', 438, 'honor petugas pendataan lapangan vrest umk', 7, 'DOK', 50000, 350000, 0, 0, 0, 0, 0, 0, 0, 350000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(263, '054.01.GG.2908.BMA.004.005.A.524111', 541, 'Perjalanan DInas ke BPS Provinsi', 2, 'O-P', 3168000, 6336000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5910000, 0, 426000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(264, '054.01.GG.2908.BMA.004.005.A.524113', 572, 'transport lokal petugas pemeriksaan lapangan vhts', 2, 'O-K', 110000, 220000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 220000, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(265, '054.01.GG.2908.BMA.004.005.A.524113', 573, 'transport lokal petugas pendataan vhtl', 3, 'O-K', 110000, 330000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 330000, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(266, '054.01.GG.2908.BMA.004.005.A.524113', 574, 'transport lokal petugas pendataan slk koperasi simpan pinjam', 2, 'O-K', 110000, 220000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 220000, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(267, '054.01.GG.2908.QMA.009.005.A.521213', 549, 'honor petugas listing survei e-commerce', 7, 'BS', 228000, 1596000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1596000, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(268, '054.01.GG.2908.QMA.009.005.A.521213', 550, 'honor petugas pendataan survei e-commerce', 59, 'DOK', 65000, 3835000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3835000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(269, '054.01.GG.2908.QMA.009.005.A.521811', 575, 'ATK dan Computer Supplies', 1, 'PAKET', 1262000, 1262000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1262000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(270, '054.01.GG.2908.QMA.009.005.A.524113', 553, 'transport lokal pemeriksaan hasil listing survei e-commerce', 1, 'O-K', 150000, 150000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150000, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(271, '054.01.GG.2908.QMA.009.005.A.524113', 554, 'transport lokal pemeriksaan hasil survei e-commerce', 3, 'O-K', 150000, 450000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 450000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(272, '054.01.GG.2909.BMA.005.005.A.521211', 577, 'Pembelian ATK', 1, 'PAKET', 1440000, 1440000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1440000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(273, '054.01.GG.2910.BMA.008.051.A.521211', 259, 'perlengkapan fullboard pelatihan petugas komstrat di kab kota', 11, 'SET', 150000, 1650000, 1650000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1650000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(274, '054.01.GG.2910.BMA.008.005.A.521213', 249, 'honor petugas pendataan lapangan listing komstrat karet', 4, 'BS', 228000, 912000, 912000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 912000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(275, '054.01.GG.2910.BMA.008.005.A.521213', 250, 'honor petugas pendataan lapangan komstrat karet', 40, 'DOK', 65000, 2600000, 2600000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2600000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(276, '054.01.GG.2910.BMA.008.005.A.521213', 252, 'honor petugas pendataan lapangan updating dpp dutl', 32, 'DOK', 55000, 1760000, 0, 0, 0, 0, 0, 0, 0, 0, 1375000, 55000, 0, 0, 330000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(277, '054.01.GG.2910.BMA.008.051.A.521213', 260, 'honor pengajar pelatihan petugas komstrat di kab kota', 18, 'OJP', 123000, 2214000, 2214000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2214000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(278, '054.01.GG.2910.BMA.008.005.A.524111', 539, 'Konsultasi Ke BPS Provinsi', 1, 'PAKET', 2055000, 2055000, 0, 0, 0, 0, 0, 0, 0, 0, 1980000, 0, 0, 0, 75000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(279, '054.01.GG.2910.BMA.008.005.A.524113', 253, 'transport lokal petugas pemeriksaan lapangan listing komstrat karet', 2, 'O-K', 150000, 300000, 300000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(280, '054.01.GG.2910.BMA.008.005.A.524113', 255, 'transport lokal petugas pemeriksaan lapangan komstrat karet', 3, 'O-K', 150000, 450000, 450000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 450000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(281, '054.01.GG.2910.BMA.008.052.A.524113', 263, 'pengawasan statistik hortikultura dan perkebunan dari kabupaten ke kecamatan', 6, 'O-P', 362000, 2172000, 724000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2172000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(282, '054.01.GG.2910.BMA.008.051.A.524114', 261, 'fullboard pelatihan petugas komstrat di kab kota', 24, 'O-P', 650000, 15600000, 15600000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 15600000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(283, '054.01.GG.2910.BMA.008.051.A.524114', 262, 'perjalanan fullboard pelatihan petugas komstrat di kab kota', 9, 'O-P', 558667, 5028000, 5028000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5028000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(284, '054.01.GG.2910.QMA.006.717.A.521211', 485, 'Konsumsi rapat dalam rangka pelatihan pengolahan Survei Ekonomi Pertanian', 20, 'O-K', 55000, 1100000, 0, 0, 0, 0, 0, 0, 0, 0, 1088000, 0, 0, 0, 12000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(285, '054.01.GG.2910.QMA.006.725.A.521211', 298, 'konsumsi rapat dalam rangka pelatihan pengolahan survei proling', 20, 'O-K', 68000, 1360000, 1360000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1360000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(286, '054.01.GG.2910.QMA.006.005.A.521213', 264, 'honor petugas pendataan lapangan updating listing (survei proling)', 82, 'BS', 166000, 13612000, 13612000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 13612000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(287, '054.01.GG.2910.QMA.006.005.A.521213', 266, 'honor petugas pengolahan updating (survei proling)', 82, 'Dok', 33000, 2706000, 2706000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2706000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(288, '054.01.GG.2910.QMA.006.005.A.521213', 267, 'honor petugas lapangan sensus papi (survei proling)', 18, 'O-B', 4540000, 81720000, 81720000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 81720000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(289, '054.01.GG.2910.QMA.006.005.A.521213', 268, 'honor pemeriksa lapangan sensus papi (survei survei proling)', 6, 'O-B', 2406500, 14439000, 14439000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 14439000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(290, '054.01.GG.2910.QMA.006.005.A.521213', 269, 'honor petugas pengolahan sensus (survei survei proling)', 5, 'O-B', 3398000, 16990000, 16990000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 16990000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(291, '054.01.GG.2910.QMA.006.005.A.521213', 272, 'honor Petugas Lapangan Sensus PAPI  (survei ekonomi pertanian)', 18, 'O-B', 3540000, 63720000, 0, 0, 0, 0, 0, 0, 0, 63715400, 0, 0, 0, 0, 4600, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(292, '054.01.GG.2910.QMA.006.005.A.521213', 273, 'honor Pemeriksaan Lapangan Sensus PAPI  (survei ekonomi pertanian)', 6, 'O-B', 2395000, 14370000, 0, 0, 0, 0, 0, 0, 0, 14370000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(293, '054.01.GG.2910.QMA.006.005.A.521213', 265, 'honor pengolahan lapangan sensus (survei ekonomi pertanian)', 4, 'O-B', 3259000, 13036000, 0, 0, 0, 0, 0, 0, 0, 0, 13036000, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(294, '054.01.GG.2910.QMA.006.716.A.521213', 278, 'honor pengajar petugas papi survei ekonomi pertanian', 32, 'OJP', 111000, 3552000, 0, 0, 0, 0, 0, 0, 3552000, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(295, '054.01.GG.2910.QMA.006.717.A.521213', 486, 'Honor pengajar pelatihan petugas pengolahan', 14, 'OJP', 111000, 1554000, 0, 0, 0, 0, 0, 0, 0, 1554000, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(296, '054.01.GG.2910.QMA.006.724.A.521213', 290, 'honor pengajar petugas papi survei produksi dan lingkungan pertanian', 27, 'OJP', 123000, 3321000, 3321000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3321000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(297, '054.01.GG.2910.QMA.006.725.A.521213', 299, 'honor pengajar petugas pengolahan survei proling', 9, 'OJP', 123000, 1107000, 1107000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1107000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(298, '054.01.GG.2910.QMA.006.716.A.521219', 279, 'Asuransi Petugas', 20, 'O-B', 17250, 345000, 0, 0, 0, 0, 0, 0, 344063, 0, 0, 0, 0, 0, 937, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:30'),
(299, '054.01.GG.2910.QMA.006.724.A.521219', 291, 'Asuransi Petugas', 18, 'O-B', 56000, 1008000, 1008000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1008000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(300, '054.01.GG.2910.QMA.006.724.A.521811', 292, 'penggandaan laporan kab kota hasil survei produksi dan lingkungan pertanian', 700, 'LMBR', 700, 490000, 490000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 490000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(301, '054.01.GG.2910.QMA.006.005.A.524111', 463, 'Konsultasi Kab/kota ke Prov', 2, 'O-P', 5591500, 11183000, 0, 0, 0, 0, 0, 0, 0, 5668000, 5120000, 0, 0, 0, 395000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(302, '054.01.GG.2910.QMA.006.005.A.524113', 274, 'transport lokal honor pemeriksaan daftar listing/pemutahiran sls (survei proling)', 16, 'O-K', 150000, 2400000, 2400000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2400000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(303, '054.01.GG.2910.QMA.006.005.A.524113', 276, 'Transport lokal pencacahan UTL dan perusahaan', 32, 'O-K', 150000, 4800000, 4800000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4800000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(304, '054.01.GG.2910.QMA.006.005.A.524113', 277, 'Transport lokal pencacahan UTL dan perusahaan SEP', 34, 'O-K', 134200, 4562000, 0, 0, 0, 0, 0, 0, 0, 0, 4560000, 0, 0, 0, 2000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(305, '054.01.GG.2910.QMA.006.716.A.524113', 462, 'transport lokal responden role playing pelatihan petugas', 5, 'O-K', 135000, 675000, 0, 0, 0, 0, 0, 0, 660000, 0, 0, 0, 0, 0, 15000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(306, '054.01.GG.2910.QMA.006.717.A.524113', 484, 'Transport petugas dalam rangka pelatihan pengolahan Survei Ekonomi Pertanian', 8, 'O-K', 120000, 960000, 0, 0, 0, 0, 0, 0, 0, 930000, 0, 0, 0, 0, 30000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(307, '054.01.GG.2910.QMA.006.724.A.524113', 293, 'pengawasan kab/kota ke kecamatan', 5, 'O-P', 362000, 1810000, 1810000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1810000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(308, '054.01.GG.2910.QMA.006.724.A.524113', 294, 'transport daerah sulit', 11, 'O-K', 477000, 5247000, 5247000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5247000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(309, '054.01.GG.2910.QMA.006.724.A.524113', 295, 'transport lokal responden role playing pelatihan petugas', 3, 'O-K', 150000, 450000, 450000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 450000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(310, '054.01.GG.2910.QMA.006.725.A.524113', 300, 'transport lokal pelatihan petugas pengolahan survei proling', 5, 'O-K', 150000, 750000, 750000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 750000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(311, '054.01.GG.2910.QMA.006.716.A.524114', 285, 'fullboard pelatihan petugas papi kab kota survei ekonomi pertanian', 54, 'O-H', 510000, 27540000, 0, 0, 0, 0, 0, 0, 27540000, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(312, '054.01.GG.2910.QMA.006.716.A.524114', 286, 'Perjalanan pelatihan petugas papi kab kota survei ekonomi pertanian', 27, 'O-P', 375000, 10125000, 0, 0, 0, 0, 0, 0, 10125000, 0, 0, 0, 0, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(313, '054.01.GG.2910.QMA.006.724.A.524114', 296, 'fullboard pelatihan petugas papi di kab/kota survei proling', 63, 'O-P', 789397, 49732000, 49732000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 49732000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(314, '054.01.GG.2910.QMA.006.724.A.524114', 297, 'perjalanan fullboard pelatihan petugas papi di kab/kota survei proling', 21, 'O-P', 900286, 18906000, 18906000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18906000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(315, '054.01.GG.2910.QMA.006.716.A.524119', 500, 'Perjalanan Peserta Rapat Koordinasi SEP 2024', 1, 'O-P', 6241000, 6241000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6241000, 0, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(316, '054.01.GG.2910.QMA.007.005.A.521211', 449, 'perlengkapan petugas ubinan', 1, 'PAKET', 1342000, 1342000, 0, 0, 0, 0, 0, 0, 0, 1336000, 0, 0, 0, 0, 6000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(317, '054.01.GG.2910.QMA.007.005.A.521213', 312, 'honor petugas pendataan lapangan updating ubinan palawija', 70, 'BS', 166000, 11620000, 0, 0, 0, 0, 0, 0, 0, 2324000, 0, 0, 6640000, 0, 2656000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(318, '054.01.GG.2910.QMA.007.005.A.521213', 313, 'honor petugas pendataan lapangan ubinan padi dan ubinan palawija', 282, 'DOK', 77000, 21714000, 0, 0, 0, 462000, 4004000, 1463000, 1848000, 231000, 2310000, 1694000, 1771000, 7931000, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(319, '054.01.GG.2910.QMA.007.005.A.521219', 413, 'penggantian biaya responden', 282, 'RT', 59000, 16638000, 0, 0, 0, 0, 0, 3540000, 1003000, 1829000, 0, 2832000, 1357000, 6077000, 0, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(320, '054.01.GG.2910.QMA.007.052.A.524111', 576, 'Konsultasi Kab/kota ke Prov', 4, 'O-P', 2383250, 9533000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8502000, 0, 1031000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(321, '054.01.GG.2910.QMA.010.051.A.521211', 305, 'perlengkapan pelatihan petugas ksa padi dan jagung', 54, 'SET', 50000, 2700000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2700000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(322, '054.01.GG.2910.QMA.010.005.A.521213', 301, 'honor petugas pendataan lapangan updating ksa jagung', 408, 'DOK', 59000, 24072000, 0, 0, 2006000, 2006000, 2006000, 2006000, 2006000, 2006000, 2006000, 2006000, 2006000, 2006000, 4012000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(323, '054.01.GG.2910.QMA.010.005.A.521213', 302, 'honor petugas pendataan lapangan updating ksa padi', 1056, 'DOK', 116000, 122496000, 0, 0, 10208000, 10208000, 10208000, 10208000, 10208000, 10280000, 10208000, 10208000, 10208000, 10208000, 20344000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(324, '054.01.GG.2910.QMA.010.051.A.521213', 307, 'honor pengajar petugas pelatihan ksa padi dan jagung', 9, 'OJP', 123000, 1107000, 0, 576000, 312000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 219000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(325, '054.01.GG.2910.QMA.010.005.A.524111', 540, 'Konsultasi ke BPS Prov', 10, 'O-P', 2740900, 27409000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 13490000, 11336000, 2583000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31'),
(326, '054.01.GG.2910.QMA.010.051.A.524113', 308, 'Transport pelatihan petugas ksa padi dan jagung', 40, 'O-K', 212000, 8480000, 0, 2225000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6255000, 1, '2024-11-10 20:35:01', '2024-11-10 20:35:31');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2018_01_01_000000_create_action_events_table', 1),
(5, '2019_05_10_000000_add_fields_to_action_events_table', 1),
(6, '2021_08_25_193039_create_nova_notifications_table', 1),
(7, '2022_04_26_000000_add_fields_to_nova_notifications_table', 1),
(8, '2022_12_19_000000_create_field_attachments_table', 1),
(9, '2024_08_02_014623_create_kode_arsips_table', 1),
(10, '2024_08_03_053608_create_unit_kerjas_table', 1),
(11, '2024_08_03_090339_update_users_table', 1),
(12, '2024_08_04_003501_create_kode_naskahs_table', 1),
(13, '2024_08_04_010451_create_jenis_naskahs_table', 1),
(14, '2024_08_06_034126_create_pengelolas_table', 1),
(15, '2024_08_09_025240_create_naskah_keluars_table', 1),
(16, '2024_08_10_145003_create_naskah_masuks_table', 1),
(17, '2024_08_11_075557_create_izin_keluars_table', 1),
(18, '2024_08_13_143332_create_kerangka_acuans_table', 1),
(19, '2024_08_13_165759_create_kamus_anggarans_table', 1),
(21, '2024_08_14_143646_create_mitras_table', 1),
(22, '2024_08_16_103736_create_templates_table', 1),
(23, '2024_08_19_115820_create_honor_kegiatans_table', 1),
(24, '2024_08_28_081501_create_daftar_honor_mitras_table', 1),
(25, '2024_09_02_201858_create_dipas_table', 1),
(26, '2024_09_03_104924_create_jenis_kontraks_table', 1),
(27, '2024_09_09_133415_create_harga_satuans_table', 1),
(28, '2024_09_11_054300_create_tata_naskahs_table', 1),
(29, '2024_09_11_113838_create_arsip_dokumens_table', 1),
(30, '2024_09_11_134301_create_data_pegawais_table', 1),
(31, '2024_09_14_104101_create_anggaran_kerangka_acuans_table', 1),
(32, '2024_09_14_155302_create_derajat_naskahs_table', 1),
(33, '2024_09_15_075202_create_spesifikasi_kerangka_acuans_table', 1),
(34, '2024_09_21_075005_create_kepka_mitras_table', 1),
(35, '2024_09_22_164721_create_daftar_honor_pegawais_table', 1),
(36, '2024_10_04_140919_create_kontrak_mitras_table', 1),
(37, '2024_10_09_092649_create_bast_mitras_table', 1),
(38, '2024_10_12_101500_create_daftar_kontrak_mitras_table', 1),
(39, '2024_10_18_210322_create_naskah_defaults_table', 1),
(42, '2024_11_02_164357_create_barang_persediaans_table', 2),
(43, '2024_11_03_083040_create_master_persediaans_table', 2),
(52, '2024_11_03_160210_create_pembelian_persediaans_table', 3),
(53, '2024_11_03_160256_create_permintaan_persediaans_table', 3),
(54, '2024_11_09_173029_create_persediaan_keluars_table', 4),
(56, '2024_11_09_174029_create_persediaan_masuks_table', 5),
(57, '2024_08_13_165759_create_mata_anggarans_table', 6),
(58, '2024_11_10_205125_create_realisasi_anggarans_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `mitras`
--

CREATE TABLE `mitras` (
  `id` bigint UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rekening` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `kepka_mitra_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mitras`
--

INSERT INTO `mitras` (`id`, `nik`, `nama`, `alamat`, `rekening`, `npwp`, `email`, `tanggal_lahir`, `kepka_mitra_id`, `created_at`, `updated_at`) VALUES
(1, '6307081006030002', 'Muhammad Ulya Hasbi', 'Desa sumanggi RT 03 RW 02', NULL, '62.964.759.5-733.000', 'hasbiulya59@gmail.com', '2003-06-10', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(2, '6307110806970001', 'Ahmad maulana', 'Abung RT.007 RW.003', NULL, '', 'Whitekoffie187@gmail.com', '1996-07-08', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(3, '6311076612870001', 'Dina Mayasari', 'Jl. Surapati Komplek Melati 1 no.05 RT.001 RW.001', NULL, '', 'bimabintangnazir@gmai.com', '1987-12-26', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(4, '6307052203860003', 'Budi asmanto noviady', 'Jalan batuah pandawan', NULL, '', 'budibrb30@gmail.com', '1986-03-22', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(5, '6307080411780002', 'Supian arifin', 'Muara rintis', NULL, '00.000.000.0-000.000', 'Iyanarifin80@gmail.com', '1978-11-04', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(6, '6307054102050002', 'RIZKA AULIA', 'Jalan Setia Kayu Rabah RT03/RW01 kec.Pandawan', NULL, '', 'auliarizka571@gmail.com', '2005-02-01', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(7, '6307021706860002', 'MIFTAHUL FARID', 'Jl. Penas Tani IV', NULL, '', 'Varidvarid74@gmail.com', '1986-06-17', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(8, '6307100210930001', 'AHMAD TURIDI', 'Jalan ksatria tandilang RT 04 RW 02 desa tandilang kec.Batang Alai Timur kab.Hulu Sungai Tengah', NULL, '', 'ahmadturidi246@gmail.com', '1993-10-02', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(9, '6307060110910004', 'MUHAMMAD HARIANOOR RAHMAN', 'Jalan Telaga Padawangan No 51 RT. 001 RW. 001', NULL, '', 'harianoor99@gmail.com', '1991-10-01', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(10, '6307052205780001', 'Rusdiansyah', 'Setiap Rt 003 Rw 002', NULL, '81.323.973.8-733.000', 'rusdicombat@gmail.com', '1978-05-22', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(11, '6307045405000002', 'Nadia Rahmah', 'Desa Banua Kupang RT001/RW001', NULL, '53.851.944.8-733.000', 'nadiarhmh14@gmail.com', '2000-05-14', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(12, '6307034304780003', 'SITI SARPIAH', 'Desa Guha RT.04/RW.02', NULL, '', 'sitisarpiah7@gmail.com', '1978-04-03', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(13, '6307021301910002', 'MASSOGIANOR', 'JALAN SWADAYA RT/RW 007/003 NO. 322', NULL, '', 'massogianor14@gmail.com', '1991-01-13', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(14, '6307040107930208', 'ABDUL MUGNI', 'Jalan Pemangkih Seberang, RT 001 RW 001', NULL, '', 'Mugni8120@gmail.com', '1998-08-21', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(15, '6307061110930003', 'ABDUL HAFIZ', 'Kayu Bawang Rt.005 Rw.002', NULL, '80.759.337.1-733.000', 'Hafizeva24@gmail.com', '1993-10-11', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(16, '6307065502860005', 'Sri purnama', 'Jalan keramat manjang', NULL, '77.480.943.7-733.000', 'Barabaibersinar@gmail.com', '1986-02-15', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(17, '6308036001860002', 'Herlia Santi', 'Jalan Ksatria, Lunjuk RT 002', NULL, '', 'Santiherlia7@gmail.com', '1986-01-26', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(18, '6307040304970002', 'Hardi', 'Sungai buluh, rt 005 rw 003', NULL, '', 'Hardyblack92@gmail.com', '1997-04-03', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(19, '6307040506000001', 'Fahmi Gunawan', 'Desa Pajukungan, RT 002 RW 001 Kec. Barabai Kab. Hulu sungai tengah.', NULL, '', 'fahmigunawan320@gmail.com', '2000-06-05', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(20, '6307023008010001', 'ABDURRAHIM', 'Jl penas tani IV aluan', NULL, '', 'Abdurrahim300801@gmail.com', '2001-08-30', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(21, '6307035508910001', 'Noorrendayani, S.Pd.', 'Kadundung rt 001 rw 001', NULL, '', 'noorrendayani@gmail.com', '1991-08-25', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(22, '6307074804980001', 'ARBAINAH', 'Desa Mahela RT 006 RW 003 No. 028 Kecamatan Batang Alai Selatan Kabupaten Hulu Sungai Tengah', NULL, '63.442.280.2-733.000', 'inahh232@gmail.com', '1998-04-08', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(23, '6308056201920003', 'Sri Silviana', 'Jalan sarigading Komplek Bulau Indah Baru RT.010 RW.005', NULL, '', 'ryanhermawan947@gmail.com', '1992-01-22', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(24, '6307042812930003', 'Salamat', 'Jl. Ambawang-Amuntai Desa Binjai Pirua RT 001  RW 001', NULL, '96.927.163.4-733.000', 'salamatbinjai@gmail.com', '1993-12-28', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(25, '6307054902030003', 'Heny febrianti', 'Kayu rabah', NULL, '', 'Henyfebri123@gmail.com', '2003-02-09', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(26, '6307054909010001', 'WAHIDAH', 'Masiraan RT 001 RW 001', NULL, '', 'wahidah2232@gmail.con', '2001-09-09', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(27, '6307056601870002', 'NURLATIFAH', 'MAHANG SUNGAI HANYAR', NULL, '', 'iffazauvana999@gmail.com', '1987-01-26', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(28, '6307085711950002', 'Nor Rusdayanti', 'Jalan Salikan Muara Rintis RT 001 RW 001', NULL, '', 'rusdayantinor@gmail.com', '1995-11-17', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(29, '6307025504010003', 'Norliani', 'Jalan Penas Tani IV', NULL, '', 'norlianiseiko@gmail.com', '2001-04-15', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(30, '6307067010920001', 'Eva Komala Sari', 'Desa Kayu Bawang Rt.005 Rw.001', NULL, '72.770.375.3-733.000', 'evakomalasari112430@gmail.com', '1992-10-30', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(31, '6307066406840002', 'Maimunah', 'Babai', NULL, '16.747.944.3-733.000', 'Nahdacom123@gmail.com', '1984-06-24', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(32, '6307060207980001', 'Muhammad Fajrin Maulana', 'Jalan Kembang Melur Desa Banua Binjai RT/RW 006/003', NULL, '60.699.498.6-733.000', 'mfajrinmaulana@gmail.com', '1998-07-02', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(33, '6307116201910002', 'SYARNIAH', 'Desa pauh Rt007Rw 003', NULL, '', 'Syarniahniah0@gmail.com', '1991-01-22', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(34, '6271012105020004', 'Muhammad Fathurrozi Surya Putra', 'Jalan putera harapan', NULL, '', 'Muhammadfatzi7@gmail.com', '2002-05-21', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(35, '6307032605940001', 'Muhammad Rifani', 'Panggang Marak,RT 001 RW 001', NULL, '', 'muhammadrifani05@gmIl.com', '1994-05-26', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(36, '6307025911890001', 'Susie Rahmawati', 'Jln.Penas Tani IV Rt.02. Rw.01.', NULL, '', 'Susie.ut89@gmail.com', '1989-11-19', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(37, '6307050603900001', 'Ririn Sogianor', 'Jalan Sarigading RT. 01 RW. 01', NULL, '', 'rsugianor@gmail.com', '1990-03-06', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(38, '6307015208020003', 'RUSNIDA', 'Pengambau Hilir Luar Rt 006 Rw 002', NULL, '', 'nidar619@gmail.com', '2002-08-12', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(39, '6307065205840005', 'RAMA YULIS MELATI NINGSIH', 'jl.surapati rt.08 rw.03 no.33 barabai', NULL, '81.631.902.4-735.000', 'karmila_a@yahoo.co.od', '1984-05-12', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(40, '6307105606950001', 'Norhidayati', 'Jl. Kesatria Desa Tandilang RT 002/RW 001', NULL, '85.012.754.9-733.000', 'noerhidayati49@gmail.com', '1995-06-16', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(41, '6307072304970005', 'AHMAD NASIH', 'Lunjuk RT.05 RW.03', NULL, '', 'ahmadnasih23@gmail.com', '1997-04-23', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(42, '6307025003970002', 'Sa adah', 'Jalan SMPN 1 Pagat Rt.006/Rw.002', NULL, '', 'saadah100397@gmail.com', '1997-03-10', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(43, '6307036006980001', 'Nabella Indah Sari', 'Desa Telaga Jingah Hulu Rt 012 Rw 003', NULL, '86.570.090.0-733.000', 'nabellaindahsari@gmail.com', '1998-07-25', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(44, '6307066312910004', 'Maya yulianti', 'Desa Ayuang Rt.02 Rw.01', NULL, '', 'Mayayulianti023@gmail.com', '1991-12-23', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(45, '6307083005940002', 'Rahman wahyuni', 'Jl. H. Asnawi', NULL, '', 'gagayabak11@gmail.com', '1994-05-30', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(46, '6307032809700003', 'Muhammad Din Noor', 'Desa Banua Kepayang, Rt 02/ Rw 01', NULL, '', 'dinorblong@gmail.com', '1970-09-28', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(47, '6307034604000003', 'Rabiatul Adawiyah', 'Jalan Raya Pemangkih RT.02 RW.01', NULL, '63.933.253.5-733.000', 'rabiatulcomel06@gmail.com', '2000-04-06', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(48, '6307036502010002', 'Khairatunnisa', 'Desa Guha RT 01 RW 01', NULL, '', 'khairatunnisa2001@gmail.com', '2001-02-25', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(49, '6307065009820005', 'Irni lily', 'Jln keramat manjang rt 007 rw 003 kel barabai barat kec barabai', NULL, '04.009.002.9-733.000', 'Ulunsaya6@gmail.com', '1982-09-10', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(50, '6307114902880001', 'Hatnita', 'Desa Karatungan rt 06 rw 03', NULL, '', 'Hatnitan@gmail.com', '1988-02-09', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(51, '6309065310870003', 'Arabiah', 'Jalan putera harapan rt 002w 001', NULL, '00.000.000.0-000.000', 'Narisyafariz08@gmail.com', '1987-10-13', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(52, '6307040501880003', 'YANTO', 'Desa Pahalatan RT 003,RW 002', NULL, '76.666.160.7-733.000', 'yantobrb4@gmail.com', '1988-01-05', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(53, '6307030802000004', 'DIQI ANANDA', 'Pantai Hambawang Timur, RT02/RW01', NULL, '', 'diqianandadiqi@gmail.com', '2000-02-08', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(54, '6307035601730004', 'MARIATUN', 'Pantai Hambawang Timur, RT02/RW01', NULL, '', 'atunwalangku123@gmail.com', '1973-01-16', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(55, '6307026003760002', 'RAIHANAH', 'JL H ARJAN MURUNG A RT 003', NULL, '', 'raihabah2076@gmail.com', '1976-03-20', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(56, '6307074107960061', 'Nor Ahrina Sari', 'Jl.Kesatria Birayang Timur RT 005', NULL, '', 'ahrinasari23@gmail.com', '1996-11-24', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(57, '6307035308830001', 'SITI AISYAH', 'Taras Padang RT 004 RT 002', NULL, '76.103.412.3-733.000', 'staisyah84rh@gmail.com', '1983-08-13', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(58, '6307041502780001', 'H. Pahruraji', 'Desa Tabat RT 002, RW 001', NULL, '16.806.089.5-733.000', 'hpahruraji@gmail.com', '1978-02-15', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(59, '6307075208000001', 'NORITA MAHDALINA', 'Jln.Achmad Yani km.165', NULL, '', 'nmahdalina@gmail.com', '2000-08-12', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(60, '6307067005920004', 'Risty Amallia', 'Jl.brigjen H.Hasan Baseri  RT 009/ RW 003', NULL, '', 'amalliaristy92@gmail.com', '1992-05-30', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(61, '6307010709890002', 'Fauzi Rahman', 'Desa Mangunang RT/RW 005/003', NULL, '75.750.030.1-733.000', 'ujirahman22@gmail.com', '1989-09-07', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(62, '6307034209930002', 'Maulida Hasanah', 'Jalan Banua Kepayang RT 004 RW 002', NULL, '', 'lidahasan93@gmail.com', '1993-09-02', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(63, '6307094409870001', 'IsnaMaria', 'Desa Batu Tunggal Rt 003 Rw 001', NULL, '', 'isnaa0409@gmail.com', '1987-09-04', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(64, '6307051410800001', 'Zainal abidin', 'Jl. Putera harapan rt 02/01', NULL, '', 'anakdasuki80@gmail.com', '1980-10-14', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(65, '6307020501880004', 'FIRMANSYAH', 'Jl. Norman Hasim RT.005 RW.003', NULL, '04.876.417.9-733.000', 'syahfirman301@gmail.com', '1988-01-05', 1, '2024-10-25 16:28:30', '2024-10-25 16:28:30'),
(66, '6307055111800001', 'Uswatun Hasanah', 'Masiraan RT 001/RW 001', NULL, '', 'fia.fia16062008@gmail.com', '1980-11-11', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(67, '6311080508860001', 'Abdi prayetno', 'Jln.H. Damanhuri Desa Maringgit RT.03/02', NULL, '97.691.628.8-733.000', 'abdiprayetno606@gmail.com', '1986-08-05', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(68, '6307027005000002', 'MAULIDA FITRI', 'Jln.H.Arjan Desa Murung.A RT 006 RW 003', NULL, '', 'maulidafitry122@gmail.com', '2000-05-30', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(69, '6307042903820002', 'Aminur Rizani', 'Jalan raya desa kadundung rt. 01 rw.  01', NULL, '64.048.951.4-733.000', 'rizaniaminur@gmail.com', '1982-03-29', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(70, '6307044211980001', 'TRI AYU', 'Sungai Buluh RT 005', NULL, '', 'trieayu021199@gmail.com', '1999-11-02', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(71, '6307046012990002', 'Asiah', 'Binjai Pemangkih', NULL, '', 'asiah.tahun2017@gmail.com', '1999-12-20', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(72, '6307051203800003', 'ABDUL BASID', 'KAYU RABAH RT.03 RW.01', NULL, '', 'abi.raudah@gmail.com', '1980-03-12', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(73, '6307085303000001', 'RISDA ILIYANTI', 'SUMANGGI', NULL, '', 'risdagalaxy@gmail.com', '2000-03-13', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(74, '6307014111970002', 'Nada Maya Ninur', 'Pengambau Hilir Dalam RT 006/ RW 002', NULL, '', 'nadamaya01@gmail.com', '1997-11-01', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(75, '6307034303920005', 'RAHMAWATI', 'MAHANG BARU', NULL, '', 'rahmaseinna@gmail.com', '1991-06-08', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(76, '6307035207910002', 'Ratna Juwita Sari', 'Durian Gantang rt 003 rw 002', NULL, '71.361.378.4-733.000', 'ratnagina55@gmail.com', '1991-07-12', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(77, '6307090607890002', 'Hidayatullah', 'Desa alat rt. 02', NULL, '', 'dayathdr@gmail.com', '1989-07-06', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(78, '6307050807770002', 'Miseran', 'Banua Hanyar', NULL, '', 'miseran089@gmail.com', '1977-07-08', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(79, '6307022501000001', 'Ahmad Gafuri', 'Jl. Penas tani lV desa Alaun', NULL, '', 'ahmadgafuri1405@gmail.com', '2000-01-25', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(80, '6307065503040005', 'Siti Norhafiza', 'Jalan perintis kemerdekaan desa gambah rt 5 rw 2', NULL, '', 'sitinorhafiza1551@gmail.com', '2004-03-15', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(81, '6307061908970002', 'M. Reja Rahman', 'Jalan Perintis Kemerdekaan', NULL, '', 'rezarahman230@gmail.com', '1997-08-19', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(82, '6307091707990001', 'MUHAMMAD HUZAZI', 'ALAT SEBERANG RT 003 RW 001', NULL, '', 'huzazi17@gmail.com', '1999-07-17', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(83, '6307036801870004', 'RINI NORINDAH SARI', 'DURIAN GANTANG', NULL, '70.374.251.0-733.000', 'rininorindahsari@gmail.com', '1987-01-28', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(84, '6307030704930006', 'RADILLAH', 'Desa Tabat rt002 rw001', NULL, '84.915.997.7-727.000', 'radillahbinabdullah@gmail.com', '1993-04-07', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(85, '6307050511990004', 'BAHRUDDIN AHMAD', 'Jl. Putera Harapan RT.06 RW.03', NULL, '42.719.926.0-733.000', 'bahruddinahmad27@gmail.com', '1999-11-05', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(86, '6307032005770001', 'Fahrianto', 'Desa Sungai Jaranih RT 001 RW 001', NULL, '15.339.092.7-733.000', 'laurafahri172@gmail.com', '1977-05-20', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(87, '6307031707050001', 'Ahmad Rafi Al Islami', 'Desa Sungai Jaranih RT 001 RW 001', NULL, '15.339.092.7-732.000', 'rafiiia054@gmail.com', '2005-07-17', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(88, '6308056803910005', 'Rina Astuti', 'Anduhum No 42 RT 005 RW 002', NULL, '', 'Amaryllisbear89@gmail.com', '1991-03-28', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(89, '6307102607950001', 'AKHMAD JAUHARI', 'JL. KSATRIA BATU TANGGA RT 010 RW 003', NULL, '', 'azhau74@gmail.com', '1995-07-26', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(90, '6307064101950022', 'Nimah', 'Jl.Ir.P.H.M.Noor ( Kampung Arab) No.46 RT.04/02', NULL, '61.704.013.4-733.000', 'nikmahbarabai@gmail.com', '1995-01-01', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(91, '6307092206990001', 'Jaini fahmi', 'Desa alat rt 02', NULL, '', 'jainifahmi123@gmail.com', '1999-06-22', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(92, '6307036402860001', 'Norlina', 'Desa Durian Gantang RT 04 RW 02', NULL, '16.848.915.1-733.000', 'norlina614@gmail.com', '1986-02-24', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(93, '6307101502830001', 'ALIANTO', 'Jln.ksatria batu tangga RT 09 RW 03', NULL, '', 'aa3517513@gmail.com', '1983-02-15', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(94, '6307065310990003', 'Fairuz Rahmatillah', 'Komplek Citra Garden Batali RT.009 RW.005', NULL, '', 'fairuzrahmatillah@gmail.com', '1999-10-13', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(95, '6307025103970002', 'Yulia Rezeki', 'Jl. Penas Tani IV RT. 006 RW. 003 Desa Aluan Besar', NULL, '', 'yuliarisky4@gmail.com', '1997-03-11', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(96, '6307014507800004', 'RABIYATUL A\'DAWIYAH', 'Jl A. Yani Desa Pengambau Hilir Luar', NULL, '90.282.822.7-733.000', 'habibi.alaydrus23@gmail.com', '1980-07-05', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(97, '6307066402000002', 'Rizka Vebriaty', 'Jalan mualimin gang 45', NULL, '', 'Rizkavebriaty20476@gmail.com', '2000-02-24', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(98, '6306075711810001', 'RAHMI CAHYANTI', 'Jl.swadaya RT/RW :001/001 Desa paya besar', NULL, '', 'rahmicahyanti81@gmail.com', '1981-11-17', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(99, '6307094107950100', 'HELDAWATI', 'TILAHAN', NULL, '60.798.283.2-733.000', 'adibamurtaza03@gmail.com', '1995-11-06', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(100, '6307084511000002', 'RISKA HIDAYAH', 'MARINGGIT', NULL, '00.000.000.7-333.000', 'riska.brb2021@gmail.com', '2000-11-05', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(101, '6307022109840002', 'Fauzi Rahman, S.Pd', 'Jalan H. Arjan Desa Murung A Rt. 02 Rw.01', NULL, '', 'Fauzi.nida21@gmail.com', '1984-09-21', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(102, '6307041110960002', 'Fitriyadi', 'Rantau Bujur RT/RW 001/001', NULL, '', 'hjs09gaming@gmail.com', '1997-01-12', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(103, '6307036909890002', 'maulina salihanur saputri', 'Jl Pancasila Pantai Hambawang Barat Rt 001 Rw 002', NULL, '', 'ihramphonsel@gmail.com', '1989-09-29', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(104, '6309095403030002', 'ALYA ROSIDA', 'Jalan Sarigading', NULL, '', 'alyarosida995@gmail.com', '2003-03-14', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(105, '6307020505000009', 'Muhammad Aldian Rizki', 'Jalan Penas Tani IV RT.05 RW.03, Desa Kahakan', NULL, '', 'muhaldianrizki@gmail.com', '2000-05-05', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(106, '6307066111980001', 'Sri Hariyati', 'Desa Pajukungan RT 07/RW 03', NULL, '', 'srihayati2561@gmail.com', '1998-11-21', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(107, '6307024607900004', 'Norhayati', 'Jl.penas tani IV', NULL, '', 'inornorhayati72@gmail.com', '1990-07-06', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(108, '6307060101910023', 'Ahmad Gozali, S.Pd', 'Jln. Sarigading Desa Banua Batung RT 00 RW 003', NULL, '73.822.817.0-733.000', 'ahmadgozali1191@gmail.com', '1991-01-01', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(109, '6307054702890008', 'Niya herlianti', 'Desa Banua hanyar RT/RW:003/001', NULL, '81.487.989.6-733.000', 'niyaherliyanti@gmail.com', '1989-02-07', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(110, '6307025002910003', 'Samiyah Faiza', 'Banua Kupang', NULL, '', 'samiyah.faiza07@gmail.com', '1991-02-10', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(111, '6307031907030004', 'MUHAMMAD TAUFIK RAHMAN', 'Durian Gantang', NULL, '', 'taufikrahman19072003@gmail.com', '2003-07-19', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(112, '6308046103830001', 'HERLINA', 'Rantau Bujur', NULL, '', 'Herlinahana2183@gmail.com', '1982-03-21', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(113, '6307015604930004', 'Reska Emelda', 'Teluk Mesjid RT.06/RW.03', NULL, '90.295.972.5-733.000', 'reskaemelda11@gmail.com', '1993-04-16', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(114, '6307091806950001', 'Salman Alfarisi', 'Desa Pasting, kecamatan hantakan, kabupaten hulu sungai tengah', NULL, '', 'salmana18696@gmail.com', '1995-06-18', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(115, '6307094605840002', 'Salimah', 'Desa Alat RT.05 RW.04 kec.Hantakan', NULL, '', 'salimahsalimahalat@gmail.com', '1984-05-06', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(116, '6307036106910004', 'Khairan Nisa', 'Mahang putat', NULL, '', 'Syahlianhidayat91@gmail.com', '1991-06-21', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(117, '6307035511990001', 'Nada Fauzannah', 'Pantai Hambawang Barat, RT 05 RW 02, Kecamatan Labuan Amas Selatan, Kabupaten Hulu Sungai Tengah', NULL, '', 'nadafauzanah11@gmail.com', '1999-11-15', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(118, '6307096606890002', 'Ida Arianti', 'Desa Murung B Rt 06 Rw 003', NULL, '', 'idairianti197@gmail.com', '1989-06-26', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(119, '6307066409030004', 'Mahda Auliana', 'Jalan.Mualimin gang karya bersama', NULL, '', 'mahda9951@gamil.com', '2003-09-24', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(120, '6307051207030001', 'Habibi Rusadi', 'Jalan putera harapan, Rt 05', NULL, '', 'habibirusadi@gmail.com', '2003-07-12', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(121, '6307054203920004', 'Auliyana, S.Pd.I', 'DURIAN GANTANG, RT. 001, RW. 001', NULL, '94.939.013.2-733.000', 'auliyana003@gmail.com', '1992-03-02', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(122, '6307062303030002', 'ABDUL KHALIQ', 'Jalan Kayu Bawang RT.03/RW.01', NULL, '', 'liqqqkha@gmail.com', '2003-03-23', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(123, '6307085711020001', 'Rafiah', 'MUARA RINTIS', NULL, '', 'fiahfi@gmail.com', '2002-11-17', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(124, '6307074712930001', 'Ramona', 'Kias rt 07/ rw 03 Kecamatan Batang Alai Selatan Kabupaten Hulu sungai Tengah 71381', NULL, '73.420.057.9-733.000', 'ramonaaluhidut@gmail.com', '1993-12-07', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(125, '6307095808900001', 'Diwi Pratiwi', 'Jalan Brigjen H Hasan Baseri Desa Hantakan RT.04 RW.03', NULL, '', 'pratiwidewi709@gmail.com', '1990-08-18', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(126, '6307096312970003', 'Hamidah', 'Desa Bulayak, Rt.01 Rw.01 no.19', NULL, '', 'Medahbardat@gmail.com', '1997-12-23', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(127, '6307044501010004', 'Maulida', 'Desa Binjai Pirua RT 001 RW 001', NULL, '', 'c030319019.maulida@gmail.com', '2001-07-09', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(128, '6307086203030001', 'NORIJATIL HASANAH', 'Awang Baru RT. 004, RW. 002', NULL, '', 'norijatil15@gmail.com', '2003-03-22', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(129, '6307035701000001', 'Resnawati', 'Jl.Merdeka Desa Kapar RT 002 RW 001', NULL, '41.348.152.4-733.000', 'rw779961@gmail.com', '1999-01-25', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(130, '6307116105030001', 'Riska Maulida', 'Desa Hawang RT 06 RW 03 Kecamatan Limpasu', NULL, '', 'maulidariska2103@gmail.com', '2003-05-21', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(131, '6307055208000002', 'Ahyi Auliya', 'Mahang Sungai Hanyar RT.006 RW.003', NULL, '', 'ahyiauliya1208@gmail.com', '2000-08-12', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(132, '6311014107900004', 'EMELIA JUM\'ATI', 'Desa Tapuk', NULL, '86.086.060.0-733.000', 'goblokblalall@gmail.com', '1990-04-21', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(133, '6307034903940001', 'Yeni puspita', 'Jl.ulama ilung pasar lama rt.01 rw.01', NULL, '', 'yenipuspita090394@gmail.com', '1994-03-09', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(134, '6307054807870005', 'Arbainah', 'Durian gantang', NULL, '92.819.331.7-733.000', 'arbainahainah68@gmail.com', '1987-07-08', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(135, '6307111006870001', 'Hasan', 'Karau Rt. 03 Rw. 01', NULL, '00.000.000.0-000.000', 'hsan60270@gmail.com', '1987-08-10', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(136, '6307060702960003', 'Data Saputra', 'Jalan Perintis Kemerdekaan Rt 004 Rw 002 Desa Gambah Kecamatan Barabai', NULL, '', 'datasaputra8@gmail.com', '1996-02-07', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(137, '6307036009970003', 'HALIMATUSSA\'DIAH', 'Panggang Marak', NULL, '', 'shalimatus096@gmail.com', '1997-09-20', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(138, '6307015410830004', 'FARIDA ARIANI', 'Pemangkih RT.005 RW.002', NULL, '42.346.837.0-733.000', 'faridasyifaa20@gmail.com', '1983-10-14', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(139, '6307044201990002', 'MISLAWATI', 'SUNGAI BULUH RT 005', NULL, '', 'mislawati101099@gmail.com', '1999-10-10', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(140, '6307116807040001', 'Nur Mahbubah', 'Desa Tapuk, Rt/Rw 03/02, Kec. Limpasu, Kab. HST', NULL, '', 'nurmahbubah7401@gmail.com', '2004-09-28', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(141, '6307046906860003', 'ANITA RAHMAH', 'Banua kupang rt.004/002', NULL, '', 'anita.rahmah.8686@gmail.com', '1986-06-29', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(142, '6307055111010005', 'Novina Ariani', 'Jl. Putera Harapan', NULL, '94.941.091.4-733.000', 'novina.nv99@gmail.com', '2001-11-11', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(143, '6307085401000003', 'ILIYA ANITA', 'Jl. Ilung Pasar Lama RT 007 RW 004 Ds. Ilung Pasar Lama', NULL, '', 'iliyaanita@gmail.com', '2000-01-14', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(144, '6307024307010001', 'TRYSTY PUTRANTY', 'Jalan Tanjung Pura RT.09 RW.03', NULL, '', 'trystyputranty@gmal.com', '2001-07-03', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(145, '6307064906000003', 'Putri Maulida', 'Jl. Ds. Pajukungan', NULL, '', 'putrimaulida.pm29@gmail.com', '2000-06-09', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(146, '6307035711930001', 'SITI BA\'DIAH MAYASARI', 'Jamil, Rt.006/ Rw.003', NULL, '80.001.127.2-733.000', 'sitibadiahmayasari93@gmail.com', '1993-11-17', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(147, '6307057112010003', 'Maulida Efrianti', 'Mahang Matang Landung', NULL, '', 'maulidadevya3@gmail.com', '2000-12-31', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(148, '6307084412990001', 'Sahidatun ni\'mah', 'Jln bina Banua desa Awang RT 05 RW 03', NULL, '', 'sahidatunnimah0499@gmail.com', '1999-12-04', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(149, '6307024812860002', 'Mariyati', 'Aluan Mati', NULL, '', 'mariyatimariyatii7@gmail.com', '1986-12-08', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(150, '6202135906930001', 'Desi amalia', 'Desa rantau bujur rt 001/rw 001', NULL, '', 'desiamalia312@gmail.com', '1993-06-19', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(151, '6307062505890005', 'Yudha Hermawan', 'Jl. Perintis Kemerdekaan RT 001 RW 001', NULL, '', 'yudha6989hermawan@gmail.com', '1989-05-25', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(152, '6307025409840002', 'Rahma yanti', 'Jl.Norman Hasyim RT 006 RW 003', NULL, '25.758.036.5-733.000', 'yantirahma1409@gmail.com', '1984-09-14', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(153, '6306075405030001', 'MARNI', 'Desa Tabat, Rt/Rw : 002/001', NULL, '', 'marnitabat@gmail.com', '2003-03-04', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(154, '6307065101020003', 'Devia Herliany', 'Jalan Surapati rt/rw 008/003, Gang Maritam No 42', NULL, '', 'deviaherliany9@gmail.com', '2002-01-11', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(155, '6307042009990001', 'MUHAMMAD SAIDI', 'jalan desa tabat, RT 04 RW 02', NULL, '', 'saidiey04@gmail.com', '1999-09-20', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(156, '6307066308980001', 'NAQI RIZIANI', 'Jl.Keramat Manjang Gang Rukun', NULL, '', 'naqiriziani123456@gmail.com', '1998-08-23', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(157, '6307026412940001', 'Herni yunada', 'Jalan H. Arjan Desa Murung. A', NULL, '', 'Herniyunada1@gmail.com', '1994-12-24', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(158, '6307024304850001', 'Rahmatul Jannah', 'Jl.Penas Tani IV RT.004 RW.002', NULL, '71.355.350.1-733.000', 'rrahmatul03@gmail.com', '1985-04-03', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(159, '6307024510900002', 'Sahlina', 'Jl. Penas TAni IV RT 001 RW 001', NULL, '', 'ssahlina325@gmail.com', '1990-10-05', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(160, '6307046108010001', 'SYIFA NORSA\'ADAH', 'Banua Kupang RT.004 / RW.002', NULL, '', 'Syifa.nursadah.2001@gmail.com', '2001-08-21', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(161, '6307062210760002', 'M. SURYA DARMA', 'JLN PANGERAN ANTASARI RT 008 RW 003', NULL, '', 'muhammadsuryadarma221076@gmail.com', '1976-10-22', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(162, '6307066002950007', 'listi handayani', 'Jalan Sarigading Banua Binjai RT002 RW001', NULL, '83.105.443.2-733.000', 'listihandayani81@gmail.com', '1995-02-22', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(163, '6307071404930002', 'Muhammad Hifni', 'Jln. Kesatria RT.005 RW. 003 Desa Wawai', NULL, '', 'hairiahlima@gmail.com', '1993-04-14', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(164, '6307056609970002', 'Bahzah Mulyana', 'Jl.batuah pandawan', NULL, '', 'bahzah.bbm@gmail.com', '1997-09-26', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(165, '6307062305850004', 'Edy Fitriansyah', 'Desa Bakapas Rt 002/001', NULL, '', 'edyfitriansyah79@gmail.com', '1985-05-23', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(166, '6307096007970001', 'Siti maisarah', 'Hantakan', NULL, '', 'maysarah6982@gmail.com', '1997-07-20', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(167, '6307065604900006', 'SUMIATI', 'DESA BABAI RT 007 RW 002', NULL, '', 'hajarumi39@gmail.com', '1990-04-16', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(168, '6305044709880001', 'Sri welda wati', 'Jalan hulu rasau rt 004 rw 002', NULL, '', 'welda.ayip14@gmail.com', '1988-09-07', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(169, '6307075504030001', 'Salsa Della Puteri', 'cukan lipai', NULL, '', 'salsadellaputeri@gmail.com', '2003-04-15', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(170, '6307056908930001', 'Ida royani', 'Kambat selatan Rt.05 Rw.03', NULL, '', 'Idaroyani2901@gmail.com', '1993-08-29', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(171, '6307034911790003', 'KHAIRUNNISA', 'DESA KAPAR RT.006 RW.004', NULL, '', 'anezicha233@gmail.com', '1997-11-09', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(172, '6307016312960001', 'SANTI MARIANI', 'JALAN DIVISI IV ALRI NOMOR 26 RT.001 RW.001', NULL, '', 'santimariani1995@gmail.com', '1995-12-23', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(173, '6307117009970001', 'Erli ahyani', 'Jalan Raya Tapuk, Rt.002 Rw.001', NULL, '', 'Faaufa813@gmail.com', '1997-09-30', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(174, '6307035910920001', 'Tintayinah', 'BANUA KEPAYANG RT 004 RW.002', NULL, '98.494.263.1-733.000', 'tintayinah3112@gmail.com', '1992-10-19', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(175, '6307025210860001', 'Norhayati', 'Jl. Swadaya RT 005 RW 002 Desa Paya Besar', NULL, '', 'NorOhayati2023@gmail.com', '1986-10-12', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(176, '6307015903010002', 'Sonia Anggraini', 'Jln panti asuhan pembentuk Budi Haruyan', NULL, '', 'soniaanggraini190301@gmail.com', '2001-03-19', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(177, '6307022009000004', 'Muhammad Rijali', 'Desa Aluan Mati  RT 01 RW 01 ( Depan Langgar Darul Aman Karamat )', NULL, '', 'bisnisrijal22@gmail.com', '2000-01-03', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(178, '6371015507920006', 'Paramita', 'Jln.A yani Desa Telang Rt. 02', NULL, '76.348.296.5-731.000', 'ramitainnudin@gmail.com', '1992-07-15', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(179, '6307066212990001', 'Noor Amrina Rosyada', 'Jl. IR. PHM. Noor RT04/RW03 Barabai Barat, Barabai', NULL, '', 'amrinarosyada2220@gmail.com', '1999-12-22', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(180, '6307053108990004', 'MUHAMMAD ABDUL KIPLI', 'Mahang Matang Landung', NULL, '', 'muhammadadul31@gmail.com', '1999-03-31', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(181, '6311024801730001', 'Daliati', 'Desa Juhu RT.001 RW.001 KEC. BATANG ALAI TIMUR KAB HULU SUNGAI TENGAH', NULL, '', 'daliatibjm@gmail.com', '1995-04-20', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(182, '6307040606930003', 'MUHAMMAD TAUFIK HIDAYAT', 'Desa Samhurang RT.001 RW.001', NULL, '91.335.958.7-733.000', 'wawa.upik06@gmail.com', '1993-06-06', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(183, '6307066205000006', 'Siti Maisarah', 'Jl. Brigjen H. Hasan Baseri RT. 03 RW. 01 No. 22, Kelurahan Barabai Barat, Kecamatan Barabai, Provinsi Kalimantan Selatan', NULL, '', 'sitimaisarah146@gmail.com', '2000-05-22', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(184, '6307114410000002', 'Rahmawati', 'Desa Tapuk RT 012 RW 006', NULL, '', 'rahmawati4102@gmail.com', '2000-10-04', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(185, '6307014410040002', 'Norlaila Safitri', 'Desa Tabat Padang RT 003 RW 002', NULL, '', 'norlailasafitri03@gmail.com', '2004-10-04', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(186, '6307036501950002', 'Lely Istiqamah', 'Maringgit', NULL, '00.000.000.0-000.000', 'lelyistiqamah25@gmail.com', '1995-01-25', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(187, '6307036507000002', 'Siti Fatimah', 'Taras Padang', NULL, '', 'fatimaahh.hk@gmail.com', '2000-07-25', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(188, '6307025707010006', 'NOURLAILA', 'Jl. Penas Tani IV RT. 001 RW. 001', NULL, '', 'nourlaila171@gmail.com', '2001-07-17', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(189, '6307116503030001', 'Gina Hafizah', 'Abung Surapati No. 120 RT 004 RW 002', NULL, '', 'ginahafizah8940@gmail.com', '2003-03-25', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(190, '6307036408030002', 'Nor Ifta Hasanah', 'Desa Mahang Baru, Rt. 004, Rw. 002', NULL, '', 'iftahhasanah7@gmail.com', '2003-08-24', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(191, '6307065802960002', 'Rahmi fitriyani', 'Awang besar', NULL, '', 'rahmifitriyani773@gmail.com', '1996-02-18', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(192, '6307024508980003', 'LAILA SAFITRI', 'JL. NORMAN HASYIM RT/RW 005/003', NULL, '', 'safitrilaila168@gmail.com', '1998-08-05', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(193, '6307067105020002', 'Maulidya Salsabella', 'Jl.Brigjend.H.Hasan Baseri Rt.03 Rw.01', NULL, '96.196.668.6-733.000', 'Maulidyasalsabella@gmail.com', '2002-05-31', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(194, '6307116006040002', 'Ehsa Azizah', 'Desa Tapuk, RT/RW : 03/02 , Kec. Limpasu, Kab. Hulu Sungai Tengah', NULL, '', 'ehsaazizah2@gmail.com', '2004-06-20', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(195, '6307020406960002', 'RAHMATULLAH SUHANDI', 'JALAN TANJUNG PURA RT. 005 RW. 002', NULL, '90.679.928.3-733.000', 'rahmatsuhandie@gmail.com', '1996-06-04', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(196, '6307044704830003', 'Jaliha', 'Banua Kupang', NULL, '16.965.563.6-733.000', 'jalehaukah9@gmail.com', '1983-04-07', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(197, '6307066603000001', 'NAIMA HERLIYANI', 'Desa Bakapas, RT. 006 RW. 002 Kec. Barabai Kab. Hulu Sungai Tengah', NULL, '', 'herliyaninaima260@gmail.com', '2000-03-26', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(198, '6307074107960069', 'Safitri Agustini', 'Jalan Gerilya H.Hasan Basri Tanah Habang', NULL, '', 'safitriagustini460@gmail.com', '1996-08-06', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(199, '6307035203790001', 'Elly sasmita', 'Jl.pancasila Rt.04 Rw.02', NULL, '', 'ellysasmita7@gmail.com', '1979-03-12', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(200, '6307036811010001', 'Risnawati', 'Telaga Jingah Rt.013 Rw.003', NULL, '', 'risnawati0141@gmail.com', '2001-11-28', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(201, '6307042201950001', 'HUMAIDI', 'Jalan raya desa binjai pirua', NULL, '62.977.806.9-733.000', 'maiditvmaidi@gmail.com', '1995-01-22', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(202, '6307046111020001', 'DEWI', 'Jl. Desa Tabat RT.03 RW.01', NULL, '', 'dewikarulina08@gmail.com', '2002-11-21', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(203, '6307084109960004', 'Jahratun nisa', 'Jl.AHMAD YANI RT 003 RW 002', NULL, '94.398.589.5-733.000', 'zahratunnisa2301@gmail.com', '1996-01-23', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(204, '6307034308780001', 'Irni', 'Desa Sungai Jaranih Rt001RW.001', NULL, '64.248.066.9-733.000', 'irni0308las@gmail.com', '1978-08-03', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(205, '6307105708900001', 'Sri Agustina', 'Awang besar', NULL, '', 'samagustin309@gmail.com', '1990-08-17', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(206, '6307046104010003', 'Kartini Putri Aprilianti', 'Jalan Tabat Rt.01 Rw 01 Kecamatan Labuan Amas Utara Kabupaten Hulu Sungai Tengah', NULL, '', 'puputtabat@gmail.com', '2001-04-21', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(207, '6307105204940001', 'Herlenawati', 'Jalan kesatria pembakulan', NULL, '', 'mmeisya841@gmail.com', '1994-04-12', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(208, '6307102211990001', 'Muliadi', 'Desa Juhu, RT.01 RW.01', NULL, '62.499.250.9-733.000', 'adimuli676@gmail.com', '1999-05-12', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(209, '6307085106870004', 'NURLAILA HASANAH', 'Jalan Haji Damanhuri', NULL, '', 'almiraazril5@gmail.com', '1987-06-11', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(210, '6307074904010001', 'ATIKA DEWI', 'Jalan Surapati Desa Rangas rt.06 rw.03', NULL, '', 'atikadew01@gmail.com', '2001-04-09', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(211, '6307115510900004', 'Rina fitria', 'Desa Tapuk Rt.004 Rw.02', NULL, '', 'mufida050913@gmail.com', '1990-10-15', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(212, '6307045406020003', 'Norafifah handayani', 'Desa kadundung kecamatan labuan amas utara kabupaten hulu sungai Tengah', NULL, '', 'Norafifahhandayani@gmail.com', '2002-06-14', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(213, '6307026707990002', 'jahratun nisa', 'jalan h. arjan rt.005 rw.003', NULL, '', 'jahratunnisaa07@gmail.com', '1999-07-27', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(214, '6307046907050001', 'NOR KHAPIZAH SAPITERI', 'Jl. Banua Kupang RT.06 RW.03', NULL, '', 'sapiterinorkhafizah@gmail.com', '2004-07-29', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(215, '6307071609010006', 'MUHAMMAD HADI', 'Desa Tembuk bahalang Rt001 Rw001', NULL, '', 'muhammadhadixxx@gmail.com', '2001-09-16', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(216, '6202052210000002', 'Ilham Syah Rijal', 'Jl. Walangko', NULL, '', 'ilhamrijal97@gmail.com', '2000-10-22', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(217, '6307050301800001', 'Arkamul Ilmi', 'Mahang sungai hanyar rt.02/01 Pandawan Hulu Sungai Tengah Kalsel', NULL, '72.407.997.5-733.000', 'ilmiarkam@gmail.com', '1980-01-03', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(218, '6307094206920001', 'Nira Prowasih', 'Desa Pasting Rt. 002 Rw. 001 no 119', NULL, '84.794.151.5-733.000', 'niraprowasih@gmail.com', '1992-01-25', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(219, '6307036905900003', 'Raihani puspita sari', 'Desa taal', NULL, '16.213.221.1-733.000', 'eray291990@gmail.com', '1990-05-29', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(220, '6307084608850002', 'Yulida sari', 'Maringgit', NULL, '00.000.000.0-000.000', 'slimah516@gmail.com', '1985-08-06', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(221, '6307064107880126', 'Rahmiati', 'Babai,RT 006/ RW 003', NULL, '80.074.826.1-733.000', 'Hadijahkhalid88@gmail.com', '1988-07-01', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(222, '6307020110920001', 'Heri Gunawan', 'JL. Penas Tani lV Aluan', NULL, '', 'herrylbm@gmail.com', '1992-10-01', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(223, '6307056112010001', 'NOOR HIDAYAH', 'Jln. Karantina, Desa Kayu Rabah, RT 08, RW 03, Kec.Pandawan,  Kab Hulu Sungai Tengah.', NULL, '', 'dayahnoor2610@gmail.com', '2001-12-21', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(224, '6307050612010004', 'Hermansyah', 'Jalan simpang 4 Palajau RT 004 RW 002', NULL, '', 'hermansyahman01@gmail.com', '2001-12-06', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(225, '6307054603010003', 'RISDA TIANI', 'Jalan Sarigading, Desa Banua Batung Rt 03 Rw 02 Kab HST, Kalimantan Selatan', NULL, '', 'risdatiani36@gmail.com', '2001-03-06', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(226, '6307084302000003', 'Ziadatul Hikmah', 'Ilung Pasar Lama', NULL, '', 'ziahikmah76@gmail.com', '2000-02-03', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(227, '6307114702980001', 'Siti maimunah', 'Jln tapuk', NULL, '85.576.636.6-733.000', 'sitimaimunah975@gmail.com', '1998-02-07', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(228, '6307050511990003', 'M. Ainor Yaqin', 'Jalan Gerilya Desa Kambat Selatan RT.02 RW.01', NULL, '', 'bpsainor@gmail.com', '1999-11-05', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(229, '6307095801020002', 'Tini', 'Pasting RT 002 RW 001', NULL, '', 'ttini3117@gmail.com', '2002-01-18', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(230, '6307046203010002', 'Hikmatul Jannah', 'Kadundung RT 006 RW 002', NULL, '', 'hikmatuljannah.03@gmail.com', '2001-03-22', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(231, '6307015707020001', 'Nida Fariha Salsabila', 'Jalan A. Yani Pengambau Hilir Luar RT 005 Rw 002', NULL, '50.536.407.5-733.000', 'nidasalsabila2002@gmail.com', '2002-07-17', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(232, '6307025804980003', 'Rini Mardiani', 'Aluan mati RT 01 RW 01', NULL, '', 'rinimardiani598@gmail.com', '1998-04-18', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(233, '6307062704930003', 'fahrin apriansyah', 'Jl. SARIGADING DESA BANUA BUDI RT.005 RW.003', NULL, '94.344.620.3-733.000', 'apriansyahfahrin@gmail.com', '1994-04-27', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(234, '6305015006900002', 'Zuliah', 'Muara rintis', NULL, '93.976.745.7-733.000', 'Zuliahciye@gmail.com', '1990-06-10', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(235, '6307072005900008', 'AZWAR MUHAYAT', 'BANUA KEPAYANG RT.004 RW.002', NULL, '', 'angoirebens@gmail.com', '1990-05-20', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(236, '6307111409010004', 'Ahmad Hupi', 'Desa Kabang RT.03/RW.03', NULL, '', 'ahmadhupi016@gmail.com', '2001-09-14', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(237, '6307085901020004', 'MARIA ULFAH', 'Desa Haur Gading, Kecamatan Batang Alai Utara, Kabupaten Barabai, HST', NULL, '', 'mu5668776@gmail.com', '2002-01-19', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(238, '6307015410030004', 'NURUL LATIFAH', 'Desa pengambau hulu,kecamatan Haruyan kabupaten Hulu sungai Tengah Kalimantan Selatan 71363', NULL, '', 'nurulllatifahhst@gmail.com', '2003-10-14', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(239, '6307075109920001', 'NORLIANI', 'Jln. Merdeka Desa Lok Besar', NULL, '', 'norliani.ely11@gmail.com', '1992-09-11', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(240, '6307074610960002', 'HARTATI IRIYANI', 'Jalan kesatria desa wawai gardu', NULL, '', 'cemewewaja@gmail.com', '1996-10-06', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(241, '6307074909010003', 'AGNES MONICA', 'Desa Labuhan RT.006 RW.003', NULL, '', 'agnesmonicsa5@gmail.com', '2001-09-09', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(242, '6307051904050001', 'Maulidi Rahman', 'Setiap rt 03 rw 04', NULL, '99.001.381.5-733.000', 'rahmanmaulidi82@gmail.com', '2005-04-19', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(243, '6307052907900002', 'REZEKY ROSYADIE', 'Jl. Rasau RT.004/RW.002', NULL, '', 'saga.fery73@gmail.com', '1990-07-29', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(244, '6206101905970001', 'M. RIPAN', 'Jamil Rt/Rw 004/002 Desa Jamil', NULL, '', 'rifanmuhammad@gmail.com', '1997-05-19', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(245, '6307065008950003', 'Dewi Karimah', 'Jalan Mualimin RT 09 RW 04', NULL, '', 'dewikarimah10@gmail.com', '1995-08-10', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(246, '6307067011000005', 'NISRINA FATIMATU ZAHRA', 'Jalan Hevea No.44 RT.004 RW.002', NULL, '', 'nirina.zahra01@gmail.com', '2000-11-30', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(247, '6307054103020001', 'Maulida Sovia', 'Kayu Rabah, RT02/RW01', NULL, '', 'maulidasopia251@gmail.com', '2002-03-01', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(248, '6307041503010002', 'MUHAMMAD MUZAKIR', 'DESA BANUA KUPANG RT. 001 RW. 001 KEC. LABUAN AMAS UTARA KAB. HULU SUNGAI TENGAH PROV. KALIMANTAN SELATAN KODE POS. 71362', NULL, '50.983.788.6-733.000', 'muhammadmuzakir1506@gmail.com', '2001-03-15', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(249, '6308056107910001', 'Shalihah', 'Komplek Pesona Madani Durian Gantang Nomor E28 Rt.003 Kecamatan Labuan amas selatan Kabupaten Hulu sungai Tengah', NULL, '82.801.743.4-733.000', 'Leehanaufal19@gmail.com', '1991-07-21', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(250, '6307114110860001', 'Nordiati', 'Desa Tapuk Rt.004 Rw.002 No.001 kec. Limpasu', NULL, '75.098.688.7-733.000', 'muhammadilmi.brb@gmail.com', '1986-10-01', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(251, '6307085204030001', 'Safia Rahmah', 'Jalan A. Yani Desa Muara Rintis RT 002 / RW 001', NULL, '', 'safiasafsr@gmail.com', '2003-04-12', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(252, '6307034207030005', 'Norhayat', 'Desa Taal', NULL, '', 'norhayat0207@gmail.com', '2003-07-02', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(253, '6307061503980003', 'Muhammad Ridha Fuady', 'Birayang Surapati', NULL, '', 'fuadyfu@gmail.com', '1998-03-15', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(254, '6307052709860001', 'Yusi rizal', 'Desa Walatung Rt 006 Rw 003', NULL, '97.696.544.2-733.000', 'yusirizal20@gmail.com', '1986-09-27', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(255, '6307050510900006', 'MURHAN', 'JL. SARIGADING RT 005 RW 003 DESA BANUA BUDI', NULL, '', 'murhanbanbud@gmail.com', '1990-10-05', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(256, '6307080501960002', 'AHMAD RIFANSYAH', 'Desa Sumanggi', NULL, '', 'rifansyaha0@gmail.com', '1996-01-05', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(257, '6307081112800002', 'IRIANSYAH', 'JL. BINA BANUA DESA ILUNG TENGAH RT. 005', NULL, '', 'tunumma80@gmail.com', '1980-12-11', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(258, '6307050103950002', 'RAHMADI', 'Jalan Setia Desa Kayu Rabah Rt. 06 Rw. 02', NULL, '91.544.621.5-733.000', 'madi@gmail.com', '1995-03-01', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(259, '6307071306910001', 'MUHAMMAD ARIFIN', 'Jl. Gerilya H.Hasan baseri Desa Cukan Lipai RT.06 RW.02', NULL, '', 'arifin6307040@gmail.com', '1991-06-13', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(260, '6307066210010005', 'Siti inabatul ulya', 'Jl. Surapati Banua Jingah rt. 10', NULL, '', 'Ulyayaul2@gmail.com', '2001-10-22', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(261, '6307074501030004', 'Norhayani', 'Tembok Bahalang', NULL, '', 'norhayani050103@gmail.com', '2003-01-05', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(262, '6307041101060001', 'MUHAMMAD RIFAN', 'KADUNDUNG', NULL, '', 'rifanmhmmd11@gmail.com', '2006-01-11', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(263, '6307064706990003', 'Miftahul Jannah', 'Desa Bakapas RT 01 RW 01', NULL, '', 'fcmiftahuljannah@gmail.com', '1999-06-07', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(264, '6307042912960005', 'Rezky Hidayat', 'jln Desa Rantau Keminting', NULL, '', 'rezkyrantaukeminting@gmail.com', '1996-12-29', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(265, '6309054612950003', 'HAMIDA', 'DESA HAWANG RT 005 RW 003', NULL, '', 'hamidadifta@gmail.com', '1995-12-06', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(266, '6307056403940002', 'Abrida Hasanah, SKM', 'Mahang Sungai Hanyar Rt.06 Rw.03 Kec. Pandawan', NULL, '00.000.000.0-000.000', 'AafAfridha2403@gmail.com', '1994-03-24', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(267, '6307064607000003', 'NORWILDAYANTI', 'Jl.Perintis Kemerdekaan, Rt.01 Rw.01', NULL, '', 'norwildayanti@gmail.com', '2000-07-06', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(268, '6307055208020004', 'Anisa Agustina', 'Jl. Sarigading RT 1 RW 1 desa setiap', NULL, '', 'anisaanisaagustina77@gmail.com', '2002-08-12', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(269, '6307020405930002', 'Abdi Fauzi', 'JL. H. ARJAN RT/RW: 006/003', NULL, '82.434.330.5-733.000', 'abdifauzi8@gmail.com', '1993-05-04', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(270, '6307054401980003', 'Media Madiani', 'DESA KAMBAT UTARA RT 001 RW 001', NULL, '', 'mediamadiani04@gmail.com', '1998-01-04', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(271, '6307075005030002', 'Zulfa Raudatun Nissa', 'Tembok Bahalang RT 002 RW 001', NULL, '', 'Zlfrdtnnssaa1234@gmail.com', '2003-05-10', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31');
INSERT INTO `mitras` (`id`, `nik`, `nama`, `alamat`, `rekening`, `npwp`, `email`, `tanggal_lahir`, `kepka_mitra_id`, `created_at`, `updated_at`) VALUES
(272, '6307025708900004', 'RUKAIYAH', 'Jl.Norman Hasyim,RT 003,RW 002', NULL, '', 'iyahr6866@gmail.com', '1990-08-17', 1, '2024-10-25 16:28:31', '2024-10-25 16:28:31'),
(273, '6307037005790001', 'Mahrita Agus', 'Pantai Hambawang Barat, RT 005, RW 002', NULL, '', 'sucilena13@gmail.com', '1979-05-30', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(274, '6307035004020001', 'Norhidayatun Aulia', 'Jalan Banua Kepayang rt.3 rw.2', NULL, '', 'liaauliasarah@gmail.com', '2002-04-10', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(275, '6371025006870008', 'Yuni munazar', 'Desa Durian Gantang', NULL, '', 'munazarr@gmail.com', '1987-06-10', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(276, '6307042404990002', 'Muhammad Arif Abdillah', 'Binjai Pemangkih.RT001/RW001. Kecamatan Labuan Amas Utara. Kabupaten Hulu Sungai Tengah', NULL, '62.744.711.3-733.000', 'muhammadarifabdillah1@gmail.com', '1999-04-24', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(277, '6307036705940001', 'RAHMAH HAYATI', 'Desa Guha RT.04 RW 02', NULL, '', 'rahmahhayati994@gmail.com', '1994-05-27', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(278, '6307064506980006', 'Anna Rahayu Eka Putri Rusadi', 'Jalam Rutas Desa Kayu Bawang', NULL, '50.200.616.6-733.000', 'annarahayueka@gmail.com', '1998-06-05', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(279, '6307040708830002', 'UMAR', 'Desa Sungai Buluh RT 005', NULL, '', 'fatihmuhammad940@gmail.com', '1983-08-07', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(280, '6307065104000004', 'Susilawati', 'Jalan Trikesuma RT/RW 012/001', NULL, '', 'sswati150400@gmail.com', '2000-04-11', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(281, '6307055701920006', 'Rini Saputri', 'Desa Kambat Utara RT. 002 RW. 001', NULL, '83.298.174.0-733.000', 'rini.saputri@gmail.com', '1992-01-17', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(282, '6307040611790004', 'Abdul Hadi', 'Pemangkih Seberang RT 02,RW01', NULL, '', 'abulpemangkih22@gmail.com', '1979-11-06', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(283, '6307064602810006', 'ARY NINTA SARI', 'Jl. Hevea rt 004 rw 002', NULL, '', 'arynientasari@gmail.com', '1981-02-06', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(284, '6307040505830005', 'Harto', 'Sungai Buluh RT 005', NULL, '', 'hardtwo050583@gmail.com', '1983-05-05', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(285, '6307052305860003', 'Farid Wajedi', 'Jalan Sarigading Desa Hilir Banua RT.001 RW.001', NULL, '', 'raesasyafa555@gmail.com', '1986-05-23', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(286, '6307034902010001', 'ASTUTI PEGIANI', 'Desa Guha RT.04 RW 02', NULL, '', 'aastutipegyani@gmail.com', '2001-02-09', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(287, '6307041902030001', 'Muhammad Sauki', 'Desa Rantau keminting,RT.05/RW.03', NULL, '', 'msauki808@gmail.com', '2003-02-19', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(288, '6307025408770001', 'Susan Frahastati', 'Desa Pantai Batung RT 03 / RW 05', NULL, '', 'susanfrahastati18@gmail.com', '1977-08-14', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(289, '6307072205970002', 'ADI WIJAYA', 'Jalan Desa Batu Parahu RT.01 RW.01', NULL, '', 'loklabuhan@gmail.com', '1997-05-22', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(290, '6307041806960003', 'ALPIANNOR', 'DESA PERUMAHAN RT. 004 RW. 002', NULL, '', 'alviahyat@gmail.com', '1996-06-18', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(291, '6307055311970001', 'Fitri Ariani', 'Jalan setia kayu rabah RT 6 RW 2', NULL, '', 'fitri.ariani.apps@gmail.com', '1998-11-23', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(292, '6307111508890001', 'M. WAHYUDI', 'Desa Karau RT 09 RW 03', NULL, '65.268.860.7-733.000', 'Wahyudi191122@gmail.com', '1989-08-15', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(293, '6307050103040001', 'Muhammad bakhieth', 'Jalan putra harapan matang ginalon RT 03 . RW 02', NULL, '', 'Mhmmdbakhieth@gmail.com', '2004-03-01', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(294, '6307040301800003', 'Ali Syafrudin', 'Desa Banua Kupang RT 001/RW 001', NULL, '', 'alisyafrudin705@gmail.com', '1980-01-03', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(295, '6307066403940004', 'Rina Amalia', 'JL.H.ARJAN RT/RW:006/003', NULL, '', 'rinaamalia240394@gmail.com', '1994-03-24', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(296, '6307075009900002', 'INTAN NOOR NOVITASARI', 'Jalan Surapati', NULL, '81.544.876.6-733.000', 'intanbirayang@gmail.com', '1990-09-10', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(297, '6307015406860003', 'Meriatunnisa', 'Jalan Banua Hanyar RT.02 RW.01', NULL, '16.147.749.2-733.000', 'meriatunnisa@gmail.com', '1986-06-14', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(298, '6307090405980002', 'MUHAMMAD RIFAI', 'Jalan Brigjen H. Hasan Basri', NULL, '', 'muhammadrifai.mr688@gmail.com', '1998-05-04', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(299, '6307016211940001', 'RUSMILA SRI RAHAYU', 'Mangunang seberang', NULL, '', 'rusmila.ayu94@gmail.com', '1994-09-22', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(300, '6307055010960003', 'Sapnah Hartati', 'Desa Tungkup Rt 001 Rw 001', NULL, '', 'sapnahhartati52@gmail.com', '1996-10-08', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(301, '6307026303800003', 'Ridawati', 'jln.Penas Tani IV.Rt.03 Rw.01 Desa Aluan', NULL, '', 'rridawati8@gmail.com', '1980-03-23', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(302, '6307027005030003', 'Nurul Karimah', 'Jalan Penas Tani IV, RT 006 RW 003', NULL, '', 'nurulkarimah3005@gmail.com', '2003-05-30', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(303, '6307066009000005', 'Riski wahyuna', 'Jl. Perintis kemerdekaan', NULL, '', 'riskiwahyuna@gmail.com', '2000-09-20', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(304, '6407074502950001', 'SITI AMINAH', 'Pamangkih RT 02 RW 01', NULL, '', 'amisahlan123@gmail.com', '1995-06-05', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(305, '6307040504960001', 'Abdul Rasyid', 'Jl. Desa Tabat', NULL, '', 'raidorabani@gmail.com', '1996-04-05', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(306, '6307061808890015', 'Andy Gunawan', 'Komplek pesona durian gantang', NULL, '82.817.037.3-733.000', 'andygunawan96763@gmail.com', '1989-08-18', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(307, '6307056204980003', 'RIDATUL JANNAH', 'Jl. Sarigading, Hilir Banua', NULL, '', 'ridatuljannah003@gmail.com', '1998-04-22', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(308, '6307060509980001', 'M ERIANSYAH', 'Jl. Perintis Kemerdekaan RT 005 RW 003 Desa Benawa Tengah Kec. Barabai Kab. Hulu sungai tengah prov. Kalimantan Selatan', NULL, '', 'erikriwil23@gmail.com', '2000-01-23', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(309, '6472021401010003', 'Taufik Hidayat', 'Jl. Kesatria No.113 RT.003 RW.001', NULL, '', 'Mhidayat3000@gmail.com', '2001-01-14', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(310, '6307094902010001', 'Aminah', 'Desa Pasting', NULL, '', 'aminahaminah170720@gmail.com', '2001-02-09', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(311, '6305106401920004', 'Siti Fatimah', 'Karau', NULL, '', 'fatimah9292@gmail.com', '1992-01-24', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(312, '6307066808010006', 'Nazla Ramdan Maun', 'Jalan Bintara sungai tabuk gang alfatah RT/02 RW/01', NULL, '', 'nazlarm85@gmail.com', '2001-08-28', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(313, '6307065410040002', 'Siti Salma', 'JL. P. ANTASARI KOMP. BRI RT.12/RW.4 KEL. BARABAI TIMUR KEC. BARABAI', NULL, '', 'sitisalma613@gmail.com', '2004-10-14', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(314, '6307016212920001', 'MAULIDA RAHMAWATI', 'Andang RT 06 RW 03', NULL, '', 'syaifrahma@gmail.com', '1992-12-22', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(315, '6307055402990001', 'Fitrianor  Rahmi', 'Jl. Datu aria, rt.01 rw. 001', NULL, '', 'rahmiami30883@gmail.com', '1999-02-14', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(316, '6307014107970095', 'Ayu Lestari', 'Desa Pahalatan', NULL, '62.762.877.9-733.000', 'ayu273284@gmail.com', '1998-07-05', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(317, '6307040107000160', 'AHMAD NOR', 'Jalan desa pahalatan', NULL, '62.762.877.9-733.000', 'amadnor0@gmail.com', '1999-09-09', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(318, '6307110111940001', 'AHMAD DUDIBAS', 'Desa Tapuk', NULL, '', 'abasdudibas@gmail.com', '1994-11-01', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(319, '6307056811050001', 'EIN WULANDARI', 'Jalan mahang matang landung rt 002/rw 001', NULL, '', 'wulandariein@gmail.com', '2005-11-28', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(320, '6307111506950001', 'Muhammad ihsan', 'Limpasu rt 004/rw 002', NULL, '', 'Ihsanplat@gmail.com', '1995-06-15', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(321, '6307056508990005', 'Misbahul Janah', 'Kambat utara RT. 002 RW. 001 Keç. Pandawan Kab. HST', NULL, '', 'misbahuljanah763@gmail.com', '1999-08-25', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(322, '6310066011980001', 'Jamilah', 'taal', NULL, '', 'j4mil4h2011@gmail.com', '1998-11-20', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(323, '6307061710870003', 'Syarifuddin', 'Jln. Keramat manjang RT/RW 008/003', NULL, '', 'syarif171219@gmail.com', '1987-10-17', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(324, '6372027101890001', 'Siti aisah', 'Jl keramat manjang', NULL, '', 'Dapoergaluh@gmail.com', '1989-01-31', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(325, '6307064809890003', 'Siti Arbainah', 'Taras Padang RT 004 RW 002', NULL, '15.839.722.4-733.000', 'Arbainahs723@gmail.com', '1989-09-08', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(326, '6307055705030002', 'SALMA AULIA', 'Mahang Sungai Hanyar RT.001/RW.001', NULL, '', 'Salmaauliaa1705@gmail.com', '2023-11-17', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(327, '6307036808020003', 'MISLAYANTI', 'BANGKAL', NULL, '', 'mislayanti369@gmail.com', '2002-08-28', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(328, '6307070503010005', 'Fitriyadi', 'Lunjuk Rt 2, Rw 2', NULL, '', 'fitriyadie03@gmail.com', '2001-03-05', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(329, '6307051708030001', 'Muhammad Agus Hadrianor', 'Desa Setiap RT 03  RW 02', 'BRI 123456788089', '', 'agus.hdrnr@gmail.com', '2003-08-17', 1, '2024-10-25 16:28:32', '2024-11-10 06:58:58'),
(330, '6307084201010003', 'Harti Miliyani', 'Jalan Ahmad Yani', NULL, '', 'hartimiliyani@gmail.com', '2001-01-02', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(331, '6307017004950001', 'Triatini,S.Pd', 'Desa Hapulang RT/RW 002/001', NULL, '72.052.156.6-733.000', 'Khadijahtriatini@gmail.com', '1995-04-30', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(332, '6311054207920002', 'Winda Herliani', 'Jalan Haji Damanhuri Desa Ilung', NULL, '', 'khairil25289@gmail.com', '1992-07-02', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(333, '6307063105020006', 'Syah Mizana Yusdin', 'Jl.Penas tani iv,aluan besar RT 01, RW 01', NULL, '', 'Ayudianamira1980@gmail.com', '2002-05-31', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(334, '6307057003990002', 'ASTINA RIYANDINI', 'Desa Mahang Putat RT 003 RW 002', NULL, '', 'astina.riyandini123@gmail.com', '1999-03-30', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(335, '6307054208020003', 'MAYA AGUSTIN', 'MAHANG SUNGAI HANYAR', NULL, '60.745.918.7-733.000', 'Mayaagustin0203@gmail.com', '2002-08-02', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(336, '6307064611860006', 'NOORHASANAH', 'jalan pagat sarigading', NULL, '', 'hasanahnoor086@gmail.com', '1986-11-06', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(337, '6307062307920005', 'REDHA ADIANI', 'Jl.Surapati Komp.Mawar', NULL, '', 'adiwarank@gmail.com', '1992-07-23', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(338, '6307024107980041', 'Nur Endah Sari', 'Desa Kayu Bawang', NULL, '', 'Indahbjb136@gmail.com', '1998-07-01', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(339, '6307061904960005', 'Muhammad Rida Hafizi', 'Jalan Kh Hasan Ahmad Rt.014 Rw.004', NULL, '60.132.974.1-733.000', 'hafizirida@gmail.com', '1996-04-19', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(340, '6307074604000002', 'Rahmi Rahmayanti', 'Jl. Merdeka, Desa kapar, Rt.009, Rw.005', NULL, '', 'rahmirahmaya@gmail.com', '2000-04-08', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(341, '6307061703020005', 'Muhad Qimal', 'jalan putra harapan matang ginalon', NULL, '', 'qimalmolen17@gmail.com', '2002-03-17', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(342, '6307065605900005', 'ANNISA HIDAYANTHI', 'Jl.kembang melur', NULL, '', 'ahidayanthi@gmail.com', '1990-05-16', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(343, '6307090107000232', 'Muhammad yusuf', 'Hantakan', NULL, '', 'yusufpalker10@gmail.com', '2000-07-01', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(344, '6307065512990005', 'HAMIDAH', 'Jl. Sarigading Desa Banua Binjai RT.004 RW.002', NULL, '', 'hamidah991512@gmail.com', '1999-12-15', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(345, '6307066805970003', 'Sitri Cahyani', 'Jalan Sarigading Banua budi RT.002 RW.003', NULL, '', 'sitrycahyanii@gmail.com', '1997-05-28', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(346, '6307075209040001', 'Ghaitsa Zahra Shofa', 'Jl. merdeka Banua Rantau RT.05 RW.03 No.009', NULL, '', 'azzahraghaitsa4@gmail.com', '2004-09-12', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(347, '6307074112010002', 'Fatimatul Zahra', 'Jl. Merdeka Nomor 057 Rt.002/Rw.001', NULL, '', 'fatimatulzahra012@gmail.com', '2001-12-01', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(348, '6307034505000006', 'Normaliah', 'Gang Dhuvad RT. 06 RW. 003', NULL, '', 'normaliah92@gmail.com', '2000-05-05', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(349, '6307112810990002', 'Akhmad Hafis', 'Desa Karau RT/RW 001/001 Kecamatan Limpasu Kabupaten Hulu Sungai Tengah, Provinsi Kalimantan Selatan', NULL, '', 'akhmadhafis28@gmail.com', '1999-10-28', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(350, '6307055909030001', 'Dea Fidelma', 'Desa Banua Hanyar RT.01 RW.01', NULL, '', 'deafidelma297@gmail.com', '2004-03-02', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(351, '6307056010010002', 'Siti cahyatun', 'Banua hanyar', NULL, '', 'Ayaarabgin@gmail.com', '2001-10-20', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(352, '6307061405010005', 'MUHAMMAD AMIN FADILLAH', 'Jl.SMP RT 08 RW 02 Kel. Barabai Darat Kec. Barabai Kab. HST', NULL, '', 'fadillahamin567@gmail.com', '2001-05-14', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(353, '6307024105010003', 'Zaitun Nor Alles', 'Jl. H. Arjan RT/RW 005/003', NULL, '', 'zaitunnorallesalles3875@gmail.com', '2001-05-01', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(354, '6307032402920003', 'ACHMAD SYAIBANI', 'PANTAI HAMBAWANG', NULL, '16.455.733.2-733.000', 'Syaibania@gmail.com', '1992-02-24', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(355, '6307022511990003', 'MUHAMMAD FIKRI HAIKAL', 'JL. SWADAYA DESA PAYA BESAR, RT 04 RW 02, KEC. BATU BENAWA KAB. HULU SUNGAI TENGAH', NULL, '', 'fikriihh@gmail.com', '1999-11-25', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(356, '6307066703000006', 'SITI NURSINA INDRIANI', 'Komplek Murakata Indah No.134, RT 019 RW 003', NULL, '', 'pluvind@gmail.com', '2000-03-27', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(357, '6307065405950003', 'nor alawiyyah', 'JL. IR. P. H. M. Noor', NULL, '', 'noralawiyyah@gmail.com', '1995-05-14', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(358, '6307112112000001', 'Muhammad Tedy Ramadan', 'Limpasu Rt.05 Rw.03', NULL, '', 'tedyramadan47@gmail.com', '2000-12-21', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(359, '6307054402920001', 'HELYATI', 'Banua Asam Rt.003 Rw.002', NULL, '81.519.774.4-733.000', 'helyati040292@gmail.com', '1992-02-04', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(360, '6307050107970168', 'MUHAMMAD RAMLI', 'Jalan Sarigading RT. 01 RW. 01', NULL, '', 'ramlixmuhammad@gmail.com', '1999-04-23', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(361, '6307044703010004', 'Naftahul Jannah', 'Desa Rantau Keminting RT. 002/ RW. 001', NULL, '', 'naftahuljannah73@gmail.com', '2001-03-07', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(362, '6307062507980006', 'Muhammad Fauzul Azmi', 'Jalan sarigading Rt.6 Bulau dalam', NULL, '', 'fauzul999999@gmail.com', '1998-07-25', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(363, '6307035506980003', 'Isnaniah', 'Desa Mundar RT 007, RW 003', NULL, '', 'Isna2053@gmail.com', '1998-06-15', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(364, '6307075303000002', 'Qarina Fathimah', 'Jl. Kesatria, RT. 003 RW. 002', NULL, '', 'qarin.fathimah@gmail.com', '2000-03-13', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(365, '6307055507000002', 'Rizkatun Hasanah', 'Jl. Putera Harapan Desa Matang Ginalun RT.03 RW.02', NULL, '', 'rzktnhsnh@gmail.com', '2000-07-15', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(366, '6307015511010001', 'AYUDIA RAMADANI', 'Jalan Devisi IV Alri. Desa Andang. RT 005. RW.003.', NULL, '', 'ayudiaramadani03@gmail.com', '2001-11-15', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(367, '6307062610010003', 'Rakha Fauziannur', 'Jalan Guntur barat VII Komplek. Guntur Permai, RT14/RW7, Desa Benawa Tengah, kec. Barabai, Kab. HST, Prov. KALSEL', NULL, '', 'rakhafauziannur@gmail.com', '2001-10-26', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(368, '6307025801970001', 'Dwi Ayu Rahmi Safitri', 'Aluan Mati RT. 001 RW. 001', NULL, '', 'dwiayurahmisafitri18@gmail.com', '1997-01-18', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(369, '6307064308010002', 'Rusnani', 'Mandingin, Gang Cucu H.Sidik RT/RW 010/002', NULL, '', 'nanirusnani7890@gmail.com', '2001-08-03', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(370, '6307066005000005', 'Fahriani', 'Desa Bakapas RT 05 RW 02, Kecamatan Barabai, Kabupaten Hulu Sungai Tengah', NULL, '', 'fahrianifahri10@gmail.com', '2000-05-20', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(371, '6307070706990001', 'Muhammad Syuhada Rahman', 'Kias', NULL, '', 'syuhadarahman5@gmail.com', '1999-06-07', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(372, '6307081406000005', 'Muhammad Azmi Rahman', 'Jalan A. Yani Haur Gading Nomor  269 RT 05 RW 03', NULL, '', 'muhammadazmirahman14@gmail.com', '2000-06-14', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(373, '6307066405990004', 'Husnul Khatimah', 'Jl.Ir phm noor no.62', NULL, '', 'Husnul2499@gmail.com', '1999-05-24', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(374, '6307015911000002', 'Khairun Nisa', 'Gg. Taruna Jaya Rt006/003', NULL, '43.079.204.4-733.000', 'knisaa229@gmail.com', '2000-11-19', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(375, '6307026605020002', 'Annisa Maulida', 'Jl. Tanjung Pura Pagat Rt 01/Rw 01', NULL, '', 'maulidaannisa297@gmail.com', '2002-05-26', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(376, '6307065008000002', 'Rina Amelia', 'Jl. Sarigading RT.004/RW.002 Desa Banua Binjai', NULL, '', 'rinaamelia108@gmail.com', '2000-08-10', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(377, '6307062202990007', 'Zainal ilmi', 'Jl. H. M. Syarkawi', NULL, '', 'zainalilmi0857@gmail.com', '1999-02-22', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(378, '6307101306020001', 'Muhammad risnan raudani', 'jl. Kesatria Hinas Kiri, RT.02 RW.03', NULL, '', 'risnanraudani@gmail.com', '2002-06-13', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(379, '6307024107010045', 'SITI ZAINAB', 'Jln. Pangkalan Nasri Desa Layuh RT 01 RW 01', NULL, '', 'sitizainab491@gmail.com', '2001-07-01', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(380, '6307074205900001', 'Nor Alinda', 'Jl. Kesatria, Rt.004 Rw.002 Kel. Birayang Kecamatan Batang Alai Selatan', NULL, '60.156.606.0-733.000', 'alindanor23@gmail.com', '1999-05-02', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(381, '6307025308990002', 'NOR AIDA', 'Jl. Tanjung Pura', NULL, '', 'noraida1245@gmail.com', '1999-08-13', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(382, '6307016005910003', 'Misri Yani', 'Guntung Desa Haruyan Seberang RT.007 RW. 003', NULL, '16.849.072.0-733.000', 'misriy487@gmail.com', '1991-05-20', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(383, '6307066703000004', 'Yasmin Nur Afifah', 'Jalan Muntiraya RT 5 RW 2', NULL, '50.910.087.1-733.000', 'yasminnurafifah27@gmail.com', '2000-03-27', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(384, '6307071508970001', 'RAHMADANI', 'Desa Cukan Lipai, kec.Batang Alai Selatan, kab.Hulu Sungai Tengah, prov.Kalimantan Selatan', NULL, '', 'rahmadanidani296@gmail.com', '1997-01-08', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(385, '6307056812010001', 'Nida Khairiyah', 'Jalan Palas Palajau RT 008 RW 004', NULL, '40.184.630.8-733.000', 'nidakhairiyah28@gmail.com', '2001-12-28', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(386, '6204064112020002', 'Fitria Wahdini', 'Pajukungan', NULL, '', 'fitriawhdn@gmail.com', '2002-12-01', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(387, '6307055704920001', 'Nurul Huda', 'Mahang Matang Landung Rt.01 Rw.01', NULL, '90.125.578.6-733.000', 'nurulnurul7208@gmail.com', '1992-04-17', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(388, '6307066207000001', 'Rina Yuliani', 'Jalan Hevea No 27 RT 004/RW 002', NULL, '', 'rinayulianij2@gmail.com', '2000-07-22', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(389, '6307066207000002', 'Maya Sarnita', 'Jalan Mualimin Gang Karya Bersama RT. 11 RW.03', NULL, '', 'mayasarnita220700@gmail.com', '2000-07-22', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(390, '6307060912000001', 'Rizki Ramadhani', 'Jalan Merdeka, Komplek Murakata Muhibbin No A30', NULL, '', 'ramadhanirizki049@gmail.com', '2000-12-09', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(391, '6307037003000002', 'Arine Rosania', 'Perumahan Bangkal no.01 rt01/rw01', NULL, '40.090.511.3-733.000', 'arinerosania62@gmail.com', '2000-03-30', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(392, '6307063105960002', 'Muhammad Wahyudinnoor', 'Jalan trikesuma gang rambutan', NULL, '60.909.449.5-733.000', 'wahyu.wy802@gmail.com', '1996-05-31', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(393, '6307062609890003', 'Dharma Septian Denny', 'Komplek perumahan bangkal RT.01 RW.01', NULL, '98.099.770.4-733.000', 'dharmadenny86@gmail.com', '1989-09-26', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(394, '6307095006000004', 'Nuratul Muntahana', 'Desa Hantakan, RT. 03/RW. 02', NULL, '', 'hanamuntahana123@gmail.com', '2000-06-10', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(395, '5203195507940007', 'Yulia Ningsih', 'Jln. Ksatria desa muara hungi', NULL, '50.999.333.3-733.000', 'btler2398@gmail.com', '1994-07-15', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(396, '6307065907020003', 'Lisda Hadiyana', 'Desa Mandingin', NULL, '', 'lisdahadiyana@gmail.com', '2002-07-19', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(397, '6307074910950002', 'Hariri rahmatiah', 'Wawai Gardu', NULL, '', 'haririrahmatiah@gmail.com', '1995-10-09', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(398, '6203015803990006', 'Fiqri hardiyanti', 'Komplek Bulau Indah Baru RT 10 RW 05', NULL, '', 'fiqrihardiyanti51@gmail.com', '1999-03-18', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(399, '6307035804050001', 'NORHAYATI', 'Jalan murung Taal RT.04 RW 02', NULL, '86.242.387.8-733.000', 'nh7461779@gmail.com', '2005-04-18', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(400, '6307067009000004', 'Ruwaida', 'Jalan Sarigading Gang Kenanga', NULL, '', 'ruwaidaaa030@gmail.com', '2000-09-30', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(401, '6307060105750015', 'rachmani', 'Jalan surapati desa banua jingah barabai', NULL, '14.817.827.0-733.000', 'rachmani.ssos@gmail.com', '1975-05-01', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(402, '6307051004020004', 'Muhammad Rizki Renaldi', 'Desa Banua Hanyar RT 002 RW 001 Kec. Pandawan', NULL, '', 'rizky.renaldi1004@gmail.com', '2002-04-10', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(403, '6307065309040003', 'NILAM CAHYANI', 'JL.H.M.SYARKAWI RT/015 RW/002 KOMPLEK BULAU INDAH', NULL, '', 'nilamchynyii@gmail.com', '2004-09-13', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(404, '6307070206010001', 'Muhammad Deky Wahyudi', 'Jalan Kesatria Wawai Rt/Rw 005/003', NULL, '65.194.319.3-733.000', 'dekywahyudi87@gmail.com', '2000-06-12', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(405, '6307101306990002', 'RIFANI', 'DS ATIRAN RT.001 RW.001 ATIRAN, BATANG ALAI TIMUR', NULL, '63.320.493.8-733.000', 'hawarifan@gmail.com', '1998-06-13', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(406, '6307025603000002', 'SITI NURHAFIZAH ADHA', 'Desa Haliau RT 001 RW 001', NULL, '', 'adha.lee16@gmail.com', '2000-03-16', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(407, '6307072406970001', 'Abdur Rahim', 'Desa Limbar RT.05 RW.03', NULL, '62.189.167.0-733.000', 'Abdurrahimna@gmail.com', '1997-06-26', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(408, '6307064811000003', 'Siti Nurhaliza', 'Jl. Brigjen H. Hasan Baseri Komplek PU RT 09 RW 03', NULL, '', 'nrhlzicha08@gmail.com', '2000-11-08', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(409, '6307030505000002', 'Juaini Juaini', 'Jl. Pancasila Rt1 Pantai Hambawang Barat', NULL, '', 'juaini742@gmail.com', '2000-05-05', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(410, '6303065104990001', 'Puspita Khairini', 'Komplek bulau indah baru', NULL, '', 'puspitakhairini58@gmail.com', '1999-04-11', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(411, '6307057107990002', 'Noor Aulia Puteri', 'Jl. Putera Harapan, Ds. Matang Ginalun', NULL, '', 'noorauliaputeri@gmail.com', '1999-07-31', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(412, '6307066108000005', 'Dhea Ashfia', 'Jl. H. Ahmad Syafawi Murakata RT 006 RW 002', NULL, '', 'dheaashfiashoo@gmail.com', '2000-08-21', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(413, '6307052406920002', 'Abdus sahid', 'Pajukungan', NULL, '70.004.625.3-733.000', 'Hbalum55@gmail.com', '1992-06-24', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(414, '6307060604840008', 'Wahyudinnor', 'Pajukungan RT. 007 RW 003', NULL, '64.090.857.0-733.000', 'wahyudinnor.barabai@gmail.com', '1984-04-06', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(415, '6307054402990001', 'Jamilatunnisa', ' Komplek Bulau Indah', NULL, '', 'Jamilatunnisa087@gmail.com', '1999-02-04', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(416, '6310096106990003', 'Rizma Elfariani', 'Jalan Mualimin RT. 09 RW. 04', NULL, '', 'rismariani21@gmail.com', '1999-06-21', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(417, '6307060107950167', 'M. Faisal Rahman', 'JL.Ir.P.H.M.Noor Barabai Rt 11/ Rw 04', NULL, '', 'salfayer@gmail.com', '1995-07-01', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(418, '6307061612020005', 'Muhammad Adam', 'Jl.Surapati Banua Jingah RT.007/RW.002', NULL, '', 'muhammadadam16122002@gmail.com', '2002-12-16', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(419, '6307065912990003', 'Tuti Adellia', 'Jalan Bintara RT.007 / RW. 003', NULL, '', 'tutiadelia17@gmail.com', '1999-12-19', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(420, '6307061306970007', 'Fauzi Rahman', 'Jl. Bintara, Gg Cabang 2.', NULL, '', 'fauzirahmanfr013@gmail.com', '1997-06-13', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(421, '6307036303970005', 'Mariyana', 'Jl.desa bangkal, no.18', NULL, '', 'mariyana.hamid@gmail.com', '1997-03-23', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(422, '6307062308970001', 'Muhammad Tsabit Akmal', 'Jl Sarigading Banua Binjai', NULL, '', 'tsabitakmall@gmail.com', '1997-08-23', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(423, '6307076706980002', 'Lini Maulida', 'Jl. mualimin', NULL, '', 'linimaulida27@gmail.com', '1998-06-27', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(424, '6307064412980002', 'Norjannah', 'Jl Trikesuma', NULL, '', 'norjannahnj4@gmail.com', '1998-12-04', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(425, '6307072102970001', 'M. Sairaji', 'Paya', NULL, '', 'mhmmdsairaji@gmail.com', '1997-02-21', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(426, '6307066001980001', 'Widiana Ramadana Yanti', 'Jl. Telaga Sungai Tabuk, RT. 1, RW. 1', NULL, '', 'widianary@gmail.com', '1998-01-20', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(427, '6307080611000001', 'Aldiansyah', 'Jalan Bina Banua Desa Awang', NULL, '', 'aldiansyahhhp@gmail.com', '2000-11-06', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(428, '6303025106010003', 'Maulidia Hayati', 'Jl. Kesuma Bangsa RT 001/RW 001 Kel. Birayang Kec. Batang Alai Selatan', NULL, '', 'maulidiahyti11@gmail.com', '2001-06-11', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(429, '6307042001040001', 'Khairu Rizki Rahmatullah', 'Jalan Raya Kasarangan Rt.006 Rw.002', NULL, '', 'khairurizkirahmatullah@gmail.com', '2004-01-20', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(430, '6307034712980001', 'Mariana Dewi', 'Sungai Jaranih RT.003 RW.002', NULL, '', 'marianadwispn@gmail.com', '1998-12-07', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(431, '6307051508990008', 'Muhammad Agus Setiawan', 'Jalan Gotong Royong RT. 01 RW. 01 No. 23', NULL, '', 'agussetiawanmuhammad64@gmail.com', '1999-08-15', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(432, '6307070504900005', 'Rahmadani', 'Kasarangan RT 007 RW 003', NULL, '16.805.851.9-733.000', 'rahmadanierl@gmail.com', '1990-04-05', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(433, '6307062106010001', 'Syihabuddin', 'Jalan Sarigading RT. 04 RW. 02', NULL, '', 'syihaagromero@gmail.com', '2001-06-21', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(434, '6307045405020001', 'ANISA MAULIDA', 'Jl. Ambawang - Amuntai , gang keluarga 3, RT 003/RW 002', NULL, '', 'anisamaulida14502@gmail.com', '2002-05-14', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(435, '6307064305910003', 'Misliyani', 'Jalan perintis kemerdekaan', NULL, '85.560.220.7-734.000', 'aniemissliya@gmail.com', '1991-05-03', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(436, '6307064512990005', 'Iffah Adilah', 'Jl. Komplek Bulau Indah Baru RT 002/ RW 001', NULL, '', 'adilahiffah@gmail.com', '1999-12-05', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(437, '6307065304980004', 'Herdina Fujianti', 'Jalan Murakata Komplek DPRD', NULL, '', 'fujiantiherdina@gmail.com', '1998-04-13', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(438, '6307067112870002', 'Nila Novie Haryani', 'Jalan Perintis Kemerdekaan Rt.006 Rw.003', NULL, '00.850.909.3-733.000', 'lalanovie89@gmail.com', '1989-12-31', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(439, '6307092908000001', 'MUHAMMAD SALMAN', 'Desa Murung B RT. 008 RW. 003 Kecamatan Hantakan', NULL, '', 'muhammadsalm4n2020@gmail.com', '2000-07-25', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(440, '6307051211960003', 'NOVEI AHDIYAT', 'Mahang Matang Landung RT. 002 RW. 001', NULL, '', 'noveiahdiyat@gmail.com', '1997-11-12', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(441, '6307025305020001', 'Nur Radliyah', 'Jl. H. Arjan, Pantai Batung', NULL, '', 'nurradliyah@gmail.com', '2002-05-13', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(442, '6307065603020004', 'Herlianti', 'Jl. Brigjen H. H. Baseri Bukat RT 007 / RW 003', NULL, '', 'herliantiii0@gmail.com', '2002-03-16', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(443, '6307032004910002', 'Muhammad Yuhdhi', 'Desa sungai rangas RT. 1 RW. 1 No.4', NULL, '', 'm.yuhdhi@gmail.com', '1991-04-20', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(444, '6307080102890005', 'Muhammad Khairil Abidin', 'DESA ILUNG', NULL, '', 'khairilabidin007@gmail.com', '1989-02-01', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(445, '6307074905030001', 'NUR SYIFA', 'Jalan Merdeka', NULL, '', 'syifahadju500@gmail.com', '2003-05-09', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(446, '6307102604990001', 'Muhammad Fazar', 'Jalan Ksatria Rt.06 Rw.02 Desa Batu Tangga', NULL, '00.000.000.0-000.000', 'muhammadfazar264@gmail.com', '1999-04-26', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(447, '6307114608870002', 'Suraida', 'Desa Kabang Rt 5 Rw 3', NULL, '', 'suraida.aryani87@gmail.com', '1987-08-06', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(448, '6307066508980002', 'LILY MAQRI YANTI', 'Jalan Sarigading', NULL, '91.475.078.1-733.000', 'lilymagriyanti@gmail.com', '1998-08-25', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(449, '6307070606010003', 'Muhammad Maulidi Rahmadani', 'GG Nor ain', NULL, '', 'maulidim505@gmail.com', '2001-06-06', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(450, '6307046002000008', 'ERLIANI', 'Rantau Keminting Rt.004 Rw.002', NULL, '63.996.825.4-733.000', 'erlianii2002@gmail.com', '2000-02-20', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(451, '6307015802990001', 'Norol Alpiya', 'Desa Pengambau Hilir Dalam Kec. Haruyan Kab. Hulu Sungai Tengah', NULL, '', 'norolalpiya1710515320015@gmail.com', '1999-02-18', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(452, '6307031202990002', 'Muhammad Ridwan', 'Jalan Desa Tabudarat Hulu Rt:08, Re:02', NULL, '', 'ridwanabidzar779@gmail.com', '1999-02-12', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(453, '6307034810920002', 'Norhalimah', 'Jalan H, Bahran Jamil RT 06 RW 03', NULL, '63.758.946.6-733.000', 'norhalimah5284@gmail.com', '1992-10-08', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(454, '6303084502010003', 'ATINA RAHMAH', 'Desa Ayuang', NULL, '40.262.727.7-733.000', 'atinarahmah14@gmail.com', '2001-02-05', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(455, '6307065808010004', 'Nahdiati Rahmini', 'Ayuang', NULL, '', 'nahdiatinadiaa@gmail.com', '2001-08-18', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(456, '6307032411920002', 'muhammad arif rahman', 'Desa Banua Kepayang, RT.04/RW.02', NULL, '95.374.210.3-733.000', 'arifpmtk24@gmail.com', '1992-11-24', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(457, '6307010604000003', 'Muhammad Roby Gunawan', 'Jalan Divisi IV ALRI', NULL, '', 'muhammadrobygunawan@gmail.com', '2000-04-06', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(458, '6307065212980003', 'Nor Laila', 'Jl.Sarigading Banua Budi RT.004 RW.002', NULL, '', 'norlaila032@gmail.com', '1998-12-12', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(459, '6307082804960003', 'Muhammad Ismail', 'Jalan H Damanhuri RT.5/RW.3 No.40', NULL, '', 'ismailge.27@gmail.com', '1996-04-28', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(460, '6307062009880002', 'Riza Fahriadi', 'Jl. Ir. P. H. M. Noor RT. 014 RW. 004 Kelurahan Barabai Utara Kecamatan Barabai', NULL, '', 'fahriadi.riza@gmail.com', '1988-09-20', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(461, '6307064401910003', 'Rizki Amalia', 'Jl. Ir. P. H. M. Noor RT. 014 RW. 004 Kelurahan Barabai Utara Kecamatan Barabai', NULL, '', 'rizkiamaliaqelna@gmail.com', '1991-01-04', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(462, '6307054405000005', 'Misnawati', 'Desa Mahang Matang Landung', NULL, '50.583.171.9-733.000', 'mizsna.momoen@gmail.com', '2000-05-04', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(463, '6307065209970005', 'Septhia', 'Jalan Brigjen H. Hasan Baseri. Gang syafaat', NULL, '', 'septhia856@gmail.com', '1997-09-12', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(464, '6307055007000003', 'RUSNAILAH', 'Desa kambat selatan', NULL, '', 'rusnailah93@gmail.com', '2000-07-10', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(465, '6307076603970002', 'Normaiyah', 'Jalan Kesatria', NULL, '53.372.161.5-733.000', 'Normaiyah97@gmail.com', '1997-03-26', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(466, '6311040410900001', 'Alfian Widyananda', 'Desa Andang RT 006 RW 003', NULL, '64.085.546.6-733.000', 'alfianwidyananda90@gmail.com', '1990-10-04', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(467, '6307074109990001', 'Heeni hidayati', 'Desa tanah habang', NULL, '', 'Hennyhidayati25@gmail.com', '1999-10-01', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(468, '6307076909970001', 'SULASTERI', 'Jl. Merdeka RT 004 RW 002 Desa Banua Rantau', NULL, '', 'sulasteriii027@gmail.com', '1997-09-27', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(469, '6307076107010001', 'Ravieta Widieyanti', 'JALAN MERDEKA DESA LOK BESAR RT. 004 RW. 003 KEC. BATANG ALAI SELATAN KAB. HULU SUNGAI TENGAH', NULL, '', 'ravietawidieyanti20@gmail.com', '2001-06-20', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(470, '6307074307010001', 'Raudatul Jannah', 'Jln. Kesatria', NULL, '', 'raudatuljannah261@gmail.com', '2001-07-03', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(471, '6307011208890001', 'Syamsul Rahman', 'Guntung, Desa Haruyan Seberang RT.07 RW.03', NULL, '81.339.451.7-733.000', 'th3sr@yahoo.com', '1989-08-12', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(472, '6307012302000001', 'Ryan Fadhilah', 'Haruyan RT/RW 002/001 Desa Haruyan Kecamatan Haruyan', NULL, '', 'ryanfadhillah71@gmail.com', '2000-02-23', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(473, '6307100411940001', 'MUHAMMAD RIDHA', 'Jalan Ksatria Desa Batu Tangga RT10/ RW03, Kec. Batang Alai Timur, Kab. Hulu Sungai Tengah', NULL, '', 'reidhakukuricik@gmail.com', '1994-11-04', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(474, '6307016010930003', 'Rizke Aulia', 'Desa Tabat Padang RT.006 RW.003', NULL, '91.160.803.2-733.000', 'rizkeauliabarabai@gmail.com', '1993-10-20', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(475, '6307051405900002', 'Suandi', 'jl. sakuatang indah', NULL, '42.299.349.3-733.000', 'andiealfatih@gmail.com', '1990-05-14', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(476, '6309020505850010', 'Ahmad jayandi', 'Jln.A Yani km 149 desa Pengambau Hilir Luar', NULL, '', 'sibujang72031@gmail.com', '1985-05-05', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(477, '6307024601000002', 'Misda Yanti', 'Jalan Tanjung Pura Rt.002 Rw.001', NULL, '', 'Misdaynt06@gmail.com', '2000-01-06', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(478, '6307060505950005', 'MUHAMMAD HASBI SIDIK', 'HULU RASAU RT 004 / RW 002', NULL, '62.173.627.7-733.000', 'hasbisidik05@gmail.com', '1995-05-05', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(479, '6307036712970001', 'NANA YULIANA', 'Desa Taal RT. 003', NULL, '', 'Nanayuliana1297@gmail.com', '1997-12-27', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(480, '6307024610000002', 'Ainur Rahmah', 'Jalan H. Arjan RT 005 RW 003 Desa Pantai Batung, Kecamatan Batu Benawa, Kabupaten Hulu Sungai Tengah, Provinsi Kalimantan Selatan', NULL, '', 'ainrahmaa89@gmail.com', '2000-10-06', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(481, '6307035210990005', 'Fitriani', 'Desa taras padang', NULL, '', 'Fitrianiteras171@gmail.com', '1999-10-12', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(482, '6307036001010004', 'Kiki ludya sari', 'Taras padang', NULL, '', 'sarikiky47@gmail.com', '2001-01-20', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(483, '6307034511000001', 'HELDAYANTI', 'DURIAN GANTANG RT 02 RW 01', NULL, '', 'Heldayanti1105@gmail.com', '2000-05-11', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(484, '6307066411990004', 'Siti Rahmie Yati', 'Jl.Surapati Komp.Graha kartika eka paksi Blok B', NULL, '', 'sitirahmieyati16@gmail.com', '1999-11-16', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(485, '6307052501010001', 'Muhammad Rifqi Amrillah', 'Jl. Datu Aria No.34 RT.001 RW.001 Pandawan', NULL, '50.374.945.9-733.000', 'rifqi.amril@gmail.com', '2001-01-25', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(486, '6307055612970005', 'Novita Sari', 'Walatung', NULL, '', 'novitasari16121998@gmail.com', '1997-12-16', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(487, '6307020503010002', 'Budi', 'Jl. Penas Tani IV Rt 005 Rw 002 Desa Aluan', NULL, '', 'budi39212@gmail.com', '2001-03-05', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(488, '6307034706890001', 'nifhuljannah', 'desa sungai rangas RT.02', NULL, '82.323.460.4-733.000', 'nifhuljannah89@gmail.com', '1989-06-07', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(489, '6307076008920001', 'Pahriana', 'Jl. Ksatria birayang timur rt/rw 04/02 desa birayang timur kec. Batang alai selatan kab. HST', NULL, '00.000.000.0-000.000', 'Riana.barabai@gmail.com', '1992-08-20', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(490, '6307112710990002', 'Syaiful Azmi, S. Kom', 'Jl. Dahri Imberan Gayaba Desa Limpasu RT. 05 RW. 03', NULL, '', 'Sazmi77777@gmail.com', '1999-10-29', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(491, '6307024705000002', 'Rahmiyanti', 'Jl. H. Arjan Desa Pantai Batung RT 005 RW 003', NULL, '', 'rahmiyantiradam88@gmail.com', '2000-05-07', 1, '2024-10-25 16:28:32', '2024-10-25 16:28:32'),
(492, '6307070610980001', 'Muhammad Lutfi', 'Jl.Surapati desa Rangas Kec.BAS Kab.HST', NULL, '', 'mluthfi554@gmail.com', '1998-10-06', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(493, '6307021006920006', 'ACHMAD FAUZAN', 'JL PENAS TANI IV RT 007 RW 004', NULL, '91.131.264.3-733.000', 'ahmaddzan@gmail.com', '1992-06-10', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(494, '6307056409990004', 'Maulida', 'Kayu Rabah RT. 002 RW. 001', NULL, '', 'maulidamaulidalida@gmail.com', '1999-09-24', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(495, '6307065105940007', 'Munawarah', 'Jl. Brigjend H. Hasan Baseri', NULL, '', 'nawra115@gmail.com', '1994-05-11', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(496, '6307040210000003', 'MUHAMMAD ARWI FIRDAUS', 'Desa Rantau Keminting RT 006 RW 003', NULL, '', 'arwifirdaus@gmail.com', '2000-10-02', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(497, '6307072612960001', 'Mahpuz', 'Jalan Gerilya Desa Paya RT. 06/03 No. 428', NULL, '', 'mahpuz96@gmail.com', '1996-12-26', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(498, '6307052207950002', 'MUHAMMAD ANDRIANI', 'DESA JARANIH RT003 RW003 Kec. Pandawan Kabupaten Hulu Sungai Tengah', NULL, '85.005.723.3-733.000', 'muhammadandriani64@gmail.com', '1995-07-22', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(499, '6307060404980004', 'Muhammad Aditya Rachman', 'Jl. Muntiraya No. 75 RT. 05 RW. 02 Kel. Barabai Darat Kec. Barabai Kab. Hulu Sungai Tengah Kalimantan Selatan', NULL, '41.837.071.4-733.000', 'aditrachman44@gmail.com', '1998-04-04', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(500, '6307084608980001', 'Safratu Ilmiah', 'Desa sumanggi', NULL, '53.330.870.6-733.000', 'safratuilmiah06@gmail.com', '1998-08-06', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(501, '6307060209980004', 'Muhammad Abdussalam Riyadhi', 'Jalan Danggung Desa ayuang', NULL, '', 'muhammadabdussalamr@gmail.com', '1998-09-02', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(502, '6307085208030002', 'Nor Kamariah', 'Jl. Ahmad Yani, Desa Haur Gading, RT.03/RW.02', NULL, '', 'norkamariah03@gmail.com', '2003-08-12', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(503, '6307063110020001', 'Muhammad Fajar Aufa Rizqi', 'JL. Keramat Manjang RT.007 / RW. 003', NULL, '', 'qwerty465722@gmail.com', '2002-01-30', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(504, '6307034111920003', 'Marliani', 'Durian Gantang', NULL, '', 'marliani92@gmail.com', '1992-11-01', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(505, '6203034307920003', 'Ramlah', 'Durian Gantang', NULL, '', 'yayahpelangi@gmail.com', '1992-10-10', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(506, '6307025002990001', 'Resma Helliana', 'Jl.Penas tani IV Rt007/Rw004 Desa kahakan', NULL, '53.192.543.6-733.000', 'resmahelliana27@gmail.com', '1999-10-10', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(507, '6306074905860001', 'RAHMAWATI', 'Bangkal RT 002 RW 001', NULL, '82.200.704.3-733.000', 'rahmawatispdmb@gmail.com', '1986-05-09', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(508, '6307016003010005', 'Siti Saudah', 'Desa Haruyan Seberang RT 008 RW 003 Kecamatan Haruyan Kabupaten Hulu Sungai Tengah', NULL, '61.861.796.3-733.000', 'saudahsaudah160@gmail.com', '1999-11-05', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(509, '6307016312970002', 'FARIDATUL MUCHAIRAH', 'Tabat Padang', NULL, '62.325.365.5-733.000', 'faridatulmuchairah@gmail.com', '1997-12-23', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(510, '6307046505940002', 'SITI MARIAM', 'DESA PEMANGKIH RT. 006 RW. 002', NULL, '86.910.543.7-733.000', 'Mariampemangkih@gmail.com', '1994-05-25', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(511, '6307026210940003', 'Erma Mardatillah', 'Jalan Swadaya RT.007/RW.003', NULL, '85.419.187.1-733.000', 'ermamardatillah55@gmail.com', '1994-10-22', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(512, '6307055506980004', 'SITI MUNAWARAH', 'Desa Mahang Sungai Hanyar', NULL, '60.106.444.7-733.000', 'smunawarah720@gmail.com', '1998-06-15', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(513, '6307036506000001', 'maulida arini', 'Tabudarat Hilir RT.005/RW.003', NULL, '', 'arinimaulida80@gmail.com', '2000-06-25', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(514, '6307036504020001', 'LAILA SAFRINA', 'GUHA RT.004 RW.002', NULL, '', 'lailasafrina675@gmail.com', '2002-04-25', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(515, '6307050710020006', 'Muhammad Syahrani', 'Kayu Rabah RT 003 / RW 001', NULL, '', 'muhammadsyahrani1215@gmail.com', '2002-10-07', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(516, '6307035104950007', 'Nor Azkiah', 'Pantai Hambawang Barat RT13/RW003', NULL, '', 'azkiahaja7@gmail.com', '1995-04-11', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(517, '6307034201020002', 'Aulia Mawaddah', 'Guha', NULL, '', 'auliamawaddah0201@gmail.com', '2001-01-02', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(518, '6307055006010003', 'Norul Fatmah', 'Jl pahlawan Rt 006 rw 003 desa kambat selatan', NULL, '', 'fatmahnorulfatmah@gmail.com', '2001-06-10', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(519, '6307066903990002', 'NOR AZIZAH RATNA WATI', 'JL. SURAPATI RT.010/RW.003 DESA BANUA JINGAH', NULL, '', 'norazizahhh9@gmail.com', '1999-03-29', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(520, '6307056308000006', 'Norhikmah, S.Sos', 'Mahang Putat Rt 02 Rw 01', NULL, '', 'norhikmah2308@gmail.com', '1999-08-23', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(521, '6307111002020001', 'MUHAMMAD PARIDI', 'Kabang RT/RW:006/004', NULL, '', 'muhammadparidi12@gmail.com', '2001-07-23', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(522, '6372034610920002', 'IDA MAULIDA', 'JL. DIVISI ALRI RT.002 RW.001 DESA ANDANG', NULL, '', 'idamaulida920@gmail.com', '1992-10-06', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(523, '6307035810010003', 'Siti Aisyah', 'desa.Taras Padang RT.06/RW.03', NULL, '', 'sitiaisyah181021@gmail.com', '2001-10-18', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(524, '6307016509000002', 'Salina Indriani', 'Panggung RT 02 RW 01', NULL, '93.898.134.7-733.000', 'salinaindriani@gmail.com', '2000-09-25', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(525, '6307014104000005', 'Norlaila Faizah', 'Panggung, RT 04 RW 02', NULL, '', 'lailanorfaizah@gmail.com', '2000-03-01', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(526, '6307065012820003', 'Herliyana', 'Desa Pajukungan RT.007', NULL, '64.048.950.6-733.000', 'herliyanabarabai@gmail.com', '1982-12-10', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(527, '6307025209990002', 'Siti Fatimah', 'Desa guha rt 002 rw 001', NULL, '91.389.425.9-733.000', 'fatimahazzahras301@gmail.com', '1999-09-12', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(528, '6311016701840001', 'RINI ANITA', 'SUNGAI JARANIH RT 003 RW 002', NULL, '00.000.000.0-000.000', 'rinianita27011984@gmail.com', '1984-01-27', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(529, '6307034101920004', 'JUM\'ATIAH', 'Jalan jamil Rt.006 Rw.003 Kec. Labuan Amas Selatan Kabupaten Hulu Sungai Tengah', NULL, '75.482.648.5-733.000', 'jumatiah733@gmail.com', '1995-04-18', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(530, '6307055206000003', 'Laras Sania Rezkia', 'JL. Rasau Gg. Hijrah RT. 004 / RW 002', NULL, '', 'lsaniarezkia@gmail.com', '2000-06-12', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(531, '6307054704000001', 'Noor Annisa', 'Jaranih', NULL, '', 'annissanissaa348@gmail.com', '2000-04-07', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(532, '6307056406000001', 'Santi Maulida', 'Jl. Setia Usaha Desa Banua Asam RT/RW 001/001 Kecamatan Pandawan', NULL, '', 'maulidasanti24@gmail.com', '2000-06-24', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(533, '6307056912970003', 'Icha Ariani', 'Jln setia desa kayurabah rt 03 rw 01', NULL, '', 'ichaariani29@gmail.com', '1997-12-29', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(534, '6307085608000006', 'Rizqa Ainul wafiq', 'Jl.ulama ilung pasar lama RT.01', NULL, '', 'ainulwafiqr@gmail.com', '2000-08-16', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(535, '6307106410970001', 'JUMIATI', 'Desa Masiraan Kec. Pandawan', NULL, '', 'rustam.efendi170897@gmail.com', '1997-10-24', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(536, '6307035708990003', 'HIDAYATUS SHALEHAH', 'JALAN RASAU, RT 05 RW 02, KECAMATAN PANDAWAN, KABUPATEN HULU SUNGAI TENGAH', NULL, '', 'hidayatusshalehah40@gmail.com', '1999-08-17', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(537, '6307031907040001', 'Zainal Abidin', 'Bangkal RT 002 RW 001', NULL, '00.000.000.0-000.000', 'znala81@gmail.com', '2004-07-19', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(538, '6307025103030001', 'Faujiah', 'jln. penas tani no.IV desa Kahakan', NULL, '', 'Ziafauziah979@gmail.com', '2003-03-11', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(539, '6307015406020001', 'NAILA HIDAYATI', 'Desa Teluk Mesjid RT 008/RW 004', NULL, '61.523.658.5-733.000', 'nailahidayati3@gmail.com', '2002-06-14', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33');
INSERT INTO `mitras` (`id`, `nik`, `nama`, `alamat`, `rekening`, `npwp`, `email`, `tanggal_lahir`, `kepka_mitra_id`, `created_at`, `updated_at`) VALUES
(540, '6307044903000005', 'Noor Risa', 'DS. BANUA KUPANG,KEC. LABUAN AMAS UTARA KAB. HULU SUNGAI TENGAH KALIMANTAN SELATAN', NULL, '40.200.154.9-733.000', 'noorrisa017@gmail.com', '2000-03-09', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(541, '6307084906000006', 'Sri Maulida Juniarti', 'Jl. Ulama RT. 01 RW. 01', NULL, '', 'srimaulida252@gmail.com', '2000-06-09', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(542, '6307021601970003', 'Muhammad faisyal', 'Jl H Arjan  Rt 005 Rw 003 Kelurahan Murung A', NULL, '76.920.957.8-733.000', 'muhammadfaisyal16@gmail.com', '1997-01-16', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(543, '6307065911000002', 'Rusyda Ilhami', 'Jl. Trikesuma', NULL, '', 'rusydaaelita@gmail.com', '2000-11-19', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(544, '6307010210010001', 'Muhammad Ansyari Rahman', 'Haruyan Seberang Jalan Abdi Banua Rt. 005 Rw.002', NULL, '', 'ansyarimuhammad84@gmail.com', '2001-10-02', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(545, '6307066910010001', 'Luthfia Rahma Meziha', 'Birayang Surapati, RT 006 RW 000', NULL, '', 'fiarahma17@gmail.com', '2001-10-29', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(546, '6307061701980002', 'WAHYU ROSYIDI', 'Jalan Matang Hambawang RT.012 RW.006 No.26', NULL, '', 'wahyurosyidi12@gmail.com', '1998-01-17', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(547, '6371051603840006', 'JOKO KRISTIANTO', 'jalan merdeka desa lok besar RT.09 RW.03 No. 44', NULL, '', 'borneo.jk84@gmail.com', '1984-03-16', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(548, '6307056403030001', 'Nailah Khairiah', 'Jalan Sarigading Desa Hilir Banua RT.001 / RW.001', NULL, '', 'nailahkhairiah7@gmail.com', '2003-03-24', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(549, '6307012007020003', 'Saman Akmal Ridani', 'Teluk Mesjid RT 001 RW 001', NULL, '50.941.083.3-733.000', 'samanakmalridani@gmail.com', '2002-07-20', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(550, '6307016508960002', 'Eli Rahmawati', 'Desa Tabat Padang RT 003 RW 002', NULL, '', 'elly33999@gmail.com', '1996-08-25', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(551, '6307064907910003', 'ANA YULIA WATI', 'Jl. Brigjend h. Hasan Baseri Komplek pu', NULL, '', 'anazhoel22@gmail.com', '1991-07-09', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(552, '6307056202980003', 'MASDIANTI', 'Masiraan RT 001/ RW 001', NULL, '63.670.560.0-733.000', 'Masdiantii22@gmail.com', '1998-02-22', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(553, '6307035512020002', 'DISY RAMUNA MULIDA', 'Jl.H.Arjan', NULL, '', 'desiramunamulida@gmail.com', '2002-12-15', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(554, '6307045008990002', 'Astuti', 'Jalan perumahan rt 002 rw 002 kecamatan labuan amas utara kabupaten hulu sungai tengah', NULL, '', 'astuty.067@gmail.com', '1996-09-03', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(555, '6307080606050001', 'Muhammad Ibrahim Al Azdi', 'JL. Hidup Baru RT.005/RW.003', NULL, '', 'ibrahim06.borneo@gmail.com', '2005-06-06', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(556, '6307034302960003', 'Eva Raihana', 'Jalan Desa Mundar RT 06 RW 03, kecamatan labuan Amas selatan', NULL, '', 'evaraihana465@gmail.com', '1996-02-03', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(557, '6307060305020007', 'Muhammad Qusyairi', 'JL. Sarigading Banua Binjai RT 04/ Rw 02', NULL, '', 'muhammad22qusyairi@gmail.com', '2002-05-03', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(558, '6307056912020001', 'Alya rohali', 'Desa kayu rabah rt 003 rw 001', NULL, '62.783.434.4-733.000', 'Aliya12rohali29@gmail.com', '2002-12-29', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(559, '6307056010010004', 'Lailan Najia', 'Mahang Sungai Hanyar', NULL, '', 'lelannajia@gmail.com', '2001-10-20', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(560, '6307084510940002', 'MIR\'ATUN NISA', 'Desa Awang Baru, RT 004, RW 002', NULL, '', 'nisamiratun94@gmail.com', '1994-10-05', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(561, '6307050201990003', 'Muhammad Rahmadani', 'Kambat Utara', NULL, '', 'ramadanimuhammad021@gmail.com', '1999-01-02', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(562, '6307010505920002', 'Akhmad Jamali', 'Jl. Loklaga Ria RT.006 RW.003', NULL, '92.069.566.5-733.000', 'ahmadjamali05@gmail.com', '1992-05-05', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(563, '6307065402000003', 'Nida Luthfina', 'Jl. A. Yani. Desa Pajukungan. RT.02 RW. 01. Kab. Hulu Sungai Tengah.', NULL, '', 'finaluthfina17@gmail.com', '2000-02-14', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(564, '6307017005970002', 'Mila', 'Hapulang, RT. 06 RW. 03', NULL, '', 'milamilachinchillaaa@gmail.com', '1997-05-30', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(565, '6307055706950002', 'MAHMUZAH', 'Hulu rasau RT.004 RW.002', NULL, '85.266.756.7-733.000', 'mahmuzahmah@gmail.com', '1995-06-17', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(566, '6307084211010002', 'Aina Tiati Noor', 'Desa Sumanggi rt 7, Kec Batang Alai Utara', NULL, '', 'ainatiati@gmail.com', '2001-11-02', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(567, '6307084403990001', 'RISMAYA ULFAH', 'JL. PASAR LAMA RT.07 RW.04', NULL, '43.080.413.8-733.000', 'rismayaulfah043@gmail.com', '1999-03-04', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(568, '6307040208010001', 'MUHAMMAD RUSTAM EFENDI', 'Kadundung Rt02/Rw01 Gang Kampunggadang', NULL, '65.618.825.7-733.000', 'rustamefendii125@gmail.com', '2001-08-02', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(569, '6307031301980002', 'Fajarullah', 'Jalan Bahran Jamil', NULL, '', 'fajarrullah5@gmail.com', '1998-01-13', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(570, '6307020608940001', 'Raeno rahmat koestanto', 'Jl ahmad yani km 175 desa maringgit rt 03 rw 02', NULL, '42.826.085.5-733.000', 'rnrahmatk@gmail.com', '1994-08-06', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(571, '6307081006920001', 'Muhammad Rifani Padli', 'Jl. Pasar Lama RT.07 RW.04', NULL, '76.561.388.0-733.000', 'mrifanipadli@gmail.com', '1992-06-10', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(572, '6307066412990010', 'Norlena Saffitri', 'Komplek Bulau Indah RT 015 / RW 002', NULL, '', 'saffitrinorlena@gmail.com', '1999-12-24', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(573, '6307051407010004', 'Muhammad Akmal', 'Desa Mahang Matang Landung RT. 003 RW. 002', NULL, '', 'muhammadakmal28890@gmail.com', '2001-07-14', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(574, '6307051705040001', 'Muhammad Syafi\'i', 'Desa Banua Hanyar RT 01 RW 01', NULL, '', 'muhammadsyafii32145@gmail.com', '2004-05-14', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(575, '6307066905010002', 'Alifa Nashata Dilla', 'Jl.Komplek Guntur Barat X Rt/RW 014/007', NULL, '', 'ddila4655@gmail.com', '2001-05-29', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(576, '6307055005050002', 'HUSNUL HATIMAH', 'Desa Jaranih ,RT005 RW003, Kec. Pandawan', NULL, '', 'hhatimah39@gmail.com', '2005-03-21', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(577, '6307065008010004', 'Jumratul Aliyah', 'Desa Babai, RT 006 RW 002 Kec. Barabai, Hulu Sungai Tengah', NULL, '', 'aljumratulaliyah@gmail.com', '2001-08-10', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(578, '6307115008010001', 'Riska Aryanti', 'Desa kabang rt. 06 rw 04', NULL, '', 'riskaaryanti85@gmail.com', '2001-08-10', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(579, '6307074205990001', 'Noria hartati', 'Jl merdeka RT 008 RW 004 nomor 11 desa kapar', NULL, '', 'norriahr28@gmail.com', '1999-03-28', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(580, '6307076405980002', 'Mulita Devi', 'Jalan Ksatria Desa Batu Tangga Rt 06 Rw 02', NULL, '00.000.000.0-000.000', 'devimulita@gmail.com', '1998-05-24', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(581, '6307064401020001', 'emma ridawati', 'Jl.kemasan tengah RT.02/RW.01', NULL, '', 'emmaridawatirahman04@gmail.com', '2002-01-04', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(582, '6307052706050002', 'MUHAMMAD FATHURRAHMAN', 'BANUA HANYAR RT:003 RW:001', NULL, '', 'amanmfathurrahman@gmail.com', '2005-06-27', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(583, '6307065109990003', 'Misda Nurul Rina Damaiyanti', 'Jalan Sarigading Desa Banua Budi, Rt 05 Rw 03, Kec. Barabai, Kab. Hulu Sungai Tengah', NULL, '', 'rinadamayanti247@gmail.com', '1999-09-11', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(584, '6307061708920002', 'Muhammad jazri', 'Jalan surapati RT 013 RW 003', NULL, '94.892.896.5-733.000', 'jazreyspesial@gmail.com', '1992-08-18', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(585, '6307075302010005', 'Nurkhaliza Pebriyanti', 'Jl. Kesuma Bangsa, Kelurahan Birayang, Kecamatan Batang Alai Selatan, Kabupaten Hulu Sungai Tengah, Provinsi Kalimantan Selatan, RT. 02, RW. 01, No. 63, Kode Pos 71381', NULL, '', 'nurkhalizapebriyanti@gmail.com', '2001-02-13', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(586, '6306054310880004', 'WAHYU ANITA NINGSIH', 'JL. P. ANTASARI RT/RW 006/002', NULL, '', 'wahyu0anita@gmail.com', '1988-10-03', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(587, '6307056401930003', 'Ratna Dewi', 'Jl. Putera Harapan RT. 003 RW. 002', NULL, '80.603.871.7-733.000', 'rdew0326@gmail.com', '1993-01-24', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(588, '6307016002740001', 'RABIATUL ADAWIAH', 'PANDANU', NULL, '', 'atulufik@gmail.com', '1974-02-20', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(589, '6307010509810001', 'SARIANSYAH', 'Pengambau Hulu RT 06 RW 03', NULL, '', 'sariansyahsariansyah756@gmail.com', '1980-09-05', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(590, '6307066308000003', 'Anita Soraya', 'Jl.Sarigadin, Banua Budi, RT 003/RW 002', NULL, '', 'yayabdr23@gmail.com', '2000-08-23', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(591, '6307065504020002', 'Tsamratul Jannah', 'Desa Kayu Bawang RT.001 RW.001', NULL, '', 'tsamratulj@gmail.com', '2002-04-15', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(592, '6307084507000004', 'FITRI YANI', 'Haur Gading RT.006 RW.003', NULL, '', 'ipitfitriyani49@gmail.com', '2000-07-05', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(593, '6307076611000002', 'NOOR HAFIZAH', 'Jl. Gerilya Desa Paya RT. 06 RW. 03 Kec. Batang Alai Selatan', NULL, '', '96mahpuz@gmail.com', '2000-11-26', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(594, '6307042407970001', 'Ronaldi Saputra', 'Desa Samhurang, Rt. 002/Rw.001', NULL, '', 'ronaldisaputra024@gmail.com', '1997-07-24', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(595, '6307056009010002', 'Norhayati', 'Banua Asam, RT/RW 003/002, Kec. Pandawan, Kab. Hulu Sungai Tengah', NULL, '40.269.534.0-733.000', 'hayatihali09@gmail.com', '2001-09-20', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(596, '6307080210990001', 'M. Arifani', 'Jl. Ilung Pasar Lama RT.007 RW.004', NULL, '', 'Arifanimuhammad12@gmail.com', '1999-10-02', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(597, '6307035011000001', 'Rahmathunnisa', 'Desa Tabudarat Hilir Rt. 06 Rw. 03 Kec. LAS Kab. HST', NULL, '40.564.188.7-733.000', 'rahmathunnisanisa4@gmail.com', '2001-01-01', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(598, '6307035707980002', 'Linda paramita', 'Jamil, RT/RW 04/02', NULL, '', 'lindaparamita221@gmail.com', '1998-07-17', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(599, '6307082810000002', 'M. AFIF ILHAMI', 'Awang Baru, RT. 02, RW. 01', NULL, '', 'afifilham.mhmmd@gmail.com', '2000-10-28', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(600, '6307065809000002', 'Ramadina', 'Jalan Sarigading RT 001 RW 001 Desa Banua Budi', NULL, '', 'ramadinax@gmail.com', '2000-09-18', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(601, '6307086912960001', 'Laili Rizka', 'Desa Sumanggi seberang, rt 04, rw 02', NULL, '', 'Lailirizka29@gmail.com', '1996-12-29', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(602, '6307062910010004', 'Muhammad Riswan', 'Jalan H. M. Syarkawi Komplek Bulau Indah II B Nomor 125 RT 015 / RW 002', NULL, '', 'darkeao77@gmail.com', '2001-10-29', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(603, '6371026604980007', 'Anita Rahma', 'Jalan Binjai Pirua Rt. 001 Rw. 001', NULL, '62.978.843.1-733.000', 'Anitarahma391@gmail.com', '1998-04-26', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(604, '6307065202900003', 'Noor Aida', 'Jln Brigjen H.Hasan Baseri Rt.03 Rw.01', NULL, '83.870.191.0-733.000', 'Hapis0236@gmail.com', '1990-02-12', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(605, '6307036904900002', 'Soraya', 'Desa Taras Padang', NULL, '93.867.632.7-733.000', 'rayahusna199@gmail.com', '1990-04-29', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(606, '6307085502970001', 'Sarinah', 'Labunganak Rt.009 Rw.003', NULL, '42.075.198.4-733.000', 'iyahs5915@gmail.com', '1997-02-15', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(607, '3501094803930003', 'mutiara kusuma yandita', 'Komplek gambah graha asri blok j no 7', NULL, '', 'mutiarakusumayandita@gmail.com', '1993-03-08', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(608, '6307064511020003', 'Sofia Bella Safitri', 'Jalan Hevea Munti Raya Luar', NULL, '', 'Sofiabella893@gmail.com', '2002-09-05', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(609, '6307066512990010', 'Ramadhina Putri', 'Jl. Sarigading', NULL, '', 'putriramadhina519@gmail.com', '1999-12-25', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(610, '6307115610990001', 'Hidayatul Hafizah', 'Desa Karau', NULL, '', 'hfz16hdytl10@gmail.com', '1999-10-16', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(611, '6307075210990004', 'DISTI SILTIAWATI', 'Desa Limbar RT 005 RW 003', NULL, '', 'distisiltiawati@gmail.com', '1999-10-12', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(612, '6401066310990001', 'Erena Fatnisa', 'HARUYAN SEBERANG RT/RW 003/001', NULL, '', 'erenafatnisa23@gmail.com', '1999-10-23', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(613, '6307010209930003', 'ACHMAD RAMLI, S.Sos', 'Guntung RT 007. RW 003', NULL, '66.887.146.0-733.000', 'achmadramli93@gmail.com', '1993-09-02', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(614, '6307037009000001', 'Fatmawati', 'Taras Padang', NULL, '', 'ff5903322@gmail.com', '2000-09-30', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(615, '6308060604990002', 'Ahmad Fahri', 'Desa Sumanggi', NULL, '', 'fahry739@gmail.com', '1999-04-06', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(616, '6307054905000005', 'Norhasanah', 'Jalan Tungkaran', NULL, '', 'norhasanahhh095@gmail.com', '2000-05-09', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(617, '6307054905000006', 'Norhalisyah', 'Jalan Tungkaran', NULL, '', 'norhalisyah.09@gmail.com', '2000-05-09', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(618, '6307052606000002', 'Akhmad Rifky Fadhilah', 'Jalan Kamboja, RT 005/RW 003, Desa Palajau, Kecamatan Pandawan, Hulu Sungai Tengah', NULL, '', 'akhmadrifkyfadhilah@gmail.com', '2000-06-26', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(619, '6307046906000001', 'Maulidya Devi Yuniar', 'Banua kupang', NULL, '96.200.461.0-733.009', 'maulidyadeviyuniar@gmail.com', '2000-06-29', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(620, '6307116512960001', 'IKE MAHRIATI', 'DESA PAUH RT 04 RW 02', NULL, '85.843.148.9-733.000', 'mahriatiike@gmail.com', '1996-12-25', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(621, '6307035302000004', 'Suci Mahdalena', 'JL. Pancasila, Pantai Hambawang Barat', NULL, '', 'sucimahdalena13@gmail.com', '2000-02-13', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(622, '6307016101960001', 'Hayatun Fardhah', 'Jl. Divisi IV Alri Lokbuntar', NULL, '', 'hayatunfardhah6@gmail.com', '1996-01-21', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(623, '6307061512900003', 'Muhammad Akhyar, S.T', 'Desa Pajukungan RT.001 RW.001', NULL, '81.735.922.7-733.000', 'akhyarbuseri@gmail.com', '1990-12-15', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(624, '6307022003960002', 'Faisal Ansyari', 'Jalan Swadaya Desa Paya Besar RT.03 RW.02 Kec. Batu Benawa Kab. Hulu Sungai Tengah', NULL, '39.249.078.5-733.000', 'ansyarifaisal07@gmail.com', '1996-03-20', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(625, '6307036912010002', 'KHAIRINI', 'Jalan Kandang Sari, Desa Mundar, RT.001/RW.001, No.24', NULL, '', 'rini97974@gmail.com', '2001-12-29', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(626, '6307087010020002', 'Siti Norhaliza', 'Jl.Ahmad Yani, Desa Haur Gading, RT.04/RW.02', NULL, '', 'siitinurhalizaaa2002@gmail.com', '2002-10-30', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(627, '6307064208030003', 'Noor Mahfuzah', 'jl Muallimin RT 20 RW 04 Gang 45', NULL, '', 'fuzadila02@gmail.com', '2003-08-02', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(628, '6307046612970001', 'NOOR HALISAH', 'Desa Pemangkih, RT.006 RW.002', NULL, '62.558.789.4-733.000', 'halisah.hst@gmail.com', '1997-12-26', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(629, '6307075107010003', 'Yuli Mediati', 'Birayang RT 06 RW 02', NULL, '', 'yuli.mediati17@gmail.com', '2001-07-11', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(630, '6307015703010003', 'Astri Fatimah', 'Jln.Lok Laga Ria Rt.001 Rw.001', NULL, '', 'astrifatimah964@gmail.com', '2001-03-17', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(631, '6307065803020005', 'Vena Anzaliya', 'Desa Mandingin Rt 011/Rw 02', NULL, '', 'anzaliyav@gmail.com', '2002-03-18', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(632, '6307045406000002', 'Risda Shaleha', 'Rantau Keminting RT004 RW002', NULL, '39.374.392.7-733.000', 'risdashaleha14@gmail.com', '2000-06-14', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(633, '6307086207970003', 'RISDA MAULINA', 'Desa Maringgit, RT. 002 RW. 001, No. 063', NULL, '63.307.532.0-733.000', 'risdamaulina2@gmail.com', '1997-07-22', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(634, '6307036706950002', 'Mudiati Saleha', 'Jl Tabudarat Hilir RT 06 RW 03', NULL, '85.816.462.7-733.000', 'mudiatisaleha27@gmail.com', '1995-06-27', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(635, '6307064509980004', 'ANISA KURNIAWATI', 'Jl. Perintis Kemerdekaan', NULL, '', 'kurniawatianisa260@gmail.com', '1998-09-05', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(636, '6307066508010009', 'INTAN SALSABILA', 'JALAN MUALIMIN GANG KARYA BERSAMA', NULL, '', 'intansalsabila168@gmail.com', '2001-08-25', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(637, '6311032207880002', 'Muhammad Fauzi', 'Desa Haruyan RT 05 RW 03', NULL, '', 'muhammadfauzie88@gmail.com', '1988-07-22', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(638, '6307056908990002', 'Rusdiana', 'Desa Banua Hanyar RT. 01 RW. 01', NULL, '', 'rusdiana0899@gmail.com', '1999-08-29', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(639, '6307054204900003', 'AMY HAPSARI', 'Jalan Batuah Rt.005 Rw.003 Desa Pandawan Kec. Pandawan Kab. Hulu Sungai Tengah, 71352', NULL, '80.713.704.7-733.000', 'amiey.hps@gmail.com', '1990-04-02', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(640, '6307016703930002', 'Norfitri Yani', 'Haruyan Seberang Rt 003 Rw 001', NULL, '', 'fitriyani10459@gmail.com', '1993-03-27', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(641, '6307034107030051', 'Maulida Rahmi', 'Durian Gantang RT.01 RW. 01', NULL, '', 'rahmimaulida938@gmail.com', '2002-05-23', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(642, '6307036512990003', 'Nurwaqi\'ah', 'Jln. Taras Padang RT. 004, RW. 002', NULL, '', 'nurwaqiah898@gmail.com', '1999-12-25', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(643, '6307052411990004', 'muhammad ilmi', 'Jalan Datu aria Rt 001 Rw 001', NULL, '50.979.156.2-733.000', 'milmi6107@gmail.com', '1999-11-24', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(644, '6307087006950001', 'NURUL HIKMAH', 'Jl. Hidup Baru Desa Labung Anak Rt 01 Rt 01 No 05 Kec. BAU Kab. HST', NULL, '86.861.550.1-733.000', 'nikmahnikmah336@gmail.com', '1995-06-30', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(645, '6307026208000003', 'Syahrida Iliani', 'JL. H. M. TAHER RT 05 RW 03', NULL, '', 'syahrida.iliani22@gmail.com', '2000-08-22', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(646, '6307032910990002', 'Rahmatul Khaliq', 'Jl. Pancasila RT.01 RW.01 NO.04', NULL, '', 'rahmatulkhaliq9@gmail.com', '1999-10-29', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(647, '6307056502010004', 'Maria elvida', 'Desa Banua hanyar', NULL, '', 'mariaelvida84@gmail.com', '2001-02-25', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(648, '6307052409970001', 'Adhi Maulana', 'Jalan H. M. Syarkawi RT007 RW003', NULL, '', 'adhiimaulana24@gmail.com', '1997-09-24', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(649, '6307066507990005', 'Desy Yulia Herliani', 'Jalan Swadaya Desa Paya Besar Nomor 103 Rt02 Rw01', NULL, '60.450.039.7-733.000', 'Dedesyulia123@gmail.com', '1999-07-25', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(650, '6307055502920003', 'Dewi Annisa', 'Jalan Putera Harapan RT 06 / RW 03', NULL, '76.411.934.3-733.000', 'annisaadewy@gmail.com', '1992-02-15', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(651, '6307076208980001', 'SITI HADIJAH', 'JL.Gerilya Desa Paya', NULL, '', 'seikokhadijah@gmail.com', '1998-08-22', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(652, '6307074304990001', 'NORLAILY', 'Jalan grliya desa kias, Kec. BAS kab. HST', NULL, '', 'Lailynor53@gmail.com', '1999-04-03', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(653, '6307030712950001', 'Mas adianur', 'Jl benua kepayang RT 5 RW 3', NULL, '', 'adihaikal459@gmail.com', '1995-12-07', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(654, '6213050802970001', 'Muhammad Rizali', 'PAUH. RT.003/RW.001', NULL, '', 'm.rizali1997@gmail.com', '1997-02-08', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(655, '6307060707990003', 'MUHAMMAD NOOR RIZKI', 'Jl. Mualimin RT 011 RW 004', NULL, '', 'mnoorrizki77@gmail.com', '1999-07-07', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(656, '6307036309040002', 'RAISA RIZQIYA', 'Durian Gantang', NULL, '', 'raisarizqiya916@gmail.com', '2004-09-23', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(657, '6307071207010003', 'Rojali Rahman', 'Jalan Merdeka, Desa Lok Besar, RT.9/RW.3, Kecamatan Batang Alai Selatan, Kabupaten Hulu Sungai Tengah', NULL, '', 'rojalirahman012@gmail.com', '2001-07-12', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(658, '6307061105950007', 'Basit alkahfi', 'Jln sarigading bulau', NULL, '', 'kahfi077@gmail.com', '1995-05-11', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(659, '6307062003000004', 'Akhmad Saleh', 'Jln. Perintis Kemerdekaan Rt. 01 Rw. 01', NULL, '39.588.969.4-733.000', 'salehakhmad20@gmail.com', '2000-03-20', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(660, '6307024107000053', 'Khairun Nida', 'Jl. Tanjung Pura Pagat RT.OO9 RW.003', NULL, '', 'khairunnida2001@gmail.com', '2001-01-13', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(661, '6307064208010001', 'Defi Purnama', 'Jalan h.m Syarkawi, Komplek Bulau Indah', NULL, '', 'defipurnama34@gmail.com', '2001-08-02', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(662, '6307043108870001', 'Husin', 'Jalan Timbuk Lama Rt005 Rw002', NULL, '16.537.261.6-733.000', 'husin0316@gmail.com', '1987-08-31', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(663, '6307065901050003', 'Nabila Nor Azizah', 'Komp. Bumi Batung Permai Mandingin', NULL, '', 'naanabila36@gmail.com', '2005-01-19', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(664, '6307050504990002', 'Baihaki', 'Desa Buluan kec. Pandawan Kab. Hulu Sungai Tengah prov. Kalimantan Selatan', NULL, '', 'baihaki1200@gmail.com', '1999-04-05', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(665, '6307061706960005', 'MAHBUB HUMAIDI', 'Jalan Bintara RT. 007 RW. 003', NULL, '93.104.190.9-733.000', 'mahbubhumaidi171771@gmail.com', '1996-06-17', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(666, '6307044811000001', 'Siti Norjannah', 'Banua Kupang Rt 06 Rw 03', NULL, '', 'siti.norjannah018@gmail.com', '2000-11-08', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33'),
(667, '6307034703020001', 'Miftahurrahmah', 'Desa mundar, RT 07 RW 03', NULL, '', 'miftahurrahmah073@gmai.com', '2002-03-07', 1, '2024-10-25 16:28:33', '2024-10-25 16:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `naskah_defaults`
--

CREATE TABLE `naskah_defaults` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_arsip_id` text COLLATE utf8mb4_unicode_ci,
  `jenis_naskah_id` mediumint UNSIGNED DEFAULT NULL,
  `derajat_naskah_id` mediumint UNSIGNED DEFAULT NULL,
  `tata_naskah_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `naskah_defaults`
--

INSERT INTO `naskah_defaults` (`id`, `jenis`, `kode_arsip_id`, `jenis_naskah_id`, `derajat_naskah_id`, `tata_naskah_id`, `created_at`, `updated_at`) VALUES
(1, 'kak', '[118]', 23, 1, 1, '2024-10-26 06:29:25', '2024-10-26 06:29:25'),
(2, 'sk', '[28,29,30,31,32,33,34,35,36,37,38,39,71,72,73,74,75,76,77,78,79,80,81,82]', 5, 1, 1, '2024-10-26 06:30:57', '2024-10-26 06:30:57'),
(3, 'st', '[28,29,30,31,32,33,34,35,36,37,38,39,71,72,73,74,75,76,77,78,79,80,81,82]', 6, 1, 1, '2024-10-26 06:31:14', '2024-10-26 06:31:14'),
(4, 'kontrak', '[28,29,30,31,32,33,34,35,36,37,38,39,71,72,73,74,75,76,77,78,79,80,81,82]', 13, 1, 1, '2024-10-26 06:31:33', '2024-10-26 06:33:47'),
(5, 'bast', '[28,29,30,31,32,33,34,35,36,37,38,39,71,72,73,74,75,76,77,78,79,80,81,82]', 15, 1, 1, '2024-10-26 06:31:52', '2024-10-26 06:34:01'),
(6, 'bastp', '[474]', 15, 1, 1, '2024-11-09 09:07:59', '2024-11-09 09:07:59');

-- --------------------------------------------------------

--
-- Table structure for table `naskah_keluars`
--

CREATE TABLE `naskah_keluars` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_urut` int UNSIGNED DEFAULT NULL,
  `segmen` int UNSIGNED DEFAULT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perihal` text COLLATE utf8mb4_unicode_ci,
  `pengiriman` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `draft` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'M',
  `jenis_naskah_id` mediumint UNSIGNED DEFAULT NULL,
  `derajat_naskah_id` mediumint UNSIGNED DEFAULT NULL,
  `kode_arsip_id` mediumint UNSIGNED DEFAULT NULL,
  `kode_naskah_id` mediumint UNSIGNED DEFAULT NULL,
  `unit_kerja_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `naskah_keluars`
--

INSERT INTO `naskah_keluars` (`id`, `tanggal`, `no_urut`, `segmen`, `nomor`, `tujuan`, `perihal`, `pengiriman`, `tanggal_kirim`, `draft`, `signed`, `generate`, `jenis_naskah_id`, `derajat_naskah_id`, `kode_arsip_id`, `kode_naskah_id`, `unit_kerja_id`, `created_at`, `updated_at`) VALUES
(45, '2024-11-02', 1, 0, 'B-1/63070/KU.320/2024', 'Pejabat Pembuat Komitmen', 'Form Permintaan Pembayaran Biaya Perjalanan Dinas dalam rangka... Pengadaan Perlengkapan....', NULL, NULL, NULL, NULL, 'A', 23, 1, 118, 3, 1, '2024-11-02 17:04:05', '2024-11-02 17:04:05'),
(46, '2024-11-02', 1, 0, '1 TAHUN 2024', 'Petugas Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024', 'SK Petugas Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024', NULL, NULL, NULL, NULL, 'A', 5, 1, 29, 2, 1, '2024-11-02 17:07:28', '2024-11-02 17:07:28'),
(47, '2024-11-02', 2, 0, 'B-2/63071/SS.320/2024', 'Petugas Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024', 'Surat Tugas Petugas Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024', NULL, NULL, NULL, NULL, 'A', 6, 1, 29, 3, 1, '2024-11-02 17:07:28', '2024-11-02 17:07:28'),
(128, '2024-11-02', 1, 0, '1/2024', 'Ahmad maulana', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:34', '2024-11-02 20:37:34'),
(129, '2024-11-02', 2, 0, '2/2024', 'ABDUL MUGNI', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:34', '2024-11-02 20:37:34'),
(130, '2024-11-02', 3, 0, '3/2024', 'Muhammad Din Noor', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:34', '2024-11-02 20:37:34'),
(131, '2024-11-02', 4, 0, '4/2024', 'DIQI ANANDA', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:34', '2024-11-02 20:37:34'),
(132, '2024-11-02', 5, 0, '5/2024', 'MAULIDA FITRI', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:34', '2024-11-02 20:37:34'),
(133, '2024-11-02', 6, 0, '6/2024', 'Hidayatullah', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:34', '2024-11-02 20:37:34'),
(134, '2024-11-02', 7, 0, '7/2024', 'Miseran', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:34', '2024-11-02 20:37:34'),
(135, '2024-11-02', 8, 0, '8/2024', 'Maulidi Rahman', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:35', '2024-11-02 20:37:35'),
(136, '2024-11-02', 9, 0, '9/2024', 'AHMAD RIFANSYAH', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:35', '2024-11-02 20:37:35'),
(137, '2024-11-02', 10, 0, '10/2024', 'MUHAMMAD ARIFIN', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:35', '2024-11-02 20:37:35'),
(138, '2024-11-02', 11, 0, '11/2024', 'UMAR', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:35', '2024-11-02 20:37:35'),
(139, '2024-11-02', 12, 0, '12/2024', 'Abdul Hadi', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:35', '2024-11-02 20:37:35'),
(140, '2024-11-02', 13, 0, '13/2024', 'Muhammad bakhieth', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:35', '2024-11-02 20:37:35'),
(141, '2024-11-02', 14, 0, '14/2024', 'Ali Syafrudin', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:35', '2024-11-02 20:37:35'),
(142, '2024-11-02', 15, 0, '15/2024', 'Muhammad Agus Hadrianor', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:35', '2024-11-02 20:37:35'),
(143, '2024-11-02', 16, 0, '16/2024', 'MUHAMMAD RIDHA', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-02 20:37:35', '2024-11-02 20:37:35'),
(144, '2024-11-02', 17, 0, '17/2024', 'Ahmad maulana', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:28', '2024-11-03 06:16:28'),
(145, '2024-11-02', 18, 0, '18/2024', 'ABDUL MUGNI', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:29', '2024-11-03 06:16:29'),
(146, '2024-11-02', 19, 0, '19/2024', 'Muhammad Din Noor', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:29', '2024-11-03 06:16:29'),
(147, '2024-11-02', 20, 0, '20/2024', 'DIQI ANANDA', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:29', '2024-11-03 06:16:29'),
(148, '2024-11-02', 21, 0, '21/2024', 'MAULIDA FITRI', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:29', '2024-11-03 06:16:29'),
(149, '2024-11-02', 22, 0, '22/2024', 'Hidayatullah', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:29', '2024-11-03 06:16:29'),
(150, '2024-11-02', 23, 0, '23/2024', 'Miseran', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:29', '2024-11-03 06:16:29'),
(151, '2024-11-02', 24, 0, '24/2024', 'Maulidi Rahman', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:29', '2024-11-03 06:16:29'),
(152, '2024-11-02', 25, 0, '25/2024', 'AHMAD RIFANSYAH', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:29', '2024-11-03 06:16:29'),
(153, '2024-11-02', 26, 0, '26/2024', 'MUHAMMAD ARIFIN', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:29', '2024-11-03 06:16:29'),
(154, '2024-11-02', 27, 0, '27/2024', 'UMAR', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:30', '2024-11-03 06:16:30'),
(155, '2024-11-02', 28, 0, '28/2024', 'Abdul Hadi', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:30', '2024-11-03 06:16:30'),
(156, '2024-11-02', 29, 0, '29/2024', 'Muhammad bakhieth', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:30', '2024-11-03 06:16:30'),
(157, '2024-11-02', 30, 0, '30/2024', 'Ali Syafrudin', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:30', '2024-11-03 06:16:30'),
(158, '2024-11-02', 31, 0, '31/2024', 'Muhammad Agus Hadrianor', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:30', '2024-11-03 06:16:30'),
(159, '2024-11-02', 32, 0, '32/2024', 'MUHAMMAD RIDHA', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 06:16:30', '2024-11-03 06:16:30'),
(192, '2024-11-03', 33, 0, '33/2024', 'Ahmad maulana', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:02:58', '2024-11-03 07:02:58'),
(193, '2024-11-03', 34, 0, '34/2024', 'ABDUL MUGNI', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:02:58', '2024-11-03 07:02:58'),
(194, '2024-11-03', 35, 0, '35/2024', 'Muhammad Din Noor', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:02:58', '2024-11-03 07:02:58'),
(195, '2024-11-03', 36, 0, '36/2024', 'DIQI ANANDA', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:02:59', '2024-11-03 07:02:59'),
(196, '2024-11-03', 37, 0, '37/2024', 'MAULIDA FITRI', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:02:59', '2024-11-03 07:02:59'),
(197, '2024-11-03', 38, 0, '38/2024', 'Hidayatullah', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:02:59', '2024-11-03 07:02:59'),
(198, '2024-11-03', 39, 0, '39/2024', 'Miseran', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:02:59', '2024-11-03 07:02:59'),
(199, '2024-11-03', 40, 0, '40/2024', 'Maulidi Rahman', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:02:59', '2024-11-03 07:02:59'),
(200, '2024-11-03', 41, 0, '41/2024', 'AHMAD RIFANSYAH', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:02:59', '2024-11-03 07:02:59'),
(201, '2024-11-03', 42, 0, '42/2024', 'MUHAMMAD ARIFIN', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:02:59', '2024-11-03 07:02:59'),
(202, '2024-11-03', 43, 0, '43/2024', 'UMAR', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:02:59', '2024-11-03 07:02:59'),
(203, '2024-11-03', 44, 0, '44/2024', 'Abdul Hadi', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:03:00', '2024-11-03 07:03:00'),
(204, '2024-11-03', 45, 0, '45/2024', 'Muhammad bakhieth', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:03:00', '2024-11-03 07:03:00'),
(205, '2024-11-03', 46, 0, '46/2024', 'Ali Syafrudin', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:03:00', '2024-11-03 07:03:00'),
(206, '2024-11-03', 47, 0, '47/2024', 'Muhammad Agus Hadrianor', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:03:00', '2024-11-03 07:03:00'),
(207, '2024-11-03', 48, 0, '48/2024', 'MUHAMMAD RIDHA', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:03:00', '2024-11-03 07:03:00'),
(208, '2024-12-31', 49, 0, '49/2024', 'Ahmad maulana', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:47', '2024-11-03 07:39:47'),
(209, '2024-12-31', 50, 0, '50/2024', 'ABDUL MUGNI', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:47', '2024-11-03 07:39:47'),
(210, '2024-12-31', 51, 0, '51/2024', 'Muhammad Din Noor', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:47', '2024-11-03 07:39:47'),
(211, '2024-12-31', 52, 0, '52/2024', 'DIQI ANANDA', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:47', '2024-11-03 07:39:47'),
(212, '2024-12-31', 53, 0, '53/2024', 'MAULIDA FITRI', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:47', '2024-11-03 07:39:47'),
(213, '2024-12-31', 54, 0, '54/2024', 'Hidayatullah', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:47', '2024-11-03 07:39:47'),
(214, '2024-12-31', 55, 0, '55/2024', 'Miseran', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:48', '2024-11-03 07:39:48'),
(215, '2024-12-31', 56, 0, '56/2024', 'Maulidi Rahman', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:48', '2024-11-03 07:39:48'),
(216, '2024-12-31', 57, 0, '57/2024', 'AHMAD RIFANSYAH', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:48', '2024-11-03 07:39:48'),
(217, '2024-12-31', 58, 0, '58/2024', 'MUHAMMAD ARIFIN', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:48', '2024-11-03 07:39:48'),
(218, '2024-12-31', 59, 0, '59/2024', 'UMAR', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:48', '2024-11-03 07:39:48'),
(219, '2024-12-31', 60, 0, '60/2024', 'Abdul Hadi', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:48', '2024-11-03 07:39:48'),
(220, '2024-12-31', 61, 0, '61/2024', 'Muhammad bakhieth', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:48', '2024-11-03 07:39:48'),
(221, '2024-12-31', 62, 0, '62/2024', 'Ali Syafrudin', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:48', '2024-11-03 07:39:48'),
(222, '2024-12-31', 63, 0, '63/2024', 'Muhammad Agus Hadrianor', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:49', '2024-11-03 07:39:49'),
(223, '2024-12-31', 64, 0, '64/2024', 'MUHAMMAD RIDHA', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:39:49', '2024-11-03 07:39:49'),
(224, '2024-11-03', 48, 1, '48.1/2024', 'Ahmad maulana', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:15', '2024-11-03 07:41:15'),
(225, '2024-11-03', 48, 2, '48.2/2024', 'ABDUL MUGNI', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:15', '2024-11-03 07:41:15'),
(226, '2024-11-03', 48, 3, '48.3/2024', 'Muhammad Din Noor', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:15', '2024-11-03 07:41:15'),
(227, '2024-11-03', 48, 4, '48.4/2024', 'DIQI ANANDA', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:15', '2024-11-03 07:41:15'),
(228, '2024-11-03', 48, 5, '48.5/2024', 'MAULIDA FITRI', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:15', '2024-11-03 07:41:15'),
(229, '2024-11-03', 48, 6, '48.6/2024', 'Hidayatullah', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:16', '2024-11-03 07:41:16'),
(230, '2024-11-03', 48, 7, '48.7/2024', 'Miseran', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:16', '2024-11-03 07:41:16'),
(231, '2024-11-03', 48, 8, '48.8/2024', 'Maulidi Rahman', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:16', '2024-11-03 07:41:16'),
(232, '2024-11-03', 48, 9, '48.9/2024', 'AHMAD RIFANSYAH', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:16', '2024-11-03 07:41:16'),
(233, '2024-11-03', 48, 10, '48.10/2024', 'MUHAMMAD ARIFIN', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:16', '2024-11-03 07:41:16'),
(234, '2024-11-03', 48, 11, '48.11/2024', 'UMAR', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:16', '2024-11-03 07:41:16'),
(235, '2024-11-03', 48, 12, '48.12/2024', 'Abdul Hadi', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:16', '2024-11-03 07:41:16'),
(236, '2024-11-03', 48, 13, '48.13/2024', 'Muhammad bakhieth', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:16', '2024-11-03 07:41:16'),
(237, '2024-11-03', 48, 14, '48.14/2024', 'Ali Syafrudin', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:17', '2024-11-03 07:41:17'),
(238, '2024-11-03', 48, 15, '48.15/2024', 'Muhammad Agus Hadrianor', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:17', '2024-11-03 07:41:17'),
(239, '2024-11-03', 48, 16, '48.16/2024', 'MUHAMMAD RIDHA', 'PERJANJIAN KERJA MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 13, 1, 29, 5, 1, '2024-11-03 07:41:17', '2024-11-03 07:41:17'),
(240, '2024-12-31', 65, 0, '65/2024', 'Ahmad maulana', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:22', '2024-11-03 07:41:22'),
(241, '2024-12-31', 66, 0, '66/2024', 'ABDUL MUGNI', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:23', '2024-11-03 07:41:23'),
(242, '2024-12-31', 67, 0, '67/2024', 'Muhammad Din Noor', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:23', '2024-11-03 07:41:23'),
(243, '2024-12-31', 68, 0, '68/2024', 'DIQI ANANDA', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:23', '2024-11-03 07:41:23'),
(244, '2024-12-31', 69, 0, '69/2024', 'MAULIDA FITRI', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:23', '2024-11-03 07:41:23'),
(245, '2024-12-31', 70, 0, '70/2024', 'Hidayatullah', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:23', '2024-11-03 07:41:23'),
(246, '2024-12-31', 71, 0, '71/2024', 'Miseran', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:23', '2024-11-03 07:41:23'),
(247, '2024-12-31', 72, 0, '72/2024', 'Maulidi Rahman', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:23', '2024-11-03 07:41:23'),
(248, '2024-12-31', 73, 0, '73/2024', 'AHMAD RIFANSYAH', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:23', '2024-11-03 07:41:23'),
(249, '2024-12-31', 74, 0, '74/2024', 'MUHAMMAD ARIFIN', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:23', '2024-11-03 07:41:23'),
(250, '2024-12-31', 75, 0, '75/2024', 'UMAR', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:24', '2024-11-03 07:41:24'),
(251, '2024-12-31', 76, 0, '76/2024', 'Abdul Hadi', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:24', '2024-11-03 07:41:24'),
(252, '2024-12-31', 77, 0, '77/2024', 'Muhammad bakhieth', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:24', '2024-11-03 07:41:24'),
(253, '2024-12-31', 78, 0, '78/2024', 'Ali Syafrudin', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:24', '2024-11-03 07:41:24'),
(254, '2024-12-31', 79, 0, '79/2024', 'Muhammad Agus Hadrianor', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:24', '2024-11-03 07:41:24'),
(255, '2024-12-31', 80, 0, '80/2024', 'MUHAMMAD RIDHA', 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS PENDATAAN BULAN DESEMBER TAHUN 2024', NULL, NULL, NULL, NULL, 'A', 15, 1, 29, 5, 1, '2024-11-03 07:41:24', '2024-11-03 07:41:24'),
(256, '2024-11-03', 3, 0, 'B-3/63070/KU.320/2024', 'Pejabat Pembuat Komitmen', 'Form Permintaan Pembelian Kertas F4', NULL, NULL, NULL, NULL, 'A', 23, 1, 118, 3, 1, '2024-11-03 17:57:08', '2024-11-03 17:57:08'),
(258, '2024-11-09', 48, 17, '48.17/2024', 'Pengelola Barang Persediaan', 'BAST Pembelian Kertas F4', NULL, NULL, NULL, NULL, 'A', 15, 1, 474, 5, 1, '2024-11-09 09:32:20', '2024-11-09 09:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `naskah_masuks`
--

CREATE TABLE `naskah_masuks` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `pengirim` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perihal` text COLLATE utf8mb4_unicode_ci,
  `arsip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_naskah_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nova_field_attachments`
--

CREATE TABLE `nova_field_attachments` (
  `id` int UNSIGNED NOT NULL,
  `attachable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachable_id` bigint UNSIGNED NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nova_notifications`
--

CREATE TABLE `nova_notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nova_notifications`
--

INSERT INTO `nova_notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
('9d655f55-6a74-4d78-80a6-deea94c30c8a', 'Laravel\\Nova\\Notifications\\NovaNotification', 'App\\Models\\User', 13, '{\"component\":\"message-notification\",\"icon\":\"download\",\"message\":\"Your report is ready to download.\",\"actionText\":\"Unduh\",\"actionUrl\":\"\",\"openInNewTab\":false,\"type\":\"info\",\"iconClass\":\"text-sky-500\"}', NULL, '2024-11-03 06:39:26', '2024-11-03 06:39:26', NULL),
('9d656175-f203-4718-8d15-2c3fefc06fb4', 'Laravel\\Nova\\Notifications\\NovaNotification', 'App\\Models\\User', 13, '{\"component\":\"message-notification\",\"icon\":\"exclamation\",\"message\":\"Terdapat perubahan pada kontrak mitra!\",\"actionText\":\"Lihat\",\"actionUrl\":\"http:\\/\\/simpede.test\\/resources\\/kontrak-mitras\",\"openInNewTab\":false,\"type\":\"error\",\"iconClass\":\"text-red-500\"}', '2024-11-03 06:46:19', '2024-11-03 06:45:23', '2024-11-03 06:46:19', NULL),
('9d6562e6-2528-4f9f-96ba-631e1d4ff126', 'Laravel\\Nova\\Notifications\\NovaNotification', 'App\\Models\\User', 13, '{\"component\":\"message-notification\",\"icon\":\"exclamation\",\"message\":\"Terdapat perubahan pada kontrak mitra!\",\"actionText\":\"Lihat\",\"actionUrl\":{\"url\":\"\\/app\\/resources\\/kontrak-mitras\",\"remote\":true},\"openInNewTab\":false,\"type\":\"error\",\"iconClass\":\"text-red-500\"}', '2024-11-03 06:49:32', '2024-11-03 06:49:25', '2024-11-03 06:49:32', NULL),
('9d6563fa-7b22-4d8c-ba0b-0f7aebf81a63', 'Laravel\\Nova\\Notifications\\NovaNotification', 'App\\Models\\User', 13, '{\"component\":\"message-notification\",\"icon\":\"exclamation\",\"message\":\"Terdapat perubahan pada kontrak mitra!\",\"actionText\":\"Lihat\",\"actionUrl\":{\"url\":\"\\/app\\/resources\\/kontrak-mitras\",\"remote\":true},\"openInNewTab\":false,\"type\":\"error\",\"iconClass\":\"text-red-500\"}', NULL, '2024-11-03 06:52:26', '2024-11-03 06:52:26', NULL),
('9d6575b2-a6b0-416f-b089-5b43827b4514', 'Laravel\\Nova\\Notifications\\NovaNotification', 'App\\Models\\User', 13, '{\"component\":\"message-notification\",\"icon\":\"exclamation\",\"message\":\"Terdapat perubahan pada kontrak mitra!\",\"actionText\":\"Lihat\",\"actionUrl\":{\"url\":\"\\/app\\/resources\\/kontrak-mitras\",\"remote\":true},\"openInNewTab\":false,\"type\":\"error\",\"iconClass\":\"text-red-500\"}', NULL, '2024-11-03 07:41:59', '2024-11-03 07:41:59', NULL),
('9d72516b-9ca3-4aba-b4b3-bc3bcbfc6088', 'Laravel\\Nova\\Notifications\\NovaNotification', 'App\\Models\\User', 1, '{\"component\":\"message-notification\",\"icon\":\"information-circle\",\"message\":\"Permintaan Persediaan Baru: Muhlis Abdi, S.Si Mengajukan Permintaan Persediaan\",\"actionText\":\"Lihat\",\"actionUrl\":{\"url\":\"\\/app\\/resources\\/permintaan-persediaans\\/\",\"remote\":true},\"openInNewTab\":false,\"type\":\"info\",\"iconClass\":\"text-sky-500\"}', '2024-11-09 17:06:31', '2024-11-09 17:06:18', '2024-11-09 17:06:31', NULL),
('9d72516b-a10f-4c24-b4b5-acc16f36c928', 'Laravel\\Nova\\Notifications\\NovaNotification', 'App\\Models\\User', 25, '{\"component\":\"message-notification\",\"icon\":\"information-circle\",\"message\":\"Permintaan Persediaan Baru: Muhlis Abdi, S.Si Mengajukan Permintaan Persediaan\",\"actionText\":\"Lihat\",\"actionUrl\":{\"url\":\"\\/app\\/resources\\/permintaan-persediaans\\/\",\"remote\":true},\"openInNewTab\":false,\"type\":\"info\",\"iconClass\":\"text-sky-500\"}', NULL, '2024-11-09 17:06:18', '2024-11-09 17:06:18', NULL),
('9d725237-4394-4aa5-88f6-cce0f5cbaf4f', 'Laravel\\Nova\\Notifications\\NovaNotification', 'App\\Models\\User', 1, '{\"component\":\"message-notification\",\"icon\":\"information-circle\",\"message\":\"Permintaan Persediaan Baru: Muhlis Abdi, S.Si Mengajukan Permintaan Persediaan\",\"actionText\":\"Lihat\",\"actionUrl\":{\"url\":\"\\/app\\/resources\\/permintaan-persediaans\\/6\",\"remote\":true},\"openInNewTab\":false,\"type\":\"info\",\"iconClass\":\"text-sky-500\"}', '2024-11-09 17:08:46', '2024-11-09 17:08:31', '2024-11-09 17:08:46', NULL),
('9d725237-4631-41aa-b744-dd23f8a697b6', 'Laravel\\Nova\\Notifications\\NovaNotification', 'App\\Models\\User', 25, '{\"component\":\"message-notification\",\"icon\":\"information-circle\",\"message\":\"Permintaan Persediaan Baru: Muhlis Abdi, S.Si Mengajukan Permintaan Persediaan\",\"actionText\":\"Lihat\",\"actionUrl\":{\"url\":\"\\/app\\/resources\\/permintaan-persediaans\\/6\",\"remote\":true},\"openInNewTab\":false,\"type\":\"info\",\"iconClass\":\"text-sky-500\"}', NULL, '2024-11-09 17:08:31', '2024-11-09 17:08:31', NULL),
('9d72c4bd-160d-46c2-b0d1-2773551d59ce', 'Laravel\\Nova\\Notifications\\NovaNotification', 'App\\Models\\User', 1, '{\"component\":\"message-notification\",\"icon\":\"information-circle\",\"message\":\"Muhlis Abdi, S.Si Mengajukan Permintaan Persediaan\",\"actionText\":\"Lihat\",\"actionUrl\":{\"url\":\"\\/app\\/resources\\/permintaan-persediaans\\/7\",\"remote\":true},\"openInNewTab\":false,\"type\":\"info\",\"iconClass\":\"text-sky-500\"}', NULL, '2024-11-09 22:28:45', '2024-11-09 22:28:45', NULL),
('9d72c4bd-1924-4262-aaac-f404cb7a1ee1', 'Laravel\\Nova\\Notifications\\NovaNotification', 'App\\Models\\User', 25, '{\"component\":\"message-notification\",\"icon\":\"information-circle\",\"message\":\"Muhlis Abdi, S.Si Mengajukan Permintaan Persediaan\",\"actionText\":\"Lihat\",\"actionUrl\":{\"url\":\"\\/app\\/resources\\/permintaan-persediaans\\/7\",\"remote\":true},\"openInNewTab\":false,\"type\":\"info\",\"iconClass\":\"text-sky-500\"}', NULL, '2024-11-09 22:28:45', '2024-11-09 22:28:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nova_pending_field_attachments`
--

CREATE TABLE `nova_pending_field_attachments` (
  `id` int UNSIGNED NOT NULL,
  `draft_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_persediaans`
--

CREATE TABLE `pembelian_persediaans` (
  `id` bigint UNSIGNED NOT NULL,
  `rincian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_kak` date DEFAULT NULL,
  `tanggal_bast` date DEFAULT NULL,
  `tanggal_buku` date DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anggaran_kerangka_acuan_id` mediumint UNSIGNED DEFAULT NULL,
  `kerangka_acuan_id` mediumint UNSIGNED DEFAULT NULL,
  `bast_naskah_keluar_id` mediumint UNSIGNED DEFAULT NULL,
  `ppk_user_id` mediumint UNSIGNED DEFAULT NULL,
  `pbmn_user_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembelian_persediaans`
--

INSERT INTO `pembelian_persediaans` (`id`, `rincian`, `tanggal_kak`, `tanggal_bast`, `tanggal_buku`, `status`, `anggaran_kerangka_acuan_id`, `kerangka_acuan_id`, `bast_naskah_keluar_id`, `ppk_user_id`, `pbmn_user_id`, `created_at`, `updated_at`) VALUES
(5, 'Pembelian Kertas F4', '2024-11-02', '2024-11-09', '2024-11-09', 'diterima', 10, 8, 258, 13, 25, '2024-11-09 09:31:30', '2024-11-09 22:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `pengelolas`
--

CREATE TABLE `pengelolas` (
  `id` bigint UNSIGNED NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` date DEFAULT NULL,
  `inactive` date DEFAULT NULL,
  `user_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengelolas`
--

INSERT INTO `pengelolas` (`id`, `role`, `active`, `inactive`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'ppk', '2024-01-01', NULL, 13, '2024-08-06 06:16:03', '2024-08-07 04:34:10'),
(2, 'admin', '2024-01-01', NULL, 1, '2024-08-06 06:16:29', '2024-08-06 06:16:29'),
(3, 'ppspm', '2024-01-01', NULL, 1, '2024-08-06 06:16:57', '2024-09-11 21:56:32'),
(4, 'bmn', '2024-01-01', NULL, 25, '2024-08-06 06:17:56', '2024-08-07 04:34:49'),
(5, 'pbj', '2024-01-01', NULL, 4, '2024-08-06 06:18:18', '2024-08-07 01:16:46'),
(6, 'bendahara', '2024-01-01', NULL, 16, '2024-08-06 06:18:45', '2024-08-06 06:18:45'),
(7, 'kpa', '2024-01-01', NULL, 22, '2024-08-06 06:19:01', '2024-08-06 06:19:01'),
(8, 'kasubbag', '2024-01-01', NULL, 1, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(10, 'anggota', '2024-01-01', '2024-06-06', 3, '2024-01-01 00:00:00', '2024-11-10 07:20:24'),
(11, 'koordinator', '2024-01-01', NULL, 4, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(12, 'anggota', '2024-01-01', NULL, 5, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(13, 'anggota', '2024-01-01', NULL, 6, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(14, 'anggota', '2024-01-01', NULL, 7, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(15, 'anggota', '2024-01-01', NULL, 8, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(16, 'koordinator', '2024-01-01', NULL, 9, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(17, 'koordinator', '2024-01-01', NULL, 10, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(18, 'koordinator', '2024-01-01', NULL, 11, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(19, 'anggota', '2024-01-01', NULL, 12, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(20, 'anggota', '2024-01-01', NULL, 13, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(21, 'anggota', '2024-01-01', NULL, 14, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(22, 'anggota', '2024-01-01', NULL, 15, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(23, 'anggota', '2024-01-01', NULL, 16, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(24, 'anggota', '2024-01-01', NULL, 17, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(25, 'anggota', '2024-01-01', NULL, 18, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(26, 'anggota', '2024-01-01', NULL, 19, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(27, 'anggota', '2024-01-01', NULL, 20, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(28, 'koordinator', '2024-01-01', NULL, 21, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(29, 'kepala', '2024-01-01', NULL, 22, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(30, 'anggota', '2024-01-01', NULL, 23, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(31, 'anggota', '2024-01-01', NULL, 24, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(32, 'anggota', '2024-01-01', NULL, 25, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(33, 'anggota', '2024-01-01', NULL, 26, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(34, 'anggota', '2024-01-01', NULL, 27, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(35, 'anggota', '2024-01-01', NULL, 1, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(36, 'anggota', '2024-01-01', NULL, 4, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(37, 'anggota', '2024-01-01', NULL, 9, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(38, 'anggota', '2024-01-01', NULL, 10, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(39, 'anggota', '2024-01-01', NULL, 11, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(40, 'anggota', '2024-01-01', NULL, 21, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(41, 'anggota', '2024-01-01', NULL, 22, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(42, 'koordinator', '2024-01-01', NULL, 1, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
(43, 'ppk', '2024-01-01', NULL, 1, '2024-10-26 16:38:10', '2024-10-26 16:38:10'),
(44, 'bmn', '2024-08-07', NULL, 1, '2024-11-05 05:50:40', '2024-11-05 05:50:40'),
(45, 'pbj', '2024-08-07', NULL, 1, '2024-11-05 16:54:48', '2024-11-05 16:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_persediaans`
--

CREATE TABLE `permintaan_persediaans` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal_permintaan` date DEFAULT NULL,
  `tanggal_persetujuan` date DEFAULT NULL,
  `kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pbmn_user_id` mediumint UNSIGNED DEFAULT NULL,
  `user_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permintaan_persediaans`
--

INSERT INTO `permintaan_persediaans` (`id`, `tanggal_permintaan`, `tanggal_persetujuan`, `kegiatan`, `keterangan`, `status`, `pbmn_user_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, '2024-11-09', '2024-11-09', 'Apa', 'aA', 'outdated', 25, 1, '2024-11-09 16:27:54', '2024-11-09 22:23:47'),
(6, '2024-11-09', NULL, 'sdsd', 'dfdf', 'dibuat', NULL, 1, '2024-11-09 17:08:31', '2024-11-09 17:08:31'),
(7, '2024-11-09', NULL, 'dsfsd', 'ffddf', 'dibuat', NULL, 1, '2024-11-09 22:28:45', '2024-11-09 22:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `persediaan_keluars`
--

CREATE TABLE `persediaan_keluars` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor_dokumen` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_dokumen` date DEFAULT NULL,
  `rincian` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_buku` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `persediaan_keluars`
--

INSERT INTO `persediaan_keluars` (`id`, `nomor_dokumen`, `tanggal_dokumen`, `rincian`, `tanggal_buku`, `created_at`, `updated_at`) VALUES
(2, 'sdsfdsw', '2024-11-09', 'dsfdsfd', '2024-11-11', '2024-11-09 18:20:02', '2024-11-09 18:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `persediaan_masuks`
--

CREATE TABLE `persediaan_masuks` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor_dokumen` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_dokumen` date DEFAULT NULL,
  `rincian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_buku` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `realisasi_anggarans`
--

CREATE TABLE `realisasi_anggarans` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal_sp2d` date DEFAULT NULL,
  `nomor_spp` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_sp2d` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uraian` text COLLATE utf8mb4_unicode_ci,
  `coa_id` smallint UNSIGNED DEFAULT NULL,
  `nilai` int DEFAULT NULL,
  `dipa_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `realisasi_anggarans`
--

INSERT INTO `realisasi_anggarans` (`id`, `tanggal_sp2d`, `nomor_spp`, `nomor_sp2d`, `uraian`, `coa_id`, `nilai`, `dipa_id`, `created_at`, `updated_at`) VALUES
(1, '2024-11-01', '00334T', '241101503001409', 'Pembayaran belanja pegawai gaji induk bulan November Tahun 2024 untuk 14 pegawai/31 jiwa', 324, 47690300, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(2, '2024-11-01', '00334T', '241101503001409', 'Pembayaran belanja pegawai gaji induk bulan November Tahun 2024 untuk 14 pegawai/31 jiwa', 327, 863, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(3, '2024-11-01', '00334T', '241101503001409', 'Pembayaran belanja pegawai gaji induk bulan November Tahun 2024 untuk 14 pegawai/31 jiwa', 330, 2870940, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(4, '2024-11-01', '00334T', '241101503001409', 'Pembayaran belanja pegawai gaji induk bulan November Tahun 2024 untuk 14 pegawai/31 jiwa', 333, 708288, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(5, '2024-11-01', '00334T', '241101503001409', 'Pembayaran belanja pegawai gaji induk bulan November Tahun 2024 untuk 14 pegawai/31 jiwa', 336, 1260000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(6, '2024-11-01', '00334T', '241101503001409', 'Pembayaran belanja pegawai gaji induk bulan November Tahun 2024 untuk 14 pegawai/31 jiwa', 339, 4410000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(7, '2024-11-01', '00334T', '241101503001409', 'Pembayaran belanja pegawai gaji induk bulan November Tahun 2024 untuk 14 pegawai/31 jiwa', 342, 51575, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(8, '2024-11-01', '00334T', '241101503001409', 'Pembayaran belanja pegawai gaji induk bulan November Tahun 2024 untuk 14 pegawai/31 jiwa', 345, 2245020, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(9, '2024-11-01', '00334T', '241101503001409', 'Pembayaran belanja pegawai gaji induk bulan November Tahun 2024 untuk 14 pegawai/31 jiwa', 347, 735000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(10, '2024-11-05', '00365T', '241101305001016', 'Pembayaran Tunjangan Kinerja Susulan Bulan Oktober Tahun 2024 untuk 6 Pegawai Sesuai PerpresNo. 99 Tahun 2018 Tanggal 30 Oktober 2018 dan Perka BPS RI No. 101 Tahun 2018 Tanggal 29 November 2018', 351, 27064409, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(11, '2024-01-17', '00007T', '241101301000131', 'Pembayaran Belanja Barang Honorarium Pencacahan Survei IMK Triwulan 4 Tahun 2023 yang dilaksanakan 2-10 Januari 2024 Untuk 4 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.050/KPA Tahun 2023 Tanggal 28 Desember 2023', 127, 1815000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:09'),
(12, '2024-01-25', '00008T', '241101301000222', 'Pembayaran Biaya Transport Lokal Pelatihan Petugas KSA dan Ubinan 2024 tanggal 11 Januari 2024 Untuk 16 Penerima Sesuai Surat Tugas No. 035A/6307/VS.220/01/2024 Tanggal 8 Januari 2024', 308, 2225000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:09'),
(13, '2024-02-07', '00023T', '241101301000528', 'Pembayaran Belanja Barang Kekurangan Honorarium Instruktur Daerah Pelatihan Petugas KSA dan Ubinan tanggal 11 Januari 2024 Atas Nama Hasyimur Rusdi Sesuai SK KPA nomor 63070.002A/KPA Tahun 2024 Tanggal 10Januari 2024', 307, 312000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:09'),
(14, '2024-10-16', '00336T', '241101301007541', 'Pembayaran Belanja Barang Biaya Honorarium Pencacahan Survei Konstruksi Triwulan III Tahun 2024 a.n. Irni Lily Sesuai SK KPA BPS Kab. HST Nomor 63070.050B/KPA Tahun 2024 Tanggal 1 Oktober 2024', 117, 240000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(15, '2024-11-05', '00351T', '241101301007952', 'Pembayaran Belanja Barang Honorarium Pencacahan Survei Harga Konsumen Bulan Oktober Tahun 2024 (HK 1.1, 1.2, 4, 5, 6) Untuk 9 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.051/KPA Tahun 2023 Tanggal 29 Desember 2023', 81, 4700000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(16, '2024-11-05', '00352T', '241101301007953', 'Pembayaran Belanja Barang Honorarium Pencacahan Survei Harga Konsumen Bulan Oktober Tahun 2024 (HK 2.1, 2.2, 3) Untuk 7 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.051/KPA Tahun 2023 Tanggal 29 Desember 2023', 82, 1885000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(17, '2024-11-05', '00355T', '241101301007919', 'Pembayaran Belanja Barang Honorarium Pencacahan Survei Harga Produsen Perdesaan (HD) Bulan Oktober Tahun 2024 Untuk 7 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.052/KPA Tahun 2023 Tanggal 29 Desember 2023', 73, 880000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(18, '2024-11-05', '00356T', '241101301007956', 'Pembayaran Belanja Barang Honorarium Pencacahan Survei Harga Produsen Perdesaan (HKD) Bulan Oktober Tahun 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.052/KPA Tahun 2023 Tanggal 29 Desember 2023', 72, 585000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(19, '2024-11-05', '00357T', '241101301007957', 'Pembayaran Belanja Barang Honorarium Pencacahan Survei Harga Produsen Gabah (SHPG) Bulan Oktober Tahun 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.053/KPA Tahun 2023 Tanggal 29 Desember 2023', 76, 750000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(20, '2024-11-05', '00358T', '241101301007958', 'Pembayaran Belanja Barang Honorarium Pencacahan Survei Harga Produsen Beras di Penggilingan (SHPBG) Bulan Oktober Tahun 2024 Untuk 2 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.053/KPA Tahun 2023 Tanggal 29 Desember 2023', 74, 220000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(21, '2024-11-05', '00353T', '241101301007954', 'Pembayaran Belanja Barang Honorarium Pencacahan Survei Harga Perdagangan Besar (SHPB) Bulan Oktober Tahun 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.026/KPA Tahun 2023 Tanggal 31 Mei 2024', 71, 750000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(22, '2024-11-07', '00371T', '241101301008082', 'Pembayaran Belanja Barang Biaya Honor Pencacahan Survei Harga Kemahalan Kontruksi (SHKK) Triwulan 4 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.055/KPA Tahun 2023 Tanggal 29 Desember 2023', 77, 1020000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(23, '2024-11-05', '00354T', '241101301007955', 'Pembayaran Belanja Barang Honorarium Pencacahan Survei Tingkat Penghunian Kamar Hotel (VHTS) Bulan September Tahun 2024 Yang Dilaksanakan Bulan Oktober 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.056/KPA Tahun 2023Tanggal 29 Desember 2023', 232, 880000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:13'),
(24, '2024-11-07', '00373T', '241101301008152', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 301, 2006000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(25, '2024-11-07', '00373T', '241101301008152', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 302, 10208000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(26, '2024-11-07', '00366T', '241101301008067', 'Pembayaran Belanja Barang Honor Pejabat Pengelola Keuangan, Pengurus/Penyimpan BMN, dan Pejabat Pengadaan BPS Kab. HST Bln Oktober 2024 untuk 7 pegawai sesuai SK KPA nmr 63071.043/KPA tgl 20 Juni 2024,  63071.001J/KPA dan 63071.001H/KPA tgl 3 Jan 2024', 357, 344000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(27, '2024-11-07', '00366T', '241101301008067', 'Pembayaran Belanja Barang Honor Pejabat Pengelola Keuangan, Pengurus/Penyimpan BMN, dan Pejabat Pengadaan BPS Kab. HST Bln Oktober 2024 untuk 7 pegawai sesuai SK KPA nmr 63071.043/KPA tgl 20 Juni 2024,  63071.001J/KPA dan 63071.001H/KPA tgl 3 Jan 2024', 358, 1036000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(28, '2024-11-07', '00366T', '241101301008067', 'Pembayaran Belanja Barang Honor Pejabat Pengelola Keuangan, Pengurus/Penyimpan BMN, dan Pejabat Pengadaan BPS Kab. HST Bln Oktober 2024 untuk 7 pegawai sesuai SK KPA nmr 63071.043/KPA tgl 20 Juni 2024,  63071.001J/KPA dan 63071.001H/KPA tgl 3 Jan 2024', 359, 1512000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(29, '2024-11-07', '00366T', '241101301008067', 'Pembayaran Belanja Barang Honor Pejabat Pengelola Keuangan, Pengurus/Penyimpan BMN, dan Pejabat Pengadaan BPS Kab. HST Bln Oktober 2024 untuk 7 pegawai sesuai SK KPA nmr 63071.043/KPA tgl 20 Juni 2024,  63071.001J/KPA dan 63071.001H/KPA tgl 3 Jan 2024', 360, 396000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(30, '2024-11-07', '00366T', '241101301008067', 'Pembayaran Belanja Barang Honor Pejabat Pengelola Keuangan, Pengurus/Penyimpan BMN, dan Pejabat Pengadaan BPS Kab. HST Bln Oktober 2024 untuk 7 pegawai sesuai SK KPA nmr 63071.043/KPA tgl 20 Juni 2024,  63071.001J/KPA dan 63071.001H/KPA tgl 3 Jan 2024', 362, 180000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(31, '2024-11-07', '00367T', '241101301008068', 'Pembayaran Belanja Barang Honorarium Tim Pengelola SAI BPS Kabupaten Hulu Sungai Tengah Bulan Oktober 2024 untuk 4 pegawai sesuai SK KPA Nomor 63071.043A/KPA Tahun 2024 tanggal 4 Juli 2024', 382, 100000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(32, '2024-11-07', '00367T', '241101301008068', 'Pembayaran Belanja Barang Honorarium Tim Pengelola SAI BPS Kabupaten Hulu Sungai Tengah Bulan Oktober 2024 untuk 4 pegawai sesuai SK KPA Nomor 63071.043A/KPA Tahun 2024 tanggal 4 Juli 2024', 383, 80000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(33, '2024-11-07', '00367T', '241101301008068', 'Pembayaran Belanja Barang Honorarium Tim Pengelola SAI BPS Kabupaten Hulu Sungai Tengah Bulan Oktober 2024 untuk 4 pegawai sesuai SK KPA Nomor 63071.043A/KPA Tahun 2024 tanggal 4 Juli 2024', 384, 150000, 1, '2024-11-10 21:17:14', '2024-11-10 21:22:14'),
(34, '2024-11-05', '00370T', '241101305001015', 'Pembayaran Belanja Pegawai Uang Makan Bulan Oktober Tahun 2024 Untuk 11 Pegawai', 346, 8068000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:14'),
(35, '2024-02-26', '00037T', '241101301000970', 'Pembayaran Belanja Barang Honorarium Pemutakhiran/updating Survei Angkatan kerja Nasional (SAKERNAS) Untuk 7 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.004/KPA Tahun 2024 Tanggal 24 Januari 2024', 150, 2324000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:09'),
(36, '2024-11-07', '00373T', '241101301008152', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 354, 849800, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:14'),
(37, '2024-03-20', '00068T', '241101301001804', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 381, 680000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:09'),
(38, '2024-10-18', '00332T', '241101301007521', 'Pembayaran belanja barang berupa tagihan listrik bulan Oktober 2024 untuk 1 invoice', 366, 3652290, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(39, '2024-10-14', '00330T', '241101301007480', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 367, 69100, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(40, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 368, 1167700, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(41, '2024-10-18', '00331T', '241101301007519', 'Pembayaran belanja barang berupa tagihan telepon bulan Oktober 2024 untuk 1 invoice', 467, 982350, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(42, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 373, 300000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(43, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 375, 3310000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(44, '2024-08-27', '00267T', '241101301006162', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 378, 270000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:12'),
(45, '2024-11-07', '00373T', '241101301008152', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 380, 4320000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:14'),
(46, '2024-02-22', '00038T', '241101301000980', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 172, 2300000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:09'),
(47, '2024-02-22', '00038T', '241101301000980', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 208, 17410000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:09'),
(48, '2024-02-28', '00039T', '241101301001047', 'Pembayaran Belanja Barang Biaya Honorarium Pemutakhiran /updating Susenas Maret dan Seruti Tw I 2024 untuk 41 Penerima Sesuai SK KPA BPS Kabupaten HST Nomor 63070.007A/KPA Tahun 2024 Tanggal 30 Januari 2024', 185, 10956000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:09'),
(49, '2024-02-28', '00040T', '241101301001050', 'Pembayaran Belanja Barang Biaya Pembelian Perlengkapan Pelatihan Petugas Susenas dan Seruti Maret 2024 Sesuai Kuitansi Nomor 22/RZK/02/2024 Tanggal 18 Januari 2024', 204, 3120000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:09'),
(50, '2024-02-28', '00041T', '241101301001048', 'Pembayaran Belanja Barang Biaya Pembelian Perlengkapan Pelatihan Petugas Sakernas Februari 2024 Sesuai Kuitansi Nomor 21/RZK/02/2024 Tanggal 18 Januari 2024', 163, 576000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:09'),
(51, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 364, 2416600, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(52, '2024-09-24', '00299T', '241101301006841', 'Pembayaran Belanja Pegawai Biaya Lembur Bulan Agustus Dalam Rangka Persiapan Rilis Publikasi ST Tahap II Untuk 4 Penerima Sesuai Surat Perintah Kerja Lembur No B-712F/63070/KU.320/08/2024 Tanggal 2 Agustus 2024', 350, 2525000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(53, '2024-11-07', '00366T', '241101301008067', 'Pembayaran Belanja Barang Honor Pejabat Pengelola Keuangan, Pengurus/Penyimpan BMN, dan Pejabat Pengadaan BPS Kab. HST Bln Oktober 2024 untuk 7 pegawai sesuai SK KPA nmr 63071.043/KPA tgl 20 Juni 2024,  63071.001J/KPA dan 63071.001H/KPA tgl 3 Jan 2024', 361, 408000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:14'),
(54, '2024-11-07', '00366T', '241101301008067', 'Pembayaran Belanja Barang Honor Pejabat Pengelola Keuangan, Pengurus/Penyimpan BMN, dan Pejabat Pengadaan BPS Kab. HST Bln Oktober 2024 untuk 7 pegawai sesuai SK KPA nmr 63071.043/KPA tgl 20 Juni 2024,  63071.001J/KPA dan 63071.001H/KPA tgl 3 Jan 2024', 392, 256000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:14'),
(55, '2024-11-07', '00368T', '241101301008066', 'Pembayaran Belanja Barang Biaya Honor Pencacahan Ubinan Palawija Subround 3 Bulan September Tahun 2024 Untuk 5 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.008C/KPA Tahun 2024 Tanggal 1 Februari 2024', 313, 1617000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:14'),
(56, '2024-03-19', '00067T', '241101301001667', 'Pembayaran Belanja Barang Biaya Honorarium Instruktur Nasional Survei Harga Produsen Beras di Penggilingan Untuk 1 Penerima Sesuai SK KPA BPS HST Nomor 63070.002C/KPA Tahun 2024 Tanggal 9 Januari 2024', 390, 777000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:09'),
(57, '2024-03-20', '00068T', '241101301001804', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 353, 436000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:09'),
(58, '2024-08-27', '00267T', '241101301006162', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 356, 11200, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:12'),
(59, '2024-03-20', '00068T', '241101301001804', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 388, 2380000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:09'),
(60, '2024-03-20', '00068T', '241101301001804', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 389, 275000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:09'),
(61, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 396, 650000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(62, '2024-08-06', '00233T', '241101301005639', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 365, 3152000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:12'),
(63, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 376, 285000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(64, '2024-03-20', '00068T', '241101301001804', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 377, 50000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(65, '2024-03-20', '00068T', '241101301001804', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 391, 270000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(66, '2024-03-25', '00069T', '241101301001850', 'Pembayaran Belanja Barang Honorarium Pendataan Lapangan Survei Angkatan Kerja Nasional (Sakernas) Februari Tahun 2024 Untuk 7 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.005/KPA Tahun 2024 Tanggal 24 Januari 2024', 151, 9380000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(67, '2024-10-10', '00328T', '241101301007295', 'Pembayaran Belanja Barang Biaya Honorarium Pendataan Lapangan Seruti TW 3 2024 Untuk 15 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.048E/KPA Tahun 2024 Tanggal 6 September 2024', 189, 9000000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(68, '2024-03-25', '00071T', '241101301001852', 'Pembayaran Belanja Barang Honorarium Pendataan Lapangan Susenas Maret Tahun 2024 yang dilaksanakan tanggal 19 Februari - 9 Maret 2024 Untuk 41 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.011/KPA Tahun 2024 Tanggal 16 Februari 2024', 187, 79200000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(69, '2024-05-14', '00132T', '241101301003117', 'Pembayaran Belanja Pegawai Kekurangan Gaji THR Tahun 2024 untuk 2 pegawai/2 jiwa', 326, 1114280, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(70, '2024-05-14', '00132T', '241101301003117', 'Pembayaran Belanja Pegawai Kekurangan Gaji THR Tahun 2024 untuk 2 pegawai/2 jiwa', 329, 120, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(71, '2024-03-25', '00073T', '241101506000078', 'Pembayaran THR Tahun 2024 Untuk 12 Pegawai.', 332, 2396340, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(72, '2024-03-25', '00073T', '241101506000078', 'Pembayaran THR Tahun 2024 Untuk 12 Pegawai.', 335, 691994, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(73, '2024-03-25', '00072T', '241101503000393', 'Pembayaran THR Tahun 2024 Untuk 16 Pegawai.', 338, 1800000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(74, '2024-05-14', '00132T', '241101301003117', 'Pembayaran Belanja Pegawai Kekurangan Gaji THR Tahun 2024 untuk 2 pegawai/2 jiwa', 341, 1080000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(75, '2024-03-25', '00073T', '241101506000078', 'Pembayaran THR Tahun 2024 Untuk 12 Pegawai.', 344, 1725804, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(76, '2024-03-25', '00073T', '241101506000078', 'Pembayaran THR Tahun 2024 Untuk 12 Pegawai.', 349, 545000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(77, '2024-03-28', '00074T', '241101303000032', 'Pembayaran Belanja Barang Biaya Pengadaan Perlengkapan Pakaian Kerja Pegawai Sesuai Kuitansi Nomor 38/ZA/03/2024 Tanggal 20 Maret 2024', 363, 25606000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(78, '2024-09-27', '00300T', '241101301006905', 'Pembayaran belanja barang Pengadaan Outsourcing termin 3 sesuai kontrak No.03/BPS6307/P-OS/12/2023 Tgl 29-12-23 ADD Kontrak No.03/BPS63/ADD/09/2024 Tgl 24-09-24 BAKP No.08/BPS6307/PJL-MB/09/2024 Tgl 25-09-24 BAP No.09/BPS6307/PJL-MB/09/2024 Tgl 25-09-24', 369, 62453305, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(79, '2024-04-04', '00089T', '241101301002191', 'Pembayaran Belanja Barang Biaya Honorarium Pencacahan Updating Direktori Perusahaan Konstruksi Tahun 2024 untuk 3 peneriman sesuai SK KPA BPS Kab. HST Nomor 63070.013/KPA Tahun 2024 tanggal 1 Maret 2024', 129, 2500000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(80, '2024-04-19', '00098T', '241101301002447', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 171, 2880000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(81, '2024-04-19', '00098T', '241101301002447', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 207, 31500000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(82, '2024-05-02', '00099T', '241101301002685', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pengolahan Sampel Susenas Maret Tahun 2024 Untuk 8 Penerima Sesuai SK KPA BPS Kab. Hulu Sungai Tengah Nomor 63070.010B/KPA Tahun 2024 Tanggal 15 Februari 2024', 188, 18150000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(83, '2024-10-25', '00345T', '241101301007685', 'Pembayaran Belanja Barang Biaya Honorarium Pengolahan Sampel Seruti Triwulan III 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.048F Tahun 2024 Tanggal 13 September 2024', 180, 1800000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(84, '2024-05-02', '00101T', '241101301002684', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pengoolahan Updating Susenas Maret 2024 untuk 8 penerima Sesuai SK KPA BPS Kab. Hulu Sungai Tengah Nomor 6300.010B/KPA Tahun 2024 Tanggal 15 Februari 2024', 186, 2178000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:10'),
(85, '2024-10-18', '00338T', '241101301007582', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pendataan Lapangan Survei Khusus Lembaga Non-Profit yang Melayani Rumah Tangga (SKLNPRT) Triwulan 3 2024 Untuk 2 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.033/KPA Tahun 2024 Tanggal 4 Juni 2024', 14, 650000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(86, '2024-10-18', '00340T', '241101301007583', 'Pembayaran Belanja Barang Biaya Honor Petugas Pendataan Lapangan Survei Khusus Triwulanan Neraca Produksi (SKTNP) Triwulan 3 2024 an. Irni Lily Sesuai SK KPA BPS Kab. HST No. 63070.034/KPA Tahun 2024 Tanggal 4 Juni 2024', 38, 110000, 1, '2024-11-10 21:17:15', '2024-11-10 21:22:13'),
(87, '2024-10-16', '00335T', '241101301007540', 'Pembayaran Belanja Barang Biaya Honorarium Pencacahan Survei Air Bersih Triwulan III Tahun 2024 a.n. Nor Laila Sesuai SK KPA BPS Kab. HST Nomor 63070.050C/KPA Tahun 2024 Tanggal 1 Oktober 2024', 121, 44000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:13'),
(88, '2024-05-03', '00120T', '241101301002782', 'Pembayaran Belanja Barang Biaya Transport Lokal Pelatihan PODES tahun 2024 tanggal 25 April 2024 Untuk 40 Penerima Sesuai Surat Tugas No. 255/63070/VS.330/04/2024 Tanggal 22 April 2024', 223, 8665000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:10'),
(89, '2024-05-07', '00121T', '241101301002864', 'Pembayaran Belanja Barang Biaya Pengadaan Paket Meeting Fullday Pelatihan Petugas Pendataan Survei Potensi Desa 2024 Sesuai Kwitansi Nomor 43/DI/04/2024 Tanggal 26 April 2024', 222, 9600000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:10'),
(90, '2024-11-07', '00373T', '241101301008152', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 387, 1440000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:14'),
(91, '2024-05-14', '00133T', '241101301003078', 'Pembayaran Belanja Barang Biaya Honorarium Instruktur Daerah Pelatihan Petugas Pendataan Potensi Desa (PODES) 2024 Tanggal 25 April 2024 untuk 2 Penerima Sesuai SK KPA BPS HST Nomor 63070.016A/KPA Tahun 2024 Tanggal 18 Januari 2024', 221, 3552000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:10'),
(92, '2024-05-14', '00136T', '241101301003132', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 167, 2775000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:10'),
(93, '2024-05-14', '00136T', '241101301003132', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 205, 8547000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:10'),
(94, '2024-09-17', '00291T', '241101301006733', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 413, 2832000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:13'),
(95, '2024-05-14', '00136T', '241101301003132', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 4, 1000000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:10'),
(96, '2024-05-14', '00136T', '241101301003132', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 372, 850000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:10'),
(97, '2024-05-14', '00136T', '241101301003132', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 374, 120000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:10'),
(98, '2024-06-13', '00168T', '241101305000553', 'Pembayaran Kekurangan Gaji Ketiga Belas Tahun 2024 untuk 1 pegawai/4 jiwa', 325, 133400, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(99, '2024-06-13', '00168T', '241101305000553', 'Pembayaran Kekurangan Gaji Ketiga Belas Tahun 2024 untuk 1 pegawai/4 jiwa', 328, 24, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(100, '2024-06-13', '00168T', '241101305000553', 'Pembayaran Kekurangan Gaji Ketiga Belas Tahun 2024 untuk 1 pegawai/4 jiwa', 331, 13340, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(101, '2024-06-13', '00168T', '241101305000553', 'Pembayaran Kekurangan Gaji Ketiga Belas Tahun 2024 untuk 1 pegawai/4 jiwa', 334, 5336, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(102, '2024-06-03', '00138T', '241101503000810', 'Pembayaran Gaji Ketiga Belas Tahun 2024 Untuk 16 Pegawai.', 337, 1800000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(103, '2024-06-13', '00167T', '241101301004114', 'Pembayaran Kekurangan Gaji Ketiga Belas Tahun 2024 untuk 1 pegawai/3 jiwa', 340, 1100000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(104, '2024-06-13', '00167T', '241101301004114', 'Pembayaran Kekurangan Gaji Ketiga Belas Tahun 2024 untuk 1 pegawai/3 jiwa', 343, 32982, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(105, '2024-06-03', '00139T', '241101506000145', 'Pembayaran Gaji Ketiga Belas Tahun 2024 Untuk 12 Pegawai.', 348, 545000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(106, '2024-06-05', '00143T', '241101301003649', 'Pembayaran Belanja Barang Biaya Honor Petugas Pendataan Potensi Desa (Podes) 2024 Level Desa Bulan Mei 2024 untuk 25 Penerima Sesuai SK KPA BPS HST Nomor 63070.017A/KPA Tahun 2024 Tanggal 26 April 2024', 214, 17238000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(107, '2024-06-13', '00162T', '241101301004053', 'Pembayaran Belanja Barang Biaya Paket Meeting Fullboard Pelatihan Petugas Survei Ekonomi Pertanian (SEP) 2024 Tanggal 29-31 Mei 2024 Sesuai Kwitansi/Invoice Nomor 39/DI/05/2024 Tanggal 31 Mei 2024', 285, 27540000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(108, '2024-06-13', '00169T', '241101301004078', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 279, 344063, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(109, '2024-06-13', '00169T', '241101301004078', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 201, 3765000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(110, '2024-06-13', '00169T', '241101301004078', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 462, 660000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(111, '2024-06-13', '00169T', '241101301004078', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 286, 10125000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(112, '2024-06-20', '00171T', '241101301004211', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Updating Direktori Perusahaan Awal Tahun 2024 Yang Dilaksanakan Tanggal 1-31 Mei 2024 untuk 1 penerima Sesuai SK KPA BPS HST Nomor 63070.017B/KPA Tahun 2024 Tanggal 30 April 2024', 116, 90000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(113, '2024-06-20', '00172T', '241101301004212', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Survei Tahunan Perusahaan Industri Manufaktur 2024 Untuk 1 Penerima Sesuai SK KPA BPS HST Nomor 63070.017C/KPA Tahun 2024', 123, 78000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(114, '2024-06-20', '00173T', '241101301004213', 'Pembayaran Belanja Barang Biaya Honorarium Instruktur Daerah Pelatihan Petugas Survei Ekonomi Pertanian (SEP) 2024 untuk 1 Penerima sesuai SK KPA BPS HST Nomor 63070.022A/KPA Tahun 2024 Tanggal 24 Mei 2024', 278, 3552000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(115, '2024-06-24', '00174T', '241101301004264', 'Pembayaran Belanja Barang Biaya Honorarium Instruktur Daerah Pelatihan Petugas Pendataan SKTDNPENG Tahun 2024 Tanggal 10-12 Juni 2024 Untuk 1 Penerima Sesuai SK KPA BPS HST Nomor 63070.029/KPA Tahun 2024 Tanggal 3 Juni 2024', 27, 2220000, 1, '2024-11-10 21:17:16', '2024-11-10 21:22:11'),
(116, '2024-10-14', '00330T', '241101301007480', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 452, 9950000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:13'),
(117, '2024-06-28', '00178T', '241101305000598', 'Pembayaran Belanja Barang Biaya Honorarium Instruktur Daerah Updating Direktori Usaha/Perusahaan Ekonomi 2024 Tanggal 24-24 Juni 2024 Untuk 1 Penerima Sesuai SK KPA BPS HST Nomor 63070.037/KPA Tahun 2024 Tanggal 21 Juni 2024', 63, 1221000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:11'),
(118, '2024-06-28', '00179T', '241101301004444', 'Pembayaran Belanja Barang Biaya Honor Petugas Listing Survei Volume Penjualan Eceran Beras Semester I 2024 Bulan Mei 2024 Untuk 1 Penerima Sesuai SK KPA BPS HST Nomor 63070.021/KPA Tahun 2024 Tanggal 16 Mei 2024', 78, 228000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:11'),
(119, '2024-11-05', '00359T', '241101301007959', 'Pembayaran Belanja Barang Biaya Honorarium Pencacahan Survei Volume Penjualan eceran Beras (SVPEB) Semester 2 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.021/KPA Tahun 2024 Tanggal 16 Mei 2024', 68, 1500000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:14'),
(120, '2024-07-02', '00181T', '241101301004532', 'Pembayaran Belanja Barang Biaya Honor Instruktur Nasional Pelatihan Petugas Updating Direktori Pasar (UDP) 2024 Tanggal 15 Mei 2024 Untuk 1 Penerima Sesuai SK KPA BPS Nomor 63070.019/KPA Tahun 2024 Tanggal 14 Mei 2024', 450, 555000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:11'),
(121, '2024-07-05', '00196T', '241101301004725', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pencacahan Survei Ekonomi Pertanian (SEP) Tahun 2024 Untuk 18 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.022A/KPA Tahun 2024 Tanggal 24 Mei 2024', 272, 63715400, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:11'),
(122, '2024-07-05', '00197T', '241101301004726', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pemeriksaan Survei Ekonomi Pertanian (SEP) 2024 yang dilaksanakan 1-30 Juni 2024 Untuk 6 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.022A/KPA Tahun 2024 Tanggal 24 Mei 2024', 273, 14370000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:11'),
(123, '2024-10-08', '00318T', '241101301007158', 'Pembayaran Belanja Barang Biaya Perjalanan Dinas Dalam Rangka Rapat Evaluasi Kegiatan Survei Statistik Harga dan KTIP Tahun 2024 Tgl 17-20 September 2024 an. Arif Maulana Sesuai Surat Tugas Nomor B-833/63070/KU.320/2024 Tgl 13 September 2024', 451, 3470000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:13'),
(124, '2024-08-27', '00264T', '241101301006143', 'Penggantian Uang Persediaan KKP untuk keperluan belanja barang', 463, 2160000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(125, '2024-07-12', '00209T', '241101301004922', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pencacahan Surve Konstruksi Tahunan (SKTH) 2024 yang Dilaksanakan Maret-Juni 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.013/KPA Tahun 2024 Tanggal 1 Maret 2024', 130, 1168000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:11'),
(126, '2024-07-12', '00210T', '241101301004923', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pendataan Lapangan Seruti Triwulan II Tahun 2024 Yang Dilaksanakan Bulan Juni 2024 Untuk 2 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.037A/KPA Tahun 2024 Tanggal 24 Juni 2024', 470, 1820000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:11'),
(127, '2024-07-12', '00211T', '241101301004924', 'Pembayaran Belanja Barang Biaya Honorarium Instruktur Daerah Pelatihan Petugas Pengolahan Survei Ekonomi Pertanian 2024 a.n. Eddy Rahmadani Sesuai SK KPA BPS Kab. HST Nomor 63070.040/KPA Tahun 2024 Tanggal 28 Juni 2024', 486, 1554000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:11'),
(128, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 25, 400000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:11'),
(129, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 26, 495000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:11'),
(130, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 419, 575000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(131, '2024-08-06', '00233T', '241101301005639', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 56, 100000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(132, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 469, 240000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(133, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 431, 630000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(134, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 429, 3690000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(135, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 220, 1500000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(136, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 436, 1325000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(137, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 449, 1336000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(138, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 48, 1050000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(139, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 438, 350000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(140, '2024-10-16', '00337T', '241101301007542', 'Pembayaran Belanja Barang Biaya Honorarium Updating Ubinan Palawija Subround III Tahun 2024 Untuk 10 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.047A/KPA Tahun 2024 Tanggal 1 Agustus 2024', 312, 6640000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:13'),
(141, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 379, 200000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(142, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 465, 550000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(143, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 65, 465000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(144, '2024-07-12', '00215T', '241101301004965', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 484, 930000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(145, '2024-07-29', '00220T', '241101301005234', 'Pembayaran Belanja Barang Biaya Transport Lokal Perjalanan Dinas Dalam Rangka Pendataan Podes Kecamatan 2024 Untuk 10 Penerima Sesuai Surat Tugas Nomor 263/63070/VS.330/04/2024 Tanggal 23 April 2024', 445, 1385000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(146, '2024-07-29', '00221T', '241101301005242', 'Pembayaran Belanja Barang Biaya Honorarium Pengolahan Sampel SERUTI Triwulan II Tahun 2024 Untuk 1 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.040A/KPA Tahun 2024 Tanggal 28 Juni 2024', 471, 340000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(147, '2024-07-26', '00222T', '241101301005223', 'Pembayaran Belanja Barang Biaya Transport Lokal Perjalanan Dinas Dalam Rangka Pelatihan Petugas Sakernas Agustus Tahun 2024 Yang dilaksanakan 16-18 Juli Untuk 45 Penerima Sesuai Surat Tugas Nomor 610/63070/VS.220/07/2024 Tanggal 8 Juli 2024', 174, 29070000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(148, '2024-11-07', '00373T', '241101301008152', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 397, 1440000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:14'),
(149, '2024-08-06', '00232T', '241101301005515', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pencacahan Survei Daya Tarik Wisata (VDTW) Tahun 2024 Yang Dilaksanakan Bulan Juli 2024 Untuk 1 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.024/KPA Tahun 2024 Tanggal 31 Mei 2024', 231, 240000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(150, '2024-08-06', '00233T', '241101301005639', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 352, 505300, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(151, '2024-08-06', '00233T', '241101301005639', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 393, 2600000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(152, '2024-08-06', '00233T', '241101301005639', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 468, 119000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(153, '2024-08-06', '00233T', '241101301005639', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 164, 2250000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(154, '2024-08-06', '00233T', '241101301005639', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 473, 225000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(155, '2024-08-06', '00233T', '241101301005639', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 441, 35000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(156, '2024-08-06', '00233T', '241101301005639', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 442, 180000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(157, '2024-08-06', '00233T', '241101301005639', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 485, 1088000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(158, '2024-08-06', '00233T', '241101301005639', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 236, 1595000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(159, '2024-08-06', '00233T', '241101301005639', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 476, 245000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(160, '2024-08-06', '00233T', '241101301005639', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 226, 815000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(161, '2024-08-06', '00233T', '241101301005639', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 227, 285000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(162, '2024-08-07', '00234T', '241101301005646', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pengolahan Survei Ekonomi Pertanian (SEP) 2024 Untuk 4 Orang Penerima Sesuai Sk KPA BS Kab. HST Nomor 63070.040B/KPA Tahun 2024 Tanggal 1 Juli 2024', 265, 13036000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(163, '2024-08-13', '00238T', '241101301005779', 'Pembayaran Belanja Barang Biaya Honorarium Instruktur Daerah Pelatihan Petugas SAKERNAS Agustus 2024 Untuk 2 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.045/KPA Tahun 2024 Tgl 9 Juli 2024', 168, 2553000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(164, '2024-08-12', '00239T', '241101301005749', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Listing Survei IMK Tahunan 2024 Untuk 8 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.037C/KPA Tahun 2024 Tgl 25 Juni 2024', 124, 6384000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(165, '2024-08-15', '00244T', '241101301005874', 'Pembayaran Belanja Barang Honorarium Petugas Pemutakhiran Sakernas Agustus 2024 Untuk 28 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.041/KPA Tahun 2024 Tanggal 3 Juli 2024', 152, 9296000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(166, '2024-08-15', '00245T', '241101301005875', 'Pembayaran Belanja Barang Biaya Honorarium Pemeriksaan dan Pengawasan Pemutakhiran Sakernas 2024 a.n. Budi Asmanto Noviady Sesuai SK KPA BPS Kab. HST Nomor 63070.041/KPA Tahun 2024 Tanggal 3 Juli 2024', 491, 212000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(167, '2024-09-03', '00265T', '241101301006314', 'Pembayaran Belanja BArang Biaya Kukurangan Honor Petugas Updating Direktori Usaha Pertanian Lainnya (DPPDUTL) 2024 an. Abdul Mugni Sesuai SK KPA BPS Kab. HST Nomor 63070.040D/KPA Tahun 2024 Tanggal 30 Juni 2024', 252, 55000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(168, '2024-08-23', '00247T', '241101301006025', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pencacahan Survei Captive Power Tahun 2024 Untuk 1 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.040E/KPA Tahun 2024 Tanggal 30 Juni 2024', 119, 330000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(169, '2024-08-23', '00248T', '241101301006026', 'Pembayaran Belanja Barang Biaya Honorarium Pencacahan Updating Direktori Usaha/Perusahaan Ekonomi Tahun 2024 Untuk 4 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.039/KPA Tahun 2024 Tanggsl 28 Juni 2024', 60, 3800000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(170, '2024-08-23', '00249T', '241101301006027', 'Pembayaran Belanja Barang Biaya Honorarium Pencacahan Survei Pergudangan, Ekspedisi dan Kurir (VPEK) Tahun 2024 Untuk 1 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.044/KPA Tahun 2024 Tanggal 5 Juli 2024', 402, 584000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(171, '2024-08-23', '00251T', '241101301006029', 'Pembayaran Belanja Barang Biaya Honorarium Pencacahan Survei Lembaga Keuangan Koperasi Simpan Pinjam (VSLK-KSP) Tahun 2024 yang Dilaksanakan Bulan Juli 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.025/KPA Tahun 2024 Tanggal 31 Mei 2024', 230, 1080000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(172, '2024-08-27', '00264T', '241101301006143', 'Penggantian Uang Persediaan KKP untuk keperluan belanja barang', 494, 1620000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(173, '2024-08-21', '00256T', '241101301006039', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 122, 55000, 1, '2024-11-10 21:17:17', '2024-11-10 21:22:12'),
(174, '2024-08-21', '00256T', '241101301006039', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 277, 4560000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:12'),
(175, '2024-08-21', '00256T', '241101301006039', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 173, 20250000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:12'),
(176, '2024-11-07', '00373T', '241101301008152', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 466, 2880000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:14'),
(177, '2024-08-26', '00259T', '241101301006090', 'Pembayaran Belanja Barang Biaya Perjalanan Dinas Dalam Rangka Penyelenggaraan Pleno Evaluasi Penyelenggaraan Statistik Sektoral (EPSS) 2024 di Banjarbaru tgl 12-15 Agustus 2024 Untuk 5 Penerima Sesuai ST Nomor 750/63070/TS.160/2024 Tgl 8 Agustus 2024', 490, 7150000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:12'),
(178, '2024-08-27', '00264T', '241101301006143', 'Penggantian Uang Persediaan KKP untuk keperluan belanja barang', 539, 540000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:12'),
(179, '2024-09-03', '00266T', '241101301006277', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pencacahan Survei Hotel dan Jasa Akomodasi Lainnya Tahunan (VHTL) 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.023/KPA Tahun 2024 Tanggal 31 Mei 2024', 234, 880000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:12'),
(180, '2024-08-27', '00267T', '241101301006162', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 218, 24230000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:12'),
(181, '2024-09-04', '00268T', '241101301006288', 'Pembayaran Belanja Barang Biaya Honorarium Pencacahan Survei Usaha Penggalian Usaha Rumah Tangga (UST) Tahun 2024 Untuk 2 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.040F/KPA Tahun 2024 Tanggal 30 Juni 2024', 120, 1650000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:12'),
(182, '2024-09-10', '00277T', '241101301006542', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pendataan Lapangan Updating Direktori Lembaga Non-Proft yang Melayani Rumah Tangga (LNPRT) Tahun 2024 Untuk 2 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.032/KPA Tahun 2024 Tanggal 3 Juni 2024', 17, 500000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:12'),
(183, '2024-09-10', '00278T', '241101301006543', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pendataan Lapangan Survei Khusus Perusahaan Swasta Non-Finansial (SKPS) Tahun 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.032/KPA Tahun 2024 Tanggal 3 Juni 2024', 15, 476000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:12'),
(184, '2024-09-10', '00279T', '241101301006539', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pendataan Lapangan Survei Khusus Lembaga Non-Profit (SKLNP) Tahun 2024 Untuk 2 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.032/KPA Tahun 2024 Tanggal 3 Juni 2024', 415, 511000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:12'),
(185, '2024-09-18', '00288T', '241101301006740', 'Pembayaran Belanja Barang Biaya Paket Meeting Fullboard Pelatihan Petugas Susenas MSBP 2024 dan Seruti Triwulan 3 2024 Tanggal 3-6 September 2024 di Darul Istiqomah Sesuai Kwitansi/Invoice Nomor 56/DI/09/2024 Tanggal 6 September 2024', 534, 37875000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(186, '2024-09-18', '00289T', '241101301006738', 'Pembayaran Belanja Barang Biaya Honor Pemeriksaan dan Pengawasan Pendataan Sakernas Agustus 2024 a.n. Budi Asmanto Noviady Sesuai SK KPA BPS Kab. HST Nomor 63070.042/KPA Tahun 2024 Tanggal 3 Juli 2024', 492, 920000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(187, '2024-09-18', '00290T', '241101301006739', 'Pembayaran Belanja Barang Biaya Honorarium Pendataan Sakernas Agustus 2024 Untuk 28 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.042/KPA Tahun 2024 Tanggal 3 Juli 2024', 154, 37453000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(188, '2024-09-17', '00291T', '241101301006733', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 519, 550000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(189, '2024-09-17', '00291T', '241101301006733', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 446, 9970000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(190, '2024-09-17', '00291T', '241101301006733', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 535, 12510000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(191, '2024-09-23', '00292T', '241101301006801', 'Pembayaran Belanja Barang Biaya Honorarium Pencacahan Sampel Industri Mikro Kecil (IMK) Tahunan 2024 Untuk 8 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.037C/KPA Tahun 2024 Tanggal 25 Juni 2024', 125, 7975000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(192, '2024-09-25', '00296T', '241101301006828', 'Pembayaran Belanja Barang Biaya Honorarium Pemutakhiran Susenas MSBP dan Seruti Tw 3 Tahun 2024 Yang Dilaksanakan Tanggal 11-15 September 2024 Untuk 15 Penerima Sesuai SK KPA BPS Kab. HST Nomor 63070.048A/KPA Tahun 2024 Tanggal 6 September 2024', 178, 2490000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(193, '2024-09-30', '00301T', '241101301006909', 'Pembayaran Belanja Barang Biaya Honor Instruktur Nasional Pelatihan Petugas Survei Sosial Ekonomi Nasional (Susenas) MSBP dan Seruti Tw 3 2024 A.n. Nugrahayu Suryaningrum Sesuai SK KPA BPS Kab. HST No.63070.048B/KPA Tahun 2024 Tanggal 30 Agustus 2024', 532, 2997000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(194, '2024-10-08', '00310T', '241101301007145', 'Pembayaran Belanja Barang Biaya Honor Petugas Pendataan Lapangan Survei Khusus Studi Penyusunan Perubahan Inventori (SKSPPI) 2024 Untuk 2 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.032/KPA Tahun 2024 Tanggal 3 Juni 2024', 16, 1125000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(195, '2024-10-08', '00311T', '241101301007162', 'Pembayaran Belanja Barang Biaya Honor Petugas Pendataan Lapangan Survei Khusus Input Pemerintah (SKSIP) 2024 Untuk 2 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.032/KPA Tahun 2024 Tanggal 3 Juni 2024', 416, 110000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(196, '2024-10-08', '00312T', '241101301007163', 'Pembayaran Belanja Barang Biaya Honor Petugas Pendataan Lapangan Survei In-Depth Study System of Environmental Accounting (SEEA) 2024 an. Irni Lily Sesuai SK KPA BPS Kab. HST No. 63070.031/KPA Tahun 2024 Tanggal 3 Juni 2024', 421, 300000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(197, '2024-11-07', '00373T', '241101301008152', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 540, 5554000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:14'),
(198, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 541, 2740000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(199, '2024-10-30', '00350T', '241101301007837', 'Penggantian Uang Persediaan KKP untuk keperluan belanja barang', 323, 1394000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13');
INSERT INTO `realisasi_anggarans` (`id`, `tanggal_sp2d`, `nomor_spp`, `nomor_sp2d`, `uraian`, `coa_id`, `nilai`, `dipa_id`, `created_at`, `updated_at`) VALUES
(200, '2024-10-10', '00327T', '241101301007294', 'Pembayaran Belanja Barang Biaya Honorarium Pendataan Lapangan Susenas MSBP Tahun 2024 Untuk 15 Penerima Sesuai SK BPS Kab. HST No. 63070.048D/KPA Tahun 2024 Tanggal 6 September 2024', 183, 18000000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(201, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 482, 884000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(202, '2024-10-14', '00330T', '241101301007480', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 536, 187000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(203, '2024-10-14', '00330T', '241101301007480', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 537, 300000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(204, '2024-10-14', '00330T', '241101301007480', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 405, 1810000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(205, '2024-10-14', '00330T', '241101301007480', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 160, 1605000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(206, '2024-10-18', '00339T', '241101301007584', 'Pembayaran Belanja Barang Biaya Honor Instruktur Daerah Pelatihan Survei IMK Triwulan III Tahun 2024 an. Hasyimur Rusdi Sesuai SK KPA BPS Kab. HST No. 63071.051/KPA Tahun 2024 Tanggal 4 Oktober 2024', 547, 999000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(207, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 500, 2839840, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(208, '2024-10-25', '00342T', '241101301007682', 'Pembayaran Belanja Barang Biaya Honorarium  Petugas Pengolahan Sampel IMK Tahunan 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.048F/KPA Tahun 2024 Tanggal 13 September 2024', 493, 1595000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(209, '2024-10-25', '00343T', '241101301007683', 'Pembayaran Belanja Barang Biaya Honorarium Pengolahan Updating Susenas MSBP 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.048F Tahun 2024 Tanggal 13 September 2024', 182, 495000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(210, '2024-10-25', '00344T', '241101301007684', 'Pembayaran Belanja Barang Biaya Honorarium Pengolahan Sampel Susenas MSBP 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.048F Tahun 2024 Tanggal 13 September 2024', 184, 4125000, 1, '2024-11-10 21:17:18', '2024-11-10 21:22:13'),
(211, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 545, 552000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:13'),
(212, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 546, 300000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:13'),
(213, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 565, 250000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:13'),
(214, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 531, 1250000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:13'),
(215, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 566, 250000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:13'),
(216, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 571, 200000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:13'),
(217, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 576, 8202000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:13'),
(218, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 35, 220000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:13'),
(219, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 556, 405000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:13'),
(220, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 548, 570000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:13'),
(221, '2024-10-29', '00347T', '241101301007779', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 533, 400000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:13'),
(222, '2024-11-05', '00360T', '241101301007960', 'Pembayaran Belanja Barang Biaya Honorarium Listing Survei E-Commerce 2024 Untuk 3 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.050A/KPA Tahun 2024 Tanggal 30 September 2024', 549, 1596000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:14'),
(223, '2024-11-05', '00361T', '241101301007979', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pendataan Lapangan Survei Khusus Neraca Produksi (SKNP) 2024 Untuk 5 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.014/KPA Tahun 2024 Tanggal 4 Maret 2024', 420, 2760000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:14'),
(224, '2024-11-05', '00362T', '241101301007980', 'Pembayaran Belanja Barang Biaya Honorarium Petugas Pendataan Lapangan Survei Khusus Sektor Jasa (SKSJ) 2024 Untuk 4 Penerima Sesuai SK KPA BPS Kab. HST No. 63070.014A/KPA Tahun 2024 Tanggal 4 Maret 2024', 37, 480000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:14'),
(225, '2024-11-07', '00373T', '241101301008152', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 480, 10562000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:14'),
(226, '2024-11-07', '00373T', '241101301008152', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 18, 220000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:14'),
(227, '2024-11-07', '00373T', '241101301008152', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 196, 1495000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:14'),
(228, '2024-11-07', '00373T', '241101301008152', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 573, 330000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:14'),
(229, '2024-11-07', '00373T', '241101301008152', 'Penggantian Uang Persediaan Rupiah Murni Untuk Keperluan Belanja Barang', 574, 220000, 1, '2024-11-10 21:17:19', '2024-11-10 21:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('KAHYm1xOLOZYfi5OkdNUIJ60VwWuM2BTIVSxrkJP', 1, '172.18.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiNEpLdWNGVXZ6eGRuZkVsRFVzdTZzRWtUZVk5WTlnRFNYV1A4RHZadyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly9zaW1wZWRlLnRlc3QvYXBwL3Jlc291cmNlcy9ob25vci1rZWdpYXRhbnMvNy9lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3MzEyNzU2MzE7fXM6NDoieWVhciI7aToyMDI0O3M6NDoicm9sZSI7czoxMToia29vcmRpbmF0b3IiO30=', 1731280111);

-- --------------------------------------------------------

--
-- Table structure for table `spesifikasi_kerangka_acuans`
--

CREATE TABLE `spesifikasi_kerangka_acuans` (
  `id` bigint UNSIGNED NOT NULL,
  `rincian` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume` int UNSIGNED DEFAULT NULL,
  `satuan` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_satuan` mediumint UNSIGNED DEFAULT NULL,
  `total_harga` mediumint UNSIGNED DEFAULT NULL,
  `spesifikasi` text COLLATE utf8mb4_unicode_ci,
  `kerangka_acuan_id` mediumint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spesifikasi_kerangka_acuans`
--

INSERT INTO `spesifikasi_kerangka_acuans` (`id`, `rincian`, `volume`, `satuan`, `harga_satuan`, `total_harga`, `spesifikasi`, `kerangka_acuan_id`, `created_at`, `updated_at`) VALUES
(8, 'Honor', 2, 'Dok', 50000, 100000, '1. Spek\r\n2. Spek\r\n3.Spek', 7, '2024-11-02 17:04:57', '2024-11-11 06:47:50'),
(9, 'Kertas HVS A4', 1, 'Rim', 75000, 75000, '1. 70 gsm', 8, '2024-11-03 17:57:50', '2024-11-03 18:02:37'),
(10, 'AAA', 2, 'buah', 100000, 200000, 'ass', 8, '2024-11-06 06:25:11', '2024-11-06 06:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `tata_naskahs`
--

CREATE TABLE `tata_naskahs` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tata_naskahs`
--

INSERT INTO `tata_naskahs` (`id`, `nomor`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'Perka BPS No 1 Tahun 2023', '2023-01-02', '2024-09-11 05:57:51', '2024-09-11 05:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `nama`, `jenis`, `file`, `created_at`, `updated_at`) VALUES
(1, 'Template Import Kode Arsip', 'import', 'HMrafy1OQUdCv20aF7zFgb12BU7mkpCMk5yH4IUE.xlsx', '2024-08-16 11:04:17', '2024-08-16 11:04:17'),
(2, 'Template Import Mitra', 'import', 'vs4vjnKmcr8CPUrONoj44wQbI1ntrEeSwLJvsDRD.xlsx', '2024-08-16 15:32:32', '2024-08-16 15:34:15'),
(3, 'Template Kerangka Acuan Kerja', 'kak', 'ReAdPXzRYWqgpho3W0mX4U3rxg3UfZ3F4MmKlxsP.docx', '2024-09-02 15:05:11', '2024-09-05 09:13:09'),
(4, 'Template SPJ', 'spj', 'd2z8X186YFymCM29dPa84LH7rTrqljrmfhmyc7C4.docx', '2024-09-08 08:13:31', '2024-09-08 09:41:00'),
(5, 'Template SK Petugas', 'sk', 'JmHXF4rvAMCnZQg6zx8jjfvZAygCsh0hpZcRcSJd.docx', '2024-10-19 08:47:00', '2024-10-19 08:47:00'),
(6, 'Template Surat Tugas', 'st', '6ALNH1DPbuAbXP3t3muIDuCOQ7Wjqd1WTR9zqXlS.docx', '2024-10-19 08:47:26', '2024-10-19 08:47:26'),
(7, 'Template Surat Tugas dengan Lampiran', 'st', 'uYxj7Ir0cAiOBnrQ9EPEi5fqHuStnbVSHOhFijjl.docx', '2024-10-19 08:47:48', '2024-10-19 08:47:48'),
(8, 'Kontrak Bulanan Mitra', 'kontrak', 'NMkRjA9CIjEGH6Otv1VdnDL1dt2tQFY4dXm0W8Sg.docx', '2024-10-28 20:24:49', '2024-10-28 20:24:49'),
(9, 'BAST Kontrak Bulanan Mitra', 'bast', 'm3yoHzM7gYlvy2F6KDKSlFtyeYNe36eqKLh8FoYU.docx', '2024-10-28 21:31:58', '2024-10-28 21:31:58'),
(10, 'Template Import Master Persediaan', 'import', 'zUCmuLwHj8P0d50lunRAYlQGESuUTwaECHs7hvEx.xlsx', '2024-11-03 10:55:29', '2024-11-03 10:55:29'),
(11, 'Template BAST Barang Persediaan', 'bastp', '8XlIOq9mjiZWYRhQE22KUkPKRDLzZDOdqtjoJiyy.docx', '2024-11-03 16:27:42', '2024-11-03 16:27:42'),
(12, 'Template Bon Persediaan', 'bon', 'kA4gjL7ih9kVU5CNpew9noR35RJpPuPq8rgPvZ3B.docx', '2024-11-03 16:28:07', '2024-11-03 16:28:07');

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerjas`
--

CREATE TABLE `unit_kerjas` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_kerjas`
--

INSERT INTO `unit_kerjas` (`id`, `kode`, `unit`, `created_at`, `updated_at`) VALUES
(1, '63071', 'Subbagian Umum', '2024-08-04 00:30:27', '2024-08-05 05:33:21'),
(2, '63070', 'Fungsi Statistik Distribusi', '2024-08-05 04:32:01', '2024-08-05 05:32:42'),
(3, '63070', 'Fungsi Statistik Produksi', '2024-08-05 04:32:57', '2024-08-05 04:32:57'),
(4, '63070', 'Fungsi Statistik Sosial', '2024-08-05 04:33:34', '2024-08-05 04:33:34'),
(5, '63070', 'Fungsi IPDS', '2024-08-05 05:32:24', '2024-08-05 05:32:24'),
(6, '63070', 'Fungsi Nerwilis', '2024-08-05 05:33:04', '2024-09-04 16:29:33'),
(7, '63070', 'BPS Kabupaten', '2024-08-06 06:29:50', '2024-08-06 06:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip_lama` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rekening` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `avatar`, `nip`, `nip_lama`, `rekening`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'f5RoXyURRoAcOwBQKkCpIoET5Y1Sn5ldWG3HcDLX.jpg', '198704292010031001', '340053819', NULL, 'Muhlis Abdi, S.Si', 'muhlis.abdi', NULL, '$2y$12$gmHWjyIpF6ey/Kkf80aOheCoYmyvVFqkSMt7Bl.UEk51IczhmKu.i', NULL, '2024-08-04 00:28:05', '2024-10-26 23:23:41'),
(3, 'cUdANsnvCZVH9UfktosWdLRTC98deZ0sLaMQjOf3.jpg', '197104292006041013', NULL, NULL, 'Fakhriansyah', 'fakhriansyah', NULL, '$2y$12$AuysXGQrbew.8tOu0BQm6OGC81GuPn.pKIskgkx4KzyEbs4a9dBam', NULL, '2024-08-04 00:28:05', '2024-10-24 10:59:35'),
(4, 'fLBOCRmBHdUIzQVRTBcKxH9vkrpAhENPCBHJidsR.jpg', '199207302014121001', NULL, NULL, 'Luthfi Rachman, SST', 'luthfi.rachman', NULL, '$2y$12$NKni4MjJefk5/XW6QatDoezuBPRyNh7Hxnq4xjcHqk1SsUCZG91K.', NULL, '2024-08-04 00:28:05', '2024-10-24 10:59:08'),
(5, 'FmsT932nJ3Ec25ZjjCOgLbN3mIt4AFu2oSGAl2Rs.jpg', '199407222017012002', NULL, 'dsd', 'Nugrahayu Suryaningrum, SST', 'nugrahayu.suryaningrum', NULL, '$2y$12$SBqyPHSiMRyOuuhJ9D5.EOz6NZRyN1/1BMeypfnDZjkKDhUeuWzga', NULL, '2024-08-04 00:28:05', '2024-11-10 09:34:10'),
(6, 'gkerKwLKdLw20Zz8NC0rsBn4jsJHaNppEsxQzRMD.jpg', '199104012014101001', NULL, NULL, 'Khairur Rahimin Ramadhani, SST', 'khairur.rahimin', NULL, '$2y$12$CO0Wlh8oRg92YKkr5TK/DuhSKACTmA1IMoU.VCaAlWi.QVDyXDnGy', NULL, '2024-08-04 00:28:05', '2024-10-24 10:46:35'),
(7, 'WGWUkkrWvYUFfiVKicsgdkfNxs5G0Y3WtfFLQraS.jpg', '196807122002122003', NULL, NULL, 'Ainun Faridah', 'ainun.faridah', NULL, '$2y$12$0hyWZmJfNWeRPkqwDigCTOvBNghfiblPzPh1.Y7t20Ozb9aExpSv.', NULL, '2024-08-04 00:28:05', '2024-10-24 10:46:14'),
(8, 'dxZG14X10bhNNZB0LgPotZYEgSDJ0DrgS0EaxIvf.jpg', '199501012018022001', NULL, NULL, 'Annisa Sorayya, SST', 'annisa.sorayya', NULL, '$2y$12$bDRU9dmEdvm08pNqseDL9eBd2WGe9cLzz.3tlzjzkuXhuIOIrfMNS', NULL, '2024-08-04 00:28:05', '2024-10-24 10:45:52'),
(9, 'itGkfd1EcwX9M5RGRGKvqMOuBpMQO3Oe51sWEH62.jpg', '199408202017011001', NULL, NULL, 'Arif Maulana, SST', 'arif.maulana', NULL, '$2y$12$cuS3CI/Jo7RC9KY9YNCJJ..rFkgITIInbox6NSFyagIsTTYcOmm6O', NULL, '2024-08-04 00:28:05', '2024-10-24 10:45:24'),
(10, 'TkiiJqq7hdph1LtbjJkWgqb1iimhVsJ2GnPKTnmd.jpg', '199611282019011002', NULL, NULL, 'Surya Himawan Saputra, S.Tr.Stat.', 'saputra.surya', NULL, '$2y$12$IGHC78tPb50QeZRWUxU5o.ZLlIB3F2eCIuLBBx4xWppsrpKUJlD3C', NULL, '2024-08-04 00:28:05', '2024-10-24 10:45:01'),
(11, 'qShe4z5REU2fSLXdHP03WEL7xwL4CY58776xPR7S.jpg', '199004242013111001', NULL, NULL, 'Eddy Rahmadani, SST', 'eddyr', NULL, '$2y$12$bikTJSsVO5u3r342QSvBYuSBc2ydfR2UYtIzpsYVrfjnzYl2zFhj2', NULL, '2024-08-04 00:28:05', '2024-10-24 10:38:22'),
(12, 'UOcswua0XMRFqbfdZBhymwlUojjJEqx2WHnrPleH.jpg', '199301222014102001', NULL, NULL, 'Dian Margahayu, SST', 'dmargahayu', NULL, '$2y$12$M.UyslHrMia9BJfQEQTSyeOuPfrnNft4BY/5qp9hkySfWhkzR0ryO', NULL, '2024-08-04 00:28:05', '2024-10-24 10:36:32'),
(13, 'MC2VwbVWhzZPvPAQtXwtdFi6v6B4UyDm4ozD7Aak.jpg', '199502252017011001', NULL, NULL, 'Mochamad Qois Bimantara, SST', 'qois.bimantara', NULL, '$2y$12$Lv0hQUYUET/tduri3.U9TOOQybmM0djzpWxjwmRDUindy67gswaii', NULL, '2024-08-04 00:28:05', '2024-10-24 10:36:05'),
(14, 'SjjLvNsxPVqav4Aene16YUFJvICK85hgVCQtbhlZ.jpg', '199407292019032001', NULL, NULL, 'Wiwin Yuli Widiawati, S.Stat.', 'wiwinyuliwidiawati', NULL, '$2y$12$6C9xSAisg91ZDkeL6P9jHOwOL1hhbmcpowT.yXghQDL3IQkyh1ijO', NULL, '2024-08-04 00:28:05', '2024-10-24 10:30:57'),
(15, '1fcldCtGMUPgzecgt3f3tPJvu2ZFRn8VCDuOVTYS.jpg', '198405092007101003', NULL, NULL, 'Royani Andrianto', 'royani.andrianto', NULL, '$2y$12$mnYzpN.a2GfZrWWR6ojcDOnQxRd/6SLExdkGkETQFqL7ctGIdiBEC', NULL, '2024-08-04 00:28:05', '2024-10-24 10:30:39'),
(16, 'QvkI9b06JkAPbtDMGkBIGHLieCv8hRARQQ28RO4m.jpg', '198109222009012006', NULL, NULL, 'Ruspia Fahrinawati', 'ruspia.fahrinawati', NULL, '$2y$12$lkzOGqRsJ9Clwf5hFtOcsuij72kuPkJgEayQxgG.zKJJqx1wqOXCG', NULL, '2024-08-04 00:28:05', '2024-10-24 10:29:41'),
(17, 'kR3lzUUY9en48tmd6jZ9N2SD9zlWBF6KpCLBWjZM.jpg', '197809162009111001', NULL, NULL, 'Zainal Abidin', 'z.abidin', NULL, '$2y$12$IQ1R/SdNQ3EgRnLu2W9jz.Exkuprg1XmMbbPe8EztUP37jSbwl16O', NULL, '2024-08-04 00:28:05', '2024-10-24 10:29:22'),
(18, '6QbQ9EGq9gL3oOs1Prlkw7u3ApZDgKWvd0ZPm3Ec.jpg', '198602022005022001', NULL, NULL, 'Fahlina', 'fahlina', NULL, '$2y$12$AdtSsTEMgw5X6V3Df2qNZOo4PbOTOGFM5OMhrvAEOZk4B2scUHH82', NULL, '2024-08-04 00:28:05', '2024-10-24 10:28:51'),
(19, 'DhlDKgl35hyAJH2pEEzAhwi8myHCIKp9BY7qHKAO.jpg', '198008252007101001', NULL, NULL, 'Ikhwan Rifanie', 'ikhwane.rifanie', NULL, '$2y$12$GN73R7NSZ/9YlsOB4kTx5elOo.mYO6hgA8EYjtG6YZUS0uYDbtBCe', NULL, '2024-08-04 00:28:05', '2024-10-24 10:28:18'),
(20, 'awWqeMILvgm7RKog22E8GgnfyqHcS6NmkpVjoO0R.jpg', '197103082006042029', NULL, NULL, 'Raudatul Jannah', 'raudatul.jannah', NULL, '$2y$12$DVytGhHZ/MoO6Sy5quWubeOyobmE81ZGnrmkTFTNSTR0VGjorjswK', NULL, '2024-08-04 00:28:05', '2024-10-24 10:27:00'),
(21, 'gJmBSwWq7PEe8FkHcdUmHQu1j1j0FCkfdErJ9Pkz.jpg', '198512262011011008', NULL, NULL, 'Fauzan Rahman S.Si', 'fauzan.rahman', NULL, '$2y$12$atdDK9FFQHtQi7M.2Aksq..sVkIxO1tJ5E/Nd1NguiEmY3nCVMrFG', NULL, '2024-08-04 00:28:05', '2024-10-24 10:24:00'),
(22, 'umDbfczzyTQ3WF1fLUhveA6BX0ykTsgcrTauK1Hg.jpg', '197912252002121002', NULL, NULL, 'Deddy Winarno SST.M.Si', 'dediwinarno', NULL, '$2y$12$dodKkkfAhVh2LEetI7gHuODtB0E52O3xpVUP3idtgVvb3.80XaQvG', NULL, '2024-08-04 00:28:05', '2024-10-24 10:21:52'),
(23, 'Z8gkqFuKyQejqlLAkwtL4xmzKpSzP5htwLCQOX3z.jpg', '197602102006042034', NULL, NULL, 'Endriyati Rahmi, S.Pi', 'endriyati.rahmi', NULL, '$2y$12$yCkyc28mxyHJQDHIY7dyzOqSB9/ccKuKCWb73Apvt50/qBx97ZZwu', NULL, '2024-08-04 00:28:05', '2024-10-24 10:21:25'),
(24, '2ShemzHUdQoZaVZaNwfK433GYWMs8Eh9wtKgHuiB.jpg', '200002192023022003', NULL, NULL, 'Fina Fauziyah, S.Tr.Stat', 'fina.fauziyah', NULL, '$2y$12$pMpDbQA2XtZTtjFKCTZi1.2cnK3zB7K86v0RLZ6iRTgI7GffZKhCq', NULL, '2024-08-04 00:28:05', '2024-10-24 10:14:14'),
(25, 'IoqjSg9cTRhCnifzk6fy8smXg9UW86DoVqBjukee.jpg', '200005052023021003', NULL, NULL, 'Hasyimur Rusdi, S.Tr.Stat', 'hasyimur.rusdi', NULL, '$2y$12$BxIAox89wOnM.BGhsOi19.QqznL7avexnSSHd4VXAe5WF/jq5q1fS', NULL, '2024-08-04 00:28:05', '2024-10-24 10:13:54'),
(26, 'bKgAK7P0HM5l2VbRubcAJJDdpNff2dcFghCrrVZX.jpg', '200110132023101002', NULL, NULL, 'Muhammad Rafie Ananda S.Tr.Stat.', 'rafie.ananda', NULL, '$2y$12$dAebBF62JahEiSjOJqMGfeYUzAmLLwJ6DkaR29FbLPwImUNO/5lka', NULL, '2024-08-04 00:28:05', '2024-10-24 07:41:35'),
(27, 'G99ElrTEgEDRG4blE3m1xxMmFcfB0VVeLio0L3H6.jpg', '200006142023101001', NULL, NULL, 'Ilman Maulana, S.Tr.Stat', 'ilman.maulana', NULL, '$2y$12$5.QJfnVdovS3oRF6PzVmdO2CAL6mGNKF.OA9MG3wSBH1.ZIKZuoha', NULL, '2024-08-04 00:28:05', '2024-10-24 07:41:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_events`
--
ALTER TABLE `action_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_events_actionable_type_actionable_id_index` (`actionable_type`,`actionable_id`),
  ADD KEY `action_events_target_type_target_id_index` (`target_type`,`target_id`),
  ADD KEY `action_events_batch_id_model_type_model_id_index` (`batch_id`,`model_type`,`model_id`),
  ADD KEY `action_events_user_id_index` (`user_id`);

--
-- Indexes for table `anggaran_kerangka_acuans`
--
ALTER TABLE `anggaran_kerangka_acuans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arsip_dokumens`
--
ALTER TABLE `arsip_dokumens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_persediaans`
--
ALTER TABLE `barang_persediaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bast_mitras`
--
ALTER TABLE `bast_mitras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `daftar_honor_mitras`
--
ALTER TABLE `daftar_honor_mitras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_honor_pegawais`
--
ALTER TABLE `daftar_honor_pegawais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_kontrak_mitras`
--
ALTER TABLE `daftar_kontrak_mitras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pegawais`
--
ALTER TABLE `data_pegawais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `derajat_naskahs`
--
ALTER TABLE `derajat_naskahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dipas`
--
ALTER TABLE `dipas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dipas_tahun_unique` (`tahun`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `harga_satuans`
--
ALTER TABLE `harga_satuans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `honor_kegiatans`
--
ALTER TABLE `honor_kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `izin_keluars`
--
ALTER TABLE `izin_keluars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_kontraks`
--
ALTER TABLE `jenis_kontraks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_naskahs`
--
ALTER TABLE `jenis_naskahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamus_anggarans`
--
ALTER TABLE `kamus_anggarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kepka_mitras`
--
ALTER TABLE `kepka_mitras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kerangka_acuans`
--
ALTER TABLE `kerangka_acuans`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `kerangka_acuans` ADD FULLTEXT KEY `rincian` (`rincian`);

--
-- Indexes for table `kode_arsips`
--
ALTER TABLE `kode_arsips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kode_naskahs`
--
ALTER TABLE `kode_naskahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontrak_mitras`
--
ALTER TABLE `kontrak_mitras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_persediaans`
--
ALTER TABLE `master_persediaans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_persediaans_kode_unique` (`kode`);

--
-- Indexes for table `mata_anggarans`
--
ALTER TABLE `mata_anggarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitras`
--
ALTER TABLE `mitras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `naskah_defaults`
--
ALTER TABLE `naskah_defaults`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `naskah_keluars`
--
ALTER TABLE `naskah_keluars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `naskah_masuks`
--
ALTER TABLE `naskah_masuks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `naskah_masuks_nomor_unique` (`nomor`);

--
-- Indexes for table `nova_field_attachments`
--
ALTER TABLE `nova_field_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nova_field_attachments_attachable_type_attachable_id_index` (`attachable_type`,`attachable_id`),
  ADD KEY `nova_field_attachments_url_index` (`url`);

--
-- Indexes for table `nova_notifications`
--
ALTER TABLE `nova_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nova_notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `nova_pending_field_attachments`
--
ALTER TABLE `nova_pending_field_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nova_pending_field_attachments_draft_id_index` (`draft_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembelian_persediaans`
--
ALTER TABLE `pembelian_persediaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengelolas`
--
ALTER TABLE `pengelolas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaan_persediaans`
--
ALTER TABLE `permintaan_persediaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persediaan_keluars`
--
ALTER TABLE `persediaan_keluars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persediaan_masuks`
--
ALTER TABLE `persediaan_masuks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `realisasi_anggarans`
--
ALTER TABLE `realisasi_anggarans`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `realisasi_anggarans` ADD FULLTEXT KEY `realisasi_anggarans_uraian_fulltext` (`uraian`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `spesifikasi_kerangka_acuans`
--
ALTER TABLE `spesifikasi_kerangka_acuans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tata_naskahs`
--
ALTER TABLE `tata_naskahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_kerjas`
--
ALTER TABLE `unit_kerjas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_events`
--
ALTER TABLE `action_events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=941;

--
-- AUTO_INCREMENT for table `anggaran_kerangka_acuans`
--
ALTER TABLE `anggaran_kerangka_acuans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `arsip_dokumens`
--
ALTER TABLE `arsip_dokumens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `barang_persediaans`
--
ALTER TABLE `barang_persediaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `bast_mitras`
--
ALTER TABLE `bast_mitras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `daftar_honor_mitras`
--
ALTER TABLE `daftar_honor_mitras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `daftar_honor_pegawais`
--
ALTER TABLE `daftar_honor_pegawais`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `daftar_kontrak_mitras`
--
ALTER TABLE `daftar_kontrak_mitras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `data_pegawais`
--
ALTER TABLE `data_pegawais`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `derajat_naskahs`
--
ALTER TABLE `derajat_naskahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dipas`
--
ALTER TABLE `dipas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `harga_satuans`
--
ALTER TABLE `harga_satuans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `honor_kegiatans`
--
ALTER TABLE `honor_kegiatans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `izin_keluars`
--
ALTER TABLE `izin_keluars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenis_kontraks`
--
ALTER TABLE `jenis_kontraks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenis_naskahs`
--
ALTER TABLE `jenis_naskahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `kamus_anggarans`
--
ALTER TABLE `kamus_anggarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=660;

--
-- AUTO_INCREMENT for table `kepka_mitras`
--
ALTER TABLE `kepka_mitras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kerangka_acuans`
--
ALTER TABLE `kerangka_acuans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kode_arsips`
--
ALTER TABLE `kode_arsips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=585;

--
-- AUTO_INCREMENT for table `kode_naskahs`
--
ALTER TABLE `kode_naskahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kontrak_mitras`
--
ALTER TABLE `kontrak_mitras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `master_persediaans`
--
ALTER TABLE `master_persediaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=654;

--
-- AUTO_INCREMENT for table `mata_anggarans`
--
ALTER TABLE `mata_anggarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `mitras`
--
ALTER TABLE `mitras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=668;

--
-- AUTO_INCREMENT for table `naskah_defaults`
--
ALTER TABLE `naskah_defaults`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `naskah_keluars`
--
ALTER TABLE `naskah_keluars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `naskah_masuks`
--
ALTER TABLE `naskah_masuks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nova_field_attachments`
--
ALTER TABLE `nova_field_attachments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nova_pending_field_attachments`
--
ALTER TABLE `nova_pending_field_attachments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelian_persediaans`
--
ALTER TABLE `pembelian_persediaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengelolas`
--
ALTER TABLE `pengelolas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `permintaan_persediaans`
--
ALTER TABLE `permintaan_persediaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `persediaan_keluars`
--
ALTER TABLE `persediaan_keluars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `persediaan_masuks`
--
ALTER TABLE `persediaan_masuks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `realisasi_anggarans`
--
ALTER TABLE `realisasi_anggarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `spesifikasi_kerangka_acuans`
--
ALTER TABLE `spesifikasi_kerangka_acuans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tata_naskahs`
--
ALTER TABLE `tata_naskahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `unit_kerjas`
--
ALTER TABLE `unit_kerjas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
