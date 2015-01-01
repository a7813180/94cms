<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

  class Member_login_module extends CI_Module {

  	/**
  	 * 构造函数
  	 *
  	 **/
  	function __construct()
  	{
  		parent::__construct();
      $this->is_member();
      $lock = dirname(__FILE__).DS.'install.lock';
      if(!file_exists($lock)){ show_error('请先安装本模块！');}
      $this->load->helper('form');
    
    }

  
     //登陆页
     public function index()
     { 
       $data = $this->db->get('member_site')->row_array();
       $this->load->view('index_login.html',$data);
     }

  	 //验证码
     public function code(){
       $this->load->library('code');
       $this->code->get_code(107,40,4,'member');
     }

    
     public function login_s(){
      //获取会员设置
      $site = $this->db->select('login_code,in_login')->get('member_site')->row_array();
      $site['in_login']?'':error('系统禁止登陆');
      $data = $this->input->post(null,true);
      $config = array(
        array('field'   => 'userid', 'label'   => '用户名', 'rules'   => 'required|min_length[5]|max_length[12]|alpha_dash'),
        array('field'   => "pwd",'label'   => "密码",'rules'   => 'required|min_length[5]|max_length[12]'),
        array('field'   => 'code', 'label'   => '验证码','rules'   => 'required')
        );
      //判断如果会员设置登陆不显示验证码 那就销毁验证码的验证规则！
      if(!$site['login_code']){
         unset($config['2']);
      }
      $this->form_validation->set_rules($config);
      if ($this->form_validation->run() == FALSE){
         error(validation_errors());
      }
      if($site['login_code']){
        $data['code'] = strtolower($data['code']);
        $this->load->library('code');
        $this->code->checkCode($data['code'],'member')?'':error('验证码错误!');
      }

      $user = array('userid' => $data['userid'],'pwd'=>md5($data['pwd']));
      $u = $this->db->select('id,userid,mtype,uname,sex,logintime,loginip,look,tx')->where($user)->get('member');
      if($u->num_rows()){
       $u_info = $u->row_array();
       $u_info['look'] ? error('您的账户被禁止登陆!') : '';
       $this->load->library('session');
       
       $u_info['tx'] = string2array($u_info['tx']);
       $this->session->set_userdata($u_info);
       //更新记录
       $datas = array('logintime'=>time(),'loginip'=>getIP(),'uptime'=>$u_info['logintime'],'upip'=>$u_info['loginip']);
       $this->db->where('id',$u_info['id'])->update('member',$datas);
     }else{
      error('账户或者密码错误！');
     }
       redirect(site_url('member/home'));
   }

   //注册
   public function reg(){
      $site = $this->db->select('reg_code,in_reg')->get('member_site')->row_array();
      $site['pid'] = isset($_GET['pid'])? (int)$_GET['pid'] : 0;
      $this->load->view('index_zc.html',$site);
   }
   
   //注册处理
   public function  reg_s(){
      $data = $this->input->post(null,true);
      $site = $this->db->select('reg_code,in_reg')->get('member_site')->row_array();
      $site['in_reg']?'':error('系统已关闭新用户注册!');
      $config = array(
        array('field'   => 'userid', 'label'   => '用户名', 'rules'   => 'required|min_length[5]|max_length[12]|alpha_dash'),
        array('field'   => 'email','label'=>'邮箱','rules'=>'required|valid_email'),
        array('field'   => "pwd", 'label'   => "密码", 'rules'   => 'required|min_length[5]|max_length[12]'),
        array('field'   => 'code','label'   => '验证码','rules'   => 'required')
        );
      //判断如果会员设置注册不显示验证码 那就销毁验证码的验证规则！
      if(!$site['reg_code']){
         unset($config['3']);
      }
      $this->form_validation->set_rules($config);
      if($this->form_validation->run()==FALSE){
        return error(validation_errors());
      }
      if($site['reg_code']){
        $data['code'] = strtolower($data['code']);
        $this->load->library('code');
        $this->code->checkCode($data['code'],'member')?'':error('验证码错误!');
      }
      if($data['repwd'] != $data['pwd']){error('2次密码不相同!');}
      if(!isset($data['agree'])){error('请先同意注册协议!');}
      $d = $this->db->select('userid,email,tel');
      $d->get_where('member',array('userid'=>$data['userid']))->num_rows()?error('用户名已存在!'):'';
      $d->get_where('member',array('email'=>$data['tel']))->num_rows()?error('手机号码已存在!'):'';
      $d->get_where('member',array('email'=>$data['email']))->num_rows()?error('邮箱已存在!'):'';
      unset($data['repwd'],$data['code'],$data['agree']);
      $data['pwd'] =md5($data['pwd']);
      $data['jointime'] = time();
      $data['joinip'] = getIp();
      $data['checkmail'] = '-1';
      $this->db->insert('member',$data) ? success('注册成功!请登录!','member/home') : error('注册失败!');
     }
 
    //退出    
    public function logut(){
      $this->load->library('session');
      $data = array('id'=>'','userid'=>'','mtype'=>'','uname'=>'','sex'=>'','logintime'=>'','loginip'=>"",'look'=>'');
      $this->session->unset_userdata($data);
      success('退出成功!','member/login');
    } 
}