-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 23 Décembre 2014 à 11:53
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `poll`
--
CREATE DATABASE IF NOT EXISTS `poll` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `poll`;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `num_tel` varchar(14) NOT NULL,
  `texte` text NOT NULL,
  `categorie` text NOT NULL,
  `ID_reponse` int(11) NOT NULL,
  `ID_question` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_question` (`ID_question`),
  KEY `ID_reponse` (`ID_reponse`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`ID`, `num_tel`, `texte`, `categorie`, `ID_reponse`, `ID_question`) VALUES
(1, '+33609692454', '1A', 'Valide', 3, 1),
(2, '+33609692454', '1B', 'Valide', 4, 1),
(3, '+33781439434', '1A', 'Valide', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `operations`
--

CREATE TABLE IF NOT EXISTS `operations` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `date_prevue` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `operations`
--

INSERT INTO `operations` (`ID`, `nom`, `date_prevue`) VALUES
(1, 'test_1', '2014-12-22');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `num_question` int(11) NOT NULL,
  `texte` text NOT NULL,
  `ID_operation` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_operation` (`ID_operation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`ID`, `num_question`, `texte`, `ID_operation`) VALUES
(1, 1, 'test_1_question_1', 1),
(2, 2, 'test_1_question_2', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE IF NOT EXISTS `reponses` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `lettre_reponse` varchar(1) NOT NULL,
  `texte` text NOT NULL,
  `points` int(11) DEFAULT NULL,
  `ID_question` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_question` (`ID_question`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `reponses`
--

INSERT INTO `reponses` (`ID`, `lettre_reponse`, `texte`, `points`, `ID_question`) VALUES
(3, 'A', 'test_1_question_1_reponse_1', 0, 1),
(4, 'B', 'test_1_question_1_reponse_2', 0, 1),
(5, 'C', 'test_1_question_1_reponse_3', 0, 1),
(6, 'A', 'test_1_question_2_reponse_1', 0, 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_id_question` FOREIGN KEY (`ID_question`) REFERENCES `questions` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_id_reponse` FOREIGN KEY (`ID_reponse`) REFERENCES `reponses` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_id_operation` FOREIGN KEY (`ID_operation`) REFERENCES `operations` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `reponses_id_question` FOREIGN KEY (`ID_question`) REFERENCES `questions` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
