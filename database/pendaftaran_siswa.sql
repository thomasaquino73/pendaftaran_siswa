-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2024 at 04:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendaftaran_siswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id` bigint(20) NOT NULL,
  `namacabang` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id`, `namacabang`, `kategori`) VALUES
(2, 'bsd 1', 'Head Office'),
(3, 'bsd2', 'Branch');

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
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  `action` varchar(20) NOT NULL,
  `user` bigint(20) NOT NULL,
  `note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `date`, `action`, `user`, `note`) VALUES
(1, '2024-03-25 16:50:33', 'Create', 1, 'Create Karyawan'),
(2, '2024-03-25 17:02:32', 'Delete', 1, 'Delete Kategori'),
(3, '2024-03-25 17:24:05', 'Delete', 1, 'Delete Kategori'),
(4, '2024-03-25 17:24:09', 'Delete', 1, 'Delete Kategori'),
(5, '2024-03-25 18:23:42', 'Delete', 1, 'Delete Kategori'),
(6, '2024-03-26 06:14:52', 'Delete', 1, 'Delete Kategori'),
(7, '2024-03-26 06:16:24', 'Delete', 1, 'Delete Kategori'),
(8, '2024-03-26 06:16:28', 'Delete', 1, 'Delete Kategori'),
(9, '2024-03-26 06:20:14', 'Delete', 1, 'Delete Kategori'),
(10, '2024-03-26 06:24:21', 'Delete', 1, 'Delete Kategori'),
(11, '2024-03-26 06:26:00', 'Delete', 1, 'Delete Kategori'),
(12, '2024-03-26 06:30:53', 'Delete', 1, 'Delete Kategori'),
(13, '2024-03-27 16:27:57', 'Update', 1, 'Update Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `provinsi_id` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `nama`, `provinsi_id`) VALUES
(1, 'Kab. Aceh Barat', 1),
(2, 'Kab. Aceh Barat Daya', 1),
(5, 'badung', 3),
(6, 'Denpasar', 3);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint(20) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `namalengkap` varchar(250) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `alamat` text NOT NULL,
  `notel` char(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `jeniskelamin` varchar(6) NOT NULL,
  `tempatlahir` varchar(100) NOT NULL,
  `tanggallahir` date NOT NULL,
  `idprovinsi` int(10) NOT NULL,
  `idkabupaten` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nip`, `namalengkap`, `slug`, `alamat`, `notel`, `email`, `avatar`, `jeniskelamin`, `tempatlahir`, `tanggallahir`, `idprovinsi`, `idkabupaten`, `created_at`, `updated_at`) VALUES
