SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


INSERT INTO `kode_naskahs` (`id`, `kategori`, `format`, `created_at`, `updated_at`, `tata_naskah_id`) VALUES
(1, 'Naskah Dinas Pengaturan', '<no_urut> TAHUN <tahun>', '2024-08-06 07:10:43', '2024-09-03 21:06:52', 1),
(2, 'Naskah Dinas Penetapan', '<no_urut> TAHUN <tahun>', '2024-08-08 01:58:06', '2024-09-03 21:05:05', 1),
(3, 'Surat Dinas', '<derajat>-<no_urut>/<kode_unit_kerja>/<kode_arsip>/<tahun>', '2024-08-08 02:03:05', '2024-09-03 21:08:00', 1),
(4, 'Memo dan Nota Dinas', '<no_urut>/<kode_unit_kerja>/<kode_arsip>/<tahun>', '2024-08-08 02:04:08', '2024-09-03 21:08:36', 1),
(5, 'Naskah Dinas Khusus', '<no_urut>/<tahun>', '2024-08-08 02:25:52', '2024-09-03 21:04:30', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
