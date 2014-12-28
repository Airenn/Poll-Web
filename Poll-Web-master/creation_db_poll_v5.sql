-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 28 Décembre 2014 à 15:58
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
  `date_reception` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categorie` text NOT NULL,
  `ID_reponse` int(11) NOT NULL,
  `ID_question` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_question` (`ID_question`),
  KEY `ID_reponse` (`ID_reponse`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`ID`, `num_tel`, `texte`, `date_reception`, `categorie`, `ID_reponse`, `ID_question`) VALUES
(1, '+33609692454', '1A', '2014-12-26 14:59:26', 'Valide', 3, 1),
(2, '+33609692454', '1B', '2014-12-26 14:59:26', 'Valide', 4, 1),
(3, '+33781439434', '1A', '2014-12-26 14:59:26', 'Valide', 3, 1),
(5, '+33609692454', '1D', '2014-12-26 16:29:23', 'Valide', 9, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `operations`
--

INSERT INTO `operations` (`ID`, `nom`, `date_prevue`, `fermee`) VALUES
(1, 'op1', '2014-12-22', 1);

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
  PRIMARY KEY (`ID`),
  KEY `ID_operation` (`ID_operation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`ID`, `num_question`, `texte`, `multi_rep`, `fermee`, `ID_operation`) VALUES
(1, 1, 'op1_qu1', 0, 1, 1),
(2, 2, 'op1_qu2', 0, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `reponses`
--

INSERT INTO `reponses` (`ID`, `lettre_reponse`, `texte`, `points`, `ID_question`) VALUES
(3, 'A', 'op1_qu1_rep1', 0, 1),
(4, 'B', 'op1_qu1_rep2', 0, 1),
(5, 'C', 'op1_qu1_rep3', 0, 1),
(6, 'A', 'op1_qu2_rep1', 0, 2),
(9, 'D', 'op1_qu1_rep4', NULL, 1);

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
