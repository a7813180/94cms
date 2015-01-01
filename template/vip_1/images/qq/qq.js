var QQ1="770760008";
var QQ2="770760008";
var QQ3="770760008";
var LXDH="400-033-5671";
var MS="全国24小时热线电话";

document.write("<div class='QQbox' id='divQQbox' >");
document.write("<div class='Qlist' id='divOnline' onmouseout='hideMsgBox(event);' style='display : none;z-index:9999;'>");
document.write("<div class='t'></div>");

document.write("<div class='con'>");
document.write("<ul>");

document.write("<li class=odd><a href=' http://wpa.qq.com/msgrd?v=3&uin="+QQ1+"&site=qq&menu=yes' target='_blank'><img src='/templets/default/images/qq/11.png'  align='absmiddle' border=0>售前客服</a></li>");
document.write("<li class=odd><a href=' http://wpa.qq.com/msgrd?v=3&uin="+QQ2+"&site=qq&menu=yes' target='_blank'><img src='/templets/default/images/qq/11.png'  align='absmiddle' border=0>售后技术</a></li>");
document.write("<li class=odd><a href=' http://wpa.qq.com/msgrd?v=3&uin="+QQ3+"&site=qq&menu=yes' target='_blank'><img src='/templets/default/images/qq/11.png'  align='absmiddle' border=0>投诉建议</a></li>");

document.write("</ul>");
document.write("</div>");

document.write("<div class='infobox_ms'>"+MS+"</div>");
document.write("<div class='infobox_dh'>"+LXDH+"</div>");

document.write("<div class='b'></div>");

document.write("</div>");
document.write("<div id='divMenu' onmouseover='OnlineOver();'><img src='/templets/default/images/qq/qq_1.png' id='press' alt='在线咨询'></div>");
document.write("</div>");


var tips; var theTop = 140; 
var old = theTop;
function initFloatTips() {
tips = document.getElementById('divQQbox');
moveTips();
};
function moveTips() {
var tt=50;
if (window.innerHeight) {
pos = window.pageYOffset
}
else if (document.documentElement && document.documentElement.scrollTop) {
pos = document.documentElement.scrollTop
}
else if (document.body) {
pos = document.body.scrollTop;
}
pos=pos-tips.offsetTop+theTop;
pos=tips.offsetTop+pos/10;
if (pos < theTop) pos = theTop;
if (pos != old) {
tips.style.top = pos+"px";
tt=10;
//alert(tips.style.top);
}
old = pos;
setTimeout(moveTips,tt);
}

initFloatTips();



function OnlineOver(){

document.getElementById("divMenu").style.display = "none";
document.getElementById("divOnline").style.display = "block";
document.getElementById("divQQbox").style.width = "150px";

}
function OnlineOut(){
document.getElementById("divMenu").style.display = "block";
document.getElementById("divOnline").style.display = "none";
}
if(typeof(HTMLElement)!="undefined")    //给firefox定义contains()方法，ie下不起作用
{   
      HTMLElement.prototype.contains=function(obj)   
      {   
          while(obj!=null&&typeof(obj.tagName)!="undefind"){ //通过循环对比来判断是不是obj的父元素
   　　　　if(obj==this) return true;   
   　　　　obj=obj.parentNode;
   　　}   
          return false;   
      };   
}  




function hideMsgBox(theEvent){ //theEvent用来传入事件，Firefox的方式

　 if (theEvent){
　   var browser=navigator.userAgent; //取得浏览器属性
     
	　 if (browser.indexOf("Firefox")>0){ //如果是Firefox
	　　 if (document.getElementById('divOnline').contains(theEvent.relatedTarget)) { //如果是子元素

	     return; //结束函式
	     } 
	   }else if (browser.indexOf("MSIE")>0){ //如果是IE
				if (document.getElementById('divOnline').contains(event.toElement)) { //如果是子元素
				return; //结束函式
				}
		 }else{ //其他
				if (document.getElementById('divOnline').contains(theEvent.relatedTarget)) { //如果是子元素
				return; //结束函式
				}
		 }
   }
   
/*要执行的操作*/

document.getElementById("divOnline").style.display = "none";
document.getElementById("divMenu").style.display = "block";


}
