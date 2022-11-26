-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 25 sep. 2022 à 18:05
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `estate`
--

-- --------------------------------------------------------
CREATE DATABASE estate;
--
-- Structure de la table `agency_infos`
--

CREATE TABLE `agency_infos` (
  `a_name` varchar(30) NOT NULL,
  `a_email` varchar(80) NOT NULL,
  `a_telephoneNumber` int(11) NOT NULL,
  `a_location` varchar(20) NOT NULL,
  `a_openingTime` int(11) NOT NULL,
  `a_closureHour` int(11) NOT NULL,
  `a_facebook` varchar(80) NOT NULL,
  `a_instagram` varchar(80) NOT NULL,
  `a_linkedin` varchar(80) NOT NULL,
  `a_twitter` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `agency_infos`
--

INSERT INTO `agency_infos` (`a_name`, `a_email`, `a_telephoneNumber`, `a_location`, `a_openingTime`, `a_closureHour`, `a_facebook`, `a_instagram`, `a_linkedin`, `a_twitter`) VALUES
('Benin Immo', 'beninimmo@gmail.com', 54142205, 'Porto-Novo', 7, 19, 'https://facebook.com', 'https://instagram.com', 'https://fr.linkedin.com', 'https://twitter.com');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `m_subject` varchar(80) NOT NULL,
  `u_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `u_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `m_subject`, `u_id`, `created_at`, `u_message`) VALUES
(1, 'Votre site', 1, '2022-09-23 03:57:24', 'Je l\'aime bien'),
(4, 'Réservation', 20, '2022-09-24 06:17:47', 'Est il possible de réserver une de vos propriétés en vue d\'une appropriation future ?'),
(10, 'Réservation', 1, '2022-09-25 03:19:31', 'Réservation de la propriété8'),
(11, 'Réservation', 1, '2022-09-25 05:40:52', 'Réservation de la propriété 21');

-- --------------------------------------------------------

--
-- Structure de la table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `p_location` varchar(255) NOT NULL,
  `p_category` varchar(4) NOT NULL,
  `p_area` int(10) UNSIGNED NOT NULL,
  `p_beds` int(10) UNSIGNED NOT NULL,
  `p_baths` int(10) UNSIGNED NOT NULL,
  `p_description` text NOT NULL,
  `p_image` varchar(255) NOT NULL,
  `p_price` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `properties`
--

INSERT INTO `properties` (`id`, `p_location`, `p_category`, `p_area`, `p_beds`, `p_baths`, `p_description`, `p_image`, `p_price`) VALUES
(2, 'Abomey-Calavi', 'rent', 300, 4, 2, 'Un paradis terrestre!', 'upload/property-2.jpg', 50000),
(3, 'Dassa', 'sale', 600, 6, 5, 'Un hâvre de paix !', 'upload/property-3.jpg', 7000000),
(4, 'Grand-Popo', 'rent', 400, 4, 2, 'Idéal pour des vacances', 'upload/property-4.jpg', 600000),
(5, 'Parakou', 'rent', 400, 4, 2, 'Vous accueille pour une virée dans la cité des Koburu', 'upload/property-5.jpg', 300000),
(6, 'Natitingou', 'rent', 275, 3, 2, 'Pour rendre votre visite encore plus agréable', 'upload/property-6.jpg', 150000),
(7, 'Abomey', 'sale', 500, 5, 3, 'Parfait si vous désirez vous installer dans la ville du roi Béhanzin', 'upload/property-7.jpg', 5500000),
(8, 'Ganvié', 'rent', 200, 3, 2, 'Dans la cité balnéaire. Parfait pour des vacances', 'upload/property-8.jpg', 150000),
(9, 'Bohicon', 'sale', 450, 4, 2, 'Parfait pour un déménagement dans une zone en plein développement', 'upload/property-9.jpg', 7000000),
(10, 'Ouidah', 'rent', 450, 4, 2, 'L\'emplacement idéale dans une ville historique du pays', 'upload/property-10.jpg', 500000),
(13, 'Savè', 'sale', 158, 2, 1, 'Idéale pour une colocation estudiantine', 'upload/property-9.jpg', 15000),
(15, 'N\'dali', 'sale', 158, 3, 2, 'Idéale pour une colocation estudiantine', 'upload/property-9.jpg', 45000),
(16, 'Porto-Novo', 'rent', 250, 3, 2, 'Pour une visite dans la capitale béninoise', 'upload/property-2.jpg', 50000),
(21, 'Parakou', 'sale', 345, 4, 3, 'Une habitation confortable', 'upload/property-63302d1e89c132.54232422.jpeg', 15000000);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `email` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `brand`, `username`, `lastName`, `u_password`, `is_admin`, `email`) VALUES
(1, 'MG', 'Meschack', 'Gbewezoun', '$2y$14$sGQNnf/aqYgG9DC0RokUMu/bMkZHSlZ.w9HNT4reOAQB/n3HWYcCq', 0, 'meshachgbewezoun@gmail.com'),
(20, 'JD', 'John', 'Doe', '$2y$14$kc14YDikNzQJPAoXXtZVZu3p6RLCsSQYsyM2nMrDIp9XGaofR9K4i', 1, 'john@doe.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agency_infos`
--
ALTER TABLE `agency_infos`
  ADD PRIMARY KEY (`a_name`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
