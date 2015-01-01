<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>404</title>
<style type="text/css">
body{margin:0;padding:0;font:14px/1.6 Arial,Sans-serif;background:#fff url(<?php echo base_url();?>public/404/body.png) repeat-x;}
a:link,a:visited{color:#007ab7;text-decoration:none;}
h1{
	position:relative;
	z-index:2;
	width:540px;
	height:0;
	margin:110px auto 15px;
	padding:230px 0 0;
	overflow:hidden;
	xxxxborder:1px solid;
	background-image: url(<?php echo base_url();?>public/404/Main.jpg);
	background-repeat: no-repeat;
}
h2{
	position:absolute;
	top:55px;
	left:233px;
	margin:0;
	font-size:0;
	text-indent:-999px;
	-moz-user-select:none;
	-webkit-user-select:none;
	user-select:none;
	cursor:default;
	width: 404px;
	height: 90px;
}




h3 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}
#container {
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
	height: 100px;
	width: 500px;
	margin-top: 10px;
	margin-right: auto;
	margin-bottom: 10px;
	margin-left: auto;
	padding-right: 10px;
	padding-left: 10px;
}
 
</style>
<!--[if lte IE 8]>
<style type="text/css">
h2 em{color:#e4ebf8;}
</style>
<![endif]-->
</head>
<body>
    <h1></h1>


	<div id="container">

		<h3><?php echo $heading; ?></h1>
		<?php echo $message; ?>
	</div>





</body>
</html>
