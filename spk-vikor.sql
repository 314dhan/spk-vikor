-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Bulan Mei 2025 pada 15.31
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk-vikor`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatifs`
--

CREATE TABLE `alternatifs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_alternatif` varchar(255) NOT NULL,
  `nama_alternatif` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alternatifs`
--

INSERT INTO `alternatifs` (`id`, `kode_alternatif`, `nama_alternatif`, `description`, `created_at`, `updated_at`) VALUES
(21, '01', 'Arjuna Reyhan Wibawa', 'siswa', NULL, '2025-05-06 22:40:38'),
(22, '02', 'Muhammad Dafa Alfaris', 'siswa', NULL, '2025-05-06 22:40:44'),
(23, '03', 'Hikmah Dhika Nur Syafaatulloh', 'siswa', NULL, '2025-05-06 22:40:50'),
(24, '04', 'Saiful Hidayat', 'siswa', NULL, '2025-05-06 22:40:54'),
(25, '05', 'Rizki Andika Pratama', 'siswa', NULL, '2025-05-06 22:41:02'),
(26, '06', 'Iqbal Al Rasyiig', 'siswa', NULL, '2025-05-06 22:41:08'),
(27, '07', 'Muhamad Maulana Sawaludin', 'siswa', NULL, '2025-05-06 22:41:14'),
(28, '08', 'Villaxandria Violensiera Virtous Vierosa Virginia', 'siswa', NULL, '2025-05-06 22:41:20'),
(29, '09', 'Crespo Marfandi Pratama', 'siswa', NULL, '2025-05-06 22:41:26'),
(30, '10', 'Muhammad A\'Azif Junaidi', 'siswa', NULL, '2025-05-06 22:41:30'),
(31, '11', 'Julian Fahmi', 'siswa', NULL, '2025-05-06 22:41:37'),
(32, '12', 'Firda Aulia', 'siswa', NULL, '2025-05-06 22:41:43'),
(33, '13', 'Tantri Pramudita', 'siswa', NULL, '2025-05-06 22:41:48'),
(34, '14', 'Firdaus Abdul Ghanny', 'siswa', NULL, '2025-05-06 22:41:56'),
(35, '15', 'Sapta', 'siswa', NULL, '2025-05-06 22:42:04'),
(36, '16', 'Jamaludin', 'siswa', NULL, '2025-05-06 22:42:10'),
(37, '17', 'Indra Priatna', 'siswa', NULL, '2025-05-06 22:42:15'),
(38, '18', 'Elviana', 'siswa', NULL, '2025-05-06 22:42:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriterias`
--

CREATE TABLE `kriterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_kriteria` varchar(255) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `bobot` decimal(5,2) NOT NULL,
  `jenis` enum('cost','benefit') NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kriterias`
--

INSERT INTO `kriterias` (`id`, `kode_kriteria`, `nama_kriteria`, `bobot`, `jenis`, `description`, `created_at`, `updated_at`) VALUES
(2, 'a1', 'Ranking di kelas', 0.30, 'cost', 'Rank di kelas', '2025-05-06 08:49:05', '2025-05-11 04:56:59'),
(3, 'a2', 'Nilai Rata Rata Raport', 0.30, 'benefit', 'Nilai rata rata pada raport', '2025-05-06 09:20:09', '2025-05-06 22:31:54'),
(4, 'a3', 'Datang Terlambat', 0.10, 'cost', 'Ketepatan siswa dalam datang ke sekolah', '2025-05-06 09:21:22', '2025-05-06 09:21:22'),
(5, 'a4', 'Bolos Sekolah', 0.10, 'cost', 'Keseringan siswa dalam disiplin disekolah', '2025-05-06 09:22:40', '2025-05-06 09:22:40'),
(6, 'a5', 'Tawuran', 0.10, 'cost', 'Perilaku siswa', '2025-05-06 09:23:05', '2025-05-06 22:51:25'),
(7, 'a6', 'Terlibat Kasus Narkoba', 0.10, 'cost', 'Perilaku siswa di sekolah', '2025-05-06 22:51:53', '2025-05-06 22:51:53');

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
(2, '2025_05_06_054205_0001_create_kriteria_table', 1),
(3, '2025_05_06_145044_create_alternatifs_table', 2),
(4, '2025_05_06_145621_create_vikor_calculations_table', 3),
(5, '2025_05_06_161620_create_penilaians_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaians`
--

