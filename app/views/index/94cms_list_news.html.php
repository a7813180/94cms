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
      <h2 class="Tit2"><?php echo $catename;?></h2>
      <div class="fix">
        <div class="l main_cont">
          <form id="theform" name="formsearch" method="post" action="http://demo40.dede58.com//plus/search.php">
            <div class="sear bor1">
              <div class="t">检索</div>
              <select name="searchtype" class="search-option" id="search-option">
                <option value="titlekeyword" selected='1'>智能模糊搜索</option>
                <option value="title">仅搜索标题</option>
              </select>
              <div class="dib sear_f vt">
                <input type="text" name="q" id="keywords" class="inp" value="关键词搜索"/>
                <input type="button" name="toptosearch" id="tosearch" class="btn" value=" " title="搜索" />
                <script type="text/javascript">
					 $("#tosearch").click(function(){$("#theform").submit();});
					 $("#keywords").focus(function(){if($.trim($("#keywords").val())=='关键词搜索'){$("#keywords").val("");}});
					 $("#keywords").blur(function(){if($.trim($("#keywords").val())==''){$("#keywords").val("关键词搜索");}});
					 </script>
              </div>
            </div>
            <div class="seque mt20"> </div>
            <ul class="news_list mt20">
              <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("content_tag");if (method_exists($CI->content_tag, '_list')) {$data = $CI->content_tag->_list(array('cid'=>$cid,'order'=>'desc','sort'=>'id','pagenum'=>$pagenum,'num'=>'7',));}$total = $CI->content_tag->_list(array('cid'=>$cid,'order'=>'desc','sort'=>'id','pagenum'=>$pagenum,'num'=>'7',),true);$page = $CI->content_tag->page($ename,$cid,$pagenum,$total,7,5);?>
              
              <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
              <li class="xwdt"><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>"><b class="t"><b><?php echo $v['title'];?>-<?php echo $v['id'];?></b> <em>发布时间：<?php echo date('Y-m-d H:i:s',$v['publishtime']);?>  发布于:<?php echo time_tran($v['publishtime']);?>  &nbsp;&nbsp;  浏览:<?php echo $v['click'];?>&nbsp;&nbsp; TAG:<?php echo $v['keywords'];?> </em></b></a>
                <p class="p"><?php echo get_str($v['description'],200);?> </p>
              </li>
              <?php } ?>
            </ul>
            <div class="page mt20"> <?php echo $page;?>
              <?php if(isset($data))unset($data);?> </div>
            <input name="offset" id="offset" type="hidden" value="0" />
            <input name="orderby" id="orderby" type="hidden" value="" />
          </form>
        </div>
        <div class="r sub">
          <div class="bor1 sub_block news_tag">
            <div class="t">热门标签</div>
            <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("content_tag");if (method_exists($CI->content_tag, '_tag')) {$data = $CI->content_tag->_tag(array('sort'=>'id','order'=>'desc','num'=>'30',));}?>
            <?php  if(is_array($data)) foreach($data AS $key => $v) { ?> <a href="<?php echo $v['url'];?>" target="_blank" style="margin-right:5px;" ><?php echo $v['title'];?></a> <?php } ?>
            <?php if(isset($data))unset($data);?> </div>
          <div class="bor1 sub_block">
            <div class="t">随机新闻</div>
            <ul class="sub_news">
              <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("content_tag");if (method_exists($CI->content_tag, '_arclist')) {$data = $CI->content_tag->_arclist(array('modelid'=>'2','cid'=>$cid,'sort'=>'id','order'=>'DESC','num'=>'10',));}?>
              <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
              <li><a href="<?php echo $v['url'];?>"><?php echo get_str($v['title'],20);?></a> <span><?php echo date('m-d',$v['publishtime']);?> </span> </li>
              <?php } ?>
              <?php if(isset($data))unset($data);?>
            </ul>
          </div>
          <div class="bor1 sub_block">
            <div class="t">热门新闻</div>
            <ul class="sub_news">
              <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("content_tag");if (method_exists($CI->content_tag, '_arclist')) {$data = $CI->content_tag->_arclist(array('modelid'=>'2','order'=>'desc','sort'=>'click','num'=>'10',));}?>
              <?php $n=1;if(is_array($data)) foreach($data AS $v) { ?>
              <li><a href="<?php echo $v['url'];?>"><?php echo get_str($v['title'],20);?></a> <span><?php echo date('m-d',$v['publishtime']);?> </span> </li>
              <?php } ?>
              <?php if(isset($data))unset($data);?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include $this->mytpl_class->view('foot.html',true); ?>
</body>
</html>
