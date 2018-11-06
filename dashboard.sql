-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Gegenereerd op: 06 nov 2018 om 10:10
-- Serverversie: 5.6.16
-- PHP-versie: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `dashboard`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `todo_items`
--

CREATE TABLE IF NOT EXISTS `todo_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `done` int(1) DEFAULT '0',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Gegevens worden geëxporteerd voor tabel `todo_items`
--

INSERT INTO `todo_items` (`item_id`, `list_id`, `description`, `done`, `added_on`) VALUES
(1, 3, 'Split from what used to be notes', 1, '2018-11-05 17:23:55'),
(2, 3, 'Add done and tally functionality', 1, '2018-11-05 17:23:55'),
(3, 3, 'Add list creation and deletion', 0, '2018-11-05 17:23:55'),
(4, 3, 'Link to-do tables in MySQL db', 0, '2018-11-05 17:23:55'),
(5, 2, 'Decide on bootstrap styling', 0, '2018-11-05 17:23:55'),
(6, 1, 'Make a new landing page', 0, '2018-11-05 17:23:55'),
(7, 1, 'Decide on what to put on the landing page', 0, '2018-11-05 17:23:55'),
(8, 1, 'Add login system', 0, '2018-11-05 17:23:55'),
(9, 1, 'Dynamically change menu color', 0, '2018-11-05 17:23:55'),
(10, 2, 'Add reading start and end dates', 0, '2018-11-05 17:23:55'),
(11, 2, '(Re)-implement bol.com api', 0, '2018-11-05 17:23:55'),
(12, 2, 'Add reading history overview', 0, '2018-11-05 17:23:55');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `todo_lists`
--

CREATE TABLE IF NOT EXISTS `todo_lists` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `list_name` varchar(255) DEFAULT NULL,
  `list_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden geëxporteerd voor tabel `todo_lists`
--

INSERT INTO `todo_lists` (`list_id`, `list_name`, `list_creation`) VALUES
(1, 'General things', '2018-11-05 17:23:29'),
(2, 'Books', '2018-11-05 17:23:29'),
(3, 'To-do', '2018-11-05 17:23:29');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `words`
--

CREATE TABLE IF NOT EXISTS `words` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `correct` int(11) DEFAULT '0',
  `incorrect` int(11) DEFAULT '0',
  `last_tested` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=170 ;

--
-- Gegevens worden geëxporteerd voor tabel `words`
--

