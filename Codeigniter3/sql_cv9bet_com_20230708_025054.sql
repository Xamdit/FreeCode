-- MariaDB dump 10.17  Distrib 10.4.12-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: sql_cv9bet_com
-- ------------------------------------------------------
-- Server version	10.4.12-MariaDB-log

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
-- Table structure for table `acc_withdraw`
--

DROP TABLE IF EXISTS `acc_withdraw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc_withdraw` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `accnum` varchar(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_withdraw`
--

LOCK TABLES `acc_withdraw` WRITE;
/*!40000 ALTER TABLE `acc_withdraw` DISABLE KEYS */;
INSERT INTO `acc_withdraw` VALUES (1,'5142778844','จักรพรรดิ์ ตรุษกราน','ZXlKaGIuQzMsKIDsA0NzZDMEE2ODFFMkI2ODgwMjIwQ0Q1NjEzQ0I0NTk2RkMyMTY5NyBBNkFFMDYzMzI=','051306',1);
/*!40000 ALTER TABLE `acc_withdraw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account_bank`
--

DROP TABLE IF EXISTS `account_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_bank` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `accnum` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL,
  `accnum_ktb` varchar(50) NOT NULL,
  `name_ktb` varchar(50) NOT NULL,
  `username_ktb` varchar(50) NOT NULL,
  `password_ktb` varchar(50) NOT NULL,
  `ktb_token` text NOT NULL,
  `status_scb` int(11) NOT NULL,
  `status_ktb` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_bank`
--

LOCK TABLES `account_bank` WRITE;
/*!40000 ALTER TABLE `account_bank` DISABLE KEYS */;
INSERT INTO `account_bank` VALUES (1,'8842554239','นางสาว มณข้าว ทองแท่ง','ZXlKaGIuNWMsKIDsNjNDVkZWUtYzIwNC00ZDcxLWI1ZGQtMjk2MjkwNGVmZmVl','473272','','','','','',1,0);
/*!40000 ALTER TABLE `account_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `stats` int(11) NOT NULL,
  `category` text CHARACTER SET utf8 NOT NULL,
  `secert_code` text CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin01','$2b$10$sNezkhFDTWXOIvvKrcwByua9d1.lxvi4ox/wUM6itowmCqlrmDmoq',99,',จัดการสมาชิก,โปรโมชั่น,ประวัติรับโปรโมชั่น,ถอนเงิน,ฝากเงิน,รายงานการสุ่มวงล้อ',''),(3,'Topsup','$2b$10$sNezkhFDTWXOIvvKrcwByua9d1.lxvi4ox/wUM6itowmCqlrmDmoq',109,'',''),(33,'mskids','$2b$10$StUp58p7c4dlxC7bEgxgc.7990pzuB1EMB2HxPB8GVTXIwzUQv5QO',109,'','');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aff_history`
--

DROP TABLE IF EXISTS `aff_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aff_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amout` int(10) NOT NULL,
  `amout_get` int(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aff_history`
--

LOCK TABLES `aff_history` WRITE;
/*!40000 ALTER TABLE `aff_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `aff_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alliance`
--

DROP TABLE IF EXISTS `alliance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alliance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `name` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `accnum` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `bank_name` text DEFAULT NULL,
  `percent` int(11) DEFAULT NULL,
  `code` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `stats` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alliance`
--

LOCK TABLES `alliance` WRITE;
/*!40000 ALTER TABLE `alliance` DISABLE KEYS */;
/*!40000 ALTER TABLE `alliance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alliance_log`
--

DROP TABLE IF EXISTS `alliance_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alliance_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_username` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alliance_log`
--

LOCK TABLES `alliance_log` WRITE;
/*!40000 ALTER TABLE `alliance_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `alliance_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auto_withdraw`
--

DROP TABLE IF EXISTS `auto_withdraw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auto_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_username` text NOT NULL,
  `bank_name` text NOT NULL,
  `bank_acc` text NOT NULL,
  `name` text NOT NULL,
  `amount` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `date_new` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auto_withdraw`
--

LOCK TABLES `auto_withdraw` WRITE;
/*!40000 ALTER TABLE `auto_withdraw` DISABLE KEYS */;
/*!40000 ALTER TABLE `auto_withdraw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `bank_id` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank`
--

LOCK TABLES `bank` WRITE;
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
INSERT INTO `bank` VALUES (1,'bbl','กรุงเทพ','#1e4598','002'),(2,'scb','ไทยพาณิชย์','#4e2e7f','014'),(3,'kbank','กสิกร','#138f2d','004'),(4,'bay','กรุงศรีอยุธยา','#fec43b','025'),(5,'ktb','กรุงไทย','#1ba5e1','006'),(6,'ttb','ทหารไทย','#1279be','011'),(7,'tbank','ธนชาติ','#fc4f1f','065'),(8,'gsb','ออมสิน','#eb198d','030'),(9,'baac','เพื่อการเกษตรและสหกรณ์การเกษตร','#4b9b1d','034'),(10,'uob','ยูโอบี','#0b3979','024'),(11,'tisco','ทิสโก้','#12549f','067'),(12,'cimb','ซีไอเอ็มบีไทย','#7e2f36','022'),(13,'lhb','แลนด์แอนด์เฮ้าส์','#6d6e71','073');
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history_turnover`
--

DROP TABLE IF EXISTS `history_turnover`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history_turnover` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `turnover` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `winloss` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `date` varchar(50) CHARACTER SET utf8mb4 NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history_turnover`
--

LOCK TABLES `history_turnover` WRITE;
/*!40000 ALTER TABLE `history_turnover` DISABLE KEYS */;
/*!40000 ALTER TABLE `history_turnover` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_token`
--

DROP TABLE IF EXISTS `log_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` text CHARACTER SET utf8mb4 NOT NULL,
  `ip_address` text CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_token`
--

LOCK TABLES `log_token` WRITE;
/*!40000 ALTER TABLE `log_token` DISABLE KEYS */;
INSERT INTO `log_token` VALUES (1,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MzMsInVzZXJuYW1lIjoibXNraWRzIiwic3RhdHMiOjEwOSwiaXAiOnsiaXBBZGRyZXNzIjoiNDkuMjI4LjIxOC4xNzAiLCJjb250aW5lbnRDb2RlIjoiQVMiLCJjb250aW5lbnROYW1lIjoiQXNpYSIsImNvdW50cnlDb2RlIjoiVEgiLCJjb3VudHJ5TmFtZSI6IlRoYWlsYW5kIiwic3RhdGVQcm92IjoiUGh1a2V0IiwiY2l0eSI6IlBodWtldCJ9LCJpYXQiOjE2ODAyODM1MTMsImV4cCI6MTY4MDI5MDcxM30.UBGqVZw6J543d0Q7ouIF68qNvqHFJmZbFd_coUu9nRI','49.228.218.170'),(2,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MywidXNlcm5hbWUiOiJUb3BzdXAiLCJzdGF0cyI6MTA5LCJpcCI6eyJpcEFkZHJlc3MiOiI0OS40OS4yMzguMTAzIiwiY29udGluZW50Q29kZSI6IkFTIiwiY29udGluZW50TmFtZSI6IkFzaWEiLCJjb3VudHJ5Q29kZSI6IlRIIiwiY291bnRyeU5hbWUiOiJUaGFpbGFuZCIsInN0YXRlUHJvdiI6Ik5vbnRoYWJ1cmkiLCJjaXR5IjoiUGFrIEtyZXQifSwiaWF0IjoxNjgwMzYzNzA5LCJleHAiOjE2ODAzNzA5MDl9.3lBZcitI3gEwoi7IJ79LFOJQTB4IxnJJfz6Br_T6iWs','49.49.238.103'),(3,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJiZXQ5Y3YiLCJzdGF0cyI6OTksImlwIjp7ImlwQWRkcmVzcyI6IjQ5LjQ5LjIzOC4xMDMiLCJjb250aW5lbnRDb2RlIjoiQVMiLCJjb250aW5lbnROYW1lIjoiQXNpYSIsImNvdW50cnlDb2RlIjoiVEgiLCJjb3VudHJ5TmFtZSI6IlRoYWlsYW5kIiwic3RhdGVQcm92IjoiTm9udGhhYnVyaSIsImNpdHkiOiJQYWsgS3JldCJ9LCJpYXQiOjE2ODAzNjM3OTMsImV4cCI6MTY4MDM3MDk5M30.7nlJVWMZurvQ0W2lVGGn9paK3LNhHBzBxLuJdmRsOLs','49.49.238.103'),(5,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJiZXQ5Y3YiLCJzdGF0cyI6OTksImlwIjp7ImlwQWRkcmVzcyI6IjE0LjIwNy44NS4xNDciLCJjb250aW5lbnRDb2RlIjoiQVMiLCJjb250aW5lbnROYW1lIjoiQXNpYSIsImNvdW50cnlDb2RlIjoiVEgiLCJjb3VudHJ5TmFtZSI6IlRoYWlsYW5kIiwic3RhdGVQcm92IjoiTm9udGhhYnVyaSIsImNpdHkiOiJQYWsgS3JldCJ9LCJpYXQiOjE2ODAzNjY3ODcsImV4cCI6MTY4MDM3Mzk4N30.QpIa1vsb7p6ORy9hnunXzQTU0eWrd30a27yjDEEVbIU','14.207.85.147'),(6,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJiZXQ5Y3YiLCJzdGF0cyI6OTksImlwIjp7ImlwQWRkcmVzcyI6IjE0LjIwNy44NS4xNDciLCJjb250aW5lbnRDb2RlIjoiQVMiLCJjb250aW5lbnROYW1lIjoiQXNpYSIsImNvdW50cnlDb2RlIjoiVEgiLCJjb3VudHJ5TmFtZSI6IlRoYWlsYW5kIiwic3RhdGVQcm92IjoiTm9udGhhYnVyaSIsImNpdHkiOiJQYWsgS3JldCJ9LCJpYXQiOjE2ODAzOTA5MzYsImV4cCI6MTY4MDM5ODEzNn0.V4YWKbtKjlYBYnhVfq_kE1ymTkj0_s7qC76sZ-RdMqY','14.207.85.147'),(7,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MywidXNlcm5hbWUiOiJUb3BzdXAiLCJzdGF0cyI6MTA5LCJpcCI6eyJpcEFkZHJlc3MiOiI0OS40OS4yMzYuMTI5IiwiY29udGluZW50Q29kZSI6IkFTIiwiY29udGluZW50TmFtZSI6IkFzaWEiLCJjb3VudHJ5Q29kZSI6IlRIIiwiY291bnRyeU5hbWUiOiJUaGFpbGFuZCIsInN0YXRlUHJvdiI6Ik5vbnRoYWJ1cmkiLCJjaXR5IjoiUGFrIEtyZXQifSwiaWF0IjoxNjgwNTIwNjczLCJleHAiOjE2ODA1Mjc4NzN9.W2UfbtN_hGrmIJ1GyPm1y1RkQ8kj_eqlyR8g_7-f8mk','49.49.236.129'),(9,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MywidXNlcm5hbWUiOiJUb3BzdXAiLCJzdGF0cyI6MTA5LCJpcCI6eyJpcEFkZHJlc3MiOiI0OS40OS4yMzYuMTI5IiwiY29udGluZW50Q29kZSI6IkFTIiwiY29udGluZW50TmFtZSI6IkFzaWEiLCJjb3VudHJ5Q29kZSI6IlRIIiwiY291bnRyeU5hbWUiOiJUaGFpbGFuZCIsInN0YXRlUHJvdiI6Ik5vbnRoYWJ1cmkiLCJjaXR5IjoiUGFrIEtyZXQifSwiaWF0IjoxNjgwNTM3Njg3LCJleHAiOjE2ODA1NDQ4ODd9.rCmiVgKiguYfzXUEz8JVNtCHv3goDXZlb1MAQHgYABE','49.49.236.129'),(10,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MywidXNlcm5hbWUiOiJUb3BzdXAiLCJzdGF0cyI6MTA5LCJpcCI6eyJpcEFkZHJlc3MiOiI0OS40OS4yMzYuMTI5IiwiY29udGluZW50Q29kZSI6IkFTIiwiY29udGluZW50TmFtZSI6IkFzaWEiLCJjb3VudHJ5Q29kZSI6IlRIIiwiY291bnRyeU5hbWUiOiJUaGFpbGFuZCIsInN0YXRlUHJvdiI6Ik5vbnRoYWJ1cmkiLCJjaXR5IjoiUGFrIEtyZXQifSwiaWF0IjoxNjgwNjI0NTcwLCJleHAiOjE2ODA2MzE3NzB9.-S_kDQS1h0S1VQot_uWA47jIhVkjsdC8Q3Dg8hp--OI','49.49.236.129'),(11,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJiZXQ5Y3YiLCJzdGF0cyI6OTksImlwIjp7ImlwQWRkcmVzcyI6IjE4NC4yMi4xMi4xODAiLCJjb250aW5lbnRDb2RlIjoiQVMiLCJjb250aW5lbnROYW1lIjoiQXNpYSIsImNvdW50cnlDb2RlIjoiVEgiLCJjb3VudHJ5TmFtZSI6IlRoYWlsYW5kIiwic3RhdGVQcm92IjoiQmFuZ2tvayIsImNpdHkiOiJSYXRjaGF0aGV3aSAoS2h3YWVuZyBTYW1zZW4gTmFpKSJ9LCJpYXQiOjE2ODA2OTMyOTIsImV4cCI6MTY4MDcwMDQ5Mn0.MLE73PUn1Uq1N3V6rNg4SMt05LQcsPdcZdH96snWgQo','184.22.12.180'),(12,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJiZXQ5Y3YiLCJzdGF0cyI6OTksImlwIjp7ImlwQWRkcmVzcyI6IjE4NC4yMi4xMi4xODAiLCJjb250aW5lbnRDb2RlIjoiQVMiLCJjb250aW5lbnROYW1lIjoiQXNpYSIsImNvdW50cnlDb2RlIjoiVEgiLCJjb3VudHJ5TmFtZSI6IlRoYWlsYW5kIiwic3RhdGVQcm92IjoiQmFuZ2tvayIsImNpdHkiOiJSYXRjaGF0aGV3aSAoS2h3YWVuZyBTYW1zZW4gTmFpKSJ9LCJpYXQiOjE2ODA2OTMzMTYsImV4cCI6MTY4MDcwMDUxNn0.B5h1YAgQ-BNYEbyrdBuR7dMUrg_vLFq-Po12tYrV9vg','184.22.12.180'),(13,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJiZXQ5Y3YiLCJzdGF0cyI6OTksImlwIjp7ImlwQWRkcmVzcyI6IjE4NC4yMi4xMi4xODAiLCJjb250aW5lbnRDb2RlIjoiQVMiLCJjb250aW5lbnROYW1lIjoiQXNpYSIsImNvdW50cnlDb2RlIjoiVEgiLCJjb3VudHJ5TmFtZSI6IlRoYWlsYW5kIiwic3RhdGVQcm92IjoiQmFuZ2tvayIsImNpdHkiOiJSYXRjaGF0aGV3aSAoS2h3YWVuZyBTYW1zZW4gTmFpKSJ9LCJpYXQiOjE2ODA2OTM5OTAsImV4cCI6MTY4MDcwMTE5MH0.94JRxOA9k1N4-bJ7sBrKlva4EihcO4i5pHQVElTOzcs','184.22.12.180'),(14,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NDQsInVzZXJuYW1lIjoiVWZhY3Y5Iiwic3RhdHMiOjAsImNhdGVnb3J5IjoiLOC4iOC4seC4lOC4geC4suC4o-C4quC4oeC4suC4iuC4tOC4gSzguYLguJvguKPguYLguKHguIrguLHguYjguJks4Lib4Lij4Liw4Lin4Lix4LiV4Li04Lij4Lix4Lia4LmC4Lib4Lij4LmC4Lih4LiK4Lix4LmI4LiZLOC4luC4reC4meC5gOC4h-C4tOC4mSzguJ3guLLguIHguYDguIfguLTguJks4Lij4Liy4Lii4LiH4Liy4LiZ4Lic4LilLOC4o-C4suC4ouC4h-C4suC4meC4geC4suC4o-C4neC4suC4geC5gOC4h-C4tOC4mSzguKPguLLguKLguIfguLLguJnguIHguLLguKPguJbguK3guJnguYDguIfguLTguJks4Lij4Liy4Lii4LiH4Liy4LiZ4LiB4Liy4Lij4LmA4LiH4Li04LiZLOC4o-C4suC4ouC4h-C4suC4meC4ouC4reC4lOC5gOC4l-C4tOC4o-C5jOC4mSzguIjguLHguJTguIHguLLguKPguJ7guJnguLHguIHguIfguLLguJks4Lib4Lij4Liw4Lin4Lix4LiV4Li04LiC4Lit4LiH4Lie4LiZ4Lix4LiB4LiH4Liy4LiZLOC4leC4seC5ieC4h-C4hOC5iOC4suC4p-C4h-C4peC5ieC4rSzguKPguLLguKLguIfguLLguJnguIHguLLguKPguKrguLjguYjguKHguKfguIfguKXguYnguK0s4LiV4Lix4LmJ4LiH4LiE4LmI4Liy4LmA4Lib4LmI4Liy4Lii4Li04LmJ4LiH4LiJ4Li44LiaLOC4o-C4suC4ouC4h-C4suC4meC4geC4suC4o-C5gOC4peC5iOC4meC5gOC4m-C5iOC4suC4ouC4tOC5ieC4h-C4ieC4uOC4miIsImlwIjp7ImlwQWRkcmVzcyI6IjEuNDcuMTUyLjIxIiwiY29udGluZW50Q29kZSI6IkFTIiwiY29udGluZW50TmFtZSI6IkFzaWEiLCJjb3VudHJ5Q29kZSI6IlRIIiwiY291bnRyeU5hbWUiOiJUaGFpbGFuZCIsInN0YXRlUHJvdiI6IkJhbmdrb2siLCJjaXR5IjoiQmFuZ2tvayJ9LCJpYXQiOjE2ODA2OTQwODAsImV4cCI6MTY4MDcwMTI4MH0.rFNAUWFqnDXWY3hRTW4F4wUKCO8qhiomiRg4LMQ65jA','1.47.152.21'),(15,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NDMsInVzZXJuYW1lIjoidmFuMzMwNzEwIiwic3RhdHMiOjAsImNhdGVnb3J5IjoiLOC4iOC4seC4lOC4geC4suC4o-C4quC4oeC4suC4iuC4tOC4gSzguYLguJvguKPguYLguKHguIrguLHguYjguJks4Lib4Lij4Liw4Lin4Lix4LiV4Li04Lij4Lix4Lia4LmC4Lib4Lij4LmC4Lih4LiK4Lix4LmI4LiZLOC4luC4reC4meC5gOC4h-C4tOC4mSzguJ3guLLguIHguYDguIfguLTguJks4Lij4Liy4Lii4LiH4Liy4LiZ4Lic4LilLOC4o-C4suC4ouC4h-C4suC4meC4geC4suC4o-C4neC4suC4geC5gOC4h-C4tOC4mSzguKPguLLguKLguIfguLLguJnguIHguLLguKPguJbguK3guJnguYDguIfguLTguJks4Lij4Liy4Lii4LiH4Liy4LiZ4LiB4Liy4Lij4LmA4LiH4Li04LiZLOC4o-C4suC4ouC4h-C4suC4meC4ouC4reC4lOC5gOC4l-C4tOC4o-C5jOC4mSzguIjguLHguJTguIHguLLguKPguJ7guJnguLHguIHguIfguLLguJks4Lib4Lij4Liw4Lin4Lix4LiV4Li04LiC4Lit4LiH4Lie4LiZ4Lix4LiB4LiH4Liy4LiZLOC4leC4seC5ieC4h-C4hOC5iOC4suC4p-C4h-C4peC5ieC4rSzguKPguLLguKLguIfguLLguJnguIHguLLguKPguKrguLjguYjguKHguKfguIfguKXguYnguK0s4LiV4Lix4LmJ4LiH4LiE4LmI4Liy4LmA4Lib4LmI4Liy4Lii4Li04LmJ4LiH4LiJ4Li44LiaLOC4o-C4suC4ouC4h-C4suC4meC4geC4suC4o-C5gOC4peC5iOC4meC5gOC4m-C5iOC4suC4ouC4tOC5ieC4h-C4ieC4uOC4miIsImlwIjp7ImlwQWRkcmVzcyI6IjQ5LjIyOS4xNjIuMTEyIiwiY29udGluZW50Q29kZSI6IkFTIiwiY29udGluZW50TmFtZSI6IkFzaWEiLCJjb3VudHJ5Q29kZSI6IlRIIiwiY291bnRyeU5hbWUiOiJUaGFpbGFuZCIsInN0YXRlUHJvdiI6IkJhbmdrb2siLCJjaXR5IjoiUmF0Y2hhdGhld2kgKEtod2FlbmcgU2Ftc2VuIE5haSkifSwiaWF0IjoxNjgwNzA4MzM4LCJleHAiOjE2ODA3MTU1Mzh9.EhBqDJxVwutCilEKOPHB5NFpYRJA5ZvHrSk-lQK-tx8','49.229.162.112'),(16,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NDMsInVzZXJuYW1lIjoidmFuMzMwNzEwIiwic3RhdHMiOjAsImNhdGVnb3J5IjoiLOC4iOC4seC4lOC4geC4suC4o-C4quC4oeC4suC4iuC4tOC4gSzguYLguJvguKPguYLguKHguIrguLHguYjguJks4Lib4Lij4Liw4Lin4Lix4LiV4Li04Lij4Lix4Lia4LmC4Lib4Lij4LmC4Lih4LiK4Lix4LmI4LiZLOC4luC4reC4meC5gOC4h-C4tOC4mSzguJ3guLLguIHguYDguIfguLTguJks4Lij4Liy4Lii4LiH4Liy4LiZ4Lic4LilLOC4o-C4suC4ouC4h-C4suC4meC4geC4suC4o-C4neC4suC4geC5gOC4h-C4tOC4mSzguKPguLLguKLguIfguLLguJnguIHguLLguKPguJbguK3guJnguYDguIfguLTguJks4Lij4Liy4Lii4LiH4Liy4LiZ4LiB4Liy4Lij4LmA4LiH4Li04LiZLOC4o-C4suC4ouC4h-C4suC4meC4ouC4reC4lOC5gOC4l-C4tOC4o-C5jOC4mSzguIjguLHguJTguIHguLLguKPguJ7guJnguLHguIHguIfguLLguJks4Lib4Lij4Liw4Lin4Lix4LiV4Li04LiC4Lit4LiH4Lie4LiZ4Lix4LiB4LiH4Liy4LiZLOC4leC4seC5ieC4h-C4hOC5iOC4suC4p-C4h-C4peC5ieC4rSzguKPguLLguKLguIfguLLguJnguIHguLLguKPguKrguLjguYjguKHguKfguIfguKXguYnguK0s4LiV4Lix4LmJ4LiH4LiE4LmI4Liy4LmA4Lib4LmI4Liy4Lii4Li04LmJ4LiH4LiJ4Li44LiaLOC4o-C4suC4ouC4h-C4suC4meC4geC4suC4o-C5gOC4peC5iOC4meC5gOC4m-C5iOC4suC4ouC4tOC5ieC4h-C4ieC4uOC4miIsImlwIjp7ImlwQWRkcmVzcyI6IjQ5LjIyOS4xNjIuMTEyIiwiY29udGluZW50Q29kZSI6IkFTIiwiY29udGluZW50TmFtZSI6IkFzaWEiLCJjb3VudHJ5Q29kZSI6IlRIIiwiY291bnRyeU5hbWUiOiJUaGFpbGFuZCIsInN0YXRlUHJvdiI6IkJhbmdrb2siLCJjaXR5IjoiUmF0Y2hhdGhld2kgKEtod2FlbmcgU2Ftc2VuIE5haSkifSwiaWF0IjoxNjgwNzA4NDMwLCJleHAiOjE2ODA3MTU2MzB9.LOwm-zxnIXqPf_0PlUZL-hO26rEoFJg-uoap-7lU_GY','49.229.162.112'),(17,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJiZXQ5Y3YiLCJzdGF0cyI6OTksImlwIjp7ImlwQWRkcmVzcyI6IjE4NC4yMi4xMi4xODAiLCJjb250aW5lbnRDb2RlIjoiQVMiLCJjb250aW5lbnROYW1lIjoiQXNpYSIsImNvdW50cnlDb2RlIjoiVEgiLCJjb3VudHJ5TmFtZSI6IlRoYWlsYW5kIiwic3RhdGVQcm92IjoiQmFuZ2tvayIsImNpdHkiOiJSYXRjaGF0aGV3aSAoS2h3YWVuZyBTYW1zZW4gTmFpKSJ9LCJpYXQiOjE2ODA3NDU3NDMsImV4cCI6MTY4MDc1Mjk0M30.7tvE1-9bNW6YIyleH5lYrihgrXnPNBGON3TE4x7l2_k','184.22.12.180'),(18,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MzMsInVzZXJuYW1lIjoibXNraWRzIiwic3RhdHMiOjEwOSwiaXAiOnsiaXBBZGRyZXNzIjoiNDkuMjI4LjI0Ni4xODUiLCJjb250aW5lbnRDb2RlIjoiQVMiLCJjb250aW5lbnROYW1lIjoiQXNpYSIsImNvdW50cnlDb2RlIjoiVEgiLCJjb3VudHJ5TmFtZSI6IlRoYWlsYW5kIiwic3RhdGVQcm92IjoiQ2hpYW5nIE1haSIsImNpdHkiOiJDaGlhbmcgTWFpIn0sImlhdCI6MTY4NzI3NDQyNywiZXhwIjoxNjg3MjgxNjI3fQ.ZU9M4bw5-IDhCQMoLgzGxLEJkDhEbAocgmAxvfS579Q','49.228.246.185'),(19,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MzMsInVzZXJuYW1lIjoibXNraWRzIiwic3RhdHMiOjEwOSwiaXAiOnsiaXBBZGRyZXNzIjoiNDkuMjI4LjI0Ni4xODUiLCJjb250aW5lbnRDb2RlIjoiQVMiLCJjb250aW5lbnROYW1lIjoiQXNpYSIsImNvdW50cnlDb2RlIjoiVEgiLCJjb3VudHJ5TmFtZSI6IlRoYWlsYW5kIiwic3RhdGVQcm92IjoiQ2hpYW5nIE1haSIsImNpdHkiOiJDaGlhbmcgTWFpIn0sImlhdCI6MTY4NzI3NTEwMCwiZXhwIjoxNjg3MjgyMzAwfQ.e1fHxJeRdk3ruOKOMNQnmLczhy1sQkwGicUBBUS655E','49.228.246.185'),(20,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MzMsInVzZXJuYW1lIjoibXNraWRzIiwic3RhdHMiOjEwOSwiaXAiOnsiaXBBZGRyZXNzIjoiNDkuMjI4LjI0Ni4xODUiLCJjb250aW5lbnRDb2RlIjoiQVMiLCJjb250aW5lbnROYW1lIjoiQXNpYSIsImNvdW50cnlDb2RlIjoiVEgiLCJjb3VudHJ5TmFtZSI6IlRoYWlsYW5kIiwic3RhdGVQcm92IjoiQ2hpYW5nIE1haSIsImNpdHkiOiJDaGlhbmcgTWFpIn0sImlhdCI6MTY4NzI3NTE2MSwiZXhwIjoxNjg3MjgyMzYxfQ.NW3pTCmcNH7v85Dz1wQst2rVqIxeHBvDykdi4j6QarA','49.228.246.185'),(21,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MzMsInVzZXJuYW1lIjoibXNraWRzIiwic3RhdHMiOjEwOSwiaXAiOnsiaXBBZGRyZXNzIjoiNDkuMjI4LjI0Ni4xODUiLCJjb250aW5lbnRDb2RlIjoiQVMiLCJjb250aW5lbnROYW1lIjoiQXNpYSIsImNvdW50cnlDb2RlIjoiVEgiLCJjb3VudHJ5TmFtZSI6IlRoYWlsYW5kIiwic3RhdGVQcm92IjoiQ2hpYW5nIE1haSIsImNpdHkiOiJDaGlhbmcgTWFpIn0sImlhdCI6MTY4NzI3NTE3NSwiZXhwIjoxNjg3MjgyMzc1fQ.L98qCOjNIaVOM9fbCCiWFFgn750mrKfbOO1hVliLY6Y','49.228.246.185'),(22,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MywidXNlcm5hbWUiOiJUb3BzdXAiLCJzdGF0cyI6MTA5LCJpcCI6eyJpcEFkZHJlc3MiOiI0OS40OS4yMzcuMjQ0IiwiY29udGluZW50Q29kZSI6IkFTIiwiY29udGluZW50TmFtZSI6IkFzaWEiLCJjb3VudHJ5Q29kZSI6IlRIIiwiY291bnRyeU5hbWUiOiJUaGFpbGFuZCIsInN0YXRlUHJvdiI6Ik5vbnRoYWJ1cmkiLCJjaXR5IjoiUGFrIEtyZXQifSwiaWF0IjoxNjg3Mjc1MTk3LCJleHAiOjE2ODcyODIzOTd9.ZICphJaK1jYo9jVFfDmWteRDyqoqg-2zm7x3fdBs0K8','49.49.237.244'),(23,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MywidXNlcm5hbWUiOiJUb3BzdXAiLCJzdGF0cyI6MTA5LCJpcCI6eyJpcEFkZHJlc3MiOiI0OS40OS4yMzcuMjQ0IiwiY29udGluZW50Q29kZSI6IkFTIiwiY29udGluZW50TmFtZSI6IkFzaWEiLCJjb3VudHJ5Q29kZSI6IlRIIiwiY291bnRyeU5hbWUiOiJUaGFpbGFuZCIsInN0YXRlUHJvdiI6Ik5vbnRoYWJ1cmkiLCJjaXR5IjoiUGFrIEtyZXQifSwiaWF0IjoxNjg3Mjc2NDk3LCJleHAiOjE2ODcyODM2OTd9.CkE2piyj2weBNxC0OwJo-312sm2EjwZYo84h6IOxo0I','49.49.237.244'),(25,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJhZG1pbjAxIiwic3RhdHMiOjk5LCJpcCI6eyJpcEFkZHJlc3MiOiI0OS4yMjguMjM0LjM5IiwiY29udGluZW50Q29kZSI6IkFTIiwiY29udGluZW50TmFtZSI6IkFzaWEiLCJjb3VudHJ5Q29kZSI6IlRIIiwiY291bnRyeU5hbWUiOiJUaGFpbGFuZCIsInN0YXRlUHJvdiI6IkJhbmdrb2siLCJjaXR5IjoiUmF0Y2hhdGhld2kgKEtod2FlbmcgU2Ftc2VuIE5haSkifSwiaWF0IjoxNjg3NDMxNTY3LCJleHAiOjE2ODc0Mzg3Njd9.RfACY-FJ7OjQ_ZMidSlq9hwNYV9FWgg0Yq36O5QoVIc','49.228.234.39'),(26,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJhZG1pbjAxIiwic3RhdHMiOjk5LCJpcCI6eyJpcEFkZHJlc3MiOiI0OS4yMjguMjM0LjM5IiwiY29udGluZW50Q29kZSI6IkFTIiwiY29udGluZW50TmFtZSI6IkFzaWEiLCJjb3VudHJ5Q29kZSI6IlRIIiwiY291bnRyeU5hbWUiOiJUaGFpbGFuZCIsInN0YXRlUHJvdiI6IkJhbmdrb2siLCJjaXR5IjoiUmF0Y2hhdGhld2kgKEtod2FlbmcgU2Ftc2VuIE5haSkifSwiaWF0IjoxNjg3NDMyNzkwLCJleHAiOjE2ODc0Mzk5OTB9.GQUUcVVhlY22IulK-p-oJH_3x90oyubBuXp6ho4hpPU','49.228.234.39'),(27,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJhZG1pbjAxIiwic3RhdHMiOjk5LCJpcCI6eyJpcEFkZHJlc3MiOiIxODAuMTgzLjExNC45NiIsImNvbnRpbmVudENvZGUiOiJBUyIsImNvbnRpbmVudE5hbWUiOiJBc2lhIiwiY291bnRyeUNvZGUiOiJUSCIsImNvdW50cnlOYW1lIjoiVGhhaWxhbmQiLCJzdGF0ZVByb3YiOiJCYW5na29rIiwiY2l0eSI6IlZhZGhhbmEifSwiaWF0IjoxNjg4MDc5NjQ4LCJleHAiOjE2ODgwODY4NDh9.bM4NJn9HgUOBOpPEVp90fz5sQL02Q9Dd5R5DNZG-J8U','180.183.114.96'),(28,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJhZG1pbjAxIiwic3RhdHMiOjk5LCJpcCI6eyJpcEFkZHJlc3MiOiIxMTAuMTY5LjIyMi4xNDYiLCJjb250aW5lbnRDb2RlIjoiQVMiLCJjb250aW5lbnROYW1lIjoiQXNpYSIsImNvdW50cnlDb2RlIjoiVEgiLCJjb3VudHJ5TmFtZSI6IlRoYWlsYW5kIiwic3RhdGVQcm92IjoiQmFuZ2tvayIsImNpdHkiOiJEaW4gRGFlbmcgKEtod2FlbmcgRGluIERhZW5nKSJ9LCJpYXQiOjE2ODgzODYwODEsImV4cCI6MTY4ODM5MzI4MX0.zRDYDmtxO3cnQQ7BC5wsrCchotUW3QIPpGzh6ArvIPw','110.169.222.146');
/*!40000 ALTER TABLE `log_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `line` varchar(50) DEFAULT NULL,
  `accnum` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `aff` int(11) DEFAULT NULL,
  `coins` int(11) DEFAULT 0,
  `IP` varchar(50) NOT NULL,
  `LastUpdate` datetime NOT NULL DEFAULT current_timestamp(),
  `powyingshup` int(11) NOT NULL,
  `promotion_id` int(11) NOT NULL,
  `cr_prog` varchar(100) NOT NULL,
  `alliance` text DEFAULT NULL,
  `ref` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (1,'0999999999','12345678','','1111111111','lhb','TEST',1,NULL,0,'172.68.234.149','2023-06-22 18:22:02',0,0,'Manual',NULL,NULL);
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `powyingshup_log`
--

DROP TABLE IF EXISTS `powyingshup_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `powyingshup_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_username` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `credit` int(11) NOT NULL,
  `result` int(11) NOT NULL COMMENT '0,แพ้ 1,เสมอ 2,ชนะ',
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `powyingshup_log`
--

LOCK TABLES `powyingshup_log` WRITE;
/*!40000 ALTER TABLE `powyingshup_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `powyingshup_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pro_log`
--

DROP TABLE IF EXISTS `pro_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pro_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_username` varchar(255) NOT NULL,
  `money` int(10) NOT NULL,
  `pro_id` int(10) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `x` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pro_log`
--

LOCK TABLES `pro_log` WRITE;
/*!40000 ALTER TABLE `pro_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `pro_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotion`
--

DROP TABLE IF EXISTS `promotion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promotion` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `percen` double NOT NULL,
  `x` int(50) NOT NULL,
  `exprice` varchar(50) NOT NULL,
  `text` varchar(5000) NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(1000) NOT NULL,
  `img_name` varchar(1000) DEFAULT NULL,
  `limit_d` int(10) NOT NULL DEFAULT 0,
  `limit_w` int(10) NOT NULL DEFAULT 0,
  `stats` int(11) DEFAULT NULL,
  `turn` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotion`
--

LOCK TABLES `promotion` WRITE;
/*!40000 ALTER TABLE `promotion` DISABLE KEYS */;
INSERT INTO `promotion` VALUES (15,20,5,'','ฝากขั้นต่ำ 500-2,500 บาท รับโบนัสได้สูงสุด 500 บาท\n*เงื่อนไขกติกา*\n-กดรับได้ครั้งเดียว\n-เล่นได้ทุกอย่างทำยอดเทิร์น 5 เท่า\n-ตัวอย่าง-\n*ฝากเงินครั้งแรกรับโบนัส ฝาก 2,500 รับเพิ่ม 500 รวมเป็นเครดิต 3,000\n*เทิร์น  x 5 = 15,000 นับยอดได้-ยอดเสีย  \n*ถอนได้ทั้งหมด\n-หมายเหตุฯ ฝากก่อนกดรับโปรโมชั่นนะคะ','NEW!! สมัครสมาชิกใหม่ครั้งแรก','123456','https://shorturl.asia/2acIO',2500,0,1,0),(17,10,2,'','สำหรับสมาชิกทุกท่าน ฝากได้สูงสุด 10,000 บาท\n*เงื่อนไขกติกา*\n-กดรับได้ทุกวัน\n-เล่นได้ทุกอย่างเทิร์น 2 เท่า\n-ตัวอย่าง-\n*ฝากเงินครั้งแรกรับโบนัส ฝาก 10,000 ได้โบนัสเพิ่ม 1,000 รวมเป็นเครดิต 11,000 บาท*\n*เทิร์น  x 2= 22,000 นับยอดได้-ยอดเสีย*\n*ถอนได้ทั้งหมด* *โปรรีเซทใหม่ทุกเที่ยงคืนของทุกวัน*\n-หมายเหตุฯ ฝากก่อนกดรับนะคะ-','ฝากแรกของวันรับโบนัสเพิ่ม 10%','123456','https://shorturl.asia/kTIGc',10000,0,1,0),(18,5,3,'','วิธีรับโบนัส\r\n1. สมัครสมาชิกและฝากเงินครั้งแรกขั้นต่ำ 50 บาท\r\n2. สมาชิกมีสิทธิ์รับโบนัส 10% สูงสุด 1,000 บาท\r\n3. ถ้าคุณรับโบนัส..คุณต้องทำเทินโอเวอร์ให้ได้ 3 เท่า ถึงจะถอนเงินได้\r\n','รับทั้งวัน','123456','7.png',10000,0,NULL,NULL);
/*!40000 ALTER TABLE `promotion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotion_2`
--

DROP TABLE IF EXISTS `promotion_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promotion_2` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `percen` double NOT NULL,
  `x` int(50) NOT NULL,
  `exprice` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotion_2`
--

LOCK TABLES `promotion_2` WRITE;
/*!40000 ALTER TABLE `promotion_2` DISABLE KEYS */;
INSERT INTO `promotion_2` VALUES (15,1,10,'');
/*!40000 ALTER TABLE `promotion_2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotion_history`
--

DROP TABLE IF EXISTS `promotion_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promotion_history` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `amount` float NOT NULL,
  `txtencode` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `balance` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotion_history`
--

LOCK TABLES `promotion_history` WRITE;
/*!40000 ALTER TABLE `promotion_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `promotion_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_log`
--

DROP TABLE IF EXISTS `ref_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_username` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `bonus` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `date` varchar(50) CHARACTER SET utf8mb4 DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_log`
--

LOCK TABLES `ref_log` WRITE;
/*!40000 ALTER TABLE `ref_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_activity`
--

DROP TABLE IF EXISTS `report_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text CHARACTER SET utf8mb4 NOT NULL,
  `detail` text CHARACTER SET utf8mb4 NOT NULL,
  `module` text CHARACTER SET utf8mb4 NOT NULL,
  `ip_address` text CHARACTER SET utf8mb4 NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_activity`
--

LOCK TABLES `report_activity` WRITE;
/*!40000 ALTER TABLE `report_activity` DISABLE KEYS */;
INSERT INTO `report_activity` VALUES (1,'mskids','เปิดหน้า Dashboard','Admin Page','49.228.218.170','2023-03-31 17:25:16'),(2,'mskids','เปิดหน้า Dashboard','Admin Page','49.228.218.170','2023-03-31 17:26:37'),(3,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.238.103','2023-04-01 15:41:50'),(4,'bet9cv','เปิดหน้า Dashboard','Admin Page','49.49.238.103','2023-04-01 15:43:14'),(5,'bet9cv','เปิดหน้า Dashboard','Admin Page','49.49.238.103','2023-04-01 15:43:42'),(6,'bet9cv','เปิดหน้า Dashboard','Admin Page','49.49.238.103','2023-04-01 15:43:51'),(7,'bet9cv','เปิดหน้า Dashboard','Admin Page','49.49.238.103','2023-04-01 15:45:09'),(8,'bet9cv','เปิดหน้า Dashboard','Admin Page','14.207.85.147','2023-04-01 16:33:09'),(9,'bet9cv','เปิดหน้า Dashboard','Admin Page','14.207.85.147','2023-04-01 23:15:38'),(10,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.236.129','2023-04-03 11:17:55'),(11,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.236.129','2023-04-03 11:19:05'),(12,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.236.129','2023-04-03 11:19:10'),(13,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.236.129','2023-04-03 11:24:58'),(14,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.236.129','2023-04-03 16:01:28'),(15,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.236.129','2023-04-04 16:09:31'),(16,'bet9cv','เปิดหน้า Dashboard','Admin Page','184.22.12.180','2023-04-05 11:14:54'),(17,'bet9cv','เปิดหน้า Dashboard','Admin Page','184.22.12.180','2023-04-05 11:15:18'),(18,'bet9cv','เปิดหน้า Dashboard','Admin Page','184.22.12.180','2023-04-05 11:22:40'),(19,'bet9cv','เพิ่ม STAFF ||van330710','Admin Page','184.22.12.180','2023-04-05 11:23:04'),(20,'bet9cv','เปิดหน้า STAFF','Admin Page','184.22.12.180','2023-04-05 11:23:06'),(21,'bet9cv','เปิดหน้า Dashboard','Admin Page','184.22.12.180','2023-04-05 11:23:07'),(22,'bet9cv','เปิดหน้า Dashboard','Admin Page','184.22.12.180','2023-04-05 11:26:32'),(23,'bet9cv','เปิดหน้า Dashboard','Admin Page','184.22.12.180','2023-04-05 11:26:34'),(24,'bet9cv','เปิดหน้า STAFF','Admin Page','184.22.12.180','2023-04-05 11:26:39'),(25,'bet9cv','เพิ่ม STAFF ||Ufacv9','Admin Page','184.22.12.180','2023-04-05 11:26:56'),(26,'bet9cv','เปิดหน้า STAFF','Admin Page','184.22.12.180','2023-04-05 11:26:57'),(27,'Ufacv9','เปิดหน้า Dashboard','Admin Page','1.47.152.21','2023-04-05 11:28:03'),(28,'van330710','เปิดหน้า Dashboard','Admin Page','49.229.162.112','2023-04-05 15:25:43'),(29,'van330710','เปิดหน้า Dashboard','Admin Page','49.229.162.112','2023-04-05 15:26:11'),(30,'van330710','เปิดหน้า Dashboard','Admin Page','49.229.162.112','2023-04-05 15:27:14'),(31,'bet9cv','เปิดหน้า Dashboard','Admin Page','184.22.12.180','2023-04-06 01:49:06'),(32,'mskids','เปิดหน้า Dashboard','Admin Page','49.228.246.185','2023-06-20 15:20:29'),(33,'mskids','เปิดหน้า Dashboard','Admin Page','49.228.246.185','2023-06-20 15:31:42'),(34,'mskids','เปิดหน้า Dashboard','Admin Page','49.228.246.185','2023-06-20 15:32:42'),(35,'mskids','เปิดหน้า Dashboard','Admin Page','49.228.246.185','2023-06-20 15:32:57'),(36,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.237.244','2023-06-20 15:33:19'),(37,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.237.244','2023-06-20 15:37:03'),(38,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.237.244','2023-06-20 15:37:25'),(39,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.237.244','2023-06-20 15:37:32'),(40,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.237.244','2023-06-20 15:52:50'),(41,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.237.244','2023-06-20 15:52:55'),(42,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.237.244','2023-06-20 15:53:47'),(43,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.237.244','2023-06-20 15:54:16'),(44,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.237.244','2023-06-20 15:54:40'),(45,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.237.244','2023-06-20 15:54:59'),(46,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.237.244','2023-06-20 16:01:51'),(47,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.237.244','2023-06-20 16:31:18'),(48,'Topsup','เปิดหน้า Member','Admin Page','49.49.237.244','2023-06-20 16:31:38'),(49,'0999999999','เปิดหน้าวงล้อ','Wheelspin','172.68.4.163','2023-06-20 23:54:00'),(50,'Topsup','เปิดหน้า Dashboard','Admin Page','49.49.237.244','2023-06-20 16:54:19'),(51,'0999999999','เปิดหน้าวงล้อ','Wheelspin','172.68.4.163','2023-06-20 23:54:35'),(52,'admin01','เปิดหน้า Dashboard','Admin Page','49.49.237.244','2023-06-20 17:18:18'),(53,'admin01','เปิดหน้า Dashboard','Admin Page','49.228.234.39','2023-06-22 17:59:30'),(54,'admin01','เปิดหน้า Member','Admin Page','49.228.234.39','2023-06-22 17:59:44'),(55,'admin01','เปิดหน้า Dashboard','Admin Page','49.228.234.39','2023-06-22 18:19:52'),(56,'admin01','เปิดหน้า Dashboard','Admin Page','49.228.234.39','2023-06-22 18:20:28'),(57,'admin01','เปิดหน้า Dashboard','Admin Page','49.228.234.39','2023-06-22 18:24:21'),(58,'admin01','เปิดหน้า Dashboard','Admin Page','180.183.114.96','2023-06-30 06:00:51'),(59,'admin01','เปิดหน้า Dashboard','Admin Page','110.169.222.146','2023-07-03 19:08:05'),(60,'admin01','เปิดหน้า Dashboard','Admin Page','110.169.222.146','2023-07-03 19:08:21');
/*!40000 ALTER TABLE `report_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seting`
--

DROP TABLE IF EXISTS `seting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seting` (
  `id` int(11) NOT NULL,
  `line` varchar(50) NOT NULL,
  `token_line` text NOT NULL,
  `token_line_game` varchar(100) DEFAULT NULL,
  `token_line_depo` varchar(100) DEFAULT NULL,
  `token_line_with` varchar(100) DEFAULT NULL,
  `name_web` varchar(50) NOT NULL,
  `domain` varchar(150) NOT NULL DEFAULT 'http://localhost',
  `d_limit` int(7) NOT NULL,
  `w_limit` int(7) NOT NULL,
  `aff_d` int(11) NOT NULL,
  `aff_w` int(11) NOT NULL,
  `aff_m` float NOT NULL,
  `re_sitekey` varchar(100) DEFAULT NULL,
  `re_secretkey` varchar(100) DEFAULT NULL,
  `auto_login` text NOT NULL,
  `perfix` varchar(6) NOT NULL DEFAULT 'aa',
  `numbercount` int(6) NOT NULL DEFAULT 100000,
  `acc_ufa` varchar(25) DEFAULT NULL,
  `ufa_pass` varchar(25) DEFAULT NULL,
  `theme` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seting`
--

LOCK TABLES `seting` WRITE;
/*!40000 ALTER TABLE `seting` DISABLE KEYS */;
INSERT INTO `seting` VALUES (1,'@481yhgwm','-','-','-','-','UFATEST','https://cv9bet.com',1,20,100,2,0.1,'6Lf3sJYaAAAAAKtu4Q9w_PkqsEfiBKbj8Mb5Rt4D','6Lf3sJYaAAAAACMM7j6xoM6gVRH9CGSvEFP-oUeG','https://www.boss369.com/HomeSmart.aspx?lang=EN-GB','a8',27,'ufdia19','Aa112233*','home');
/*!40000 ALTER TABLE `seting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting_auto_withdraw`
--

DROP TABLE IF EXISTS `setting_auto_withdraw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting_auto_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `credit_min` int(11) NOT NULL,
  `credit_max` int(11) NOT NULL,
  `credit_limit` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting_auto_withdraw`
--

LOCK TABLES `setting_auto_withdraw` WRITE;
/*!40000 ALTER TABLE `setting_auto_withdraw` DISABLE KEYS */;
INSERT INTO `setting_auto_withdraw` VALUES (1,1,2000,100000,0);
/*!40000 ALTER TABLE `setting_auto_withdraw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting_game`
--

DROP TABLE IF EXISTS `setting_game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auto_login` text CHARACTER SET utf8mb4 NOT NULL,
  `VIEWSTATEGENERATOR` text CHARACTER SET utf8mb4 NOT NULL,
  `VIEWSTATE` text CHARACTER SET utf8mb4 NOT NULL,
  `EVENTVALIDATION` text CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting_game`
--

LOCK TABLES `setting_game` WRITE;
/*!40000 ALTER TABLE `setting_game` DISABLE KEYS */;
INSERT INTO `setting_game` VALUES (1,'https://sun34444.com/HomeSmart.aspx?lang=EN-GB','DF40E925','/wEPDwUJNTY3MjU0MDE2D2QWAmYPZBYEAgEPFgIeC3BsYWNlaG9sZGVyBR7guIrguLfguYjguK3guJzguLnguYnguYPguIrguYlkAgIPFgIfAAUY4Lij4Lir4Lix4Liq4Lic4LmI4Liy4LiZZGTuyrmCjs6/lXqlWeVcFxrYd8t4vA==','/wEdAAS9BdEM4pJkSwqE6mP/7SnwY3plgk0YBAefRz3MyBlTcO4sciJO3Hoc68xTFtZGQEivn9vBjVd9fs+uQ2w6sTEuuQF7UZ7576JsocYCtWm/loNqiXs='),(2,'https://ufabet.com/HomeSmart.aspx?lang=EN-GB','DF40E925','/wEPDwUJNTY3MjU0MDE2D2QWAmYPZBYEAgEPFgIeC3BsYWNlaG9sZGVyBR7guIrguLfguYjguK3guJzguLnguYnguYPguIrguYlkAgIPFgIfAAUY4Lij4Lir4Lix4Liq4Lic4LmI4Liy4LiZZGTuyrmCjs6/lXqlWeVcFxrYd8t4vA==','/wEdAAS9BdEM4pJkSwqE6mP/7SnwY3plgk0YBAefRz3MyBlTcO4sciJO3Hoc68xTFtZGQEivn9vBjVd9fs+uQ2w6sTEuuQF7UZ7576JsocYCtWm/loNqiXs=');
/*!40000 ALTER TABLE `setting_game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting_powyingshup`
--

DROP TABLE IF EXISTS `setting_powyingshup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting_powyingshup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `credit_low` int(11) NOT NULL,
  `credit_high` int(11) NOT NULL,
  `credit_prize` int(11) NOT NULL,
  `round` int(11) NOT NULL,
  `deposit` int(11) NOT NULL,
  `play` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting_powyingshup`
--

LOCK TABLES `setting_powyingshup` WRITE;
/*!40000 ALTER TABLE `setting_powyingshup` DISABLE KEYS */;
INSERT INTO `setting_powyingshup` VALUES (1,1,10,100,30,100,2,1,1);
/*!40000 ALTER TABLE `setting_powyingshup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting_wheel`
--

DROP TABLE IF EXISTS `setting_wheel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting_wheel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `offset_text` int(11) DEFAULT NULL,
  `text_color` varchar(100) NOT NULL,
  `text_size` int(11) DEFAULT NULL,
  `text_type` varchar(100) NOT NULL,
  `line_color` varchar(100) NOT NULL,
  `inner_color` varchar(100) NOT NULL,
  `outer_color` varchar(100) NOT NULL,
  `center_color` varchar(100) NOT NULL,
  `center_img` varchar(100) NOT NULL,
  `lowcredit` int(13) NOT NULL DEFAULT 0,
  `type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting_wheel`
--

LOCK TABLES `setting_wheel` WRITE;
/*!40000 ALTER TABLE `setting_wheel` DISABLE KEYS */;
INSERT INTO `setting_wheel` VALUES (1,'วงล้อเสี่ยงโชค','','',1,'#000',20,'h','#FFFFFF','#FFF','#D0BD0C','#FFFFFF00','https://sv1.img.in.th/3lrK5.th.png',100,'system',1),(2,'คุณได้รับ 20 เครดิต','20','#364C62',NULL,'',NULL,'','','','','','',0,'wheel',1),(3,'ไม่ได้รับเครดิต','0','#ff0000',NULL,'',NULL,'','','','','','',0,'wheel',1),(4,'คุณได้รับ 30 เครดิต','30','#E67E22',NULL,'',NULL,'','','','','','',0,'wheel',1),(5,'ไม่ได้รับเครดิต','0','#ff0000',NULL,'',NULL,'','','','','','',0,'wheel',1),(6,'คุณได้รับ 100 เครดิต','100','#CCCCCC',NULL,'',NULL,'','','','','','',0,'wheel',1),(7,'คุณได้รับ 10 เครดิต','10','#95A5A6',NULL,'',NULL,'','','','','','',0,'wheel',1),(8,'คุณได้รับ 30 เครดิต','30','#16A085',NULL,'',NULL,'','','','','','',0,'wheel',1),(9,'ไม่ได้รับเครดิต','0','#ff0000',NULL,'',NULL,'','','','','','',0,'wheel',1),(10,'คุณได้รับ 20 เครดิต','20','#2980B9',NULL,'',NULL,'','','','','','',0,'wheel',1),(11,'คุณได้รับ 10 เครดิต','10','#E74C3C',NULL,'',NULL,'','','','','','',0,'wheel',1);
/*!40000 ALTER TABLE `setting_wheel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_history`
--

DROP TABLE IF EXISTS `staff_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `type` int(11) NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_history`
--

LOCK TABLES `staff_history` WRITE;
/*!40000 ALTER TABLE `staff_history` DISABLE KEYS */;
INSERT INTO `staff_history` VALUES (1,'Topsup',0,'เพิ่มสมาชิก ผู้ใช้งาน 0999999999 || ประเภท : Manual','2023-06-20 23:31:36');
/*!40000 ALTER TABLE `staff_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_promotion`
--

DROP TABLE IF EXISTS `tbl_promotion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_promotion` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_detail` text NOT NULL,
  `product_price` int(16) NOT NULL,
  `product_img` varchar(100) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_promotion`
--

LOCK TABLES `tbl_promotion` WRITE;
/*!40000 ALTER TABLE `tbl_promotion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_promotion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme`
--

DROP TABLE IF EXISTS `theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme`
--

LOCK TABLES `theme` WRITE;
/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
INSERT INTO `theme` VALUES (1,'theme-1','assets/theme-1/',1),(2,'home_3','assets/home_3/',1),(3,'home','assets/home/',1);
/*!40000 ALTER TABLE `theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topup_history`
--

DROP TABLE IF EXISTS `topup_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topup_history` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `alert` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topup_history`
--

LOCK TABLES `topup_history` WRITE;
/*!40000 ALTER TABLE `topup_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `topup_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `member_username` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `stats` int(2) NOT NULL,
  `pro_id` int(10) NOT NULL,
  `date_new` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_2`
--

DROP TABLE IF EXISTS `transaction_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_2` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `member_username` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `stats` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_2`
--

LOCK TABLES `transaction_2` WRITE;
/*!40000 ALTER TABLE `transaction_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction_2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_manual`
--

DROP TABLE IF EXISTS `transaction_manual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_manual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_username` varchar(255) NOT NULL,
  `credit` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `cr_by` varchar(255) NOT NULL,
  `module` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_manual`
--

LOCK TABLES `transaction_manual` WRITE;
/*!40000 ALTER TABLE `transaction_manual` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction_manual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ufa_acc`
--

DROP TABLE IF EXISTS `ufa_acc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ufa_acc` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `member_username` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ufa_acc`
--

LOCK TABLES `ufa_acc` WRITE;
/*!40000 ALTER TABLE `ufa_acc` DISABLE KEYS */;
INSERT INTO `ufa_acc` VALUES (1,'0999999999','ufdia19rx6oog','ibj6j}RQ');
/*!40000 ALTER TABLE `ufa_acc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ufagen`
--

DROP TABLE IF EXISTS `ufagen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ufagen` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) NOT NULL DEFAULT 'xaxa!6969',
  `changpass` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `used` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ufagen`
--

LOCK TABLES `ufagen` WRITE;
/*!40000 ALTER TABLE `ufagen` DISABLE KEYS */;
INSERT INTO `ufagen` VALUES (3,'ufdia19rx6oog','ibj6j}RQ',1,1,1),(4,'ufdia19u4elqh','&O8MlezJ',1,1,0);
/*!40000 ALTER TABLE `ufagen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wheel`
--

DROP TABLE IF EXISTS `wheel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wheel` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `user` varchar(25) NOT NULL,
  `credit` double NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_new` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wheel`
--

LOCK TABLES `wheel` WRITE;
/*!40000 ALTER TABLE `wheel` DISABLE KEYS */;
/*!40000 ALTER TABLE `wheel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'sql_cv9bet_com'
--

--
-- Dumping routines for database 'sql_cv9bet_com'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-08  2:50:54
