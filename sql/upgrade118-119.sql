-- Update DB Version --
UPDATE 'settings' SET 'value' = '118' WHERE 'key' = 'db_version';

/**
 * Table structure for table `opportunities`
 *
 */

CREATE TABLE IF NOT EXISTS `opportunities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_available` varchar(75) NOT NULL,
  `pcv_name` varchar(75) NOT NULL,
  `available_from` datetime DEFAULT NULL,
  `available_until` datetime DEFAULT NULL,
  `contact` varchar(75) NOT NULL,
  `add_info` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Stores resources available posted by user' AUTO_INCREMENT=1 ;

