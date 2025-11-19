-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2025 at 01:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bills`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `cart` varchar(1000) NOT NULL,
  `discount` int(11) NOT NULL,
  `discount_amount` varchar(100) NOT NULL,
  `tax` int(11) NOT NULL,
  `tax_amount` varchar(100) NOT NULL,
  `freight_charges` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `payment` int(11) DEFAULT 0,
  `payment_mode` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `customer_id`, `cart`, `discount`, `discount_amount`, `tax`, `tax_amount`, `freight_charges`, `grand_total`, `payment`, `payment_mode`, `created_at`, `updated_at`) VALUES
(1, 1, '[{\"productId\":2,\"quantity\":26,\"price\":89},{\"productId\":15,\"quantity\":18,\"price\":97},{\"productId\":19,\"quantity\":6,\"price\":34}]', 0, '0', 0, '0', 0, 4264, 0, 0, '2024-11-18 18:30:00', '2024-11-18 18:30:00'),
(2, 1, '[{\"productId\":16,\"quantity\":30,\"price\":52}]', 0, '0', 0, '0', 0, 1560, 0, 0, '2024-11-17 18:30:00', '2024-11-17 18:30:00'),
(3, 1, '', 0, '0', 0, '0', 0, 0, 1000, 1, '2024-11-17 18:30:00', '2023-09-11 18:30:00'),
(4, 1, '', 0, '0', 0, '0', 0, 0, 2295, 1, '2024-11-14 18:30:00', '2024-03-02 18:30:00'),
(5, 1, '[{\"productId\":3,\"quantity\":28,\"price\":21},{\"productId\":21,\"quantity\":17,\"price\":28},{\"productId\":11,\"quantity\":18,\"price\":99}]', 0, '0', 0, '0', 0, 2846, 0, 0, '2024-11-13 18:30:00', '2024-11-13 18:30:00'),
(6, 1, '', 0, '0', 0, '0', 0, 0, 2000, 1, '2024-11-11 18:30:00', '2024-08-10 18:30:00'),
(7, 1, '[{\"productId\":5,\"quantity\":15,\"price\":99},{\"productId\":11,\"quantity\":18,\"price\":99},{\"productId\":25,\"quantity\":10,\"price\":60},{\"productId\":22,\"quantity\":11,\"price\":15},{\"productId\":14,\"quantity\":4,\"price\":4}]', 0, '0', 0, '0', 0, 4048, 0, 0, '2024-11-10 18:30:00', '2024-11-10 18:30:00'),
(8, 1, '', 0, '0', 0, '0', 0, 0, 2285, 1, '2024-11-10 18:30:00', '2024-09-10 18:30:00'),
(10, 1, '', 0, '0', 0, '0', 0, 0, 800, 1, '2024-11-17 18:30:00', '2024-12-04 04:21:20');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `bill_address` varchar(255) DEFAULT NULL,
  `opening_balance` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `image_presets`
--

INSERT INTO `image_presets` (`id`, `name`, `width`, `height`, `status`) VALUES
(1, 'small', 36, 36, 0),
(2, 'avatar', 30, 30, 0),
(3, 'photo', 100, 100, 0),
(4, 'thumb', 138, 93, 0),
(5, 'Profile', 370, 250, 0),
(6, 'Testimonials', 250, 318, 0),
(7, 'slider', 770, 520, 0),
(8, 'property_listing', 300, 350, 0),
(9, 'Agent_avatar', 300, 334, 0),
(10, 'state_image', 370, 275, 0),
(11, 'blog_image_large', 720, 308, 0),
(12, 'blog_image_front', 181, 167, 0),
(13, 'logo', 150, 106, 0),
(14, 'Full', 0, 0, 0);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_09_13_153402_create_types_table', 14),
(84, '2023_11_28_131149_create_site_settings_table', 15),
(86, '2024_11_12_093838_create_customers_table', 16),
(88, '2024_11_17_173827_billing', 18),
(90, '2024_11_27_094333_create_payments_table', 19),
(91, '2025_11_11_073214_create_suppliers_table', 20),
(97, '2025_11_12_090524_create_purities_table', 21),
(98, '2024_11_16_131427_create_unit_table', 22),
(99, '2024_11_11_112538_create_products_table', 23);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'smtp.menu', 'web', 'smtp', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(2, 'smtp.setting', 'web', 'smtp', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(3, 'site.menu', 'web', 'site', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(4, 'site.setting', 'web', 'site', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(5, 'role.menu', 'web', 'role', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(6, 'role.index', 'web', 'role', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(7, 'role.create', 'web', 'role', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(8, 'role.edit', 'web', 'role', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(9, 'role.delete', 'web', 'role', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(10, 'permission.index', 'web', 'role', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(11, 'permission.create', 'web', 'role', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(12, 'permission.edit', 'web', 'role', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(13, 'permission.delete', 'web', 'role', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(14, 'add.roles.permission', 'web', 'role', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(15, 'all.roles.permission', 'web', 'role', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(16, 'admin.menu', 'web', 'admin', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(17, 'all.admin', 'web', 'admin', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(18, 'add.admin', 'web', 'admin', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(19, 'image_preset.menu', 'web', 'image_preset', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(20, 'image_preset.index', 'web', 'image_preset', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(21, 'image_preset.create', 'web', 'image_preset', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(22, 'image_preset.edit', 'web', 'image_preset', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(23, 'image_preset.status', 'web', 'image_preset', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(24, 'image_preset.delete', 'web', 'image_preset', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(25, 'module.menu', 'web', 'module', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(26, 'module.index', 'web', 'module', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(27, 'module.create', 'web', 'module', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(28, 'module.delete', 'web', 'module', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(29, 'pages.menu', 'web', 'pages', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(30, 'pages.create', 'web', 'pages', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(31, 'pages.index', 'web', 'pages', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(32, 'pages.edit', 'web', 'pages', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(33, 'pages.status', 'web', 'pages', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(34, 'pages.delete', 'web', 'pages', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(35, 'blog.menu', 'web', 'post', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(36, 'blog.index', 'web', 'post', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(37, 'blog.create', 'web', 'post', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(38, 'blog.edit', 'web', 'post', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(39, 'blog.delete', 'web', 'post', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(40, 'tag.menu', 'web', 'tag', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(41, 'tag.index', 'web', 'tag', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(42, 'tag.create', 'web', 'tag', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(43, 'tag.edit', 'web', 'tag', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(44, 'tag.delete', 'web', 'tag', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(45, 'menus.menu', 'web', 'menus', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(46, 'menus.index', 'web', 'menus', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(47, 'menus.create', 'web', 'menus', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(48, 'menus.edit', 'web', 'menus', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(49, 'menus.delete', 'web', 'menus', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(50, 'menus.status', 'web', 'menus', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(51, 'menugroup.menu', 'web', 'menugroup', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(52, 'menugroup.index', 'web', 'menugroup', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(53, 'menugroup.create', 'web', 'menugroup', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(54, 'menugroup.edit', 'web', 'menugroup', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(55, 'menugroup.delete', 'web', 'menugroup', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(56, 'testimonials.menu', 'web', 'testimonials', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(57, 'testimonials.create', 'web', 'testimonials', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(58, 'testimonials.index', 'web', 'testimonials', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(59, 'testimonials.edit', 'web', 'testimonials', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(60, 'testimonials.delete', 'web', 'testimonials', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(61, 'testimonials.status', 'web', 'testimonials', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(62, 'all.users', 'web', 'admin', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(63, 'blogcategory.menu', 'web', 'blogcategory', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(64, 'blogcategory.create', 'web', 'blogcategory', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(65, 'blogcategory.index', 'web', 'blogcategory', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(66, 'blogcategory.edit', 'web', 'blogcategory', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(67, 'blogcategory.delete', 'web', 'blogcategory', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(68, 'blogcategory.status', 'web', 'blogcategory', '2024-09-12 09:00:44', '2024-09-12 09:00:44'),
(69, 'category.menu', 'web', 'post', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(70, 'category.index', 'web', 'post', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(71, 'category.create', 'web', 'post', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(72, 'category.edit', 'web', 'post', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(73, 'category.delete', 'web', 'post', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(74, 'portfolio.menu', 'web', 'portfolio', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(75, 'portfolio.index', 'web', 'portfolio', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(76, 'portfolio.create', 'web', 'portfolio', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(77, 'portfolio.edit', 'web', 'portfolio', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(78, 'portfolio.delete', 'web', 'portfolio', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(79, 'services.menu', 'web', 'services', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(80, 'services.index', 'web', 'services', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(81, 'services.create', 'web', 'services', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(82, 'services.edit', 'web', 'services', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(83, 'services.delete', 'web', 'services', '2024-09-13 10:41:45', '2024-09-13 10:41:45'),
(84, 'category.status', 'web', 'category', '2024-09-13 10:58:36', '2024-09-13 10:58:36'),
(85, 'portfolio.status', 'web', 'portfolio', '2024-09-13 10:58:48', '2024-09-13 10:58:48'),
(86, 'services.status', 'web', 'serviecs', '2024-09-13 10:59:00', '2024-09-13 10:59:00'),
(87, 'skill.menu', 'web', 'skill', '2024-09-14 11:47:03', '2024-09-14 11:47:03'),
(88, 'skill.create', 'web', 'skill', '2024-09-14 11:47:04', '2024-09-14 11:47:04'),
(89, 'skill.index', 'web', 'skill', '2024-09-14 11:47:04', '2024-09-14 11:47:04'),
(90, 'skill.edit', 'web', 'skill', '2024-09-14 11:47:04', '2024-09-14 11:47:04'),
(91, 'skill.delete', 'web', 'skill', '2024-09-14 11:47:04', '2024-09-14 11:47:04'),
(92, 'skill.status', 'web', 'skill', '2024-09-14 11:47:04', '2024-09-14 11:47:04'),
(93, 'whychoose.menu', 'web', 'whychoose', '2024-09-14 11:47:04', '2024-09-14 11:47:04'),
(94, 'whychoose.create', 'web', 'whychoose', '2024-09-14 11:47:04', '2024-09-14 11:47:04'),
(95, 'whychoose.index', 'web', 'whychoose', '2024-09-14 11:47:04', '2024-09-14 11:47:04'),
(96, 'whychoose.edit', 'web', 'whychoose', '2024-09-14 11:47:04', '2024-09-14 11:47:04'),
(97, 'whychoose.delete', 'web', 'whychoose', '2024-09-14 11:47:04', '2024-09-14 11:47:04'),
(98, 'whychoose.status', 'web', 'whychoose', '2024-09-14 11:47:04', '2024-09-14 11:47:04');

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
  `price` varchar(100) DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `purity_id` int(11) DEFAULT NULL,
  `unit_id` int(11) NOT NULL DEFAULT 2,
  `gross_weight` decimal(10,4) NOT NULL,
  `net_weight` decimal(10,4) NOT NULL,
  `making_charge` int(11) NOT NULL DEFAULT 0,
  `rate_per_gram` int(11) NOT NULL DEFAULT 0,
  `gst_percent` int(11) NOT NULL DEFAULT 0,
  `stock_qty` int(11) NOT NULL DEFAULT 1,
  `pstatus` enum('in_stock','sold','returned') NOT NULL DEFAULT 'in_stock',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `type_id`, `name`, `price`, `image`, `purity_id`, `unit_id`, `gross_weight`, `net_weight`, `making_charge`, `rate_per_gram`, `gst_percent`, `stock_qty`, `pstatus`, `status`, `created_at`, `updated_at`) VALUES
(1, 'GOLD001', 1, '22K Gold Chain', '118,398.50', 'upload/product/thumbnail/1849221672701399.png', 2, 2, 10.0000, 10.0000, 500, 11445, 3, 1, 'in_stock', 0, '2025-11-19 11:52:49', '2025-11-19 07:25:05'),
(2, 'GOLD002', 1, '24K Gold Ring', '0', '', 1, 2, 5.0000, 5.0000, 300, 12486, 3, 1, 'in_stock', 0, '2025-11-19 11:54:15', '2025-11-19 11:54:15'),
(3, 'GOLD003', 1, '22K Gold Necklace', '0', '', 2, 2, 20.0000, 20.0000, 800, 11445, 3, 1, 'in_stock', 0, '2025-11-19 11:55:49', '2025-11-19 11:55:49'),
(4, 'GOLD004', 1, '18K Gold Bracelet', '0', '', 3, 2, 15.0000, 15.0000, 600, 9364, 3, 1, 'in_stock', 0, '2025-11-19 11:57:27', '2025-11-19 11:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `purities`
--

CREATE TABLE `purities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purities`
--

INSERT INTO `purities` (`id`, `type_id`, `name`, `status`) VALUES
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
  `tax` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gst` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_holder_name` varchar(255) DEFAULT NULL,
  `bank_ifsc` varchar(255) DEFAULT NULL,
  `bank_account` varchar(100) DEFAULT NULL,
  `bank_branch` varchar(150) DEFAULT NULL,
  `pan_no` varchar(50) DEFAULT NULL,
  `declaration` varchar(100) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `bank_qr_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `logo`, `favicon`, `site_title`, `app_name`, `support_phone`, `email`, `tax`, `address`, `gst`, `bank_name`, `bank_holder_name`, `bank_ifsc`, `bank_account`, `bank_branch`, `pan_no`, `declaration`, `message`, `bank_qr_code`) VALUES
