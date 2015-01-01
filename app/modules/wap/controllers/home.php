<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class   Wap_home_module extends CI_Module {

	/**
	 * 构造函数
	 *
	 * @return void
	 * @author
	 **/
	function __construct()
	{
		parent::__construct();
        $this->is_view(); //引入模板引擎和自定义配置类
        $this->is_mobil(); //判断手机网站关闭还是开启
        $lock = dirname(__FILE__).DS.'install.lock';
        if(!file_exists($lock)){ show_error('请先安装本模块！');}
        define('_APPURL_', 'module/wap/home'); 
       
	}
    
    //首页
	public function index()
	{  
      $data['tcid'] = 0;
      $data['cid'] = 0;
      $this->wap_view('index.html',$data);
	}
    
  

}