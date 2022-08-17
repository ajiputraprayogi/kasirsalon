-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2022 at 09:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasirsalon`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_wa` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nama`, `alamat`, `no_wa`, `email`) VALUES
(2, 'Aji Putra Prayogi', 'Jl. Raya Bulurejo, Blabak, Pesantren, Kota Kediri', '082237666321', 'ajiputraprayogi@gmail.com'),
(5, 'Syahril Kharim', 'Jl. Banaran, Kota Kediri', '081234567890', 'syahrikharim@gmail.com'),
(7, 'Customer', 'Customer', '081234567890', 'cutomer@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `diskon` varchar(50) DEFAULT NULL,
  `status` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`id`, `nama`, `diskon`, `status`) VALUES
(1, 'Potongan Lebaran', '3000', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `list_pesanan`
--

CREATE TABLE `list_pesanan` (
  `id` int(11) NOT NULL,
  `faktur` varchar(50) NOT NULL,
  `id_paket` varchar(50) DEFAULT NULL,
  `jumlah_paket` varchar(50) DEFAULT NULL,
  `id_produk` varchar(50) DEFAULT NULL,
  `jumlah_produk` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_pesanan`
--

INSERT INTO `list_pesanan` (`id`, `faktur`, `id_paket`, `jumlah_paket`, `id_produk`, `jumlah_produk`, `created_at`, `updated_at`) VALUES
(183, 'TRF202204261.1', '2', '1', NULL, NULL, '2022-04-25 19:52:57', '2022-04-25 19:52:57'),
(184, 'TRF202204263.1', '3', '1', NULL, NULL, '2022-04-25 19:54:12', '2022-04-25 19:54:12'),
(185, 'TRF202204263.2', '3', '1', NULL, NULL, '2022-04-25 19:57:24', '2022-04-25 19:57:24'),
(186, 'TRF202204263.3', '1', '1', NULL, NULL, '2022-04-25 19:59:07', '2022-04-25 19:59:07'),
(187, 'TRF202204261.2', '1', '1', NULL, NULL, '2022-04-25 20:03:25', '2022-04-25 20:03:25'),
(188, 'TRF202204261.3', NULL, NULL, '1', '1', '2022-04-26 00:13:26', '2022-04-26 00:13:26'),
(189, 'TRF202204271.1', '1', '1', NULL, NULL, '2022-04-26 21:53:16', '2022-04-26 21:53:16'),
(190, 'TRF202204271.1', NULL, NULL, '2', '1', '2022-04-26 21:53:16', '2022-04-26 21:53:16'),
(191, 'TRF202204271.2', '1', '1', NULL, NULL, '2022-04-26 22:05:52', '2022-04-26 22:05:52'),
(192, 'TRF202204271.2', NULL, NULL, '1', '1', '2022-04-26 22:05:52', '2022-04-26 22:05:52'),
(193, 'TRF202204271.3', '1', '1', NULL, NULL, '2022-04-26 22:08:25', '2022-04-26 22:08:25'),
(194, 'TRF202204273.1', '2', '1', NULL, NULL, '2022-04-26 22:08:59', '2022-04-26 22:08:59'),
(195, 'TRF202204271.4', '1', '1', NULL, NULL, '2022-04-26 22:41:30', '2022-04-26 22:41:30'),
(196, 'TRF202204271.5', '3', '1', NULL, NULL, '2022-04-27 02:24:53', '2022-04-27 02:24:53'),
(197, 'TRF202204271.6', '3', '1', NULL, NULL, '2022-04-27 02:27:53', '2022-04-27 02:27:53'),
(198, 'TRF202204281.1', '2', '3', NULL, NULL, '2022-04-27 18:14:47', '2022-04-27 18:15:27'),
(199, 'TRF202204281.2', '1', '1', NULL, NULL, '2022-04-27 18:20:23', '2022-04-27 18:20:23'),
(200, 'TRF202204281.2', NULL, NULL, '4', '1', '2022-04-27 18:20:23', '2022-04-27 18:20:23'),
(201, 'TRF202205091.1', '3', '1', NULL, NULL, '2022-05-09 03:28:52', '2022-05-09 03:28:52'),
(202, 'TRF20220603.1', '3', '1', NULL, NULL, '2022-06-03 08:37:51', '2022-06-03 08:37:51'),
(203, 'TRF20220603.1', NULL, NULL, '4', '1', '2022-06-03 08:37:51', '2022-06-03 08:37:51');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_07_21_062729_create_permission_tables', 1),
(5, '2021_11_07_122500_create_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 3),
(1, 'App\\User', 4),
(1, 'App\\User', 5),
(2, 'App\\User', 1),
(2, 'App\\User', 2),
(2, 'App\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `paket_salon`
--

CREATE TABLE `paket_salon` (
  `id` int(11) NOT NULL,
  `paket` varchar(50) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL,
  `fee_capster` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket_salon`
--

INSERT INTO `paket_salon` (`id`, `paket`, `harga`, `fee_capster`) VALUES
(1, 'Dewasa', '10000', '5000'),
(2, 'Anak-anak', '7000', '3000'),
(3, 'Bayi', '15000', '6000');

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
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_wa` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `alamat`, `no_wa`, `email`) VALUES
(1, 'Aji Putra Prayogi', 'Jl. Raya Bulurejo, Blabak, Pesantren, Kota Kediri', '082237666321', 'ajiputraprayogi@gmail.com'),
(2, 'Syahril Kharim', 'Jl. Banaran, Kota Kediri', '081234567890', 'syahrikharim@gmail.com'),
(5, 'Komar', 'Pegawai', '081234567890', 'pegawai@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view-users', 'web', NULL, NULL),
(2, 'create-users', 'web', NULL, NULL),
(3, 'edit-users', 'web', NULL, NULL),
(4, 'delete-users', 'web', NULL, NULL),
(5, 'view-roles', 'web', NULL, NULL),
(6, 'create-roles', 'web', NULL, NULL),
(7, 'edit-roles', 'web', NULL, NULL),
(8, 'delete-roles', 'web', NULL, NULL),
(9, 'setting-web', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `stok`, `harga`) VALUES
(1, 'Pomade', 14, 25000),
(2, 'Shampoo', -9, 10000),
(3, 'Sabun Muka', 21, 43500),
(4, 'Miranda', 87, 100000),
(7, 'Cermin Kaca', 89, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', NULL, NULL),
(2, 'super admin', 'web', NULL, NULL);

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
(1, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_program` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan_nama_program` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_program` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `nama_program`, `singkatan_nama_program`, `instansi`, `deskripsi_program`) VALUES
(1, 'D-Boiler Laravel 7', 'DBL7', 'Gurah Putra', 'A free boiler for everyone');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id`, `nama`, `alamat`, `telp`) VALUES
(1, 'Salon Wanita', 'Jl. Centong, Kota Kediri', '08123456798'),
(2, 'Salon Pengantin', 'Jl. Blabak, Kota Kediri', '08123456798'),
(3, 'Salon Selebrity', 'Jl. Kaliombo, Kota Kediri', '08123456798');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `faktur` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_pegawai` int(11) NOT NULL DEFAULT 0,
  `id_customer` int(11) DEFAULT NULL,
  `subtotal` varchar(50) DEFAULT NULL,
  `namadiskon` varchar(50) DEFAULT NULL,
  `diskon` varchar(50) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  `tunai` varchar(50) DEFAULT NULL,
  `kembali` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `faktur`, `id_user`, `id_pegawai`, `id_customer`, `subtotal`, `namadiskon`, `diskon`, `total`, `tunai`, `kembali`, `created_at`, `updated_at`) VALUES
(114, 'TRF202204261.1', 2, 1, 7, NULL, NULL, NULL, '7000', '10000', '3000', '2022-01-24 19:55:30', '2022-04-25 19:55:30'),
(115, 'TRF202204263.1', 4, 5, 7, NULL, NULL, NULL, '15000', '20000', '5000', '2022-02-25 19:56:27', '2022-04-25 19:56:27'),
(116, 'TRF202204263.2', 4, 5, 7, NULL, NULL, NULL, '15000', '20000', '5000', '2022-03-25 19:58:07', '2022-04-25 19:58:07'),
(117, 'TRF202204263.3', 4, 1, 7, NULL, NULL, NULL, '10000', '10000', '0', '2022-04-25 19:59:19', '2022-04-25 19:59:19'),
(118, 'TRF202204261.2', 2, 2, 7, NULL, NULL, NULL, '10000', '10000', '0', '2022-04-25 20:03:54', '2022-04-25 20:03:54'),
(119, 'TRF202204261.3', 2, 1, 7, NULL, NULL, NULL, '25000', '25000', '0', '2022-04-26 00:13:41', '2022-04-26 00:13:41'),
(120, 'TRF202204271.1', 2, 1, 7, NULL, NULL, NULL, '20000', '20000', '0', '2022-04-26 21:53:27', '2022-04-26 21:53:27'),
(121, 'TRF202204271.2', 2, 1, 7, NULL, NULL, NULL, '35000', '50000', '15000', '2022-04-26 22:06:45', '2022-04-26 22:06:45'),
(122, 'TRF202204271.3', 2, 5, 7, NULL, NULL, NULL, '7000', '10000', '3000', '2022-04-26 22:27:11', '2022-04-26 22:27:11'),
(123, 'TRF202204271.4', 2, 2, 7, NULL, NULL, '3000', '7000', '10000', '7000', '2022-04-26 22:41:55', '2022-04-26 22:41:55'),
(124, 'TRF202204271.5', 2, 5, 7, NULL, NULL, '3000', '12000', '15000', '12000', '2022-04-27 02:25:08', '2022-04-27 02:25:08'),
(125, 'TRF202204271.6', 2, 2, 7, NULL, NULL, '3000', '12000', '15000', '3000', '2022-04-27 02:30:10', '2022-04-27 02:30:10'),
(126, 'TRF202204281.1', 2, 1, 7, '21000', NULL, '3000', '18000', '20000', '2000', '2022-04-27 18:18:50', '2022-04-27 18:18:50'),
(127, 'TRF202204281.2', 2, 5, 7, '110000', 'Potongan Lebaran', '3000', '107000', '120000', '13000', '2022-04-27 18:22:44', '2022-04-27 18:22:44'),
(128, 'TRF202205091.1', 2, 1, 7, '15000', 'Potongan Lebaran', '3000', '12000', '12000', '0', '2022-05-09 03:29:11', '2022-05-09 03:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_toko` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `telp`, `id_toko`, `level`, `gambar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'devasatrio', 'deva', 'deva@gmail.com', NULL, NULL, 'Super Admin', NULL, NULL, '$2y$10$rib2HT.ZuiSlhysQdGoRl.Agkkg/v2.soiAOCyQ450sfhtN13Quxu', 'VI89zx0hqfrjbUrKSsZ87dmjclvQIxRtLpo3whtWbHEOByLwD99apOQBEObR', '2021-11-07 06:43:27', '2021-11-07 06:43:27'),
(2, 'ajiputraprayogi', 'ajiputraprayogi', 'ajiputraprayogi@gmail.com', NULL, '1', 'super admin', NULL, NULL, '$2y$10$bmnYegyxhw0XkTPb.l1DYuRUAdtF0nmOoxQp.l7gVRJpN2XgWXpF6', 'sfSw0mPPoadmJsjfxlgsndKNVfyDYHWFUEVulZn36cge1X9yfzzAW9iPsItR', '2022-04-03 16:40:57', '2022-04-03 16:40:57'),
(3, 'admin', 'admin1', 'admin@gmail.com', '081234567890', NULL, 'admin', '1649962390-kediri-app1.jpg', NULL, '$2y$10$As3Vmyf1a7uj1Wil4tpXzuYoJ5fVK2NxT2E/6gv.KTJW9cYGNnoF2', 'Tmrag8EpPKQUJujXQWKTaevFOMpJ11yQoz0OzVQdNuczWlNtawutVpdIKvPa', '2022-04-14 11:53:11', '2022-04-14 12:10:19'),
(4, 'kasir', 'kasir', 'kasir@gmail.com', '081234567890', '3', 'super admin', '1649963863-kediri-app1.jpg', NULL, '$2y$10$7HLd/gtus62YFJAKQ03gvO79h.hoe/l96whJLcguG8qoJfMg2qUm6', '0tHVePBYf5RUkifrs3dhfxOrHIFY1nhrUBhcpGq2kn6ioUDgG0dTG1wuJPqQ', '2022-04-14 12:17:43', '2022-04-14 23:18:08'),
(5, 'kasir2', 'kasir2', 'kasir2@gmail.com', '081234567890', '1', 'admin', '1649965106-kediri-app1.jpg', NULL, '$2y$10$/wQ9aPAqfTUxMOk22qA6reIDETBHTf1JlresSDQ88dpVAh136ZV8.', NULL, '2022-04-14 12:38:26', '2022-04-14 12:40:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_pesanan`
--
ALTER TABLE `list_pesanan`
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
-- Indexes for table `paket_salon`
--
ALTER TABLE `paket_salon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
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
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_pesanan`
--
ALTER TABLE `list_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paket_salon`
--
ALTER TABLE `paket_salon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

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