(1, 'upload/template/thumbnail/1809981924661515.png', 'upload/template/thumbnail/1809981924671923.png', 'TUFF TWELVE PRIVATE LIMITE', 'TUFF TWELVE PRIVATE LIMITE', '99-5846-4102', 'info@demo.com', 0, 'asdsad', 'asdsa', 'bas', 'Mohan', '324324', 'a2343ws', '3edf', '13344s', '3223', 'hgfhdsaas', '');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `status`) VALUES
(1, 'Gold', '0'),
(2, 'Slider', '0'),
(3, 'Other', '0');

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
(1, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$12$dQN5u.bXyxKOIrdCUy1qrOhXDp8ZiqKXf7EJknImBkSfz5LTKLB/K', 'upload/user/thumbnail/1817511670142466.jpg', NULL, 0, NULL, 'admin', 0, 'SVQ3NyzO3OpPQEyMDvBy3MdBRNS4UIACkzrkfpabwJShMPCUs2YEYFFVnCOS', '2023-11-27 23:45:04', '2024-12-04 06:40:00'),
(2, 'hajari', 'admin2', 'test@gmail.com', NULL, '$2y$12$Yl/BCf6okAdG0BhmIOfzAeEiwS7jaQg8DRK7blpPloITzBhy/z76u', 'upload/user/thumbnail/1817511688965034.jpg', NULL, 0, NULL, 'admin', 0, NULL, '2024-11-27 03:36:13', '2024-12-04 06:40:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_presets`
--
ALTER TABLE `image_presets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
