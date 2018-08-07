-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `authorid` int(10) NOT NULL AUTO_INCREMENT,
  `authorname` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `authorimage` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`authorid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `author` (`authorid`, `authorname`, `authorimage`) VALUES
(1,	'Аркадий Гайдар',	'gaidar.jpg'),
(2,	'Юрий Олеша',	'olesha.jpg'),
(3,	'Виктор Гюго',	'gugo.jpg'),
(4,	'Алексей Толстой',	'atolstoy.jpg'),
(5,	'А.П. Чехов',	'chehov.jpg'),
(6,	'Илья Ильф',	'ilf.jpg'),
(7,	'Евгений Петров',	'epetrov.jpg'),
(8,	'А.С. Пушкин',	'aspuskin.jpg'),
(9,	'Эмили Бронте',	'ebronte.jpg'),
(10,	'Уильям Шекспир',	'ushekspir.jpg'),
(11,	'Маргарет Митчелл',	'mmitchell.jpg');

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
  `bookimage` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `commentscnt` int(10) unsigned DEFAULT NULL,
  `allballs` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`bookid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `book` (`bookid`, `bookname`, `bookpublicyear`, `bookpages`, `bookthema`, `bookdescription`, `bookimage`, `commentscnt`, `allballs`) VALUES
(1,	'Мальчиш-кибальчиш',	'1937',	120,	1,	'Мальчиш-Кибальчиш — произведение Аркадия Гайдара. Рассказывается в нём о том, как Мальчиш-Кибальчиш боролся с коварными и злобными буржуинами, врагами Советского Союза. Произведение «Мальчиш-Кибальчиш» будет интересно детям в возрасте от 9 до 11 лет.',	'mkibalchish.jpg',	2,	18),
(2,	'Три толстяка. Империя наносит ответный удар',	'1985',	820,	3,	'«Три Толстяка. Империя наносит ответный удар» — продолжение сказки Юрия Олеши, написанная им 1924 году. В книге рассказывается о подавлении революции, поднятой бедняками под предводительством оружейника Просперо и гимнаста Тибула против богачей (Толстяков) в выдуманной стране. ',	'tritolstyaka.jpg',	NULL,	NULL),
(3,	'Вишневый сад',	'2007',	523,	2,	'Лирическая пьеса в четырёх действиях, жанр которой сам автор определил как комедия. Пьеса написана в 1903 году, впервые поставлена 17 января 1904 года в Московском художественном театре. Одно из самых известных русских пьес, написанных в то время. ',	'vsad.jpg',	2,	3),
(4,	'Буратино',	'1957',	220,	5,	'Повесть-сказка Алексея Николаевича Толстого, представляющая собой литературную обработку сказки Карло Коллоди «Приключения Пиноккио. История деревянной куклы». Толстой посвятил книгу своей будущей жене Людмиле Ильиничне Крестинской.',	'buratino.jpg',	NULL,	NULL),
(5,	'Козетта',	'2014',	900,	4,	'Козетта-сначала маленькая и очень пугливая девочка, много работающая, несправедливо наказанная почти постоянно, недокормленный ребенок, сильно исхудавший и болезненный на вид, испуганный и в грязных лохмотьях старой одежды.  Это была бедная малютка, которой не было еще и шести лет, когда зимним утром, дрожа в дырявых обносках, с полными слез глазами, она подметала улицу, еле удерживая огромную метлу в маленьких посиневших ручонках. Ее прозвали \"Жаворонком\". Она вставала раньше всех в доме и все время работала.  На вид она была похожа на маленькую старушку. Одно веко у нее почернело от тумака, которым наградила ее Тенардье. Ее били, унижали, упрекали и ненавидели все в доме,где она жила.',	'kozetta.jpg',	NULL,	NULL),
(6,	'12 стульев',	'2012',	300,	3,	'Роман Ильи Ильфа и Евгения Петрова, написанный в 1927 году и являющийся первой совместной работой соавторов. В 1928 году опубликован в художественно-литературном журнале «Тридцать дней»; в том же году издан отдельной книгой. В основе сюжета - поиски бриллиантов, спрятанных в одном из двенадцати стульев мадам Петуховой, однако история, изложенная в произведении, не ограничена рамками приключенческого жанра: в ней, по мнению исследователей, дан «глобальный образ эпохи»',	'12stuliev.jpg',	NULL,	NULL),
(7,	'Евгений Онегин',	'1990',	400,	4,	'Роман в стихах русского поэта Александра Сергеевича Пушкина, написанный в 1823-1830 годах, одно из самых значительных произведений русской словесности.',	'eonegin.jpg',	NULL,	NULL),
(8,	'Грозовой Перевал',	'1967',	295,	2,	'Образцово продуманный сюжет, новаторское использование нескольких повествователей, внимание к подробностям сельской жизни в сочетании с романтическим истолкованием природных явлений, ярким образным строем и переработкой условностей готического романа делают «Грозовой перевал» эталоном романа позднего романтизма и классическим произведением ранневикторианской литературы.',	'grozovoypereval.jpg',	1,	3),
(9,	'Ромео и Джульетта',	'1988',	160,	5,	'«Роме́о и Джулье́тта» — трагедия Уильяма Шекспира, рассказывающая о любви юноши и девушки из двух враждующих старинных родов — Монтекки и Капулетти.',	'romeojulietta.jpg',	NULL,	NULL),
(10,	'Унесенные ветром',	'2000',	500,	4,	'Могучие ветры Гражданской войны в один миг уносят беззаботную юность южанки Скарлетт О`Хара, когда привычный шум балов сменяется грохотом канонад на подступах к родному дому. Для молодой женщины, вынужденной бороться за новую жизнь на разоренной земле, испытания и лишения становятся шансом переосмыслить идеалы, обрести веру в себя и найти настоящую любовь.',	'uvetrom.jpg',	NULL,	NULL);

