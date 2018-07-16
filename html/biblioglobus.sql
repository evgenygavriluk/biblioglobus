-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `authorid` int(10) NOT NULL AUTO_INCREMENT,
  `authorname` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`authorid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `author` (`authorid`, `authorname`) VALUES
(1,	'Аркадий Гайдар'),
(2,	'Юрий Олеша'),
(3,	'Виктор Гюго'),
(4,	'Алексей Толстой'),
(5,	'А.П. Чехов');

DROP TABLE IF EXISTS `biblioteka`;
CREATE TABLE `biblioteka` (
  `bibliotekaid` int(2) NOT NULL AUTO_INCREMENT,
  `bibliotekatitle` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `bibliotekaadress` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`bibliotekaid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `biblioteka` (`bibliotekaid`, `bibliotekatitle`, `bibliotekaadress`) VALUES
(1,	'Центральная научная библиотека',	'Тула, пр. Ленина 212'),
(2,	'Детская городская библиотека',	'Тула, ул.Первомайская, 7'),
(3,	'Библиотека им. Толкиена',	'Тула, ул. Металлистов, 13');

DROP TABLE IF EXISTS `biblioteka_book`;
CREATE TABLE `biblioteka_book` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `bibliotekaid` int(2) NOT NULL,
  `bookid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bibliotekaid` (`bibliotekaid`),
  KEY `bookid` (`bookid`),
  CONSTRAINT `biblioteka_book_ibfk_1` FOREIGN KEY (`bibliotekaid`) REFERENCES `biblioteka` (`bibliotekaid`),
  CONSTRAINT `biblioteka_book_ibfk_2` FOREIGN KEY (`bookid`) REFERENCES `book` (`bookid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `biblioteka_book` (`id`, `bibliotekaid`, `bookid`) VALUES
(1,	1,	1),
(2,	1,	4),
(3,	1,	5),
(4,	2,	2),
(5,	2,	3),
(6,	2,	5),
(7,	3,	1),
(8,	3,	2),
(9,	3,	3),
(10,	3,	4),
(11,	3,	5);

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `bookid` int(10) NOT NULL AUTO_INCREMENT,
  `bookname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bookpublicyear` year(4) NOT NULL,
  `bookpages` int(4) NOT NULL,
  `bookthema` int(3) NOT NULL,
  `bookdescription` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`bookid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `book` (`bookid`, `bookname`, `bookpublicyear`, `bookpages`, `bookthema`, `bookdescription`) VALUES
(1,	'Мальчиш-кибальчиш',	'1937',	120,	0,	NULL),
(2,	'Три толстяка. Империя наносит ответный удар',	'1985',	820,	0,	NULL),
(3,	'Вишневый сад',	'2007',	523,	0,	NULL),
(4,	'Буратино',	'1957',	220,	0,	NULL),
(5,	'Козетта',	'2014',	900,	0,	NULL);

DROP TABLE IF EXISTS `book_author`;
CREATE TABLE `book_author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bookid` int(10) NOT NULL,
  `authorid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bookid` (`bookid`),
  KEY `authorid` (`authorid`),
  CONSTRAINT `book_author_ibfk_1` FOREIGN KEY (`bookid`) REFERENCES `book` (`bookid`),
  CONSTRAINT `book_author_ibfk_2` FOREIGN KEY (`authorid`) REFERENCES `author` (`authorid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `book_author` (`id`, `bookid`, `authorid`) VALUES
(1,	1,	1),
(2,	2,	2),
(3,	3,	3),
(4,	4,	4),
(5,	5,	5),
(6,	1,	5);

DROP TABLE IF EXISTS `book_thema`;
CREATE TABLE `book_thema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bookid` int(10) NOT NULL,
  `themaid` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bookid` (`bookid`),
  KEY `themaid` (`themaid`),
  CONSTRAINT `book_thema_ibfk_1` FOREIGN KEY (`bookid`) REFERENCES `book` (`bookid`),
  CONSTRAINT `book_thema_ibfk_2` FOREIGN KEY (`themaid`) REFERENCES `thema` (`themaid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `book_thema` (`id`, `bookid`, `themaid`) VALUES
(1,	1,	1),
(2,	2,	4),
(3,	3,	2),
(4,	4,	2),
(5,	5,	5),
(6,	1,	3),
(7,	3,	1);

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `commentid` int(10) NOT NULL AUTO_INCREMENT,
  `bookid` int(10) NOT NULL,
  `commenttext` int(11) NOT NULL,
  `commentraiting` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`commentid`),
  KEY `bookid` (`bookid`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`bookid`) REFERENCES `book` (`bookid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `thema`;
CREATE TABLE `thema` (
  `themaid` int(2) NOT NULL AUTO_INCREMENT,
  `themaname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`themaid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `thema` (`themaid`, `themaname`) VALUES
(1,	'Революционный триллер'),
(2,	'Антиутопия'),
(3,	'Романтическая комедия'),
(4,	'Фантастический хоррор'),
(5,	'Сказка для тинейджеров');

-- 2018-07-16 11:44:47
