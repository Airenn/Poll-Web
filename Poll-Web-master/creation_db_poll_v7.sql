-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 28 Décembre 2014 à 23:49
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
DROP DATABASE IF EXISTS `poll`;
CREATE DATABASE IF NOT EXISTS `poll` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `poll`;

-- --------------------------------------------------------

--
-- Structure de la table `operations`
--

CREATE TABLE IF NOT EXISTS `operations` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `date_prevue` date NOT NULL,
  `fermee` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `operations`
--

INSERT INTO `operations` (`ID`, `nom`, `date_prevue`, `fermee`) VALUES
(1, 'operation_erreur', '2014-12-22', 1),
(2, 'op1', '2014-12-22', 0);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `num_question` int(11) NOT NULL,
  `texte` text NOT NULL,
  `multi_rep` tinyint(1) NOT NULL DEFAULT '0',
  `fermee` tinyint(1) NOT NULL DEFAULT '1',
  `ID_operation` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`num_question`,`ID_operation`),
  UNIQUE KEY `UNIQUE_ID` (`ID`),
  KEY `FK_ID_operation` (`ID_operation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`ID`, `num_question`, `texte`, `multi_rep`, `fermee`, `ID_operation`) VALUES
(1, -1, 'question_erreur', 0, 1, 1),
(2, 1, 'op1_qu1', 0, 0, 2),
(3, 2, 'op1_qu2', 0, 1, 2);

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
  PRIMARY KEY (`ID`,`lettre_reponse`,`ID_question`),
  UNIQUE KEY `UNIQUE_ID` (`ID`),
  KEY `FK_ID_question` (`ID_question`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `reponses`
--

INSERT INTO `reponses` (`ID`, `lettre_reponse`, `texte`, `points`, `ID_question`) VALUES
(1, 'X', 'reponse_erreur', NULL, 1),
(2, 'A', 'op1_qu1_rep1', NULL, 2),
(3, 'B', 'op1_qu1_rep2', NULL, 2),
(4, 'C', 'op1_qu1_rep3', NULL, 2),
(5, 'A', 'op1_qu2_rep1', NULL, 3),
(6, 'D', 'op1_qu1_rep4', NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `num_tel` varchar(14) NOT NULL,
  `texte` text NOT NULL,
  `date_reception` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `erreur` tinyint(1) NOT NULL DEFAULT '0',
  `doublon` tinyint(1) NOT NULL DEFAULT '0',
  `retard` tinyint(1) NOT NULL DEFAULT '0',
  `ID_reponse` int(11) NOT NULL,
  `ID_question` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`num_tel`,`ID_reponse`,`ID_question`),
  UNIQUE KEY `UNIQUE_ID` (`ID`),
  KEY `FK_ID_question` (`ID_question`),
  KEY `FK_ID_reponse` (`ID_reponse`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`ID`, `num_tel`, `texte`, `date_reception`, `valide`, `erreur`, `doublon`, `retard`, `ID_reponse`, `ID_question`) VALUES
(1, '+33609692454', '1A', '2014-12-28 19:35:18', 1, 0, 0, 0, 2, 2),
(2, '+33609692454', '1B', '2014-12-28 19:35:18', 1, 0, 0, 0, 3, 2),
(3, '+33781439434', '1A', '2014-12-28 19:35:18', 1, 0, 0, 0, 2, 2),
(4, '+33609692454', '1D', '2014-12-28 19:35:18', 1, 0, 0, 0, 6, 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FK_questions_operation` FOREIGN KEY (`ID_operation`) REFERENCES `operations` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `FK_reponses_question` FOREIGN KEY (`ID_question`) REFERENCES `questions` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FK_messages_question` FOREIGN KEY (`ID_question`) REFERENCES `questions` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_messages_reponse` FOREIGN KEY (`ID_reponse`) REFERENCES `reponses` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
