
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Cable'),
(2, 'Capacitor'),
(3, 'Connector'),
(4, 'Diode'),
(5, 'IC'),
(6, 'Inductor'),
(7, 'Mechanic'),
(16, 'Module'),
(8, 'Opto'),
(9, 'Clocks'),
(18, 'Oscillator'),
(13, 'Resistor'),
(15, 'Sensor'),
(10, 'Switch'),
(11, 'Transformer'),
(12, 'Transistor'),
(14, 'Display'),
(17, 'Miscellaneous');


DROP TABLE IF EXISTS `category_sub`;
CREATE TABLE `category_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `subcategory` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_catid` (`category_id`),
  CONSTRAINT `category_sub_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=utf8;

INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('1', '1', 'Ribbon');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('2', '1', 'Coax');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('3', '1', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('4', '2', 'Ceramic');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('5', '2', 'Electrolytic');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('6', '2', 'Polyester');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('7', '2', 'Tantalum');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('8', '2', 'Variable');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('9', '2', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('10', '3', 'Audio');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('11', '3', 'Coax');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('12', '3', 'DC');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('13', '3', 'D-Sub');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('14', '3', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('15', '4', 'Rectifier');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('16', '4', 'Schottky');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('17', '4', 'Small Signal');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('18', '4', 'Zener');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('19', '4', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('20', '5', '4xxx');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('21', '5', '74xx');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('22', '5', 'Microcontroller');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('23', '5', 'Comparator');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('24', '5', 'Op. Amp.');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('25', '5', 'Temperature');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('26', '5', 'Timer & Osc.');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('27', '5', 'Voltage Ref.');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('28', '5', 'Voltage Reg.');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('29', '5', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('30', '6', 'Ferrite');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('31', '6', 'Filter');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('32', '6', 'Inductor');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('33', '6', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('34', '7', 'Box');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('35', '7', 'Distance');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('36', '7', 'Fuse');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('37', '7', 'Motor');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('38', '7', 'Screw');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('39', '7', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('40', '8', 'Reflex coupler');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('41', '8', 'Laser');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('42', '8', 'LED');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('43', '8', 'LED 3mm');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('44', '8', 'LED 5mm');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('45', '8', 'Optocoupler');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('46', '8', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('47', '9', 'Crystal');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('48', '9', 'Resonator');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('49', '9', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('50', '10', 'Keypad');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('51', '10', 'Momentary');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('52', '10', 'PCB Mounted');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('53', '10', 'Rotary Encoder');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('54', '10', 'Toggle Switch');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('55', '10', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('56', '11', 'Power Supply');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('57', '11', 'Transformer');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('58', '11', 'Wall Adapter');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('59', '11', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('60', '12', 'BJT');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('61', '12', 'JFET');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('62', '12', 'MOSFET');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('63', '12', 'NPN');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('64', '12', 'PNP');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('65', '12', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('66', '13', '1/4W Carbon');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('67', '13', '1/4W Metal');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('68', '13', '1/6W Carbon');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('69', '13', '1/6W Metal');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('70', '13', '0603');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('71', '13', '0805');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('72', '13', '1206');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('73', '13', 'Effect');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('74', '13', 'Photo');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('75', '13', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('76', '16', 'GSM');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('77', '16', 'GPS');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('78', '16', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('79', '14', 'LCD');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('80', '14', 'VFD');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('81', '14', 'LED');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('82', '14', 'TFT');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('83', '8', 'IR LED');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('84', '14', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('85', '7', 'IC Socket');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('86', '7', 'Heat Sink');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('87', '5', 'Data Converter');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('88', '5', 'A/D Multiplexer');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('89', '5', 'Driver');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('90', '5', 'Opto Driver');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('91', '5', 'DC/DC Converter');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('92', '5', 'Audio/Video');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('93', '5', 'Memory');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('94', '13', 'Temperature');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('95', '13', 'Network');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('96', '3', 'HF');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('97', '7', 'Knob');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('98', '7', 'Meter');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('99', '1', 'Standard');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('100', '1', 'Mains');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('101', '1', 'Signal/Data');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('102', '1', 'Fiber optic');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('103', '3', 'PCB');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('104', '16', 'Bluetooth');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('105', '16', 'WLAN');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('106', '16', 'ZigBee');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('107', '16', 'RFID');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('108', '3', 'Mains');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('109', '15', 'Moisture');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('110', '15', 'Temperature');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('111', '15', 'Pressure');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('112', '15', 'Magnetic');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('113', '15', 'Hall Effect');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('114', '15', 'Gas');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('115', '15', 'Accelerometer');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('116', '15', 'Light');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('117', '15', 'Proximity');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('118', '15', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('119', '17', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('120', '5', 'Logic');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('121', '13', 'Potentiometer');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('122', '10', 'Relay');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('123', '3', 'Data');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('124', '18', 'Crystal');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('125', '18', 'Resonator');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('126', '18', 'Misc');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('127', '10', 'DIP');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('128', '4', 'Bridge');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('129', '12', 'Triac');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('130', '13', '1/3W Carbon');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('131', '13', '1/3W Metal');
INSERT INTO `ecdb`.`category_sub` (`id`, `category_id`, `subcategory`) VALUES ('132', '13', 'Precision');


DROP TABLE IF EXISTS `data`;
CREATE TABLE IF NOT EXISTS `data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `manufacturer` varchar(64) NOT NULL,
  `package` varchar(64) NOT NULL,
  `pins` varchar(11) NOT NULL,
  `smd` varchar(3) NOT NULL DEFAULT 'No',
  `quantity` varchar(11) NOT NULL,
  `order_quantity` varchar(11) NOT NULL,
  `location` varchar(32) NOT NULL,
  `scrap` varchar(3) NOT NULL DEFAULT 'No',
  `width` varchar(11) DEFAULT NULL,
  `height` varchar(11) DEFAULT NULL,
  `depth` varchar(11) DEFAULT NULL,
  `weight` varchar(11) DEFAULT NULL,
  `datasheet` varchar(256) NOT NULL,
  `comment` text NOT NULL,
  `category` varchar(11) NOT NULL,
  `public` varchar(3) NOT NULL DEFAULT 'No',
  `url1` varchar(256) NOT NULL,
  `url2` varchar(256) NOT NULL,
  `url3` varchar(256) NOT NULL,
  `url4` varchar(256) NOT NULL,
  `price` varchar(11) NOT NULL,
  KEY `Id` (`id`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `login` varchar(32) NOT NULL,
  `mail` varchar(32) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `measurement` int(11) NOT NULL DEFAULT '1',
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


INSERT INTO `members` (`member_id`, `firstname`, `lastname`, `login`, `mail`, `passwd`, `admin`, `measurement`, `currency`, `reg_date`) VALUES
(1, 'Admin', 'Admin', 'admin', 'admin@127.0.0.1', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 'USD', '2014-07-18 23:34:32');



DROP TABLE IF EXISTS `members_stats`;
CREATE TABLE IF NOT EXISTS `members_stats` (
  `members_stats_id` int(11) NOT NULL AUTO_INCREMENT,
  `members_stats_member` int(11) NOT NULL,
  `members_stats_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`members_stats_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_owner` int(11) NOT NULL,
  `project_name` varchar(64) NOT NULL,
  `project_public` tinyint(1) NOT NULL DEFAULT 0,
  `project_url` varchar(128) NULL,
  `project_desc` varchar(16384) NULL,

  PRIMARY KEY (`project_id`),
  KEY `project_owner` (`project_owner`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `projects_data`;
CREATE TABLE IF NOT EXISTS `projects_data` (
  `projects_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `projects_data_owner_id` int(11) NOT NULL,
  `projects_data_project_id` int(11) NOT NULL,
  `projects_data_component_id` int(11) NOT NULL,
  `projects_data_quantity` int(11) NOT NULL,
  PRIMARY KEY (`projects_data_id`),
  KEY `owner_id` (`projects_data_owner_id`),
  KEY `project_id` (`projects_data_project_id`),
  KEY `component_id` (`projects_data_component_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `admin_options`;
CREATE TABLE IF NOT EXISTS `admin_options` (
  `admin_options_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_key` varchar(64) NOT NULL,
  `admin_value` varchar(256),
  PRIMARY KEY (`admin_options_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
