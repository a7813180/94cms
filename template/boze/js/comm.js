var ie6 = !-[1,] && !window.XMLHttpRequest; 

var userAgent = navigator.userAgent.toLowerCase();

var browser = {

	ie8: /msie 8/.test(userAgent),

	ie7: /msie 7/.test(userAgent)

};

//返回顶部

$('body').on('click','.gotop',function(){$('html,body').stop().animate({scrollTop:'0'},300)});

/*

自定义滚动条

opts.wrap:		指定内容包裹元素,jQuery格式,默认不指定，将新增 .scroll_c ;

opts.monitor:  设置是否监听被动滚动（用于多插件协作）,布尔值,默认false ;

opts.keyway:	上下按钮滚动键程,数值,默认30 ;

*/

$.fn.scrollBar=function(opts){

	var this_=$(this),sC,sB,sU,sD,sS,sW,sAH,sAW,sSH,sSW,prop,keyway,ssTop=0,drive=false;

	if(opts.wrap){

		sC=$(''+opts.wrap)

		}else{

			this_.wrapInner("<div class='scroll_c'></div>");

			sC=this_.children('.scroll_c');

			};

	this_.append("<div class='scroll_bar' unselectable='on'><div class='scroll_up'><!----></div><div class='scroll_slider' unselectable='on'><!----></div><div class='scroll_down' style='position:absolute;bottom:0;left:0;overflow:hidden'><!----></div></div>");

	sB=this_.children('.scroll_bar');

	sU=sB.children('.scroll_up');

	sD=sB.children('.scroll_down');

	sS=sB.children('.scroll_slider');

	sW=!!sB.width()?!!sB.width() : 10;	//滚动条宽度

	sAH=!!sU.height()?sU.height():16;	//按钮高度

	sAW=!!sU.width()?sU.width():'100%';	//按钮宽度

	sSH=!!sS.height()?sS.height():30;	//滑块高度

	sSW=!!sS.width()?sS.width():'100%';	//滑块宽度

	keyway=opts.keyway || 30; 				//按钮键程

	prop=(sC.height()-this_.height())/(this_.height()-sAH*2-sSH);	//滑动比率

	if(sC.height()<this_.height()) {sB.remove();return false;};

	sB.width(sW);

	sC.css('padding_right',sW);

	sU.height(sAH).width(sAW);

	sD.height(sAH).width(sAW);

	sS.height(sSH).width(sSW);

	if(opts.monitor) passive(sC);

	setTop();

	sS.bind('mousedown',function(e){

		var pageY = e.pageY,

			 topCur=parseFloat($(this).css('top')),

			 Move;

		$(this).addClass('scroll_slider_on');

		drive=true;

		$(document).mousemove(function(e2){

			Move = e2.pageY - pageY;

			ssTop=topCur+Move;

			setTop();

			});

		$(document).mouseup(function(){

			$(this).unbind();

			drive=false;

			sS.removeClass('scroll_slider_on');

			});

		});

	sU.bind({

		'mousedown':function(){

			$(this).addClass('scroll_up_on');

			},

		'mouseup':function(){

		var _scTop=parseFloat(sC.css('top'))+keyway;

		sC.css('top',_scTop>0 ? 0 : _scTop);

		$(this).removeClass('scroll_up_on');

		}

		});

	sD.bind({

		'mousedown':function(){

			$(this).addClass('scroll_down_on');

			},

		'mouseup':function(){

		var _scTop=parseFloat(sC.css('top'))-keyway;

		sC.css('top',_scTop < this_.height()-sC.height() ? this_.height()-sC.height() : _scTop);

		$(this).removeClass('scroll_down_on');

		}

		});

	function setTop(){	

		if(ssTop<sAH){

			ssTop=sAH

			}else if(ssTop>this_.height()-sAH-sSH){

				ssTop=this_.height()-sAH-sSH

				};

		sS.css({top:ssTop});

		if(drive) sC.css({top:-((ssTop-sAH)*prop)});

		};

	function passive(sC){

		var scTop,_ssTop;

		setInterval(function(event){

			_ssTop=parseFloat(sC.css('top'));

			if(!drive && (scTop != _ssTop)){

				sS.css({top:sAH-_ssTop/prop});

				scTop = _ssTop;

				}

			},16);

		};

	};

