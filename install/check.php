<?php
require("fun.php");
define('OB_PATH',substr(str_replace('\\','/',dirname(__FILE__)),0,-8));
//echo OB_PATH;
//指定要检查的目录
$check_dir=array("/","/APP","/Uploads");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>94CMS网站管理系统安装程序</title>
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link rel="stylesheet" type="text/css" href="image/css.css" />
<script type="text/javascript" src="image/jquery-1.4.4.min.js"></script>
<script type="text/javascript">
var $time=0;
var $totaltime=5;
$is_time=$totaltime;
function time_go(){
	$is_time=$is_time-1;
	$time=$time+1;
	$('#is_time').html($is_time);
	if($time==$totaltime){
		$url=$('#time_url').find('a').attr('href');
		location.href=$url;
	}
	setTimeout("time_go()",1000);
}
</script>
</head>

<body>
<div class="top">
 <div class="head">
  <div class="head_logo"><a href="./" target="_blank"><img src="image/logo.png" title="94CMS网站管理系统" border="0" /></a></div>
  <div class="head_info">
	<a href="http://www.94CMS.com">94CMS官方网站</a>
	<a href="http://demo.94CMS.com">演示站</a>
	<a href="http://bbs.94CMS.com/forum.php">技术论坛</a>
	<a href="http://bbs.94CMS.com/thread-8-1-1.html">使用帮助</a></div>
  <div class="clear"></div>
 </div>
</div>
<div class="contain">
	<div class="step"></div><!--安装过程-->
	<div class="body">
		<p class="title">目录权限</p>
		<ul class="ck_ul">
		<?php
		$check=0;
		foreach($check_dir as $k=>$v){
		?>
			<li><span class="lf1">【<?php echo $v;?>】文件夹</span><span class="lr">【<?php if(is_writable(OB_PATH.$v)){ echo "可写";}else{echo "<label style=\"color:red\">不可写</label>";$check=1;}?>】</span></li>
			<?php }?>
		</ul>
		<p class="title">系统环境</p>
		<ul class="ck_ul">
			<li><span class="lf1">【GD】支持</span><span class="lr"><?php echo extension_loaded('gd')&&function_exists('imagecreate')?'√支持GD':'<span style="color:red">×不支持GD(与图片有关的一些功能将不能使用)</span>';?></span></li>
			<li><span class="lf1">【MySQL】支持</span><span class="lr"><?php if(extension_loaded('mysql')&&function_exists('mysql_connect')){echo '√支持Mysql';}else{echo '<span style="color:red">×不支持Mysql</span>';$check=1;}?></span></li>
			<li><span class="lf1">【PHP版本】</span><span class="lr"><?php echo PHP_VERSION;?></span></li>
			<li><span class="lf1">【操作系统】</span><span class="lr"><?php echo PHP_OS;?></span></li>
			<li><span class="lf1">【服务器】</span><span class="lr"><?php echo $_SERVER['SERVER_SOFTWARE'];?></span></li>
			<li><span class="lf1">【服务器域名】</span><span class="lr"><?php echo thisDomain();?></span></li>
			
		</ul>
	</div><!--内容部分-->
	<div class="btn"><?php if($check==1){ echo"<span style=\"color:red\">安装失败</span>";}?><input type="button" value="上一步：说明" class="inp" onclick="javascript:location.href='index.php'" />
		<input type="button" value="重新检查" class="inp" onclick="javascript:location.href='check.php'" />
		<input <?php if($check){ echo "style=\"display:none\" disabled=\"disabled\"";}?> type="button" value="下一步：配置系统" class="inp" onclick="javascript:location.href='confing.php'" /></div><!--按钮-->
</div>
</body>
</html>
