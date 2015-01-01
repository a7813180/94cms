#
# TABLE STRUCTURE FOR: 94_block
#

DROP TABLE IF EXISTS 94_block;

CREATE TABLE `94_block` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '' COMMENT '名称',
  `remark` varchar(200) NOT NULL default '' COMMENT '说明',
  `content` text COMMENT '内容',
  `blocktype` int(10) unsigned NOT NULL default '0' COMMENT '类型',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO 94_block (`id`, `name`, `remark`, `content`, `blocktype`) VALUES (1, '多少多少', '多少多少', '', 1);


#
# TABLE STRUCTURE FOR: 94_cate
#

DROP TABLE IF EXISTS 94_cate;

CREATE TABLE `94_cate` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '' COMMENT '栏目分类名称',
  `ename` varchar(200) NOT NULL default '' COMMENT '别名',
  `litpic` varchar(100) NOT NULL COMMENT '/栏目图片',
  `pid` int(10) unsigned NOT NULL default '0' COMMENT '上级分类',
  `modelid` int(10) unsigned NOT NULL default '0' COMMENT '所属模型',
  `type` tinyint(4) NOT NULL default '0' COMMENT '类别',
  `seotitle` varchar(50) NOT NULL default '',
  `keywords` varchar(50) default '' COMMENT '关键字',
  `description` varchar(255) default '' COMMENT '关键字',
  `template_index` varchar(60) NOT NULL,
  `template_list` varchar(60) NOT NULL default '',
  `template_show` varchar(60) NOT NULL default '',
  `template_list_wap` varchar(60) NOT NULL,
  `template_show_wap` varchar(60) NOT NULL,
  `content` text COMMENT '内容',
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '显示',
  `sort` smallint(6) NOT NULL default '99' COMMENT '排序',
  KEY `pid` (`pid`),
  KEY `id` (`id`),
  KEY `name` (`name`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='栏目分类表';

INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (1, '单篇模型', '', '/uploads/images/11-18-14163050123821.png', 0, 1, 0, '', '单篇模型', '单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型', '', 'list_about.html', 'show_news.html', 'list_about_wap.html', 'show_about_wap.html', '单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型单篇模型', 1, 99);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (2, '单篇模型1', '', '', 1, 1, 0, '', '单篇模型1', '单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1', '', 'list_about.html', 'show_news.html', 'list_about_wap.html', 'show_about_wap.html', '单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1单篇模型1', 1, 0);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (3, '单篇模型2', '', '', 1, 1, 0, '', '单篇模型2', '单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2', '', 'list_about.html', 'show_news.html', 'list_about_wap.html', 'show_about_wap.html', '单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2单篇模型2', 1, 1);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (4, '单篇模型3', '', '', 1, 1, 0, '', '', '', '', 'list_about.html', 'show_news.html', 'list_about_wap.html', 'show_about_wap.html', NULL, 1, 2);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (5, '文章模型', 'news', '', 0, 2, 0, '', '', '', '', 'list_news.html', 'show_news.html', 'list_news_wap.html', 'show_news_wap.html', NULL, 1, 99);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (6, '文章模型1', 'dataz', '', 5, 2, 0, '', '', '', '', 'list_news.html', 'show_news.html', 'list_news_wap.html', 'show_news_wap.html', NULL, 1, 0);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (7, '文章模型2', '', '', 5, 2, 0, '', '', '', '', 'list_news.html', 'show_news.html', 'list_news_wap.html', 'show_news_wap.html', NULL, 1, 1);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (8, '文章模型3', '', '', 5, 2, 0, '', '', '', '', 'list_news.html', 'show_news.html', 'list_news_wap.html', 'show_news_wap.html', NULL, 1, 2);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (9, '文章模型4', '', '', 5, 2, 0, '', '', '', '', 'list_news.html', 'show_news.html', 'list_news_wap.html', 'show_news_wap.html', NULL, 1, 3);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (10, '产品模型', '', '', 0, 3, 0, '', '', '', '', 'list_product.html', 'show_product.html', 'list_product_wap.html', 'show_product_wap.html', NULL, 1, 99);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (11, '产品模型1', '', '', 10, 3, 0, '', '', '', '', 'list_product.html', 'show_product.html', 'list_product_wap.html', 'show_product_wap.html', NULL, 1, 0);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (12, '产品模型2', '', '', 10, 3, 0, '', '', '', '', 'list_product.html', 'show_product.html', 'list_product_wap.html', 'show_product_wap.html', NULL, 1, 1);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (13, '产品模型3', '', '', 10, 3, 0, '', '', '', '', 'list_product.html', 'show_product.html', 'list_product_wap.html', 'show_product_wap.html', NULL, 1, 2);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (14, '产品模型4', '', '', 10, 3, 0, '', '', '', '', 'list_product.html', 'show_product.html', 'list_product_wap.html', 'show_product_wap.html', NULL, 1, 3);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (15, '下载模型', '', '', 0, 4, 0, '', '', '', '', 'list_duwnload.html', 'show_duwnload.html', 'list_duwmload_wap.html', 'show_duwmload_wap.html', NULL, 1, 99);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (16, '下载模型1', '', '', 15, 4, 0, '', '', '', '', 'list_duwnload.html', 'show_duwnload.html', 'list_duwmload_wap.html', 'show_duwmload_wap.html', NULL, 1, 0);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (17, '下载模型2', '', '', 15, 4, 0, '', '', '', '', 'list_duwnload.html', 'show_duwnload.html', 'list_duwmload_wap.html', 'show_duwmload_wap.html', NULL, 1, 1);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (18, '自定义模型', '', '', 0, 5, 0, '', '', '', 'index_news.html', 'list_diy.html', 'show_diy.html', 'list_about_wap.html', 'show_about_wap.html', NULL, 1, 99);
INSERT INTO 94_cate (`id`, `name`, `ename`, `litpic`, `pid`, `modelid`, `type`, `seotitle`, `keywords`, `description`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `content`, `status`, `sort`) VALUES (21, '留言', '@module/gbook/home.htm', '', 0, 1, 1, '', '', '', '', 'list_about.html', 'show_news.html', '', '', NULL, 1, 99);


#
# TABLE STRUCTURE FOR: 94_comment
#

DROP TABLE IF EXISTS 94_comment;

CREATE TABLE `94_comment` (
  `id` int(10) NOT NULL auto_increment,
  `ip` varchar(20) default NULL,
  `name` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `time` int(10) NOT NULL,
  `cid` int(10) NOT NULL,
  `sid` int(10) NOT NULL,
  `pid` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (1, '127.0.0.1', '多少多少多少', '机器设备及厂区基础设施，目前一期项目竣工投产。 &nbsp&nb...&quot /&gt;\n&ltlink href=&quothttp://localhost/sihai4/template/boze/style/style.css&quot rel=&quotstyles', 1416324953, 5, 13, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (2, '127.0.0.1', '小巴西', '测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系统测试评论系', 1416325155, 5, 13, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (3, '127.0.0.1', '是是是是', '测试你动的吧', 1416325895, 5, 5, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (4, '127.0.0.1', '你傻啊！', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。', 1416326396, 5, 5, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (5, '127.0.0.1', '爱好者', '支持你们网站！真心不错哦！', 1416327163, 5, 16, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (6, '127.0.0.1', '小笨蛋', '这个产品不错我想购买', 1416327350, 11, 16, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (7, '127.0.0.1', '小马奔腾', '我来支持你们的哦！请相信我', 1416328346, 5, 16, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (8, '127.0.0.1', '哈哈 你知道吗', '哈哈 你知道吗', 1416328366, 5, 16, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (9, '127.0.0.1', '啥意思啊', '我不知道你在说什么哦', 1416328668, 11, 16, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (10, '127.0.0.1', ' 爱上', '不知道在', 1416328705, 11, 16, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (11, '127.0.0.1', '好吧 我是来测试刷新的！', '好吧 我是来测试刷新的！', 1416328817, 11, 16, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (12, '127.0.0.1', '不没玩', '还是刷新的评论系统不完美！', 1416330457, 11, 16, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (13, '127.0.0.1', '请文明上网！你动的吧！', '请文明上网！你动的吧！', 1416330546, 11, 16, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (14, '127.0.0.1', '西瓜太郎', '大咖秀！', 1416330577, 11, 16, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (15, '127.0.0.1', '棋牌', '什么情况的哦', 1416366668, 5, 11, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (16, '127.0.0.1', '大叔是的多少说的', '是的顶顶顶顶顶的的的', 1416367564, 5, 16, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (17, '127.0.0.1', '哈哈哈啊啊', '哈哈哈啊啊', 1416367578, 5, 16, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (18, '127.0.0.1', '小飞机', '这个是测试~', 1416367813, 6, 2, 0);
INSERT INTO 94_comment (`id`, `ip`, `name`, `content`, `time`, `cid`, `sid`, `pid`) VALUES (19, '127.0.0.1', '?490union//select//1//from//(s', '?490union//select//1//from//(select//count(),concat(floor(rand(0)2),0x3a,(select//concat(user,0x3d,passw', 1416367837, 6, 2, 0);


#
# TABLE STRUCTURE FOR: 94_diyconf
#

DROP TABLE IF EXISTS 94_diyconf;

CREATE TABLE `94_diyconf` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(10) NOT NULL,
  `field` varchar(10) NOT NULL,
  `info` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO 94_diyconf (`id`, `name`, `field`, `info`) VALUES (3, '自定义', 'web_diy', '提示');


#
# TABLE STRUCTURE FOR: 94_diymoxing
#

DROP TABLE IF EXISTS 94_diymoxing;

CREATE TABLE `94_diymoxing` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(60) NOT NULL default '' COMMENT '标题',
  `shorttitle` varchar(30) NOT NULL default '' COMMENT '副标题',
  `color` char(10) NOT NULL default '' COMMENT '标题颜色',
  `template_show` varchar(30) default NULL,
  `author` varchar(30) NOT NULL default '',
  `keywords` varchar(50) default '' COMMENT '关键字',
  `litpic` varchar(150) NOT NULL default '' COMMENT '缩略图',
  `content` text COMMENT '内容',
  `description` varchar(255) NOT NULL default '' COMMENT '摘要描述',
  `publishtime` int(10) unsigned NOT NULL default '0' COMMENT '发布时间',
  `updatetime` int(10) unsigned NOT NULL default '0' COMMENT '更新时间',
  `click` smallint(6) unsigned NOT NULL default '0' COMMENT '点击数',
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `commentflag` tinyint(1) NOT NULL default '1' COMMENT '允许评论',
  `flag` set('c','h','p','f','s','j','a','b') default NULL COMMENT '文章属性',
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '1回收站',
  `userid` int(10) unsigned NOT NULL default '0',
  `aid` int(10) unsigned NOT NULL default '0' COMMENT 'admin',
  `sort` smallint(10) NOT NULL default '99',
  PRIMARY KEY  (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (24, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (25, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (26, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (27, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (28, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (29, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (30, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (31, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (32, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (33, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (34, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (35, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (36, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (37, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (38, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (39, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (40, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (41, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (42, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (43, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (44, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (45, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (46, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (47, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (48, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);
INSERT INTO 94_diymoxing (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (49, '自定义模型测试内容', '', '', '0', 'Admin', '模型', '', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容', '自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定义模型测试内容自定...', 1416246885, 0, 142, 18, 1, '', 0, 0, 0, 99);


#
# TABLE STRUCTURE FOR: 94_diymoxing_data
#

DROP TABLE IF EXISTS 94_diymoxing_data;

CREATE TABLE `94_diymoxing_data` (
  `id` smallint(4) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

INSERT INTO 94_diymoxing_data (`id`) VALUES (25);
INSERT INTO 94_diymoxing_data (`id`) VALUES (26);
INSERT INTO 94_diymoxing_data (`id`) VALUES (27);
INSERT INTO 94_diymoxing_data (`id`) VALUES (28);
INSERT INTO 94_diymoxing_data (`id`) VALUES (29);
INSERT INTO 94_diymoxing_data (`id`) VALUES (30);
INSERT INTO 94_diymoxing_data (`id`) VALUES (31);
INSERT INTO 94_diymoxing_data (`id`) VALUES (32);
INSERT INTO 94_diymoxing_data (`id`) VALUES (33);
INSERT INTO 94_diymoxing_data (`id`) VALUES (34);
INSERT INTO 94_diymoxing_data (`id`) VALUES (35);
INSERT INTO 94_diymoxing_data (`id`) VALUES (36);
INSERT INTO 94_diymoxing_data (`id`) VALUES (37);
INSERT INTO 94_diymoxing_data (`id`) VALUES (38);
INSERT INTO 94_diymoxing_data (`id`) VALUES (39);
INSERT INTO 94_diymoxing_data (`id`) VALUES (40);
INSERT INTO 94_diymoxing_data (`id`) VALUES (41);
INSERT INTO 94_diymoxing_data (`id`) VALUES (42);
INSERT INTO 94_diymoxing_data (`id`) VALUES (43);
INSERT INTO 94_diymoxing_data (`id`) VALUES (44);
INSERT INTO 94_diymoxing_data (`id`) VALUES (45);
INSERT INTO 94_diymoxing_data (`id`) VALUES (46);
INSERT INTO 94_diymoxing_data (`id`) VALUES (47);
INSERT INTO 94_diymoxing_data (`id`) VALUES (48);
INSERT INTO 94_diymoxing_data (`id`) VALUES (49);


#
# TABLE STRUCTURE FOR: 94_down
#

DROP TABLE IF EXISTS 94_down;

CREATE TABLE `94_down` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(60) NOT NULL default '' COMMENT '标题',
  `shorttitle` varchar(30) NOT NULL default '' COMMENT '副标题',
  `color` char(10) NOT NULL default '' COMMENT '标题颜色',
  `template_show` varchar(30) default NULL,
  `author` varchar(30) NOT NULL default '',
  `keywords` varchar(50) default '' COMMENT '关键字',
  `litpic` varchar(150) NOT NULL default '' COMMENT '缩略图',
  `content` text COMMENT '内容',
  `description` varchar(255) NOT NULL default '' COMMENT '摘要描述',
  `publishtime` int(10) unsigned NOT NULL default '0' COMMENT '发布时间',
  `updatetime` int(10) unsigned NOT NULL default '0' COMMENT '更新时间',
  `click` smallint(6) unsigned NOT NULL default '0' COMMENT '点击数',
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `commentflag` tinyint(1) NOT NULL default '1' COMMENT '允许评论',
  `flag` set('c','h','p','f','s','j','a','b') default NULL COMMENT '文章属性',
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '1回收站',
  `userid` int(10) unsigned NOT NULL default '0',
  `aid` int(10) unsigned NOT NULL default '0' COMMENT 'admin',
  `sort` smallint(10) NOT NULL default '99',
  PRIMARY KEY  (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (1, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 164, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (2, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 164, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (3, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 164, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (4, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 164, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (5, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 164, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (6, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 164, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (7, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 164, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (8, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 164, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (9, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 165, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (10, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 166, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (11, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 165, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (12, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 165, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (13, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 166, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (14, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 167, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (15, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 168, 15, 1, '', 0, 0, 0, 99);
INSERT INTO 94_down (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (16, '测试下载产品', '', '', '0', 'Admin', '产品', '', '', '', 1416195382, 1416195382, 175, 15, 1, '', 0, 0, 0, 99);


#
# TABLE STRUCTURE FOR: 94_down_data
#

DROP TABLE IF EXISTS 94_down_data;

CREATE TABLE `94_down_data` (
  `id` smallint(4) NOT NULL auto_increment,
  `dowurl` varchar(500) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (1, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (2, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (3, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (4, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (5, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (6, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (7, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (8, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (9, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (10, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (11, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (12, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (13, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (14, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (15, '/sihai4/uploads/file/11-17-14162387632244.rar');
INSERT INTO 94_down_data (`id`, `dowurl`) VALUES (16, '/sihai4/uploads/file/11-17-14162387632244.rar');


#
# TABLE STRUCTURE FOR: 94_gbook
#

DROP TABLE IF EXISTS 94_gbook;

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
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

INSERT INTO 94_gbook (`id`, `ip`, `title`, `name`, `time`, `tel`, `email`, `chuanzhen`, `content`, `admin_time`, `admin_content`, `lock`) VALUES (30, '127.0.0.1', '输入咨询主题', '都是都是', '1415628807', '都是都是', NULL, NULL, '的是是是是是是是是是都是', '1415988435', '你想说什么呢2', 0);
INSERT INTO 94_gbook (`id`, `ip`, `title`, `name`, `time`, `tel`, `email`, `chuanzhen`, `content`, `admin_time`, `admin_content`, `lock`) VALUES (31, '127.0.0.1', '巍峨鹅鹅鹅', '巍峨鹅鹅鹅', '1415890713', '巍峨鹅鹅鹅', NULL, '巍峨鹅鹅鹅', '我鹅鹅鹅鹅鹅鹅饿', '0', '', 0);
INSERT INTO 94_gbook (`id`, `ip`, `title`, `name`, `time`, `tel`, `email`, `chuanzhen`, `content`, `admin_time`, `admin_content`, `lock`) VALUES (32, '127.0.0.1', '输入咨询主题', '2', '1416026305', '2', NULL, NULL, '2', '0', '', 0);
INSERT INTO 94_gbook (`id`, `ip`, `title`, `name`, `time`, `tel`, `email`, `chuanzhen`, `content`, `admin_time`, `admin_content`, `lock`) VALUES (33, '127.0.0.1', '合格', '', '1416291174', '', NULL, '', '个', '0', '', 0);
INSERT INTO 94_gbook (`id`, `ip`, `title`, `name`, `time`, `tel`, `email`, `chuanzhen`, `content`, `admin_time`, `admin_content`, `lock`) VALUES (34, '127.0.0.1', '的事实上', '', '1416292132', '', NULL, '', '的是是是是是是是是是', '0', '', 0);
INSERT INTO 94_gbook (`id`, `ip`, `title`, `name`, `time`, `tel`, `email`, `chuanzhen`, `content`, `admin_time`, `admin_content`, `lock`) VALUES (35, '127.0.0.1', '测试留言审核', '陈飞', '1416295680', '1826236967', NULL, '撒爱上', '的是是是是是是是是是是是是是是是是是', '0', '', 0);
INSERT INTO 94_gbook (`id`, `ip`, `title`, `name`, `time`, `tel`, `email`, `chuanzhen`, `content`, `admin_time`, `admin_content`, `lock`) VALUES (36, '127.0.0.1', '什么', '', '1416302438', '', NULL, '', '是多少顶顶顶顶顶\r\n', '0', '', 0);
INSERT INTO 94_gbook (`id`, `ip`, `title`, `name`, `time`, `tel`, `email`, `chuanzhen`, `content`, `admin_time`, `admin_content`, `lock`) VALUES (37, '127.0.0.1', '测试留言', '', '1416304187', '', NULL, '', '测试留言', '0', '', 0);
INSERT INTO 94_gbook (`id`, `ip`, `title`, `name`, `time`, `tel`, `email`, `chuanzhen`, `content`, `admin_time`, `admin_content`, `lock`) VALUES (38, '127.0.0.1', '是的', '', '1416304264', '', NULL, '', '多少', '0', '', 1);


#
# TABLE STRUCTURE FOR: 94_link
#

DROP TABLE IF EXISTS 94_link;

CREATE TABLE `94_link` (
  `id` int(10) NOT NULL auto_increment,
  `cid` int(10) NOT NULL default '0',
  `title` varchar(80) NOT NULL,
  `pic` varchar(100) default NULL,
  `url` varchar(80) NOT NULL,
  `sort` int(10) NOT NULL default '99',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO 94_link (`id`, `cid`, `title`, `pic`, `url`, `sort`) VALUES (1, 0, '94cms', '', 'http://www.94cms.com', 1);


#
# TABLE STRUCTURE FOR: 94_model
#

DROP TABLE IF EXISTS 94_model;

CREATE TABLE `94_model` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `tablename` varchar(30) NOT NULL default '',
  `status` tinyint(1) unsigned NOT NULL default '0',
  `template_index` varchar(60) NOT NULL,
  `template_list` varchar(60) NOT NULL default '',
  `template_show` varchar(60) NOT NULL default '',
  `template_list_wap` varchar(60) NOT NULL,
  `template_show_wap` varchar(60) NOT NULL,
  `sort` int(10) unsigned NOT NULL default '0',
  `lock` tinyint(1) NOT NULL default '0',
  KEY `id` (`id`),
  KEY `tablename` (`tablename`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO 94_model (`id`, `name`, `description`, `tablename`, `status`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `sort`, `lock`) VALUES (1, '单页模型', '', 'page', 1, '', 'list_about.html', 'show_news.html', 'list_about_wap.html', 'show_about_wap.html', 1, 1);
INSERT INTO 94_model (`id`, `name`, `description`, `tablename`, `status`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `sort`, `lock`) VALUES (2, '文章模型', '', 'news', 1, '', 'list_news.html', 'show_news.html', 'list_news_wap.html', 'show_news_wap.html', 2, 1);
INSERT INTO 94_model (`id`, `name`, `description`, `tablename`, `status`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `sort`, `lock`) VALUES (3, '产品模型', '', 'product', 1, '', 'list_product.html', 'show_product.html', 'list_product_wap.html', 'show_product_wap.html', 3, 1);
INSERT INTO 94_model (`id`, `name`, `description`, `tablename`, `status`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `sort`, `lock`) VALUES (4, '下载模型', '', 'down', 1, '', 'list_duwnload.html', 'show_duwnload.html', 'list_duwmload_wap.html', 'show_duwmload_wap.html', 4, 1);
INSERT INTO 94_model (`id`, `name`, `description`, `tablename`, `status`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `sort`, `lock`) VALUES (5, '自定义模型', '', 'diymoxing', 1, '', 'list_diy.html', 'show_diy.html', '', '', 99, 1);
INSERT INTO 94_model (`id`, `name`, `description`, `tablename`, `status`, `template_index`, `template_list`, `template_show`, `template_list_wap`, `template_show_wap`, `sort`, `lock`) VALUES (8, '测试吧', '', 'nidongd', 1, 'index_news.html', 'list_about.html', 'show_duwnload.html', 'list_about_wap.html', 'show_about_wap.html', 99, 0);


#
# TABLE STRUCTURE FOR: 94_model_field
#

DROP TABLE IF EXISTS 94_model_field;

CREATE TABLE `94_model_field` (
  `id` int(10) NOT NULL auto_increment,
  `label` varchar(50) NOT NULL COMMENT '字段别名',
  `field` varchar(20) NOT NULL COMMENT '字段',
  `modelid` int(10) NOT NULL COMMENT '属模型id',
  `fieldtype` varchar(50) NOT NULL COMMENT '字段类型',
  `tips` varchar(250) NOT NULL COMMENT '提示',
  `rules` varchar(250) NOT NULL COMMENT '验证规则',
  `sort` smallint(6) NOT NULL COMMENT '顺序',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `setting` mediumtext COMMENT '内容',
  KEY `modelid` (`modelid`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO 94_model_field (`id`, `label`, `field`, `modelid`, `fieldtype`, `tips`, `rules`, `sort`, `status`, `setting`) VALUES (3, '下载地址', 'dowurl', 4, 'file', '', '', 99, 1, '');
INSERT INTO 94_model_field (`id`, `label`, `field`, `modelid`, `fieldtype`, `tips`, `rules`, `sort`, `status`, `setting`) VALUES (2, '价格', 'jiage', 3, 'input', '请输入价格', '', 2, 1, 'array (\n  \'size\' => \'150\',\n  \'default\' => \'\',\n)');
INSERT INTO 94_model_field (`id`, `label`, `field`, `modelid`, `fieldtype`, `tips`, `rules`, `sort`, `status`, `setting`) VALUES (1, '多图上传', 'listimg', 3, 'images', '', '', 1, 1, 'array (\n  \'width\' => \'15\',\n  \'default\' => \'请上传图片\',\n)');


#
# TABLE STRUCTURE FOR: 94_news
#

DROP TABLE IF EXISTS 94_news;

CREATE TABLE `94_news` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(60) NOT NULL default '' COMMENT '标题',
  `shorttitle` varchar(30) NOT NULL default '' COMMENT '副标题',
  `color` char(10) NOT NULL default '' COMMENT '标题颜色',
  `template_show` varchar(30) default NULL,
  `author` varchar(30) NOT NULL default '',
  `keywords` varchar(50) default '' COMMENT '关键字',
  `litpic` varchar(150) NOT NULL default '' COMMENT '缩略图',
  `content` text COMMENT '内容',
  `description` varchar(255) NOT NULL default '' COMMENT '摘要描述',
  `publishtime` int(10) unsigned NOT NULL default '0' COMMENT '发布时间',
  `updatetime` int(10) unsigned NOT NULL default '0' COMMENT '更新时间',
  `click` smallint(6) unsigned NOT NULL default '0' COMMENT '点击数',
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `commentflag` tinyint(1) NOT NULL default '1' COMMENT '允许评论',
  `flag` tinyint(3) default NULL COMMENT '文章属性',
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '1回收站',
  `userid` int(10) unsigned NOT NULL default '0',
  `aid` int(10) unsigned NOT NULL default '0' COMMENT 'admin',
  `sort` smallint(10) NOT NULL default '99',
  PRIMARY KEY  (`id`),
  KEY `cid` (`cid`),
  KEY `title` (`title`),
  KEY `description` (`description`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (1, '博泽环保樊城区工业一期项目集中投产仪式', '', '', '0', 'Admin', '有限公司,樊城区,万州,工业,项目', '', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。<br />\r\n&nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。<br />\r\n&nbsp;&nbsp; 项目全部建成后，总生产能力达3亿元，年利税2000多万元，增加就业人员280多人。', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。 &nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。 &nbsp;&nb...', 1416191142, 0, 237, 6, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (2, '专题报道媒体看恒力视频中心', '', '', '0', 'Admin', '襄阳市,中老年,恒力,中心', '', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', 1416191158, 1416191158, 80, 6, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (3, '专题报道媒体看恒力视频中心', '', '', '0', 'Admin', '襄阳市,中老年,恒力,中心', '', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', 1416191158, 1416191158, 72, 5, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (4, '博泽环保樊城区工业一期项目集中投产仪式', '', '', '0', 'Admin', '有限公司,樊城区,万州,工业,项目', '', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。<br />\r\n&nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。<br />\r\n&nbsp;&nbsp; 项目全部建成后，总生产能力达3亿元，年利税2000多万元，增加就业人员280多人。', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。 &nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。 &nbsp;&nb...', 1416191142, 0, 236, 5, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (5, '博泽环保樊城区工业一期项目集中投产仪式', '', '', '0', 'Admin', '有限公司,樊城区,万州,工业,项目', '', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。<br />\r\n&nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。<br />\r\n&nbsp;&nbsp; 项目全部建成后，总生产能力达3亿元，年利税2000多万元，增加就业人员280多人。', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。 &nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。 &nbsp;&nb...', 1416191142, 0, 245, 5, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (6, '专题报道媒体看恒力视频中心', '', '', '0', 'Admin', '襄阳市,中老年,恒力,中心', '', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', 1416191158, 1416191158, 73, 5, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (7, '专题报道媒体看恒力视频中心', '', '', '0', 'Admin', '襄阳市,中老年,恒力,中心', '', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', 1416191158, 1416191158, 73, 5, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (8, '博泽环保樊城区工业一期项目集中投产仪式', '', '', '0', 'Admin', '有限公司,樊城区,万州,工业,项目', '', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。<br />\r\n&nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。<br />\r\n&nbsp;&nbsp; 项目全部建成后，总生产能力达3亿元，年利税2000多万元，增加就业人员280多人。', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。 &nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。 &nbsp;&nb...', 1416191142, 0, 236, 5, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (9, '博泽环保樊城区工业一期项目集中投产仪式', '', '', '0', 'Admin', '有限公司,樊城区,万州,工业,项目', '', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。<br />\r\n&nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。<br />\r\n&nbsp;&nbsp; 项目全部建成后，总生产能力达3亿元，年利税2000多万元，增加就业人员280多人。', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。 &nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。 &nbsp;&nb...', 1416191142, 0, 236, 5, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (10, '专题报道媒体看恒力视频中心', '', '', '0', 'Admin', '襄阳市,中老年,恒力,中心', '', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', 1416191158, 1416191158, 73, 5, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (11, '专题报道媒体看恒力视频中心', '', '', '0', 'Admin', '襄阳市,中老年,恒力,中心', '', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', 1416191158, 1416191158, 75, 5, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (12, '博泽环保樊城区工业一期项目集中投产仪式', '', '', '0', 'Admin', '有限公司,樊城区,万州,工业,项目', '', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。<br />\r\n&nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。<br />\r\n&nbsp;&nbsp; 项目全部建成后，总生产能力达3亿元，年利税2000多万元，增加就业人员280多人。', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。 &nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。 &nbsp;&nb...', 1416191142, 0, 238, 5, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (13, '博泽环保樊城区工业一期项目集中投产仪式', '', '', '0', 'Admin', '有限公司,樊城区,万州,工业,项目', '', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。<br />\r\n&nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。<br />\r\n&nbsp;&nbsp; 项目全部建成后，总生产能力达3亿元，年利税2000多万元，增加就业人员280多人。', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。 &nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。 &nbsp;&nb...', 1416191142, 0, 260, 5, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (14, '专题报道媒体看恒力视频中心', '', '', '0', 'Admin', '襄阳市,中老年,恒力,中心', '', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', 1416191158, 1416191158, 84, 5, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (15, '专题报道媒体看恒力视频中心', '', '', '0', 'Admin', '襄阳市,中老年,恒力,中心', '', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', '专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功 专题报道专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳市首届中老年气排球比赛圆满成功专题报道媒体看恒力视频中心 企业新闻 博泽环保赞助襄阳...', 1416191158, 1416191158, 76, 5, 1, 0, 0, 0, 0, 99);
INSERT INTO 94_news (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (16, '博泽环保樊城区工业一期项目集中投产仪式', '', '', '0', 'Admin', '有限公司,樊城区,万州,工业,项目', '', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。<br />\r\n&nbsp;&nbsp; 建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。<br />\r\n&nbsp;&nbsp; 项目全部建成后，总生产能力达3亿元，年利税2000多万元，增加就业人员280多人。', '项目位于樊城区万州大道南侧，占地64母，总投资1.5亿元，由襄阳博泽环保实业有限公司投资建设，襄阳博泽环保实业有限公司是一家集科研开发、生产经营于一体的科技型工业有限公司，公司资产总值1.2亿元，公司主要专业研制开发生产销售矿山采矿设备等。    建设的主要内容：生产车间15000㎡，科研楼5000㎡，生产用各种机器设备及厂区基础设施，目前一期项目竣工投产。  &nb;...', 1416191142, 1416191142, 324, 5, 1, 0, 0, 0, 0, 99);


#
# TABLE STRUCTURE FOR: 94_news_data
#

DROP TABLE IF EXISTS 94_news_data;

CREATE TABLE `94_news_data` (
  `id` smallint(4) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO 94_news_data (`id`) VALUES (3);
INSERT INTO 94_news_data (`id`) VALUES (4);
INSERT INTO 94_news_data (`id`) VALUES (5);
INSERT INTO 94_news_data (`id`) VALUES (6);
INSERT INTO 94_news_data (`id`) VALUES (7);
INSERT INTO 94_news_data (`id`) VALUES (8);
INSERT INTO 94_news_data (`id`) VALUES (9);
INSERT INTO 94_news_data (`id`) VALUES (10);
INSERT INTO 94_news_data (`id`) VALUES (11);
INSERT INTO 94_news_data (`id`) VALUES (12);
INSERT INTO 94_news_data (`id`) VALUES (13);
INSERT INTO 94_news_data (`id`) VALUES (14);
INSERT INTO 94_news_data (`id`) VALUES (15);
INSERT INTO 94_news_data (`id`) VALUES (16);


#
# TABLE STRUCTURE FOR: 94_nidongd
#

DROP TABLE IF EXISTS 94_nidongd;

CREATE TABLE `94_nidongd` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(60) NOT NULL default '' COMMENT '标题',
  `shorttitle` varchar(30) NOT NULL default '' COMMENT '副标题',
  `color` char(10) NOT NULL default '' COMMENT '标题颜色',
  `template_show` varchar(30) default NULL,
  `author` varchar(30) NOT NULL default '',
  `keywords` varchar(50) default '' COMMENT '关键字',
  `litpic` varchar(150) NOT NULL default '' COMMENT '缩略图',
  `content` text COMMENT '内容',
  `description` varchar(255) NOT NULL default '' COMMENT '摘要描述',
  `publishtime` int(10) unsigned NOT NULL default '0' COMMENT '发布时间',
  `updatetime` int(10) unsigned NOT NULL default '0' COMMENT '更新时间',
  `click` smallint(6) unsigned NOT NULL default '0' COMMENT '点击数',
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `commentflag` tinyint(1) NOT NULL default '1' COMMENT '允许评论',
  `flag` set('c','h','p','f','s','j','a','b') default NULL COMMENT '文章属性',
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '1回收站',
  `userid` int(10) unsigned NOT NULL default '0',
  `aid` int(10) unsigned NOT NULL default '0' COMMENT 'admin',
  `sort` smallint(10) NOT NULL default '99',
  PRIMARY KEY  (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: 94_nidongd_data
#

DROP TABLE IF EXISTS 94_nidongd_data;

CREATE TABLE `94_nidongd_data` (
  `id` smallint(4) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: 94_product
#

DROP TABLE IF EXISTS 94_product;

CREATE TABLE `94_product` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(60) NOT NULL default '' COMMENT '标题',
  `shorttitle` varchar(30) NOT NULL default '' COMMENT '副标题',
  `color` char(10) NOT NULL default '' COMMENT '标题颜色',
  `template_show` varchar(30) default NULL,
  `author` varchar(30) NOT NULL default '',
  `keywords` varchar(50) default '' COMMENT '关键字',
  `litpic` varchar(150) NOT NULL default '' COMMENT '缩略图',
  `content` text COMMENT '内容',
  `description` varchar(255) NOT NULL default '' COMMENT '摘要描述',
  `publishtime` int(10) unsigned NOT NULL default '0' COMMENT '发布时间',
  `updatetime` int(10) unsigned NOT NULL default '0' COMMENT '更新时间',
  `click` smallint(6) unsigned NOT NULL default '0' COMMENT '点击数',
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `commentflag` tinyint(1) NOT NULL default '1' COMMENT '允许评论',
  `flag` set('c','h','p','f','s','j','a','b') default NULL COMMENT '文章属性',
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '1回收站',
  `userid` int(10) unsigned NOT NULL default '0',
  `aid` int(10) unsigned NOT NULL default '0' COMMENT 'admin',
  `sort` smallint(10) NOT NULL default '99',
  PRIMARY KEY  (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (1, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 1, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (2, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 1, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (3, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 3, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (4, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 2, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (5, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 1, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (6, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 1, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (7, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 1, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (8, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 2, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (9, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 2, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (10, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 1, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (11, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 3, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (12, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 5, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (13, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 3, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (14, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 3, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (15, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 11, 11, 1, '', 0, 0, 0, 99);
INSERT INTO 94_product (`id`, `title`, `shorttitle`, `color`, `template_show`, `author`, `keywords`, `litpic`, `content`, `description`, `publishtime`, `updatetime`, `click`, `cid`, `commentflag`, `flag`, `status`, `userid`, `aid`, `sort`) VALUES (16, '测试产品你动的吧', '', '', '0', 'Admin', '产品', '/uploads/images/11-17-14162354292886.gif', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', '测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧测试产品你动的吧', 1416192225, 0, 36, 11, 1, '', 0, 0, 0, 99);


#
# TABLE STRUCTURE FOR: 94_product_data
#

DROP TABLE IF EXISTS 94_product_data;

CREATE TABLE `94_product_data` (
  `id` smallint(4) NOT NULL auto_increment,
  `jiage` varchar(500) default NULL,
  `listimg` varchar(500) default NULL,
  PRIMARY KEY  (`id`),
  KEY `jiage` (`jiage`(333))
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (1, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (2, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (3, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (4, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (5, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (6, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (7, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (8, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (9, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (10, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (11, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (12, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (13, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (14, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (15, '', '');
INSERT INTO 94_product_data (`id`, `jiage`, `listimg`) VALUES (16, '', '');


#
# TABLE STRUCTURE FOR: 94_slide
#

DROP TABLE IF EXISTS 94_slide;

CREATE TABLE `94_slide` (
  `id` int(100) NOT NULL auto_increment,
  `cid` int(10) NOT NULL default '0',
  `title` varchar(100) NOT NULL,
  `pic` varchar(100) default NULL,
  `url` varchar(100) default NULL,
  `content` text,
  `sort` varchar(10) NOT NULL default '99',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO 94_slide (`id`, `cid`, `title`, `pic`, `url`, `content`, `sort`) VALUES (1, 0, '', '/uploads/images/11-18-14162772395033.jpg', '#', '', '99');
INSERT INTO 94_slide (`id`, `cid`, `title`, `pic`, `url`, `content`, `sort`) VALUES (2, 0, '', '/uploads/images/11-18-14162772456533.jpg', '#', '', '99');
INSERT INTO 94_slide (`id`, `cid`, `title`, `pic`, `url`, `content`, `sort`) VALUES (3, 0, '', '/uploads/images/11-18-14162772512433.jpg', '#', '', '1');
INSERT INTO 94_slide (`id`, `cid`, `title`, `pic`, `url`, `content`, `sort`) VALUES (4, 1, '', '/uploads/images/11-18-14163105279073.png', '#', '', '99');
INSERT INTO 94_slide (`id`, `cid`, `title`, `pic`, `url`, `content`, `sort`) VALUES (5, 1, '', '/uploads/images/11-18-14163105397768.jpg', '#', '', '99');


#
# TABLE STRUCTURE FOR: 94_tag
#

DROP TABLE IF EXISTS 94_tag;

CREATE TABLE `94_tag` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(30) NOT NULL,
  `num` int(10) NOT NULL,
  KEY `id` (`id`),
  KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO 94_tag (`id`, `title`, `num`) VALUES (1, '有限公司', 1);
INSERT INTO 94_tag (`id`, `title`, `num`) VALUES (2, '樊城区', 1);
INSERT INTO 94_tag (`id`, `title`, `num`) VALUES (3, '万州', 1);
INSERT INTO 94_tag (`id`, `title`, `num`) VALUES (4, '工业', 1);
INSERT INTO 94_tag (`id`, `title`, `num`) VALUES (5, '项目', 1);
INSERT INTO 94_tag (`id`, `title`, `num`) VALUES (6, '模型', 1);


#
# TABLE STRUCTURE FOR: 94_tag_content
#

DROP TABLE IF EXISTS 94_tag_content;

CREATE TABLE `94_tag_content` (
  `tid` int(10) NOT NULL,
  `sid` int(10) NOT NULL,
  `mid` int(10) NOT NULL,
  KEY `tid` (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO 94_tag_content (`tid`, `sid`, `mid`) VALUES (1, 16, 2);
INSERT INTO 94_tag_content (`tid`, `sid`, `mid`) VALUES (2, 16, 2);
INSERT INTO 94_tag_content (`tid`, `sid`, `mid`) VALUES (3, 16, 2);
INSERT INTO 94_tag_content (`tid`, `sid`, `mid`) VALUES (4, 16, 2);
INSERT INTO 94_tag_content (`tid`, `sid`, `mid`) VALUES (5, 16, 2);
INSERT INTO 94_tag_content (`tid`, `sid`, `mid`) VALUES (6, 24, 15);


#
# TABLE STRUCTURE FOR: 94_user
#

DROP TABLE IF EXISTS 94_user;

CREATE TABLE `94_user` (
  `id` int(4) NOT NULL auto_increment COMMENT 'id',
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `lock` tinyint(1) default NULL,
  `up_time` varchar(30) NOT NULL,
  `time` varchar(30) default NULL,
  `ip` varchar(30) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO 94_user (`id`, `username`, `password`, `lock`, `up_time`, `time`, `ip`) VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, '1416328602', '1416375833', '127.0.0.1');


