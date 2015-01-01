<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class   Gbook_Admin_home_module extends CI_Module {

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
        $lock = dirname(__FILE__).DIRECTORY_SEPARATOR.'install.lock';
        if(!file_exists($lock)){ error('请先安装本模块！');}
        define('_APPURL_', 'module/gbook/admin_home'); 
       
	}
    
    //首页
	public function index()
	{
        $gbook = $this->db->get('gbook');
        $total_rows = $gbook -> num_rows();
        $this->load->library('pagination');
        $perPage='10'; //每页显示
        $config['base_url'] = site_url('module/gbook/admin_home/index/');
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
        $data['gbook']=$this->db->limit($perPage, $offset)->order_by('id','desc')->get('gbook')->result_array();
        $data['page'] =$this->pagination->create_links();
        $this->load->view('gbook_index.html',$data);
	}
     

    //回复
    public function updata()
    {
		 $id = $this->uri->segment(5);
		 $this->load->model('Main_data_model');
	     $data['data'] = $this->Main_data_model->updata($id);
	     $this->load->view('gbook_updata.html',$data);
    }

    public function updata_s()
    {
    	$data = $this->input->post(null,true);
        $data['title'] && $data['content'] && $data['admin_content'] ? '' : error_s('不可以为空!');
    	$data['admin_time'] =  time();
    	$this->db->where('id',$data['id'])->update('gbook',$data) ? success_s('回复成功!') : error_s('回复失败!');
    }

      //删除
    public  function del()
    {
        $id = $this->uri->segment(5);
        $this->load->model('Main_data_model');
        $this->Main_data_model->del($id) ? success('删除成功!',_APPURL_) : error('删除失败');
    }

    //批量删除
    public function del_s()
    {
        $id=$this->input->post('del',true);
        $id ?  '': error('要删除留言不存在！');
        foreach($id as $v){
        $this->db->delete('gbook',array('id'=>$v));
        }
        success("批量删除成功！",_APPURL_);
    }

   //审核

   public function lock()
    {
       $id = $this->uri->segment(5);
       $lock = $this->uri->segment(6);
       $this->db->where('id',$id)->update('gbook',array('lock'=>$lock)) ? success('状态更新成功') : error('更新失败');
      
    }

}