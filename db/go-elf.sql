/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.10-MariaDB : Database - go_elf
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`go_elf` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `go_elf`;

/*Table structure for table `reservation` */

DROP TABLE IF EXISTS `reservation`;

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `no_seat` varchar(255) DEFAULT NULL,
  `no_elf` int(11) DEFAULT NULL,
  `tujuan` varchar(255) DEFAULT NULL,
  `date_booking` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

/*Data for the table `reservation` */

insert  into `reservation`(`id`,`username`,`no_seat`,`no_elf`,`tujuan`,`date_booking`) values (41,'admin','1_1',1,'Intercon-Tekno','2018-02-28 15:33:03'),(42,'admin','2_3',2,'Tekno-Intercon','2018-02-28 15:34:15'),(43,'jourdan','1_2',1,'Intercon-Tekno','2018-02-28 15:35:51'),(45,'jourdan','1_1',2,'Tekno-Intercon','2018-02-28 17:59:05'),(46,'ahmad','2_2',1,'Intercon-Tekno','2018-02-28 18:49:20'),(47,'admin','1_1',2,'Intercon-Tekno','2018-03-01 09:40:39'),(48,'admin','1_2',1,'Intercon-Tekno','2018-03-02 09:38:42'),(49,'admin','1_1,1_2',0,'--- Pilih ---','2018-05-18 01:29:39');

/*Table structure for table `supir` */

DROP TABLE IF EXISTS `supir`;

CREATE TABLE `supir` (
  `id_supir` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_supir`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `supir` */

insert  into `supir`(`id_supir`,`username`,`email`,`password`,`created_at`) values (1,'Supardi','supardi@gspe.co.id','supardi',NULL),(2,'Jojo','jojo@gspe.co.id','jojo',NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id_user`,`username`,`email`,`password`,`created_at`) values (1,'admin','admin@gmail.com','admin','2018-03-01 09:28:56'),(2,'jourdan','jourdan@gmail.com','jourdan',NULL),(3,'ahmad','ahmad@gmail.com','ahmad',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
