-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas wygenerowania: 04 Sty 2015, 17:26
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Zrzut danych tabeli `application`
--

INSERT INTO `application` (`application_id`, `offer_id`, `student_id`, `date`, `status`, `cv`, `motivation_letter`, `response`, `response_date`) VALUES
(1, 2, 3, '2014-10-19', '0', 'cv-32014-10-19-19-42.txt', 'motivation_letter-32014-10-19-19-42.txt', 'zdgsdf', '2014-11-03'),
(2, 5, 3, '2014-11-03', '0', 'bla.txt', 'bla2.txt', 'asdfsdf', '2014-11-03'),
(3, 5, 1, '2014-11-03', '0', 'bla.txt', 'bla2.txt', 'sfdsdf', '2014-11-03'),
(4, 6, 3, '2014-11-03', '0', 'cv-32014-11-03-20-07.txt', 'motivation_letter-32014-11-03-20-07.txt', NULL, NULL),
(6, 7, 3, '2014-11-03', '0', 'cv-32014-11-03-20-11.txt', 'motivation_letter-32014-11-03-20-11.txt', NULL, NULL),
(13, 1, 3, '2014-11-15', '0', 'cv-32014-11-15-14-39.txt', 'motivation_letter-32014-11-15-14-39.txt', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `ask_for_reference`
--

INSERT INTO `ask_for_reference` (`ask_id`, `student_id`, `teacher_id`, `message`, `date`, `status`) VALUES
(1, 3, 2, 'sfsdfvds', '2014-10-17', 0),
(2, 3, 8, 'asdsadf', '2014-10-18', 1),
(3, 3, 1, 'dfsjdbskzdvlkisefugoluskd', '2014-11-25', 0),
(4, 3, 6, 'ZDfSDfsxdfdf', '2014-11-16', 0),
(5, 3, 13, 'Dzień dobry,\r\npoproszę o referencje.\r\nDziękuję', '2014-11-16', 0),
(6, 3, 11, 'poproszę o referencje', '2014-11-16', 0),
(7, 3, 17, 'poproszę o referencje', '2014-11-16', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `company_id` (`company_id`,`student_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Zrzut danych tabeli `comment`
--

INSERT INTO `comment` (`comment_id`, `company_id`, `student_id`, `content`, `date`, `rate`) VALUES
(1, 1, 2, 'cbkjs sdhsdv  dscj', '2014-11-09', 5),
(2, 1, 3, 'sdfg sfg', '2014-11-03', 4),
(3, 1, 1, 'fdb fd dfg', '2014-11-01', 5),
(4, 2, 2, 'fg xdf cx', '2014-11-03', 3),
(5, 3, 1, 'xvn  dgh dftghj', '2014-11-05', 2),
(6, 1, 3, 'Napisz komentarz...', '2014-11-14', 4),
(7, 1, 3, 'Napisz komentarz...', '2014-11-14', 3),
(8, 1, 3, 'Napisz komentarz...', '2014-11-14', 2),
(9, 1, 3, 'Napisz komentarz...', '2014-11-14', 3),
(10, 11, 3, 'Napisz komentarz...', '2014-11-16', 5),
(11, 10, 3, 'Aenean facilisis pellentesque tincidunt. Pellentesque pellentesque ut nibh vel finibus. Interdum et malesuada fames ac ante ipsum primis in faucibus.', '2014-11-16', 3),
(12, 7, 3, 'Aenean facilisis pellentesque tincidunt. Pellentesque pellentesque ut nibh vel finibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean facilisis pellentesque tincidunt. Pellentesque pellentesque ut nibh vel finibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean facilisis pellentesque tincidunt. Pellentesque pellentesque ut nibh vel finibus. Interdum et malesuada fames ac ante ipsum primis in faucibus.', '2014-11-16', 4);

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
  `account_creation_date` date NOT NULL,
  `photoname` varchar(30) NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Zrzut danych tabeli `company`
--

INSERT INTO `company` (`company_id`, `name`, `address`, `telephone`, `e_mail`, `password`, `active`, `account_creation_date`, `photoname`) VALUES
(1, 'IT company', '90-090 Gdańsk ul. Morska 145', '456854876', 'itcompany@poczta.pl', 'ef73781effc5774100f87fe2f437a435', 1, '2014-09-02', 'itcompany.jpg'),
(2, 'DeveloperStudio', '12-345 Opole ul. Piłsudskiego 49', '876428400', 'devstudio@poczta.pl', 'ef73781effc5774100f87fe2f437a435', 1, '2014-09-03', 'developer.jpg'),
(3, 'itfirm', 'ul. Zana 2 \r\n99-999 Lublin', '111111111', 'it@o2.pl', '22d7fe8c185003c98f97e5d6ced420c7', 1, '2014-10-09', 'itfirm2014-10-12-19-15.jpg'),
(4, 'programos', 'lipowa 12 11-222 Lublin', '123232323', 'programos@kontakt.com', 'qwertyui', 1, '2014-11-16', 'firma.jpg'),
(5, 'zaqxsw', 'wert131 12-132 kjhfdgs', '123456789', 'firma@poczta.com', 'qwertyui', 1, '2014-11-05', 'firma2.jpg'),
(7, 'BIcompany', 'polna 6 12-123 Wrocław', '123456789', 'BI@poczta.com', 'qwertyui', 1, '2014-10-14', 'firma3.jpg'),
(8, 'firmaIT', 'pogodna 123 12-345 Konin', '123456789', 'firma@poczta.pl', 'qwertyui', 1, '2014-09-08', 'firma2.jpg'),
(9, 'itcorporation', 'poiouyt 234 98-900 Warszawa', '123456789', 'itcorp@poczta.com', 'qwertyui', 1, '2014-09-07', 'firma3.jpg'),
(10, 'abcd', 'qwerty 1 11-111 qwerty', '123456789', 'abdc@poczta.com', 'qwertyui', 1, '2014-07-14', 'firma.jpg'),
(11, 'XXXX', 'yuiop 23/8 12-345 zxcvbnm', '12312121212', 'xxxx@poczta.pl', 'qwertyui', 1, '2014-05-21', 'firma2.jpg'),
(12, 'poiuytrewq', 'asdfgh 34 12-789 qazwsxedcrfv tgbyhn', '123456789', 'xyz@poczta.com', 'qwertyui', 1, '2014-04-10', 'firma3.jpg'),
(13, 'rrtyuiop firma', 'erftgyhujikldfg ghjk 120c 12-234 ertyui fghj', '123123123', 'firma2@poczta.com', 'qwertyui', 1, '2014-07-02', 'firma2.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_from` int(11) DEFAULT NULL,
  `teacher_from` int(11) DEFAULT NULL,
  `company_from` int(11) DEFAULT NULL,
  `student_to` int(11) DEFAULT NULL,
  `teacher_to` int(11) DEFAULT NULL,
  `company_to` int(11) DEFAULT NULL,
  `content` text,
  `date` datetime NOT NULL,
  `read` tinyint(4) NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `student_from` (`student_from`),
  KEY `company_from` (`company_from`),
  KEY `student_to` (`student_to`),
  KEY `teacher_to` (`teacher_to`),
  KEY `company_to` (`company_to`),
  KEY `teacher_from` (`teacher_from`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `message`
--

INSERT INTO `message` (`message_id`, `student_from`, `teacher_from`, `company_from`, `student_to`, `teacher_to`, `company_to`, `content`, `date`, `read`) VALUES
(1, 3, NULL, NULL, 2, NULL, NULL, 'dsdf', '2014-11-16 11:50:18', 0),
(2, 3, NULL, NULL, NULL, 7, NULL, 'dfsdf', '2014-11-16 11:54:32', 0),
(3, 3, NULL, NULL, NULL, NULL, 2, 'xcvbxcb', '2014-11-16 11:56:32', 0),
(4, 3, NULL, NULL, NULL, 8, NULL, 'safdsf', '2014-11-16 14:55:29', 0),
(5, 3, NULL, NULL, NULL, 1, NULL, 'sdfsdfsd', '2014-11-16 15:05:26', 0),
(6, 3, NULL, NULL, 2, NULL, NULL, 'sdfsdfsdf sdfs df', '2014-11-16 15:06:17', 0),
(7, 2, NULL, NULL, 3, NULL, NULL, 'adfsdfdf', '2014-11-09 00:00:00', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

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
(7, 2, 'java developer', 'dfsdf', 'sdfsdg', 'asdasd', 'umowa o pracę', 40, '3 miesiące', 0, '2014-10-17', '2014-11-17'),
(8, 8, 'c++', 'sfv', 'sdfv', 'lublin', 'umowa o dzieło', 40, '6 miesiecy', 1500, '2014-11-13', '2015-01-13'),
(9, 12, 'network aministrator', 'fv dgn fg hdgb ', 'gh b hdgh dbv hdgb ', 'lublin', 'umowa zlecenie', 40, '3 miesiace', 0, '2014-11-17', '2014-12-26');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `offer_to_student`
--

INSERT INTO `offer_to_student` (`offer_to_id`, `company_id`, `student_id`, `job`, `description`, `requirements`, `place_of_work`, `employment_status`, `number_of_hours`, `length_of_contract`, `salary`, `date_from`, `date_to`, `date_send`, `response`, `response_date`) VALUES
(1, 3, 3, 'java developer', 'mmmmmmmmmm', 'mmmmmmmmmmm', 'mmm', 'umowa o dzieło', 40, '3 miesiące', 0, '2014-10-18', '2014-12-18', '2014-10-17', 'asfsdfsdfsdfsd', '2014-11-15'),
(2, 3, 3, 'php developer', 'mmmmmmmmmm', 'mmmmmmmmmmm', 'mmm', 'umowa o dzieło', 40, '3 miesiące', 0, '2014-10-16', '2014-10-18', '2014-10-16', NULL, '2014-11-09'),
(3, 5, 3, 'network aministrator', 'xcgvzf zdfzdfg xdfbzdf', 'dsvzdfb zdfbdfgsg fhhjmc ', 'lublin', 'umowa o prace', 40, '1 rok', 0, '2014-11-16', '2015-01-15', '2014-11-16', NULL, NULL),
(4, 10, 3, 'android developer', 'zdvfc   oipftgy stg ', ' sfgh jf ncg yjjd', 'lublin', 'umowa zlecenie', 20, '3 miesiace', 1000, '2014-11-16', '2014-12-23', '2014-11-15', 'taksd fsdvf  df', '2014-11-17');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `references`
--

CREATE TABLE IF NOT EXISTS `references` (
  `references_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`references_id`),
  KEY `student_id` (`student_id`,`teacher_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Zrzut danych tabeli `references`
--

INSERT INTO `references` (`references_id`, `student_id`, `teacher_id`, `content`, `date`) VALUES
(2, 2, 8, 'qwewrtfqwertyui rtyuio rty ufgh vb fghj rtyui fghjk fghjk tyuio rtyuik rctyunm fgbhn', '2014-11-05'),
(7, 2, 5, 'ftghbnjm ftgybhunjm rftgyhu ygvbuijn mubtf ybyvygbn inygvtygvbu knj', '2014-11-05'),
(9, 1, 8, 'Napisz referencje...', '2014-11-10'),
(11, 1, 8, 'Napisz referencje...', '2014-11-10'),
(13, 1, 8, 'moje referencje...', '2014-11-10'),
(14, 1, 8, 'Napisz referencje...', '2014-11-10'),
(15, 1, 8, 'Napisz referencje...', '2014-11-10'),
(16, 1, 8, 'Napisz referencje...moj', '2014-11-10'),
(18, 1, 8, 'Napisz referencje...', '2014-11-10'),
(19, 1, 8, 'Napisz referencje...', '2014-11-10'),
(21, 1, 8, 'Napisz referencje...hdfghdf', '2014-11-10');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Zrzut danych tabeli `student`
--

INSERT INTO `student` (`student_id`, `name`, `last_name`, `address`, `telephone`, `e_mail`, `password`, `education`, `languages`, `experience`, `skills`, `interest`, `employment_form`, `change_of_residence`, `salary`, `status`, `account_creation_date`, `is_admin`, `photoname`) VALUES
(1, 'Kamil', 'Wrona', '00-999 Warszawa ul. Cicha 17', '876654234', 'kmil.kamil@poczta.pl', 'ef73781effc5774100f87fe2f437a435', '2008-2011 II LO w Warszawie', 'angielski - poziom zaawansowany\r\nniemiecki - poziom zaawansowany', 'brak', 'PHP - poziom dobry\r\nJava - poziom dobry', 'sport, samochody', 'praktyki/staż', 0, 0, 'poszukuję praktyk lub stażu', '2014-09-01', 0, 'wrona.jpg'),
(2, 'Agata', 'Mińska', '11-234 Łódź ul. Jasna 3 m. 7', '343434341', 'magdagrzesinska@gmail.com', 'ef73781effc5774100f87fe2f437a435', '2002-2005 XII LO w Krakowie\r\n2005-2010 Informatyka Uniwersytet Jagielloński', 'rosyjski - zaawansowany\r\nfrancuski - zaawansowany\r\nangielski - średni\r\nniemiecki - podstawy', '2010-2014 staż i praca w IT Business Solutions - programista Java i JavaScript', 'JavaScript - zaawansowany\r\nHTML5 - zaawansowany\r\nc++ - zaawansowany\r\nJava - zaawansowany\r\nSQL - średni', 'muzyka, kulinaria, ogrodnictwo', 'umowa o pracę', 1, 3000, 'poszukuję pracy', '2014-09-01', 1, 'minska.jpg'),
(3, 'magda', 'kowalska', 'ul.zana 2\r\n20-202 Lublin', '999999999', 'magda@o2.pl', '22d7fe8c185003c98f97e5d6ced420c7', 'blabal', 'blabalblabal', 'blabalblabal2', 'blabal2', 'blabal\r\nblabal\r\nblabal', 'staż', 0, 1000, 'employed', '2014-10-09', 1, 'kowalska2014-10-10-17-49.jpg'),
(4, 'anna', 'polska', 'trtruyrr 12 78-789 jhghgjh', '98765443234', 'polska@poczta.pl', 'qwertyui', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.\r\nEtiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.\r\nEtiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.\r\nEtiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.\r\nEtiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.\r\nEtiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'staż', 1, 1500, 'poszukuję', '2014-09-09', 0, 'student4.jpg'),
(5, 'agnieszka', 'walczak', 'ertyuioyt 6 45-456 jhfgddghkjg', '87654456789', 'walczak@poczta.pl', 'qwertyui', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'umowa o pracę', 0, 1200, 'poszukuję', '2014-08-18', 0, 'student5.jpg'),
(6, 'jan', 'jankowski', 'iutdfgkhjhgcv 4 98-966 gjgj khuytrterfg', '3436344643', 'jankowski@poczta.pl', 'qwertyui', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.\r\n', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'praktyki', 0, 700, 'poszukuję', '2014-07-10', 0, 'student.jpg'),
(7, 'adam', 'kometa', 'wertyui 9 98-876 hgfdghgfvbgh', '6544535464', 'kometa@poczta.pl', 'qwertyui', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.Etiam auctor est et elementum cursus.\r\nIn gravida nulla at dui scelerisque, sed dapibus lectus maximus.', 'umowa o pracę', 1, 3500, 'zatrudniony', '2014-09-02', 0, 'student2.jpg'),
(8, 'daniel', 'kot', 'tsfvnm 1 12-123 kjhkgh hkjgkjgg', '96674654654', 'kot@poczta.pl', 'qwertyui', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'umowa o pracę', 0, 3000, 'zatrudniony', '2014-05-07', 0, 'student3.jpeg'),
(9, 'paulina', 'krzaczek', 'oh iuhuhuhiuhiuh 89 89-999 jgjfhgfhghgfhgfhf', '67556456684', 'krzaczek@poczta.pl', 'qwertyui', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.\r\n', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'umowa o pracę', 0, 3500, 'zatrudniona', '2014-09-10', 0, 'student4.jpg'),
(10, 'dominika', 'wróbel', 'fggyjghgjhg 87 67-987 ufjghgfhgfhgfhf', '45613254665', 'wrobel@poczta.pl', 'qwertyui', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'staż/praktyki', 0, 500, 'poszukuję praktyk', '2014-09-17', 0, 'student4.jpg'),
(11, 'wanda', 'kieliszek', 'tuygyyutuyt 9 89-098 jhggjhgjhgjghjg', '86657576984', 'kieliszek@poczta.pl', 'qwertyui', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'umowa o pracę', 0, 4000, 'zatrudniona', '2014-05-01', 0, 'student5.jpg'),
(12, 'wojciech', 'chaber', 'uyttutyt 7 98-765 ughjgfgjhgj', '87765654654', 'chaber@poczta.pl', 'qwertyui', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'umowa o pracę', 1, 5000, 'zatrudniony', '2014-10-03', 0, 'student.jpg'),
(13, 'mateusz', 'gil', 'fghgfgfhgfg 45 87-987 gjhghgjhgjhg', '75674436436', 'gil@poczta.pl', 'qwertyui', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'staż', 0, 1000, 'poszukuję zatrudnienia', '2014-11-04', 0, 'student2.jpg'),
(14, 'grzegorz', 'pirat', 'jkhsdjksdjkhsd 6 12-123 khjhjhjhh', '78676765655', 'pirat@poczta.pl', 'qwertyui', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'praktyki', 0, 0, 'poszukuję praktyk studenckich', '2014-11-12', 0, 'student3.jpeg'),
(15, 'zuzanna', 'świć', 'uytrsdsfgjf 54 98-987 jhfhgfgfhgfjgf', '76565454654', 'swic@poczta.pl', 'qwertyuio', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Nunc id magna rutrum, posuere arcu quis, consectetur sapien.\r\nDonec non sem gravida massa malesuada efficitur.\r\nPhasellus eget nunc sed sapien condimentum pellentesque ac sed elit.\r\nQuisque at felis vitae nulla cursus facilisis.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'umowa o pracę', 0, 4500, 'zatrudniona', '2014-07-01', 0, 'student6.jpg'),
(16, 'aleksander', 'michalski', 'jkghgh 4 78-986 fghgfgfhgf', '65455464343', 'michalski@poczta.pl', 'qwertyui', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'praktyki/staż', 0, 1500, 'poszukuję zatrudnienia', '2014-09-08', 0, 'student.jpg'),
(17, 'kinga', 'jaworska', 'hfgjhfg 32 87-098 jhgfhfhf', '5454543653', 'jaworska@poczta.pl', 'qwertyui', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'praktyki', 0, 0, 'poszukuję praktyk', '2014-10-07', 0, 'student5.jpg'),
(18, 'monika', 'sedlak', 'hgdshfjsdg 4 98-098 hjvhghggghhg', '76565545646', 'sedlak@poczta.pl', 'qwertyui', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'praktyki/staż', 1, 1500, 'poszukuję praktyk/stażu', '2014-11-03', 0, 'student6.jpg'),
(19, 'dariusz', 'pawelec', 'kjdfjkvkdjbv 90 78-098 jjhgjgjhgjhgjg', '64546545675', 'pawelec@poczta.pl', 'qwertyui', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'Etiam pellentesque turpis id vehicula volutpat.\r\nVivamus vitae augue eget massa dictum volutpat.\r\nMaecenas id justo mattis, condimentum libero pretium, venenatis ex.', 'praktyki', 0, 0, 'poszukuję praktyk', '2014-08-21', 0, 'student.jpg'),
(20, 'katarzyna', 'drabik', 'yutuytt 23 87-678 jhgjhghjg', '65454354364', 'drabik@poczta.pl', 'qwertyui', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'umowa o pracę', 1, 3500, 'poszukuję pracy', '2014-10-17', 0, 'student4.jpg'),
(21, 'weronika', 'dąb', 'fghgfd 76 98-987 jvhghgfghgf', '67454455645', 'dab@poczta.pl', 'qwertyui', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'umowa o pracę', 0, 2000, 'poszukuję zatrudnienia', '2014-09-11', 0, 'student6.jpg'),
(22, 'joanna', 'rzepa', 'gfjghgf 12 90-098 jhgjhjhg', '65765545645', 'rzepa@poczta.pl', 'qwertyui', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'praktyki/staż', 0, 1200, 'poszukuję praktyk', '2014-10-07', 0, 'student6.jpg'),
(23, 'patryk', 'wymiatał', 'uiuyyu uiuuu 78 90-000 jkkjghjghf', '57545465474', 'wymiatal@poczta.pl', 'qwertyui', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'Praesent euismod magna vel tellus laoreet ornare.\r\nNulla tincidunt magna vel justo aliquam, nec tincidunt nunc semper.\r\nMauris luctus libero vel justo semper malesuada a commodo libero.', 'umowa o pracę', 1, 3500, 'poszukuję zatrudnienia', '2014-08-14', 0, 'student3.jpeg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

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
(8, 'jan', 'asdfasdf', 'profesor', 111111111, 'jan2@o2.pl', '22d7fe8c185003c98f97e5d6ced420c7', 1, '2014-10-09'),
(9, 'jan', 'pawłowski', 'magister', 123123123, 'jpaw@poczta.pl', 'qwertyui', 1, '2014-11-02'),
(10, 'anna', 'król', 'doktor', 456456789, 'krola@poczta.pl', 'qwertyui', 1, '2014-07-07'),
(11, 'tadeusz', 'mazur', 'profesor', 678890098, 'mazur@poczta.pl', 'qwertyui', 1, '2014-09-17'),
(12, 'kamila', 'woś', 'magister', 987657453, 'kamilawos@poczta.pl', 'qwertyui', 1, '2014-04-17'),
(13, 'damian', 'kowalski', 'doktor', 567432345, 'kowalski@poczta.pl', 'qwertyui', 1, '2014-09-09'),
(14, 'daria', 'kowalska-nowak', 'doktor', 2147483647, 'dknowak@poczta.pl', 'qwertyui', 0, '2014-11-13'),
(15, 'agata', 'orzeł', 'profesor', 987567432, 'orzel@poczta.pl', 'qwertyui', 1, '2014-11-15'),
(16, 'paweł', 'joć', 'profesor', 2147483647, 'joc@poczta.pl', 'qwertyui', 1, '2014-08-13'),
(17, 'gertruda', 'wiącek', 'profesor', 2147483647, 'wiacek@poczta.pl', 'qwertyui', 1, '2014-09-30'),
(18, 'piotr', 'polanecki', 'profesor', 2147483647, 'polanecki@poczta.pl', 'qwertyui', 1, '2014-03-21'),
(19, 'jerzy', 'madej', 'magister', 2147483647, 'madej@poczta.pl', 'qwertyui', 1, '2014-09-11'),
(20, 'krzysztof', 'dereński', 'doktor', 2147483647, 'derenski@poczta.pl', 'qwertyui', 1, '2014-09-20');

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
  ADD CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `company_ident` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ident` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `company_from` FOREIGN KEY (`company_from`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_to` FOREIGN KEY (`company_to`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_from` FOREIGN KEY (`student_from`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_to` FOREIGN KEY (`student_to`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_from` FOREIGN KEY (`teacher_from`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_to` FOREIGN KEY (`teacher_to`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Ograniczenia dla tabeli `references`
--
ALTER TABLE `references`
  ADD CONSTRAINT `student` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
