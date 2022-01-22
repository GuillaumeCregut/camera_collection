-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 22 jan. 2022 à 21:53
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `collection`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_appareil`
--

DROP TABLE IF EXISTS `t_appareil`;
CREATE TABLE IF NOT EXISTS `t_appareil` (
  `PK_APPAREIL` int NOT NULL AUTO_INCREMENT,
  `NOM_TAPP` varchar(30) NOT NULL,
  `DESC_APP` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`PK_APPAREIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_film`
--

DROP TABLE IF EXISTS `t_film`;
CREATE TABLE IF NOT EXISTS `t_film` (
  `PK_FILM` int NOT NULL AUTO_INCREMENT,
  `NOM_FILM` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`PK_FILM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_format`
--

DROP TABLE IF EXISTS `t_format`;
CREATE TABLE IF NOT EXISTS `t_format` (
  `PK_FORMAT` int NOT NULL AUTO_INCREMENT,
  `NOM_FORMAT` varchar(20) NOT NULL,
  PRIMARY KEY (`PK_FORMAT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_item`
--

DROP TABLE IF EXISTS `t_item`;
CREATE TABLE IF NOT EXISTS `t_item` (
  `REF_INV` varchar(15) NOT NULL,
  `FK_MARQUE` int NOT NULL,
  `FK_FILM` int NOT NULL,
  `FK_APP` int NOT NULL,
  `FK_MAT` int NOT NULL,
  `FK_OBTU` int NOT NULL,
  `FK_MONTURE` int NOT NULL,
  `FK_FORMAT` int NOT NULL,
  `FK_PERIODE` int NOT NULL,
  `ANNEE_PROD` date DEFAULT NULL,
  `PHOTOS` varchar(50) DEFAULT NULL,
  `NOM_ITEM` varchar(30) NOT NULL,
  `PRIX_ACHAT` int DEFAULT NULL,
  `ETAT` int DEFAULT NULL,
  `HIST_ITEM` varchar(50) NOT NULL,
  `NOTES_PERSO` varchar(50) NOT NULL,
  PRIMARY KEY (`REF_INV`),
  KEY `FK_APP_T_APP_idx` (`FK_APP`),
  KEY `FK_ITEM_MARQUE_IDX` (`FK_MARQUE`),
  KEY `FK_FILM_FILM_IDX` (`FK_FILM`),
  KEY `FK_MAT_MAT_IDX` (`FK_MAT`),
  KEY `FK_OBTU_OBTU_IDX` (`FK_OBTU`),
  KEY `FK_MONTURE_MONTURE_IDX` (`FK_MONTURE`),
  KEY `FK_PERIODE_PERIODE_IDX` (`FK_PERIODE`),
  KEY `FK_FORMAT_FORMAT_IDX` (`FK_FORMAT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_marque`
--

DROP TABLE IF EXISTS `t_marque`;
CREATE TABLE IF NOT EXISTS `t_marque` (
  `PK_MARQUE` int NOT NULL AUTO_INCREMENT,
  `FK_PAYS` int NOT NULL,
  `NOM_MARQUE` varchar(30) NOT NULL,
  `HIST_MARQUE` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`PK_MARQUE`),
  KEY `FK_PAYS_MARQUE` (`FK_PAYS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_materiel`
--

DROP TABLE IF EXISTS `t_materiel`;
CREATE TABLE IF NOT EXISTS `t_materiel` (
  `PK_TMAT` int NOT NULL AUTO_INCREMENT,
  `NOM_MAT` varchar(30) NOT NULL,
  PRIMARY KEY (`PK_TMAT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_monture`
--

DROP TABLE IF EXISTS `t_monture`;
CREATE TABLE IF NOT EXISTS `t_monture` (
  `PK_MONTURE` int NOT NULL AUTO_INCREMENT,
  `NOM_MONTURE` varchar(30) DEFAULT NULL,
  `DESC_MONTURE` varchar(50) NOT NULL,
  PRIMARY KEY (`PK_MONTURE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_obturateur`
--

DROP TABLE IF EXISTS `t_obturateur`;
CREATE TABLE IF NOT EXISTS `t_obturateur` (
  `PK_OBTU` int NOT NULL AUTO_INCREMENT,
  `NOM_OBTU` varchar(30) NOT NULL,
  `DESC_OBTU` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`PK_OBTU`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_pays`
--

DROP TABLE IF EXISTS `t_pays`;
CREATE TABLE IF NOT EXISTS `t_pays` (
  `PK_PAYS` int NOT NULL AUTO_INCREMENT,
  `NOM_PAYS` varchar(60) NOT NULL,
  PRIMARY KEY (`PK_PAYS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_periode`
--

DROP TABLE IF EXISTS `t_periode`;
CREATE TABLE IF NOT EXISTS `t_periode` (
  `PK_PERIODE` int NOT NULL AUTO_INCREMENT,
  `NOM_PERIODE` varchar(12) NOT NULL,
  PRIMARY KEY (`PK_PERIODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_item`
--
ALTER TABLE `t_item`
  ADD CONSTRAINT `FK_PK_APP` FOREIGN KEY (`FK_APP`) REFERENCES `t_appareil` (`PK_APPAREIL`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PK_FILM` FOREIGN KEY (`FK_FILM`) REFERENCES `t_film` (`PK_FILM`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PK_FORMAT` FOREIGN KEY (`FK_FORMAT`) REFERENCES `t_format` (`PK_FORMAT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PK_MARQUE` FOREIGN KEY (`FK_MARQUE`) REFERENCES `t_marque` (`PK_MARQUE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PK_MAT` FOREIGN KEY (`FK_MAT`) REFERENCES `t_materiel` (`PK_TMAT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PK_MONTURE` FOREIGN KEY (`FK_MONTURE`) REFERENCES `t_monture` (`PK_MONTURE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PK_OBTU` FOREIGN KEY (`FK_OBTU`) REFERENCES `t_obturateur` (`PK_OBTU`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PK_PERIODE` FOREIGN KEY (`FK_PERIODE`) REFERENCES `t_periode` (`PK_PERIODE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_marque`
--
ALTER TABLE `t_marque`
  ADD CONSTRAINT `FK_PAYS_MARQUE` FOREIGN KEY (`FK_PAYS`) REFERENCES `t_pays` (`PK_PAYS`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
