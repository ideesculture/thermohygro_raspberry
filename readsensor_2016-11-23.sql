# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: 127.0.0.1 (MySQL 5.5.5-10.1.18-MariaDB)
# Base de données: readsensor
# Temps de génération: 2016-11-23 21:05:57 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table hygrometry
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hygrometry`;

CREATE TABLE `hygrometry` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `station` int(11) DEFAULT NULL,
  `value` double DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `hygrometry` WRITE;
/*!40000 ALTER TABLE `hygrometry` DISABLE KEYS */;

INSERT INTO `hygrometry` (`id`, `station`, `value`, `datetime`)
VALUES
	(1,1,57.54,NULL),
	(2,1,57.6,NULL);

/*!40000 ALTER TABLE `hygrometry` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table temperature
# ------------------------------------------------------------

DROP TABLE IF EXISTS `temperature`;

CREATE TABLE `temperature` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `station` int(11) DEFAULT NULL,
  `value` double DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `temperature` WRITE;
/*!40000 ALTER TABLE `temperature` DISABLE KEYS */;

INSERT INTO `temperature` (`id`, `station`, `value`, `datetime`)
VALUES
	(1,1,22,NULL),
	(2,1,21.71,NULL),
	(3,1,21.69,NULL);

/*!40000 ALTER TABLE `temperature` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
