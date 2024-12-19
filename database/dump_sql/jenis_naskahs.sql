SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


INSERT INTO `jenis_naskahs` (`id`, `jenis`, `template`, `kode_naskah_id`, `created_at`, `updated_at`) VALUES
(1, 'Peraturan Perundang-undangan', NULL, 1, '2024-08-06 07:10:57', '2024-08-08 02:08:17'),
(2, 'Instruksi', NULL, 1, '2024-08-08 02:07:14', '2024-08-08 02:07:14'),
(3, 'Surat Edaran', 'MpQQXeWRdCv3TzXOYuU79ybIim82gunKGJWQTH1M.pdf', 1, '2024-08-08 02:07:34', '2024-12-19 18:57:17'),
(4, 'SOP Administrasi Pemerintahan', NULL, 1, '2024-08-08 02:08:00', '2024-08-08 02:08:00'),
(5, 'Keputusan', 'Nx1XEcTSwont5Q4dWbpatg3jdOtijf3Lp3NzOtYO.docx', 2, '2024-08-08 02:11:01', '2024-12-19 18:56:55'),
(6, 'Surat Tugas', 'Mq25Q0MzVEoayvzntGEZWC3hF13VlIgxdZnuuz8b.docx', 3, '2024-08-08 02:13:13', '2024-12-19 18:00:11'),
(7, 'Surat Perintah', 'Rp9Yi99RIJoCDgXS4k5iVxioNrXqqceS7n4Za3NC.pdf', 3, '2024-08-08 02:13:28', '2024-12-19 18:55:30'),
(8, 'Nota Dinas', 'YWk0t0CtQ3IS9nns4l8mdaiAGHIQr10R0EtqeySl.pdf', 4, '2024-08-08 02:13:57', '2024-12-19 18:35:58'),
(9, 'Memorandum', 'D6ESsRCvR42xKqmXCWrgPqOUpv8gDWTqNZmLE5YU.pdf', 4, '2024-08-08 02:14:25', '2024-12-19 18:35:51'),
(10, 'Disposisi', NULL, 4, '2024-08-08 02:15:38', '2024-08-08 02:15:38'),
(11, 'Undangan Internal', '9fiw08rV2vG12DSf3ZUxZqhoAk1ZdyoAsFVe1yxW.pdf', 4, '2024-08-08 02:16:00', '2024-12-19 18:35:33'),
(12, 'Surat Dinas Eksternal', 'ov0RawfVnoW5JRJ9TD2BWB6qlVpLPrA21C7aRhXy.docx', 3, '2024-08-08 02:17:14', '2024-12-19 18:00:35'),
(13, 'Surat Perjanjian', 'K9zyF4WS2pWlWLjB3Uc2SDz8bFyVPjRn7azunsYt.pdf', 5, '2024-08-08 02:28:20', '2024-12-19 18:34:09'),
(14, 'Surat Kuasa', 'pPriyPi5vUFZVh4k0XbY6L06iQoBqm5OoZlkAIcm.pdf', 5, '2024-08-08 02:28:39', '2024-12-19 18:30:56'),
(15, 'Berita Acara', 'Mc4HXS9Hl50FgXmrt4CjhvUcqd9ydtPWdUQUEw1f.pdf', 5, '2024-08-08 02:28:57', '2024-12-19 18:30:40'),
(16, 'Surat Keterangan', 'aCbeZWDK6lPqLH9tUXPcDLydh1pjdraVlpsT6llI.pdf', 5, '2024-08-08 02:29:16', '2024-12-19 18:29:50'),
(17, 'Surat Pengantar', 'Lf7V859gllYABglwN7cXzYnXZkims9C0jjYi7uDk.pdf', 5, '2024-08-08 02:29:32', '2024-12-19 18:29:25'),
(18, 'Pengumuman', 'Z5VnUtxVzNBacINWH8aL7fvGn3wTNmWFNDavRmca.pdf', 5, '2024-08-08 02:29:45', '2024-12-19 18:29:16'),
(19, 'Laporan', 's6MU6aOiv4LrpyFN2jcusmBHEBfbhfG4fRDrX2pq.pdf', 5, '2024-08-08 02:29:58', '2024-12-19 18:28:32'),
(20, 'Telaahan Staf', 'FzddHopPJFq6f6ZZjeAUXJ71PeP4rHxqrxwpb4K4.pdf', 5, '2024-08-08 02:30:16', '2024-12-19 18:28:17'),
(21, 'Notula', 'kfLRv9IaTuVNREkxEl2TzFvQS9AysZJfDKZxTX15.pdf', 5, '2024-08-08 02:30:29', '2024-12-19 18:28:09'),
(22, 'Sertifikat', 'aUGgFOnCY2jDcRgRlCptKkz5ZhlBxYGQBHIwR68V.docx', 5, '2024-08-08 02:30:36', '2024-12-19 18:26:23'),
(23, 'Form Permintaan', NULL, 3, '2024-08-10 18:08:56', '2024-09-03 21:09:04'),
(24, 'Bon Persediaan', 'MfJeuAn9iQvin6u4QfVohKb34KS7oxr3PmDexBFF.docx', 4, '2024-11-18 18:54:15', '2024-12-19 18:35:19');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
