-- MySQL dump 10.16  Distrib 10.1.40-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: oidococina
-- ------------------------------------------------------
-- Server version	10.1.40-MariaDB-0ubuntu0.18.04.1

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
-- Table structure for table `Categorias`
--

DROP TABLE IF EXISTS `Categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categorias`
--

LOCK TABLES `Categorias` WRITE;
/*!40000 ALTER TABLE `Categorias` DISABLE KEYS */;
INSERT INTO `Categorias` VALUES (1,'Primer','2019-06-04 15:53:42','2019-06-04 15:53:42'),(2,'Segundo','2019-06-04 15:53:42','2019-06-04 15:53:42'),(3,'Tercero','2019-06-04 15:53:42','2019-06-04 15:53:42'),(4,'Postre','2019-06-04 15:53:42','2019-06-04 15:53:42');
/*!40000 ALTER TABLE `Categorias` ENABLE KEYS */;
UNLOCK TABLES;

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
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `product_id` (`producto_id`) USING BTREE,
  CONSTRAINT `Ingredientes_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `Productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ingredientes`
--

LOCK TABLES `Ingredientes` WRITE;
/*!40000 ALTER TABLE `Ingredientes` DISABLE KEYS */;
INSERT INTO `Ingredientes` VALUES (33,1,45,'2019-06-04 15:53:37','2019-06-04 15:53:37'),(34,1,76,'2019-06-04 15:53:37','2019-06-04 15:53:37'),(35,2,67,'2019-06-04 15:53:37','2019-06-04 15:53:37'),(36,2,5,'2019-06-04 15:53:37','2019-06-04 15:53:37');
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
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Menus`
--

LOCK TABLES `Menus` WRITE;
/*!40000 ALTER TABLE `Menus` DISABLE KEYS */;
INSERT INTO `Menus` VALUES (1,'Menu del dia',10,'2019-06-04 15:53:22','2019-06-04 15:53:22');
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
  PRIMARY KEY (`plato_id`,`menu_id`) USING BTREE,
  KEY `Menus_x_Platos_Menus_id_fk` (`menu_id`) USING BTREE,
  CONSTRAINT `Menus_x_Platos_Menus_id_fk` FOREIGN KEY (`menu_id`) REFERENCES `Menus` (`id`),
  CONSTRAINT `Menus_x_Platos_Platos_id_fk` FOREIGN KEY (`plato_id`) REFERENCES `Platos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Menus_x_Platos`
--

LOCK TABLES `Menus_x_Platos` WRITE;
/*!40000 ALTER TABLE `Menus_x_Platos` DISABLE KEYS */;
INSERT INTO `Menus_x_Platos` VALUES (1,1),(1,2);
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
  `estado` int(2) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Mesas`
--

LOCK TABLES `Mesas` WRITE;
/*!40000 ALTER TABLE `Mesas` DISABLE KEYS */;
INSERT INTO `Mesas` VALUES (1,'Exterior 1',0,'2019-06-17 13:24:43','2019-06-17 13:24:43'),(2,'Exterior 2',0,'2019-06-17 13:24:50','2019-06-17 13:24:50'),(3,'Exterior 3',0,'2019-06-17 13:25:00','2019-06-17 13:25:00'),(4,'interior 1',0,'2019-06-17 13:24:27','2019-06-17 13:24:27'),(5,'Interior 2',0,'2019-06-04 15:53:26','2019-06-10 22:29:23'),(6,'Interior 3',0,'2019-06-04 15:53:26','2019-06-17 13:25:05');
/*!40000 ALTER TABLE `Mesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PedidoPlatos`
--

DROP TABLE IF EXISTS `PedidoPlatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PedidoPlatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido` int(11) NOT NULL,
  `plato` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `pedido` (`pedido`,`plato`) USING BTREE,
  KEY `plato` (`plato`) USING BTREE,
  CONSTRAINT `PedidoPlatos_ibfk_1` FOREIGN KEY (`pedido`) REFERENCES `Pedidos` (`id`),
  CONSTRAINT `PedidoPlatos_ibfk_2` FOREIGN KEY (`plato`) REFERENCES `Platos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PedidoPlatos`
--

LOCK TABLES `PedidoPlatos` WRITE;
/*!40000 ALTER TABLE `PedidoPlatos` DISABLE KEYS */;
/*!40000 ALTER TABLE `PedidoPlatos` ENABLE KEYS */;
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
  `estado` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `Pedidos_Mesas_id_fk` (`mesa_id`) USING BTREE,
  CONSTRAINT `Pedidos_Mesas_id_fk` FOREIGN KEY (`mesa_id`) REFERENCES `Mesas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pedidos`
--

LOCK TABLES `Pedidos` WRITE;
/*!40000 ALTER TABLE `Pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `Pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pedidos_x_Platos`
--

