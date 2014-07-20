
DROP TABLE IF EXISTS `admin_options`;
CREATE TABLE IF NOT EXISTS `admin_options` (
  `admin_options_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_key` varchar(64) NOT NULL,
  `admin_value` varchar(256),
  PRIMARY KEY (`admin_options_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- blog tab details
INSERT INTO `admin_options` (`admin_key`, `admin_value`) VALUES ('blog_tab_show', '1');
INSERT INTO `admin_options` (`admin_key`, `admin_value`) VALUES ('blog_tab_title', 'The ecDB Blog');
INSERT INTO `admin_options` (`admin_key`, `admin_value`) VALUES ('blog_tab_url', 'http://ecdb.net');

-- enable register button as public or not
INSERT INTO `admin_options` (`admin_key`, `admin_value`) VALUES ('register_tab_show', '1');
-- public components tab, not working so lets hide it
INSERT INTO `admin_options` (`admin_key`, `admin_value`) VALUES ('pubcomponents_tab_show', '0');
-- donation tab, if your running a public site, maybe leave this on
INSERT INTO `admin_options` (`admin_key`, `admin_value`) VALUES ('donate_tab_show', '1');

alter table `projects` add column `project_public` tinyint(1) NOT NULL DEFAULT 0;
alter table `projects` add column `project_url` varchar(128) NULL;
alter table `projects` add column `project_desc` varchar(16384) NULL;