CREATE TABLE `penilaians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alternatif_id` bigint(20) UNSIGNED NOT NULL,
  `kriteria_id` bigint(20) UNSIGNED NOT NULL,
  `nilai` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penilaians`
--

INSERT INTO `penilaians` (`id`, `alternatif_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES
(546, 21, 2, 20, NULL, NULL),
(547, 21, 3, 15, NULL, '2025-05-06 23:32:52'),
(548, 21, 4, 1, NULL, NULL),
(549, 21, 5, 2, NULL, NULL),
(550, 21, 6, 3, NULL, NULL),
(551, 21, 7, 4, NULL, NULL),
(552, 22, 2, 15, NULL, NULL),
(553, 22, 3, 15, NULL, NULL),
(554, 22, 4, 1, NULL, '2025-05-06 23:32:52'),
(555, 22, 5, 2, NULL, NULL),
(556, 22, 6, 3, NULL, NULL),
(557, 22, 7, 4, NULL, NULL),
(558, 23, 2, 20, NULL, NULL),
(559, 23, 3, 15, NULL, NULL),
(560, 23, 4, -1, NULL, '2025-05-06 23:32:52'),
(561, 23, 5, 2, NULL, '2025-05-06 23:32:52'),
(562, 23, 6, 3, NULL, NULL),
(563, 23, 7, 4, NULL, NULL),
(564, 24, 2, 10, NULL, NULL),
(565, 24, 3, 10, NULL, NULL),
(566, 24, 4, 1, NULL, NULL),
(567, 24, 5, 2, NULL, NULL),
(568, 24, 6, 3, NULL, '2025-05-06 23:38:20'),
(569, 24, 7, 4, NULL, NULL),
(570, 25, 2, 15, NULL, NULL),
(571, 25, 3, 15, NULL, '2025-05-06 23:32:52'),
(572, 25, 4, 1, NULL, '2025-05-06 23:32:52'),
(573, 25, 5, 2, NULL, NULL),
(574, 25, 6, 3, NULL, NULL),
(575, 25, 7, 4, NULL, NULL),
(576, 26, 2, 20, NULL, NULL),
(577, 26, 3, 20, NULL, NULL),
(578, 26, 4, 1, NULL, NULL),
(579, 26, 5, 2, NULL, NULL),
(580, 26, 6, 3, NULL, NULL),
(581, 26, 7, 4, NULL, NULL),
(582, 27, 2, 10, NULL, NULL),
(583, 27, 3, 10, NULL, NULL),
(584, 27, 4, 1, NULL, NULL),
(585, 27, 5, 2, NULL, '2025-05-06 23:38:57'),
(586, 27, 6, 3, NULL, NULL),
(587, 27, 7, 4, NULL, NULL),
(588, 28, 2, 20, NULL, '2025-05-06 23:32:52'),
(589, 28, 3, 15, NULL, '2025-05-06 23:32:52'),
(590, 28, 4, 1, NULL, '2025-05-06 23:23:46'),
(591, 28, 5, 2, NULL, '2025-05-06 23:23:46'),
(592, 28, 6, 3, NULL, '2025-05-06 23:23:46'),
(593, 29, 2, 20, NULL, '2025-05-06 23:32:52'),
(594, 29, 3, 15, NULL, '2025-05-06 23:32:52'),
(595, 29, 4, 1, NULL, '2025-05-06 23:23:46'),
(596, 29, 5, 2, NULL, '2025-05-06 23:23:46'),
(597, 29, 6, 3, NULL, '2025-05-06 23:23:46'),
(598, 30, 2, 20, NULL, '2025-05-06 23:32:52'),
(599, 30, 3, 10, NULL, '2025-05-06 23:23:46'),
(600, 30, 4, 1, NULL, '2025-05-06 23:23:46'),
(601, 30, 5, 2, NULL, '2025-05-06 23:23:46'),
(602, 30, 6, 3, NULL, '2025-05-06 23:23:46'),
(603, 31, 2, 20, NULL, '2025-05-06 23:32:52'),
(604, 31, 3, 15, NULL, '2025-05-06 23:32:52'),
(605, 31, 4, 1, NULL, '2025-05-06 23:23:46'),
(606, 31, 5, 2, NULL, '2025-05-06 23:23:46'),
(607, 31, 6, 3, NULL, '2025-05-06 23:23:46'),
(608, 32, 2, 20, NULL, '2025-05-06 23:32:52'),
(609, 32, 3, 10, NULL, '2025-05-06 23:23:46'),
(610, 32, 4, 1, NULL, '2025-05-06 23:23:46'),
(611, 32, 5, 2, NULL, '2025-05-06 23:23:46'),
(612, 32, 6, 3, NULL, '2025-05-06 23:23:46'),
(613, 33, 2, 20, NULL, '2025-05-06 23:32:52'),
(614, 33, 3, 15, NULL, '2025-05-06 23:32:52'),
(615, 33, 4, 1, NULL, '2025-05-06 23:23:46'),
(616, 33, 5, 2, NULL, '2025-05-06 23:23:46'),
(617, 33, 6, 3, NULL, '2025-05-06 23:23:46'),
(618, 34, 2, 20, NULL, '2025-05-06 23:32:52'),
(619, 34, 3, 10, NULL, '2025-05-06 23:23:46'),
(620, 34, 4, 1, NULL, '2025-05-06 23:23:46'),
(621, 34, 5, 2, NULL, '2025-05-06 23:23:46'),
(622, 34, 6, 3, NULL, '2025-05-06 23:23:46'),
(623, 35, 2, 10, NULL, NULL),
(624, 35, 3, 10, NULL, '2025-05-06 23:23:46'),
(625, 35, 4, 1, NULL, '2025-05-06 23:32:52'),
(626, 35, 5, 2, NULL, '2025-05-06 23:23:46'),
(627, 35, 6, 3, NULL, '2025-05-06 23:23:46'),
(628, 36, 2, 20, NULL, '2025-05-06 23:32:52'),
(629, 36, 3, 20, NULL, '2025-05-06 23:32:52'),
(630, 36, 4, 1, NULL, '2025-05-06 23:23:46'),
(631, 36, 5, 2, NULL, '2025-05-06 23:23:46'),
(632, 36, 6, 3, NULL, '2025-05-06 23:23:46'),
(633, 37, 2, 20, NULL, '2025-05-06 23:32:52'),
(634, 37, 3, 15, NULL, '2025-05-06 23:32:52'),
(635, 37, 4, 1, NULL, '2025-05-06 23:23:46'),
(636, 37, 5, 2, NULL, '2025-05-06 23:23:46'),
(637, 37, 6, 3, NULL, '2025-05-06 23:23:46'),
(638, 38, 2, 15, NULL, NULL),
(639, 38, 3, 15, NULL, '2025-05-06 23:32:52'),
(640, 38, 4, 1, NULL, '2025-05-06 23:23:46'),
(641, 38, 5, 2, NULL, '2025-05-06 23:23:46'),
(642, 38, 6, 3, NULL, '2025-05-06 23:23:46'),
(643, 28, 7, 3, '2025-05-06 23:07:02', '2025-05-06 23:23:46'),
(644, 29, 7, 4, '2025-05-06 23:07:02', '2025-05-06 23:07:02'),
(645, 30, 7, 4, '2025-05-06 23:07:02', '2025-05-06 23:07:02'),
(646, 31, 7, 4, '2025-05-06 23:07:02', '2025-05-06 23:07:02'),
(647, 32, 7, 4, '2025-05-06 23:07:02', '2025-05-06 23:07:02'),
(648, 33, 7, 4, '2025-05-06 23:07:02', '2025-05-06 23:07:02'),
(649, 34, 7, 4, '2025-05-06 23:07:02', '2025-05-06 23:07:02'),
(650, 35, 7, 4, '2025-05-06 23:07:02', '2025-05-06 23:07:02'),
(651, 36, 7, 4, '2025-05-06 23:07:02', '2025-05-06 23:07:02'),
(652, 37, 7, 4, '2025-05-06 23:07:02', '2025-05-06 23:07:02'),
(653, 38, 7, 4, '2025-05-06 23:07:02', '2025-05-06 23:07:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$13$UOHV2Scf2gQRBXw5KM025ub7UOW.ARv3k0f2yJaW9/dozATDFheCi', '2025-05-06 07:41:03', '2025-05-06 07:41:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vikor_calculations`
--

CREATE TABLE `vikor_calculations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alternatif_id` bigint(20) UNSIGNED NOT NULL,
  `nilai_s` decimal(10,4) NOT NULL,
  `nilai_r` decimal(10,4) NOT NULL,
  `nilai_q` decimal(10,4) NOT NULL,
  `ranking` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `vikor_calculations`
--

INSERT INTO `vikor_calculations` (`id`, `alternatif_id`, `nilai_s`, `nilai_r`, `nilai_q`, `ranking`, `created_at`, `updated_at`) VALUES
(1, 30, 0.2000, 0.1000, 0.0000, 1, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(2, 32, 0.2000, 0.1000, 0.0000, 2, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(3, 34, 0.2000, 0.1000, 0.0000, 3, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(4, 21, 0.3500, 0.1500, 0.5000, 4, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(5, 29, 0.3500, 0.1500, 0.5000, 5, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(6, 31, 0.3500, 0.1500, 0.5000, 6, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(7, 33, 0.3500, 0.1500, 0.5000, 7, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(8, 37, 0.3500, 0.1500, 0.5000, 8, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(9, 23, 0.4500, 0.1500, 0.8333, 9, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(10, 28, 0.4500, 0.1500, 0.8333, 10, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(11, 22, 0.5000, 0.1500, 1.0000, 11, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(12, 24, 0.5000, 0.3000, 1.0000, 12, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(13, 25, 0.5000, 0.1500, 1.0000, 13, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(14, 26, 0.5000, 0.3000, 1.0000, 14, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(15, 27, 0.5000, 0.3000, 1.0000, 15, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(16, 35, 0.5000, 0.3000, 1.0000, 16, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(17, 36, 0.5000, 0.3000, 1.0000, 17, '2025-05-11 06:46:42', '2025-05-11 06:46:42'),
(18, 38, 0.5000, 0.1500, 1.0000, 18, '2025-05-11 06:46:42', '2025-05-11 06:46:42');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatifs`
--
ALTER TABLE `alternatifs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alternatifs_kode_alternatif_unique` (`kode_alternatif`);

--
-- Indeks untuk tabel `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kriterias_kode_kriteria_unique` (`kode_kriteria`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penilaians`
--
ALTER TABLE `penilaians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penilaians_alternatif_id_kriteria_id_unique` (`alternatif_id`,`kriteria_id`),
  ADD KEY `penilaians_kriteria_id_foreign` (`kriteria_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indeks untuk tabel `vikor_calculations`
--
ALTER TABLE `vikor_calculations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vikor_calculations_alternatif_id_foreign` (`alternatif_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatifs`
--
ALTER TABLE `alternatifs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `penilaians`
--
ALTER TABLE `penilaians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=654;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `vikor_calculations`
--
ALTER TABLE `vikor_calculations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penilaians`
--
ALTER TABLE `penilaians`
  ADD CONSTRAINT `penilaians_alternatif_id_foreign` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatifs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaians_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `vikor_calculations`
--
ALTER TABLE `vikor_calculations`
  ADD CONSTRAINT `vikor_calculations_alternatif_id_foreign` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatifs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
