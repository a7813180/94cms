//左侧菜单显示或者隐藏控制
function showmenu(id) {
//====close other menu======== 
	for(var i=0;i<20;i++) 
	{
		if(document.getElementById('leftMenu_'+i)==null) continue;
		if(i!=id) 
			document.getElementById('leftMenu_'+i).style.display='none';
	}
	if(document.getElementById('leftMenu_'+id).style.display=='block'){
		document.getElementById('leftMenu_'+id).style.display='none';
	}else{
		document.getElementById('leftMenu_'+id).style.display='block';
	}
}
//======lTrim()
function lTrim(str) 
 {  
 if(str!=null){
 if (str.charAt(0) == " ") 
   {
 str = str.slice(1);
 str = lTrim(str);
   } 
 }else{
str=""; 
 }
  return str; 
 }
  //====rTrim=======
function rTrim(str) 
{ 
if(str!=null){
var iLength; 
  
iLength = str.length; 
  
if(str.charAt(iLength - 1)==" ") 
{str = str.slice(0, iLength - 1);
 str = rTrim(str);
} 
}else{
str=""; 
}
return str; 
}
//=====trim()========
function trim(str) 
{
   return lTrim(rTrim(str)); 
}
//ajax 获取信息
function getAndSetInfoAjax(url,divid){
	$("#"+divid).load(url);
}
//清空表单的值
function clearForm(){
  //----表单内对象清空------
       for(var j=0;j<document.theform.elements.length;j++)
       {
         var curObj=document.theform.elements[j];
         if(curObj.type=='text'||curObj.type == "password"){
           curObj.value ="";
         }
       if(curObj.type=='select-one'){
          curObj.selectedIndex="0";
         }
       } 
}

//回车提交表单
function keydown(formname)
{
   if(window.event.keyCode==13)
	 {
	   document.formname.submit();
	 }
}
function nofind(errorImgUrl){ 
	var img=event.srcElement; 
	img.src=errorImgUrl; 
	img.onerror=null; //控制onerror事件只触发一次 
} 
