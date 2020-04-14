-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 14 avr. 2020 à 14:52
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ebayece`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `IdAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `E-mail` varchar(100) NOT NULL,
  `Pseudo` varchar(30) NOT NULL,
  `MotDePasse` varchar(30) NOT NULL,
  PRIMARY KEY (`IdAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`IdAdmin`, `E-mail`, `Pseudo`, `MotDePasse`) VALUES
(1, 'mathieu.dadoun@edu.ece.fr', 'Mat', 'mathieu'),
(2, 'nikola.todorovic200@gmail.com', 'Niko', 'nikola'),
(3, 'nikola.todorovic200@gmail.com', 'Niko', 'nikola'),
(4, 'jordan.kujundzic@edu.ece.com', 'Jord', 'jordan');

-- --------------------------------------------------------

--
-- Structure de la table `autoenchere`
--

DROP TABLE IF EXISTS `autoenchere`;
CREATE TABLE IF NOT EXISTS `autoenchere` (
  `IdVente` int(11) NOT NULL,
  `IdClient` int(11) NOT NULL,
  `PrixMax` int(6) NOT NULL,
  PRIMARY KEY (`IdVente`,`IdClient`),
  KEY `c9` (`IdClient`),
  KEY `c10` (`IdVente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `IdClient` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `E-mail` varchar(100) NOT NULL,
  `Pseudo` varchar(30) NOT NULL,
  `MotDePasse` varchar(30) NOT NULL,
  `Adresse` varchar(535) NOT NULL,
  `CodePostal` int(6) NOT NULL,
  `Ville` varchar(30) NOT NULL,
  `Pays` varchar(30) NOT NULL,
  `Telephone` varchar(10) NOT NULL,
  `Panier` varchar(30) DEFAULT NULL,
  `TypeCarte` enum('Visa','MasterCard','American Express','PayPal') NOT NULL,
  `NumCarte` varchar(16) NOT NULL,
  `NomCarte` varchar(20) NOT NULL,
  `DateExpCarte` varchar(7) NOT NULL,
  `CodeCarte` int(4) NOT NULL,
  `PorteMonnaie` int(6) NOT NULL,
  PRIMARY KEY (`IdClient`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`IdClient`, `Nom`, `Prenom`, `E-mail`, `Pseudo`, `MotDePasse`, `Adresse`, `CodePostal`, `Ville`, `Pays`, `Telephone`, `Panier`, `TypeCarte`, `NumCarte`, `NomCarte`, `DateExpCarte`, `CodeCarte`, `PorteMonnaie`) VALUES
(1, 'Simpson', 'Bart', 'bartsimpson@edu.ece.fr', 'bart', 'bart', '123 route de bart', 13009, 'Springfield', 'USA', '0625032528', NULL, 'Visa', '1234123412341234', 'Bart Simpson', '12/2020', 1234, 0),
(2, 'Simpson', 'Lisa', 'lisasimpson@edu.ece.fr', 'lisa', 'lisa', '123 route de bart', 13009, 'Springfield', 'USA', '0625032529', NULL, 'Visa', '3456345634563456', 'Lisa Simpson', '08/2020', 1414, 0),
(3, 'Simpson', 'Maggie', 'maggiesimpson@edu.ece.fr', 'mag', 'maggie', '123 route de bart', 13009, 'Springfield', 'USA', '0625032529', NULL, 'MasterCard', '1234567812345678', 'Maggie Simpson', '12/2022', 2341, 10000);

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `IdVente` int(11) NOT NULL,
  `IdClient` int(11) NOT NULL,
  `PrixActuel` int(6) NOT NULL,
  PRIMARY KEY (`IdVente`,`IdClient`),
  KEY `c8` (`IdClient`),
  KEY `c7` (`IdVente`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `IdVente` int(11) NOT NULL,
  `IdClient` int(11) NOT NULL,
  `IdVendeur` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Photo` varchar(500) NOT NULL,
  `Video` varchar(500) DEFAULT NULL,
  `Categorie` enum('Ferraille ou Trésor','Bon pour le Musée','Accessoir VIP') NOT NULL,
  `PrixDepart` int(5) NOT NULL,
  `PrixAchat` int(6) NOT NULL,
  `TypeAchat` enum('Immédiat','Enchère','Négociation') NOT NULL,
  PRIMARY KEY (`IdVente`,`IdClient`,`IdVendeur`),
  KEY `c5` (`IdClient`),
  KEY `c6` (`IdVendeur`),
  KEY `c4` (`IdVente`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `negociation`
--

DROP TABLE IF EXISTS `negociation`;
CREATE TABLE IF NOT EXISTS `negociation` (
  `IdVente` int(11) NOT NULL,
  `IdClient` int(11) NOT NULL,
  `NbNego` int(2) NOT NULL,
  `PrixNego` int(6) NOT NULL,
  PRIMARY KEY (`IdVente`,`IdClient`),
  KEY `c3` (`IdClient`),
  KEY `c2` (`IdVente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `IdVendeur` int(11) NOT NULL AUTO_INCREMENT,
  `E-mail` varchar(80) NOT NULL,
  `Pseudo` varchar(30) NOT NULL,
  `MotDePasse` varchar(30) NOT NULL,
  `Photo` varchar(535) NOT NULL,
  `ImageFond` varchar(30) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Pays` varchar(30) NOT NULL,
  `Telephone` varchar(10) NOT NULL,
  `PorteMonnaie` int(6) NOT NULL,
  PRIMARY KEY (`IdVendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`IdVendeur`, `E-mail`, `Pseudo`, `MotDePasse`, `Photo`, `ImageFond`, `Nom`, `Pays`, `Telephone`, `PorteMonnaie`) VALUES
(1, 'homersimpson@edu.ece.fr', 'hom', 'homer', 'PhotoProfil/homer.png', 'PhotoProfil/homer.png', 'Simpson', 'USA', '0625032525', 0),
(2, 'margesimpson@edu.ece.fr', 'mar', 'marge', 'PhotoProfil/marge.png', 'PhotoProfil/marge.png', 'Simpson', 'USA', '0625032526', 0);

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

DROP TABLE IF EXISTS `vente`;
CREATE TABLE IF NOT EXISTS `vente` (
  `IdVente` int(11) NOT NULL AUTO_INCREMENT,
  `IdVendeur` int(11) NOT NULL,
  `Nom` varchar(40) NOT NULL,
  `Photo` varchar(500) DEFAULT NULL,
  `Video` varchar(500) DEFAULT NULL,
  `Description` varchar(535) NOT NULL,
  `Categorie` enum('Ferraille ou Tresor','Bon pour le Musee','Accessoire VIP') NOT NULL,
  `PrixDepart` int(5) NOT NULL,
  `PrixAchatImmediat` int(6) NOT NULL,
  `TypeVente` enum('Négociation','Enchère') NOT NULL,
  `DateAjout` date NOT NULL,
  PRIMARY KEY (`IdVente`),
  KEY `c1` (`IdVendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`IdVente`, `IdVendeur`, `Nom`, `Photo`, `Video`, `Description`, `Categorie`, `PrixDepart`, `PrixAchatImmediat`, `TypeVente`, `DateAjout`) VALUES
(1, 1, 'Montre Bulova', 'PhotoItem/Montre.png', NULL, 'Une super montre jamais portée!', 'Accessoire VIP', 500, 2000, 'Enchère', '2020-04-10'),
(2, 2, 'Bureau en Bois', 'PhotoItem/Bureau.png', NULL, 'Un super bureau sur lequel on peut travailler', 'Ferraille ou Tresor', 50, 400, 'Négociation', '2020-04-13'),
(3, 1, 'Statue Bronze', 'PhotoItem/Statue.png', NULL, 'Une statue de collection a placer dans un Musée', 'Bon pour le Musee', 1000, 10000, 'Enchère', '2020-04-11'),
(4, 2, 'Piece d\'époque', 'PhotoItem/Piece.png', NULL, 'Une piece datant de 1844', 'Ferraille ou Tresor', 2, 20, 'Enchère', '2020-04-12');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `autoenchere`
--
ALTER TABLE `autoenchere`
  ADD CONSTRAINT `c10` FOREIGN KEY (`IdVente`) REFERENCES `vente` (`IdVente`),
  ADD CONSTRAINT `c9` FOREIGN KEY (`IdClient`) REFERENCES `client` (`IdClient`);

--
-- Contraintes pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `c7` FOREIGN KEY (`IdVente`) REFERENCES `vente` (`IdVente`),
  ADD CONSTRAINT `c8` FOREIGN KEY (`IdClient`) REFERENCES `client` (`IdClient`);

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `c4` FOREIGN KEY (`IdVente`) REFERENCES `vente` (`IdVente`),
  ADD CONSTRAINT `c5` FOREIGN KEY (`IdClient`) REFERENCES `client` (`IdClient`),
  ADD CONSTRAINT `c6` FOREIGN KEY (`IdVendeur`) REFERENCES `vendeur` (`IdVendeur`);

--
-- Contraintes pour la table `negociation`
--
ALTER TABLE `negociation`
  ADD CONSTRAINT `c2` FOREIGN KEY (`IdVente`) REFERENCES `vente` (`IdVente`),
  ADD CONSTRAINT `c3` FOREIGN KEY (`IdClient`) REFERENCES `client` (`IdClient`);

--
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `c1` FOREIGN KEY (`IdVendeur`) REFERENCES `vendeur` (`IdVendeur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
