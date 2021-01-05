-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2020 at 03:55 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yayasankematian`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2020_10_16_105436_create_sessions_table', 1),
(7, '2020_10_16_134514_create_table_user_access', 1),
(8, '2020_10_17_073954_add_column_users', 1),
(9, '2020_10_17_150914_add_column_telepon_table_users', 1),
(10, '2020_10_26_143201_create_table_settings', 1),
(11, '2020_11_17_093434_create_table_customer', 2),
(12, '2020_11_17_133745_create_table_projects', 3),
(13, '2020_11_18_084209_create_table_vedors', 4),
(14, '2020_11_18_092403_add_column_vendor1', 5),
(15, '2020_11_20_064639_create_table_modules', 6),
(16, '2020_11_21_061517_add_column_modules_items', 7),
(17, '2020_11_22_045652_add_column_modules_item_parent_id', 8),
(18, '2020_11_24_155017_create_table_coa_group', 9),
(19, '2020_11_25_023925_create_table_journal', 10),
(20, '2020_11_25_045441_create_table_bank_account', 11);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'HRD', NULL, '2020-11-20 00:08:23', '2020-11-20 00:08:23'),
(2, 'Procurement', NULL, '2020-11-20 00:09:09', '2020-11-20 00:09:09'),
(3, 'Finance', NULL, '2020-11-20 00:09:17', '2020-11-20 00:09:17'),
(4, 'Accounting', NULL, '2020-11-20 00:09:24', '2020-11-20 00:09:24'),
(5, 'Sales', NULL, '2020-11-20 00:09:41', '2020-11-20 00:09:41'),
(6, 'Project Management', NULL, '2020-11-20 00:10:12', '2020-11-20 00:10:12'),
(7, 'Inventory', NULL, '2020-11-20 00:10:19', '2020-11-20 00:10:19'),
(8, 'Logistik', NULL, '2020-11-20 00:10:26', '2020-11-20 00:10:26'),
(9, 'Administrator', NULL, '2020-11-20 23:06:52', '2020-11-20 23:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `modules_items`
--

CREATE TABLE `modules_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` smallint(6) DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules_items`
--

INSERT INTO `modules_items` (`id`, `module_id`, `name`, `link`, `status`, `created_at`, `updated_at`, `type`, `icon`, `parent_id`) VALUES
(37, 1, 'Employee', 'employee/index', 1, '2020-11-20 20:30:45', '2020-11-20 20:30:45', 0, '', NULL),
(38, 1, 'Leave', 'leave/index', 1, '2020-11-20 20:31:16', '2020-11-20 20:31:16', 0, '', NULL),
(39, 1, 'Attendance', 'attendance/index', 1, '2020-11-20 20:31:31', '2020-11-20 20:31:31', 0, '', NULL),
(40, 1, 'Medical Reimbursment', 'medial-reimbursment/index', 1, '2020-11-20 20:31:53', '2020-11-20 20:31:53', 0, '', NULL),
(41, 1, 'Payment Request', 'payment-request/index', 1, '2020-11-20 20:32:11', '2020-11-20 20:32:11', 0, '', NULL),
(42, 1, 'Training and Business Trip', 'training-and-business-trip/index', 1, '2020-11-20 20:32:36', '2020-11-20 20:32:36', 0, '', NULL),
(43, 1, 'Overtime', 'overtime/index', 1, '2020-11-20 20:32:47', '2020-11-20 20:32:47', 0, '', NULL),
(44, 1, 'Payroll, PPH 21', 'payroll-pph-21/index', 1, '2020-11-20 20:33:13', '2020-11-20 20:33:13', 0, '', NULL),
(49, 9, 'Setting', 'setting', 1, '2020-11-20 23:26:28', '2020-11-20 23:26:28', 1, 'icon-settings', NULL),
(50, 9, 'All Users', 'user/index', 1, '2020-11-20 23:26:50', '2020-11-20 23:26:50', 1, 'icon-users', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `background_of_opportunity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_value` int(11) DEFAULT NULL,
  `date_receiving_info` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `rfi_file` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `customer_id`, `background_of_opportunity`, `contract_value`, `date_receiving_info`, `status`, `rfi_file`, `created_at`, `updated_at`) VALUES
