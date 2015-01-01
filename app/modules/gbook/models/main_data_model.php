<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gbook_Main_data_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
    
    //回复
	public function updata($id)
	{
       return $this->db->select('id,title,content,admin_content,lock')->get_where('gbook',array('id'=>$id))->row_array();
	}

    //删除
    public function del($id){
     return $this->db->delete('gbook',array('id'=>$id));
    }

}
