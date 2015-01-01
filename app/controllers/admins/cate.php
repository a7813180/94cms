<?php
if (!defined('BASEPATH')) {
    die('No direct script access allowed');
}
class Cate extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_login();
    }
    /*
    分类首页显示
    */
    public function index()
    {
        $this->load->model('Cate_model', 'cate');
        $data = $this->cate->cate_models();
        //  P($data);die;
        $this->load->library('cate_class');
        $data['cate'] = $this->cate_class->yi_wei($data);
        $this->load->view('admin/cate_index.html', $data);
    }
    /*
    添加分类显示
    */
    public function cate_add()
    {
        $this->load->library('form_validation');
        //调出分类
        $this->load->model('cate_model');
        $data = $this->cate_model->cate_select('*', 'sort', 'asc');
        // P($data);die;
        $this->load->library('cate_class');
        $data['cate'] = $this->cate_class->yi_wei($data);
        //读取自定义模型
        $this->load->model('Md_model', 'md');
        $data['md'] = $this->md->md_select('id,name,sort,template_list,template_show,template_show_wap,template_list_wap', 'sort', 'asc');
        //调用自定义配置文件
        $this->load->helper('common');
        $data['template_index'] = getFileFolderList(TMPATH, 2, 'index_*');
        $data['template_list'] = getFileFolderList(TMPATH, 2, 'list_*');
        $data['template_show'] = getFileFolderList(TMPATH, 2, 'show_*');
        $data['template_list_wap'] = getFileFolderList(TMPATH.'wap', 2, 'list_*');
        $data['template_show_wap'] = getFileFolderList(TMPATH.'wap', 2, 'show_*');
        $this->load->view('admin/cate_add.html', $data);
    }
    /*
    添加分类处理
    */
    public function add()
    {
        $this->load->library('form_validation');
        $date = $this->form_validation->run('cate');
        if (!$date) {
            $msg = validation_errors();
            $msg = str_replace('.', '!', $msg);
            error($msg);
        } else {
            $data = $this->input->post(null, true);
            unset($data['imgFile']);
            if ($data['ename']) {
                if (!$this->input->post('type')) {
                    $this->form_validation->set_rules('ename', '自定义URL', 'alpha_dash');
                    if ($this->form_validation->run() == FALSE) {
                        $msg = validation_errors();
                        $msg = str_replace('.', '!', $msg);
                        error($msg);
                    }
                }
                $ename = strtolower($data['ename']);
                $data['ename'] = $ename;
                $ename = $this->db->where(array('ename' => $ename))->get('cate')->result_array();
                if ($ename) {
                    error('自定义URL已存在！请重新填写！');
                }
            }
            $this->db->insert('cate', $data);
            success('添加分类成功！', APP_ADMIN . '/cate');
        }
    }
    /*
      编辑分类显示
    */
    public function cate_updata()
    {
        $this->load->library('form_validation');
        $id = $this->uri->segment(4);
        if (!$id) {
            error('分类id不存在！');
        }
        $data['_cate'] = $this->db->get_where('cate', array('id' => $id))->row_array();
        $this->load->model('cate_model');
        $catedata = $this->cate_model->cate_select('*', 'sort', 'asc');
        // P($data);die;
        $this->load->library('cate_class');
        $data['cate'] = $this->cate_class->yi_wei($catedata);
        //读取自定义模型
        $this->load->model('Md_model', 'md');
        $data['md'] = $this->md->md_select('id,name,sort,template_list,template_show,template_show_wap,template_list_wap', 'sort', 'asc');
        $this->load->helper('common');
        $data['template_index'] = getFileFolderList(TMPATH, 2, 'index_*');
        $data['template_list'] = getFileFolderList(TMPATH, 2, 'list_*');
        $data['template_show'] = getFileFolderList(TMPATH, 2, 'show_*');
        $data['template_list_wap'] = getFileFolderList(TMPATH.'wap', 2, 'list_*');
        $data['template_show_wap'] = getFileFolderList(TMPATH.'wap', 2, 'show_*');
        $this->load->view('admin/cate_updata.html', $data);
    }
    /*
      修改分类处理
    */
    public function updata()
    {
        $this->load->library('form_validation');
        $date = $this->form_validation->run('cate');
  
        if (!$date) {
            $msg = validation_errors();
            $msg = str_replace('.', '!', $msg);
            error($msg);
        } else {
         $data = $this->input->post(null, true);
         $datas = $data;
         unset($data['tongbu_temp']);
         unset($data['imgFile']);
            if ($data['ename']) {
                if (!$this->input->post('type')) {
                    $data['type'] = 0;
                    $this->form_validation->set_rules('ename', '自定义URL', 'alpha_dash');
                    if ($this->form_validation->run() == FALSE) {
                        $msg = validation_errors();
                        $msg = str_replace('.', '!', $msg);
                        error($msg);
                    }
                }
                if (!empty($data['ename'])) {
                    $ename = strtolower($data['ename']);
                    $data['ename'] = $ename;
                    $ename = $this->db->where(array('ename' => $ename))->get('cate')->row_array(1);
                    if (!empty($ename)) {
                        if ($ename['id'] != $data['id']) {
                            error('自定义URL已存在！请重新填写！');
                        }
                    }
                }
            }
            $this->db->update('cate', $data, array('id' => $data['id']));
            if(isset($datas['tongbu_temp'])){
                 $cate = $this->db->get('cate')->result_array();
                 $this->load->library('cate_class');
                 $cids= $this->cate_class->fu_cate($cate,$data['id']);
                 $listdata = array(
                    'template_list'=>$data['template_list'],
                    'template_show'=>$data['template_show'],
                    'template_list_wap'=>$data['template_list_wap'],
                    'template_show_wap'=>$data['template_show_wap'],
                   );
               foreach ($cids as $v) {
                   $this->db->update('cate', $listdata, array('id' => $v));
               }
            }
            success('修改分类成功！', APP_ADMIN . '/cate');
        }
    }
    /*
     删除分类处理
    */
    public function delete()
    {
        $id = $this->uri->segment(4);
        $this->load->model('Cate_model', 'cate');
        $data = $this->cate->cate_select('id,pid,');
        $this->load->library('Cate_class');
        $ids = $this->cate_class->fu_cate($data, $id);
        $ids[] = $id;
        foreach ($ids as $v) {
            $this->db->where(array('id' => $v))->delete('cate');
        }
        success('删除分类成功！', APP_ADMIN . '/cate/index');
    }
    //分类显示和隐藏
    public function status()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data = array('id' => $id, 'status' => $status);
        $this->db->update('cate', $data, array('id' => $id));
        success('栏目状态修改成功！', APP_ADMIN . '/cate');
    }
    //批量更新顺序
    public function P_sort()
    {
        $data = $this->input->post(null, true);
        $data ? '' : error('亲！请先添加分类在操作更新栏目顺序哦！');
        foreach ($data as $key => $v) {
            if ($key !== 'del') {
                $id = explode('_', $key);
                $this->db->where(array('id' => $id['1']));
                $this->db->update('cate', array('sort' => $v));
            }
        }
        success('栏目顺序更新成功！', APP_ADMIN . '/cate');
    }
    //批量删除
    public function p_del()
    {
        $id = $this->input->post('del', true);
        $id ? '' : error('要删除分类不存在！');
        foreach ($id as $v) {
            $this->db->delete('cate', array('id' => $v));
        }
        success('批量删除成功！', APP_ADMIN . '/cate');
    }
    //批量添加分类
    public function p_addcate()
    {
        //读取自定义模型
        $this->load->model('Md_model', 'md');
        $data['md'] = $this->md->md_select('id,name,sort,template_list,template_show', 'sort', 'asc');
        $this->load->view('admin/p_addcate.html', $data);
    }
    //批量添加分类处理
    public function p_add()
    {
        $data = $this->input->post(null, true);
        if (!$data['name']) {
            error('一级分类不可以为空！');
        }
        $this->db->where(array('id' => $data['modelid']));
        $this->db->select('template_list,template_show');
        $template = $this->db->get('model')->row_array();
        $datas = array('pid' => '0', 'name' => $data['name'], 'sort' => '99', 'status' => '1', 'modelid' => $data['modelid'], 'template_list' => $template['template_list'], 'template_show' => $template['template_show']);
        $this->db->insert('cate', $datas);
        $id = $this->db->insert_id();
        $name_e = $data['name_e'];
        $name = explode(',', $name_e);
        if ($name_e) {
            foreach ($name as $key => $v) {
                $datas = array('pid' => $id, 'name' => $v, 'sort' => $key, 'status' => '1', 'modelid' => $data['modelid'], 'template_list' => $template['template_list'], 'template_show' => $template['template_show']);
                if ($datas['name']) {
                    $this->db->insert('cate', $datas);
                }
            }
        }
        success('批量添加分类成功！', APP_ADMIN . '/cate');
    }
}