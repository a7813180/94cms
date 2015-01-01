<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Upload extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->is_login();
    }
    //图片上传
    public function upimg() {
        $config['upload_path'] = './uploads/images/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|swf|bmp|false';
        $config['max_size'] = '10000';
        $config['file_name'] = date('m-d') . '-' . time() . mt_rand(1000, 9999);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('imgFile')) {
            $data = $this->upload->display_errors();
            $msg = msg($data);
            die(json_encode(array(
                "error" => 1,
                'state' => $msg,
                "message" => $msg
            )));
        } else {
            $data = $this->upload->data();
            if ($this->input->get('dir', true)) {
                $url = base_url() . '/uploads/images/' . $data['file_name'];
            } else {
                $url = '/uploads/images/' . $data['file_name'];
            }
            die(json_encode(array(
                "error" => 0,
                'state' => "SUCCESS",
                "url" => $url
            )));
        }
    }
    //文件上传
    public function upfile() {
        $config['upload_path'] = './uploads/file/';
        $config['allowed_types'] = 'rar|zip|txt|text|pdf|gif|jpg|png|jpeg|swf|bmp';
        $config['max_size'] = '10000';
        $config['file_name'] = date('m-d') . '-' . time() . mt_rand(1000, 9999);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('imgFile')) {
            $data = $this->upload->display_errors();
            $msg = msg($data);
            die(json_encode(array(
                "error" => 1,
                "message" => $msg
            )));
        } else {
            $data = $this->upload->data();
            $url = base_url('uploads/file') . "/" . $data['file_name'];
            die(json_encode(array(
                "error" => 0,
                "url" => $url
            )));
        }
    }
}

