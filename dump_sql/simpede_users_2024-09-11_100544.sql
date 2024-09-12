-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: simpede
-- ------------------------------------------------------
-- Server version	10.11.6-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `pangkat` varchar(30) DEFAULT NULL,
  `golongan` varchar(40) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `unit_kerja_id` bigint(20) unsigned DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(2,'Muhlis Abdi, S.Si','198704292010031001@simpede.com',NULL,'$2y$12$gmHWjyIpF6ey/Kkf80aOheCoYmyvVFqkSMt7Bl.UEk51IczhmKu.i','19870429 201003 1 001','Penata Tingkat 1','III/d','Kepala Subbagian Umum',1,'koordinator','f5RoXyURRoAcOwBQKkCpIoET5Y1Sn5ldWG3HcDLX.jpg',NULL,'2024-08-04 00:28:05','2024-09-04 12:15:26'),
(3,'Radina Yasinta Karolina, S.Tr.Stat.','199603302019012001@simpede.com',NULL,'$2y$12$.qO54WaoizOIxN1fRB99z.noqLp/jd6ba4HTfEoKSnwAgfv.kRlhK','19960330 201901 2 001','Penata Muda Tingkat 1','III/b','Statistisi Ahli Pertama',3,'anggota','x851oVFhNXoc5swcK9Auf5CULFzggUhscCimI1Eh.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:04:22'),
(4,'Fakhriansyah','197104292006041013@simpede.com',NULL,'$2y$12$AuysXGQrbew.8tOu0BQm6OGC81GuPn.pKIskgkx4KzyEbs4a9dBam','19710429 200604 1 013','Penata Muda Tingkat 1','III/b','Statistisi Mahir',1,'anggota','cUdANsnvCZVH9UfktosWdLRTC98deZ0sLaMQjOf3.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:07:03'),
(5,'Luthfi Rachman, SST','199207302014121001@simpede.com',NULL,'$2y$12$NKni4MjJefk5/XW6QatDoezuBPRyNh7Hxnq4xjcHqk1SsUCZG91K.','19920730 201412 1 001','Penata','III/c','Statistisi Ahli Muda',4,'koordinator','fLBOCRmBHdUIzQVRTBcKxH9vkrpAhENPCBHJidsR.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:00:53'),
(6,'Nugrahayu Suryaningrum, SST','199407222017012002@simpede.com',NULL,'$2y$12$SBqyPHSiMRyOuuhJ9D5.EOz6NZRyN1/1BMeypfnDZjkKDhUeuWzga','19940722 201701 2 002','Penata Muda Tingkat 1','III/b','Statistisi Ahli Pertama',4,'anggota','FmsT932nJ3Ec25ZjjCOgLbN3mIt4AFu2oSGAl2Rs.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:01:38'),
(7,'Khairur Rahimin Ramadhani, SST','199104012014101001@simpede.com',NULL,'$2y$12$CO0Wlh8oRg92YKkr5TK/DuhSKACTmA1IMoU.VCaAlWi.QVDyXDnGy','19910401 2014 10 1 001','Penata Muda Tingkat 1','III/b','Pelaksana',3,'anggota','gkerKwLKdLw20Zz8NC0rsBn4jsJHaNppEsxQzRMD.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 09:53:30'),
(8,'Ainun Faridah','196807122002122003@simpede.com',NULL,'$2y$12$0hyWZmJfNWeRPkqwDigCTOvBNghfiblPzPh1.Y7t20Ozb9aExpSv.','19680712 200212 2 003','Penata Muda','III/a','Statistisi Mahir',2,'anggota','WGWUkkrWvYUFfiVKicsgdkfNxs5G0Y3WtfFLQraS.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 09:56:24'),
(9,'Annisa Sorayya, SST','199501012018022001@simpede.com',NULL,'$2y$12$bDRU9dmEdvm08pNqseDL9eBd2WGe9cLzz.3tlzjzkuXhuIOIrfMNS','19950101 2018 02 2 001','Penata Muda Tingkat 1','III/b','Statistisi Ahli Pertama',2,'anggota','dxZG14X10bhNNZB0LgPotZYEgSDJ0DrgS0EaxIvf.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:03:27'),
(10,'Arif Maulana, SST','199408202017011001@simpede.com',NULL,'$2y$12$cuS3CI/Jo7RC9KY9YNCJJ..rFkgITIInbox6NSFyagIsTTYcOmm6O','19940820 201701 1 001','Penata Muda Tingkat 1','III/b','Statistisi Ahli Muda',2,'koordinator','itGkfd1EcwX9M5RGRGKvqMOuBpMQO3Oe51sWEH62.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:02:55'),
(11,'Surya Himawan Saputra, S.Tr.Stat.','199611282019011002@simpede.com',NULL,'$2y$12$IGHC78tPb50QeZRWUxU5o.ZLlIB3F2eCIuLBBx4xWppsrpKUJlD3C','19961128 201901 1 002','Penata Muda Tingkat 1','III/b','Statistisi Ahli Pertama',6,'koordinator','TkiiJqq7hdph1LtbjJkWgqb1iimhVsJ2GnPKTnmd.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:05:00'),
(12,'Eddy Rahmadani, SST','199004242013111001@simpede.com',NULL,'$2y$12$bikTJSsVO5u3r342QSvBYuSBc2ydfR2UYtIzpsYVrfjnzYl2zFhj2','19900424 201311 1 001','Penata','III/c','Pranata Komputer Ahli Muda',5,'koordinator','qShe4z5REU2fSLXdHP03WEL7xwL4CY58776xPR7S.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:00:21'),
(13,'Dian Margahayu, SST','199301222014102001@simpede.com',NULL,'$2y$12$M.UyslHrMia9BJfQEQTSyeOuPfrnNft4BY/5qp9hkySfWhkzR0ryO','19930122 201410 2 001','Penata Muda Tingkat 1','III/b','Pelaksana',5,'anggota','UOcswua0XMRFqbfdZBhymwlUojjJEqx2WHnrPleH.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 09:53:59'),
(14,'Mochamad Qois Bimantara, SST','199502252017011001@simpede.com',NULL,'$2y$12$Lv0hQUYUET/tduri3.U9TOOQybmM0djzpWxjwmRDUindy67gswaii','19950225 201701 1 001','Penata Muda','III/a','Statistisi Ahli Pertama',5,'anggota','MC2VwbVWhzZPvPAQtXwtdFi6v6B4UyDm4ozD7Aak.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:03:53'),
(15,'Wiwin Yuli Widiawati, S.Stat.','199407292019032001@simpede.com',NULL,'$2y$12$6C9xSAisg91ZDkeL6P9jHOwOL1hhbmcpowT.yXghQDL3IQkyh1ijO','19940729 201903 2 001','Penata Muda Tingkat 1','III/b','Statistisi Ahli Pertama',6,'anggota','SjjLvNsxPVqav4Aene16YUFJvICK85hgVCQtbhlZ.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:02:10'),
(16,'Royani Andrianto','198405092007101003@simpede.com',NULL,'$2y$12$mnYzpN.a2GfZrWWR6ojcDOnQxRd/6SLExdkGkETQFqL7ctGIdiBEC','19840509 200710 1 003','Pengatur Muda Tingkat 1','II/b','Fungsional Umum',1,'anggota','1fcldCtGMUPgzecgt3f3tPJvu2ZFRn8VCDuOVTYS.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:08:55'),
(17,'Ruspia Fahrinawati','198109222009012006@simpede.com',NULL,'$2y$12$lkzOGqRsJ9Clwf5hFtOcsuij72kuPkJgEayQxgG.zKJJqx1wqOXCG','19810922 200901 2 006','Pengatur','II/c','Fungsional Umum',1,'anggota','QvkI9b06JkAPbtDMGkBIGHLieCv8hRARQQ28RO4m.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:08:27'),
(18,'Zainal Abidin','197809162009111001@simpede.com',NULL,'$2y$12$IQ1R/SdNQ3EgRnLu2W9jz.Exkuprg1XmMbbPe8EztUP37jSbwl16O','19780916 200911 1 001','Pengatur','II/c','Fungsional Umum',3,'anggota','kR3lzUUY9en48tmd6jZ9N2SD9zlWBF6KpCLBWjZM.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:07:49'),
(19,'Fahlina','198602022005022001@simpede.com',NULL,'$2y$12$AdtSsTEMgw5X6V3Df2qNZOo4PbOTOGFM5OMhrvAEOZk4B2scUHH82','19860202 200502 2 001','Penata Muda','III/a','Fungsional Umum',3,'anggota','6QbQ9EGq9gL3oOs1Prlkw7u3ApZDgKWvd0ZPm3Ec.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:09:29'),
(20,'Ikhwan Rifanie','198008252007101001@simpede.com',NULL,'$2y$12$GN73R7NSZ/9YlsOB4kTx5elOo.mYO6hgA8EYjtG6YZUS0uYDbtBCe','19800825 200710 1 001','Penata Muda','III/a','Statistisi Mahir',6,'anggota','DhlDKgl35hyAJH2pEEzAhwi8myHCIKp9BY7qHKAO.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 09:58:49'),
(21,'Raudatul Jannah','197103082006042029@simpede.com',NULL,'$2y$12$DVytGhHZ/MoO6Sy5quWubeOyobmE81ZGnrmkTFTNSTR0VGjorjswK','19710308 200604 2 029','Penata Muda Tingkat 1','III/b','Statistisi Mahir',4,'anggota','awWqeMILvgm7RKog22E8GgnfyqHcS6NmkpVjoO0R.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 09:57:21'),
(22,'Fauzan Rahman S.Si','198512262011011008@simpede.com',NULL,'$2y$12$atdDK9FFQHtQi7M.2Aksq..sVkIxO1tJ5E/Nd1NguiEmY3nCVMrFG','19851226 2011 01 1 008','Penata','III/c','Statistisi Ahli Muda',3,'koordinator','gJmBSwWq7PEe8FkHcdUmHQu1j1j0FCkfdErJ9Pkz.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 09:59:33'),
(23,'Deddy Winarno SST.M.Si','197912252002121002@simpede.com',NULL,'$2y$12$dodKkkfAhVh2LEetI7gHuODtB0E52O3xpVUP3idtgVvb3.80XaQvG','19791225 200212 1 002','Pembina Tingkat 1','IV/b','Kepala',7,'kepala','umDbfczzyTQ3WF1fLUhveA6BX0ykTsgcrTauK1Hg.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 09:52:14'),
(24,'Endriyati Rahmi, S.Pi','197602102006042034@simpede.com',NULL,'$2y$12$yCkyc28mxyHJQDHIY7dyzOqSB9/ccKuKCWb73Apvt50/qBx97ZZwu','19760210 200604 2 034','Penata','III/c','Statistisi Penyelia',2,'anggota','Z8gkqFuKyQejqlLAkwtL4xmzKpSzP5htwLCQOX3z.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 09:58:08'),
(25,'Fina Fauziyah, S.Tr.Stat','200002192023022003@simpede.com',NULL,'$2y$12$pMpDbQA2XtZTtjFKCTZi1.2cnK3zB7K86v0RLZ6iRTgI7GffZKhCq','20000219 202302 2 003','Penata Muda','III/a','Statistisi Ahli Pertama',4,'anggota','2ShemzHUdQoZaVZaNwfK433GYWMs8Eh9wtKgHuiB.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:06:00'),
(26,'Hasyimur Rusdi, S.Tr.Stat','200005052023021003@simpede.com',NULL,'$2y$12$BxIAox89wOnM.BGhsOi19.QqznL7avexnSSHd4VXAe5WF/jq5q1fS','20000505 202302 1 003','Penata Muda','III/a','Pelaksana',3,'anggota','IoqjSg9cTRhCnifzk6fy8smXg9UW86DoVqBjukee.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 10:06:31'),
(27,'Muhammad Rafie Ananda S.Tr.Stat.','200110132023101002@simpede.com',NULL,'$2y$12$dAebBF62JahEiSjOJqMGfeYUzAmLLwJ6DkaR29FbLPwImUNO/5lka','2001101 3202310 1 002','Penata Muda','III/a','Pelaksana',2,'anggota','bKgAK7P0HM5l2VbRubcAJJDdpNff2dcFghCrrVZX.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 09:55:18'),
(28,'Ilman Maulana, S.Tr.Stat','200006142023101001@simpede.com',NULL,'$2y$12$5.QJfnVdovS3oRF6PzVmdO2CAL6mGNKF.OA9MG3wSBH1.ZIKZuoha','20000614 202310 1 001','Penata Muda','III/a','Fungsional Umum',5,'anggota','G99ElrTEgEDRG4blE3m1xxMmFcfB0VVeLio0L3H6.jpg',NULL,'2024-08-04 00:28:05','2024-08-16 09:54:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-11 10:06:00
