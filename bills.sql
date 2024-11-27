-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 10:20 AM
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
  `grand_total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `customer_id`, `cart`, `discount`, `discount_amount`, `tax`, `tax_amount`, `grand_total`, `created_at`, `updated_at`) VALUES
(2, 1, '[{\"productId\":\"14\",\"quantity\":23,\"price\":4},{\"productId\":\"17\",\"quantity\":14,\"price\":56},{\"productId\":\"17\",\"quantity\":12,\"price\":56}]', 0, '0', 0, '0', 1548, '2024-11-27 09:01:16', '2024-11-27 09:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(1, 'Upvc Windows & Door Manufacturer', '0'),
(2, 'Aluminium Partition & Window Elevation', '0'),
(3, 'Aluminium Powder Coating Section', '0'),
(4, 'Exclusive Hardware & Aluminium', '0'),
(5, 'Acp Composite Panel', '0'),
(6, 'Hpl Composite Panel', '0'),
(7, 'Technologiesa', '0');

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
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `bill_address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mohan', 'kumar', '2233333333', 'asdasd', NULL, 0, '2024-11-12 04:55:04', '2024-11-12 04:57:44');

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
(5, '2024_09_13_153402_create_categories_table', 14),
(84, '2023_11_28_131149_create_site_settings_table', 15),
(85, '2024_11_11_112538_create_products_table', 15),
(86, '2024_11_12_093838_create_customers_table', 16),
(87, '2024_11_16_131427_create_colors_table', 17),
(88, '2024_11_17_173827_billing', 18);

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
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `image`, `price`, `unit_id`, `text`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'SILVER ANODIDES 1 KG', '', 52, 0, 'Rem et deleniti et consequatur porro et deserunt sit. Quia est ducimus et aut cum illum. Odio modi mollitia et possimus sit pariatur.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(2, 4, 'Product 13', '', 89, 0, 'Rerum eos voluptates et quam ut consequatur sunt rerum. Qui tempora dignissimos sit in accusamus eveniet. Quod illum consequuntur ut quasi sunt dolorum. Ut nam ut architecto sed non ipsum.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(3, 3, 'Product 8', '', 21, 0, 'Nihil doloremque delectus voluptatem beatae reiciendis dolorem dicta laudantium. Culpa rem omnis expedita et necessitatibus eius. Illo aliquid in repellendus inventore ipsam fugit.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(4, 5, 'Product 29', '', 36, 0, 'Omnis sequi aut minima excepturi odio eum ipsam. Ex dicta voluptatem iusto exercitationem placeat et. Temporibus nemo unde quidem esse voluptate.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(5, 1, 'Product 39', '', 99, 0, 'Nisi sed eveniet ut ut aut quod voluptatem. Et recusandae illo et voluptates inventore. Non sed et dolorum aut distinctio fuga occaecati. Non expedita cumque laudantium recusandae.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(6, 1, 'Product 84', '', 28, 0, 'Id corrupti minus quia. Et nulla tenetur et. Minus impedit praesentium officiis dicta sunt.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(7, 6, 'Product 99', '', 16, 0, 'Temporibus voluptas eos suscipit hic nihil pariatur vero. Magni adipisci sed accusantium dolorem. Enim tenetur ut accusantium iusto officia.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(8, 3, 'Product 100', '', 51, 0, 'Qui id rerum et. Blanditiis ut et non suscipit sapiente sed vel. Quibusdam id et et consequuntur et id.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(9, 1, 'Product 69', '', 62, 0, 'Voluptas perspiciatis suscipit velit doloribus aut facere possimus. Corporis sed quae sapiente consequatur accusantium voluptatem. Fugiat et perspiciatis quam culpa.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(10, 3, 'Product 73', '', 32, 0, 'Nihil quia fuga dicta aut. Consequuntur doloremque deserunt aliquid qui perspiciatis tempora. Quasi voluptas aliquam quaerat culpa commodi. Porro inventore maxime quas vel.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(11, 3, 'Product 66', '', 99, 0, 'Qui quibusdam nesciunt sapiente aut tempore voluptas consequuntur est. Occaecati ipsum nihil eius ducimus. Qui cum est ex dolor sunt nisi. Voluptatem voluptatem consequatur necessitatibus delectus.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(12, 3, 'Product 49', '', 59, 0, 'Error aliquam quis nam qui temporibus ut. Nam iusto ea voluptatem in accusamus. Vitae assumenda temporibus a est libero dolore quo.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(13, 2, 'Product 72', '', 45, 0, 'Non sunt est ullam laudantium laborum non et. Eius eum minus sit nihil eum. Iste quibusdam saepe non ad.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(14, 5, 'Product 42', '', 4, 0, 'Magnam autem eius accusamus. Rerum dolor maxime vero possimus blanditiis est. Beatae aspernatur est hic quis dolor.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(15, 3, 'Product 94', '', 97, 0, 'Quas culpa cum non minima. Quia animi aut et. Dolore provident qui et. Delectus nihil tempore sequi ea. Nostrum dignissimos perspiciatis voluptatem sed. Quo dolores qui deleniti quibusdam quos aut.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(16, 1, 'Product 27', '', 52, 0, 'Ut aut dolores eum consectetur. Nemo et facilis explicabo sint modi mollitia. Expedita aut inventore sint magni ut quis dignissimos.', 0, '2024-11-12 14:14:59', '2024-11-22 07:57:46'),
(17, 4, 'Product 57', '', 56, 0, 'Dignissimos facilis sint sint est. Recusandae perferendis nobis ducimus officia alias voluptatum illum eaque. Ea aut aliquam voluptate qui ipsum. Rerum numquam ut hic optio dolorem et.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(18, 1, 'Product 80', '', 75, 0, 'Provident earum iste in doloremque atque. Et eligendi reprehenderit et veniam. Ut nobis est quia autem sunt incidunt. Enim hic tenetur saepe iusto ducimus necessitatibus dolores.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(19, 6, 'Product 54', '', 34, 0, 'Tempora aut facere ut velit impedit. Earum possimus est dolorem sint sed hic eaque. Sit eum architecto qui tenetur sunt quisquam et. Reiciendis rerum iste illum culpa nemo quae rerum aperiam.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(20, 7, 'Product 68', '', 25, 0, 'Magnam voluptas amet eum sed dolore qui voluptatem. Aut vitae laudantium neque et quibusdam. Odio quasi veniam perspiciatis iure optio. Cumque autem deserunt eum doloremque ut minima accusamus.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(21, 1, 'Product 67', '', 28, 0, 'Eum veritatis tempore iste eum. Suscipit a est et aut. Corporis placeat consequuntur veniam.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(22, 1, 'Product 35', '', 15, 0, 'Aperiam soluta sapiente quo ratione quos in. Et eius dolores cum ipsum consectetur quis magni.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(23, 1, 'Product 98', '', 75, 0, 'Nulla ipsum eveniet et laudantium optio. Dolores quae sed rem aut. Assumenda voluptatum id ex.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(24, 5, 'Product 33', '', 48, 0, 'Sit omnis perspiciatis saepe quae est. Minus esse ipsum aspernatur ut. Voluptates eligendi beatae illum officiis explicabo qui ea. Maxime ut sint architecto non molestias.', 0, '2024-11-12 14:14:59', '2024-11-12 14:14:59'),
(25, 4, 'Product 28', '', 60, 1, 'Dolor sed maiores minima beatae delectus quis sit. Sunt laudantium nihil enim libero sapiente aperiam. Earum inventore iste rerum sint et tenetur. Eveniet hic consequatur ullam sint qui.', 0, '2024-11-12 14:14:59', '2024-11-22 08:28:59');

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
  `bank_account` varchar(100) DEFAULT NULL,
  `bank_branch` varchar(150) DEFAULT NULL,
  `pan_no` varchar(50) DEFAULT NULL,
  `declaration` varchar(100) DEFAULT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `logo`, `favicon`, `site_title`, `app_name`, `support_phone`, `email`, `tax`, `address`, `gst`, `bank_name`, `bank_account`, `bank_branch`, `pan_no`, `declaration`, `message`) VALUES
(1, 'upload/template/thumbnail/1809981924661515.png', 'upload/template/thumbnail/1809981924671923.png', 'TUFF TWELVE PRIVATE LIMITE', 'TUFF TWELVE PRIVATE LIMITE', '99-5846-4102', 'info@demo.com', 0, 'asdsad', 'asdsa', 'bas', 'a2343ws', '3edf', '13344s', '3223', '');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `status`) VALUES
(1, 'Brown', 0),
(2, 'Sliver', 0),
(3, 'Ivory', 0),
(4, 'Marvel', 0),
(5, 'Wooden', 0);

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
(1, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$12$dQN5u.bXyxKOIrdCUy1qrOhXDp8ZiqKXf7EJknImBkSfz5LTKLB/K', 'upload/user/thumbnail/1798391573232030.jpg', NULL, 0, NULL, 'admin', 0, 'WtrHtTCxjNCRyxZqmi6lkm9CI1F6rFHXACnbkCBagBvjAWrALLBxgDPNpAuw', '2023-11-27 23:45:04', '2024-05-07 11:04:17'),
(2, 'hajari', 'admin2', 'test@gmail.com', NULL, '$2y$12$Yl/BCf6okAdG0BhmIOfzAeEiwS7jaQg8DRK7blpPloITzBhy/z76u', '', NULL, 0, NULL, 'admin', 0, NULL, '2024-11-27 03:36:13', '2024-11-27 03:39:49');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
