-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: herbs
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `joined_on` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Emmanuel','Mmanda','Admin','81dc9bdb52d04dc20036dbd8313ed055','active','2022-06-13');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicine`
--

DROP TABLE IF EXISTS `medicine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicine` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `mname` varchar(255) NOT NULL,
  `mdescription` text NOT NULL DEFAULT 'Herbs for general Health of the body',
  `mcategory` varchar(255) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Allowed',
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicine`
--

LOCK TABLES `medicine` WRITE;
/*!40000 ALTER TABLE `medicine` DISABLE KEYS */;
INSERT INTO `medicine` VALUES (47,'Cilliata','I treats fever and ulcers plus general health of body','Herbs for Health','Mwaka','Allowed','med1.webp'),(48,'Globulus','Treats skin infections and other skin disorders','Skin Infections','Mwaka','Allowed','med2.jpg'),(49,'Indica','Blood Purifier and Astringent in the body.','Sexual Transmitted Diseases','Mwaka','Allowed','med3.webp'),(50,'Aristata','Treats both scabiies and other skin infections in the body.','Skin Infections','Samara','Allowed','med5.jpg'),(51,'Sativa','Deals with problem in the Urinary track of women ,Infertitily','Fertility[ Women ]','Samara','disaproved','med6.jpg');
/*!40000 ALTER TABLE `medicine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `joined_on` date NOT NULL DEFAULT current_timestamp(),
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (12,'Lulu ','Michael','Lulu','81dc9bdb52d04dc20036dbd8313ed055','lulum@yahoo.com',769642928,'images2.jpg','2022-06-21','Mbeya, Tanzania'),(13,'ibrah','david','ibrah','81dc9bdb52d04dc20036dbd8313ed055','ibrah@gmail.com',767675645,'images5.jpg','2022-06-21','Sinza Daressalaam');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practitioner`
--

DROP TABLE IF EXISTS `practitioner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `practitioner` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `office_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `professionality` varchar(255) NOT NULL,
  `bio` varchar(1000) NOT NULL,
  `nida` varchar(25) NOT NULL,
  `businesslicense` varchar(100) NOT NULL,
  `facebook` varchar(250) NOT NULL,
  `twitter` varchar(250) NOT NULL,
  `joined_on` date NOT NULL DEFAULT current_timestamp(),
  `is_new` int(11) NOT NULL DEFAULT 0,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `license` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practitioner`
--

LOCK TABLES `practitioner` WRITE;
/*!40000 ALTER TABLE `practitioner` DISABLE KEYS */;
INSERT INTO `practitioner` VALUES (34,'Issack','Yohana',769642928,'isaka@gmsil.com','Isa Herbs','Mbeya Mjini','Issack','81dc9bdb52d04dc20036dbd8313ed055','images3.jpg','Sexual Transmitted Diseases','I deal with sexually transmitted diseases by using Traditional medical herbs','','','facebook.com/issaherbs','twitter.com/issaherbs','2022-06-21',1,'user','',0),(35,'Baraka ','Mbogola',767675645,'baraka@gamil.com','BR Herbs','Sinza Daressalaam','Baraka','81dc9bdb52d04dc20036dbd8313ed055','images8.png','Fertility[ Men ]','I deal with mens fertility using herbal medicine','','','facebook.com/br','twitter.com/br','2022-06-21',1,'user','',0),(36,'Deo','Casmiry',769642928,'deo@gmail.com','toby herbs','moshi kirimanjaro','Deo','81dc9bdb52d04dc20036dbd8313ed055','images6.jpg','Skin Infections','i deal with skin infections using traditional medicine','','','facebook.com/issaherbs','twitter.com/hbers','2022-06-21',1,'user','',0),(37,'LINAH','PETER',767985435,'samara@gmail.com','LINAH MEDICAL CARE','Kimara, Dar es saalam','Samara','81dc9bdb52d04dc20036dbd8313ed055','images9.jpg','Dental Care','Get plant medicine that treats all dental infections.','434354564657676756434','bussineslicense1.jpg','facebook.com/dental ','twitter.com/dental','2022-06-21',1,'user','doctor license1.jpg',1),(38,'Mwaka','Docta',768686656,'mwaka@yahoo.com','Dr.Mwaka','Dodoma- Tanzania','Mwaka','81dc9bdb52d04dc20036dbd8313ed055','sampe4.jpeg','Fertility[ Women ]','I deal with women\'s fertility using herbal medicine.\r\n','65656565545454434346465','Business-license-2.webp','facebook.com/dkmwaka','twitter.com/dkmwaka','2022-06-21',1,'user','doctorlicense2.jpg',1);
/*!40000 ALTER TABLE `practitioner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `review_type` varchar(60) NOT NULL,
  `medicine_name` varchar(40) NOT NULL,
  `practitioner_name` varchar(40) NOT NULL,
  `review_description` varchar(700) NOT NULL,
  `submitted_on` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,'Lulu','medicine','Cilliata','','This medicine has made me swell in the glands since i started using it.','2022-07-08'),(2,'Lulu','Other Reviews','','','The system has an error in the practitioners side. i cant search a practitioner..','2022-07-08'),(3,'Lulu','practitioners','','Baraka','He is very aggressive and did not provide me with good treatment.','2022-07-08');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-13 22:50:11
