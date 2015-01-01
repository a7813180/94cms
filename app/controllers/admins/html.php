<?php
if (!defined('BASEPATH')) {
    die('No direct script access allowed');
}
//生成静态
class Html extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->is_login();
        $this->load->library('thtml');
       // if(config_item('url')!=3){ error('URL模式不是静态模式!请先设置为静态在生成！');}
    }
    
    //列表生成
    public function cate(){
      $data['cate'] = $this->db->select('id,name,modelid,pid,template_index,template_list')->where('status !=','0')->where('type','0')->where('modelid !=','1')->get_where('cate',array('status'=>1))->result_array();
      $this->load->view('admin/html_cate.html',$data);

    }

    //列表生成处理
    public function cate_s(){
        $data = $this->input->get(null,true);
        $cates= $this->db->select('id,ename,modelid,pid,template_index,template_list')->where('status !=','0')->where('type','0')->where('modelid !=','1')->get_where('cate',array('status'=>1))->result_array();
        $this->thtml->schtml_all('cate','index',$cates,$cates)?success('列表全部生成成功！！',APP_ADMIN.'/home/homes'):error('列表生成失败');
        //$this->thtml->schtml_all('show','index',$shows,$shows)?success('内容生成成功',APP_ADMIN.'/home/homes'):error('列表生成失败');
    }

    //单篇生成
    public function page(){
       $pages = $this->db->select('id,ename,modelid,pid,template_index,template_list')->where('type','0')->where('modelid','1')->get_where('cate',array('status'=>1))->result_array();
       $this->thtml->schtml_all('page','index',$pages,$pages);
    }


   //内容页生成
   public function show(){

       $this->db->from('cate');
       $this->db->select('cate.id AS id,cate.ename AS ename,model.tablename AS tablename,cate.name AS name');
       $this->db->join('model','model.id=cate.modelid');
       $this->db->where('cate.type','0')->where('cate.modelid !=','1');
       $shows=$this->db->get()->result_array();
       foreach ($shows as $v) {
       	  $content = $this->db->select('id,title,cid')->get_where($v['tablename'],array('cid'=>$v['id']))->result_array();
          $this->thtml->schtml_all('show','index',$content,$v);
       }
 
      success('内容页全部生成成功',APP_ADMIN.'/home/homes');

   }

   public function mysqls(){
      $title = "这是一篇测试新闻哦！--". rand(10000000,10000000000000000);
      $content = createRandomCode(100);
 
      $data = array(
         'title' =>$title,
         'content' => $content,
         'publishtime'=>time(),
         'cid' => '10',
      	);
      for ($i=0; $i <10000 ; $i++) { 
        $this->db->insert('product',$data);
      }
      

   }

}