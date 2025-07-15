-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2025 pada 14.01
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemantauan_mata_air`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mata_air_id` bigint(20) UNSIGNED NOT NULL,
  `kode_laporan` varchar(255) DEFAULT NULL,
  `tgl_pelaporan` timestamp NOT NULL DEFAULT current_timestamp(),
  `nama` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL,
  `desc_laporan` text NOT NULL,
  `status_laporan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id`, `mata_air_id`, `kode_laporan`, `tgl_pelaporan`, `nama`, `job`, `desc_laporan`, `status_laporan`, `created_at`, `updated_at`) VALUES
(4, 4, 'LA002', '2025-07-07 14:16:21', 'ozi', 'nganggur', 'sumber air mengalami pencemaran', '0', NULL, NULL),
(5, 4, 'LA002', '2025-07-08 03:33:02', 'Taufiq Aziz', 'Wiraswasta', 'Sumber mata air sikopyah mengalami pencemaran', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_air`
--

CREATE TABLE `mata_air` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_mata_air` varchar(255) NOT NULL,
  `short_desc` varchar(255) NOT NULL,
  `long_desc` text NOT NULL,
  `alamat_mata_air` text NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `kondisi` varchar(255) NOT NULL,
  `status_mata_air` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mata_air`
--

INSERT INTO `mata_air` (`id`, `nama_mata_air`, `short_desc`, `long_desc`, `alamat_mata_air`, `lat`, `lng`, `kondisi`, `status_mata_air`, `created_at`, `updated_at`) VALUES
(4, 'sikopyah', 'sangat baik', 'mata air tersembunyi', 'desa kali urip serang', '-7.0599422°', '109.4259114°', 'Baik', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_media` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `media_laporan`
--

CREATE TABLE `media_laporan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `laporan_id` bigint(20) UNSIGNED NOT NULL,
  `media_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `media_mata_air`
--

CREATE TABLE `media_mata_air` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mata_air_id` bigint(20) UNSIGNED NOT NULL,
  `media_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `media_pemantauan`
--

CREATE TABLE `media_pemantauan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemantauan_id` bigint(20) UNSIGNED NOT NULL,
  `media_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_17_214426_create_media_table', 1),
(5, '2025_04_17_214433_create_mata_airs_table', 1),
(6, '2025_04_17_214438_create_pemantauans_table', 1),
(7, '2025_04_17_214443_create_laporans_table', 1),
(8, '2025_04_17_215638_create_media_mata_airs_table', 1),
(9, '2025_04_17_215655_create_media_pemantauans_table', 1),
(10, '2025_04_17_215701_create_media_laporans_table', 1),
(11, '2025_07_08_000000_add_role_to_users_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemantauan`
--

CREATE TABLE `pemantauan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mata_air_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tgl_pemantauan` datetime NOT NULL,
  `debit_mata_air` varchar(255) NOT NULL,
  `kondisi_air` varchar(255) NOT NULL,
  `kerusakan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6eIVUhpDh1GzdSQhg17VeGbVUXjpL4Yyh6VYPjpU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiand6NlFaRzYxYVZIMXJkRzR3OEJxUWl1RmdnZHJySm9JbUhLamFJbSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaWduaW4iO319', 1751973834),
('eg4l2siL88sfjM7OWi2BNgHGjbzX1EoIXtIhjueC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidTUwNmhCYW41Q2QxYXJFcGIwMllMYmUxeFR2MjVkSElaSmNkdUs4aSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaWduaW4iO319', 1751976047);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'pelapor',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `image`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '-', 'Administrator', 'admin@admin.com', '2025-04-23 19:32:37', '$2y$12$zm2wouGnJ1NqT3Lg4DAGTegLI2pCT6wiJpSD4cffzOj7OCE30UfkG', 'admin', 'UDbShPNywaqS38FDSm2lXbLNFmJvHS8nactnwQDJ3W99ciIRNe9xiAVLAzMD', '2025-04-23 19:32:37', '2025-04-23 19:32:37'),
(2, '20250708040636FB_IMG_1687474864199.jpg', 'Taufiq Aziz', 'pelapor@pelapor.com', NULL, '$2y$12$RbEcrtHdcDgQ2mx0WClvw.do5NGcs3QtYVSSFInVAcvFruPoJRg5K', 'pelapor', NULL, '2025-07-07 20:31:38', '2025-07-07 21:06:36'),
(4, 'thumbnail/user.png', 'Adi', 'adi@pelapor.com', NULL, '$2y$12$0pCswl8o9yBtbTKk2RxDjOc2hEdFxrZnc0nZNSsb7FjpBEIBSMJX2', 'pelapor', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_mata_air_id_foreign` (`mata_air_id`);

--
-- Indeks untuk tabel `mata_air`
--
ALTER TABLE `mata_air`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `media_laporan`
--
ALTER TABLE `media_laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_laporan_laporan_id_foreign` (`laporan_id`),
  ADD KEY `media_laporan_media_id_foreign` (`media_id`);

--
-- Indeks untuk tabel `media_mata_air`
--
ALTER TABLE `media_mata_air`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_mata_air_mata_air_id_foreign` (`mata_air_id`),
  ADD KEY `media_mata_air_media_id_foreign` (`media_id`);

--
-- Indeks untuk tabel `media_pemantauan`
--
ALTER TABLE `media_pemantauan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_pemantauan_pemantauan_id_foreign` (`pemantauan_id`),
  ADD KEY `media_pemantauan_media_id_foreign` (`media_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pemantauan`
--
ALTER TABLE `pemantauan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemantauan_mata_air_id_foreign` (`mata_air_id`),
  ADD KEY `pemantauan_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `mata_air`
--
ALTER TABLE `mata_air`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `media_laporan`
--
ALTER TABLE `media_laporan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `media_mata_air`
--
ALTER TABLE `media_mata_air`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `media_pemantauan`
--
ALTER TABLE `media_pemantauan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pemantauan`
--
ALTER TABLE `pemantauan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_mata_air_id_foreign` FOREIGN KEY (`mata_air_id`) REFERENCES `mata_air` (`id`);

--
-- Ketidakleluasaan untuk tabel `media_laporan`
--
ALTER TABLE `media_laporan`
  ADD CONSTRAINT `media_laporan_laporan_id_foreign` FOREIGN KEY (`laporan_id`) REFERENCES `laporan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_laporan_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `media_mata_air`
--
ALTER TABLE `media_mata_air`
  ADD CONSTRAINT `media_mata_air_mata_air_id_foreign` FOREIGN KEY (`mata_air_id`) REFERENCES `mata_air` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_mata_air_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `media_pemantauan`
--
ALTER TABLE `media_pemantauan`
  ADD CONSTRAINT `media_pemantauan_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_pemantauan_pemantauan_id_foreign` FOREIGN KEY (`pemantauan_id`) REFERENCES `pemantauan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemantauan`
--
ALTER TABLE `pemantauan`
  ADD CONSTRAINT `pemantauan_mata_air_id_foreign` FOREIGN KEY (`mata_air_id`) REFERENCES `mata_air` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemantauan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
