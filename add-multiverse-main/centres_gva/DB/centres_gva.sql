# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.33)
# Database: centres_gva
# Generation Time: 2022-10-24 09:55:36 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table centre
# ------------------------------------------------------------

DROP TABLE IF EXISTS `centre`;

CREATE TABLE `centre` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `regim_id` int(11) unsigned NOT NULL,
  `provincia_id` int(11) unsigned NOT NULL,
  `codi` varchar(8) NOT NULL DEFAULT '',
  `centre` varchar(150) DEFAULT NULL,
  `direccio` varchar(200) DEFAULT NULL,
  `localitat` varchar(150) DEFAULT NULL,
  `telefon` varchar(12) DEFAULT NULL,
  `query` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codi` (`codi`),
  KEY `fk_regim_centre1_idx` (`regim_id`),
  KEY `fk_provincia_centre1_idx` (`provincia_id`),
  CONSTRAINT `fk_provincia_centre1` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_regim_centre1` FOREIGN KEY (`regim_id`) REFERENCES `regim` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `centre` WRITE;
/*!40000 ALTER TABLE `centre` DISABLE KEYS */;

INSERT INTO `centre` (`id`, `regim_id`, `provincia_id`, `codi`, `centre`, `direccio`, `localitat`, `telefon`, `query`)
VALUES
	(1,1,2,'46022099','IES PORÇONS','C. JULIÁN JUAN MOMPÓ, 3','46812 - AIELO DE MALFERIT','962919595','Institut+d\'Educació+Secundària+Ies+Porçons'),
	(2,1,2,'46000161','IES DOCTOR FAUSTÍ BARBERÁ','C. VICENTE LIS BARONA, S/N','46970 - ALAQUÀS','961206150','IES+Doctor+Faustí+Barberà'),
	(3,1,2,'46021290','IES CONSUELO ARANDA','Part. MISANA, S/N','46260 - ALBERIC','962457865','I.E.S+Consuelo+Aranda'),
	(4,1,2,'46016038','IES SALVADOR GADEA','Cm. DE LES ENCREULLADES, 4','46960 - ALDAIA','961206210','IES+Salvador+Gadea'),
	(5,1,2,'46001199','IES SANT VICENT FERRER','C. PARQUE SALVADOR CASTELL, 16','46680 - ALGEMESÍ','962457820','Institut+d\'Educació+Secundària+Sant+Vicent+Ferrer'),
	(6,1,2,'46015733','IES FERNANDO III','C. PINTOR PEDRO CAMARA, 19','46620 - AYORA','961892940','IES+Fernando+III'),
	(7,1,2,'46016312','IES ENRIC SOLER I GODES','Part. SISENA, S/N','46450 - BENIFAIÓ','961719085','IES+ENRIC+SOLER+I+GODES'),
	(8,1,2,'46002775','IES EDUARDO PRIMO MARQUÉS','C. CORBELLA, 141','46240 - CARLET','962980130','I.E.S.+Eduardo+Primo+Marqués'),
	(9,1,2,'46023250','IES MESTRE RAMÓN ESTEVE','C. CALVARIO, S/N','46196 - CATADAU','962980140','Instituto+Mestre+Ramon+Esteve'),
	(10,1,2,'46018761','CIPFP COMPLEJO EDUCATIVO DE CHESTE','Ctra. CV-378 - KM. 0,300,','46380 - CHESTE','962787530','CIPFP+de+Cheste'),
	(11,1,2,'46003408','IES BLASCO IBÁÑEZ','C. RAMIRO PEDRÓS FONT, 1','46400 - CULLERA','961719100','IES+Blasco+Ibáñez'),
	(12,1,2,'46004221','IES MARÍA ENRÍQUEZ','C. LITERATO AZORÍN, 1','46702 - GANDIA','962829430','IES+María+Enríquez'),
	(13,1,2,'46022543','IES LA VEREDA','C. ISABEL DE VILLENA, 1','46185 - LA POBLA DE VALLBONA','962718345','IES+La+Vereda'),
	(14,1,2,'46005132','IES JOSÉ RODRIGO BOTET','C. SANTOS JUSTO Y PASTOR, 70','46940 - MANISES','961206040','IES+José+Rodrigo+Botet'),
	(15,1,2,'46019660','CIPFP MISLATA','C. DOLORES IBARRURI, 32','46920 - MISLATA','961205925','CIPFP+Mislata'),
	(16,1,2,'46023924','IES ALCALANS','C. PESSET ALEIXANDRE, S/N','46192 - MONTSERRAT','962980145','IES+Alcalans+de+Montserrat(Valencia)'),
	(17,1,2,'46006100','IES L\'ESTACIÓ','Av. ESTACIÓN, S/N','46870 - ONTINYENT','962919375','IES+l\'Estació'),
	(18,1,2,'46017675','IES LA SÈNIA','C. ESCULTOR JOSÉ CAPUZ, 96','46200 - PAIPORTA','961205955','IES+La+Sénia'),
	(19,1,2,'46022622','IES HENRI MATISSE','C. ENRIC VALOR, S/N','46980 - PATERNA','961206280','IES+Henri+Matisse'),
	(20,1,2,'46007748','IES CAMP DE MORVEDRE','C. ABOGADO FAUSTO CARUANA, S/N','46520 - SAGUNT - EL PUERTO SAGUNTO','962617720','IES+Camp+de+Morvedre'),
	(21,1,2,'46007943','IES MANUEL SANCHIS GUARNER','C. CID CAMPEADOR, 2','46460 - SILLA','961206160','IES+Manuel+Sanchis+Guarner'),
	(22,1,2,'46008340','IES JAUME II EL JUST','C. CAMÍ DE LA DULA, 31','46760 - TAVERNES DE LA VALLDIGNA','962829995','IES+Jaume+II+el+Just'),
	(23,1,2,'46019015','IES SERRA PERENXISA','C. CORONA D\'ARAGÓ, 1','46900 - TORRENT','961206090','IES+Serra+Perenxisa'),
	(24,1,2,'46008972','IES MIGUEL BALLESTEROS VIANA','Av. VENTA DEL MORO, 1','46300 - UTIEL','962169255','IES+Miguel+Ballesteros+Viana'),
	(25,1,2,'46021711','CIPFP AUSIÀS MARCH','C. ÁNGEL DE VILLENA, S/N','46013 - VALÈNCIA','961205930','CIP+FP+Ausiàs+March+a+València'),
	(26,1,2,'46025040','IES ABASTOS','C. ALBERIQUE, 18','46008 - VALÈNCIA','961205875','I.E.S.+Abastos'),
	(27,1,2,'46022257','IES CONSELLERIA','C. MONESTIR DE POBLET, S/N','46015 - VALÈNCIA','961206100','IES+Conselleria'),
	(28,1,2,'46015290','IES EL GRAO','C. ESCALANTE, 9','46011 - VALÈNCIA','961206030','Institut+d\'Educació+Secundària+El+Grao'),
	(29,1,2,'46014224','IES FONT DE SANT LLUÍS','Av. HERMANOS MARISTAS, 25','46013 - VALÈNCIA','961206065','I.E.S.+Font+de+Sant+Lluís'),
	(30,1,2,'46012963','IES JUAN DE GARAY','C. JUAN DE GARAY, 25','46017 - VALÈNCIA','961206045','IES+Juan+de+Garay'),
	(31,1,2,'46022646','IES SERPIS','C. JOSÉ MARÍA HARO, 63','46022 - VALÈNCIA','961206105','IES+Serpis'),
	(32,1,2,'46018692','IES DOCTOR LLUÍS SIMARRO LACABRA','Av. DE LES CORTS VALENCIANES, S/N','46800 - XÀTIVA','962249080','IES+Doctor+Lluís+Simarro+Lacabra'),
	(33,1,2,'46025799','CENTRE ESPECÍFIC D\'EDUCACIÓ A DISTÀNCIA CEED','C. CASA DE LA MISERICORDIA, 34','46014 - VALÈNCIA','961206990','Centro+Específico+de+Educación+a+Distancia+de+la+Comunidad+Valenciana+-+CEEDCV');

