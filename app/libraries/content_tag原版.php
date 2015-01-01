<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

 
  class content_tag{

     function __construct()
    {
       
    }
    


 
 
   public function _cate($arr)
    { 
     $ci =& get_instance();
     isset($arr['cid']) ? $arr['cid'] = (int)($arr['cid'])  : $arr['cid'] ='0';
     isset($arr['wap']) ? '' : $arr['wap'] = null;
     $field = "id,name,ename,litpic,pid,type,sort,modelid";
     empty($arr['field']) ? '' : $field =  $field.$arr['field'];
     $data = $ci->db->select($field)->order_by('sort',$arr['order'])->order_by('id','asc')->get_where('cate',array('status '=>'1',))->result_array();
     $ci->load->library('cate_class');
     $data= $ci->cate_class->zuhe_cate($data,$arr['cid'],$arr['num'],$arr['wap']);
     return $data;
    }





    //列表调用
    public function _list($arr,$page=null)
     {
    //查询本分类下面有没有下级分类，如果有分配到$ids里面
	$ci =& get_instance();
    $ci->load->model('Content_model', 'cont');
    $ci->load->library('Cate_class');
    $ci->load->model('Cate_Model', 'cate');
    $cate = $ci->cate->cate_select('id,pid,name');
    $cids = $ci->cate_class->fu_cate($cate, $arr['cid']);
    $cids[] = $arr['cid'];
 
    //输入cid得到模型id
    $modelid = $ci->db->select('modelid')->get_where('cate',array('id'=>$arr['cid']))->row_array();
    //得到数据表
    $tablename = $ci->db->select('tablename')->get_where('model',array('id'=>$modelid['modelid']))->row_array();

    //开始查询
    $tb=$tablename['tablename'];
	
	//判断是不是需要分页调用直接 return 所有文章整数
	if($page){
	   $ci->db->where_in($tb.'.cid',$cids);
	   return $ci->db->get_where($tb,array('status'=>0))->num_rows();
     }
	$select = $tb . ".id AS id," . $tb . ".cid AS cid," .
    "cate.name AS cname," . $tb . ".title AS title," . $tb.
    ".publishtime AS publishtime," . $tb . ".click AS click," . $tb .
    ".sort AS sort,".$tb.".litpic AS litpic,".$tb.".content AS content,".$tb.'.description AS description,'.$tb.'.shorttitle AS shorttitle,'. $tb . '.color as color,'.$tb.'.author AS author,'.$tb. '.keywords AS keywords,' . $tb . '.updatetime AS updatetime,'."cate.ename AS ename,"."cate.type AS type,"."cate.modelid AS modelid,";
    if (!empty($arr['field'])) {
    	//正则判断是不是有字段分隔符
    	if (preg_match("[,]", $arr['field'])){
    	//匹配出有，以分隔符变成数组 在循环写入 要输出的字段
         $arr['field']=explode(',',$arr['field']);
    	  foreach ($arr['field'] as $v) {
    	  	 $select = $select . $tb . '_data.' . $v. ' AS '.$v.',';
    	  }
    	}else{
         $select = $select . $tb . '_data.' . $arr['field']. ' AS '.$arr['field'];
    	}
    }
    

    //fenye
    if($arr['pagenum'] == '1' or empty($arr['pagenum'])){
        $pagenum = 0;
    }else{
        $pagenum = $arr['pagenum'] - 1;
        $pagenum = $arr['num'] * $pagenum;
		$ci->db->where_in($tb.'.cid',$cids);
	    $zs = $ci->db->get_where($tb,array('status'=>0))->num_rows();
	    $zys = ceil($zs/$arr['num']);
		 if($pagenum > $zys ){
		    $pagenum = $zys;
		 }
	
	//需要优化 数据多的话耗时  多查询了2次   所有记录
    }
    $ci->db->from($tb);
    $ci->db->limit($arr['num'],$pagenum);
     //fenye
    $ci->db->select($select);
    $ci->db->where($tb.'.status',0); //回收站
    $ci->db->where_in($tb.'.cid',$cids);
    $joina=$tb.".cid"."="."cate.id";
    $ci->db->join('cate', $joina,'LEFT');
    if(!empty($arr['field'])){
        $joina2 = $tb.'.id='.$tb.'_data.id';
        $ci->db->join($tb.'_data',$joina2,'LEFT');
    }
    $ci->db->order_by($tb.'.sort',"asc");
    $ci->db->order_by($tb.'.id',$arr['order']);
	
    $_list=$ci->db->get()->result_array();
    isset($arr['wap'])? $wap= true : $wap=null;
	$arr = array();
    foreach ($_list as $value) {
         $cate =array('id'=>$value['cid'],'type'=>$value['type'],'ename'=>$value['ename'],'modelid'=>$value['modelid']);
         $value['url']  = show_url($value,$wap);
         $value['curl'] = list_url($cate,$wap);
         $value['litpic'] = empty($value['litpic']) ? base_url('public/nopic.jpg') : base_url($value['litpic']);
         $arr[]= $value;
    }

     return $arr;
   }

   
   //分页
   public function page($ename,$cid,$pagenum,$total,$num,$style,$wap=null)
   {
    empty($wap)? $wap='': $wap = 'wap/';
    $ci =& get_instance();
    $ci->load->library('page_class');
    $ci->page_class->minupage(array('total'=>$total,'perpage'=>$num));
    if(!$ename){
    $ci->page_class->_set_url($wap.'list_view_'.$cid.'_');
    }else{
    $ci->page_class->_set_url($wap.$ename.'/list_');
    }
    $ci->page_class->_set_nowindex($pagenum);
    return $ci->page_class->show($style);
   }

   

   //srclist 全局文章调用
   public function _arclist($arr)
   {
    $ci =& get_instance();
    if(isset($arr['cid']))
    {
     $ci->load->model('Content_model', 'cont');
     $ci->load->library('Cate_class');
     $ci->load->model('Cate_Model', 'cate');
     $cate = $ci->cate->cate_select('id,pid,name');
     $cids = $ci->cate_class->fu_cate($cate, $arr['cid']);
     $cids[] = $arr['cid'];
     //输入cid得到模型id
     $modelid = $ci->db->select('modelid')->get_where('cate',array('id'=>$arr['cid']))->row_array();
     $arr['modelid'] = $modelid['modelid'];
   }
    //得到数据表
    $tablename = $ci->db->select('tablename')->get_where('model',array('id'=>$arr['modelid']))->row_array();
    $tb=$tablename['tablename'];
    if($tb == 'page'){
    	return '';
    }
    
    $select = $tb . ".id AS id," . $tb . ".cid AS cid," .
    "cate.name AS cname," . $tb . ".title AS title," . $tb.
    ".publishtime AS publishtime," . $tb . ".click AS click," . $tb .
    ".sort AS sort,".$tb.".litpic AS litpic,".$tb.".content AS content,".$tb.'.description AS description,'.$tb.'.shorttitle AS shorttitle,'. $tb . '.color as color,'.$tb.'.author AS author,'.$tb. '.keywords AS keywords,' . $tb . '.updatetime AS updatetime,'."cate.ename AS ename,"."cate.type AS type,"."cate.modelid AS modelid,";
    if (!empty($arr['field'])) {
    	//正则判断是不是有字段分隔符
    	if (preg_match("[,]", $arr['field'])){
    	//匹配出有，以分隔符变成数组 在循环写入 要输出的字段
         $arr['field']=explode(',',$arr['field']);
    	  foreach ($arr['field'] as $v) {
    	  	 $select = $select . $tb . '_data.' . $v. ' AS '.$v.',';
    	  }
    	}else{
         $select = $select . $tb . '_data.' . $arr['field']. ' AS '.$arr['field'];
    	}
    }

    $ci->db->from($tb);
    $ci->db->select($select);
    $ci->db->where($tb.'.status',0); //回收站
    //判断有没有cid
    if (isset($arr['cid'])) {
    	$ci->db->where_in($tb.'.cid',$cids);
    }


    //判断有没有略缩图
    if(isset($arr['litpic'])){
    	if($arr['litpic'] == 'true'){
    		$ci->db->where($tb.'.litpic !=','');
    	}
    }
    $joina=$tb.".cid"."="."cate.id";
    $ci->db->join('cate', $joina,'LEFT');
    //如果需要调用自定义字段 关联附表
    if(isset($arr['field'])){
        $joina2 = $tb.'.id='.$tb.'_data.id';
        $ci->db->join($tb.'_data',$joina2,'LEFT');
    }

    //以什么属性进行排序
    if(isset($arr['sort'])){
    	$ci->db->order_by($arr['sort'],$arr['order']);
    }else{
    	$ci->db->order_by("id",$arr['order']);
    }

    //判断调用数目
    if (isset($arr['limit'])) {
    	$ci->db->limit($arr['num'],$arr['limit']);
    }else{
    	$ci->db->limit($arr['num']);
    }

    $_arclist=$ci->db->get()->result_array();
    isset($arr['wap'])? $wap= true : $wap=null; //判断是不是手机都用
    $arr = array();
    foreach ($_arclist as $value) {

         $value['url']  = show_url($value,$wap);
         $value['curl'] = list_url($value,$wap);
         $value['litpic'] = empty($value['litpic']) ? base_url('public/nopic.jpg') : base_url($value['litpic']);
         $arr[]= $value;
    }

     return $arr;

   } 
   


   //TAG调用

   public function _tag($arr)
   {
     $ci =& get_instance();
     isset($arr['sort']) ? '' :$arr['sort'] = 'id';
     isset($arr['order']) ? '' :$arr['order'] = 'desc';
     isset($arr['num']) ? '' :$arr['num'] = '10';
     $data = $ci->db->order_by($arr['sort'],$arr['order'])->limit($arr['num'])->get('tag')->result_array();
     $arr =array();
     config_item('index_page') ? $fuhao = "/" : $fuhao = '';
     foreach ($data as $v) {
             $v['url'] = site_url().$fuhao.'tag/'.$v['title'];
             $arr[] = $v;
      }
       return $arr;
 
   
   }





 }
?>
