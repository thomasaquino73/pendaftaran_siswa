-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 10:13 PM
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
-- Database: `gudang_buku`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(10) NOT NULL,
  `nosku` varchar(20) NOT NULL,
  `namabarang` varchar(100) NOT NULL,
  `idkategori` int(5) NOT NULL,
  `idsatuan` int(10) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nosku`, `namabarang`, `idkategori`, `idsatuan`, `foto`, `updated_at`, `created_at`) VALUES
(102, '12', '12', 24, 2, NULL, '2024-03-14 14:11:00', '2024-03-14 14:11:00'),
(103, '2', '2', 24, 2, NULL, '2024-03-14 15:08:18', '2024-03-14 15:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `barang_models`
--

CREATE TABLE `barang_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(9, '2024-03-12 22:48:29', 'Create', 1, 'Create Barang'),
(10, '2024-03-12 22:48:41', 'Update', 1, 'Update Barang'),
(11, '2024-03-12 22:49:53', 'Delete', 1, 'Delete Barang'),
(12, '2024-03-12 22:55:47', 'Update', 1, 'Update Kategori'),
(13, '2024-03-12 22:57:40', 'Create', 1, 'Create Kategori'),
(14, '2024-03-14 14:07:45', 'Delete', 1, 'Delete Provinsi'),
(15, '2024-03-14 14:11:00', 'Create', 1, 'Create Barang'),
(16, '2024-03-14 15:08:18', 'Create', 1, 'Create Barang'),
(17, '2024-03-14 15:12:34', 'Update', 1, 'Update Provinsi'),
(18, '2024-03-14 15:15:25', 'Update', 1, 'Update Provinsi'),
(19, '2024-03-14 15:15:55', 'Update', 1, 'Update Provinsi'),
(20, '2024-03-14 15:20:23', 'Update', 1, 'Update Provinsi'),
(21, '2024-03-14 15:30:15', 'Update', 1, 'Update Provinsi'),
(22, '2024-03-14 15:30:22', 'Update', 1, 'Update Provinsi'),
(23, '2024-03-14 16:08:24', 'Update', 1, 'Update Kabupaten'),
(24, '2024-03-14 16:09:29', 'Update', 1, 'Update Kabupaten'),
(25, '2024-03-14 16:10:28', 'Update', 1, 'Update Kabupaten'),
(26, '2024-03-14 16:17:37', 'Update', 1, 'Update Kabupaten'),
(27, '2024-03-14 16:17:51', 'Update', 1, 'Update Kabupaten'),
(28, '2024-03-14 16:19:16', 'Create', 1, 'Create Kabupaten'),
(29, '2024-03-14 16:20:50', 'Update', 1, 'Update Kabupaten'),
(30, '2024-03-15 18:18:17', 'Delete', 1, 'Delete Kabupaten'),
(31, '2024-03-15 18:24:30', 'Create', 1, 'Create Kabupaten'),
(32, '2024-03-15 23:29:09', 'Update', 1, 'Update Karyawan'),
(33, '2024-03-16 02:16:24', 'Create', 1, 'Create Karyawan'),
(34, '2024-03-16 04:17:43', 'Update', 1, 'Update Pemasok'),
(35, '2024-03-16 04:22:25', 'Create', 1, 'Create Karyawan'),
(36, '2024-03-16 04:23:26', 'Update', 1, 'Update Karyawan'),
(37, '2024-03-16 04:30:20', 'Update', 1, 'Update Karyawan'),
(38, '2024-03-16 04:30:32', 'Update', 1, 'Update Karyawan'),
(39, '2024-03-16 04:33:36', 'Create', 1, 'Create Kabupaten'),
(40, '2024-03-16 04:33:52', 'Update', 1, 'Update Karyawan'),
(41, '2024-03-16 04:35:39', 'Update', 1, 'Update Karyawan'),
(42, '2024-03-16 14:31:54', 'Update', 1, 'Update Pemasok'),
(43, '2024-03-17 21:09:11', 'Update', 1, 'Update Barang'),
(44, '2024-03-17 21:09:26', 'Update', 1, 'Update Barang'),
(45, '2024-03-17 21:09:35', 'Update', 1, 'Update Barang'),
(46, '2024-03-17 21:12:41', 'Update', 1, 'Update Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `indonesia_cities`
--

CREATE TABLE `indonesia_cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` char(4) NOT NULL,
  `province_code` char(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `meta` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indonesia_districts`
--

CREATE TABLE `indonesia_districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` char(7) NOT NULL,
  `city_code` char(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `meta` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indonesia_provinces`
--

CREATE TABLE `indonesia_provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` char(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `meta` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indonesia_villages`
--

CREATE TABLE `indonesia_villages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` char(10) NOT NULL,
  `district_code` char(7) NOT NULL,
  `name` varchar(255) NOT NULL,
  `meta` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, 'denpasar', 3),
(5, 'badung', 3);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint(20) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `namalengkap` varchar(250) NOT NULL,
  `alamat` text NOT NULL,
  `notel` varchar(20) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `idprovinsi` int(10) NOT NULL,
  `idkabupaten` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nip`, `namalengkap`, `alamat`, `notel`, `avatar`, `idprovinsi`, `idkabupaten`, `created_at`, `updated_at`) VALUES
(4, '2', 'sukro', '2', '123', 'assets/uploads/fotokaryawan\\65ef5877e75731710184567.png', 1, 1, '2024-03-11 12:13:40', '2024-03-15 16:29:09'),
(5, '22', '22', '22', '22', NULL, 1, 1, '2024-03-15 19:16:24', '2024-03-17 14:12:41'),
(6, '22fdfs', '22sdfsdf', '2', '22', NULL, 1, 2, '2024-03-15 21:22:25', '2024-03-15 21:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan_models`
--

CREATE TABLE `karyawan_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(5) NOT NULL,
  `namakategori` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `namakategori`, `created_at`, `updated_at`) VALUES
(24, 'bajusdfdsf', '2024-03-01 13:33:35', '2024-03-01 13:33:35'),
(25, 'celana', '2024-03-01 13:52:04', '2024-03-01 13:52:04'),
(29, 'dsfsdf', '2024-03-12 22:57:40', '2024-03-12 22:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_models`
--

CREATE TABLE `kategori_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2024_02_20_025548_create_karyawan_models_table', 1),
(12, '2024_02_20_040115_create_permission_tables', 1),
(13, '2024_02_20_174910_create_provinsi_models_table', 1),
(14, '2016_08_03_072729_create_provinces_table', 2),
(15, '2016_08_03_072750_create_cities_table', 2),
(16, '2016_08_03_072804_create_districts_table', 2),
(17, '2016_08_03_072819_create_villages_table', 2),
(18, '2024_02_29_163343_create_kategori_models_table', 2),
(19, '2024_03_01_133759_create_barang_models_table', 2),
(20, '2024_03_02_190116_create_perusahaan_models_table', 2);

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

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@email.com', '$2y$12$z61qcDoOIfOOfohNv6J7iOKI6rwZFhyZHZaxhmhsEI8xYjAnnDkG6', '2024-03-17 04:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE `pemasok` (
  `id` bigint(20) NOT NULL,
  `namaperusahaan` varchar(100) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `idprovinsi` bigint(20) NOT NULL,
  `idkabupaten` bigint(20) NOT NULL,
  `namabank` varchar(100) DEFAULT NULL,
  `norek` int(20) DEFAULT NULL,
  `pemilikrekening` varchar(100) DEFAULT NULL,
  `notel` varchar(50) NOT NULL,
  `kontak` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemasok`
--

INSERT INTO `pemasok` (`id`, `namaperusahaan`, `alamat`, `idprovinsi`, `idkabupaten`, `namabank`, `norek`, `pemilikrekening`, `notel`, `kontak`, `keterangan`, `updated_at`, `created_at`) VALUES
(19, 'PT SEMUANYA ADA', 'cisauk', 3, 5, '1', 2, '3', '123123', 'bp abc', '4', '2024-03-16 07:31:54', '2024-03-08 04:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `perusahaan_models`
--

CREATE TABLE `perusahaan_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, 'BENGKULU', '2024-03-14 15:09:14', '2024-03-14 15:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi_models`
--

CREATE TABLE `provinsi_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(10) NOT NULL,
  `namasatuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `namasatuan`) VALUES
(2, 'pcs');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(8, 'thomas', 'admin@email.com', NULL, '$2y$12$eMgv78/NV3JUuq2CAOzBS.0Astlhgys/ORnzxMl.E/kIQfCDjxg5a', NULL, '2024-03-17 14:08:50', '2024-03-17 14:08:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_models`
--
ALTER TABLE `barang_models`
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
-- Indexes for table `indonesia_cities`
--
ALTER TABLE `indonesia_cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indonesia_cities_code_unique` (`code`),
  ADD KEY `indonesia_cities_province_code_foreign` (`province_code`);

--
-- Indexes for table `indonesia_districts`
--
ALTER TABLE `indonesia_districts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indonesia_districts_code_unique` (`code`),
  ADD KEY `indonesia_districts_city_code_foreign` (`city_code`);

--
-- Indexes for table `indonesia_provinces`
--
ALTER TABLE `indonesia_provinces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indonesia_provinces_code_unique` (`code`);

--
-- Indexes for table `indonesia_villages`
--
ALTER TABLE `indonesia_villages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indonesia_villages_code_unique` (`code`),
  ADD KEY `indonesia_villages_district_code_foreign` (`district_code`);

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
-- Indexes for table `karyawan_models`
--
ALTER TABLE `karyawan_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_models`
--
ALTER TABLE `kategori_models`
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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perusahaan_models`
--
ALTER TABLE `perusahaan_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinsi_models`
--
ALTER TABLE `provinsi_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
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
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `barang_models`
--
ALTER TABLE `barang_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `indonesia_cities`
--
ALTER TABLE `indonesia_cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indonesia_districts`
--
ALTER TABLE `indonesia_districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indonesia_provinces`
--
ALTER TABLE `indonesia_provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indonesia_villages`
--
ALTER TABLE `indonesia_villages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `karyawan_models`
--
ALTER TABLE `karyawan_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `kategori_models`
--
ALTER TABLE `kategori_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perusahaan_models`
--
ALTER TABLE `perusahaan_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `provinsi_models`
--
ALTER TABLE `provinsi_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `indonesia_cities`
--
ALTER TABLE `indonesia_cities`
  ADD CONSTRAINT `indonesia_cities_province_code_foreign` FOREIGN KEY (`province_code`) REFERENCES `indonesia_provinces` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `indonesia_districts`
--
ALTER TABLE `indonesia_districts`
  ADD CONSTRAINT `indonesia_districts_city_code_foreign` FOREIGN KEY (`city_code`) REFERENCES `indonesia_cities` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `indonesia_villages`
--
ALTER TABLE `indonesia_villages`
  ADD CONSTRAINT `indonesia_villages_district_code_foreign` FOREIGN KEY (`district_code`) REFERENCES `indonesia_districts` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD CONSTRAINT `kabupaten_ibfk_1` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsi` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
