-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas wygenerowania: 09 Lis 2014, 19:01
-- Wersja serwera: 5.6.14
-- Wersja PHP: 5.5.6

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
  `cv` varchar(40) NOT NULL,
  `motivation_letter` varchar(40) NOT NULL,
  `response` text,
  `response_date` date DEFAULT NULL,
  PRIMARY KEY (`application_id`),
  KEY `offer_id` (`offer_id`,`student_id`),
  KEY `student_id` (`student_id`),
  KEY `date` (`date`),
  KEY `date_2` (`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Zrzut danych tabeli `application`
--

INSERT INTO `application` (`application_id`, `offer_id`, `student_id`, `date`, `status`, `cv`, `motivation_letter`, `response`, `response_date`) VALUES
(1, 2, 3, '2014-10-19', '0', 'cv-32014-10-19-19-42.txt', 'motivation_letter-32014-10-19-19-42.txt', 'zdgsdf', '2014-11-03'),
(2, 5, 3, '2014-11-03', '0', 'bla.txt', 'bla2.txt', 'asdfsdf', '2014-11-03'),
(3, 5, 1, '2014-11-03', '0', 'bla.txt', 'bla2.txt', 'sfdsdf', '2014-11-03'),
(4, 6, 3, '2014-11-03', '0', 'cv-32014-11-03-20-07.txt', 'motivation_letter-32014-11-03-20-07.txt', NULL, NULL),
(6, 7, 3, '2014-11-03', '0', 'cv-32014-11-03-20-11.txt', 'motivation_letter-32014-11-03-20-11.txt', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ask_for_reference`
--

CREATE TABLE IF NOT EXISTS `ask_for_reference` (
  `ask_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 - oczekujące, 1 - zignorowane lub wysłane',
  PRIMARY KEY (`ask_id`),
  KEY `student_id` (`student_id`,`teacher_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `ask_for_reference`
--

INSERT INTO `ask_for_reference` (`ask_id`, `student_id`, `teacher_id`, `message`, `date`, `status`) VALUES
(1, 3, 2, 'sfsdfvds', '2014-10-17', 0),
(2, 3, 8, 'asdsadf', '2014-10-18', 1),
(3, 3, 1, 'dfsjdbskzdvlkisefugoluskd', '2014-11-25', 0);

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
  `e_mail` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `account_create_date` date NOT NULL,
  `photoname` varchar(30) NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `company`
--

INSERT INTO `company` (`company_id`, `name`, `address`, `telephone`, `e_mail`, `password`, `active`, `account_create_date`, `photoname`) VALUES
(1, 'IT company', '90-090 Gdańsk ul. Morska 145', '456854876', 'itcompany@poczta.pl', 'ef73781effc5774100f87fe2f437a435', 1, '2014-09-02', 'itcompany.jpg'),
(2, 'DeveloperStudio', '12-345 Opole ul. Piłsudskiego 49', '876428400', 'devstudio@poczta.pl', 'ef73781effc5774100f87fe2f437a435', 1, '2014-09-03', 'developer.jpg'),
(3, 'itfirm', 'ul. Zana 2 \r\n99-999 Lublin', '111111111', 'it@o2.pl', '22d7fe8c185003c98f97e5d6ced420c7', 1, '2014-10-09', 'itfirm2014-10-12-19-15.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
  `offer_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `job` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `requirements` text NOT NULL,
  `place_of_work` varchar(25) NOT NULL,
  `employment_status` text NOT NULL,
  `number_of_hours` int(11) NOT NULL,
  `length_of_contract` varchar(40) NOT NULL,
  `salary` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  PRIMARY KEY (`offer_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `offer`
--

INSERT INTO `offer` (`offer_id`, `company_id`, `job`, `description`, `requirements`, `place_of_work`, `employment_status`, `number_of_hours`, `length_of_contract`, `salary`, `date_from`, `date_to`) VALUES
(1, 3, 'java developer', 'asfdadfs', 'asd', 'asdasd', 'umowa zlecenie', 40, '3 miesiące', 0, '2014-10-06', '2014-12-31'),
(2, 3, 'java developer', 'asfdadfs', 'asd', 'asdasd', 'umowa zlecenie', 40, '3 miesiące', 0, '2014-10-19', '2014-10-26'),
(3, 3, 'java developer', 'asfdadfs', 'asd', 'asdasd', 'umowa zlecenie', 40, '3 miesiące', 0, '2014-10-17', '2014-10-17'),
(4, 3, 'java developer', 'asfdadfs', 'dfsdf', 'asdfadf', 'umowa o pracę', 20, '1 rok', 1000, '2014-10-17', '2014-10-17'),
(5, 3, 'java developer', 'asd', 'asdasd', 'asdasd', 'staż', 40, '3 miesiące', 0, '2014-10-17', '2014-11-17'),
(6, 3, 'java developer', 'sdf', 'sdfsdf', 'asdfadf', 'umowa o pracę', 40, '3 miesiące', 0, '2014-10-17', '2014-11-17'),
(7, 2, 'java developer', 'dfsdf', 'sdfsdg', 'asdasd', 'umowa o pracę', 40, '3 miesiące', 0, '2014-10-17', '2014-11-17');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offer_to_student`
--

CREATE TABLE IF NOT EXISTS `offer_to_student` (
  `offer_to_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `job` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `requirements` text NOT NULL,
  `place_of_work` varchar(25) NOT NULL,
  `employment_status` text NOT NULL,
  `number_of_hours` int(11) NOT NULL,
  `length_of_contract` varchar(40) NOT NULL,
  `salary` float NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `date_send` date NOT NULL,
  `response` text,
  `response_date` date DEFAULT NULL,
  PRIMARY KEY (`offer_to_id`),
  KEY `company_id` (`company_id`,`student_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `offer_to_student`
--

INSERT INTO `offer_to_student` (`offer_to_id`, `company_id`, `student_id`, `job`, `description`, `requirements`, `place_of_work`, `employment_status`, `number_of_hours`, `length_of_contract`, `salary`, `date_from`, `date_to`, `date_send`, `response`, `response_date`) VALUES
(1, 3, 3, 'java developer', 'mmmmmmmmmm', 'mmmmmmmmmmm', 'mmm', 'umowa o dzieło', 40, '3 miesiące', 0, '2014-10-18', '2014-12-18', '2014-10-17', 'adfdsfsdf', '2014-10-19'),
(2, 3, 3, 'php developer', 'mmmmmmmmmm', 'mmmmmmmmmmm', 'mmm', 'umowa o dzieło', 40, '3 miesiące', 0, '2014-10-16', '2014-12-18', '2014-10-17', NULL, '2014-11-09');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `refernces`
--

INSERT INTO `refernces` (`references_id`, `student_id`, `teacher_id`, `content`) VALUES
(1, 1, 3, 'ok ok ok ok ok ok ok '),
(2, 2, 8, 'qwewrtfqwertyui rtyuio rty ufgh vb fghj rtyui fghjk fghjk tyuio rtyuik rctyunm fgbhn'),
(4, 1, 1, 'dfgbhnjmk erftgyhujik rtfgyhuji rdftgyhuji rdftgyhujik '),
(5, 1, 2, 'fdv fghjk yuio ftgyhuji fddf fghjk vbnm, xcvbnm rtyui dfghjkl '),
(6, 3, 5, 'iuhygtfyguhijkjihugytf ugfttrfgyhu rty edrfty htftfgbn ugrcvbuni nuhvtfvgbun '),
(7, 2, 5, 'ftghbnjm ftgybhunjm rftgyhu ygvbuijn mubtf ybyvygbn inygvtygvbu knj');

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
  `e_mail` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `education` text NOT NULL,
  `languages` text NOT NULL,
  `experience` text NOT NULL,
  `skills` text NOT NULL,
  `interest` text NOT NULL,
  `employment_form` text NOT NULL,
  `change_of_residence` tinyint(1) NOT NULL,
  `salary` float NOT NULL,
  `status` text NOT NULL,
  `account_creation_date` date NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `photoname` varchar(30) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `student`
--

INSERT INTO `student` (`student_id`, `name`, `last_name`, `address`, `telephone`, `e_mail`, `password`, `education`, `languages`, `experience`, `skills`, `interest`, `employment_form`, `change_of_residence`, `salary`, `status`, `account_creation_date`, `is_admin`, `photoname`) VALUES
(1, 'Kamil', 'Wrona', '00-999 Warszawa ul. Cicha 17', '876654234', 'kmil.kamil@poczta.pl', 'ef73781effc5774100f87fe2f437a435', '2008-2011 II LO w Warszawie', 'angielski - poziom zaawansowany\r\nniemiecki - poziom zaawansowany', 'brak', 'PHP - poziom dobry\r\nJava - poziom dobry', 'sport, samochody', 'praktyki/staż', 0, 0, 'poszukuję praktyk lub stażu', '2014-09-01', 0, 'wrona.jpg'),
(2, 'Agata', 'Mińska', '11-234 Łódź ul. Jasna 3 m. 7', '343434341', 'magdagrzesinska@gmail.com', 'ef73781effc5774100f87fe2f437a435', '2002-2005 XII LO w Krakowie\r\n2005-2010 Informatyka Uniwersytet Jagielloński', 'rosyjski - zaawansowany\r\nfrancuski - zaawansowany\r\nangielski - średni\r\nniemiecki - podstawy', '2010-2014 staż i praca w IT Business Solutions - programista Java i JavaScript', 'JavaScript - zaawansowany\r\nHTML5 - zaawansowany\r\nc++ - zaawansowany\r\nJava - zaawansowany\r\nSQL - średni', 'muzyka, kulinaria, ogrodnictwo', 'umowa o pracę', 1, 3000, 'poszukuję pracy', '2014-09-01', 1, 'minska.jpg'),
(3, 'magda', 'kowalska', 'ul.zana 2\r\n20-202 Lublin', '999999999', 'magda@o2.pl', '22d7fe8c185003c98f97e5d6ced420c7', 'blabal', 'blabalblabal', 'blabalblabal2', 'blabal2', 'blabal\r\nblabal\r\nblabal', 'staż', 0, 1000, 'employed', '2014-10-09', 0, 'kowalska2014-10-10-17-49.jpg');

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
  `e_mail` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `account_creation_date` date NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `name`, `last_name`, `academic_degree`, `telephone`, `e_mail`, `password`, `active`, `account_creation_date`) VALUES
(1, 'Adam', 'Nowak', 'doktor', 123123123, 'nowak@poczta.pl', 'ef73781effc5774100f87fe2f437a435', 1, '2014-09-11'),
(2, 'Jan', 'Kowalski', 'magister', 987988788, 'kowalski@poczta.pl', 'ef73781effc5774100f87fe2f437a435', 1, '2014-09-02'),
(3, 'Anna', 'Bąk', 'profesor', 678678654, 'bak.anna@poczta.pl', 'ef73781effc5774100f87fe2f437a435', 1, '2014-09-03'),
(4, 'jan', 'kowalski', 'dr', 111111111, 'jan@o2.pl', '22d7fe8c185003c98f97e5d6ced420c7', 0, '2014-10-09'),
(5, 'as', 'asdfasdf', 'asa', 111111111, 'as@as.pl', '22d7fe8c185003c98f97e5d6ced420c7', 0, '2014-10-09'),
(6, 'as', 'asdasd', 'asa', 111111111, 'as@as.pl', '22d7fe8c185003c98f97e5d6ced420c7', 0, '2014-10-09'),
(7, 'as', 'asdasd', 'dr', 111111111, 'as2@o2.pl', '22d7fe8c185003c98f97e5d6ced420c7', 0, '2014-10-09'),
(8, 'jan', 'asdfasdf', 'profesor', 111111111, 'jan2@o2.pl', '22d7fe8c185003c98f97e5d6ced420c7', 1, '2014-10-09');

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
  ADD CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ask_for_reference_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `student_ident` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_ident` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `company` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
