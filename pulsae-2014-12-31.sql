-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table pulsae.card
CREATE TABLE IF NOT EXISTS `card` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_number` int(11) DEFAULT NULL,
  `car_picture` varchar(128) DEFAULT NULL,
  `pro_id` int(11) NOT NULL,
  `tra_id` int(11) DEFAULT NULL,
  `car_datecreate` date NOT NULL,
  `car_pricep` int(11) DEFAULT NULL,
  `car_prices` int(11) DEFAULT NULL,
  `car_status` int(11) NOT NULL,
  `car_note` text,
  PRIMARY KEY (`car_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table pulsae.card: 0 rows
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
/*!40000 ALTER TABLE `card` ENABLE KEYS */;


-- Dumping structure for table pulsae.product
CREATE TABLE IF NOT EXISTS `product` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(64) NOT NULL,
  `pro_category` varchar(64) NOT NULL,
  `pro_picture` varchar(128) DEFAULT NULL,
  `pro_qty` int(11) NOT NULL DEFAULT '0',
  `pro_price` int(11) NOT NULL,
  `pro_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table pulsae.product: 0 rows
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;


-- Dumping structure for table pulsae.transaction
CREATE TABLE IF NOT EXISTS `transaction` (
  `tra_id` int(11) NOT NULL AUTO_INCREMENT,
  `tra_datecreate` datetime NOT NULL,
  `tra_format` varchar(256) NOT NULL,
  `tra_total` int(11) NOT NULL,
  `tra_customer` text,
  `tra_status` varchar(2) NOT NULL DEFAULT 'CF' COMMENT 'CF=Confirm|PC=Processed|CN=Canceled|PD=Pending',
  PRIMARY KEY (`tra_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table pulsae.transaction: 0 rows
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
