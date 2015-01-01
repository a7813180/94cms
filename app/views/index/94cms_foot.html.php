<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><div class="pro_selector">
  <div class="wrap fix">
    <div class="l sec_1">
      <form action="<?php echo site_url().'/search';?>" method="get">
        <input type="hidden"  name="type" value="2" />
        <label for="s2" class="t"><b>站内信息搜索</b></label>
        <div class="fix bor1 bwhite">
          <div class="l sele i_f_s_item" data-click="true"> <span>全部</span>
            <div class="sele_"> <a href="javascript:void(0)" onclick="setFootOtherName('footsearchflag','')">全部</a> <a href="javascript:void(0)" onclick="setFootOtherName('footsearchflag','2')">新闻</a> <a href="javascript:void(0)" onclick="setFootOtherName('footsearchflag','1')">产品</a> <a href="javascript:void(0)" onclick="setFootOtherName('footsearchflag','6')">招聘</a> <a href="javascript:void(0)" onclick="setFootOtherName('footsearchflag','3')">其他</a> </div>
          </div>
          <input name="q" type="text" id="footkey" class="l inp" placeholder="大家正在搜：博泽国际化" value="大家正在搜：博泽国际化" onfocus="this.value=''" />
          <input type="button" class="l btn" id="foottosearch" />
        </div>
      </form>
    </div>
    <div class="l sec_2"> <a href="http://weibo.com/" target="_blank" class="l"><span class="ico ico1_4"></span>官方微博</a>
      <div class="footshare">
        <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare"><span class="bds_more">分享：</span><a class="bds_qzone" title="分享到QQ空间" href="#"></a><a class="bds_tsina" title="分享到新浪微博" href="#"></a><a class="bds_tqq" title="分享到腾讯微博" href="#"></a><a class="bds_renren" title="分享到人人网" href="#"></a><a class="bds_t163" title="分享到网易微博" href="#"></a></div>
        <a onclick="share2wx()" class="l share2wx hidetext" title="分享到微信朋友圈">微信</a> </div>
    </div>
    <div class="r sec_3 i_erweima"> <img src="<?php echo base_url('template/'.C('template')).'/'; ?>images/temp/soci_07.png" /> 手机站二维码 </div>
  </div>
</div>

<div class="foot">
  <div class="wrap foot_c">
    <div class="oh foot_menu_wrap"> <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("content_tag");if (method_exists($CI->content_tag, '_cate')) {$data = $CI->content_tag->_cate(array('order'=>'asc','cid'=>'0','num'=>'10',));}?>
      <?php  if(is_array($data)) foreach($data AS $key => $v) { ?>
      <dl class="l foot_menu">
        <dt><a href="<?php echo $v['url'];?>" target="_blank" title="<?php echo $v['name'];?>"><em class="f_ico_1"></em><?php echo $v['name'];?></a></dt>
        <?php $n=1;if(is_array($v['x'])) foreach($v['x'] AS $v2) { ?>
        <dd><a href="<?php echo $v2['url'];?>" target="_blank" title="<?php echo $v2['name'];?>"><?php echo $v2['name'];?></a></dd>
        <?php } ?>
      </dl>
      <?php } ?>
      <?php if(isset($data))unset($data);?> </div>
  </div>
  <div class="foot_last">
    <div class="wrap">
   
      <div class="foot_last_c"> <?php echo C('webcop');?> <a target="_blank" href="http://www.miibeian.gov.cn/" rel="nofollow"><?php echo C('webbeian');?></a> 
	  

</div>
    </div>
  </div>
</div>
<!-- Baidu Button BEGIN -->
<script type="text/javascript" id="bdshare_js" data="type=tools&uid=652327" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->
<script src="<?php echo base_url('template/'.C('template')).'/'; ?>js/comm.js"></script>
<script type="text/javascript">
setTopSelect(112);
$('.iv_list').scroll_v({line:1,up:'iv_up',down:'iv_down'}); 
</script>
<div class="sideFloat ie6Fix sideFloat_new"> <?php if(!isset($CI))$CI =& get_instance();$CI->load->library("content_tag");if (method_exists($CI->content_tag, '_cate')) {$data = $CI->content_tag->_cate(array('order'=>'asc','cid'=>'10','num'=>'10',));}?>
  <?php  if(is_array($data)) foreach($data AS $key => $v) { ?> <a href="<?php echo $v['url'];?>" target="_blank" class="dc">
  <p><?php echo $v['name'];?></p>
  </a> <?php } ?>
  <?php if(isset($data))unset($data);?>
  <div class="gotop">
    <p>回到顶部</p>
  </div>
</div>
