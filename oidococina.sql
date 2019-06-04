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

 Date: 04/06/2019 19:16:17
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
  `estado` tinyint(1) NULL DEFAULT 0,
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
-- Table structure for Pedidos
-- ----------------------------
DROP TABLE IF EXISTS `Pedidos`;
CREATE TABLE `Pedidos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mesa_id` int(11) NOT NULL,
  `estado` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `Pedidos_Mesas_id_fk`(`mesa_id`) USING BTREE,
  CONSTRAINT `Pedidos_Mesas_id_fk` FOREIGN KEY (`mesa_id`) REFERENCES `Mesas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 67 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of Pedidos
-- ----------------------------
INSERT INTO `Pedidos` VALUES (1, 5, NULL, '2019-06-04 15:52:40', '2019-06-04 15:52:40');
INSERT INTO `Pedidos` VALUES (3, 5, NULL, '2019-06-04 18:29:56', '2019-06-04 18:29:56');
INSERT INTO `Pedidos` VALUES (4, 5, NULL, '2019-06-04 18:34:20', '2019-06-04 18:34:20');
INSERT INTO `Pedidos` VALUES (5, 5, NULL, '2019-06-04 18:34:20', '2019-06-04 18:34:20');
INSERT INTO `Pedidos` VALUES (6, 5, NULL, '2019-06-04 18:34:20', '2019-06-04 18:34:20');
INSERT INTO `Pedidos` VALUES (7, 5, NULL, '2019-06-04 18:34:20', '2019-06-04 18:34:20');
INSERT INTO `Pedidos` VALUES (8, 5, NULL, '2019-06-04 18:34:21', '2019-06-04 18:34:21');
INSERT INTO `Pedidos` VALUES (9, 5, NULL, '2019-06-04 18:34:21', '2019-06-04 18:34:21');
INSERT INTO `Pedidos` VALUES (10, 5, NULL, '2019-06-04 18:34:21', '2019-06-04 18:34:21');
INSERT INTO `Pedidos` VALUES (11, 5, NULL, '2019-06-04 18:34:21', '2019-06-04 18:34:21');
INSERT INTO `Pedidos` VALUES (12, 5, NULL, '2019-06-04 18:34:22', '2019-06-04 18:34:22');
INSERT INTO `Pedidos` VALUES (13, 5, NULL, '2019-06-04 18:34:22', '2019-06-04 18:34:22');
INSERT INTO `Pedidos` VALUES (14, 5, NULL, '2019-06-04 18:34:22', '2019-06-04 18:34:22');
INSERT INTO `Pedidos` VALUES (15, 5, NULL, '2019-06-04 18:34:23', '2019-06-04 18:34:23');
INSERT INTO `Pedidos` VALUES (16, 5, NULL, '2019-06-04 18:34:23', '2019-06-04 18:34:23');
INSERT INTO `Pedidos` VALUES (17, 5, NULL, '2019-06-04 18:34:23', '2019-06-04 18:34:23');
INSERT INTO `Pedidos` VALUES (18, 5, NULL, '2019-06-04 18:34:24', '2019-06-04 18:34:24');
INSERT INTO `Pedidos` VALUES (19, 5, NULL, '2019-06-04 18:34:24', '2019-06-04 18:34:24');
INSERT INTO `Pedidos` VALUES (20, 5, NULL, '2019-06-04 18:34:24', '2019-06-04 18:34:24');
INSERT INTO `Pedidos` VALUES (21, 5, NULL, '2019-06-04 18:34:24', '2019-06-04 18:34:24');
INSERT INTO `Pedidos` VALUES (22, 5, NULL, '2019-06-04 18:34:25', '2019-06-04 18:34:25');
INSERT INTO `Pedidos` VALUES (23, 5, NULL, '2019-06-04 18:34:25', '2019-06-04 18:34:25');
INSERT INTO `Pedidos` VALUES (24, 5, NULL, '2019-06-04 18:34:25', '2019-06-04 18:34:25');
INSERT INTO `Pedidos` VALUES (25, 5, NULL, '2019-06-04 18:34:25', '2019-06-04 18:34:25');
INSERT INTO `Pedidos` VALUES (26, 5, NULL, '2019-06-04 18:34:26', '2019-06-04 18:34:26');
INSERT INTO `Pedidos` VALUES (27, 5, NULL, '2019-06-04 18:34:26', '2019-06-04 18:34:26');
INSERT INTO `Pedidos` VALUES (28, 5, NULL, '2019-06-04 18:34:26', '2019-06-04 18:34:26');
INSERT INTO `Pedidos` VALUES (29, 5, NULL, '2019-06-04 18:34:27', '2019-06-04 18:34:27');
INSERT INTO `Pedidos` VALUES (30, 5, NULL, '2019-06-04 18:34:27', '2019-06-04 18:34:27');
INSERT INTO `Pedidos` VALUES (31, 5, NULL, '2019-06-04 18:34:27', '2019-06-04 18:34:27');
INSERT INTO `Pedidos` VALUES (32, 5, NULL, '2019-06-04 18:34:27', '2019-06-04 18:34:27');
INSERT INTO `Pedidos` VALUES (33, 5, NULL, '2019-06-04 18:34:28', '2019-06-04 18:34:28');
INSERT INTO `Pedidos` VALUES (34, 5, NULL, '2019-06-04 18:34:28', '2019-06-04 18:34:28');
INSERT INTO `Pedidos` VALUES (35, 5, NULL, '2019-06-04 18:34:28', '2019-06-04 18:34:28');
INSERT INTO `Pedidos` VALUES (36, 5, NULL, '2019-06-04 18:34:29', '2019-06-04 18:34:29');
INSERT INTO `Pedidos` VALUES (37, 5, NULL, '2019-06-04 18:34:29', '2019-06-04 18:34:29');
INSERT INTO `Pedidos` VALUES (38, 5, NULL, '2019-06-04 18:34:29', '2019-06-04 18:34:29');
INSERT INTO `Pedidos` VALUES (39, 5, NULL, '2019-06-04 18:34:29', '2019-06-04 18:34:29');
INSERT INTO `Pedidos` VALUES (40, 5, NULL, '2019-06-04 18:34:30', '2019-06-04 18:34:30');
INSERT INTO `Pedidos` VALUES (41, 5, NULL, '2019-06-04 18:34:30', '2019-06-04 18:34:30');
INSERT INTO `Pedidos` VALUES (42, 5, NULL, '2019-06-04 18:34:30', '2019-06-04 18:34:30');
INSERT INTO `Pedidos` VALUES (43, 5, NULL, '2019-06-04 18:34:30', '2019-06-04 18:34:30');
INSERT INTO `Pedidos` VALUES (44, 5, NULL, '2019-06-04 18:34:35', '2019-06-04 18:34:35');
INSERT INTO `Pedidos` VALUES (45, 5, NULL, '2019-06-04 18:34:36', '2019-06-04 18:34:36');
INSERT INTO `Pedidos` VALUES (46, 5, NULL, '2019-06-04 18:34:36', '2019-06-04 18:34:36');
INSERT INTO `Pedidos` VALUES (47, 5, NULL, '2019-06-04 18:34:36', '2019-06-04 18:34:36');
INSERT INTO `Pedidos` VALUES (48, 5, NULL, '2019-06-04 18:34:37', '2019-06-04 18:34:37');
INSERT INTO `Pedidos` VALUES (49, 5, NULL, '2019-06-04 18:34:37', '2019-06-04 18:34:37');
INSERT INTO `Pedidos` VALUES (50, 5, NULL, '2019-06-04 18:34:37', '2019-06-04 18:34:37');
INSERT INTO `Pedidos` VALUES (51, 5, NULL, '2019-06-04 18:34:38', '2019-06-04 18:34:38');
INSERT INTO `Pedidos` VALUES (52, 5, NULL, '2019-06-04 18:34:38', '2019-06-04 18:34:38');
INSERT INTO `Pedidos` VALUES (53, 5, NULL, '2019-06-04 18:34:38', '2019-06-04 18:34:38');
INSERT INTO `Pedidos` VALUES (54, 5, NULL, '2019-06-04 18:34:39', '2019-06-04 18:34:39');
INSERT INTO `Pedidos` VALUES (55, 5, NULL, '2019-06-04 18:34:39', '2019-06-04 18:34:39');
INSERT INTO `Pedidos` VALUES (56, 5, NULL, '2019-06-04 18:34:39', '2019-06-04 18:34:39');
INSERT INTO `Pedidos` VALUES (57, 5, NULL, '2019-06-04 18:34:39', '2019-06-04 18:34:39');
INSERT INTO `Pedidos` VALUES (58, 5, NULL, '2019-06-04 18:34:40', '2019-06-04 18:34:40');
INSERT INTO `Pedidos` VALUES (59, 5, NULL, '2019-06-04 18:34:40', '2019-06-04 18:34:40');
INSERT INTO `Pedidos` VALUES (60, 5, NULL, '2019-06-04 18:34:40', '2019-06-04 18:34:40');
INSERT INTO `Pedidos` VALUES (61, 5, NULL, '2019-06-04 18:34:41', '2019-06-04 18:34:41');
INSERT INTO `Pedidos` VALUES (62, 5, NULL, '2019-06-04 18:34:41', '2019-06-04 18:34:41');
INSERT INTO `Pedidos` VALUES (63, 5, NULL, '2019-06-04 18:35:15', '2019-06-04 18:35:15');
INSERT INTO `Pedidos` VALUES (64, 5, NULL, '2019-06-04 18:35:15', '2019-06-04 18:35:15');
INSERT INTO `Pedidos` VALUES (65, 5, NULL, '2019-06-04 18:36:17', '2019-06-04 18:36:17');
INSERT INTO `Pedidos` VALUES (66, 5, NULL, '2019-06-04 19:14:05', '2019-06-04 19:14:05');

-- ----------------------------
-- Table structure for Pedidos_x_Platos
-- ----------------------------
DROP TABLE IF EXISTS `Pedidos_x_Platos`;
CREATE TABLE `Pedidos_x_Platos`  (
  `pedido_id` int(11) NOT NULL,
  `plato_id` int(11) NOT NULL,
  PRIMARY KEY (`pedido_id`, `plato_id`) USING BTREE,
  INDEX `Pedidos_x_Platos_Platos_id_fk`(`plato_id`) USING BTREE,
  CONSTRAINT `Pedidos_x_Platos_Pedidos_id_fk` FOREIGN KEY (`pedido_id`) REFERENCES `Pedidos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `Pedidos_x_Platos_Platos_id_fk` FOREIGN KEY (`plato_id`) REFERENCES `Platos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of Pedidos_x_Platos
-- ----------------------------
INSERT INTO `Pedidos_x_Platos` VALUES (1, 3);
INSERT INTO `Pedidos_x_Platos` VALUES (1, 4);
INSERT INTO `Pedidos_x_Platos` VALUES (4, 6);
INSERT INTO `Pedidos_x_Platos` VALUES (5, 3);
INSERT INTO `Pedidos_x_Platos` VALUES (7, 3);
INSERT INTO `Pedidos_x_Platos` VALUES (8, 3);
INSERT INTO `Pedidos_x_Platos` VALUES (9, 6);
INSERT INTO `Pedidos_x_Platos` VALUES (10, 4);
INSERT INTO `Pedidos_x_Platos` VALUES (11, 4);
INSERT INTO `Pedidos_x_Platos` VALUES (12, 2);
INSERT INTO `Pedidos_x_Platos` VALUES (13, 4);
INSERT INTO `Pedidos_x_Platos` VALUES (14, 4);
INSERT INTO `Pedidos_x_Platos` VALUES (15, 2);
INSERT INTO `Pedidos_x_Platos` VALUES (65, 1);
INSERT INTO `Pedidos_x_Platos` VALUES (65, 2);
INSERT INTO `Pedidos_x_Platos` VALUES (66, 1);

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
