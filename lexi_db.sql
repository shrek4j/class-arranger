/*
SQLyog Ultimate v8.32 
MySQL - 5.5.20 : Database - lexi_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lexi_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `lexi_db`;

/*Table structure for table `lexi_word` */

DROP TABLE IF EXISTS `lexi_word`;

CREATE TABLE `lexi_word` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `word` varchar(20) NOT NULL,
  `meaning` varchar(100) DEFAULT NULL,
  `origin` int(1) DEFAULT NULL COMMENT '1:latin 2:germanic 3:greek',
  `teach` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `lexi_word` */

/*Table structure for table `lexi_word_root` */

DROP TABLE IF EXISTS `lexi_word_root`;

CREATE TABLE `lexi_word_root` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `word_root` varchar(20) NOT NULL,
  `meaning` varchar(50) DEFAULT NULL,
  `origin` int(1) DEFAULT NULL COMMENT '1:latin 2:germanic 3:greek 4:other',
  `category_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `lexi_word_root` */

insert  into `lexi_word_root`(`id`,`word_root`,`meaning`,`origin`,`category_id`) values (1,'uni-','one',1,1);

/*Table structure for table `lexi_word_root_category` */

DROP TABLE IF EXISTS `lexi_word_root_category`;

CREATE TABLE `lexi_word_root_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `lexi_word_root_category` */

insert  into `lexi_word_root_category`(`id`,`category_name`) values (1,'数字'),(2,'动物'),(3,'植物');

/*Table structure for table `lexi_word_root_rela` */

DROP TABLE IF EXISTS `lexi_word_root_rela`;

CREATE TABLE `lexi_word_root_rela` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `word_id` int(10) NOT NULL,
  `word_root_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `lexi_word_root_rela` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
