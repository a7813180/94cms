<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class   Sql_Admin_home_module extends CI_Module {

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
        define('_APPURL_', 'module/sql/admin_home'); 
       
	}
    
    //首页
	public function index()
	{  
       $data['model'] = $this->db->select('sort,name,tablename,id,lock')->order_by('sort','asc')->get_where('model',array('lock'=>'1','id >'=>'1'))->result_array();
       $this->load->view('sql_index.html',$data);
	}
    
    public function sql_s(){
       $sql = $this->input->post('sql');
       empty($sql)? error('请输入sql语句！') :'';
       $this->db->simple_query($sql) ?success('sql执行成功') : error('sql语句错误');

    }

    public function th_s(){
    $data = $this->input->post(null,true);
    empty($data['tablename']) ? error('模型不可以为空'): '';
    empty($data['field']) ? error('字段不可以为空') :'';
    empty($data['content']) ?error('要查找的内容不可以为空') :'';
    
    foreach ($data['tablename'] as $v) {
      $tablename = $data['table'] ? $v : $v."_data";
      $tablename = $this->db->protect_identifiers($tablename,true);
      $sql = "update ".$tablename." set ".$data['field']." = REPLACE(".$data['field'].",'".$data['content']."','".$data['content_ok']."');";
      if($this->db->simple_query($sql)){
       echo $tablename." Success;"."<br/>" ;
      } else{
        echo $tablename." Error!"."<br/>";
      }
     }
     success('替换完成!');
  }
 

}