/*!
 * Item Name : pp社区
 * Copyright 2012, 25pp.com
 *
 * Creator : X_Pilot(Inv)
 * Created Date : 2012.11.21
 */

var $id = function(id) { return document.getElementById(id); };
//var win = $(window), doc = $(document);

var ppZone = {};

//common
(function(ppZ) {
    var common = {
        //文本框输入文本则隐藏label
        fIpttext_hideLabel : function(iptTxt) {
			/*
            var t, i=0,
                lbl = iptTxt.parentNode.getElementsByTagName("span")[0];

            if(iptTxt.value != "") lbl.style.display = "none";
            iptTxt.onfocus = function() {
                t = setInterval(function() {
                    lbl.style.display = iptTxt.value == "" ? "inline-block" : "none";
                }, 80);
            }
            iptTxt.onblur = function() {
                clearInterval(t);
            }
			//修复IE聚焦问题
			if(lbl){
				lbl.onclick = function(){
					iptTxt.focus();
				}
			}
			*/
        },

        //设置鼠标经过样式
        setMouseHover : function(jqObj) {
			/*
            jqObj = !jqObj ? $(".setHover") : jqObj;
            jqObj.css("cursor", "pointer");
            jqObj.unbind("hover").hover(function() {
                if(/^setHover/.test(this.className)) {
                    this.className += " hover";
                } else {
                    this.className += " " + /\S+\s+setHover/.exec(this.className)[0].replace(/\s+setHover/, "") + "_hover";
                }
            }, function() {
                this.className = this.className.replace(/\s+\S+_hover/, "").replace(/\s*hover/, "");
            })
			*/
        },

		//提示框
		modalInit : function(modalName){
			var $modal = $(modalName);
			var $mask;
			$modal.hide();
			$modal.isShow = false;
			//显示
			$modal.toShow = function(){
				if(!$modal.isShow){
					$mask = common.createMask(0);
					_initPosition();
                    setTimeout(function(){
                        $modal.show();
                        $modal.isShow = true;
                    },1);

				}
			};
			//隐藏
			$modal.toHide = function(){
				if($modal.isShow){
					$modal.hide();
					$('.mask').remove();
					$modal.isShow = false;
				}
			};
			$('.close',$modal).click(function(){
				$modal.toHide();
			})
			//初始化位置
			function _initPosition(){
                if(typeof $mask != 'undefined'){
                    $mask.attr('style','position:absolute; left:0; top:0;background-color:#000;z-index:998;filter:alpha(opacity=0); opacity:0;');
                    $mask.width($(document).width());
                    $mask.height($(document).height());
                }
                var _width = $(window).width();
                var _height = $(window).height();

                var _scropTop = (/webkit/i.test(navigator.userAgent) ? document.body : document.documentElement).scrollTop;
                if(_width < 980){
                    _width = 980;
                }
                if(_height > 800){
                    _height = 800;
                }
                if(_scropTop > 350){
                    _scropTop = 350;
                }

				$modal.css('margin-left','0px');
				$modal.css('margin-top','0px');
				$modal.css('left',(_width -$modal.width()) / 2 + 'px');
                $modal.css('top',(_height -$modal.height()) / 2 + _scropTop + 'px');

				//if ($.browser.msie && ($.browser.version == "6.0") && !$.support.style) {$modal.css('position','absolute');} // 修复IE6不支持fixed的临时方法
            }
            window.onscroll = function(){
                _initPosition();
            }
            window.onresize = function(){
                _initPosition();
            }
			return $modal;
		},

		//创建遮罩层
		createMask : function(maskVal){
			var $mask = $('<div class="mask"></div>');
			$mask.attr('style','position:absolute; left:0; top:0;background-color:#000;z-index:998;filter:alpha(opacity='+maskVal * 10+'); opacity:'+maskVal / 10+';');
			$mask.width($(document).width());
			$mask.height($(document).height());
			$('body').append($mask);
			return $mask;
		}

    };
    ppZ.common = common;

    var regexp = {
        username : /^[a-zA-z0-9]{6,20}$/
    }
    ppZ.regexp = regexp;
})(ppZone);

$(function(){
    $('input[type=password]').each(function(){

        if(this.className.indexOf('alowPaste') == -1){
            this.oncontextmenu = function(){ return false;}
            this.oncopy = function(){ return false;}
            this.onpaste = function(){ return false;}
            this.oncut = function(){ return false;}
        }
    })
})