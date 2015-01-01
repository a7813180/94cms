# -----------------------------------------------------------
# Description:备份的数据表[结构] blog_access,blog_block,blog_cate,blog_link,blog_model,blog_news,blog_node,blog_product,blog_role,blog_role_user,blog_slide,blog_user
# Description:备份的数据表[数据] blog_access,blog_block,blog_cate,blog_link,blog_model,blog_news,blog_node,blog_product,blog_role,blog_role_user,blog_slide,blog_user
# Time: 2014-05-27 21:04:24
# -----------------------------------------------------------
# SQLFile Label：#1
# -----------------------------------------------------------


# 表的结构 blog_access 
DROP TABLE IF EXISTS `blog_access`;
CREATE TABLE `blog_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) default NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

# 表的结构 blog_block 
DROP TABLE IF EXISTS `blog_block`;
CREATE TABLE `blog_block` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '' COMMENT '名称',
  `remark` varchar(200) NOT NULL default '' COMMENT '说明',
  `content` text COMMENT '内容',
  `blocktype` int(10) unsigned NOT NULL default '0' COMMENT '类型',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ;

# 表的结构 blog_cate 
DROP TABLE IF EXISTS `blog_cate`;
CREATE TABLE `blog_cate` (
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
  `template_category` varchar(60) NOT NULL default '',
  `template_list` varchar(60) NOT NULL default '',
  `template_show` varchar(60) NOT NULL default '',
  `content` text COMMENT '内容',
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '显示',
  `sort` smallint(6) NOT NULL default '99' COMMENT '排序',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='栏目分类表' ;

# 表的结构 blog_link 
DROP TABLE IF EXISTS `blog_link`;
CREATE TABLE `blog_link` (
  `id` int(10) NOT NULL auto_increment,
  `cid` int(10) NOT NULL default '0',
  `title` varchar(80) NOT NULL,
  `pic` varchar(100) default NULL,
  `url` varchar(80) NOT NULL,
  `sort` int(10) NOT NULL default '99',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ;

# 表的结构 blog_model 
DROP TABLE IF EXISTS `blog_model`;
CREATE TABLE `blog_model` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `tablename` varchar(30) NOT NULL default '',
  `status` tinyint(1) unsigned NOT NULL default '0',
  `template_category` varchar(60) NOT NULL default '',
  `template_list` varchar(60) NOT NULL default '',
  `template_show` varchar(60) NOT NULL default '',
  `sort` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ;

# 表的结构 blog_news 
DROP TABLE IF EXISTS `blog_news`;
CREATE TABLE `blog_news` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(60) NOT NULL default '' COMMENT '标题',
  `shorttitle` varchar(30) NOT NULL default '' COMMENT '副标题',
  `color` char(10) NOT NULL default '' COMMENT '标题颜色',
  `copyfrom` varchar(30) NOT NULL default '',
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
  PRIMARY KEY  (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ;

# 表的结构 blog_node 
DROP TABLE IF EXISTS `blog_node`;
CREATE TABLE `blog_node` (
  `id` smallint(6) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) default NULL,
  `status` tinyint(1) default '0',
  `remark` varchar(255) default NULL,
  `sort` smallint(6) unsigned default NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 ;

# 表的结构 blog_product 
DROP TABLE IF EXISTS `blog_product`;
CREATE TABLE `blog_product` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(30) default NULL COMMENT '标题',
  `color` char(10) default NULL COMMENT '标题颜色',
  `keywords` varchar(50) default '' COMMENT '关键字',
  `litpic` varchar(150) default NULL COMMENT '缩略图',
  `listpic` text COMMENT '图片地址',
  `content` text COMMENT '内容',
  `description` varchar(255) default NULL COMMENT '摘要描述',
  `price` float default '0',
  `trueprice` float default '0',
  `brand` varchar(50) default NULL COMMENT '品牌',
  `units` varchar(50) NOT NULL default '' COMMENT '单位',
  `specification` varchar(50) NOT NULL default '' COMMENT '规格',
  `publishtime` int(10) unsigned NOT NULL default '0' COMMENT '发布时间',
  `updatetime` int(10) unsigned NOT NULL default '0' COMMENT '更新时间',
  `click` smallint(6) unsigned NOT NULL default '0' COMMENT '点击数',
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `commentflag` tinyint(1) default '1' COMMENT '允许评论',
  `flag` set('c','h','p','f','s','j','a','b') default NULL COMMENT '文章属性',
  `status` tinyint(1) unsigned default '0' COMMENT '1回收站',
  `userid` int(10) unsigned default '0',
  `aid` int(10) unsigned default '0' COMMENT 'admin',
  PRIMARY KEY  (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ;

# 表的结构 blog_role 
DROP TABLE IF EXISTS `blog_role`;
CREATE TABLE `blog_role` (
  `id` smallint(6) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) default NULL,
  `status` tinyint(1) unsigned default NULL,
  `remark` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ;

# 表的结构 blog_role_user 
DROP TABLE IF EXISTS `blog_role_user`;
CREATE TABLE `blog_role_user` (
  `role_id` mediumint(9) unsigned default NULL,
  `user_id` char(32) default NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

# 表的结构 blog_slide 
DROP TABLE IF EXISTS `blog_slide`;
CREATE TABLE `blog_slide` (
  `id` int(100) NOT NULL auto_increment,
  `cid` int(10) NOT NULL default '0',
  `title` varchar(100) NOT NULL,
  `pic` varchar(100) default NULL,
  `url` varchar(100) default NULL,
  `content` text,
  `sort` varchar(10) NOT NULL default '99',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ;

# 表的结构 blog_user 
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user` (
  `id` int(4) NOT NULL auto_increment COMMENT 'id',
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `lock` tinyint(1) default NULL,
  `time` varchar(30) default NULL,
  `ip` varchar(30) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ;



# 转存表中的数据：blog_access 
INSERT INTO `blog_access` VALUES ('1','22','3','');
INSERT INTO `blog_access` VALUES ('1','21','3','');
INSERT INTO `blog_access` VALUES ('1','20','2','');
INSERT INTO `blog_access` VALUES ('1','19','3','');
INSERT INTO `blog_access` VALUES ('1','18','3','');
INSERT INTO `blog_access` VALUES ('1','17','2','');
INSERT INTO `blog_access` VALUES ('1','10','3','');
INSERT INTO `blog_access` VALUES ('1','9','3','');
INSERT INTO `blog_access` VALUES ('1','6','3','');
INSERT INTO `blog_access` VALUES ('1','5','3','');
INSERT INTO `blog_access` VALUES ('1','4','3','');
INSERT INTO `blog_access` VALUES ('2','15','3','');
INSERT INTO `blog_access` VALUES ('2','14','2','');
INSERT INTO `blog_access` VALUES ('2','1','1','');
INSERT INTO `blog_access` VALUES ('1','3','3','');
INSERT INTO `blog_access` VALUES ('1','2','2','');
INSERT INTO `blog_access` VALUES ('1','16','3','');
INSERT INTO `blog_access` VALUES ('1','15','3','');
INSERT INTO `blog_access` VALUES ('1','14','2','');
INSERT INTO `blog_access` VALUES ('1','1','1','');
INSERT INTO `blog_access` VALUES ('1','11','2','');
INSERT INTO `blog_access` VALUES ('1','12','3','');
INSERT INTO `blog_access` VALUES ('2','16','3','');
INSERT INTO `blog_access` VALUES ('2','17','2','');
INSERT INTO `blog_access` VALUES ('2','18','3','');
INSERT INTO `blog_access` VALUES ('2','19','3','');
INSERT INTO `blog_access` VALUES ('2','20','2','');
INSERT INTO `blog_access` VALUES ('2','21','3','');
INSERT INTO `blog_access` VALUES ('2','22','3','');
INSERT INTO `blog_access` VALUES ('2','11','2','');
INSERT INTO `blog_access` VALUES ('2','12','3','');


# 转存表中的数据：blog_block 
INSERT INTO `blog_block` VALUES ('1','多少多少','多少多少','','1');


# 转存表中的数据：blog_cate 
INSERT INTO `blog_cate` VALUES ('1','公司介绍','About','','0','1','0','','','　 　建湖永大实业有限公司是一家著名的以研究供水、排水、洁水、泵、阀等流体输送，贮水设备、电气控制系统，节能环保热泵热水机组和节能环保设备的多元化企业。','','List_page.html','Show_news.html','<p style="text-indent:2em;">
	<p>
		&nbsp;
	</p>
<span> 
	<p>
		&nbsp;<span style="background-color:#ffffff;color:#333333;"><span style="font-family:Microsoft YaHei;font-size:14px;">&nbsp; </span><span style="font-family:Microsoft YaHei;font-size:14px;">建湖永大实业有限公司是一家著名的以研究供水、排水、洁水、泵、阀等流体输送，贮水设备、电气控制系统，节能环保热泵热水机组和节能环保设备的多元化企业。</span></span><br />
<span style="background-color:#ffffff;font-family:Microsoft YaHei;color:#333333;font-size:14px;">　 　经过十余年的磨砺，企业现总占地面积139860m2，建筑面积71000 m2。总部位于美丽富饶的黄海之滨——江苏省建湖县沿河大道1号，基地紧傍盐徐高速，新长铁路6公里，离京沪高速仅30公里，距盐城机场仅40公里，交通便捷，区域位置优越。</span><br />
<span style="background-color:#ffffff;color:#333333;"><span style="font-family:Microsoft YaHei;font-size:14px;">　 　企业下辖永大水箱、永大压力容器、永大管业、永大泵业、永大阀门、永大环保、永大洁水。其产品品种达一千多种涵盖了供水、排水、洁水、环保、制热水及制冷、D1D2类压力容器、泵、阀系统设备。性价合理，质量可靠；广泛应用于市政、水利、建筑、消防、电力、环保、石油、化工、矿业、医院、国防等领域。销售收入连续多年立于行业之首！</span><span class="Apple-converted-space"> </span></span><br />
<span style="background-color:#ffffff;font-family:Microsoft YaHei;color:#333333;font-size:14px;">　 　建湖永大实业有限公司相继通过了ISO9001、IS014001、3C、D1D2类压力容器等认证，并全面推行了ERP信息化管理。先后获得国家和行业颁发的相关证书，连续多年被政府部门评为“先进企业”“信用企业” “百强私营企业”等众多荣誉称号。</span><br />
<span style="background-color:#ffffff;font-family:Microsoft YaHei;color:#333333;font-size:14px;">　 　随着企业的稳健发展，企业逐步建立和完善了销售服务网络,现已在上海、北京、浙江、湖南、东北三省、安徽、云南、贵州、西安、兰州等地设立了分支机构，建立了专业销售服务队伍。为广大客户提供专业的技术与优良的营销服务。目前企业拥有：“毛主席纪念堂”“浦东机场”“宝钢”“娃哈哈”“哥伦比亚大使馆“印尼汽车厂” “扬子石化” “金山石化” “克胜农药” “印度铅矿” “仪征化纤” “天厨味精”“坦桑尼亚中国援建中学”“萍矿”“上广电”“东北传媒”“北京富豪酒店”“扬州友好医院”等一大批国内外样板工程。 永大实企为实现“百年永大”的远大目标，本着永远珍惜人与自然的和谐关系；并提供人类生活质量，我们将在水工领域不断努力！并以“以用户为已任”的企业经营理念，为国人奉献！</span><br />
<span style="background-color:#ffffff;font-family:Microsoft YaHei;color:#333333;font-size:14px;">　 　水，因永大而致高、致清、致远……</span><br />
<span style="background-color:#ffffff;font-family:Microsoft YaHei;color:#333333;font-size:14px;">　　“永不言败”是永大人的精神理念，永大人秉承：“诚信经营、成果共享”的经营理念，并致力于“保护环境、节约能源、对能源进行二次利用”是永大人的艰巨任务，让我们和所有致力于环保事业的朋友来共同推动人类“节能环保”型产业向前发展！共建美好绿色的地球村！</span></span> 
	</p>','1','99');
INSERT INTO `blog_cate` VALUES ('12','测试栏目图片分类','','/cms941/Uploads/images/201405/538194b0d740f.jpg','0','1','0','','','','','List_page.html','Show_news.html','','0','99');
INSERT INTO `blog_cate` VALUES ('2','产品展示','Product','','0','3','0','','','','','List_product.html','Show_product.html','','1','99');
INSERT INTO `blog_cate` VALUES ('3','工程案例','Case','','0','3','0','','','','','List_product.html','Show_product.html','','1','99');
INSERT INTO `blog_cate` VALUES ('4','资质证书','Zizhi','','0','1','0','','','','','List_page.html','Show_news.html','','1','99');
INSERT INTO `blog_cate` VALUES ('5','联系我们','','/cms941/Uploads/images/201405/5381f9966fe71.jpg','0','1','0','','','','','List_page.html','Show_news.html','','1','99');
INSERT INTO `blog_cate` VALUES ('6','公司介绍下级1','','','1','1','0','','','','','List_page.html','','','1','99');
INSERT INTO `blog_cate` VALUES ('7','公司介绍下级2','','','1','1','1','','','','','List_page.html','','','1','99');
INSERT INTO `blog_cate` VALUES ('8','产品展示1','','','2','3','0','','','','','List_product.html','','','1','99');
INSERT INTO `blog_cate` VALUES ('9','产品展示2','Product2','','2','1','0','','产品展示2','产品展示2产品展示2产品展示2产品展示2产品展示2产品展示2','','List_page.html','','','1','99');
INSERT INTO `blog_cate` VALUES ('10','新闻资讯','News','','0','2','0','','','','','List_news.html','Show_news.html','','1','99');
INSERT INTO `blog_cate` VALUES ('11','行业动态','Dynamic','','0','1','0','','','','','List_page.html','Show_news.html','','0','99');
INSERT INTO `blog_cate` VALUES ('13','测试分类2','','/cms941/Uploads/images/201405/538194c366817.jpg','0','2','0','','','','','List_news.html','Show_news.html','','1','99');


# 转存表中的数据：blog_link 
INSERT INTO `blog_link` VALUES ('1','0','四海网络','','http://localhost/','99');
INSERT INTO `blog_link` VALUES ('2','0','四海网络1','http://localhost/phpMYADMIN/themes/original/img/logo_left.png','http://localhost/cms941/index.php/Admin/Index/index','99');
INSERT INTO `blog_link` VALUES ('3','0','三2','','http://localhost/cms941/index.php/Admin/Index/index','99');
INSERT INTO `blog_link` VALUES ('4','0','SDDS','','http://localhost/cms941/index.php/Admin/Index/index','99');


# 转存表中的数据：blog_model 
INSERT INTO `blog_model` VALUES ('2','文章模型','','news','1','','List_news.html','Show_news.html','2');
INSERT INTO `blog_model` VALUES ('1','单页模型','','page','1','','List_page.html','Show_page.html','1');
INSERT INTO `blog_model` VALUES ('3','产品模型','','product','1','','List_product.html','Show_product.html','3');


# 转存表中的数据：blog_news 
INSERT INTO `blog_news` VALUES ('1','建湖干部被曝歌厅不雅照现已被免职 纪委：搂的不是“女法制晚报讯（记者 王选辉）  近日，江苏盐城建湖县一网友发帖称，该县','','','','','','','法制晚报讯（记者 王选辉） 近日，江苏盐城<a class="relatedlink" href="http://jianhuzx.com/" target="_blank">建湖</a>县一网友发帖称，该县住建局一名干部在歌厅搂抱小姐。帖子还附有几张两人搂抱在一起的照片。照片中，一间豪华装修的KTV房间内，一名身穿黑色衣服的中年男子在搂抱一位女子，动作不雅。<br />
<br />
今天上午，建湖县纪检监察三室主任陈亚飞接受《法制晚报》采访时称，照片中搂抱女子的男性，是建湖县住建局建设工程质量检测中心负责人焦某。目前已经被免职。<br />
<br />
此前有媒体记者联系上照片中的焦某。“我抱的是我女同学，不是什么小姐。”焦某说，今年春节前有外地的同学回家，然后就喊几位同学聚聚的，一高兴就喝了点酒，然后去KTV唱歌时有了不雅的举动。<br />
<br />
参与此事调查的陈亚飞称，“搂抱的是女同学”的说法并不属实。经过调查，实际上焦某搂抱的女子是歌厅的一位陪酒小姐。当天焦某和一帮朋友在歌厅喝酒唱歌，并没有组织所谓的同学聚会。<br />
<br />
陈亚飞说，住建局建设工程质量检测中心并不是事业单位，而是一个国有企业。纪检部门看到网上曝光的情况后，就立即启动了调查，并随后免去了焦某的职务。<br />','法制晚报讯（记者 王选辉） 近日，江苏盐城建湖县一网友发帖称，该县住建局一名干部在歌厅搂抱小姐。帖子还附有几张两人搂抱在一起的照片。照片中，一间豪华装修的KTV','1400752003','1400752003','13','10','1','','0','0','1');
INSERT INTO `blog_news` VALUES ('2','是的顶顶顶顶顶','','','','','','','','','1400768114','1400768114','55','10','1','','0','0','1');
INSERT INTO `blog_news` VALUES ('3','圣诞节看电视剧','','','','','','','','','1400768119','1400768119','69','10','1','','0','0','1');
INSERT INTO `blog_news` VALUES ('4','较深的口号就是好解释看','','','','','','','','','1400768124','1400768124','32','10','1','','0','0','1');
INSERT INTO `blog_news` VALUES ('5','就快了撒就快了撒可螺丝结顶考虑','','','','','','','','','1400768129','1400768129','91','10','1','','0','0','1');
INSERT INTO `blog_news` VALUES ('6','建湖可就快了就快了考虑就快了了看见‘','','','','','','','','','1400768134','1400768134','85','10','1','','0','0','1');
INSERT INTO `blog_news` VALUES ('7','就考虑就快了就快了可六角恐龙 就考虑j','','','','','','','','','1400768140','1400768140','42','10','1','','0','0','1');
INSERT INTO `blog_news` VALUES ('8','看见了就快了刻录机刻录机考虑','','','','','','','','','1400768146','1400768146','107','10','1','','0','0','1');


# 转存表中的数据：blog_node 
INSERT INTO `blog_node` VALUES ('1','Admin','后台管理','1','','1','0','1');
INSERT INTO `blog_node` VALUES ('2','Rbac','后台用户权限管理','1','','1','1','2');
INSERT INTO `blog_node` VALUES ('3','index','用户列表','1','','1','2','3');
INSERT INTO `blog_node` VALUES ('4','role','角色列表','1','','2','2','3');
INSERT INTO `blog_node` VALUES ('5','node','节点列表','1','','3','2','3');
INSERT INTO `blog_node` VALUES ('6','node_add','添加节点','1','','4','2','3');
INSERT INTO `blog_node` VALUES ('8','index','首页','1','','1','7','2');
INSERT INTO `blog_node` VALUES ('9','role_add','添加角色','1','','5','2','3');
INSERT INTO `blog_node` VALUES ('10','user_add','添加用户','1','','6','2','3');
INSERT INTO `blog_node` VALUES ('11','system','系统设置','1','','5','1','2');
INSERT INTO `blog_node` VALUES ('12','code','验证码设置','1','','1','11','3');
INSERT INTO `blog_node` VALUES ('14','Blog','文章管理','1','','1','1','2');
INSERT INTO `blog_node` VALUES ('15','index','文章列表','1','','1','14','3');
INSERT INTO `blog_node` VALUES ('16','blog_add','添加文章','1','','2','14','3');
INSERT INTO `blog_node` VALUES ('17','Attr','文章属性','1','','3','1','2');
INSERT INTO `blog_node` VALUES ('18','index','属性列表','1','','1','17','3');
INSERT INTO `blog_node` VALUES ('19','add_attr','添加属性','1','','2','17','3');
INSERT INTO `blog_node` VALUES ('20','Cate','分类管理','1','','4','1','2');
INSERT INTO `blog_node` VALUES ('21','index','分类列表','1','','1','20','3');
INSERT INTO `blog_node` VALUES ('22','addcate','添加分类','1','','2','20','3');


# 转存表中的数据：blog_product 
INSERT INTO `blog_product` VALUES ('1','3222222222','','','/cms941/Uploads/images/201405/537dca3fe097d.jpg','','','','0','0','','','','1400752485','1400752485','68','2','1','','0','0','1');
INSERT INTO `blog_product` VALUES ('2','211111111','','','','','','','0','0','','','','1400752976','1400752976','42','2','1','','0','0','1');


# 转存表中的数据：blog_role 
INSERT INTO `blog_role` VALUES ('1','wzgly','0','1','网站管理员');
INSERT INTO `blog_role` VALUES ('2','wzbj','0','1','网站编辑');


# 转存表中的数据：blog_role_user 
INSERT INTO `blog_role_user` VALUES ('1','6');
INSERT INTO `blog_role_user` VALUES ('1','6');
INSERT INTO `blog_role_user` VALUES ('1','7');
INSERT INTO `blog_role_user` VALUES ('2','7');
INSERT INTO `blog_role_user` VALUES ('0','8');
INSERT INTO `blog_role_user` VALUES ('1','2');
INSERT INTO `blog_role_user` VALUES ('2','3');


# 转存表中的数据：blog_slide 
INSERT INTO `blog_slide` VALUES ('2','0','titile','/cms941/Uploads/images/201405/53822906c5cca.jpg','I(\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\','I(\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\'id\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\',0,\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\'intval\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\');','1');
INSERT INTO `blog_slide` VALUES ('16','1','','/cms941/Uploads/images/201405/53829671d993f.jpg','','','1');
INSERT INTO `blog_slide` VALUES ('17','0','','/cms941/Uploads/images/201405/538295f0d709f.JPG','','','1');


# 转存表中的数据：blog_user 
INSERT INTO `blog_user` VALUES ('1','admin','e10adc3949ba59abbe56e057f20f883e','0','1401162532','127.0.0.1');
INSERT INTO `blog_user` VALUES ('2','a7813180','e10adc3949ba59abbe56e057f20f883e','0','1398269132','127.0.0.1');
INSERT INTO `blog_user` VALUES ('3','b7813180','e10adc3949ba59abbe56e057f20f883e','0','1398269257','127.0.0.1');
