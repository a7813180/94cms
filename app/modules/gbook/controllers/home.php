<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class   Gbook_Home_module extends CI_Module {

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
        $lock = dirname(__FILE__).DS.'install.lock';
        if(!file_exists($lock)){ show_error('请先安装本模块！');}
    }
    
    //首页
	public function index()
	{   
        $gbook = $this->db->get_where('gbook',array('lock'=>'0'));
        $total_rows = $gbook -> num_rows();
        $this->load->library('pagination');
        $perPage='5'; //每页显示
        $config['base_url'] = site_url().'module/gbook/home/index';
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $perPage;
        $config['uri_segment'] = 5;
        $config['first_link'] = '首页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['last_link'] = '最后一页';
        $config['enable_query_strings'] = true;
        $this->pagination->initialize($config); 
        $offset = $this->uri->segment(5);
        $data['gbook']=$this->db->limit($perPage, $offset)->order_by('id','desc')->get_where('gbook',array('lock'=>'0'))->result_array();
        $data['page'] =$this->pagination->create_links();
        $data['tcid'] = 0;
        $data['cid'] = 0;
        $this->view('gbook.html',$data);
	}
     
     //提交
     public function gbook_s()
     {  
        //success('OK');
        define('TIME_OUT', 60); //定义重复操作最短的允许时间，单位秒
        $this->load->library('session'); 
        $time = time(); 
        $s_time = $this->session->userdata('time');
        /*if( isset($s_time) )
        { 
         if( $time - $s_time <= TIME_OUT ) //判断超时 
        { error('1分钟只可以提交一次!');}
        } */

        $data = $this->input->post(null,true);
        $data['title'] && $data['content'] ? '':error('标题和留言内容不可以为空!');

        $conlock = config_item('gbook');
   
        if($conlock == "true"){
            $data['lock'] = 1;
        }else{
            $data['lock'] = 0 ;
        }
    
        $data['time'] = time();
        $data['ip'] = getip();
        $this->session->set_userdata(array('time'=>$time)); //提交成功生成session

        if($this->db->insert('gbook',$data)){
           success('留言成功!'); 
        }else{
            error('留言失败!');
        }
 
       }


}