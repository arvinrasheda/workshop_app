/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100126
 Source Host           : localhost:3306
 Source Schema         : workshop

 Target Server Type    : MySQL
 Target Server Version : 100126
 File Encoding         : 65001

 Date: 05/10/2020 11:36:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Arvin', 'arvin', '$2y$10$LEZFoxQ1WytyYD.Wlc/PJ.cIgFPulKDbNkyCWYJjNOv/Aj/8ei4bu');
INSERT INTO `users` VALUES (2, 'Eka', 'eka', '$2y$10$LEZFoxQ1WytyYD.Wlc/PJ.cIgFPulKDbNkyCWYJjNOv/Aj/8ei4bu');
INSERT INTO `users` VALUES (3, 'Indra', 'indra', '$2y$10$LEZFoxQ1WytyYD.Wlc/PJ.cIgFPulKDbNkyCWYJjNOv/Aj/8ei4bu');
INSERT INTO `users` VALUES (4, 'Ady', 'ady', '$2y$10$LEZFoxQ1WytyYD.Wlc/PJ.cIgFPulKDbNkyCWYJjNOv/Aj/8ei4bu');
INSERT INTO `users` VALUES (5, 'Wahab', 'wahab', '$2y$10$LEZFoxQ1WytyYD.Wlc/PJ.cIgFPulKDbNkyCWYJjNOv/Aj/8ei4bu');

SET FOREIGN_KEY_CHECKS = 1;
