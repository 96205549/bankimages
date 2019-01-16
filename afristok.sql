-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 15 Janvier 2019 à 08:48
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `afristok`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE IF NOT EXISTS `abonnement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datedeb` varchar(50) NOT NULL,
  `datefin` varchar(50) NOT NULL DEFAULT '0',
  `idclient` int(11) NOT NULL,
  `idpack` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `idtransaction` int(11) NOT NULL,
  `actif` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`idclient`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `abonnement`
--

INSERT INTO `abonnement` (`id`, `datedeb`, `datefin`, `idclient`, `idpack`, `type`, `idtransaction`, `actif`) VALUES
(1, '2018-12-13 11:32:13', '2019-01-13 00:00:00', 10, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `date_at` date NOT NULL,
  `date_up` date NOT NULL,
  `statut` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `access`
--

INSERT INTO `access` (`id`, `description`, `keyword`, `date_at`, `date_up`, `statut`) VALUES
(4, 'Gestions des videos', 'video', '2018-08-01', '2018-08-01', 1),
(1, 'Gestions des categories', 'categorie', '2018-07-31', '2018-07-31', 1),
(2, 'Gestions des images', 'image', '2018-07-31', '2018-07-31', 0),
(5, 'Gestions des abonn&eacute;es', 'abonnee', '2018-08-01', '2018-08-01', 1),
(6, 'galley des images et videos', 'gallery', '2018-08-05', '2018-08-05', 1),
(7, 'Gestions des utilisateurs', 'utilisateur', '2018-08-05', '2018-08-05', 1),
(8, 'Gestions des messages', 'message', '2018-08-05', '2018-08-05', 1);

-- --------------------------------------------------------

--
-- Structure de la table `acheter`
--

CREATE TABLE IF NOT EXISTS `acheter` (
  `idpanier` int(11) unsigned NOT NULL,
  `idproduit` int(11) unsigned NOT NULL,
  `taille` varchar(50) DEFAULT NULL,
  `qtecommandee` int(11) unsigned NOT NULL DEFAULT '1',
  `totalvente` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`idpanier`,`idproduit`),
  KEY `fk_acheter_produit_idx` (`idproduit`),
  KEY `fk_acheter_panier_idx` (`idpanier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `acheter`
--

INSERT INTO `acheter` (`idpanier`, `idproduit`, `taille`, `qtecommandee`, `totalvente`) VALUES
(1, 10, 'moyenne', 1, 50),
(2, 3, 'moyenne', 1, 50),
(2, 4, 'moyenne', 1, 50),
(2, 5, 'moyenne', 1, 50),
(2, 6, 'moyenne', 1, 50),
(2, 11, 'moyenne', 1, 50),
(2, 21, 'moyenne', 1, 60),
(2, 22, 'moyenne', 1, 60),
(4, 14, 'moyenne', 1, 60),
(5, 6, 'moyenne', 1, 50),
(9, 5, 'moyenne', 1, 50),
(11, 5, 'grande', 1, 100),
(12, 6, 'moyenne', 1, 50),
(13, 2, 'moyenne', 1, 50),
(13, 13, 'moyenne', 1, 50);

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpays` int(11) NOT NULL,
  `ville` varchar(200) NOT NULL,
  `region` varchar(150) NOT NULL,
  `boitePostal` varchar(150) NOT NULL,
  `idclient` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`id`, `idpays`, `ville`, `region`, `boitePostal`, `idclient`) VALUES
(1, 1, 'Cotonou', 'godmey', '01BP2015', 19),
(2, 1, 'Cotonou', 'cotonou', '01BP2015', 2),
(3, 1, 'Cotonou', 'cotonou', '01BP2015', 4),
(4, 1, 'Cotonou', 'cotonou', '01BP2015', 5),
(5, 1, 'Cotonou', 'cotonou', '01BP2015', 6),
(6, 1, 'yrey', 'yery', 'yrey', 7);

-- --------------------------------------------------------

--
-- Structure de la table `afriquestock_image`
--

CREATE TABLE IF NOT EXISTS `afriquestock_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagelink` varchar(250) NOT NULL,
  `taille` varchar(50) NOT NULL,
  `width` varchar(50) NOT NULL,
  `height` varchar(50) NOT NULL,
  `idimg` int(11) NOT NULL,
  `idcategorie` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Contenu de la table `afriquestock_image`
--

INSERT INTO `afriquestock_image` (`id`, `imagelink`, `taille`, `width`, `height`, `idimg`, `idcategorie`) VALUES
(1, '191118/1911180443212246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '2306', '3418', 1, '0050359c65547c702512ca24662609aa7f9e60a7'),
(2, '191118/191118044321bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '1658', '2486', 1, '0050359c65547c702512ca24662609aa7f9e60a7'),
(3, '191118/191118044321faa2de14e669b2f0296186a0536d57b1.jpg', 'petite', '620', '932', 1, '0050359c65547c702512ca24662609aa7f9e60a7'),
(4, '191118/1911180444402246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '2448', '3696', 2, '0050359c65547c702512ca24662609aa7f9e60a7'),
(5, '191118/191118044440bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '1658', '2486', 2, '0050359c65547c702512ca24662609aa7f9e60a7'),
(6, '191118/191118044440faa2de14e669b2f0296186a0536d57b1.jpg', 'petite', '620', '932', 2, '0050359c65547c702512ca24662609aa7f9e60a7'),
(7, '191118/1911180453302246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '2388', '3294', 3, '0050359c65547c702512ca24662609aa7f9e60a7'),
(8, '191118/191118045330bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '1228', '1692', 3, '0050359c65547c702512ca24662609aa7f9e60a7'),
(9, '191118/1911180453306030aeacd2c6966614df4a521de923eb.jpg', 'petite', '632', '872', 3, '0050359c65547c702512ca24662609aa7f9e60a7'),
(10, '191118/1911180454522246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '3744', '5616', 4, '0050359c65547c702512ca24662609aa7f9e60a7'),
(11, '191118/191118045452bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '1658', '2486', 4, '0050359c65547c702512ca24662609aa7f9e60a7'),
(12, '191118/191118045452faa2de14e669b2f0296186a0536d57b1.jpg', 'petite', '620', '932', 4, '0050359c65547c702512ca24662609aa7f9e60a7'),
(13, '191118/1911180459052246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '3744', '5616', 5, '0050359c65547c702512ca24662609aa7f9e60a7'),
(14, '191118/191118045905bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '1658', '2486', 5, '0050359c65547c702512ca24662609aa7f9e60a7'),
(15, '191118/191118045905faa2de14e669b2f0296186a0536d57b1.jpg', 'petite', '620', '932', 5, '0050359c65547c702512ca24662609aa7f9e60a7'),
(16, '191118/1911180500262246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '5616', '3744', 6, '0050359c65547c702512ca24662609aa7f9e60a7'),
(17, '191118/191118050026bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '3096', '2070', 6, '0050359c65547c702512ca24662609aa7f9e60a7'),
(18, '191118/191118050026faa2de14e669b2f0296186a0536d57b1.jpg', 'petite', '675', '449', 6, '0050359c65547c702512ca24662609aa7f9e60a7'),
(19, '191118/1911180501512246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '5616', '3744', 7, '0050359c65547c702512ca24662609aa7f9e60a7'),
(20, '191118/191118050151bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '3096', '2070', 7, '0050359c65547c702512ca24662609aa7f9e60a7'),
(21, '191118/191118050151faa2de14e669b2f0296186a0536d57b1.jpg', 'petite', '696', '466', 7, '0050359c65547c702512ca24662609aa7f9e60a7'),
(22, '191118/1911180505392246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '5616', '3744', 8, '76c7b363ac7cc60f42bf2fe0e2114d12305de7a4'),
(23, '191118/191118050539bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '3096', '2070', 8, '76c7b363ac7cc60f42bf2fe0e2114d12305de7a4'),
(24, '191118/191118050539faa2de14e669b2f0296186a0536d57b1.jpg', 'petite', '675', '449', 8, '76c7b363ac7cc60f42bf2fe0e2114d12305de7a4'),
(25, '191118/1911180507022246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '5616', '3744', 9, 'b19dab42c3ed43a00635950e43371ad1c1ae7cd8'),
(26, '191118/191118050702bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '3096', '2070', 9, 'b19dab42c3ed43a00635950e43371ad1c1ae7cd8'),
(27, '191118/1911180515362246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '3744', '5616', 10, 'b19dab42c3ed43a00635950e43371ad1c1ae7cd8'),
(28, '191118/191118051536bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '1658', '2486', 10, 'b19dab42c3ed43a00635950e43371ad1c1ae7cd8'),
(29, '191118/191118051536faa2de14e669b2f0296186a0536d57b1.jpg', 'petite', '620', '932', 10, 'b19dab42c3ed43a00635950e43371ad1c1ae7cd8'),
(30, '191118/1911180516462246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '3744', '5616', 11, 'a021cbebd205f1e5bfd7bf56ba691b4c1aa7ec56'),
(31, '191118/191118051646bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '1658', '2486', 11, 'a021cbebd205f1e5bfd7bf56ba691b4c1aa7ec56'),
(32, '191118/1911180516466030aeacd2c6966614df4a521de923eb.jpg', 'petite', '620', '932', 11, 'a021cbebd205f1e5bfd7bf56ba691b4c1aa7ec56'),
(33, '191118/1911180517582246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '5616', '3744', 12, '0050359c65547c702512ca24662609aa7f9e60a7'),
(34, '191118/191118051758bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '3096', '2070', 12, '0050359c65547c702512ca24662609aa7f9e60a7'),
(35, '191118/191118051758faa2de14e669b2f0296186a0536d57b1.jpg', 'petite', '675', '449', 12, '0050359c65547c702512ca24662609aa7f9e60a7'),
(36, '191118/19111811003205917306836339985a6b009badc166ba.jpg', 'grande', '3744', '5616', 13, '0050359c65547c702512ca24662609aa7f9e60a7'),
(37, '191118/191118110032bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '1658', '2486', 13, '0050359c65547c702512ca24662609aa7f9e60a7'),
(38, '191118/191118110032faa2de14e669b2f0296186a0536d57b1.jpg', 'petite', '620', '932', 13, '0050359c65547c702512ca24662609aa7f9e60a7'),
(39, '191118/1911181112432246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '3744', '5616', 20, '0050359c65547c702512ca24662609aa7f9e60a7'),
(40, '191118/191118111243bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '1658', '2486', 20, '0050359c65547c702512ca24662609aa7f9e60a7'),
(41, '191118/191118111243faa2de14e669b2f0296186a0536d57b1.jpg', 'petite', '620', '932', 20, '0050359c65547c702512ca24662609aa7f9e60a7'),
(42, '191118/1911181115312246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '3744', '5616', 21, '0050359c65547c702512ca24662609aa7f9e60a7'),
(43, '191118/191118111532bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '1658', '2486', 21, '0050359c65547c702512ca24662609aa7f9e60a7'),
(44, '191118/191118111532faa2de14e669b2f0296186a0536d57b1.jpg', 'petite', '620', '932', 21, '0050359c65547c702512ca24662609aa7f9e60a7'),
(45, '191118/1911181156202246007ef032cd63855c51869ba0c9fb.jpg', 'grande', '3744', '5616', 22, 'ba25b43357523d7b014e7b08fb4ed8c9ca661a65'),
(46, '191118/191118115620bec5e72cea07bd026dc473e7b974a66a.jpg', 'moyenne', '1658', '2486', 22, 'ba25b43357523d7b014e7b08fb4ed8c9ca661a65'),
(47, '191118/191118115620faa2de14e669b2f0296186a0536d57b1.jpg', 'petite', '620', '932', 22, 'ba25b43357523d7b014e7b08fb4ed8c9ca661a65'),
(48, '070119/0701190423046b50f9863045d3e7bfd49fe4fe188c10.jpg', 'grande', '426', '280', 23, '0050359c65547c702512ca24662609aa7f9e60a7'),
(49, '070119/0701190423046b50f9863045d3e7bfd49fe4fe188c10.jpg', 'moyenne', '426', '280', 23, '0050359c65547c702512ca24662609aa7f9e60a7'),
(50, '070119/0701190423046b50f9863045d3e7bfd49fe4fe188c10.jpg', 'petite', '426', '280', 23, '0050359c65547c702512ca24662609aa7f9e60a7'),
(51, '070119/0701190441321a25489930a0455172293e7f1f1aeada.jpg', 'grande', '700', '472', 24, '0050359c65547c702512ca24662609aa7f9e60a7'),
(52, '070119/0701190441321a25489930a0455172293e7f1f1aeada.jpg', 'moyenne', '700', '472', 24, '0050359c65547c702512ca24662609aa7f9e60a7'),
(53, '070119/0701190441321a25489930a0455172293e7f1f1aeada.jpg', 'petite', '700', '472', 24, '0050359c65547c702512ca24662609aa7f9e60a7'),
(54, '070119/070119044230cd77306f9eb387525675ee571c48199d.jpg', 'grande', '445', '334', 25, '76c7b363ac7cc60f42bf2fe0e2114d12305de7a4'),
(55, '070119/070119044230cd77306f9eb387525675ee571c48199d.jpg', 'moyenne', '445', '334', 25, '76c7b363ac7cc60f42bf2fe0e2114d12305de7a4'),
(56, '070119/070119044230cd77306f9eb387525675ee571c48199d.jpg', 'petite', '445', '334', 25, '76c7b363ac7cc60f42bf2fe0e2114d12305de7a4');

-- --------------------------------------------------------

--
-- Structure de la table `caracteristique_video`
--

CREATE TABLE IF NOT EXISTS `caracteristique_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(250) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `valeur` varchar(250) NOT NULL,
  `id_video` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCat` varchar(200) NOT NULL,
  `nomCategorie` varchar(250) NOT NULL,
  `parent` varchar(200) NOT NULL DEFAULT '0',
  `iduser` int(11) NOT NULL,
  `dateat` varchar(20) NOT NULL,
  `dateup` varchar(20) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `idCat`, `nomCategorie`, `parent`, `iduser`, `dateat`, `dateup`, `statut`) VALUES
(1, '0050359c65547c702512ca24662609aa7f9e60a7', 'ecole', '0', 1, '2018-11-16 15:05:25', '2018-11-16 15:05:25', 1),
(2, '76c7b363ac7cc60f42bf2fe0e2114d12305de7a4', 'classe', '0050359c65547c702512ca24662609aa7f9e60a7', 1, '2018-11-16 15:15:39', '2018-11-16 15:15:39', 1),
(3, 'b19dab42c3ed43a00635950e43371ad1c1ae7cd8', 'banc', '0050359c65547c702512ca24662609aa7f9e60a7', 1, '2018-11-16 15:15:55', '2018-11-16 15:15:55', 1),
(4, 'a021cbebd205f1e5bfd7bf56ba691b4c1aa7ec56', 'zoo', '0', 1, '2018-11-18 21:21:06', '2018-11-18 21:21:06', 1),
(5, 'ba25b43357523d7b014e7b08fb4ed8c9ca661a65', 'beautÃ©', '0', 1, '2018-11-19 23:54:39', '2018-11-19 23:54:39', 1);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `password` varchar(150) NOT NULL,
  `idpays` int(11) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `boitePostale` varchar(255) DEFAULT NULL,
  `codevalidate` varchar(150) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `email`, `telephone`, `password`, `idpays`, `ville`, `region`, `boitePostale`, `codevalidate`, `statut`, `type`) VALUES
(1, 'Toure', 'Ibrahim', 'tourbra@gmail.com', '67556565', 'azer', 1, 'Cotonou', 'Littoral', 'BP 66666', 'c64b8348cfdd2dd49b66e2c00ae3cb2c10cb3683', 0, 'photographe'),
(2, 'KANTE', 'Blaise', 'kant@gmail.com', '6666666', 'ver', 1, 'Parakou', 'Nord', 'BP 5656565', '06e7bd6dbd2e8e6913c6546758131cf0f6689dd2', 0, 'Contributeur'),
(3, 'BA', 'Samson', 'basam@gmail.com', '6666666', 'tyu', 2, 'Lome', 'Sud', 'BP 66666', '8f5d3a96c9b6f08cb0dbe527f19325fa4531d443', 0, 'Contributeur'),
(4, 'HOUNTON', 'Wilfried', 'wilfriedhount@gmail.com', '67556566', 'aze', 1, 'Cotonou', 'Littoral', 'BP 555555', 'f7fed2e50a4e16a7f6fd20bff1080123a3d6db35', 0, 'photographe'),
(5, 'CADJA', 'Fiacre', 'c56@gmail.com', '55555666', 'sdf', 1, 'Porto', 'Sud', 'BP 66655', '04e7416ebac032b5123c93048dd3934c20619cff', 0, 'photographe'),
(6, 'kaffo', 'ztertzt', 'gg@yahoo.fr', '+22996205549', 'demo', 1, 'Cotonou', 'cotonou', '01BP2015', '1b8d67be1d87a71a132b08e496b470b6f57b8fbe', 0, 'photographe'),
(7, 'kaffo', 'ztertzt', 'gg@yahoo.fr', '+22996205549', 'demo', 1, 'Cotonou', 'cotonou', '01BP2015', '1e8683867dbd01f26ca904a30089348dd1e0d862', 0, 'photographe'),
(8, 'kaffo', 'ztertzt', 'gg@yahoo.fr', '+22996205549', 'demo', 1, 'Cotonou', 'cotonou', '01BP2015', '6058ce2aeb06f91af87dfc3699f928ba58016335', 0, '0'),
(9, 'kaffo', 'gsgg', 'bouraimajoezers@gmail.com', 'gsg', 'demo', 1, 'gsgs', 'sgegs', 'gsgs', 'fc323e9cd820ca74a90beb545fdb7147fd78194a', 0, 'photographe'),
(10, 'kaffo', 'jojo', 'bouraimajoezer@gmail.com', '+22996205549', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', 1, 'Cotonou', 'akpakpa', '06bp3110', '9715063da66b86c46e07a7735af88c6fc9af5b0d', 0, 'contributeur'),
(11, 'kaffo', 'jamal', 'bouraimajoezer@yahoo.fr', '+22996205549', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', 1, 'calavie', '0485', '06bp3110', '0bd367f12e7ad25d82994712c7d038b3410fb0f7', 1, 'contributeur'),
(12, 'zinsou', 'samuel', 'bouraimajoezer@yahoo.fr', NULL, '89e495e7941cf9e40e6980d14a16bf023ccd4c91', NULL, NULL, NULL, NULL, '59c6b8953611c1935353f19a6938015cdf08f8e6', 0, '0'),
(13, 'dansou', 'josuÃ©', 'tj-tech@twicejoetech.com', '+22996205549', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', 1, 'cotonou', 'akpakpa', '01BP2015', '50fe6c9df30a2e9233ccd90526e500650a187b57', 1, 'contributeur');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `idcommande` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `refcommande` varchar(250) DEFAULT NULL,
  `datecommande` bigint(20) unsigned DEFAULT NULL,
  `statutcommande` tinyint(1) NOT NULL DEFAULT '0',
  `totalcommande` int(11) NOT NULL DEFAULT '0',
  `identiteclient` varchar(250) DEFAULT NULL,
  `adresseclient` varchar(250) DEFAULT NULL,
  `telclient` bigint(15) DEFAULT NULL,
  `adressefacture` varchar(250) DEFAULT NULL,
  `dateupdate` bigint(20) DEFAULT NULL,
  `totalremise` int(11) unsigned NOT NULL DEFAULT '0',
  `tva` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`idcommande`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commander`
--

CREATE TABLE IF NOT EXISTS `commander` (
  `idcommande` int(11) unsigned NOT NULL,
  `idproduit` int(11) unsigned NOT NULL,
  `qtecommandee` int(11) unsigned NOT NULL DEFAULT '0',
  `totalvente` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`idcommande`,`idproduit`),
  KEY `fk_commander_produit_idx` (`idproduit`),
  KEY `fk_commander_commande_idx` (`idcommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE IF NOT EXISTS `facture` (
  `idfacture` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reffacture` varchar(250) DEFAULT NULL,
  `datefacture` bigint(20) unsigned DEFAULT NULL,
  `idcommande` int(11) unsigned NOT NULL,
  PRIMARY KEY (`idfacture`),
  KEY `fk_facture_commande_idx` (`idcommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `formule`
--

CREATE TABLE IF NOT EXISTS `formule` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `formule`
--

INSERT INTO `formule` (`id`, `libelle`, `description`) VALUES
(1, 'pro', 'abonnement pro'),
(5, 'sssgssgsgsgsd', 'sgsgsg'),
(3, '15 images', 'pack de 15'),
(4, 'Accueil', 'chambre climatisÃ© avec tÃ©lÃ©');

-- --------------------------------------------------------

--
-- Structure de la table `imagecontributeur`
--

CREATE TABLE IF NOT EXISTS `imagecontributeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(55) NOT NULL,
  `idClient` int(11) NOT NULL,
  `description` text,
  `motcle` varchar(250) DEFAULT NULL,
  `categorie` varchar(200) DEFAULT '0',
  `date` varchar(50) NOT NULL,
  `validite` enum('-1','0','1','') NOT NULL DEFAULT '0',
  `archiver` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Contenu de la table `imagecontributeur`
--

INSERT INTO `imagecontributeur` (`id`, `image`, `idClient`, `description`, `motcle`, `categorie`, `date`, `validite`, `archiver`) VALUES
(5, 'images/photo/gi.jpg', 10, 'fille Ã  l''Ã©cole', 'rentrÃ© scolaire, milieu,livre,vaccance,etudiante,Ã©cole', '0050359c65547c702512ca24662609aa7f9e60a7', '2018-12-04 14:44:33', '1', 0),
(2, 'images/photo/eyes2.jpg', 10, 'regard vers le haut', 'fixÃ© le ciel, yeux, regard haut,prunel', 'b19dab42c3ed43a00635950e43371ad1c1ae7cd8', '2018-12-04 14:17:10', '1', 0),
(3, 'images/photo/881484382-1024x1024.jpg', 10, 'tzyzeyzy', 'tyzea', '0050359c65547c702512ca24662609aa7f9e60a7', '2018-12-04 14:17:36', '-1', 0),
(6, 'images/photo/img5.jpeg', 10, 'confÃ©rence ', 'confÃ©rence,spectacle,assemblÃ©', '76c7b363ac7cc60f42bf2fe0e2114d12305de7a4', '2018-12-04 16:53:04', '1', 0),
(7, 'images/photo/img.jpeg', 10, 'qsqgvsqb', 'qggzeg,zergzer,geg,zeg,ezgzeg', 'b19dab42c3ed43a00635950e43371ad1c1ae7cd8', '2018-12-04 16:53:13', '1', 0),
(8, 'images/photo/img.jpg', 10, 'zzagzagagagazga', 'agzagzag,agzagzra,gazg,azrg,azrgzragzrage', '0050359c65547c702512ca24662609aa7f9e60a7', '2018-12-04 16:53:28', '1', 0),
(40, '../public/images/photo/gouv1.jpg', 10, NULL, NULL, '0', '2018-12-12 16:14:39', '0', 0),
(10, 'images/photo/petit.jpg', 10, 'sein femme noir', 'bout de sein, sein ronde, boule de sein', 'ba25b43357523d7b014e7b08fb4ed8c9ca661a65', '2018-12-05 16:41:42', '1', 0),
(15, 'images/photo/v4.jpg', 13, NULL, NULL, '0', '2018-12-08 10:23:03', '0', 0),
(52, '../public/images/photo/gouv1.jpg', 10, NULL, NULL, '0', '2018-12-19 17:26:25', '0', 0),
(19, '../public/images/photo/gouv2.jpg', 10, NULL, NULL, '0', '2018-12-12 15:11:21', '0', 0),
(49, '../public/images/photo/Moyen.jpg', 10, NULL, NULL, '0', '2018-12-14 16:27:33', '0', 0),
(42, '../public/images/photo/gi.jpg', 10, NULL, NULL, '0', '2018-12-13 09:44:26', '0', 0),
(28, '../public/images/photo/4.jpg', 10, NULL, NULL, '0', '2018-12-12 15:19:33', '0', 0),
(29, '../public/images/photo/12.jpg', 10, NULL, NULL, '0', '2018-12-12 15:24:30', '0', 0),
(30, '../public/images/photo/1.jpg', 10, NULL, NULL, '0', '2018-12-12 15:24:34', '0', 0),
(34, '../public/images/photo/8.jpg', 10, NULL, NULL, '0', '2018-12-12 15:24:50', '0', 0);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `idimage` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `description` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `motcle` text CHARACTER SET latin1,
  `extension` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `signature` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `affiche` varchar(200) DEFAULT NULL,
  `type` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `iduser` int(11) NOT NULL,
  `idcategorie` varchar(200) CHARACTER SET latin1 NOT NULL,
  `imageID` varchar(20) CHARACTER SET latin1 NOT NULL,
  `photographe` int(11) NOT NULL,
  `prixG` int(11) NOT NULL,
  `prixM` int(11) NOT NULL,
  `prixP` int(11) NOT NULL,
  `width` varchar(50) DEFAULT NULL,
  `height` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idimage`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`idimage`, `nom`, `description`, `motcle`, `extension`, `signature`, `affiche`, `type`, `iduser`, `idcategorie`, `imageID`, `photographe`, `prixG`, `prixM`, `prixP`, `width`, `height`) VALUES
(1, NULL, 'ztzey r yyey yetu ururu ru ru reu er ue ut', 'AF#231426191118,ztezez,yzuzu,uuzu,zuuerurueu,utruu', 'jpg', '191118/1911180443217c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118044321278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#231426191118', 1, 100, 50, 35, '187', '280'),
(2, NULL, 'sdfsgsqsh  hsdhsdhds hsd', 'AF#255898191118,gsgshs,fhfhdf,dhdhd', 'jpg', '191118/1911180444407c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118044440278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#255898191118', 1, 100, 50, 35, '187', '280'),
(3, NULL, 'iirurubuy yz yz y e ureureuerie', 'AF#14924191118,tttzttztt,tztztztrzet,rztzteztezteztz,yezyezyezezyehrutur', 'jpg', '191118/191118045330b122738f21bf9390cd59cbd5e6f52328.jpg', '191118/191118045330278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#14924191118', 1, 100, 50, 35, '205', '280'),
(4, NULL, 'eyeryreureureueruuru', 'AF#254599191118,zzzeyzeyz ,yeyzyzyyutrutrir,tityitryruiyt,rtyr', 'jpg', '191118/1911180454527c46c83ec637a3ef8e070224395e74aa.jpg', '191118/1911180454520836299c8ed7980aaee6cec9d51e5a44.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#254599191118', 1, 100, 50, 35, '186', '280'),
(5, NULL, 'gsgsgs dd ds hs dh sdhdsh', 'AF#29335191118,stqqsgsqgq', 'jpg', '191118/1911180459057c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118045905278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#29335191118', 1, 100, 50, 35, '186', '280'),
(6, NULL, 'yzye euer ut ueru re ureu reu reu er', 'AF#181697191118,rztztzatzatzatzat,tttyyyrurur,yzy,zy,yzyu,uerureure', 'jpg', '191118/1911180500267c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118050026278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#181697191118', 1, 100, 50, 35, '422', '280'),
(7, NULL, 'eyyeyryrereuer ureuerureuer', 'AF#29426191118,zqqzgqgsqg,fufjfjfujut,yiouuyipu,rtyu,fjfjtyu', 'jpg', '191118/1911180501517c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118050151278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#29426191118', 1, 100, 50, 35, '426', '280'),
(8, NULL, 'djjdfdjdfj', 'AF#365297191118,qqgqgsqgqsg', 'jpg', '191118/1911180505397c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118050539278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, 'ba25b43357523d7b014e7b08fb4ed8c9ca661a65', 'AF#365297191118', 1, 100, 50, 35, '425', '280'),
(9, NULL, 'hshshshshs hshrhrhrhhrhrhr hrer', 'AF#15347191118,sgsgsggdhdhd,qhhdsdhdshsh,shshshh', 'jpg', '191118/1911180507027c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118050702278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, 'ba25b43357523d7b014e7b08fb4ed8c9ca661a65', 'AF#15347191118', 1, 100, 50, 35, '425', '280'),
(10, NULL, 'eezyzy zuzuzuzu', 'AF#915737191118,ytyyz,zyzyyyzuerre,urureuerurr,uzz', 'jpg', '191118/1911180515367c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118051536278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, 'a021cbebd205f1e5bfd7bf56ba691b4c1aa7ec56', 'AF#915737191118', 1, 100, 50, 35, '187', '280'),
(11, NULL, 'zuzuzu zuzuzuzuz', 'AF#104595191118,ttzyzey zyzeyze', 'jpg', '191118/1911180516467c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118051646278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, '76c7b363ac7cc60f42bf2fe0e2114d12305de7a4', 'AF#104595191118', 1, 100, 50, 35, '187', '280'),
(12, NULL, 'zyzeyzy zz zz uzzzyzy', 'AF#998368191118,attyyzzy,zeyzyzy,yzyzyzy', 'jpg', '191118/1911180517587c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118051758278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, 'ba25b43357523d7b014e7b08fb4ed8c9ca661a65', 'AF#998368191118', 1, 100, 50, 35, '419', '280'),
(13, NULL, 'zteztzeze zehze hez h hehe hreh', 'AF#365871191118,gsgsfdhdshdshs,hhd,hd,sh,ddsjsdjssj,s,hs,s,hs,hyshsdhs', 'jpg', '191118/1911181100317c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118110031278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, 'ba25b43357523d7b014e7b08fb4ed8c9ca661a65', 'AF#365871191118', 1, 100, 50, 35, '187', '280'),
(14, NULL, 'zzeezhz eheh he he he', 'AF#364965191118,tztzetezzeezy,zyzyyey,y,zyzyeyeyeye,ejurjur', 'jpg', '191118/191118110244b122738f21bf9390cd59cbd5e6f52328.jpg', '191118/191118110244278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#364965191118', 1, 100, 60, 35, '419', '280'),
(15, NULL, 'zzeezhz eheh he he he', 'AF#745943191118,tztzetezzeezy,zyzyyey,y,zyzyeyeyeye,ejurjur', 'jpg', '191118/191118110304b122738f21bf9390cd59cbd5e6f52328.jpg', '191118/191118110304278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#745943191118', 1, 100, 60, 35, '419', '280'),
(16, NULL, 'qhqhhdshds hdshdshdshdsh', 'AF#454454191118,qdfegsdhdg,hdh,dh,hsdhdshdshd,shdsh,dshdsh,ds,hdshdsh', 'jpg', '191118/191118110422995322b800ff4ec9b2c2ba20a6db9c79.jpg', '191118/191118110422278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, 'b19dab42c3ed43a00635950e43371ad1c1ae7cd8', 'AF#454454191118', 1, 100, 60, 35, '187', '280'),
(17, NULL, 'qhqhhdshds hdshdshdshdsh', 'AF#756427191118,qdfegsdhdg,hdh,dh,hsdhdshdshd,shdsh,dshdsh,ds,hdshdsh', 'jpg', '191118/191118110438995322b800ff4ec9b2c2ba20a6db9c79.jpg', '191118/191118110438278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, 'b19dab42c3ed43a00635950e43371ad1c1ae7cd8', 'AF#756427191118', 1, 100, 60, 35, '187', '280'),
(18, NULL, 'hdhd hhsd hds', 'AF#515755191118,egeggsf,g,g,g,,s,gs', 'jpg', '191118/1911181105507c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118110550278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#515755191118', 10, 100, 60, 35, '187', '280'),
(19, NULL, 'hdhd hhsd hds', 'AF#457475191118,egeggsf,g,g,g,,s,gs', 'jpg', '191118/1911181112217c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118111221278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#457475191118', 1, 100, 60, 35, '187', '280'),
(20, NULL, 'hdhd hhsd hds', 'AF#106437191118,egeggsf,g,g,g,,s,gs', 'jpg', '191118/1911181112437c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118111243278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#106437191118', 1, 100, 60, 35, '187', '280'),
(21, NULL, 'gegez zehzehzhh', 'AF#392337191118,sdhdsh shsdh,hdhh,urur,zt', 'jpg', '191118/1911181115317c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118111531278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#392337191118', 1, 100, 60, 35, '186', '280'),
(22, NULL, 'sgsgddhsdhsdhhfdfdjfd sdhdshsdhsd qgq', 'AF#708329191118,eztzeyzeyze,yzeyzey,zeyzey,eztzu,reuer,sststsd', 'jpg', '191118/1911181156207c46c83ec637a3ef8e070224395e74aa.jpg', '191118/191118115620278e2405d8f9dcdc82eee4d5eeca098d.jpg', 'Gratuit', 1, 'ba25b43357523d7b014e7b08fb4ed8c9ca661a65', 'AF#708329191118', 1, 100, 60, 35, '186', '280'),
(23, NULL, 'sqfzqg gqgqgz', 'AF#698540070119,sgsgqsggsqg,sgsqgs,gedjhrjr,hdfhfdjhf,hsdh', 'jpg', '070119/0701190423041e3c6c2c89cad9255a52968e48a177ea.jpg', '070119/0701190423046b50f9863045d3e7bfd49fe4fe188c10.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#698540070119', 1, 100, 60, 35, '426', '280'),
(24, NULL, 'sqgsqsqgsqg', 'AF#70666070119,qsfs,sqgsqgq,q,gsfq,gsq,gsqg,sg', 'jpg', '070119/0701190441325bdcab7791c98bb22469c034870994b9.jpg', '070119/0701190441321a25489930a0455172293e7f1f1aeada.jpg', 'Gratuit', 1, '0050359c65547c702512ca24662609aa7f9e60a7', 'AF#70666070119', 1, 100, 60, 35, '700', '472'),
(25, NULL, 'qrgqg', 'AF#381310070119,zerqgvzeqqe', 'jpg', '070119/070119044230cd77306f9eb387525675ee571c48199d.jpg', '070119/070119044230cd77306f9eb387525675ee571c48199d.jpg', 'Gratuit', 1, '76c7b363ac7cc60f42bf2fe0e2114d12305de7a4', 'AF#381310070119', 1, 100, 60, 35, '445', '334');

-- --------------------------------------------------------

--
-- Structure de la table `imagevendu`
--

CREATE TABLE IF NOT EXISTS `imagevendu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproduit` int(11) NOT NULL,
  `idphotographe` int(11) NOT NULL,
  `taille` varchar(50) NOT NULL DEFAULT 'moyenne',
  `prix` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `imagevendu`
--

INSERT INTO `imagevendu` (`id`, `idproduit`, `idphotographe`, `taille`, `prix`, `date`) VALUES
(1, 1, 10, 'moyenne', 30, '05-12-2018 10:05:28'),
(2, 5, 10, 'moyenne', 15, '11-12-2018 17:00:01'),
(3, 13, 10, 'moyenne', 15, '11-12-2018 17:00:01'),
(4, 5, 10, 'moyenne', 8, '11-12-2018 17:09:15'),
(5, 13, 10, 'moyenne', 8, '11-12-2018 17:09:15'),
(6, 5, 10, 'moyenne', 8, '11-12-2018 17:26:52'),
(7, 13, 10, 'moyenne', 8, '11-12-2018 17:26:52'),
(8, 9, 10, 'moyenne', 8, '11-12-2018 17:44:14'),
(9, 13, 10, 'moyenne', 8, '11-12-2018 17:44:14'),
(10, 21, 10, 'moyenne', 9, '11-12-2018 17:44:14'),
(11, 13, 10, 'moyenne', 8, '12-12-2018 08:32:38'),
(12, 21, 10, 'moyenne', 9, '12-12-2018 08:32:38'),
(13, 4, 10, 'moyenne', 8, '13-12-2018 17:09:19'),
(14, 6, 10, 'moyenne', 8, '13-12-2018 17:09:19'),
(15, 12, 10, 'moyenne', 8, '13-12-2018 17:09:20'),
(16, 22, 10, 'moyenne', 9, '13-12-2018 17:09:20'),
(17, 5, 10, 'moyenne', 8, '13-12-2018 17:12:43'),
(18, 2, 10, 'moyenne', 8, '13-12-2018 17:14:46'),
(19, 1, 10, 'moyenne', 8, '13-12-2018 17:19:43'),
(20, 13, 10, 'moyenne', 8, '14-12-2018 12:21:43'),
(21, 22, 10, 'moyenne', 9, '14-12-2018 14:23:08');

-- --------------------------------------------------------

--
-- Structure de la table `pack`
--

CREATE TABLE IF NOT EXISTS `pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `idtype` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `idformule` int(11) NOT NULL,
  `idperiode` int(11) NOT NULL,
  `nbreimage` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `pack`
--

INSERT INTO `pack` (`id`, `libelle`, `idtype`, `prix`, `idformule`, `idperiode`, `nbreimage`) VALUES
(1, 'pack de 55 images', 1, 50000, 1, 1, 55),
(2, 'pack de 66 images', 3, 3, 1, 2, 66),
(3, 'pack de 100 images', 1, 500, 1, 2, 100),
(4, 'pack de 200 images', 2, 450, 3, 1, 200),
(5, 'pack de 300 images', 1, 45, 3, 1, 300);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE IF NOT EXISTS `panier` (
  `idpanier` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `datecreation` bigint(20) DEFAULT NULL,
  `totalcommande` int(11) unsigned NOT NULL DEFAULT '0',
  `identiteclient` varchar(250) DEFAULT NULL,
  `adresseclient` varchar(250) DEFAULT NULL,
  `telclient` bigint(15) DEFAULT NULL,
  `adressefacture` varchar(250) DEFAULT NULL,
  `dateupdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idpanier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`idpanier`, `datecreation`, `totalcommande`, `identiteclient`, `adresseclient`, `telclient`, `adressefacture`, `dateupdate`) VALUES
(1, 1544599901, 110, '10', NULL, NULL, NULL, '12-12-2018 08:32:38'),
(2, 1544709125, 0, NULL, NULL, NULL, NULL, NULL),
(3, 1544710073, 0, NULL, NULL, NULL, NULL, NULL),
(4, 1544710208, 50, '10', NULL, NULL, NULL, '13-12-2018 17:19:43'),
(5, 1544774066, 0, NULL, NULL, NULL, NULL, NULL),
(6, 1544774077, 60, '10', NULL, NULL, NULL, '14-12-2018 14:23:08'),
(7, 1545033578, 0, NULL, NULL, NULL, NULL, NULL),
(8, 1545055491, 0, NULL, NULL, NULL, NULL, NULL),
(9, 1545062787, 0, NULL, NULL, NULL, NULL, NULL),
(10, 1545063687, 0, NULL, NULL, NULL, NULL, NULL),
(11, 1545138834, 0, NULL, NULL, NULL, NULL, NULL),
(12, 1545236603, 0, NULL, NULL, NULL, NULL, NULL),
(13, 1545295803, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `payer`
--

CREATE TABLE IF NOT EXISTS `payer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codetransaction` varchar(100) NOT NULL,
  `montant` int(11) NOT NULL DEFAULT '0',
  `datepaiement` varchar(50) DEFAULT NULL,
  `idclient` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codetransaction` (`codetransaction`),
  KEY `fk_payer_facture_idx` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `payer`
--

INSERT INTO `payer` (`id`, `codetransaction`, `montant`, `datepaiement`, `idclient`) VALUES
(1, '910', 100, '11-12-2018 16:40:03', 10),
(4, '913', 100, '11-12-2018 16:43:02', 10),
(5, '914', 100, '11-12-2018 17:00:01', 10),
(6, '915', 100, '11-12-2018 17:09:15', 10),
(7, '916', 100, '11-12-2018 17:26:52', 10),
(8, '917', 160, '11-12-2018 17:44:13', 10),
(9, '920', 100, '12-12-2018 08:30:10', 10),
(11, '921', 110, '12-12-2018 08:32:38', 10),
(13, '925', 210, '13-12-2018 17:09:19', 10),
(16, '926', 50, '13-12-2018 17:12:43', 10),
(18, '927', 50, '13-12-2018 17:14:46', 10),
(20, '928', 50, '13-12-2018 17:19:42', 10),
(22, '931', 50, '14-12-2018 12:21:43', 10),
(24, '932', 60, '14-12-2018 14:23:08', 10);

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE IF NOT EXISTS `pays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nompays` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `pays`
--

INSERT INTO `pays` (`id`, `nompays`) VALUES
(1, 'BENIN'),
(2, 'TOGO');

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

CREATE TABLE IF NOT EXISTS `periode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taux` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `periode`
--

INSERT INTO `periode` (`id`, `taux`) VALUES
(1, 'Mensuel'),
(2, 'Annuel');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelletype` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`id`, `libelletype`, `description`) VALUES
(1, 'Grand', 'Image de grande resolution'),
(2, 'Moyen', 'Image de resolution moyenne'),
(3, 'Petit', 'Image de petite resolution');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `dateat` varchar(20) NOT NULL,
  `dateup` varchar(20) NOT NULL,
  `typeUser` int(11) NOT NULL DEFAULT '0',
  `statut` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `login`, `password`, `dateat`, `dateup`, `typeUser`, `statut`) VALUES
(1, 'bouraima', 'joezer', 'bouraimajoezer@gmail.com', 'admin', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', '2018-07-31', '2018-07-31', -1, 1),
(18, 'johnson', 'antoine', 'ltopanou@yahoo.fr', 'rokico', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', '2018-08-05', '2018-08-05', 0, 1),
(17, 'johnson', 'antoine', 'ltopanou@yahoo.fr', 'rokico', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', '2018-08-05', '2018-08-05', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_access`
--

CREATE TABLE IF NOT EXISTS `user_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `idaccess` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `user_access`
--

INSERT INTO `user_access` (`id`, `iduser`, `idaccess`) VALUES
(1, 17, 4),
(2, 17, 1),
(3, 17, 2),
(4, 17, 5),
(5, 17, 6),
(6, 18, 4),
(7, 18, 1),
(8, 18, 2),
(9, 18, 5),
(10, 18, 6);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE IF NOT EXISTS `ville` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomVille` varchar(200) NOT NULL,
  `idPays` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ville`
--

INSERT INTO `ville` (`id`, `nomVille`, `idPays`) VALUES
(1, 'cotonou', 1),
(2, 'lome', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
