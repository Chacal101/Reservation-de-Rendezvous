-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 14 juil. 2025 à 09:46
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
-- Base de données : `gestion_rendezvous`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `Id_Admin` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Mot_de_Passe` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `reset_password_token` text COLLATE utf8mb4_general_ci,
  `reset_password_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id_Admin`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`Id_Admin`, `Nom`, `Email`, `Mot_de_Passe`, `reset_password_token`, `reset_password_datetime`) VALUES
(4, 'Nomena', 'nomenatupac02@gmail.com', '$2y$10$miMKwCWYd1qaXR1YDwUfpusvHDAAioCCZzS2IaP4uF5XyFCC0asK.', '85df7904f7a136908e9979bcce3643c1', '2025-07-11 08:09:41');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Telephone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `email`, `password`, `Telephone`, `date_creation`) VALUES
(1, 'Aina', 'aina@gmail.com', '$2y$10$./tJHrLkY74n4rGhDnFip.phqQ2ZZhl6TIMBTbQOmA/FZVEO4v0xu', '033 10 789 30', '2025-02-27'),
(2, 'Safidy', 'safidy@gmail.com', '$2y$10$vTSdkeIO3tbGOAXMEf2qvOfMU009yoV4SG1chPPboI4NGQzbbXlRG', '034 88 948 46', '2025-02-27'),
(4, 'Tojoniaina', 'Tojo02@gmail.com', '$2y$10$.e9wEt/DyYXRGy2YaH8inuwuOhlkHVQEXmhiE6VgXy.33QqGU12Mm', '032 26 789 69', '0000-00-00'),
(5, 'Rabesonina', 'Erica@gmail.com', '$2y$10$v2TjEcm2VkPjBSSbwZM8rOlY/X6P3m3CLtaNUyIHmMTdSNv9YqKly', '037 28 456 98', '0000-00-00'),
(6, 'Tsiory Sylvio', 'Tsiory11@gmail.com', '$2y$10$aEnxYKDct5A0p0lgrMhCIOxM4DJcR9r3B35Z9UU.fIN0NEeZaTUyO', '034 70 456 89', '0000-00-00'),
(7, 'RABEKOTO', 'Koto@gmail.com', '$2y$10$MwmDZAFao3EPf7rlueYOxuh3gXMPrWvOSdKduA5lKX.FYIVhrHnMm', '', '0000-00-00'),
(8, 'Mendrika', 'Mendrika0036@gmail.com', '$2y$10$tIjO9uRlGX/ArFHOWitj9uwzRo/2/Xt/5AwtdWjXHLyv3e.HVSy/i', '038 33 049 85', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `conge`
--

DROP TABLE IF EXISTS `conge`;
CREATE TABLE IF NOT EXISTS `conge` (
  `id_congé` int NOT NULL AUTO_INCREMENT,
  `date_début` date NOT NULL,
  `date_retour` date NOT NULL,
  `id_employé` int NOT NULL,
  PRIMARY KEY (`id_congé`),
  KEY `id_employé` (`id_employé`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `id_employer` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fonction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statut` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_employer`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id_employer`, `nom`, `email`, `fonction`, `statut`) VALUES
(1, 'Diary', 'Diary@gmail.com', 'Formateur PHP', 'Actif'),
(2, 'Rakoto', 'Rakoto@gmail.com', 'Formateur JavaScript', 'Actif'),
(3, 'Rabe', 'Rabe@gmail.com', 'Formateur Préstashop', 'Actif'),
(4, 'Paul', 'Paul00@gmail.com', '', 'Inactif'),
(8, 'Durlant', 'Durlant00@gmail.com', '', 'Actif'),
(9, 'Rasoa', 'Rasoa1@gmail.com', '', 'Actif'),
(10, 'Raharison', 'Raharison2@gmail.com', '', 'Actif');

-- --------------------------------------------------------

--
-- Structure de la table `jferie`
--

