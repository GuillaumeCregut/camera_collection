-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 02 juin 2023 à 16:59
-- Version du serveur : 8.0.21
-- Version de PHP : 8.1.2

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_appareil`
--

INSERT INTO `t_appareil` (`PK_APPAREIL`, `NOM_TAPP`, `DESC_APP`) VALUES
(2, 'télémétriques - rangefinder', 'telemetriques-rangefinder'),
(3, 'reflex -  SLR', 'reflex-slr'),
(4, 'Biobjectifs - TLR', 'biobjectifs-tlr'),
(5, 'compact', 'compact'),
(6, 'Chambre  - view camera', 'chambre-viewcamera'),
(7, 'Box', 'box'),
(8, 'Detective', 'detective'),
(9, 'Folding', 'folding'),
(10, 'caméra', 'caméra'),
(11, 'Gadget', 'gadget'),
(12, 'Stéréo', 'stéréo'),
(13, 'jumelles', 'jumelles');

-- --------------------------------------------------------

--
-- Structure de la table `t_film`
--

DROP TABLE IF EXISTS `t_film`;
CREATE TABLE IF NOT EXISTS `t_film` (
  `PK_FILM` int NOT NULL AUTO_INCREMENT,
  `NOM_FILM` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`PK_FILM`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_film`
--

INSERT INTO `t_film` (`PK_FILM`, `NOM_FILM`) VALUES
(2, '120'),
(3, '127'),
(4, '126'),
(5, 'Plaque de verre'),
(6, 'Plan film'),
(7, '135'),
(8, '110'),
(9, '220'),
(10, '620'),
(11, 'Inconnu'),
(12, 'Film cinéma'),
(13, '616'),
(14, '116');

-- --------------------------------------------------------

--
-- Structure de la table `t_format`
--

