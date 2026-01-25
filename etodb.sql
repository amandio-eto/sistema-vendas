-- MySQL dump 10.13  Distrib 9.4.0, for macos15.4 (arm64)
--
-- Host: localhost    Database: etodb
-- ------------------------------------------------------
-- Server version	9.4.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `client_name` (`client_name`),
  UNIQUE KEY `client_id` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (10,'ETO-BALIDE','CL-001','Rua Bairo-Pite Hudi Laran, Dili Timor-Leste','+67077027766','JoseAmandiodeAlmeida021099@gmail.com','2026-01-25 01:04:55','2026-01-25 01:04:55',NULL);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drivers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `driver_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drivers`
--

LOCK TABLES `drivers` WRITE;
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;
INSERT INTO `drivers` VALUES (7,'JOSE AMANDIO DE ALMEIDA','+67077027766','2026-01-25 00:37:52','2026-01-25 00:37:52',NULL),(8,'Quitao Minguel Viera','+67077027766','2026-01-25 00:37:57','2026-01-25 00:37:57',NULL);
/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code_product` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `quality` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (21,'P0098','GASOLINE','RON98','2026-01-25 01:01:17','2026-01-25 01:01:17',NULL),(22,'P0010','DIESEL','10PPM','2026-01-25 11:59:48','2026-01-25 11:59:48',NULL),(23,'P0092','GASOLINE','RON92','2026-01-25 12:00:07','2026-01-25 12:00:07',NULL),(24,'P00JA1','JET-A1','JET-A1','2026-01-25 12:00:18','2026-01-25 12:00:18',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `approved` varchar(255) DEFAULT NULL,
  `do_number` bigint unsigned DEFAULT NULL,
  `lo_number` bigint unsigned DEFAULT NULL,
  `so_number` varchar(255) DEFAULT NULL,
  `product_type` varchar(255) DEFAULT NULL,
  `id_product` int DEFAULT NULL,
  `authorized_by` varchar(255) DEFAULT NULL,
  `approve_number` varchar(255) DEFAULT NULL,
  `id_user` bigint unsigned DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `statusedit` tinyint(1) DEFAULT '0',
  `quantity` decimal(13,2) unsigned DEFAULT NULL,
  `id_client` int DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `id_driver` int DEFAULT NULL,
  `driver_name` varchar(255) DEFAULT NULL,
  `plat_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `button` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `do_number` (`do_number`),
  KEY `id_product` (`id_product`),
  KEY `id_user` (`id_user`),
  KEY `id_client` (`id_client`),
  KEY `id_driver` (`id_driver`),
  CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`),
  CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`id_driver`) REFERENCES `drivers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (19,'JoseAmandio de Almeida',100,1212,'1212','P0010-10PPM',22,'IT MANAGER','5335',19,1,0,5000.00,10,'ETO-BALIDE',7,'JOSE AMANDIO DE ALMEIDA','A53-20','2026-01-25 17:23:32','2026-01-25 17:33:38',NULL,0),(20,'JoseAmandio de Almeida',101,1212,'1212','P0010-10PPM',22,'IT MANAGER','3756',19,1,0,12121.00,10,'ETO-BALIDE',8,'Quitao Minguel Viera','P2413','2026-01-25 17:26:08','2026-01-25 17:33:37',NULL,0);
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_logs`
--

DROP TABLE IF EXISTS `user_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_logs_user_id_fk` (`user_id`),
  CONSTRAINT `user_logs_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_logs`
--

LOCK TABLES `user_logs` WRITE;
/*!40000 ALTER TABLE `user_logs` DISABLE KEYS */;
INSERT INTO `user_logs` VALUES (2,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','Register User ..','2026-01-23 14:28:26','2026-01-23 14:28:26'),(3,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','DELETE','Delete User ..','2026-01-23 15:16:36','2026-01-23 15:16:36'),(4,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Create Product ..','2026-01-23 16:22:07','2026-01-23 16:22:07'),(5,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','DELETE','User Delete Client','2026-01-23 16:26:37','2026-01-23 16:26:37'),(6,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','Register User ..','2026-01-23 16:39:16','2026-01-23 16:39:16'),(7,18,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','DELETE','User Delete Product ..','2026-01-23 16:39:57','2026-01-23 16:39:57'),(8,18,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Create Product ..','2026-01-23 16:56:55','2026-01-23 16:56:55'),(9,18,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Create Product ..','2026-01-23 16:57:11','2026-01-23 16:57:11'),(10,18,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','PUT','User Update Product ..','2026-01-23 16:57:18','2026-01-23 16:57:18'),(11,18,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','PUT','User Update Product ..','2026-01-23 16:57:24','2026-01-23 16:57:24'),(12,18,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','PUT','User Update Product ..','2026-01-23 16:57:31','2026-01-23 16:57:31'),(13,18,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Create Product ..','2026-01-23 16:57:54','2026-01-23 16:57:54'),(14,18,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Create Product ..','2026-01-23 16:58:15','2026-01-23 16:58:15'),(15,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Create Product ..','2026-01-24 03:00:14','2026-01-24 03:00:14'),(16,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','PUT','User Update Product ..','2026-01-24 03:07:10','2026-01-24 03:07:10'),(17,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Register Client','2026-01-24 03:17:36','2026-01-24 03:17:36'),(18,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','DELETE','User Delete Client','2026-01-24 03:17:43','2026-01-24 03:17:43'),(19,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Register Client','2026-01-24 03:22:39','2026-01-24 03:22:39'),(20,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','DELETE','User Delete Client','2026-01-24 03:22:45','2026-01-24 03:22:45'),(21,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Register Client','2026-01-24 03:23:02','2026-01-24 03:23:02'),(22,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','DELETE','User Delete Client','2026-01-24 06:09:33','2026-01-24 06:09:33'),(23,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','DELETE','User Delete Product ..','2026-01-24 06:09:39','2026-01-24 06:09:39'),(24,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','DELETE','User Delete Product ..','2026-01-24 06:09:41','2026-01-24 06:09:41'),(25,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','DELETE','User Delete Product ..','2026-01-24 06:09:43','2026-01-24 06:09:43'),(26,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','DELETE','User Delete Product ..','2026-01-24 06:09:46','2026-01-24 06:09:46'),(27,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','DELETE','User Delete Product ..','2026-01-24 06:09:48','2026-01-24 06:09:48'),(28,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Create Product ..','2026-01-25 01:01:17','2026-01-25 01:01:17'),(29,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Register Client','2026-01-25 01:04:55','2026-01-25 01:04:55'),(30,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Create Product ..','2026-01-25 11:59:48','2026-01-25 11:59:48'),(31,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Create Product ..','2026-01-25 12:00:07','2026-01-25 12:00:07'),(32,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Create Product ..','2026-01-25 12:00:18','2026-01-25 12:00:18'),(33,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Add New 1212','2026-01-25 16:33:42','2026-01-25 16:33:42'),(34,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','PUT','User Request to Edit DO','2026-01-25 16:34:38','2026-01-25 16:34:38'),(35,18,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','Register User ..','2026-01-25 17:15:37','2026-01-25 17:15:37'),(36,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','PUT',' Update Users ..','2026-01-25 17:16:09','2026-01-25 17:16:09'),(37,19,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Add New 1212','2026-01-25 17:23:32','2026-01-25 17:23:32'),(38,19,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','POST','User Add New 1212','2026-01-25 17:26:08','2026-01-25 17:26:08'),(39,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','PUT','User Request to Edit DO','2026-01-25 17:33:37','2026-01-25 17:33:37'),(40,16,'JOSEs-MacBook-Pro.local','127.0.0.1','Chrome','143.0.0.0','OS X','Macintosh','PUT','User Request to Edit DO','2026-01-25 17:33:38','2026-01-25 17:33:38');
/*!40000 ALTER TABLE `user_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` enum('administrator','staff','manager') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roleid` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `possition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (16,'+67077027766','administrator',1,'JoseAmandio de Almeida','JoseAmandiodeAlmeida021099@gmail.com',NULL,'$2y$10$uZM2tzsuYSC5WG01oCEGE.cGSqvR29fomHb2dBnIMVgJ6zTmKNauq','IT MANAGER',1,'profile_photos/vZsXWEvVuNfUHDTg8SmHWybnhwZYWvRZsURJn3er.jpg',NULL,'2026-01-23 14:26:51','2026-01-25 16:00:42','female'),(18,'+67077027766','administrator',1,'Tita','amandio.almeida@eto.tl',NULL,'$2a$12$kDO.OfVYf9aqia9zhAm8LupXzkkz1FGxupTWTFuCLxrugSqDMbo12','IT MANAGER',1,NULL,NULL,'2026-01-23 16:39:16','2026-01-25 15:12:26','female'),(19,'+67077027766','staff',1,'test','test@test.com',NULL,'$2y$10$E0jip5Q3ntrPs3D7HZl4DOnrxBnaS4LduP/mE7NF/DmgLeImr5mqa','test',1,NULL,NULL,'2026-01-25 17:16:09','2026-01-25 17:16:09','male');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-26  2:51:56