//Slide func

$.fn.slide=function(){

var defaults,opts,data_opts,$this,$b_,t,n=0,count,$nav,$p,$n,DelayObj,Delay=false;

	defaults={

		fade:true,

		auto:true,

		time:4000,

		action:'mouseover',

		fn:null

		};

	$this=$(this);

	data_opts=$this.data('slide')||{};

	opts=$.extend({},defaults,data_opts);

	$b_=$this.children('.ban_c');

	count=$b_.length;

	if($this.find('.ban_nav').length){$nav=$this.find('.ban_nav')}else{

			$nav=$('<div class="ban_nav"></div>');

			for(i=0;i<count;i++){$nav.append('<a>'+(i+1)+'</a>')};

			$this.append($nav)

			};

	$this.append('<a class="Left" onselectstart="return false;"></a><a class="Right" onselectstart="return false;"></a>');

	$nav.children('a').eq(0).addClass('on');

	$nav.children('a').eq(1).addClass('ban_next');

	$nav.children('a').eq(count-1).addClass('ban_prev');

	$b_.hide().eq(0).show();

	if(ie6){$b_.height($b_.attr('height') || $this.height())};

	$nav.children('a').each(function(index) {

		$(this).on(opts.action,function(event) {

			event.preventDefault();

			event.stopPropagation();

			if (index >= count){return false}else{

					$nav.children('a').eq(index-1).addClass('ban_prev').siblings().removeClass('ban_prev');

					$nav.children('a').eq(index==count-1 ? 0 : index+1).addClass('ban_next').siblings().removeClass('ban_next')

					};

			if(opts.fade){$b_.stop(1,1).fadeOut(200).eq(index).stop(1,1).fadeIn(500)}else{$b_.hide().eq(index).show()};

			$(this).addClass('on').siblings().removeClass("on");

			n=index

		})

	});

	$p=$(this).find('.Left');

	$n=$(this).find('.Right');

	if(opts.auto){

		t = setInterval(function(){showAuto()}, opts.time);

		$this.mouseenter(function(){

			clearInterval(t);

			}).mouseleave(function(){

				t=setInterval(function(){showAuto()},opts.time);

				})

		};

	$p.click(function(){showPre()});

	$n.click(function(){showAuto()});

	function showAuto(){n=n>=(count - 1) ? 0 : ++n;$nav.find('a').eq(n).trigger(opts.action);};

	function showPre(){n=n<=0 ? (count - 1) : --n;$nav.find('a').eq(n).trigger(opts.action)};

	if(opts.fn){eval(opts.fn+"(opts,$b_,$nav)")}

};

$('.slide').each(function() {$(this).slide()});

//领导关怀

function ldgh_ext(opts,$b,$nav){

	var step,navPrev,navNext,$count=$nav.children('a').length;

	$nav.children('a').each(function(index) {

      $(this).click(function(){

			step=(index-3)>=0 ? index<$count-4 ? (index-3) : $count-8 : 0;	

			$nav.stop(1,0).animate({top:-step*40},300);

			})

   	});

	$('.nav_wrap').scrollBar({wrap:'.ban_nav',monitor:true});

	};

//关闭标签页     

function CloseWin(){window.opener=null;window.open("","_self");window.close()};

//字号调节

var $speech=$('.myart'),defaultsize=$speech.css('font-size');

$('#switcher a').click(function(){

	var num=parseFloat($speech.css('font-size'),10)

	switch(this.id){

		case 'small':

		num/=1.4;

		break;

		case 'big':

		num*=1.4;

		break;

		default:

		num=parseFloat(defaultsize,10)

		}

		$speech.css('font-size',num+'px')

	});

//下拉

$.fn.sele=function() {

	var ev=$(this).data('click')?'click':'mouseenter';

	$(this).bind(ev,function(){sele_show(this,ev)}).bind('mouseleave',function(){sele_hide(this)});

	function sele_show(me,evt){

		$(me).children('span').addClass('on').end().find('.sele_').stop(1,1).slideDown(200).children('a').click(function(event){

			event.stopPropagation();

			if(!$(this).attr('target')){

				event.preventDefault();

				if($(me).find('.btn').length){

					$(me).find('.btn').attr('href',$(this).attr('href')).click(function(event){event.stopPropagation()});

				};

				$(this).parent().hide().parents('.sele').children('span').text($(this).text());

			}

		})

	};

	function sele_hide(me){

		$(me).children('span').removeClass('on').end().find('.sele_').stop(1,0).slideUp(200)

	};

};

