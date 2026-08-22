-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: alziz_user
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account_images`
--

DROP TABLE IF EXISTS `account_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `game_account_id` bigint(20) unsigned NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_images_game_account_id_foreign` (`game_account_id`),
  CONSTRAINT `account_images_game_account_id_foreign` FOREIGN KEY (`game_account_id`) REFERENCES `game_accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_images`
--

LOCK TABLES `account_images` WRITE;
/*!40000 ALTER TABLE `account_images` DISABLE KEYS */;
INSERT INTO `account_images` VALUES (23,9,'accounts/gallery/KEY4I4Teb3YXz5fbOvIcZNz5O2gRjy7PdwaxOI7E.jpg',NULL,1,'2026-08-21 19:27:51','2026-08-21 19:27:51'),(24,9,'accounts/gallery/ROdraB1KUqiQdkk4JEGehxvK0PGTOpcOaXQEOJPA.jpg',NULL,2,'2026-08-21 19:27:51','2026-08-21 19:27:51'),(25,9,'accounts/gallery/XV3gvLP3J8IatCsntszSz5PdSA6ZTCl96Af802l9.jpg',NULL,3,'2026-08-21 19:27:51','2026-08-21 19:27:51'),(26,9,'accounts/gallery/0ykWsNPCx6UnK85wanOpvPU4L3r62mmd9f2JZTbE.jpg',NULL,4,'2026-08-21 19:27:51','2026-08-21 19:27:51'),(27,9,'accounts/gallery/XFstWBfijRr4v6DDLacz2CuJgwLPuCOZJFQIN5SX.jpg',NULL,5,'2026-08-21 19:27:52','2026-08-21 19:27:52'),(28,9,'accounts/gallery/vjInh80QfWzbOTOZu8RzvOy5lht8JWkn7haYuHej.jpg',NULL,6,'2026-08-21 19:27:52','2026-08-21 19:27:52'),(29,9,'accounts/gallery/4wccBqskYHbsgFyduij1W2unfDZGbOP7YAEt8cX3.jpg',NULL,7,'2026-08-21 19:27:52','2026-08-21 19:27:52'),(30,9,'accounts/gallery/HXIerg4YjVq18F8xwsdRABX2EkbEFZLtVUcLM91c.jpg',NULL,8,'2026-08-21 19:27:52','2026-08-21 19:27:52');
/*!40000 ALTER TABLE `account_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_role` varchar(255) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_created_at_action_index` (`created_at`,`action`),
  KEY `activity_logs_user_id_index` (`user_id`),
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,1,'Admin ALzis STURR','owner','TEST_SYSTEM','Sistem Owner Dashboard ALzis STURR berhasil diuji coba.','127.0.0.1','Symfony',NULL,'2026-08-22 00:45:49','2026-08-22 00:45:49'),(2,3,'PelawakHor','user','LOGIN','Pengguna \'PelawakHor\' (kurirkelilit@gmail.com) berhasil login ke sistem sebagai USER.','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36',NULL,'2026-08-22 00:49:05','2026-08-22 00:49:05');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_accounts`
--

DROP TABLE IF EXISTS `game_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `game_category_id` bigint(20) unsigned NOT NULL,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `discount_price` decimal(15,2) DEFAULT NULL,
  `login_bind` varchar(255) NOT NULL,
  `server` varchar(255) NOT NULL DEFAULT 'Indonesia',
  `status` enum('available','sold','booked') NOT NULL DEFAULT 'available',
  `thumbnail` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `full_specs` longtext DEFAULT NULL,
  `hero_count` int(11) DEFAULT NULL,
  `skin_count` int(11) DEFAULT NULL,
  `rank_tier` varchar(255) DEFAULT NULL,
  `winrate` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `views_count` bigint(20) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `game_accounts_code_unique` (`code`),
  UNIQUE KEY `game_accounts_slug_unique` (`slug`),
  KEY `game_accounts_game_category_id_foreign` (`game_category_id`),
  CONSTRAINT `game_accounts_game_category_id_foreign` FOREIGN KEY (`game_category_id`) REFERENCES `game_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_accounts`
