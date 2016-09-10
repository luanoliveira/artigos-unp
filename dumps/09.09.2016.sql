-- MySQL dump 10.13  Distrib 5.7.12, for linux-glibc2.5 (x86_64)
--
-- Host: 127.0.0.1    Database: unp
-- ------------------------------------------------------
-- Server version	5.5.50-0+deb8u1

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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(255) DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_content` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,NULL,' 2 dasdasd, Uma vez flamengo, sempre flamengo','<p>dasdasd</p>\r\n','2016-09-07 11:34:00','2016-09-07 11:38:04'),(2,NULL,'ssdf','<p>fsdfdsf</p>\r\n','2016-09-07 12:25:14','2016-09-07 12:25:14'),(6,NULL,'Teste com tag','<p>dasdasd</p>\r\n','2016-09-07 13:44:52','2016-09-07 13:44:52'),(7,NULL,'Outro teste com tag','<p>dsadasd</p>\r\n','2016-09-07 13:45:54','2016-09-07 13:45:54'),(8,NULL,'Mais umss','<p>asdasd</p>\r\n','2016-09-07 14:05:16','2016-09-07 14:05:16'),(9,NULL,'Flamengo','<p>dsadsad</p>\r\n','2016-09-07 15:01:33','2016-09-07 15:01:33'),(10,NULL,'Flamengo','<p>dsadsad</p>\r\n','2016-09-07 15:01:45','2016-09-07 15:01:45'),(11,NULL,'Flamengo','<p>dsadsad</p>\r\n','2016-09-07 15:02:20','2016-09-07 15:02:20'),(12,NULL,'Um teste completo','<p>dasdasd</p>\r\n','2016-09-07 15:02:45','2016-09-07 15:02:45'),(13,NULL,'Olá mundo','<p>dasdsadasd</p>\r\n','2016-09-07 15:03:16','2016-09-07 15:03:16'),(14,NULL,'asdasdasd','<p>dasdasd</p>\r\n','2016-09-07 15:03:28','2016-09-07 15:03:28'),(15,NULL,'sadsadasd','<p>dasdasd</p>\r\n','2016-09-07 15:05:29','2016-09-07 15:05:29'),(16,NULL,'sadsadasd','<p>dasdasd</p>\r\n','2016-09-07 15:06:18','2016-09-07 15:06:18'),(17,NULL,'saddsa','<p>dasdasd</p>\r\n','2016-09-07 15:07:11','2016-09-07 15:07:11'),(18,NULL,'dasd','<p>asdasd</p>\r\n','2016-09-07 15:07:48','2016-09-07 15:07:48'),(19,NULL,'blabla','<p>dasdsad</p>\r\n','2016-09-07 15:09:22','2016-09-07 15:09:22');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_has_tags`
--

DROP TABLE IF EXISTS `posts_has_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts_has_tags` (
  `posts_id` int(11) NOT NULL,
  `tags_id` int(11) NOT NULL,
  PRIMARY KEY (`posts_id`,`tags_id`),
  KEY `fk_posts_has_tags_tags1_idx` (`tags_id`),
  KEY `fk_posts_has_tags_posts_idx` (`posts_id`),
  CONSTRAINT `fk_posts_has_tags_posts` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_posts_has_tags_tags1` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_has_tags`
--

LOCK TABLES `posts_has_tags` WRITE;
/*!40000 ALTER TABLE `posts_has_tags` DISABLE KEYS */;
INSERT INTO `posts_has_tags` VALUES (7,1),(11,1),(12,1),(13,1),(14,1),(16,1),(18,1),(1,2),(2,2),(6,2),(8,2),(16,2),(18,2),(19,2),(1,3),(6,3),(7,3),(12,3),(14,3),(16,3),(19,5),(19,6),(19,7);
/*!40000 ALTER TABLE `posts_has_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Olá mundo 2','2016-09-07 13:44:12','2016-09-07 22:51:52'),(2,'Gremio','2016-09-07 13:44:52','2016-09-07 15:34:21'),(3,'Vasco','2016-09-07 13:45:54','2016-09-07 15:34:15'),(4,'Nova tag','2016-09-07 15:24:16','2016-09-07 15:24:16'),(5,'Flamengo','2016-09-07 15:26:19','2016-09-07 15:26:19'),(6,'Mundo','2016-09-07 15:34:31','2016-09-07 15:34:31'),(7,'Qualquer coisa','2016-09-07 21:12:28','2016-09-07 21:12:28');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Luan Oliveira','luanconecte@gmail.com','$2y$10$xIQediiDnbWKe1/qs2.xAulWmQvnpgIiQC79j.xx5Qo9ICyr/rdWq','ZToAeMtgxtXeKxYuQIoWdaCIyuB4Bx4J5v6GJNJkwSofoltcRnfNy6p6dnKj',NULL,'2016-09-09 23:31:39'),(3,'Luan Oliveira 210','luanconecte@gmail.com.br','$2y$10$l.ZQixMuGepWCoEIcPoir.Twz.d8xn9lHDRv1AJ9hHmi3KxnFqiN2','ZqGeGuUrB37cl92oWmCAbGw6LAzqsgjTuRQ3CWIuZ2Dy2qFkEbDGLloiatui','2016-09-09 23:31:22','2016-09-10 00:03:45');
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

-- Dump completed on 2016-09-09 23:35:09
