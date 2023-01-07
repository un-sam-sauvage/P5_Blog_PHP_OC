-- MariaDB dump 10.18  Distrib 10.4.17-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: socialnetwork
-- ------------------------------------------------------
-- Server version	10.4.17-MariaDB

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
-- Table structure for table `codes`
--

DROP TABLE IF EXISTS `codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codes`
--

LOCK TABLES `codes` WRITE;
/*!40000 ALTER TABLE `codes` DISABLE KEYS */;
INSERT INTO `codes` VALUES (1,'<?php \r\n\r\nsession_start();\r\nrequire(\"filters/guest_filter.php\");\r\nrequire(\"config/database.php\");\r\nrequire(\"includes/functions.php\");\r\n\r\n\r\nif(isset($_POST[\"save\"])){\r\n    if(!empty($_POST[\"code\"])){\r\n\r\n        extract($_POST);\r\n\r\n        $q = $db->prepare(\"INSERT INTO codes(code) VALUES(?)\");\r\n        $q->execute([$code]);\r\n\r\n\r\n\r\n    }else{\r\n        redirect(\"share_code.php\");\r\n    }\r\n}\r\n\r\n\r\n\r\nrequire(\"views/share_code.view.php\");\r\n\r\n?>'),(2,'this is a test code'),(3,'<?php \r\n\r\nsession_start();\r\nrequire(\"filters/guest_filter.php\");\r\nrequire(\"config/database.php\");\r\nrequire(\"includes/functions.php\");\r\n\r\n\r\nif(isset($_POST[\"save\"])){\r\n    if(!empty($_POST[\"code\"])){\r\n\r\n        extract($_POST);\r\n\r\n        $q = $db->prepare(\"INSERT INTO codes(code) VALUES(?)\");\r\n        $q->execute([$code]);\r\n\r\n\r\n\r\n    }else{\r\n        redirect(\"share_code.php\");\r\n    }\r\n}\r\n\r\n\r\n\r\nrequire(\"views/share_code.view.php\");\r\n\r\n?> je rajoute ceci');
/*!40000 ALTER TABLE `codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `commentId` int(11) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `isAuthorized` tinyint(4) DEFAULT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `title` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_author_id` (`author`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES ('autre titre 2 ','autre contenu 2',2,5,'2022-12-15 14:27:41','2022-12-15 14:30:13'),('Lorem ipsum','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',4,5,'2022-12-15 14:27:41','2022-12-15 14:30:13');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `active` enum('0','1') DEFAULT '0',
  `created_at` datetime DEFAULT current_timestamp(),
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `is_nice` enum('true','false') DEFAULT 'false',
  `bio` text DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'un_sam_sauvage','samuel.brb19@gmail.com','$2b$10$x/0iPp/JPEZt03aoRj1SoeLhJxd3DjloJ.GxEwLuHnXjLITgkFXvW','0','2022-04-26 18:36:32','Samuel','','','false','',0),(2,'un_sam_sauva','samuel.brb19@gmail.co','$2b$10$td6/UDvG5tmtJHH/uISqcOTDBnG1mIRIlPYNkCdcsKg0HJlI5gZHy','0','2022-04-28 11:23:24',NULL,NULL,NULL,'false',NULL,0),(3,'SamSmax',NULL,'$2y$10$HcyyK1idqLdbyeg0LBtFrOBQhxlqKiN5mOHrpIBzJ06U5lWTyk7la','0','2022-07-18 12:17:38',NULL,NULL,NULL,'false',NULL,0),(4,'smax','samuel.brb19@gmail.net','$2y$10$Smh2fVDBqLVWy8T3AB9YyOsixXF0UU23WDwygvL2RclI.tx6f3kee','0','2022-10-27 13:00:00',NULL,NULL,NULL,'false',NULL,0),(5,'todolechat','todolechat@gmail.com','$2y$10$Oy932rT.F8nhlSPiN7h/Tu1G4FGWhUN8gZ53TSW/R5jaxhO1W55Ua','0','2022-11-04 23:54:00',NULL,NULL,'','false','description another one',0),(6,'todoLeChaton','todoLechaton@gmail.com','$2y$10$9UDJo0BlKNnZLl7SptbAeOR2Vq7UMp6yNio21xgHtHeu06XrRjyqi','0','2022-11-04 23:55:18',NULL,NULL,NULL,'false',NULL,0),(7,'newUser','samuel@gmail.com','$2y$10$GcnMkdX6C8bYJXdy8WhvT.4KlFoihgRC/5kUTKPbiXaZUNMwDt0WG','0','2022-11-18 09:50:11',NULL,NULL,NULL,'false',NULL,0);
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

-- Dump completed on 2022-12-27 19:23:14
