-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2019 at 10:22 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr_soft`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$zoaJDVlp96QYX51XicqM/eqYLmM4GYO.QE5VpM5mUs50q7WGEZPtq', 'DecuhMmxLwEvHkJ8BrBPVtlW9vfrxrIu2FDzCUSIUAAyzMcuHgYgb0W1xdB2', '2019-02-18 22:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `daily_attendances`
--

CREATE TABLE `daily_attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `attend_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `late_duration` time NOT NULL,
  `user_type` tinyint(4) NOT NULL COMMENT '1=Supervisor, 2=Employee',
  `approval_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Approved',
  `approve_remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_attendances`
--

INSERT INTO `daily_attendances` (`id`, `employee_id`, `attend_date`, `start_time`, `end_time`, `late_duration`, `user_type`, `approval_status`, `approve_remarks`, `approved_by`, `created_at`, `updated_at`, `valid`) VALUES
(1, 1, '2019-04-07', '10:00:00', '17:00:00', '00:00:00', 1, 0, NULL, NULL, '2019-05-01 00:14:48', '2019-05-01 00:14:48', 1),
(2, 1, '2019-04-13', '11:30:00', '17:00:00', '00:02:30', 1, 0, NULL, NULL, '2019-05-01 11:35:45', '2019-05-01 11:35:45', 1),
(3, 1, '2019-04-14', '08:30:00', '14:00:00', '00:00:00', 1, 0, NULL, NULL, '2019-05-01 11:41:12', '2019-05-01 11:41:12', 1),
(4, 2, '2019-05-04', '09:00:00', '17:00:00', '00:00:30', 1, 0, NULL, NULL, '2019-05-01 12:07:41', '2019-05-01 12:07:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance_activities`
--

CREATE TABLE `employee_attendance_activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `attendance_id` int(11) DEFAULT NULL COMMENT 'attendance.id',
  `semister_id` int(11) DEFAULT NULL COMMENT 'semister.id',
  `employee_id` int(11) NOT NULL,
  `attend_date` date DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL,
  `assign_advisor_id` int(11) DEFAULT NULL,
  `seen_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_attendance_activities`
--

INSERT INTO `employee_attendance_activities` (`id`, `attendance_id`, `semister_id`, `employee_id`, `attend_date`, `user_type`, `assign_advisor_id`, `seen_status`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 1, NULL, 1, 0, 0, '2019-04-26 13:25:37', '2019-04-26 13:25:37'),
(2, NULL, 2, 1, NULL, 1, 0, 0, '2019-04-26 13:46:10', '2019-04-26 13:46:10'),
(3, 1, NULL, 1, '2019-04-06', 1, 0, 0, '2019-05-01 00:14:48', '2019-05-01 00:14:48'),
(4, 2, NULL, 1, '2019-04-13', 1, 0, 0, '2019-05-01 11:35:45', '2019-05-01 11:35:45'),
(5, 3, NULL, 1, '2019-04-14', 1, 0, 0, '2019-05-01 11:41:12', '2019-05-01 11:41:12'),
(6, NULL, 3, 2, NULL, 1, 0, 0, '2019-05-01 12:06:32', '2019-05-01 12:06:32'),
(7, 4, NULL, 2, '2019-05-04', 1, 0, 0, '2019-05-01 12:07:41', '2019-05-01 12:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `employee_departments`
--

CREATE TABLE `employee_departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `depertment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_departments`
--

INSERT INTO `employee_departments` (`id`, `depertment`, `sort_name`, `created_at`, `updated_at`, `valid`) VALUES
(1, 'Software Engineering', 'SWE', '2019-04-10 12:23:32', '2019-04-10 12:23:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_designations`
--

CREATE TABLE `employee_designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_designations`
--

INSERT INTO `employee_designations` (`id`, `designation`, `created_at`, `updated_at`, `valid`) VALUES
(1, 'Senior Lecturer', '2019-04-21 14:07:50', '2019-04-21 14:07:50', 1),
(2, 'Dept Head', '2019-04-26 12:17:07', '2019-04-26 12:17:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_schedules`
--

CREATE TABLE `employee_schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL COMMENT 'users.id',
  `semister_id` int(11) NOT NULL COMMENT 'semister_id=semister.id',
  `day_index` int(11) NOT NULL COMMENT 'schedule_days.day_index',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_schedules`
--

INSERT INTO `employee_schedules` (`id`, `employee_id`, `semister_id`, `day_index`, `start_time`, `end_time`, `created_at`, `updated_at`, `valid`) VALUES
(1, 1, 2, 0, '09:00:00', '17:00:00', '2019-05-01 00:12:41', '2019-05-01 00:12:41', 1),
(2, 1, 2, 1, '08:30:00', '16:00:00', '2019-05-01 00:12:41', '2019-05-01 00:12:41', 1),
(3, 2, 3, 0, '08:30:00', '17:00:00', '2019-05-01 12:07:13', '2019-05-01 12:07:13', 1),
(4, 2, 3, 2, '09:00:00', '16:00:00', '2019-05-01 12:07:13', '2019-05-01 12:07:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `expense_category_id` int(11) NOT NULL,
  `expense_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expense_details` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_amount` double(10,2) NOT NULL,
  `expense_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `income_category_id` int(11) NOT NULL,
  `income_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `income_details` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `income_amount` double(10,2) NOT NULL,
  `income_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `income_categories`
--

CREATE TABLE `income_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `income_categories`
--

INSERT INTO `income_categories` (`id`, `user_id`, `category_name`, `category_remarks`, `created_at`, `updated_at`, `valid`) VALUES
(1, 1, 'Salary', 'Company Job Income.', '2019-08-28 13:01:12', '2019-08-28 13:01:12', 1),
(2, 1, 'Salarydg', 'Company Job Income.', '2019-08-28 13:46:26', '2019-08-28 13:46:26', 1),
(3, 1, 'Salarydfghj', 'Company Job Income.', '2019-08-28 13:49:06', '2019-08-28 13:49:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lenders`
--

CREATE TABLE `lenders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `lender_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lender_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lender_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lender_remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `transaction_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `loan_type` tinyint(4) NOT NULL,
  `paid_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT '1'
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
(3, '2019_01_25_184846_create_admins_table', 1),
(4, '2019_02_21_043015_create_schedule_days_table', 2),
(5, '2019_02_21_043534_create_employee_schedules_table', 2),
(6, '2019_02_21_043809_create_employee_designations_table', 2),
(7, '2019_02_21_043840_create_employee_departments_table', 2),
(8, '2019_02_22_080128_create_semisters_table', 3),
(9, '2019_02_24_175405_create_daily_attendances_table', 4),
(10, '2019_02_24_194540_create_employee_attendance_activities_table', 5),
(11, '2019_08_26_184035_create_expenses_table', 6),
(12, '2019_08_26_185238_create_incomes_table', 6),
(13, '2019_08_26_185502_create_expense_categories_table', 6),
(14, '2019_08_26_185518_create_income_categories_table', 6),
(15, '2019_08_26_190305_create_lenders_table', 6),
(16, '2019_08_26_190745_create_loans_table', 6);

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
-- Table structure for table `schedule_days`
--

CREATE TABLE `schedule_days` (
  `id` int(10) UNSIGNED NOT NULL,
  `day_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_index` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule_days`
--

INSERT INTO `schedule_days` (`id`, `day_name`, `day_index`, `created_at`, `updated_at`) VALUES
(1, 'Saturday', 0, '2019-02-21 20:00:00', NULL),
(2, 'Sunday', 1, '2019-02-21 20:00:00', NULL),
(3, 'Monday', 2, '2019-02-21 20:00:00', NULL),
(4, 'Tuesday', 3, '2019-02-21 20:00:00', NULL),
(5, 'Wednesday', 4, '2019-02-21 21:00:00', NULL),
(6, 'Thursday', 5, '2019-02-21 20:00:00', NULL),
(7, 'Friday', 6, '2019-02-21 20:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `semisters`
--

CREATE TABLE `semisters` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL COMMENT 'users.id',
  `semister_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` tinyint(4) NOT NULL COMMENT '1 = supervisor, 2 = employee',
  `start_date` date NOT NULL,
  `approval_status` int(11) NOT NULL DEFAULT '0',
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semisters`
--

INSERT INTO `semisters` (`id`, `employee_id`, `semister_name`, `year`, `version`, `user_type`, `start_date`, `approval_status`, `approved_by`, `created_at`, `updated_at`, `valid`) VALUES
(1, 1, 'Fall', 2019, 'v-1', 1, '2019-04-02', 0, NULL, '2019-04-26 13:25:37', '2019-04-26 13:51:07', 1),
(2, 1, 'Spring', 2019, 'v-1', 1, '2019-04-06', 0, NULL, '2019-04-26 13:46:10', '2019-04-26 13:46:10', 1),
(3, 2, 'Summer', 2019, 'v-1', 1, '2019-05-01', 0, NULL, '2019-05-01 12:06:32', '2019-05-01 12:06:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depertment_id` int(191) DEFAULT NULL,
  `designation_id` int(191) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `generate_emp_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_supervisor` tinyint(4) NOT NULL DEFAULT '0',
  `is_employee` tinyint(4) NOT NULL DEFAULT '0',
  `assign_advisor` int(11) NOT NULL DEFAULT '0',
  `valid` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `depertment_id`, `designation_id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `generate_emp_id`, `is_supervisor`, `is_employee`, `assign_advisor`, `valid`) VALUES
(1, 'Rafikul Islam Rafi', 1, 2, 'rafikulswe@gmail.com', NULL, '$2y$10$IWGhwRHClTWxTGk91.UXceS8jPB/P2WV3yDEsqo0qz3/GWQgznMjC', '0d82TtU0OUyg459GO4xa0zlCJ3mbWiEYvRvUheh6b8g5KOIxObCsCnZYcnF2', '2019-04-26 12:25:25', '2019-04-26 12:25:25', '001', 1, 0, 0, 1),
(2, 'Miske Tara Zannat', 1, 1, 'moni@gmail.com', NULL, '$2y$10$/LEh3Kb1C.Puld0xSyvRJOAT3mBEZF1G.1FrqTUtLpP4W.fandUqa', 'YP4KKwW7v7Gpt3MVM5ndQ3ABzEadHyKha8yucrvH87klQTa0Aa8rv2rna8Cn', '2019-05-01 12:05:56', '2019-05-01 12:05:56', '002', 1, 0, 0, 1),
(3, 'Najmul Hasan Sobuj', 1, 1, 'sobuj@gmail.com', NULL, '$2y$10$DXHwtG.JyKoxw7Dx00lqPuaqExrN/E6o3jPAn3FHOy.7DSo0855EW', 'SOhVes87SnYWxdR9QO9bEoUNOSIVbGhK0UtoGQtsvgP5R6KLdXwqxgIvLVHK', '2019-05-23 06:01:33', '2019-05-23 06:01:33', '003', 0, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `daily_attendances`
--
ALTER TABLE `daily_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_attendance_activities`
--
ALTER TABLE `employee_attendance_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_departments`
--
ALTER TABLE `employee_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_designations`
--
ALTER TABLE `employee_designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_schedules`
--
ALTER TABLE `employee_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_categories`
--
ALTER TABLE `income_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lenders`
--
ALTER TABLE `lenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `schedule_days`
--
ALTER TABLE `schedule_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semisters`
--
ALTER TABLE `semisters`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `daily_attendances`
--
ALTER TABLE `daily_attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employee_attendance_activities`
--
ALTER TABLE `employee_attendance_activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `employee_departments`
--
ALTER TABLE `employee_departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employee_designations`
--
ALTER TABLE `employee_designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee_schedules`
--
ALTER TABLE `employee_schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `income_categories`
--
ALTER TABLE `income_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lenders`
--
ALTER TABLE `lenders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `schedule_days`
--
ALTER TABLE `schedule_days`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `semisters`
--
ALTER TABLE `semisters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
