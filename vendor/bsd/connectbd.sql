-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 12 août 2024 à 18:43
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `connectbd`
--

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `description`, `image_url`, `quantite`, `prix`) VALUES
(19, 'Jordan 4', 'Air Jordan 4 retro &amp; OG archive collection Nike', 'path/to/your/upload/directory/air-jordan-4-retro-oxidized-green-mens-shoes-PNtDJp.webp', 10, 200.00),
(17, 'Polo', 'New Arrival\r\nSlightly longer, double-breasted blazer. Notched lapels, buttons at front, and welt front pockets with flap. Shoulder pads and long sleeves. Lined.\r\n\r\nArt. No.:1232584003\r\nSize:\r\nSleeve: Length: 62.5 in. (Size M), Shoulder: Width: 41.0 in. (Size M), Back: Length: 72.0 in. (Size M)\r\nLength: Long\r\nSleeve Length: Long sleeve\r\nFit: Regular fit\r\nCollar: Notched Lapels\r\nStyle: Blazer, Double-breasted\r\nNeckline: V-neck\r\nDescription: Navy blue, Solid-color', 'path/to/your/upload/directory/51wN0xRq-LL._AC_UY1000_.jpg', 15, 49.99),
(18, 'Veste Lacoste', 'Veste de survêtement Lacoste Tennis Sportsuit Chez DM&#039;Sports  €* · En stock · Marque : Lacoste', 'path/to/your/upload/directory/veste-de-survetement-lacoste-tennis-sportsuit-bande-siglee-verte-et-blanche-.jpg', 5, 126.00);

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `item_number` varchar(50) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_price` float(10,2) DEFAULT NULL,
  `item_price_currency` varchar(10) DEFAULT NULL,
  `payer_id` varchar(50) DEFAULT NULL,
  `payer_name` varchar(50) DEFAULT NULL,
  `payer_email` varchar(50) DEFAULT NULL,
  `payer_country` varchar(20) DEFAULT NULL,
  `merchant_id` varchar(255) DEFAULT NULL,
  `merchant_email` varchar(50) DEFAULT NULL,
  `order_id` varchar(50) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `paid_amount` float(10,2) NOT NULL,
  `paid_amount_currency` varchar(10) NOT NULL,
  `payment_source` varchar(50) DEFAULT NULL,
  `payment_status` varchar(25) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `username`, `email`, `password`, `is_admin`) VALUES
(23, 'aoudia11', 'dzjob10@gmail.com', '$2y$10$BZQ7qWzHEKZHC5wbzloPP.sfyrXKzxy/Qun.mLSDuMG6RK3FdgZ8S', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
