-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: thlogistics
-- ------------------------------------------------------
-- Server version	8.0.32-0ubuntu0.22.10.2

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
-- Table structure for table `kienhang`
--

DROP TABLE IF EXISTS `kienhang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kienhang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `orderCode` varchar(20) DEFAULT NULL,
  `ladingCode` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `amount` float DEFAULT '0',
  `shippingWay` varchar(20) DEFAULT NULL,
  `size` float DEFAULT NULL,
  `feetransport` float DEFAULT NULL,
  `totalfeetransport` float DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `price` float DEFAULT NULL,
  `currency` float DEFAULT NULL,
  `totalmoney` float DEFAULT NULL,
  `totalyen` float DEFAULT NULL,
  `servicefee` float DEFAULT NULL,
  `totalservicefee` float DEFAULT NULL,
  `listTimeStatus` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `user_id` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `nametq` varchar(255) DEFAULT NULL,
  `bh` int NOT NULL DEFAULT '0',
  `tienbh` float NOT NULL DEFAULT '0',
  `dateCreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `note` text,
  `total` float DEFAULT NULL,
  `linksp` text,
  `shiptq` float DEFAULT NULL,
  `magiamgia` float DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `kichthuoc` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `kienhang_chk_1` CHECK (json_valid(`listTimeStatus`))
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kienhang`
--

LOCK TABLES `kienhang` WRITE;
/*!40000 ALTER TABLE `kienhang` DISABLE KEYS */;
INSERT INTO `kienhang` VALUES (5,'TH1688005','777118248377088',1,'BT / HN1',0,28000,28000,5,0,3650,0,0,0,0,'{\"1\": \"2022-12-11T16:28:23\", \"2\": \"2022-12-16T10:45:31\", \"4\": \"2022-12-20T01:58:08\", \"5\": \"2022-12-21T01:58:08\"}',33,'Tạp dề','男',0,0,'2022-12-11 08:27:11','MKH THKG275',28000,'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.20.2c714174f0O5KL&id=605150240460',NULL,NULL,NULL,NULL),(6,'TH1688006','JT5163725253101',1,'BT / HN1',0,28000,28000,5,0,3650,0,0,0,0,'{\"1\": \"2022-12-13T10:37:17\", \"2\": \"2022-12-14T14:09:42\", \"4\": \"2022-12-20T01:57:29\", \"5\": \"2022-12-21T01:57:29\"}',33,'Dụng cụ tập thể dục','男',0,0,'2022-12-11 08:27:11','MKH THKG275',28000,'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.20.2c714174f0O5KL&id=605150240460',NULL,NULL,NULL,NULL),(7,'TH1688007','9852007988154',1,'BT / HN1',0,28000,28000,5,0,3650,0,0,0,0,'{\"1\": \"2022-12-11T16:28:15\", \"2\": \"2022-12-14T14:09:10\", \"4\": \"2022-12-20T01:57:19\", \"5\": \"2022-12-21T01:57:19\"}',33,'Áo tập thể dục','男',0,0,'2022-12-11 08:27:11','MKH THKG275',28000,'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.20.2c714174f0O5KL&id=605150240460',NULL,NULL,NULL,NULL),(8,'TH1688008','9851934970607',1,'BT / HN1',0,28000,28000,5,0,3650,0,0,0,0,'{\"1\": \"2022-12-11T16:28:10\", \"2\": \"2022-12-13T10:34:40\", \"4\": \"2022-12-20T01:58:02\", \"5\": \"2022-12-21T01:58:02\"}',33,'Thuốc tẩy','男',0,0,'2022-12-11 08:27:11','MKH THKG275',28000,'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.20.2c714174f0O5KL&id=605150240460',NULL,NULL,NULL,NULL),(9,'TH1688009','JT3019292387127 ',1,'BT/HN1',13,28000,28000,1,0,3610,0,0,0.02,0,'{\"1\":\"2022-12-13T17:36:48\"}',37,'Áo Nữ','',0,0,'2022-12-13 17:36:48','',28000,'https://mobile.yangkeduo.com/goods2.html?_wvx=10&refer_share_uin=JCNCTXVJ43ALS7434LHP647D2I_GEXDA&refer_share_id=HulHuqtv3IDEl9DFFidplePRDPjoVjlH&share_uin=JCNCTXVJ43ALS7434LHP647D2I_GEXDA&page_from=101&_wv=41729&refer_share_channel=copy_link&pxq_secret_key=K2JOACBKFP2G7WG4OARYM64X6JN2X7IBCFR6QGSQON5VCVMW5LEA&goods_id=326788273894',0,0,'',''),(10,'TH16880010','YT8476100819062',1,'BT/HN1',13,28000,28000,1,0,3610,0,0,0.02,0,'{\"1\":\"2022-12-13T17:36:48\"}',37,'Áo Nữ','',0,0,'2022-12-13 17:36:48','',28000,'https://mobile.yangkeduo.com/goods1.html?_wvx=10&refer_share_uin=JCNCTXVJ43ALS7434LHP647D2I_GEXDA&refer_share_id=FTh8Vkn3DAYn1HZj0swzbonVrgevu9Uf&share_uin=JCNCTXVJ43ALS7434LHP647D2I_GEXDA&page_from=101&_wv=41729&refer_share_channel=copy_link&pxq_secret_key=K2JOACBKFP2G7WG4OARYM64X6ITVHYQI5PTKP7BH33JXKBD37D4Q&goods_id=353367786333',0,0,'',''),(19,'TH16880019','78640324277620',3,'BT/HN1',13,28000,84000,4,0,3610,0,0,0.02,0,'{\"1\": \"2022-12-14T02:28:38\", \"4\": \"2022-12-14T11:31:43\"}',38,'Aó moto GP','',0,0,'2022-12-14 02:28:38','',84000,'',0,0,'',''),(22,'TH16880022','432956833007555',1,'BT/HN1',13,28000,28000,2,0,3610,0,0,0,0,'{\"1\": \"2022-12-14T02:43:42\", \"2\": \"2022-12-16T10:44:56\"}',39,'giày nike','',0,0,'2022-12-14 02:43:42','',28000,'',0,0,'',''),(23,'TH16880023','SF1149247809416 ',1,'BT/HN1',13,28000,28000,1,0,3610,0,0,0,0,'{\"1\":\"2022-12-14T02:43:42\"}',39,'giày nike','',0,0,'2022-12-14 02:43:42','',28000,'',0,0,'',''),(24,'TH16880024','78640947107626',1,'BT/HN1',13,28000,28000,5,0,3610,0,0,0.02,0,'{\"1\": \"2022-12-14T03:14:24\", \"2\": \"2022-12-14T14:08:19\", \"4\": \"2022-12-16T03:05:10\", \"5\": \"2022-12-17T03:05:10\"}',34,'Aó nam','',0,0,'2022-12-14 03:14:24','',28000,'',0,0,'',''),(27,'TH16880027','432964427133174',1,'BT/HN1',13,28000,28000,5,0,3610,0,0,0.02,0,'{\"1\": \"2022-12-14T08:35:28\", \"2\": \"2022-12-16T10:45:07\", \"4\": \"2022-12-19T08:13:28\", \"5\": \"2022-12-20T08:13:28\"}',40,'Aó lông nữ','',0,0,'2022-12-14 08:35:28','TH276-Ngân',28000,'',0,0,'',''),(28,'TH16880028','773197986879883',1,'BT/HN1',13,28000,28000,5,0,3610,0,0,0.02,0,'{\"1\": \"2022-12-14T08:35:28\", \"2\": \"2022-12-15T09:51:19\", \"4\": \"2022-12-19T08:12:46\", \"5\": \"2022-12-20T08:12:46\"}',40,'Váy nữ','',0,0,'2022-12-14 08:35:28','TH276-Ngân',28000,'',0,0,'',''),(31,'TH16880031','78641765398233',1,'BT/HN1',13,28000,28000,2,0,3610,0,0,0.02,0,'{\"1\": \"2022-12-14T15:10:04\", \"2\": \"2022-12-16T10:31:48\"}',41,'Aó Nam','',0,0,'2022-12-14 15:10:04','TH271-Anne Dinh',28000,'',0,0,'',''),(33,'TH16880033','78640324277620',3,'BT/HN1',13,28000,84000,4,0,3610,0,0,0.02,0,'{\"1\": \"2022-12-14T16:39:38\", \"2\": \"2022-12-15T09:53:19\", \"4\": \"2022-12-15T09:53:32\"}',38,'Aó moto GP','',0,0,'2022-12-14 16:39:38','',84000,'',0,0,'',''),(37,'TH16880037','S60435468615',400,'BT/HN1',40,28000,11200000,2,0,3610,0,0,0.02,0,'{\"1\": \"2022-12-14T17:58:35\", \"2\": \"2022-12-15T09:52:20\"}',44,'Bát đĩa','',0,0,'2022-12-14 17:58:35','',11200000,'',0,0,'',''),(38,'TH16880038','9889654714999',0,'BT/HN1',13,28000,0,2,0,3610,0,0,0.02,0,'{\"1\": \"2022-12-14T18:01:06\", \"2\": \"2022-12-15T09:52:48\"}',45,'Quần tất trẻ em','',0,0,'2022-12-14 18:01:06','Quỳnh Anh',0,'',0,0,'',''),(39,'TH16880039','YT6932071153961',0,'BT/HN1',13,28000,0,2,0,3610,0,0,0.02,0,'{\"1\": \"2022-12-14T18:01:06\", \"2\": \"2022-12-15T09:52:55\"}',45,'Váy trẻ em','',0,0,'2022-12-14 18:01:06','Quỳnh Anh',0,'',0,0,'',''),(41,'TH16880041','78643228899268',1,'BT/HN1',0,28000,28000,2,161.49,3560,3560,161.49,0,0,'{\"1\":\"2022-12-17T02:51:41\"}',47,'Váy liền','',0,0,'2022-12-17 02:51:41','Không',31560,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',0,0,'đen','s'),(42,'TH16880042','YT6929654093900',1,'BT/HN1',1,32000,32000,5,1,3560,3560,1,3,106.8,'{\"1\": \"2022-12-17T02:53:11\", \"4\": \"2022-12-19T08:08:24\", \"5\": \"2022-12-20T08:08:24\"}',47,'Váy liền','',0,0,'2022-12-17 02:53:11','Không',35666.8,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',0,0,'đen','s'),(43,'TH16880043','YT6929266341400',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-17T02:54:10\", \"4\": \"2022-12-19T08:11:37\", \"5\": \"2022-12-20T08:11:37\"}',47,'giày bệt','',0,0,'2022-12-17 02:54:10','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',0,0,'đen','36'),(44,'TH16880044','YT6929301474343',1,'',1,32000,32000,5,12,3650,3650,12,3,109.5,'{\"1\": \"2022-12-17T02:59:16\", \"4\": \"2022-12-19T08:09:10\", \"5\": \"2022-12-20T08:09:10\"}',47,'Váy liền','',0,0,'2022-12-17 02:59:16','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',0,0,'đen','s'),(45,'TH16880045','78642966257870',1,'BT/HN1',1,32000,32000,5,12,3650,3650,12,3,109.5,'{\"1\": \"2022-12-17T03:00:01\", \"4\": \"2022-12-19T08:07:44\", \"5\": \"2022-12-20T08:07:44\"}',47,'Váy liền','',0,0,'2022-12-17 03:00:01','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',0,0,'trắng','s'),(46,'TH16880046','78641067720028',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-17T03:00:40\", \"4\": \"2022-12-19T08:09:40\", \"5\": \"2022-12-20T08:09:40\"}',47,'quần da','',0,0,'2022-12-17 03:00:40','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',0,0,'đen','L'),(47,'TH16880047','JT3019942457636',1,'BT/HN1',0.2,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-17T03:01:16\", \"2\": \"2022-12-03T17:08:23\", \"3\": \"2022-12-05T17:08:44\", \"4\": \"2022-12-19T08:11:02\", \"5\": \"2022-12-20T08:11:02\"}',47,'Aó nữ','',0,0,'2022-12-17 03:01:16','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'đen','s'),(48,'TH16880048','JT3020711263258',1,'BT/HN1',1,32000,32000,2,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-17T03:01:55\", \"2\": \"2022-12-26T10:35:45\"}',47,'Sét quần áo nữ','',0,0,'2022-12-17 03:01:55','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'trắng','s'),(49,'TH16880049','773197318912935',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-17T03:02:28\", \"4\": \"2022-12-19T07:59:34\", \"5\": \"2022-12-20T07:59:34\"}',47,'giày bệt','',0,0,'2022-12-17 03:02:28','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'đen','36'),(50,'TH16880050','773197831965029',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-17T03:03:17\", \"4\": \"2022-12-19T08:10:23\", \"5\": \"2022-12-20T08:10:23\"}',47,'váy nữ','',0,0,'2022-12-17 03:03:17','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'trắng','s'),(51,'TH16880051','JDJ001409516132',1,'BT/HN1',1,32000,32000,2,1,3650,3650,1,3,109.5,'{\"1\":\"2022-12-17T03:03:54\"}',47,'giày nam','',0,0,'2022-12-17 03:03:54','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'đen','43'),(52,'TH16880052','YT6949958624269',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-17T03:09:09\", \"2\": \"2022-12-26T10:35:11\", \"4\": \"2022-12-27T07:14:51\", \"5\": \"2022-12-28T07:14:51\"}',46,'giày bệt','',0,0,'2022-12-17 03:09:09','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',0,0,'nâu','35'),(53,'TH16880053','YT6949923457100',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-17T03:10:04\", \"2\": \"2022-12-21T14:19:46\", \"4\": \"2022-12-26T02:27:21\", \"5\": \"2022-12-27T02:27:21\"}',46,'giày nam','',0,0,'2022-12-17 03:10:04','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'nâu','41'),(54,'TH16880054','JT5164170683273',1,'',0.5,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-16T14:31:49\", \"2\": \"2022-12-17T22:23:20\", \"4\": \"2022-12-19T09:07:32\", \"5\": \"2022-12-20T09:07:32\"}',49,'giày bot nữ','',0,0,'2022-12-19 07:31:27','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'đen','36'),(55,'TH16880055','78643953516080 ',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-19T07:36:45\", \"2\": \"2022-12-21T14:21:01\", \"4\": \"2022-12-26T02:24:57\", \"5\": \"2022-12-27T02:24:57\"}',46,'Quần nam','',0,0,'2022-12-19 07:36:45','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(56,'TH16880056','432978176942694 ',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-19T07:37:59\", \"2\": \"2022-12-26T10:34:44\", \"4\": \"2022-12-27T07:12:55\", \"5\": \"2022-12-28T07:12:55\"}',46,'Aó nam','',0,0,'2022-12-19 07:37:59','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(57,'TH16880057','YT6951400726600 ',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-19T07:38:56\", \"2\": \"2022-12-26T10:34:14\", \"4\": \"2022-12-27T07:14:24\", \"5\": \"2022-12-28T07:14:24\"}',46,'Túi nữ','',0,0,'2022-12-19 07:38:56','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(58,'TH16880058','73195153686721',1,'BT/HN1',1,32000,32000,5,599,3650,3650,599,3,109.5,'{\"1\": \"2022-12-19T07:42:21\", \"2\": \"2022-12-25T11:53:02\", \"4\": \"2022-12-27T07:12:15\", \"5\": \"2022-12-28T07:12:15\"}',48,'Aó phao nữ','',0,0,'2022-12-19 07:42:21','Không',35759.5,'https://item.taobao.com/item.htm?spm=a1z09.2.0.0.75532e8dbz0vu8&id=693723991260&_u=h3vluih84865',1,1,'đỏ','s'),(59,'TH16880059','78644374725806',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-19T07:43:12\", \"2\": \"2022-12-26T10:33:23\", \"4\": \"2022-12-27T07:18:39\", \"5\": \"2022-12-28T07:18:39\"}',39,'Bót nữ','',0,0,'2022-12-19 07:43:12','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(60,'TH16880060','YT6950048221070 ',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-19T07:45:02\", \"2\": \"2022-12-26T10:32:58\", \"4\": \"2022-12-27T07:14:37\", \"5\": \"2022-12-28T07:14:37\"}',41,'Aó thun nữ','',0,0,'2022-12-19 07:45:02','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(61,'TH16880061','773198787642688',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-19T07:46:13\", \"2\": \"2022-12-26T10:32:30\", \"4\": \"2022-12-27T07:19:02\", \"5\": \"2022-12-28T07:19:02\"}',38,'Mũ bảo hiểm xe máy','',0,0,'2022-12-19 07:46:13','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(62,'TH16880062','JT3020711263258',1,'BT/HN1',1,32000,32000,4,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-19T08:05:19\", \"2\": \"2022-12-26T10:32:08\", \"4\": \"2023-01-05T16:09:48\"}',47,'Sét nữ','',0,0,'2022-12-19 08:05:19','Không',35759.5,'https://item.taobao.com/item.htm?spm=a1z09.2.0.0.65052e8dD9vK1Y&id=652508224747&_u=c3vluih8856e',1,1,'1','1'),(63,'TH16880063','JDJ001409516132',1,'BT/HN1',1,32000,32000,4,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-20T22:30:35\", \"4\": \"2023-01-05T16:09:28\"}',47,'Giày zara','',0,0,'2022-12-19 08:06:17','Không',35759.5,'https://item.taobao.com/item.htm?spm=a1z09.2.0.0.65052e8dD9vK1Y&id=652508224747&_u=c3vluih8856e',1,1,'1','1'),(64,'TH16880064','75555061846298',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-12T10:06:53\", \"2\": \"2022-12-15T14:58:24\", \"4\": \"2022-12-26T02:24:40\", \"5\": \"2022-12-27T02:24:40\"}',50,'Áo nữ','',0,0,'2022-12-20 23:57:48','Không',35759.5,'https://item.taobao.com/item.htm?spm=a1z09.2.0.0.65052e8dD9vK1Y&id=652508224747&_u=c3vluih8856e',1,1,'1','1'),(66,'TH16880066','YT1670337414434',11,'BT/HN1',1,32000,352000,5,1,3650,40150,11,3,1204.5,'{\"1\": \"2022-12-14T11:02:12\", \"2\": \"2022-12-18T12:02:25\", \"4\": \"2022-12-31T03:25:28\", \"5\": \"2023-01-01T03:25:28\"}',50,'Áo nữ','',0,0,'2022-12-21 00:02:07','Không',393354,'https://item.taobao.com/item.htm?spm=a1z09.2.0.0.65052e8dD9vK1Y&id=652508224747&_u=c3vluih8856e',1,1,'1','1'),(67,'TH16880067','776336159166103',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-14T08:30:58\", \"2\": \"2022-12-21T14:33:07\", \"4\": \"2022-12-27T07:15:05\", \"5\": \"2022-12-28T07:15:05\"}',50,'Áo nữ','',0,0,'2022-12-21 00:03:54','Không',35759.5,'https://item.taobao.com/item.htm?spm=a1z09.2.0.0.65052e8dD9vK1Y&id=652508224747&_u=c3vluih8856e',1,1,'1','1'),(68,'TH16880068','75555498227591',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-14T15:05:14\", \"2\": \"2022-12-17T10:05:27\", \"4\": \"2022-12-31T03:25:33\", \"5\": \"2023-01-01T03:25:33\"}',50,'Áo nữ','',0,0,'2022-12-21 00:05:07','Không',35759.5,'https://item.taobao.com/item.htm?spm=a1z09.2.0.0.65052e8dD9vK1Y&id=652508224747&_u=c3vluih8856e',1,1,'1','1'),(69,'TH16880069','75555692117724',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-15T10:06:39\", \"2\": \"2022-12-26T10:30:43\", \"4\": \"2022-12-27T07:13:07\", \"5\": \"2022-12-28T07:13:07\"}',50,'Áo nữ','',0,0,'2022-12-21 00:06:28','Không',35759.5,'https://item.taobao.com/item.htm?spm=a1z09.2.0.0.65052e8dD9vK1Y&id=652508224747&_u=c3vluih8856e',1,1,'1','1'),(70,'TH16880070','777119866042082',1,'BT/HN1',1,32000,32000,2,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-22T03:11:11\", \"2\": \"2022-12-26T10:30:21\"}',33,'Khăn lụa','',0,0,'2022-12-22 03:11:11','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','s'),(71,'TH16880071','462710574144114',4,'BT/HN1',1,32000,128000,5,1,3650,14600,4,3,438,'{\"1\": \"2022-12-25T04:48:04\", \"2\": \"2022-12-26T10:29:57\", \"4\": \"2022-12-27T07:15:53\", \"5\": \"2022-12-28T07:15:53\"}',49,'Aó len','',0,0,'2022-12-25 04:48:04','Không',143038,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'đen','s'),(72,'TH16880072','YT6967176034291',1,'BT/HN1',1,32000,32000,4,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-27T07:07:27\", \"2\": \"2023-01-03T09:01:38\", \"3\": \"2023-01-03T14:01:58\", \"4\": \"2023-01-05T09:02:12\"}',52,'Aó khoác dài nữ','',0,0,'2022-12-27 07:07:27','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'Nâu sữa','xs'),(73,'TH16880073','75106149182',600,'BT/HN1',14,32000,19200000,1,1,3650,2190000,600,3,65700,'{\"1\":\"2022-12-28T07:47:51\"}',53,'Bút mực nước','',0,0,'2022-12-28 07:47:51','Không',21455700,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'Xanh','1'),(74,'TH16880074','777120750507235',1,'BT/HN1',1,32000,32000,5,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-26T08:44:14\", \"2\": \"2022-12-27T10:44:30\", \"4\": \"2022-12-31T03:30:53\", \"5\": \"2023-01-01T03:30:53\"}',33,'Váy liền','',0,0,'2022-12-29 03:43:58','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(75,'TH16880075','773200612492716',1,'BT/HN1',1,32000,32000,4,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-28T14:55:29\", \"2\": \"2023-01-02T16:54:11\", \"4\": \"2023-01-07T09:34:57\"}',41,'Bộ ngủ','',0,0,'2023-01-05 07:53:58','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'đen','s'),(76,'TH16880076','78647133671116',1,'BT/HN1',1,32000,32000,4,1,3650,3650,1,3,109.5,'{\"1\": \"2022-12-31T14:55:07\", \"2\": \"2023-01-03T15:55:51\", \"4\": \"2023-01-07T09:34:49\"}',41,'Aó thun nam','',0,0,'2023-01-05 07:55:04','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(77,'TH16880077','78314347025100',1,'BT/HN1',1,32000,32000,4,1,3650,3650,1,3,109.5,'{\"1\": \"2023-01-03T14:15:03\", \"2\": \"2023-05-04T09:15:37\", \"4\": \"2023-01-07T09:15:48\"}',33,'giày bệt','',0,0,'2023-01-07 02:14:53','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(78,'TH16880078','777121571756523',1,'BT/HN1',1,32000,32000,4,1,3650,3650,1,3,109.5,'{\"1\": \"2023-01-05T16:36:58\", \"2\": \"2023-01-07T15:51:18\", \"4\": \"2023-01-10T09:51:33\"}',33,'Váy liền','',0,0,'2023-01-07 09:35:49','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(79,'TH16880079','777121813025180',1,'BT/HN1',1,32000,32000,4,1,3650,3650,1,3,109.5,'{\"1\": \"2023-01-05T16:36:51\", \"2\": \"2023-01-08T14:51:05\", \"4\": \"2023-01-10T09:51:28\"}',33,'Váy liền','',0,0,'2023-01-07 09:36:24','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(80,'TH16880080','78317733331926',1,'BT/HN1',1,32000,32000,2,1,3650,3650,1,3,109.5,'{\"1\": \"2023-01-30T01:51:55\", \"2\": \"2023-01-31T09:42:18\"}',33,'Váy liền','',0,0,'2023-01-30 01:51:55','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(81,'TH16880081','773203745436912',2,'BT/HN1',1,32000,64000,1,1,3650,7300,2,3,219,'{\"1\": \"2023-01-31T20:55:44\"}',54,'giày nữ','',0,0,'2023-01-31 13:55:34','Không',71519,'https://item.taobao.com/item.htm?spm=a1z09.2.0.0.65052e8dD9vK1Y&id=652508224747&_u=c3vluih8856e',1,1,'1','1'),(88,'TH16880088','433036493133580',3,'BT/HN1',1,32000,96000,2,1,3650,10950,3,3,328.5,'{\"1\": \"2023-02-01T02:13:03\", \"2\": \"2023-02-04T09:10:19\"}',32,'Bóp ví','',0,0,'2023-02-01 02:13:03','Không',107278,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(89,'TH16880089','78318191013866',1,'BT/HN1',1,32000,32000,2,1,3650,3650,1,3,109.5,'{\"1\": \"2023-02-01T02:54:46\", \"2\": \"2023-02-03T11:39:41\"}',33,'Váy liền','',0,0,'2023-02-01 02:54:46','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(90,'TH16880090','78653349523093',1,'BT/HN1',1,32000,32000,2,1,3650,3650,1,3,109.5,'{\"1\": \"2023-02-01T07:40:07\", \"2\": \"2023-02-04T09:30:42\"}',56,'Aó bommer nam','',0,0,'2023-02-01 07:40:07','Không',35759.5,'https://item.taobao.com/item.htm?spm=a1z09.2.0.0.75532e8dQw7ia9&id=679192481917&_u=13vluih81821',0,0,'Xanh','L'),(91,'TH16880091','78653087290169',1,'BT/HN1',1,32000,32000,2,1,3650,3650,1,3,109.5,'{\"1\": \"2023-02-01T07:41:11\", \"2\": \"2023-02-04T09:38:29\"}',56,'Aó bommer nam','',0,0,'2023-02-01 07:41:11','Không',35759.5,'https://item.taobao.com/item.htm?spm=a1z09.2.0.0.75532e8dbz0vu8&id=693723991260&_u=h3vluih84865',0,0,'Đen','M'),(92,'TH16880092','78653278207905',1,'BT/HN1',1,32000,32000,2,1,3550,3550,1,3,106.5,'{\"1\": \"2023-02-01T07:42:02\", \"2\": \"2023-02-04T09:26:07\"}',56,'Aó bommer nam','',0,0,'2023-02-01 07:42:02','Không',35656.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',0,0,'Xanh','M'),(93,'TH16880093','SF1142446469817',10,'BT/HN1',10,32000,320000,2,1,3650,36500,10,3,1095,'{\"1\": \"2023-02-01T07:43:51\", \"2\": \"2023-02-04T09:18:52\"}',56,'Aó bommer nam zara','',0,0,'2023-02-01 07:43:51','Không',357595,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',0,0,'đen','s'),(94,'TH16880094','78653287971495',6,'BT/HN1',6,32000,192000,2,0,3650,0,0,3,0,'{\"1\": \"2023-02-02T02:40:51\", \"2\": \"2023-02-04T09:08:43\"}',56,'Aó bommer nam','',0,0,'2023-02-02 02:40:51','Không',192000,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',0,0,'đen','s'),(95,'TH16880095','78318657629818',1,'BT/HN1',1,32000,32000,2,1,3650,3650,1,3,109.5,'{\"1\": \"2023-02-03T04:41:25\", \"2\": \"2023-02-04T09:14:25\"}',33,'Váy liền','',0,0,'2023-02-03 04:41:25','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(96,'TH16880096','JT5171043305568',1,'BT/HN1',1,32000,32000,2,1,3650,3650,1,3,109.5,'{\"1\": \"2023-02-03T09:01:28\", \"2\": \"2023-02-04T09:14:43\"}',33,'Váy liền','',0,0,'2023-02-03 09:01:28','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',1,1,'1','1'),(97,'TH16880097','78653622544281',1,'BT/HN1',1,32000,32000,1,0,3650,0,0,3,0,'{\"1\":\"2023-02-04T02:12:17\"}',54,'Chân váy','',0,0,'2023-02-04 02:12:17','Không',32000,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',0,0,'đen','L'),(98,'TH16880098','773204629862862',1,'BT/HN1',1,32000,32000,1,1,3650,3650,1,3,109.5,'{\"1\":\"2023-02-04T02:13:02\"}',54,'Aó nam','',0,0,'2023-02-04 02:13:02','Không',35759.5,'https://detail.i56.taobao.com/trace/trace_detail.htm?tId=3079519165481438449&userId=2464737198',0,0,'đen','L');
/*!40000 ALTER TABLE `kienhang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phieugiaohang`
--

DROP TABLE IF EXISTS `phieugiaohang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phieugiaohang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `maphieu` varchar(16) DEFAULT NULL,
  `listmakien` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `sokien` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `user_id` int DEFAULT NULL,
  `diachigiao` varchar(255) DEFAULT NULL,
  `cannang` float NOT NULL DEFAULT '0',
  `ship` float NOT NULL,
  `cod` float NOT NULL DEFAULT '0',
  `ghichu` varchar(255) DEFAULT NULL,
  `tienmat` float DEFAULT '0',
  `ngaytao` datetime NOT NULL,
  `ngaygiao` datetime NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `phieugiaohang_chk_1` CHECK (json_valid(`listmakien`))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phieugiaohang`
--

LOCK TABLES `phieugiaohang` WRITE;
/*!40000 ALTER TABLE `phieugiaohang` DISABLE KEYS */;
INSERT INTO `phieugiaohang` VALUES (1,'TH001',NULL,3,1,21,'Ha Dong Ha Noi',12.3,0,500000,'fgfgfg',0,'2022-12-02 14:39:15','2022-12-02 14:39:15');
/*!40000 ALTER TABLE `phieugiaohang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shoe_image`
--

DROP TABLE IF EXISTS `shoe_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shoe_image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `shoe_id` int NOT NULL,
  `link_image` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shoe_image`
--

LOCK TABLES `shoe_image` WRITE;
/*!40000 ALTER TABLE `shoe_image` DISABLE KEYS */;
INSERT INTO `shoe_image` VALUES (1,16,'imageShoe/73039743_457799481516743_2944413433908428800_n.jpg'),(2,16,'imageShoe/74589546_545009112982009_579124783078178816_n.jpg'),(3,16,'imageShoe/146972117_2849928912001221_7521882077628797924_n.jpg'),(4,15,'imageShoe/278436512_1056949608191262_6272145579401916967_n.jpg'),(5,15,'imageShoe/278713399_1987770381397641_3834876700356754447_n.jpg'),(6,15,'imageShoe/ao.jpg'),(7,19,'imageShoe/167460640_548361456141577_4021222783376699911_n (2).jpg'),(8,19,'imageShoe/167460640_548361456141577_4021222783376699911_n.jpg'),(9,19,'imageShoe/186990832_2912094862453743_3770370240088288146_n.jpg'),(10,19,'imageShoe/213649488_187668229973939_9155369604254683281_n.jpg'),(21,21,'imageShoe/73039743_457799481516743_2944413433908428800_n.jpg'),(24,24,'imageShoe/146972117_2849928912001221_7521882077628797924_n.jpg'),(25,24,'imageShoe/ao.jpg'),(26,23,'imageShoe/73039743_457799481516743_2944413433908428800_n.jpg'),(27,23,'imageShoe/74589546_545009112982009_579124783078178816_n.jpg'),(28,23,'imageShoe/146972117_2849928912001221_7521882077628797924_n.jpg'),(29,22,'imageShoe/cogiaoman.png'),(30,25,'imageShoe/SharedScreenshot3.jpg'),(31,25,'imageShoe/SharedScreenshot4.jpg'),(32,25,'imageShoe/SharedScreenshot5.jpg'),(33,26,'imageShoe/SharedScreenshot.jpg'),(34,26,'imageShoe/SharedScreenshot2.jpg'),(35,27,'imageShoe/245073628_3091058767796051_5731964485928323993_n.jpg'),(36,27,'imageShoe/245495174_2898697773716058_6691009756593589867_n.png'),(37,27,'imageShoe/245642692_415139920308073_6895757974366559092_n.png'),(38,28,'imageShoe/313879854_3419763658251666_4978816054660034339_n.jpg');
/*!40000 ALTER TABLE `shoe_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Shop gửi hàng'),(2,'TQ Nhận hàng'),(3,'Vận chuyển'),(4,'Nhập kho VN'),(5,'Đang giao hàng'),(6,'Đã giao hàng');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `th1688`
--

