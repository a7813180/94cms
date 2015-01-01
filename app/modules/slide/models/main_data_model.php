<?php  

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Slide_Main_data_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
    
    //查询所有友情链接
	function select($cid)
	{ 
      $data = $this->db->order_by('sort','asc')->order_by('id','asc')->get_where('slide',array('cid' => $cid))->result_array();
	   return $data;
	}

    //删除
    public function del($id){
     return $this->db->delete('slide',array('id'=>$id));

    }

    
    public function updata($id){
   
     return $this->db->get_where('slide',array('id'=>$id))->row_array();
    }


}
