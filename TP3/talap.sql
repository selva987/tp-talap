/*
 Navicat Premium Data Transfer

 Source Server         : (LOCAL) Sis
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : localhost:3306
 Source Schema         : talap

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : 65001

 Date: 14/11/2020 22:41:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for lista_cabeceras
-- ----------------------------
DROP TABLE IF EXISTS `lista_cabeceras`;
CREATE TABLE `lista_cabeceras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for lista_detalles
-- ----------------------------
DROP TABLE IF EXISTS `lista_detalles`;
CREATE TABLE `lista_detalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabecera` int(11) NOT NULL,
  `id_video` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cabecera` (`id_cabecera`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `genero` enum('M','F') NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `pagina_web` varchar(255) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `altura` int(11) DEFAULT NULL,
  `latitud` double(255,0) DEFAULT NULL,
  `longitud` double(255,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