DROP TABLE IF EXISTS `th1688`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `th1688` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tygia` float DEFAULT '3600',
  `phidichvu` float NOT NULL DEFAULT '3',
  `giavanchuyen` float NOT NULL DEFAULT '32000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `th1688`
--

LOCK TABLES `th1688` WRITE;
/*!40000 ALTER TABLE `th1688` DISABLE KEYS */;
INSERT INTO `th1688` VALUES (1,3650,3,32000);
/*!40000 ALTER TABLE `th1688` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `code` varchar(16) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '0',
  `gender` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (27,'th1688','TH168827','25d55ad283aa400af464c76d713c07ad','Trung Hoa Logistics','1993-01-01','Nga Ba Ba La Ha Dong HN',1,1,'thlogistics1688@gmail.com','0336991688'),(32,'duyen193','TH277','ebd358ad91a865dc82bbcb7176ede4e8','phan thị mỹ duyên','2004-03-19','hh02-1a, kđt Thanh Hà, Cự Khê, Thanh Oai, Hà Nội',0,0,'phamyduyen19032004@gmail.com','0365167826'),(33,'thanhnga','THKG275','25d55ad283aa400af464c76d713c07ad','Thanh Nga ','2000-02-02','Hà Đông Hà Nội',0,1,'Aries.myzbie@gmail.com','0988888888'),(34,'minh12345','TH168834','f96d2bf8a643be6cee1bfab179f42189','Nguyễn Quang Minh','2022-09-07','Ngõ 11, Tôn Đức Thắng, Khai Quang, Vĩnh Yên, Vĩnh Phúc',0,1,'minhquang416035@gmail.com','0919147784'),(35,'Tuananh27 ','TH168835','e1e92c0b27b72200218397bc3eabbf55','Anh Tuấn','2000-09-01','Cầu Hổ, Phường Mai Lâm, Thị Xã Nghi Sơn, Thanh Hoá',0,1,'mynameistung27@gmail.com','+843932243'),(36,'duannv','TH168836','37665bd7d022788ad8efdbaced4690a7','Nguyen Duan','1993-03-26','La Casta Tower, Văn Phú, Hà Đông, Hà Nội',0,1,'duank15st@gmail.com','0961378578'),(37,'duykhoa','THKG837','25d55ad283aa400af464c76d713c07ad','Duy Khoa','2000-02-02','Hà Đông Hà Nội',0,1,'duykhoa@gmail.com','0988888888'),(38,'thuylinh273','TH273','25d55ad283aa400af464c76d713c07ad','Thùy Linh','2000-02-02','Hà Đông Hà Nội',0,0,'thuylinh@gmail.com','0988888888'),(39,'hoang','Beo','25d55ad283aa400af464c76d713c07ad','Hoàng','2000-12-16','Hà Đông Hà Nội',0,1,'hoang@gmail.com','0988888888'),(40,'thngan276','THOD276','25d55ad283aa400af464c76d713c07ad','Ngan 276','1993-01-01','Ha Dong HN',0,0,'ngan276@gmail.com','0336991688'),(41,'anne271','TH271','25d55ad283aa400af464c76d713c07ad','Anne Dinh','2000-02-02','Hà Đông Hà Nội',0,0,'anne271@gmail.com','0988888888'),(42,'Hanglt93','TH283','c485f93eccc7bf6eb338b2f89dc43d95','Lê Thu Hằng','1993-03-06','57 An Dương, Yên Phụ,Tây Hồ, Hà Nội',0,0,'hanglt6393@gmail.com','0818406393'),(43,'hoangthuha','TH274','25d55ad283aa400af464c76d713c07ad','TH274-Hoàng Thu Hà','1993-01-01','Ha Dong HN',0,0,'hoangtuhha@gmail.com','0968160693'),(44,'dieulinh','THOD284','25d55ad283aa400af464c76d713c07ad','Lê Thị Diệu Linh','1993-01-01','Ha Dong HN',0,0,'dieulinh@gmail.com','0968160693'),(45,'quynhanh','Quỳnh Anh','25d55ad283aa400af464c76d713c07ad','Quynh Anh','1993-01-01','Ha Dong HN',0,0,'quynhanh@gmail.com','0336991688'),(46,'Tranvantam1003','THOD285','1781e27f35665336b5f1e63f0024e256','Trần văn tâm','1996-03-10','Thạch hoà, thật thất, hà nội',0,1,'tranvunhatkhanh1720@gmail.com','0369684345'),(47,'Tuấn Bân','Bân','25d55ad283aa400af464c76d713c07ad','Bân','2020-11-01','Hạ Long Quảng Ninh',0,0,'hieunt196793@gmail.com','0963312942'),(48,'Thanh','THOD287','3ab1e89495885c22f4f9b0a0a968c0c1','Trần thi thanh','2022-12-06','Xóm 3, diễn phong, diễn châu, nghệ an',0,1,'Hungthanh080591@gmail.com','0986096379'),(49,'Đặng Tâm','THKG278','0a60e33e3eebda562e2cfd297e7bd940','tam dang','1997-05-30','27, liền kề 9, kdt văn phú, phú la, hà đông',0,1,'dangtam.teac@gmail.com','0981783543'),(50,'THKG278 ','THKG278','25d55ad283aa400af464c76d713c07ad','Linh','1997-11-05','Hà Đông Hà Nội',0,0,'linh278@gmail.com','0934508173'),(51,'BeHuynh','THOD00','13c93504112271e7a4c2f804d93f494b','Huynh Phuong Thao','2022-12-24','242/24 Nguyễn Xí, phường 13, quận Bình Thạnh, tphcm',0,0,'shelly.huynh381@gmail.com','0937685818'),(52,'Doha298','THOD291','5ac8f1552f3850838835bc0d9c3b69d0','Đỗ thị hà','1992-08-29','Thanh oai hà nội',0,0,'dothiha298@gmail.com','0976345935'),(53,'NGOCNHUY458','THOD290','46b016846ae95ff3cd335e3f3aeeb08d','BÙI THỊ NGOC','1990-08-16','F5/22 ĐƯỜNG LIÊN ẤP 2,6 XÃ VĨNH LỘC A, BÌNH CHÁNH, TPHCM',0,0,'ngocnhuy458@gmail.com','0343556851'),(54,'Ngatmini','THKG292','d6b0ab7f1c8ab8f514db9a6d85de160a','Hồng Ngát','2022-12-29','số nhà 6, ngách 23 Ngõ Trạm Điện, Quang Trung, Hà Đông',0,0,'ngat182001@gmail.com','0967868019'),(55,'Hoangblue','THKG293','471529fdbb791586245c3f39037bb56b','Nguyễn Văn Hoàng','2023-01-10','Huyện Quảng Ninh - tỉnh Quảng Bình',0,1,'ngochoang97qb@gmail.com','0818696941'),(56,'mqstore','THOD294','df2b0e29ff56721952b5c757c3e0d077','Trương Quân','1988-08-21','85 E Nguyễn Văn Trỗi , phường 2 Đà Lạt',0,1,'dl.truongminhquan@gmail.com','0862311339'),(57,'Nga Nghẹo','THOD295','25d55ad283aa400af464c76d713c07ad','Thuy Nga','2020-11-01','Tecco Phủ Liễn -P Hoàng Văn Thụ-TP Thái Nguyên ',0,1,'thuynga.avaunique@gmail.com','0988412791');
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

-- Dump completed on 2023-02-04  8:15:12