(3, '222', 'thomas', NULL, 'SDF', '123123', 'admin@email.com', NULL, 'Male', 'padang', '2024-03-20', 3, 5, '2024-03-25 09:49:40', '2024-03-27 09:27:57'),
(4, '24234234', 'THOMAS AQUINO', NULL, 'SDF', '123123', 'admin@email.com', NULL, 'Male', 'padang', '2024-03-20', 3, 5, '2024-03-25 09:50:33', '2024-03-25 09:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(5) NOT NULL,
  `namakelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `namakelas`) VALUES
(3, 'pre reading 1'),
(4, 'pre reading 2');

-- --------------------------------------------------------

--
-- Table structure for table `kursus`
--

CREATE TABLE `kursus` (
  `id` bigint(20) NOT NULL,
  `regdate` date NOT NULL,
  `nopendaftaran` varchar(20) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `startdate` date NOT NULL,
  `idsiswa` varchar(20) NOT NULL,
  `idcenter` int(11) NOT NULL,
  `idkaryawan` int(11) NOT NULL,
  `materialissued` varchar(255) DEFAULT NULL,
  `classid` varchar(50) NOT NULL,
  `reg_number` varchar(20) DEFAULT NULL,
  `idclassroom` int(11) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kursus`
--

INSERT INTO `kursus` (`id`, `regdate`, `nopendaftaran`, `slug`, `startdate`, `idsiswa`, `idcenter`, `idkaryawan`, `materialissued`, `classid`, `reg_number`, `idclassroom`, `code`, `created_at`, `updated_at`) VALUES
(2, '2024-03-09', '900', 'icrns20240001', '2024-03-30', '5', 2, 3, 'Course Material,ICR Shirt,ICR Pen and Sticker,Pencil/Eraser/Ruler,ICR Pencil Case', '100', 'ICRNS20240001', 3, NULL, '2024-03-25 09:52:30', '2024-03-25 18:46:56');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_23_060400_add_slug_to_kursus', 2),
(6, '2024_03_23_064834_add_slug_to_karyawan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(14, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `id` bigint(20) NOT NULL,
  `reg_number` varchar(20) DEFAULT NULL,
  `full_name_parent` varchar(200) DEFAULT NULL,
  `family_name_parent` varchar(100) DEFAULT NULL,
  `relation` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile_no` bigint(30) DEFAULT NULL,
  `office_no` bigint(20) DEFAULT NULL,
  `code` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`id`, `reg_number`, `full_name_parent`, `family_name_parent`, `relation`, `email`, `mobile_no`, `office_no`, `code`) VALUES
(16, 'ICRST20240001', 's', 's', 'Father', 'aa@email.com', 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `ket` varchar(8) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `ket`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-create', 'disabled', 'web', '2024-03-26 02:14:34', '2024-03-26 02:14:34'),
(2, 'role-edit', 'disabled', 'web', '2024-03-26 02:14:34', '2024-03-26 02:14:34'),
(3, 'role-delete', 'disabled', 'web', '2024-03-26 02:14:34', '2024-03-26 02:14:34'),
(4, 'role-view', 'disabled', 'web', '2024-03-26 02:14:34', '2024-03-26 02:14:34'),
(5, 'role-list', '', 'web', '2024-03-26 02:14:34', '2024-03-26 02:14:34'),
(6, 'user-create', '', 'web', '2024-03-26 02:15:25', '2024-03-26 02:15:25'),
(7, 'user-edit', '', 'web', NULL, NULL),
(8, 'user-delete', '', 'web', NULL, NULL),
(9, 'user-view', '', 'web', NULL, NULL),
(10, 'user-list', '', 'web', NULL, NULL),
(11, 'area-create', 'disabled', 'web', NULL, NULL),
(12, 'area-edit', 'disabled', 'web', NULL, NULL),
(13, 'area-delete', 'disabled', 'web', NULL, NULL),
(14, 'area-view', 'disabled', 'web', NULL, NULL),
(15, 'area-list', '', 'web', NULL, NULL),
(16, 'company-create', 'disabled', 'web', NULL, NULL),
(17, 'company-edit', 'disabled', 'web', NULL, NULL),
(18, 'company-delete', 'disabled', 'web', NULL, NULL),
(19, 'company-view', 'disabled', 'web', NULL, NULL),
(20, 'company-list', '', 'web', NULL, NULL),
(21, 'classroom-create', '', 'web', NULL, NULL),
(22, 'classroom-edit', '', 'web', NULL, NULL),
(23, 'classroom-delete', '', 'web', NULL, NULL),
(24, 'classroom-view', 'disabled', 'web', NULL, NULL),
(25, 'classroom-list', '', 'web', NULL, NULL),
(26, 'center-create', '', 'web', NULL, NULL),
(27, 'center-edit', '', 'web', NULL, NULL),
(28, 'center-delete', '', 'web', NULL, NULL),
(29, 'center-view', 'disabled', 'web', NULL, NULL),
(30, 'center-list', '', 'web', NULL, NULL),
(31, 'teacher-create', '', 'web', NULL, NULL),
(32, 'teacher-edit', '', 'web', NULL, NULL),
(33, 'teacher-delete', '', 'web', NULL, NULL),
(34, 'teacher-view', '', 'web', NULL, NULL),
(35, 'teacher-list', '', 'web', NULL, NULL),
(36, 'student-create', '', 'web', NULL, NULL),
(37, 'student-edit', '', 'web', NULL, NULL),
(38, 'student-delete', '', 'web', NULL, NULL),
(39, 'student-view', '', 'web', NULL, NULL),
(40, 'student-list', '', 'web', NULL, NULL),
(41, 'course-create', '', 'web', NULL, NULL),
(42, 'course-edit', '', 'web', NULL, NULL),
(43, 'course-delete', '', 'web', NULL, NULL),
(44, 'course-view', '', 'web', NULL, NULL),
(45, 'course-list', '', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(1) NOT NULL,
  `namaperusahaan` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `notel` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `namaperusahaan`, `alamat`, `notel`, `email`, `logo`) VALUES
(1, 'PT. ABCD', 'JALAN ANUNYA GITU', '08129999', 'anunya22@gmail.com', 'assets/uploads/logo\\65e9237ab89c41709777786.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Nanggroe Aceh Darussalam', '2024-03-14 15:09:14', '2024-03-14 15:09:14'),
(2, 'Sumatera Utara', '2024-03-14 15:09:14', '2024-03-14 15:09:14'),
(3, 'BALI', '2024-03-14 15:09:14', '2024-03-14 15:09:14'),
(4, 'BENGKULU', '2024-03-14 15:09:14', '2024-03-14 15:09:14'),
(6, 'KAB. ACEH BARAT', '2024-03-20 18:32:19', '2024-03-20 18:32:19');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(13, 'Administrator', 'web', '2024-03-25 22:23:39', '2024-03-25 22:23:39'),
(14, 'Supervisor', 'web', '2024-03-25 22:34:52', '2024-03-25 22:34:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(5, 13),
(5, 14),
(6, 14),
(7, 14),
(8, 14),
(9, 14),
(10, 14),
(15, 14),
(20, 14),
(21, 14),
(22, 14),
(23, 14),
(25, 14),
(26, 14),
(27, 14),
(28, 14),
(30, 14),
(31, 14),
(32, 14),
(33, 14),
(34, 14),
(35, 14),
(36, 14),
(37, 14),
(38, 14),
(39, 14),
(40, 14),
(41, 14),
(42, 14),
(43, 14),
(44, 14),
(45, 14);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `family_name` varchar(100) DEFAULT NULL,
  `place_birth` varchar(100) NOT NULL,
  `date_birth` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `medical_conditions` enum('Yes','No') NOT NULL,
  `medical_note` varchar(200) DEFAULT NULL,
  `disability_condition` enum('Yes','No') NOT NULL,
  `disability_note` varchar(200) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `idprovinsi` int(10) NOT NULL,
  `idkabupaten` int(10) NOT NULL,
  `icr_info` varchar(255) DEFAULT NULL,
  `reg_number` varchar(20) NOT NULL,
  `code` int(20) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `full_name`, `family_name`, `place_birth`, `date_birth`, `gender`, `nationality`, `medical_conditions`, `medical_note`, `disability_condition`, `disability_note`, `address`, `idprovinsi`, `idkabupaten`, `icr_info`, `reg_number`, `code`, `foto`, `created_at`, `updated_at`) VALUES
(11, 'a', 'a', 'weq', '2024-04-03', 'Male', 'gdgdf', 'No', NULL, 'No', NULL, 'tangerang', 1, 1, 'Mail Drop, Advertisement', 'ICRST20240001', 1, NULL, '2024-03-26 06:32:00', '2024-03-26 06:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `reason` text DEFAULT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `reason`, `model_type`, `model_id`, `created_at`, `updated_at`) VALUES
(18, 'aktif', NULL, 'App\\Models\\SiswaModel', 5, '2024-03-25 11:29:13', '2024-03-25 11:29:13'),
(23, 'aktif', NULL, 'App\\Models\\SiswaModel', 6, '2024-03-25 16:44:18', '2024-03-25 16:44:18'),
(24, 'active', NULL, 'App\\Models\\SiswaModel', 7, '2024-03-25 23:17:36', '2024-03-25 23:17:36'),
(25, 'active', NULL, 'App\\Models\\SiswaModel', 8, '2024-03-25 23:21:27', '2024-03-25 23:21:27'),
(26, 'active', NULL, 'App\\Models\\SiswaModel', 9, '2024-03-25 23:25:06', '2024-03-25 23:25:06'),
(27, 'active', NULL, 'App\\Models\\SiswaModel', 10, '2024-03-25 23:26:35', '2024-03-25 23:26:35'),
(28, 'non-aktif', NULL, 'App\\Models\\SiswaModel', 11, '2024-03-25 23:33:39', '2024-03-25 23:33:39'),
(29, 'non-aktif', NULL, 'App\\Models\\SiswaModel', 11, '2024-03-25 23:34:21', '2024-03-25 23:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '3', '222', NULL, '$2y$12$NUiQKPUyW2z861h.s/dVi.S1EwctIkb7DYU0.eYsz424O4ClLG8oW', NULL, '2024-03-22 23:18:26', '2024-03-27 20:12:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provinsi_id` (`provinsi_id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kursus`
--
ALTER TABLE `kursus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`) USING BTREE;

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`) USING BTREE;

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`) USING BTREE,
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`) USING BTREE;

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statuses_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kursus`
--
ALTER TABLE `kursus`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