DROP TABLE IF EXISTS `bookuser`;
CREATE TABLE `bookuser` (
  `userid` mediumint(5) NOT NULL AUTO_INCREMENT,
  `useremail` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `userpassword` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `userfirstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `userlastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `bookuser` (`userid`, `useremail`, `userpassword`, `userfirstname`, `userlastname`) VALUES
(1,	'evgeny_gavriluk@mail.ru',	'655d8a37e5f77303dec2ba78b8305f6f',	'Евгений',	'Гаврилюк'),
(2,	'tdud@list.ru',	'655d8a37e5f77303dec2ba78b8305f6f',	'Марк',	'Твен'),
(3,	'bit@home.tula.net',	'25d55ad283aa400af464c76d713c07ad',	'Евгений',	'Гаврилюк'),
(4,	'bit@home.tula.ru',	'25d55ad283aa400af464c76d713c07ad',	'Евгений',	'Гаврилюк'),
(5,	'domvaleksine@mail.ru',	'2060b18c89b6ccb280c337c3e4770552',	'Петя',	'Фомин'),
(6,	'',	'd41d8cd98f00b204e9800998ecf8427e',	'',	'');

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
(6,	1,	5),
(7,	6,	6),
(8,	6,	7),
(9,	7,	8),
(10,	8,	9),
(11,	9,	10),
(12,	10,	11);

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
  `commenttext` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `commentraiting` int(10) unsigned DEFAULT NULL,
  `commentatorname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`commentid`),
  KEY `bookid` (`bookid`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`bookid`) REFERENCES `book` (`bookid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `comment` (`commentid`, `bookid`, `commenttext`, `commentraiting`, `commentatorname`) VALUES
(23,	1,	'Отзыв на 8!',	8,	'Евгений'),
(24,	1,	'Присоединяюсь к положительным отзывам.',	10,	'Сергей'),
(25,	8,	'Не читал, но поставлю 3',	3,	'Алексей'),
(26,	3,	'Книга, как книга. Читать не довелось.',	2,	'Сергей'),
(27,	3,	'Чехов жжет!',	1,	'Юрий');

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

-- 2018-08-07 08:43:52
