-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2025 at 08:20 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bill_jewelry`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart` varchar(500) NOT NULL,
  `discount` int(11) NOT NULL,
  `discount_amount` varchar(100) NOT NULL,
  `tax` int(11) NOT NULL,
  `tax_amount` varchar(100) NOT NULL,
  `gst` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `payment_mode` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gold', 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(2, 'Silver', 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adhar_no` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `opening_balance` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `adhar_no`, `address`, `opening_balance`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Customer 9', 'jayce.hintz@example.net', '+1 (229) 728-4427', '3330206523', '798 Giles Court\nBrakusborough, VT 91662-4534', 0, 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(2, 'Customer 98', 'robb.mann@example.com', '+1-307-628-8056', '8363014404', '9636 Chanel Forest\nPort Christian, NY 90173-0857', 0, 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(3, 'Customer 74', 'westley.considine@example.org', '414.974.1216', '0829333053', '4951 Nicolas Expressway Suite 841\nGorczanyburgh, NM 50705-8995', 0, 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(4, 'Customer 16', 'kemmer.archibald@example.net', '+12792314597', '6781531673', '2031 Morissette Avenue Apt. 433\nCollinsshire, MS 26312', 0, 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(5, 'Customer 81', 'noemi.anderson@example.net', '+1.901.734.6208', '0203482821', '1416 Mills Plaza\nTrantowfort, TN 94206', 0, 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(6, 'Customer 91', 'reinhold58@example.org', '458-629-4035', '1438804356', '65491 Morissette Land\nWest Candido, MA 02340-9070', 0, 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(7, 'Customer 67', 'deron65@example.org', '239.901.5116', '0591692021', '2852 Lew Tunnel Suite 059\nMadysonfurt, AZ 06565', 0, 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(8, 'Customer 44', 'floy.hudson@example.net', '+1.726.884.0296', '4247966951', '55964 Jacobs Divide Suite 150\nUptonhaven, NV 37227', 0, 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(9, 'Customer 34', 'rocky.carroll@example.com', '+1-838-565-5961', '7841411933', '70682 Mina Freeway\nLake Jerrodfort, RI 66300', 0, 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(10, 'Customer 48', 'afton64@example.org', '854.202.3008', '5683045521', '916 Opal Square Apt. 073\nCamilletown, MI 85555-3848', 0, 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image_presets`
--

CREATE TABLE `image_presets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000002_create_jobs_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_28_131149_create_site_settings_table', 1),
(6, '2023_11_28_132524_create_image_presets_table', 1),
(7, '2024_09_13_153211_create_categories_table', 1),
(8, '2024_09_13_153402_create_types_table', 1),
(9, '2024_11_11_112538_create_products_table', 1),
(10, '2024_11_12_093838_create_customers_table', 1),
(11, '2024_11_16_131427_create_unit_table', 1),
(12, '2024_11_17_173827_billing', 1),
(13, '2024_11_27_094333_create_payments_table', 1),
(14, '2025_11_11_073214_create_suppliers_table', 1),
(15, '2025_11_12_090524_create_purities_table', 1),
(16, '2025_12_02_041205_create_supplier_billings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(255) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `purity_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `gross_weight` decimal(10,4) NOT NULL,
  `net_weight` decimal(10,4) NOT NULL,
  `making_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `rate_per_gram` decimal(10,2) NOT NULL DEFAULT 0.00,
  `gst_percent` decimal(5,2) NOT NULL DEFAULT 0.00,
  `stock_qty` decimal(10,4) NOT NULL DEFAULT 1.0000,
  `pstatus` enum('in_stock','sold','returned') NOT NULL DEFAULT 'in_stock',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `type_id`, `name`, `price`, `image`, `purity_id`, `unit_id`, `gross_weight`, `net_weight`, `making_charge`, `rate_per_gram`, `gst_percent`, `stock_qty`, `pstatus`, `status`, `created_at`, `updated_at`) VALUES
(1, 'GOLD-24K-001', 1, 'Pure Gold Bar 24K', '124664.30', '', 1, 2, '10.0000', '10.0000', '0.00', '12343.00', '1.00', '1.0000', 'in_stock', 0, '2025-11-28 00:07:38', '2025-11-27 19:04:50'),
(2, 'GOLD-22K-002', 5, 'Gold Bangle 22K', '96895.36', '', 2, 2, '8.0000', '8.0000', '0.00', '11992.00', '1.00', '1.0000', 'in_stock', 0, '2025-11-28 00:08:38', '2025-11-27 19:06:32'),
(3, 'GOLD-18K-003', 2, 'Gold Ring 18K', '56097.42', '', 3, 2, '6.0000', '6.0000', '0.00', '9257.00', '1.00', '1.0000', 'in_stock', 0, '2025-11-28 00:09:36', '2025-11-27 19:06:48'),
(4, 'GOLD-14K-004', 4, 'Gold Necklace 14K', '87264.00', '', 4, 2, '12.0000', '12.0000', '0.00', '7200.00', '1.00', '1.0000', 'in_stock', 0, '2025-11-28 00:10:42', '2025-11-27 19:07:00'),
(5, 'GOLD-9K-005', 5, 'Gold Bracelet 9K', '23376.45', '', 5, 2, '5.0000', '5.0000', '0.00', '4629.00', '1.00', '1.0000', 'in_stock', 0, '2025-11-28 00:11:48', '2025-11-27 19:07:11'),
(6, 'SILVER-925-006', 19, 'Silver Pendant 925', '2620.95', '', 8, 2, '15.0000', '15.0000', '0.00', '173.00', '1.00', '1.0000', 'in_stock', 0, '2025-11-28 00:13:05', '2025-11-27 19:07:24'),
(7, 'SILVER-958-007', 22, 'Silver Coin 958', '3494.60', '', 7, 2, '20.0000', '20.0000', '0.00', '173.00', '1.00', '1.0000', 'in_stock', 0, '2025-11-28 00:14:10', '2025-11-27 19:07:35'),
(8, 'SILVER-999-008', 12, 'Silver Bar 999', '4418.75', '', 6, 12, '25.0000', '25.0000', '50.00', '173.00', '1.00', '1.0000', 'in_stock', 0, '2025-11-28 00:15:20', '2025-11-27 19:07:48'),
(9, 'SILVER-925-009', 18, 'Silver Earring 925', '554.49', '', 8, 2, '3.0000', '3.0000', '30.00', '173.00', '1.00', '1.0000', 'in_stock', 0, '2025-11-28 00:16:38', '2025-11-27 19:07:59'),
(10, 'SILVER-958-010', 13, 'Silver Ring 958', '739.32', '', 7, 2, '4.0000', '4.0000', '40.00', '173.00', '1.00', '1.0000', 'in_stock', 0, '2025-11-28 00:18:00', '2025-11-27 19:39:06');

-- --------------------------------------------------------

--
-- Table structure for table `purities`
--

CREATE TABLE `purities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purities`
--

INSERT INTO `purities` (`id`, `category_id`, `name`, `status`) VALUES
(1, 1, '24K - (99.9% Pure Gold)', 0),
(2, 1, '22K - (91.6% Gold)', 0),
(3, 1, '18K - (75% Gold)', 0),
(4, 1, '14K - (58.5% Gold)', 0),
(5, 1, '9K  - (37.5% Gold)', 0),
(6, 2, '999 - (Fine Silver 99.9%)', 0),
(7, 2, '958 - (Britannia Silver 95.8%)', 0),
(8, 2, '925 - (Sterling Silver 92.5%)', 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `site_title` varchar(100) NOT NULL,
  `app_name` varchar(100) DEFAULT NULL,
  `support_phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tax` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gst` varchar(255) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_holder_name` varchar(100) DEFAULT NULL,
  `bank_ifsc` varchar(50) DEFAULT NULL,
  `bank_account` varchar(100) DEFAULT NULL,
  `bank_branch` varchar(100) DEFAULT NULL,
  `pan_no` varchar(100) DEFAULT NULL,
  `declaration` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `bank_qr_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `logo`, `favicon`, `site_title`, `app_name`, `support_phone`, `email`, `tax`, `address`, `gst`, `bank_name`, `bank_holder_name`, `bank_ifsc`, `bank_account`, `bank_branch`, `pan_no`, `declaration`, `message`, `bank_qr_code`) VALUES
(1, '', '', 'Demo Site', 'Demo Site', '00-0000-0000', 'info@demo.com', 0, '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gst_no` text DEFAULT NULL,
  `account` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `shop_name`, `phone`, `email`, `address`, `gst_no`, `account`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Smith-Stoltenberg', '1-772-397-1901', 'zschaden@example.net', '64184 Lavon Street\nTrompbury, DE 78670-6211', 'OFTRE1500T6ZS', '834781444434', 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(2, 'Murazik-Durgan', '+1.947.557.0952', 'franecki.sid@example.com', '148 Amiya Trace\nNorth Asiamouth, DE 54690-0077', 'OCJRW7600C3ZQ', '192000835', 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(3, 'Schaefer, Tremblay and Labadie', '(781) 353-3690', 'greenfelder.jordan@example.net', '7787 Ortiz Pass Apt. 304\nAbshiremouth, FL 41284', 'QBOOV3427J5ZG', '553197540072', 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(4, 'Metz-Gerhold', '743-210-1902', 'dbraun@example.com', '618 Herzog Village\nNorth Durward, AK 05565-0965', 'BPDPT7853T4ZY', '228271616143', 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(5, 'Stracke-O\'Connell', '(770) 993-2566', 'rsipes@example.org', '49361 Noemie Summit\nNorth Fidel, AL 53090-3490', 'DRIDQ5984Q7ZL', '83252140566', 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(6, 'Rice LLC', '1-678-603-9753', 'vhayes@example.net', '480 Feil Cliff Apt. 406\nWest Willis, CT 75110-0890', 'OMANJ3918M3ZH', '226899549621', 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(7, 'Bergstrom and Sons', '+1 (660) 862-9824', 'vbergnaum@example.com', '1999 Lura Way\nPort Freddyberg, MS 68895-7649', 'SWDOU7137P0ZQ', '269519560781', 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(8, 'Welch Group', '+1 (872) 654-3987', 'qking@example.com', '38753 O\'Keefe Springs Apt. 383\nNorth Michele, PA 65881-6950', 'EKSDB9100X6ZE', '77841713986027', 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(9, 'Herman, O\'Keefe and Orn', '1-520-481-1278', 'josefina.anderson@example.com', '73166 Aylin Fall Suite 071\nPort Ellenburgh, OH 91544', 'SAHDE3250U4ZD', '738614', 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29'),
(10, 'West, Leuschke and Johnson', '+1 (315) 856-9525', 'blanche.parker@example.com', '95474 Serena Forest\nEast Myrna, NJ 44923', 'FYSLY6731S5ZH', '85564069', 0, '2025-12-03 17:53:29', '2025-12-03 17:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_billings`
--

CREATE TABLE `supplier_billings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` varchar(255) DEFAULT NULL,
  `bill_image` varchar(255) DEFAULT NULL,
  `bill_amount` int(11) NOT NULL DEFAULT 0,
  `paid` int(11) NOT NULL DEFAULT 0,
  `payment_mode` int(11) NOT NULL DEFAULT 0,
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_billings`
--

INSERT INTO `supplier_billings` (`id`, `supplier_id`, `bill_image`, `bill_amount`, `paid`, `payment_mode`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, '1', '', 5000, 1000, 0, NULL, '2025-12-03 19:12:53', '2025-12-03 19:12:53'),
(2, '1', NULL, 0, 2000, 1, 'FULLPAY-1764789260', '2025-12-03 19:14:20', '2025-12-03 19:14:20'),
(3, '1', NULL, 0, 2000, 1, 'FULLPAY-1764789434', '2025-12-03 19:17:14', '2025-12-03 19:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `category_id`, `name`, `status`) VALUES
(1, 1, 'Gold Bar', 0),
(2, 1, 'Gold Ring', 0),
(3, 1, 'Gold Chain', 0),
(4, 1, 'Gold Necklace', 0),
(5, 1, 'Gold Bracelet', 0),
(6, 1, 'Gold Anklet', 0),
(7, 1, 'Gold Earrings', 0),
(8, 1, 'Gold Pendant', 0),
(9, 1, 'Gold Bangles', 0),
(10, 1, 'Gold Nose Pin', 0),
(11, 1, 'Gold Coin', 0),
(12, 2, 'Silver Bar', 0),
(13, 2, 'Silver Ring', 0),
(14, 2, 'Silver Chain', 0),
(15, 2, 'Silver Necklace', 0),
(16, 2, 'Silver Bracelet', 0),
(17, 2, 'Silver Anklet', 0),
(18, 2, 'Silver Earrings', 0),
(19, 2, 'Silver Pendant', 0),
(20, 2, 'Silver Bangles', 0),
(21, 2, 'Silver Toe Ring', 0),
(22, 2, 'Silver Coin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `fname`, `status`) VALUES
(1, 'mg', 'Milligram (mg)', 0),
(2, 'g', 'Gram (g)', 0),
(3, 'kg', 'Kilogram (kg)', 0),
(4, 'tola', 'Tola', 0),
(5, 'carat', 'Carat (ct)', 0),
(6, 'piece', 'Piece (pcs)', 0),
(7, 'set', 'Set', 0),
(8, 'pair', 'Pair', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `top` int(11) NOT NULL DEFAULT 0,
  `about` text DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `phone`, `top`, `about`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@example.com', NULL, '$2y$12$etWyclv5QmSPzCEx8eLpl.IiIUlbD4KqHPVl9zN8weuKVujneGqu.', NULL, NULL, 0, NULL, 'admin', 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `image_presets`
--
ALTER TABLE `image_presets`
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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Indexes for table `purities`
--
ALTER TABLE `purities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_billings`
--
ALTER TABLE `supplier_billings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `types_name_unique` (`name`),
  ADD KEY `types_category_id_foreign` (`category_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
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
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_presets`
--
ALTER TABLE `image_presets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purities`
--
ALTER TABLE `purities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier_billings`
--
ALTER TABLE `supplier_billings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `types`
--
ALTER TABLE `types`
  ADD CONSTRAINT `types_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
