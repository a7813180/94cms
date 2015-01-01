<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Content extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->is_login();
        $this->load->model('Cate_model', 'cate');
        $this->load->library('cate_class');
        $this->load->helper('common');
        $this->load->library('form_validation');
    }
    //内容页面需要判断是否有2级分类
    public function index() {
        $cid = $this->uri->segment(4);
        if (!$cid) {
            error('分类不存在！');
        }
        //判断有没有下级分类
        $data = $this->cate->cate_models();
        $data['cate'] = $this->cate_class->fu_cate($data, $cid);
        $data['cid'] = $cid;
        $this->load->view('admin/content_index.html', $data);
    }
    //如果一级分类下面还有子类就调用本页面
    public function content_left() {
        $cid = $this->uri->segment(4);
        if (!$cid) {
            error('分类不存在！');
        }
        $cate = $this->cate->cate_models();
        $data['cid'] = $cid;
        $data['cate'] = $this->cate_class->fu_cate_nr($cate, $cid);
        $this->load->view('admin/content_left.html', $data);
    }
    //内容列表页面
    public function content_right() {
        $laji = false; //陈了这句其他和默认首页一模一样
        $this->load->helper('text');
        $cid = $this->uri->segment(4);
        $soso = $this->uri->segment(5);
        if (!$cid) {
            error('分类不存在！');
        }
        $md = $this->cate->cate_models(array(
            'cate.id' => $cid
        ));
        if (!$md) {
            error('分类不存在！');
        }
        $mid = $md['modelid'];
        $tablename = $md['tablename'];
        if ($tablename == 'page') {
            //判断如果本分类的模型表名如果是单页
            $data['page'] = $this->cate->cid_page($cid); //调用自定义模型
            //得到自定义字段
            // $this->load->model('Content_model','cont');
            //$data['field']=$this->cont->diyfield($mid);
            $this->load->view('admin/content_page.html', $data);
        } else {
            //查询本分类下面有没有下级分类，如果有分配到$ids里面
            $this->load->model('Content_model', 'cont');
            $this->load->library('Cate_class');
            $this->load->model('Cate_Model', 'cate');
            $cate = $this->cate->cate_select('id,pid,name');
            $ids = $this->cate_class->fu_cate($cate, $cid);
            $ids[] = $cid;
            //调用查询内容模型
            $this->load->model('Content_model', 'cont');
            //需要调用的字段 AS
            $arr = $tablename . ".id AS id," . $tablename . ".cid AS cid," . "cate.name AS cname," . $tablename . ".title AS title," . $tablename . ".publishtime AS publishtime," . $tablename . ".click AS click," . $tablename . ".sort AS sort," . $tablename . ".litpic AS litpic";
            //分页开始
            if (!empty($soso)) {
                if ($this->input->post('type', TRUE) == 1) {
                    $this->db->where('title', $this->input->post('title', TRUE));
                } else {
                    $this->db->like('title', $this->input->post('title', TRUE));
                }
            }
            $num = $this->cont->content_select($arr, $tablename, $cid, 'sort', 'asc', 'num_rows', $ids, $laji); //得到所有列表数量
            $this->load->library('pagination');
            if ($this->input->get('page')) {
                $perPage = $_GET['page'];
            } else {
                $perPage = 10;
            }
            //每页显示多少条
            //得到本分类的模型信息
            $cate = $this->db->get_where('cate', array(
                'id' => $cid
            ))->row_array();
            //重新到所有分类
            $_data = $this->cate->cate_models();
            $this->load->library('cate_class');
            $_data = $this->cate_class->yi_wei($_data);
            $data['cate'] = $this->cate_class->getLevelOfModel($_data, $cate['modelid']);
            $config['base_url'] = site_url() . '/' . APP_ADMIN . '/content/content_right/' . $cid;
            $config['total_rows'] = $num;
            $config['per_page'] = $perPage;
            $config['uri_segment'] = 5;
            $config['first_link'] = '首页';
            $config['num_links'] = 2;
            $config['prev_link'] = '上一页';
            $config['next_link'] = '下一页';
            $config['last_link'] = '最后一页';
            $offset = $this->uri->segment(5);
            $this->pagination->initialize($config);
            //搜索
            if (!empty($soso)) {
                if ($this->input->post('type', TRUE) == 1) {
                    $this->db->where('title', $this->input->post('title', TRUE));
                } else {
                    $this->db->like('title', $this->input->post('title', TRUE));
                }
                $data['so_title'] = $this->input->post('title', TRUE);
            }
            $this->db->limit($perPage, $offset);
            $data['page'] = "<a>" . "一共有" . $num . '条内容,分为' . ceil($num / $perPage) . '页' . "</a>";
            $data['page'] = $data['page'] . $this->pagination->create_links();
            $data['num'] = $num;
            //分页结束
            $data['content'] = $this->cont->content_select($arr, $tablename, $cid, 'sort', 'asc', 'result_array', $ids, $laji);
            $data['tablename'] = $tablename;
            $data['cid'] = $cid;
            $data['laji'] = $laji; //需要本字段来判断是不是回收站
            $this->load->view('admin/content_list.html', $data);
        }
    }
    //列表内容移动
    public function yidong() {
        $tablename = $this->uri->segment(4);
        $cid = $this->uri->segment(5);
        !$tablename && !$cid ? error('请用正规后台路径访问！') : '';
        $data = $this->input->post(null, true);
        empty($data['del']) ? error('亲！要移动的内容呢？请把要移动的内容打钩！') : '';
        $ids = $data['del'];
        foreach ($ids as $v) {
            $this->db->where('id', $v)->update($tablename, array(
                'cid' => $data['cid']
            ));
        }
        success('移动成功！', APP_ADMIN . '/content/content_right/' . $cid);
    }
    //列表内容复制
    public function fuzhi() {
        $tablename = $this->uri->segment(4);
        $cid = $this->uri->segment(5);
        !$tablename && !$cid ? error('请用正规后台路径访问！') : '';
        $data = $this->input->post(null, true);
        empty($data['del']) ? error('亲！要复制的内容呢？请把要复制的内容打钩！') : '';
        $ids = $data['del'];
        foreach ($ids as $v) {
            $data_a = $this->db->where('id', $v)->get($tablename)->row_array();
            unset($data_a['id']);
            $data_b = $this->db->where('id', $v)->get($tablename . '_data')->row_array();
            $data_a['cid'] = $data['cid'];
            $this->db->insert($tablename, $data_a);
            $data_a_id = $this->db->insert_id();
            $data_b['id'] = $data_a_id;
            $this->db->insert($tablename . '_data', $data_b);
        }
        success('复制成功！', APP_ADMIN . '/content/content_right/' . $cid);
    }
    //单页修改
    public function page_updata() {
        if (!$_POST) {
            die('404!');
        }
        if ($this->form_validation->run('page') == false) {
            $msg = validation_errors();
            $msg = msg($msg);
            error($msg);
        } else {
            $data = $this->input->post(null, true);
            if ($data['keywords'] == '') {
                $data['keywords'] = $data['name'];
            }
            $this->load->helper('text');
            if ($data['description'] == '') {
                $data['description'] = character_limiter(strip_tags($data['content']) , 80);
            }
            $data['content'] = $this->input->post('content');
            $data = array(
                'id' => $data['id'],
                'name' => $data['name'],
                'seotitle' => $data['seotitle'],
                'keywords' => $data['keywords'],
                'litpic' => $data['litpic'],
                'description' => $data['description'],
                'content' => $data['content'],
            );
            $this->db->where(array(
                'id' => $data['id']
            ))->update('cate', $data);
            success('修改成功！', APP_ADMIN . "/content/content_right/" . $data['id']);
        }
    }
    //添加内容显示
    public function add() {
        $data['tablename'] = $this->uri->segment(4);
        $data['cid'] = $this->uri->segment(5);
        if (empty($data['tablename']) or empty($data['cid'])) {
            die('404!');
        }
        //得到本分类的模型信息
        $cate = $this->db->get_where('cate', array(
            'id' => $data['cid']
        ))->row_array();
        //重新到所有分类
        $_data = $this->cate->cate_models();
        $this->load->library('cate_class');
        $_data = $this->cate_class->yi_wei($_data);
        $data['cate'] = $this->cate_class->getLevelOfModel($_data, $cate['modelid']);
        $this->load->helper('common');
        $this->config->load('diy', true);
        $tm = $this->config->item('tm', 'diy');
        $tm = $tm['template'];
        $data['template_show'] = getFileFolderList(TMPATH, 2, 'show_*');
        //得到自定义字段
        $this->load->model('Content_model', 'cont');
        $data['field'] = $this->cont->diyfield($cate['modelid']);
        $this->load->view("admin/content_add.html", $data);
    }
    //添加内容动作
    public function add_s() {
        $data = $this->input->post(null, true);
        $this->form_validation->set_rules('title', '标题', 'required|min_length[4]');
        if ($this->form_validation->run() == false) {
            $msg = validation_errors();
            $msg = msg($msg);
            error($msg);
        }
        $data['content'] = $this->input->post('content');
        //分词测试
        if (empty($data['keywords'])) {
            $fenci = config_item('fenci');
            if ($fenci) {
                //调用dz云平台分词系统
                $this->load->helper('common');
                $data['keywords'] = get_tag_auto(strip_tags($data['title']) , strip_tags($data['content']));
            } else {
                $this->load->library('fenci_class');
                $data['keywords'] = $this->fenci_class->get_keyword($data['title']);
                //本地分词系统，有点小问题！
                
            }
        }
        $tablename = $data['tablename'];
        $cid = $data['cid'];
        if (empty($data['flag'])) {
            $data['flag'] = '';
        } else {
            $flag = $data['flag'];
            $data['flag'] = 0;
            foreach ($flag as $v) {
                $data['flag']+= $v;
            }
        }
        if (empty($data['publishtime'])) {
            $data['publishtime'] = time();
        } else {
            $data['publishtime'] = strtotime($data['publishtime']);
        }
        $this->load->helper('text');
        if (empty($data['description']) && !empty($data['content'])) {
            $data['description'] = get_str($data['content'], 200);
            //$this->load->helper('common');
            // $data['description'] = substr_ext($data['description'],0,250);
            
        }
        //下载远程图片
        if (isset($data['get_content_img'])) {
            if (!empty($data['content'])) {
                $arr_img = get_img($data['content']);
                $arr_img = array_unique($arr_img);
                foreach ($arr_img as $key => $img_url) {
                    $furl = get_photo($img_url);
                    //提取内容第一张为缩略图
                    if (isset($data['get_content_img_litpic']) && $key == '0') {
                        $data['litpic'] ? '' : $data['litpic'] = $furl;
                    }
                    $furl = config_item('cmspath') . '/' . $furl;
                    $data['content'] = ereg_replace($img_url, $furl, $data['content']);
                }
            }
        }
        //重新组合
        $data = array(
            'title' => $data['title'],
            'shorttitle' => $data['shorttitle'],
            'flag' => $data['flag'],
            'color' => $data['color'],
            'keywords' => $data['keywords'],
            'author' => $data['author'],
            'litpic' => $data['litpic'],
            'description' => $data['description'],
            'content' => $data['content'],
            'publishtime' => $data['publishtime'],
            'click' => $data['click'],
            'sort' => $data['sort'],
            'template_show' => $data['template_show'],
        );
        $data_a = $data;
        $data_a['cid'] = $cid;
        //处理自定义字段信息
        $cate = $this->db->select('modelid')->get_where('cate', array(
            'id' => $cid
        ))->row_array(); //得到本分类的模型信息
        //得到验证规则
        $diyfield = $this->db->select('field,label,rules,fieldtype')->get_where("model_field", array(
            'modelid ' => $cate['modelid']
        ))->result_array();
        if ($diyfield) {
            $this->form_validation->set_rules($diyfield);
            if ($this->form_validation->run() == false) {
                $msg = validation_errors();
                $msg = msg($msg);
                error($msg);
            }
        }
        $this->db->insert($tablename, $data_a); //主表数据插入
        $id = $this->db->insert_id(); //得到主表插入数据的id
        //TAG 入库
        if (!empty($data['keywords'])) {
            $modelid = $this->db->select('id')->get_where('model', array(
                'tablename' => $tablename
            ))->row_array();
            $modelid = $modelid['id'];
            $tag = explode(',', $data['keywords']);
            foreach ($tag as $v) {
                $_tag = $this->db->get_where('tag', array(
                    'title' => $v
                ))->num_rows();
                if ($_tag == '0') {
                    $this->db->insert('tag', array(
                        'title' => $v,
                        'num' => '1'
                    ));
                    $tag_id = $this->db->insert_id();
                } else {
                    $this->db->where('title', $v);
                    $this->db->set('num', 'num+1', FALSE);
                    $this->db->update('tag');
                    $tag_id = $this->db->select('id')->get_where('tag', array(
                        'title' => $v
                    ))->row_array();
                    $tag_id = $tag_id['id'];
                }
                $tag_data = array(
                    'tid' => $tag_id,
                    'sid' => $id,
                    'mid' => $modelid,
                );
                $this->db->insert('tag_content', $tag_data);
            }
        }
        //TAG end
        if ($diyfield) {
            //把字段读取分配到$FIELD 里面
            foreach ($diyfield as $v) {
                $field[] = array(
                    'field' => $v['field'],
                    'fieldtype' => $v['fieldtype']
                );
            }
            //重组
            $data_b = array();
            $data_b['id'] = $id;
            foreach ($field as $v) {
                $diy = $v['field'];
                if ($v['fieldtype'] == 'checkbox' || $v['fieldtype'] == 'images') {
                    $this->load->helper('common');
                    $data_b[$diy] = array2string($this->input->post($diy, true));
                } elseif ($v['fieldtype'] == 'editor') {
                    $data_b[$diy] = $this->input->post($diy);
                } else {
                    $data_b[$diy] = $this->input->post($diy, true);
                }
            }
            $this->db->insert($tablename . '_data', $data_b); //发布到附表里面
            
        }
        //同时发布操作
        $cids = $this->input->post('cids', true);
        if (!empty($cids)) {
            foreach ($cids as $v) {
                $data_a['cid'] = $v;
                $this->db->insert($tablename, $data_a);
                if ($diyfield) {
                    $id = $this->db->insert_id();
                    $data_b['id'] = $id;
                    $this->db->insert($tablename . '_data', $data_b);
                }
            }
        }
        success('发布成功!', APP_ADMIN . '/content/content_right/' . $cid);
    }
    //内容修改显示 所有模型全部在这里
    public function content_updata() {
        $id = $this->uri->segment(5);
        $tablename = $this->uri->segment(4);
        if (!$id && !$tablename) {
            error('内容不存在！');
        }
        $this->load->model('Content_model', 'cont');
        $data = $this->cont->content($tablename, $id);
        $data['tablename'] = $tablename;
        //得到本分类的模型信息
        $cate = $this->db->get_where('cate', array(
            'id' => $data['cid']
        ))->row_array();
        //重新到所有分类
        $_data = $this->cate->cate_models();
        $this->load->library('cate_class');
        $data['cate'] = $this->cate_class->mid_cate($_data, $cate['modelid']);
        $this->load->helper('common');
        $this->config->load('diy', true);
        $tm = $this->config->item('tm', 'diy');
        $tm = $tm['template'];
        $data['template_shows'] = getFileFolderList(FCPATH . '/template/' . $tm, 2, 'show_*');
        //得到自定义字段
        $this->load->model('Content_model', 'cont');
        $data['field'] = $this->cont->diyfield($cate['modelid']);
        $data['id'] = $id; //如果模型不存在自定义字段 读取 关联数据的时候，会把id读取不出来
        $this->load->view('admin/content_updata.html', $data);
        return (json_encode(array(
            "error" => 0,
            'status' => 1,
            "url" => '2222222'
        )));
    }
    //内容修改处理
    public function content_updata_s() {
        $data = $this->input->post(null, true);
        $id = $data['id'];
        if (empty($id)) {
            error('id不存在！');
        }
        $this->form_validation->set_rules('title', '标题', 'required|min_length[4]');
        if ($this->form_validation->run() == false) {
            $msg = validation_errors();
            $msg = msg($msg);
            error($msg);
        }
        $data['content'] = $this->input->post('content');
        //分词测试
        if (empty($data['keywords'])) {
            $fenci = config_item('fenci');
            if ($fenci) {
                //调用dz云平台分词系统
                $this->load->helper('common');
                $data['keywords'] = get_tag_auto(strip_tags($data['title']) , strip_tags($data['content']));
            } else {
                $this->load->library('fenci_class');
                $data['keywords'] = $this->fenci_class->get_keyword($data['title']);
                //本地分词系统，有点小问题！
                
            }
        }
        $tablename = $data['tablename'];
        $cid = $data['cid'];
        if (empty($data['flag'])) {
            $data['flag'] = '';
        } else {
            $flag = $data['flag'];
            $data['flag'] = 0;
            foreach ($flag as $v) {
                $data['flag']+= $v;
            }
        }
        if (empty($data['publishtime'])) {
            $data['publishtime'] = time();
        } else {
            $data['publishtime'] = strtotime($data['publishtime']);
        }
        //截取字符串位数有问题！需要修改！先这样
        $this->load->helper('text');
        if (empty($data['description']) && !empty($data['content'])) {
            $data['description'] = get_str($data['content'], 200);
            //$this->load->helper('common');
            //$data['description'] = substr_ext($data['description'],0,250);
            
        }
        //下载远程图片
        if (isset($data['get_content_img'])) {
            if (!empty($data['content'])) {
                $arr_img = get_img($data['content']);
                $arr_img = array_unique($arr_img);
                foreach ($arr_img as $key => $img_url) {
                    $furl = get_photo($img_url);
                    //提取内容第一张为缩略图
                    if (isset($data['get_content_img_litpic']) && $key == '0') {
                        $data['litpic'] ? '' : $data['litpic'] = $furl;
                    }
                    $furl = config_item('cmspath') . '/' . $furl;
                    $data['content'] = ereg_replace($img_url, $furl, $data['content']);
                }
            }
        }
        //重新组合
        $data = array(
            'title' => $data['title'],
            'shorttitle' => $data['shorttitle'],
            'flag' => $data['flag'],
            'color' => $data['color'],
            'keywords' => $data['keywords'],
            'author' => $data['author'],
            'litpic' => $data['litpic'],
            'description' => $data['description'],
            'content' => $data['content'],
            'updatetime' => $data['publishtime'],
            'click' => $data['click'],
            'sort' => $data['sort'],
            'template_show' => $data['template_show'],
        );
        $data_a = $data;
        $data_a['cid'] = $cid;
        //处理自定义字段信息
        $cate = $this->db->select('modelid')->get_where('cate', array(
            'id' => $cid
        ))->row_array(); //得到本分类的模型信息
        //得到验证规则
        $diyfield = $this->db->select('field,label,rules,fieldtype')->get_where("model_field", array(
            'modelid ' => $cate['modelid']
        ))->result_array();
        if ($diyfield) {
            $this->form_validation->set_rules($diyfield);
            if ($this->form_validation->run() == false) {
                $msg = validation_errors();
                $msg = msg($msg);
                error($msg);
            }
        }
        $this->db->where(array(
            'id' => $id
        ));
        $caozuo_a = $this->db->update($tablename, $data_a); //主表修改完成
        //TAG 入库
        if (!empty($data['keywords'])) {
            $modelid = $this->db->select('id')->get_where('model', array(
                'tablename' => $tablename
            ))->row_array();
            $modelid = $modelid['id'];
            $tag = explode(',', $data['keywords']);
            foreach ($tag as $v) {
                $_tag = $this->db->get_where('tag', array(
                    'title' => $v
                ))->num_rows();
                if ($_tag == '0') {
                    $this->db->insert('tag', array(
                        'title' => $v,
                        'num' => '1'
                    ));
                    $tag_id = $this->db->insert_id(); //得到tag_id
                    $tag_data = array(
                        'tid' => $tag_id,
                        'sid' => $id,
                        'mid' => $modelid,
                    );
                    $this->db->insert('tag_content', $tag_data); //插入数据库
                    
                } else {
                    /*$this->db->where('title',$v);
                    $this->db->set('num', 'num+1', FALSE);
                    $this->db->update('tag');*/
                    //存在就是之前文章添加的 所以num不需要加1
                    $tag_id = $this->db->select('id')->get_where('tag', array(
                        'title' => $v
                    ))->row_array();
                    $tag_id = $tag_id['id'];
                    //查询tag附表 是不是已经添加好数据
                    $tag_data = array(
                        'tid' => $tag_id,
                        'sid' => $id,
                        'mid' => $modelid,
                    );
                    $tag_cz = $this->db->get_where('tag_content', $tag_data)->num_rows();
                    if (!$tag_cz) {
                        $this->db->insert('tag_content', $tag_data);
                    }
                }
            }
        }
        //TAG end
        if ($diyfield) {
            //把字段读取分配到$FIELD 里面
            foreach ($diyfield as $v) {
                $field[] = array(
                    'field' => $v['field'],
                    'fieldtype' => $v['fieldtype']
                );
            }
            //重组
            $data_b = array();
            $data_b['id'] = $id;
            foreach ($field as $v) {
                $diy = $v['field'];
                if ($v['fieldtype'] == 'checkbox' || $v['fieldtype'] == 'images') {
                    $this->load->helper('common');
                    $data_b[$diy] = array2string($this->input->post($diy, true));
                } elseif ($v['fieldtype'] == 'editor') {
                    $data_b[$diy] = $this->input->post($diy);
                } else {
                    $data_b[$diy] = $this->input->post($diy, true);
                }
            }
            //判断一下附表的关联数据是否存在！如果不存在插入数据 存在则修改数据
            $this->db->where(array(
                'id' => $id
            ));
            $num = $this->db->get($tablename . '_data')->num_rows();
            if ($num) {
                $caozuo_b = $this->db->where(array(
                    'id' => $id
                ))->update($tablename . '_data', $data_b);
            } else {
                $caozuo_b = $this->db->insert($tablename . '_data', $data_b);
            }
            //判断是否操作成功
            if ($caozuo_a && $caozuo_b) {
                success('修改成功！', APP_ADMIN . '/content/content_right/' . $cid);
            } else {
                error('操作失败请检查错误！');
            }
        } else {
            $this->db->where(array(
                'id' => $id
            ));
            $caozuo_a = $this->db->update($tablename, $data_a);
            if ($caozuo_a) {
                success('修改成功！', APP_ADMIN . '/content/content_right/' . $cid);
            } else {
                error('操作失败请检查错误！');
            }
        }
    }
    //回收站首页
    public function hsz() {
        $laji = true; //陈了这句其他和默认首页一模一样
        $this->load->helper('text');
        $cid = $this->uri->segment(4);
        if (!$cid) {
            error('分类不存在！');
        }
        $md = $this->cate->cate_models(array(
            'cate.id' => $cid
        ));
        if (!$md) {
            error('分类不存在！');
        }
        $mid = $md['modelid'];
        $tablename = $md['tablename'];
        if ($tablename == 'page') {
            //判断如果本分类的模型表名如果是单页
            $data['page'] = $this->cate->cid_page($cid); //调用自定义模型
            //得到自定义字段
            // $this->load->model('Content_model','cont');
            //$data['field']=$this->cont->diyfield($mid);
            $this->load->view('admin/content_page.html', $data);
        } else {
            //查询本分类下面有没有下级分类，如果有分配到$ids里面
            $this->load->model('Content_model', 'cont');
            $this->load->library('Cate_class');
            $this->load->model('Cate_Model', 'cate');
            $cate = $this->cate->cate_select('id,pid,name');
            $ids = $this->cate_class->fu_cate($cate, $cid);
            $ids[] = $cid;
            //调用查询内容模型
            $this->load->model('Content_model', 'cont');
            //需要调用的字段 AS
            $arr = $tablename . ".id AS id," . $tablename . ".cid AS cid," . "cate.name AS cname," . $tablename . ".title AS title," . $tablename . ".publishtime AS publishtime," . $tablename . ".click AS click," . $tablename . ".sort AS sort";
            //分页开始
            $num = $this->cont->content_select($arr, $tablename, $cid, 'sort', 'desc', 'num_rows', $ids, $laji); //得到所有列表数量
            $this->load->library('pagination');
            if ($this->input->get('page')) {
                $perPage = $_GET['page'];
            } else {
                $perPage = 10;
            }
            //每页显示多少条
            $config['base_url'] = site_url(APP_ADMIN . '/content/hsz/' . $cid);
            $config['total_rows'] = $num;
            $config['per_page'] = $perPage;
            $config['uri_segment'] = 5;
            $config['first_link'] = '首页';
            $config['num_links'] = 2;
            $config['prev_link'] = '上一页';
            $config['next_link'] = '下一页';
            $config['last_link'] = '最后一页';
            $offset = $this->uri->segment(5);
            $this->pagination->initialize($config);
            $this->db->limit($perPage, $offset);
            $data['page'] = "<a>" . "一共有" . $num . '条内容,分为' . ceil($num / $perPage) . '页' . "</a>";
            $data['page'] = $data['page'] . $this->pagination->create_links();
            $data['num'] = $num;
            //分页结束
            $data['content'] = $this->cont->content_select($arr, $tablename, $cid, 'sort', 'asc', 'result_array', $ids, $laji);
            $data['tablename'] = $tablename;
            $data['cid'] = $cid;
            $data['laji'] = $laji; //需要本字段来判断是不是回收站
            $this->load->view('admin/content_list.html', $data);
        }
    }
    //批量修改顺序
    public function content_sort() {
        $data = $this->input->post(null, true);
        $tablename = $this->uri->segment(4);
        $cid = $this->uri->segment(5);
        foreach ($data as $key => $v) {
            if ($key !== 'del' && $key !== 'title' && $key !== 'type' && $key !== 'cid') {
                $id = explode('_', $key);
                $this->db->where(array(
                    'id' => $id['1']
                ));
                $this->db->update($tablename, array(
                    'sort' => $v
                ));
            }
        }
        success('内容顺序更新成功!', APP_ADMIN . '/content/content_right/' . $cid);
    }
    //批量删除到回收站
    public function P_hsz() {
        $data = $this->input->post('del', true);
        $data ? '' : error('要删除内容不存在！');
        $tablename = $this->uri->segment(4);
        $cid = $this->uri->segment(5);
        foreach ($data as $key => $v) {
            $this->db->where(array(
                'id' => $v
            ));
            $this->db->update($tablename, array(
                'status' => 1
            ));
        }
        success('删除至回收站成功!', APP_ADMIN . '/content/content_right/' . $cid);
    }
    // 删除内容
    public function content_del() {
        $tablename = $this->uri->segment(4);
        $id = $this->uri->segment(5);
        $cid = $this->uri->segment(6);
        if (!$id || !$tablename) {
            error('要删除内容不存在！');
        }
        $this->db->delete($tablename, array(
            'id' => $id
        ));
        $this->db->delete($tablename . '_data', array(
            'id' => $id
        ));
        success('删除成功', APP_ADMIN . '/content/content_right/' . $cid);
    }
    //删除到回收站
    public function content_hsz_del() {
        $tablename = $this->uri->segment(4);
        $id = $this->uri->segment(5);
        $cid = $this->uri->segment(6);
        if (!$id || !$tablename) {
            error('要删除内容不存在！');
        }
        $this->db->where(array(
            'id' => $id
        ))->update($tablename, array(
            'status' => 1
        ));
        success('删除成功!', APP_ADMIN . '/content/content_right/' . $cid);
    }
    //回收站恢复
    public function content_hsz_hf() {
        $tablename = $this->uri->segment(4);
        $id = $this->uri->segment(5);
        $cid = $this->uri->segment(6);
        if (!$id || !$tablename) {
            error('要删除内容不存在！');
        }
        $this->db->where(array(
            'id' => $id
        ))->update($tablename, array(
            'status' => 0
        ));
        success('恢复成功!', APP_ADMIN . '/content/hsz/' . $cid);
    }
    //批量回收站恢复
    public function content_hsz_hf_s() {
        $data = $this->input->post('del', true);
        $data ? '' : error('亲！请不要逗我好不好，要恢复的文章请打钩！');
        $tablename = $this->uri->segment(4);
        $cid = $this->uri->segment(5);
        foreach ($data as $key => $v) {
            $this->db->where(array(
                'id' => $v
            ));
            $this->db->update($tablename, array(
                'status' => 0
            ));
        }
        success('批量恢复成功!', APP_ADMIN . '/content/hsz/' . $cid);
    }
    //批量彻底删除
    public function content_hsz_del_s() {
        $data = $this->input->post('del', true);
        $data ? '' : error('亲！请不要逗我好不好，要删除的文章请打钩！');
        $tablename = $this->uri->segment(4);
        $cid = $this->uri->segment(5);
        foreach ($data as $v) {
            $this->db->delete($tablename, array(
                'id' => $v
            ));
            $this->db->delete($tablename . '_data', array(
                'id' => $v
            )); //删除附表
            
        }
        success('批量彻底删除成功!', APP_ADMIN . '/content/hsz/' . $cid);
    }
    public function soso() {
        $data = $this->input->post(NULL, TRUE);
        P($data);
        DIE;
    }
}
?>
