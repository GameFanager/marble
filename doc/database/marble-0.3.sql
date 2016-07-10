-- MySQL dump 10.13  Distrib 5.6.26, for osx10.9 (x86_64)
--
-- Host: localhost    Database: marble
-- ------------------------------------------------------
-- Server version	5.6.26

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
-- Table structure for table `attribute`
--

DROP TABLE IF EXISTS `attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attribute` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `named_identifier` varchar(255) NOT NULL,
  `default_value` text NOT NULL,
  `serialized_value` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attribute`
--

LOCK TABLES `attribute` WRITE;
/*!40000 ALTER TABLE `attribute` DISABLE KEYS */;
INSERT INTO `attribute` VALUES (1,'Textfeld','textfield','',0),(2,'Textblock','textblock','',0),(3,'Auswahlliste','selectbox','',0),(4,'HTML Block','htmlblock','',0),(5,'Datum','date','',0),(6,'Datum und Zeit','datetime','a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}',1),(7,'Zeit','time','a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}',1),(8,'Objektverknüpfung','object_relation','',0),(9,'Objektverknüpfungsliste','object_relation_list','a:0:{}',1),(10,'Bild','image','',1),(11,'Bilder','images','a:0:{}',1),(12,'Key/Value Store','keyvalue_store','',1),(13,'Matrix','matrix','',1),(14,'Sprachauswahl','selectbox_language','',0),(15,'Checkbox','checkbox','0',0);
/*!40000 ALTER TABLE `attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_attribute`
--

DROP TABLE IF EXISTS `class_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_attribute` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class_id` int(10) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `sort_order` int(10) NOT NULL DEFAULT '0',
  `configuration` text NOT NULL,
  `named_identifier` varchar(255) NOT NULL,
  `translate` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `group_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_attribute`
--