/*!40000 ALTER TABLE `centre` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cicle
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cicle`;

CREATE TABLE `cicle` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codi` varchar(5) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `cicle` WRITE;
/*!40000 ALTER TABLE `cicle` DISABLE KEYS */;

INSERT INTO `cicle` (`id`, `codi`, `nom`)
VALUES
	(1,'SMX','SISTEMES MICROINFORMÀTICS I XARXES'),
	(2,'ASIX','ADMINISTRACIÓ DE SISTEMES INFORMÀTICS EN XARXA'),
	(3,'DAM','DESENVOLUPAMENT D\'APLICACIONS MULTIPLATAFORMA'),
	(4,'DAW','DESENVOLUPAMENT D\'APLICACIONS WEB');

/*!40000 ALTER TABLE `cicle` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cicle_centre
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cicle_centre`;

CREATE TABLE `cicle_centre` (
  `cicle_id` int(11) unsigned NOT NULL,
  `centre_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`cicle_id`,`centre_id`),
  KEY `fk_centre_cicle_centre1_idx` (`centre_id`),
  KEY `fk_cicle_cicle_centre1_idx` (`cicle_id`),
  CONSTRAINT `fk_centre_cicle_centre1` FOREIGN KEY (`centre_id`) REFERENCES `centre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cicle_cicle_centre1` FOREIGN KEY (`cicle_id`) REFERENCES `cicle` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `cicle_centre` WRITE;
/*!40000 ALTER TABLE `cicle_centre` DISABLE KEYS */;

