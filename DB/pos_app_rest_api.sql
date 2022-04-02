-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2022 at 04:54 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_app_rest_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `company_id`, `brand_code`, `brand_name`, `created_at`, `updated_at`) VALUES
(1, 1, '1695', 'Rerum', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(2, 1, '1810', 'Exercitationem', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(3, 1, '1413', 'Cumque', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(4, 1, '1325', 'Ullam', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(5, 1, '1531', 'Mollitia', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(6, 1, '1002', 'Eligendi', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(7, 1, '1380', 'Suscipit', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(8, 1, '1371', 'Et', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(9, 1, '1558', 'Asperiores', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(10, 1, '1542', 'Recusandae', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(11, 2, '1728', 'Quae', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(12, 2, '1012', 'Id', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(13, 2, '1245', 'Vitae', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(14, 2, '1459', 'Aperiam', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(15, 2, '1701', 'Totam', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(16, 2, '1910', 'Est', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(17, 2, '1401', 'Deleniti', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(18, 2, '1896', 'Molestias', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(19, 2, '1353', 'Aut', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(20, 2, '1455', 'Quia', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(21, 3, '1117', 'Sit', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(22, 3, '1233', 'Ut', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(23, 3, '1465', 'Aut', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(24, 3, '1271', 'Doloremque', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(25, 3, '1223', 'Ut', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(26, 3, '1626', 'Fuga', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(27, 3, '1109', 'Hic', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(28, 3, '1293', 'Incidunt', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(29, 3, '1471', 'Qui', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(30, 3, '1338', 'Ipsum', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(31, 4, '1601', 'Molestiae', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(32, 4, '1942', 'Eos', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(33, 4, '1643', 'Vel', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(34, 4, '1438', 'Nobis', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(35, 4, '1071', 'Vitae', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(36, 4, '1558', 'Ut', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(37, 4, '1950', 'Omnis', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(38, 4, '1406', 'Dolor', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(39, 4, '1047', 'Dolorem', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(40, 4, '1490', 'Atque', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(41, 5, '1312', 'Consequatur', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(42, 5, '1002', 'Culpa', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(43, 5, '1230', 'Repellat', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(44, 5, '1145', 'Et', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(45, 5, '1739', 'Quis', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(46, 5, '1133', 'Aut', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(47, 5, '1571', 'Non', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(48, 5, '1814', 'Error', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(49, 5, '1510', 'Odio', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(50, 5, '1541', 'Facilis', '2022-04-01 02:35:09', '2022-04-01 02:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `company_id`, `category_code`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 1, '1280', 'Fugit', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(2, 1, '1516', 'Et', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(3, 1, '3287', 'Saepe', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(4, 1, '2644', 'Fugiat', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(5, 1, '3658', 'Est', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(6, 1, '3325', 'Omnis', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(7, 1, '1055', 'Minus', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(8, 1, '2651', 'Voluptatem', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(9, 1, '2537', 'Eos', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(10, 1, '3571', 'Sed', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(11, 2, '1715', 'Velit', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(12, 2, '1561', 'Sed', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(13, 2, '1711', 'Debitis', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(14, 2, '1855', 'Eos', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(15, 2, '2071', 'Officia', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(16, 2, '2642', 'Et', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(17, 2, '3978', 'Explicabo', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(18, 2, '3712', 'Molestiae', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(19, 2, '3517', 'Ut', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(20, 2, '3260', 'Vel', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(21, 3, '1170', 'Est', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(22, 3, '2925', 'Sint', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(23, 3, '2151', 'Vero', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(24, 3, '2990', 'Aut', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(25, 3, '3189', 'Omnis', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(26, 3, '1965', 'Totam', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(27, 3, '2074', 'Officiis', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(28, 3, '1246', 'Cupiditate', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(29, 3, '3567', 'Officiis', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(30, 3, '3577', 'Est', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(31, 4, '1911', 'In', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(32, 4, '2517', 'Qui', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(33, 4, '1689', 'Aut', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(34, 4, '1893', 'Qui', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(35, 4, '1586', 'Sit', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(36, 4, '1793', 'Recusandae', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(37, 4, '1036', 'Aperiam', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(38, 4, '1812', 'Sed', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(39, 4, '3614', 'Hic', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(40, 4, '1471', 'Impedit', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(41, 5, '2874', 'Ad', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(42, 5, '2780', 'Et', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(43, 5, '3129', 'Tenetur', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(44, 5, '3251', 'Quisquam', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(45, 5, '1566', 'Quo', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(46, 5, '3995', 'Consequuntur', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(47, 5, '1330', 'Ratione', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(48, 5, '2389', 'Dolores', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(49, 5, '2930', 'Enim', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(50, 5, '3067', 'Quod', '2022-04-01 02:35:09', '2022-04-01 02:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `company_img`, `company_phone`, `company_address`, `company_description`, `created_at`, `updated_at`) VALUES
(1, 'Oberbrunner Ltd', NULL, '765.221.5930', '8357 Savion Roads\nBodeshire, VT 28313-1789', 'Qui ipsa id soluta.', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(2, 'Jerde-Schmidt', NULL, '1-504-225-6468', '81749 Jaskolski Alley\nDewayneberg, NJ 64654', 'Nostrum sed et dolores et ratione veritatis.', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(3, 'Denesik-Fadel', NULL, '283.444.2034', '12804 Tabitha Ports\nEast Tod, WY 18709-4222', 'Et tempora molestiae voluptas ut.', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(4, 'McDermott, Bernhard and Bauch', NULL, '220.364.2762', '7422 Metz Pines Apt. 028\nErniestad, WV 90721-8667', 'Est corrupti ut itaque.', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(5, 'Grady-Schroeder', NULL, '970-958-0996', '19877 Kub Pines Suite 265\nRosalindaborough, KY 03885', 'Quibusdam aut minima enim qui qui.', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(7, 'Company Name', NULL, '000-0000-0000', 'Company Address Street', '', '2022-04-01 02:48:38', '2022-04-01 02:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_11_022129_company_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2022_03_24_052039_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_selling_price` double NOT NULL,
  `product_purchase_price` double NOT NULL,
  `product_discount_price` int(11) NOT NULL,
  `product_final_price` double NOT NULL,
  `product_stock` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `company_id`, `category_id`, `brand_id`, `product_name`, `product_unit`, `product_code`, `product_barcode`, `product_selling_price`, `product_purchase_price`, `product_discount_price`, `product_final_price`, `product_stock`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 5, 42, 44, 'Coca Cola', 'pcs', 'CC-00032', '212314747', 3, 2, 0, 3, 200, 5, 5, '2022-04-01 10:08:52', '2022-04-01 10:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_root` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `username`, `avatar`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `active`, `is_admin`, `is_root`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'kaitlin80', 'http://localhost:8000/storage/avatars/user-1/64Qv1UVInT5faF6CiebKXL4KzEN7S0WPvLIXJ9BL.jpg', 'Miss Delores Bogisich DDS', 'maureen.fritsch@example.com', '2022-04-01 02:35:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 1, 1, 1, '48SPWS3LcL', '2022-04-01 02:35:09', '2022-04-01 18:16:04'),
(2, 2, 'pmoore', NULL, 'Dawn Schroeder I', 'amccullough@example.net', '2022-04-01 02:35:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 1, 1, 1, '1IPYOP6mzZ', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(3, 3, 'dominic.leannon', NULL, 'Ruth Adams II', 'hleffler@example.org', '2022-04-01 02:35:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 1, 1, 1, 'TeJIT4YaYU', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(4, 4, 'rjakubowski', NULL, 'Kari Daugherty', 'laury.dooley@example.net', '2022-04-01 02:35:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 1, 1, 1, 'zGF7ZiWYB9', '2022-04-01 02:35:09', '2022-04-01 02:35:09'),
(5, 5, 'qfritsch', NULL, 'Rayleigh Brandon', 'pfannerstill.louvenia@example.com', '2022-04-01 02:35:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, 1, 1, 1, 'aWKszBTf2R', '2022-04-01 02:35:09', '2022-04-01 06:10:13'),
(7, 7, 'dzulfikar', NULL, 'Dzulfikar Sauki', 'test@email.com', '2022-04-01 02:50:04', '$2y$10$OIf.HFsQewTvhdchGsrd1uihMZGT.Hm9lYwhNba1Sb9a5Suonrc1e', NULL, NULL, 1, 1, 1, NULL, '2022-04-01 02:48:38', '2022-04-01 02:50:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_company_id_foreign` (`company_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_company_id_foreign` (`company_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_company_id_foreign` (`company_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_company_id_foreign` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand`
--
ALTER TABLE `brand`
  ADD CONSTRAINT `brand_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `products_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
