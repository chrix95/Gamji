-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 15, 2021 at 09:42 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamji`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `phone`, `address`, `city`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Prime star Hospital', '09057041663', '23, Dutse Plaza, Opposite Life Camp Hospital.', 'Maitama', 'Abuja', '2020-11-24 12:58:44', '2020-11-24 13:53:14'),
(3, 'Keffi Plant', '08183780409', '6 School road, off Itu road, Uyo', 'Uyo', 'Akwa Ibom', '2020-11-24 20:11:05', '2020-11-24 20:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `project_id`, `amount`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 2300.00, 'Transportation and purchase of cement', '2020-12-05 20:25:00', '2020-12-05 20:25:00'),
(2, 1, 800.00, 'Refund', '2020-12-05 20:38:05', '2020-12-05 20:38:05'),
(3, 1, 200.00, 'Recharge card', '2020-12-05 20:45:08', '2020-12-05 20:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
CREATE TABLE IF NOT EXISTS `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('light','heavy') COLLATE utf8mb4_unicode_ci NOT NULL,
  `plate_number` text COLLATE utf8mb4_unicode_ci,
  `serial_number` text COLLATE utf8mb4_unicode_ci,
  `amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `docs1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs7` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs8` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs9` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs10` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `name`, `type`, `plate_number`, `serial_number`, `amount`, `docs1`, `docs2`, `docs3`, `docs4`, `docs5`, `docs6`, `docs7`, `docs8`, `docs9`, `docs10`, `note`, `branch_id`, `created_at`, `updated_at`) VALUES
