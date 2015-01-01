<?php


if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends My_Controller {
    /*
     判断
    
    */
    public function __construct() {
        parent::__construct();
        $this->is_login();
    }
    //鍚庡彴
    public function index() {
        $this->load->view('admin/index.html');
    }
    //后台首页头部
    public function top() {
        $this->load->view('admin/top.html');
    }
    public function homes() {
        $this->load->view('admin/home.html');
    }
    //后台首页left
    public function left() {
        $where = array(
            'type' => 0,
            'status' => 1
        );
        $this->load->model('Cate_model', 'cate');
        $this->db->where($where);
        $this->db->order_by('sort', 'asc');
        $this->db->order_by('id', 'asc');
        $data = $this->cate->cate_select('*', 'sort', 'asc');
        $this->load->library('cate_class');
        $data['cate'] = $this->cate_class->fu_cate_nr($data, 0);
        //自定义模块菜单
        $path = FCPATH . 'app' . DS . 'modules' . DS; //插件根目录路径
        $this->load->helper('directory');
        $_data = directory_map($path);
        $sj = array();
        foreach ($_data as $key => $v) {
            $_path = $path . $key . DIRECTORY_SEPARATOR . 'index.xml';
            if (file_exists($_path)) {
                $con = simplexml_load_file($_path);
                $con = ob2ar($con); //对象转为数组
                file_exists($path . $key . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'install.lock') ? $install = 'true' : $install = 'false';
                if ($install === 'true' && $con['nav'] === '1') {
                    $arr = array(
                        'name' => $key,
                        'title' => $con['title'],
                    );
                    $sj[] = $arr;
                }
            }
        }
        $data['modules'] = $sj;
        //判断会员模块是不是已经安装
        $data['member'] = file_exists($path.'member/controllers/install.lock');
        $this->load->view('admin/left.html', $data);
    }
}
?>
