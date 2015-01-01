CREATE TABLE `94_gbook` (
  `id` int(10) NOT NULL auto_increment,
  `ip` varchar(15) NOT NULL default '0',
  `title` varchar(50) NOT NULL,
  `name` varchar(10) NOT NULL,
  `time` varchar(20) NOT NULL,
  `tel` varchar(11) default NULL,
  `email` varchar(15) default NULL,
  `chuanzhen` varchar(15) default NULL,
  `content` text NOT NULL,
  `admin_time` varchar(20) NOT NULL default '0',
  `admin_content` text NOT NULL,
  `lock` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

