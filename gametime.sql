-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 11 jun 2024 om 13:27
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gametime`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `failed_jobs`
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
-- Tabelstructuur voor tabel `gametime`
--

CREATE TABLE `gametime` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `datum` date NOT NULL,
  `tijd` time NOT NULL,
  `geactiveerd` tinyint(4) NOT NULL,
  `kind_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tijdafgelopen` time NOT NULL,
  `toepassing` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `gametime`
--

INSERT INTO `gametime` (`id`, `datum`, `tijd`, `geactiveerd`, `kind_id`, `created_at`, `updated_at`, `tijdafgelopen`, `toepassing`) VALUES
(8, '2024-06-13', '12:22:00', 1, 2, '2024-06-11 07:32:34', '2024-06-11 08:50:46', '00:00:00', 'test'),
(9, '2024-06-11', '12:22:00', 0, 2, '2024-06-11 08:08:26', '2024-06-11 08:08:26', '12:27:00', 'Tv kijken'),
(10, '2024-06-12', '12:12:00', 0, 2, '2024-06-11 08:15:12', '2024-06-11 08:15:12', '12:17:00', 't'),
(11, '2024-06-12', '12:00:00', 0, 2, '2024-06-11 08:20:08', '2024-06-11 08:20:08', '12:15:00', 'Gamen'),
(12, '2024-06-11', '22:00:00', 0, 2, '2024-06-11 09:26:01', '2024-06-11 09:26:01', '10:05:00', 'Netflix kijken');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `jobs`
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
-- Tabelstructuur voor tabel `job_batches`
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
-- Tabelstructuur voor tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(31, '2024_05_15_082237_create_gedragsnotitie_table', 2),
(35, '0001_01_01_000000_create_users_table', 3),
(36, '0001_01_01_000001_create_cache_table', 3),
(37, '0001_01_01_000002_create_jobs_table', 3),
(38, '2024_05_15_082227_create_gametime_table', 3),
(39, '2024_05_15_082233_create_taak_table', 3),
(40, '2024_05_22_112840_add_role_to_users_table', 3),
(41, '2024_06_02_235722_create_parent_child_table', 4),
(42, '2024_06_09_225623_add_points_to_users_table', 5),
(43, '2024_06_10_015136_create_user_relations_table', 6),
(50, '2024_06_10_075348_create_time_to_points_table', 7),
(51, '2024_06_10_075555_create_screen_time_points_table', 7),
(52, '2024_06_11_071705_create_gametime_table', 7),
(53, '2024_06_11_081020_add_child_id_to_users_table', 7),
(54, '2024_06_11_095349_add_tijdafgelopen_to__table', 8),
(56, '2024_06_11_101211_add_toepassing_to__table', 9);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `parent_child`
--

CREATE TABLE `parent_child` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `child_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `parent_child`
--