--

LOCK TABLES `game_accounts` WRITE;
/*!40000 ALTER TABLE `game_accounts` DISABLE KEYS */;
INSERT INTO `game_accounts` VALUES (9,2,'AZS-5XR9Y','FREE FIRE SET ITACHI KECE GOIB , SG TEROMPET MAX 1 SG 6 DRAGON GREEN','free-fire-set-itachi-kece-goib-sg-terompet-max-1-sg-6-dragon-green-azs-5xr9y',400000.00,350000.00,'Google','Indonesia','available','accounts/thumbnails/6ZsER8C3I5VobGTQ5fZXMVrcqxqLyisGvutpGEKI.jpg','Akun Pribadi, Bundle Set Kece dan Keren','Rank Heroic\r\nVault 430\r\nSg 4 rasa : Terompet, Mamba, Bunny, Suci\r\nEvo 3: SG 6 Dragon Green Lv 7, Scar  lv5, Thomson lv 5\r\nWeapon : AWM Hyperbook, M4A1 STROM ASCENT, \r\nSet Kece: Itachi, Galatic Bunny, Super Void Red, Dino Kardus Incu utama, Mask Ruok Incu, Black Turtleneck,  Celana genji putih\r\nSet Girl: Fjoker v1 Girl face,  Black Turtleneck, Dragon Spy, celana pendek hitam, Celana genji putih\r\nDll.',NULL,NULL,NULL,NULL,1,1,7,'2026-08-21 19:27:51','2026-08-22 00:01:04');
/*!40000 ALTER TABLE `game_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_categories`
--

DROP TABLE IF EXISTS `game_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `game_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_categories`
--

LOCK TABLES `game_categories` WRITE;
/*!40000 ALTER TABLE `game_categories` DISABLE KEYS */;
INSERT INTO `game_categories` VALUES (1,'Mobile Legends: Bang Bang','mobile-legends','mlbb-icon.png','mlbb-banner.jpg','Akun MLBB Mythical Glory, Collector, KOF, Legend, Aspirants, All Unbind.',1,1,'2026-08-21 23:17:41','2026-08-21 23:17:41'),(2,'Free Fire','free-fire','ff-icon.png','ff-banner.jpg','Akun FF Old, SG 2 OPM, Megalodon, Bundle Season 1/2, Akun Polosan & Sultan.',1,2,'2026-08-21 23:17:41','2026-08-21 23:17:41'),(3,'Genshin Impact','genshin-impact','genshin-icon.png','genshin-banner.jpg','Akun Genshin AR 55-60, C6 R5 Sultan, Well-Built, Primogems Melimpah Server Asia.',1,3,'2026-08-21 23:17:41','2026-08-21 23:17:41'),(4,'PUBG Mobile','pubg-mobile','pubg-icon.png','pubg-banner.jpg','Akun PUBGM M416 Glacier Max, X-Suit Bintang 6, Title Conqueror Server Indo.',1,4,'2026-08-21 23:17:41','2026-08-21 23:17:41'),(5,'Honor of Kings','honor-of-kings','hok-icon.png','hok-banner.jpg','Akun HOK Grandmaster, Skin Epic & Legend, Hero Komplit, Bind Aman.',1,5,'2026-08-21 23:17:41','2026-08-21 23:17:41'),(6,'Valorant','valorant','valorant-icon.png','valorant-banner.jpg','Akun Valorant Kuronami, Prime, Reaver, Radiant Rank Server AP/Indonesia.',1,6,'2026-08-21 23:17:41','2026-08-21 23:17:41');
/*!40000 ALTER TABLE `game_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_08_22_000001_add_custom_fields_to_users_table',1),(5,'2026_08_22_000002_create_game_categories_table',1),(6,'2026_08_22_000003_create_game_accounts_table',1),(7,'2026_08_22_000004_create_account_images_table',1),(8,'2026_08_22_000005_create_wishlists_table',1),(9,'2026_08_22_000006_create_site_settings_table',1),(10,'2026_08_22_073832_create_activity_logs_and_update_users_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('OHFI8t0OJLRBzSgvqUemItRtVXtZTRLlXZAgimDe',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiY3JEZ3Y5U1FJSVhINlhabklsaGtuSm9yVkdmcUJhcHFzbldwd253MCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTAzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWt1bi9mcmVlLWZpcmUtc2V0LWl0YWNoaS1rZWNlLWdvaWItc2ctdGVyb21wZXQtbWF4LTEtc2ctNi1kcmFnb24tZ3JlZW4tYXpzLTV4cjl5IjtzOjU6InJvdXRlIjtzOjEyOiJhY2NvdW50LnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1787380225),('Ra8wK2AwjT6l13MJklZRqZQsl6S4PSXjMpdbV4KB',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOUlUVU5rNjJaUTFRSGlJNE1MM1hEbjh1WUdESExtcUJvNU1YWGQwUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9',1787386214);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'site_name','ALzis STURR','2026-08-21 23:17:41','2026-08-21 23:17:41'),(2,'site_tagline','Jual Beli & Japost Akun Game Terpercaya #1 di Indonesia','2026-08-21 23:17:41','2026-08-21 23:17:41'),(3,'discord_invite_url','https://discord.gg/alzis-sturr','2026-08-21 23:17:41','2026-08-21 23:17:41'),(4,'instagram_username','alzis_sturr','2026-08-21 23:17:41','2026-08-21 23:17:41'),(5,'tiktok_username','emu_velz','2026-08-21 23:17:41','2026-08-21 23:54:08'),(6,'banner_announcement','🔥 PROMO SPESIAL ALzis STURR! Transaksi Cepat & 100% Anti Hackback via Discord.','2026-08-21 23:17:41','2026-08-21 23:54:08'),(7,'guarantee_text','Garansi 100% Aman | Anti Hackback | Legal & Bersih | Fast Respond 24 Jam via Discord','2026-08-21 23:17:41','2026-08-21 23:54:08'),(8,'rules_text','1. Pilih akun yang ingin dibeli lalu klik \'Beli via Discord Ticket\' atau hubungi Instagram / TikTok kami.\n2. Buka Ticket Transaksi di Discord Server ALzis STURR.\n3. Admin ALzis STURR akan memberikan detail pembayaran resmi.\n4. Lakukan pembayaran dan kirimkan bukti transfer di Ticket Discord.\n5. Admin memproses serah terima data akun (email/password/bind) sampai selesai dan terverifikasi aman.','2026-08-21 23:17:41','2026-08-21 23:54:08');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `is_banned` tinyint(1) NOT NULL DEFAULT 0,
  `ban_reason` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin ALzis STURR','velzgud@gmail.com','owner',0,NULL,NULL,NULL,'082324634848',NULL,'$2y$12$jWJpXKtK6xtaRR43XWU6puzgXj.D9WdWCClntu2Akkr6FL0BIA1TC',NULL,'2026-08-21 23:17:40','2026-08-22 00:40:51'),(2,'Gamer Sultan','user@alzis.com','user',0,NULL,NULL,NULL,'081234567890',NULL,'$2y$12$sodrcIIsEBX0u7iMa9G6k.4hK57a8R5iabJ2Dn6UuiVuqOosNusFy',NULL,'2026-08-21 23:17:41','2026-08-21 23:17:41'),(3,'PelawakHor','kurirkelilit@gmail.com','user',0,NULL,NULL,NULL,NULL,NULL,'$2y$12$zWjN1gu8zMCBpnQRx6Ua7er.P0gZPSUwtcx4.EXlkYk/tUyK43GiS',NULL,'2026-08-22 00:09:13','2026-08-22 00:09:13');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishlists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `game_account_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlists_user_id_game_account_id_unique` (`user_id`,`game_account_id`),
  KEY `wishlists_game_account_id_foreign` (`game_account_id`),
  CONSTRAINT `wishlists_game_account_id_foreign` FOREIGN KEY (`game_account_id`) REFERENCES `game_accounts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-22 16:02:29
