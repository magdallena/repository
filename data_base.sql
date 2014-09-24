-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas wygenerowania: 22 Wrz 2014, 14:22
-- Wersja serwera: 5.5.34
-- Wersja PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `data_base`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `application_id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `response` text NOT NULL,
  `response_date` date NOT NULL,
  PRIMARY KEY (`application_id`),
  KEY `offer_id` (`offer_id`,`student_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ask_for_reference`
--

CREATE TABLE IF NOT EXISTS `ask_for_reference` (
  `ask_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`ask_id`),
  KEY `student_id` (`student_id`,`teacher_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `company_id` (`company_id`,`student_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `e-mail` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `account_create_date` datetime NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `company`
--

INSERT INTO `company` (`company_id`, `name`, `address`, `telephone`, `e-mail`, `password`, `active`, `account_create_date`) VALUES
(1, 'IT company', '90-090 Gdańsk ul. Morska 145', '456854876', 'itcompany@poczta.pl', 'ef73781effc5774', 1, '2014-09-02 00:00:00'),
(2, 'DeveloperStudio', '12-345 Opole ul. Piłsudskiego 49', '876428400', 'devstudio@poczta.pl', 'ef73781effc5774', 1, '2014-09-03 00:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
  `offer_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `requirements` text NOT NULL,
  `place_of_work` varchar(25) NOT NULL,
  `employment_status` text NOT NULL,
  `salary` float NOT NULL,
  `date_from` date NOT NULL,
  PRIMARY KEY (`offer_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offer_to_student`
--

CREATE TABLE IF NOT EXISTS `offer_to_student` (
  `offer_to_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `requirements` text NOT NULL,
  `place_of_work` varchar(25) NOT NULL,
  `employment_status` text NOT NULL,
  `salary` float NOT NULL,
  `send_date` date NOT NULL,
  `response` text NOT NULL,
  `response_date` date NOT NULL,
  PRIMARY KEY (`offer_to_id`),
  KEY `company_id` (`company_id`,`student_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `refernces`
--

CREATE TABLE IF NOT EXISTS `refernces` (
  `references_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`references_id`),
  KEY `student_id` (`student_id`,`teacher_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `address` varchar(50) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `e-mail` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `education` text NOT NULL,
  `languages` text NOT NULL,
  `experience` text NOT NULL,
  `skills` text NOT NULL,
  `interest` text NOT NULL,
  `employment_form` text NOT NULL,
  `change_of_residence` tinyint(1) NOT NULL,
  `rate` float NOT NULL,
  `status` text NOT NULL,
  `account_creation_date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `student`
--

INSERT INTO `student` (`student_id`, `name`, `last_name`, `address`, `telephone`, `e-mail`, `password`, `education`, `languages`, `experience`, `skills`, `interest`, `employment_form`, `change_of_residence`, `rate`, `status`, `account_creation_date`, `active`, `is_admin`) VALUES
(1, 'Kamil', 'Wrona', '00-999 Warszawa ul. Cicha 17', '876654234', 'kmil.kamil@poczta.pl', 'ef73781effc5774', '2008-2011 II LO w Warszawie', 'angielski - poziom zaawansowany\r\nniemiecki - poziom zaawansowany', 'brak', 'PHP - poziom dobry\r\nJava - poziom dobry', 'sport, samochody', 'praktyki/staż', 0, 0, 'poszukuję praktyk lub stażu', '2014-09-01 00:00:00', 1, 0),
(2, 'Agata', 'Mińska', '11-234 Łódź ul. Jasna 3 m. 7', '343434341', 'agam@poczta.pl', 'ef73781effc5774', '2002-2005 XII LO w Krakowie\r\n2005-2010 Informatyka Uniwersytet Jagielloński', 'rosyjski - zaawansowany\r\nfrancuski - zaawansowany\r\nangielski - średni\r\nniemiecki - podstawy', '2010-2014 staż i praca w IT Business Solutions - programista Java i JavaScript', 'JavaScript - zaawansowany\r\nHTML5 - zaawansowany\r\nc++ - zaawansowany\r\nJava - zaawansowany\r\nSQL - średni', 'muzyka, kulinaria, ogrodnictwo', 'umowa o pracę', 1, 3000, 'poszukuję pracy', '2014-09-01 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `academic_degree` varchar(45) NOT NULL,
  `telephone` int(11) NOT NULL,
  `e-mail` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `account_creation_date` datetime NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `name`, `last_name`, `academic_degree`, `telephone`, `e-mail`, `password`, `active`, `account_creation_date`) VALUES
(1, 'Adam', 'Nowak', 'doktor', 123123123, 'nowak@poczta.pl', 'ef73781effc5774', 1, '2014-09-11 00:00:00'),
(2, 'Jan', 'Kowalski', 'magister', 987988788, 'kowalski@poczta.pl', 'ef73781effc5774', 1, '2014-09-02 00:00:00'),
(3, 'Anna', 'Bąk', 'profesor', 678678654, 'bak.anna@poczta.pl', 'ef73781effc5774', 1, '2014-09-03 00:00:00');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`offer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `ask_for_reference`
--
ALTER TABLE `ask_for_reference`
  ADD CONSTRAINT `ask_for_reference_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ask_for_reference_ibfk_2` FOREIGN KEY (`ask_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `offer_to_student`
--
ALTER TABLE `offer_to_student`
  ADD CONSTRAINT `offer_to_student_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offer_to_student_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `refernces`
--
ALTER TABLE `refernces`
  ADD CONSTRAINT `refernces_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `refernces_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