INSERT INTO `cicle_centre` (`cicle_id`, `centre_id`)
VALUES
	(1,1),
	(1,2),
	(3,2),
	(1,3),
	(3,3),
	(1,4),
	(4,4),
	(1,5),
	(2,5),
	(3,5),
	(4,5),
	(1,6),
	(1,7),
	(2,7),
	(1,8),
	(3,8),
	(1,9),
	(4,9),
	(1,10),
	(2,10),
	(3,10),
	(4,10),
	(1,11),
	(1,12),
	(2,12),
	(3,12),
	(4,12),
	(1,13),
	(2,13),
	(3,13),
	(4,13),
	(1,14),
	(2,14),
	(4,14),
	(1,15),
	(2,15),
	(3,15),
	(4,15),
	(1,16),
	(1,17),
	(4,17),
	(1,18),
	(2,18),
	(3,18),
	(4,18),
	(1,19),
	(3,19),
	(1,20),
	(2,20),
	(3,20),
	(4,20),
	(1,21),
	(1,22),
	(2,22),
	(3,22),
	(4,22),
	(1,23),
	(2,23),
	(3,23),
	(4,23),
	(1,24),
	(1,25),
	(2,25),
	(4,25),
	(1,26),
	(2,26),
	(3,26),
	(4,26),
	(1,27),
	(2,27),
	(4,27),
	(1,28),
	(2,28),
	(3,28),
	(1,29),
	(2,29),
	(4,29),
	(1,30),
	(2,30),
	(4,30),
	(1,31),
	(2,31),
	(3,31),
	(4,31),
	(1,32),
	(2,32),
	(3,32),
	(4,32),
	(3,33),
	(4,33);

/*!40000 ALTER TABLE `cicle_centre` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table provincia
# ------------------------------------------------------------

DROP TABLE IF EXISTS `provincia`;

CREATE TABLE `provincia` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `provincia` WRITE;
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;

INSERT INTO `provincia` (`id`, `nom`)
VALUES
	(1,'Prov. de Castelló'),
	(2,'Prov. de València'),
	(3,'Prov. d\'Alacant'),
	(4,'Tota la Comunitat');

/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table regim
# ------------------------------------------------------------

DROP TABLE IF EXISTS `regim`;

CREATE TABLE `regim` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `regim` WRITE;
/*!40000 ALTER TABLE `regim` DISABLE KEYS */;

INSERT INTO `regim` (`id`, `nom`)
VALUES
	(1,'Públic'),
	(2,'Privat'),
	(3,'Tots');

/*!40000 ALTER TABLE `regim` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
