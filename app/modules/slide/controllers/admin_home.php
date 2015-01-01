<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Slide_Admin_Home_module extends CI_Module {

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
        define('_APPURL_', 'module/slide/admin_home'); //操作成功返回URL
    }
 
  
   public   function index()
	 { 
     
     $cid=$this->uri->segment(5);
     empty($cid)? $cid = 0 : '';
     $this->load->model('Main_data_model');
     $data['slide']=$this->Main_data_model->select($cid);
     $data['cid'] = $cid;
     $this->load->view('slide_index.html',$data);
	 }

    //删除
   public  function del()
    {
     $id = $this->uri->segment(5);
     $this->load->model('Main_data_model');
     $this->Main_data_model->del($id) ? success('删除成功!') : error('删除失败');
    }
    
 

  //添加
  public function add()
  {
    $cid = $this->uri->segment(5);
    $cid ? $cid =$cid :$cid='0';
    $data = array
    (
      'cid' => $cid,
      'url' =>'#',
      'sort'=>'99'
      );
    $this->db->insert('slide',$data) ? success('添加成功!') : error('添加失败！!');
  }
  
 
  //修改

  public function update()
  {
    $data = $this->input->post(null,true);
    unset($data['imgFile']);
    $this->db->where('id',$data['id']);
    $this->db->update('slide',$data) ? success('oK') : error('修改失败!');
  }


 
}