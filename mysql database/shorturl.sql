-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2025 at 10:01 AM
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
-- Database: `shorturl`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
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
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `invited_by` bigint(20) UNSIGNED NOT NULL,
  `invited_for` varchar(255) DEFAULT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `signed_up` varchar(255) NOT NULL DEFAULT 'pending',
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`id`, `email`, `role_id`, `invited_by`, `invited_for`, `master_id`, `token`, `signed_up`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'one@gmail.com', 2, 1, NULL, 'one', 'c5sXy8yOehQ338wHKwtycBfJrLyj59ERDk6iAAFz', 'Registered', '2025-01-23 08:13:00', '2025-01-23 08:11:20', '2025-01-23 08:11:20'),
(2, 'two@gmail.com', 2, 1, NULL, 'two', 'isidbgfG90EEAhBhCKkRrmHmkeJCKVPp1dBQRCjD', 'Registered', '2025-01-23 08:14:36', '2025-01-23 08:14:00', '2025-01-23 08:14:00'),
(3, 'five@gmail.com', 2, 3, '3', 'two', 'yYZp6ZNI6YY2L1LMpPDVrBXmbs51xy1dsqq9utUL', 'Registered', '2025-01-23 08:18:09', '2025-01-23 08:17:29', '2025-01-23 08:17:29'),
(4, 'six@gmail.com', 3, 3, '3', 'two', 'QLfiRwdcCT9MDOhcdo6UEzUHms2etcRQZiXZpLdU', 'Registered', '2025-01-23 08:19:53', '2025-01-23 08:19:06', '2025-01-23 08:19:06'),
(5, 'nine@gmail.com', 2, 3, '3', 'two', 'I6IA5aBeWIS8xGfxP2aLcBzwjQbnGA854ZhyDR0j', 'pending', '2025-01-23 08:55:35', '2025-01-23 08:25:35', '2025-01-23 08:25:35'),
(6, 'three@gmail.com', 2, 2, '2', 'one', 'y3nWEXXPvdwt8UxYcwktPhedLeIECS0KEyll3oYe', 'pending', '2025-01-23 09:15:37', '2025-01-23 08:45:37', '2025-01-23 08:45:37'),
(7, 'four@gmail.com', 3, 2, '2', 'one', 'CpwD7D2iiNCOpx9ioScYg3wW4pHu2aJmvEa9REJ9', 'pending', '2025-01-23 09:16:06', '2025-01-23 08:46:06', '2025-01-23 08:46:06');

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
(43, '0001_01_01_000001_create_cache_table', 1),
(44, '0001_01_01_000002_create_jobs_table', 1),
(45, '2025_01_21_102819_create_users_table', 1),
(46, '2025_01_21_102820_create_invitations_table', 1),
(47, '2025_01_21_102820_create_roles_table', 1),
(48, '2025_01_21_102820_create_urls_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '2025-01-23 02:32:16', '2025-01-23 02:32:16'),
(2, 'Admin', '2025-01-23 02:32:16', '2025-01-23 02:32:16'),
(3, 'Member', '2025-01-23 02:32:16', '2025-01-23 02:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE `urls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `long_url` varchar(255) NOT NULL,
  `short_url` varchar(255) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT 0,
  `master_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `urls`
--

INSERT INTO `urls` (`id`, `user_id`, `owner_id`, `long_url`, `short_url`, `hits`, `master_id`, `created_at`, `updated_at`) VALUES
(3, 5, 5, 'https://docs.python-telegram-bot.org/en/v21.5/', 'uxy7gt', 2, 'two', '2025-01-23 03:11:22', '2025-01-23 03:11:22'),
(5, 4, 4, 'https://github.com/hiteshchoudhary', 'CXjVdD', 3, 'two', '2025-01-23 03:12:36', '2025-01-23 03:12:36'),
(7, 2, 2, 'https://www.google.com/search?client=firefox-b-d&q=progress+bar+in+php&sei=4wGSZ5PrOLSa4-EP9rz96A0', 'Ye4qF9', 4, 'one', '2025-01-23 03:16:34', '2025-01-23 03:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `master_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `client_id`, `master_id`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@example.com', '$2y$12$jO189Y7iTS71iRwM8TshVu9mCp/y0Zak5XuAUFJstwvyVjeL4NdCG', 1, NULL, NULL, '2025-01-23 02:32:58', '2025-01-23 02:32:58'),
(2, 'one', 'one@gmail.com', '$2y$12$aETOmk7/x8cbfsI.G2bxOen.4dqB2TTPhTKYcrJShabRDz1LU/0fW', 2, NULL, 'one', '2025-01-23 08:13:00', '2025-01-23 08:13:00'),
(3, 'two', 'two@gmail.com', '$2y$12$b0.ufG2lfnKIWCqJ78sEv.MBJ/bnRYcplRNdvGQpg81qX1UYFhSte', 2, NULL, 'two', '2025-01-23 08:14:36', '2025-01-23 08:14:36'),
(4, 'five', 'five@gmail.com', '$2y$12$ZvF/yp6IWHchr0XZy07HB.n.8GUF5poWNAmDP0eOUlxNqp8PffNWW', 2, NULL, 'two', '2025-01-23 08:18:09', '2025-01-23 08:18:09'),
(5, 'six@gmail.com', 'six@gmail.com', '$2y$12$pzRCuWon5n.IK4b2tK5tmuWMY/.MyXSouuiEYmTzpPy7N/sf7KkJ6', 3, NULL, 'two', '2025-01-23 08:19:53', '2025-01-23 08:19:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invitations_email_unique` (`email`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `urls`
--
ALTER TABLE `urls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
