CREATE DATABASE  IF NOT EXISTS `station_reads` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `station_reads`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: station_reads
-- ------------------------------------------------------
-- Server version	5.6.11

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
-- Table structure for table `station`
--

DROP TABLE IF EXISTS `station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `station` (
  `station_id` int(11) NOT NULL AUTO_INCREMENT,
  `station_name` varchar(45) NOT NULL,
  PRIMARY KEY (`station_id`),
  UNIQUE KEY `station_name_UNIQUE` (`station_name`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `station`
--

LOCK TABLES `station` WRITE;
/*!40000 ALTER TABLE `station` DISABLE KEYS */;
INSERT INTO `station` VALUES (15,'Bremen'),(7,'Buck Creek'),(23,'Center Point'),(4,'Clem'),(3,'Flatrock'),(21,'Hickory Level'),(20,'Honda Lock'),(2,'Jonesville'),(8,'Mooselodge'),(13,'Morgan Road'),(9,'North Carrollton'),(17,'North Mount Zion'),(10,'Oak Mountain'),(11,'Roopville'),(24,'Roses Store'),(6,'Sandhill'),(22,'South Buchanan'),(19,'South Tallapoosa'),(16,'South Waco'),(1,'Tisinger'),(5,'Tyus'),(12,'West Villa Rica'),(18,'Yorkville'),(14,'Youngs Station');
/*!40000 ALTER TABLE `station` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `station_breaker`
--

DROP TABLE IF EXISTS `station_breaker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `station_breaker` (
  `breaker_id` int(11) NOT NULL AUTO_INCREMENT,
  `breaker_station_id` int(11) NOT NULL,
  `breaker_name` varchar(45) NOT NULL,
  `breaker_mult_header` int(11) DEFAULT NULL,
  `breaker_has_mult` int(10) unsigned DEFAULT '0',
  `breaker_has_amp` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`breaker_id`),
  UNIQUE KEY `breaker_id_UNIQUE` (`breaker_id`),
  UNIQUE KEY `breaker_name_UNIQUE` (`breaker_name`),
  KEY `fk_bsid_station_id_idx` (`breaker_station_id`),
  CONSTRAINT `fk_bsid_station_id` FOREIGN KEY (`breaker_station_id`) REFERENCES `station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `station_breaker`
--

LOCK TABLES `station_breaker` WRITE;
/*!40000 ALTER TABLE `station_breaker` DISABLE KEYS */;
INSERT INTO `station_breaker` VALUES (1,1,'C011',NULL,0,1),(2,1,'C012',NULL,0,1),(3,1,'C014',NULL,0,1),(4,1,'C015',NULL,0,1),(5,2,'C051',NULL,0,1),(6,2,'C052',NULL,0,1),(7,2,'C054',NULL,0,1),(8,3,'C081',NULL,0,1),(9,3,'C082',NULL,0,1),(10,3,'C083',40,1,0),(11,3,'C084',40,1,0),(12,3,'C085',40,1,0),(13,4,'C061',NULL,0,1),(14,4,'C062',80,1,1),(15,4,'C063',NULL,0,1),(16,4,'C064',NULL,0,1),(17,4,'C065',NULL,0,1),(18,4,'C066',NULL,0,1),(19,5,'C091',NULL,0,1),(20,5,'C092',NULL,0,1),(21,5,'C093',NULL,0,1),(22,5,'C094',NULL,0,1),(23,5,'C095',NULL,0,1),(24,6,'C101',40,1,0),(25,6,'C102',60,1,0),(26,6,'C103',60,1,0),(27,6,'C104',100,1,0),(28,7,'C148',120,1,1),(29,8,'C151',NULL,0,1),(30,8,'C152',NULL,0,1),(31,8,'C153',NULL,0,1),(32,8,'C154',NULL,0,1),(33,8,'C155',NULL,0,1),(34,9,'C121',NULL,0,1),(35,9,'C122',NULL,0,1),(36,9,'C123',NULL,0,1),(37,9,'C124',NULL,0,1),(38,9,'C125',NULL,0,1),(39,10,'C161',100,1,1),(40,10,'C162',NULL,0,1),(41,10,'C163',NULL,0,1),(42,10,'C164',NULL,0,1),(43,11,'C172',NULL,0,1),(44,11,'C173',NULL,0,1),(45,12,'C021',80,1,0),(46,12,'C022',80,1,0),(47,12,'C023',80,1,0),(48,12,'C024',80,1,0),(49,12,'C026',NULL,0,1),(50,13,'C182',NULL,0,1),(51,13,'C183',NULL,0,1),(52,13,'C184',NULL,0,1),(53,13,'C185',NULL,0,1),(54,14,'C192',NULL,0,1),(55,15,'C042',NULL,0,1),(56,15,'C043',NULL,0,1),(57,16,'C201',NULL,0,1),(58,17,'C071',40,1,1),(59,17,'C072',NULL,0,1),(60,17,'C073',NULL,0,1),(61,17,'C074',40,1,1),(62,18,'C251',NULL,0,1),(63,18,'C252',NULL,0,1),(64,18,'C253',NULL,0,1),(65,18,'C254',NULL,0,1),(66,19,'C212',NULL,0,1),(67,19,'C213',NULL,0,1),(68,19,'C214',NULL,0,1),(69,19,'C215',NULL,0,1),(70,20,'C271',NULL,0,1),(71,21,'C281',NULL,0,1),(72,21,'C282',NULL,0,1),(73,21,'C283',NULL,0,1),(74,21,'C284',NULL,0,1),(75,22,'C221',NULL,0,1),(76,22,'C222',NULL,0,1),(77,22,'C223',NULL,0,1),(78,22,'C224',NULL,0,1),(79,23,'C261',NULL,0,1),(80,23,'C262',NULL,0,1),(81,23,'C263',NULL,0,1),(82,23,'C264',NULL,0,1),(83,24,'C242',NULL,0,1),(84,24,'C243',NULL,0,1),(85,24,'C244',NULL,0,1),(86,24,'C245',NULL,0,1);
/*!40000 ALTER TABLE `station_breaker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `station_breaker_read`
--

