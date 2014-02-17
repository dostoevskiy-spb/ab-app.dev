SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Р‘Р°Р·Р° РґР°РЅРЅС‹С…: `db_zimaevent_6`
--

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- РЎС‚СЂСѓРєС‚СѓСЂР° С‚Р°Р±Р»РёС†С‹ `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id`       INT(10) NOT NULL AUTO_INCREMENT,
  `name`     VARCHAR(250) DEFAULT NULL,
  `mail`     VARCHAR(255) DEFAULT NULL,
  `phone`    VARCHAR(50) DEFAULT NULL,
  `ticket`   INT(1) DEFAULT NULL,
  `type`     INT(1) DEFAULT 0,
  `pay`      INT(1) DEFAULT NULL,
  `quantity` INT(3) DEFAULT 0,
  `comment`  TEXT,
  `page`     INT(10) NOT NULL DEFAULT '0',
  `source`   INT(11) NOT NULL,
  `date`     DATETIME DEFAULT NULL,
  `ip`       VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE =MyISAM
  DEFAULT CHARSET =utf8
  AVG_ROW_LENGTH =82
  AUTO_INCREMENT =1;


-- --------------------------------------------------------

--
-- РЎС‚СЂСѓРєС‚СѓСЂР° С‚Р°Р±Р»РёС†С‹ `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id`     INT(11) NOT NULL AUTO_INCREMENT,
  `html`   TEXT,
  `active` INT(1) DEFAULT '0',
  PRIMARY KEY (`id`)
)
  ENGINE =MyISAM
  DEFAULT CHARSET =utf8
  AVG_ROW_LENGTH =8428
  AUTO_INCREMENT =1;

INSERT INTO `page` (`html`, 'active') VALUES (
  'Скоро здесь будет новый сайт',
  1
);
-- --------------------------------------------------------

--
-- РЎС‚СЂСѓРєС‚СѓСЂР° С‚Р°Р±Р»РёС†С‹ `Settings`
--

CREATE TABLE IF NOT EXISTS `Settings` (
  `id`    INT(11) NOT NULL AUTO_INCREMENT,
  `phone` VARCHAR(255) DEFAULT NULL,
  `email` VARCHAR(255) DEFAULT NULL,
  `name`  VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE =MyISAM
  DEFAULT CHARSET =utf8
  AVG_ROW_LENGTH =48
  AUTO_INCREMENT =2;

--
-- Р”Р°РјРї РґР°РЅРЅС‹С… С‚Р°Р±Р»РёС†С‹ `Settings`
--

INSERT INTO `Settings` (`id`, `phone`, `email`, `name`) VALUES
(1, '', 'info@mota-systems.ru', 'Mota-systems');

-- --------------------------------------------------------

--
-- РЎС‚СЂСѓРєС‚СѓСЂР° С‚Р°Р±Р»РёС†С‹ `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `id`    INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE =MyISAM
  DEFAULT CHARSET =utf8
  AVG_ROW_LENGTH =34
  AUTO_INCREMENT =2;
INSERT INTO `source` (`id`, `title`) VALUES
(1, 'Напрямую с сайта');
-- --------------------------------------------------------

--
-- РЎС‚СЂСѓРєС‚СѓСЂР° С‚Р°Р±Р»РёС†С‹ `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id`       INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) DEFAULT NULL,
  `password` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE =MyISAM
  DEFAULT CHARSET =utf8
  AVG_ROW_LENGTH =32
  AUTO_INCREMENT =2;

--
-- Р”Р°РјРї РґР°РЅРЅС‹С… С‚Р°Р±Р»РёС†С‹ `users`
--

#INSERT INTO `users` (`id`, `username`, `password`) VALUES
#(1, 'admin', 'Su6iVBF/q2VgI');

-- --------------------------------------------------------

--
-- РЎС‚СЂСѓРєС‚СѓСЂР° С‚Р°Р±Р»РёС†С‹ `visits`
--

CREATE TABLE IF NOT EXISTS `visits` (
  `id`     INT(11) NOT NULL AUTO_INCREMENT,
  `ip`     VARCHAR(255) DEFAULT NULL,
  `source` VARCHAR(255) DEFAULT NULL,
  `page`   VARCHAR(255) DEFAULT NULL,
  `date`   DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8
  AVG_ROW_LENGTH =84
  AUTO_INCREMENT =1;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
