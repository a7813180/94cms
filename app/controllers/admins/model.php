<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
  自定义模型
*/
class Model extends MY_Controller {
    //构造函数
    public function __construct() {
        parent::__construct();
        $this->is_login();
    }
    //模型查看
    public function index() {
        $this->load->model('Md_model', 'md');
        $data['model'] = $this->md->md_select('*', 'sort', 'asc');
        $this->load->view('admin/model_index.html', $data);
    }
    //添加模型
    public function model_add() {
        $this->load->helper('common');
        $data['template_index'] = getFileFolderList(TMPATH, 2, 'index_*');
        $data['template_list'] = getFileFolderList(TMPATH, 2, 'list_*');
        $data['template_show'] = getFileFolderList(TMPATH, 2, 'show_*');
        $data['template_list_wap'] = getFileFolderList(TMPATH.'wap', 2, 'list_*');
        $data['template_show_wap'] = getFileFolderList(TMPATH.'wap', 2, 'show_*');
        $this->load->view('admin/model_add.html', $data);
    }
    //添加模型处理
    public function add() {
        if (!$_POST) {
            echo '404';
            die;
        }
        $data = $this->input->post();
        $data['tablename'] = strtolower($data['tablename']);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', '模型名称', 'required');
        $this->form_validation->set_rules('tablename', '模型表名', 'required|alpha');
        if ($this->form_validation->run() == FALSE) {
            $msg = validation_errors();
            error_s($msg);
        } else {
            $tablename = $this->input->POST('tablename', TRUE);
            $tablename = strtolower($this->db->dbprefix($tablename));
            if ($this->db->get_where('model', array(
                'tablename' => strtolower($data['tablename'])
            ))->num_rows()) {
                error('附加表已存在！请不要重复添加!');
            }
            if ($this->db->table_exists($tablename)) {
                error_s('附加表已存在！请重新设置！');
            }
            $tablename_data = $tablename . '_data';
            $str = <<<str
 CREATE TABLE $tablename (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(60) NOT NULL default '' COMMENT '标题',
  `shorttitle` varchar(30) NOT NULL default '' COMMENT '副标题',
  `color` char(10) NOT NULL default '' COMMENT '标题颜色',
  `template_show` varchar(30) default NULL,
  `author` varchar(30) NOT NULL default '',
  `keywords` varchar(50) default '' COMMENT '关键字',
  `litpic` varchar(150) NOT NULL default '' COMMENT '缩略图',
  `content` text COMMENT '内容',
  `description` varchar(255) NOT NULL default '' COMMENT '摘要描述',
  `publishtime` int(10) unsigned NOT NULL default '0' COMMENT '发布时间',
  `updatetime` int(10) unsigned NOT NULL default '0' COMMENT '更新时间',
  `click` smallint(6) unsigned NOT NULL default '0' COMMENT '点击数',
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `commentflag` tinyint(1) NOT NULL default '1' COMMENT '允许评论',
  `flag` set('c','h','p','f','s','j','a','b') default NULL COMMENT '文章属性',
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '1回收站',
  `userid` int(10) unsigned NOT NULL default '0',
  `aid` int(10) unsigned NOT NULL default '0' COMMENT 'admin',
  `sort` smallint(10) NOT NULL default '99',
  PRIMARY KEY  (`id`),
  KEY `cid` (`cid`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;
str;
            $strdata = <<<str
CREATE TABLE $tablename_data (
  `id` smallint(4) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
str;
            if ($this->db->simple_query($str) and $this->db->simple_query($strdata)) {
                $this->db->insert('model', $data);
                success_s('添加模型成功!');
            } else {
                error('添加失败请检查mysql数据库!');
            }
        }
    }
    //编辑模型
    public function model_updata() {
        $id = $this->uri->segment(4);
        $id = (int)($id);
        //if($id <= '4'){error('系统内置模型不可以编辑！');}
        $data['model'] = $this->db->get_where('model', array(
            'id' => $id
        ))->row_array();
        $this->load->helper('common');
        $data['template_index'] = getFileFolderList(TMPATH, 2, 'index_*');
        $data['template_list'] = getFileFolderList(TMPATH, 2, 'list_*');
        $data['template_show'] = getFileFolderList(TMPATH, 2, 'show_*');
        $data['template_list_wap'] = getFileFolderList(TMPATH.'wap', 2, 'list_*');
        $data['template_show_wap'] = getFileFolderList(TMPATH.'wap', 2, 'show_*');
        $this->load->view('admin/model_updata.html', $data);
    }
    //编辑表单处理
    public function updata() {
        if (!$_POST) {
            echo '404';
            die;
        }
        $data = $this->input->post(null, TRUE);
        $data['tablename'] = strtolower($data['tablename']);
        $id = $data['id'];
        $tablename = $this->db->select('tablename')->get_where('model', array(
            'id' => $id
        ))->row_array();
        $tablename = $tablename['tablename'];
        if ($tablename != $data['tablename']) {
            $_tablename = strtolower($this->db->dbprefix($data['tablename'])); //要修改的表名
            if ($this->db->table_exists($_tablename)) {
                error('表已存在！请重新命名！');
            } else {
                //$tablename 原来的表名 // $data['tablename'] 要修改的表名
                $this->load->dbforge();
                $this->dbforge->rename_table($tablename, $data['tablename']); //修改主表
                $this->dbforge->rename_table($tablename . '_data', $data['tablename'] . '_data'); //修改附表
                
            }
        }
        $this->db->where(array(
            'id' => $id
        ));
        $this->db->update('model', $data);
        success('模型更新成功', APP_ADMIN . '/model');
    }
    // 删除模型
    public function delete() {
        $id = $this->uri->segment(4);
        $tablename = $this->uri->segment(5);
        $tablename = $this->db->dbprefix($tablename);
        if ($id <= 5) {
            error('系统固定模型不可以删除！');
        }
        $this->db->delete('model', array(
            'id' => $id
        ));
        $this->db->query('drop table ' . $tablename);
        $this->db->query('drop table ' . $tablename . '_data');
        success('模型删除成功！', APP_ADMIN . '/model');
    }
    //批量更新模型顺序
    public function p_sort() {
        if (!$_POST) {
            echo '404';
            die;
        }
        $data = $this->input->post(null, TRUE);
        foreach ($data as $key => $v) {
            if ($key !== 'del') {
                $id = explode('_', $key);
                $this->db->where(array(
                    'id' => $id['1']
                ));
                $this->db->update('model', array(
                    'sort' => $v
                ));
            }
        }
        success('模型顺序更新成功！', APP_ADMIN . '/model');
    }
    //自定义字段显示
    public function model_field() {
        $mid = $this->uri->segment(4);
        $name = $this->db->select('name')->get_where('model', array(
            'id' => $mid
        ))->row_array();
        $data['model_name'] = $name;
        $data['mid'] = $mid;
        $data['field'] = $this->db->order_by('sort', 'asc')->order_by('id', 'asc')->get_where('model_field', array(
            'modelid' => $mid
        ))->result_array();
        $this->load->view('admin/model_field.html', $data);
    }
    //自定义字段添加页面
    public function model_field_add() {
        $mid = $this->uri->segment(4);
        $data['mid'] = $mid;
        $this->load->model('Md_model', 'md');
        $data['model'] = $this->md->md_select('id,name', 'sort', 'asc');
        $this->load->view('admin/model_field_add.html', $data);
    }
    //批量更新字段顺序
    public function field_sort() {
        if (!$_POST) {
            echo '404';
            die;
        }
        $data = $this->input->post(null, TRUE);
        $modelid = $this->input->get('model', true);
        foreach ($data as $key => $v) {
            if ($key !== 'del') {
                $id = explode('_', $key);
                $this->db->where(array(
                    'id' => $id['1']
                ));
                $this->db->update('model_field', array(
                    'sort' => $v
                ));
            }
        }
        success('字段顺序更新成功！', APP_ADMIN . '/model/model_field/' . $modelid);
    }
    /*
    字段锁定and开启   
    */
    public function field_status() {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $mid = $this->uri->segment(6);
        if (isset($id) && isset($status)) {
            if (!$status) {
                $rules = $this->db->select('rules')->get_where('model_field', array(
                    'id' => $id
                ))->row_array();
                $rules['rules'] ? error('本字段有必填选项,不可以锁定！如想锁定请先取消必填！') : '';
            }
            $this->db->where('id', $id)->update('model_field', array(
                'status' => $status
            ));
            success('状态更新成功！', APP_ADMIN . '/model/model_field/' . $mid);
        }
    }
    /*
     *动态加载自定义字段配置
    */
    public function ajaxformtype() {
        $type = $this->input->get('type');
        if (empty($type)) exit('');
        //加载字段配置文件
        $this->load->helper('fields');
        $func = 'my_form_' . $type;
        if (!function_exists($func)) exit('');
        eval('echo ' . $func . '();');
    }
    //添加自定义字段处理
    public function model_field_add_s() {
        if (!$_POST) {
            echo 404;
            die;
        }
        $data = $this->input->post(NULL, TRUE);
        if ($data['modelid'] == 1) {
            error('单页模型不支持自定义字段！sorry.');
        }
        $this->load->library('form_validation');
        if ($this->form_validation->run('field')) {
            $mid = $this->input->post('modelid');
            $tablename = $this->db->select('tablename')->get_where('model', array(
                'id' => $mid
            ))->row_array();
            $tablename = $this->db->dbprefix($tablename['tablename'] . '_data');
            $data['field'] = strtolower($data['field']);
            if ($this->db->get_where('model_field', array(
                'modelid' => $mid,
                'field' => $data['field']
            ))->num_rows()) {
                error_s('字段已存在!');
            }
            if ($this->db->field_exists($data['field'], $tablename)) {
                error_s('字段已存在!');
            }
            //添加字段组合sql语句
            if ($data['fieldtype'] == 'editor') {
                $str = "ALTER TABLE " . $tablename . " ADD " . $data['field'] . " TEXT NULL";
                $msg = $this->db->simple_query($str);
            } else {
                $type = "varchar(500)";
                $str = "ALTER TABLE " . $tablename . " ADD COLUMN " . $data['field'] . " " . $type . " NULL";
                $msg = $this->db->simple_query($str);
                if ($msg && !empty($data['indexkey'])) {
                    $str = "ALTER TABLE " . $tablename . " ADD " . $data['indexkey'] . " (" . $data['field'] . ")";
                    $msg = $this->db->simple_query($str);
                }
            }
            /**/
            unset($data['indexkey']); //销毁 indexkey
            $this->load->helper('common');
            $data['setting'] = array2string($data['setting'], 0); //把数组变为字符串
            $this->db->insert('model_field', $data);
            success_s('添加成功');
        } else {
            $msg = validation_errors();
            error_s($msg);
        }
    }
    //删除自定义字段处理
    public function model_field_del() {
        $id = $this->uri->segment(4);
        $data = $this->db->select('field,modelid,id')->get_where('model_field', array(
            'id' => $id
        ))->row_array();
        $tablename = $this->db->get_where('model', array(
            'id' => $data['modelid']
        ))->row_array('tablename');
        $tablename = strtolower($this->db->dbprefix($tablename['tablename'])) . "_data"; //得到本字段所在模型的附表
        //删除数据库里面的字段
        $str = "ALTER TABLE " . $tablename . " DROP " . $data['field'];
        $this->db->simple_query($str);
        $this->db->delete('model_field', array(
            'id' => $id
        ));
        success('删除自定义字段成功!', APP_ADMIN . '/model/model_field/' . $data['modelid']);
    }
    //修改自定义字段
    public function model_field_updata() {
        $id = $this->uri->segment(4);
        $data = $this->db->get_where('model_field', array(
            'id' => $id
        ))->row_array();
        $this->load->model('Md_model', 'md');
        $data['model'] = $this->md->md_select('id,name', 'sort', 'asc');
        $this->load->view('admin/model_field_upload.html', $data);
    }
    public function model_field_updata_s() {
        $data = $this->input->post(null, TRUE);
        $this->load->library('form_validation');
        if ($this->form_validation->run('field')) {
            $field = $this->db->select('field,modelid')->get_where('model_field', array(
                'id' => $data['id']
            ))->row_array();
            //判断如果修改字段的
            if ($field['field'] != $data['field']) {
                $tablename = $this->db->select('tablename')->get_where('model', array(
                    'id' => $field['modelid']
                ))->row_array();
                $tablename = $tablename['tablename'] . "_data";
                $this->load->dbforge();
                if ($data['fieldtype'] == 'editor') {
                    $type = "TEXT";
                } else {
                    $type = "varchar(500)";
                }
                $xg_field = array(
                    $field['field'] => array(
                        'name' => $data['field'],
                        'type' => $type,
                    )
                );
                $this->dbforge->modify_column($tablename, $xg_field);
            }
            unset($data['indexkey']);
            $data['setting'] = array2string($data['setting'], 0);
            $this->db->where(array(
                'id' => $data['id']
            ));
            $this->db->update('model_field', $data);
            success_s('自定义字段修改成功');
        } else {
            $msg = validation_errors();
            error_s($msg);
        }
    }
}
?>
