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

 Date: 08/06/2019 11:28:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for Categorias
-- ----------------------------
DROP TABLE IF EXISTS `Categorias`;
CREATE TABLE `Categorias`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of Categorias
-- ----------------------------
INSERT INTO `Categorias` VALUES (1, 'Primer', '2019-06-04 15:53:42', '2019-06-04 15:53:42');
INSERT INTO `Categorias` VALUES (2, 'Segundo', '2019-06-04 15:53:42', '2019-06-04 15:53:42');
INSERT INTO `Categorias` VALUES (3, 'Tercero', '2019-06-04 15:53:42', '2019-06-04 15:53:42');
INSERT INTO `Categorias` VALUES (4, 'Postre', '2019-06-04 15:53:42', '2019-06-04 15:53:42');

-- ----------------------------
-- Table structure for Ingredientes
-- ----------------------------
DROP TABLE IF EXISTS `Ingredientes`;
CREATE TABLE `Ingredientes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(5) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_id`(`producto_id`) USING BTREE,
  CONSTRAINT `Ingredientes_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `Productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of Ingredientes
-- ----------------------------
INSERT INTO `Ingredientes` VALUES (33, 1, 45, '2019-06-04 15:53:37', '2019-06-04 15:53:37');
INSERT INTO `Ingredientes` VALUES (34, 1, 76, '2019-06-04 15:53:37', '2019-06-04 15:53:37');
INSERT INTO `Ingredientes` VALUES (35, 2, 67, '2019-06-04 15:53:37', '2019-06-04 15:53:37');
INSERT INTO `Ingredientes` VALUES (36, 2, 5, '2019-06-04 15:53:37', '2019-06-04 15:53:37');

-- ----------------------------
-- Table structure for Menus
-- ----------------------------
DROP TABLE IF EXISTS `Menus`;
CREATE TABLE `Menus`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `precio` float NOT NULL,
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of Menus
-- ----------------------------
INSERT INTO `Menus` VALUES (1, 'Menu del dia', 10, '2019-06-04 15:53:22', '2019-06-04 15:53:22');

