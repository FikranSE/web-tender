-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Nov 2024 pada 07.11
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laraveldb`
--

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
-- Struktur dari tabel `hasil_evaluasi`
--

CREATE TABLE `hasil_evaluasi` (
  `id_hasil_evaluasi` bigint(20) UNSIGNED NOT NULL,
  `id_tender` bigint(20) UNSIGNED NOT NULL,
  `id_peserta` bigint(20) UNSIGNED NOT NULL,
  `id_legend` bigint(20) UNSIGNED NOT NULL,
  `alasan` text DEFAULT NULL,
  `skor` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `legend`
--

CREATE TABLE `legend` (
  `id_legend` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(10) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(31, '2014_10_12_000000_create_users_table', 1),
(32, '2014_10_12_100000_create_password_resets_table', 1),
(33, '2019_08_19_000000_create_failed_jobs_table', 1),
(34, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(35, '2024_09_21_125717_create_products_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id_paket` bigint(20) UNSIGNED NOT NULL,
  `nama_paket` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `created_at`, `updated_at`) VALUES
(2, 'Jasa pelayanan', '2024-09-25 22:35:07', '2024-09-27 21:46:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penawar`
--

CREATE TABLE `penawar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_peserta` bigint(20) UNSIGNED NOT NULL,
  `id_tender` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `npwp` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nomor_telepon` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `dokumen_perusahaan` varchar(255) DEFAULT NULL,
  `dokumen_penawaran` varchar(255) DEFAULT NULL,
  `harga_penawaran` decimal(20,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penawar`
--

INSERT INTO `penawar` (`id`, `id_peserta`, `id_tender`, `nama_perusahaan`, `npwp`, `email`, `nomor_telepon`, `alamat`, `dokumen_perusahaan`, `dokumen_penawaran`, `harga_penawaran`, `created_at`, `updated_at`) VALUES
(2, 2, 4, 'PT Sinergi Informatika Semen Indonesia', '1244.4735.734573.898', 'fikran0000@gmail.com', '081266920962', 'Insani housing area, kuranji', 'dokumen_perusahaan/T36RsKvMzLQTDoSFzUgeJnXsEIs1Osf6lrpSxbD5.pdf', 'dokumen_penawaran/PQgIbgHj5s50j65NOXeISYbTuhODvvateB09g9hO.pdf', 120000000.00, '2024-11-06 22:03:39', '2024-11-06 22:03:39'),
(6, 3, 4, 'PT Sinergi ekonomi', '1241141343', 'tes@gmail.com', '081266920962', 'Insani housing area, kuranji', 'dokumen_perusahaan/uqCR9HycJUVKiN0yapkZWnFCxACItF23Ggzm6SuC.pdf', 'dokumen_penawaran/ECCuq6K7yeQdC3rruhnHH41GpZ4LBeelvSlYn5ET.pdf', 23000000.00, '2024-11-06 23:03:45', '2024-11-06 23:03:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tender`
--

CREATE TABLE `tender` (
  `id_tender` bigint(20) UNSIGNED NOT NULL,
  `id_paket` bigint(20) UNSIGNED NOT NULL,
  `kode_tender` varchar(50) NOT NULL,
  `nama_tender` varchar(255) NOT NULL,
  `tahapan_tender_saat_ini` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `dokumen_pemilihan` varchar(255) DEFAULT NULL,
  `hasil_evaluasi` text DEFAULT NULL,
  `berita_acara` varchar(255) DEFAULT NULL,
  `status` enum('draft','aktif','selesai','dibatalkan') DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tender`
--

INSERT INTO `tender` (`id_tender`, `id_paket`, `kode_tender`, `nama_tender`, `tahapan_tender_saat_ini`, `tanggal_mulai`, `tanggal_selesai`, `dokumen_pemilihan`, `hasil_evaluasi`, `berita_acara`, `status`, `created_at`, `updated_at`) VALUES
(4, 2, '002', 'Jasa Pemindahan Server (ANDIKA KARTIKA SARI, S.H)', 'mulai', '2024-09-27', '2024-09-30', 'dokumen_pemilihan/NgTCFYQIFXJUNVfP2vLcoE3Kze2N6TKPjNsM8ZPE.pdf', 'awd', 'berita_acara/hu7DYObsvi6Gu261BqNSbbL3F5iIeDc1KotyQf53.pdf', 'aktif', '2024-09-26 23:09:32', '2024-09-27 21:45:20'),
(5, 2, '003', 'Beltim Security Operation Center', 'mulai', '2024-09-27', '2024-09-30', 'dokumen_pemilihan/hT8SaDfVqVfwefO0JIHVgvvOii8QrAXSBg2Gd5En.pdf', 'awd', 'berita_acara/YkIvhZi4SG9fLUnTD1T996dDjpRMb04zpnMlBpGE.pdf', 'aktif', '2024-09-26 23:22:02', '2024-10-08 21:07:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` enum('provider','penawar','','') DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `type`) VALUES
(1, 'admin', 'provider', 'admin@example.com', NULL, '$2y$10$TJc54x6n94ew9Dwg6APRNOj.FrZOR..tQAs2c7satndk4y6pbCcCG', 'qJ74iQu8ONodGbzAatwDjTCatJ1YuuOvLo2ktd4V01a0Elfn9JWPGOdWJDUg', '2024-09-25 22:16:59', '2024-09-25 22:16:59', 1),
(2, 'guest', 'penawar', 'guest@gmail.com', NULL, '$2y$10$TJc54x6n94ew9Dwg6APRNOj.FrZOR..tQAs2c7satndk4y6pbCcCG', 'efKHpQMgDa8NyvWA32Hv577lm1oO2erCbkyIHtQ0QDX6akIRM1gyKaMtGSVZ', '2024-09-27 00:20:06', '2024-09-27 00:20:06', 0),
(3, 'tes', NULL, 'tes@gmail.com', NULL, '$2y$10$y6LQqMiucSO2tKyixEAJqOxPWXMDhTB5z9Sy.q/x3fOSZIuxUZHZ.', NULL, '2024-11-06 23:03:07', '2024-11-06 23:03:07', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `hasil_evaluasi`
--
ALTER TABLE `hasil_evaluasi`
  ADD PRIMARY KEY (`id_hasil_evaluasi`),
  ADD KEY `id_tender` (`id_tender`),
  ADD KEY `id_peserta` (`id_peserta`),
  ADD KEY `id_legend` (`id_legend`);

--
-- Indeks untuk tabel `legend`
--
ALTER TABLE `legend`
  ADD PRIMARY KEY (`id_legend`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `penawar`
--
ALTER TABLE `penawar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `npwp` (`npwp`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_tender` (`id_tender`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tender`
--
ALTER TABLE `tender`
  ADD PRIMARY KEY (`id_tender`),
  ADD UNIQUE KEY `kode_tender` (`kode_tender`),
  ADD KEY `id_paket` (`id_paket`);

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
-- AUTO_INCREMENT untuk tabel `hasil_evaluasi`
--
ALTER TABLE `hasil_evaluasi`
  MODIFY `id_hasil_evaluasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `legend`
--
ALTER TABLE `legend`
  MODIFY `id_legend` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penawar`
--
ALTER TABLE `penawar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tender`
--
ALTER TABLE `tender`
  MODIFY `id_tender` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil_evaluasi`
--
ALTER TABLE `hasil_evaluasi`
  ADD CONSTRAINT `hasil_evaluasi_ibfk_1` FOREIGN KEY (`id_tender`) REFERENCES `tender` (`id_tender`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_evaluasi_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_evaluasi_ibfk_3` FOREIGN KEY (`id_legend`) REFERENCES `legend` (`id_legend`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penawar`
--
ALTER TABLE `penawar`
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`id_tender`) REFERENCES `tender` (`id_tender`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tender`
--
ALTER TABLE `tender`
  ADD CONSTRAINT `tender_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
