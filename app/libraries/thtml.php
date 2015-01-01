<?php
 
    class tHtml{
       
     
     //批量生成
     function schtml_all($c,$show,$data,$datas){
       foreach($data as $v){
         $this->schtml($c,$show,$v,$datas);
         echo $v['id'].'__________OK'.'<br/>';
       }
       return true;
      }


     //生成
     function schtml($c,$show,$data,$cates){

      //先判断封面模板存在不存在如果不存在 查询分页
       if($c == 'cate' && empty($data['template_index']) ){
           $CI =& get_instance();
           $CI ->load->library('cate_class');
           $cids = $CI->cate_class->fu_cate($cates,$data['id']);
           $cids[] = $data['id'];
           $CI->load->model('md_model');
           $tablename = $CI->md_model->md_table('tablename',$data['modelid']);
           $tablename = $tablename['tablename'];
           $CI->db->where('status',0); //回收站
           $CI->db->where_in('cid',$cids);
           $t_num = $CI->db->get('news')->num_rows();
           //模板设置的每页多少条
           $page = $this->page($data['template_list']);
           if($page){
              $page = ceil($t_num/$page );
           }
        
         }else{
           $page = false;
         }
       $ename = empty($data['ename'])? null : $data['ename']; 
       if(!$page){
        $url = $c.'/'.$show.'/'.$data['id'];
        if($c == 'page'){
           $htmlname = empty($data['ename']) ? 'page_view_'.$data['id'].".html": 'index.html';
        }elseif($c == 'show'){
           $url = $c.'/'.$show.'/'.$data['cid'].'/'.$data['id'];
           $ename = $cates['ename'];
           $htmlname = empty($cates['ename']) ? 'show_view_'.$data['cid'].'_'.$data['id'].".html": $data['id'].'.html';
        }else{
          $htmlname = empty($data['ename']) ? 'list_view_'.$data['id'].'_1'.".html": 'index.html';
        }

        $this->is_html($url,$ename,$htmlname);
       }else{
        for ($i=1; $i <=$page ; $i++) { 
         $url = $c.'/'.$show.'/'.$data['id'].'/'.$i;
         $htmlname = ($i == 1) ? 'index.html' : 'list_'.$i.'.html';
         $this->is_html($url,$ename,$htmlname);
        }
      }
     }
    
     
     //写入文件
     public function is_html($url,$ename,$htmlname){
      die;
       $content = @file_get_contents(site_url($url));
       if(empty($content)){
        $content = $this->curl_get_file_contents(site_url($url));
       }
       $filename = $this->is_filename($ename);
       if($filename!= FALSE){
         $fp = fopen($filename.DS.$htmlname, "w+");
         $zt = fputs($fp, $content);
         fclose($fp);
         return $zt;

       }else{
         return false;
        }


     }


     //判断目录存在不存在 不存在就自动创建
     public function is_filename($filename = null){
       $filename = FCPATH.config_item('html_path').DS.$filename;
       if(!is_dir(FCPATH.config_item('html_path'))){
          mkdir(FCPATH.config_item('html_path'),0700);
       }
         if(!is_dir($filename)){
          mkdir($filename,0700);
       }
       return $filename;
     }
  

  /**
   curl 读取文件
   */
  function curl_get_file_contents($url)
    {
      if(!function_exists('curl_init'))return FALSE;
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $url);
        $contents = curl_exec($c);
        curl_close($c);
        if (FALSE === $contents)return FALSE;
        return $contents;
    }
  
   
  //读取page每页分多少条
  function page($filename){
    if(empty($filename) || !file_exists (TMPATH.$filename)){ return false;}

    $pagenum= file_get_contents(TMPATH.$filename);
    if(empty($pagenum)){
      return false;
    }
    preg_match_all("/\{pc:content action=\"_list\" +([^}]+)\}/ie", $pagenum, $str);
    preg_match_all("/([a-z]+)\=[\"]?([^\"]+)[\"]?/i", stripslashes($str['1']['0']), $matches, PREG_SET_ORDER);
    foreach ($matches as $v) {
            $$v[1] = $v[2];
        }
    $page =isset($num)?  $num : '10';
    return $page;
    }



 
}

?>
