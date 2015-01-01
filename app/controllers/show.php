<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Show extends My_Controller {
    //构造函数
    public function __construct() {
        parent::__construct();
        $this->is_view(); //引入模板引擎和自定义配置类
        $this->is_mobile(); //判断pc或者手机
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
                //empty($_cate['ename']) ? '' : show_error('内容不存在!');
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
            config_item('index_page') ? $fuhao = "/" : $fuhao = '';
            foreach ($tag as $v) {
                $data['tag'] = $data['tag'] . "<a target='_blank' href=" . site_url() . $fuhao .'tag/' . $v . ">" . $v . "</a>" . "&nbsp;&nbsp;";
            }
            //判断内容页是不是又自定义模板
            $data['template_show'] ? $template_show = $data['template_show'] : $template_show = $_cate['template_show'];
            $this->view($template_show, $data);
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

    //评价
    public function comm($cid,$id){
       if(!$_POST){show_error('404!');}
       $cid = (int)($cid);
       $id = (int)($id);
       $data = $this->input->post(null,true);
       $data = array(
        'name'=>strip_tags(safe_replace($data['name'])),
        'content'=>strip_tags(safe_replace($data['content'])),
        'cid'=>$cid,
        'sid'=>$id,
        'time'=> time(),
        'pid'=>'0',
        'ip'=>getIP()
        );
     if($this->db->insert('comment',$data)){
        echo json_encode(array("status"=>1));
     }else{
        echo json_encode(array("status"=>0));
     }
    }

    //下载
    public function dow($cid,$id){
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
                empty($_cate['ename']) ? '' : show_error('下载内容不存在!');
            } else {
                $_cate = $this->db->get_where('cate', array(
                    'ename' => $cid
                ))->row_array();
            }
            if (empty($_cate) || $_cate['modelid'] == '1' || $_cate['status'] == '0') {
                show_error('下载内容不存在！');
            }
             $tablename = $this->db->select('tablename')->get_where('model', array(
                'id' => $_cate['modelid']
            ))->row_array();
            //开始查询
            $tb = $tablename['tablename'];
            //判断本模型有没有下载字段
            $dowurl= $this->db->field_exists('dowurl',$tb.'_data');
            $dowurl?'':error('没有要下载的内容!');
            $dowdata = $this->db->get_where($tb.'_data',array('id'=>$id))->row_array();
            if(isset($dowdata['inmember'])){
             //判断有没有设置只有会员下载
             if($dowdata['inmember'] == "会员下载"){
                    $this->load->library('session');
                    $data=$this->session->all_userdata();
                    if(empty($data['userid']) && empty($data['id'])){
                       error('需要登录会员才可以下载!');
                    }else{
                       //判断本文件是不想需要积分下载
                       if($dowdata['jifen']!=0){
                         $jifen = $this->db->select('jifen')->get_where('member',array('id'=>$data['id']))->row_array();
                         $jifen = $jifen['jifen'];
                         $jifen - $dowdata['jifen'] < 0 ?error('积分不够!'):'';
                         //判断以前有没有下载过
                         $order = array('mid'=>$data['id'],'cid'=>$cid,'aid'=>$id);
                         $sfxz = $this->db->get_where('member_dep',$order)->num_rows();
                         if(!$sfxz){
                           //如果以前没有下载记录 那就扣除积分
                           $this->db->where('id',$data['id'])->update('member',array('jifen'=>$jifen - $dowdata['jifen']));
                           $order['time'] = time();
                           $order['style'] = "文件下载";
                           $order['shuliang'] = $dowdata['jifen'];
                           $this->db->insert('member_dep',$order);
                         } 
                         
                     }
                   }
                }
            $this->load->helper('download');
            if(!file_exists(FCPATH.$dowdata['dowurl'])){
               error('下载文件已被删除!');
            }
            $field = file_get_contents(FCPATH.$dowdata['dowurl']); 
            $fieldname = basename(FCPATH.$dowdata['dowurl']);
            force_download($fieldname, $field);
            }

       }
    }
    
}
?>