INSERT INTO `words` (`id`, `list_id`, `question`, `answer`, `correct`, `incorrect`, `last_tested`) VALUES
(12, 2, 'day', 'день', 12, 1, 1528726684),
(13, 2, 'morning', 'утро', 11, 0, 1528726710),
(14, 2, 'night', 'ночи', 12, 1, 1528726719),
(15, 2, 'evening', 'вечер', 13, 3, 1528726708),
(16, 2, 'now', 'сейчас', 14, 17, 1528726717),
(17, 2, 'past', 'прошлая', 15, 16, 1528726688),
(18, 2, 'week', 'неделя', 15, 20, 1528726723),
(19, 2, 'last', 'прошлый', 15, 17, 1528726705),
(20, 1, 'boy', 'мальчик', 15, 10, 1528726615),
(21, 1, 'woman', 'женщина', 23, 19, 1528726606),
(22, 1, 'man', 'мужчина', 17, 12, 1528726597),
(23, 1, 'she', 'она', 7, 0, 1528265326),
(24, 1, 'mama', 'мама', 7, 0, 1528265304),
(25, 1, 'papa', 'папа', 6, 0, 0),
(26, 1, 'I', 'я', 6, 0, 1528227713),
(27, 1, 'he', 'он', 6, 0, 1528265407),
(28, 1, 'person', 'человек', 20, 15, 1528726626),
(29, 1, '(little) girl', 'деволка', 10, 4, 1528726618),
(30, 1, 'you', 'вы/ты', 7, 1, 1528348798),
(31, 1, 'they', 'они', 7, 1, 1528658676),
(32, 1, 'sister', 'сестра', 8, 3, 1528726636),
(33, 1, 'we', 'мы', 8, 3, 1528265415),
(34, 1, 'brother', 'брат', 6, 1, 1528265389),
(35, 1, 'child', 'ребёнок', 18, 14, 1528726601),
(36, 1, 'children', 'дети', 6, 0, 1528265323),
(38, 1, 'teacher', 'учитель', 22, 22, 1528726631),
(39, 1, 'guest', 'гость', 9, 4, 1528265311),
(40, 1, 'reader', 'читатель', 22, 23, 1528726611),
(41, 1, 'guy', 'парень', 13, 10, 1528726582),
(42, 3, 'here', 'здесь', 9, 10, 1528726777),
(43, 3, 'park', 'парк', 4, 1, 1528313417),
(44, 3, 'where', 'где', 5, 2, 1528658794),
(45, 3, 'here', 'вот', 5, 3, 1528726787),
(46, 3, 'city/town', 'город', 4, 1, 1528313394),
(47, 3, 'there', 'там', 7, 5, 1528726761),
(48, 3, 'in', 'в', 7, 5, 1528726791),
(49, 3, 'office', 'офис', 4, 0, 1528313329),
(50, 3, 'lake', 'озеро', 8, 8, 1528726757),
(51, 3, 'on', 'на', 8, 8, 1528726798),
(52, 3, 'place/area/site', 'место', 9, 11, 1528726784),
(53, 3, 'toilet', 'туалет', 4, 1, 1528313285),
(54, 3, 'work', 'работе', 9, 10, 1528726739),
(55, 3, 'near', 'возле', 9, 29, 1528726750),
(56, 3, 'offices', 'офисы', 5, 3, 1528348943),
(57, 3, 'lakes', 'озёра', 7, 7, 1528726767),
(58, 4, 'bicycle', 'велосипед', 1, 1, 1528548352),
(59, 4, 'taxi', 'такси', 1, 1, 1528548334),
(60, 4, 'telephone', 'телефон', 1, 1, 1528548367),
(61, 4, 'table/desk', 'стол', 1, 0, 1528548313),
(62, 4, 'plate', 'тарелка', 1, 0, 1528548291),
(63, 4, 'plan', 'план', 1, 1, 1528548264),
(64, 4, 'towel', 'полетенце', 1, 5, 1528548417),
(65, 4, 'notebook', 'тетрадь', 1, 3, 1528548421),
(66, 4, 'bed', 'кровать', 1, 3, 1528548393),
(67, 4, 'stone', 'камень', 1, 2, 1528548360),
(68, 4, 'tree', 'деребо', 0, 0, 0),
(69, 4, 'door', 'дверь', 0, 0, 0),
(70, 4, 'pencil', 'карандаша', 0, 0, 0),
(71, 4, 'book', 'книга', 0, 0, 0),
(72, 4, 'word', 'слово', 0, 0, 0),
(73, 4, 'menu', 'меню', 0, 0, 0),
(74, 4, 'car', 'машина', 0, 0, 0),
(75, 4, 'movie', 'фильм', 0, 0, 0),
(76, 4, 'problem', 'проблема', 0, 0, 0),
(77, 4, 'business', 'дело', 0, 0, 0),
(78, 4, 'path', 'путь', 0, 0, 0),
(79, 4, 'thing', 'вещь', 0, 0, 0),
(80, 4, 'blood', 'кровь', 0, 0, 0),
(81, 4, 'glass', 'стакан', 0, 0, 0),
(82, 4, 'bowl', 'миска', 0, 0, 0),
(89, 5, 'apple', 'яблоко', 2, 3, 1528659006),
(90, 5, 'coffee', 'кофе', 1, 0, 1528548463),
(91, 5, 'borscht', 'борщ', 2, 1, 1528658928),
(92, 5, 'bread', 'хлеб', 2, 2, 1528658938),
(93, 5, 'milk', 'молоко', 1, 0, 1528548443),
(94, 5, 'water', 'вода', 1, 0, 1528548457),
(95, 5, 'egg', 'яйцо', 2, 6, 1528658966),
(96, 5, 'juice', 'сок', 2, 3, 1528658942),
(97, 5, 'rice', 'рис', 2, 1, 1528658893),
(98, 5, 'butter', 'масло', 2, 3, 1528659021),
(99, 5, 'tea', 'чай', 1, 1, 1528659010),
(100, 5, '(hot) cocoa', 'какао', 1, 3, 1528659033),
(101, 5, 'puree', 'пюре', 1, 2, 1528659018),
(102, 5, 'beer', 'пиво', 0, 0, 0),
(105, 6, 'cat', 'кошка', 4, 1, 1528659116),
(106, 6, 'horse', 'лошадь', 9, 8, 1528659066),
(107, 6, 'lion', 'лев', 4, 2, 1528549405),
(108, 6, 'mouse', 'мышь', 6, 4, 1528659078),
(109, 6, 'bird', 'птица', 5, 3, 1528548743),
(110, 6, 'snake', 'змея', 7, 5, 1528659060),
(111, 6, 'dog', 'собака', 5, 6, 1528659141),
(112, 6, 'duck', 'утка', 4, 2, 1528659089),
(113, 6, 'bear', 'медведь', 5, 4, 1528659095),
(114, 6, 'chicken/hen', 'курица', 7, 6, 1528659086),
(115, 6, 'fly', 'муха', 7, 5, 1528659071),
(116, 6, 'wolf', 'волк', 4, 2, 1528659056),
(117, 7, 'and', 'и', 1, 0, 1528225661),
(118, 7, 'our', 'наше', 2, 1, 1528228186),
(119, 7, 'my', 'моя', 1, 0, 1528225481),
(120, 7, 'this/it is', 'это', 3, 3, 1528726480),
(121, 7, 'no', 'нет', 1, 0, 1528225695),
(122, 7, 'this', 'этот', 5, 4, 1528659159),
(123, 7, 'not', 'не', 2, 1, 1528228259),
(124, 7, 'or', 'или', 3, 2, 1528726528),
(125, 7, 'yes', 'да', 1, 0, 1528225693),
(126, 7, 'thank you', 'спасибо', 1, 0, 1528225422),
(127, 7, 'hi', 'привет', 1, 0, 1528225714),
(128, 7, 'you are welcome/please', 'пожалуйста', 5, 12, 1528726396),
(129, 7, 'bye/see you', 'пока', 3, 2, 1528726358),
(130, 7, 'excuse me/sorry', 'извини(те)', 2, 1, 1528228209),
(131, 7, 'good afternoon', 'добрый день', 2, 1, 1528228370),
(132, 7, 'good evening', 'добрый вечер', 2, 1, 1528228201),
(133, 7, 'good night', 'спокойной ночи', 5, 10, 1528726486),
(134, 7, 'how', 'как', 2, 1, 1528228334),
(135, 7, 'everything', 'всё', 2, 1, 1528228234),
(136, 7, 'good morning', 'доброе утро', 3, 2, 1528726369),
(137, 7, 'is fine/good/ok', 'хорошо', 2, 4, 1528726573),
(138, 7, 'how are you doing?', 'как дела?', 1, 1, 1528228640),
(139, 7, 'goodbye', 'до свидания', 4, 10, 1528726566),
(140, 7, 'see you soon', 'до скорого', 4, 15, 1528726547),
(141, 7, 'I have (a)', 'у меня есть', 2, 2, 1528726504),
(142, 7, 'we have (?)', 'у нас есть', 1, 1, 1528228477),
(143, 7, 'what', 'что', 0, 0, 0),
(144, 7, 'hello', 'здравствуй(те)', 0, 0, 0),
(145, 7, 'thank you', 'благодарю', 0, 0, 0),
(146, 7, 'perfect', 'отлично', 0, 0, 0),
(147, 7, 'name', 'зовут', 0, 0, 0),
(148, 7, 'wrong', 'так', 0, 0, 0),
(149, 7, 'one more time/again', 'ещё раз', 0, 0, 0),
(150, 7, 'you have (a)', 'у тебя есть', 0, 0, 0),
(151, 7, 'also', 'тоже', 0, 0, 0),
(152, 7, 'far (away)', 'далеко', 0, 0, 0),
(153, 7, 'too', 'тоже', 0, 0, 0),
(154, 7, 'neither ... nor', 'ни', 0, 0, 0),
(155, 7, 'life', 'жизиь', 0, 0, 0),
(156, 7, 'more', 'ещё', 0, 0, 0),
(157, 8, 'to be/exist/have', 'быть', 6, 5, 1528917338),
(158, 8, 'to speak', 'сказать', 3, 2, 1528917165),
(159, 8, 'to say/tell', 'говорить', 2, 1, 1528917109),
(160, 8, 'to eat', 'есть', 2, 1, 1528917100),
(161, 8, 'to drink', 'пить', 1, 0, 1528916999),
(162, 8, 'to know', 'знать', 5, 4, 1528917324),
(163, 8, 'to see', 'видеть', 2, 1, 1528917224),
(164, 8, 'to want', 'хотеть', 5, 5, 1528917401),
(165, 8, 'to write', 'писать', 3, 2, 1528917328),
(166, 8, 'to read', 'читать', 3, 2, 1528917411),
(167, 8, 'to sleep', 'спать', 1, 1, 1528917397),
(168, 8, 'to cook', 'готовить', 1, 2, 1528917431),
(169, 8, 'to work', 'работать', 1, 1, 1528917421);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `word_lists`
--

CREATE TABLE IF NOT EXISTS `word_lists` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `list_name` varchar(255) DEFAULT NULL,
  `q_lang` varchar(255) DEFAULT NULL,
  `a_lang` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Gegevens worden geëxporteerd voor tabel `word_lists`
--

INSERT INTO `word_lists` (`list_id`, `list_name`, `q_lang`, `a_lang`) VALUES
(1, 'people', 'english', 'russian'),
(2, 'time', 'english', 'russian'),
(3, 'location', 'english', 'russian'),
(4, 'things', 'english', 'russian'),
(5, 'food', 'english', 'russian'),
(6, 'animals', 'english', 'russian'),
(7, 'misc', 'english', 'russian'),
(8, 'verbs', 'english', 'russian');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
