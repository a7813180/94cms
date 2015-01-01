<?php require("fun.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMSHead网站管理系统安装程序</title>
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link rel="stylesheet" type="text/css" href="image/css.css" />
</head>

<body>
<div class="top">
 <div class="head">
  <div class="head_logo">
	<a href="#" target="_blank"><img src="image/logo.png" title="CMS" border="0" /></a></div>
  <div class="head_info">
	<a href="http://www.cmshead.com">官方网站</a>
	<a href="http://bbs.cmshead.com/forum.php">技术论坛</a>
	<a href="http://bbs.cmshead.com/thread-8-1-1.html">使用帮助</a>
  </div>
  <div class="clear"></div>
 </div>
</div>
<div class="contain">
	<div class="step"></div><!--安装过程-->
	<div class="body">
		<div class="lcs">
			<iframe height="500" width="730" style="border:0" src="license.html" id="iframe"></iframe>
		</div>
	</div><!--内容部分-->
	<div class="btn"><input type="button" value="下一步：检测安装环境" class="inp" onclick="javascript:location.href='check.php'" /></div><!--按钮-->
</div>
</body>
</html>