var $sele=$('.sele');

$sele.each(function(i) {$(this).css('z-index',$sele.length-i).sele()});

//搜索框

$('#s').focus(function(){

	if($(this).val()==''){

		$(this).parent('form').attr('class','focous');

		$(this).on('input',function(){

			$(this).parent('form').addClass('input')

		})

	}

	}).blur(function(){

		$(this).parent('form').removeClass('focous');

		if($(this).val()==''){

			$(this).parent('form').removeAttr('class')

			}

		});

	//for ie

if(document.all){

	  var $s=document.getElementById('s');

	  if($s.attachEvent) {

			$s.attachEvent('onpropertychange',function(e) {

				 if(e.propertyName!='value') return;

				 $($s).trigger('input');

			});

	  }

};

//导航

var $nav=$('.nav').find('.li'),

	 $navCur=$('.nav').find('.cur').length?$('.nav').find('.cur').index():0,

	 $navLine=$('.nav_line');

$navLine.css('left',$navCur*$nav.eq(0).width());

$nav.mouseenter(function(){

	$(this).addClass('hover');

	$navLine.stop(1,0).animate({left:$(this).index()*$nav.eq(0).width()},200)

	}).mouseleave(function(){

		$(this).removeClass('hover');

		$navLine.stop(1,0).animate({left:($('.nav').find('.cur').length?$('.nav').find('.cur').index():0)*$nav.eq(0).width()},200)

		});

//banner专辑封面

function banner_ext(opts,$b_,$nav){

	var album=$b_.filter(function(){return $(this).hasClass('album')}),

		 newslink=$('.banner').find('.link');

		 newslink.eq(0).show();

	if(browser.ie8) opts.fade=false;

	$b_.each(function(i){

		$(this).data('index',i)

		});

	album.each(function(i){

		$('.frontCover').append('<li index="'+($(this).data('index'))+'"><div class="img">'+$(this).find('a').eq(0).html()+'</div><p>'+$(this).find('img').eq(0).attr('alt')+'</p></li>')

		});

	$nav.children('a').each(function(index) {

      $(this).click(function(){

			$('.frontCover').children('li').filter(function() {

				return $(this).attr('index')==index

			}).addClass('open').siblings().removeClass('open');

			newslink.eq($('.frontCover').find('.open').index()).show().siblings('.link').hide();

		})

   });

	$('.frontCover').children('li').click(function(){

		$nav.children('a').eq($(this).attr('index')).trigger('click')

		});

	$('.frontCover').children('li').eq(0).addClass('open').end().eq(-1).css('margin',0)

	};

//单行上下

$.fn.newsUp=function(){

	var $this=$(this)

		,$news=$this.find('ul')

		,$num=$news.find('li').length

		,$hei=$this.height()

		,$pre=$this.find('.pre_')

		,$nex=$this.find('.nex_')

		,$i=0;

	$nex.click(function(){$i<$num-1 ? $i++ : $i=0;ani($i)});

	$pre.click(function(){$i>0 ? $i-- : $i=$num-1;ani($i)});

	function ani($i){$news.animate({top:-$hei*$i+'px'},400)};

	setInterval(function(){$nex.click()},4000)

};

$('.newsUp').each(function() {$(this).newsUp()});

//图片悬停

$('.imghover').mouseenter(function(){

	$(this).find('img').animate({opacity:.7},200)

	}).mouseleave(function(){

		$(this).find('img').animate({opacity:1},200)

		});

//选项卡

$.fn.tab=function(){

	var $key=$(this).find('.key'),

		 $cont=$(this).find('.tab_c');

		 $key.eq(0).addClass('on');

		 $cont.hide().eq(0).show();

		 $key.hover(function(){

			 $(this).addClass('on').siblings().removeClass('on');

			 $cont.hide().eq($(this).index()).show();

			 })

	};

$('.tab').each(function() {$(this).tab()});

//翻页

