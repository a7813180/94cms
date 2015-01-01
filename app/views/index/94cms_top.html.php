<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><div class="head pr"> <s class="pa shadow"></s>
  <div class="wrap fix">
    <div class="tr head_top">
      <div class="dib head_f">
        <form action="<?php echo site_url().'/search';?>" method="get">
          <input type="text" class="inp" name="q" id="s" style="padding-left:2px;" value="站内搜索"/>
          <input type="button" name="toptosearch" id="toptosearch" value=" " title="搜索" class="btn" />
          <input type="hidden"  name="type" value="2" />
          <script type="text/javascript">
		  $("#toptosearch").click(function(){$("#searchform").submit();});
		  $("#s").focus(function(){if($.trim($("#s").val())=='站内搜索'){$("#s").val("");}});
		  $("#s").blur(function(){if($.trim($("#s").val())==''){$("#s").val("站内搜索");}});
		  </script>
        </form>
      </div>
    </div>
    <h1 class="l logo"><a href="<?php echo base_url();?>" title="<?php echo C('webname');?>"><img src="<?php echo base_url(C('weblogo'));?>" alt="<?php echo C('webname');?>" /></a></h1>
    <div class="r nav pr">
      <ul>
	    <li class="li" id="top100"><a href="<?php echo base_url();?>"  class="nav_cell" title=" ">首页</a> </li>
	  
        <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("content_tag");if (method_exists($CI->content_tag, '_cate')) {$data = $CI->content_tag->_cate(array('order'=>'asc','cid'=>'0','num'=>'10',));}?>
        <?php  if(is_array($data)) foreach($data AS $key => $v) { ?>
        <li class="li" id="top10<?php echo $key+1?>"><a href="<?php echo $v['url'];?>"  class="nav_cell" title="<?php echo $v['name'];?>"><?php echo $v['name'];?></a> <?php if(!empty($v['x'])) { ?>
          <div class="nav_lev2 nav_lev2_6 navtoplev1"> <s class="pa shadow"></s>
            <div class="l percent30 nav_menu">
              <ul class="p20">
                <?php $n=1;if(is_array($v['x'])) foreach($v['x'] AS $v2) { ?>
                <li><a href="<?php echo $v2['url'];?>" title="<?php echo $v2['name'];?>"><?php echo $v2['name'];?></a></li>
                <?php } ?>
              </ul>
            </div>
            <div class="l percent70">
              <div class="cont">
                <div class="picshow"><a href="javascript:;" title="<?php echo $v['name'];?>"><img src="<?php echo $v['litpic'];?>" alt="<?php echo $v['name'];?>"/></a> </div>
                <div class="t"><a href="javascript:;" title="<?php echo $v['name'];?>"><?php echo $v['name'];?></a></div>
 
              </div>
            </div>
          </div>
          <?php } ?> </li>
        <?php } ?>
        <?php if(isset($data))unset($data);?>
      </ul>
      <div class="pa nav_block">
        <div class="pa nav_line"></div>
      </div>
    </div>
  </div>
  <div class="pa head_block">
    <div class="pa head_line"></div>
  </div>
</div>
