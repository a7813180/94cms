<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Member_home_module extends CI_Module {

     /**
     * 构造函数
     *
     * @return void
     * @author
     **/
     function __construct()
     {
      parent::__construct();
      $this->is_member(); //判断会员关闭
      $this->is_member_login(); //判断会员登陆
      $this->load->library('session');
      $lock = dirname(__FILE__).DS.'install.lock';
      if(!file_exists($lock)){ error('请先安装本模块！');}
      define('_APPURL_', 'module/menber/admin_home'); 
    }
    
    //默认首页
    public function index(){
      $id = $this->session->userdata('id');
      $data = $this->db->get_where('member',array('id'=>$id))->row_array();
     // P($data);die;
      $this->load->view('index_home.html',$data);
    }
    

    //个人资料
    public function setprofile(){
      $id = $this->session->userdata('id');
      $select =array('id','userid','uname','sex','email','tel');
      $data['u_info']  = $this->db->select($select)->get_where('member',array('id'=>$id))->row_array();
      $data['title'] = '个人资料';
      $this->load->view('index_setprofile.html',$data);
    }
    
    //个人资料处理
    public function setprofile_s(){
      $data = $this->input->post(null,true);
      $data2 = $this->db->get_where('member',array('id'=>$data['id']))->row_array();
      if($data['email']!=$data2['email']){
       $data2['checkmail'] ? error('邮箱已经验证过,不可以修改！') : ''; 
     }
     if($data['tel']!=$data2['tel']){
       if($data2['checktel']){
         error('手机号码已经验证过,不可以修改！'); 
       }
       $this->db->get_Where('member',array('tel'=>$data['tel']))->num_rows()?error('手机号码重复!请重新输入!'):'';
     }
      //获取会员设置
     $site = $this->db->select('in_uname')->get('member_site')->row_array();
     if(!$site['in_uname']){
        //判断昵称是否和以前的一样如果不是进行数据库查询
      if($data2['uname']!= $data['uname']){
        $this->db->get_where('member',array('uname'=>$data['uname']))->num_rows()?error('昵称重复,请修改!'):'';
      }
    }
    $this->db->where('id',$data['id'])->update('member',$data)?success('修改成功'):error('修改失败!');
  }


    //修改密码
  public function pwd(){
    $data['id'] = $this->session->userdata('id');
    $data['userid'] = $this->session->userdata('userid');
    $data['title'] = '修改密码';
    $this->load->view('index_pwd.html',$data);
  }

    //修改密码处理
  public function pwd_s(){
    $data = $this->input->post(null,true);
    $config = array(
      array('field'   => 'id', 'label'   => '用户ID', 'rules'   => 'required'),
      array('field'   => 'pwd_j','label'=>'旧密码','rules'=>'required'),
      array('field'   => "pwd", 'label'   => "新密码", 'rules'   => 'required|min_length[5]|max_length[12]'),
      array('field'   => 'pwd_reg','label'   => '重复新密码','rules'   => 'required|min_length[5]|max_length[12]')
      );
    $this->form_validation->set_rules($config);
    if($this->form_validation->run()==FALSE){
      return error(validation_errors());
    }
    if($data['pwd']!= $data['pwd_reg']){error('您输入的2次新密码不一样！请重新输入！');}
    $this->db->get_where('member',array('id'=>$data['id'],'pwd'=>md5($data['pwd_j'])))->num_rows()?'':error('旧密码不正确!');
    unset($data['pwd_j'],$data['pwd_reg']);
    $data['pwd'] = md5($data["pwd"]);
    $this->db->where('id',$data['id'])->update('member',$data)?success('密码修改成功!'):error('密码修改失败！');
  }

  
  //消费记录
  public function deposit(){
    $mid = $this->session->userdata('id');
    $this->load->library('pagination');
    $myts = 9; //每页显示多少条
    $total = $this->db->where('mid',$mid)->get('member_dep')->num_rows();

    $dqys = $this->uri->segment(4)? $this->uri->segment(4) : '0';
    $config['total_rows'] = $total;
    $config['per_page'] = $myts;
    $config['uri_segment'] = 4;
    $config['first_link'] = '首页';
    $config['prev_link'] = '上一页';
    $config['next_link'] = '下一页';
    $config['last_link'] = '最后一页';
    $config['enable_query_strings'] = true;
    $config['base_url'] =  site_url().'member/home/deposit';

    $this->pagination->initialize($config); 
    $data['page'] = $this->pagination->create_links();
    
    $data['dep'] = $this->db->limit($myts,$dqys)->order_by('time','DESC')->get_where('member_dep',array('mid'=>$mid))->result_array();
    $data['title'] = '消费记录';
    $this->load->view('index_deposit.html',$data);
  }

  //在线充值
  public function pay(){
  	$data['id'] = $this->session->userdata('id');
  	$data['userid'] = $this->session->userdata('userid');
    $data['title'] = '在线充值';
    $this->load->view('index_pay.html',$data);
  }

  //充值处理
  public function pay_s(){
  	$data = $this->input->post(null,true);
    $config = array(
      array('field'   => 'mid', 'label'   => '用户ID', 'rules'   => 'required|integer'),
      array('field'   => "money", 'label'   => "充值金额", 'rules'   => 'required|numeric'),
      array('field'   => 'pay','label'   => '充值方式','rules'   => 'required|numeric')
      );
    $this->form_validation->set_rules($config);
    if($this->form_validation->run()==FALSE){
      return error(validation_errors());
    }
    $in_money = $this->db->select('in_money')->get('member_site')->row_array();
    $in_money = $in_money['in_money'];
    if($data['money']<$in_money || $data['money'] < 0 ){error('充值金额错误!最低充值'.$in_money.'元!');}
    $data['time'] = time(); $data['ip'] = getIP();
    $data['order'] = time();
    $this->db->insert('member_order',$data);
    P($data);
  }
  
  //充值记录
  public function pay_data(){
  	$mid = $this->session->userdata('id');
  	$this->load->library('pagination');
    $myts = 9; //每页显示多少条
    $total = $this->db->where('mid',$mid)->get('member_order')->num_rows();
    $dqys = $this->uri->segment(4)? $this->uri->segment(4) : '0';
    $config['total_rows'] = $total;
    $config['per_page'] = $myts;
    $config['uri_segment'] = 4;
    $config['first_link'] = '首页';
    $config['prev_link'] = '上一页';
    $config['next_link'] = '下一页';
    $config['last_link'] = '最后一页';
    $config['enable_query_strings'] = true;
    $config['base_url'] =  site_url().'member/home/pay_data';
    $this->pagination->initialize($config); 
    $data['page'] = $this->pagination->create_links();
    
  	$data['title'] = '充值记录';
  	$data['pay_data'] = $this->db->limit($myts,$dqys)->order_by('time','DESC')->get_where('member_order',array('mid'=>$mid))->result_array();
 
  	$this->load->view('index_pay_data.html',$data);
  }  

  //积分兑换
  public function jifen(){
    $id = $this->session->userdata('id');
    $data = $this->db->get_where('member',array('id'=>$id))->row_array();
    $bili = $this->db->select('jifenbili')->get('member_site')->row_array();
    $data['title'] = '积分兑换';
    $data['bili'] = $bili['jifenbili'];
    $this->load->view('index_jifen.html',$data);
  }

  //积分处理
   public function jifen_S(){
    $data = $this->input->post(null,true);
    empty($data['money'])? error('请输入要兑换的金额!'):'';
    $money =$this->db->select('money,jifen')->get_where('member',array('id'=>$data['id']))->row_array();
    if($money['money'] - $data['money'] < 0 ){error('金额不足!');}
    $bili = $this->db->select('jifenbili')->get('member_site')->row_array();
    $bili = $bili['jifenbili']; 
    $money['money'] = $money['money'] -$data['money'];
    $money['jifen'] = $money['jifen']  + ($data['money'] * $bili);
    $this->db->where('id',$data['id'])->update('member',$money)?success('恭喜您兑换成功!'):error('兑换失败,请稍等重试!');
 
   }
  

   //邀请好友
   public function yaoqing(){
   	$data['mid'] = $this->session->userdata('id');
   	$data['title'] = "邀请好友";
   	$this->load->view('index_yaoqing.html',$data);
   }

  // 头像修改
   public function tx(){
    $data['mid'] = $this->session->userdata('id');
    $data['title'] = "邀请好友";
    $this->load->view('index_tx.html',$data);
   }

  
  //头像上传
   public function uptx() {
    $config['allowed_types'] = 'gif|jpeg|jpg|tmp|png|bmp';
    $result = array();
    $data = array();
    $result['success'] = false;
    $successNum = 0;
        //定义一个变量用以储存当前头像的序号
    $avatarNumber = 1;
    $i = 0;
    $msg = '';
        //上传目录
    $dir = "uploads/member/tx";
    while (list($key, $val) = each($_FILES))
    {
     if ( $_FILES[$key]['error'] > 0)
     {
      $msg .= $_FILES[$key]['error'];
    }
    else
    {   
      $fileName = date("YmdHis").'_'.floor(microtime() * 1000).'_'.createRandomCode(8);
				//处理原始图片（默认的 file 域的名称是__source，可在插件配置参数中自定义。参数名：src_field_name）
				//如果在插件中定义可以上传原始图片的话，可在此处理，否则可以忽略。
      if ($key == '__source')
      {
					//当前头像基于原图的初始化参数，用于修改头像时保证界面的视图跟保存头像时一致。帮助提升用户体验度。修改头像时设置默认加载的原图的url为此图片的url+该参数即可。
       $initParams = $_POST["__initParams"];
       $virtualPath = "$dir/php_source_$fileName.jpg";
       $result['sourceUrl'] = '/' . $virtualPath.$initParams;
       move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
					/*
						可在此将 $result['sourceUrl'] 储存到数据库
					*/
             $successNum++;
         }
				//处理头像图片(默认的 file 域的名称：__avatar1,2,3...，可在插件配置参数中自定义，参数名：avatar_field_names)
         else if (strpos($key, '__avatar') === 0)
         {
           $virtualPath = "$dir/tx_" . $avatarNumber . "_$fileName.jpg";
           $result['avatarUrls'][$i] = '/' . $virtualPath;
           move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
					/*
						可在此将 $result['avatarUrls'][$i] 储存到数据库
					*/
            $data[$i] = $result['avatarUrls'][$i];
            $successNum++;
            $i++;
          }
         }
      }
      $result['msg'] = $msg;
      if ($successNum > 0)
      {
       $result['success'] = true;
     }
     $this->session->set_userdata(array('tx'=>$data));
     $data = array2string($data);
     $id = $this->session->userdata('id');
   //查询以前的图片并且删除
     $tx = $this->db->select('tx')->get_where('member',array('id'=>$id))->row_array();
     $tx =  $tx['tx'];
     $tx =  string2array($tx);
     if(is_array($tx)){
       foreach ($tx as $v){
        unlink(FCPATH.$v);
      } 
    }

    $this->db->where('id',$id)->update('member',array('tx'=>$data));
    print json_encode($result);

  }
	
	
 
  //系统消息
  public function info(){
    
  } 

}