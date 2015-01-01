<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 分类模型
 */

class Cate_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    /*
    所有分类查询
    $arr 要查询那么字段
    $order 排序以那个字段
    $by  正序还是倒序

    */
    //所有分类
    function cate_select($arr,$order = NULL,$by=NULL){
    	  !empty($order) ? $order=$order :$order='id';
        !empty($by) ? $by=$by :$by='asc';
        $this->db->select($arr);
        $this->db->order_by($order,$by);
        $data=$this->db->get('cate')->result_array();
        return $data;
    }



   //栏目关联模型 如果 $where 为真返回数组  相反返回 数组集
   function cate_models($where=NULL){
      $as ="cate.id AS id,cate.name AS name,cate.ename AS ename,cate.pid AS pid,cate.type AS type,cate.seotitle AS seotitle,cate.keywords AS keywords,cate.description AS description,cate.modelid AS modelid,cate.template_index AS template_index,cate.template_list AS template_list,cate.template_show AS template_show,cate.status AS status,cate.sort AS sort,cate.litpic AS litpic,model.name AS modelname,model.tablename AS tablename";
      $this->db->select($as);
      if($where){$this->db->where($where);}
      $this->db->order_by('cate.sort','asc');
      $this->db->order_by("id", "asc");
      $this->db->from('cate');
      $this->db->join('model', 'cate.modelid = model.id','left');
      if($where){
        $data = $this->db->get()->row_array();
      }else{
        $data = $this->db->get()->result_array();
      }
        return $data;
      }
  

   //输入一个id调用本id所有内容，适用于单页模型

   function cid_page($cid){
    $data=$this->db->get_where('cate',array('id'=>$cid))->row_array();
     return $data;
   }
    
   
   //输入id调用出来本分类的表名

   function tablename_cid($cid){

    $mid=$this->db->select('modelid')->get_where('cate',array('id'=>$cid))->row_array();
    $mid=$mid['modelid'];
    $tablename=$this->db->select('tablename')->get_where('model',array('id'=>$mid))->row_array();
    return $tablename['tablename'];
   } 


   //输入一个id调用本id 查询需要的内容

   function name_cid($cid){
    $data=$this->db->select('id,name')->get_where('cate',array('id'=>$cid))->row_array();
    return $data;
   }
    
    
}
?>