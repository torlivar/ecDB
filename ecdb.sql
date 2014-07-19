-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 11, 2013 at 11:42 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecdb_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_head`
--

DROP TABLE IF EXISTS `category_head`;
CREATE TABLE IF NOT EXISTS `category_head` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_head`
--

INSERT INTO `category_head` (`id`, `name`) VALUES
(1, 'Cable'),
(2, 'Capacitor'),
(3, 'Connector'),
(4, 'Diode'),
(5, 'IC'),
(6, 'Inductor'),
(7, 'Mechanic'),
(16, 'Module'),
(8, 'Opto'),
(18, 'Oscillator'),
(13, 'Resistor'),
(15, 'Sensor'),
(10, 'Switch'),
(11, 'Transformer'),
(12, 'Transistor'),
(14, 'Display'),
(17, 'Miscellaneous');

-- --------------------------------------------------------

--
-- Table structure for table `category_sub`
--

DROP TABLE IF EXISTS `category_sub`;
CREATE TABLE IF NOT EXISTS `category_sub` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_sub`
--

INSERT INTO `category_sub` (`id`, `name`) VALUES
(101, 'Ribbon'),
(102, 'Coax'),
(199, 'Misc'),
(201, 'Ceramic'),
(202, 'Electrolytic'),
(203, 'Polyester'),
(204, 'Tantalum'),
(205, 'Variable'),
(299, 'Misc'),
(301, 'Audio'),
(302, 'Coax'),
(303, 'DC'),
(304, 'D-Sub'),
(399, 'Misc'),
(401, 'Rectifier'),
(402, 'Schottky'),
(403, 'Small Signal'),
(404, 'Zener'),
(499, 'Misc'),
(501, '4xxx'),
(502, '74xx'),
(503, 'Microcontroller'),
(504, 'Comparator'),
(505, 'Op. Amp.'),
(506, 'Temperature'),
(507, 'Timer & Osc.'),
(508, 'Voltage Ref.'),
(509, 'Voltage Reg.'),
(599, 'Misc'),
(601, 'Ferrite'),
(602, 'Filter'),
(603, 'Inductor'),
(699, 'Misc'),
(701, 'Box'),
(702, 'Distance'),
(703, 'Fuse'),
(704, 'Motor'),
(705, 'Screw'),
(799, 'Misc'),
(801, 'Reflex coupler'),
(802, 'Laser'),
(803, 'LED'),
(804, 'LED 3mm'),
(805, 'LED 5mm'),
(806, 'Optocoupler'),
(899, 'Misc'),
(901, 'Crystal'),
(902, 'Resonator'),
(999, 'Misc'),
(1001, 'Keypad'),
(1002, 'Momentary'),
(1003, 'PCB Mounted'),
(1004, 'Rotary Encoder'),
(1005, 'Toggle Switch'),
(1099, 'Misc'),
(1101, 'Power Supply'),
(1102, 'Transformer'),
(1103, 'Wall Adapter'),
(1199, 'Misc'),
(1201, 'BJT'),
(1202, 'JFET'),
(1203, 'MOSFET'),
(1204, 'NPN'),
(1205, 'PNP'),
(1299, 'Misc'),
(1301, '1/4W Carbon'),
(1302, '1/4W Metal'),
(1303, '1/6W Carbon'),
(1304, '1/6W Metal'),
(1305, '0603'),
(1306, '0805'),
(1307, '1206'),
(1308, 'Effect'),
(1309, 'Photo'),
(1399, 'Misc'),
(1601, 'GSM'),
(1602, 'GPS'),
(1699, 'Misc'),
(1401, 'LCD'),
(1402, 'VFD'),
(1404, 'LED'),
(1403, 'TFT'),
(807, 'IR LED'),
(1499, 'Misc'),
(708, 'IC Socket'),
(709, 'Heat Sink'),
(510, 'Data Converter'),
(511, 'A/D Multiplexer'),
(512, 'Driver'),
(513, 'Opto Driver'),
(514, 'DC/DC Converter'),
(515, 'Audio/Video'),
(516, 'Memory'),
(1311, 'Temperature'),
(1310, 'Network'),
(305, 'HF'),
(710, 'Knob'),
(711, 'Meter'),
(103, 'Standard'),
(104, 'Mains'),
(105, 'Signal/Data'),
(106, 'Fiber optic'),
(306, 'PCB'),
(1603, 'Bluetooth'),
(1604, 'WLAN'),
(1605, 'ZigBee'),
(1606, 'RFID'),
(307, 'Mains'),
(1501, 'Moisture'),
(1502, 'Temperature'),
(1503, 'Pressure'),
(1504, 'Magnetic'),
(1505, 'Hall Effect'),
(1506, 'Gas'),
(1507, 'Accelerometer'),
(1508, 'Light'),
(1509, 'Proximity'),
(1599, 'Misc'),
(1799, 'Misc'),
(517, 'Logic'),
(1312, 'Potentiometer'),
(1006, 'Relay'),
(308, 'Data'),
(1801, 'Crystal'),
(1802, 'Resonator'),
(1899, 'Misc'),
(1007, 'DIP'),
(406, 'Bridge'),
(1206, 'Triac'),
(1313, '1/3W Carbon'),
(1314, '1/3W Metal'),
(1315, 'Precision');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `firstname`, `lastname`, `login`, `mail`, `passwd`, `admin`, `measurement`, `currency`, `reg_date`) VALUES
(1, 'Admin', 'Admin', 'admin', 'admin@127.0.0.1', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 'USD', '2014-07-18 23:34:32');


-- --------------------------------------------------------

--
-- Table structure for table `members_stats`
--

DROP TABLE IF EXISTS `members_stats`;
CREATE TABLE IF NOT EXISTS `members_stats` (
  `members_stats_id` int(11) NOT NULL AUTO_INCREMENT,
  `members_stats_member` int(11) NOT NULL,
  `members_stats_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`members_stats_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_owner` int(11) NOT NULL,
  `project_name` varchar(64) NOT NULL,
  `project_public` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`project_id`),
  KEY `project_owner` (`project_owner`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `projects_data`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `admin_options`
--

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