$.fn.roll=function(){

	var $keylist=$(this).find('a'),

		 $View=$(this).parent().next('.view'),

		 $SildeWidth=$View.width(),

		 allpage=$View.find('.gallery_cell').length,

		 nowpage=0,

		 $now,

		 $all,

		 $haspage=$(this).parent().find('.now').length && $(this).parent().find('.all').length;

	if($haspage){$now=$(this).parent().find('.now');$all=$(this).parent().find('.all');$now.text(nowpage+1);$all.text(allpage)};

	$View.find('.gallery').width($SildeWidth*allpage);

	$View.find('.gallery_cell').width($SildeWidth);

	if($keylist.parent().children('.left').length && $keylist.parent().children('.right').length){

		$keylist.click(function(event){

			event.preventDefault();

			if($(this).hasClass('right')){

				nowpage = nowpage >=(allpage - 1) ? 0 : ++nowpage;roll1(nowpage);if($haspage){$now.text(nowpage+1)}

			}else if($(this).hasClass('left')){

				nowpage = nowpage <=0 ? (allpage - 1) : --nowpage;roll1(nowpage);if($haspage){$now.text(nowpage+1)}

			}

			function roll1(nowpage){$View.children('.gallery').stop(1,0).animate({marginLeft:-$SildeWidth*nowpage+'px'},400)}

			})

		}else{

		   var keycur=0,autotimer=setInterval(function(){keycur = keycur < allpage-1 ? keycur+1 : 0;roll2(keycur)},4000);

			$keylist.eq(0).addClass('cur');

			$View.hover(function(){clearInterval(autotimer)},function(){autotimer=setInterval(function(){keycur = keycur < allpage-1 ? keycur+1 : 0;roll2(keycur)},4000)})

			$keylist.each(function(index) {

            $(this).mouseenter(function(){keycur=index;roll2(keycur)})

         });

			function roll2(keycur){$keylist.eq(keycur).addClass('cur').siblings().removeClass('cur');$View.children('.gallery').stop(1,0).animate({marginLeft:-$SildeWidth*keycur+'px'},400)}

			}

	};

$('.roll').each(function() {$(this).roll()});

//侧边导航

$('.side_menu').children('dd').click(function(event){

	if($(this).find('ul').length){

		$(this).toggleClass('open');

		}

	});

//服务检索

$('.serv_select').children('li').click(function(){$(this).toggleClass('on')});

//排序按钮

$('.seque').children('span').click(function(){$(this).addClass('red').siblings().removeClass('red')});

//加入收藏

function favorite() {var sURL = "http://"+document.domain+"/",sTitle = document.title;try{window.external.addFavorite(sURL, sTitle)} catch (e){try{window.sidebar.addPanel(sTitle, sURL, "")}catch (e){alert("加入收藏失败，请使用Ctrl+D进行添加")}}};

//横向滚动

$.fn.scrollsmooth=function(n,auto,time){

	$(this).before($('<a href="#" class="s_prev"></a>')).after('<a href="#" class="s_next"></a>');

	var $this=$(this),

		 $i=0,

		 $list=$this.find('li'),

		 $n=$list.length,

		 $max=Math.floor($this.width()/$list.outerWidth(true)),

		 $shown=n>$max?$max:n,

		 $margin_lr=Math.floor(($this.width()-$list.eq(0).outerWidth(true)*$shown)/$shown/2),

		 $aWid=$list.eq(0).outerWidth(true)+$margin_lr*2,

		 $T_pre=$this.prev('.s_prev'),

		 $T_nex=$this.next('.s_next'),

		 $timer;

	$list.css({'margin-left':$margin_lr,'margin-right':$margin_lr});

	if(auto){

		$timer=setInterval(function(){$T_nex.click()}, time);

		$this.hover(function(){clearInterval($timer)},function(){$timer=setInterval(function(){$T_nex.click()}, time)})

	}

	$T_nex.click(function(event){event.preventDefault();$i=$i<$n-$shown && $n>=$shown ? $i+1 : 0;ani()})

	$T_pre.click(function(event){event.preventDefault();$i=$i>0 ? $i-1 : $n-$shown;ani()})

	function ani(){$this.children('.gallery').stop().animate({marginLeft:-$aWid*$i},'fast')}

};

