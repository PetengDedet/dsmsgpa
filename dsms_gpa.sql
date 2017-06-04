-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2017 at 01:55 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.1.0-5+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dsms_gpa`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `lembaga_id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `agenda` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `lembaga_id`, `tahun`, `bulan`, `agenda`, `created_at`, `updated_at`) VALUES
(3, 3, 2017, 5, 'adazvcvcxv', '2017-05-23 03:02:54', '2017-05-23 03:02:54'),
(4, 2, 2017, 5, 'fadsffafad', '2017-05-23 03:03:08', '2017-05-23 03:03:08'),
(5, 4, 2017, 6, 'uhaushdaskjdhaskdas', '2017-05-23 14:11:35', '2017-05-23 14:11:35'),
(6, 1, 2017, 7, 'asdasdasdasd', '2017-05-23 14:11:39', '2017-05-23 14:11:39');

-- --------------------------------------------------------

--
-- Table structure for table `anggaran`
--

CREATE TABLE `anggaran` (
  `id` int(11) NOT NULL,
  `lembaga_id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `pagu` bigint(20) NOT NULL DEFAULT '0',
  `realisasi` bigint(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggaran`
--

INSERT INTO `anggaran` (`id`, `lembaga_id`, `tahun`, `pagu`, `realisasi`, `created_at`, `updated_at`) VALUES
(1, 1, 2017, 10000000, 9000000, '2017-05-22 15:46:03', '2017-05-23 06:11:16'),
(2, 3, 2018, 234234, 34234234, '2017-05-23 02:55:30', '2017-05-23 02:55:30'),
(3, 2, 2017, 4000000000, 716000000, '2017-05-23 02:56:00', '2017-05-23 06:13:45'),
(4, 3, 2017, 35654654645, 4565464564, '2017-05-23 02:56:30', '2017-05-23 02:56:54'),
(5, 4, 2017, 6000000000, 4000000000, '2017-05-23 14:11:07', '2017-05-23 14:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `triwulan` int(11) NOT NULL,
  `pending` int(11) NOT NULL DEFAULT '0',
  `selesai` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`id`, `tahun`, `triwulan`, `pending`, `selesai`, `created_at`, `updated_at`) VALUES
(1, 2017, 1, 12, 10, '2017-05-23 14:15:50', '2017-05-23 14:16:13'),
(2, 2017, 2, 34, 22, '2017-05-23 14:16:01', '2017-05-23 14:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `id` int(11) NOT NULL,
  `lembaga_id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `nilai` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`id`, `lembaga_id`, `tahun`, `bulan`, `nilai`, `created_at`, `updated_at`) VALUES
(3, 2, 2017, 5, 19, '2017-05-23 17:49:42', '2017-05-23 17:49:42'),
(4, 3, 2017, 1, 32, '2017-05-23 17:49:51', '2017-05-23 17:49:51'),
(5, 3, 2017, 5, 23, '2017-05-23 17:50:02', '2017-05-23 17:50:02'),
(6, 4, 2017, 5, 17, '2017-05-23 17:50:11', '2017-05-23 17:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `lembaga`
--

CREATE TABLE `lembaga` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `nama_pimpinan` varchar(255) DEFAULT NULL,
  `foto_pimpinan` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lembaga`
--

INSERT INTO `lembaga` (`id`, `nama`, `alias`, `nama_pimpinan`, `foto_pimpinan`, `created_at`, `updated_at`) VALUES
(1, 'DSMS', 'DSMS', 'Rudi Saleh Susetyo', 'Foto_Pimpinan_zzRF.png', '2017-05-22 15:01:38', '2017-06-04 12:36:09'),
(2, 'DPST', 'DPST', 'Arifin Susanto', 'Foto_Pimpinan_iuZE.png', '2017-05-22 15:02:25', '2017-05-23 15:03:35'),
(3, 'DMPB', 'DMPB', 'Insan Hasani', 'Foto_Pimpinan_25dY.png', '2017-05-22 15:02:31', '2017-05-23 15:03:22'),
(4, 'SKDK', 'SKDK', 'Rakianto Irwanto', 'Foto_Pimpinan_549u.png', '2017-05-22 15:05:48', '2017-06-04 13:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `rdk`
--

CREATE TABLE `rdk` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `pending` int(11) NOT NULL DEFAULT '0',
  `selesai` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rdk`
--

INSERT INTO `rdk` (`id`, `tahun`, `bulan`, `pending`, `selesai`, `created_at`, `updated_at`) VALUES
(1, 2017, 1, 33, 11, '2017-05-23 14:22:40', '2017-05-23 14:22:48'),
(2, 2017, 2, 234, 43, '2017-05-23 14:22:55', '2017-05-23 14:22:55'),
(3, 2017, 5, 45, 32, '2017-05-23 17:10:47', '2017-05-23 17:10:47'),
(4, 2017, 6, 45, 23, '2017-06-04 12:34:17', '2017-06-04 12:34:17');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `lembaga_id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tugas` int(11) NOT NULL DEFAULT '0',
  `terlaksana` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `lembaga_id`, `tahun`, `bulan`, `tugas`, `terlaksana`, `created_at`, `updated_at`) VALUES
(1, 1, 2017, 1, 45, 5, '2017-05-23 04:21:27', '2017-05-23 13:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `tj_keuangan`
--

CREATE TABLE `tj_keuangan` (
  `id` int(11) NOT NULL,
  `lembaga_id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `nilai` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tj_keuangan`
--

INSERT INTO `tj_keuangan` (`id`, `lembaga_id`, `tahun`, `bulan`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 1, 2017, 1, 60, '2017-05-23 14:39:38', '2017-05-23 14:39:38'),
(2, 1, 2017, 4, 50, '2017-05-23 14:39:45', '2017-05-23 14:39:45'),
(3, 1, 2017, 5, 60, '2017-05-23 17:47:29', '2017-05-23 17:47:29'),
(4, 2, 2017, 5, 40, '2017-05-23 17:47:56', '2017-05-23 17:47:56'),
(5, 3, 2017, 5, 90, '2017-05-23 17:48:14', '2017-05-23 17:48:14'),
(6, 4, 2017, 5, 70, '2017-05-23 17:48:31', '2017-05-23 17:48:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('admin','user') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `type`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com', '$2y$10$4p1vi5GduAJYwcBi2yecveFaoLd1ShtD0R30vyUqD8Ypsj2TZHluG', 'duy0ISppnCpiU4zrgknumA4OnJb0oK3aVOynAp05uWZf4KQuI5UjGPOiOLpY', '2016-12-05 09:48:40', '2017-05-27 13:16:42'),
(7, 'masiwan', 'masiwan', 'user', NULL, '$2y$10$qja/h5oKGrlbFeGjJGFBcuLYYmOXhzQx6o.X1VLvIZD/l7V6tglJW', 'juqpiPwhRBw3cQupDzHNREQ1iBQAnRHzHrPTF3lOPlVZuB7UtO8U29WUXLxc', '2017-02-02 16:39:25', '2017-05-23 16:02:03'),
(8, 'kmp.dmpb', 'kmp.dmpb', 'user', NULL, '$2y$10$QLffdx82LBOc2PJn19WfIuzIyklxBMfs/rltkqelaYVPcXlYqxmK2', NULL, '2017-05-23 03:33:12', '2017-05-23 03:33:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lembaga`
--
ALTER TABLE `lembaga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rdk`
--
ALTER TABLE `rdk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tj_keuangan`
--
ALTER TABLE `tj_keuangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `anggaran`
--
ALTER TABLE `anggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `lembaga`
--
ALTER TABLE `lembaga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rdk`
--
ALTER TABLE `rdk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tj_keuangan`
--
ALTER TABLE `tj_keuangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
