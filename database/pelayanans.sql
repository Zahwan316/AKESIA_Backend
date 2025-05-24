-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2025 at 03:36 PM
-- Server version: 8.0.42-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `KIA`
--

--
-- Dumping data for table `pelayanans`
--

INSERT INTO `pelayanans` (`id`, `jenis_layanan_id`, `nama`, `harga`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Ceria Baby Spa', 110000, 'Setiap Hari  08.00 - 17.00 WIB', '2025-05-13 03:51:17', '2025-05-13 03:51:17', NULL),
(2, 3, 'Periksa Hamil Nyaman', 0, 'Senin - Jum’at (15.00 - 17.00)  & (19.00 - 20.00)', '2025-05-14 00:19:13', '2025-05-16 07:35:09', NULL),
(3, 4, 'Gold Gentlebirth', 1000000, 'Dari awal hingga usai persalinan', '2025-05-15 05:59:12', '2025-05-15 05:59:12', NULL),
(5, 3, 'Periksa Hamil Dhuafa', 50000, 'Senin - Jum’at (15.00 - 17.00)  & (19.00 - 20.00)', '2025-05-16 08:05:13', '2025-05-16 08:05:13', NULL),
(6, 3, 'Periksa Lanjutan', 80000, 'Senin - Jum’at (15.00 - 17.00)  & (19.00 - 20.00)', '2025-05-16 08:29:18', '2025-05-16 08:29:18', NULL),
(7, 3, 'Periksa Hamil Awal', 100000, 'Senin - Jum’at (15.00 - 17.00)  & (19.00 - 20.00)', '2025-05-16 08:29:30', '2025-05-16 08:29:30', NULL),
(9, 1, 'Healthy Massage', 70000, 'Setiap Hari  08.00 - 17.00 WIB', '2025-05-19 02:55:07', '2025-05-19 02:55:07', NULL),
(10, 1, 'Paket Bapil Singgle', 85000, 'Setiap Hari  08.00 - 17.00 WIB', '2025-05-19 02:57:04', '2025-05-19 02:57:04', NULL),
(11, 1, 'Paket Bapil Premium', 150000, 'Setiap Hari  08.00 - 17.00 WIB', '2025-05-19 02:57:18', '2025-05-19 02:57:18', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
