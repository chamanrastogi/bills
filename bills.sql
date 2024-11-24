-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 06:24 PM
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
-- Database: `bills`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart` varchar(500) NOT NULL,
  `discount` int(11) NOT NULL,
  `discount_amount` varchar(50) NOT NULL,
  `tax` int(11) NOT NULL,
  `tax_amount` varchar(50) NOT NULL,
  `grand_total` varchar(50) NOT NULL,
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
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(1, 'Hardware', 0),
(2, 'Aluminium', 0);

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
(1, 'AK ENTERPRISES ', '', '7999512063', 'NAGOD ', 'NAGOD ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'AKRITI OFSET ', '', '9425144921', 'CHHATARPUR', 'CHHATARPUR', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'ALI GLASS ', '', '7007058472', 'MAHOBA ', 'MAHOBA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'ALISHA TRADERS ', '', '9369456803', 'MAURANIPUR ', 'MAURANIPUR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'ANIL STEEL ', '', '8354842092', 'BANDA', 'BANDA', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'ARUN PRAJAPATI  ', '', '9131704618', 'BIJAWAR ', 'BIJAWAR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'ARVINDRA VISHWAKARMA ', '', '8839028462', 'BIJAWAR ', 'BIJAWAR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'ARVINDRA VISHWAKARMA ', '', '7989203088', 'SATAI ROAD ', 'SATAI ROAD ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'ASHISH SAHU BIJAWAR', '', '6266612032', 'BIJAWAR ', 'BIJAWAR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'BAHUBALI ALUMINIUM ', '', '7000344109', 'CHHATARPUR ', 'CHHATARPUR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'BHARGAV GLASS ', '', '9826226264', 'BUS STAND', 'BUS STAND', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'CAHNDU SONI ', '', '9893869764', 'BUS STAND', 'BUS STAND', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'CHHATRAPAL ', '', '8359039884', 'NOWGONG ', 'NOWGONG ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'CHHOTU VISHWAKARMA ', '', '8076729942', 'PALERA ', 'PALERA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'DEVENDRA VISHWAKARMA', '', '9752523161', 'SAGAR ROAD ', 'SAGAR ROAD ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'GAYTRI GLASS ', '', '8871512405', 'KHAJURAHO ', 'KHAJURAHO ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'GOVINDRA VISHWAKARMA ', '', '9131418738', 'PATHAPUR ', 'PATHAPUR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'GUPTA ALUMINIUM ', '', '7999753076', 'BIJAWAR ', 'BIJAWAR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'GUPTA TRADERS ', '', '7000483128', 'PANNA ', 'PANNA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'HARI OM ARJARIYA  ', '', '9179447950', 'SATAI ROAD ', 'SATAI ROAD ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'HARSHITA ALUMINIUM', '', '7860690111', 'MAURANIPUR ', 'MAURANIPUR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'HRADESH SHRIWAS ', '', '9098169503', 'HARPALPUR ', 'HARPALPUR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'JAAKIR KHAN', '', '9981429529', 'KHARGAPUR ', 'KHARGAPUR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'JAGDISH PATEL ', '', '9993048218', 'SARBAI', 'SARBAI', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'KAILASH YADAV ', '', '9826309351', 'SAGAR ROAD ', 'SAGAR ROAD ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'KALPNA ALUMINIUMM ', '', '8699152657', 'ATARRA ', 'ATARRA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'KAVYA GLASS ', '', '7900051351', 'NARAINI', 'NARAINI', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'LOKESH PANCHAL ', '', '9621262656', 'RATH', 'RATH', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'LOVKUSH FURNITURE ', '', '7879794051', 'DEVENDRANAGAR ', 'DEVENDRANAGAR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'M K FURNITURE ', '', '9935576860', 'PANWARI', 'PANWARI', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'MAA GAURI ', '', '8871191500', 'NOWGONG ', 'NOWGONG ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'MAANAK LAL VISHWAKARMA ', '', '9109596259', 'BADA MALHARA ', 'BADA MALHARA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'MAHAKAL HARDWARE', '', '8827010029', 'KHARGAPUR ', 'KHARGAPUR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'MAHESH PATHAK ', '', '9993862418', 'CHANDNAGAR ', 'CHANDNAGAR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'MAHESH VISHWAKARMA ', '', '8517087472', 'PANNA ', 'PANNA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'MAKHAN ', '', '9757937253', 'NAGOD ', 'NAGOD ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'MANISH SAHU ', '', '9131615422', 'BIJAWAR ', 'BIJAWAR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'MANSOORI ', '', '9111877698', 'HARPALPUR ', 'HARPALPUR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'MODI TRADERS ', '', '9425877981', 'PANNA ', 'PANNA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'MOH. NADIM', '', '9795697803', 'MAHOBA ', 'MAHOBA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'MUKESH VISHWAKARMA ', '', '9893061213', 'KHAJURAHO ', 'KHAJURAHO ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'NANDINI ASSOCIATE ', '', '8319630743', 'SATNA ', 'SATNA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'NARSINGH ALUMINIUM ', '', '9425880395', 'CHHATARPUR ', 'CHHATARPUR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'NEERAJ VISHWAKARMA ', '', '8770618106', 'NOWGONG ', 'NOWGONG ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'NIKHIL FEBRICATION ', '', '7000401141', 'SAGAR ROAD ', 'SAGAR ROAD ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'NISHAR BHAI ', '', '7566095551', 'NOWGONG ', 'NOWGONG ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'OM FURNITURE', '', '8787075341', 'MAHOBA ', 'MAHOBA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'PATHAK TRADERS ', '', '9827848892', 'NAGOD ', 'NAGOD ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'PURAN KUSHWAHA ', '', '9399617312', 'BUS STAND ', 'BUS STAND ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'RACHNA GLASS ', '', '9993262261', 'NOWGONG ', 'NOWGONG ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'RAHUL PANCHAL ', '', '7697862529', 'SAGAR ROAD ', 'SAGAR ROAD ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'RAJ SHREE ', '', '8962287033', 'HARPALPUR ', 'HARPALPUR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'RAMSHARAN VISHWAKARMA', '', '6264271625', 'BADA MALHARA ', 'BADA MALHARA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'RATNA VISHWAKARMA  ', '', '7869573493', 'BADA MALHARA ', 'BADA MALHARA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'RINKU VISHWAKARMA ', '', '9501662774', 'SATAI ROAD ', 'SATAI ROAD ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'SANJAY SHARMA ', '', '9893900660', 'CHHATARPUR ', 'CHHATARPUR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'SANTOSH KUMAR SAHU ', '', '9685896757', 'SAGAR ROAD ', 'SAGAR ROAD ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'SANTOSH KUSHWAHA ', '', '8305767398', 'PANNA ', 'PANNA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'SANTOSH MAHARAJ ', '', '9131635643', 'BUS STAND ', 'BUS STAND ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'SHIDDHI VINAYAK  ', '', '8602364854', 'SASGAR ROAD ', 'SASGAR ROAD ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'SHIV KRIPA ALUMINIUM  ', '', '7241154950', 'BRAHMAKUMARI AASHRAM ', 'BRAHMAKUMARI AASHRAM ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'SUNIL PATEL ', '', '8120764891', 'CHANDLA ', 'CHANDLA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'SURESH VISHWAKARMA ', '', '9165018821', 'AJAYGARH', 'AJAYGARH', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'TEJ KUMAR ', '', '9575233134', 'SAGAR ROAD ', 'SAGAR ROAD ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'VISHWAKARMA ENTERPRISES ', '', '9993909891', 'PANNA ', 'PANNA ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'YASH ALUMINIUM ', '', '7067333166', 'CHHATARPUR ', 'CHHATARPUR ', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(5, '2023_11_28_131149_create_site_settings_table', 1),
(6, '2024_09_13_153402_create_categories_table', 1),
(7, '2024_11_11_112538_create_products_table', 1),
(8, '2024_11_12_093838_create_customers_table', 1),
(9, '2024_11_16_131427_create_colors_table', 1),
(10, '2024_11_17_173827_billing', 1);

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
(2, 1, 'SCREW 19X8 STAR ', '', 230, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'SCREW 13X6 STAR ', '', 160, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 'SCREW  60X6 STAR ', '', 170, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 'SCREW 75X8 STAR ', '', 280, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 'SCREW 75x10 STAR ', '', 300, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 'SCREW 75X10 WOODEN', '', 200, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 'SCREW 60X10 STAR ', '', 180, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 'SCREW 19X8 SELF ', '', 320, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 'SCREW 13X8 SELF  ', '', 300, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 'SCREW 60X8 STAR ', '', 300, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, 'SCREW 2\" BLACK  ', '', 380, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 1, 'SCREW 1.50\" DIRECT ', '', 380, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 1, 'SCREW 25X6 STAR  ', '', 260, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 1, 'GULLI ', '', 35, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 1, '4\" TOWER BOLT BROWN', '', 30, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 1, '4\" TOWER BOLT BROWN', '', 300, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 1, '4\" TOWER BOLT SILVER', '', 30, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 1, '4\" TOWER BOLT SILVER', '', 300, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 1, '4\" HANDLE BROWN ', '', 15, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 1, '4\" HANDLE BROWN ', '', 150, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 1, '4\" HANDLE SILVER ', '', 15, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 1, '4\" HANDLE SILVER ', '', 150, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 1, '6\" TOWER BOLT SILVER ', '', 30, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 1, '6\" TOWER BOLT SILVER ', '', 350, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 1, '6\" TOWER BOLT BROWN', '', 30, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 1, '6\" TOWER BOLT BROWN', '', 350, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 1, '6\" TOWER BOLT LIGHT SILVER ', '', 30, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 1, '6\" TOWER BOLT LIGHT SILVER ', '', 300, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 1, '6\" TOWER BOLT LIGHT BROWN', '', 30, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 1, '6\" TOWER BOLT LIGHT BROWN', '', 300, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 1, 'G WEARING SET ', '', 200, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 1, 'DEN GARARI', '', 8, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 1, 'DEN GARARI', '', 550, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 1, 'TPI GARARI', '', 10, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 1, 'TPI GARARI', '', 100, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 1, 'PVC STAR LOCK', '', 20, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 1, 'PVC STAR LOCK', '', 380, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 1, 'STAR LOCK ALBOSS', '', 40, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 1, 'STAR LOCK ALBOSS', '', 750, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 1, 'SADA LOCK', '', 100, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 1, 'SADA LOCK', '', 480, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 1, 'AKADI LOCK', '', 100, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 1, 'AKADI LOCK', '', 720, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 1, 'AC RUBBER ', '', 200, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 1, 'MOSQUITO JAALI ', '', 15, 4, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 1, 'RUBBER ', '', 110, 2, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 1, 'SADA AKADI', '', 15, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 1, 'SADA AKADI', '', 160, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 1, 'BROWN AKADI ', '', 15, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 1, 'BROWN AKADI ', '', 160, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 1, 'IVORY AKADI', '', 15, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 1, 'IVORY AKADI', '', 160, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 1, 'SILVER STOPER ', '', 50, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 1, 'SILVER STOPER ', '', 500, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 1, 'BROWN STOPER ', '', 50, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 1, 'BROWN STOPER ', '', 500, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 1, 'CHAMPION STOPER ', '', 60, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 1, 'CHAMPION STOPER ', '', 550, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 1, '3\" STEEL KABJAA ', '', 8, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 1, '3\" STEEL KABJAA ', '', 190, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 1, '4\" SILVER KABJAA ', '', 30, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 1, '4\" SILVER KABJAA ', '', 360, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 1, '4\" BROWN KABJAA ', '', 30, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 1, '4\" BROWN KABJAA ', '', 400, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 1, '4\" IVORY KABJAA ', '', 30, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 1, '4\" IVORY KABJAA ', '', 400, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 1, '4\" CHAMPION KABJAA ', '', 35, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 1, '4\" CHAMPION KABJAA ', '', 450, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 1, '6\" ALDROP SILVER', '', 50, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 1, '6\" ALDROP SILVER', '', 500, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 1, '6\" ALDROP BROWN', '', 55, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 1, '6\" ALDROP BROWN', '', 550, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 1, '6\" ALDROP IVORY', '', 55, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 1, '6\" ALDROP IVORY', '', 550, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 1, '8\" ALDROP SILVER', '', 70, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 1, '8\" ALDROP SILVER', '', 0, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 1, '8\" ALDROP BROWN', '', 80, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 1, '8\" ALDROP BROWN', '', 0, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 1, '8\" ALDROP IVORY', '', 80, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 1, '8\" ALDROP IVORY', '', 0, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 1, '10\" ALDROP SILVER', '', 140, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 1, '10\" ALDROP SILVER', '', 0, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 1, '10\" ALDROP BROWN', '', 140, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 1, '10\" ALDROP BROWN', '', 0, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 1, '10\" ALDROP IVORY', '', 140, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 1, '10\" ALDROP IVORY', '', 0, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 1, '12\" ALDROP SILVER', '', 160, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 1, '12\" ALDROP SILVER', '', 0, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 1, '12\" ALDROP BROWN', '', 160, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 1, '12\" ALDROP BROWN', '', 0, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 1, '12\" ALDROP IVORY', '', 160, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 1, '12\" ALDROP IVORY', '', 0, 1, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 1, 'E-CHANNEL SILVER', '', 180, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 1, 'E-CHANNEL BROWN', '', 200, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 1, 'E-CHANNEL INORY', '', 200, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 1, 'E-CHANNEL CHAMPION', '', 220, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 1, 'U- CHANNEL SILVER', '', 60, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 1, 'U- CHANNEL BROWN', '', 70, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 1, 'U- CHANNEL IVORY', '', 70, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 1, 'U- CHANNEL CHAMPION', '', 80, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 1, 'SILVER SPRAY ', '', 150, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 1, 'BRWON SPRAY', '', 150, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 1, 'IVORY SPRAY ', '', 150, 3, '', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
  `email` varchar(100) DEFAULT NULL,
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
(1, 'upload/template/thumbnail/1816024053765469.png', 'upload/template/thumbnail/1816024053787384.png', 'Hema Aluminium & Ply', 'Hema Aluminium & Ply', '94-2514-3331', 'hemaaluminiumchh31@gmail.com', 18, 'Sheikh Ki Bagia, Police Line Road, Chhatarpur HO, Chhatarpur - 471001 (Behind Saffron Lodge)', '23AFPPV1843J1Z1', 'ICICI Bank', 'Hema Aluminium & Ply', 'ICIC0000426', '042605001873', 'Chhatarpur', 'ICIC0000426', 'We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.', 'This is Computer Generated Invoice', 'upload/template/thumbnail/1816510426446627.jpeg');

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
(1, 'Box', 0),
(2, 'KGS', 0),
(3, 'Pcs', 0),
(4, 'Sqf', 0);

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
(1, 'admin', 'admin', 'hemaaluminiumchh31@gmail.com', NULL, '$2y$12$A1kHOF7jk/LhKheG1ns80uKXy2.2056AhIu2gES9b3ch/pBQVfcBS', 'upload/user/thumbnail/1815982330376496.png', '9425143331', 0, NULL, 'admin', 0, 'PcLMbcStvtgOg4eJwp0zh7caYN3Hh2ZBo2RGsxa7xZC6pVhPXGoLDgADSQfL', '2023-11-27 18:15:04', '2024-11-18 02:18:57');

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
  ADD UNIQUE KEY `categories_name_unique` (`name`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
