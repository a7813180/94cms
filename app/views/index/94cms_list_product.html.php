<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="<?php echo $webname;?>" />
<title><?php echo $catename;?>-<?php echo $webname;?></title>
<meta name="keywords" content="<?php echo $catekey;?>" />
<meta name="description" content="<?php echo $catedes;?>" />
<link href="<?php echo base_url('template/'.C('template')).'/'; ?>style/style.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('template/'.C('template')).'/'; ?>js/jq1.91.js"></script>
<style type="text/css">
<!--
.list_pic {
 
	float: left;
	height: 250px;
	width: 230px;
	margin-top: 8px;
	margin-right: 8px;
	margin-bottom: 17px;
	margin-left: 8px;
}
.list_pic img {
	width: 230px;
    height: 215px;
}
.list_pic span {
	width: 230px;
	height: 35px;
	text-align: center;
}
-->
</style>
</head>
<body>
<?php include $this->mytpl_class->view('top.html',true); ?>
<div class="channelLine">
  <div class="wrap">
    <div class="posi"> <?php echo catepos($cid);?> </div>
  </div>
</div>
<div class="n_cont">
  <div class="wrap fix">
    <div class="l side">
      <dl class="side_menu">
        <dt class="Tit2"><?php echo cate($tcid,'name');?> </dt>
        <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("content_tag");if (method_exists($CI->content_tag, '_cate')) {$data = $CI->content_tag->_cate(array('cid'=>$tcid,'order'=>'asc','num'=>'10',));}?>
        <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <dd><a href='<?php echo $v['url'];?>' <?php if($cid == $v['id']) { ?>class='thisclass' <?php } ?>><?php echo $v['name'];?></a></dd>
        <?php } ?>
        <?php if(isset($data))unset($data);?>
      </dl>
    </div>
    <div class="r main">
      <h2 class="Tit2"><?php echo $catename;?></h2>
      <ul>
         <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("content_tag");if (method_exists($CI->content_tag, '_list')) {$data = $CI->content_tag->_list(array('cid'=>$cid,'order'=>'desc','sort'=>'id','pagenum'=>$pagenum,'num'=>'6',));}$total = $CI->content_tag->_list(array('cid'=>$cid,'order'=>'desc','sort'=>'id','pagenum'=>$pagenum,'num'=>'6',),true);$page = $CI->content_tag->page($ename,$cid,$pagenum,$total,6,5);?>
        <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <li class="list_pic"><a href="<?php echo $v['url'];?>"><img src="<?php echo $v['litpic'];?>"></a><span><?php echo $v['title'];?>-<?php echo $v['id'];?> </span></li>
        <?php } ?>
       </ul>
      <div style="clear:both"> </div>
      <?php echo $page;?>
      <?php if(isset($data))unset($data);?> </div>
  </div>
</div>
<?php include $this->mytpl_class->view('foot.html',true); ?>
</body>
</html>