DROP TABLE IF EXISTS `t_format`;
CREATE TABLE IF NOT EXISTS `t_format` (
  `PK_FORMAT` int NOT NULL AUTO_INCREMENT,
  `NOM_FORMAT` varchar(20) NOT NULL,
  PRIMARY KEY (`PK_FORMAT`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_format`
--

INSERT INTO `t_format` (`PK_FORMAT`, `NOM_FORMAT`) VALUES
(2, '24x36'),
(3, '4,5x6'),
(4, '6x6'),
(5, '6x7'),
(6, '6x9'),
(7, '9x12'),
(8, '4px5p'),
(9, '8px10p'),
(10, '5px7p'),
(11, 'Inconnu'),
(12, '1/4 plaque-plate'),
(13, '13x18'),
(14, '8mm cin'),
(15, '8x5,5cm'),
(16, 'bi : 6x6 6x9'),
(17, '10.4x4cm'),
(18, '2p1/4x4p1/4'),
(19, '6,5x4'),
(20, '8x15'),
(21, '13mmx17mm');

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

--
-- Déchargement des données de la table `t_item`
--

INSERT INTO `t_item` (`REF_INV`, `FK_MARQUE`, `FK_FILM`, `FK_APP`, `FK_MAT`, `FK_OBTU`, `FK_MONTURE`, `FK_FORMAT`, `FK_PERIODE`, `ANNEE_PROD`, `PHOTOS`, `NOM_ITEM`, `PRIX_ACHAT`, `ETAT`, `HIST_ITEM`, `NOTES_PERSO`) VALUES
('0401002030015', 6, 7, 3, 3, 4, 2, 2, 12, '1979-01-01', '3;nikon/em/em-', 'EM', 0, 3, 'emH', 'emN'),
('0406002010017', 6, 7, 3, 3, 4, 2, 2, 12, '1983-01-01', '1;nikon/fm2/fm2-', 'FM2', 350, 2, 'fm2H', 'fm2N'),
('0504002060016', 6, 7, 3, 3, 4, 2, 2, 13, '1996-01-01', '2;nikon/f5/f5-', 'F5', 900, 2, 'f5H', 'f5N'),
('0506002060018', 18, 2, 3, 3, 14, 23, 3, 13, '1988-01-01', '2;bronica/etrsi/etrsi-', 'ETRSI', 0, 2, 'etrsiH', 'etrsiN'),
('0603003010020', 9, 7, 2, 3, 3, 9, 2, 10, '1956-01-01', '2;krasno/zorki4/z4-', 'Zorki 4', 60, 2, 'zorki4H', 'zorki4N'),
('0604005020001', 12, 7, 5, 3, 6, 3, 2, 10, '1963-01-01', '1;kodak/retinette1a/retinette1a-', 'Retinette 1A', 0, 3, 'retinette1aH', 'retinette1aN'),
('0605003010009', 9, 7, 2, 3, 3, 9, 2, 9, '1949-01-01', '4;krasno/zorki1/zorki1-', 'Zorki 1', 0, 3, 'zorki1H', 'zorki1N'),
('0701002030005', 11, 7, 3, 3, 3, 16, 2, 11, '1968-01-01', '3;wirgin/edixa/edixa-', 'Edixa Prismat LTL', 0, 3, 'edixaprismatltlH', 'edixaprismatltlN'),
('0701003030004', 7, 7, 2, 3, 7, 15, 2, 10, '1965-01-01', '3;canon/canonet19/ql19-', 'Canonet QL 19', 0, 2, 'canonetql19H', 'canonetql19N'),
('0701003030010', 15, 7, 2, 3, 4, 20, 2, 7, '1936-01-01', '3;zeiss/contax2/contax2-', 'Contax II', 0, 3, 'contaxiiH', 'contaxiiN'),
('0701005030002', 10, 7, 5, 3, 9, 14, 2, 9, '1957-01-01', '4;foca/focasport1c/focasport1c-', 'Focasport 1C', 0, 3, 'focasport1cH', 'focasport1cN'),
('0701008030003', 15, 2, 9, 3, 6, 5, 3, 8, '1938-01-01', '1;zeiss/ikonta521/ikonta521-', 'Ikonta 521 A', 0, 2, 'ikonta521aH', 'ikonta521aN'),
('0706001040014', 14, 5, 6, 3, 13, 4, 13, 15, '1900-01-01', '3;chambre/chambre14/chambre-', 'chambre voyage', 80, 4, 'chambrevoyageH', 'chambrevoyageN'),
('0706004020006', 13, 2, 7, 3, 8, 19, 6, 9, '1950-01-01', '2;goldstein/sporting/sporting-', 'Sporting', 7, 2, 'sportingH', 'sportingN'),
('0706008020011', 15, 2, 9, 3, 10, 5, 6, 7, '1929-01-01', '4;zeiss/ikonta520/ikonta520-', 'Ikonta 520-2', 17, 3, 'ikonta520-2H', 'ikonta520-2N'),
('0707003030007', 10, 7, 2, 3, 9, 17, 2, 10, '1962-01-01', '4;foca/focasport2f/foca2F-', 'Focasport 2F', 0, 2, 'focasport2fH', 'focasport2fN'),
('0707004020008', 12, 10, 7, 3, 8, 19, 4, 9, '1955-01-01', '4;kodak/brownie/brownie-', 'Brownie Flash', 3, 2, 'brownieflashH', 'brownieflashN'),
('0708008020012', 17, 10, 9, 3, 11, 21, 6, 9, '1950-01-01', '3;kinax/major/major-', 'Major', 5, 2, 'majorH', 'majorN'),
('0709005020021', 19, 7, 5, 3, 15, 10, 2, 9, '1953-01-01', '3;agfa/silette/silette-', 'Silette', 30, 3, 'siletteH', 'siletteN'),
('0709008010013', 16, 5, 6, 3, 12, 22, 7, 6, '1914-01-01', '4;voigtlander/avus/avus-', 'Avus', 45, 3, 'avusH', 'avusN'),
('0711001040023', 14, 5, 6, 3, 17, 8, 12, 15, '1900-01-01', '3;chambre/8x11/8x11-', 'Chambre 8x11', 10, 4, 'chambre8x11H', 'chambre8x11N'),
('0711008040022', 12, 3, 9, 3, 16, 11, 3, 5, '1915-01-01', '3;kodak/vp/vest-', 'Vest Pocket Autographic', 25, 2, 'vestpocketautographicH', 'vestpocketautographicN'),
('0712007010026', 20, 5, 8, 3, 8, 4, 7, 15, '1900-01-01', '2;clemgilm/omega2b/omega-', 'Omega 2 bis', 16, 4, 'omega2bisH', 'omega2bisN'),
('0712008030024', 14, 5, 9, 3, 8, 12, 7, 15, '1920-01-01', '3;folding/fr/fold_fr-', 'Folding inconnu', 0, 3, 'foldinginconnuH', 'foldinginconnuN'),
('0712008030025', 12, 14, 9, 3, 16, 11, 18, 6, '1914-01-01', '0;kodak/n1AJr/n1AJr-', 'N 1A Autographic Jr', 0, 4, 'n1aautographicjrH', 'n1aautographicjrN'),
('0801001010028', 21, 5, 6, 3, 24, 11, 8, 4, '1900-01-01', '0;century/petite2-', 'Petite N2', 56, 5, 'petiten2H', 'petiten2N'),
('0801001010029', 22, 5, 6, 3, 19, 4, 10, 4, '1900-01-01', '0;rochester/premo/premo-', 'Premo SR', 77, 4, 'premosrH', 'premosrN'),
('0801008020027', 16, 2, 9, 3, 8, 24, 6, 7, '1931-01-01', '3;voigtlander/jubilar/jubilar-', 'Jubilar', 10, 2, 'jubilarH', 'jubilarN'),
('0802005030030', 10, 7, 5, 3, 9, 14, 2, 9, '1955-01-01', '3;foca/focasport/foca-', 'Focasport', 0, 2, 'focasportH', 'focasportN'),
('0803001040031', 25, 5, 6, 3, 21, 18, 10, 4, '1900-01-01', '3;schering/peltak/peltak-', 'Peltak', 230, 2, 'peltakH', 'peltakN'),
('0803001040032', 23, 5, 6, 3, 17, 7, 12, 4, '1902-01-01', '5;sanderson/regular-', 'Modele Regular', 230, 3, 'modeleregularH', 'modeleregularN'),
('0803008040033', 14, 6, 9, 3, 22, 25, 15, 15, '1900-01-01', '4;folding/bl/foldbl-', 'Folding inconnu 2', 3, 4, 'foldinginconnu2H', 'foldinginconnu2N'),
('0803009030034', 26, 7, 11, 3, 8, 4, 2, 13, '1993-01-01', '3;blanche_p/sports35-', 'Sports 35', 0, 1, 'sports35H', 'sports35N'),
('0804004030035', 35, 3, 7, 3, 8, 27, 19, 9, '1948-01-01', '2;ferrania/rondine/ron-', 'Rondine', 0, 2, 'rondineH', 'rondineN'),
('0804008030036', 12, 2, 9, 3, 25, 4, 6, 6, '1922-01-01', '2;kodak/n1pocket/n1-', 'N1 pocket serie 2', 0, 4, 'n1pocketserie2H', 'n1pocketserie2N'),
('0804010030037', 24, 12, 10, 7, 8, 13, 14, 9, '1956-01-01', '1;paillard/bolexH8/H8-', 'Bolex H8', 0, 2, 'bolexh8H', 'bolexh8N'),
('0805001040041', 14, 5, 6, 3, 8, 4, 12, 15, '1900-01-01', '2;chambreGC/chambre-', 'Chambre inconnue 1', 20, 5, 'chambreinconnue1H', 'chambreinconnue1N'),
('0805004020038', 27, 2, 7, 3, 8, 4, 6, 8, '1934-01-01', '2;lumiere/scoutbox/scout-', 'ScoutBox', 7, 2, 'scoutboxH', 'scoutboxN'),
('0805008020039', 12, 13, 9, 3, 8, 4, 6, 7, '1934-01-01', '3;kodak/six16/616-', 'Six 16', 23, 2, 'six16H', 'six16N'),
('0806001010042', 14, 5, 6, 3, 26, 28, 12, 15, '1900-01-01', '0;chambre/chambre42/42-', 'Chambre Voyage 3', 38, 4, 'chmabrevoyage3H', 'chmabrevoyage3N'),
('0806001040040', 14, 5, 6, 3, 13, 4, 13, 15, '1900-01-01', '2;chambre/chambre40/chambre-', 'Chambre voyage 2', 125, 3, 'chambrevoyage2H', 'chambrevoyage2N'),
('0806003020044', 29, 7, 2, 3, 29, 30, 2, 10, '1966-01-01', '3;yashica/electro35/el-', 'Electro 35', 5, 3, 'electro35H', 'electro35N'),
('0806005020045', 30, 2, 5, 3, 8, 4, 11, 9, '1955-01-01', '2;bauchet/mosquito2/mos2-', 'Mosquito II', 4, 2, 'mosquitoiiH', 'mosquitoiiN'),
('0806008020043', 28, 2, 9, 3, 27, 29, 4, 8, '1940-01-01', '4;ansco/speedex/b2-', 'B2 Speedex', 5, 3, 'b2speedexH', 'b2speedexN'),
('0807005010046', 31, 7, 5, 3, 8, 4, 2, 12, '1981-01-01', '4;minox/gt35/gt35-', 'Minox 35 GT', 20, 2, 'minox35gtH', 'minox35gtN'),
('0807005010047', 32, 7, 5, 3, 8, 4, 2, 12, '1980-01-01', '4;kiev/35a/35a-', 'Kiev 35A', 50, 2, 'kiev35aH', 'kiev35aN'),
('0808001010049', 12, 5, 6, 3, 8, 4, 10, 6, '1937-01-01', '2;kodak/2D/2D-', '2D', 100, 4, '2dH', '2dN'),
('0808001030048', 34, 5, 6, 3, 23, 4, 8, 4, '1900-01-01', '2;manhattan/wizard/wizard-', 'Cycle Wizard A', 0, 4, 'cyclewizardaH', 'cyclewizardaN'),
('0809011020050', 33, 5, 12, 3, 8, 4, 17, 5, '1905-01-01', '4;richard/glypho/glypho-', 'Glyphoscope', 30, 3, 'glyphoscopeH', 'glyphoscopeN'),
('0810008020051', 12, 10, 9, 3, 8, 4, 16, 9, '1955-01-01', '4;kodak/B11/B11-', 'Modele B11', 15, 2, 'moleb11H', 'moleb11N'),
('0811004040052', 15, 2, 7, 3, 8, 26, 6, 7, '1934-01-01', '0;zeiss/tangor/tangor-', 'Box Tangor', 5, 3, 'boxtangorH', 'boxtangorN'),
('0811004040053', 15, 5, 9, 3, 10, 5, 7, 6, '1927-01-01', '0;zeiss/taxo/taxo-', 'Taxo', 8, 2, 'taxoH', 'taxoN'),
('0903001040054', 14, 5, 6, 3, 30, 4, 11, 2, '1880-01-01', '0;chambre/collodion1-', 'Chambre collodion', 300, 4, 'chambrecollodionH', 'chambrecollodionN'),
('0903001040055', 36, 5, 6, 3, 4, 4, 13, 4, '1900-01-01', '0;wunsche/favorit/favorit-', 'Favorit', 75, 4, 'favoritH', 'favoritN'),
('0906001040057', 38, 5, 6, 3, 32, 4, 20, 6, '1927-01-01', '0;inconnu/mondia/mondia-', 'Mondia', 50, 4, 'mondiaH', 'mondiaN'),
('0906012040056', 37, 5, 13, 3, 31, 4, 6, 4, '1898-01-01', '0;gaumont/spidoII/spido-', 'Spido Modele 2', 30, 4, 'spidomodele2H', 'spidomodele2N'),
('09110080459', 12, 7, 9, 3, 33, 32, 2, 9, '1951-01-01', '0;kodak/retina1a/', 'Retina 1a', 10, 4, 'retina1aH', 'retina1aN'),
('1001001040061', 14, 5, 6, 3, 34, 34, 13, 4, '1900-01-01', '2;chambre/chambrebi/chambrebi-', 'chambre bi objectif', 100, 4, 'chambrebiobjectifH', 'chambrebiobjectifN'),
('1001005030060', 19, 8, 5, 3, 27, 9, 21, 11, '1974-01-01', '0;agfa/agfamatic1000', 'agfamatic pocket  1000', 0, 3, 'agfamaticpocket1000H', 'agfamaticpocket1000N');

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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_marque`
--

INSERT INTO `t_marque` (`PK_MARQUE`, `FK_PAYS`, `NOM_MARQUE`, `HIST_MARQUE`) VALUES
(6, 6, 'Nikon', 'nikon'),
(7, 6, 'Canon', 'canon'),
(9, 7, 'Krasnogorsk', 'krasnogorsk'),
(10, 2, 'O.P.L. FOCA', 'o.p.l.foca'),
(11, 3, 'Wirgin', 'wirgin'),
(12, 5, 'Kodak', 'kodak'),
(13, 2, 'Goldstein', 'goldstein'),
(14, 8, 'Inconnue-Unknown', 'inconnue-unknown'),
(15, 3, 'Zeiss-Ikon', 'zeiss-ikon'),
(16, 3, 'Voigtlander', 'voigtlander'),
(17, 2, 'Kinax', 'kinax'),
(18, 6, 'Bronica', 'bronica'),
(19, 3, 'Agfa', 'agfa'),
(20, 2, 'Clement et Gilmer', 'clementetgilmer'),
(21, 5, 'Century', 'century'),
(22, 5, 'Rochester Optic Co', 'rochesteropticco'),
(23, 4, 'Houghton-Sanderson', 'houghton-sanderson'),
(24, 10, 'Paillard', 'paillard'),
(25, 3, 'Schering', 'schering'),
(26, 2, 'Blanche porte', 'blancheporte'),
(27, 2, 'Lumière', 'lumière'),
(28, 5, 'Ansco', 'ansco'),
(29, 6, 'Yashica', 'yashica'),
(30, 2, 'Bauchet', 'bauchet'),
(31, 3, 'Minox', 'minox'),
(32, 7, 'Kiev', 'kiev'),
(33, 2, 'Jules Richard', 'julesrichard'),
(34, 5, 'Manhattan Opt. Co.', 'manhattanopt.co.'),
(35, 9, 'Ferrania', 'ferrania'),
(36, 3, 'Wunsche', 'wunsche'),
(37, 2, 'Gaumont', 'gaumont'),
(38, 2, 'Lorillon', 'lorillon');

-- --------------------------------------------------------

--
-- Structure de la table `t_materiel`
--

DROP TABLE IF EXISTS `t_materiel`;
CREATE TABLE IF NOT EXISTS `t_materiel` (
  `PK_TMAT` int NOT NULL AUTO_INCREMENT,
  `NOM_MAT` varchar(30) NOT NULL,
  PRIMARY KEY (`PK_TMAT`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_materiel`
--

INSERT INTO `t_materiel` (`PK_TMAT`, `NOM_MAT`) VALUES
(2, 'Agrandisseur-Enlarger'),
(3, 'Appareil photo - camera'),
(4, 'Cellule - Lightmeter'),
(5, 'télémètre - rangefinder'),
(6, 'Autre - other'),
(7, 'caméra ciné');

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_monture`
--

INSERT INTO `t_monture` (`PK_MONTURE`, `NOM_MONTURE`, `DESC_MONTURE`) VALUES
(2, 'Nikon F', 'nikonf'),
(3, 'Reomar 45mm', 'reomar45mm'),
(4, 'Inconnu-Unknown', 'inconnu-unknown'),
(5, 'Novar Anastigmat', 'novaranastigmat'),
(7, 'Dagor anastigmat', 'dagoranastigmat'),
(8, 'B&L Rapid Rectilinear', 'b&lrapidrectilinear'),
(9, '39 à vis T', '39 a vis'),
(10, 'Apotar', 'apotar'),
(11, 'Rapid Rectilinear', 'rapidrectilinear'),
(12, 'Trylor', 'trylor'),
(13, 'Tourelle', 'tourelle'),
(14, 'Foca-Néoplar', 'foca-néoplar'),
(15, 'Canon 45mm', 'canon45mm'),
(16, '42mm Pentax', '42mmpentax'),
(17, 'Neoplex', 'neoplex'),
(18, 'Héliostigmat', 'héliostigmat'),
(19, 'Ménisque', 'ménisque'),
(20, 'Baionnette contax', 'baionnettecontax'),
(21, 'Kinn', 'kinn'),
(22, 'Skopar Anastigmat', 'skoparanastigmat'),
(23, 'Bronica ETR', 'bronicaetr'),
(24, 'Voigtar Anastigmat', 'voigtaranastigmat'),
(25, 'Periskop', 'periskop'),
(26, 'Goerz Frontar', 'goerzfrontar'),
(27, 'Linear', 'linear'),
(28, 'Derojy', 'derojy'),
(29, 'Ansco Anastigmat', 'anscoanastigmat'),
(30, 'Yashinon DX', 'yashinondx'),
(32, 'Retina Xenar', 'retinaxenar'),
(33, 'Agfa color  Agnar', 'agfacoloragnar'),
(34, 'Stigmatic N2 Dallmeyer', 'stigmaticn2dallmeyer'),
(35, 'Optische Institut Doppel', 'optischeinstitutdoppel');

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_obturateur`
--

INSERT INTO `t_obturateur` (`PK_OBTU`, `NOM_OBTU`, `DESC_OBTU`) VALUES
(3, 'a rideau H-focal plane H', 'arideauh-focalplaneh'),
(4, 'a rideau V-focal plane V', 'arideauv-focalplanev'),
(6, 'Prontor 300S', 'prontor300s'),
(7, 'Copal SV', 'copalsv'),
(8, 'Inconnu-Unknown', 'inconnu-unknown'),
(9, 'Atos II', 'atosii'),
(10, 'Derval', 'derval'),
(11, 'IPO', 'ipo'),
(12, 'Compur', 'compur'),
(13, 'Thornton-Pickard', 'thornton-pickard'),
(14, 'Sur objectif - On Lens', 'surobjectif-onlens'),
(15, 'Pronto', 'pronto'),
(16, 'E.K.C Ball Bearing', 'e.k.cballbearing'),
(17, 'Unicum', 'unicum'),
(18, 'Vario', 'vario'),
(19, 'Victor', 'victor'),
(21, 'Helios', 'helios'),
(22, 'Ultex', 'ultex'),
(23, 'Manhattan', 'manhattan'),
(24, 'C.C.C', 'c.c.c'),
(25, 'Kodex', 'kodex'),
(26, 'G. Jousset', 'g.jousset'),
(27, 'Inconnu-Central', 'inconnu-central'),
(29, 'Copal Elec', 'copalelec'),
(30, 'Aucun', 'aucun'),
(31, 'Decaux L.G ', 'decauxl.g'),
(32, 'Klopcic', 'klopcic'),
(33, 'Synchro Compur', 'synchrocompur'),
(34, 'Guerry volet', 'guerryvolet');

-- --------------------------------------------------------

--
-- Structure de la table `t_pays`
--

DROP TABLE IF EXISTS `t_pays`;
CREATE TABLE IF NOT EXISTS `t_pays` (
  `PK_PAYS` int NOT NULL AUTO_INCREMENT,
  `NOM_PAYS` varchar(60) NOT NULL,
  PRIMARY KEY (`PK_PAYS`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_pays`
--

INSERT INTO `t_pays` (`PK_PAYS`, `NOM_PAYS`) VALUES
(2, 'France'),
(3, 'Allemagne'),
(4, 'Angleterre'),
(5, 'U.S.A'),
(6, 'Japon'),
(7, 'U.R.S.S'),
(8, 'Inconnu-Unknown'),
(9, 'Italie'),
(10, 'Suisse');

-- --------------------------------------------------------

--
-- Structure de la table `t_periode`
--

DROP TABLE IF EXISTS `t_periode`;
CREATE TABLE IF NOT EXISTS `t_periode` (
  `PK_PERIODE` int NOT NULL AUTO_INCREMENT,
  `NOM_PERIODE` varchar(12) NOT NULL,
  PRIMARY KEY (`PK_PERIODE`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_periode`
--

INSERT INTO `t_periode` (`PK_PERIODE`, `NOM_PERIODE`) VALUES
(2, '1880-1890'),
(3, '1890-1900'),
(4, '1900-1910'),
(5, '1910-1920'),
(6, '1920-1930'),
(7, '1930-1940'),
(8, '1940-1950'),
(9, '1950-1960'),
(10, '1960-1970'),
(11, '1970-1980'),
(12, '1980-1990'),
(13, '2000-2010'),
(14, '2000-2010'),
(15, 'Inconnue'),
(16, '1820-1830'),
(17, '1830-1840'),
(18, '1840-1850'),
(19, '1850-1860'),
(20, '1860-1870'),
(21, '1870-1880'),
(22, '1810-1820');

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
