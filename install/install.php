<?php require("fun.php");
if(!isset($_POST["localhost"])){
	header('Location:./');exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMSHead网站管理系统安装程序</title>
<link rel="stylesheet" type="text/css" href="image/css.css" />
</head>

<body>
<div class="top">
 <div class="head">
  <div class="head_logo"><a href="./" target="_blank"><img src="image/logo.png" title="CMSHead网站管理系统" border="0" /></a></div>
  <div class="head_info">
	<a href="http://www.cmshead.com">CMSHead官方网站</a>
	<a href="http://demo.cmshead.com">演示站</a>
	<a href="http://bbs.cmshead.com/forum.php">技术论坛</a>
	<a href="http://bbs.cmshead.com/thread-8-1-1.html">使用帮助</a></div>
  </div>
  <div class="clear"></div>
 </div>
</div>
<div class="contain">
	<div class="step"></div><!--安装过程-->
	<div class="body">
		<div class="lcs">
			<div style="width:700px; margin:10px auto;">
			<?php			
			echo "<p>安装中,请稍后...</p>";
			//1. 获取表单信息
			$localhost 	= trim($_POST["localhost"]);	//主机名	
			$db_port 	= trim($_POST["db_port"]);		//端口
			if($db_port=='') $db_port = '3306';
			$db_name 	= trim($_POST["db_name"]);		//库名
			$db_user 	= trim($_POST["db_user"]);		//账号
			$db_password= trim($_POST["db_password"]);	//密码
			$db_pre 	= trim($_POST["db_pre"]);		//表前缀
			
			$account 		= trim($_POST["admin"]);		//后台管理账号
			$password 	= trim($_POST["password"]);
			$nickname = trim($_POST["nickname"]);
			$last_login_time = time();
			$last_login_ip = get_client_ip();
			$email 		= trim($_POST["mail"]);
			$create_time 	= time();
			$status = 1;
			$SITE_URL = trim($_POST["SITE_URL"]);
			$SITE_NAME = trim($_POST["SITE_NAME"]);
			$SITE_KEYWORDS = trim($_POST["SITE_KEYWORDS"]);
			$SITE_DESCRIPTION = trim($_POST["SITE_DESCRIPTION"]);
			$icp_num 		= trim($_POST["icp_num"]);
			$is_data = $_POST["is_data"];
			$is_mod_rewrite = $_POST["mod_rewrite"];
			$is_home_cache = $_POST["home_cache"];
				
			
			//2. （连接数据库）效验一下数据库的账号和密码
			$link = @mysql_connect($localhost.':'.$db_port,$db_user,$db_password) or die(
					"<p style='color:red'>数据库连接错误！请检查数据库设置部分。</p>".
					"<p><a href='javascript:window.history.back();'>【返回】</a></p>");
			echo "<p>连接数据库成功...</p>";
			
			//3. 读取数据库的sql文件：cmshead.sql
			$sql_content="";
			$file = fopen("94cms.sql","r"); //以只读方式打开数据库sql文件
			while($s = fread($file,1024)){
				$sql_content.=$s;
			}
			fclose($file);
			echo "<p>成功读取数据库信息文件...</p>";
			$sql_content=str_replace('blog_','',$sql_content);//将ch_替换成空	
			//4. 解析配置文件。形成建表语句数组
			preg_match_all("/CREATE TABLE `(.*?)`(.*?);/is",$sql_content,$sqllist);
			//echo "<pre>";
			//var_dump($sqllist);
			//echo "</pre>";
			echo "<p>成功解析数据库结构文件...</p>";
			//5. 创建数据库
			if(mysql_select_db($db_name,$link)){
				echo "<p>数据库已存在....</p>";
			}else{
				$sql = "CREATE DATABASE `{$db_name}` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
				if(mysql_query($sql,$link)){
					echo "<p>数据库创建成功！....</p>";
				}else{
					die("<p style='color:red'>数据库{$db_name}创建失败!</p>".
						"<p><a href='javascript:window.history.back();'>【返回】</a></p>");
				}
				//进入到数据库中
				mysql_select_db($db_name,$link);
			}
			mysql_query("set names utf8");
			//6. 遍历创建表格
			foreach($sqllist[1] as $k=>$v){
				mysql_query("drop table if exists `".$db_pre.$v."`",$link);//删除同名的表
				$sql = "create table `".$db_pre.$v."` ".$sqllist[2][$k];
				//echo $sql."<br/><br/>";
				if(mysql_query($sql,$link)){
					echo "<p>数据表格".$db_pre.$v."创建成功！....</p>";
				}else{
					die("<p style='color:red'>数据表".$db_pre.$v."创建失败!</p>".
						"<p><a href='javascript:window.history.back();'>【返回】</a></p>");
				}
			}
			//echo "</pre>";
			//6.1 遍历创建表格插入数据 
			$basetables = array();
			preg_match_all("/insert into `(access|attribute|link|model|model_children|model_fieldnotes|node)`(.*?)\);[\r\n]/is",$sql_content,$insertlist);
			if($insertlist[0]){
				foreach($insertlist[0] as $key=>$val){
					$basetables[] = $insertlist[1][$key];
					$insertsql = str_replace('`'.$insertlist[1][$key].'`','`'.$db_pre.$insertlist[1][$key].'`',$val);
					mysql_query($insertsql,$link);
				}
			}
			echo "<p>成功插入基础数据...</p>";

			//安装时勾选了测试数据
			if($is_data){
				//6.1 遍历创建表格插入数据
				foreach($sqllist[1] as $k=>$v){
					preg_match_all("/insert into `(".$v.")`(.*?)\);[\r\n]/is",$sql_content,$insertlist);
					if($insertlist[0] && !in_array($v,$basetables)){
						foreach($insertlist[0] as $key=>$val){
							$insertsql = str_replace('`'.$v.'`','`'.$db_pre.$v.'`',$val);
							//echo $insertsql."<br>";
							mysql_query($insertsql,$link);
						}
					}
				}
				echo "<p>成功插入测试数据...</p>";
			}
			//echo "</pre>";
			
			//清空后台用户数据库
			mysql_query("truncate {$db_pre}user",$link);
			
			//7。添加后台管理员账户信息
 	
			$sql = "INSERT INTO `{$db_pre}user` (`id` ,`username` ,`password` ,`lock` ,`time` ,`ip` ) VALUES ('', '$admin', '".md5($password)."', '', '', '')";
            mysql_query($sql,$link);
			if(mysql_affected_rows()>0){
				echo "<p>添加管理员账号创建成功！....</p>";
			}else{
				die("<p style='color:red'>添加管理员账号失败!</p>".
					"<p><a href='javascript:window.history.back();'>【返回】</a></p>");
			}
			//8. 生成外部总配置文件config.php
$dbinfo="<?php
/**
  * 辛辛苦苦抽时间搞开源！方便我自己的同时也方便大家。
  * 如果可以请帮我多多宣传CMSHead，谢谢！让我们一起努力，来把CMSHead做成最强悍的开源CMS，虽然任重道远，但是我还是有信心去努力！欢迎您加群讨论QQ群号：146570772
  * Author：还是这个味 782039296@qq.com
*/
if(!defined('THINK_PATH')) exit();
return array(
	'OUTPUT_ENCODE'	=>	false, //关闭页面压缩，解决可能的330错误 (net::ERR_CONTENT_DECODING_FAILED)
	'DB_TYPE'		=>	'mysql',// 数据库类型	
	'DB_HOST'		=>	'{$localhost}',// 数据库服务器地址
	'DB_NAME'		=>	'{$db_name}',// 数据库名称
	'DB_USER'		=>	'{$db_user}',// 数据库用户名
	'DB_PWD'		=>	'{$db_password}',// 数据库密码
	'DB_PREFIX'		=>	'{$db_pre}',// 数据表前缀
	'DB_CHARSET'	=>	'utf8',// 网站编码
	'DB_PORT'		=>	'{$db_port}',// 数据库端口 
	
	//网站系统设置
	'SITE_URL'     		=>  '{$SITE_URL}',// 网站地址
	'SITE_NAME'			=>  '{$SITE_NAME}',
	'SITE_KEYWORDS'		=>  '{$SITE_KEYWORDS}',
	'SITE_DESCRIPTION'	=>  '{$SITE_DESCRIPTION}',
	'EMAIL'				=>	'{$email}',
	'OFFLINEMESSAGE'	=>	'本站正在维护中，暂不能访问。<br /> 请稍后再访问本站。',
	'ICP_NUM'			=>	'{$icp_num}',
	'CMSHEAD_VERSION'	=>	'2.1_20130528', //请勿随意修改
	
	//前台网友交互发布的信息默认是否审核0,1
	'HOME_SEND_STATUS'	=> 0,	
 
);";
			//开启伪静态后缀
			if($is_mod_rewrite){
				$mod_rewrite = '\'URL_HTML_SUFFIX\'		=>\'.html\',		//伪静态后缀acan';
			}else{
				$mod_rewrite = '//\'URL_HTML_SUFFIX\'		=>\'.html\',		//伪静态后缀acan';
			}
			//开启静态缓存
			if($is_home_cache){
				$home_cache = '
	/*前台整页面静态缓存规则*/
	\'HTML_CACHE_ON\'=>true, 
	\'HTML_READ_TYPE\'=>1,
	/*
	\'HTML_CACHE_RULES\'=> array( 
		\'index:\'=>array(\'{$_SERVER.REQUEST_URI|md5}\',60), 
		\'case:\'=>array(\'{$_SERVER.REQUEST_URI|md5}\',60), 
		\'about:\'=>array(\'{$_SERVER.REQUEST_URI|md5}\',60), 
		\'product:\'=>array(\'{$_SERVER.REQUEST_URI|md5}\',60), 
		\'test:\'=>array(\'{$_SERVER.REQUEST_URI|md5}\',60), 
		\'news:\'=>array(\'{$_SERVER.REQUEST_URI|md5}\',60), 
	  ), 
	  */
	\'HTML_CACHE_RULES\'=> array( 
		\'*\'=>array(\'{$_SERVER.REQUEST_URI|md5}\',60), 
	  ),';
		}else{
			$home_cache = '
	/*前台整页面静态缓存规则*/
	//\'HTML_CACHE_ON\'=>true, 
	//\'HTML_READ_TYPE\'=>1,
	/*
	\'HTML_CACHE_RULES\'=> array( 
		\'index:\'=>array(\'{$_SERVER.REQUEST_URI|md5}\',60), 
		\'case:\'=>array(\'{$_SERVER.REQUEST_URI|md5}\',60), 
		\'about:\'=>array(\'{$_SERVER.REQUEST_URI|md5}\',60), 
		\'product:\'=>array(\'{$_SERVER.REQUEST_URI|md5}\',60), 
		\'test:\'=>array(\'{$_SERVER.REQUEST_URI|md5}\',60), 
		\'news:\'=>array(\'{$_SERVER.REQUEST_URI|md5}\',60), 
	  ), 
	*/
	//\'HTML_CACHE_RULES\'=> array( 
	//	\'*\'=>array(\'{$_SERVER.REQUEST_URI|md5}\',60), 
	//),';
	}
		$file = fopen("../config.php","w");
		fwrite($file,$dbinfo);
		fclose($file);
		echo "<p>项目总配置文件/config.php配置成功！....</p>";
		
	
	       
			//10.生成一个安装锁文件install.lock
			$file = fopen("../install.lock","w");
			fclose($file);

			//11. 关闭数据库
			mysql_close($link);
			echo "<p>安装成功！....</p>";
			//12. 清除缓存
			@deleteDir('../APP/Runtime');
			define('CMS_SELF','../');
			echo "<p>管理员账号：{$account}</p><p>管理员密码：{$password}</p>";

 /*   if (delete_file("./install")){

            	echo "成功删除引导安装文件";
            }else{

            	echo "删除失败";
            }
              */


			?>
			</div>
		</div>
	</div><!--内容部分-->
	<?php if(true){?>
		<div class="btn"><input type="button" value="进入首页" class="inp" onclick="javascript:window.open('<?php echo CMS_SELF;?>');" /><input type="button" value="进入管理后台" class="inp" onclick="javascript:window.open('<?php echo CMS_SELF;?>admin.php');" /></div><!--按钮-->
	<?php
	}
	?>
</div>
</body>
</html>
