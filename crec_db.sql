-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2025 at 01:12 AM
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
-- Database: `crec_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `approvals`
--

CREATE TABLE `approvals` (
  `ApprovalID` bigint(20) UNSIGNED NOT NULL,
  `RequestID` bigint(20) UNSIGNED NOT NULL,
  `ApproverID` bigint(20) UNSIGNED NOT NULL,
  `ApprovalDate` date NOT NULL DEFAULT '2025-12-14',
  `Decision` varchar(255) NOT NULL,
  `Remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `approvals`
--

INSERT INTO `approvals` (`ApprovalID`, `RequestID`, `ApproverID`, `ApprovalDate`, `Decision`, `Remarks`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2025-12-14', 'Approved', NULL, '2025-12-14 12:12:46', '2025-12-14 12:12:46'),
(2, 4, 1, '2025-12-14', 'Approved', NULL, '2025-12-14 12:16:33', '2025-12-14 12:16:33'),
(3, 6, 1, '2025-12-15', 'Approved', NULL, '2025-12-14 16:52:56', '2025-12-14 16:52:56'),
(4, 7, 1, '2025-12-15', 'Approved', NULL, '2025-12-14 16:53:01', '2025-12-14 16:53:01'),
(5, 9, 1, '2025-12-15', 'Approved', NULL, '2025-12-14 17:05:08', '2025-12-14 17:05:08'),
(6, 11, 1, '2025-12-16', 'Approved', NULL, '2025-12-16 07:56:15', '2025-12-16 07:56:15');

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
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `EquipmentID` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `AvailabilityStatus` varchar(255) NOT NULL DEFAULT 'Available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`EquipmentID`, `Name`, `Description`, `AvailabilityStatus`, `created_at`, `updated_at`) VALUES
(1, 'Canon DSLR 80D', 'High quality camera for events', 'Available', '2025-12-14 11:27:17', '2025-12-14 17:05:49'),
(2, 'Canon DSLR 80D', 'High quality camera for events', 'Available', '2025-12-14 11:28:23', '2025-12-14 12:07:20'),
(3, 'Epson Projector', 'HDMI and VGA support', 'Available', '2025-12-14 11:28:23', '2025-12-14 16:53:59'),
(4, 'Dell Laptop', 'i7 Processor, 16GB RAM', 'Available', '2025-12-14 11:28:23', '2025-12-16 07:56:17'),
(5, 'Microscope Set', 'Biology Lab Kit', 'Available', '2025-12-14 11:28:23', '2025-12-14 12:07:20'),
(6, 'Extension Cord', '10 meters, heavy duty', 'Available', '2025-12-14 11:30:04', '2025-12-16 07:56:56');

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
-- Table structure for table `lending_requests`
--

CREATE TABLE `lending_requests` (
  `RequestID` bigint(20) UNSIGNED NOT NULL,
  `BorrowerID` bigint(20) UNSIGNED NOT NULL,
  `EquipmentID` bigint(20) UNSIGNED NOT NULL,
  `Purpose` varchar(255) NOT NULL,
  `RequestDate` date NOT NULL DEFAULT '2025-12-14',
  `DesiredReturnDate` date NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lending_requests`
--

INSERT INTO `lending_requests` (`RequestID`, `BorrowerID`, `EquipmentID`, `Purpose`, `RequestDate`, `DesiredReturnDate`, `Status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'documentation', '2025-12-14', '2025-12-17', 'Declined', '2025-12-14 11:38:17', '2025-12-14 11:50:22'),
(2, 1, 1, 'documentation', '2025-12-14', '2025-12-26', 'Declined', '2025-12-14 11:45:07', '2025-12-14 11:50:24'),
(3, 2, 1, 'documentation', '2025-12-14', '2025-12-16', 'Returned', '2025-12-14 12:08:49', '2025-12-14 12:12:57'),
(4, 2, 3, 'documentation', '2025-12-14', '2025-12-29', 'Returned', '2025-12-14 12:15:46', '2025-12-14 12:16:47'),
(5, 2, 1, 'documentation', '2025-12-14', '2025-12-26', 'Declined', '2025-12-14 12:16:08', '2025-12-14 12:16:35'),
(6, 2, 1, 'documentation', '2025-12-15', '2025-12-25', 'Returned', '2025-12-14 16:50:44', '2025-12-14 16:53:38'),
(7, 2, 3, 'for project', '2025-12-15', '2026-01-31', 'Returned', '2025-12-14 16:51:15', '2025-12-14 16:53:59'),
(8, 2, 4, 'presentation', '2025-12-15', '2025-12-27', 'Declined', '2025-12-14 16:52:07', '2025-12-14 16:52:59'),
(9, 2, 1, 'need for project making', '2025-12-15', '2025-12-18', 'Returned', '2025-12-14 17:04:04', '2025-12-14 17:05:49'),
(10, 2, 4, 'need for presentation', '2025-12-15', '2026-08-31', 'Declined', '2025-12-14 17:04:38', '2025-12-14 17:05:11'),
(11, 2, 6, 'project', '2025-12-16', '2026-07-28', 'Returned', '2025-12-16 07:55:13', '2025-12-16 07:56:56'),
(12, 2, 4, 'presentation', '2025-12-16', '2025-12-17', 'Declined', '2025-12-16 07:55:40', '2025-12-16 07:56:17');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_14_191657_create_equipment_table', 2),
(5, '2025_12_14_191858_create_lending_requests_table', 3),
(6, '2025_12_14_191859_create_approvals_table', 3),
(7, '2025_12_14_191859_create_penalties_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `penalties`
--

CREATE TABLE `penalties` (
  `PenaltyID` bigint(20) UNSIGNED NOT NULL,
  `RequestID` bigint(20) UNSIGNED NOT NULL,
  `Amount` decimal(8,2) NOT NULL,
  `Reason` varchar(255) NOT NULL,
  `DateIssued` date NOT NULL DEFAULT '2025-12-14',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penalties`
--

INSERT INTO `penalties` (`PenaltyID`, `RequestID`, `Amount`, `Reason`, `DateIssued`, `created_at`, `updated_at`) VALUES
(1, 7, 10000.00, 'broke items', '2025-12-15', '2025-12-14 16:53:59', '2025-12-14 16:53:59'),
(2, 9, 3000.00, 'Damage', '2025-12-15', '2025-12-14 17:05:49', '2025-12-14 17:05:49'),
(3, 11, 500.00, 'Late/Damaged', '2025-12-16', '2025-12-16 07:56:56', '2025-12-16 07:56:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'borrower',
  `department` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `department`, `position`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@school.edu', NULL, '$2y$12$jQTsVNgXVxicUTnIOv2xau9LWkg4RGD9Apnu8VtSzFpG0s1kxf5IW', 'approver', NULL, NULL, NULL, '2025-12-14 11:04:43', '2025-12-14 11:04:43'),
(2, 'Monico Student', 'student@school.edu', NULL, '$2y$12$eA5CU/CxypV2/EHXtzhXjuLlUueeRE95QVdC/9fCAvdCFZzp/h2iu', 'borrower', 'BSIS', NULL, NULL, '2025-12-14 12:04:12', '2025-12-14 12:04:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`ApprovalID`),
  ADD KEY `approvals_requestid_foreign` (`RequestID`),
  ADD KEY `approvals_approverid_foreign` (`ApproverID`);

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
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`EquipmentID`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `lending_requests`
--
ALTER TABLE `lending_requests`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `lending_requests_borrowerid_foreign` (`BorrowerID`),
  ADD KEY `lending_requests_equipmentid_foreign` (`EquipmentID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalties`
--
ALTER TABLE `penalties`
  ADD PRIMARY KEY (`PenaltyID`),
  ADD KEY `penalties_requestid_foreign` (`RequestID`);

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
-- AUTO_INCREMENT for table `approvals`
--
ALTER TABLE `approvals`
  MODIFY `ApprovalID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `EquipmentID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lending_requests`
--
ALTER TABLE `lending_requests`
  MODIFY `RequestID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penalties`
--
ALTER TABLE `penalties`
  MODIFY `PenaltyID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approvals`
--
ALTER TABLE `approvals`
  ADD CONSTRAINT `approvals_approverid_foreign` FOREIGN KEY (`ApproverID`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `approvals_requestid_foreign` FOREIGN KEY (`RequestID`) REFERENCES `lending_requests` (`RequestID`) ON DELETE CASCADE;

--
-- Constraints for table `lending_requests`
--
ALTER TABLE `lending_requests`
  ADD CONSTRAINT `lending_requests_borrowerid_foreign` FOREIGN KEY (`BorrowerID`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lending_requests_equipmentid_foreign` FOREIGN KEY (`EquipmentID`) REFERENCES `equipment` (`EquipmentID`) ON DELETE CASCADE;

--
-- Constraints for table `penalties`
--
ALTER TABLE `penalties`
  ADD CONSTRAINT `penalties_requestid_foreign` FOREIGN KEY (`RequestID`) REFERENCES `lending_requests` (`RequestID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
