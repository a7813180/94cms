<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class   Member_Admin_home_module extends CI_Module {

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
       if(!file_exists($lock)){ error('请先安装本模块！');}
       define('_APPURL_', 'module/menber/admin_home'); 

     }

     //会员列表
     public function index()
     {  
      $data['member'] = $this->db->get('member')->result_array();
      $this->load->view('admin_index.html',$data);
    }


    //添加会员
    public function add(){
      $this->load->view('admin_add.html');
     }


    //添加会员处理
    public function add_s(){
      $data = $this->input->post(null,true);
      $data['pwd'] = md5($data['pwd']);
      $data['joinip'] = getIP();
      $data['jointime'] = time();
      $this->db->insert('member',$data) ? success_s('添加成功!'): error_s('添加失败!');
    }

    //删除会员
    public function del($id=null){
      $id = (int) $id;
      empty($id)?error('没有找到要删除的参数!'):'';
      $this->db->where('id',$id)->delete('member') ? success('删除成功'):error('删除失败');
    }

    //批量删除
    public function del_s(){
      $ids =  $this->input->post(null,true);
      empty($ids)?error('没有找到要删除的参数!'):'';
      $this->db->where_in('id',$ids['del'])->delete('member')? success('批量删除成功'):error('批量删除失败');
    }


    //会员信息
    public function info($id){
      $id = (int) $id;
      $data['member']  = $this->db->where('id',$id)->get('member')->row_array();
      $this->load->view('admin_info.html',$data);
    }

    //会员设置

    public function site(){
      $data = $this->db->get('member_site')->row_array();
      $this->load->view('admin_site.html',$data);
    }

    //会员设置处理
    public function site_s(){
      $data = $this->input->post(null,true);
      $this->db->update('member_site',$data)?success('会员设置修改成功！'):error('会员设置修改失败!');
    }


}