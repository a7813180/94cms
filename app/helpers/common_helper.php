<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
  /**
     * getFileFolderList
     *@fileFlag 0 所有文件列表,1只读文件夹,2是只读文件(不包含文件夹)
     */

   // 过滤数组中不需要的函数




    //获取文件目录列表,该方法返回数组
  function getFileFolderList($pathname,$fileFlag = 0, $pattern='*') {
   $fileArray = array();
   $pathname = rtrim($pathname,'/') . '/';
   $list   =   glob($pathname.$pattern);
   foreach ($list  as $i => $file) {
      switch ($fileFlag) {
         case 0:
         $fileArray[]=basename($file);
         break;
         case 1:
         if (is_dir($file)) {
           $fileArray[]=basename($file);
       }
       break;

       case 2:
       if (is_file($file)) {
           $fileArray[]=basename($file);
       }
       break;

       default:
       break;
   }
}

if(empty($fileArray)) $fileArray = NULL;
return $fileArray;
}



/**
 * 功能：计算文件大小
 * @param int $bytes
 * @return string 转换后的字符串
 */
function get_byte($bytes) {
    if (empty($bytes)) {
        return '--';
    }
    $sizetext = array(" B", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    return round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), 2) . $sizetext[$i];
}
/**
 * 生成随机字符串
 * @param string $lenth 长度
 * @return string 字符串
 */
function get_randomstr($lenth = 6) {
    return get_random($lenth, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
}

/**
* 产生随机字符串
*
* @param    int        $length  输出长度
* @param    string     $chars   可选的 ，默认为 0123456789
* @return   string     字符串
*/
function get_random($length, $chars = '0123456789') {
    $hash = '';
    $max = strlen($chars) - 1;
    for($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}




//循环删除目录和文件函数
function delDirAndFile($dirName, $bFlag = false ) {
    if ( $handle = opendir( "$dirName" ) ) {
        while ( false !== ( $item = readdir( $handle ) ) ) {
            if ( $item != "." && $item != ".." ) {
                if ( is_dir( "$dirName/$item" ) ) {
                    delDirAndFile("$dirName/$item", $bFlag);
                } else {
                    unlink( "$dirName/$item" );
                }
            }
        }
        closedir( $handle );
        if($bFlag) rmdir($dirName);
    }
}




// 获取远程
function sb_get_contents($url,$timeout=100,$referer=''){
    if(function_exists('curl_init')){
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,$timeout);
        if($referer){
            curl_setopt ($ch, CURLOPT_REFERER, $referer);
        }       
        $content = curl_exec($ch);
        curl_close($ch);
        if($content){
            return $content;
        }       
    }
    $ctx = stream_context_create(array('http'=>array('timeout'=>$timeout)));
    $content = @file_get_contents($url, 0, $ctx);
    if($content){
        return $content;
    }
    return false;
}

    //TAG分词自动获取
function get_tag_auto($title,$content){
    $data = sb_get_contents('http://keyword.discuz.com/related_kw.html?ics=utf-8&ocs=utf-8&title='.rawurlencode($title).'&content='.rawurlencode(mb_substr($content,0,500)));
    if($data) {
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, $data, $values, $index);
        xml_parser_free($parser);
        $kws = array();
        foreach($values as $valuearray) {
            if($valuearray['tag'] == 'kw') {
                if(strlen($valuearray['value']) > 3){
                    $kws[] = trim($valuearray['value']);
                }
            }elseif($valuearray['tag'] == 'ekw'){
                $kws[] = trim($valuearray['value']);
            }
        }
        return implode(',',$kws);
    }
    return false;
}


/**
 * 字符串截取，支持中文和其他编码
 * 
 *
 * 
 * @param string $str 需要转换的字符串
 * 
 * @param string $start 开始位置
 * 
 * @param string $length 截取长度
 * 
 * @param string $charset 编码格式
 * 
 * @param string $suffix 截断字符串后缀
 * 
 * @return string
 * 
 */

