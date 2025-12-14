-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2025 at 05:12 PM
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
-- Database: `chatbot_konsultasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int(11) NOT NULL,
  `chat_id` varchar(50) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `detail` text DEFAULT NULL,
  `bukti_pembulian` longtext DEFAULT NULL,
  `nama_pembuli` varchar(100) DEFAULT NULL,
  `jurusan_pembuli` varchar(100) DEFAULT NULL,
  `mata_kuliah_name` varchar(100) DEFAULT NULL,
  `feedback_dosen` text DEFAULT NULL,
  `umum_topik` varchar(100) DEFAULT NULL,
  `umum_detail` text DEFAULT NULL,
  `keuangan_detail` text DEFAULT NULL,
  `is_resolved` tinyint(1) DEFAULT 0,
  `resolved_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `dosen` varchar(100) DEFAULT NULL,
  `sks` int(11) DEFAULT 3,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id`, `nama`, `dosen`, `sks`, `created_at`) VALUES
(1, 'Basis Data', 'Dr. Ahmad Rizki', 3, '2025-12-14 13:21:05'),
(2, 'Pemrograman Web', 'Budi Santoso, M.Sc', 4, '2025-12-14 13:21:05'),
(3, 'Sistem Operasi', 'Prof. Siti Noor', 3, '2025-12-14 13:21:05'),
(4, 'Jaringan Komputer', 'Hendra Wijaya, M.T', 3, '2025-12-14 13:21:05'),
(5, 'Machine Learning', 'Dr. Dina Kusuma', 4, '2025-12-14 13:21:05'),
(6, 'Pemrograman Web', 'Budi Santoso, M.Sc', 4, '2025-12-14 16:10:50'),
(7, 'Sistem Operasi', 'Prof. Siti Noor', 3, '2025-12-14 16:10:50'),
(8, 'Jaringan Komputer', 'Hendra Wijaya, M.T', 3, '2025-12-14 16:10:50'),
(9, 'Machine Learning', 'Dr. Dina Kusuma', 4, '2025-12-14 16:10:50'),
(10, 'Matematika Teknik', 'Ir. Bambang Haryanto', 3, '2025-12-14 16:10:50'),
(11, 'Mekanika Bahan', 'Prof. Sinta Wijaya', 3, '2025-12-14 16:10:50'),
(12, 'Gambar Teknik', 'Ir. Joko Hartono', 3, '2025-12-14 16:10:50'),
(13, 'Survei dan Pemetaan', 'Ms. Lina Setiawan', 3, '2025-12-14 16:10:50'),
(14, 'Pengantar Manajemen', 'Dr. Agus Santoso', 3, '2025-12-14 16:10:50'),
(15, 'Ekonomi Mikro', 'Prof. Cahyo Nugroho', 3, '2025-12-14 16:10:50'),
(16, 'Akuntansi Dasar', 'Ms. Rianti Puspitawati', 3, '2025-12-14 16:10:50'),
(17, 'Food & Beverage Operations', 'Ir. Agus Wijaya', 3, '2025-12-14 16:10:50'),
(18, 'Retail Management Basics', 'Ms. Ayu Rahmadani', 3, '2025-12-14 16:10:50'),
(19, 'Customer Service Excellence', 'Dr. Hendra Santoso', 3, '2025-12-14 16:10:50'),
(20, 'Pengantar Informatika', 'Dr. Bambang Haryanto', 3, '2025-12-14 16:10:50'),
(21, 'Pemrograman Dasar', 'Prof. Rudi Hartono', 4, '2025-12-14 16:10:50'),
(22, 'Matematika Komputasi', 'Dr. Siti Aminah', 3, '2025-12-14 16:10:50'),
(23, 'Logika dan Algoritma', 'Ir. Agus Prasetyo', 3, '2025-12-14 16:10:50'),
(24, 'Pengantar Basis Data', 'Ms. Rini Setiawati', 3, '2025-12-14 16:10:50'),
(25, 'Pemrograman Lanjut', 'Budi Santoso, M.Sc', 4, '2025-12-14 16:10:50'),
(26, 'Database Management', 'Dr. Ahmad Rizki', 3, '2025-12-14 16:10:50'),
(27, 'Web Development Framework', 'Hendra Wijaya, M.T', 3, '2025-12-14 16:10:50'),
(28, 'Keamanan Jaringan', 'Prof. Siti Noor', 3, '2025-12-14 16:10:50'),
(29, 'Data Mining', 'Dr. Dina Kusuma', 3, '2025-12-14 16:10:50'),
(30, 'Statika Struktur', 'Ir. Bambang Haryanto', 3, '2025-12-14 16:10:50'),
(31, 'Material Teknik Sipil', 'Prof. Sinta Wijaya', 3, '2025-12-14 16:10:50'),
(32, 'Hidrogeologi', 'Ir. Joko Hartono', 3, '2025-12-14 16:10:50'),
(33, 'Konstruksi Bangunan', 'Ms. Lina Setiawan', 3, '2025-12-14 16:10:50'),
(34, 'Manajemen Operasional', 'Dr. Agus Santoso', 3, '2025-12-14 16:10:50'),
(35, 'Pemasaran Strategi', 'Prof. Cahyo Nugroho', 3, '2025-12-14 16:10:50'),
(36, 'Etika Bisnis', 'Ms. Rianti Puspitawati', 3, '2025-12-14 16:10:50'),
(37, 'Ekonomi Makro', 'Ir. Agus Wijaya', 3, '2025-12-14 16:10:50'),
(38, 'Keuangan Perusahaan', 'Ms. Ayu Rahmadani', 3, '2025-12-14 16:10:50'),
(39, 'Food Preparation Advanced', 'Dr. Hendra Santoso', 3, '2025-12-14 16:10:50'),
(40, 'Inventory & Stock Control', 'Ir. Rinto Wijaya', 3, '2025-12-14 16:10:50'),
(41, 'Pemrograman Berorientasi Obyek', 'Dr. Bambang Haryanto', 4, '2025-12-14 16:10:50'),
(42, 'Struktur Data', 'Prof. Rudi Hartono', 4, '2025-12-14 16:10:50'),
(43, 'Sistem Digital', 'Dr. Siti Aminah', 3, '2025-12-14 16:10:50'),
(44, 'Basis Data Lanjut', 'Ir. Agus Prasetyo', 3, '2025-12-14 16:10:50'),
(45, 'Data Structures', 'Ms. Rini Setiawati', 4, '2025-12-14 16:10:50'),
(46, 'Cloud Computing', 'Dr. Dina Kusuma', 3, '2025-12-14 16:10:50'),
(47, 'Mobile Application Development', 'Hendra Wijaya, M.T', 3, '2025-12-14 16:10:50'),
(48, 'Cybersecurity', 'Prof. Siti Noor', 3, '2025-12-14 16:10:50'),
(49, 'Business Intelligence', 'Dr. Ahmad Rizki', 3, '2025-12-14 16:10:50'),
(50, 'Analisis Struktur', 'Ir. Bambang Haryanto', 4, '2025-12-14 16:10:50'),
(51, 'Teknologi Beton', 'Prof. Sinta Wijaya', 3, '2025-12-14 16:10:50'),
(52, 'Rekayasa Fundasi', 'Ir. Joko Hartono', 3, '2025-12-14 16:10:50'),
(53, 'Manajemen Konstruksi', 'Ms. Lina Setiawan', 3, '2025-12-14 16:10:50'),
(54, 'Manajemen SDM', 'Dr. Agus Santoso', 3, '2025-12-14 16:10:50'),
(55, 'Analisis Laporan Keuangan', 'Prof. Cahyo Nugroho', 3, '2025-12-14 16:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `session_konsultasi`
--

CREATE TABLE `session_konsultasi` (
  `id` int(11) NOT NULL,
  `chat_id` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT 'waiting_nama',
  `nama` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `nim` varchar(10) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `data_temp` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_temp`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_konsultasi`
--

INSERT INTO `session_konsultasi` (`id`, `chat_id`, `status`, `nama`, `jurusan`, `nim`, `kategori`, `data_temp`, `created_at`, `updated_at`) VALUES
(1, 'unknown', 'waiting_nim', 'Joko', 'Sistem Informasi', NULL, NULL, '[]', '2025-12-14 13:22:18', '2025-12-14 14:54:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_chat_id` (`chat_id`),
  ADD KEY `idx_kategori` (`kategori`),
  ADD KEY `idx_created` (`created_at`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_konsultasi`
--
ALTER TABLE `session_konsultasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chat_id` (`chat_id`),
  ADD KEY `idx_chat_id` (`chat_id`),
  ADD KEY `idx_status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `session_konsultasi`
--
ALTER TABLE `session_konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
