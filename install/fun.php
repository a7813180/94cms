<?php
//判断是否已经安装过
if(file_exists("../install.lock")){
	header('Content-type:text/html;charset=utf-8');
	die("网站已经安装过了！如果你需要重装，请删除 install.lock再试。<a href='../'>回到首页</a>");
}

// 获取客户端IP地址
function get_client_ip() {
    static $ip = NULL;
    if ($ip !== NULL) return $ip;
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos =  array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip   =  trim($arr[0]);
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $ip = (false !== ip2long($ip)) ? $ip : '0.0.0.0';
    return $ip;
}
/**
* 删除目录及其文件
* 
* @param string $dir 目录全路径
* @param bool $self 是否删除自身
*/
function deleteDir( $dir, $self=false ){
    if(!is_dir($dir)) return false;
    foreach( glob( $dir . '/*') as $item ){
        is_dir($item) ? (deleteDir($item) && rmdir ($item)) : unlink($item); 
    }    
    return ($self)? rmdir($dir) : true;
}


 

//取得当前网址信息
function thisDomain(){
	$http = $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
	$c_path = preg_replace('/\/install\/.*/i','',$_SERVER['PHP_SELF']);
	return $http.$_SERVER['HTTP_HOST'].$c_path;
}