CREATE TABLE `94_link` (
  `id` int(10) NOT NULL auto_increment,
  `cid` int(10) NOT NULL default '0',
  `title` varchar(80) NOT NULL,
  `pic` varchar(100) default NULL,
  `url` varchar(80) NOT NULL,
  `sort` int(10) NOT NULL default '99',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;
