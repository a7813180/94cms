<?php
  if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 以下函数作用于字段添加/修改部分
 */

function my_form_input($setting = '') {
    return '
    <div style="width:10px;"></div>
    <li><label style="color: #FF0000;">长度</label>
    <input type="text"  class="dfinput"  style="width:150px" class="dfinput"  style="width:150px"value="' . (isset($setting['width']) ? $setting['width'] : '150') . '" name="setting[width]">
    <i style="color:#FF0000;">必填</i></li>
    <li><label style=" color: #FF0000;">默认值</label>
     <input type="text" class="dfinput"  style="width:150px" value="' . (isset($setting['default']) ? $setting['default'] : '') . '" name="setting[default]">
    <li>';
}


function my_form_textarea($setting = '') {
    return '
     <div style="width:10px;"></div>
     <li><label style=" color: #FF0000;">长度</label>
     <input type="text" style="width:150px" class="dfinput"  value="' .(isset($setting['width']) ? $setting['width'] : '400') . '" name="setting[width]">
    <i style=" color: #FF0000;">必填</i ></li>

     <li><label style=" color: #FF0000;">宽度</label>
     <input type="text" style="width:150px" class="dfinput"   value="' .(isset($setting['height']) ? $setting['height'] : '90') . '" name="setting[height]">
     <i style=" color: #FF0000;">必填</i></li>
     <li><label style=" color: #FF0000;">默认值</label>
     <input type="text" class="dfinput"  style="width:150px" value="' . (isset($setting['default']) ? $setting['default'] : '') . '" name="setting[default]">
     </li>';
}

function my_form_editor($setting = '') {
	$t = isset($setting['type']) && $setting['type'] ?  1 : (!isset($setting['type']) ? 1 : 0);
	$w = isset($setting['width'])  ? $setting['width']  : '795';
	$h = isset($setting['height']) ? $setting['height'] : '200';
    return '
    <div style="width:10px;"></div>
     <li><label style=" color: #FF0000;">长度</label>
     <input type="text"  style="width:150px" class="dfinput"  value="' . $w. '" name="setting[width]">
     <i style=" color: #FF0000;">必填</i ></li>
     <li><label style=" color: #FF0000;">宽度</label>
     <input type="text"  style="width:150px" class="dfinput"   value="' . $h . '" name="setting[height]">
     <i style=" color: #FF0000;">必填</i></li>
     <li><label style=" color: #FF0000;">默认值</label>
     <input type="text" class="dfinput"  style="width:150px" value="' . (isset($setting['default']) ? $setting['default'] : '') . '" name="setting[default]">
     </li>
     ';
}

function my_form_select($setting = '') {
    return '
     <div style="width:10px;"></div>
     <li><label style=" color: #FF0000;">选项列表</label>
     <textarea name="setting[content]" style="width:150px;height:100px;" class="dfinput" >' . (isset($setting['content']) ? $setting['content'] : '') . '</textarea>
     <i>格式：选项名称1|选项值1 (回车换行) </i>
     </li>
     <li><label >默认选中值</label>
     
     <input type="text" class="dfinput"  style="width:150px" value="' . (isset($setting['default']) ? $setting['default'] : '') . '" name="setting[default]">
     </li>';
}

function my_form_radio($setting = '') {
    return my_form_select($setting);
}

function my_form_checkbox($setting = '') {
    return my_form_select($setting);
}

function my_form_image($setting = '') {
    return '';
}

function my_form_file($setting = '') {
    return '';
}

function my_form_images($setting = '') {
     return ' <div style="width:10px;"></div>
    <li><label style=" color: #FF0000;">限制图片</label>
    <input type="text"  class="dfinput"  class="dfinput"  style="width:150px"value="' . (isset($setting['size']) ? $setting['size'] : '10') . '" name="setting[width]">
    <i style=" color: #FF0000;">必填</i></li>
    <li><label style=" color: #FF0000;">默认值</label>
     <input type="text" class="dfinput"  style="width:150px" value="' . (isset($setting['default']) ? $setting['default'] : '') . '" name="setting[default]">
    <li>';
}



