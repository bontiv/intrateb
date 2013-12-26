-- MySQL dump 10.13  Distrib 5.5.34, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: epicenote
-- ------------------------------------------------------
-- Server version	5.5.34-0ubuntu0.13.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acces`
--

DROP TABLE IF EXISTS `acces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acces` (
  `acl_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acl_action` varchar(30) NOT NULL,
  `acl_page` varchar(30) NOT NULL,
  `acl_acces` enum('ANNONYMOUS','GUEST','USER','SUPERUSER','ADMINISTRATOR') NOT NULL DEFAULT 'ADMINISTRATOR',
  PRIMARY KEY (`acl_id`),
  UNIQUE KEY `acl_action` (`acl_action`,`acl_page`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acces`
--

LOCK TABLES `acces` WRITE;
/*!40000 ALTER TABLE `acces` DISABLE KEYS */;
INSERT INTO `acces` VALUES (1,'index','index','ANNONYMOUS'),(3,'index','login','ANNONYMOUS'),(7,'admin','index','ADMINISTRATOR'),(15,'admin','update','ADMINISTRATOR'),(21,'user','index','ADMINISTRATOR'),(24,'syscore','nomod','ADMINISTRATOR'),(26,'section','index','GUEST'),(27,'section','add','ADMINISTRATOR'),(34,'ecole','index','ADMINISTRATOR'),(43,'user','view','ADMINISTRATOR'),(44,'user','invit_section','ADMINISTRATOR'),(51,'section','goto','ADMINISTRATOR'),(80,'section','goin','ADMINISTRATOR'),(82,'section','goout','ADMINISTRATOR'),(84,'section','details','ADMINISTRATOR'),(95,'section','accept','ADMINISTRATOR'),(100,'section','manager','ADMINISTRATOR'),(104,'section','reject','ADMINISTRATOR'),(129,'user','quit','ADMINISTRATOR'),(154,'user','add','ADMINISTRATOR'),(169,'section','edit','ADMINISTRATOR'),(170,'section','mkevent','ADMINISTRATOR'),(171,'event','index','ADMINISTRATOR'),(172,'note','index','ADMINISTRATOR'),(173,'bulletin','index','ADMINISTRATOR'),(174,'reclam','index','ADMINISTRATOR'),(175,'section','delete','ADMINISTRATOR'),(176,'user','delete','ADMINISTRATOR'),(177,'user','edit','ADMINISTRATOR'),(178,'ecole','add','ADMINISTRATOR'),(179,'ecole','delete','ADMINISTRATOR'),(180,'ecole','edit','ADMINISTRATOR'),(181,'event','view','ADMINISTRATOR'),(182,'section','view','ADMINISTRATOR'),(183,'section','detail','ADMINISTRATOR');
/*!40000 ALTER TABLE `acces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `name` varchar(30) NOT NULL,
  `value` text NOT NULL,
  `env` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`,`env`),
  UNIQUE KEY `env` (`env`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `event_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_name` varchar(100) NOT NULL,
  `event_desc` text NOT NULL,
  `event_start` datetime NOT NULL,
  `event_end` datetime NOT NULL,
  `event_lock` date NOT NULL,
  `event_note1` date NOT NULL,
  `event_note2` date NOT NULL,
  `event_coef` int(11) NOT NULL,
  `event_section` int(11) NOT NULL,
  `event_owner` int(11) NOT NULL,
  `event_state` enum('DRAFT','OPEN','MODERATE1','MODERETE2','CLOSE','END') NOT NULL DEFAULT 'DRAFT',
  PRIMARY KEY (`event_id`),
  KEY `event_section` (`event_section`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Nocturne','Espece de nocturne .','2013-12-25 20:10:00','2014-01-24 20:10:00','2013-12-25','2014-01-24','2014-01-24',1,21,1,'DRAFT'),(2,'Ecore un event alacon','Et oui parce que je suis con !','2013-12-25 20:10:00','2014-01-24 20:10:00','2013-12-25','2014-01-24','2014-01-24',1,21,1,'DRAFT'),(3,'Tu va fonctionner ?','Non parce que je commence Ã  m\'impatienter ...','2014-01-01 20:10:00','2014-01-10 20:10:00','2013-12-25','2014-01-17','2014-01-24',1,21,1,'DRAFT');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `section_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `section_name` varchar(30) NOT NULL,
  `section_type` enum('primary','secondary') NOT NULL,
  `section_owner` int(11) NOT NULL,
  PRIMARY KEY (`section_id`),
  UNIQUE KEY `section_name` (`section_name`),
  KEY `section_owner` (`section_owner`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (10,'JVM','primary',1),(11,'Nocturne','primary',1),(13,'Projection','primary',1),(14,'Technique','primary',1),(15,'Bouffe','primary',1),(16,'Maid','primary',1),(17,'Pokemon','primary',1),(18,'JV','primary',1),(19,'Karaoke','primary',1),(20,'Toyunda','primary',1),(21,'Bureau','primary',1);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_sections`
--

DROP TABLE IF EXISTS `user_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_sections` (
  `us_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `us_user` int(10) unsigned NOT NULL,
  `us_section` int(10) unsigned NOT NULL,
  `us_type` enum('manager','user','guest','rejected') NOT NULL,
  PRIMARY KEY (`us_id`),
  KEY `user_id` (`us_user`,`us_section`),
  KEY `us_user` (`us_user`),
  KEY `us_section` (`us_section`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_sections`
--

LOCK TABLES `user_sections` WRITE;
/*!40000 ALTER TABLE `user_sections` DISABLE KEYS */;
INSERT INTO `user_sections` VALUES (1,1,14,'user'),(2,1,17,'guest'),(5,1,11,'user'),(7,1,21,'manager'),(8,4,10,'user');
/*!40000 ALTER TABLE `user_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_types` (
  `ut_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ut_name` varchar(100) NOT NULL,
  PRIMARY KEY (`ut_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_types`
--

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
INSERT INTO `user_types` VALUES (1,'epitech'),(2,'epita'),(3,'e-art'),(4,'externe');
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `user_pass` varchar(34) NOT NULL,
  `user_firstname` varchar(20) NOT NULL,
  `user_lastname` varchar(20) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_login` varchar(10) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_role` enum('GUEST','USER','SUPERUSER','ADMINISTRATOR') DEFAULT 'GUEST',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'bontiv','momololo','remi','bonnet',1,'bonnet_f','','','ADMINISTRATOR'),(3,'galaf','','Christophe','LABONNE',1,'labonn_c','galaf@epitanime.com','','GUEST'),(4,'test','c4f961b4380ee24d982fed76ef36be9f','test','test',1,'','','','GUEST');
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

-- Dump completed on 2013-12-26 21:01:13