(2, 'Spade', 'light', NULL, NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-12-04 20:20:31', '2020-12-04 21:59:42'),
(4, 'Tractor', 'heavy', 'YAB234KU', '12FG9POS91283HJKLL83', '800000.00', 'equipments/upload/1610664993.pdf', 'equipments/upload/1610664917.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Police dey after the tractor', 1, '2021-01-14 21:09:14', '2021-01-14 21:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_logs`
--

DROP TABLE IF EXISTS `inventory_logs`;
CREATE TABLE IF NOT EXISTS `inventory_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `inventories_id` int(11) NOT NULL,
  `type` enum('inflow','outflow') COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_logs`
--

INSERT INTO `inventory_logs` (`id`, `inventories_id`, `type`, `quantity`, `remark`, `created_at`, `updated_at`) VALUES
(1, 2, 'inflow', 23, 'Inflow for Spade', '2020-12-04 20:20:31', '2020-12-04 20:20:31'),
(2, 2, 'inflow', 12, 'Inflow for Spade', '2020-12-04 21:59:42', '2020-12-04 21:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `letters`
--

DROP TABLE IF EXISTS `letters`;
CREATE TABLE IF NOT EXISTS `letters` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sender_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `letters`
--

INSERT INTO `letters` (`id`, `branch_id`, `title`, `file_url`, `description`, `sender_name`, `sender_email`, `sender_phone`, `created_at`, `updated_at`) VALUES
(2, 1, 'SAFETY POLICY', 'letters/upload/safety-policy1610666536.pdf', 'Polisuds dksd ksd sdfbsdf skd fsd', 'Real warri Pikin', 'entgolkova@gmail.com', '08035545777', '2021-01-14 22:22:16', '2021-01-14 22:22:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_22_125536_create_projects_table', 1),
(5, '2020_11_22_125625_create_branches_table', 1),
(6, '2020_11_22_125715_create_roles_table', 1),
(7, '2020_11_22_125725_create_inventories_table', 1),
(8, '2020_11_22_125732_create_stocks_table', 1),
(9, '2020_11_22_125739_create_suppliers_table', 1),
(10, '2020_11_22_125750_create_expenses_table', 1),
(11, '2020_11_22_125802_create_requisitions_table', 1),
(12, '2020_11_22_125814_create_requisition_items_table', 1),
(15, '2020_11_22_125920_create_milestones_table', 2),
(14, '2020_11_22_131328_create_inventory_logs_table', 1),
(20, '2020_12_05_175324_create_letters_table', 3),
(21, '2020_12_05_175535_create_minutes_table', 3),
(22, '2020_12_06_195321_create_notifications_table', 4),
(23, '2020_12_21_082547_create_user_documents_table', 5),
(24, '2020_12_21_212258_create_progress_reports_table', 6),
(25, '2021_01_14_232607_create_permissions_table', 7),
(27, '2021_01_15_125909_create_store_requests_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

DROP TABLE IF EXISTS `milestones`;
CREATE TABLE IF NOT EXISTS `milestones` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expected_end_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('created','ongoing','paused','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'created',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `project_id`, `name`, `description`, `start_date`, `expected_end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Interlocking Flooring', 'This is the international flooring to ensure that the pool is working awesomely', '2020-11-28', '2021-02-26', 'ongoing', '2020-11-28 20:50:02', '2020-11-28 22:03:35'),
(2, '1', 'Roofing sheet', 'Get the latest roof sheet design and complete the building roofing.', '2020-11-12', '2021-05-13', 'completed', '2020-11-28 21:36:34', '2020-11-28 22:10:07'),
(3, '1', 'Destroy the chandelier', 'This mission is critical and requires that you provide all necessary document regarding it', '2020-12-05', '2021-04-23', 'paused', '2020-11-28 22:29:38', '2020-11-28 22:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `minutes`
--

DROP TABLE IF EXISTS `minutes`;
CREATE TABLE IF NOT EXISTS `minutes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_url` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `minutes`
--

INSERT INTO `minutes` (`id`, `branch_id`, `title`, `content`, `file_url`, `created_at`, `updated_at`) VALUES
(1, 3, 'SAFETY POLICY', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'minutes/upload/1607198992.pdf', '2020-12-05 18:36:03', '2020-12-05 19:09:52');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `expected_date` date DEFAULT NULL,
  `status` enum('pending','ongoing','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `content`, `branch_id`, `expected_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SAFETY POLICY', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, NULL, 'pending', '2020-12-06 19:28:32', '2020-12-08 03:18:54'),
(2, 'Dummy Service', 'skdjkf sdkjf skd fks dfs dkf s fsd sdd', 1, '2020-12-30', 'pending', '2020-12-08 03:21:39', '2020-12-08 03:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `code`, `created_at`, `updated_at`) VALUES
(1, 'View Project', 'project_view', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(2, 'Create Project', 'project_create', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(3, 'Edit Project', 'project_edit', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(4, 'Delete Project', 'project_delete', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(5, 'Add Project Milestone', 'project_add_milestone', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(6, 'Add Project Expenses', 'project_expenses', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(7, 'View Equipments', 'store_view', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(8, 'Add Equipment', 'store_create', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(9, 'Update Equipment', 'store_edit', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(10, 'Delete Equipment', 'store_delete', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(11, 'Store Request', 'store_request', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(12, 'View Suppliers', 'supplier_view', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(13, 'Create Supplier', 'supplier_create', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(14, 'Update Supplier', 'supplier_edit', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(15, 'Delete Supplier', 'supplier_delete', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(16, 'View Employee', 'employee_view', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(17, 'Create Employee', 'employee_create', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(18, 'Update Employee', 'employee_edit', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(19, 'Delete Employee', 'employee_delete', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(20, 'View Report', 'progress_view', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(21, 'Upload Report', 'progress_create', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(22, 'Delete Report', 'progress_delete', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(23, 'View Letters', 'letter_view', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(24, 'Upload Letters', 'letter_create', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(25, 'Delete Letters', 'letter_delete', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(26, 'View Minutes', 'minute_view', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(27, 'Update Minutes', 'minute_edit', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(28, 'Upload Minutes', 'minute_create', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(29, 'Delete Minutes', 'minute_delete', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(30, 'View Notification', 'notification_view', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(31, 'Update Notification', 'notification_edit', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(32, 'Upload Notification', 'notification_create', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(33, 'Delete Notification', 'notification_delete', '2021-01-14 22:27:23', '2021-01-14 22:27:23'),
(34, 'Approve/Reject Store Request', 'store_approval', '2021-01-15 21:02:47', '2021-01-15 21:02:47'),
(35, 'Delete Store Request', 'store_request_delete', '2021-01-15 21:02:47', '2021-01-15 21:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `progress_reports`
--

DROP TABLE IF EXISTS `progress_reports`;
CREATE TABLE IF NOT EXISTS `progress_reports` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `docs` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `progress_reports`
--

INSERT INTO `progress_reports` (`id`, `project_id`, `title`, `description`, `docs`, `created_at`, `updated_at`) VALUES
(1, 2, 'SAFETY POLICY', 'police revamp coming soon.....', 'reports/upload/safety-policy1608588000.pdf', '2020-12-21 21:00:00', '2020-12-21 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `project_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expected_end_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_cost` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('created','ongoing','paused','completed','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'created',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `branch_id`, `project_code`, `project_name`, `start_date`, `expected_end_date`, `client_name`, `client_phone`, `estimated_cost`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'PRG-8928389238', 'Ginuew Biseau', '2020-11-28', '2020-11-29', 'Mr. Desmond Uto', '09023849093', '3495000', 'ongoing', '2020-11-28 18:00:43', '2020-11-28 22:35:39'),
(2, 1, 'PRG-8928389290', 'Police Revamp', '2020-12-31', '2021-05-31', 'IGP of Police', '09023849093', '24500000', 'created', '2020-12-08 03:35:05', '2020-12-08 03:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

DROP TABLE IF EXISTS `requisitions`;
CREATE TABLE IF NOT EXISTS `requisitions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `requisition_items_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requisition_items`
--

DROP TABLE IF EXISTS `requisition_items`;
CREATE TABLE IF NOT EXISTS `requisition_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `requisition_id` int(11) NOT NULL,
  `inventories_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `inventory_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `inventory_id`, `supplier_id`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 23, 24000.00, '2020-12-04 20:20:31', '2020-12-04 20:20:31'),
(2, 2, 1, 12, 967990.00, '2020-12-04 21:59:42', '2020-12-04 21:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `store_requests`
--

DROP TABLE IF EXISTS `store_requests`;
CREATE TABLE IF NOT EXISTS `store_requests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `approval_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_form` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `machines` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_request_form` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reject_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','rejected','approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_requests`
--

INSERT INTO `store_requests` (`id`, `user_id`, `branch_id`, `approval_date`, `request_form`, `machines`, `approved_request_form`, `approved_by`, `reject_reason`, `status`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-01-15 21:39:28', 'equipments/request/1610723472.pdf', '[\"Tractor|12FG9POS91283HJKLL83\"]', 'equipments/request/1610746768.pdf', 'Gamji Administrator', NULL, 'approved', 'The purpose is necessary for approval', '2021-01-15 14:11:12', '2021-01-15 20:39:28'),
(2, 1, 1, '2021-01-15 21:40:52', 'equipments/request/1610746819.pdf', '[\"Tractor|12FG9POS91283HJKLL83\"]', 'equipments/request/1610746852.pdf', 'Gamji Administrator', 'This has been done earlier why is it still coming again?', 'rejected', 'This has been done earlier why is it still coming again?', '2021-01-15 20:40:19', '2021-01-15 20:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'EG Superwash Ltd', 'Falala plaza. 3rd Avenue Gwarinpa', '08077068954', 'ehiali00@gmail.com', '2020-12-04 19:10:59', '2020-12-04 19:11:24'),
(2, 'Chinemere & Daughters', '14 Ademola Tunko Street, Off Lekki Phase II Roundabout', '09057041663', 'info@chinyconcept.com', '2020-12-04 19:14:04', '2020-12-04 19:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `guarantor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guarantor_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guarantor_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `next_of_kin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `next_of_kin_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `means_of_identification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_letter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `employee_code` (`employee_code`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `dob`, `employee_code`, `branch_id`, `email_verified_at`, `password`, `role`, `guarantor_name`, `guarantor_phone`, `guarantor_address`, `next_of_kin_name`, `next_of_kin_phone`, `means_of_identification`, `employment_letter`, `permission`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Gamji Administrator', 'admin@admin.com', '081837880409', 'Dove court garden estate, Utako, Abuja FCT', '1995-09-05', 'GAM-U982002', NULL, NULL, '$2y$10$6FPbw2c9sTukUlKdRA6KAu.L.ah/aTrGZTZSkziKuD43RV2g6Jpiy', 2, 'Dubem Ifeanyi', '09057041663', 'Utako Abuja FCT', 'David Nwokwocha', '09057041663', NULL, NULL, '[\"project_view\",\"project_create\",\"project_edit\",\"project_delete\",\"project_add_milestone\",\"project_expenses\",\"store_view\",\"store_create\",\"store_edit\",\"store_delete\",\"store_request\",\"supplier_view\",\"supplier_create\",\"supplier_edit\",\"supplier_delete\",\"employee_view\",\"employee_create\",\"employee_edit\",\"employee_delete\",\"progress_view\",\"progress_create\",\"progress_delete\",\"letter_view\",\"letter_create\",\"letter_delete\",\"minute_view\",\"minute_edit\",\"minute_create\",\"minute_delete\",\"notification_view\",\"notification_edit\",\"notification_create\",\"notification_delete\",\"store_approval\",\"store_request_delete\"]', NULL, '2020-11-22 14:00:14', '2021-01-15 20:26:56'),
(2, 'Christopher Okokon Ntuk', 'engchris95@gmail.com', '08183780409', 'Donatus street, Off RCC Road, Benin-Agbor Road', '11/24/2020', 'GAM-6728893', 1, NULL, '$2y$10$.k/1Bjbv8SNqHodZxAKgMe1bzEQ3urKolOtb40xjbDl3c5F48aJM2', 0, 'Dubem Ifeanyi', '09057041663', 'Utako Abuja FCT', 'David Nwokwocha', '09057041663', NULL, NULL, '[\"project_view\",\"project_create\",\"project_edit\",\"project_delete\",\"project_add_milestone\",\"project_expenses\",\"store_view\",\"store_create\",\"store_edit\",\"store_delete\",\"store_request\",\"supplier_view\",\"supplier_create\",\"supplier_edit\",\"supplier_delete\",\"employee_view\",\"employee_create\",\"employee_edit\",\"employee_delete\",\"progress_view\",\"progress_create\",\"progress_delete\",\"letter_view\",\"letter_create\",\"letter_delete\",\"minute_view\",\"minute_edit\",\"minute_create\",\"minute_delete\",\"notification_view\",\"notification_edit\",\"notification_create\",\"notification_delete\"]', NULL, '2020-11-24 14:40:22', '2020-11-24 19:11:14'),
(7, 'Christopher Okokon Ntuk', 'engchris94@gmail.com', '08183780407', '6 School road, off Itu road, Uyo\r\nDonatus street, Off RCC Road, Benin-Agbor Road, Benin City, Edo State', '2021-01-14', 'GAM-6728899', 1, NULL, '$2y$10$hHIPdYQKT7Tg0p4aogcQgeyVfJgt3N9d3vSHasqxH9bh0d2iuNdAu', 0, 'Wilson Emmanuel', '08183780409', 'CAD Zone Plot C5, Dawaki District, Bwari Area Council, Abuja FCT.', 'David Ajao', '09082898833', 'idcards/upload/wilson-emmanuel1610704975.pdf', 'employment_docs/upload/christopher-okokon-ntuk1610704975.pdf', '[\"project_view\",\"store_view\",\"supplier_view\",\"employee_view\",\"progress_view\",\"letter_view\",\"minute_view\",\"notification_view\"]', NULL, '2021-01-15 09:02:55', '2021-01-15 09:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_documents`
--

DROP TABLE IF EXISTS `user_documents`;
CREATE TABLE IF NOT EXISTS `user_documents` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `docs` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_documents`
--

INSERT INTO `user_documents` (`id`, `user_id`, `title`, `docs`, `created_at`, `updated_at`) VALUES
(1, 5, 'SAFETY POLICY', 'employment_docs/upload/safety-policy1608551937.pdf', '2020-12-21 10:58:57', '2020-12-21 10:58:57');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