/////////////////////////////////////////////////////////

//调用diy字段
function get_content_value($fieldtype,$field,$setting,$value=null) {
  $ss="content_".$fieldtype;
  $setting  = string2array($setting);

  echo $ss($field,$setting,$value);
 }


//编辑字段属性

function get_diy_updata($fieldtype,$setting=null){
    $ss="my_form_".$fieldtype;
    $setting  = string2array($setting);
    echo $ss($setting);
}




/**
 * 以下函数作用于发布内容部分
 */
 function content_input($field,$setting,$value=null) {

    $style    = isset($setting['width']) ? " style='width:" . ($setting['width'] ? $setting['width'] : 150) . "px;'": '';
    isset($value) ? $content=$value : $content = $setting['default'];
    return '<input type="text" value="' . $content . '" class="dfinput" name="' . $field .'"'. $style .'/>';
}

   //多行文本
function content_textarea($field,$setting,$value=null) {
    $style		= isset($setting['width']) && $setting['width'] ? 'width:' . $setting['width'] . 'px;' : '';	//宽度
    $style		.= isset($setting['height']) && $setting['height'] ? 'height:' . $setting['height'] . 'px;' : '';	//高度
    isset($value) ? $content=$value : $content = $setting['default'];
    return '<textarea class="dfinput" style="' . $style . '" name="'. $field . '"'. '>' . $content . '</textarea>';
}

 
//kindeditor编辑器函数
function content_editor($field,$setting,$value=null) {
    $w			= isset($setting['width']) && $setting['width'] ? $setting['width'] : '98';
    $h			= isset($setting['height']) && $setting['height'] ? $setting['height'] : '400';
    isset($value) ? $content=$value : $content = $setting['default'];
    $id			= $field;
    $str= "
		<script type=\"text/javascript\">KindEditor.ready(function(K) { 
			K.create('#fc_" . $id . "', { 
				allowFileManager : false,
				allowImageUpload : false,
				resizeType : 0 ,
        items : [
				     'source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright','justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', '|', 'selectall', '-','title', 'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline', 'strikethrough', 'removeformat', '|', 'image',  'flash', 'media', 'advtable', 'hr',  'link', 'unlink' 
				]
			});
		});
		</script>";
   $str .= '<textarea id="fc_' . $id . '" name="' . $field . '" style="width:' . $w . 'px;height:' . $h . 'px;visibility:hidden;">' . $content . '</textarea>';
   return $str;
}

// 下拉菜单
function content_select($field,$setting,$value=null) {
  $select	= $setting['content'];
  $select = explode('|', $select);
  $str	= "<select id='fc_" . $field. "' name='" . $field . "' class='inputauto'  " . ">";
    foreach ($select as $t) {
        
        if(isset($value)){
          if($t ==$value){$qk= "selected='selected'";}else{ $qk = '';}
        }else{
          if($t == $setting['default']){$qk= "selected='selected'";}else{ $qk = '';}
        }

        $str.= "<option value='" . $t . "'" . $qk . ">" . $t . "</option>";
    }
    return $str . '</select>';
}


//单选菜单
function content_radio($field,$setting,$value=null) {
   $select = $setting['content'];
   $select = explode('|', $select);
   $str='';
    foreach ($select as $t) {
      if(isset($value)){
          if($t ==$value){$qk= "checked";}else{ $qk = '';}
        }else{
          if($t == $setting['default']){$qk= "checked";}else{ $qk = '';}
        }
      $str.= $t . '&nbsp;<input type="radio" name="' . $field. '" value="' . $t . '" ' . $qk . '/>&nbsp;&nbsp;&nbsp;&nbsp;';
    }
    return $str;
}

