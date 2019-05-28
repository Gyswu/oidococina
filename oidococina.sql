/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : oidococina

 Target Server Type    : MariaDB
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 28/05/2019 20:04:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for Ingredientes
-- ----------------------------
DROP TABLE IF EXISTS `Ingredientes`;
CREATE TABLE `Ingredientes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(5) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_id`(`producto_id`) USING BTREE,
  CONSTRAINT `Ingredientes_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `Productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of Ingredientes
-- ----------------------------
INSERT INTO `Ingredientes` VALUES (1, 1, 5);

-- ----------------------------
-- Table structure for MesaPedidos
-- ----------------------------
DROP TABLE IF EXISTS `MesaPedidos`;
CREATE TABLE `MesaPedidos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mesa` int(11) NULL DEFAULT NULL,
  `pedido` int(11) NULL DEFAULT NULL,
  `creado` datetime(0) NULL DEFAULT NULL,
  `actualizado` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `mesa`(`mesa`) USING BTREE,
  INDEX `pedido`(`pedido`) USING BTREE,
  CONSTRAINT `MesaPedidos_ibfk_1` FOREIGN KEY (`mesa`) REFERENCES `Mesas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `MesaPedidos_ibfk_2` FOREIGN KEY (`pedido`) REFERENCES `Pedidos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for Mesas
-- ----------------------------
DROP TABLE IF EXISTS `Mesas`;
CREATE TABLE `Mesas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for PedidoVariaciones
-- ----------------------------
DROP TABLE IF EXISTS `PedidoVariaciones`;
CREATE TABLE `PedidoVariaciones`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido` int(11) NULL DEFAULT NULL,
  `producto` int(11) NULL DEFAULT NULL,
  `cantidad` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pedido`(`pedido`) USING BTREE,
  INDEX `producto`(`producto`) USING BTREE,
  CONSTRAINT `PedidoVariaciones_ibfk_1` FOREIGN KEY (`pedido`) REFERENCES `Pedidos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `PedidoVariaciones_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `Productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for Pedidos
-- ----------------------------
DROP TABLE IF EXISTS `Pedidos`;
CREATE TABLE `Pedidos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plato` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cantidad` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for Platos
-- ----------------------------
DROP TABLE IF EXISTS `Platos`;
CREATE TABLE `Platos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `precio` float(6, 2) NULL DEFAULT NULL,
  `disponible` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `nombre`(`nombre`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of Platos
-- ----------------------------
INSERT INTO `Platos` VALUES (1, 'Judías con chorizo', 23.00, NULL);
INSERT INTO `Platos` VALUES (2, 'Callos a la madrileña', 150.00, NULL);

-- ----------------------------
-- Table structure for PlatosProductos
-- ----------------------------
DROP TABLE IF EXISTS `PlatosProductos`;
CREATE TABLE `PlatosProductos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plato` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `cantidad` int(3) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `producto`(`producto`) USING BTREE,
  INDEX `plato`(`plato`) USING BTREE,
  CONSTRAINT `PlatosProductos_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `Productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `PlatosProductos_ibfk_2` FOREIGN KEY (`plato`) REFERENCES `Platos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for Productos
-- ----------------------------
DROP TABLE IF EXISTS `Productos`;
CREATE TABLE `Productos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `categoria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cantidad` int(11) NULL DEFAULT NULL,
  `unidad` enum('num','ml','gr') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of Productos
-- ----------------------------
INSERT INTO `Productos` VALUES (1, 'Judías', 'conservas', 250, 'num');

SET FOREIGN_KEY_CHECKS = 1;
