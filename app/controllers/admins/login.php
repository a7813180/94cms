<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
    /*
    构造函数
    判断是否已登录，已登录直接跳到后台首页
    */
    public function __construct() {
        parent::__construct(); //必须存在
        $this->load->library('session');
        $this->config->set_item('index_page', 'index.php');
    }
    //登陆显示
    public function index() {
        $data = $this->session->all_userdata();
        if (!empty($data['username']) && !empty($data['rank'])) {
            redirect(APP_ADMIN . '/home/');
        }
        $this->load->helper('form');
        $this->load->view('admin/login.html');
    }
    //登陆判断
    public function logins() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', '用户名', 'required');
        $this->form_validation->set_rules('password', '密码', 'required');
        $this->form_validation->set_rules('code', '验证码', 'required');
        $date = $this->form_validation->run();
        if ($date) {
            $code = strtolower($_POST['code']);
            $this->load->library('code');
            $code = $this->code->checkCode($code, 'user');
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            if ($code) {
                $data = $this->db->get_where('user', array(
                    'username' => $username
                ))->row_array();
                if (!$data) {
                    error('对不起！你输入的用户名不存在！');
                } else {
                    if ($password != $data['password']) {
                        error('对不起！你输入的密码不正确！');
                    } else {
                        $newdata = array(
                            'username' => $data['username'],
                            'rank' => 'a'
                        );
                        $this->session->set_userdata($newdata);
                        $time = $this->db->select('time')->get_where('user',array('username'=>$data['username']))->row_array();
                        $this->db->where('username',$data['username'])->update('user',array('up_time'=>$time['time']));
                        $this->db->where('username',$data['username'])->update('user',array('time'=>time()));
                        redirect(APP_ADMIN . '/home/');
                    }
                }
            } else {
                error('验证码错误!');
            }
        } else {
            $msg = validation_errors();
            if ($msg) {
                error($msg);
            }
            $this->load->view('admin/login.html');
        }
    }
    //验证码显示
    public function code() {

        $this->load->library('code', 'session');
        $this->code->get_code(120,40,4,'user');

    }
    //退出
    public function logut() {
        $this->load->library('session');
        $this->session->sess_destroy();
        redirect(APP_ADMIN . '/login/', '无权限登录');
    }
}
?>
