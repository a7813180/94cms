<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

 
  class Tag_model extends CI_Model{

     function __construct()
    {
        parent::__construct();
    }
    


   //分类调用
    public function cate($arr)
    { 
     $field = "id,name,ename,litpic,pid,type,sort,modelid";
     empty($arr['field']) ? '' : $field =  $field.$arr['field'];
     $data = $this->db->select($field)->order_by('sort',$arr['order'])->order_by('id',$arr['order'])->get_where('cate',array('status '=>'1',))->result_array();
     $this->load->library('cate_class');
     $data= $this->cate_class->zuhe_cate($data,$arr['pid'],$arr['num']);
     return $data;
    }

   

   //当前位置
    public function weizhi($cid){
     $data = $this->db->select('id,name,ename,type,modelid,pid')->get_where('cate',array('status '=>'1',))->result_array();
     $this->load->library('cate_class');
     $cate = $this->cate_class->get_parent($data,$cid);
     $weizhi = "<a href='".site_url()."'>".'主页'."</a>";
     foreach ($cate as $v) {
          $arr = "<a href='".$v['url']."'>".$v['name']."</a>";
          $weizhi = $weizhi."&gt;".$arr;
     }
     return $weizhi;
    }



    //列表调用
    public function _list($arr,$page=null)
     {
    //查询本分类下面有没有下级分类，如果有分配到$ids里面
    $this->load->model('Content_model', 'cont');
    $this->load->library('Cate_class');
    $this->load->model('Cate_Model', 'cate');
    $cate = $this->cate->cate_select('id,pid,name');
    $cids = $this->cate_class->fu_cate($cate, $arr['cid']);
    $cids[] = $arr['cid'];
    //输入cid得到模型id
    $modelid = $this->db->select('modelid')->get_where('cate',array('id'=>$arr['cid']))->row_array();
    //得到数据表
    $tablename = $this->db->select('tablename')->get_where('model',array('id'=>$modelid['modelid']))->row_array();

    //开始查询
    $tb=$tablename['tablename'];
    $select = $tb . ".id AS id," . $tb . ".cid AS cid," .
    "cate.name AS cname," . $tb . ".title AS title," . $tb.
    ".publishtime AS publishtime," . $tb . ".click AS click," . $tb .
    ".sort AS sort,".$tb.".litpic AS litpic,".$tb.'.description AS description,'.$tb.'.shorttitle AS shorttitle,'. $tb . '.color as color,'.$tb.'.author AS author,'.$tb. '.keywords AS keywords,' . $tb . '.updatetime AS updatetime,';
    if (!empty($arr['field'])) {
        $select = $select . $tb . '_data.' . $arr['field']. ' AS '.$arr['field'];
    }
    
    $this->db->from($tb);
    //fenye
    
    if($arr['pagenum'] == '1' or empty($arr['pagenum'])){
        $pagenum = 0;
    }else{
        $pagenum = $arr['pagenum'] - 1;
        $pagenum = $arr['num'] * $pagenum;
    }
    $this->db->limit($arr['num'],$pagenum);
     //fenye
    $this->db->select($select);
    $this->db->where($tb.'.status',0); //回收站
    $this->db->where_in($tb.'.cid',$cids);
    $joina=$tb.".cid"."="."cate.id";
    $this->db->join('cate', $joina,'LEFT');
    if(!empty($arr['field'])){
        $joina2 = $tb.'.id='.$tb.'_data.id';
        $this->db->join($tb.'_data',$joina2,'LEFT');
    }
    $this->db->order_by($tb.'.sort',"asc");
    $this->db->order_by($tb.'.id',$arr['order']);

    $_list=$this->db->get()->result_array();
    return $_list;
   }

   
   //分页
   public function page($ename,$cid,$pagenum)
   {
    $this->load->library('page_class');
    $this->page_class->minupage(array('total'=>'1000'));
    if(!$ename){
    $this->page_class->_set_url('list_view_'.$cid.'_');
    }else{
    $this->page_class->_set_url($ename.'/list_');
    }
    $this->page_class->_set_nowindex($pagenum);
    return $this->page_class->show(4);
   }



 

 }
?>