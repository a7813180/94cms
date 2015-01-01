<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class mydata extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->is_login();
        $this->load->dbutil();
    }
    //所有表
    public function index() {
        $data['data'] = $this->db->query('SHOW TABLE STATUS')->result_array();
        $this->load->view('admin/data_index.html', $data);
    }
    //修复单表
    public function xiufu() {
        $tablename = $this->uri->segment(4);
        $str = $tablename . '表修复';
        if ($this->dbutil->repair_table($tablename)) {
            success($str . '成功！', APP_ADMIN . '/mydata');
        } else {
            error($str . '失败！');
        }
    }
    //优化
    public function youhua() {
        $tablename = $this->uri->segment(4);
        $str = $tablename . '表优化';
        if ($this->dbutil->optimize_table($tablename)) {
            success($str . '成功！', APP_ADMIN . '/mydata');
        } else {
            error($str . '失败！');
        }
    }
    //多选修复
    public function xiufu_s() {
        $tablenames = $this->input->post('del', true);
        if (!$tablenames) {
            error('请选择要修复的表!');
        }
        foreach ($tablenames as $v) {
            $this->dbutil->repair_table($v);
        }
        success('修复成功!', APP_ADMIN . '/mydata');
    }
    //多选优化
    public function youhua_s() {
        $tablenames = $this->input->post('del', true);
        if (!$tablenames) {
            error('请选择要优化的表!');
        }
        foreach ($tablenames as $v) {
            $this->dbutil->optimize_table($v);
        }
        success('优化成功!', APP_ADMIN . '/mydata');
    }
    //备份
    public function database() {
        $tablenames = $this->input->post('del', true);
        if (!$tablenames) {
            error('请选择要备份的表!');
        }
        $prefs = array(
            'tables' => $tablenames,
            'format' => 'sql',
            'filename' => '94cms' . time() . '.sql',
            'add_drop' => TRUE, // 是否要在备份文件中添加 DROP TABLE 语句
            'add_insert' => TRUE, // 是否要在备份文件中添加 INSERT 语句
            'newline' => "\n"
            // 备份文件中的换行符
            
        );
        $backup = $this->dbutil->backup($prefs);
        $this->load->helper('file');
        $path = FCPATH . 'public/database/' . '94cms_sql_' . time() . '.sql';
        if (write_file($path, $backup)) {
            success('备份成功！', APP_ADMIN . '/mydata');
        } else {
            error('备份失败!');
        }
    }
    //备份列表
    public function datalist() {
        $path = FCPATH . 'public'.DS.'database';
        $this->load->helper('file');
        $data['data'] = get_dir_file_info($path);
        unset($data['data']['index.html']);
        $this->load->view('/admin/data_list.html', $data);
    }
    //删除文件
    public function del() {
        $_file = $this->uri->segment(4);
        $path = FCPATH . 'public/database/' . $_file;
        unlink($path) ? success('删除成功', APP_ADMIN . '/mydata/datalist') : error('删除失败可能是没有权限！');
    }
    //恢复
    public function hf() {
        $_file = $this->uri->segment(4);
        $path = FCPATH . 'public/database/' . $_file;
        $sql = file_get_contents($path);
        $this->run_sql($sql) ? success('恢复成功', APP_ADMIN . '/mydata') : error('恢复失败!');
    }
    private function run_sql($sql) {
        $sqls = $this->sql_split($sql);
        $result = 0;
        if (is_array($sqls)) {
            foreach ($sqls as $sql) {
                if (trim($sql) != '') {
                    $this->db->query($sql);
                    $result+= mysql_affected_rows();
                }
            }
        } else {
            $this->db->query($sqls);
            $result+= mysql_affected_rows();
        }
        return $result;
    }
    private function sql_split($sql) {
        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $query) {
                $str1 = substr($query, 0, 1);
                if ($str1 != '#' && $str1 != '-') $ret[$num].= $query;
            }
            $num++;
        }
        return ($ret);
    }
    public function yijian() {
        $prefs = array(
            'tables' => array() , // 包含了需备份的表名的数组.
            'ignore' => array() , // 备份时需要被忽略的表
            'format' => 'sql',
            'filename' => '94cms' . time() . '.sql',
            'add_drop' => TRUE, // 是否要在备份文件中添加 DROP TABLE 语句
            'add_insert' => TRUE, // 是否要在备份文件中添加 INSERT 语句
            'newline' => "\n"
            // 备份文件中的换行符
            
        );
        $backup = $this->dbutil->backup($prefs);
        $this->load->helper('file');
        $path = FCPATH . 'public/database/' . '94cms_sql_' . time() . '.sql';
        if (write_file($path, $backup)) {
            success('备份成功！', APP_ADMIN . '/mydata');
        } else {
            error('备份失败!');
        }
    }
}
?>
