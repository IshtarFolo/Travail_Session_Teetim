-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 04:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `teetim_tpv34`
--
CREATE DATABASE IF NOT EXISTS `teetim_tpv34` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `teetim_tpv34`;

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` tinyint(4) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Animaux'),
(2, 'Inusité'),
(4, 'Nature'),
(3, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `id` mediumint(9) NOT NULL,
  `numero` char(30) NOT NULL,
  `ddm` date NOT NULL COMMENT 'Date de dernière modification du panier par le visiteur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Cette table contient les chariots pris par les visiteurs du ';

-- --------------------------------------------------------

--
-- Table structure for table `panier_article`
--

CREATE TABLE `panier_article` (
  `id` int(11) NOT NULL,
  `id_produit` smallint(6) NOT NULL,
  `id_panier` mediumint(9) NOT NULL,
  `qte` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Cette table contiendra les articles du panier pour chaque ut';

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id` smallint(6) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prix` decimal(5,2) NOT NULL,
  `ventes` smallint(6) NOT NULL,
  `dac` date NOT NULL,
  `image` varchar(25) NOT NULL COMMENT 'Nom complet du fichier image',
  `id_categorie` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `prix`, `ventes`, `dac`, `image`, `id_categorie`) VALUES
(1, 'Cute comme un poisson tropical', 25.95, 34, '2023-04-25', 'ts0001.webp', 1),
(2, 'Monstre douillet', 25.95, 123, '2023-08-12', 'ts0004.webp', 1),
(3, 'Camarade basque', 20.50, 20, '2023-02-27', 'ts0006.webp', 1),
(4, 'Chaton moteur', 27.50, 12, '2023-10-01', 'ts0007.webp', 1),
(5, 'Renardcoptère', 17.95, 56, '2023-05-04', 'ts0009.webp', 1),
(6, 'L\'outre d\'outremer', 15.95, 260, '2022-10-11', 'ts0013.webp', 1),
(7, 'Fauteuil illégal', 20.50, 6, '2023-01-02', 'ts0002.webp', 2),
(8, 'Cerveau volant', 24.50, 154, '2022-08-08', 'ts0014.webp', 2),
(9, 'Beau bébébot', 26.50, 20, '2023-09-05', 'ts0019.webp', 2),
(10, 'Grille-pain couac-couac', 20.00, 3, '2023-10-01', 'ts0020.webp', 2),
(11, 'Un dunk dans l\'univers', 22.75, 21, '2023-01-02', 'ts0003.webp', 3),
(12, 'Basket courbe', 19.75, 158, '2022-09-04', 'ts0015.webp', 3),
(13, 'pizza, vino e calcio', 19.75, 40, '2023-07-18', 'ts0016.webp', 3),
(14, 'Bleu comme une orange', 25.95, 325, '2022-12-25', 'ts0005.webp', 4),
(15, 'Et vogue le navire', 15.50, 293, '2022-12-21', 'ts0008.webp', 4),
(16, 'Par une nuit d\'été sur Mars', 22.00, 48, '2023-01-30', 'ts0010.webp', 4),
(17, 'Le déjeuner pointilliste', 21.00, 55, '2023-02-21', 'ts0011.webp', 4),
(18, 'Portrait au tournesol', 29.99, 24, '2023-03-26', 'ts0012.webp', 4),
(19, 'Reflexion dans le lac', 21.50, 12, '2023-07-10', 'ts0017.webp', 4),
(20, 'Levé de soleil en automne', 22.95, 5, '2023-08-28', 'ts0018.webp', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`);

--
-- Indexes for table `panier_article`
--
ALTER TABLE `panier_article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_produit_2` (`id_produit`,`id_panier`),
  ADD KEY `id_produit` (`id_produit`),
  ADD KEY `id_panier` (`id_panier`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`,`id_categorie`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `panier_article`
--
ALTER TABLE `panier_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `panier_article`
--
ALTER TABLE `panier_article`
  ADD CONSTRAINT `panier_article_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `panier_article_ibfk_2` FOREIGN KEY (`id_panier`) REFERENCES `panier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`);
COMMIT;
