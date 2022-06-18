-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: salononline
-- ------------------------------------------------------
-- Server version	8.0.29

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'uncategorized'),(6,'uncategorizedf'),(7,'another category'),(8,'tes category');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coiffeurs`
--

DROP TABLE IF EXISTS `coiffeurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coiffeurs` (
  `user_id` int NOT NULL,
  `city` varchar(255) NOT NULL,
  `quartier` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `store_title` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `work_hours` varchar(255) NOT NULL,
  `work_days` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coiffeurs`
--

LOCK TABLES `coiffeurs` WRITE;
/*!40000 ALTER TABLE `coiffeurs` DISABLE KEYS */;
INSERT INTO `coiffeurs` VALUES (1,'taroudant','derb cherif','09292922','salon taroudant','profile_img_165524714836032_img.png','[[\"10:30\",\"16:00\"]]','[0,1,2]'),(1,'taroudant','derb cherif','09292922','salon taroudant','profile_img_165524714836032_img.png','[[\"10:30\",\"16:00\"]]','[0,1,2]'),(1,'taroudant','derb cherif','09292922','salon taroudant','profile_img_165524714836032_img.png','[[\"10:30\",\"16:00\"]]','[0,1,2]'),(1,'taroudant','derb cherif','09292922','salon taroudant','profile_img_165524714836032_img.png','[[\"10:30\",\"16:00\"]]','[0,1,2]'),(1,'taroudant','derb cherif','09292922','salon taroudant','profile_img_165524714836032_img.png','[[\"10:30\",\"16:00\"]]','[0,1,2]'),(16,'Agadir','awrirtamazirt','0565656565','salon agra','profile_img_165524714836032_img.png','[[\"12:00\",\"22:00\"]]','[2,1,3]'),(19,'Mohammedia','quartier taghazout','0610204662','salon taghazout','not_uploaded','[[\"08:00\",\"23:59\"]]','[2,3,4]'),(20,'Ouarzazate','tamazirt','0667878977','salon nakh','profile_img_165533742892852_img.gif','[[\"08:00\",\"23:59\"]]','[2,3,4]'),(21,'El Kelaa des Srarhna','test','0610207687','test salon','profile_img_165533781997897_img.jpeg','[[\"08:00\",\"23:59\"]]','[1,2]'),(23,'Casablanca','tamazirt','0610204662','salon tamazirt','profile_img_165545832649529_img.jpeg','[[\"08:00\",\"23:59\"]]','[2,3]');
/*!40000 ALTER TABLE `coiffeurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `user_id` int NOT NULL,
  `phone` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (7,'0657668876','profile_img_165523842396650_img.jpeg'),(10,'0610204662','profile_img_165523842396650_img.jpeg'),(11,'0610204662','profile_img_165523842396650_img.jpeg'),(12,'0610204662','profile_img_16552457337554_img.jpeg'),(17,'0610204662','profile_img_165532641174301_img.jpeg'),(18,'0620202020','not_uploaded'),(20,'0678657687','profile_img_165542907176255_img.jpeg'),(22,'0645342356','not_uploaded');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_requests`
--

DROP TABLE IF EXISTS `service_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_requests` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `service_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_requests`
--

LOCK TABLES `service_requests` WRITE;
/*!40000 ALTER TABLE `service_requests` DISABLE KEYS */;
INSERT INTO `service_requests` VALUES (30,'33','2022-06-02','02:31:00','2','20','2022-06-17 02:26:57','2022-06-17 02:26:57'),(31,'33','2022-06-23','16:09:00','1','22','2022-06-17 16:03:08','2022-06-17 16:03:08');
/*!40000 ALTER TABLE `service_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `coiffeur_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (33,'nike service','service_img_165533484662021_img.jpeg','zeze','12',6,19);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'omar kazoum','1','$2y$10$0eqWoG4PS9xS3wEk1iuSYu7BJYhSrs2Pqxewc2zDmNHCYtORynNem','omar','kazoum','admin@gmail.Com'),(17,'client name','2','$2y$10$0eqWoG4PS9xS3wEk1iuSYu7BJYhSrs2Pqxewc2zDmNHCYtORynNem','client ','name','pilupoh@mailinator.com'),(18,'coiffeur name','2','$2y$10$0eqWoG4PS9xS3wEk1iuSYu7BJYhSrs2Pqxewc2zDmNHCYtORynNem','coiffeur','name','coiffeur2@gmail.com'),(19,'coiffeur native','3','$2y$10$0eqWoG4PS9xS3wEk1iuSYu7BJYhSrs2Pqxewc2zDmNHCYtORynNem','coiffeur','native','coiffeurnative@email.com'),(20,'mailinator dddj','2','$2y$10$0eqWoG4PS9xS3wEk1iuSYu7BJYhSrs2Pqxewc2zDmNHCYtORynNem','Abbotj','Woodsj','client@gmail.Comgj'),(21,'gmail','3','$2y$10$0eqWoG4PS9xS3wEk1iuSYu7BJYhSrs2Pqxewc2zDmNHCYtORynNem','Hop','Harding','mejymyty@mailinator.com'),(22,'client TRj','2','$2y$10$PlnvkjBzaqJWPB9JUdeXpeuSb3XuBuahdIpMvBEokRi00nL4nGhxq','client OKi','name hhj','client@gmail.Com'),(23,'coiffeur maintenant','3','$2y$10$5JYtXJ.9tEddp4M8S3hdWuKHM4i0GzpirJhrXvS1ACZmXSjEhHEru','coiffeur','ahmed','coiffeur@gmail.com');
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

-- Dump completed on 2022-06-17 19:36:25
