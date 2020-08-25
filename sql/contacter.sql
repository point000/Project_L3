-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 25 Août 2020 à 16:07
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `contacter`
--

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `Id_Com` int(11) NOT NULL AUTO_INCREMENT,
  `Comment` text NOT NULL,
  `Pseudo` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_Com`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=202 ;

--
-- Contenu de la table `forum`
--

INSERT INTO `forum` (`Id_Com`, `Comment`, `Pseudo`) VALUES
(189, 'Nice congratulation ! ', 'KOKO'),
(195, 'i like the idea !!!', 'ADRAR'),
(196, 'yes i agree with you ', 'KOKO'),
(201, 'Finally i can sleep with my own bed', 'ADRAR');

-- --------------------------------------------------------

--
-- Structure de la table `personnes`
--

CREATE TABLE IF NOT EXISTS `personnes` (
  `Id` int(255) NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Passeword` varchar(255) NOT NULL,
  `Aut_key` int(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `personnes`
--

INSERT INTO `personnes` (`Id`, `Username`, `Email`, `Passeword`, `Aut_key`) VALUES
(14, 'KOKO', 'llol89178@gmail.com', '$2y$10$G23ze8Bjvy0PfRy6lgprfeI8EAwLS2fsX1Uk6i7ZmxrWadegJ1PLO', 1),
(18, 'ADRAR', 'boff70296@gmail.com', '$2y$10$UnF8eA6i4jrSXAn1kzrCJORdWsf5.X.uOxo3w4d1VpPSe4XNo/YHO', 1);

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `id_v` int(11) NOT NULL AUTO_INCREMENT,
  `User_name` varchar(255) NOT NULL,
  `Value` varchar(255) NOT NULL,
  PRIMARY KEY (`id_v`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `rating`
--

INSERT INTO `rating` (`id_v`, `User_name`, `Value`) VALUES
(2, 'KOKO', ''),
(3, 'ADRAR', 'Good');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
