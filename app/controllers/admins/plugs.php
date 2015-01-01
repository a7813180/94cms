<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Plugs extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->is_login();
        $this->load->helper('file'); //目录函数
        
    }
    //模块插件列表
    public function index() {
        $path = FCPATH . 'app' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR; //插件根目录路径
        $this->load->helper('directory');
        $data = directory_map($path);
        $sj = array();
        foreach ($data as $key => $v) {
            $_path = $path . $key . DIRECTORY_SEPARATOR . 'index.xml';
            if (file_exists($_path)) {
                $con = simplexml_load_file($_path);
                $this->load->helper('common');
                $con = ob2ar($con); //对象转为数组
                file_exists($path . $key . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'install.lock') ? $install = 'true' : $install = 'false';
                $arr = array(
                    'name' => $key,
                    'title' => $con['title'],
                    'lock' => $con['lock'],
                    'banben' => $con['banben'],
                    'nav' => $con['nav'],
                    'attribute' => $con['attribute'],
                    'zuozhe' => $con['zuozhe'],
                    'install' => $install
                );
                $sj[] = $arr;
            }
        }
        $data['modules'] = $sj;
        $this->load->view('admin/plugs.html', $data);
    }
    //安装模块
    public function install() {
        $mname = $this->uri->segment(4);
        $path = FCPATH . 'app' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $mname . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR;
        if (!file_exists($path . 'install.lock')) {
            $sql = $path . 'install.sql';
            file_exists($sql) ? '' : error('sql文件不存在!');
            $sql_content = "";
            $file = fopen($sql, "r"); //以只读方式打开数据库sql文件
            while ($s = fread($file, 1024)) {
                $sql_content.= $s;
            }
            $sql_content = str_replace('94_', '', $sql_content);
            preg_match_all("/CREATE TABLE `(.*?)`(.*?);/is", $sql_content, $sqllist);
            foreach ($sqllist[1] as $k => $v) {
                $tablename = $this->db->dbprefix($v);
                $this->load->dbforge();
                $this->dbforge->drop_table($v);
                $sql = "create table `" . $tablename . "` " . $sqllist[2][$k];
                if ($this->db->query($sql)) {
                    // echo "<p>数据表格".$tablename."创建成功！....</p>";
                    $file = fopen($path . "/install.lock", "w");
                    fclose($file);
                    success('模块安装成功!', APP_ADMIN . '/Plugs/');
                } else {
                    die("<p style='color:red'>数据表" . $tablename . "创建失败!</p>" . "<p><a href='javascript:window.history.back();'>【返回】</a></p>");
                }
            }
        } else {
            error('模块已安装不要重复安装!');
        }
    }
    //卸载模块
    public function uninstall() {
        $mname = $this->uri->segment(4);
        $path = FCPATH . 'app' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $mname . DIRECTORY_SEPARATOR;
        if (file_exists($path . 'controllers' . DIRECTORY_SEPARATOR . 'install.lock')) {
            //读取模块配置文件
            $_path = $path . 'index.xml';
            $con = simplexml_load_file($_path);
            $this->load->helper('common');
            $con = ob2ar($con); //对象转为数组
            //判断是不是锁定模块
            if (!$con['lock']) {
                $this->load->dbforge();
                $this->dbforge->drop_table($mname); //ci本身数据库维护类
                unlink($path . 'controllers' . DIRECTORY_SEPARATOR . 'install.lock'); //删除锁定文件
                success('卸载成功!', APP_ADMIN . '/Plugs/');
            } else {
                error('锁定模块不可以卸载!');
            }
        } else {
            error('模块已卸载!');
        }
    }
}
?>
