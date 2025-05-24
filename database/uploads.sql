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
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `user_id`, `path`, `created_at`, `updated_at`) VALUES
(1, 3, 'storage/uploads/2A7gRL5V92UnPODaIouD4THBDgsOXrRxH3tc89IA.png', '2025-05-13 03:47:28', '2025-05-13 03:47:28'),
(2, 3, 'storage/uploads/a0aqeSdHAiSaBYmKRjLdDe2dpXi2jGUZv34Q6ckp.png', '2025-05-13 03:47:58', '2025-05-13 03:47:58'),
(3, 3, 'storage/uploads/172CGdAvXb0pahLksH0BSW0QT8spELPcVWGZyF1P.png', '2025-05-13 03:48:29', '2025-05-13 03:48:29'),
(4, 3, 'storage/uploads/nmtLFKuTMdONsyu76llmzHrsKUcBTAklKJJYl9tA.png', '2025-05-13 03:48:44', '2025-05-13 03:48:44'),
(5, 4, 'storage/uploads/zuAfFhAUQzGlbovkglKcJXaYBweUDldImAsPJ7wm.jpg', '2025-05-13 05:18:45', '2025-05-13 05:18:45'),
(6, 4, 'storage/uploads/Plp96zjqJZoHlCvICtknjY9C498ueZQHyge1AZVT.jpg', '2025-05-13 05:19:10', '2025-05-13 05:19:10');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
