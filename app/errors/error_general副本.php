<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>404 -<?php echo C('webname');?></title>
<link href="<?php echo base_url('public/admin');?>/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('public/admin');?>/js/jquery-1.7.2.min.js"></script>
<script language="javascript">
	$(function(){
    $('.error').css({'position':'absolute','left':($(window).width()-490)/2});
	$(window).resize(function(){  
    $('.error').css({'position':'absolute','left':($(window).width()-490)/2});
    })  
});  
</script>
</head>
<body style="background:#edf6fa;">
<div class="error">
  <h2><?php echo C('webname');?>友情提醒</h2>
  <p><?php echo $heading; ?> </p>
  <p><?php echo $message; ?></p>
  <p>

   <a href="<?php echo base_url();?>" >首页</a> 
		
		
        <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("content_tag");if (method_exists($CI->content_tag, '_cate')) {$data = $CI->content_tag->_cate(array('order'=>'asc','cid'=>'0','num'=>'10',));}?>
        <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
        <?php if($v['id']!='5') { ?>
       | <a href="<?php echo $v['url'];?>"><?php echo $v['name'];?></a> 
        <?php } ?>
        <?php } ?>
        <?php if(isset($data))unset($data);?>
     
      </ul>
  </p>
  
<div class="reindex"><a href="<?php echo base_url();?>" target="_parent">返回首页</a></div>
</div>
</body>
</html>
