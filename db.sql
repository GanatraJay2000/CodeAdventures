-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: code_adventures
-- ------------------------------------------------------
-- Server version	8.0.22

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
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `branches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `detailed_address` varchar(255) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `region_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`,`region_id`),
  KEY `region_id` (`region_id`),
  CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'Borivali','It is detailed.  Not so much','Borivali','Mumbai',1);
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` bigint NOT NULL,
  `type` varchar(255) NOT NULL,
  `vendor_id` int NOT NULL,
  `man_days` int DEFAULT '0',
  `actual_rate` bigint unsigned DEFAULT NULL,
  `extra_hours` int DEFAULT NULL,
  `extra_hours_amt` bigint unsigned DEFAULT NULL,
  `base_amt` bigint unsigned DEFAULT NULL,
  `no_of_working_sundays` int DEFAULT NULL,
  `sunday_working_amt` bigint unsigned DEFAULT NULL,
  `otp` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_emailNo` (`email`,`phone_no`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (3,'Emp1','emp1@gmail.com',1212,'Custodian',1,13,12,12,12,12,12,12,884189),(4,'Emp2','emp2@gmail.com',1234,'Custodian',1,13,12,16,12,12,12,12,434123),(5,'Emp3','emp3@gmail.com',1212,'Driver',1,1212,12,12,12,12,12,12,NULL),(6,'Emp4','emp4@gmail.com',12456,'Vault Guy',1,24,12,46,12,12,14,12,257277),(7,'Emp5','emp5@gmail.com',1212,'Arm Guard',1,13,12,19,12,12,12,12,NULL),(8,'Emp6','emp6@gmail.com',1212,'Vault Guy',1,12,12,12,12,12,12,12,NULL),(11,'Emp7','emp7@gmail.com',121212,'Custodian',1,2,12,0,12,12,0,12,NULL);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hubs`
--

DROP TABLE IF EXISTS `hubs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hubs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `detailed_address` varchar(255) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `branch_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`,`branch_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `hubs_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hubs`
--

