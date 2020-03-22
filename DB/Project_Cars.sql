-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: Project_Cars
-- ------------------------------------------------------
-- Server version	8.0.19-0ubuntu0.19.10.3

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
-- Table structure for table `allCars`
--

DROP TABLE IF EXISTS `allCars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `allCars` (
  `carPlate` varchar(11) NOT NULL,
  `idCon` varchar(5) NOT NULL,
  `brand` varchar(45) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `seats` int DEFAULT NULL,
  `doors` int DEFAULT NULL,
  `gearShift` varchar(45) DEFAULT NULL,
  `typeEngine` varchar(45) DEFAULT NULL,
  `cv` int DEFAULT NULL,
  `maxSpeed` int DEFAULT NULL,
  `roads` varchar(60) DEFAULT NULL,
  `extras` varchar(10) DEFAULT NULL,
  `startDate` varchar(45) DEFAULT NULL,
  `endDate` varchar(45) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `views` int NOT NULL,
  PRIMARY KEY (`carPlate`),
  KEY `idCon_idx` (`idCon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allCars`
--

LOCK TABLES `allCars` WRITE;
/*!40000 ALTER TABLE `allCars` DISABLE KEYS */;
INSERT INTO `allCars` VALUES ('1254-NBC','CM005','Ford','Focus',5,6,'Manual','Electric',42,455,'City:','No','01/23/2020','01/18/2020',NULL,2),('2149-AHR','AO006','Porsche','Cayenne',4,3,'Manual','Electric',443,434,'Road:','No','01/13/2020','01/11/2020','porsche-cayenne.jpg',1),('5113-CBV','AN004','Seat','Leon',6,6,'Manual','Hybrid',100,250,'Road:','Yes','03/26/2020','03/21/2020',NULL,1),('5209-FGH','CM005','Mazda','Serie 3',5,6,'Manual','Electric',123,543,'Roadway:','No','01/01/2020','01/25/2020',NULL,0),('5331-HGK','AN004','Toyota','GT 86',3,3,'Auto','Electric',542,444,'Roadway:','No','01/16/2020','01/25/2020','toyota-gt86.jpg',14),('5432-CDF','UM007','Seat','Ibiza',6,5,'Auto','Electric',134,543,'Roadway:','No','01/11/2020','01/29/2020','seat-ibiza.jpg',2),('5523-APH','AS002','Subaru','Impreza',6,5,'Manual','Combustion',125,250,'Roadway:','Yes','03/23/2020','03/18/2020',NULL,3),('5555-OOO','AS002','Seat','Test 1',4,4,'Auto','Electric',123,543,'Roadway:','Yes','01/08/2020','01/04/2020',NULL,6),('5746-GHJ','AO001','Tesla','Model 3',6,5,'Auto','Electric',123,544,'City:','No','01/15/2020','01/11/2020',NULL,1),('6317-DFG','AO006','Chevrolet','Camaro',4,3,'Manual','Electric',433,334,'City:','No','01/22/2020','01/02/2020','chevrolet-camaro.jpg',0),('6847-GHB','AN004','Ford','Mustang',3,5,'Auto','Electric',123,654,'City:Rural:','No','01/07/2020','01/18/2020',NULL,2),('7584-CVB','CM005','Tesla','Roadster',5,6,'Manual','Electric',124,234,'Roadway:','No','01/15/2020','01/10/2020','tesla-modely.jpg',1),('8771-BVV','AS002','Opel','Grand Land',6,5,'Manual','Combustion',100,200,'Road:','No','03/17/2020','03/18/2020','opel-grandland.jpg',3),('9521-BNV','UM007','Porsche','Taycan',5,3,'Auto','Electric',100,250,'Roadway:','Yes','03/18/2020','03/13/2020',NULL,1);
/*!40000 ALTER TABLE `allCars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brandCars`
--

DROP TABLE IF EXISTS `brandCars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brandCars` (
  `brandID` int NOT NULL AUTO_INCREMENT,
  `brand` varchar(45) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `views` int NOT NULL,
  PRIMARY KEY (`brandID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brandCars`
--

LOCK TABLES `brandCars` WRITE;
/*!40000 ALTER TABLE `brandCars` DISABLE KEYS */;
INSERT INTO `brandCars` VALUES (1,'Ford','view/img/Ford_logo.png',6),(2,'Porsche','view/img/Porsche_logo.png',6),(3,'Mazda','view/img/Mazda_logo.png',4),(4,'Toyota','view/img/Toyota_logo.png',0),(5,'Seat','view/img/Seat_logo.png',0),(6,'Aston Martin','view/img/Aston-Martin_logo.png',1),(7,'Tesla','view/img/Tesla_logo.png',1),(8,'Chevrolet','view/img/Chevrolet_logo.png',2);
/*!40000 ALTER TABLE `brandCars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `concessionaire`
--

DROP TABLE IF EXISTS `concessionaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `concessionaire` (
  `idCon` varchar(5) NOT NULL,
  `nameCon` varchar(45) NOT NULL,
  `locationCon` varchar(45) NOT NULL,
  `province` varchar(45) NOT NULL,
  PRIMARY KEY (`idCon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `concessionaire`
--

LOCK TABLES `concessionaire` WRITE;
/*!40000 ALTER TABLE `concessionaire` DISABLE KEYS */;
INSERT INTO `concessionaire` VALUES ('AN004','Ancrisa','40.383640, -3.769406','Madrid'),('AO001','Auto Ocasion','39.486391, -0.399266','Valencia'),('AO006','Auto Clariano','39.110888, -1.512402','Murcia'),('AS002','Auto Salon','41.361016, -1.965214','Zaragoza'),('CM005','Conde Motor','39.796542, -5.412776','Extremadura'),('GA003','Gyata','42.486326, -6.546507','Galicia'),('UM007','Ulsan Motor','38.828443, -0.599987','Alicante');
/*!40000 ALTER TABLE `concessionaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `username` varchar(15) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `registerDate` varchar(50) NOT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('javier','jajajajxd5@gmail.com','$2y$10$uw2WExJ4BywIRghv/ugwTuBrsu2Sg.nBEq7C6LrWegwYf2PV.yE5i','0','https://avatars.dicebear.com/v2/jdenticon/de9d0980398db0a5f2096a237de02ff1.svg','client'),('maribel','maribel@marel.com','$2y$10$Pq77JoP0HI5.QAPM4DB2vOIZfSiBmdcn06hlYG8ClosSuFSTWYmzK','0','https://avatars.dicebear.com/v2/jdenticon/ff5d2a19357c8cddb15e5b395f0c9546.svg','client'),('oscar','oscar@oscar.com','$2y$10$7f19VmMlGiz/HqWjiX1wh.0wZgLQ6q9dWXZKgSa2UpbSKt0a0or9m','0','https://avatars.dicebear.com/v2/jdenticon/c6bfc2c772a018961f45f16fb1f6a21b.svg','admin'),('raul2020','raul2020@gmail.com','$2y$10$hVTWlPXGFu5hkdpr3AawpOOlN271q/IIAdYbCwo3nZPUAzPVfBJIC','2020/03/20','https://avatars.dicebear.com/v2/jdenticon/193de084eec71a10bdd72876a05935d2.svg','client'),('xemita','xemita@xema.com','$2y$10$9.i3kRftnpZWa7Zbz/euVuS2OBHC93/93oE4F9Yg1cqipfi9U9VnW','0','https://avatars.dicebear.com/v2/jdenticon/a0856e9c73302111df5d32794b62271b.svg','client');
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

-- Dump completed on 2020-03-22 13:02:53
