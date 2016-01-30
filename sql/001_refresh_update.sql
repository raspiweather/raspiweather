/* SQL update to include refresh time on dashboard */

LOCK TABLES `site_info` WRITE;
INSERT INTO `site_info` (`site_item`, `site_value`) VALUES
('site_refresh', '0');
UNLOCK TABLES;