function substr_ext($str, $start = 0, $length, $charset = "utf-8", $suffix = "...")
{
    strlen($str) > $length*2 ? $suffix= $suffix : $suffix='';
    if (function_exists("mb_substr")) {
        return mb_substr($str, $start, $length, $charset) .$suffix;
    } elseif (function_exists('iconv_substr')) {
       return iconv_substr($str, $start, $length, $charset) . $suffix;
   }
   $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
   $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
   $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
   $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
   preg_match_all($re[$charset], $str, $match);
   $slice = join("", array_slice($match[0], $start, $length));

   return $slice . $suffix;
}


/**
 * 返回经addslashes处理过的字符串或数组
 * @param $string 需要处理的字符串或数组
 * @return mixed
 */
function new_addslashes($string){
    if(!is_array($string)) return addslashes($string);
    foreach($string as $key => $val) $string[$key] = new_addslashes($val);
    return $string;
}


/**
 * 返回经stripslashes处理过的字符串或数组
 * @param $string 需要处理的字符串或数组
 * @return mixed
 */
function new_stripslashes($string) {
    if(!is_array($string)) return stripslashes($string);
    foreach($string as $key => $val) $string[$key] = new_stripslashes($val);
    return $string;
}


//以为数组转换为字符串
//$fuhao 为分隔符
function arrry1_str($fuhao=',',$arr){
    if(is_array($arr)){
      $str = '';
      foreach ($arr as  $value) {
        $str = $str . $value .$fuhao;
      }
      return $str;
    }else{
      return '';
    }

}



/**
* 将字符串转换为数组
*
* @param    string  $data   字符串
* @return   array   返回数组格式，如果，data为空，则返回空数组
*/
function string2array($data) {
    $array=NULL;
    if($data == '') return array();
    @eval("\$array = $data;");
    return $array;
}
/**
* 将数组转换为字符串
*
* @param    array   $data       数组
* @param    bool    $isformdata 如果为0，则不使用new_stripslashes处理，可选参数，默认为1
* @return   string  返回字符串，如果，data为空，则返回空
*/
function array2string($data, $isformdata = 1) {
    if($data == '') return '';
    if($isformdata) $data = new_stripslashes($data);

    return  var_export($data, TRUE);
}



/*
对象数据为数组

*/
function ob2ar($obj) {    if(is_object($obj)) {        $obj = (array)$obj;        $obj = ob2ar($obj);    } elseif(is_array($obj)) {        foreach($obj as $key => $value) {            $obj[$key] = ob2ar($value);        }    }    return $obj;}


/*
 * 获取当前页面完整URL地址
 */
function get_url() {
	$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
	$php_self = $_SERVER['PHP_SELF'] ? safe_replace($_SERVER['PHP_SELF']) : safe_replace($_SERVER['SCRIPT_NAME']);
	$path_info = isset($_SERVER['PATH_INFO']) ? safe_replace($_SERVER['PATH_INFO']) : '';
	$relate_url = isset($_SERVER['REQUEST_URI']) ? safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.safe_replace($_SERVER['QUERY_STRING']) : $path_info);
	return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}



/**
 * 安全过滤函数
 *
 * @param $string
 * @return string
 */
function safe_replace($string) {
	$string = str_replace('%20','',$string);
	$string = str_replace('%27','',$string);
	$string = str_replace('%2527','',$string);
	$string = str_replace('*','',$string);
	$string = str_replace('"','&quot;',$string);
	$string = str_replace("'",'',$string);
	$string = str_replace('"','',$string);
	$string = str_replace(';','',$string);
	$string = str_replace('<','&lt;',$string);
	$string = str_replace('>','&gt;',$string);
	$string = str_replace("{",'',$string);
	$string = str_replace('}','',$string);
	$string = str_replace('\\','',$string);
	return $string;
}


