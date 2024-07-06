-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 06 juil. 2024 à 13:07
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
  `theme_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `specs` text DEFAULT NULL,
  `capacity` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `transmission` varchar(50) NOT NULL,
  `fuel` varchar(50) NOT NULL,
  `max_travelers` int(11) DEFAULT NULL,
  `pet_friendly` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fleet`
--

INSERT INTO `fleet` (`id`, `name`, `description`, `price_per_week`, `available`, `featured`, `category_id`, `theme_id`, `image_path`, `specs`, `capacity`, `year`, `transmission`, `fuel`, `max_travelers`, `pet_friendly`) VALUES
(1, 'Land Rover Defender', 'The Land Rover Defender embodies legendary toughness and reliability. With its timeless design and proven durability, it is the perfect choice for demanding adventurers. Get ready to make your mark in the wild.', 1200.00, 1, 0, 1, 1, 'public/img/vehicles/range_rover.png', NULL, 5, 2020, 'Automatic', 'Diesel', 5, 1),
(2, 'Toyota Hilux', 'The Toyota Hilux combines raw power and advanced technology to deliver an unparalleled driving experience. Designed for the toughest terrains, it is ideal for long expeditions and extreme adventures.', 1100.00, 1, 1, 1, 1, 'public/img/vehicles/toyota_hilux.png', NULL, 5, 2019, 'Manual', 'Diesel', 4, 0),
(3, 'Mercedes Viano', 'The Mercedes Viano offers space and comfort for your passengers and luggage. With a smooth and luxurious ride, it is the perfect companion for long journeys, combining sophistication and performance on the road.', 1300.00, 1, 0, 5, 2, 'public/img/vehicles/mercedes_viano.png', NULL, 7, 2018, 'Automatic', 'Petrol', 5, 0),
(4, 'Land Rover Discovery 4', 'The Land Rover Discovery 4 is renowned for its luxurious comfort and exceptional off-road capabilities. This vehicle promises an unforgettable adventure on any terrain, blending sophistication and ruggedness.', 1250.00, 1, 1, 1, 1, 'public/img/vehicles/land_rover_discovery.png', NULL, 7, 2020, 'Automatic', 'Diesel', 4, 1),
(5, 'VW Caravelle', 'The VW Caravelle combines power and toughness for the most demanding landscapes. With advanced technology, it offers an unparalleled driving experience, ideal for difficult expeditions and long journeys.', 1000.00, 1, 1, 2, 2, 'public/img/vehicles/vw_caravelle.png', NULL, 8, 2021, 'Automatic', 'Diesel', 7, 1),
(6, 'Jeep Wrangler', 'The Jeep Wrangler is a symbol of freedom and performance. Designed for adventure, it excels both on and off-road, perfect for those who seek to explore without limits.', 1100.00, 1, 0, 1, 5, 'public/img/vehicles/jeep_wrangler.png', NULL, 5, 2019, 'Manual', 'Petrol', 2, 0),
(7, 'Volvo XC90', 'The Volvo XC90 combines iconic design with exceptional performance. Designed for freedom, it delivers top performance on and off-road, ideal for adventurers looking to explore.', 1100.00, 1, 0, 3, 3, 'public/img/vehicles/volvo_xc90.png', NULL, 5, 2020, 'Automatic', 'Hybrid', 5, 1),
(8, 'Nissan Patrol', 'The Nissan Patrol is designed for the toughest landscapes with raw power and advanced technology. It offers an unparalleled driving experience, perfect for long expeditions and adventures.', 1150.00, 0, 0, 4, 1, 'public/img/vehicles/nissan_patrol.png', NULL, 5, 2018, 'Manual', 'Diesel', 5, 0),
(9, 'Dodge Ram', 'The Dodge Ram combines legendary power and exceptional capabilities. Built for the toughest terrains and heavy loads, it offers unmatched performance and durability for all your adventures.', 1300.00, 1, 1, 1, 5, 'public/img/vehicles/dodge_ram.png', NULL, 6, 2021, 'Automatic', 'Diesel', 6, 1);

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
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `adults` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `pets` int(11) NOT NULL DEFAULT 0,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Off-road'),
(2, 'Camping equipment included'),
(3, 'Hybrid or electric'),
(4, 'Long range'),
(5, 'GPS Navigation'),
(6, 'Heated seats'),
(7, 'Sunroof'),
(8, 'Ideal for road trips'),
(9, 'Pets allowed'),
(10, 'Roof rack'),
(11, 'High towing capacity'),
(12, 'Manual transmission'),
(13, 'Low consumption'),
(14, 'Full insurance included'),
(15, 'Available for long-term rental');

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
-- Structure de la table `user_favorite_vehicles`
--

CREATE TABLE `user_favorite_vehicles` (
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_favorite_vehicles`
--

INSERT INTO `user_favorite_vehicles` (`user_id`, `vehicle_id`) VALUES
(1, 1),
(2, 3),
(2, 4),
(4, 5),
(5, 8);

-- --------------------------------------------------------

--
-- Structure de la table `vehicle_tag`
--

CREATE TABLE `vehicle_tag` (
  `vehicle_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vehicle_tag`
--

INSERT INTO `vehicle_tag` (`vehicle_id`, `tag_id`) VALUES
(1, 1),
(1, 5),
(1, 6),
(1, 8),
(1, 10),
(1, 14),
(2, 1),
(2, 5),
(2, 8),
(2, 10),
(2, 11),
(2, 12),
(2, 14),
(3, 4),
(3, 5),
(3, 8),
(3, 14),
(4, 1),
(4, 5),
(4, 6),
(4, 8),
(4, 10),
(4, 14),
(5, 1),
(5, 5),
(5, 6),
(5, 8),
(5, 10),
(5, 14),
(6, 1),
(6, 7),
(6, 8),
(6, 10),
(6, 11),
(6, 14),
(7, 1),
(7, 3),
(7, 4),
(7, 5),
(7, 6),
(7, 8),
(7, 10),
(7, 13),
(7, 14),
(8, 1),
(8, 5),
(8, 8),
(8, 10),
(8, 11),
(8, 12),
(8, 14),
(9, 1),
(9, 5),
(9, 6),
(9, 8),
(9, 10),
(9, 14);

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
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

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
-- Index pour la table `user_favorite_vehicles`
--
ALTER TABLE `user_favorite_vehicles`
  ADD PRIMARY KEY (`user_id`,`vehicle_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Index pour la table `vehicle_tag`
--
ALTER TABLE `vehicle_tag`
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
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `fleet` (`id`);

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
-- Contraintes pour la table `user_favorite_vehicles`
--
ALTER TABLE `user_favorite_vehicles`
  ADD CONSTRAINT `user_favorite_vehicles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_favorite_vehicles_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `fleet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vehicle_tag`
--
ALTER TABLE `vehicle_tag`
  ADD CONSTRAINT `vehicle_tag_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `fleet` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicle_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