(1, 2, 'Fiber', 100000000, '2020-11-16', NULL, NULL, '2020-11-17 21:23:28', '2020-11-17 21:23:28'),
(2, 1, 'Rollout', 200000000, '2020-01-01', NULL, NULL, '2020-11-17 21:37:25', '2020-11-17 21:37:25'),
(3, 3, 'Data Center', 100000000, '2020-11-17', 1, NULL, '2020-11-17 23:27:36', '2020-11-17 23:27:36'),
(4, 3, 'Data Center', 100000000, '2020-11-17', 1, NULL, '2020-11-17 23:28:15', '2020-11-17 23:28:15'),
(5, 3, 'Data Center', 100000000, '2020-11-17', 1, NULL, '2020-11-17 23:31:50', '2020-11-17 23:31:50'),
(6, 2, 'MS', 500000000, '2020-11-26', 2, NULL, '2020-11-17 23:32:25', '2020-11-17 23:32:25');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8130Ch8n7vzr8GERhmKTwhjmDVdWn8z6WBxeTt49', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiOEhoVTFES0tteUd3ZGx2MllGWkVQS2dqem1lekZ6Y2pINGF0TFA3WCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9hanJpLmxvY2FsL2FjY291bnQtcGF5YWJsZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCQ2azZvODh3QTd5TUVCMEpWVThTcTVPMzRIeWtVdTN0M1dqWWY0STNzZjdtVTBaLnlFQzVTQyI7czo1OiJpc19pZCI7aTo0O3M6MjI6ImlzX2xvZ2luX2FkbWluaXN0cmF0b3IiO2I6MTt9', 1606319826),
('HyLnKfT9CctA2sps7Tk5oiGJ1iMy1e84uWOWvS1O', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQW93OEs1ZFFXYXBhY0xYNnl5RFM5QkFjeXZTbW9NeERnRXpDdzdlViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxNzoiaHR0cDovL2FqcmkubG9jYWwiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMzoiaHR0cDovL2FqcmkubG9jYWwvbG9naW4iO319', 1606287726),
('zCnuFuMbkoIiEHHSCocZG6BM7J5KBV7rpjCuCNKy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiODNVVE9hN0hLNG13Zmt1QW9VdzRRd29RSktDU1FndnJUWUF4U0tWWCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovL2FqcmkubG9jYWwvYWNjb3VudC1wYXlhYmxlIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly9hanJpLmxvY2FsL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1606359123);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'logo', 'logo20201124032705.png', '2020-11-03 17:34:55', '2020-11-24 08:27:05'),
(2, 'company', 'Asuransi Reliance Indonesia', '2020-11-03 17:38:50', '2020-11-24 08:35:25'),
(3, 'address', 'Kantor Operasional\nReliance Building\nJl. Pluit Sakti Raya No. 27 AB\nPenjaringan, Pluit\nJakarta Utara\nDKI Jakarta 14450\nIndonesia\n021-661 7768\n021-666 75075', '2020-11-03 18:01:31', '2020-11-24 08:35:25'),
(4, 'email', 'customer.care@reliance-insurance.com', '2020-11-03 18:03:48', '2020-11-24 08:35:25'),
(5, 'phone', '0800 1000 327', '2020-11-03 18:03:48', '2020-11-24 08:35:25'),
(6, 'website', 'https://asuransireliance.com/id/', '2020-11-03 18:03:48', '2020-11-24 08:35:25'),
(7, 'favicon', 'favicon20201124153611.png', '2020-11-19 00:57:10', '2020-11-24 08:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_access_id` int(11) DEFAULT NULL,
  `telepon` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `user_access_id`, `telepon`, `address`) VALUES
(4, 'Administrator', 'admin@gmail.com', NULL, '$2y$10$SKRcIsWkSORxU73T3GwvUurBb8vQg3e64EyY70C4Npt9aTGKuG6NS', NULL, NULL, NULL, NULL, '/storage/photo/4/24112020152652.jpeg', '2020-11-03 16:11:04', '2020-11-24 16:09:18', 1, '-', 'Jakarta Pusat'),
(6, 'Administrator', 'admin@gmaill.com', NULL, '$2y$10$dM8meaQGNsdbQ/2B37pR1uaHuPqehxc6hvtS8zg4iCjMQtNT84P.G', NULL, NULL, NULL, NULL, NULL, '2020-11-16 23:42:05', '2020-11-18 01:30:27', 1, '087777', 'Bojong Gede - Kabupaten Bogor'),
(9, 'Finance', 'finance@gmail.com', NULL, '$2y$10$6k6o88wA7yMEB0JVU8Sq5O34HykUu3t3WjYf4I3sf7mU0Z.yEC5SC', NULL, NULL, NULL, NULL, NULL, '2020-11-18 01:40:43', '2020-11-18 01:40:43', 2, '021-213-1234', 'Jakarta Pusat');

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '-', NULL, NULL),
(2, 'Finance', '-', NULL, NULL),
(3, 'Accounting', '-', '2020-11-24 08:24:25', '2020-11-24 08:24:25');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules_items`
--
ALTER TABLE `modules_items`
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
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `modules_items`
--
ALTER TABLE `modules_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