//复选框
function content_checkbox($field,$setting,$value=null) {
   $select = $setting['content'];
   $select = explode('|', $select);
   isset($value)?  $value= string2array($value) :'';
   $str='';
    foreach ($select as $t) {
        if(!isset($value)){
        if($t == $setting['default']){$qk= "checked";}else{ $qk = '';}
        }else{
          if(in_array($t,$value)){$qk= "checked";}else{ $qk = '';} // in_array 数组中搜索给定的值。
        }
       $str.= $t . '&nbsp;<input type="checkbox" name="' . $field . '[]" value="' . $t . '" ' . $qk . ' />&nbsp;&nbsp;';
    }
    return $str;
}

//图片上传
function content_image($field,$setting=null,$value=null) {
	  isset($value)?  $value= $value : $value = '' ;
    $upload= site_url(APP_ADMIN.'/upload/upimg');
    $str ="<script>
      KindEditor.ready(function(K) {
        var uploadbutton = K.uploadbutton({
          button : K('#fc_".$field."')[0],
          fieldName : 'imgFile',
          url : '".$upload."',
          afterUpload : function(data) {
            if (data.error === 0) {
              var url = K.formatUrl(data.url, 'absolute');
              K('#sc_".$field."').val(url);
              alert('上传成功!');
            } else {
              alert(data.message);
            }
          },
          afterError : function(str) {
            alert('上传错误: ' + str);
          }
        });
        uploadbutton.fileBox.change(function(e) {
          uploadbutton.submit();
        });
      });
    </script>".'<input name="' . $field . '" type="text" id="sc_'.$field.'" class="dfinput" style="width:255px;" value="'.$value.'" readonly="readonly" />
        <input type="button" id="fc_' .$field . '"   value="上传图片" />';
 
    return $str;
}



/* function content_images($field,$setting=null,$value=null){
  isset($value)?  $value= $value : $value = '' ;
  $upload= site_url(APP_ADMIN.'/upload/upimg');
  $str = '<div class="grid">
  <input type="file" class="g-u"  id="J_'.$field.'" value="'.$setting['default'].'" name="imgFile" >
  <input type="hidden" id="'.$field.'" name="'.$field.'" value="" />
  </div>
  <ul style="padding-left:90px;" id="J_'.$field.'Queue" class="grid">
  
  </ul>
<script>
    var S = KISSY;
     S.use("gallery/uploader/1.5.4/index,gallery/uploader/1.5.4/themes/imageUploader/index,gallery/uploader/1.5.4/themes/imageUploader/style.css", function (S, Uploader,ImageUploader) {
       var plugins = "gallery/uploader/1.5.4/plugins/auth/auth," +
                "gallery/uploader/1.5.4/plugins/urlsInput/urlsInput," +
                "gallery/uploader/1.5.4/plugins/preview/preview";
        S.use(plugins,function(S,Auth,UrlsInput,Preview){
            var uploader = new Uploader("#J_'.$field.'",{
                type : "iframe",
                data:{"name":"minghe"},
                action:"'.$upload.'"
            });
    
        uploader.theme(new ImageUploader({
                queueTarget:"#J_'.$field.'Queue"
            }))
         uploader.plug(new Auth({
                        max:'.$setting['width'].',
                        maxSize:500
          }))
         .plug(new UrlsInput({target:"#'.$field.'"}))
         .plug(new Preview())
            ;
        });
    })
</script>
';
  return $str;
 }*/


