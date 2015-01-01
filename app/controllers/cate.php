<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cate extends My_Controller {
    //构造函数
    public function __construct() {
        parent::__construct();
        $this->is_view(); //引入模板引擎和自定义配置类
        $this->is_mobile(); //判断pc或者手机
    }
    //首页
    public function index($cid, $pagenum = 1) {
        if (is_numeric($cid)) {
            $cid = (int)($cid);
            $list = $this->db->get_where('cate', array(
                'id' => $cid
            ))->row_array();
        } else {
            $list = $this->db->get_where('cate', array(
                'ename' => $cid
            ))->row_array();
        }
        if (empty($list) || $list['modelid'] == '1' || $list['status'] == '0') {
            show_error('列表不存在!');
        }
        $data['catename'] = $list['seotitle'] ? $list['seotitle'] : $list['name'];
        $data['catekey'] = $list['keywords'];
        $data['catedes'] = $list['description'];
        $data['cateurl'] = list_url($list);
        $data['ename'] = $list['ename'];
        $data['cid'] = $list['id'];
        $data['tcid'] = tcid($data['cid']);
        empty($pagenum) ? $data['pagenum'] = 0 : $data['pagenum'] = (int)($pagenum);
        $template = $list['template_index'] ? $list['template_index'] :$list['template_list'];
        $this->view($template, $data);
    }
}
?>
