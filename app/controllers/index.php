<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

   class Index extends My_Controller{
      //构造函数
      public function __construct()
      {
      parent::__construct();
      $this->is_view(); //引入模板引擎和自定义配置类
      $this->is_mobile(); //判断pc或者手机
      }


      //首页
      public function index()
      {
      $data['tcid'] = 0;
      $data['cid'] = 0;
      $this->view('index.html',$data);
      }


  
   }
?>