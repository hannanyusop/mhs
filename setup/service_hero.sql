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
  `datetime` datetime NOT NULL,
  `new_datetime` datetime NOT NULL,
  `user_note` longtext NOT NULL,
  `admin_note` longtext NOT NULL DEFAULT '0',
  `grand_price` float(10,2) NOT NULL DEFAULT 0.00,
  `tax_price` float(10,2) NOT NULL DEFAULT 0.00,
  `status` int(11) NOT NULL DEFAULT 0,
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
  `name` varchar(255) DEFAULT '0',
  `description` longtext DEFAULT '0',
  `basic_price` float(10,2) DEFAULT 0.00,
  `kouta` varchar(255) DEFAULT '0',
  `status` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table services_hero.services: ~1 rows (approximately)
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` (`id`, `name`, `description`, `basic_price`, `kouta`, `status`) VALUES
	(1, 'MAILD', 'LALAAL', 2.00, '1', '1');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;

-- Dumping structure for table services_hero.services_add_on
CREATE TABLE IF NOT EXISTS `services_add_on` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `name` varchar(255) DEFAULT '0',
  `price` float(10,2) DEFAULT 0.00,
  `kouta` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK__services` (`service_id`),
  CONSTRAINT `FK__services` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table services_hero.services_add_on: ~0 rows (approximately)
/*!40000 ALTER TABLE `services_add_on` DISABLE KEYS */;
/*!40000 ALTER TABLE `services_add_on` ENABLE KEYS */;

-- Dumping structure for table services_hero.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL DEFAULT '0',
  `last_name` varchar(255) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL DEFAULT '0',
  `ic` varchar(255) NOT NULL DEFAULT '0',
  `address1` varchar(255) NOT NULL DEFAULT '0',
  `address2` varchar(255) NOT NULL DEFAULT '0',
  `city` varchar(255) NOT NULL DEFAULT '0',
  `postcode` varchar(255) NOT NULL DEFAULT '0',
  `states` varchar(255) NOT NULL DEFAULT '0',
  `country` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '0',
  `banned_notes` varchar(255) NOT NULL DEFAULT '0',
  `level` varchar(255) NOT NULL DEFAULT '0',
  `default` int(11) NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table services_hero.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `ic`, `address1`, `address2`, `city`, `postcode`, `states`, `country`, `status`, `banned_notes`, `level`, `default`, `modified`, `created`) VALUES
	(2, 'admin', 'acc', 'test@gmail.com', '1', '0124387464', '4874239873', 'jalan 1', 'rumah 2', 'MUKAH', '98700', '0', 'MALAYSIA', '1', '0', 'ADMIN', 1, '2017-09-16 11:41:31', '2017-09-15 09:14:23'),
	(3, 'hannan', 'yusop', 'nan_s96@yahoo.com', '1', '105960585', '0', 'jalan pandaruan', '11', 'MUKAH', '98700', 'SARAWAK', 'MALAYSIA', '1', '0', 'USER', 0, '2017-09-16 11:54:56', '2017-09-16 02:48:45');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
