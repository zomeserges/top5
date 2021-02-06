-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 06 fév. 2021 à 10:58
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `top5`
--
CREATE DATABASE IF NOT EXISTS `top5` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `top5`;

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

DROP TABLE IF EXISTS `action`;
CREATE TABLE IF NOT EXISTS `action` (
  `idaction` bigint(11) NOT NULL,
  `idpdca` bigint(11) NOT NULL,
  `idsqdip` bigint(11) NOT NULL,
  `idescalade` bigint(11) NOT NULL,
  `idlogin` bigint(11) NOT NULL,
  `iddirection` bigint(11) NOT NULL,
  `idgid` bigint(11) NOT NULL,
  `idorigine` bigint(11) NOT NULL,
  `etat` bigint(11) DEFAULT NULL,
  `responsable` varchar(255) DEFAULT NULL,
  `data_prevu` datetime DEFAULT NULL,
  `action` text,
  `direction` bigint(11) DEFAULT NULL,
  `origine` bigint(11) DEFAULT NULL,
  `sqdip` bigint(11) DEFAULT NULL,
  `escalade` bigint(11) DEFAULT NULL,
  `gestionnaire` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`idaction`),
  KEY `fk_action_pdca` (`idpdca`),
  KEY `fk_action_sqdip` (`idsqdip`),
  KEY `fk_action_escalade` (`idescalade`),
  KEY `fk_action_loginpareto` (`idlogin`),
  KEY `fk_action_direction` (`iddirection`),
  KEY `fk_action_gid` (`idgid`),
  KEY `fk_action_origine` (`idorigine`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `causepareto`
--

DROP TABLE IF EXISTS `causepareto`;
CREATE TABLE IF NOT EXISTS `causepareto` (
  `idcausepareto` bigint(11) NOT NULL,
  `cause` varchar(255) DEFAULT NULL,
  `description` text,
  `pareto` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`idcausepareto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `direction`
--

DROP TABLE IF EXISTS `direction`;
CREATE TABLE IF NOT EXISTS `direction` (
  `iddirection` bigint(11) NOT NULL AUTO_INCREMENT,
  `direction` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`iddirection`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `direction`
--

INSERT INTO `direction` (`iddirection`, `direction`, `created_at`, `updated_at`) VALUES
(1, 'Securite', '2021-01-30 09:34:28', '2021-01-30 13:44:35'),
(2, 'Qualite', '2021-01-30 09:36:04', '2021-01-30 09:36:04'),
(3, 'Comptabilite', '2021-01-30 09:44:39', '2021-01-30 13:45:12'),
(4, 'Maintenance', '2021-01-30 10:28:20', '2021-01-30 10:28:20'),
(5, 'Recherche', '2021-01-30 10:58:30', '2021-01-30 10:58:30');

-- --------------------------------------------------------

--
-- Structure de la table `escalade`
--

DROP TABLE IF EXISTS `escalade`;
CREATE TABLE IF NOT EXISTS `escalade` (
  `idescalade` bigint(11) NOT NULL AUTO_INCREMENT,
  `escalade` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idescalade`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `escalade`
--

INSERT INTO `escalade` (`idescalade`, `escalade`, `created_at`, `updated_at`) VALUES
(1, 'Service technique', '2021-01-31 12:21:22', '2021-01-31 12:21:22'),
(2, 'Service RH', '2021-01-31 12:21:55', '2021-01-31 12:24:09'),
(3, 'Direction', '2021-01-31 12:22:16', '2021-01-31 12:22:16');

-- --------------------------------------------------------

--
-- Structure de la table `gid`
--

DROP TABLE IF EXISTS `gid`;
CREATE TABLE IF NOT EXISTS `gid` (
  `idgid` bigint(11) NOT NULL,
  `gid` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `nom` varchar(128) DEFAULT NULL,
  `prenom` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `origine` bigint(11) DEFAULT NULL,
  `direction` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`idgid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `indicateur`
--

DROP TABLE IF EXISTS `indicateur`;
CREATE TABLE IF NOT EXISTS `indicateur` (
  `idindicateur` bigint(11) NOT NULL,
  `iddirection` bigint(11) NOT NULL,
  `idorigine` bigint(11) NOT NULL,
  `idsqdip` bigint(11) NOT NULL,
  `indicateur` varchar(255) DEFAULT NULL,
  `responsable` varchar(255) DEFAULT NULL,
  `description` text,
  `direction` bigint(11) DEFAULT NULL,
  `origine` bigint(11) DEFAULT NULL,
  `sqdip` bigint(11) DEFAULT NULL,
  `mini` bigint(4) DEFAULT NULL,
  `maxi` bigint(11) DEFAULT NULL,
  `a1` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`idindicateur`),
  KEY `fk_indicateur_direction` (`iddirection`),
  KEY `fk_indicateur_origine` (`idorigine`),
  KEY `fk_indicateur_sqdip` (`idsqdip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `info`
--

DROP TABLE IF EXISTS `info`;
CREATE TABLE IF NOT EXISTS `info` (
  `idinfo` bigint(11) NOT NULL,
  `idorigine` bigint(11) NOT NULL,
  `iddirection` bigint(11) NOT NULL,
  `idgid` bigint(11) NOT NULL,
  `date_debut` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `info` text,
  `direction` bigint(11) DEFAULT NULL,
  `origine` bigint(11) DEFAULT NULL,
  `gestionnaire` bigint(11) DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  PRIMARY KEY (`idinfo`),
  KEY `fk_info_origine` (`idorigine`),
  KEY `fk_info_direction` (`iddirection`),
  KEY `fk_info_gid` (`idgid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `listepareto`
--

DROP TABLE IF EXISTS `listepareto`;
CREATE TABLE IF NOT EXISTS `listepareto` (
  `idlistepareto` bigint(11) NOT NULL,
  `iddirection` bigint(11) NOT NULL,
  `pareto` varchar(255) DEFAULT NULL,
  `description` text,
  `direction` bigint(11) DEFAULT NULL,
  `origine` bigint(11) DEFAULT NULL,
  `sqdip` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`idlistepareto`),
  KEY `fk_listepareto_direction` (`iddirection`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `listepareto_cause`
--

DROP TABLE IF EXISTS `listepareto_cause`;
CREATE TABLE IF NOT EXISTS `listepareto_cause` (
  `idlistepareto` bigint(11) NOT NULL,
  `idcausepareto` bigint(11) NOT NULL,
  PRIMARY KEY (`idlistepareto`,`idcausepareto`),
  KEY `fk_listepareto_cause_causepareto` (`idcausepareto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `loginadmin`
--

DROP TABLE IF EXISTS `loginadmin`;
CREATE TABLE IF NOT EXISTS `loginadmin` (
  `idloginadmin` bigint(11) NOT NULL,
  `gid` bigint(11) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idloginadmin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `loginindicateur`
--

DROP TABLE IF EXISTS `loginindicateur`;
CREATE TABLE IF NOT EXISTS `loginindicateur` (
  `idloginindicateur` bigint(11) NOT NULL,
  `gid` bigint(11) DEFAULT NULL,
  `indicateur` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`idloginindicateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `loginpareto`
--

DROP TABLE IF EXISTS `loginpareto`;
CREATE TABLE IF NOT EXISTS `loginpareto` (
  `idlogin` bigint(11) NOT NULL,
  `idlistepareto` bigint(11) NOT NULL,
  `gid` bigint(11) DEFAULT NULL,
  `pareto` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`idlogin`),
  KEY `fk_loginpareto_listepareto` (`idlistepareto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `origine`
--

DROP TABLE IF EXISTS `origine`;
CREATE TABLE IF NOT EXISTS `origine` (
  `idorigine` bigint(11) NOT NULL,
  `idlistepareto` bigint(11) NOT NULL,
  `idgid` bigint(11) NOT NULL,
  `origine` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idorigine`),
  KEY `fk_origine_listepareto` (`idlistepareto`),
  KEY `fk_origine_gid` (`idgid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pareto`
--

DROP TABLE IF EXISTS `pareto`;
CREATE TABLE IF NOT EXISTS `pareto` (
  `idpareto` bigint(11) NOT NULL,
  `idcausepareto` bigint(11) NOT NULL,
  `idindicateur` bigint(11) DEFAULT NULL,
  `pareto` varchar(255) DEFAULT NULL,
  `valeur` decimal(15,2) DEFAULT NULL,
  `description` text,
  `direction` bigint(11) DEFAULT NULL,
  `origine` bigint(11) DEFAULT NULL,
  `sqdip` bigint(11) DEFAULT NULL,
  `responsable` varchar(128) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idpareto`),
  KEY `fk_pareto_causepareto` (`idcausepareto`),
  KEY `fk_pareto_indicateur` (`idindicateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pdca`
--

DROP TABLE IF EXISTS `pdca`;
CREATE TABLE IF NOT EXISTS `pdca` (
  `idpdca` bigint(11) NOT NULL AUTO_INCREMENT,
  `etat` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpdca`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sqdip`
--

DROP TABLE IF EXISTS `sqdip`;
CREATE TABLE IF NOT EXISTS `sqdip` (
  `idsqdip` bigint(11) NOT NULL AUTO_INCREMENT,
  `sqdip` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idsqdip`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sqdip`
--

INSERT INTO `sqdip` (`idsqdip`, `sqdip`, `created_at`, `updated_at`) VALUES
(1, 'Securite', '2021-01-30 15:08:58', '2021-01-30 15:08:58'),
(2, 'Qualite', '2021-01-30 15:09:19', '2021-01-30 15:09:19'),
(3, 'Departement', '2021-01-30 15:09:52', '2021-01-30 15:09:52'),
(4, 'Isolation', '2021-01-30 15:10:09', '2021-01-30 15:10:43');

-- --------------------------------------------------------

--
-- Structure de la table `sqdip_listepareto`
--

DROP TABLE IF EXISTS `sqdip_listepareto`;
CREATE TABLE IF NOT EXISTS `sqdip_listepareto` (
  `idlistepareto` bigint(11) NOT NULL,
  `idsqdip` bigint(11) NOT NULL,
  PRIMARY KEY (`idlistepareto`,`idsqdip`),
  KEY `fk_sqdip_listepareto_sqdip` (`idsqdip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `typeseuil`
--

DROP TABLE IF EXISTS `typeseuil`;
CREATE TABLE IF NOT EXISTS `typeseuil` (
  `idtypeseuil` bigint(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idtypeseuil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `telephone` text NOT NULL,
  `password` text NOT NULL,
  `ver_token` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `type` varchar(150) NOT NULL,
  `status` varchar(30) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '1',
  `department` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `telephone`, `password`, `ver_token`, `created_at`, `updated_at`, `type`, `status`, `is_verified`, `department`) VALUES
(2, 'Zome', 'Serges', 'zomeserges@gmail.com', '0755860555', '601f1889667efaebb33b8c12572835da3f027f78', NULL, '2021-01-22 20:14:09', '2021-01-22 20:14:09', 'Super Admin', 'active', 1, 'Securite'),
(3, 'KEMMOU TCHINDA', 'Desmond', 'kemou@gmail.com', '0660686578', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', NULL, '2021-02-23 22:06:02', '2021-01-25 15:33:22', 'Admin Indicateur', 'blocked', 1, 'Qualite'),
(4, 'Pegwe', 'Wadji Kemone', 'daniel@gmail.com', '057855878', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', NULL, '2021-01-24 09:23:34', '2021-01-25 15:25:03', 'Admin Pareto', 'deactivated', 1, 'Securite'),
(5, 'Zome', 'Serges', 'zomeserges@gmail.com', '0755860555', '601f1889667efaebb33b8c12572835da3f027f78', NULL, '2021-01-22 20:14:09', '2021-01-22 20:14:09', 'Super Admin', 'active', 1, 'Securite'),
(6, 'KEMMOU TCHINDA', 'Desmond', 'kemou@gmail.com', '0660686578', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', NULL, '2021-02-23 22:06:02', '2021-01-25 15:33:22', 'Admin Indicateur', 'blocked', 1, 'Qualite'),
(7, 'Pegwe', 'Wadji Kemone', 'daniel@gmail.com', '057855878', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', NULL, '2021-01-24 09:23:34', '2021-01-25 15:25:03', 'Admin Pareto', 'deactivated', 1, 'Securite');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `valeurindicateur`
--

DROP TABLE IF EXISTS `valeurindicateur`;
CREATE TABLE IF NOT EXISTS `valeurindicateur` (
  `idvaleurindicateur` bigint(11) NOT NULL,
  `idindicateur` bigint(11) NOT NULL,
  `idlistepareto` bigint(11) NOT NULL,
  `indicateur` bigint(11) DEFAULT NULL,
  `valeur` bigint(11) DEFAULT NULL,
  `qui` varchar(255) DEFAULT NULL,
  `date_saisie` datetime DEFAULT NULL,
  PRIMARY KEY (`idvaleurindicateur`),
  KEY `fk_valeurindicateur_indicateur` (`idindicateur`),
  KEY `fk_valeurindicateur_listepareto` (`idlistepareto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `valeurpareto`
--

DROP TABLE IF EXISTS `valeurpareto`;
CREATE TABLE IF NOT EXISTS `valeurpareto` (
  `idvaleurpareto` bigint(11) NOT NULL,
  `idcausepareto` bigint(11) NOT NULL,
  `cause` bigint(11) DEFAULT NULL,
  `pareto` bigint(11) DEFAULT NULL,
  `valeur` bigint(11) DEFAULT NULL,
  `qui` varchar(255) DEFAULT NULL,
  `date_saisie` datetime DEFAULT NULL,
  PRIMARY KEY (`idvaleurpareto`),
  KEY `fk_valeurpareto_causepareto` (`idcausepareto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `version`
--

DROP TABLE IF EXISTS `version`;
CREATE TABLE IF NOT EXISTS `version` (
  `version` bigint(11) NOT NULL,
  `numversion` bigint(11) NOT NULL,
  PRIMARY KEY (`version`,`numversion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
--
-- Base de données : `top5_2`
--
CREATE DATABASE IF NOT EXISTS `top5_2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `top5_2`;

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

DROP TABLE IF EXISTS `action`;
CREATE TABLE IF NOT EXISTS `action` (
  `idaction` bigint(11) NOT NULL AUTO_INCREMENT,
  `idpdca` bigint(11) NOT NULL,
  `idsqdip` bigint(11) NOT NULL,
  `idescalade` bigint(11) NOT NULL,
  `idlogin` bigint(11) NOT NULL,
  `iddirection` bigint(11) NOT NULL,
  `idgid` bigint(11) NOT NULL,
  `idorigine` bigint(11) NOT NULL,
  `etat` bigint(11) DEFAULT NULL,
  `responsable` varchar(255) DEFAULT NULL,
  `data_prevu` datetime DEFAULT NULL,
  `action` text,
  `direction` bigint(11) DEFAULT NULL,
  `origine` bigint(11) DEFAULT NULL,
  `sqdip` bigint(11) DEFAULT NULL,
  `escalade` bigint(11) DEFAULT NULL,
  `gestionnaire` bigint(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idaction`),
  KEY `fk_action_pdca` (`idpdca`),
  KEY `fk_action_sqdip` (`idsqdip`),
  KEY `fk_action_escalade` (`idescalade`),
  KEY `fk_action_loginpareto` (`idlogin`),
  KEY `fk_action_direction` (`iddirection`),
  KEY `fk_action_gid` (`idgid`),
  KEY `fk_action_origine` (`idorigine`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `causepareto`
--

DROP TABLE IF EXISTS `causepareto`;
CREATE TABLE IF NOT EXISTS `causepareto` (
  `idcausepareto` bigint(11) NOT NULL AUTO_INCREMENT,
  `cause` varchar(255) DEFAULT NULL,
  `description` text,
  `pareto` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`idcausepareto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `direction`
--

DROP TABLE IF EXISTS `direction`;
CREATE TABLE IF NOT EXISTS `direction` (
  `iddirection` bigint(11) NOT NULL AUTO_INCREMENT,
  `direction` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`iddirection`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `direction`
--

INSERT INTO `direction` (`iddirection`, `direction`, `created_at`, `updated_at`) VALUES
(1, 'Securite', '2021-02-03 11:19:33', '2021-02-03 11:20:22'),
(2, 'Qualite', '2021-02-03 11:20:32', '2021-02-03 11:20:32'),
(3, 'Maintenance', '2021-02-03 11:20:40', '2021-02-03 11:20:40');

-- --------------------------------------------------------

--
-- Structure de la table `escalade`
--

DROP TABLE IF EXISTS `escalade`;
CREATE TABLE IF NOT EXISTS `escalade` (
  `idescalade` bigint(11) NOT NULL AUTO_INCREMENT,
  `escalade` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idescalade`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `escalade`
--

INSERT INTO `escalade` (`idescalade`, `escalade`, `created_at`, `updated_at`) VALUES
(1, 'Service technique', '2021-02-03 11:38:52', '2021-02-03 11:38:52'),
(2, 'Service RH', '2021-02-03 11:39:00', '2021-02-03 11:39:00'),
(3, 'Directions', '2021-02-03 11:39:08', '2021-02-03 11:39:23');

-- --------------------------------------------------------

--
-- Structure de la table `gid`
--

DROP TABLE IF EXISTS `gid`;
CREATE TABLE IF NOT EXISTS `gid` (
  `idgid` bigint(11) NOT NULL AUTO_INCREMENT,
  `idorigine` bigint(11) DEFAULT NULL,
  `gid` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `nom` varchar(128) DEFAULT NULL,
  `prenom` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `origine` varchar(128) DEFAULT NULL,
  `direction` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idgid`),
  KEY `fk_gid_origine` (`idorigine`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `gid`
--

INSERT INTO `gid` (`idgid`, `idorigine`, `gid`, `pass`, `nom`, `prenom`, `email`, `origine`, `direction`, `created_at`, `updated_at`) VALUES
(1, 3, 'Zome Se', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Serges', 'Zome', 'zomeserges@gmail.com', 'Departement de maintenance', 'Securite', '2021-02-03 12:54:05', '2021-02-03 18:23:25'),
(2, NULL, 'Desmond KEMMOU TCHINDA', '601f1889667efaebb33b8c12572835da3f027f78', 'KEMMOU TCHINDA', 'Desmond', 'morelle@gmail.com', 'Direction central', NULL, '2021-02-03 13:10:45', '2021-02-03 17:54:42'),
(3, 3, 'Zome Serges', NULL, NULL, 'Zome', 'zome@gmail.com', 'Service informatique', NULL, '2021-02-03 14:20:54', '2021-02-03 14:20:54'),
(4, 4, 'zomeserges@gmail.com', NULL, 'Serges', 'Zome', 'zomeserges@gmail.co', 'Service de maintenance', NULL, '2021-02-03 14:28:08', '2021-02-03 14:28:08'),
(5, 3, 'zomeserges@gmail.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', 'Serges', 'Zome', 'zomeserges@gmail.ck', 'Service informatique', NULL, '2021-02-03 14:31:18', '2021-02-03 14:31:18'),
(6, 4, 'zomeserges', '601f1889667efaebb33b8c12572835da3f027f78', 'Serges', 'Zome', 'zomeserges@gmail.tk', 'Service de maintenance', NULL, '2021-02-03 14:51:19', '2021-02-03 14:51:19'),
(7, 1, 'zomeserges@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', 'Serges', 'Zome', 'zomeserges@gmail.j', 'Direction central', NULL, '2021-02-03 14:53:46', '2021-02-03 14:53:46');

-- --------------------------------------------------------

--
-- Structure de la table `indicateur`
--

DROP TABLE IF EXISTS `indicateur`;
CREATE TABLE IF NOT EXISTS `indicateur` (
  `idindicateur` bigint(11) NOT NULL AUTO_INCREMENT,
  `iddirection` bigint(11) NOT NULL,
  `idorigine` bigint(11) NOT NULL,
  `idsqdip` bigint(11) NOT NULL,
  `indicateur` varchar(255) DEFAULT NULL,
  `responsable` varchar(255) DEFAULT NULL,
  `description` text,
  `direction` bigint(11) DEFAULT NULL,
  `origine` bigint(11) DEFAULT NULL,
  `sqdip` bigint(11) DEFAULT NULL,
  `mini` bigint(4) DEFAULT NULL,
  `valeur` decimal(15,2) NOT NULL,
  `maxi` bigint(11) DEFAULT NULL,
  `a1` bigint(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idindicateur`),
  KEY `fk_indicateur_direction` (`iddirection`),
  KEY `fk_indicateur_origine` (`idorigine`),
  KEY `fk_indicateur_sqdip` (`idsqdip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `info`
--

DROP TABLE IF EXISTS `info`;
CREATE TABLE IF NOT EXISTS `info` (
  `idinfo` bigint(11) NOT NULL AUTO_INCREMENT,
  `idorigine` bigint(11) NOT NULL,
  `iddirection` bigint(11) NOT NULL,
  `idgid` bigint(11) NOT NULL,
  `info` text,
  `direction` bigint(11) DEFAULT NULL,
  `origine` bigint(11) DEFAULT NULL,
  `gestionnaire` bigint(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idinfo`),
  KEY `fk_info_origine` (`idorigine`),
  KEY `fk_info_direction` (`iddirection`),
  KEY `fk_info_gid` (`idgid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `loginadmin`
--

DROP TABLE IF EXISTS `loginadmin`;
CREATE TABLE IF NOT EXISTS `loginadmin` (
  `idloginadmin` bigint(11) NOT NULL AUTO_INCREMENT,
  `gid` bigint(11) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idloginadmin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `loginindicateur`
--

DROP TABLE IF EXISTS `loginindicateur`;
CREATE TABLE IF NOT EXISTS `loginindicateur` (
  `idloginindicateur` bigint(11) NOT NULL AUTO_INCREMENT,
  `gid` bigint(11) DEFAULT NULL,
  `indicateur` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`idloginindicateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `loginpareto`
--

DROP TABLE IF EXISTS `loginpareto`;
CREATE TABLE IF NOT EXISTS `loginpareto` (
  `idlogin` bigint(11) NOT NULL AUTO_INCREMENT,
  `idpareto` bigint(11) NOT NULL,
  `gid` bigint(11) DEFAULT NULL,
  `pareto` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`idlogin`),
  KEY `fk_loginpareto_pareto` (`idpareto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `origine`
--

DROP TABLE IF EXISTS `origine`;
CREATE TABLE IF NOT EXISTS `origine` (
  `idorigine` bigint(11) NOT NULL AUTO_INCREMENT,
  `origine` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idorigine`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `origine`
--

INSERT INTO `origine` (`idorigine`, `origine`, `created_at`, `updated_at`) VALUES
(1, 'Direction central', '2021-02-03 12:13:31', '2021-02-03 12:13:31'),
(2, 'Departement de maintenance', '2021-02-03 12:14:05', '2021-02-03 12:14:05'),
(3, 'Service informatique', '2021-02-03 12:15:12', '2021-02-03 12:15:54'),
(4, 'Service de maintenance', '2021-02-03 12:15:42', '2021-02-03 12:15:42');

-- --------------------------------------------------------

--
-- Structure de la table `pareto`
--

DROP TABLE IF EXISTS `pareto`;
CREATE TABLE IF NOT EXISTS `pareto` (
  `idpareto` bigint(11) NOT NULL AUTO_INCREMENT,
  `idcausepareto` bigint(11) NOT NULL,
  `idindicateur` bigint(11) DEFAULT NULL,
  `pareto` varchar(255) DEFAULT NULL,
  `valeur` decimal(15,2) DEFAULT NULL,
  `description` text,
  `direction` bigint(11) DEFAULT NULL,
  `origine` bigint(11) DEFAULT NULL,
  `sqdip` bigint(11) DEFAULT NULL,
  `responsable` varchar(128) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`idpareto`),
  KEY `fk_pareto_causepareto` (`idcausepareto`),
  KEY `fk_pareto_indicateur` (`idindicateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pdca`
--

DROP TABLE IF EXISTS `pdca`;
CREATE TABLE IF NOT EXISTS `pdca` (
  `idpdca` bigint(11) NOT NULL AUTO_INCREMENT,
  `etat` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idpdca`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pdca`
--

INSERT INTO `pdca` (`idpdca`, `etat`, `created_at`, `updated_at`) VALUES
(1, 'President', '2021-02-03 11:35:48', '2021-02-03 11:35:48'),
(2, 'Directeur', '2021-02-03 11:36:06', '2021-02-03 11:36:06'),
(3, 'Collecteur', '2021-02-03 11:36:18', '2021-02-03 11:36:18'),
(4, 'Administrateur', '2021-02-03 11:36:33', '2021-02-03 11:36:33');

-- --------------------------------------------------------

--
-- Structure de la table `sqdip`
--

DROP TABLE IF EXISTS `sqdip`;
CREATE TABLE IF NOT EXISTS `sqdip` (
  `idsqdip` bigint(11) NOT NULL AUTO_INCREMENT,
  `sqdip` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idsqdip`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sqdip`
--

INSERT INTO `sqdip` (`idsqdip`, `sqdip`, `created_at`, `updated_at`) VALUES
(1, 'Securite', '2021-02-03 11:34:53', '2021-02-03 11:34:53'),
(2, 'Isolation', '2021-02-03 11:35:08', '2021-02-03 11:35:08'),
(3, 'Departements', '2021-02-03 11:35:17', '2021-02-03 11:35:31');

-- --------------------------------------------------------

--
-- Structure de la table `typeseuil`
--

DROP TABLE IF EXISTS `typeseuil`;
CREATE TABLE IF NOT EXISTS `typeseuil` (
  `idtypeseuil` bigint(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idtypeseuil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `telephone` text NOT NULL,
  `password` text NOT NULL,
  `ver_token` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `type` varchar(150) NOT NULL,
  `status` varchar(30) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '1',
  `department` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `telephone`, `password`, `ver_token`, `created_at`, `updated_at`, `type`, `status`, `is_verified`, `department`) VALUES
(5, 'Zome', 'Serges', 'zomeserges@gmail.com', '0755860555', '601f1889667efaebb33b8c12572835da3f027f78', NULL, '2021-01-22 20:14:09', '2021-01-22 20:14:09', 'Super Admin', 'active', 1, 'Securite'),
(6, 'KEMMOU TCHINDA', 'Desmond', 'kemou@gmail.com', '0660686578', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', NULL, '2021-02-23 22:06:02', '2021-01-25 15:33:22', 'Admin Indicateur', 'blocked', 1, 'Qualite'),
(7, 'Pegwe', 'Wadji Kemone', 'daniel@gmail.com', '057855878', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', NULL, '2021-01-24 09:23:34', '2021-01-25 15:25:03', 'Admin Pareto', 'deactivated', 1, 'Securite');

-- --------------------------------------------------------

--
-- Structure de la table `version`
--

DROP TABLE IF EXISTS `version`;
CREATE TABLE IF NOT EXISTS `version` (
  `version` bigint(11) NOT NULL AUTO_INCREMENT,
  `numversion` bigint(11) NOT NULL,
  PRIMARY KEY (`version`,`numversion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
