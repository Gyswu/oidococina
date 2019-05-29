-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: oidococina
-- ------------------------------------------------------
-- Server version	10.1.38-MariaDB-0ubuntu0.18.04.2

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
-- Table structure for table `Ingredientes`
--

DROP TABLE IF EXISTS `Ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ingredientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `product_id` (`producto_id`) USING BTREE,
  CONSTRAINT `Ingredientes_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `Productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ingredientes`
--

LOCK TABLES `Ingredientes` WRITE;
/*!40000 ALTER TABLE `Ingredientes` DISABLE KEYS */;
INSERT INTO `Ingredientes` VALUES (33,1,45),(34,1,76),(35,2,67);
/*!40000 ALTER TABLE `Ingredientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Menus`
--

DROP TABLE IF EXISTS `Menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `precio` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Menus`
--

LOCK TABLES `Menus` WRITE;
/*!40000 ALTER TABLE `Menus` DISABLE KEYS */;
INSERT INTO `Menus` VALUES (1,'Menu del dia',10);
/*!40000 ALTER TABLE `Menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Menus_x_Platos`
--

DROP TABLE IF EXISTS `Menus_x_Platos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Menus_x_Platos` (
  `menu_id` int(11) NOT NULL,
  `plato_id` int(11) NOT NULL,
  PRIMARY KEY (`plato_id`,`menu_id`),
  KEY `Menus_x_Platos_Menus_id_fk` (`menu_id`),
  CONSTRAINT `Menus_x_Platos_Menus_id_fk` FOREIGN KEY (`menu_id`) REFERENCES `Menus` (`id`),
  CONSTRAINT `Menus_x_Platos_Platos_id_fk` FOREIGN KEY (`plato_id`) REFERENCES `Platos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Menus_x_Platos`
--

LOCK TABLES `Menus_x_Platos` WRITE;
/*!40000 ALTER TABLE `Menus_x_Platos` DISABLE KEYS */;
INSERT INTO `Menus_x_Platos` VALUES (1,1);
/*!40000 ALTER TABLE `Menus_x_Platos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Mesas`
--

DROP TABLE IF EXISTS `Mesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Mesas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Mesas`
--

LOCK TABLES `Mesas` WRITE;
/*!40000 ALTER TABLE `Mesas` DISABLE KEYS */;
INSERT INTO `Mesas` VALUES (4,'Interior 1'),(5,'Interior 2'),(6,'Interior 3');
/*!40000 ALTER TABLE `Mesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pedidos`
--

DROP TABLE IF EXISTS `Pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mesa_id` int(11) NOT NULL,
  `plato_id` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `Pedidos_Mesas_id_fk` (`mesa_id`),
  KEY `Pedidos_Platos_id_fk` (`plato_id`),
  CONSTRAINT `Pedidos_Mesas_id_fk` FOREIGN KEY (`mesa_id`) REFERENCES `Mesas` (`id`),
  CONSTRAINT `Pedidos_Platos_id_fk` FOREIGN KEY (`plato_id`) REFERENCES `Platos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pedidos`
--

LOCK TABLES `Pedidos` WRITE;
/*!40000 ALTER TABLE `Pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `Pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Platos`
--

DROP TABLE IF EXISTS `Platos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Platos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `precio` float(6,2) DEFAULT NULL,
  `disponible` int(1) DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `nombre` (`nombre`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Platos`
--

LOCK TABLES `Platos` WRITE;
/*!40000 ALTER TABLE `Platos` DISABLE KEYS */;
INSERT INTO `Platos` VALUES (1,'Judías con chorizo',23.00,NULL),(2,'Callos a la madrileña',150.00,NULL),(3,'Tortilla',2.50,1);
/*!40000 ALTER TABLE `Platos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Platos_x_Ingredientes`
--

DROP TABLE IF EXISTS `Platos_x_Ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Platos_x_Ingredientes` (
  `plato_id` int(11) NOT NULL,
  `ingrediente_id` int(11) NOT NULL,
  PRIMARY KEY (`plato_id`,`ingrediente_id`),
  KEY `Platos_x_Ingredientes_Ingredientes_id_fk` (`ingrediente_id`),
  CONSTRAINT `Platos_x_Ingredientes_Ingredientes_id_fk` FOREIGN KEY (`ingrediente_id`) REFERENCES `Ingredientes` (`id`),
  CONSTRAINT `Platos_x_Ingredientes_Platos_id_fk` FOREIGN KEY (`plato_id`) REFERENCES `Platos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Platos_x_Ingredientes`
--

LOCK TABLES `Platos_x_Ingredientes` WRITE;
/*!40000 ALTER TABLE `Platos_x_Ingredientes` DISABLE KEYS */;
INSERT INTO `Platos_x_Ingredientes` VALUES (1,33),(1,34),(1,35);
/*!40000 ALTER TABLE `Platos_x_Ingredientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Productos`
--

DROP TABLE IF EXISTS `Productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `unidad` enum('num','ml','gr') DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Productos`
--

LOCK TABLES `Productos` WRITE;
/*!40000 ALTER TABLE `Productos` DISABLE KEYS */;
INSERT INTO `Productos` VALUES (1,'Judías','conservas',250,'num'),(2,'huevo','frescos',10,'num'),(3,'das','ca',500,'num');
/*!40000 ALTER TABLE `Productos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-30  0:29:32
