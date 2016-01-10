SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sessionTimeoutStamp` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `interval` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `file` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `chart` tinyint(1) NOT NULL DEFAULT '0',
  `template_order` int(255) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `setting_item` varchar(40) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_item` (`setting_item`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `site_info` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `site_item` varchar(40) NOT NULL,
  `site_value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_item` (`site_item`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `widgets` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `widget_name` varchar(40) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `widget_icon` varchar(255) NOT NULL,
  `widget_text` varchar(255) NOT NULL,
  `widget_bg` varchar(255) NOT NULL,
  `widget_order` int(255) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `widget_name` (`widget_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cron` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `cron_name` varchar(40) NOT NULL,
  `cron_value` varchar(255) NOT NULL,
  `cron_run` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cron_name` (`cron_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `posted_by` varchar(255) NOT NULL,
  `news_subject` varchar(255) NOT NULL,
  `news_text` text NOT NULL,
  `news_date` varchar(255) NOT NULL,
  `news_edit` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
INSERT INTO `users` (`username`, `pass`, `is_admin`) VALUES
('Admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8',1);
UNLOCK TABLES;

LOCK TABLES `settings` WRITE;
INSERT INTO `settings` (`setting_item`, `setting_value`) VALUES
('templates', '/apps/weather/templates'),
('user_calib', '/apps/weather/calib'),
('work', '/apps/weather/tmp'),
('local_files', '/apps/weather/public_html/data');
UNLOCK TABLES;

LOCK TABLES `site_info` WRITE;
INSERT INTO `site_info` (`site_item`, `site_value`) VALUES
('site_name', 'RasPiWeather'),
('site_colour', '#438F8A'),
('site_api', '6980bbacd6239f97428f6d97d5fda2688e74cf162fa78089b01766fc003d80bd'),
('site_remote', 'raspiweather.com');
UNLOCK TABLES;

LOCK TABLES `widgets` WRITE;
INSERT INTO `widgets` (`widget_name`, `active`, `widget_icon`, `widget_text`, `widget_bg`, `widget_order`) VALUES
('temp_out','1','wi-celcius','Outside Temperature','bg-aqua',1),
('temp_in','1','wi-celcius','Inside Temperature','bg-orange',2),
('apparent_temp','1','wi-celcius','Apparent Temperature','bg-green',3),
('hum_out','1','icon-percent','Humidity','bg-purple',4),
('hum_in','1','icon-percent','Inside Humidity','bg-blue',5),
('rel_pressure','1','fa fa-dashboard','Pressure','bg-red',6),
('wind_ave','1','wi-strong-wind','Wind Average','bg-yellow',7),
('wind_gust','1','wi-strong-wind','Wind Gust','bg-maroon',8),
('wind_dir','1','wi-strong-wind','Wind Direction','bg-light-blue',9),
('rain','1','wi-rain','Rain (mm)','bg-olive',10);
UNLOCK TABLES;

LOCK TABLES `cron` WRITE;
INSERT INTO `cron` (`cron_name`, `cron_value`) VALUES
('pi_resources', 'yes'),
('pywws_status', 'yes'),
('pywws_crash', 'no'),
('pywws_service', 'no'),
('pywws_remote', 'no');
UNLOCK TABLES;

LOCK TABLES `templates` WRITE;
INSERT INTO `templates` VALUES
(4,'logged','Overview - Last 1 Hour',0,'4',1,0,1),
(5,'hourly','Wind - 24 Hours',2,'5',1,0,2),
(6,'hourly','Temperature - Last 24 Hours',2,'6',1,0,1),
(7,'hourly','Wind Speeds - Last 24 Hours',2,'7',1,0,1),
(8,'hourly','Overview - Last 6 Hour',0,'8',1,0,2),
(9,'daily','Overview - Last 24 Hours',0,'9',1,0,3),
(10,'daily','Overview - Last 7 Days',0,'10',1,0,4),
(11,'daily','Overview - Last 12 Months',0,'11',1,0,5),
(12,'hourly','Rain/Pressure - Last 24 Hours',2,'12',1,0,1),
(13,'logged','Wind - Last 1 Hour',2,'13',1,0,1),
(14,'logged','bom.gov.au Format - URL Only',3,'14',1,0,1),
(15,'hourly','Temperature - Last 7 Days',2,'15',1,0,9),
(16,'daily','Temperature - Last 28 Days',2,'16',1,0,10);
UNLOCK TABLES;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
