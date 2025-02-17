/*
 * db.sql 文件
 *
 * 此文件用于初始化你的 MySQL 数据库。
 * 它将在 Docker 容器启动时运行，
 * 并执行所有的 SQL 命令来设置你的数据库。
 *
 * 你可以在这里创建你的数据库，创建表，
 * 插入数据，或执行任何其他的 SQL 命令。
 *
 * 例如：
 *   CREATE DATABASE IF NOT EXISTS your_database;
 *   USE your_database;
 *   CREATE TABLE your_table (...);
 *   INSERT INTO your_table VALUES (...);
 *
 * 请根据你的需要修改此文件，
 */

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

drop database if exists flag;
create database flag;
use flag;

-- ----------------------------
-- Table structure for table
-- ----------------------------
DROP TABLE IF EXISTS `table`;
CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `flag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of table
-- ----------------------------
BEGIN;
INSERT INTO `test` VALUES (1, 'helloct{you_got_flag_29}');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
