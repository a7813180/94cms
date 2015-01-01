<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

 
  class module_tag{

     function __construct()
    {
       
    }

   //幻灯片
   public function _slide($arr)
    { 
     $ci =& get_instance();
     isset($arr['cid']) ? '': $arr['cid']='0';
     $data = $ci->db->order_by('sort','asc')->get_where('slide',array('cid'=>$arr['cid']))->result_array();
     $datas = array();
     foreach ($data as $v) {
      $v['pic'] =  $v['pic'] ? base_url($v['pic']) :  base_url('public')."/nopic.jpg";
        $datas[] = $v;
     }
     return $datas;
    } 
  
   //友情链接
   public function _link($arr){
     $ci =& get_instance();
     isset($arr['cid']) ? '': $arr['cid']='0';
     $data = $ci->db->order_by('sort','asc')->get_where('link',array('cid'=>$arr['cid']))->result_array();
     return $data;
   }

  //评论

   public function _comm($arr){
    $ci =& get_instance();
    if(!$arr['cid'] && !$arr['sid']){ return '';}
    $cid = (int)($arr['cid']);
    $sid = (int)($arr['sid']);
    $data = $ci->db->select('id,name,content,time')->order_by('id','desc')->get_where('comment',array('cid'=>$cid,'sid'=>$sid))->result_array();
    return $data;
   }



 }
?>
