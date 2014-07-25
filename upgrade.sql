ALTER TABLE category_head ENGINE = InnoDB;
ALTER TABLE category_sub ENGINE = InnoDB;
ALTER TABLE data ENGINE = InnoDB;
ALTER TABLE members ENGINE = InnoDB;
ALTER TABLE members_stats ENGINE = InnoDB;
ALTER TABLE projects ENGINE = InnoDB;
ALTER TABLE projects_data ENGINE = InnoDB;


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

alter table `projects` add column `project_public` tinyint(1) NOT NULL DEFAULT 0;
alter table `projects` add column `project_url` varchar(128) NULL;
alter table `projects` add column `project_desc` varchar(16384) NULL;


-- new updates
-- add primary key for category head, data
alter table category_head add constraint primary key (id);
alter table data add constraint primary key (id);
INSERT INTO `category_head` (`id`, `name`)  VALUES (9, 'Clocks');


-- create new subcategory table
DROP TABLE IF EXISTS `tblx`;
CREATE TABLE `tblx` (
  `id` int(11) not null auto_increment,
  `category_id` int(11) not null,
  `subcategory` varchar(64) not null,
  `oldid` int(11) not null,

  PRIMARY KEY (id),
  FOREIGN KEY fk_catid (category_id) REFERENCES category_head(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- update data
insert into tblx (category_id, subcategory, oldid)  select id div 100 as catid, `name`, id from category_sub ;

-- convert components
update data d, tblx c set d.category = c.id where d.category = c.oldid;

-- remove old and rename new
alter table tblx drop column oldid;
drop table category_sub;
rename table tblx to category_sub;
rename table category_head to category;

-- add admin user.... could be tricky if a user 'admin' exists...
INSERT INTO `members` (`firstname`, `lastname`, `login`, `mail`, `passwd`, `admin`, `measurement`, `currency`, `reg_date`) VALUES
('Admin', 'Admin', 'admin', 'admin@127.0.0.1', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 'USD', '2014-07-18 23:34:32');

-- delete everything related to 'demo' user...
delete from data where owner = (select member_id from members where login = 'demo');
delete from members_stats where members_stats_member = (select member_id from members where login = 'demo');
delete from projects_data where projects_data_owner_id = (select member_id from members where login = 'demo');
delete from projects where project_owner = (select member_id from members where login = 'demo');
delete from members where login = 'demo';

