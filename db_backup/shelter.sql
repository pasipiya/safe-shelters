-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2020 at 07:05 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shelter`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shelter_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_04_08_101439_create_shelters_table', 1),
(4, '2020_04_08_101913_create_images_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shelters`
--

CREATE TABLE `shelters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shel_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shel_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shel_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shel_postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shel_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shel_rooms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shel_contact_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shel_contact_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shel_rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shel_latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shel_longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shel_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shel_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shelters`
--

INSERT INTO `shelters` (`id`, `shel_name`, `user_id`, `shel_status`, `shel_country`, `shel_postal_code`, `shel_address`, `shel_rooms`, `shel_contact_1`, `shel_contact_2`, `shel_rating`, `shel_latitude`, `shel_longitude`, `shel_description`, `shel_pic`, `created_at`, `updated_at`) VALUES
(6, 'dfbn', '2', '0', NULL, '169810', 'Usa River, Inta Urban Okrug, Komi Republic, Northwestern Federal District, 169810, Russia', '3', '345678', NULL, NULL, '66.50862330000001', '61.07828320000001', 'zxcvbn', '1586623997.png', '2020-04-11 11:23:17', '2020-04-11 11:23:17'),
(7, 'zxcv', '1', '1', NULL, '227120', 'Amethi, NH731, Amethi, Mohanlalganj, Lucknow, Uttar Pradesh, 227120, India', '3', '3456', NULL, NULL, '26.74422390000001', '81.1552917', 'cvb', '1586624034.png', '2020-04-11 11:23:54', '2020-04-11 11:26:59'),
(8, 'fghm', '2', '0', NULL, '18221', 'Japan, Luzerne County, Pennsylvania, 18221, United States of America', '3', '345678', NULL, NULL, '40.9925844', '-75.9101994', 'xcvbnm', '1586624085.png', '2020-04-11 11:24:45', '2020-04-11 11:24:45'),
(9, 'fghjnkm', '2', '1', NULL, '33700', 'La India, Camargo, Chihuahua, 33700, Mexico', '3', '345678', NULL, NULL, '27.638378499999988', '-105.0082392', 'b n,m.,', '1586624276.png', '2020-04-11 11:27:56', '2020-04-11 11:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `profile_pic`, `role`, `status`, `address`, `postal_code`, `rating`, `email`, `contact_no`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pasindu', NULL, '1', '0', NULL, NULL, NULL, 'piyathilaka10@gmail.com', NULL, NULL, '$2y$10$F9Ztv7BR5Rluqnia./Y78ee37r6IS3URYyTgfsXzH//UCgEDa5dOm', NULL, '2020-04-11 09:13:52', '2020-04-11 11:26:43'),
(2, 'Company1', NULL, '2', '1', NULL, NULL, NULL, 'test1@gmail.com', NULL, NULL, '$2y$10$EK9weTV7QWTJ0tId8I0Jberu6Nk6sEWu1xn0b6J947s9hSELexC/C', NULL, '2020-04-11 11:22:38', '2020-04-11 11:26:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
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
-- Indexes for table `shelters`
--
ALTER TABLE `shelters`
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
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shelters`
--
ALTER TABLE `shelters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
