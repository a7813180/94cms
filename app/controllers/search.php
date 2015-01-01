<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 搜索
 */
class Search extends My_Controller {
    function __construct() {
        parent::__construct();
        $this->is_view(); //引入模板引擎和自定义配置类
        
    }
    //默认首页
    public function index() {
        $type = $this->input->get('type', true);
        $q = $this->input->get('q', true);
        $q = safe_replace($q); //safe_replace 对搜索的关键词过滤
        //$q = $this->db->escape_like_str($q);
        $type = empty($type) ? 2 : (int)($type);
        if ($type == 1) {
            $type = 2;
        }
        if (empty($q) || strlen($q) < 2) {
            error('搜索关键字最少2个字节！');
        }
        $tablename = $this->db->select('tablename')->get_where('model', array(
            'id' => $type
        ))->row_array();
        if (!$tablename) {
            show_error('模型不存在！');
        }
        //开始查询
        $tb = $tablename['tablename'];
        $this->load->model('content_model', 'content');
        $_tnum = $this->content->search($tb, $q, $type, true);
        //分页
        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/search?type=' . urlencode($type) . '&q=' . $q;
        $config['total_rows'] = $_tnum;
        $config['per_page'] = '10';
        $config['page_query_string'] = true;
        $this->pagination->initialize($config);
        $indexpage = $this->input->get('per_page', true);
        isset($indexpage) ? '' : $indexpage = 0;
        $this->db->limit(10, $indexpage);
        $arr = $this->content->search($tb, $q, $type);
        $data['model'] = $this->db->where('id !=', '1')->get('model')->result_array();
        $data['searchlist'] = $arr;
        $data['q'] = $q;
        $data['title'] = "搜索-" . $q;
        $data['page'] = $this->pagination->create_links();
        $this->view('search.html', $data);
    }
}
?>
