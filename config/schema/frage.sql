-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 13, 2010 at 08:15 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `prodem`
--

-- --------------------------------------------------------

--
-- Table structure for table `fr_encuestas`
--

DROP TABLE IF EXISTS `fr_encuestas`;
CREATE TABLE `fr_encuestas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `publicar` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fr_encuestas`
--

INSERT INTO `fr_encuestas` (`id`, `nombre`) VALUES
(1, 'About CakePHP plugins'),
(2, 'About frage plugin');

-- --------------------------------------------------------

--
-- Table structure for table `fr_preguntas`
--

DROP TABLE IF EXISTS `fr_preguntas`;
CREATE TABLE `fr_preguntas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fr_encuesta_id` int(10) DEFAULT NULL,
  `pregunta` varchar(255) DEFAULT NULL,
  `tipo` int(10) DEFAULT NULL,
  `multiple` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `fr_preguntas`
--

INSERT INTO `fr_preguntas` (`id`, `fr_encuesta_id`, `pregunta`, `tipo`, `multiple`) VALUES
(1, 1, 'Do you use CakePHP plugins?', 1, 0),
(2, 1, 'How much?', 2, 0),
(3, 1, 'Do you find them better than plain CakePHP? Why?', 3, 0),
(4, 2, 'Will you help me improving it?', 1, 0),
(5, 1, 'Which Framework is better?', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fr_opciones`
--

DROP TABLE IF EXISTS `fr_opciones`;
CREATE TABLE `fr_opciones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fr_pregunta_id` int(10) NOT NULL,
  `opcion` varchar(255) NOT NULL,
  `tipo` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `fr_opciones`
--

INSERT INTO `fr_opciones` (`id`, `fr_pregunta_id`, `opcion`, `tipo`) VALUES
(1, 0, 'Sí', 1), (2, 0, 'No', 1), -- Yes / No
(3, 0, 1, 2), (4, 0, 2, 2), (5, 0, 3, 2), (6, 0, 4, 2), (7, 0, 5, 2),  -- 1 to 5
(8, 0, 'FR_TEXT', 3); -- free text

-- --------------------------------------------------------

--
-- Table structure for table `fr_preguntas_votos`
--

DROP TABLE IF EXISTS `fr_preguntas_votos`;
CREATE TABLE `fr_preguntas_votos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `fr_pregunta_id` int(11) NOT NULL,
  `fr_opcion_id` int(11) NOT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `fr_preguntas_votos`
--


