-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 09 avr. 2024 à 22:24
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `book`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `idCategory` int(3) NOT NULL,
  `nameCategory` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`idCategory`, `nameCategory`) VALUES
(24, 'romantique');

-- --------------------------------------------------------

--
-- Structure de la table `command`
--

CREATE TABLE `command` (
  `idCommand` int(3) NOT NULL,
  `idUserCommand` int(3) DEFAULT NULL,
  `amountCommand` int(3) NOT NULL,
  `dateCommand` datetime NOT NULL,
  `stateCommand` varchar(280) NOT NULL DEFAULT 'En cours de traitement'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detailscommand`
--

CREATE TABLE `detailscommand` (
  `idDetailsCommand` int(3) NOT NULL,
  `idCommandDetailsCommand` int(3) DEFAULT NULL,
  `idProductDetailsCommand` int(3) DEFAULT NULL,
  `quantityDetailsCommand` int(3) NOT NULL,
  `priceDetailsCommand` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

CREATE TABLE `member` (
  `idMember` int(3) NOT NULL,
  `pseudoMember` varchar(20) NOT NULL,
  `passwordMember` varchar(300) NOT NULL,
  `nameMember` varchar(20) NOT NULL,
  `firstnameMember` varchar(20) NOT NULL,
  `emailMember` varchar(50) NOT NULL,
  `cityMember` varchar(20) NOT NULL,
  `postalCodeMember` varchar(5) NOT NULL,
  `adressMember` varchar(50) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `member`
--

INSERT INTO `member` (`idMember`, `pseudoMember`, `passwordMember`, `nameMember`, `firstnameMember`, `emailMember`, `cityMember`, `postalCodeMember`, `adressMember`, `isAdmin`) VALUES
(16, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'admin', 'admin@gmail.com', 'montreal', '18000', 'place montoire', 1),
(17, 'meriem', '1efcfaab69361232b5e5e39265464be84f6e484f', 'mekrarbech', 'meriem', 'mekrarbech12@gmail.com', 'Anjou', '23000', '8191 PLACE MONTOIRE', 0);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `idProduct` int(3) NOT NULL,
  `nameProduct` varchar(100) NOT NULL,
  `descriptionProduct` text NOT NULL,
  `imageProduct` varchar(250) NOT NULL,
  `priceProduct` int(3) NOT NULL,
  `stockProduct` int(3) NOT NULL,
  `idCategoryProduct` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`idProduct`, `nameProduct`, `descriptionProduct`, `imageProduct`, `priceProduct`, `stockProduct`, `idCategoryProduct`) VALUES
(17, 'Romeo et Juliette', 'Romeo et Juliette', 'bsrc_download.jpg', 20, 15, 24);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Index pour la table `command`
--
ALTER TABLE `command`
  ADD PRIMARY KEY (`idCommand`),
  ADD KEY `idUserCommand` (`idUserCommand`);

--
-- Index pour la table `detailscommand`
--
ALTER TABLE `detailscommand`
  ADD PRIMARY KEY (`idDetailsCommand`),
  ADD KEY `idProductDetailsCommand` (`idProductDetailsCommand`),
  ADD KEY `idCommandDetailsCommand` (`idCommandDetailsCommand`);

--
-- Index pour la table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idMember`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `idCategoryProduct` (`idCategoryProduct`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `idCategory` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `command`
--
ALTER TABLE `command`
  MODIFY `idCommand` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `detailscommand`
--
ALTER TABLE `detailscommand`
  MODIFY `idDetailsCommand` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `member`
--
ALTER TABLE `member`
  MODIFY `idMember` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `idProduct` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
