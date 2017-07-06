-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: weischool
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `chatting`
--

DROP TABLE IF EXISTS `chatting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chatting` (
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` char(255) NOT NULL,
  `date` date NOT NULL,
  `is_recieved` enum('not_received','received') NOT NULL DEFAULT 'not_received',
  `chat_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`chat_id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  CONSTRAINT `receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `sender_id` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chatting`
--

LOCK TABLES `chatting` WRITE;
/*!40000 ALTER TABLE `chatting` DISABLE KEYS */;
INSERT INTO `chatting` VALUES (1,2,'abcd买买买','2017-06-21','not_received',1);
/*!40000 ALTER TABLE `chatting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diary`
--

DROP TABLE IF EXISTS `diary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diary` (
  `user` int(11) NOT NULL DEFAULT '0',
  `content` char(255) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `diary_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`diary_id`),
  KEY `user_diray_id` (`user`),
  CONSTRAINT `user_diray_id` FOREIGN KEY (`user`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diary`
--

LOCK TABLES `diary` WRITE;
/*!40000 ALTER TABLE `diary` DISABLE KEYS */;
INSERT INTO `diary` VALUES (1,'今日无事','2017-06-21',1),(2,'明日无事','2017-06-21',2);
/*!40000 ALTER TABLE `diary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_class` int(11) DEFAULT '0',
  `name` char(20) NOT NULL,
  `introduction` char(255) DEFAULT NULL,
  `state` int(11) DEFAULT '0',
  `publish_time` date NOT NULL,
  `sold_time` date DEFAULT NULL,
  `picture` char(255) NOT NULL DEFAULT 'img/default',
  PRIMARY KEY (`item_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,1,0,'pen','钛金笔头',1,'2017-06-22',NULL,'img/default'),(2,1,0,'thinkpad','笔记本电脑',2,'2017-06-22','2017-07-05','img/default'),(3,2,0,'小号','雅马哈小号',1,'2017-06-22',NULL,'img/default'),(4,2,0,'平板电脑','昂达寨板',2,'2017-06-22','2017-07-05','img/default'),(15,1,0,'钢板','introduction',2,'2017-07-03','2017-07-06','img/default'),(16,1,12,'aaba','lalala',1,'2017-07-04',NULL,'img/default'),(17,1,0,'abc','abc',2,'2017-07-04','2017-07-06','img/default'),(18,1,0,'abc1','1221',2,'2017-07-04','2017-07-06','img/default'),(19,1,7,'abc2','111',1,'2017-07-04',NULL,'img/default'),(34,19,6,'鼠标','一个鼠标',2,'2017-07-05','2017-07-06','img/1499242035'),(35,19,6,'鼠标','一个鼠标鼠标鼠标',2,'2017-07-05','2017-07-06','img/1499248438'),(36,19,1,'一样一样','亲戚去去去',2,'2017-07-05','2017-07-06','img/1499258602'),(37,1,7,'一样','呃呃呃地方',0,'2017-07-05',NULL,'img/1499259169'),(38,1,7,'完完全全额','全身照',0,'2017-07-05',NULL,'img/1499259215'),(39,1,7,'呃呃呃额额','呃呃呃儿童',0,'2017-07-05',NULL,'img/1499259342'),(40,1,7,'二月初三','特别近四儿',0,'2017-07-05',NULL,'img/1499259375'),(41,1,7,'好的不放假','去u我充充电',0,'2017-07-05',NULL,'img/1499259413'),(42,19,7,'停停停','吞吞吐吐',1,'2017-07-05',NULL,'img/1499260278'),(43,19,5,'tyy','ttt',0,'2017-07-05',NULL,'img/1499265614'),(44,19,6,'啦啦啦','啦啦啦',0,'2017-07-06',NULL,'null'),(45,19,6,'鼠标','崭新的鼠标，想换一台电脑',0,'2017-07-06',NULL,'null'),(46,19,1,'龙江的后背','龙江宽广的后背，换一个基友',2,'2017-07-06','2017-07-06','null'),(47,1,0,'龙江宽阔的后背','后背出租,换一个可靠基友',0,'2017-07-06',NULL,'img/1499312341'),(48,25,1,'用过的纸巾','用过的纸巾',2,'2017-07-06','2017-07-06','img/1499322004');
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trade`
--

DROP TABLE IF EXISTS `trade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trade` (
  `user1` int(11) DEFAULT NULL,
  `user2` int(11) DEFAULT NULL,
  `item1` int(11) NOT NULL DEFAULT '0',
  `item2` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item1`,`item2`),
  KEY `user1` (`user1`),
  KEY `user2` (`user2`),
  CONSTRAINT `user1` FOREIGN KEY (`user1`) REFERENCES `user` (`user_id`),
  CONSTRAINT `user2` FOREIGN KEY (`user2`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trade`
--

LOCK TABLES `trade` WRITE;
/*!40000 ALTER TABLE `trade` DISABLE KEYS */;
INSERT INTO `trade` VALUES (1,16,1,21),(19,1,42,19);
/*!40000 ALTER TABLE `trade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` char(30) NOT NULL,
  `password` char(30) NOT NULL,
  `user_nickname` char(30) DEFAULT NULL,
  `phone_number` char(11) DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `picture` char(255) NOT NULL DEFAULT 'img/default',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'abc','abc','abcdefg','13100000000',114.441,30.5555,'img/default'),(2,'def','def','defghij','13200000000',114.441,30.5555,'img/default'),(11,'lz','123456','lz','11111111111',114.441,30.5555,'img/default'),(12,'rozen','111','rozen','11111111111',114.441,30.5555,'img/default'),(13,'rou','123456','zeng','11111111111',114.441,30.5555,'img/default'),(14,'abc1','abc','abc','11111111111',114.441,30.5555,'img/default'),(15,'abc2','abc','abc','11111111111',114.441,30.5555,'img/default'),(16,'asdf','asdf','asdf','123456789',114.441,30.5555,'picture/123/456'),(19,'qwer','qwer','zxcvb','1234569870',114.441,30.5555,'img/1499240073'),(20,'luozhen','luozhen','luozhen','13211111111',114.441,30.5555,'null'),(21,'user0706','user','user0706','13211111111',114.441,30.5555,'null'),(22,'user133','user','user','13291919191',114.441,30.5555,'null'),(23,'roo','roo','roo','13191919191',114.441,30.5555,'img/1499311952'),(24,'re0','re0','nick','13297919999',114.441,30.5555,'img/1499318420'),(25,'user123','123','nick','11111111111',114.441,30.5202,'img/1499321914');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-06 16:50:24