INSERT INTO `parent_child` (`id`, `parent_id`, `child_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `screen_time_points`
--

CREATE TABLE `screen_time_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `minutes` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `child_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `screen_time_points`
--

INSERT INTO `screen_time_points` (`id`, `minutes`, `points`, `parent_id`, `child_id`, `created_at`, `updated_at`) VALUES
(1, 5, 5, 1, 2, '2024-06-11 06:40:34', '2024-06-11 06:40:34');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessions`
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
-- Gegevens worden geëxporteerd voor tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5G8r7JSzxasXulO9Z0QPYTziS8y1jl8XvElPl2x1', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN1g3d3l0bmRRbk54VFVlNTJIdzNtWWhQVzJuajVIWHU2eWFBcVJFRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zY3JlZW4tdGltZS1wb2ludHMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1718105161);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `taak`
--

CREATE TABLE `taak` (
  `idtaak` int(10) UNSIGNED NOT NULL,
  `omschrijving` varchar(45) NOT NULL,
  `waardepunten` int(11) NOT NULL,
  `datum` date NOT NULL,
  `voltooid` tinyint(4) NOT NULL,
  `gedragsnotitie` varchar(255) DEFAULT NULL,
  `controller_idcontroller` bigint(20) UNSIGNED NOT NULL,
  `kind_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `taak`
--

INSERT INTO `taak` (`idtaak`, `omschrijving`, `waardepunten`, `datum`, `voltooid`, `gedragsnotitie`, `controller_idcontroller`, `kind_id`) VALUES
(8, 'Grasmaaien 5', 5, '2024-06-14', 0, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `time_to_points`
--

CREATE TABLE `time_to_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `minutes` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Kind',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `points`) VALUES
(1, 'test@gm', 'test@gm', 'Ouder', NULL, '$2y$12$XsP2tqzoVJ8ji3KEh.eFM.rkHJidptitOQwOkNZH0WkHmiDfSj09K', NULL, '2024-06-03 05:38:44', '2024-06-03 05:38:44', 0),
(2, 'bart@test', 'bart@test', 'Kind', NULL, '$2y$12$vh2A2D83SL575nXK48ORP.nOlQtDaHWkmMzX6HHzAsFcFbD6MZC9u', NULL, '2024-06-03 05:40:27', '2024-06-11 09:26:01', 4),
(3, 'kind@test', 'kind@test', 'Kind', NULL, '$2y$12$gtXoBgEgVjyYCVmwR7QZruHlH2QGVXeHJ0lG7IQFe.IaxErrunt5K', NULL, '2024-06-03 06:50:14', '2024-06-10 09:02:11', 15),
(4, 'account@test', 'account@test', 'Ouder', NULL, '$2y$12$OXGRq/C/k1kuf2P8dp3W7.YSiPHTtSQyH7xerHMB5oFvl17Qk22s.', 'cIR6PhlWBST68NY8Yb7MMdxRa7sv9VjexbruTEuVHkHyMTnHJfOtOG60SeKi', '2024-06-04 08:48:57', '2024-06-04 08:48:57', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_relations`
--

CREATE TABLE `user_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `related_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user_relations`
--

INSERT INTO `user_relations` (`id`, `user_id`, `related_user_id`, `created_at`, `updated_at`) VALUES
(3, 1, 4, NULL, NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexen voor tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexen voor tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexen voor tabel `gametime`
--
ALTER TABLE `gametime`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gametime_kind_id_foreign` (`kind_id`);

--
-- Indexen voor tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexen voor tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `parent_child`
--
ALTER TABLE `parent_child`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parent_child_parent_id_child_id_unique` (`parent_id`,`child_id`),
  ADD KEY `parent_child_child_id_foreign` (`child_id`);

--
-- Indexen voor tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexen voor tabel `screen_time_points`
--
ALTER TABLE `screen_time_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `screen_time_points_parent_id_foreign` (`parent_id`),
  ADD KEY `screen_time_points_child_id_foreign` (`child_id`);

--
-- Indexen voor tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexen voor tabel `taak`
--
ALTER TABLE `taak`
  ADD PRIMARY KEY (`idtaak`),
  ADD KEY `fk_taak_user_idx` (`controller_idcontroller`),
  ADD KEY `fk_taak_kind_idx` (`kind_id`);

--
-- Indexen voor tabel `time_to_points`
--
ALTER TABLE `time_to_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `time_to_points_parent_id_foreign` (`parent_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexen voor tabel `user_relations`
--
ALTER TABLE `user_relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_relations_user_id_foreign` (`user_id`),
  ADD KEY `user_relations_related_user_id_foreign` (`related_user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gametime`
--
ALTER TABLE `gametime`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT voor een tabel `parent_child`
--
ALTER TABLE `parent_child`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `screen_time_points`
--
ALTER TABLE `screen_time_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `taak`
--
ALTER TABLE `taak`
  MODIFY `idtaak` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `time_to_points`
--
ALTER TABLE `time_to_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `user_relations`
--
ALTER TABLE `user_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `gametime`
--
ALTER TABLE `gametime`
  ADD CONSTRAINT `gametime_kind_id_foreign` FOREIGN KEY (`kind_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `parent_child`
--
ALTER TABLE `parent_child`
  ADD CONSTRAINT `parent_child_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parent_child_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `screen_time_points`
--
ALTER TABLE `screen_time_points`
  ADD CONSTRAINT `screen_time_points_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `screen_time_points_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `taak`
--
ALTER TABLE `taak`
  ADD CONSTRAINT `taak_controller_idcontroller_foreign` FOREIGN KEY (`controller_idcontroller`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `taak_kind_id_foreign` FOREIGN KEY (`kind_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `time_to_points`
--
ALTER TABLE `time_to_points`
  ADD CONSTRAINT `time_to_points_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `user_relations`
--
ALTER TABLE `user_relations`
  ADD CONSTRAINT `user_relations_related_user_id_foreign` FOREIGN KEY (`related_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_relations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
