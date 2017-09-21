-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.2.3-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for services_hero
CREATE DATABASE IF NOT EXISTS `services_hero` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `services_hero`;

-- Dumping structure for table services_hero.contact_us
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table services_hero.contact_us: ~0 rows (approximately)
/*!40000 ALTER TABLE `contact_us` DISABLE KEYS */;
INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `message`, `seen`) VALUES
	(1, 'hannan', 'nan_s96@yahoo.com', '105960585', 'asdfsd', 0);
/*!40000 ALTER TABLE `contact_us` ENABLE KEYS */;

-- Dumping structure for table services_hero.invoices
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `user_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date_process` varchar(255) DEFAULT NULL,
  `service_title` varchar(255) DEFAULT NULL,
  `service_price` varchar(255) DEFAULT NULL,
  `add_on_title` varchar(255) DEFAULT NULL,
  `add_on_price` float(10,2) DEFAULT NULL,
  `sub_total` float(10,2) DEFAULT NULL,
  `tax` float(10,2) DEFAULT NULL,
  `grand_total` float(10,2) DEFAULT NULL,
  `date_completed` datetime DEFAULT NULL,
  `comment` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_invoice_orders` (`order_id`),
  CONSTRAINT `FK_invoice_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table services_hero.invoices: ~3 rows (approximately)
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` (`id`, `order_id`, `user_name`, `phone`, `email`, `address`, `date_process`, `service_title`, `service_price`, `add_on_title`, `add_on_price`, `sub_total`, `tax`, `grand_total`, `date_completed`, `comment`) VALUES
	(4, 1, 'hannan yusop', '105960585', 'nan_s96@yahoo.com', 'jalan pandaruan<br>kpg pahlawan<br>MUKAH,98700,SARAWAK<br>MALAYSIA', '2017-09-18 22:59:28', 'HP REPAIR', '120.00', 'CUCI KOLAM', 1.00, 121.00, 2.50, 123.50, NULL, NULL),
	(5, 2, 'hannan yusop', '105960585', 'nan_s96@yahoo.com', 'jalan pandaruan<br>kpg pahlawan<br>MUKAH,98700,SARAWAK<br>MALAYSIA', '2017-09-19 20:11:44', 'PENGGALI KUBUR', '150.00', 'CUCI KRETA', 32.00, 182.00, 3.40, 185.40, NULL, NULL),
	(6, 1, 'hannan yusop', '105960585', 'nan_s96@yahoo.com', 'jalan pandaruan<br>kpg pahlawan<br>MUKAH,98700,SARAWAK<br>MALAYSIA', '2017-09-19 20:27:11', 'HP REPAIR', '120.00', 'CUCI KOLAM', 1.00, 121.00, 2.50, 123.50, NULL, NULL),
	(7, 1, 'hannan yusop', '105960585', 'nan_s96@yahoo.com', 'jalan pandaruan<br>kpg pahlawan<br>MUKAH,98700,SARAWAK<br>MALAYSIA', '2017-09-19 20:27:21', 'HP REPAIR', '120.00', 'CUCI KOLAM', 1.00, 121.00, 2.50, 123.50, NULL, NULL);
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;

-- Dumping structure for table services_hero.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `service_id` int(11) NOT NULL DEFAULT 0,
  `services_add_on_id` int(11) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `new_date` date DEFAULT NULL,
  `new_time` time DEFAULT NULL,
  `user_note` longtext DEFAULT NULL,
  `admin_note` longtext DEFAULT NULL,
  `grand_price` float(10,2) NOT NULL,
  `tax_price` float(10,2) DEFAULT 0.00,
  `status` int(11) NOT NULL DEFAULT 1,
  `completed_datetime` datetime DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `payment_attachment` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `rating_note` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_order_users` (`user_id`),
  KEY `FK_order_services` (`service_id`),
  KEY `FK_order_services_add_on` (`services_add_on_id`),
  CONSTRAINT `FK_order_services` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_order_services_add_on` FOREIGN KEY (`services_add_on_id`) REFERENCES `services_add_on` (`id`),
  CONSTRAINT `FK_order_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table services_hero.orders: ~2 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `user_id`, `service_id`, `services_add_on_id`, `date`, `time`, `new_date`, `new_time`, `user_note`, `admin_note`, `grand_price`, `tax_price`, `status`, `completed_datetime`, `payment`, `payment_attachment`, `rating`, `rating_note`) VALUES
	(1, 3, 2, 3, '2017-09-21', '13:00:00', NULL, NULL, '[po[po', NULL, 21.00, 2.50, 3, '2017-09-17 14:37:21', NULL, NULL, 4, 'Terbaik lah service abang  ni. cepat dan padat'),
	(2, 3, 3, 4, '2017-09-17', '14:58:48', NULL, NULL, 'trtdtd', 'Not valid/complete information', 21.00, 3.40, 4, NULL, NULL, NULL, 0, NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

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
	(1, 'REPAIR LEAKED ROOFTOP', '<p>Type of service:</p>\r\n\r\n<ul>\r\n	<li>repair leaked rooftop</li>\r\n	<li>change new rooftop</li>\r\n	<li>re-paint</li>\r\n	<li>others</li>\r\n</ul>\r\n\r\n<p>Whatapps : +60105960754</p>\r\n', 250.00, '10', '1'),
	(2, 'HP REPAIR', '<p><strong>OUR SERVICE:</strong></p>\r\n\r\n<ol>\r\n	<li>HP</li>\r\n	<li>LAPTOP</li>\r\n	<li>PC</li>\r\n</ol>\r\n\r\n<table border="1" cellpadding="1" cellspacing="1" style="width:500px">\r\n	<tbody>\r\n		<tr>\r\n			<td>Poblem</td>\r\n			<td>Price</td>\r\n		</tr>\r\n		<tr>\r\n			<td>LCD</td>\r\n			<td>RM140</td>\r\n		</tr>\r\n		<tr>\r\n			<td>BOARD</td>\r\n			<td>RM200</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n', 120.00, '10', '2'),
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

-- Dumping data for table services_hero.services_add_on: ~4 rows (approximately)
/*!40000 ALTER TABLE `services_add_on` DISABLE KEYS */;
INSERT INTO `services_add_on` (`id`, `service_id`, `title`, `price`, `kouta`, `status`) VALUES
	(1, 2, 'URUT', 10.00, NULL, 1),
	(2, 2, 'superuser', 100.00, NULL, 1),
	(3, 2, 'CUCI KOLAM', 1.00, NULL, 1),
	(4, 2, 'CUCI KRETA', 32.00, NULL, 1),
	(5, 2, 'Apa-apa lah', 2.50, NULL, 1);
/*!40000 ALTER TABLE `services_add_on` ENABLE KEYS */;

-- Dumping structure for table services_hero.service_images
CREATE TABLE IF NOT EXISTS `service_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `alt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_service_image_services` (`service_id`),
  CONSTRAINT `FK_service_image_services` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table services_hero.service_images: ~2 rows (approximately)
/*!40000 ALTER TABLE `service_images` DISABLE KEYS */;
INSERT INTO `service_images` (`id`, `service_id`, `image`, `alt`) VALUES
	(4, 1, '_03282016103611478_d5e4f548-4e5f-482c-98c3-72c61f111adc.jpg.jpeg', '1'),
	(5, 1, 'ohs_logo1.jpg.jpeg', '');
/*!40000 ALTER TABLE `service_images` ENABLE KEYS */;

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
  `delete_note` varchar(255) NOT NULL DEFAULT '1',
  `banned_notes` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `default` int(11) NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table services_hero.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `ic`, `address1`, `address2`, `city`, `postcode`, `states`, `country`, `status`, `delete_note`, `banned_notes`, `level`, `default`, `modified`, `created`) VALUES
	(2, 'admin', 'acc', 'test@gmail.com', '1', '0124387464', '4874239873', 'jalan 1', 'rumah 2', 'MUKAH', '98700', '0', 'MALAYSIA', '1', '1', '0', 'ADMIN', 1, '2017-09-16 22:16:44', '2017-09-15 09:14:23'),
	(3, 'hannan', 'yusop', 'nan_s96@yahoo.com', '1', '105960585', '960516135589', 'jalan pandaruan', 'kpg pahlawan', 'MUKAH', '98700', 'SARAWAK', 'MALAYSIA', '1', 'I don\'t want to use this service anymote', '0', 'USER', 0, '2017-09-17 14:01:26', '2017-09-16 02:48:45'),
	(11, 'ABDUL', 'HANNAN', 'hannanyusop@lynk.my', '1', '0105960586', NULL, 'LOT 89,ANGERIK 1', 'SAUJANA UTAMA 1', 'MUKAH', '47000', 'SARAWAK', 'MALAYSIA', '2', '1', NULL, 'USER', 0, '2017-09-17 03:41:04', '2017-09-16 23:29:31');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
