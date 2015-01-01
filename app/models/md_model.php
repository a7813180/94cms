<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
    
 
  class Md_model extends CI_Model{

     function __construct()
    {
        parent::__construct();
    }
    
    /*
        查询所有模型
     $arr  需要调用的字段
     $order 用那个字段排序
     $bY  倒序还是正序
    */

    public function md_select($arr,$order = NULL,$by=NULL){
        !empty($order) ? $order=$order :$order='id';
        !empty($by) ? $by=$by :$by='asc';
        $this->db->select($arr);
        $this->db->order_by($order,$by);
        $data=$this->db->get('model')->result_array();
        return $data;
     }

   

    /*
        查询指定模型表名
      $arr 需要查询的字段
      $mid 模型id
    */

    public function md_table($arr,$mid){
      $this->db->select($arr);
      $data=$this->db->get_where('model',array('id'=>$mid))->row_array();
      return $data;
    }


  }



?>