//匹配图片
function get_img($str){
    $str = stripslashes($str);
    $pattern = "/<[img|IMG][^>]*(src|SRC)\=[\"|'| ]((http:\/\/[^>]*)(jpg|gif|png|bmp|jpeg))[\"|'| ]/i";   //获取所有图片标签的全部信息

    preg_match_all($pattern, $str, $matches);

    return $matches[2]; 
}



//下载远程图片
function get_photo($url,$filename='',$savefile= 'uploads/images/') 
{   
    $imgArr = array('gif','bmp','png','ico','jpg','jepg');
    if(!$url) return false;
    if(!$filename) {   
      $ext=strtolower(end(explode('.',$url)));   
      if(!in_array($ext,$imgArr)) return false;
      $filename= date('m-d').'-'.time() . mt_rand(1000,9999).'.'.$ext;   
  }   
  if(!is_dir($savefile)) mkdir($savefile, 0777);
  if(!is_readable($savefile)) chmod($savefile, 0777);
  $filename =  $savefile.$filename;
  ob_start();   
  readfile($url);   
  $img = ob_get_contents();   
  ob_end_clean();   
  $size = strlen($img);   
  $fp2=@fopen($filename, "a");   
  @fwrite($fp2,$img);   
  @fclose($fp2);

  return $filename;   
}   


//百度ping提交函数
function ping_baidu($url){
    $ntime=time();
    $now = date('Y-m-d',$ntime);
    $data ='<?xml version="1.0" encoding="UTF-8"?>';
    $data .='   <urlset>';
    $data .='       <url>';
    $data .='           <loc><![CDATA['.$url.']]></loc>';
    $data .='           <lastmod>'.$now.'</lastmod>';
    $data .='           <changefreq>daily</changefreq>';
    $data .='           <priority>0.8</priority>';
    $data .='       </url>';
    $data .='   </urlset>';
    $pingurl="http://ping.baidu.com/sitemap?site=www.xxx.com&resource_name=sitemap&access_token=XXXXXXX";//你的接口地址
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $pingurl); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, "curl/7.12.1"); // 模拟用户使用的浏览器
    @curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    curl_setopt($curl, CURLOPT_REFERER,"");
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
       echo 'Errno'.curl_error($curl);//捕抓异常
   }
    curl_close($curl); // 关闭CURL会话
    return $tmpInfo; // 返回数据
}

 

 //时间函数按照多少小时 多少天计算
   function time_tran($the_time){
   	$now_time = date("Y-m-d H:i:s",time());
   	$the_time = date('Y-m-d H:i:s',$the_time);
   	$now_time = strtotime($now_time);
   	$show_time = strtotime($the_time);
   	$dur = $now_time - $show_time;
   	if($dur < 0){
   		return $the_time;
   	}else{
   		if($dur < 60){
   			return $dur.'秒前';
   		}else{
   			if($dur < 3600){
   				return floor($dur/60).'分钟前';
   			}else{
   				if($dur < 86400){
   					return floor($dur/3600).'小时前';
   				}else{
       if($dur < 259200){//3天内
       	return floor($dur/86400).'天前';
       }else{
       	return $the_time;
       }
      }
    }
  }
 }
}
 

 //把内容过滤并按照要求就去的个数输出
 function get_str($str,$sublen){
 	$str = strip_tags($str);
  $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));
 	$str = substr_ext($str,0,$sublen);
 	return $str;
 }



 //下载函数
  function dow($cid,$id){
    $cid = (int) $cid;
    $id =(int) $id;
    if(empty($cid)||empty($cid)){
      return '';
    }
    return site_url('show_dow_'.$cid.'_'.$id);
  }
 
 
 /**************************************************************
*  生成指定长度的随机码。
*  @param int $length 随机码的长度。
*  @access public
**************************************************************/
function createRandomCode($length)
{
	$randomCode = "";
	$randomChars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	for ($i = 0; $i < $length; $i++)
	{
		$randomCode .= $randomChars { mt_rand(0, 35) };
	}
	return $randomCode;
}
 
 
 
 

?>