LOCK TABLES `hubs` WRITE;
/*!40000 ALTER TABLE `hubs` DISABLE KEYS */;
INSERT INTO `hubs` VALUES (1,'Samta Nagar','Samta Nagar','Borivali','Mumbai',1),(2,'Station Road','Nr. Station','Borivali','Mumbai',1);
/*!40000 ALTER TABLE `hubs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `regions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `zone_id` int NOT NULL,
  `detailed_address` varchar(255) DEFAULT NULL,
  `main_branch_id` int DEFAULT NULL,
  `phone_no` bigint NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone_no` (`phone_no`),
  UNIQUE KEY `unique_name` (`name`,`zone_id`),
  KEY `zone_id` (`zone_id`),
  CONSTRAINT `regions_ibfk_1` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regions`
--

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` VALUES (1,'North East',1,'Shaitan gali, khatra mahal, andher nagar, shamshan ke samne',NULL,9819203343);
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `detailed_address` varchar(255) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `hub_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`,`hub_id`),
  KEY `hub_id` (`hub_id`),
  CONSTRAINT `sites_ibfk_1` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sites`
--

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;
/*!40000 ALTER TABLE `sites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `emp_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `vehicle_id` int DEFAULT NULL,
  `region_id` int DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `site_id` int DEFAULT NULL,
  `service_type` text,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `opening_km` bigint unsigned DEFAULT NULL,
  `closing_km` bigint unsigned DEFAULT NULL,
  `total_km` int DEFAULT NULL,
  `km_allowances` float DEFAULT NULL,
  `expexted_km` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,6,'2021-07-23',NULL,NULL,NULL,NULL,NULL,'08:00:00','18:05:00',NULL,NULL,NULL,NULL,NULL),(2,3,'2021-07-23',NULL,NULL,NULL,NULL,NULL,'04:08:55','04:10:26',NULL,12,11,NULL,NULL),(7,6,'2021-07-24',NULL,NULL,NULL,NULL,NULL,'08:00:00','09:23:01',NULL,NULL,NULL,NULL,NULL),(8,7,'2021-07-24',NULL,NULL,NULL,NULL,NULL,'08:00:00','23:00:00',NULL,NULL,NULL,NULL,NULL),(11,NULL,'2021-07-24',2,NULL,NULL,NULL,NULL,NULL,NULL,10,12,111,12,NULL),(12,NULL,'2021-07-24',4,NULL,NULL,NULL,NULL,NULL,NULL,144,155,11,NULL,NULL),(13,3,'2021-07-24',NULL,NULL,NULL,NULL,NULL,'09:17:11','09:24:15',NULL,NULL,NULL,NULL,NULL),(14,4,'2021-07-24',NULL,NULL,NULL,NULL,NULL,'10:29:43','10:30:35',NULL,NULL,NULL,NULL,NULL),(15,4,'2021-07-26',NULL,NULL,NULL,NULL,NULL,'08:00:00','20:00:00',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `emp_id` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `access_level` varchar(255) NOT NULL,
  `phone_no` bigint DEFAULT NULL,
  `password` text NOT NULL,
  `otp` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,'Super Admin','superadmin@ca.riidl','100',NULL,'$2y$10$Pj66LsBcO4lEM7rxFsRM6uK76zpBNEi0OYOJmYlb2ZNl.zyJay8Du','0'),(3,2,'Hey there, this is a large title, lets see what happens','roronoax2000@gmail.com','1',NULL,'$2y$10$PkQAbFtvd15BGFJUWCtMEe3I8YcNK6IsQp/HuP2BbFPkLgL3jD3e6','0'),(4,NULL,'Regional 1','gala.av@somaiya.edu','30',NULL,'$2y$10$TU52a0SoqhTK3sqWoavBHeAn7VoOX9tTLiVJDzt2tMCQqTgrqqDEi','0'),(5,NULL,'Vendor1','gala@somaiya.edu','14',NULL,'$2y$10$J0kuXxvK83RlO6Fdc4ZNguhXd/u.fGhxREpHhWFrQS9JVu7I5i.sm','0'),(6,3,'Emp1','emp1@gmail.com','1',NULL,'$2y$10$7MS78iZi9a3bPHEPKLsGy.MqQyk0PYbJU//9PEWq0fxrBzXVCX9nS','0'),(7,4,'Emp2','emp2@gmail.com','1',NULL,'$2y$10$yHQwaYsccYnA1d6sRYhSCetPRyx8Ov3EXW74dD43fjpgydcQkIozi','0'),(8,5,'Emp3','emp3@gmail.com','1',NULL,'$2y$10$.vNqx2SV2qQ/kqgnDf8Gau6uwU.DDPzO.GVjz/ulemCBY8J1HAM0q','0'),(9,6,'Emp4','emp4@gmail.com','1',NULL,'$2y$10$kh1jNDXuj.niB07BXUymUOaRtFL1F8RpLy.9IlpdKK2KUZpxoV.sW','0'),(10,7,'Emp5','emp5@gmail.com','1',NULL,'$2y$10$tb0yVN3QSn9qMSSImWVW4ulgz2CPZ8Xv6sfG6Pw9defngl8BPJE2m','0'),(11,8,'Emp6','emp6@gmail.com','1',NULL,'$2y$10$SDOs38GyrCzo9tLB8oFCIuMtaXmAefojsVr28XBYrOJCfR09r39HC','0'),(12,9,'Emp7','emp7@gmail.com','1',NULL,'$2y$10$FczmL8m7BKqND5zztNZ7a.K3wY/KNfo/jZovhgoC0BiFESjnRiNxG','0');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_id` varchar(255) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `details` text,
  `vendor_id` int DEFAULT NULL,
  `total_kms` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (2,'1','two-wheeler','1',1,111),(3,'2','two-wheeler','2',1,0),(4,'3','four-wheeler','3',1,11),(5,'4','four-wheeler','4',1,0),(6,'5','two-wheeler','5',1,0);
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` bigint NOT NULL,
  `no_of_employees` int NOT NULL,
  `region_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone_no` (`phone_no`),
  UNIQUE KEY `unique_name` (`name`,`region_id`),
  KEY `region_id` (`region_id`),
  CONSTRAINT `vendors_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
INSERT INTO `vendors` VALUES (1,'Demo Vendor','jbg@somaiya.edu',9819203343,113,1);
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zones`
--

DROP TABLE IF EXISTS `zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `main_branch_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zones`
--

LOCK TABLES `zones` WRITE;
/*!40000 ALTER TABLE `zones` DISABLE KEYS */;
INSERT INTO `zones` VALUES (1,'Northern',12345);
/*!40000 ALTER TABLE `zones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-24 12:59:24
