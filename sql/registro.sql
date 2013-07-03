-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 21, 2013 at 09:46 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `registro`
--

-- --------------------------------------------------------

--
-- Table structure for table `CLASSE`
--

CREATE TABLE `CLASSE` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `ANNO` varchar(128) NOT NULL,
  `ISTITUTO` varchar(128) NOT NULL,
  `CLASSE` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `CLASSE`
--

INSERT INTO `CLASSE` VALUES(15, '2012-13', 'Economico', '4P');
INSERT INTO `CLASSE` VALUES(16, '2012-13', 'Economico', '3P');
INSERT INTO `CLASSE` VALUES(17, '2012-13', 'Economico', '5P');

-- --------------------------------------------------------

--
-- Table structure for table `CLASSE_PROFESSORE`
--

CREATE TABLE `CLASSE_PROFESSORE` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `CLASSE_ID` int(11) NOT NULL,
  `PROF_ID` int(11) NOT NULL,
  `MATERIA` varchar(128) DEFAULT NULL,
  `TESTO` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `CLASSE_ID` (`CLASSE_ID`),
  KEY `PROF_ID` (`PROF_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `CLASSE_PROFESSORE`
--

INSERT INTO `CLASSE_PROFESSORE` VALUES(1, 15, 21, 'Informatica', '');
INSERT INTO `CLASSE_PROFESSORE` VALUES(2, 15, 20, 'Matematica', '');
INSERT INTO `CLASSE_PROFESSORE` VALUES(3, 15, 19, 'Inglese', '');
INSERT INTO `CLASSE_PROFESSORE` VALUES(4, 15, 18, 'Storia', '');

-- --------------------------------------------------------

--
-- Table structure for table `CLASSE_STUDENTE`
--

CREATE TABLE `CLASSE_STUDENTE` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `CLASSE_ID` int(11) NOT NULL,
  `STUDENTE_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `CLASSE_ID` (`CLASSE_ID`),
  KEY `STUDENTE_ID` (`STUDENTE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `CLASSE_STUDENTE`
--

INSERT INTO `CLASSE_STUDENTE` VALUES(4, 15, 14);
INSERT INTO `CLASSE_STUDENTE` VALUES(5, 15, 15);
INSERT INTO `CLASSE_STUDENTE` VALUES(6, 15, 16);
INSERT INTO `CLASSE_STUDENTE` VALUES(7, 15, 17);

-- --------------------------------------------------------

--
-- Table structure for table `COMUNICAZIONE`
--

CREATE TABLE `COMUNICAZIONE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DATA` date NOT NULL,
  `TIPO` varchar(128) NOT NULL,
  `NOTA` varchar(1024) DEFAULT NULL,
  `ASSENZA_GIORNI` int(11) DEFAULT NULL,
  `ASSENZA_ORE` int(11) DEFAULT NULL,
  `PROF_ID` int(11) DEFAULT NULL,
  `STUDENTE_ID` int(11) NOT NULL,
  `GENITORE_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `PROF_ID` (`PROF_ID`),
  KEY `STUDENTE_ID` (`STUDENTE_ID`),
  KEY `GENITORE_ID` (`GENITORE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `COMUNICAZIONE`
--

INSERT INTO `COMUNICAZIONE` VALUES(1, '2013-05-20', 'Ingresso-Uscita', 'ingresso alle ore 10.00', NULL, 2, 19, 15, NULL);
INSERT INTO `COMUNICAZIONE` VALUES(2, '2013-05-21', 'Scuola-Famiglia', 'Indisposto dal 18-5 al 19-5', 2, NULL, NULL, 14, 22);

-- --------------------------------------------------------

--
-- Table structure for table `ENUM`
--

CREATE TABLE `ENUM` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `NOME` varchar(20) NOT NULL,
  `SEQUENZA` int(10) DEFAULT NULL,
  `VALORE` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `ENUM`
--

INSERT INTO `ENUM` VALUES(1, 'PERSONA RUOLO', 1, 'Professore');
INSERT INTO `ENUM` VALUES(2, 'PERSONA RUOLO', 2, 'Studente');
INSERT INTO `ENUM` VALUES(3, 'PERSONA RUOLO', 3, 'Genitore');
INSERT INTO `ENUM` VALUES(4, 'ANNO SCOLASTICO', 1, '2012-13');
INSERT INTO `ENUM` VALUES(5, 'ANNO SCOLASTICO', 2, '2013-14');
INSERT INTO `ENUM` VALUES(6, 'ANNO SCOLASTICO', 3, '2014-15');
INSERT INTO `ENUM` VALUES(7, 'ANNO SCOLASTICO', 4, '2015-16');
INSERT INTO `ENUM` VALUES(8, 'ANNO SCOLASTICO', 5, '2016-17');
INSERT INTO `ENUM` VALUES(9, 'ANNO SCOLASTICO', 6, '2017-18');
INSERT INTO `ENUM` VALUES(10, 'ISTITUTO', 1, 'Economico');
INSERT INTO `ENUM` VALUES(11, 'ISTITUTO', 2, 'Tecnologico');
INSERT INTO `ENUM` VALUES(12, 'ISTITUTO', 3, 'Socio Sanitaria');
INSERT INTO `ENUM` VALUES(32, 'TIPO PROVA', NULL, 'Scritto');
INSERT INTO `ENUM` VALUES(33, 'TIPO PROVA', NULL, 'Orale');
INSERT INTO `ENUM` VALUES(34, 'TIPO PROVA', NULL, 'Pratico');
INSERT INTO `ENUM` VALUES(35, 'MATERIA', 1, 'Matematica');
INSERT INTO `ENUM` VALUES(36, 'MATERIA', NULL, 'Italiano');
INSERT INTO `ENUM` VALUES(37, 'MATERIA', NULL, 'Informatica');
INSERT INTO `ENUM` VALUES(38, 'MATERIA', NULL, 'Storia');
INSERT INTO `ENUM` VALUES(39, 'MATERIA', NULL, 'Inglese');
INSERT INTO `ENUM` VALUES(40, 'MATERIA', NULL, 'Educazione Fisica');
INSERT INTO `ENUM` VALUES(41, 'MATERIA', NULL, 'Ragioneria');
INSERT INTO `ENUM` VALUES(42, 'MATERIA', NULL, 'Diritto');
INSERT INTO `ENUM` VALUES(43, 'MATERIA', NULL, 'Economia Politica');
INSERT INTO `ENUM` VALUES(44, 'MATERIA', NULL, 'Tecnica');
INSERT INTO `ENUM` VALUES(45, 'MATERIA', NULL, 'Religione');
INSERT INTO `ENUM` VALUES(46, 'TIPO_COMUNICAZIONE', 1, 'Scuola-Famiglia');
INSERT INTO `ENUM` VALUES(47, 'TIPO_COMUNICAZIONE', 2, 'Famiglia-Scuola');
INSERT INTO `ENUM` VALUES(48, 'TIPO_COMUNICAZIONE', 3, 'Assenza');
INSERT INTO `ENUM` VALUES(49, 'TIPO_COMUNICAZIONE', 4, 'Ingresso-Uscita');
INSERT INTO `ENUM` VALUES(50, 'TIPO_COMUNICAZIONE', 5, 'Circolare');

-- --------------------------------------------------------

--
-- Table structure for table `PERSONA`
--

CREATE TABLE `PERSONA` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `NOME` varchar(20) NOT NULL,
  `COGNOME` varchar(20) NOT NULL,
  `NASCITA` date DEFAULT NULL,
  `RUOLO` varchar(128) NOT NULL,
  `INDIRIZZO` varchar(40) NOT NULL,
  `CAP` varchar(128) NOT NULL,
  `CITTA` varchar(15) NOT NULL,
  `TELEFONO` varchar(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `PERSONA`
--

INSERT INTO `PERSONA` VALUES(14, 'Elia', 'Suardi', '1995-06-27', 'Studente', 'Piazza Vittorio Veneto, 4', '24060', 'Endine Gaiano', '3453113506');
INSERT INTO `PERSONA` VALUES(15, 'Matteo', 'Peloni', '1995-12-31', 'Studente', '', '', '', '');
INSERT INTO `PERSONA` VALUES(16, 'Luca', 'Guizzetti', '1970-01-01', 'Studente', '', '', '', '');
INSERT INTO `PERSONA` VALUES(17, 'Katia', 'Carrella', '1970-01-01', 'Studente', '', '', '', '');
INSERT INTO `PERSONA` VALUES(18, 'Piero', 'Manera', '1970-01-01', 'Professore', '', '', '', '');
INSERT INTO `PERSONA` VALUES(19, 'Anna', 'Martone', '0000-00-00', 'Professore', '', '', '', '');
INSERT INTO `PERSONA` VALUES(20, 'Ivana', 'Fratus', '1970-01-01', 'Professore', '', '', '', '');
INSERT INTO `PERSONA` VALUES(21, 'Donato', 'Avigliano', '1970-01-01', 'Professore', '', '', '', '');
INSERT INTO `PERSONA` VALUES(22, 'Paola', 'Moroni', '1970-01-01', 'Genitore', '', '', '', '123456789');
INSERT INTO `PERSONA` VALUES(24, 'Linda', 'Gallini', '1970-01-01', 'Genitore', '', '', '', '');
INSERT INTO `PERSONA` VALUES(25, 'Gianfranco', 'Guizzetti', '1970-01-01', 'Genitore', '', '', '', '');
INSERT INTO `PERSONA` VALUES(26, 'Sara', 'Martinelli', '1995-06-27', 'Studente', '', '', 'Sovere', '');
INSERT INTO `PERSONA` VALUES(27, 'Elena', 'Bertoletti', '1970-01-01', 'Genitore', '', '', '', '');
INSERT INTO `PERSONA` VALUES(28, 'Cristian', 'Antoci', '1970-01-01', 'Studente', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `VALUTAZIONE`
--

CREATE TABLE `VALUTAZIONE` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `DATA` date DEFAULT NULL,
  `TIPO` varchar(128) NOT NULL,
  `VOTO` double NOT NULL,
  `NOTA` varchar(30) DEFAULT NULL,
  `FIRMA` varchar(20) DEFAULT NULL,
  `PROF_ID` int(11) NOT NULL,
  `STUDENTE_ID` int(11) NOT NULL,
  `CLASSE_ID` int(11) NOT NULL,
  `MATERIA` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PROF_ID` (`PROF_ID`),
  KEY `STUDENTE_ID` (`STUDENTE_ID`),
  KEY `CLASSE_ID` (`CLASSE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `VALUTAZIONE`
--

INSERT INTO `VALUTAZIONE` VALUES(1, '2013-05-20', 'Scritto', 5, '', '', 18, 14, 15, 'Storia');
INSERT INTO `VALUTAZIONE` VALUES(2, '2013-05-20', 'Orale', 10, '', '', 19, 14, 15, 'Inglese');
INSERT INTO `VALUTAZIONE` VALUES(3, '2013-05-20', 'Scritto', 8, '', '', 20, 14, 15, 'Matematica');
INSERT INTO `VALUTAZIONE` VALUES(4, '2013-05-20', 'Pratico', 9.5, '', '', 21, 14, 15, 'Informatica');
INSERT INTO `VALUTAZIONE` VALUES(5, '2013-05-20', 'Orale', 6, '', '', 20, 14, 15, 'Matematica');
INSERT INTO `VALUTAZIONE` VALUES(6, '2013-05-20', 'Scritto', 9, '', '', 18, 15, 15, 'Storia');
INSERT INTO `VALUTAZIONE` VALUES(7, '2013-05-20', 'Scritto', 7.5, NULL, NULL, 19, 15, 15, 'Inglese');
INSERT INTO `VALUTAZIONE` VALUES(8, '2013-05-20', 'Orale', 6.5, '', '', 20, 15, 15, 'Matematica');
INSERT INTO `VALUTAZIONE` VALUES(9, '2013-05-20', 'Pratico', 9, '', '', 21, 15, 15, 'Informatica');
INSERT INTO `VALUTAZIONE` VALUES(10, '2013-05-20', 'Orale', 8, '', '', 18, 15, 15, 'Storia');
INSERT INTO `VALUTAZIONE` VALUES(11, '2013-05-20', 'Scritto', 6.5, '', '', 18, 16, 15, 'Storia');
INSERT INTO `VALUTAZIONE` VALUES(12, '2013-05-20', 'Orale', 5.5, '', '', 19, 16, 15, 'Inglese');
INSERT INTO `VALUTAZIONE` VALUES(13, '2013-05-20', 'Scritto', 7, '', '', 20, 16, 15, 'Matematica');
INSERT INTO `VALUTAZIONE` VALUES(14, '2013-05-20', 'Pratico', 8.5, '', '', 21, 16, 15, 'Informatica');
INSERT INTO `VALUTAZIONE` VALUES(15, '2013-05-20', 'Orale', 6, '', '', 21, 16, 15, 'Informatica');
INSERT INTO `VALUTAZIONE` VALUES(16, '2013-05-20', 'Scritto', 9.5, '', '', 18, 17, 15, 'Storia');
INSERT INTO `VALUTAZIONE` VALUES(17, '2013-05-20', 'Scritto', 10, '', '', 19, 17, 15, 'Inglese');
INSERT INTO `VALUTAZIONE` VALUES(18, '2013-05-20', 'Scritto', 8.5, '', '', 20, 17, 15, 'Matematica');
INSERT INTO `VALUTAZIONE` VALUES(19, '2013-05-20', 'Orale', 6.5, NULL, NULL, 21, 17, 15, 'Informatica');
INSERT INTO `VALUTAZIONE` VALUES(20, '2013-05-20', 'Pratico', 5.5, '', '', 21, 17, 15, 'Informatica');
INSERT INTO `VALUTAZIONE` VALUES(21, '2013-05-21', 'Scritto', 9, '', '', 18, 26, 15, 'Storia');
INSERT INTO `VALUTAZIONE` VALUES(22, '2013-05-21', 'Orale', 9.5, '', '', 19, 26, 15, 'Inglese');
INSERT INTO `VALUTAZIONE` VALUES(23, '2013-05-21', 'Pratico', 8, '', '', 20, 26, 15, 'Matematica');
INSERT INTO `VALUTAZIONE` VALUES(24, '2013-05-21', 'Pratico', 7.5, '', '', 21, 26, 15, 'Informatica');
INSERT INTO `VALUTAZIONE` VALUES(25, '2013-05-21', 'Orale', 8.5, '', '', 20, 26, 15, 'Matematica');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CLASSE_PROFESSORE`
--
ALTER TABLE `CLASSE_PROFESSORE`
  ADD CONSTRAINT `CLASSE_PROFESSORE_ibfk_1` FOREIGN KEY (`CLASSE_ID`) REFERENCES `CLASSE` (`ID`),
  ADD CONSTRAINT `CLASSE_PROFESSORE_ibfk_2` FOREIGN KEY (`PROF_ID`) REFERENCES `PERSONA` (`ID`);

--
-- Constraints for table `CLASSE_STUDENTE`
--
ALTER TABLE `CLASSE_STUDENTE`
  ADD CONSTRAINT `CLASSE_STUDENTE_ibfk_1` FOREIGN KEY (`CLASSE_ID`) REFERENCES `CLASSE` (`ID`),
  ADD CONSTRAINT `CLASSE_STUDENTE_ibfk_2` FOREIGN KEY (`STUDENTE_ID`) REFERENCES `PERSONA` (`ID`);

--
-- Constraints for table `COMUNICAZIONE`
--
ALTER TABLE `COMUNICAZIONE`
  ADD CONSTRAINT `COMUNICAZIONE_ibfk_1` FOREIGN KEY (`PROF_ID`) REFERENCES `PERSONA` (`ID`),
  ADD CONSTRAINT `COMUNICAZIONE_ibfk_2` FOREIGN KEY (`STUDENTE_ID`) REFERENCES `PERSONA` (`ID`),
  ADD CONSTRAINT `COMUNICAZIONE_ibfk_3` FOREIGN KEY (`GENITORE_ID`) REFERENCES `PERSONA` (`ID`);

--
-- Constraints for table `VALUTAZIONE`
--
ALTER TABLE `VALUTAZIONE`
  ADD CONSTRAINT `VALUTAZIONE_ibfk_1` FOREIGN KEY (`PROF_ID`) REFERENCES `PERSONA` (`ID`),
  ADD CONSTRAINT `VALUTAZIONE_ibfk_2` FOREIGN KEY (`STUDENTE_ID`) REFERENCES `PERSONA` (`ID`),
  ADD CONSTRAINT `VALUTAZIONE_ibfk_3` FOREIGN KEY (`CLASSE_ID`) REFERENCES `CLASSE` (`ID`);
