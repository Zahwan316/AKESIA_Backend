-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2025 at 03:38 PM
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
-- Dumping data for table `jenis_layanans`
--

INSERT INTO `jenis_layanans` (`id`, `img_id`, `nama`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Baby Spa dan Message', 'Layanan untuk membuat si kecil nyaman', '2025-05-13 03:47:28', '2025-05-13 03:47:28', NULL),
(2, 2, 'Bidan Bunda', 'Layanan untuk membantu kenyamanan bunda', '2025-05-13 03:47:58', '2025-05-13 03:47:58', NULL),
(3, 3, 'Periksa hamil nyaman', 'Membuat nyaman bunda saat kehamilan', '2025-05-13 03:48:29', '2025-05-13 03:48:29', NULL),
(4, 4, 'Persalinan', 'Membantu persalinan bunda', '2025-05-13 03:48:44', '2025-05-13 03:48:44', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
