
CREATE TABLE `94_slide` (
  `id` int(100) NOT NULL auto_increment,
  `cid` int(10) NOT NULL default '0',
  `title` varchar(100) NOT NULL,
  `pic` varchar(100) default NULL,
  `url` varchar(100) default NULL,
  `content` text,
  `sort` varchar(10) NOT NULL default '99',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;