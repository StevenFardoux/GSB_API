-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 30 mars 2023 à 13:57
-- Version du serveur : 10.3.29-MariaDB-0+deb10u1
-- Version de PHP : 7.3.29-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sio`
--

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`idMedecin`, `nom`, `prenom`, `mail`, `motDePasse`, `dateCreation`, `rpps`, `dateDiplome`, `dateConsentement`) VALUES
(1, 'JDP', 'BLEEEEh', 'lefrevre.paul@gmail.com', 'paul62', '2023-03-10 16:14:15', NULL, '2022-12-11', NULL),
(2, 'durand', 'Pierre', 'pierredurand@gmail.com', 'pierredurand', '2023-03-01 16:14:15', NULL, '2004-03-02', NULL),
(3, 'bodar', 'damien', 'bodardamien@hotmail.Fr', 'azerty62', '2015-03-12 16:14:42', NULL, '2013-03-12', NULL),
(4, 'lafouche', 'lucie', 'lucielafouche', 'chaton87', '1994-03-01 16:14:42', NULL, '1983-03-01', NULL),
(5, 'mirabelle', 'george', 'mirabelle.george', 'pommedeterre', '2022-10-15 16:17:03', NULL, '2022-05-27', NULL),
(6, 'dupont', 'justine', 'justine.dupont@hotmail.fr', 'lavieestbelle', '2022-01-15 16:17:03', NULL, '2021-03-05', NULL),
(7, 'delacroix', 'samuel', 'samueldelacroix@gmail.com', 'fgazr457', NULL, NULL, '2020-05-17', NULL),
(8, 'banor', 'sophie', 'banor.sophie@hotmail.fr', 'banorsophie', '2014-03-20 16:20:20', NULL, '2012-03-14', NULL),
(9, 'ponteau', 'jules', 'ponteau.jules@gmail.com', 'julllle', '2023-03-10 16:21:24', NULL, '2023-03-05', '2023-03-11'),
(10, 'lamiche', 'ines', 'lamiche.ines@gmail.com', 'nesssmiche', '2019-03-22 16:21:24', NULL, '2014-03-24', '2019-03-13');

--
-- Déchargement des données de la table `visite`
--

INSERT INTO `visite` (`idVisite`, `idMedecin`, `idVisiteur`, `adresse`, `dateVisite`) VALUES
(1, 9, 5, 'zaeazeza', '2023-03-30 16:30:43'),
(3, 7, 5, '25 rue derose, 62400 bethune', '2023-01-09 16:31:35'),
(4, 9, 7, '3 rue jeanpaul, 62670 mazingarbe', '2020-03-17 16:31:35'),
(5, 5, 4, '16 boulevard fleuri, 62000 Arras', '2023-03-23 16:32:39'),
(6, 1, 3, '67 rue degaulle, 59000 Lille', '2023-05-18 16:32:39'),
(9, 2, 10, '63 rue racine, 62300 Lens', '2023-04-15 16:35:26'),
(10, 8, 4, '12 rue boulanger, 62000 Arras', '2023-08-31 16:35:26'),
(12, 7, 3, '9 rue picardie, 59000 Lille', '2023-01-09 16:36:52'),
(13, 3, 7, '36 rue pierre, 62300 Lens', '2022-08-25 16:38:34'),
(40, 6, 5, 'azeaze', '2023-03-22 21:24:01'),
(41, 5, 4, 'azeazeaze', '2023-03-22 21:24:14'),
(46, 8, 7, 'azeaze', '2023-03-22 22:47:22'),
(47, 4, 18, 'zaeazaz', '2023-03-22 22:48:21'),
(51, 2, 2, 'aaaaaaaa', '2023-03-22 23:41:15'),
(52, 2, 2, 'qqqqqqqqqq', '2023-03-16 23:53:00');

--
-- Déchargement des données de la table `visiteur`
--

INSERT INTO `visiteur` (`idVisiteur`, `nom`, `prenom`) VALUES
(2, 'test', 'tes'),
(3, 'haute', 'sage'),
(4, 'dyq', 'derek'),
(5, 'Royce', 'Jill'),
(6, 'trialfa', 'chad'),
(7, 'bobsi', 'isabella'),
(8, 'rossie', 'stephen'),
(9, 'rossie', 'jade'),
(10, 'josy', 'maya'),
(16, 'John Doe', 'gardener'),
(17, 'John Doe', 'gardener'),
(18, 'John Doe', 'gardener'),
(19, 'John Doe', 'gardener'),
(20, 'John Doe', 'gardener'),
(21, 'John Doe', 'gardener'),
(23, 'test', 'test'),
(24, 'Marounet', 'Julien'),
(27, 'etib', 'lana');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
