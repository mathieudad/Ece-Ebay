-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 20 avr. 2020 à 17:06
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
(4, 'jordan.kujundzic@edu.ece.com', 'Jord', 'jordan');

-- --------------------------------------------------------

--
-- Structure de la table `apayer`
--

DROP TABLE IF EXISTS `apayer`;
CREATE TABLE IF NOT EXISTS `apayer` (
  `IdVente` int(11) NOT NULL,
  `IdClient` int(11) NOT NULL,
  `IdVendeur` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `PrixAchat` int(6) NOT NULL,
  `PrixDepart` int(6) NOT NULL,
  `Photo` varchar(400) NOT NULL,
  `Video` varchar(500) DEFAULT NULL,
  `Description` varchar(500) NOT NULL,
  `TypeAchat` enum('Enchere','Negociation') NOT NULL,
  `Categorie` enum('Bon pour le Musee','Accessoire VIP','Ferraille ou Tresor') NOT NULL,
  PRIMARY KEY (`IdVente`,`IdClient`,`IdVendeur`) USING BTREE,
  KEY `c11` (`IdClient`),
  KEY `c12` (`IdVendeur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `apayer`
--

INSERT INTO `apayer` (`IdVente`, `IdClient`, `IdVendeur`, `Nom`, `PrixAchat`, `PrixDepart`, `Photo`, `Video`, `Description`, `TypeAchat`, `Categorie`) VALUES
(30, 8, 8, 'Vase Grec', 12000, 8000, 'PhotoItem/Vase1.PNG', NULL, 'Ce vase est un vase de collection, a ne pas rater', 'Negociation', 'Bon pour le Musee'),
(44, 1, 5, 'Omega Speedmaster', 4100, 3600, 'PhotoItem/Omega.PNG', NULL, 'Montre Omega qui est allÃ©e sur la lune, a ne pas rater, annÃ©e 2016, Etat : 8/10.', 'Negociation', 'Accessoire VIP');

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

--
-- Déchargement des données de la table `autoenchere`
--

INSERT INTO `autoenchere` (`IdVente`, `IdClient`, `PrixMax`) VALUES
(15, 7, 7000),
(29, 8, 600),
(32, 1, 1440),
(39, 6, 400000);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`IdClient`, `Nom`, `Prenom`, `E-mail`, `Pseudo`, `MotDePasse`, `Adresse`, `CodePostal`, `Ville`, `Pays`, `Telephone`, `Panier`, `TypeCarte`, `NumCarte`, `NomCarte`, `DateExpCarte`, `CodeCarte`, `PorteMonnaie`) VALUES
(1, 'Simpson', 'Bart', 'bartsimpson@edu.ece.fr', 'bart', 'simpson', '123 route de bart', 13009, 'Springfield', 'USA', '0625032528', NULL, 'Visa', '1234123412341234', 'Bart Simpson', '12/2020', 123, 7793),
(2, 'Simpson', 'Lisa', 'lisasimpson@edu.ece.fr', 'lisa', 'simpson', '123 route de bart', 13009, 'Springfield', 'USA', '0625032529', NULL, 'Visa', '3456345634563456', 'Lisa Simpson', '08/2020', 141, 250),
(3, 'Simpson', 'Maggie', 'maggiesimpson@edu.ece.fr', 'maggie', 'simpson', '123 route de bart', 13009, 'Springfield', 'USA', '0625032529', NULL, 'MasterCard', '1234567812345678', 'Maggie Simpson', '12/2022', 234, 10000),
(4, 'Smith', 'Morty', 'Morty.smith@ece.fr', 'morty', 'smith', '14 rue de l\'espace', 12000, 'Mars', 'Macedoine', '0989896756', '15,22', 'American Express', '1111222233334444', 'Morty Smith', '12/2022', 567, 476300),
(5, 'Messi', 'Lionel', 'lionel.messi@ece.fr', 'lionel', 'messi', '122 rue du camp nou', 78888, 'Barcelone', 'Espagne', '0855949329', NULL, 'MasterCard', '3333777788884444', 'Lionel Messi', '01/2021', 789, 780000),
(6, 'Macron', 'Emmanuel', 'parcequecnotreprojet@elysee.fr', 'emmanuel', 'macron', '55 rue du Faubourg-Saint-HonorÃ©', 75008, 'Paris', 'France', '0491229939', '27', 'American Express', '6666777733338888', 'Emmanuel Macron', '09/2023', 735, 500000),
(7, 'Trump', 'Donald', 'donald.trump@ece.fr', 'donald', 'trump', 'La maison Blanche', 90001, 'Washington', 'Etats_Unis', '0444955396', NULL, 'American Express', '5656454578789898', 'Donald Trump', '07/2023', 678, 800000),
(8, 'Raoult', 'Didier', 'coronavirus@ece.fr', 'didier', 'raoult', '12 rue du virus', 13008, 'Marseille', 'France', '0899923939', NULL, 'MasterCard', '1222334050402839', 'Didier Raoult', '08/2021', 230, 70000);

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `IdVente` int(11) NOT NULL,
  `IdClient` int(11) NOT NULL,
  `PrixActuel` int(6) NOT NULL,
  PRIMARY KEY (`IdVente`),
  KEY `c8` (`IdClient`),
  KEY `c7` (`IdVente`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`IdVente`, `IdClient`, `PrixActuel`) VALUES
(14, 6, 17000),
(15, 7, 6500),
(24, 5, 56000),
(25, 3, 450),
(27, 6, 400000),
(29, 8, 300),
(31, 7, 310000),
(32, 1, 500),
(39, 6, 300000);

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
  `Categorie` enum('Ferraille ou Tresor','Bon pour le Musee','Accessoire VIP') NOT NULL,
  `PrixDepart` int(5) NOT NULL,
  `PrixAchat` int(6) NOT NULL,
  `TypeAchat` enum('Immediat','Enchere','Negociation') NOT NULL,
  `Description` varchar(500) NOT NULL,
  PRIMARY KEY (`IdVente`,`IdClient`,`IdVendeur`),
  KEY `c5` (`IdClient`),
  KEY `c6` (`IdVendeur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`IdVente`, `IdClient`, `IdVendeur`, `Nom`, `Photo`, `Video`, `Categorie`, `PrixDepart`, `PrixAchat`, `TypeAchat`, `Description`) VALUES
(13, 4, 1, 'Montre Pepsi', 'PhotoItem/Pepsi.png', NULL, 'Accessoire VIP', 16000, 17000, 'Negociation', 'Une gmt master 2 pepsi 2015 '),
(36, 5, 2, 'collier diamant', 'PhotoItem/Bijou2.PNG', NULL, 'Accessoire VIP', 44000, 120000, 'Immediat', 'Je souhaite changer de collier alors je vends celui la serti de diamants '),
(45, 4, 6, 'Tableau Iron man', 'PhotoItem/Tableau1.PNG', NULL, 'Ferraille ou Tresor', 400, 3300, 'Immediat', 'je vends ce tableau que j ai moi meme peint dans mon garage.');

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
  KEY `c3` (`IdVente`),
  KEY `c2` (`IdClient`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `negociation`
--

INSERT INTO `negociation` (`IdVente`, `IdClient`, `NbNego`, `PrixNego`) VALUES
(16, 3, 0, 16000),
(16, 4, 0, 15000),
(16, 7, 1, 16500),
(26, 5, 1, 290000),
(26, 7, 0, 250000),
(28, 3, 0, 120),
(33, 6, 0, 420000);

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
  `Prenom` varchar(30) NOT NULL,
  `Pays` varchar(30) NOT NULL,
  `Telephone` varchar(10) NOT NULL,
  `PorteMonnaie` int(6) NOT NULL,
  PRIMARY KEY (`IdVendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`IdVendeur`, `E-mail`, `Pseudo`, `MotDePasse`, `Photo`, `ImageFond`, `Nom`, `Prenom`, `Pays`, `Telephone`, `PorteMonnaie`) VALUES
(1, 'homersimpson@edu.ece.fr', 'homer', 'simpson', 'PhotoProfil/homer.png', 'PhotoProfil/homer.png', 'Simpson', 'Homer', 'USA', '0625032525', 0),
(2, 'margesimpson@edu.ece.fr', 'marge', 'simpson', 'PhotoProfil/marge.png', 'PhotoProfil/marge.png', 'Simpson', 'Marge', 'USA', '0625032526', 0),
(5, 'james.bond@ece.fr', 'james', 'bond', 'PhotoProfil/James.PNG', 'PhotoProfil/James.PNG', 'Bond', 'James', 'Royaume_Uni', '0607080910', 0),
(6, 'rickdelespace@ece.fr', 'rick', 'smith', 'PhotoProfil/Rick.PNG', 'PhotoProfil/Rick.PNG', 'Smith', 'Rick', 'Micronesie', '1234567891', 0),
(7, 'handoftheking@ece.fr', 'tyrion', 'lannister', 'PhotoProfil/Tyrion.PNG', 'PhotoProfil/Tyrion.PNG', 'Lannister', 'Tyrion', 'Macedoine', '0804576819', 0),
(8, 'onaletoile@om.fr', 'andre', 'villas', 'PhotoProfil/Villas.PNG', 'PhotoProfil/Villas.PNG', 'Villas Boas', 'AndrÃ©', 'Portugal', '0709193494', 0);

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
  `TypeVente` enum('Negociation','Enchere') NOT NULL,
  `DateAjout` date NOT NULL,
  `DateFin` date NOT NULL,
  PRIMARY KEY (`IdVente`),
  KEY `c1` (`IdVendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`IdVente`, `IdVendeur`, `Nom`, `Photo`, `Video`, `Description`, `Categorie`, `PrixDepart`, `PrixAchatImmediat`, `TypeVente`, `DateAjout`, `DateFin`) VALUES
(12, 2, 'Rolex Daytona', 'PhotoItem/Daytona.png', NULL, 'Ancien model de rolex Daytona fond blanc 2002', 'Ferraille ou Tresor', 19000, 26000, 'Enchere', '2020-04-15', '2020-05-07'),
(14, 2, 'Montre Rolex DayJust', 'PhotoItem/Datejust.png', NULL, 'Rolex en or lunette cannelée ', 'Ferraille ou Tresor', 15000, 20000, 'Enchere', '2020-04-14', '2020-04-30'),
(15, 1, 'Rolex Milgauss', 'PhotoItem/Milgauss.png', NULL, 'Une super belle montre Rolex pas tres chere', 'Ferraille ou Tresor', 6500, 10000, 'Enchere', '2020-04-16', '2020-04-30'),
(16, 1, 'Montre Rolex Batman', 'PhotoItem/Batman.png', NULL, 'Une montre rolex gmt Master 2 qui ne se produit plus!', 'Bon pour le Musee', 13000, 22000, 'Negociation', '2020-04-15', '2020-05-22'),
(24, 6, 'Montre Patek Philippe Nautilus', 'PhotoItem/Patek.PNG', NULL, 'Je vends cette montre d\'exception presque jamais portÃ©e annÃ©e 2016', 'Ferraille ou Tresor', 48000, 83000, 'Enchere', '2020-04-20', '2020-05-23'),
(25, 6, 'Boite Bijou en Verre', 'PhotoItem/Bijou4.PNG', NULL, 'Je vends cette superbe boite en or', 'Ferraille ou Tresor', 400, 1500, 'Enchere', '2020-04-20', '2020-05-21'),
(26, 5, 'Bague ', 'PhotoItem/Bijou5.PNG', NULL, 'Je vends cette super bague que appartenait a  la reine d Angleterre. ', 'Ferraille ou Tresor', 200000, 900000, 'Negociation', '2020-04-20', '2020-05-21'),
(27, 5, 'Ferrari 250 GTO', 'PhotoItem/Voiture1.PNG', NULL, 'Je vends ma Ferrari car je ne roule plus avec.', 'Accessoire VIP', 400000, 999999, 'Enchere', '2020-04-20', '2020-06-10'),
(28, 5, 'La Joconde', 'PhotoItem/Tableau6.PNG', NULL, 'Je vends ce tableau d un peintre peu connu et que je n aime pas particulierement', 'Bon pour le Musee', 80, 700, 'Negociation', '2020-04-20', '2020-05-13'),
(29, 8, 'Tableau Lion', 'PhotoItem/Tableau2.PNG', NULL, 'Super tableau qui n a plus sa place chez moi, il vous fera rugir de plaisir.', 'Ferraille ou Tresor', 300, 1900, 'Enchere', '2020-04-20', '2020-05-13'),
(31, 8, 'McLaren 720s', 'PhotoItem/Voiture3.PNG', NULL, 'Je vends ma voiture qui avance tres vite.', 'Accessoire VIP', 300000, 440000, 'Enchere', '2020-04-20', '2020-06-17'),
(32, 8, 'Lot de deux vase d\'Ã©poque', 'PhotoItem/Vase2.PNG', NULL, 'Ce super lot de vases datant de l\'antiquite!', 'Accessoire VIP', 500, 4500, 'Enchere', '2020-04-20', '2020-05-29'),
(33, 8, 'Jacob&co Astronomia', 'PhotoItem/Montre1.PNG', NULL, 'Une montre ou l on peut admirer les planetes tourner', 'Bon pour le Musee', 400000, 700000, 'Negociation', '2020-04-20', '2020-07-17'),
(34, 7, 'bracelets or', 'PhotoItem/Bijou3.PNG', NULL, 'Ces bracelets sont d\'une qualite hors norme, produits dans la meilleure forge du pays', 'Ferraille ou Tresor', 900, 12000, 'Enchere', '2020-04-20', '2020-05-21'),
(35, 7, 'Statue de bronze', 'PhotoItem/Statue1.PNG', NULL, 'Superbe statue que j\'ai moi meme sculpte.', 'Ferraille ou Tresor', 1200, 5999, 'Enchere', '2020-04-20', '2020-05-05'),
(37, 2, 'lot de trois bracelets', 'PhotoItem/Bijou1.PNG', NULL, 'Ces bracelets sont super ils vous iront a ravir! ', 'Ferraille ou Tresor', 20, 350, 'Enchere', '2020-04-20', '2020-05-27'),
(38, 2, 'Statue Africaine', 'PhotoItem/Statue2.PNG', NULL, 'Cette statue en bois d arbre faite par une tribu d\'Afrique.', 'Ferraille ou Tresor', 70, 450, 'Negociation', '2020-04-20', '2020-05-23'),
(39, 2, 'Nuit Ã©toilÃ©e ', 'PhotoItem/Tableau5.PNG', NULL, 'Tableau original de la nuit etoile peint par Van Gogh lui meme.', 'Bon pour le Musee', 300000, 750000, 'Enchere', '2020-04-20', '2020-06-16'),
(40, 1, 'Tableau \"fun\" Alpaga', 'PhotoItem/Tableau4.PNG', NULL, 'C\'est un tableau plutot rigolo et original qui ira super bien dans votre salon.', 'Ferraille ou Tresor', 40, 350, 'Enchere', '2020-04-20', '2020-05-20'),
(41, 1, 'Tableau banc de poisson', 'PhotoItem/Tableau3.PNG', NULL, 'Super tableau ou un banc de poisson se baigne dans l\'ocean.', 'Ferraille ou Tresor', 50, 700, 'Enchere', '2020-04-20', '2020-05-13'),
(42, 1, 'Voiture multipa', 'PhotoItem/Voiture4.PNG', NULL, 'Connu pour etre LA voiture la plus moche de tous les temps, et je suis d\'accord avec cela.', 'Ferraille ou Tresor', 10, 1000, 'Enchere', '2020-04-20', '2020-05-20'),
(43, 5, 'Mercedes 300 sl', 'PhotoItem/Voiture2.PNG', NULL, 'Une des voitures les plus belles que Mercedes ait cree.', 'Accessoire VIP', 300000, 700000, 'Enchere', '2020-04-20', '2020-08-18');

--
-- Contraintes pour les tables déchargées
--

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