//纵向滚动

$.fn.scroll_v=function(opt,callback){

	 if(!opt) var opt={};

	 var _btnUp = $("#"+ opt.up),

	 	 _btnDown = $("#"+ opt.down),

	 	 timerID,

	 	 _this=this.eq(0).find("ul:first"),

	    lineH=_this.find("li").outerHeight(true), 

		 line=opt.line?parseInt(opt.line,10):parseInt(this.height()/lineH,10), 

		 speed=opt.speed?parseInt(opt.speed,10):500,

		 timer=opt.timer || 30000,

		 cols,lasted;

	 line=line?line:1;

	 var upHeight=0-line*lineH;

	 var scrollUp=function(){

		 	cols=Math.floor(_this.width()/_this.find("li").width());

			_btnUp.unbind("click",scrollUp);

			_this.animate({marginTop:upHeight},speed,function(){

					_this.find("li:lt("+cols+")").appendTo(_this);

					_this.css('marginTop',0);

					_btnUp.bind("click",scrollUp);

			})

	 };

	 var scrollDown=function(){

		 lasted=_this.find("li").length-Math.floor(_this.width()/_this.find("li").width())-1;

			_btnDown.unbind("click",scrollDown);

			for(i=1;i<=line;i++){_this.find("li:gt("+lasted+")").show().prependTo(_this)};

			_this.css({marginTop:upHeight});

			_this.animate({marginTop:0},speed,function(){

				_btnDown.bind("click",scrollDown)

			})

	 };

	 var autoPlay = function(){if(timer)timerID = window.setInterval(scrollUp,timer)};

	 var autoStop = function(){if(timer)window.clearInterval(timerID)};

	 _this.hover(autoStop,autoPlay).mouseout();

	 _btnUp.click( scrollUp ).hover(autoStop,autoPlay);

	 _btnDown.click( scrollDown ).hover(autoStop,autoPlay);

  };    

//下载图片列表

var $dl_img_list=$('.dl_img_list').find('.img');

$dl_img_list.find('.act').css('opacity',0);

$dl_img_list.mouseenter(function(){

	$(this).find('.act').stop(1,0).animate({opacity:1},200)

	}).mouseleave(function(){

		$(this).find('.act').stop(1,0).animate({opacity:0},300)

		});

//视频详细右侧滚动

$('.v_link_scroll').scroll_v({line:1,up:'v_link_up',down:'v_link_down'});

//登录注册表单

function setTopSelect(num){

	try{

		$("#top"+num).addClass("cur");

		$('.nav_line').css('left',($('.nav').find('.cur').length?$('.nav').find('.cur').index():0)*$('.nav').find('.li').eq(0).width());

	}catch(e){}	

};



//订购表单增删

var orederWrap=$('#order_wrap'),

	 sortOrder=function(){

		 orederWrap.find('.no').each(function(i) {$(this).text(i+1)});

		 },

	 addOrder=function(){

		 if(orederWrap.children('tr').length>=10) return;

		 orederWrap.append('<tr><td class="no"></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><a class="del">删除</a></td></tr>');

		 sortOrder();

		 };

orederWrap.on('click','.del',function(){

	 $(this).parents('tr').remove();

	 sortOrder();

	 if(!orederWrap.children('tr').length){

		 addOrder();

		 }

	 }

 );

 //顶部ico

$('.log,.glos,.mob').mouseenter(function(){

	$(this).addClass('hover')

	}).mouseleave(function(){

		$(this).removeClass('hover')

		});

$('.comp').mouseenter(function(){

	$(this).addClass('comp_hover')

	}).mouseleave(function(){

		$(this).removeClass('comp_hover')

		}).find('.sele_').prepend('<div class="comp_top_bor" />');

$('.mob').mouseenter(function(){

	$(this).addClass('mob_hover')

	}).mouseleave(function(){

		$(this).removeClass('mob_hover')

		}).find('.sele_').prepend('<div class="mob_top_bor" />');

$('.lang').mouseenter(function(){

	$(this).addClass('langHover')

	}).mouseleave(function(){

		$(this).removeClass('langHover')

		});

//色块变化 关于我们，

