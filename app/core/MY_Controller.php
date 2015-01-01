<?php

/*验证用户身份登录*/
Class MY_Controller extends  CI_Controller{

  //后台验证
 public function is_login(){
   $this->load->library('session');
   $data=$this->session->all_userdata();
   if(empty($data['username']) && empty($data['rank'])){
     redirect(APP_ADMIN.'/login/');
   }
   if(_94CMS_BUG){
        $this->output->enable_profiler(TRUE); // 开启调式模式 
      }
	  //缓存
      if(config_item('admin_cache') == 'true' ){
       $time = config_item('admin_cache_time')? config_item('admin_cache_time') : '60';
       $this->output->cache($time);
     }

   }

   //会员验证
  public function is_member_login(){
    $this->load->library('session');
    $data=$this->session->all_userdata();
    if(empty($data['userid']) && empty($data['id'])){
      redirect(site_url('member/login'));
    }
  }

  //会员关闭
  public function is_member(){
    $site = $this->db->select('is_member')->get('member_site')->row_array();
    if(!$site['is_member']){
      header("Content-type:text/html;charset=utf-8");
      echo '会员系统关闭';
      die;
    }
  }

    //模板引擎
    public function is_view()
    { 
      if(config_item('index_cache') == 'true'){
        $time = config_item('index_cache_time')? config_item('index_cache_time') : '60';
        $this->output->cache($time);
      }

      if(config_item('mysql_cache') == 'true'){
        $this->db->cache_on();
      }
      C('weblook') ? show_error(C('lookdes')):'';  //关闭网站判断
      if(_94CMS_BUG){
      $this->output->enable_profiler(TRUE); // 开启调式模式 
    }
  }
    
    //手机开启关闭网站判断
    public function is_mobil(){
      if(config_item('mobil') != 'true'){
        show_error('手机网站关闭!');
      }
    }


    //PC调用模板
    public function view($fielname,$data=null){
      //引入session类
      $this->load->library('session');

      if(!$fielname){show_error('没定义模板文件');}
      $this->load->library('mytpl_class');
      $templatefilename = $this->mytpl_class->view($fielname);
      $site['webname'] = C('webname');
      $site['webkey'] =C('webkey');
      $site['webdes']=C('webdes');
      if(empty($data))
      {
        $data = $site;
      }else{
        $data = array_merge_recursive($data,$site);
      }
      $this->load->view($templatefilename,$data);
    }


     //WAP调用模板引擎
    public function wap_view($fielname,$data=null){
      if(!$fielname){show_error('没定义模板文件');}
      $this->load->library('mytpl_class');
      $templatefilename = $this->mytpl_class->wap_view($fielname);
      $site['webname'] = C('webname');
      $site['webkey'] =C('webkey');
      $site['webdes']=C('webdes');
      if(empty($data))
      {
        $data = $site;
      }else{
        $data =   array_merge_recursive($data,$site);
      }
      $this->load->view($templatefilename,$data);
    }


    //电脑网站判断
    public function is_mobile(){
      $this->load->library('user_agent');
      if($this->agent->is_mobile()){
        if(config_item('mobil')){
          config_item('mobil_tz') ? redirect(base_url('wap'), 'location', 302) : ''; 
        }
      }
    }




  }
  ?>