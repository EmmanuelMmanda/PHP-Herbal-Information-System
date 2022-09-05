DROP TABLE IF EXISTS `admin`;
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

LOCK TABLES `admin` WRITE;
INSERT INTO `admin` VALUES (1,'Emmanuel','Mmanda','Admin','81dc9bdb52d04dc20036dbd8313ed055','active','2022-06-13');
UNLOCK TABLES;

DROP TABLE IF EXISTS `medicine`;
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
LOCK TABLES `medicine` WRITE;
INSERT INTO `medicine` VALUES (47,'Cilliata','I treats fever and ulcers plus general health of body','Herbs for Health','Mwaka','Allowed','med1.webp'),(48,'Globulus','Treats skin infections and other skin disorders','Skin Infections','Mwaka','Allowed','med2.jpg'),(49,'Indica','Blood Purifier and Astringent in the body.','Sexual Transmitted Diseases','Mwaka','Allowed','med3.webp'),(50,'Aristata','Treats both scabiies and other skin infections in the body.','Skin Infections','Samara','Allowed','med5.jpg'),(51,'Sativa','Deals with problem in the Urinary track of women ,Infertitily','Fertility[ Women ]','Samara','disaproved','med6.jpg');
UNLOCK TABLES;

DROP TABLE IF EXISTS `patients`;
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
LOCK TABLES `patients` WRITE;
INSERT INTO `patients` VALUES (12,'Lulu ','Michael','Lulu','81dc9bdb52d04dc20036dbd8313ed055','lulum@yahoo.com',769642928,'images2.jpg','2022-06-21','Mbeya, Tanzania'),(13,'ibrah','david','ibrah','81dc9bdb52d04dc20036dbd8313ed055','ibrah@gmail.com',767675645,'images5.jpg','2022-06-21','Sinza Daressalaam');
UNLOCK TABLES;
DROP TABLE IF EXISTS `practitioner`;
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

LOCK TABLES `practitioner` WRITE;
INSERT INTO `practitioner` VALUES (34,'Issack','Yohana',769642928,'isaka@gmsil.com','Isa Herbs','Mbeya Mjini','Issack','81dc9bdb52d04dc20036dbd8313ed055','images3.jpg','Sexual Transmitted Diseases','I deal with sexually transmitted diseases by using Traditional medical herbs','','','facebook.com/issaherbs','twitter.com/issaherbs','2022-06-21',1,'user','',0),(35,'Baraka ','Mbogola',767675645,'baraka@gamil.com','BR Herbs','Sinza Daressalaam','Baraka','81dc9bdb52d04dc20036dbd8313ed055','images8.png','Fertility[ Men ]','I deal with mens fertility using herbal medicine','','','facebook.com/br','twitter.com/br','2022-06-21',1,'user','',0),(36,'Deo','Casmiry',769642928,'deo@gmail.com','toby herbs','moshi kirimanjaro','Deo','81dc9bdb52d04dc20036dbd8313ed055','images6.jpg','Skin Infections','i deal with skin infections using traditional medicine','','','facebook.com/issaherbs','twitter.com/hbers','2022-06-21',1,'user','',0),(37,'LINAH','PETER',767985435,'samara@gmail.com','LINAH MEDICAL CARE','Kimara, Dar es saalam','Samara','81dc9bdb52d04dc20036dbd8313ed055','images9.jpg','Dental Care','Get plant medicine that treats all dental infections.','434354564657676756434','bussineslicense1.jpg','facebook.com/dental ','twitter.com/dental','2022-06-21',1,'user','doctor license1.jpg',1),(38,'Mwaka','Docta',768686656,'mwaka@yahoo.com','Dr.Mwaka','Dodoma- Tanzania','Mwaka','81dc9bdb52d04dc20036dbd8313ed055','sampe4.jpeg','Fertility[ Women ]','I deal with women\'s fertility using herbal medicine.\r\n','65656565545454434346465','Business-license-2.webp','facebook.com/dkmwaka','twitter.com/dkmwaka','2022-06-21',1,'user','doctorlicense2.jpg',1);
UNLOCK TABLES;

DROP TABLE IF EXISTS `reviews`;
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

LOCK TABLES `reviews` WRITE;
INSERT INTO `reviews` VALUES (1,'Lulu','medicine','Cilliata','','This medicine has made me swell in the glands since i started using it.','2022-07-08'),(2,'Lulu','Other Reviews','','','The system has an error in the practitioners side. i cant search a practitioner..','2022-07-08'),(3,'Lulu','practitioners','','Baraka','He is very aggressive and did not provide me with good treatment.','2022-07-08');
UNLOCK TABLES;
