-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07 Nov 2018 pada 07.52
-- Versi Server: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cubic-pro`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `boms`
--

CREATE TABLE `boms` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reject_ratio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bom_datas`
--

CREATE TABLE `bom_datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `bom_id` int(11) NOT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bom_semis`
--

CREATE TABLE `bom_semis` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bom_semi_datas`
--

CREATE TABLE `bom_semi_datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `bom_semi_id` int(11) NOT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `budget_plannings`
--

CREATE TABLE `budget_plannings` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fiscal_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `market` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jan_qty` int(11) NOT NULL DEFAULT '0',
  `jan_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `feb_qty` int(11) NOT NULL DEFAULT '0',
  `feb_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `mar_qty` int(11) NOT NULL DEFAULT '0',
  `mar_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `apr_qty` int(11) NOT NULL DEFAULT '0',
  `apr_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `may_qty` int(11) NOT NULL DEFAULT '0',
  `may_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `june_qty` int(11) NOT NULL DEFAULT '0',
  `june_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `july_qty` int(11) NOT NULL DEFAULT '0',
  `july_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `august_qty` int(11) NOT NULL DEFAULT '0',
  `august_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `sep_qty` int(11) NOT NULL DEFAULT '0',
  `sep_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `okt_qty` int(11) NOT NULL DEFAULT '0',
  `okt_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `nov_qty` int(11) NOT NULL DEFAULT '0',
  `nov_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `des_qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `des_amount` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_pic_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_pic_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_pic_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `customer_code`, `customer_name`, `customer_address`, `customer_phone`, `customer_email`, `customer_website`, `customer_pic_name`, `customer_pic_phone`, `customer_pic_email`, `created_at`, `updated_at`) VALUES
(1, 'TMMIN', 'PT. Toyota Motor Manufacturing Indonesia', 'KIIC', '123', 'cs@toyota.co.id', 'www.toyota.co.id', 'XXX', '12345', 'xxx@toyota.co.id', '2018-10-16 07:39:01', '2018-10-16 07:48:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sap_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `departments`
--

INSERT INTO `departments` (`id`, `department_code`, `division_id`, `sap_key`, `department_name`, `created_at`, `updated_at`) VALUES
(1, 'HRD', '1', NULL, 'HRGA', '2018-11-06 22:14:32', '2018-11-06 22:14:32'),
(2, 'IRL', '1', NULL, 'IR Legal', '2018-11-06 22:17:59', '2018-11-06 22:17:59'),
(3, 'MKT', '3', NULL, 'Marketing', '2018-11-06 22:18:15', '2018-11-06 22:18:15'),
(4, 'FAC', '1', NULL, 'Finance & Accounting', '2018-11-06 22:18:36', '2018-11-06 22:18:36'),
(5, 'PUR', '1', NULL, 'Purchasing', '2018-11-06 22:18:58', '2018-11-06 22:18:58'),
(6, 'ITD', '2', NULL, 'IT Development', '2018-11-06 22:19:57', '2018-11-06 22:19:57'),
(7, 'PPC', '4', NULL, 'PPIC', '2018-11-06 22:20:19', '2018-11-06 22:20:19'),
(8, 'PRD1', '4', NULL, 'Prod Body', '2018-11-06 22:20:45', '2018-11-06 22:20:45'),
(9, 'PRD2', '4', NULL, 'Prod Unit', '2018-11-06 22:21:10', '2018-11-06 22:21:10'),
(10, 'OMC', '4', NULL, 'OMC', '2018-11-06 22:21:33', '2018-11-06 22:21:33'),
(11, 'MTE', '2', NULL, 'Maintenance', '2018-11-06 22:21:55', '2018-11-06 22:21:55'),
(12, 'QAB', '2', NULL, 'Quality Body', '2018-11-06 22:22:13', '2018-11-06 22:22:13'),
(13, 'QAU', '2', NULL, 'Quality Unit', '2018-11-06 22:22:31', '2018-11-06 22:22:31'),
(14, 'MS', '2', NULL, 'Management System', '2018-11-06 22:23:05', '2018-11-06 22:23:05'),
(15, 'ENG1', '2', NULL, 'Engineering Body', '2018-11-06 22:23:27', '2018-11-06 22:23:27'),
(16, 'ENG2', '2', NULL, 'Engineering Unit', '2018-11-06 22:23:45', '2018-11-06 22:23:45'),
(17, 'NPL', '1', NULL, 'New Project  & Localization', '2018-11-06 22:24:16', '2018-11-06 22:24:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisions`
--

CREATE TABLE `divisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `division_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `divisions`
--

