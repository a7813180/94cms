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
      <div class="channelN">
        <div class="l Tit2"><?php echo $page['name'];?></div>
      </div>
      <div class="oh myart">
        <div></div>
        <?php echo $page['content'];?>
        <div></div>
      </div>
    </div>
  </div>
</div>

<?php include $this->mytpl_class->view('foot.html',true); ?>
</body>
</html>
