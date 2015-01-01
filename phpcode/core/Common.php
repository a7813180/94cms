<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Common Functions
 *
 * Loads the base classes and executes the request.
 *
 * @package		CodeIgniter
 * @subpackage	codeigniter
 * @category	Common Functions
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/
 */

// ------------------------------------------------------------------------

/**
* Determines if the current version of PHP is greater then the supplied value
*
* Since there are a few places where we conditionally test for PHP > 5
* we'll set a static variable.
*
* @access	public
* @param	string
* @return	bool	TRUE if the current version is $version or higher
*/
if ( ! function_exists('is_php'))
{
	function is_php($version = '5.0.0')
	{
		static $_is_php;
		$version = (string)$version;

		if ( ! isset($_is_php[$version]))
		{
			$_is_php[$version] = (version_compare(PHP_VERSION, $version) < 0) ? FALSE : TRUE;
		}

		return $_is_php[$version];
	}
}

// ------------------------------------------------------------------------

/**
 * Tests for file writability
 *
 * is_writable() returns TRUE on Windows servers when you really can't write to
 * the file, based on the read-only attribute.  is_writable() is also unreliable
 * on Unix servers if safe_mode is on.
 *
 * @access	private
 * @return	void
 */
if ( ! function_exists('is_really_writable'))
{
	function is_really_writable($file)
	{
		// If we're on a Unix server with safe_mode off we call is_writable
		if (DIRECTORY_SEPARATOR == '/' AND @ini_get("safe_mode") == FALSE)
		{
			return is_writable($file);
		}

		// For windows servers and safe_mode "on" installations we'll actually
		// write a file then read it.  Bah...
		if (is_dir($file))
		{
			$file = rtrim($file, '/').'/'.md5(mt_rand(1,100).mt_rand(1,100));

			if (($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE)
			{
				return FALSE;
			}

			fclose($fp);
			@chmod($file, DIR_WRITE_MODE);
			@unlink($file);
			return TRUE;
		}
		elseif ( ! is_file($file) OR ($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE)
		{
			return FALSE;
		}

		fclose($fp);
		return TRUE;
	}
}

// ------------------------------------------------------------------------

/**
* Class registry
*
* This function acts as a singleton.  If the requested class does not
* exist it is instantiated and set to a static variable.  If it has
* previously been instantiated the variable is returned.
*
* @access	public
* @param	string	the class name being requested
* @param	string	the directory where the class should be found
* @param	string	the class name prefix
* @return	object
*/
if ( ! function_exists('load_class'))
{
	function &load_class($class, $directory = 'libraries', $prefix = 'CI_')
	{
		static $_classes = array();

		// Does the class exist?  If so, we're done...
		if (isset($_classes[$class]))
		{
			return $_classes[$class];
		}

		$name = FALSE;

		// Look for the class first in the local application/libraries folder
		// then in the native system/libraries folder
		foreach (array(APPPATH, BASEPATH) as $path)
		{
			if (file_exists($path.$directory.'/'.$class.'.php'))
			{
				$name = $prefix.$class;

				if (class_exists($name) === FALSE)
				{
					require($path.$directory.'/'.$class.'.php');
				}

				break;
			}
		}

		// Is the request a class extension?  If so we load it too
		if (file_exists(APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php'))
		{
			$name = config_item('subclass_prefix').$class;

			if (class_exists($name) === FALSE)
			{
				require(APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php');
			}
		}

		// Did we find the class?
		if ($name === FALSE)
		{
			// Note: We use exit() rather then show_error() in order to avoid a
			// self-referencing loop with the Excptions class
			exit('Unable to locate the specified class: '.$class.'.php');
		}

		// Keep track of what we just loaded
		is_loaded($class);

		$_classes[$class] = new $name();
		return $_classes[$class];
	}
}

// --------------------------------------------------------------------

/**
* Keeps track of which libraries have been loaded.  This function is
* called by the load_class() function above
*
* @access	public
* @return	array
*/
if ( ! function_exists('is_loaded'))
{
	function &is_loaded($class = '')
	{
		static $_is_loaded = array();

		if ($class != '')
		{
			$_is_loaded[strtolower($class)] = $class;
		}

		return $_is_loaded;
	}
}

// ------------------------------------------------------------------------

/**
* Loads the main config.php file
*
* This function lets us grab the config file even if the Config class
* hasn't been instantiated yet
*
* @access	private
* @return	array
*/
if ( ! function_exists('get_config'))
{
	function &get_config($replace = array())
	{
		static $_config;

		if (isset($_config))
		{
			return $_config[0];
		}

		// Is the config file in the environment folder?
		if ( ! defined('ENVIRONMENT') OR ! file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/config.php'))
		{
			$file_path = APPPATH.'config/config.php';
		}

		// Fetch the config file
		if ( ! file_exists($file_path))
		{
			exit('The configuration file does not exist.');
		}

		require($file_path);

		// Does the $config array exist in the file?
		if ( ! isset($config) OR ! is_array($config))
		{
			exit('Your config file does not appear to be formatted correctly.');
		}

		// Are any values being dynamically replaced?
		if (count($replace) > 0)
		{
			foreach ($replace as $key => $val)
			{
				if (isset($config[$key]))
				{
					$config[$key] = $val;
				}
			}
		}

		return $_config[0] =& $config;
	}
}

// ------------------------------------------------------------------------

/**
* Returns the specified config item
*
* @access	public
* @return	mixed
*/
if ( ! function_exists('config_item'))
{
	function config_item($item)
	{
		static $_config_item = array();

		if ( ! isset($_config_item[$item]))
		{
			$config =& get_config();

			if ( ! isset($config[$item]))
			{
				return FALSE;
			}
			$_config_item[$item] = $config[$item];
		}

		return $_config_item[$item];
	}
}

// ------------------------------------------------------------------------

/**
* Error Handler
*
* This function lets us invoke the exception class and
* display errors using the standard error template located
* in application/errors/errors.php
* This function will send the error page directly to the
* browser and exit.
*
* @access	public
* @return	void
*/
if ( ! function_exists('show_error'))
{
	function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered')
	{
		$_error =& load_class('Exceptions', 'core');
		echo $_error->show_error($heading, $message, 'error_general', $status_code);
		exit;
	}
}

// ------------------------------------------------------------------------

/**
* 404 Page Handler
*
* This function is similar to the show_error() function above
* However, instead of the standard error template it displays
* 404 errors.
*
* @access	public
* @return	void
*/
if ( ! function_exists('show_404'))
{
	function show_404($page = '', $log_error = TRUE)
	{
		$_error =& load_class('Exceptions', 'core');
		$_error->show_404($page, $log_error);
		exit;
	}
}

// ------------------------------------------------------------------------

/**
* Error Logging Interface
*
* We use this as a simple mechanism to access the logging
* class and send messages to be logged.
*
* @access	public
* @return	void
*/
if ( ! function_exists('log_message'))
{
	function log_message($level = 'error', $message, $php_error = FALSE)
	{
		static $_log;

		if (config_item('log_threshold') == 0)
		{
			return;
		}

		$_log =& load_class('Log');
		$_log->write_log($level, $message, $php_error);
	}
}

// ------------------------------------------------------------------------

/**
 * Set HTTP Status Header
 *
 * @access	public
 * @param	int		the status code
 * @param	string
 * @return	void
 */
if ( ! function_exists('set_status_header'))
{
	function set_status_header($code = 200, $text = '')
	{
		$stati = array(
							200	=> 'OK',
							201	=> 'Created',
							202	=> 'Accepted',
							203	=> 'Non-Authoritative Information',
							204	=> 'No Content',
							205	=> 'Reset Content',
							206	=> 'Partial Content',

							300	=> 'Multiple Choices',
							301	=> 'Moved Permanently',
							302	=> 'Found',
							304	=> 'Not Modified',
							305	=> 'Use Proxy',
							307	=> 'Temporary Redirect',

							400	=> 'Bad Request',
							401	=> 'Unauthorized',
							403	=> 'Forbidden',
							404	=> 'Not Found',
							405	=> 'Method Not Allowed',
							406	=> 'Not Acceptable',
							407	=> 'Proxy Authentication Required',
							408	=> 'Request Timeout',
							409	=> 'Conflict',
							410	=> 'Gone',
							411	=> 'Length Required',
							412	=> 'Precondition Failed',
							413	=> 'Request Entity Too Large',
							414	=> 'Request-URI Too Long',
							415	=> 'Unsupported Media Type',
							416	=> 'Requested Range Not Satisfiable',
							417	=> 'Expectation Failed',

							500	=> 'Internal Server Error',
							501	=> 'Not Implemented',
							502	=> 'Bad Gateway',
							503	=> 'Service Unavailable',
							504	=> 'Gateway Timeout',
							505	=> 'HTTP Version Not Supported'
						);

		if ($code == '' OR ! is_numeric($code))
		{
			show_error('Status codes must be numeric', 500);
		}

		if (isset($stati[$code]) AND $text == '')
		{
			$text = $stati[$code];
		}

		if ($text == '')
		{
			show_error('No status text available.  Please check your status code number or supply your own message text.', 500);
		}

		$server_protocol = (isset($_SERVER['SERVER_PROTOCOL'])) ? $_SERVER['SERVER_PROTOCOL'] : FALSE;

		if (substr(php_sapi_name(), 0, 3) == 'cgi')
		{
			header("Status: {$code} {$text}", TRUE);
		}
		elseif ($server_protocol == 'HTTP/1.1' OR $server_protocol == 'HTTP/1.0')
		{
			header($server_protocol." {$code} {$text}", TRUE, $code);
		}
		else
		{
			header("HTTP/1.1 {$code} {$text}", TRUE, $code);
		}
	}
}

// --------------------------------------------------------------------

/**
* Exception Handler
*
* This is the custom exception handler that is declaired at the top
* of Codeigniter.php.  The main reason we use this is to permit
* PHP errors to be logged in our own log files since the user may
* not have access to server logs. Since this function
* effectively intercepts PHP errors, however, we also need
* to display errors based on the current error_reporting level.
* We do that with the use of a PHP error template.
*
* @access	private
* @return	void
*/
if ( ! function_exists('_exception_handler'))
{
	function _exception_handler($severity, $message, $filepath, $line)
	{
		 // We don't bother with "strict" notices since they tend to fill up
		 // the log file with excess information that isn't normally very helpful.
		 // For example, if you are running PHP 5 and you use version 4 style
		 // class functions (without prefixes like "public", "private", etc.)
		 // you'll get notices telling you that these have been deprecated.
		if ($severity == E_STRICT)
		{
			return;
		}

		$_error =& load_class('Exceptions', 'core');

		// Should we display the error? We'll get the current error_reporting
		// level and add its bits with the severity bits to find out.
		if (($severity & error_reporting()) == $severity)
		{
			$_error->show_php_error($severity, $message, $filepath, $line);
		}

		// Should we log the error?  No?  We're done...
		if (config_item('log_threshold') == 0)
		{
			return;
		}

		$_error->log_exception($severity, $message, $filepath, $line);
	}
}

// --------------------------------------------------------------------

/**
 * Remove Invisible Characters
 *
 * This prevents sandwiching null characters
 * between ascii characters, like Java\0script.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('remove_invisible_characters'))
{
	function remove_invisible_characters($str, $url_encoded = TRUE)
	{
		$non_displayables = array();
		
		// every control character except newline (dec 10)
		// carriage return (dec 13), and horizontal tab (dec 09)
		
		if ($url_encoded)
		{
			$non_displayables[] = '/%0[0-8bcef]/';	// url encoded 00-08, 11, 12, 14, 15
			$non_displayables[] = '/%1[0-9a-f]/';	// url encoded 16-31
		}
		
		$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

		do
		{
			$str = preg_replace($non_displayables, '', $str, -1, $count);
		}
		while ($count);

		return $str;
	}
}

// ------------------------------------------------------------------------

/**
* Returns HTML escaped variable
*
* @access	public
* @param	mixed
* @return	mixed
*/
if ( ! function_exists('html_escape'))
{
	function html_escape($var)
	{
		if (is_array($var))
		{
			return array_map('html_escape', $var);
		}
		else
		{
			return htmlspecialchars($var, ENT_QUOTES, config_item('charset'));
		}
	}
}

/* End of file Common.php */
/* Location: ./system/core/Common.php */

/*
自定义函数

*/

//打印函数
function P($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

//获取客户端IP
function getIP(){
global $ip;
if (getenv("HTTP_CLIENT_IP"))
$ip = getenv("HTTP_CLIENT_IP");
else if(getenv("HTTP_X_FORWARDED_FOR"))
$ip = getenv("HTTP_X_FORWARDED_FOR");
else if(getenv("REMOTE_ADDR"))
$ip = getenv("REMOTE_ADDR");
else $ip = "Unknow";
return $ip;
}

//根据IP 获取 地区
function getipinfo($ip=null){
   if(empty($ip)) $ip=getIP();  //get_client_ip()为tp自带函数，如没有，自己百度搜索。此处就不重复复制了
    $url='http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
    $result = file_get_contents($url);
   $result = json_decode($result,true);
  if($result['code']!==0 || !is_array($result['data'])) return false;
 
  if(empty($result['data']['city'])){
  	return '内部服务器';
  }else{
  	return $result['data']['city'];
  }

}

function htmlts($msg){
	echo "<meta charset='utf-8'>";
   echo $msg;

}


//验证正确函数
function success($msg,$url=null)
 {
    $baseurl=base_url();
    echo "<!DOCTYPE><html><head><meta http-equiv='Content-Type' content='text/html'>";
    echo "<meta charset='utf-8'>";
    echo "<link href='".$baseurl."public/artDialog/skins/blue.css' rel='stylesheet' type='text/css' />";
    echo "<script src='".$baseurl."public/artDialog/artDialog.js'></script>";
    echo "</head><title></title><body></body></html>";
    $url =  empty($url) ? 'location.replace(document.referrer);':  "location.href='".site_url($url)."'";
    $str = <<<str
       <script language='javascript'>
        var dialog = art.dialog({
        title: '操作成功',
        content: '$msg',
        icon: 'success',
        ok: function(){
         $url
         }
        });
        </script>
str;
    echo $str;
    die;
}



//验证错误函数
function error($msg,$url=null)
 {
    $baseurl=base_url();
    $msg=preg_replace("/\s/","",$msg);
    $msg = str_replace(".","!",$msg);
	$msg = str_replace("<p>","",$msg);
	$msg = str_replace("</p>","&nbsp;&nbsp;&nbsp;",$msg);
    echo "<!DOCTYPE><html><head><meta http-equiv='Content-Type' content='text/html'>";
    echo "<meta charset='utf-8'>";
    echo "<link href='$baseurl/public/artDialog/skins/blue.css' rel='stylesheet' type='text/css' />";
    echo "<script src='$baseurl/public/artDialog/artDialog.js'></script>";
    echo "</head><title></title><body></body></html>";
    
    $str = <<< str
       <script language='javascript'>
        var dialog = art.dialog({
        title: '操作失败',
        content: '$msg',
        icon: 'error',
        ok: function(){
        history.go(-1);
        return false;
         }
        });
        </script>
str;
    echo $str;
    die;
}

 

function success_s($msg)
    {
    echo "<!DOCTYPE><html><head><meta http-equiv='Content-Type' content='text/html'>";
    echo "<meta charset='utf-8'>";
    echo "</head><title></title><body></body></html>";
    $str = <<<str
       <script language='javascript'>
        var index = parent.layer.getFrameIndex(window.name);
           parent.layer.msg('$msg',2, 1);
           parent.layer.close(index);
         </script>
str;
    echo $str;
    die;
}



function error_s($msg)
    {
    echo "<!DOCTYPE><html><head><meta http-equiv='Content-Type' content='text/html'>";
    echo "<meta charset='utf-8'>";
    echo "</head><title></title><body></body></html>";
    $msg=preg_replace("/\s/","",$msg);
    $msg = str_replace(".","!",$msg);
	$msg = str_replace("<p>","",$msg);
	$msg = str_replace("</p>","!!",$msg);
    $str = <<<str
       <script language='javascript'>
        var index = parent.layer.getFrameIndex(window.name);
           parent.layer.alert('$msg',2, "错误信息");
           history.go(-1);
         
         </script>
str;
    echo $str;
    die;
}

 //表单验证错误信息过滤html代码
 function msg($msg){
    $msg=preg_replace("/\s/","",$msg);
    $msg = str_replace(".","!",$msg);
	$msg = str_replace("<p>","",$msg);
	$msg = str_replace("</p>","!!",$msg);
    return $msg;
 }




//读取自定义配置文件
  function C($name)
 { 
   $diy= config_item('tm');
   return $diy[$name];
 }



//当前位置函数
 function catepos($cid,$wap=null)
 {
     $ci =& get_instance();
     empty($wap) ? $wap_url=null :$wap_url = 'wap';
     $data = $ci->db->select('id,name,ename,type,modelid,pid')->get_where('cate',array('status '=>'1',))->result_array();
     $ci->load->library('cate_class');
     $cate = $ci->cate_class->get_parent($data,$cid,$wap);
     $weizhi = "<a href='".site_url($wap_url)."'>".'主页'."</a>";
     foreach ($cate as $v) {
          $arr = "<a href='".$v['url']."'>".$v['name']."</a>";
          $weizhi = $weizhi."&gt;".$arr;
     }
     return $weizhi;
 }

//最上级分类id

 function tcid($cid)
 {
     $ci =& get_instance();
     $data = $ci->db->select('id,pid')->get_where('cate',array('status '=>'1',))->result_array();
     $ci->load->library('cate_class');
     $cate = $ci->cate_class->get_tcid($data,$cid);
     If(empty($cate)){ return 0;}else{ return $cate['id'];}
    
 }


 //分类url  需要重新写这个分类URL构造函数
 function list_url($v,$wap=null)
 {  
    if(!empty($wap)){
    	config_item('index_page') ? $wap= '/wap' : $wap ='wap/';
    }
    config_item('index_page') ? $fuhao = "/" : $fuhao = '';
    if(empty($v)){ return '';}
    if($v['type']){
       //判断有没有@符 为内部链接
      if(strpos($v['ename'],'@')!==false){
        $v['ename'] =  str_replace("@", '', $v['ename']);
        $v['url'] = site_url().$fuhao.$v['ename'];
      }else{
      	$v['url'] = prep_url($v['ename']) ;
      }
     }else{
	if($v['ename']){
       if(config_item('url')==3 && empty($wap)){
 	      $v['url'] =   $v['modelid'] =='1'? '/'.config_item('html_path').$wap.$fuhao.$v['ename']:'/'.config_item('html_path').$wap.$fuhao.$v['ename'];
        }else{
 	  	  $v['url'] =   $v['modelid'] =='1'? site_url().$wap.$fuhao.'p_'.$v['ename']:site_url().$wap.$fuhao.$v['ename'];
        }
	 }else{
	  if(config_item('url')==3 && empty($wap) ){
	      $v['url'] =   $v['modelid'] =='1'? '/'.config_item('html_path').$wap.$fuhao.'page_view_'.$v['id'].'.html':'/'.config_item('html_path').$wap.$fuhao.'list_view_'.$v['id'].'_1.html';
	  }else{
	  	  $v['url'] =   $v['modelid'] =='1'? site_url($wap.$fuhao.'page_view_'.$v['id']):site_url($wap.$fuhao.'list_view_'.$v['id'].'_1');
	  }
	}
	}
    return $v['url'];
 }

 

 //输入分类id 返回 链接
 function cid_url($cid = null){
   $ci =& get_instance();
   $cate = $ci->db->get_where('cate',array('id'=>$cid))->row_array();
   return list_url($cate);
 }


//获取栏目名称 或者 url
function cate($cid=null,$type=null){
   if(empty($cid)){return '';}	
   $ci =& get_instance();
   $cate = $ci->db->get_where('cate',array('id'=>$cid))->row_array();
   $cate['url'] = list_url($cate);
   if (isset($type)) {
   	  return $cate[$type];
   }else{
   	  return '';
   }

}

 //show_url  内容页链接
 function show_url($list,$wap=null)
 { 
  if(!empty($wap)){
     $wap ='wap/';
    }else{
      $wap ='';
    }
   if(empty($list['ename']))
   { 
   	 if(config_item('url')==3 && empty($wap) ){
   	 	return  base_url(config_item('html_path').'/'.$wap.'show_view_'.$list['cid'].'_'.$list['id'].'.html');
   	 }else{
   	 	 return site_url($wap.'show_view_'.$list['cid'].'_'.$list['id']);
   	 }
    
   }else{
   	 if(config_item('url')==3 && empty($wap) ){
   	 	return base_url(config_item('html_path').'/'.$wap.$list['ename'].'/'.$list['id'].'.html');
   	 }else{
   	 	return site_url($wap.$list['ename'].'/'.$list['id']);
   	 }
   	 
   }
 }


   /**
     *  加粗关键字
     *
     * @access    private
     * @param     string  $fstr  关键词字符
     * @return    string
     */
    function GetRedKeyWord($k,$content)
    {
          $fstr = str_replace($k, "<font color='red'>".$k."</font>",$content);
          return $fstr;
    }