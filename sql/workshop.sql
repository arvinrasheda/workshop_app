/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : workshop

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 07/10/2020 20:44:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for materi
-- ----------------------------
DROP TABLE IF EXISTS `materi`;
CREATE TABLE `materi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pelatihan_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pelatihan
-- ----------------------------
DROP TABLE IF EXISTS `pelatihan`;
CREATE TABLE `pelatihan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pelatihan
-- ----------------------------
INSERT INTO `pelatihan` VALUES (1, 'Pelatihan 1', '100000');
INSERT INTO `pelatihan` VALUES (2, 'Pelatihan 2', '200000');

-- ----------------------------
-- Table structure for peserta
-- ----------------------------
DROP TABLE IF EXISTS `peserta`;
CREATE TABLE `peserta`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pelatihan_id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nohp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 64 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Arvin', 'arvin', '$2y$10$LEZFoxQ1WytyYD.Wlc/PJ.cIgFPulKDbNkyCWYJjNOv/Aj/8ei4bu', 1, 1);
INSERT INTO `users` VALUES (2, 'Eka', 'eka', '$2y$10$LEZFoxQ1WytyYD.Wlc/PJ.cIgFPulKDbNkyCWYJjNOv/Aj/8ei4bu', 1, 1);
INSERT INTO `users` VALUES (3, 'Indra', 'indra', '$2y$10$LEZFoxQ1WytyYD.Wlc/PJ.cIgFPulKDbNkyCWYJjNOv/Aj/8ei4bu', 1, 1);
INSERT INTO `users` VALUES (4, 'Ady', 'ady', '$2y$10$LEZFoxQ1WytyYD.Wlc/PJ.cIgFPulKDbNkyCWYJjNOv/Aj/8ei4bu', 1, 1);
INSERT INTO `users` VALUES (5, 'Wahab', 'wahab', '$2y$10$LEZFoxQ1WytyYD.Wlc/PJ.cIgFPulKDbNkyCWYJjNOv/Aj/8ei4bu', 1, 1);

SET FOREIGN_KEY_CHECKS = 1;
