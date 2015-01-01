<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Wap_Show_module  extends CI_Module {
    //构造函数
    public function __construct() {
        parent::__construct();
        $this->is_view(); //引入模板引擎和自定义配置类
        $this->is_mobil(); //判断手机网站关闭还是开启
        $lock = dirname(__FILE__).DS.'install.lock';
        if(!file_exists($lock)){ show_error('请先安装本模块！');}
        define('_APPURL_', 'module/wap/home'); 
    }
    //内容首页
    public function index($cid, $id) {
 
        if (!isset($cid) && !isset($id)) {
            show_error('内容页不存在!');
        } else {
            if (is_numeric($cid)) {
                $cid = (int)($cid);
                $id = (int)($id);
                $_cate = $this->db->get_where('cate', array(
                    'id' => $cid
                ))->row_array();
                //判断如果是用默认的链接进入 自定义uel不为空，抛出内容页不存在!
                empty($_cate['ename']) ? '' : show_error('内容不存在!');
            } else {
                $_cate = $this->db->get_where('cate', array(
                    'ename' => $cid
                ))->row_array();
            }
            if (empty($_cate) || $_cate['modelid'] == '1' || $_cate['status'] == '0') {
                show_error('内容不存在！');
            }
            $tablename = $this->db->select('tablename')->get_where('model', array(
                'id' => $_cate['modelid']
            ))->row_array();
            //开始查询
            $tb = $tablename['tablename'];
            $_cid = $this->db->select('cid,status')->get_where($tb, array(
                'id' => $id
            ))->row_array();
            if (empty($_cid) || $_cate['id'] != $_cid['cid'] || $_cid['status'] == '1') {
                show_error('内容不存在!');
            }
            $diyfield_num = $this->db->get_where('model_field', array(
                'modelid' => $_cate['modelid']
            ))->num_rows();
            if ($diyfield_num == '0') {
                $show = $this->db->get_where($tb, array(
                    'id' => $id
                ))->row_array();
            } else {
                //存在自定义自动关联附表
                $joina = $tb . ".id" . "=" . $tb . '_data' . '.id';
                $show = $this->db->from($tb)->join($tb . '_data', $joina, 'left')->where(array(
                    $tb . '.id' => $id
                ))->get()->row_array();
            }
            $data = $show;
            $data['litpic'] = base_url($show['litpic']);
            $data['cid'] = $_cate['id'];
            $data['tcid'] = tcid($data['cid']); //父类id
            $data['catename'] = $_cate['name'];
            $data['cateurl'] = list_url($_cate);
            //上一条
            $shang = $this->db->select('cid,title,id,sort')->where('cid', $_cate['id'])->limit(1)->order_by('id', 'asc')->get_where($tb, array(
                'id >' => $id
            ))->row_array();
            if (!empty($shang)) {
                $shang['ename'] = $_cate['ename'];
                $shang['cid'] = $_cate['id'];
                $shang['url'] = show_url($shang);
                $_shang = "<a href=" . $shang['url'] . ">" . $shang['title'] . "</a>";
            } else {
                $_shang = '第一条';
            }
            //下一篇
            $xia = $this->db->select('cid,title,id,sort')->where('cid', $_cate['id'])->limit(1)->order_by('id', 'desc')->get_where($tb, array(
                'id <' => $id
            ))->row_array();
            if (!empty($xia)) {
                $xia['ename'] = $_cate['ename'];
                $xia['url'] = show_url($xia);
                $_xia = "<a href=" . $xia['url'] . ">" . $xia['title'] . "</a>";
            } else {
                $_xia = '最后一条';
            }
            $data['prev'] = $_shang;
            $data['next'] = $_xia;
            $data['url'] = get_url();
            $tag = explode(',', $show['keywords']);
            $data['tag'] = '';
            foreach ($tag as $v) {
                $data['tag'] = $data['tag'] . "<a target='_blank' href=" . site_url() . '/tag/' . $v . ">" . $v . "</a>" . "&nbsp;&nbsp;";
            }
            //判断内容页是不是又自定义模板
            //$data['template_show'] ? $template_show = $data['template_show'] : $template_show = $_cate['template_show_wap'];
            $this->wap_view($_cate['template_show_wap'], $data);
        }
    }
    //点击
    public function click($cid, $id) {
        $cid = (int)($cid);
        $id = (int)($id);
        $_cate = $this->db->select('modelid')->get_where('cate', array(
            'id' => $cid
        ))->row_array();
        if (empty($_cate)) {
            show_error('点击的内容不存在!');
        }
        $tablename = $this->db->select('tablename')->get_where('model', array(
            'id' => $_cate['modelid']
        ))->row_array();
        //开始查询
        $tb = $tablename['tablename'];
        $this->db->set('click', 'click+1', FALSE)->where('id', $id)->update($tb);
        $click = $this->db->select('click')->get_where($tb, array(
            'id' => $id
        ))->row_array();
        if (empty($click)) {
            show_error('点击的内容不存在!');
        }
        echo 'document.write(' . $click['click'] . ')';
    }
}
?>
