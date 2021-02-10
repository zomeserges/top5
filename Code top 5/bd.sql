-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 10 fév. 2021 à 15:13
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
  `iddirection` bigint(11) NOT NULL,
  `idgid` bigint(11) NOT NULL,
  `idorigine` bigint(11) NOT NULL,
  `responsable` varchar(255) DEFAULT NULL,
  `data_prevu` date DEFAULT NULL,
  `action` text,
  `plan_action` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idaction`),
  KEY `fk_action_pdca` (`idpdca`),
  KEY `fk_action_sqdip` (`idsqdip`),
  KEY `fk_action_escalade` (`idescalade`),
  KEY `fk_action_direction` (`iddirection`),
  KEY `fk_action_gid` (`idgid`),
  KEY `fk_action_origine` (`idorigine`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `action`
--

INSERT INTO `action` (`idaction`, `idpdca`, `idsqdip`, `idescalade`, `iddirection`, `idgid`, `idorigine`, `responsable`, `data_prevu`, `action`, `plan_action`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 1, 1, 2, 2, 'Zome serges', NULL, '<p>Enregistrement de la toute premiere action</p>', NULL, '2021-02-10 14:41:05', '2021-02-10 14:41:05'),
(2, 2, 3, 3, 3, 3, 3, 'Yvan', NULL, '<p>Deuxieme Action&nbsp;</p>', NULL, '2021-02-10 15:06:02', '2021-02-10 15:06:02');

-- --------------------------------------------------------

--
-- Structure de la table `causepareto`
--

DROP TABLE IF EXISTS `causepareto`;
CREATE TABLE IF NOT EXISTS `causepareto` (
  `idcausepareto` bigint(11) NOT NULL AUTO_INCREMENT,
  `cause` varchar(255) DEFAULT NULL,
  `description` text,
  `pareto` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idcausepareto`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `causepareto`
--

INSERT INTO `causepareto` (`idcausepareto`, `cause`, `description`, `pareto`, `created_at`, `updated_at`) VALUES
(1, 'Composants HS', '<p>Il s&#39;agit des composants tr&egrave;s <strong>vuln&eacute;rables</strong></p>', 'Erreur de protection', '2021-02-07 12:12:22', '2021-02-07 12:12:22'),
(2, 'Erreur humaine', 'HHHHHHHHHHHHHHHHHHHHHHHHHHHH', 'Erreur de DE CONSERVATION', '2021-02-07 13:54:33', '2021-02-07 14:34:09');

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
  `direction` varchar(255) DEFAULT NULL,
  `origine` varchar(255) DEFAULT NULL,
  `sqdip` varchar(255) DEFAULT NULL,
  `mini` bigint(4) DEFAULT NULL,
  `valeur` decimal(15,2) NOT NULL,
  `maxi` bigint(11) DEFAULT NULL,
  `a1` bigint(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`idindicateur`),
  KEY `fk_indicateur_direction` (`iddirection`),
  KEY `fk_indicateur_origine` (`idorigine`),
  KEY `fk_indicateur_sqdip` (`idsqdip`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `indicateur`
--

INSERT INTO `indicateur` (`idindicateur`, `iddirection`, `idorigine`, `idsqdip`, `indicateur`, `responsable`, `description`, `direction`, `origine`, `sqdip`, `mini`, `valeur`, `maxi`, `a1`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 'Valeur de testeur', 'Zome serges', '<p>Je suis d&#39;accord</p>', 'Qualite', 'Direction central', 'Isolation', 10, '12.00', 15, 13, '2021-02-09 15:06:53', '2021-02-10 12:08:54'),
(2, 3, 3, 3, 'Indicateur de Pareto', 'Yvan', '<p><b>Il indique la valeur du pareto</b></p>', 'Maintenance', 'Service informatique', 'Departements', 21, '25.00', 30, 22, '2021-02-09 15:33:34', '2021-02-09 15:33:34');

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
