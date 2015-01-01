<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

 
  class Content_model extends CI_Model{

     function __construct()
    {
        parent::__construct();
    }
    

    //调用内容列表专用
    /*
    $ARR 需要调用的字段
    $tablename  需要调用内容的表名
    $Cid 分类id
    $order 排序的字段
    $by  排序
    */
    public function Content_select($arr,$tablename,$cid,$order = NULL,$by = NULL,$jg = NULL,$ids = NULL,$laji = NULL){
    	if($tablename == 'page'){
        $this->db->select($arr);
        $data=$this->db->get_where('cate',array('id'=>$cid))->row_array();
        }else{
        !empty($order) ? $order=$order :$order='sort';
        !empty($by) ? $by=$by :$by='asc';
        $this->db->select($arr);
    	  $this->db->from($tablename);
        $laji ? $this->db->where($tablename.'.status',1) : $this->db->where($tablename.'.status',0);
        $this->db->where_in($tablename.'.cid',$ids);
        $joina=$tablename.".cid"."="."cate.id";
        $this->db->join('cate', $joina,'LEFT');
        $this->db->order_by($tablename.'.'.$order,$by);
        $this->db->order_by("id", "desc");
      
        if(!$jg){
           $data=$this->db->get()->result_array(); 
        }else{
           $data=$this->db->get()->$jg();   
        }
        

        }
        return $data;

    }
      
    //获取自定义字段
    public function diyfield($mid){
     $tada=$this->db->order_by('sort','asc')->order_by('id','asc')->get_where("model_field",array('modelid '=>$mid,'status'=>'1'))->result_array();
     return($tada);

    }


    //获取内容的关联模型
    public function content($tablename,$id){
     $joina=$tablename.".id"."=".$tablename.'_data'.'.id';   
     $data=$this->db->from($tablename)->join($tablename.'_data',$joina,'left')->where(array($tablename.'.id'=>$id))->get()->row_array();
     return($data);
    }

    
    //搜索调用

    public function search($tb,$q,$type,$tnum=null){

     $select = $tb . ".id AS id," . $tb . ".cid AS cid," .
    "cate.name AS cname," . $tb . ".title AS title," . $tb.
    ".publishtime AS publishtime," . $tb . ".click AS click," . $tb .
    ".sort AS sort,".$tb.".litpic AS litpic,".$tb.'.description AS description,'.$tb.'.shorttitle AS shorttitle,'. $tb . '.color as color,'.$tb.'.author AS author,'.$tb. '.keywords AS keywords,' . $tb . '.updatetime AS updatetime,'."cate.ename AS ename,"."cate.type AS type,"."cate.modelid AS modelid,";
         $this->db->from($tb);
      
         $this->db->select($select);
         $this->db->where($tb.'.status','0'); //回收站
         $this->db->like($tb.'.title',$q);
         $this->db->or_like($tb.'.description',$q);
         $joina=$tb.".cid"."="."cate.id";
         $this->db->join('cate', $joina,'LEFT');
         $this->db->order_by($tb.'.id','desc');
         if(isset($tnum)){
          return $this->db->get()->num_rows();
         }
         $_list = $this->db->get()->result_array();
         $arr = array();
         foreach ($_list as $value) {
         $value['title'] = GetRedKeyWord($q,$value['title']);
         $value['description'] = GetRedKeyWord($q,$value['description']);
         $value['url']  = show_url($value);
         //需要优化cid_url  太浪费资源
         $value['curl'] = list_url($value);
         $value['litpic'] = empty($value['litpic']) ? base_url('public/nopic.jpg') : base_url($value['litpic']);
         $arr[]= $value;
          }
         return $arr;
         }


    
    //tag

     public function tag($tb,$sid)
     {
       $select = $tb . ".id AS id," . $tb . ".cid AS cid," .
    "cate.name AS cname," . $tb . ".title AS title," . $tb.
    ".publishtime AS publishtime," . $tb . ".click AS click," . $tb .
    ".sort AS sort,".$tb.".litpic AS litpic,".$tb.'.description AS description,'.$tb. '.keywords AS keywords,' . $tb . '.updatetime AS updatetime,'."cate.ename AS ename,"."cate.type AS type,"."cate.modelid AS modelid,";
       $this->db->select($select);//->get_where($tb,array('id'=>$sid))->row_array();
       $this->db->from($tb);
       $this->db->where($tb.'.id',$sid);
       $this->db->join('cate', 'cate.id ='. $tb.'.cid');
       $this->db->order_by('id','desc');
       $data = $this->db->get()->row_array();
       $data['url'] = show_url($data);
       $data['curl'] = list_url($data);
      return $data;
     }


  }
?>