INSERT INTO `divisions` (`id`, `division_code`, `division_name`, `dir_key`, `created_at`, `updated_at`) VALUES
(1, 'ADM', 'Administration', 'ADMIN', '2018-11-06 22:11:50', '2018-11-06 22:11:50'),
(2, 'ENG', 'Engineering', 'ADMIN', '2018-11-06 22:12:13', '2018-11-06 22:12:13'),
(3, 'MKT', 'Marketing', 'ADMIN', '2018-11-06 22:12:31', '2018-11-06 22:12:31'),
(4, 'PRD', 'Production', 'PLANT', '2018-11-06 22:12:50', '2018-11-06 22:12:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'apa', 'baik', '2018-10-15 02:50:30', '2018-10-15 02:50:30', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_locations`
--

CREATE TABLE `group_locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `helps`
--

CREATE TABLE `helps` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `helps`
--

INSERT INTO `helps` (`id`, `title`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'apa', 'Saja', '2018-10-15 20:05:36', '2018-10-15 20:05:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_histories`
--

CREATE TABLE `login_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_prices`
--

CREATE TABLE `master_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_price_catalogs`
--

CREATE TABLE `master_price_catalogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(25,2) NOT NULL,
  `supplier_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` int(11) NOT NULL,
  `is_showed` tinyint(1) NOT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `name`, `url`, `icon`, `order_number`, `is_showed`, `method`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'Dashboard', 'dashboard', 'mdi mdi-view-dashboard', 2, 1, 'dashboard', '2018-08-15 18:26:26', '2018-10-10 15:48:15', NULL),
(2, 0, 'Pengguna', 'user', 'mdi mdi-account', 4, 1, 'pengguna', '2018-08-15 18:28:13', '2018-10-15 09:56:15', '2018-10-15 09:56:15'),
(3, 0, 'Tipe Kendaraan', 'type', 'mdi mdi-car', 6, 1, 'tipe-kendaraan', '2018-08-15 18:30:04', '2018-10-14 11:33:53', '2018-10-14 11:33:53'),
(4, 0, 'Grup Lokasi', 'group_location', 'mdi mdi-pin', 8, 1, 'grup-lokasi', '2018-08-15 18:30:31', '2018-10-14 11:34:00', '2018-10-14 11:34:00'),
(5, 0, 'Tarif', 'rate', 'mdi mdi-currency-usd', 10, 1, 'tarif', '2018-08-15 18:30:56', '2018-10-14 11:34:08', '2018-10-14 11:34:08'),
(6, 0, 'Parkir Histori', 'parking_history', 'mdi mdi-parking', 12, 1, 'parkir-histori', '2018-08-15 18:33:32', '2018-10-14 11:34:20', '2018-10-14 11:34:20'),
(7, 0, 'Isi Ulang Histori', 'topup_history', 'mdi mdi-book', 14, 1, 'isi-ulang-histori', '2018-08-15 18:34:00', '2018-10-14 11:34:31', '2018-10-14 11:34:31'),
(8, 14, 'Menu', 'menu', 'mdi mdi-menu', 41, 1, 'menu', '2018-08-15 18:34:18', '2018-11-06 20:48:21', NULL),
(14, 0, 'Setting', 'settings', 'mdi mdi-settings', 40, 1, 'pengaturan', '2018-08-15 18:59:05', '2018-11-06 20:48:21', NULL),
(15, 14, 'Roles', 'settings/role', NULL, 43, 1, 'peran', '2018-08-15 18:59:36', '2018-11-06 20:48:21', NULL),
(16, 14, 'User Role', 'settings/permission', NULL, 45, 1, 'izin-hak', '2018-08-15 18:59:59', '2018-11-06 20:48:21', NULL),
(17, 0, 'FAQ', 'faq', 'mdi mdi-help-circle', 32, 1, 'faq', '2018-08-22 16:41:18', '2018-10-15 09:55:46', '2018-10-15 09:55:46'),
(18, 0, 'Bantuan', 'help', 'mdi mdi-help-circle-outline', 34, 1, 'bantuan', '2018-08-22 16:41:42', '2018-10-15 09:55:50', '2018-10-15 09:55:50'),
(24, 0, 'Upload Data', 'upload', 'glyphicon glyphicon-upload', 4, 1, 'dashboard', '2018-10-14 11:36:12', '2018-10-16 08:21:53', NULL),
(25, 24, 'Upload Bom Finish Goods', 'bom', 'glyphicon glyphicon-upload', 9, 1, 'dashboard', '2018-10-14 11:36:56', '2018-10-18 12:23:14', NULL),
(26, 24, 'Upload Master Price Part', 'masterprice', 'glyphicon glyphicon-upload', 13, 1, 'dashboard', '2018-10-14 11:38:20', '2018-10-18 12:23:50', NULL),
(27, 24, 'Upload Sales Data', 'salesdata', 'glyphicon glyphicon-upload', 5, 1, 'dashboard', '2018-10-14 11:39:17', '2018-10-25 16:14:55', NULL),
(28, 0, 'Master Data', 'master', 'mdi mdi-book', 20, 1, 'dashboard', '2018-10-15 09:49:33', '2018-11-05 12:19:10', NULL),
(29, 28, 'Division', 'division', NULL, 21, 1, 'dashboard', '2018-10-15 09:51:25', '2018-11-05 12:19:10', NULL),
(30, 28, 'Department', 'department', NULL, 23, 1, 'dashboard', '2018-10-15 09:51:47', '2018-11-05 12:19:10', NULL),
(31, 28, 'Employee', 'employee', 'mdi mdi-account', 17, 1, 'dashboard', '2018-10-15 09:52:30', '2018-10-18 04:24:25', '2018-10-18 04:24:25'),
(32, 28, 'Customer', 'customer', NULL, 27, 1, 'dashboard', '2018-10-15 09:53:22', '2018-11-06 20:48:21', NULL),
(33, 28, 'Supplier', 'supplier', NULL, 29, 1, 'dashboard', '2018-10-15 09:53:37', '2018-11-06 20:48:21', NULL),
(34, 28, 'Plant', 'plant', NULL, 23, 1, 'dashboard', '2018-10-15 09:54:19', '2018-10-17 08:45:25', '2018-10-17 08:45:25'),
(35, 28, 'Part Category', 'category_part', NULL, 25, 1, 'dashboard', '2018-10-15 09:54:44', '2018-10-17 08:37:44', '2018-10-17 08:37:44'),
(36, 28, 'Part', 'part', NULL, 31, 1, 'dashboard', '2018-10-15 09:55:09', '2018-11-06 20:48:21', NULL),
(37, 28, 'System', 'system', NULL, 37, 1, 'dashboard', '2018-10-16 08:21:44', '2018-11-06 20:48:21', NULL),
(38, 28, 'Catalog', 'catalog', NULL, 33, 1, 'dashboard', '2018-10-17 08:38:09', '2018-11-06 20:48:21', NULL),
(39, 28, 'User', 'user', 'mdi mdi-account', 35, 1, 'pengguna', '2018-10-18 04:25:00', '2018-11-06 20:48:21', NULL),
(40, 24, 'Upload Budget', 'budgetplanning', 'glyphicon glyphicon-upload', 7, 1, 'dashboard', '2018-10-18 11:38:09', '2018-10-29 11:41:55', NULL),
(41, 24, 'Upload Master Price Catalog', 'price_catalogue', 'glyphicon glyphicon-upload', 17, 1, 'dashboard', '2018-10-18 12:22:25', '2018-11-05 12:19:10', NULL),
(42, 24, 'Upload BOM Semi FInish Goods', 'bom_semi', NULL, 11, 1, 'dashboard', '2018-10-18 12:23:39', '2018-10-18 12:23:50', NULL),
(43, 24, 'Output Master', 'output_master', NULL, 15, 1, 'dashboard', '2018-11-05 12:18:51', '2018-11-05 12:19:49', NULL),
(44, 28, 'Section', 'section', NULL, 25, 1, 'dashboard', '2018-11-06 20:48:14', '2018-11-06 20:48:21', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2018_10_15_013214_create_menus_table', 1),
(9, '2018_10_15_021525_create_boms_table', 1),
(10, '2018_10_15_030253_entrust_setup_tables', 1),
(11, '2018_10_15_032226_create_group_locations_table', 1),
(12, '2018_10_15_032350_create_login_histories_table', 1),
(13, '2018_10_15_034202_create_types_table', 1),
(14, '2018_10_15_040233_create_user_datas_table', 1),
(15, '2018_10_15_045420_create_settings_table', 1),
(16, '2018_10_15_061625_create_helps_table', 1),
(17, '2018_10_15_061929_create_faqs_table', 1),
(23, '2018_10_16_135407_create_customers_table', 6),
(24, '2018_10_17_054955_create_systems_table', 7),
(26, '2018_10_17_064820_create_suppliers_table', 8),
(27, '2018_10_17_082608_create_plants_table', 9),
(32, '2014_10_12_000000_create_users_table', 11),
(33, '2018_10_16_045846_create_master_prices_table', 12),
(34, '2018_10_16_074700_create_budget_plannings_table', 12),
(35, '2018_10_16_090615_create_bom_datas_table', 12),
(36, '2018_10_24_050601_create_temporary_master_prices_table', 12),
(37, '2018_10_24_050617_create_temporary_budgets_table', 12),
(38, '2018_10_25_034505_create_sales_datas_table', 12),
(39, '2018_10_29_035155_create_master_price_catalogs_table', 12),
(40, '2018_10_30_011938_temporary_master_price_catalog', 12),
(41, '2018_10_30_012403_temporary_sales_data', 12),
(42, '2018_10_31_042413_create_bom_semis_table', 12),
(43, '2018_10_31_042424_create_bom_semi_datas_table', 12),
(44, '2018_10_31_065642_create_temporary_bom_semis_table', 12),
(45, '2018_10_31_065702_create_temporary_bom_semi_datas_table', 12),
(46, '2018_11_01_012427_create_temporary_boms_table', 12),
(47, '2018_11_01_012444_create_temporary_bom_datas_table', 12),
(49, '2018_11_07_042209_create_sections_table', 14),
(50, '2018_10_16_070240_create_divisions_tables', 15),
(52, '2018_10_16_080743_create_departments_table', 16),
(53, '2018_10_18_053903_create_parts_table', 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `parts`
--

CREATE TABLE `parts` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plant` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_part` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_fg` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assy_part` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_material` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `parts`
--

INSERT INTO `parts` (`id`, `part_number`, `part_name`, `uom`, `plant`, `category_part`, `product_code`, `category_fg`, `assy_part`, `group_material`, `created_at`, `updated_at`) VALUES
(1, '423176-10200', 'BELLCRANK,FR DOOR OUTSIDE HANDLE,LH', 'PC', 'BODY', 'Component', 'HD', 'HANDLE (NORMAL)', 'Handle', 'Ingot Material', '2018-11-06 22:49:33', '2018-11-06 22:49:33'),
(2, '423176-10200', 'BELLCRANK,FR DOOR OUTSIDE HANDLE,LH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(3, '423176-10450', 'BELLCRANK,FR DOOR OUTSIDE HANDLE,LH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(4, '423176-10610', 'BELLCRANK,FR DOOR OUTSIDE HANDLE,LH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(5, '423177-10240', 'BELLCRANK,RR DOOR OUTSIDE HANDLE,RH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(6, '423177-10520', 'BELLCRANK, RR DOOR OUTSIDE HANDLE, RH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(7, '423177-10540', 'BELLCRANK,RR DOOR OUTSIDE HANDLE,RH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(8, '423177-10580', 'BELLCRANK,RR DOOR OUTSIDE HANDLE,RH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(9, '423178-10220', 'BELLCRANK,RR DOOR OUTSIDE HANDLE,LH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(10, '423178-10520', 'BELLCRANK, RR DOOR OUTSIDE HANDLE, LH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(11, '423178-10540', 'BELLCRANK,RR DOOR OUTSIDE HANDLE,LH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(12, '423178-10580', 'BELLCRANK,RR DOOR OUTSIDE HANDLE,LH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(13, '423323-10200', 'ROD, RR DOOR LOCK OPEN,RH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(14, '423324-10200', 'ROD, RR DOOR LOCK OPEN,LH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(15, '423176-10620', 'BELLCRANK, FR DOOR OUTSIDE HANDLE, LH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(16, '423177-10700', 'BELLCRANK,RR DOOR OUTSIDE HANDLE,RH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(17, '423178-10700', 'BELLCRANK,RR DOOR OUTSIDE HANDLE,LH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(18, '412150-10660', 'ACTUATOR ASSY,SLIDE DOOR LOCK,RH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(19, '412160-10840', 'ACTUATOR ASSY,SLIDE DOOR LOCK,LH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(20, '413107-10150', 'BASE SUB-ASSY, SLIDE DOOR LOCK, FR RH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(21, '413108-10240', 'BASE SUB-ASSY, SLIDE DOOR LOCK, FR LH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(22, '413113-10170', 'BASE, SLIDE DOOR LOCK FR LOCK OUT, RH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:29', '2018-11-06 23:47:29'),
(23, '413114-10210', 'BASE, SLIDE DOOR LOCK FR LOCK OUT, LH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(24, '414513-10140', 'PLATE, SLIDE DOOR CLOSER BASE, RH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(25, '414514-10170', 'PLATE, SLIDE DOOR CLOSER BASE, LH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(26, '414515-10090', 'PLATE, SLIDE DOOR CLOSER BASE SUB, RH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(27, '414516-10110', 'PLATE, SLIDE DOOR CLOSER BASE SUB, LH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(28, '416111-13180', 'LINK,DOOR LOCK REMOTE CONTROL,RH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(29, '416112-12610', 'LINK,DOOR LOCK REMOTE CONTROL,LH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(30, '416113-10240', 'LINK,DOOR LOCK REMOTE CONTROL,NO.2,RH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(31, '416114-10260', 'LINK,DOOR LOCK REMOTE CONTROL,NO.2,LH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(32, '416413-10490', 'BASE,SLD DR LOCK REMOTE CONTROL,RR,RH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(33, '416414-10570', 'BASE,SLD DR LOCK REMOTE CONTROL,RR,LH', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(34, '423175-10620', 'BELLCRANK, FR DOOR OUTSIDE HANDLE, RH', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(35, '423196-10220', 'SCREW, DOOR OUTSIDE HANDLE', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(36, '424195-10040', 'SCREW, DOOR HANDLE', 'PC', 'BODY', 'Component', 'HD', 'COMPONENT', 'HANDLE', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(37, '91511-40608', 'BOLT, FLANGE', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(38, '213291-18080', 'BOLT, FLANGE', 'PC', 'UNIT', 'Component', 'TCC', 'COMPONENT', 'TCC', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(39, '223199-10090', 'SCREW', 'PC', 'UNIT', 'Component', 'TCC', 'COMPONENT', 'TCC', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(40, '213231-99280', 'GASKET, WATER PUMP', 'PC', 'UNIT', 'Component', 'TCC', 'COMPONENT', 'TCC', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(41, '426168-10160', 'BAG,POWER SLIDE DOOR CABLE', 'PC', 'BODY', 'Component', 'PSD', 'COMPONENT', 'PSD', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(42, '455167-15990', 'SEAL, DOOR FRAME MOULDING (CAULKING SPONGE 2)', 'PC', 'BODY', 'Component', 'CPG', 'COMPONENT', 'CPG', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(43, '455167-16010', 'SEAL, DOOR FRAME MOULDING (CAULKING SPONGE 1)', 'PC', 'BODY', 'Component', 'CPG', 'COMPONENT', 'CPG', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(44, '455167-16020', 'SEAL, DOOR FRAME MOULDING (CAULKING SPONGE 3)', 'PC', 'BODY', 'Component', 'CPG', 'COMPONENT', 'CPG', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(45, '455167-16030', 'SEAL, DOOR FRAME MOULDING (CAULKING SPONGE 4-1/2)', 'PC', 'BODY', 'Component', 'CPG', 'COMPONENT', 'CPG', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(46, '455167-16460', 'SEAL, DOOR FRAME MOULDING (CAULKING SPONGE 5)', 'PC', 'BODY', 'Component', 'CPG', 'COMPONENT', 'CPG', 'LOCAL PART', '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(47, '69203-0K070', 'FRAME SUB-ASSY, RR DOOR OUTSIDE HANDLE, RH', 'PC', 'BODY', 'Product', 'HD', 'FRAME', 'HANDLE', NULL, '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(48, '69204-0K070', 'FRAME SUB-ASSY, RR DOOR OUTSIDE HANDLE, LH', 'PC', 'BODY', 'Product', 'HD', 'FRAME', 'HANDLE', NULL, '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(49, '69210-0K090', 'HANDLE ASSY,ELECTRICAL KEY,ANTENNA(PLATING SMART)', 'PC', 'BODY', 'Product', 'HD', 'HANDLE (SMART)', 'HANDLE', NULL, '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(50, '69210-0K320', 'HANDLE ASSY,FR DOOR OUTSIDE(COLOR NORMAL)', 'PC', 'BODY', 'Product', 'HD', 'HANDLE (NORMAL)', 'HANDLE', NULL, '2018-11-06 23:47:30', '2018-11-06 23:47:30'),
(51, '69210-0K130', 'HANDLE ASSY,FR DOOR OUTSIDE(PLATING NORMAL)', 'PC', 'BODY', 'Product', 'HD', 'HANDLE (NORMAL)', 'HANDLE', NULL, '2018-11-06 23:47:30', '2018-11-06 23:47:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('syechrugotama@gmail.com', '$2y$10$/a4xwBjD.HZe3N7e7bKNxekd/1QqcfrfDP46fG6RL/KI/meWvBT6e', '2018-10-15 19:04:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `parent_id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(4, 0, 'dashboard', 'Dashboard', NULL, '2018-10-11 05:45:34', '2018-10-11 05:45:34'),
(5, 0, 'pengguna', 'Pengguna', NULL, '2018-10-11 05:46:20', '2018-10-11 05:46:20'),
(11, 0, 'bantuan', 'Bantuan', NULL, '2018-10-11 05:47:21', '2018-10-11 05:47:21'),
(13, 0, 'menu', 'Menu', NULL, '2018-10-11 05:47:41', '2018-10-11 05:47:41'),
(14, 0, 'pengaturan', 'Pengaturan', NULL, '2018-10-11 05:47:51', '2018-10-11 05:47:51'),
(15, 0, 'peran', 'Peran', NULL, '2018-10-11 05:47:58', '2018-10-11 05:47:58'),
(16, 0, 'izin-hak', 'Izin Hak', NULL, '2018-10-11 05:48:05', '2018-10-11 05:48:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(4, 2),
(5, 2),
(11, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'Admin', NULL, '2018-10-15 01:19:29', '2018-10-15 01:19:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales_datas`
--

CREATE TABLE `sales_datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fiscal_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `market` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jan_qty` int(11) NOT NULL DEFAULT '0',
  `jan_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `feb_qty` int(11) NOT NULL DEFAULT '0',
  `feb_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `mar_qty` int(11) NOT NULL DEFAULT '0',
  `mar_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `apr_qty` int(11) NOT NULL DEFAULT '0',
  `apr_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `may_qty` int(11) NOT NULL DEFAULT '0',
  `may_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `june_qty` int(11) NOT NULL DEFAULT '0',
  `june_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `july_qty` int(11) NOT NULL DEFAULT '0',
  `july_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `august_qty` int(11) NOT NULL DEFAULT '0',
  `august_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `sep_qty` int(11) NOT NULL DEFAULT '0',
  `sep_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `okt_qty` int(11) NOT NULL DEFAULT '0',
  `okt_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `nov_qty` int(11) NOT NULL DEFAULT '0',
  `nov_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `des_qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `des_amount` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sections`
--

INSERT INTO `sections` (`id`, `section_code`, `section_name`, `department_id`, `created_at`, `updated_at`) VALUES
(3, 'HG1', 'PERSONAL ADMIN', '1', '2018-11-06 22:26:55', '2018-11-06 22:26:55'),
(4, 'HG2', 'TRAINING & PD', '1', '2018-11-06 22:28:08', '2018-11-06 22:28:08'),
(5, 'HG3', 'RECRUITMENT & OD', '1', '2018-11-06 22:28:27', '2018-11-06 22:28:27'),
(6, 'HG4', 'GA', '1', '2018-11-06 22:28:42', '2018-11-06 22:28:42'),
(7, 'HG5', 'SECRETARY', '1', '2018-11-06 22:28:56', '2018-11-06 22:28:56'),
(8, 'IR1', 'IR', '2', '2018-11-06 22:29:15', '2018-11-06 22:31:33'),
(9, 'IR2', 'LEGAL', '2', '2018-11-06 22:31:47', '2018-11-06 22:31:47'),
(10, 'MKT1', 'MARKETING', '3', '2018-11-06 22:32:04', '2018-11-06 22:32:04'),
(11, 'FA1', 'COST CONTROL', '4', '2018-11-06 22:33:32', '2018-11-06 22:33:32'),
(12, 'FA2', 'CORPORATE PLANNING', '4', '2018-11-06 22:33:49', '2018-11-06 22:33:49'),
(13, 'FA3', 'FINANCE', '4', '2018-11-06 22:34:06', '2018-11-06 22:34:06'),
(14, 'FA4', 'ACCOUNTING', '4', '2018-11-06 22:34:22', '2018-11-06 22:34:22'),
(15, 'PC1', 'GENERAL PURCHASE', '5', '2018-11-06 22:34:38', '2018-11-06 22:34:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_pic_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_pic_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_pic_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_code`, `supplier_name`, `supplier_address`, `supplier_phone`, `supplier_email`, `supplier_website`, `supplier_pic_name`, `supplier_pic_phone`, `supplier_pic_email`, `created_at`, `updated_at`) VALUES
(1, 'SC001', 'AISIN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-17 00:33:19', '2018-10-17 00:33:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `systems`
--

CREATE TABLE `systems` (
  `id` int(10) UNSIGNED NOT NULL,
  `system_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `system_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `system_val` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `systems`
--

INSERT INTO `systems` (`id`, `system_type`, `system_code`, `system_val`, `created_at`, `updated_at`) VALUES
(1, 'config_other', 'dir_key', 'ADMIN;PLANT', '2018-10-16 23:43:36', '2018-11-06 22:11:26'),
(3, 'config_other', 'category_part', 'Product;Component;Raw Material', '2018-10-17 02:42:02', '2018-11-06 22:38:26'),
(5, 'config_other', 'plant', 'BODY;UNIT', '2018-10-17 20:38:25', '2018-10-18 00:22:52'),
(6, 'config_multiply', 'product_code', 'HD,Door Handle;SM,Power Seat;CPG,Moulding;PSD,Power Slide Door;O/P,Oil Pump;W/P,Water Pump;CSH,Housing;OPN,Oil Pan;TCC,T C C', '2018-10-17 21:11:51', '2018-10-18 00:14:21'),
(7, 'config_other', 'category_fg', 'COMPONENT;HANDLE (NORMAL);FRAME;CAP;HANDLE (SMART);Normal;Smart', '2018-10-17 21:21:47', '2018-10-18 00:14:41'),
(8, 'config_multiply', 'market_code', 'GNP,GNP;OE,OE', '2018-10-17 21:23:06', '2018-10-18 00:16:06'),
(9, 'config_other', 'kind_of_part', 'Component;Raw Material', '2018-10-17 21:24:50', '2018-10-18 00:15:12'),
(10, 'config_other', 'assy_part', 'HANDLE;PSD;TCC;OPN;CSH;CPG;SEAT MOTOR;OIL PAN', '2018-10-17 21:27:16', '2018-11-06 23:24:55'),
(11, 'config_other', 'source', 'CKD;Import;Local (Indonesia);Raw Material Local (Indonesia)', '2018-10-17 21:31:11', '2018-10-18 00:15:50'),
(12, 'config_other', 'group_material', 'PLASTIC MATERIAL;INGOT MATERIAL;CKD;CKD IMPORT DUTY; IMPORT PART;IMPORT PART IMPORT DUTY;INKLARING CKD;INKLARING IMPORT PART;LOCAL PART', '2018-10-17 21:35:16', '2018-11-06 23:36:44'),
(14, 'config_multiply', 'uom', 'PC,Piece;KG,Kilo Gram;CAR,Cartoon;PAA,Pair', '2018-10-18 00:19:47', '2018-10-18 00:19:47'),
(15, 'config_multiply', 'status', '0,Non Active;1,Active', '2018-10-18 23:23:00', '2018-10-18 23:23:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `temporary_boms`
--

CREATE TABLE `temporary_boms` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temporary_bom_datas`
--

CREATE TABLE `temporary_bom_datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `temporary_bom_id` int(11) DEFAULT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temporary_bom_semis`
--

CREATE TABLE `temporary_bom_semis` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temporary_bom_semi_datas`
--

CREATE TABLE `temporary_bom_semi_datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `temporary_bom_semi_id` int(11) NOT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temporary_budgets`
--

CREATE TABLE `temporary_budgets` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fiscal_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `market` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jan_qty` int(11) NOT NULL DEFAULT '0',
  `jan_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `feb_qty` int(11) NOT NULL DEFAULT '0',
  `feb_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `mar_qty` int(11) NOT NULL DEFAULT '0',
  `mar_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `apr_qty` int(11) NOT NULL DEFAULT '0',
  `apr_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `may_qty` int(11) NOT NULL DEFAULT '0',
  `may_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `june_qty` int(11) NOT NULL DEFAULT '0',
  `june_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `july_qty` int(11) NOT NULL DEFAULT '0',
  `july_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `august_qty` int(11) NOT NULL DEFAULT '0',
  `august_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `sep_qty` int(11) NOT NULL DEFAULT '0',
  `sep_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `okt_qty` int(11) NOT NULL DEFAULT '0',
  `okt_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `nov_qty` int(11) NOT NULL DEFAULT '0',
  `nov_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `des_qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `des_amount` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temporary_master_prices`
--

CREATE TABLE `temporary_master_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(25,2) NOT NULL,
  `supplier_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temporary_master_price_catalogs`
--

CREATE TABLE `temporary_master_price_catalogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(25,2) NOT NULL,
  `supplier_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temporary_sales_datas`
--

CREATE TABLE `temporary_sales_datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fiscal_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `market` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jan_qty` int(11) NOT NULL DEFAULT '0',
  `jan_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `feb_qty` int(11) NOT NULL DEFAULT '0',
  `feb_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `mar_qty` int(11) NOT NULL DEFAULT '0',
  `mar_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `apr_qty` int(11) NOT NULL DEFAULT '0',
  `apr_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `may_qty` int(11) NOT NULL DEFAULT '0',
  `may_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `june_qty` int(11) NOT NULL DEFAULT '0',
  `june_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `july_qty` int(11) NOT NULL DEFAULT '0',
  `july_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `august_qty` int(11) NOT NULL DEFAULT '0',
  `august_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `sep_qty` int(11) NOT NULL DEFAULT '0',
  `sep_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `okt_qty` int(11) NOT NULL DEFAULT '0',
  `okt_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `nov_qty` int(11) NOT NULL DEFAULT '0',
  `nov_amount` double(25,2) NOT NULL DEFAULT '0.00',
  `des_qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `des_amount` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sap_cc_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'img/pp.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `direction` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `password`, `sap_cc_code`, `photo`, `remember_token`, `department_id`, `division_id`, `direction`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator@aiia.co.id', 1, '$2y$10$WzDhzmEbVwQoTtDWfsJAVu5odj9MmbOiFEqNr07VvPmv6iGQTJob2', 'ZZ0000', 'img/pp.png', '5PSNRWUaq3wVRwEkxZx6SzJ11Eeqr2lhK6h7y2HnjtlU7DWhWQL2AY8vZKXD', 3, 1, NULL, NULL, NULL),
(2, 'Yulianto S B', 'yulianto.saparudin@arkamaya.co.id', 1, '$2y$10$ChlwH3mFXUkNp132OXwvEeIS2OAIhdXoCxQmkSuaqO0yfs3mSPGNS', 'ASD', '1539918887.jpg', NULL, 1, 3, NULL, '2018-10-18 20:14:47', '2018-10-18 23:20:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_datas`
--

CREATE TABLE `user_datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kk_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leader_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_of_birth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `account_bank_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_saving_book` text COLLATE utf8mb4_unicode_ci,
  `upload_identity_card` text COLLATE utf8mb4_unicode_ci,
  `default_group_location_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_datas`
--

INSERT INTO `user_datas` (`id`, `user_id`, `name`, `identity_number`, `kk_number`, `leader_name`, `phone_number`, `gender`, `place_of_birth`, `date_of_birth`, `address`, `account_bank_number`, `account_bank_name`, `upload_saving_book`, `upload_identity_card`, `default_group_location_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'syechru', NULL, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-15 03:27:08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boms`
--
ALTER TABLE `boms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bom_datas`
--
ALTER TABLE `bom_datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bom_semis`
--
ALTER TABLE `bom_semis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bom_semi_datas`
--
ALTER TABLE `bom_semi_datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget_plannings`
--
ALTER TABLE `budget_plannings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_locations`
--
ALTER TABLE `group_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `helps`
--
ALTER TABLE `helps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_histories`
--
ALTER TABLE `login_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_prices`
--
ALTER TABLE `master_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_price_catalogs`
--
ALTER TABLE `master_price_catalogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- Indexes for table `sales_datas`
--
ALTER TABLE `sales_datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systems`
--
ALTER TABLE `systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_boms`
--
ALTER TABLE `temporary_boms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_bom_datas`
--
ALTER TABLE `temporary_bom_datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_bom_semis`
--
ALTER TABLE `temporary_bom_semis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_bom_semi_datas`
--
ALTER TABLE `temporary_bom_semi_datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_budgets`
--
ALTER TABLE `temporary_budgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_master_prices`
--
ALTER TABLE `temporary_master_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_master_price_catalogs`
--
ALTER TABLE `temporary_master_price_catalogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_sales_datas`
--
ALTER TABLE `temporary_sales_datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_datas`
--
ALTER TABLE `user_datas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boms`
--
ALTER TABLE `boms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `bom_datas`
--
ALTER TABLE `bom_datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bom_semis`
--
ALTER TABLE `bom_semis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bom_semi_datas`
--
ALTER TABLE `bom_semi_datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `budget_plannings`
--
ALTER TABLE `budget_plannings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `group_locations`
--
ALTER TABLE `group_locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `helps`
--
ALTER TABLE `helps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `login_histories`
--
ALTER TABLE `login_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_prices`
--
ALTER TABLE `master_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_price_catalogs`
--
ALTER TABLE `master_price_catalogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sales_datas`
--
ALTER TABLE `sales_datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `systems`
--
ALTER TABLE `systems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `temporary_boms`
--
ALTER TABLE `temporary_boms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temporary_bom_datas`
--
ALTER TABLE `temporary_bom_datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temporary_bom_semis`
--
ALTER TABLE `temporary_bom_semis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temporary_bom_semi_datas`
--
ALTER TABLE `temporary_bom_semi_datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temporary_budgets`
--
ALTER TABLE `temporary_budgets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temporary_master_prices`
--
ALTER TABLE `temporary_master_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temporary_master_price_catalogs`
--
ALTER TABLE `temporary_master_price_catalogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temporary_sales_datas`
--
ALTER TABLE `temporary_sales_datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_datas`
--
ALTER TABLE `user_datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
