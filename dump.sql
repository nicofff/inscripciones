-- MySQL dump 10.14  Distrib 5.5.37-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: inscripciones
-- ------------------------------------------------------
-- Server version	5.5.37-MariaDB-log

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
-- Table structure for table `Categorias`
--

DROP TABLE IF EXISTS `Categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Categorias` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categorias`
--

LOCK TABLES `Categorias` WRITE;
/*!40000 ALTER TABLE `Categorias` DISABLE KEYS */;
INSERT INTO `Categorias` VALUES (0,'No Becado'),(1,'Becado'),(3,'Autoridad'),(4,'Coordinador'),(5,'Panelista');
/*!40000 ALTER TABLE `Categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Inscriptos`
--

DROP TABLE IF EXISTS `Inscriptos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Inscriptos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Apellido` varchar(45) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `TipoDoc` int(11) DEFAULT NULL,
  `NumeroDoc` int(11) DEFAULT NULL,
  `PaisNac` int(11) DEFAULT NULL,
  `Profesion` int(11) DEFAULT NULL,
  `Especialidad` varchar(45) DEFAULT NULL,
  `PaisRes` int(11) DEFAULT NULL,
  `Provincia` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Categoria` int(11) NOT NULL,
  `Laboratorio` int(11) NOT NULL,
  `CodigoInscripcion` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `CodigoInscripcion_UNIQUE` (`CodigoInscripcion`),
  KEY `fk_Inscriptos_1_idx` (`PaisNac`),
  KEY `fk_Inscriptos_2_idx` (`PaisRes`),
  KEY `fk_Inscriptos_3_idx` (`Profesion`),
  KEY `fk_Inscriptos_4_idx` (`Laboratorio`),
  KEY `fk_Inscriptos_5_idx` (`Categoria`),
  KEY `fk_Inscriptos_6_idx` (`TipoDoc`),
  CONSTRAINT `fk_Inscriptos_1` FOREIGN KEY (`PaisNac`) REFERENCES `Paises` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inscriptos_2` FOREIGN KEY (`PaisRes`) REFERENCES `Paises` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inscriptos_3` FOREIGN KEY (`Profesion`) REFERENCES `Profesion` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inscriptos_4` FOREIGN KEY (`Laboratorio`) REFERENCES `Laboratorios` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inscriptos_5` FOREIGN KEY (`Categoria`) REFERENCES `Categorias` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inscriptos_6` FOREIGN KEY (`TipoDoc`) REFERENCES `TipoDoc` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Inscriptos`
--

LOCK TABLES `Inscriptos` WRITE;
/*!40000 ALTER TABLE `Inscriptos` DISABLE KEYS */;
INSERT INTO `Inscriptos` VALUES (5,'asd','qwe',1,34617198,1,1,'asd',1,'La Rioja','nicofff@gmail.com',0,0,'1ba35bcc');
/*!40000 ALTER TABLE `Inscriptos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Laboratorios`
--

DROP TABLE IF EXISTS `Laboratorios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Laboratorios` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Laboratorios`
--

LOCK TABLES `Laboratorios` WRITE;
/*!40000 ALTER TABLE `Laboratorios` DISABLE KEYS */;
INSERT INTO `Laboratorios` VALUES (0,'Ninguno'),(1,'Takeda'),(2,'Roemmers'),(3,'Sanitas'),(4,'Casasco'),(5,'Gador'),(6,'Astrazéneca'),(7,'Domínguez'),(8,'Eurofarma'),(9,'Sidus'),(10,'Ivax'),(11,'CIDEMO'),(12,'Corpomédica');
/*!40000 ALTER TABLE `Laboratorios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Paises`
--

DROP TABLE IF EXISTS `Paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Paises` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Paises`
--

LOCK TABLES `Paises` WRITE;
/*!40000 ALTER TABLE `Paises` DISABLE KEYS */;
INSERT INTO `Paises` VALUES (1,'Argentina'),(2,'Armenia'),(3,'Australia'),(4,'Austria'),(5,'Bolivia'),(6,'Brasil'),(7,'Bélgica'),(8,'Canadá'),(9,'Checoslovaquia'),(10,'Chile'),(11,'China'),(12,'Colombia'),(13,'Costa Rica'),(14,'Croacia'),(15,'Cuba'),(16,'Dinamarca'),(17,'Ecuador'),(18,'El Salvador'),(19,'España'),(20,'Estados Unidos'),(21,'Finlandia'),(22,'Francia'),(23,'Grecia'),(24,'Guatemala'),(25,'Haití'),(26,'Holanda'),(27,'Honduras'),(28,'Hungría'),(29,'Irlanda'),(30,'Islandia'),(31,'Israel'),(32,'Italia'),(33,'Jamaica'),(34,'Japón'),(35,'México'),(36,'Nicaragua'),(37,'Noruega'),(38,'Nueva Zelandia'),(39,'Pakistán'),(40,'Panamá'),(41,'Paraguay'),(42,'Perú'),(43,'Polonia'),(44,'Portugal'),(45,'Puerto Rico'),(46,'Reino Unido'),(47,'República Checa'),(48,'República Dominicana'),(49,'Rumania'),(50,'Rusia'),(51,'Siria'),(52,'Suecia'),(53,'Suiza'),(54,'Taiwan'),(55,'Ucrania'),(56,'Uruguay'),(57,'Venezuela'),(58,'Yugoslavia');
/*!40000 ALTER TABLE `Paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Profesion`
--

DROP TABLE IF EXISTS `Profesion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Profesion` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Profesion`
--

LOCK TABLES `Profesion` WRITE;
/*!40000 ALTER TABLE `Profesion` DISABLE KEYS */;
INSERT INTO `Profesion` VALUES (1,'Médico '),(2,'Bioquímico '),(3,'Educador Terciario '),(4,'Asistente Social '),(5,'Psicólogo '),(6,'Kinesiólogo'),(7,'Sociólogo '),(8,'Nutricionista '),(9,'Asistente de endoscopía '),(10,'Fonoaudiólogo'),(11,'Otro');
/*!40000 ALTER TABLE `Profesion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TipoDoc`
--

DROP TABLE IF EXISTS `TipoDoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TipoDoc` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TipoDoc`
--

LOCK TABLES `TipoDoc` WRITE;
/*!40000 ALTER TABLE `TipoDoc` DISABLE KEYS */;
INSERT INTO `TipoDoc` VALUES (1,'DNI'),(2,'LC'),(3,'LE'),(4,'PASS');
/*!40000 ALTER TABLE `TipoDoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `salt` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES (1,'admin','633f7a9d7c2b4a1e97593cb88475c817990eae481f07601e6039e48a977463c6','a340');
/*!40000 ALTER TABLE `Usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-07  9:21:49
