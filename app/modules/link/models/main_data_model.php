<?php  

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Link_Main_data_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
    
    //查询所有友情链接
	function select()
	{
      $data = $this->db->order_by('sort','asc')->order_by('id','asc')->get('link')->result_array();
	   return $data;
	}

    //删除
    public function del($id){
     return $this->db->delete('link',array('id'=>$id));

    }

    public function updata($id){
   
     return $this->db->get_where('link',array('id'=>$id))->row_array();
    }


}
