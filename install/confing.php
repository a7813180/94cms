<?php require("fun.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>94cms网站管理系统安装程序</title>
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link rel="stylesheet" type="text/css" href="image/css.css" />
<script type="text/javascript" src="image/jquery-1.4.4.min.js"></script>
<script type="text/javascript" language="javascript" src="public/js/formValidator.js"></script>
<script type="text/javascript" language="javascript" src="public/js/formValidatorRegex.js"></script>
<link href="public/css/validator.css" rel="stylesheet" type="text/css">
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
$(document).ready(function(){
	$.formValidator.initConfig({formid:"form1",debug:false,submitonce:true,
		onerror:function(msg,obj,errorlist){
			//$.map(errorlist,function(msg1){alert(msg1)});
		}
	});
	
	$("#localhost").formValidator({ onshow: "",onfocus: "1-100个英文字母或数字", oncorrect: "√" }).inputValidator({ min: 1, max: 100, onerror: "1-100个英文字母或数字" });
	$("#db_name").formValidator({ onshow: "",onfocus: "1-100个英文字母或数字", oncorrect: "√" }).inputValidator({ min: 1, max: 100, onerror: "1-100个英文字母或数字" });
	$("#db_user").formValidator({ onshow: "",onfocus: "1-100个英文字母或数字", oncorrect: "√" }).inputValidator({ min: 1, max: 100, onerror: "1-100个英文字母或数字" });
	$("#db_password").formValidator({ onshow: "",empty:true,onfocus: "", oncorrect: "√" }).inputValidator({ min: 0, max: 100, onerror: "" });
	$("#db_pre").formValidator({ onshow: "改表前缀可放多个应用",empty:true,onfocus: "", oncorrect: "√" }).inputValidator({min:0,max:30,onerror:""}).regexValidator({regexp:"pretable",datatype:"enum",onerror:"表前缀必须带有下划线"})
	
	$("#admin").formValidator({ onshow: "请输入用户名", onfocus: "1-100个英文字母或数字", oncorrect: "√" }).inputValidator({ min: 1, max: 100, onerror: "1-100个英文字母或数字" });
	$("#password").formValidator({onshow:"请输入密码",onfocus:"1-100个英文字母或数字",oncorrect:"密码合法"}).inputValidator({min:1,max: 100,empty:{leftempty:false,rightempty:false,emptyerror:"密码两边不能有空符号"},onerror:"密码不能为空,请确认"});

    $("#password2").formValidator({ onshow: "", onfocus: "请重新输入密码", oncorrect: "密码一致" }).inputValidator({ min: 1, max: 100, empty: { leftEmpty: false, rightEmpty: false, emptyError: "重复密码两边不能有空符号" }, onerror: "重复密码不能为空" }).compareValidator({ desid: "password", operateor: "=", onerror: "2次密码不一致" });
    //$("#mail").formValidator({ onshow: "请填写电子邮箱", onfocus: "请填写有效的电子邮箱。", oncorrect: "√" }).inputValidator({ min: 3, onerror: "请输入电子信箱。" }).regexValidator({ regexp:"^([\\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$", onerror: "邮箱格式如：abc@dsc.com。" });
	$("#SITE_URL").formValidator({ onshow: "",onfocus: "网址不能为空", oncorrect: "√" }).inputValidator({ min: 4, max: 50, onerror: "网址不能为空" });
	$("#SITE_NAME").formValidator({ onshow: "",onfocus: "网站名称不能为空", oncorrect: "√" }).inputValidator({ min: 1, max: 200, onerror: "网站名称不能为空" });
	$("#SITE_KEYWORDS").formValidator({ onshow: "",onfocus: "网站关键字不能为空", oncorrect: "√" }).inputValidator({ min: 1, max: 200, onerror: "网站关键字不能为空" });
	$("#SITE_DESCRIPTION").formValidator({ onshow: "",onfocus: "网站描述不能为空", oncorrect: "√" }).inputValidator({ min: 1, onerror: "网站描述不能为空" });
});
</script>
</head>

<body>
<div class="top">
 <div class="head">
  <div class="head_logo"><a href="./" target="_blank"><img src="image/logo.png" title="94cms网站管理系统" border="0" /></a></div>
  <div class="head_info">
	<a href="http://www.94cms.com">94cms官方网站</a>
	<a href="http://demo.94cms.com">演示站</a>
	<a href="http://bbs.94cms.com/forum.php">技术论坛</a>
	<a href="http://bbs.94cms.com/thread-8-1-1.html">使用帮助</a></div>
  <div class="clear"></div>
 </div>
</div>
<div class="contain">
	<div class="step"></div><!--安装过程-->
	<form name="form1"  id="form1" action="install.php" method="post">
	<input type="hidden" name="is_data" value="0" />
	<input type="hidden" name="home_cache" value="0" />
	<input type="hidden" name="mod_rewrite" value="0" />
	<div class="body">
	
		<p class="title">数据库设置</p>
		<ul class="ck_ul">
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">数据库主机：</span>
				<span class="lf">
					<input class="inpt"  id="localhost" name="localhost" value="localhost"/>
					<span id="localhostTip" ></span>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">数据库端口：</span>
				<span class="lf">
					<input class="inpt"  id="db_port" name="db_port" value="3306"/>
					<span id="db_portTip" ></span>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">数据库名称：</span>
				<span class="lf">
					<input class="inpt" id="db_name" name="db_name" value="94cms"/>
					<span id="db_nameTip" ></span>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">数据库用户名：</span>
				<span class="lf">
					<input class="inpt" id="db_user" name="db_user" value="root"/>
					<span id="db_userTip" ></span>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">数据库密码：</span>
				<span class="lf">
					<input class="inpt" id="db_password" name="db_password" value=""/>
					<span id="db_passwordTip" ></span>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">数据表前缀：</span>
				<span class="lf">
					<input class="inpt" id="db_pre" name="db_pre" value="94_"/>
					<span id="db_preTip" ></span>
				</span>
			</li>
		</ul>
		<p class="title">站点配置信息</p>
		<ul class="ck_ul">
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">管理账号：</span>
				<span class="lf">
					<input class="inpt" id="admin" name="admin" value="admin"/>
					<span id="adminTip" ></span>
				</span>
				
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">管理密码：</span>
				<span class="lf">
					<input class="inpt" id="password"  name="password" value="admin"/>
					<span id="passwordTip" ></span>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">确认密码：</span>
				<span class="lf">
					<input class="inpt" id="password2" name="password2" value="admin"/>
					<span id="password2Tip" ></span>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">昵称：</span>
				<span class="lf">
					<input class="inpt" id="nickname" name="nickname" value="系统管理员"/>
					<span id="nicknameTip" ></span>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">网站网址：</span>
				<span class="lf">
					<input class="inpt" id="SITE_URL"  name="SITE_URL" value="<?php echo thisDomain()?>" />
					<span id="SITE_URLTip" ></span>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">网站名称：</span>
				<span class="lf">
					<input class="inpt" id="SITE_NAME"  name="SITE_NAME" value="94cms网站管理系统"/>
					<span id="SITE_NAMETip" ></span>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">网站关键字：</span>
				<span class="lf">
					<input class="inpt" id="SITE_KEYWORDS"  name="SITE_KEYWORDS" value="94cms,PHP CMS,ThinkPHPCMS,DWZ,jUI"/>
					<span id="SITE_KEYWORDSTip" ></span>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">网站描述：</span>
				<span class="lf">
					<input class="inpt" id="SITE_DESCRIPTION"  name="SITE_DESCRIPTION" value="94cms是一套基于ThinkPHP和DWZ(jUI)的PHP CMS，类似于帝国CMS，织梦CMS（DEDECMS）等，但它还具有插件分享机制等优点。"/>
					<span id="SITE_DESCRIPTIONTip" ></span>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">管理邮箱：</span>
				<span class="lf">
					<input class="inpt" id="mail"  name="mail" value=""/>
					<span id="mailTip" ></span>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">ICP备案号：</span>
				<span class="lf">
					<input class="inpt" id="icp_num" name="icp_num" value="蜀ICP备00000000号"/>
					<span id="mailTip" ></span>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">测试数据：</span>
				<span class="lf">
					<input style="margin-top:5px;" id="is_data"  name="is_data" value="1" type="checkbox" checked="checked"/>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">前台伪静态后缀：</span>
				<span class="lf">
					<input style="margin-top:5px;" id="mod_rewrite"  name="mod_rewrite" value="1" type="checkbox" checked="checked"/>
				</span>
			</li>
			<li style="padding-left:50px;">
				<span class="lf" style="width:100px; text-align:right">前台整页面缓存：</span>
				<span class="lf">
					<input style="margin-top:5px;" id="home_cache"  name="home_cache" value="1" type="checkbox"/>
				</span>
			</li>
		</ul>
	</div><!--内容部分-->
	<div class="btn"><input type="button" value="上一步：检查安装环境" class="inp" onclick="javascript:location.href='check.php'" /><input id="btnReg" type="submit" value="开始安装" class="inp"/></div><!--按钮-->
	</form>
</div>
</body>
</html>