$('.cwp3').mouseenter(function(){

	$(this).addClass('block_hover')

	}).mouseleave(function(){

		$(this).removeClass('block_hover')

		});

//底部ico

if(ie6){

	$('.foot_menu').hover(function(){

		$(this).toggleClass('foot_menu_hover')

		})

	};

//关于我们右上品牌文化

$('.cates').find('h3').hover(function(){

	$(this).toggleClass('act')

	});

//新闻主页热点推荐

var newsHotTab=$('#myTab').children('li'),

	 newsHotNum=0,

	 newsHotCur;

setInterval(function(){

	newsHotNum=newsHotNum<(newsHotTab.length-1)?newsHotNum+1:0;

	newsHotTab.eq(newsHotNum).trigger('click')

	},4000);

$('#newsTabLeft').click(function(){

	newsHotCur=$('#myTab').children('.act').index();

	newsHotTab.eq(newsHotCur===0?newsHotTab.length-1:newsHotCur-1).trigger('click')

	});

$('#newsTabRight').click(function(){

	newsHotCur=$('#myTab').children('.act').index();

	newsHotTab.eq(newsHotCur===newsHotTab.length-1?0:newsHotCur+1).trigger('click')

	});

//ie6定位修复

$.fn.ie6Fix=function(){

	var $this=$(this),

		 posiTop=$this.css('top')!='auto' ? true : ($this.css('bottom')!='auto' ? false : null),

		 selfHei=$(this).outerHeight(true),

		 $H,	

		 posiVal=parseInt($this.css(posiTop ? 'top' : 'bottom'));

	if(posiTop!=null){

		$this.css('position','absolute');

		rePosi();

		$(window).resize(function(){rePosi();});

		$(window).scroll(function(){rePosi();});

		function rePosi(){

			$H=$(window).height();

			$this.css('top',posiTop ? $(window).scrollTop()+posiVal : $H-selfHei-posiVal+$(window).scrollTop());

			};

	}else{

		//console.warn('ie6Fix():对象缺少top或bottom属性')

		}

};

if(ie6){$('.ie6Fix').each(function() {$(this).ie6Fix()})};

//分享到微信

function share2wx(){

	$('body').append('<div id="wexin_wrap" style="background-clip: padding-box;background-color: #FFFFFF;border: 1px solid rgba(0, 0, 0, 0.3); border-radius: 6px 6px 6px 6px; box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3); left: 50%; margin: -200px 0 0 -200px;overflow: hidden; position: fixed;_position: absolute; top: 50%; width:360px;height:360px; overflow:hidden;"><div style="border-bottom: 1px solid #EEEEEE; padding: 9px 15px;"><a style="text-decoration:none; margin-top: 2px; color: #000000; float: right; font-size: 20px; font-weight: bold; cursor:pointer;line-height: 20px; opacity: 0.2; text-shadow: 0 1px 0 #FFFFFF;" id="weixin_close">×</a><h3 style=" line-height: 30px; margin: 0; font-weight:normal; font-family:" 微软雅黑";"="">分享到微信朋友圈</h3></div><div style="text-align:center;height:251px;"><p><img src="/webadmin/twoCodeImg?url='+window.location.href+'" alt="二维码加载失败" style="margin-top:15px;" width="220" ></p></div><div style=" background-color: #f5f5f5; border-radius: 0 0 6px 6px; border-top: 1px solid #dddddd; box-shadow: 0 1px 0 #ffffff inset; padding:0 10px;padding-top:11px;text-align: right; font-size:12px;"><div style="text-align:left;margin:0; padding:0;font-size:12px;">打开微信，点击底部的“发现”，使用 “扫一扫” 即可将网页分享到我的朋友圈。</div></div></div>');

	if(ie6) $('#wexin_wrap').ie6Fix();

	$('#weixin_close').click(function(){

		$('#wexin_wrap').remove()

		});

};

//三一 海外

if($('.gs_oversea').length){

	$('.gs_oversea').scrollsmooth(5,0);

	};

//媒体主页视频模块

var $NVItem=$('.n_v_item'),

	 $NVList=$('.n_v_list');

$NVList.eq(0).show();

$NVItem.children('li').click(function(){

	$(this).addClass('cur').siblings().removeClass('cur');

	$NVList.hide().eq($(this).index()).show();

	});

	

