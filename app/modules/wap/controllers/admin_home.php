<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class   Wap_Admin_home_module extends CI_Module {

	/**
	 * 构造函数
	 *
	 * @return void
	 * @author
	 **/
	function __construct()
	{
		parent::__construct();
	    $this->is_login();
        $lock = dirname(__FILE__).DS.'install.lock';
        if(!file_exists($lock)){ error('请先安装手机网站模块！');}
        define('_APPURL_', 'module/wap/admin_home'); 
       
	}
    
    //首页
	public function index()
	{  
       header('content-type:text/html; charset=utf-8');
       echo "无需要设置";
       //$this->load->view('sql_index.html',$data);
	}
    
  

}