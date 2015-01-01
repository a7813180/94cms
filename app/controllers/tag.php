<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tag extends My_Controller {
    //构造函数
    public function __construct() {
        parent::__construct();
        $this->is_view(); //引入模板引擎和自定义配置类
        
    }
    public function index($tag = NULL) {
        if (isset($tag)) {
            $tag = rawurldecode($tag);
            $tag = safe_replace($tag);
            $data = $this->db->get_where('tag', array(
                'title' => $tag
            ))->row_array();
            if (empty($data)) {
                show_error('TAG不存在!');
            }
            $list = $this->db->get_where('tag_content', array(
                'tid' => $data['id'],
               // 'mid' => '2'
            ))->result_array();
            if (empty($list)) {
                show_error('TAG不存在!');
            }
            $this->load->model('content_model', 'content');
            $taglist = array();
            $tao = 0;
            foreach ($list as $v) {
                $tablename = $this->db->select('tablename')->get_where('model',array('id'=>$v['mid']))->row_array();
                $tb = $tablename['tablename'];
               // $tb = 'news';
                $tao++;
                $taglist[] = $this->content->tag($tb, $v['sid']);
            }
            //当前页数
            $page = isset($_GET['page']) ? ceil($_GET['page']) : '0';
            //每页分多少条
            $myts = 5;
            //一共多少页
            $zys = ceil($tao/$myts);
            //分配数据
            $taglist = $this->page_array($myts,$page,$taglist,'1');

            $data['taglist'] = $taglist;
            $data['page'] = $this->show_page($zys,site_url().'/tag/'.$tag);
            $data['title'] = $tag;
            $this->view('tag.html', $data);
        } else {
            $data = $this->db->order_by('id', 'desc')->get('tag')->result_array();
            $arr = array();
            foreach ($data as $v) {
                $v['url'] = site_url() . '/tag/' . $v['title'];
                $arr[] = $v;
            }
            if (empty($arr)) {
                $arr = false;
            }
            $data['taglist'] = $arr;
            $data['title'] = 'TAG列表';
            $this->view('tag_list.html', $data);
        }
    }

    
    protected function page_array($count,$page,$array,$order){  
       global $countpage; #定全局变量  
       $page=(empty($page))?'1':$page; #判断当前页面是否为空 如果为空就表示为第一页面   
       $start=($page-1)*$count; #计算每次分页的开始位置  
       if($order==1){  
       $array=array_reverse($array);  
       }     
       $totals=count($array);    
       $countpage=ceil($totals/$count); #计算总页面数  
       $pagedata=array();  
       $pagedata=array_slice($array,$start,$count);  
       return $pagedata;  #返回查询数据  
    }  
    
    /**
    * 分页及显示函数
    * $countpage 全局变量，照写
   * $url 当前url
    */
    protected  function show_page($countpage,$url){
     $page=empty($_GET['page'])?1:$_GET['page'];
	 if($page > 1){
	   	$uppage=$page-1;

	 }else{
	 	$uppage=1;
	 }

	 if($page < $countpage){
	   	$nextpage=$page+1;
     }else{
	    $nextpage=$countpage;
	 }
	   
    $str='<div style="border:1px; width:300px; height:30px; color:#9999CC">';
	$str.="<span>共  {$countpage}  页 / 第 {$page} 页</span>";
	$str.="<span><a href='$url?page=1'>   首页  </a></span>";
	$str.="<span><a href='$url?page={$uppage}'> 上一页  </a></span>";
	$str.="<span><a href='$url?page={$nextpage}'>下一页  </a></span>";
	$str.="<span><a href='$url?page={$countpage}'>尾页  </a></span>";
	$str.='</div>';
	return $str;
    }






}
?>
