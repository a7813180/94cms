<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="<?php echo $webname;?>" />
<title><?php echo $webname;?></title>
<meta name="description" content="<?php echo $webdes;?>" />
<meta name="keywords" content="<?php echo $webkey;?>" />
<link href="<?php echo base_url('template/'.C('template')).'/'; ?>style/style.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('template/'.C('template')).'/'; ?>js/jq1.91.js"></script>
<script type="text/javascript" src="<?php echo base_url('template/'.C('template')).'/'; ?>js/index_proscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url('template/'.C('template')).'/'; ?>js/FloatAds.js"></script>
<script type="text/javascript" src="<?php echo base_url('template/'.C('template')).'/'; ?>js/common.js"></script>
</head>
<body class="index">
<?php include $this->mytpl_class->view('top.html',true); ?>
<div class="slide banner" data-slide='{"action":"click","fn":"banner_ext","time":"8000"}'> <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("module_tag");if (method_exists($CI->module_tag, '_slide')) {$data = $CI->module_tag->_slide(array('cid'=>'0','order'=>'DESC','num'=>'10',));}?>
  <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
  <div class="ban_c album"><a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"><img src="<?php echo $v['pic'];?>" alt="<?php echo $v['title'];?>" /></a> </div>
  <?php } ?>
  <?php if(isset($data))unset($data);?> </div>
<div class="wrap bann_ext">
  <ul class="l frontCover">
  </ul>
  <div class="l bann_ext_bord">
    <div class="fix">
      <h2>热门新闻</h2>
      <div class="l newsUp index_gg">
        <div class="l key"> <a class="btn pre_" title="上一条"></a> <a class="btn nex_" title="下一条"></a> </div>
        <ul class="mybdshare">
          <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("content_tag");if (method_exists($CI->content_tag, '_arclist')) {$data = $CI->content_tag->_arclist(array('order'=>'desc','modelid'=>'2','num'=>'10',));}?>
          <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
          <li><a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a><span><?php echo time_tran($v['publishtime']);?></span></li>
          <?php } ?>
          <?php if(isset($data))unset($data);?>
        </ul>
      </div>
    </div>
    <div class="bann_ext_list"> </div>
  </div>
</div>
</div>
<div class="wrap fix i_box_wrap mt10">
  <div class="i_box2">
    <h2 class="Tit1"><a href="<?php echo cate('5','url');?>"  title="新闻中心">新闻中心</a></h2>
    <div class="i_box2_spe"> <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("content_tag");if (method_exists($CI->content_tag, '_arclist')) {$data = $CI->content_tag->_arclist(array('order'=>'desc','modelid'=>'2','limit'=>'0','num'=>'4',));}?>
      <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
      <li><a href="<?php echo $v['url'];?>" target="_blank"><?php echo $v['title'];?></a></li>
      <?php } ?>
      <?php if(isset($data))unset($data);?> </div>
    <ul class="i_box2_news">
      <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("content_tag");if (method_exists($CI->content_tag, '_arclist')) {$data = $CI->content_tag->_arclist(array('order'=>'desc','modelid'=>'2','limit'=>'4','num'=>'6',));}?>
      <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
      <li><a href="<?php echo $v['url'];?>" target="_blank"><?php echo $v['title'];?></a></li>
      <?php } ?>
      <?php if(isset($data))unset($data);?>
    </ul>
  </div>
  <div class="i_box4">
    <h2 class="Tit1"><a href="<?php echo cate('1','url');?>"  title="视频中心"><?php echo cate('1','name');?></a></h2>
    <div class="fix"> <?php echo get_str(cate('1','content'),320);?> </div>
  </div>
  <div class="i_box3">
    <h2 class="Tit1"><a href="#"  title="服务与配件">服务与配件</a></h2>
    <div class="slide i_box3_slide" data-slide='{"auto":false}'> <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("module_tag");if (method_exists($CI->module_tag, '_slide')) {$data = $CI->module_tag->_slide(array('cid'=>'1','order'=>'DESC','num'=>'10',));}?>
      <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
      <div class="ban_c"> <a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['title'];?>"><img src="<?php echo $v['pic'];?>" alt="<?php echo $v['title'];?>" /></a></div>
      <?php } ?>
      <?php if(isset($data))unset($data);?> </div>
    <div class="i_box3_form mt10"> <span>客户服务部专线：</span><br>
      电话：<?php echo C('webtel');?> 传真：<?php echo C('webfax');?> <br>
      <span>营销部专线：</span><br>
      <?php echo C('webphone');?><br>
      地址:<?php echo C('webaddress');?> <br>
    </div>
  </div>
</div>
<div class="wrap mt20">
  <h2 class="Tit1">产品推荐</h2>
  <div class="blk_18"> <a class="RightBotton" hidefocus="true" onmousedown="ISL_GoDown_1()" onmouseup="ISL_StopDown_1()" onmouseout="ISL_StopDown_1()" href="javascript:void(0);" target="_self"></a>
    <div class="pcont" id="ISL_Cont_1">
      <div class="ScrCont">
        <div id="List1_1"> <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("content_tag");if (method_exists($CI->content_tag, '_arclist')) {$data = $CI->content_tag->_arclist(array('litpic'=>'true','modelid'=>'3','order'=>'desc','limit'=>'0','num'=>'10',));}?>  
          <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
          <div class="pl">
            <div><a href="<?php echo $v['url'];?>" ><img src="<?php echo $v['litpic'];?>" width="220" height="134" /></a> <a href="<?php echo $v['url'];?>"  ><span><?php echo $v['title'];?></span></a></div>
          </div>
          <?php } ?>
          <?php if(isset($data))unset($data);?> </div>
        <div id="List2_1"></div>
      </div>
    </div>
    <a class="LeftBotton" hidefocus="true" onmousedown="ISL_GoUp_1()" onmouseup="ISL_StopUp_1()" onmouseout="ISL_StopUp_1()" href="javascript:void(0);" target="_self"></a> </div>
  <script type="text/javascript">
        picrun_ini()
        </script>
</div>
</div>
<div style="clear:both"> </div>
<div id="link"  style="width:1000px; margin-right:auto; margin-left:auto;">
  <h3>友情链接</h3>
  <br />
  <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("module_tag");if (method_exists($CI->module_tag, '_link')) {$data = $CI->module_tag->_link(array('order'=>'DESC','num'=>'10',));}?>
  <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
  <!--img src="<?php echo $v['pic'];?>"-->
  <a href="<?php echo $v['url'];?>" target="_blank" class="l4"> <?php echo $v['title'];?></a> <?php } ?>
  <?php if(isset($data))unset($data);?> </div>
<?php include $this->mytpl_class->view('foot.html',true); ?>
<div style="display:none;"> </div>
</body>
</html>