DROP TABLE IF EXISTS `Pedidos_x_Platos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pedidos_x_Platos` (
  `pedido_id` int(11) NOT NULL,
  `plato_id` int(11) NOT NULL,
  PRIMARY KEY (`pedido_id`,`plato_id`) USING BTREE,
  KEY `Pedidos_x_Platos_Platos_id_fk` (`plato_id`) USING BTREE,
  CONSTRAINT `Pedidos_x_Platos_Pedidos_id_fk` FOREIGN KEY (`pedido_id`) REFERENCES `Pedidos` (`id`),
  CONSTRAINT `Pedidos_x_Platos_Platos_id_fk` FOREIGN KEY (`plato_id`) REFERENCES `Platos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pedidos_x_Platos`
--

LOCK TABLES `Pedidos_x_Platos` WRITE;
/*!40000 ALTER TABLE `Pedidos_x_Platos` DISABLE KEYS */;
/*!40000 ALTER TABLE `Pedidos_x_Platos` ENABLE KEYS */;
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
  `categoria_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `nombre` (`nombre`) USING BTREE,
  KEY `Platos_Categorias_id_fk` (`categoria_id`) USING BTREE,
  CONSTRAINT `Platos_Categorias_id_fk` FOREIGN KEY (`categoria_id`) REFERENCES `Categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Platos`
--

LOCK TABLES `Platos` WRITE;
/*!40000 ALTER TABLE `Platos` DISABLE KEYS */;
INSERT INTO `Platos` VALUES (1,'Judías con chorizo',23.00,1,2,'2019-06-04 15:53:18','2019-06-09 17:01:02'),(2,'Callos a la madrileña',4.99,0,1,'2019-06-04 15:53:18','2019-06-17 13:22:33'),(3,'Tortilla',2.50,1,2,'2019-06-04 15:53:18','2019-06-04 15:53:18'),(4,'Lentejas con Nutella',15.00,1,1,'2019-06-04 15:53:18','2019-06-04 15:53:18'),(7,'Bravas',2.50,0,1,'2019-06-09 15:35:19','2019-06-09 15:35:19'),(8,'Alcachofas rellenas',3.99,1,2,'2019-06-17 13:25:32','2019-06-17 13:25:32'),(9,'Tofu con verduras',2.99,1,2,'2019-06-17 13:25:46','2019-06-17 13:25:46'),(10,'Helado de vainilla',1.95,1,4,'2019-06-17 13:25:57','2019-06-17 13:25:57'),(11,'Pinchos de ciruelas',1.95,1,3,'2019-06-17 13:26:24','2019-06-17 13:26:24');
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
  PRIMARY KEY (`plato_id`,`ingrediente_id`) USING BTREE,
  KEY `Platos_x_Ingredientes_Ingredientes_id_fk` (`ingrediente_id`) USING BTREE,
  CONSTRAINT `Platos_x_Ingredientes_Ingredientes_id_fk` FOREIGN KEY (`ingrediente_id`) REFERENCES `Ingredientes` (`id`),
  CONSTRAINT `Platos_x_Ingredientes_Platos_id_fk` FOREIGN KEY (`plato_id`) REFERENCES `Platos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Platos_x_Ingredientes`
--

LOCK TABLES `Platos_x_Ingredientes` WRITE;
/*!40000 ALTER TABLE `Platos_x_Ingredientes` DISABLE KEYS */;
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
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Productos`
--

LOCK TABLES `Productos` WRITE;
/*!40000 ALTER TABLE `Productos` DISABLE KEYS */;
INSERT INTO `Productos` VALUES (1,'Judías','conservas',250,'num','2019-06-04 15:53:46','2019-06-04 15:53:46'),(2,'huevo','frescos',10,'num','2019-06-04 15:53:46','2019-06-04 15:53:46'),(3,'das','ca',500,'num','2019-06-04 15:53:46','2019-06-04 15:53:46');
/*!40000 ALTER TABLE `Productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `pin` int(6) DEFAULT NULL,
  `rol` enum('camarero','tpv','cocinero','gerente','admin','superadmin') DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES (1,'Gerente 1',1111,'gerente'),(2,'Caja 1',1111,'tpv'),(3,'Chef',1111,'cocinero'),(10,'Administrador',1111,'admin'),(999999,'Gyswu',201218,'superadmin');
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

-- Dump completed on 2019-06-17 13:27:42
