CREATE DATABASE  IF NOT EXISTS `starwars` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `starwars`;
-- MySQL dump 10.13  Distrib 8.0.40, for macos14 (arm64)
--
-- Host: 127.0.0.1    Database: starwars
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `affiliations`
--

DROP TABLE IF EXISTS `affiliations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `affiliations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `affiliation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `character_affiliations`
--

DROP TABLE IF EXISTS `character_affiliations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `character_affiliations` (
  `id_character` int NOT NULL,
  `id_affiliation` int NOT NULL,
  PRIMARY KEY (`id_character`,`id_affiliation`),
  KEY `id_affiliation` (`id_affiliation`),
  CONSTRAINT `character_affiliations_ibfk_1` FOREIGN KEY (`id_character`) REFERENCES `characters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `character_affiliations_ibfk_2` FOREIGN KEY (`id_affiliation`) REFERENCES `affiliations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `character_films`
--

DROP TABLE IF EXISTS `character_films`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `character_films` (
  `id_character` int NOT NULL,
  `id_film` int NOT NULL,
  PRIMARY KEY (`id_character`,`id_film`),
  KEY `id_film` (`id_film`),
  CONSTRAINT `character_films_ibfk_1` FOREIGN KEY (`id_character`) REFERENCES `characters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `character_films_ibfk_2` FOREIGN KEY (`id_film`) REFERENCES `films` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `characters`
--

DROP TABLE IF EXISTS `characters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `characters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text,
  `height` int DEFAULT NULL,
  `mass` float DEFAULT NULL,
  `hair_color` text,
  `skin_color` text,
  `eye_color` text,
  `birth_year` text,
  `gender` text,
  `planet_id` int NOT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `url` text,
  PRIMARY KEY (`id`),
  KEY `planet_id` (`planet_id`),
  CONSTRAINT `characters_ibfk_1` FOREIGN KEY (`planet_id`) REFERENCES `planets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `deaths`
--

DROP TABLE IF EXISTS `deaths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deaths` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_character` int DEFAULT NULL,
  `id_killer` int DEFAULT NULL,
  `id_film` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_character` (`id_character`),
  KEY `id_killer` (`id_killer`),
  KEY `id_film` (`id_film`),
  CONSTRAINT `deaths_ibfk_1` FOREIGN KEY (`id_character`) REFERENCES `characters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `deaths_ibfk_2` FOREIGN KEY (`id_killer`) REFERENCES `characters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `deaths_ibfk_3` FOREIGN KEY (`id_film`) REFERENCES `films` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `films`
--

DROP TABLE IF EXISTS `films`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `films` (
  `id` int NOT NULL AUTO_INCREMENT,
  `episode` varchar(12) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `planets`
--

DROP TABLE IF EXISTS `planets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text,
  `rotation_period` int DEFAULT NULL,
  `orbital_period` int DEFAULT NULL,
  `diameter` int DEFAULT NULL,
  `climate` text,
  `gravity` text,
  `terrain` text,
  `surface_water` text,
  `population` bigint DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `url` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-25 19:14:03
