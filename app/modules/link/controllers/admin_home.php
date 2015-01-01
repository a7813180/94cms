<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Link_Admin_Home_module extends CI_Module {

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
        define('_APPURL_', 'module/link/admin_home'); //操作成功返回URL
    }

   public   function index()
	{
     $this->load->model('Main_data_model');
 
     $data['link']=$this->Main_data_model->select();
     $this->load->view('link_index.html',$data);
	}

    //删除
   public  function del()
    {
     $id = $this->uri->segment(5);
     $this->load->model('Main_data_model');
     $this->Main_data_model->del($id) ? success('删除成功!',_APPURL_) : error('删除失败');
    }
    

    //修改
   public function updata()
   {
   	$id = $this->uri->segment(5);
    $this->load->model('Main_data_model');
    $data['link'] = $this->Main_data_model->updata($id);
    $this->load->view('link_updata.html',$data);
   }

   
  //修改处理
   public function updata_s()
   {
    $data =  $this->input->post(null,true);
    unset($data['imgFile']);
    $id = $data['id'];
    !$id ? error_s('要修改的友情链接不存在!'): '';
    empty($data['title']) ? error_s('标题不可以为空!'): '';
    empty($data['url']) ? error_s('网址不可以为空!'): '';
    empty($data['sort']) ? $data['sort']=99: '';
    $this->db->update('link', $data, array('id' => $id)) ? success_s('修改成功',_APPURL_) : error_s('修改失败');
   }
 

  //添加
  public function add()
  {
    $this->load->view('link_add.html');
  }
  

  //添加处理
  public function add_s()
  { 
    $data = $this ->input ->post(null,true);
    unset($data['imgFile']);
    empty($data['title']) ? error_s('标题不可以为空!'): '';
    empty($data['url']) ? error_s('网址不可以为空!'): '';
    empty($data['sort']) ? $data['sort']=99: '';
    $this ->db ->insert('link',$data) ? success_s('添加成功',_APPURL_) : error_s('添加失败');
  }

  //批量更新顺序
  
  public function sort_s()
  {
    $data=$this->input->post(null,true);
    $data ?  '': error('亲！请先添加友情链接在操作更新栏目顺序哦！');
    foreach($data as $key=>$v){
    if($key!=='del'){
    $id=explode('_',$key);
    $this->db->where(array('id'=>$id['1']));
    $this->db->update('link',array('sort'=>$v));  
    }
    }
    success('更新成功',_APPURL_);
  }

 
  //批量删除
  public function del_s(){
    
    $id=$this->input->post('del',true);
    $id ?  '': error('要删除友情链接不存在！');
    foreach($id as $v){
      $this->db->delete('link',array('id'=>$v));
    }
    success("批量删除成功！",_APPURL_);

    }


 
}