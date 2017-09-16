-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.2.3-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for services_hero
CREATE DATABASE IF NOT EXISTS `services_hero` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `services_hero`;

-- Dumping structure for table services_hero.order
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `service_id` int(11) NOT NULL DEFAULT 0,
  `services_add_on_id` int(11) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `new_date` date NOT NULL,
  `new_time` time NOT NULL,
  `user_note` longtext NOT NULL,
  `admin_note` longtext NOT NULL,
  `grand_price` float(10,2) NOT NULL,
  `tax_price` float(10,2) NOT NULL,
  `status` int(11) NOT NULL,
  `completed_datetime` datetime NOT NULL,
  `payment` varchar(255) NOT NULL,
  `payment_attachment` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_order_users` (`user_id`),
  KEY `FK_order_services` (`service_id`),
  KEY `FK_order_services_add_on` (`services_add_on_id`),
  CONSTRAINT `FK_order_services` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_order_services_add_on` FOREIGN KEY (`services_add_on_id`) REFERENCES `services_add_on` (`id`),
  CONSTRAINT `FK_order_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table services_hero.order: ~0 rows (approximately)
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;

-- Dumping structure for table services_hero.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '0',
  `description` longtext DEFAULT '0',
  `basic_price` float(10,2) DEFAULT 0.00,
  `qouta` varchar(255) DEFAULT '0',
  `status` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table services_hero.services: ~4 rows (approximately)
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` (`id`, `title`, `description`, `basic_price`, `qouta`, `status`) VALUES
	(1, 'MAID SEPARUH MASA', '<p><strong>Hannan adalah:</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Macho</strong></li>\r\n	<li><strong>Kacak</strong></li>\r\n	<li><strong>handal</strong></li>\r\n	<li>ramai peminat</li>\r\n	<li>&nbsp;</li>\r\n</ul>\r\n', 250.00, '10', '1'),
	(2, 'HP REPAIR', 'APA AJA', 120.00, '10', '1'),
	(3, 'PENGGALI KUBUR', '-Taat menggali kubur', 150.00, '1', '1'),
	(4, 'TUKANG MASAK', '-masakan kampung ala-alalalal', 10.00, '10', '1');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;

-- Dumping structure for table services_hero.services_add_on
CREATE TABLE IF NOT EXISTS `services_add_on` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `title` varchar(255) DEFAULT '0',
  `price` float(10,2) DEFAULT 0.00,
  `kouta` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK__services` (`service_id`),
  CONSTRAINT `FK__services` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table services_hero.services_add_on: ~5 rows (approximately)
/*!40000 ALTER TABLE `services_add_on` DISABLE KEYS */;
INSERT INTO `services_add_on` (`id`, `service_id`, `title`, `price`, `kouta`, `status`) VALUES
	(1, 2, 'URUT', 10.00, NULL, 1),
	(2, 2, 'superuser', 100.00, NULL, 1),
	(3, 2, '2', 1.00, NULL, 1),
	(4, 2, 'CUCI KRETA', 32.00, NULL, 1),
	(5, 2, 'Apa-apa lah', 2.50, NULL, 1);
/*!40000 ALTER TABLE `services_add_on` ENABLE KEYS */;

-- Dumping structure for table services_hero.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `ic` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `states` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `banned_notes` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `default` int(11) NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table services_hero.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `ic`, `address1`, `address2`, `city`, `postcode`, `states`, `country`, `status`, `banned_notes`, `level`, `default`, `modified`, `created`) VALUES
	(2, 'admin', 'acc', 'test@gmail.com', '1', '0124387464', '4874239873', 'jalan 1', 'rumah 2', 'MUKAH', '98700', '0', 'MALAYSIA', '1', '0', 'ADMIN', 1, '2017-09-16 22:16:44', '2017-09-15 09:14:23'),
	(3, 'hannan', 'yusop', 'nan_s96@yahoo.com', '1', '105960585', '0', 'jalan pandaruan', '11', 'MUKAH', '98700', 'SARAWAK', 'MALAYSIA', '1', '0', 'USER', 0, '2017-09-16 11:54:56', '2017-09-16 02:48:45'),
	(11, NULL, NULL, 'hannanyusop@lynk.my', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 'USER', 0, '2017-09-16 23:29:31', '2017-09-16 23:29:31');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
