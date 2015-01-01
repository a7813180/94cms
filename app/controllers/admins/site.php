<?php
if (!defined('BASEPATH')) {
    die('No direct script access allowed');
}
class Site extends MY_Controller {
    //系统设置
    public function __construct() {
        parent::__construct();
        $this->is_login();
    }
    public function index() {
        //$this->config->set_item('gbook','wwww')? success('OK'): error('sb');
        $this->load->helper('directory');
        $map = directory_map(FCPATH . 'template', 1);
        $data['template'] = $map;
        $data['diyconf'] = $this->db->get('diyconf')->result_array();
        $this->load->view('admin/site.html', $data);
    }
    public function index_s() {
        $data = $this->input->post();
        //判断如果修改模板，如果修改删除编译过的前台模板文件
        if($data['template'] != C('template')){
            $this->load->helper('file');
            delete_files(FCPATH . APPPATH . DS . 'views'.DS.'index');
        }
        $data = '<?php if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\'); $config[\'tm\']=' . array2string($data) . ';?>';
        $flie = FCPATH . APPPATH . 'config' . DS . 'diy.php';
        file_put_contents($flie, $data) ? success('修改成功') : error('修改失败请检查权限！');
    }
    //核心设置
    public function site_s() {
        $data = $this->input->post();
        switch ($data['url']) {
          case '1':
            $data['index_page'] = 'index.php';
            $data['html'] ='false';
            break;
          case '2':
            $data['index_page'] = '';
            $data['html'] ='false';
            break;
          case '3':
            $data['index_page'] = 'index.php';
            $data['html'] ='true';
            break;
        }
        
        $arr = '<?php if (!defined(\'BASEPATH\')) exit(\'No direct script access allowed\');';
        foreach ($data as $key => $v) {
            $arr = $arr . '$config[\'' . $key . '\'] = ' . '\'' . $v . '\';';
        }
        $arr = $arr . '?>';
        $flie = FCPATH . APPPATH . 'config' . DS . 'site.php';
        file_put_contents($flie, $arr) ? success('修改成功') : error('修改失败请检查权限！');
    }
    //清楚缓存
    public function del_cache() {
        $this->load->helper('file');
        delete_files(FCPATH . APPPATH . DS . 'cache') ? success('缓存清楚成功!', APP_ADMIN . '/home/homes') : error('删除失败请检查权限', APP_ADMIN . '/home/homes');
    }
   
   //添加自定义
    public function diyconf_s(){
      $diydata = $this->input->post(null,true);
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->form_validation->set_rules('name', '别名', 'required');
      $this->form_validation->set_rules('field', '字段', 'required|alpha_dash');
      if ($this->form_validation->run() == FALSE){
       $msg = validation_errors();
       error($msg);
      }
      $data= config_item('tm');
      $diydata['field'] = 'web_'.$diydata['field'];
      $data[$diydata['field']] = '';
      $data = '<?php if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\'); $config[\'tm\']=' . array2string($data) . ';?>';
      $flie = FCPATH . APPPATH . 'config' . DS . 'diy.php';
      file_put_contents($flie, $data);
      $this->db->insert('diyconf',$diydata) ? success('添加成功') : error('添加失败');
     }
    
    //删除
    public function diyconf_sc($id){
     empty($id) ?success('id不可以为空') :'';
     $id = (int)($id);
     $this->db->delete('diyconf',array('id'=>$id)) ? success('删除成功') :error('删除失败');
    }


}

