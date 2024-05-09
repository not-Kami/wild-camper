-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 09 mai 2024 à 19:43
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
-- Base de données : `wildcamper`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, '4x4', 'Véhicules robustes adaptés pour les terrains difficiles et les aventures hors route.'),
(2, 'Van aménagé', 'Vans équipés pour des voyages longue durée avec des aménagements pour dormir et cuisiner.'),
(3, 'SUV', 'Véhicules spacieux et confortables, idéals pour les familles ou les groupes.'),
(4, 'Compact', 'Véhicules compacts, parfaits pour les voyages en ville et facile à garer.'),
(5, 'Luxe', 'Véhicules de luxe offrant un confort et des équipements haut de gamme.');

-- --------------------------------------------------------

--
-- Structure de la table `fleet`
--

CREATE TABLE `fleet` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price_per_week` decimal(10,2) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `featured` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `theme_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fleet`
--

INSERT INTO `fleet` (`id`, `name`, `description`, `price_per_week`, `available`, `featured`, `category_id`, `theme_id`) VALUES
(1, 'Land Rover Defender', 'Travel with a legend. The Land Rover Defender is an icon of resilience and reliability. Its timeless design and proven durability make it a top choice for adventurers who demand performance in the most demanding conditions. Get ready to make your mark in the wilds.', 1200.00, 1, 0, 1, 1),
(2, 'Toyota Hilux', 'Experience the raw power and robustness of the Toyota Hilux. Designed for the most challenging landscapes, it combines strength with advanced technology to deliver an unparalleled driving experience. Ideal for conquering tough trails and long expeditions with ease.', 1100.00, 1, 0, 1, 1),
(3, 'Mercedes Viano', 'Experience the space and comfort of the Mercedes Viano. With ample room for your passengers and gear, the Viano delivers a smooth and luxurious ride for long journeys. Perfect for those who seek both sophistication and capability on their road adventures.', 1300.00, 1, 0, 5, 2),
(4, 'Land Rover Discovery 4', 'Embark on your adventure with the Land Rover Discovery 4. Renowned for its luxurious comfort and exceptional off-road capabilities, this vehicle promises an unforgettable journey through any terrain. Perfect for those who seek both sophistication and ruggedness on their travels.', 1250.00, 1, 0, 1, 1),
(5, 'VW Caravelle', 'Experience the power and robustness of the VW Caravelle. Designed for the most challenging landscapes, it combines strength with advanced technology to deliver an unparalleled driving experience. Ideal for conquering tough trails and long expeditions with ease.', 1000.00, 1, 0, 2, 2),
(6, 'Jeep Wrangler', 'Experience the iconic Jeep Wrangler, designed for freedom and engineered to deliver top performance on and off the road. Ideal for those who crave adventure and wish to explore without boundaries.', 1100.00, 1, 0, 1, 1),
(7, 'Jeep Wrangler', 'Experience the iconic Jeep Wrangler, designed for freedom and engineered to deliver top performance on and off the road. Ideal for those who crave adventure and wish to explore without boundaries.', 1100.00, 1, 0, 1, 1),
(8, 'Nissan Patrol', 'Experience the raw power and robustness of the Nissan Patrol. Designed for the most challenging landscapes, it combines strength with advanced technology to deliver an unparalleled driving experience. Ideal for conquering tough trails and long expeditions with ease.', 1150.00, 1, 0, 1, 1),
(9, 'Dodge Ram', 'Discover the legendary power and capability of the Dodge Ram. Built for the toughest jobs and the most rugged terrain, it offers unparalleled performance and durability. Whether it s hauling heavy loads or tackling off-road adventures, the Dodge Ram is ready to conquer any challenge with style.', 1300.00, 1, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `language`
--

INSERT INTO `language` (`id`, `name`, `code`) VALUES
(1, 'English', 'EN'),
(2, 'Français', 'FR'),
(3, 'Español', 'ES'),
(4, 'Deutsch', 'DE'),
(5, 'Italiano', 'IT');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`id`, `vehicle_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 1, 4, 'Excellent véhicule pour les aventures hors route.', '2024-05-09 10:00:00'),
(2, 2, 2, 5, 'Le Toyota Hilux est un véhicule incroyablement robuste.', '2024-05-08 12:30:00'),
(3, 3, 3, 4, 'Le Mercedes Viano offre un confort exceptionnel pour les longs trajets.', '2024-05-07 15:45:00');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'Tout-terrain'),
(2, 'Équipement de camping inclus'),
(3, 'Hybride ou électrique'),
(4, 'Grande autonomie'),
(5, 'Navigation GPS'),
(6, 'Sièges chauffants'),
(7, 'Toit ouvrant'),
(8, 'Idéal pour les road trips'),
(9, 'Animaux autorisés'),
(10, 'Porte-bagages'),
(11, 'Capacité de remorquage élevée'),
(12, 'Transmission manuelle'),
(13, 'Faible consommation'),
(14, 'Assurance tous risques incluse'),
(15, 'Disponible pour location à long terme');

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id`, `name`, `description`) VALUES
(1, 'Aventure', 'Véhicules parfaits pour partir à l aventure dans des conditions extrêmes.'),
(2, 'Familial', 'Confort et sécurité pour toute la famille.'),
(3, 'Éco-responsable', 'Véhicules à faible émission et consommation réduite, respectueux de l environnement.'),
(4, 'Économique', 'Options abordables avec une bonne efficacité énergétique.'),
(5, 'Performance', 'Véhicules avec des performances de conduite supérieures pour les amateurs de vitesse.');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `account_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_connection` datetime DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role_id`, `account_created`, `last_connection`, `language_id`) VALUES
(1, 'admin', 'admin@example.com', 'mot_de_passe_admin', 1, '2024-05-09 19:40:10', NULL, NULL),
(2, 'user1', 'user1@example.com', 'mot_de_passe_user1', 2, '2024-05-09 19:40:18', NULL, NULL),
(3, 'user2', 'user2@example.com', 'mot_de_passe_user2', 2, '2024-05-09 19:40:18', NULL, NULL),
(4, 'user3', 'user3@example.com', 'mot_de_passe_user3', 2, '2024-05-09 19:40:18', NULL, NULL),
(5, 'user4', 'user4@example.com', 'mot_de_passe_user4', 2, '2024-05-09 19:40:18', NULL, NULL),
(6, 'user5', 'user5@example.com', 'mot_de_passe_user5', 2, '2024-05-09 19:40:18', NULL, NULL),
(7, 'user6', 'user6@example.com', 'mot_de_passe_user6', 2, '2024-05-09 19:40:18', NULL, NULL),
(8, 'user7', 'user7@example.com', 'mot_de_passe_user7', 2, '2024-05-09 19:40:18', NULL, NULL),
(9, 'user8', 'user8@example.com', 'mot_de_passe_user8', 2, '2024-05-09 19:40:18', NULL, NULL),
(10, 'user9', 'user9@example.com', 'mot_de_passe_user9', 2, '2024-05-09 19:40:18', NULL, NULL),
(11, 'user10', 'user10@example.com', 'mot_de_passe_user10', 2, '2024-05-09 19:40:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vehicle_tags`
--

CREATE TABLE `vehicle_tags` (
  `vehicle_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vehicle_tags`
--

INSERT INTO `vehicle_tags` (`vehicle_id`, `tag_id`) VALUES
(1, 1),
(1, 8),
(2, 1),
(2, 8),
(3, 2),
(3, 15),
(4, 1),
(4, 7),
(5, 2),
(5, 15),
(6, 1),
(6, 8),
(7, 1),
(7, 8),
(8, 1),
(8, 11),
(9, 1),
(9, 8);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fleet`
--
ALTER TABLE `fleet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `theme_id` (`theme_id`);

--
-- Index pour la table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Index pour la table `vehicle_tags`
--
ALTER TABLE `vehicle_tags`
  ADD PRIMARY KEY (`vehicle_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `fleet`
--
ALTER TABLE `fleet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fleet`
--
ALTER TABLE `fleet`
  ADD CONSTRAINT `fleet_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fleet_ibfk_2` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`);

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `fleet` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`);

--
-- Contraintes pour la table `vehicle_tags`
--
ALTER TABLE `vehicle_tags`
  ADD CONSTRAINT `vehicle_tags_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `fleet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehicle_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
