-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 10 avr. 2025 à 07:36
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `computek`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IMAGE` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`ID`, `LIBELLE`, `IMAGE`) VALUES
(1, 'Ordinateur Fixe & Portable', 'tour de bureau.jpg'),
(2, 'Cartes Graphiques', 'carte graphique.jpg'),
(3, 'Processeurs', 'processeur.png'),
(4, 'Disques Dur', 'disque dur.jpg'),
(5, 'Cartes mères', 'cartes meres.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_CATEGORIE` int NOT NULL,
  `MARQUE` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MODEL` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `DESCRIPTION` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IMAGE` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PRIX` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `I_FK_PRODUITS_CATEGORIE` (`ID_CATEGORIE`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`ID`, `ID_CATEGORIE`, `MARQUE`, `MODEL`, `DESCRIPTION`, `IMAGE`, `PRIX`) VALUES
(1, 3, 'AMD', 'Ryzen 7 9800X3D', '{\"Fabricant de CPU\":\"AMD\",\"Modèle du CPU\":\"Ryzen 7 9800X3D\",\"Vitesse du CPU\":\"5.2 GHz\",\"Socket du CPU\":\"Socket AM5\",\"Plateforme\":\"Windows 11\",\"Puissance\":\"120 Watts\",\"Total L3 Cache\":\"96 MB\"}', 'image/3/AMD Ryzen 7 9800X3D.png', 529.99),
(2, 3, 'AMD', 'Ryzen 7 7800X3D', '{\"Fabricant de CPU\":\"AMD\",\"Modèle du CPU\":\"Ryzen 7 7800X3D\",\"Vitesse du CPU\":\"5 GHz\",\"Socket du CPU\":\"Socket AM5\",\"Plateforme\":\"Windows 11\",\"Puissance\":\"120 Watts\",\"Total L3 Cache\":\"96 MB\"}', 'image/3/AMD Ryzen 7 7800X3D.png', 460.99),
(3, 5, 'MSI', 'B650 Gaming Plus Wifi', '{\"Socket\":\"AMD AM5\",\"Chipset\":\"AMD B650\",\"Format\":\"ATX\",\"Connectivité\":\"Wifi\",\"Format de mémoire\":\"4 X DIMM 288 pins\",\"Fréquences mémoires\":\"7200Mhz\",\"Type de mémoire\":\"DDR5\",\"USB\":\"8 ports\",\"Norme réseau\":\"2.5Gbps Gigabit Ethernet\"}', 'image/5/MSI B650 Gaming Plus Wifi.png', 199.99),
(4, 1, 'BE QUIET!', 'PC GAMER HIGH END SILENCIEUX | AMD Ryzen 7 7800X3D 8x4.20GHz | 32Go DDR5 | RX 7900 XT 20Go | 1To M.2 SSD', '{\"Processeur\":\"AMD Ryzen 7 7800X3D (8x 4.20GHz)\",\"Mémoire vive\":\"32GB DDR5 RAM 5600 MHz ADATA\",\"Carte graphique\":\"AMD Radeon RX 7900 XT - 20GB\",\"Carte mère\":\"GIGABYTE B650 Eagle AX WIFI\",\"Disque dur\":\"1000 GB M.2 SSD Western Digital WD Blue SN500\"}', 'image/1/pc gamer.png', 2015.80),
(5, 3, 'INTEL', 'Core i9 14900KF', '{\"Fabricant de CPU\":\"Intel\",\"Modèle du CPU\":\"Core i9 14900KF\",\"Vitesse du CPU\":\"5.8 GHz\",\"Socket du CPU\":\"Intel 1700\",\"Plateforme\":\"Windows 11\",\"TDP\":\"125 Watts\",\"Total L3 Cache\":\"36 MB\"}', 'image/3/INTEL Core i9 14900KF.png', 559.99),
(6, 3, 'INTEL', 'Core i7 14700KF', '{\"Fabricant de CPU\":\"Intel\",\"Modèle du CPU\":\"Core i7 14700KF\",\"Vitesse du CPU\":\"5.6 GHz\",\"Socket du CPU\":\"Intel 1700\",\"Plateforme\":\"Windows 11\",\"TDP\":\"125 Watts\",\"Total L3 Cache\":\"36 MB\"}', 'image/3/INTEL Core i7 14700KF.png', 384.00),
(7, 1, 'PC GAMER', 'HIGH END | Intel Core i9-14900KF 24x3.20GHz | 32Go DDR5 | RTX 5070 Ti 16Go DLSS 4 | 1To M.2 SSD', '{\"Processeur\":\"Intel Core i9-14900KF\",\"Mémoire vive\":\"32GB DDR5 RAM 5600 MHz ADATA\",\"Carte graphique\":\"NVIDIA GeForce RTX 5070 Ti - 16GB\",\"Carte mère\":\"GIGABYTE Z790 Eagle AX DDR5\",\"Disque dur\":\"1000 GB M.2 SSD WD Blue SN5000\"}', 'image/1/PC GAMER HIGH END  Intel Core i9-14900KF 24x3.20GHz  32Go DDR5  RTX 5070 Ti 16Go DLSS 4  1To M.2 SSD.png', 2237.65);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NOM` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PRENOM` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `EMAIL` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASSWORD` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ADMIN` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `EMAIL` (`EMAIL`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID`, `NOM`, `PRENOM`, `EMAIL`, `PASSWORD`, `ADMIN`) VALUES
(1, 'Ozier', 'Noann', 'n.ozier@lyceeclaudenougaro82300.onmicrosoft.com', '$2y$10$xjPoC47t9lACNBS4xn.77OdyOGC5N6LTEO9UHCmtIwm7dApiXQn6e', 1),
(2, 'Perrat', 'Célian', 'c.perrat@lyceeclaudenougaro82300.onmicrosoft.com', '$2y$10$IGZR0lgaKkUPjATuOA1LiO3uWhdgnUniohUDaCj8AS3heY/oUF.YK', 1),
(4, 'Toto', 'Tod', 'toto@toto.tod', '123', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`ID_CATEGORIE`) REFERENCES `categorie` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