function content_images($field,$setting=null,$value=null){
  isset($value)?  $value=  string2array($value) : $value = '' ;
  $upload= site_url(APP_ADMIN.'/upload/upimg');
  $_base_url= base_url();
  if($value){
    $arr=null;
    foreach ($value as $v) {
     $arr.= '<div class="'.$field.'_item picture_item"><img src="'.base_url($v).'" width="120"><div class="'.$field.'_del picture_del">删除</div><div class="'.$field.'_go_up picture_go_up">前移</div><input type="hidden" name="'.$field.'[]" value="'.$v.'" /></div>';
    }
  }
  empty($arr) ? $arr=null : $arr=$arr;
  $str ='<div class="litpic_show">           
            <div class="btn_up">
                <span>上传多图</span>
                <input id="'.$field.'_upload" type="file" name="imgFile">
            </div>
          <div style=" margin-left: 85px; ">
        <div id="'.$field.'_show">
         '.$arr.'
        </div>
       <div class="'.$field.'_tip" style="width:10%;"></div>
     </div>

    </div>
<script type="text/javascript">
$(function () {
  var '.$field.'_show = $("#'.$field.'_show");
  var '.$field.'_tip = $(".'.$field.'_tip");
  $("#'.$field.'_upload").wrap('."'".'<form id="'.$field.'_form" action="'.$upload.'" method="post" enctype="multipart/form-data"></form>'."'".');
    $("#'.$field.'_upload").change(function(){
      if($("#'.$field.'_upload").val() == "") return;
      if ($("#'.$field.'_show>.'.$field.'_item").length >='.$setting['width'].' ) {alert("产品最多上传'.$setting['width'].'张");return;}
    
    $("#'.$field.'_form").ajaxSubmit({
      dataType:  "json",
      beforeSend: function() {
        '.$field.'_tip.html("上传中...");
        },
      success: function(data) {
          if(data.state == "SUCCESS"){  
          '.$field.'_tip.html("上传成功");         
          var img = data.url;
          var '.$field.'_html= '."'".'<div class="'.$field.'_item picture_item"><img  src="'.$_base_url."'".'+ img +'."'".'" width="120"><div class="'.$field.'_del picture_del">删除</div><div class="'.$field.'_go_up picture_go_up">前移</div><input type="hidden" name="'.$field.'[]" value="'."'".'+ img +'."'".'" /></div>'."'".'
          '.$field.'_show.append('.$field.'_html);
          //picture_show.parent().find("span").remove().end().append("<span class="error">描述不能为空</span>");
        }else {
          '.$field.'_tip.html(data.state); 
        }     

      },
      error:function(xhr){
        '.$field.'_tip.html("上传失败"+xhr);

      }
    });
  });
});
$(function () {
  //jquery1.7后没有live
  //$(document).on 也行
  $("#'.$field.'_show").on("mouseenter","#'.$field.'_show>.'.$field.'_item",function(){
      $(this).find(".'.$field.'_go_up").show();
      $(this).find(".'.$field.'_del").show();
    }).on("mouseleave","#'.$field.'_show>.'.$field.'_item",function(){
      $(this).find(".'.$field.'_go_up").hide();
      $(this).find(".'.$field.'_del").hide();
    }
  ); 

    $("#'.$field.'_show").on("click","#'.$field.'_show .'.$field.'_go_up",function () {
        var parent = $(this).parent();
        if (parent.index() == 0){
        }else{
          parent.prev().before(parent);
          $(this).hide();
          parent.find(".'.$field.'_del").hide();
        } 
        
    });

    $("#'.$field.'_show").on("click","#'.$field.'_show .'.$field.'_del",function () {
        var img = $(this).next().val();//下个元素input的值 
    $(this).parent().remove();////移除父元素

    return;
  

});});</script>';
   
   return $str;
  }




//文件上传
function content_file($field,$setting=null,$value=null) {
  isset($value)?  $value= $value : $value = '' ;
  $upload= site_url(APP_ADMIN.'/upload/upfile/');
   $str ="<script>
   KindEditor.ready(function(K) {
        var editor = K.editor({
        uploadJson : '".$upload."',
     
        });
   K('#".$field."').click(function() {
          editor.loadPlugin('insertfile', function() {
            editor.plugin.fileDialog({
              fileUrl : K('#sc_".$field."').val(),
              clickFn : function(url, title) {
                K('#sc_".$field."').val(url);
                editor.hideDialog();
              }
            });
          });
        });
  });
 </script>
   ".'<input name="'.$field.'"type="text"  style="width:255px;"  class="dfinput" id="sc_'.$field.'" value="'.$value.'" />
 
      <input type="button" class="ke-button-common"  style=" width:84px;" id="'.$field.'" value="选择文件" />
    ';
   return $str;
}