DROP TABLE IF EXISTS `jferie`;
CREATE TABLE IF NOT EXISTS `jferie` (
  `id_JFerié` int NOT NULL AUTO_INCREMENT,
  `dateJFerié` date NOT NULL,
  PRIMARY KEY (`id_JFerié`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id_notification` int NOT NULL AUTO_INCREMENT,
  `id_client` int NOT NULL,
  `id_service` int NOT NULL,
  `date_rdv` date NOT NULL,
  `heure_debut` time NOT NULL,
  `statut` enum('non lu','lu') COLLATE utf8mb4_general_ci DEFAULT 'non lu',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_rdv` int DEFAULT NULL,
  PRIMARY KEY (`id_notification`),
  KEY `id_client` (`id_client`),
  KEY `id_service` (`id_service`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id_notification`, `id_client`, `id_service`, `date_rdv`, `heure_debut`, `statut`, `created_at`, `id_rdv`) VALUES
(15, 5, 4, '2025-07-08', '09:30:00', 'lu', '2025-07-12 05:30:58', NULL),
(14, 5, 8, '2025-07-07', '08:00:00', 'lu', '2025-07-09 00:07:19', NULL),
(13, 5, 5, '2025-04-07', '09:00:00', 'lu', '2025-04-03 06:44:43', NULL),
(12, 4, 5, '2025-03-25', '07:00:00', 'lu', '2025-03-24 12:42:21', NULL),
(11, 2, 6, '2025-03-21', '14:00:00', 'lu', '2025-03-20 08:58:51', NULL),
(9, 1, 4, '2025-03-03', '07:32:00', 'lu', '2025-02-28 20:32:30', NULL),
(10, 2, 5, '2025-03-07', '07:00:00', 'lu', '2025-03-05 10:29:23', NULL),
(16, 1, 4, '2025-07-31', '12:25:00', 'lu', '2025-07-12 17:41:46', NULL),
(17, 1, 4, '2025-07-31', '12:25:00', 'lu', '2025-07-12 17:43:35', NULL),
(18, 1, 5, '2025-07-31', '20:30:00', 'lu', '2025-07-12 17:45:16', 29),
(19, 1, 4, '2025-07-29', '20:30:00', 'lu', '2025-07-12 17:49:48', 30),
(20, 7, 9, '2025-07-17', '10:37:00', 'lu', '2025-07-14 05:37:35', 31),
(21, 8, 8, '2025-07-21', '07:00:00', 'non lu', '2025-07-14 08:16:49', 32);

-- --------------------------------------------------------

--
-- Structure de la table `notifications_client`
--

DROP TABLE IF EXISTS `notifications_client`;
CREATE TABLE IF NOT EXISTS `notifications_client` (
  `id_notification` int NOT NULL AUTO_INCREMENT,
  `id_client` int NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `date_notification` datetime DEFAULT CURRENT_TIMESTAMP,
  `statut` enum('non_lue','lue') COLLATE utf8mb4_general_ci DEFAULT 'non_lue',
  `id_rdv` int DEFAULT NULL,
  PRIMARY KEY (`id_notification`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notifications_client`
--

INSERT INTO `notifications_client` (`id_notification`, `id_client`, `message`, `date_notification`, `statut`, `id_rdv`) VALUES
(2, 1, 'Votre rendez vous est refusé', '2025-07-12 18:46:28', 'non_lue', 26),
(3, 1, 'Votre rendez vous est refusé', '2025-07-12 19:03:08', 'non_lue', 27),
(4, 1, 'Rendez-vous en Formation PHP de la date (2025-07-31 à 20:30:00 jusqu\'à) a été refusé avec succès', '2025-07-12 19:05:50', 'non_lue', 28),
(5, 1, 'Rendez-vous en Formation PHP de la date (2025-07-31 à 20:30:00 jusqu\'à) a été refusé avec succès', '2025-07-12 19:06:38', 'non_lue', 29);

-- --------------------------------------------------------

--
-- Structure de la table `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `id_permission` int NOT NULL AUTO_INCREMENT,
  `date_permission` date NOT NULL,
  `heure_début` time NOT NULL,
  `heure_fin` time NOT NULL,
  `id_employé` int NOT NULL,
  PRIMARY KEY (`id_permission`),
  KEY `id_employé` (`id_employé`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rendezvous`
--

DROP TABLE IF EXISTS `rendezvous`;
CREATE TABLE IF NOT EXISTS `rendezvous` (
  `id_rendezVous` int NOT NULL AUTO_INCREMENT,
  `date_rdv` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `id_service` int NOT NULL,
  `id_client` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `id_employer` int DEFAULT NULL,
  `status` enum('En Attente','Validé','Refusé','') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'En Attente',
  PRIMARY KEY (`id_rendezVous`),
  KEY `fk_rendezvous_client` (`id_client`),
  KEY `fk_rendezvous_service` (`id_service`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rendezvous`
--

INSERT INTO `rendezvous` (`id_rendezVous`, `date_rdv`, `heure_debut`, `heure_fin`, `id_service`, `id_client`, `created_at`, `updated_at`, `id_employer`, `status`) VALUES
(18, '2025-03-07', '07:00:00', '00:00:00', 5, 2, '2025-03-05 07:29:23', '2025-03-27 16:55:31', 2, 'Validé'),
(17, '2025-03-03', '07:32:00', '00:00:00', 4, 1, '2025-02-28 17:32:30', '2025-03-27 16:58:20', 1, 'Validé'),
(19, '2025-03-21', '14:00:00', '00:00:00', 6, 2, '2025-03-20 05:58:51', '2025-04-03 03:40:39', 8, 'Validé'),
(20, '2025-03-25', '07:00:00', '00:00:00', 5, 4, '2025-03-24 09:42:21', '2025-03-24 09:42:21', NULL, 'En Attente'),
(21, '2025-04-07', '09:00:00', '00:00:00', 5, 5, '2025-04-03 03:44:43', '2025-04-03 03:44:43', NULL, 'En Attente'),
(23, '2025-07-08', '09:30:00', '00:00:00', 4, 5, '2025-07-12 02:30:58', '2025-07-12 02:30:58', NULL, 'En Attente'),
(24, '2025-07-31', '12:25:00', '00:00:00', 4, 1, '2025-07-12 14:41:46', '2025-07-12 14:55:52', NULL, 'Refusé'),
(25, '2025-07-31', '12:25:00', '00:00:00', 4, 1, '2025-07-12 14:43:22', '2025-07-12 15:38:40', NULL, 'Refusé'),
(26, '2025-07-31', '12:25:00', '00:00:00', 4, 1, '2025-07-12 14:43:35', '2025-07-12 15:46:28', NULL, 'Refusé'),
(27, '2025-07-31', '20:30:00', '00:00:00', 5, 1, '2025-07-12 14:44:59', '2025-07-12 16:03:08', NULL, 'Refusé'),
(28, '2025-07-31', '20:30:00', '00:00:00', 5, 1, '2025-07-12 14:45:08', '2025-07-12 16:05:50', NULL, 'Refusé'),
(29, '2025-07-31', '20:30:00', '00:00:00', 5, 1, '2025-07-12 14:45:16', '2025-07-12 16:06:38', NULL, 'Refusé'),
(30, '2025-07-29', '20:30:00', '00:00:00', 4, 1, '2025-07-12 14:49:48', '2025-07-12 14:50:09', 2, 'Validé'),
(31, '2025-07-17', '10:37:00', '00:00:00', 9, 7, '2025-07-14 02:37:35', '2025-07-14 02:38:21', 8, 'Validé'),
(32, '2025-07-21', '07:00:00', '00:00:00', 8, 8, '2025-07-14 05:16:49', '2025-07-14 05:16:49', NULL, 'En Attente');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id_service` int NOT NULL AUTO_INCREMENT,
  `service` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `durée` decimal(10,0) NOT NULL,
  `Prix` int NOT NULL,
  PRIMARY KEY (`id_service`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id_service`, `service`, `description`, `durée`, `Prix`) VALUES
(4, 'Formation Préstashop.', 'Cette formation est idéale pour les entrepreneurs, développeurs et gestionnaires e-commerce souhaitant maîtriser PrestaShop et améliorer leurs ventes en ligne.', 2, 150000),
(5, 'Formation PHP', 'Cette formation est idéale pour les entrepreneurs, développeurs et gestionnaires e-commerce souhaitant maîtriser PrestaShop et améliorer leurs ventes en ligne.', 2, 120000),
(6, 'Formation JavaScript', 'Cette formation est idéale pour les entrepreneurs, développeurs et gestionnaires e-commerce souhaitant maîtriser PrestaShop et améliorer leurs ventes en ligne.', 2, 130000),
(7, 'Formation PYTHON', 'Cette formation est idéale pour les entrepreneurs, développeurs et gestionnaires e-commerce souhaitant maîtriser PrestaShop et améliorer leurs ventes en ligne.	', 3, 140000),
(8, 'Formation Java JRE', 'Cette formation est idéale pour les entrepreneurs, développeurs et gestionnaires e-commerce souhaitant maîtriser PrestaShop et améliorer leurs ventes en ligne.	', 2, 135000),
(9, 'Formation Odoo', 'Cette formation est idéale pour les entrepreneurs, développeurs et gestionnaires e-commerce souhaitant maîtriser PrestaShop et améliorer leurs ventes en ligne.	', 5, 170000),
(10, 'Formation HTML Simple', 'Cette formation est idéale pour les entrepreneurs, développeurs et gestionnaires e-commerce souhaitant maîtriser PrestaShop et améliorer leurs ventes en ligne.\r\n\r\n', 2, 100000),
(11, 'Formation CSS', 'Cette formation est idéale pour les entrepreneurs, développeurs et gestionnaires e-commerce souhaitant maîtriser PrestaShop et améliorer leurs ventes en ligne.\r\n\r\n', 2, 120000),
(12, 'Formation React Native', 'Cette formation est idéale pour les entrepreneurs, développeurs et gestionnaires e-commerce souhaitant maîtriser PrestaShop et améliorer leurs ventes en ligne.\r\n\r\n', 4, 130000);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
