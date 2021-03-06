<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Page extends My_Controller {
    //构造函数
    public function __construct() {
        parent::__construct();
        $this->is_view(); //引入模板引擎和自定义配置类
        $this->is_mobile(); //判断pc或者手机
        
    }
    //单篇
    public function index($cid, $page = null) {
        if (is_numeric($cid)) {
            $list = $this->db->get_where('cate', array(
                'id' => $cid
            ))->row_array();
        } else {
            $list = $this->db->get_where('cate', array(
                'ename' => $cid
            ))->row_array();
        }
        if (empty($list) or $list['modelid'] != '1') {
            show_error('单篇不存在!');
        }
        $data['catename'] = $list['seotitle'] ? $list['seotitle'] : $list['name'];
        $data['catekey'] = $list['keywords'];
        $data['catedes'] = $list['description'];
        $list['litpic'] = $list['litpic'] ? base_url($list['litpic']) : base_url('public/nopic.jpg');;
        $data['page'] = $list;
        $data['cid'] = $list['id'];
        $data['tcid'] = tcid($data['cid']); //父类id
        $this->view($list['template_list'], $data);
    }
}
?>