DROP TABLE IF EXISTS `station_breaker_read`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `station_breaker_read` (
  `breaker_read_id` int(11) NOT NULL AUTO_INCREMENT,
  `read_id` int(11) NOT NULL,
  `read_date` date NOT NULL,
  `breaker_id` int(11) NOT NULL,
  `count` int(11) DEFAULT NULL,
  `a_flag` int(11) DEFAULT NULL,
  `b_flag` int(11) DEFAULT NULL,
  `c_flag` int(11) DEFAULT NULL,
  `n_flag` int(11) DEFAULT NULL,
  `battery` decimal(4,1) DEFAULT NULL,
  `a_amps` int(11) DEFAULT NULL,
  `b_amps` int(11) DEFAULT NULL,
  `c_amps` int(11) DEFAULT NULL,
  `a_mult` decimal(4,1) DEFAULT NULL,
  `b_mult` decimal(4,1) DEFAULT NULL,
  `c_mult` decimal(4,1) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`breaker_read_id`),
  UNIQUE KEY `breaker_read_id_UNIQUE` (`breaker_read_id`),
  KEY `fk_bid_breaker_id_idx` (`breaker_id`),
  KEY `fk_brid_breaker_read_id_idx` (`read_id`,`read_date`),
  KEY `fk_brd_breaker_read_date_idx` (`read_date`),
  CONSTRAINT `fk_bid_breaker_id` FOREIGN KEY (`breaker_id`) REFERENCES `station_breaker` (`breaker_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_brid_breaker_read_id` FOREIGN KEY (`read_id`) REFERENCES `station_read` (`station_read_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `station_breaker_read`
--

LOCK TABLES `station_breaker_read` WRITE;
/*!40000 ALTER TABLE `station_breaker_read` DISABLE KEYS */;
INSERT INTO `station_breaker_read` VALUES (1,1,'2013-11-05',55,2222,11,1,11,11,1.0,11,11,11,0.0,0.0,0.0,'11'),(2,1,'2013-11-05',56,2222,11,1,11,11,1.0,11,11,11,0.0,0.0,0.0,'11'),(3,3,'2013-11-05',28,45,5,545,5,45,99.0,5454,54,54,99.0,54.0,54.0,'5'),(4,4,'2013-11-05',79,546,546546,546,56,464,99.0,465,46,464,0.0,0.0,0.0,'646'),(5,4,'2013-11-05',80,64,5646,456,456,456,46.0,654,56,456,0.0,0.0,0.0,'464'),(6,4,'2013-11-05',81,456,456,456,456,456,99.0,456,4,5641,0.0,0.0,0.0,'456'),(7,4,'2013-11-05',82,231,314,564,564,5614,99.0,531424,56145,45,0.0,0.0,0.0,'641'),(8,5,'2013-11-05',13,456,456,456,456,465,99.0,456,4,231,0.0,0.0,0.0,'456'),(9,5,'2013-11-05',14,23,1456,456,46,5123,41.0,135,456,153,99.0,56.0,15.0,'5614'),(10,5,'2013-11-05',15,3,145,14,541,51,99.0,534,534,534,0.0,0.0,0.0,'534'),(11,5,'2013-11-05',16,4564564,56456,4564,56,453,99.0,41,23,43,0.0,0.0,0.0,'423'),(12,5,'2013-11-05',17,53,45,453,453,453,99.0,453,4,534,0.0,0.0,0.0,'453'),(13,5,'2013-11-05',18,534,354,354,53,4,99.0,543543,543543,453453,0.0,0.0,0.0,'543543'),(14,6,'2013-11-05',8,4,564,564,564,56,4.0,56,456,46,0.0,0.0,0.0,'564'),(15,6,'2013-11-05',9,54,654,564,65,4,99.0,564,65,456,0.0,0.0,0.0,'64'),(16,6,'2013-11-05',10,456,4,564,564,56,99.0,0,0,0,99.0,99.0,56.0,'4'),(17,6,'2013-11-05',11,465,465,46,54,56,99.0,0,0,0,4.0,99.0,99.0,'456'),(18,6,'2013-11-05',12,56,456465,456,456,4,99.0,0,0,0,99.0,65.0,45.0,'65'),(19,7,'2013-11-05',71,7,897,897,897,897,8.0,45,456,486,0.0,0.0,0.0,'456'),(20,7,'2013-11-05',72,4,54,564,68,456,48.0,564,864756,47,0.0,0.0,0.0,'47'),(21,7,'2013-11-05',73,564,86756,465,74,54,99.0,4,564,564,0.0,0.0,0.0,'456'),(22,7,'2013-11-05',74,5641564,56,456,4,54,99.0,486,1,64,0.0,0.0,0.0,'865'),(23,8,'2013-11-05',70,546546,546546,546546,546546,546546,99.0,546546,546,546546,0.0,0.0,0.0,'546546'),(24,9,'2013-11-05',5,87987,9879,879,879,879,99.0,879879,879,879,0.0,0.0,0.0,'879'),(25,9,'2013-11-05',6,879,879,879,879,879879,99.0,879,879,879,0.0,0.0,0.0,'879'),(26,9,'2013-11-05',7,879879,879,879,879879,879,99.0,879879,879,879,0.0,0.0,0.0,'879'),(27,10,'2013-11-05',29,546,546,456546,546,546,99.0,546,546,546,0.0,0.0,0.0,'546546'),(28,10,'2013-11-05',30,546,546546,546,546,546,99.0,546,546,546,0.0,0.0,0.0,'546546'),(29,10,'2013-11-05',31,546,546546,546,546,546,99.0,546,546546,546,0.0,0.0,0.0,'546'),(30,10,'2013-11-05',32,546546,546,546,546,546546,99.0,546546,546,546,0.0,0.0,0.0,'546'),(31,10,'2013-11-05',33,546546,546,546,546,546546,99.0,546,546,546,0.0,0.0,0.0,'546'),(32,1,'2013-11-05',55,2222,11,1,11,11,1.0,11,11,11,0.0,0.0,0.0,'11'),(33,1,'2013-11-05',56,2222,11,1,11,11,1.0,11,11,11,0.0,0.0,0.0,'11'),(34,1,'2013-11-05',55,2222,11,1,11,11,1.0,11,11,11,0.0,0.0,0.0,'11'),(35,1,'2013-11-05',56,2222,11,1,11,11,1.0,11,11,11,0.0,0.0,0.0,'11'),(36,11,'2000-01-01',55,546,546,546546,546,546,546.0,546546,546,546,0.0,0.0,0.0,'546'),(37,11,'2000-01-01',56,546,546546,4,56546,546,546.0,546,546,546,0.0,0.0,0.0,'546'),(38,11,'2000-01-01',55,54611,546,546546,546,546,99.0,546,546,546,0.0,0.0,0.0,'546546'),(39,11,'2000-01-01',56,546,546,5464,56546,546,99.0,546,546,546,0.0,0.0,0.0,'546'),(40,11,'2000-01-01',55,54611,546,546546,546,546,99.0,546,546,546,0.0,0.0,0.0,'546546'),(41,11,'2000-01-01',56,546,546,5464,56546,546,99.0,546,546,546,0.0,0.0,0.0,'546'),(42,11,'2000-01-01',55,54611111,546,546546,546,546,99.0,546,546,546,0.0,0.0,0.0,'546546'),(43,11,'2000-01-01',56,546,546,5464,56546,546,99.0,546,546,546,0.0,0.0,0.0,'546'),(44,11,'2000-01-01',55,54611111,546,546546,546,546,99.0,546,546,546,0.0,0.0,0.0,'546546'),(45,11,'2000-01-01',56,546,546,5464,56546,546,99.0,546,546,546,0.0,0.0,0.0,'546'),(46,14,'2013-11-01',45,0,0,0,0,0,0.0,0,0,0,0.0,0.0,0.0,''),(47,14,'2013-11-01',46,932,228,201,223,392,27.0,0,0,0,1.0,1.0,1.0,''),(48,14,'2013-11-01',47,999,248,319,438,504,26.0,0,0,0,3.0,2.0,2.0,''),(49,14,'2013-11-01',48,633,282,191,209,441,26.0,0,0,0,2.0,2.0,3.0,''),(50,14,'2013-11-01',49,129,0,0,0,0,28.0,93,93,94,0.0,0.0,0.0,''),(51,17,'2013-11-22',55,54,54,54,54,54,656.0,54,54,5454,0.0,0.0,0.0,'54'),(52,17,'2013-11-22',56,54,54,54,54,5454,54.0,54,5454,54,0.0,0.0,0.0,'54'),(53,32,'2013-10-21',55,546,546,546546,546,546,546.0,546,546,546546,0.0,0.0,0.0,'546546'),(54,32,'2013-10-21',56,546,546,546546,546,546,999.9,546,546546,546,0.0,0.0,0.0,'546'),(55,33,'2012-11-22',55,54,54,54,54,54,656.0,54,54,5454,0.0,0.0,0.0,'54'),(56,33,'2012-11-22',56,54,54,54,54,5454,54.0,54,5454,54,0.0,0.0,0.0,'54'),(57,34,'2012-11-11',55,54,54,54,54,54,656.0,54,54,5454,0.0,0.0,0.0,'54'),(58,34,'2012-11-11',56,54,54,54,54,5454,54.0,54,5454,54,0.0,0.0,0.0,'54'),(59,35,'2013-11-22',71,0,0,0,0,0,0.0,0,0,0,0.0,0.0,0.0,'asdf'),(60,35,'2013-11-22',72,0,0,0,0,0,0.0,0,0,0,0.0,0.0,0.0,'asdf'),(61,35,'2013-11-22',73,0,0,0,0,0,0.0,0,0,0,0.0,0.0,0.0,'asdf'),(62,35,'2013-11-22',74,0,0,0,0,0,0.0,0,0,0,0.0,0.0,0.0,'asdf'),(63,13,'2013-11-12',55,564,564,564,564,564,564.0,56,456,45,0.0,0.0,0.0,'564'),(64,13,'2013-11-12',56,6456,46,5465,4,564,564.0,564,564,564,0.0,0.0,0.0,'564'),(65,12,'2000-01-01',79,54546,546546,456,546,546546,999.9,546546,546,546,0.0,0.0,0.0,'546'),(66,12,'2000-01-01',80,546546,456,546546,456546,456,546.0,456,546546,546,0.0,0.0,0.0,'546546'),(67,12,'2000-01-01',81,456,546546,546,546546,546,546.0,546,546,546546,0.0,0.0,0.0,'546546'),(68,12,'2000-01-01',82,546,546546,5465,546546,546546,999.9,4546,5454,5465,0.0,0.0,0.0,'546546');
/*!40000 ALTER TABLE `station_breaker_read` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `station_read`
--

DROP TABLE IF EXISTS `station_read`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `station_read` (
  `station_read_id` int(11) NOT NULL AUTO_INCREMENT,
  `read_date` date NOT NULL,
  `station_id` int(11) NOT NULL,
  PRIMARY KEY (`station_read_id`),
  UNIQUE KEY `station_read_id_UNIQUE` (`station_read_id`),
  KEY `fk_srsid_station_id_idx` (`station_id`),
  CONSTRAINT `fk_srsid_station_id` FOREIGN KEY (`station_id`) REFERENCES `station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `station_read`
--

LOCK TABLES `station_read` WRITE;
/*!40000 ALTER TABLE `station_read` DISABLE KEYS */;
INSERT INTO `station_read` VALUES (1,'2013-11-05',15),(3,'2013-11-05',7),(4,'2013-11-05',23),(5,'2013-11-05',4),(6,'2013-11-05',3),(7,'2013-11-05',21),(8,'2013-11-05',20),(9,'2013-11-05',2),(10,'2013-11-05',8),(11,'2000-01-01',15),(12,'2000-01-01',23),(13,'2013-11-12',15),(14,'2013-11-01',12),(15,'0000-00-00',15),(16,'0000-00-00',15),(17,'2013-11-22',15),(18,'0000-00-00',15),(19,'0000-00-00',15),(20,'0000-00-00',15),(21,'0000-00-00',15),(22,'0000-00-00',15),(23,'0000-00-00',15),(24,'0000-00-00',15),(25,'0000-00-00',15),(26,'0000-00-00',15),(27,'0000-00-00',15),(28,'0000-00-00',15),(29,'0000-00-00',15),(30,'0000-00-00',15),(31,'0000-00-00',15),(32,'2013-10-21',15),(33,'2012-11-22',15),(34,'2012-11-11',15),(35,'2013-11-22',21);
/*!40000 ALTER TABLE `station_read` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `station_regulator`
--

DROP TABLE IF EXISTS `station_regulator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `station_regulator` (
  `regulator_id` int(11) NOT NULL AUTO_INCREMENT,
  `regulator_station_id` int(11) NOT NULL,
  `regulator_name` varchar(45) DEFAULT NULL,
  `regulator_amp_header` int(11) NOT NULL,
  PRIMARY KEY (`regulator_id`),
  UNIQUE KEY `regulator_id_UNIQUE` (`regulator_id`),
  KEY `fk_rsid_station_id_idx` (`regulator_station_id`),
  CONSTRAINT `fk_rsid_station_id` FOREIGN KEY (`regulator_station_id`) REFERENCES `station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `station_regulator`
--

LOCK TABLES `station_regulator` WRITE;
/*!40000 ALTER TABLE `station_regulator` DISABLE KEYS */;
INSERT INTO `station_regulator` VALUES (1,1,NULL,875),(2,2,NULL,578),(3,3,'C081',328),(4,3,'C082',219),(5,3,'C083',100),(6,3,'C084',219),(7,3,'C085',328),(8,4,NULL,875),(9,5,NULL,548),(10,6,NULL,875),(11,8,NULL,875),(12,9,NULL,1093),(13,10,NULL,875),(14,11,NULL,437),(15,12,'C026',300),(16,13,NULL,875),(17,14,NULL,328),(18,15,NULL,546),(19,16,NULL,328),(20,17,NULL,875),(21,18,NULL,1093),(22,19,NULL,300),(23,20,NULL,328),(24,21,NULL,578),(25,22,NULL,546),(26,23,NULL,875),(27,24,NULL,578);
/*!40000 ALTER TABLE `station_regulator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `station_regulator_read`
--

DROP TABLE IF EXISTS `station_regulator_read`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `station_regulator_read` (
  `regulator_read_id` int(11) NOT NULL AUTO_INCREMENT,
  `read_id` int(11) NOT NULL,
  `regulator_id` int(11) NOT NULL,
  `read_date` date NOT NULL,
  `a_count` int(11) DEFAULT NULL,
  `a_raise` varchar(45) DEFAULT NULL,
  `a_lower` varchar(45) DEFAULT NULL,
  `a_amp` int(11) DEFAULT NULL,
  `a_high_voltage` int(11) DEFAULT NULL,
  `a_low_voltage` int(11) DEFAULT NULL,
  `a_comments` varchar(255) DEFAULT NULL,
  `b_count` int(11) DEFAULT NULL,
  `b_raise` varchar(45) DEFAULT NULL,
  `b_lower` varchar(45) DEFAULT NULL,
  `b_amp` int(11) DEFAULT NULL,
  `b_high_voltage` int(11) DEFAULT NULL,
  `b_low_voltage` int(11) DEFAULT NULL,
  `b_comments` varchar(255) DEFAULT NULL,
  `c_count` int(11) DEFAULT NULL,
  `c_raise` varchar(45) DEFAULT NULL,
  `c_lower` varchar(45) DEFAULT NULL,
  `c_amp` int(11) DEFAULT NULL,
  `c_high_voltage` int(11) DEFAULT NULL,
  `c_low_voltage` int(11) DEFAULT NULL,
  `c_comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`regulator_read_id`),
  UNIQUE KEY `regulator_read_id_UNIQUE` (`regulator_read_id`),
  KEY `fk_rid_regulator_id_idx` (`regulator_id`),
  KEY `fk_rrd_regulator_read_date_idx` (`read_date`),
  KEY `fk_rrid_regulator_read_id_idx` (`read_id`),
  CONSTRAINT `fk_rrid_regulator_read_id` FOREIGN KEY (`read_id`) REFERENCES `station_read` (`station_read_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rid_regulator_id` FOREIGN KEY (`regulator_id`) REFERENCES `station_regulator` (`regulator_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `station_regulator_read`
--

LOCK TABLES `station_regulator_read` WRITE;
/*!40000 ALTER TABLE `station_regulator_read` DISABLE KEYS */;
INSERT INTO `station_regulator_read` VALUES (1,1,18,'2013-11-05',3333,'1','1',1,11,1,'1',1,'1','1',1,1,1,'1',1,'11','11',1,11,11,'1'),(2,4,26,'2013-11-05',45,'456','456',464,64,546,'454',54,'546','54',546,546,54654,'54',546,'546','546',546546,546,546,'546'),(3,5,8,'2013-11-05',564,'56456','456',4564,564,564,'56456',456,'456','465',456,456,46,'54',564,'564','564',564,564,564,'56'),(4,6,3,'2013-11-05',45,'4','564',54,45,46,'456',456,'456','4',564,564,654,'564',56,'456','456',4,56456456,456,'465'),(5,6,4,'2013-11-05',456,'456','4',564,564,654,'56',456,'456','456',456,456,465,'456',456,'456','4',564,564,564,'564'),(6,6,5,'2013-11-05',564,'564','56',456,4,564,'564',564,'56','456',456,456,4,'564',564,'564','56',456,4,564,'564'),(7,6,6,'2013-11-05',56,'456','456',4,564,564,'56',456,'456','4',564,564,65,'456',456,'4','564',564,56,456,'4'),(8,6,7,'2013-11-05',564,'564','56',465,4,564,'564',564,'56','456',456,4,654,'654',654,'56','456',4,654,65,'456'),(9,7,24,'2013-11-05',7,'897','89789',789,789,789,'789',7,'897','897',897,897,897,'897',897,'897','897',897,89,789,'789'),(10,8,23,'2013-11-05',844,'56456','4564',5646,54,564,'564',564,'564','564',56546,546,546546,'546',546,'546546','546',546,546546,546546,'546546'),(11,9,2,'2013-11-05',87,'897','897',897,897,897,'879',879879,'879','879',879879,879,879,'879',879879,'879','879',879,879879,879,'879'),(12,10,11,'2013-11-05',5,'456','4564',654,564,564,'564',564,'6546','546',546546,546,546,'546546',546,'546','546',546,546546,546,'546'),(13,1,18,'2013-11-05',3333,'1','1',1,11,1,'1',1,'1','1',1,1,1,'1',1,'11','11',1,11,11,'1'),(14,11,18,'2000-01-01',544,'5456','56',456456,65,546546,'546',546546,'546','546',546546,546,546,'546546',546,'546','546546',546,546,546546,'546'),(15,14,15,'2013-11-01',28219,'L6','11',96,123,122,'',28146,'L6','11',95,123,121,'',28823,'L6','10',95,123,122,''),(18,17,18,'2013-11-22',5,'545','5454',54,5454,54,'5454',5454,'54','54',5454,54,54,'54',54,'54','54',5454,54,54,'54'),(33,32,18,'2013-10-21',5,'564','56',56546,546,546546,'546',5454,'546','546546',546,546,546,'546546',546,'546','546',546,546,546546,'546'),(34,33,18,'2012-11-22',5,'545','5454',54,5454,54,'5454',5454,'54','54',5454,54,54,'54',54,'54','54',5454,54,54,'54'),(35,34,18,'2012-11-11',5,'545','5454',54,5454,54,'5454',5454,'54','54',5454,54,54,'54',54,'54','54',5454,54,54,'54'),(36,35,24,'2013-11-22',0,'','',0,0,0,'asdf',0,'','',0,0,0,'asdf',0,'','',0,0,0,'asdf'),(37,13,18,'2013-11-12',54564,'564','654',5646,54,65456,'4',564,'564','564',564,564,564,'654',564,'564','564',56,456,4,'564'),(38,12,26,'2000-01-01',4,'564','5646',5456,4,654,'564',654,'564','564',56,456,456,'46',4,'5454','546546',546,546546,5454,'54');
/*!40000 ALTER TABLE `station_regulator_read` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `station_users`
--

DROP TABLE IF EXISTS `station_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `station_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`),
  UNIQUE KEY `password_UNIQUE` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `station_users`
--

LOCK TABLES `station_users` WRITE;
/*!40000 ALTER TABLE `station_users` DISABLE KEYS */;
INSERT INTO `station_users` VALUES (1,'testuser','85064efb60a9601805dcea56ec5402f7'),(2,'usertest','b717415eb5e699e4989ef3e2c4e9cbf7'),(3,'testadmin','66d4aaa5ea177ac32c69946de3731ec0'),(4,'cemc','5f4dcc3b5aa765d61d8327deb882cf99');
/*!40000 ALTER TABLE `station_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-22 16:35:04