-- ----------------------------
-- Table structure for Menus_x_Platos
-- ----------------------------
DROP TABLE IF EXISTS `Menus_x_Platos`;
CREATE TABLE `Menus_x_Platos`  (
  `menu_id` int(11) NOT NULL,
  `plato_id` int(11) NOT NULL,
  PRIMARY KEY (`plato_id`, `menu_id`) USING BTREE,
  INDEX `Menus_x_Platos_Menus_id_fk`(`menu_id`) USING BTREE,
  CONSTRAINT `Menus_x_Platos_Menus_id_fk` FOREIGN KEY (`menu_id`) REFERENCES `Menus` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `Menus_x_Platos_Platos_id_fk` FOREIGN KEY (`plato_id`) REFERENCES `Platos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of Menus_x_Platos
-- ----------------------------
INSERT INTO `Menus_x_Platos` VALUES (1, 1);
INSERT INTO `Menus_x_Platos` VALUES (1, 2);

-- ----------------------------
-- Table structure for Mesas
-- ----------------------------
DROP TABLE IF EXISTS `Mesas`;
CREATE TABLE `Mesas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estado` int(2) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of Mesas
-- ----------------------------
INSERT INTO `Mesas` VALUES (5, 'Interior 2', 1, '2019-06-04 15:53:26', '2019-06-04 15:53:26');
INSERT INTO `Mesas` VALUES (6, 'Interior 3', 0, '2019-06-04 15:53:26', '2019-06-04 15:53:26');

-- ----------------------------
-- Table structure for PedidoPlatos
-- ----------------------------
DROP TABLE IF EXISTS `PedidoPlatos`;
CREATE TABLE `PedidoPlatos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido` int(11) NOT NULL,
  `plato` int(11) NOT NULL,
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pedido`(`pedido`, `plato`) USING BTREE,
  INDEX `plato`(`plato`) USING BTREE,
  CONSTRAINT `PedidoPlatos_ibfk_1` FOREIGN KEY (`pedido`) REFERENCES `Pedidos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `PedidoPlatos_ibfk_2` FOREIGN KEY (`plato`) REFERENCES `Platos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of PedidoPlatos
-- ----------------------------
INSERT INTO `PedidoPlatos` VALUES (1, 1, 4, '2019-06-08 11:12:09', '2019-06-08 11:12:09');
INSERT INTO `PedidoPlatos` VALUES (2, 166, 3, '2019-06-08 11:12:14', '2019-06-08 11:12:14');
INSERT INTO `PedidoPlatos` VALUES (5, 166, 6, '2019-06-08 11:22:53', '2019-06-08 11:22:53');
INSERT INTO `PedidoPlatos` VALUES (6, 166, 6, '2019-06-08 11:22:55', '2019-06-08 11:22:55');
INSERT INTO `PedidoPlatos` VALUES (7, 166, 6, '2019-06-08 11:26:44', '2019-06-08 11:26:44');
INSERT INTO `PedidoPlatos` VALUES (8, 166, 4, '2019-06-08 11:26:46', '2019-06-08 11:26:46');
INSERT INTO `PedidoPlatos` VALUES (9, 166, 1, '2019-06-08 11:26:47', '2019-06-08 11:26:47');

-- ----------------------------
-- Table structure for Pedidos
-- ----------------------------
DROP TABLE IF EXISTS `Pedidos`;
CREATE TABLE `Pedidos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mesa_id` int(11) NOT NULL,
  `estado` int(11) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `Pedidos_Mesas_id_fk`(`mesa_id`) USING BTREE,
  CONSTRAINT `Pedidos_Mesas_id_fk` FOREIGN KEY (`mesa_id`) REFERENCES `Mesas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 167 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of Pedidos
-- ----------------------------
INSERT INTO `Pedidos` VALUES (1, 6, 0, '2019-06-08 10:46:51', '2019-06-08 10:46:51');
INSERT INTO `Pedidos` VALUES (165, 5, 0, '2019-06-06 00:23:17', '2019-06-06 00:23:17');
INSERT INTO `Pedidos` VALUES (166, 6, 0, '2019-06-08 09:44:42', '2019-06-08 09:44:42');

-- ----------------------------
-- Table structure for Platos
-- ----------------------------
DROP TABLE IF EXISTS `Platos`;
CREATE TABLE `Platos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `precio` float(6, 2) NULL DEFAULT NULL,
  `disponible` int(1) NULL DEFAULT 1,
  `categoria_id` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `nombre`(`nombre`) USING BTREE,
  INDEX `Platos_Categorias_id_fk`(`categoria_id`) USING BTREE,
  CONSTRAINT `Platos_Categorias_id_fk` FOREIGN KEY (`categoria_id`) REFERENCES `Categorias` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of Platos
-- ----------------------------
INSERT INTO `Platos` VALUES (1, 'Judías con chorizo', 23.00, NULL, 2, '2019-06-04 15:53:18', '2019-06-04 15:53:18');
INSERT INTO `Platos` VALUES (2, 'Callos a la madrileña', 150.00, NULL, 1, '2019-06-04 15:53:18', '2019-06-04 15:53:18');
INSERT INTO `Platos` VALUES (3, 'Tortilla', 2.50, 1, 2, '2019-06-04 15:53:18', '2019-06-04 15:53:18');
INSERT INTO `Platos` VALUES (4, 'Lentejas con Nutella', 15.00, 1, 1, '2019-06-04 15:53:18', '2019-06-04 15:53:18');
INSERT INTO `Platos` VALUES (6, 'Cianuro', 0.50, 1, 3, '2019-06-04 15:53:18', '2019-06-04 15:53:18');

-- ----------------------------
-- Table structure for Platos_x_Ingredientes
-- ----------------------------
DROP TABLE IF EXISTS `Platos_x_Ingredientes`;
CREATE TABLE `Platos_x_Ingredientes`  (
  `plato_id` int(11) NOT NULL,
  `ingrediente_id` int(11) NOT NULL,
  PRIMARY KEY (`plato_id`, `ingrediente_id`) USING BTREE,
  INDEX `Platos_x_Ingredientes_Ingredientes_id_fk`(`ingrediente_id`) USING BTREE,
  CONSTRAINT `Platos_x_Ingredientes_Ingredientes_id_fk` FOREIGN KEY (`ingrediente_id`) REFERENCES `Ingredientes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `Platos_x_Ingredientes_Platos_id_fk` FOREIGN KEY (`plato_id`) REFERENCES `Platos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for Productos
-- ----------------------------
DROP TABLE IF EXISTS `Productos`;
CREATE TABLE `Productos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `categoria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stock` int(11) NULL DEFAULT NULL,
  `unidad` enum('num','ml','gr') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of Productos
-- ----------------------------
INSERT INTO `Productos` VALUES (1, 'Judías', 'conservas', 250, 'num', '2019-06-04 15:53:46', '2019-06-04 15:53:46');
INSERT INTO `Productos` VALUES (2, 'huevo', 'frescos', 10, 'num', '2019-06-04 15:53:46', '2019-06-04 15:53:46');
INSERT INTO `Productos` VALUES (3, 'das', 'ca', 500, 'num', '2019-06-04 15:53:46', '2019-06-04 15:53:46');

SET FOREIGN_KEY_CHECKS = 1;
