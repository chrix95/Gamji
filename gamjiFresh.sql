-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 15, 2021 at 10:01 PM
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'View Project', 'project_view', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(2, 'Create Project', 'project_create', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(3, 'Edit Project', 'project_edit', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(4, 'Delete Project', 'project_delete', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(5, 'Add Project Milestone', 'project_add_milestone', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(6, 'Add Project Expenses', 'project_expenses', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(7, 'View Equipments', 'store_view', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(8, 'Add Equipment', 'store_create', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(9, 'Update Equipment', 'store_edit', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(10, 'Delete Equipment', 'store_delete', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(11, 'Store Request', 'store_request', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(12, 'Approve/Reject Store Request', 'store_approval', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(13, 'Delete Store Request', 'store_request_delete', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(14, 'View Suppliers', 'supplier_view', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(15, 'Create Supplier', 'supplier_create', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(16, 'Update Supplier', 'supplier_edit', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(17, 'Delete Supplier', 'supplier_delete', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(18, 'View Employee', 'employee_view', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(19, 'Create Employee', 'employee_create', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(20, 'Update Employee', 'employee_edit', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(21, 'Delete Employee', 'employee_delete', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(22, 'View Report', 'progress_view', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(23, 'Upload Report', 'progress_create', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(24, 'Delete Report', 'progress_delete', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(25, 'View Letters', 'letter_view', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(26, 'Upload Letters', 'letter_create', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(27, 'Delete Letters', 'letter_delete', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(28, 'View Minutes', 'minute_view', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(29, 'Update Minutes', 'minute_edit', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(30, 'Upload Minutes', 'minute_create', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(31, 'Delete Minutes', 'minute_delete', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(32, 'View Notification', 'notification_view', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(33, 'Update Notification', 'notification_edit', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(34, 'Upload Notification', 'notification_create', '2021-01-15 20:48:38', '2021-01-15 20:48:38'),
(35, 'Delete Notification', 'notification_delete', '2021-01-15 20:48:38', '2021-01-15 20:48:38');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Gamji Administrator', 'admin@admin.com', '08183780409', 'Dove court garden estate, Utako, Abuja FCT', '1995-09-05', 'GAM-U982002', NULL, NULL, '$2y$10$6FPbw2c9sTukUlKdRA6KAu.L.ah/aTrGZTZSkziKuD43RV2g6Jpiy', 2, 'Dubem Ifeanyi', '09057041663', 'Utako Abuja FCT', 'David Nwokwocha', '09057041663', NULL, NULL, '[\"project_view\",\"project_create\",\"project_edit\",\"project_delete\",\"project_add_milestone\",\"project_expenses\",\"store_view\",\"store_create\",\"store_edit\",\"store_delete\",\"store_request\",\"supplier_view\",\"supplier_create\",\"supplier_edit\",\"supplier_delete\",\"employee_view\",\"employee_create\",\"employee_edit\",\"employee_delete\",\"progress_view\",\"progress_create\",\"progress_delete\",\"letter_view\",\"letter_create\",\"letter_delete\",\"minute_view\",\"minute_edit\",\"minute_create\",\"minute_delete\",\"notification_view\",\"notification_edit\",\"notification_create\",\"notification_delete\",\"store_approval\",\"store_request_delete\"]', NULL, '2020-11-22 14:00:14', '2021-01-15 20:45:30');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