LOCK TABLES `class_attribute` WRITE;
/*!40000 ALTER TABLE `class_attribute` DISABLE KEYS */;
INSERT INTO `class_attribute` VALUES (1,'Name',1,1,-1,'','name',1,0,0),(48,'Name',12,1,-1,'','name',1,1,0),(50,'Name',13,1,-1,'','name',1,1,0),(52,'Frontpage',13,8,0,'','frontpage',1,0,0),(53,'Name',14,1,0,'','name',1,0,5),(56,'Name',15,1,-1,'','name',1,1,0),(59,'Settings',15,8,0,'','settings',0,0,0),(60,'Pages',15,8,0,'','pages',0,0,0),(65,'Slug',14,1,1,'','slug',1,0,5),(75,'Inhalt',14,4,0,'','content',1,0,6),(76,'Bild',14,10,1,'','image',0,0,6),(86,'Options',14,12,4,'','options',0,0,9),(89,'Bilder Gallerie',14,11,5,'','image_gallery',0,0,6),(91,'Öffentlich?',14,15,6,'','is_public',0,0,6);
/*!40000 ALTER TABLE `class_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_attribute_group`
--

DROP TABLE IF EXISTS `class_attribute_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_attribute_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class_id` int(10) NOT NULL,
  `sort_order` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_attribute_group`
--

LOCK TABLES `class_attribute_group` WRITE;
/*!40000 ALTER TABLE `class_attribute_group` DISABLE KEYS */;
INSERT INTO `class_attribute_group` VALUES (1,'Meta',12,0),(5,'Meta',14,0),(6,'Content',14,1),(9,'Optional',14,2);
/*!40000 ALTER TABLE `class_attribute_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language`
--

LOCK TABLES `language` WRITE;
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` VALUES (1,'en','English'),(2,'de','Deutsch');
/*!40000 ALTER TABLE `language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node`
--

DROP TABLE IF EXISTS `node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `class_id` int(10) NOT NULL,
  `parent_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sort_order` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node`
--

LOCK TABLES `node` WRITE;
/*!40000 ALTER TABLE `node` DISABLE KEYS */;
INSERT INTO `node` VALUES (1,1,0,'2016-07-02 15:57:23','0000-00-00 00:00:00',0),(20,12,1,'2016-07-02 13:59:47','2016-07-02 13:59:47',0),(21,13,1,'2016-07-03 09:25:19','2016-07-02 14:00:20',1),(22,14,20,'2016-07-03 13:22:04','2016-07-03 11:22:04',0),(23,15,1,'2016-07-03 09:25:22','2016-07-02 14:35:22',2);
/*!40000 ALTER TABLE `node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node_class`
--

DROP TABLE IF EXISTS `node_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node_class` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `allow_children` int(1) NOT NULL DEFAULT '1',
  `named_identifier` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `icon` varchar(128) NOT NULL,
  `group_id` int(10) NOT NULL,
  `list_children` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `allowed_child_classes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_class`
--

LOCK TABLES `node_class` WRITE;
/*!40000 ALTER TABLE `node_class` DISABLE KEYS */;
INSERT INTO `node_class` VALUES (1,'Root Folder',1,'root_folder','2016-07-10 08:38:39','2016-07-02 15:24:52','folder-o',1,0,1,'a:1:{i:0;s:3:\"all\";}'),(12,'Pages',1,'pages','2016-07-10 08:39:33','2016-07-10 06:39:33','folder-o',1,1,1,'a:1:{i:0;s:2:\"14\";}'),(13,'Einstellungen',0,'settings','2016-07-10 08:38:43','2016-07-02 14:00:09','gear',1,0,0,'a:1:{i:0;s:3:\"all\";}'),(14,'Page',1,'page','2016-07-10 08:42:27','2016-07-10 06:42:27','file-o',2,0,0,'a:1:{i:0;s:2:\"14\";}'),(15,'System Nodes',0,'system_nodes','2016-07-10 08:38:44','2016-07-02 15:05:34','list',1,0,0,'a:1:{i:0;s:3:\"all\";}');
/*!40000 ALTER TABLE `node_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node_class_attribute`
--

DROP TABLE IF EXISTS `node_class_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node_class_attribute` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `node_id` int(10) NOT NULL,
  `class_attribute_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_class_attribute`
--

LOCK TABLES `node_class_attribute` WRITE;
/*!40000 ALTER TABLE `node_class_attribute` DISABLE KEYS */;
INSERT INTO `node_class_attribute` VALUES (1,1,1),(57,20,48),(59,21,50),(61,21,52),(62,22,53),(65,23,56),(66,23,59),(69,23,60),(80,22,65),(92,22,75),(94,22,76),(116,22,86),(121,22,89),(125,22,91);
/*!40000 ALTER TABLE `node_class_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node_class_group`
--

DROP TABLE IF EXISTS `node_class_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node_class_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_class_group`
--

LOCK TABLES `node_class_group` WRITE;
/*!40000 ALTER TABLE `node_class_group` DISABLE KEYS */;
INSERT INTO `node_class_group` VALUES (0,'Alle'),(1,'System'),(2,'Content');
/*!40000 ALTER TABLE `node_class_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node_translation`
--

DROP TABLE IF EXISTS `node_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node_translation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `node_id` int(10) NOT NULL,
  `language_id` tinyint(2) NOT NULL,
  `value` text NOT NULL,
  `node_class_attribute_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_translation`
--

LOCK TABLES `node_translation` WRITE;
/*!40000 ALTER TABLE `node_translation` DISABLE KEYS */;
INSERT INTO `node_translation` VALUES (1,1,1,'Root',1),(94,1,2,'Root',1),(96,20,1,'Pages',57),(97,20,2,'Seiten',57),(100,21,1,'Settings',59),(101,21,2,'Einstellungen',59),(104,21,1,'22',61),(105,21,2,'',61),(106,22,1,'Frontpage',62),(107,22,2,'Startseite',62),(112,23,1,'System Nodes',65),(113,23,2,'System Knoten',65),(114,23,1,'21',66),(115,23,2,'21',66),(120,23,1,'20',69),(121,23,2,'20',69),(143,22,1,'frontpage',80),(144,22,2,'frontpage',80),(167,22,1,'',92),(168,22,2,'',92),(171,22,1,'b:0;',94),(172,22,2,'b:0;',94),(216,22,1,'',116),(217,22,2,'',116),(226,22,1,'a:0:{}',121),(227,22,2,'a:0:{}',121),(234,22,1,'',125),(235,22,2,'',125);
/*!40000 ALTER TABLE `node_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `group_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Admin','admin@admin','$2y$10$b/yCdOdxw585SIhJwiRRpOBeEL9buRcthyaay1dbPW1XLbNuJkL..','Xi6v57hkiCAsiDyKISI1nPKewtLkuYZdw09P1pZwrYYWUnjg8Uaxa6IZBfpR',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `allowed_classes` varchar(512) NOT NULL DEFAULT 'a:1:{s:3:"all";i:1;}',
  `create_user` tinyint(1) NOT NULL DEFAULT '0',
  `create_class` tinyint(1) NOT NULL DEFAULT '0',
  `delete_group` tinyint(1) NOT NULL DEFAULT '0',
  `delete_class` tinyint(1) NOT NULL DEFAULT '0',
  `delete_user` tinyint(1) NOT NULL DEFAULT '0',
  `edit_user` tinyint(1) NOT NULL DEFAULT '0',
  `edit_class` tinyint(1) NOT NULL DEFAULT '0',
  `edit_group` tinyint(1) NOT NULL DEFAULT '0',
  `create_group` tinyint(1) NOT NULL DEFAULT '0',
  `list_group` tinyint(1) NOT NULL DEFAULT '0',
  `list_user` tinyint(1) NOT NULL DEFAULT '0',
  `list_class` tinyint(1) NOT NULL DEFAULT '0',
  `entry_node_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` VALUES (0,'System','a:1:{i:0;s:3:\"all\";}',1,1,1,1,1,1,1,1,1,1,1,1,-1);
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-10 11:07:09
